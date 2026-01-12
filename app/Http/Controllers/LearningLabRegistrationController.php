<?php

namespace App\Http\Controllers;

use App\Models\LearningLab;
use App\Models\LearningLabRegistration;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LearningLabRegistrationController extends Controller
{
    /**
     * Store public registration (NO LOGIN)
     * POST /api/learning-labs/{learningLab}/register
     */
    public function store(Request $request, LearningLab $learningLab)
    {
        // ✅ Prevent duplicate email per learning lab
        $exists = LearningLabRegistration::where('learning_lab_id', $learningLab->id)
            ->where('email', $request->email)
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'email' => 'This email is already registered for this Learning Lab.',
            ]);
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'role_position' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'province' => 'nullable|string|max:100',

            'is_ngof_member' => 'required|boolean',

            // Conditional fields
            'ngo_name' => 'nullable|string|max:255',
            'payment_percentage' => 'nullable|integer|in:25,50,100',

            'special_needs' => 'nullable|string',

            // MUST be checked
            'consent' => 'accepted',
        ]);

        // BUSINESS RULES
        if ($validated['is_ngof_member']) {
            if (empty($validated['ngo_name'])) {
                return response()->json([
                    'message' => 'NGO name is required for NGOF members.',
                ], 422);
            }
            $validated['payment_percentage'] = null;
        } else {
            if (empty($validated['payment_percentage'])) {
                return response()->json([
                    'message' => 'Payment percentage is required for non-NGOF members.',
                ], 422);
            }
            $validated['ngo_name'] = null;
        }

        $validated['learning_lab_id'] = $learningLab->id;

        LearningLabRegistration::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Registration successful',
        ], 201);
    }
}

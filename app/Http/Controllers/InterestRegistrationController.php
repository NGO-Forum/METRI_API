<?php

namespace App\Http\Controllers;

use App\Models\InterestRegistration;
use Illuminate\Http\Request;

class InterestRegistrationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'organization'   => 'required|string|max:255',
            'role_position'  => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'nullable|string|max:50',
            'province'       => 'nullable|string|max:255',
            'interests'      => 'nullable|array',
            'interests.*'    => 'string|max:255',
            'consent'        => 'required|boolean',
        ]);

        $registration = InterestRegistration::create($validated);

        return response()->json([
            'message' => 'Interest registered successfully',
            'data'    => $registration,
        ], 201);
    }
}

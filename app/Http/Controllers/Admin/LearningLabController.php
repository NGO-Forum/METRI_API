<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningLab;
use Illuminate\Http\Request;

class LearningLabController extends Controller
{
    public function index()
    {
        return LearningLab::latest()->paginate(10);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date'         => 'required|date',
            'topic'        => 'required|string|max:255',
            'time'         => 'required|string|max:50',
            'format'       => 'required|in:online,in_person,hybrid',
            'speakers'     => 'required|string',
            'description'  => 'required|string',
            'link'         => 'nullable|url',
            'is_published' => 'boolean',
        ]);

        return LearningLab::create($validated);
    }

    public function update(Request $request, LearningLab $learningLab)
    {
        $validated = $request->validate([
            'date'         => 'sometimes|date',
            'topic'        => 'sometimes|string|max:255',
            'time'         => 'sometimes|string|max:50',
            'format'       => 'sometimes|in:online,in_person,hybrid',
            'speakers'     => 'sometimes|string',
            'description'  => 'sometimes|string',
            'link'         => 'nullable|url',
            'is_published' => 'boolean',
        ]);

        $learningLab->update($validated);

        return $learningLab;
    }

    public function destroy(LearningLab $learningLab)
    {
        $learningLab->delete();

        return response()->noContent();
    }
}

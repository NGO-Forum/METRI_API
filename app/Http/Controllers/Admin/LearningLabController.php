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
        $request->validate([
            'date'     => 'required|date',
            'topic'    => 'required|string|max:255',
            'time'     => 'required|string',
            'format'   => 'required|string',
            'speakers' => 'required|string',
        ]);

        return LearningLab::create($request->all());
    }


    public function update(Request $request, LearningLab $learningLab)
    {
        $learningLab->update($request->all());
        return $learningLab;
    }

    public function destroy(LearningLab $learningLab)
    {
        $learningLab->delete();
        return response()->noContent();
    }
}

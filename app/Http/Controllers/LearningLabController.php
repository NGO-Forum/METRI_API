<?php

namespace App\Http\Controllers;

use App\Models\LearningLab;

class LearningLabController extends Controller
{
    /**
     * Public list (NO LOGIN)
     */
    public function index()
    {
        return LearningLab::where('is_published', true)
            ->orderBy('date', 'asc')
            ->get();
    }

    /**
     * Public detail
     */
    public function show(LearningLab $learningLab)
    {
        if (!$learningLab->is_published) {
            abort(404);
        }

        return $learningLab;
    }
}

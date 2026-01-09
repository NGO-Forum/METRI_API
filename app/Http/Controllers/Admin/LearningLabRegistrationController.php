<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningLab;

class LearningLabRegistrationController extends Controller
{
    /**
     * List registrations for a learning lab
     */
    public function index()
    {
        return LearningLab::withCount('registrations')
            ->latest()
            ->get();
    }

    public function show(LearningLab $learningLab)
    {
        return $learningLab->registrations()
            ->latest()
            ->paginate(10);
    }
}

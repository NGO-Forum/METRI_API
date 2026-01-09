<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningLab;
use App\Models\LearningLabRegistration;

class LearningLabRegistrationController extends Controller
{
    /**
     * List registrations for a learning lab
     */
    public function index(LearningLab $learningLab)
    {
        return LearningLabRegistration::where('learning_lab_id', $learningLab->id)
            ->latest()
            ->paginate(20);
    }
}

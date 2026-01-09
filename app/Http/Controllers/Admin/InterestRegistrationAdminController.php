<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InterestRegistration;

class InterestRegistrationAdminController extends Controller
{
    public function index()
    {
        return response()->json(
            InterestRegistration::latest()->get()
        );
    }
}

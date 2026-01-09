<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LearningLabController;
use App\Http\Controllers\Admin\LearningLabController as AdminLearningLabController;
use App\Http\Controllers\LearningLabRegistrationController;
use App\Http\Controllers\Admin\LearningLabRegistrationController as AdminRegistrationController;

/*
|--------------------------------------------------------------------------
| Admin Auth
|--------------------------------------------------------------------------
*/
Route::post('/admin/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/admin/logout', [AuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Public Website (NO LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/learning-labs', [LearningLabController::class, 'index']);
Route::get('/learning-labs/{learningLab}', [LearningLabController::class, 'show']);
Route::post(
    '/learning-labs/{learningLab}/register',
    [LearningLabRegistrationController::class, 'store']
);
/*
|--------------------------------------------------------------------------
| Admin Dashboard (LOGIN + ADMIN)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:sanctum', 'is_admin'])
    ->prefix('admin')
    ->group(function () {
        Route::apiResource('learning-labs', AdminLearningLabController::class);
        Route::get(
            'learning-labs/{learningLab}/registrations',
            [AdminRegistrationController::class, 'index']
        );
    });

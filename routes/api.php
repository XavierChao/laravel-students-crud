<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\CourseApiController;
use Illuminate\Support\Facades\Route;

// Public routes (no authentication required)
Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

// Protected routes (require Sanctum token)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthApiController::class, 'logout']);
    Route::get('/user', [AuthApiController::class, 'user']);
    
    // Students CRUD
    Route::apiResource('students', StudentApiController::class)->names('api.students');
    
    // Courses CRUD
    Route::apiResource('courses', CourseApiController::class)->names('api.courses');
});
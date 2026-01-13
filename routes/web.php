<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/courses/export', [CourseController::class, 'exportCsv'])
        ->name('courses.export');

    Route::get('/courses/export-with-students', [CourseController::class, 'exportCoursesWithStudents'])
        ->name('courses.exportWithStudents');

    Route::get('/students/export', [StudentController::class, 'exportCsv'])
        ->name('students.export');

    Route::resource('students', StudentController::class);
    Route::resource('courses', CourseController::class);
});
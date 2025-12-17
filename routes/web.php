<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/courses/export', [CourseController::class, 'exportCsv'])
    ->name('courses.export');

Route::get('/students/export', [StudentController::class, 'exportCsv'])
    ->name('students.export');

Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
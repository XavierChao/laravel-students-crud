<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = \App\Models\Course::paginate(10);
        return view('courses.index', compact('courses'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        \App\Models\Course::create($validated);
        return redirect()->route('courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function show($id)
    {
        $course = \App\Models\Course::findOrFail($id);
        return view('courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = \App\Models\Course::findOrFail($id);
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, $id)
    {
        $course = \App\Models\Course::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = \App\Models\Course::findOrFail($id);
        $course->delete();
        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    public function exportCsv()
{
    $fileName = 'courses.csv';
    $courses = Course::all();

    return response()->streamDownload(function () use ($courses) {
        $handle = fopen('php://output', 'w');

        fputcsv($handle, ['ID', 'Name', 'Description']);

        foreach ($courses as $course) {
            fputcsv($handle, [
                $course->id,
                $course->name,
                $course->description,
            ]);
        }

        fclose($handle);
    }, $fileName, [
        'Content-Type' => 'text/csv',
    ]);
}

public function exportCoursesWithStudents()
{
    $fileName = 'courses_with_students.csv';
    $courses = Course::with('students')->get();

    return response()->streamDownload(function () use ($courses) {
        $handle = fopen('php://output', 'w');

        fputcsv($handle, ['Course ID', 'Course Name', 'Description', 'Student ID', 'Student Name', 'Student Email', 'Student Age']);

        foreach ($courses as $course) {
            if ($course->students->isEmpty()) {
                fputcsv($handle, [
                    $course->id,
                    $course->name,
                    $course->description,
                    '',
                    'No students enrolled',
                    '',
                    '',
                ]);
            } else {
                foreach ($course->students as $student) {
                    fputcsv($handle, [
                        $course->id,
                        $course->name,
                        $course->description,
                        $student->id,
                        $student->name,
                        $student->email,
                        $student->age,
                    ]);
                }
            }
        }

        fclose($handle);
    }, $fileName, [
        'Content-Type' => 'text/csv',
    ]);
}
}

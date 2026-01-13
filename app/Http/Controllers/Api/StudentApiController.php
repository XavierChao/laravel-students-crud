<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('course')->paginate(10);
        return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students',
            'age' => 'required|integer',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        $student = Student::create($validated);
        return response()->json($student, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load('course');

        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
            'age' => 'sometimes|required|integer',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        $student->update($validated);
        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}

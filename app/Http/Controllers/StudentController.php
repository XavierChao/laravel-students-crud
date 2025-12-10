<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Mostrar todos los estudiantes
     */
    public function index()
    {
        $students = Student::latest()->paginate(5);
    
        return view('students.index', compact('students'))
               ->with('i', 0);
    }


    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $courses = \App\Models\Course::all();
        return view('students.create', compact('courses'));
    }

    /**
     * Guardar estudiante en BD
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email|unique:students',
            'age'    => 'required|integer',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        Student::create($request->only([
            'name',
            'email',
            'age',
            'course_id'
        ]));

        return redirect()->route('students.index')
                         ->with('success', 'Estudiante creado correctamente.');
    }

    /**
     * Mostrar un estudiante
     */
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    /**
     * Formulario de edición
     */
    public function edit(Student $student)
    {
        $courses = \App\Models\Course::all();
        return view('students.edit', compact('student', 'courses'));
    }

    /**
     * Actualizar estudiante
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'   => 'required',
            'email'  => 'required|email|unique:students,email,' . $student->id,
            'age'    => 'required|integer',
            'course_id' => 'nullable|exists:courses,id',
        ]);

        $student->update($request->only([
            'name',
            'email',
            'age',
            'course_id'
        ]));

        return redirect()->route('students.index')
                         ->with('success', 'Estudiante actualizado correctamente.');
    }

    /**
     * Eliminar estudiante
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('students.index')
                         ->with('success', 'Estudiante eliminado correctamente.');
    }

    use App\Models\Student;

public function exportCsv()
{
    $fileName = 'students.csv';
    $students = Student::with('course')->get();

    return response()->streamDownload(function () use ($students) {
        $handle = fopen('php://output', 'w');

        fputcsv($handle, ['ID', 'Name', 'Email', 'Age', 'Course']);

        foreach ($students as $student) {
            fputcsv($handle, [
                $student->id,
                $student->name,
                $student->email,
                $student->age,
                optional($student->course)->name,
            ]);
        }

        fclose($handle);
    }, $fileName, [
        'Content-Type' => 'text/csv',
    ]);
}

}

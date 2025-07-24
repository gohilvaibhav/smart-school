<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::where('teacher_id', Auth::id())->latest()->get();
        return view('teacher.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.students.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create(array_merge(
            $request->validated(),
            ['teacher_id' => Auth::id()]
        ));

        return redirect()->route('teacher.students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::where('teacher_id', Auth::id())->findOrFail($id);
        return view('teacher.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, string $id)
    {
        $student = Student::where('teacher_id', Auth::id())->findOrFail($id);
        $student->update($request->validated());

        return redirect()->route('teacher.students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::where('teacher_id', Auth::id())->findOrFail($id);
        $student->delete();

        return redirect()->route('teacher.students.index')->with('success', 'Student deleted successfully.');
    }
}

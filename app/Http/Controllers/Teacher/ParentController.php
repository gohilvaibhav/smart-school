<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreParentRequest;
use App\Http\Requests\UpdateParentRequest;
use App\Models\ParentModel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = ParentModel::with('student')->latest()->get();
        return view('teacher.parents.index', compact('parents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $students = Student::where('teacher_id', Auth::id())->get();
        return view('teacher.parents.create', compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreParentRequest $request)
    {
        ParentModel::create($request->validated());
        return redirect()->route('teacher.parents.index')->with('success', 'Parent added successfully.');
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
        $parent   = ParentModel::findOrFail($id);
        $students = Student::where('teacher_id', Auth::id())->get();
        return view('teacher.parents.edit', compact('parent', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateParentRequest $request, string $id)
    {
        $parent = ParentModel::findOrFail($id);
        $parent->update($request->validated());
        return redirect()->route('teacher.parents.index')->with('success', 'Parent updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parent = ParentModel::findOrFail($id);
        $parent->delete();
        return redirect()->route('teacher.parents.index')->with('success', 'Parent deleted successfully.');
    }
}

<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::where('role', 'teacher')->get();
        return view('admin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teacher.create');
    }
    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();

        // Upload profile photo if exists
        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('teachers', 'public');
        }

        $data = [
            'name'          => $request->name,
            'email'         => $request->email,
            'mobile'        => $request->mobile,
            'gender'        => $request->gender,
            'birth_date'    => $request->birth_date,
            'qualification' => $request->qualification,
            'experience'    => $request->experience,
            'password'      => $request->password,
            'role'          => 'teacher',
        ];

        User::create($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully.');
    }

    public function edit($id)
    {

        $teacher = user::where('id', $id)->first();
        return view('admin.teacher.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, $id)
    {

        $teacher = User::where('role', 'teacher')->findOrFail($id);


        if ($request->hasFile('profile_photo')) {
            if ($teacher->profile_photo && Storage::disk('public')->exists($teacher->profile_photo)) {
                Storage::disk('public')->delete($teacher->profile_photo);
            }

            $path = $request->file('profile_photo')->store('teachers', 'public');
            $teacher->profile_photo = $path;
        }

        $teacher->name          = $request->name;
        $teacher->mobile        = $request->mobile;
        $teacher->gender        = $request->gender;
        $teacher->birth_date    = $request->birth_date;
        $teacher->qualification = $request->qualification;
        $teacher->experience    = $request->experience;

        $teacher->save();

        return redirect()->route('admin.teachers.index')
            ->with('success', 'Teacher updated successfully.');
    }
    public function destroy($id)
    {

        $deleteTeacher = User::where('id', $id)->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
    }
}

<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();

        // Upload profile photo if exists
        if ($request->hasFile('profile_photo')) {
            $data['profile_photo'] = $request->file('profile_photo')->store('teachers', 'public');
        }

        $data['password'] = Hash::make($data['password']);
        $data['role']     = 'teacher';

        User::create($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher added successfully.');
    }


}

<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return view('admin.dashboard');
            } else {
                 $announcements = Announcement::where('target_role', 'teacher')->latest()->take(10)->get();
                     return view('teacher.dashboard', compact('announcements'));
                
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function adminDashboard(){
         return view('admin.dashboard');
    }

        public function teacherDashboard(){
            $announcements = Announcement::where('target_role', 'teacher')->latest()->take(10)->get();

            return view('teacher.dashboard',compact('announcements'));
    }
}

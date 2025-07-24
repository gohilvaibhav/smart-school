<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\TeacherController;
use App\Http\Controllers\Auth\AnnouncementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\StudentController;
use App\Http\Controllers\Teacher\ParentController;

// Auth routes
Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/teacher/dashboard', [AuthController::class, 'teacherDashboard'])->name('teacher.dashboard');;
    
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    //admin-teacher
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/create', [TeacherController::class, 'create'])->name('teachers.create');
    Route::post('/teachers', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{id}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{id}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{id}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

    //Announcement
    Route::resource('announcements', AnnouncementController::class);

});

// Teacher Role
Route::prefix('teacher')->name('teacher.')->middleware('auth')->group(function () {
    Route::resource('students', StudentController::class);
    Route::resource('parents', ParentController::class);
});


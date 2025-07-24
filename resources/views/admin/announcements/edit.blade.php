@extends('layouts.app')

@section('content')
<h2>Edit Announcement</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Title</label>
        <input name="title" value="{{ old('title', $announcement->title) }}" class="form-control @error('title') is-invalid @enderror">
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Body</label>
        <textarea name="body" rows="4" class="form-control @error('body') is-invalid @enderror">{{ old('body', $announcement->body) }}</textarea>
        @error('body') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Target Role</label>
        <select name="target_role" class="form-control @error('target_role') is-invalid @enderror">
            <option value="">-- Select --</option>
            <option value="teacher" {{ old('target_role', $announcement->target_role) == 'teacher' ? 'selected' : '' }}>Teacher</option>
            <option value="student" {{ old('target_role', $announcement->target_role) == 'student' ? 'selected' : '' }}>Student</option>
            <option value="parent"  {{ old('target_role', $announcement->target_role) == 'parent'  ? 'selected' : '' }}>Parent</option>
        </select>
        @error('target_role') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection

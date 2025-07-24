@extends('layouts.app')

@section('content')
<h2>Add Student</h2>
<form action="{{ route('teacher.students.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Class</label>
        <input name="class" value="{{ old('class') }}" class="form-control @error('class') is-invalid @enderror">
        @error('class') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary">Create</button>
</form>
@endsection

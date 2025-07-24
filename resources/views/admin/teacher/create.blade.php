@extends('layouts.app')

@section('content')
<h2>Add Teacher</h2>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="POST" action="{{ route('admin.teachers.store') }}">
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
        <label>Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>    
    <div class="mb-3">
        <label>Mobile</label>
        <input name="mobile" value="{{ old('mobile') }}" class="form-control @error('mobile') is-invalid @enderror">
        @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Gender</label>
        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
            <option value="">-- Select Gender --</option>
            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
        </select>
        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Birth Date</label>
        <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control @error('birth_date') is-invalid @enderror">
        @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Qualification</label>
        <input name="qualification" value="{{ old('qualification') }}" class="form-control @error('qualification') is-invalid @enderror">
        @error('qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Experience (years)</label>
        <input name="experience" value="{{ old('experience') }}" class="form-control @error('experience') is-invalid @enderror">
        @error('experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
      <div class="mb-3">
        <label>Profile Photo</label>
        <input type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror">
        @error('profile_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary">Create</button>
</form>
@endsection

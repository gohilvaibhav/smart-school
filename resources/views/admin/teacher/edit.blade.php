@extends('layouts.app')

@section('content')
<h2>Edit Teacher</h2>

{{-- Success Message --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Error Messages --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.teachers.update', $teacher->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Name</label>
        <input name="name" value="{{ old('name', $teacher->name) }}" class="form-control @error('name') is-invalid @enderror">
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input name="email" value="{{ old('email', $teacher->email) }}" class="form-control @error('email') is-invalid @enderror" readonly>
        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Mobile</label>
        <input name="mobile" value="{{ old('mobile', $teacher->mobile) }}" class="form-control @error('mobile') is-invalid @enderror">
        @error('mobile') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Gender</label>
        <select name="gender" class="form-control @error('gender') is-invalid @enderror">
            <option value="">-- Select Gender --</option>
            <option value="male" {{ old('gender', $teacher->gender) == 'male' ? 'selected' : '' }}>Male</option>
            <option value="female" {{ old('gender', $teacher->gender) == 'female' ? 'selected' : '' }}>Female</option>
            <option value="other" {{ old('gender', $teacher->gender) == 'other' ? 'selected' : '' }}>Other</option>
        </select>
        @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Birth Date</label>
        <input type="date" name="birth_date" value="{{ old('birth_date', $teacher->birth_date) }}" class="form-control @error('birth_date') is-invalid @enderror">
        @error('birth_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Qualification</label>
        <input name="qualification" value="{{ old('qualification', $teacher->qualification) }}" class="form-control @error('qualification') is-invalid @enderror">
        @error('qualification') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Experience (years)</label>
        <input name="experience" value="{{ old('experience', $teacher->experience) }}" class="form-control @error('experience') is-invalid @enderror">
        @error('experience') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label>Profile Photo</label>
        <input type="file" name="profile_photo" class="form-control @error('profile_photo') is-invalid @enderror">
        @error('profile_photo') <div class="invalid-feedback">{{ $message }}</div> @enderror

        @if($teacher->profile_photo)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $teacher->profile_photo) }}" width="80" height="80" class="rounded-circle border">
                <p class="text-muted">Current photo</p>
            </div>
        @endif
    </div>

    <button class="btn btn-primary">Update</button>
</form>
@endsection

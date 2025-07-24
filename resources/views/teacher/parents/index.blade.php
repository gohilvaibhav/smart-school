@extends('layouts.app')

@section('content')
<h2>Parents</h2>
<a href="{{ route('teacher.parents.create') }}" class="btn btn-primary mb-3">Add Parent</a>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Student</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($parents as $parent)
        <tr>
            <td>{{ $parent->name }}</td>
            <td>{{ $parent->email }}</td>
            <td>{{ $parent->mobile }}</td>
            <td>{{ $parent->student->name ?? '-' }}</td>
            <td>
                <a href="{{ route('teacher.parents.edit', $parent->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('teacher.parents.destroy', $parent->id) }}" method="POST" style="display:inline-block" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn').forEach((btn) => {
        btn.addEventListener('click', function () {
            Swal.fire({
                title: 'Delete parent?',
                text: "This cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.closest('form').submit();
                }
            });
        });
    });
</script>
@endpush

@extends('layouts.app')

@section('content')
    <h2>Manage Teachers</h2>

    <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary mb-3">Add Teacher</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Birth Date</th>
                <th>Qualification</th>
                <th>Experience</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->mobile }}</td>
                    <td>{{ ucfirst($teacher->gender) }}</td>
                    <td>{{ \Carbon\Carbon::parse($teacher->birth_date)->format('d-m-Y') }}</td>
                    <td>{{ $teacher->qualification }}</td>
                    <td>{{ $teacher->experience }} years</td>
                    <td>
                        <a href="{{ route('admin.teachers.edit', $teacher->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        {{-- <form action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST" style="display:inline-block">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this teacher?')">Delete</button>
                </form> --}}
                        <form id="delete-form-{{ $teacher->id }}"
                            action="{{ route('admin.teachers.destroy', $teacher->id) }}" method="POST"
                            style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger delete-button"
                                data-id="{{ $teacher->id }}">Delete</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No teachers found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const teacherId = this.getAttribute('data-id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This will permanently delete the teacher.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + teacherId).submit();
                }
            });
        });
    });
});
</script>
@endpush

@extends('layouts.app')

@section('content')
<h2>Announcements</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<a href="{{ route('admin.announcements.create') }}" class="btn btn-primary mb-3">Create New</a>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Title</th>
            <th>Target Role</th>
            <th>Posted At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($announcements as $announcement)
        <tr>
            <td>{{ $announcement->title }}</td>
            <td>{{ ucfirst($announcement->target_role) }}</td>
            <td>{{ $announcement->created_at->format('d M, Y') }}</td>
            <td>
                <a href="{{ route('admin.announcements.edit', $announcement->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.announcements.destroy', $announcement->id) }}" method="POST" style="display:inline-block;" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-danger btn-sm delete-btn">Delete</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center">No announcements found.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn').forEach((btn) => {
        btn.addEventListener('click', function () {
            Swal.fire({
                title: 'Delete announcement?',
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

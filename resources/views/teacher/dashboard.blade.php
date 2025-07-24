{{-- @extends('layouts.app')

@section('content')
    <h2>Teacher Dashboard</h2>
    <p>Welcome, Teacher!</p>
@endsection --}}

{{-- @extends('layouts.app')

@section('content')


@if($announcements->isEmpty())
    <p>No announcements at the moment.</p>
@else
    <h4 class="mt-4">Latest Announcements</h4>
    <div class="list-group">
        @foreach($announcements as $announcement)
            <div class="list-group-item">
                <h5>{{ $announcement->title }}</h5>
                <p>{{ $announcement->body }}</p>
                <small class="text-muted">Posted on {{ $announcement->created_at->format('d M, Y') }}</small>
            </div>
        @endforeach
    </div>
@endif
@endsection --}}

@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Teacher Dashboard</h2>

    @if($announcements->isEmpty())
        <div class="alert alert-info">
            No announcements at the moment.
        </div>
    @else
        <h4 class="mb-3">Latest Announcements</h4>

        <div class="list-group">
            @foreach($announcements as $announcement)
                <div class="list-group-item mb-3 shadow-sm p-3 rounded">
                    <h5 class="mb-2">{{ $announcement->title }}</h5>
                    <p class="mb-1">{{ $announcement->body }}</p>
                    <small class="text-muted">Posted on {{ $announcement->created_at->format('d M, Y') }}</small>
                </div>
            @endforeach
        </div>
    @endif
@endsection

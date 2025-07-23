<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'EduConnect') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8f9fa; }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
            padding: 12px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>

@auth
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h4 class="text-white text-center py-3">EduConnect</h4>

            @if(auth()->user()?->role === 'admin')
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="#">Manage Teachers</a>
                <a href="#">Post Announcements</a>
            @elseif(auth()->user()?->role === 'teacher')
                <a href="{{ route('teacher.dashboard') }}">Dashboard</a>
                <a href="#">Manage Students</a>
                <a href="#">Manage Parents</a>
                <a href="#">Post Announcements</a>
            @endif

            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

        <!-- Content -->
        <div class="col-md-10 p-4">
            @yield('content')
        </div>
    </div>
</div>
@endauth

@guest
    <div class="container mt-5">
        @yield('content')
    </div>
@endguest

</body>
</html>

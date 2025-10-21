<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logbook Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #e0e0e0;
        }
        .navbar {
            background-color: #1e1e1e;
        }
        .nav-link.active {
            background-color: #0d6efd !important;
            border-radius: 8px;
            color: #fff !important;
        }
        .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 12px;
        }
        table {
            color: #ddd;
        }
        th {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark px-3">
    <a class="navbar-brand fw-bold" href="#">📘 Logbook</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('logbook.resume') ? 'active' : '' }}" href="{{ route('logbook.resume') }}">Resume</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('logbook.list') ? 'active' : '' }}" href="{{ route('logbook.list') }}">List</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('logbook.jobs') ? 'active' : '' }}" href="{{ route('logbook.jobs') }}">Jobs</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('logbook.logbook') ? 'active' : '' }}" href="{{ route('logbook.logbook') }}">Logbook</a></li>
        </ul>
    </div>
</nav>

<div class="container my-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

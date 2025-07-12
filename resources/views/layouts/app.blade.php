<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name', 'CaPaw!') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome (untuk ikon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS for Admin Panel -->
    <style>
    :root {
        --primary-green: #37473f;   /* hijau tua tombol login */
        --secondary-green: #4b5f55; /* hover tombol login */
        --accent-beige: #f5f5f5;    /* latar belakang */
    }

    body {
        background-color: var(--accent-beige);
        font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 250px;
        padding: 20px;
        background-color: var(--primary-green);
        color: #fff;
        display: flex;
        flex-direction: column;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    }

    .sidebar-header a {
        color: #fff;
        font-size: 1.5rem;
        font-weight: bold;
        text-decoration: none;
    }

    .sidebar .nav-link {
        color: #f0f0f0;
        padding: 10px 15px;
        border-radius: 10px;
        margin-bottom: 8px;
        transition: background-color 0.2s ease;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
    }

    .sidebar .nav-link:hover {
        background-color: var(--secondary-green);
    }

    .sidebar .nav-link.active {
        background-color: #2f3933;
    }

    .sidebar .logout-link {
        margin-top: auto;
        color: #f0f0f0;
        border-top: 1px solid rgba(255,255,255,0.2);
        padding-top: 15px;
    }

    .sidebar .logout-link:hover {
        color: #ffffff;
    }

    .main-content {
        margin-left: 250px;
        padding: 25px;
    }

    .navbar-admin {
        background-color: #fff;
        border-bottom: 1px solid #dee2e6;
    }

    .navbar-text strong {
        color: var(--primary-green);
    }

    .alert {
        border-radius: 8px;
    }
</style>

</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}">CaPaw! 🐾</a>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fa-fw fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <i class="fa-fw fas fa-tags"></i> Kategori
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.animals.*') ? 'active' : '' }}" href="{{ route('admin.animals.index') }}">
                    <i class="fa-fw fas fa-paw"></i> Hewan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                    <i class="fa-fw fas fa-file-alt"></i> Laporan
                </a>
            </li>
        </ul>
        <div class="logout-link mt-4">
            <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-fw fas fa-sign-out-alt"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
    </div>

    <div class="main-content">
        <nav class="navbar navbar-expand-lg navbar-light navbar-admin mb-4">
            <div class="container-fluid">
                <span class="navbar-brand">@yield('title')</span>
                <div class="ms-auto">
                    <span class="navbar-text">
                        Selamat datang, <strong>{{ Auth::user()->name }}</strong>
                    </span>
                </div>
            </div>
        </nav>

        <main>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

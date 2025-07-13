<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CaPaw!') - Sistem Pengaduan Hewan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
    :root {
        --primary-green: #37473f;
        --secondary-green: #4b5f55;
        --soft-beige: #f5f5f5;
    }

    html, body {
        height: 100%;
    }

    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    main {
        flex: 1;
    }

    .navbar-custom {
        background-color: var(--primary-green) !important;
    }

    .navbar-custom .navbar-brand,
    .navbar-custom .nav-link,
    .navbar-custom .dropdown-toggle {
        color: #ffffff !important;
    }

    .navbar-custom .nav-link.active {
        font-weight: bold;
        text-decoration: underline;
    }

    .footer {
        background-color: var(--primary-green);
        color: white;
        padding: 20px 0;
        text-align: center;
    }
</style>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-custom shadow-sm">
    <div class="container">
        {{-- Brand --}}
        @auth
        <a class="navbar-brand fw-bold" href="{{ route('user.dashboard') }}">CaPaw!</a>
        @else
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">CaPaw!</a>
        @endguest

        {{-- Toggle --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Links --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('lapor') ? 'active' : '' }}" href="{{ route('lapor') }}">Buat Laporan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('laporan.saya') ? 'active' : '' }}" href="{{ route('laporan.saya') }}">Laporan Saya</a>
                </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


    <main>
        @if (session('success'))
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        @if (session('error'))
        <div class="container mt-4">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @yield('content')
    </main>

    <!-- <footer>
        © 2025 CaPaw! - Sistem Pengaduan Hewan. Semua Hak Cipta Dilindungi.
    </footer> -->

    <footer class="footer mt-auto">
        <div class="container">
            <span>&copy; {{ date('Y') }} CaPaw! - Sistem Pengaduan Hewan. Semua Hak Cipta Dilindungi.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
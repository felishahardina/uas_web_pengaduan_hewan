<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaPaw! - Lacak & Laporkan Hewan Hilang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --dark-green: #3c4a46;
            --light-beige: #fff8f2;
            --accent: #ffc5ab;
            --radius: 1rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-beige);
            color: #333;
        }

        .navbar {
            background-color: var(--dark-green);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .btn-dark-green {
            background-color: var(--dark-green);
            color: white;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-dark-green:hover {
            background-color: #2f3a37;
            transform: scale(1.05);
        }

        .hero-section {
            min-height: 90vh;
            background: linear-gradient(to right, #fffaf5, #fff1e6);
            border-bottom: 2px dashed #ccc;
            padding-top: 4rem;
            padding-bottom: 4rem;
        }

        .card-report {
            background-color: white;
            border-radius: var(--radius);
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
            transition: 0.3s ease;
        }

        .card-report:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 25px rgba(0,0,0,0.08);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: var(--radius);
            border-top-right-radius: var(--radius);
        }

        .badge-status {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: var(--accent);
            color: #333;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 0.75rem;
        }

        footer {
            background-color: var(--dark-green);
            color: #fff;
            padding: 1.2rem 0;
            font-size: 0.85rem;
            text-align: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}"><i class="fas fa-paw me-2"></i>CaPaw!</a>
        <div class="ms-auto">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-light">Register</a>
            @else
                @if(Auth::user()->role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">Admin Panel</a>
                @else
                    <a href="{{ route('user.dashboard') }}" class="btn btn-light">My Dashboard</a>
                @endif
            @endguest
        </div>
    </div>
</nav>

<header class="hero-section d-flex align-items-center">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start animate__animated animate__fadeInLeft">
                <h1 class="fw-bold mb-3">🐾 Bantu Temukan Mereka</h1>
                <p class="lead text-muted mb-4">Laporkan hewan hilang atau temukan sahabat berkaki empat di sekitar Anda.</p>
                @auth
                    <a href="{{ route('lapor') }}" class="btn btn-dark-green px-4 py-2">
                        <i class="fas fa-bullhorn me-2"></i> Lapor Sekarang
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-dark-green px-4 py-2">
                        <i class="fas fa-sign-in-alt me-2"></i> Login untuk Lapor
                    </a>
                @endauth
            </div>
            <div class="col-lg-6 text-center animate__animated animate__zoomIn">
                <img src="{{ asset('image/cat.png') }}" alt="Cute Cat" class="img-fluid" style="max-height: 300px;">
            </div>
        </div>
    </div>
</header>

<main class="container my-5">
    <h2 class="text-center fw-bold mb-4">Laporan Hewan Terbaru</h2>
    <div class="row">
        @forelse ($reports as $report)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-report h-100 position-relative">
                    <span class="badge-status">{{ $report->status }}</span>
                    <img src="{{ asset('storage/' . $report->image_path) }}" class="card-img-top" alt="Foto {{ $report->animal->name }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $report->animal->name }}</h5>
                        <p class="card-text text-muted"><i class="fas fa-map-marker-alt me-2"></i>{{ Str::limit($report->address, 50) }}</p>
                        <a href="{{ route('laporan.detail', $report->id) }}" class="btn btn-outline-dark w-100 mt-auto">Lihat Detail</a>
                    </div>
                    <div class="card-footer text-muted text-center">
                        <small>Dilaporkan {{ $report->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-secondary text-center">
                    <h5>Belum ada laporan yang tersedia.</h5>
                    <p>Jadilah yang pertama melaporkan!</p>
                </div>
            </div>
        @endforelse
    </div>

    @if($reports->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $reports->links() }}
        </div>
    @endif
</main>

<footer>
    <div class="container">
        <p class="mb-0">&copy; {{ date('Y') }} CaPaw! - Sistem Pelaporan Hewan Hilang. Dibuat dengan cinta 🐾</p>
    </div>
</footer>
</body>
</html>

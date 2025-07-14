<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CaPaw! - Lacak & Laporkan Hewan Hilang </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
    :root {
        --primary-green: #37473f;
        --secondary-green: #4b5f55;
        --soft-beige: #f5f5f5;
        --accent: #FFD1BA;
        --radius: 1rem;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--soft-beige);
        color: #333;
    }

    /* Navbar */
    .navbar {
        background-color: var(--primary-green);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Hero Section */
    .hero-section {
        min-height: 90vh;
        background: linear-gradient(to right, var(--soft-beige), #ffffff); 
        padding-top: 4rem;
        padding-bottom: 4rem;
        position: relative;
        overflow: hidden;
        border-bottom: 2px dashed #ccc;
    }

    .hero-card {
        background-color: #ffffff;
        border-radius: var(--radius);
        box-shadow: 0 8px 24px rgba(55, 71, 63, 0.08); 
        padding: 2rem;
        transition: all 0.3s ease;
    }

    .hero-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(55, 71, 63, 0.15);
    }

    /* Tombol */
    .btn-dark-green {
        background-color: var(--primary-green);
        color: white;
        border-radius: 0.5rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-dark-green:hover {
        background-color: var(--secondary-green);
        transform: scale(1.05);
    }

    .btn-outline-dark {
        border-color: var(--primary-green);
        color: var(--primary-green);
        font-weight: 600;
        transition: 0.3s ease;
    }

    .btn-outline-dark:hover {
        background-color: var(--primary-green);
        color: white;
    }

    /* Card Laporan */
    .card-report {
        background-color: #ffffff;
        border-radius: 1.25rem;
        box-shadow: 0 8px 24px rgba(55, 71, 63, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #eee;
    }

    .card-report:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 28px rgba(55, 71, 63, 0.15);
    }

    .card-img-top {
        height: 220px;
        object-fit: cover;
        border-top-left-radius: 1.25rem;
        border-top-right-radius: 1.25rem;
    }

    .card-title {
        font-weight: 700;
        font-size: 1.1rem;
        color: #333;
        margin-bottom: 0.25rem;
    }

    .card-text {
        font-size: 0.9rem;
        color: #555;
    }

    .badge-status {
        position: absolute;
        top: 14px;
        left: 14px;
        background: var(--accent);
        color: #4a342e;
        font-weight: 500;
        font-size: 0.75rem;
        padding: 5px 12px;
        border-radius: 999px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    }

    /* Paw print background (hiasan) */
    .paw-print-bg {
        position: absolute;
        width: 100px;
        height: auto;
        opacity: 0.04;
        z-index: 0;
    }

    .paw-print-left {
        top: 10%;
        left: 3%;
    }

    .paw-print-right {
        bottom: 10%;
        right: 3%;
    }

    /* Footer */
    footer {
        background-color: var(--primary-green);
        color: #fff;
        padding: 1.2rem 0;
        font-size: 0.85rem;
        text-align: center;
    }

    .card-footer {
        background-color: transparent;
        font-size: 0.75rem;
        color: #888;
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
                <a href="{{ route('register') }}" class="btn btn-outline-light me-2">Register</a>
                @else
                @if(Auth::user()->role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Admin Panel</a>
                @else
                <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">My Dashboard</a>
                @endif
                @endguest
            </div>
        </div>
    </nav>

     <!-- SECTION 1: Laporan Hewan Terbaru (dipindah ke atas) -->
    <main class="container my-5">
        <h2 class="text-center fw-bold mb-4">Laporan Hewan Terbaru</h2>
        <div class="row">
            @forelse ($reports as $report)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card card-report h-100 position-relative">
                    <span class="badge-status">
                        <i class="fas fa-check-circle me-1"></i> {{ $report->status }}
                    </span>
                    <img src="{{ asset('storage/' . $report->image_path) }}" class="card-img-top" alt="Foto {{ optional($report->animal)->name ?? 'Hewan' }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ optional($report->animal)->name ?? '-' }}</h5>
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

    <!-- SECTION 2: Hero Section dipindah ke bawah -->
    <header class="bg-transparent py-5">
        <div class="container">
            <div class="card shadow-lg border-0 p-4 position-relative hero-card"
                style="border-radius: 1.5rem; background: linear-gradient(to right, #f5f5f5, #ffffff);">
                <img src="{{ asset('image/paw-print.png') }}" class="paw-print-bg paw-print-left" alt="paw decoration">
                <img src="{{ asset('image/paw-print.png') }}" class="paw-print-bg paw-print-right" alt="paw decoration">
                <div class="row align-items-center g-4">
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
        </div>
    </header>

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
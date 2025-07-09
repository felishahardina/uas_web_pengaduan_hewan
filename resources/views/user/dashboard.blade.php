@extends('layouts.app-user')

@section('title', 'Dashboard')

@section('content')
<style>
    :root {
        --primary-dark: #394a45;
        --accent-brown: #a1887f;
        --light-beige: #fff8f3;
        --pure-white: #ffffff;
    }

    body {
        background-color: var(--light-beige);
        font-family: 'Poppins', sans-serif;
    }

    .btn-green {
        background-color: var(--primary-dark);
        border-color: var(--primary-dark);
        color: #fff;
        font-weight: 600;
        border-radius: 0.5rem;
    }

    .btn-green:hover {
        background-color: #2d3936;
        border-color: #2d3936;
        transform: scale(1.02);
    }

    .text-darkgreen {
        color: var(--primary-dark);
    }

    .bg-beige {
        background-color: var(--light-beige);
    }

    .stat-card {
        border: none;
        border-left: 5px solid var(--primary-dark);
        border-radius: 0.75rem;
        background-color: var(--pure-white);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-5px);
    }

    .stat-icon {
        font-size: 2.4rem;
        color: var(--accent-brown);
        opacity: 0.8;
    }

    .hero-banner {
        background-color: #ebe6df;
        border-radius: 1rem;
        padding: 2rem;
        text-align: center;
    }

    .hero-banner h1 {
        font-weight: 700;
        color: var(--primary-dark);
    }

    .hero-banner p {
        color: #5c5c5c;
        font-size: 1.05rem;
    }

    .card-summary h2 {
        font-weight: bold;
    }

    .section-box {
        background-color: var(--accent-brown);
        border-radius: 1rem;
        padding: 2rem;
        color: white;
    }

    .section-box a.btn-light {
        font-weight: 600;
    }
</style>

<div class="container my-5">
    <div class="hero-banner shadow-sm mb-5">
        <h1>Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p>Setiap laporan Anda adalah harapan baru bagi mereka.</p>
        <a href="{{ route('lapor') }}" class="btn btn-green mt-3">
            <i class="fas fa-plus me-2"></i> Laporkan Hewan Sekarang
        </a>
    </div>

    <h4 class="mb-4 text-darkgreen fw-semibold">📊 Ringkasan Aktivitas Anda</h4>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Total Laporan</p>
                        <h2 class="text-darkgreen mb-0">{{ $totalLaporan }}</h2>
                    </div>
                    <i class="fas fa-file-alt stat-icon"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm h-100" style="border-left-color: #4caf50;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Disetujui</p>
                        <h2 class="mb-0" style="color: #4caf50;">{{ $laporanApproved }}</h2>
                    </div>
                    <i class="fas fa-check-circle stat-icon" style="color: #4caf50;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card stat-card shadow-sm h-100" style="border-left-color: #ffc107;">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <p class="text-muted mb-1">Menunggu Persetujuan</p>
                        <h2 class="mb-0" style="color: #ffc107;">{{ $laporanPending }}</h2>
                    </div>
                    <i class="fas fa-clock stat-icon" style="color: #ffc107;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="section-box mt-5 shadow-sm" style="background-color: #394a45;">
    <h3 class="text-white">Lihat Riwayat Laporan Anda</h3>
    <p class="mb-3 text-light">Pantau semua laporan yang pernah Anda buat, dan cek statusnya dengan cepat dan mudah.</p>
    <a href="{{ route('laporan.saya') }}" class="btn btn-light fw-semibold">
        Buka Riwayat Laporan <i class="fas fa-arrow-right ms-1"></i>
    </a>
</div>

</div>
@endsection

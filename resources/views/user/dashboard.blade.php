@extends('layouts.app-user')

@section('title', 'Dashboard')

@section('content')

<style>
    :root {
        --primary-green: #37473f;
        --secondary-green: #4b5f55;
        --soft-beige: #f5f5f5;
        --pure-white: #ffffff;
    }

    body {
        background-color: var(--soft-beige);
        font-family: 'Poppins', sans-serif;
    }

    .btn-green {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
        color: #fff;
        font-weight: 600;
        border-radius: 0.5rem;
    }

    .btn-green:hover {
        background-color: var(--secondary-green);
        border-color: var(--secondary-green);
        transform: scale(1.02);
    }

    .text-darkgreen {
        color: var(--primary-green);
    }

    .bg-beige {
        background-color: var(--soft-beige);
    }

    .stat-card {
        border: none;
        border-left: 5px solid var(--primary-green);
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
        color: var(--secondary-green);
        opacity: 0.9;
    }

    .hero-banner {
        background-color: var(--secondary-green);
        border-radius: 1rem;
        padding: 2rem;
        color: var(--soft-beige);
        text-align: center;
    }

    .hero-banner h1 {
        font-weight: 700;
        color: var(--pure-white);
    }

    .hero-banner p {
        color: #e2e2e2;
        font-size: 1.05rem;
    }

    .section-box {
        background-color: var(--primary-green);
        border-radius: 1rem;
        padding: 2rem;
        color: var(--soft-beige);
    }

    .section-box a.btn-light {
        font-weight: 600;
    }

    .card-laporan {
        border-radius: 1rem;
        transition: all 0.3s ease;
        background-color: var(--pure-white);
    }

    .card-laporan:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .card-laporan img {
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        height: 220px;
        object-fit: cover;
    }

    .badge-approved {
        background-color: #28a745;
        color: #fff;
        font-size: 0.8rem;
        border-radius: 0.5rem;
        padding: 0.2em 0.6em;
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

    <h4 class="mt-5 mb-4 text-darkgreen fw-semibold">🐾 Laporan Hewan Terbaru yang Disetujui</h4>
    <div class="row">
        @forelse ($latestApprovedReports as $report)
        <div class="col-md-4 mb-4">
            <div class="card card-laporan shadow-sm h-100">
                @if($report->animal && $report->animal->image)
                <img src="{{ asset('storage/' . $report->animal->image) }}" alt="{{ $report->animal->name }}">
                @else
                <img src="{{ asset('default-image.jpg') }}" alt="Hewan">
                @endif
                <div class="card-body">
                    <span class="badge-approved mb-2">Approved</span>
                    <h5 class="card-title mb-1">{{ $report->animal->name ?? '-' }}</h5>
                    <p class="card-text text-muted small mb-2">
                        <i class="fas fa-map-marker-alt me-1"></i> {{ $report->lokasi ?? 'Lokasi tidak tersedia' }}
                    </p>
                    <a href="{{ route('laporan.show', $report->id) }}" class="btn btn-outline-dark btn-sm">
                        Lihat Detail
                    </a>
                    <p class="text-muted small mt-2 mb-0">
                        Dilaporkan {{ $report->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <p class="text-muted">Belum ada laporan yang disetujui admin.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection

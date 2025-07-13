@extends('layouts.app-user')

@section('title', 'Dashboard')

@section('content')
{{-- Kode CSS dari file Anda sebelumnya --}}
<style>
    :root {
        --primary-green: #37473f;
        --secondary-green: #4b5f55;
        --soft-beige: #f5f5f5;
        --pure-white: #ffffff;
    }
    body { background-color: var(--soft-beige); font-family: 'Poppins', sans-serif; }
    .btn-green { background-color: var(--primary-green); border-color: var(--primary-green); color: #fff; font-weight: 600; border-radius: 0.5rem; }
    .btn-green:hover { background-color: var(--secondary-green); border-color: var(--secondary-green); transform: scale(1.02); }
    .text-darkgreen { color: var(--primary-green); }
    .hero-banner { background-color: var(--secondary-green); border-radius: 1rem; padding: 3rem 2rem; color: var(--soft-beige); text-align: center; }
    .hero-banner h1 { font-weight: 700; color: var(--pure-white); }
    .hero-banner p { color: #e2e2e2; font-size: 1.1rem; }
    .section-box { background-color: var(--primary-green); border-radius: 1rem; padding: 2.5rem; color: var(--soft-beige); }
    .section-box a.btn-light { font-weight: 600; }
    /* Style untuk kartu laporan */
    .card-report { border: none; transition: all 0.3s ease; border-radius: 0.5rem; }
    .card-report:hover { transform: translateY(-5px); box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.1)!important; }
    .card-img-top { height: 220px; object-fit: cover; border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem; }
</style>

<div class="container my-5">
    {{-- Bagian Sambutan --}}
    <div class="hero-banner shadow-sm mb-5">
        <h1>Selamat Datang Kembali, {{ Auth::user()->name }}!</h1>
        <p>Setiap laporan Anda adalah harapan baru bagi mereka yang kehilangan.</p>
        <a href="{{ route('lapor') }}" class="btn btn-green mt-3 py-2 px-4">
            <i class="fas fa-plus me-2"></i> Laporkan Hewan Sekarang
        </a>
    </div>

    <!-- PERBAIKAN: Bagian Laporan Terbaru Ditambahkan di Sini -->
    <div class="mb-5">
        <h4 class="mb-4 text-darkgreen fw-semibold">🐾 Laporan Terbaru di Komunitas</h4>
        <div class="row">
            @forelse ($latestApprovedReports as $report)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card card-report shadow-sm h-100">
                        <img src="{{ asset('storage/' . $report->image_path) }}" class="card-img-top" alt="Foto {{ $report->animal->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $report->animal->name }}</h5>
                            <p class="card-text text-muted small"><i class="fas fa-map-marker-alt me-2"></i>Terlihat di: {{ Str::limit($report->address, 30) }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('laporan.detail', $report->id) }}" class="btn btn-outline-dark w-100">Lihat Detail</a>
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <small>Dilaporkan {{ $report->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-secondary text-center">
                        <p class="mb-0">Saat ini belum ada laporan baru yang disetujui oleh admin.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Bagian Ajakan untuk Melihat Riwayat --}}
    <div class="section-box mt-4 shadow-sm">
        <h3 class="text-white">Lihat Riwayat Laporan Anda</h3>
        <p class="mb-3 text-light">Pantau semua laporan yang pernah Anda buat, cek statusnya, dan lihat ringkasan aktivitas Anda di sini.</p>
        <a href="{{ route('laporan.saya') }}" class="btn btn-light fw-semibold">
            Buka Riwayat Laporan <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>
</div>
@endsection
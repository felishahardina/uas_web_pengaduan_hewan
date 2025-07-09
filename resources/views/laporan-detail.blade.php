@extends('layouts.app-user')

@section('title', 'Detail Laporan: ' . $report->animal->name)

@section('content')
<style>
    /* Custom Green Theme */
    :root {
        --primary-green: #394a45;       /* Hijau gelap */
        --secondary-green: #617c72;     /* Hijau muda */
    }

    .card-header-green {
        background-color: var(--primary-green);
        color: white;
    }

    .detail-card-body {
        padding: 2rem;
    }

    .detail-image {
        width: 100%;
        height: 450px;
        object-fit: contain;
        background-color: #f8f9fa;
        border-radius: .5rem;
        border: 1px solid #dee2e6;
        padding: 0.5rem;
    }

    .detail-heading {
        color: var(--primary-green);
        font-weight: bold;
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }

    .detail-text {
        margin-bottom: 1.5rem;
    }

    .contact-card {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-left: 4px solid var(--secondary-green);
    }

    .contact-card .list-group-item {
        background-color: transparent;
        border: none;
        padding: 0.5rem 0;
    }
</style>


<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header card-header-brown">
            <h2 class="mb-0">{{ $report->animal->name }} <span class="badge bg-light text-dark fs-6 ms-2 fw-normal">{{ $report->animal->category->name }}</span></h2>
        </div>
        <div class="card-body detail-card-body">
            <div class="row">
                {{-- Kolom Kiri untuk Gambar --}}
                <div class="col-lg-6 mb-4 mb-lg-0">
                    {{-- PERBAIKAN: Menerapkan style langsung ke gambar --}}
                    @if($report->image_path)
                        <img src="{{ asset('storage/' . $report->image_path) }}" class="detail-image" alt="Foto {{ $report->animal->name }}">
                    @endif
                </div>

                {{-- Kolom Kanan untuk Semua Informasi --}}
                <div class="col-lg-6">

                    <div>
                        <h6 class="detail-heading"><i class="fas fa-info-circle me-2"></i>Deskripsi Laporan</h6>
                        <p class="detail-text">{{ $report->description }}</p>
                    </div>

                    <div>
                        <h6 class="detail-heading"><i class="fas fa-map-marker-alt me-2"></i>Lokasi Terakhir Terlihat</h6>
                        <p class="detail-text">{{ $report->address }}</p>
                    </div>

                    <div class="card contact-card">
                        <div class="card-body">
                            <h6 class="detail-heading"><i class="fas fa-address-book me-2"></i>Informasi Kontak</h6>
                            <p class="text-muted small mb-2">Hubungi kontak di bawah ini jika Anda memiliki informasi.</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span>Pelapor</span>
                                    <strong>{{ $report->user->name }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span>Telepon</span>
                                    <strong>{{ $report->contact_phone }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between px-0">
                                    <span>Email</span>
                                    <strong>{{ $report->user->email }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                         <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                             <i class="fas fa-arrow-left me-2"></i>Kembali ke Halaman Utama
                         </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-muted text-center">
            Dilaporkan pada {{ $report->created_at->format('d F Y') }}
        </div>
    </div>
</div>
@endsection

@extends('layouts.app-user')

@section('title', 'Laporan Saya')

@section('content')
<style>
    :root {
        --primary-green: #37473f;
        --secondary-green: #4b5f55;
        --accent: #FFD1BA;
    }

    .btn-green {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
        color: #fff;
    }

    .btn-green:hover {
        background-color: var(--secondary-green);
        border-color: var(--secondary-green);
        color: #fff;
    }

    .card-title-link {
        color: var(--primary-green);
        text-decoration: none;
        font-weight: bold;
    }

    .card-title-link:hover {
        color: var(--secondary-green);
        text-decoration: underline;
    }

    .modal-header-green {
        background-color: var(--primary-green);
        color: white;
    }

    .badge.bg-warning {
        background-color: #ffe082 !important;
        color: #5d4037;
    }

    .badge.bg-success {
        background-color: #81c784 !important;
    }

    .badge.bg-danger {
        background-color: #e57373 !important;
    }

    .btn-outline-secondary {
        border-color: var(--primary-green);
        color: var(--primary-green);
    }

    .btn-outline-secondary:hover {
        background-color: var(--primary-green);
        color: #fff;
    }
</style>

<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Riwayat Laporan Saya</h1>
        <a href="{{ route('lapor') }}" class="btn btn-green">
            <i class="fas fa-plus me-2"></i>Buat Laporan Baru
        </a>
    </div>

    <div class="row">
        @forelse ($reports as $report)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body d-flex flex-column">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/' . $report->image_path) }}"
                            class="rounded-circle me-3"
                            style="width: 60px; height: 60px; object-fit: cover;"
                            alt="Foto {{ $report->animal->name ?? '' }}">
                        <div>
                            <h5 class="card-title mb-0">
                                <a href="#" class="card-title-link" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $report->id }}">
                                    {{ $report->animal->name ?? 'Data Hewan Dihapus' }}
                                </a>
                            </h5>
                            <small class="text-muted">Dilaporkan {{ $report->created_at->diffForHumans() }}</small>
                        </div>
                    </div>

                    <p class="card-text flex-grow-1">{{ Str::limit($report->description, 100) }}</p>

                    <div class="mt-auto pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center">
                            @php
                            $statusInfo = [
                            'pending' => ['class' => 'bg-warning text-dark', 'icon' => 'fa-clock'],
                            'approved' => ['class' => 'bg-success', 'icon' => 'fa-check-circle'],
                            'rejected' => ['class' => 'bg-danger', 'icon' => 'fa-times-circle'],
                            ][$report->status] ?? ['class' => 'bg-secondary', 'icon' => 'fa-question-circle'];
                            @endphp
                            <span class="badge {{ $statusInfo['class'] }} p-2">
                                <i class="fas {{ $statusInfo['icon'] }} me-1"></i>
                                {{ ucfirst($report->status) }}
                            </span>

                            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal-{{ $report->id }}">
                                Lihat Detail
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <h4 class="mb-4 text-darkgreen fw-semibold">📊 Ringkasan Aktivitas Anda</h4>
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
        </div> -->

        <!-- Modal Detail Laporan -->
        <div class="modal fade" id="detailModal-{{ $report->id }}" tabindex="-1" aria-labelledby="detailModalLabel-{{ $report->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header modal-header-green">
                        <h5 class="modal-title" id="detailModalLabel-{{ $report->id }}">Detail Laporan: {{ $report->animal->name ?? '' }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <img src="{{ asset('storage/' . $report->image_path) }}" class="img-fluid rounded" alt="Foto Laporan">
                            </div>
                            <div class="col-md-6">
                                <h6>Deskripsi</h6>
                                <p>{{ $report->description }}</p>
                                <hr>
                                <h6><i class="fas fa-map-marker-alt me-2"></i>Alamat Terakhir Terlihat</h6>
                                <p>{{ $report->address }}</p>
                                <hr>
                                <h6><i class="fas fa-phone me-2"></i>Nomor Kontak</h6>
                                <p>{{ $report->contact_phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <div class="card card-body bg-light">
                    <h4>Anda belum pernah membuat laporan.</h4>
                    <p>Laporkan hewan yang butuh bantuan di sekitar Anda.</p>
                    <div class="mt-2">
                        <a href="{{ route('lapor') }}" class="btn btn-green btn-lg">Ayo buat laporan pertama Anda!</a>
                    </div>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    @if($reports->hasPages())
    <div class="d-flex justify-content-center mt-4">
        {{ $reports->links() }}
    </div>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
{{-- Menambahkan style kustom untuk tema coklat --}}
<style>
    :root {
        --primary-brown: #6d4c41; /* Coklat tua */
        --secondary-brown: #a1887f; /* Coklat muda */
        --warning-brown: #d7ccc8; /* Coklat sangat muda untuk aksen */
    }
    .card.border-left-brown { border-left: .25rem solid var(--primary-brown) !important; }
    .card.border-left-green { border-left: .25rem solid #1cc88a !important; }
    .card.border-left-blue { border-left: .25rem solid #36b9cc !important; }
    .card.border-left-orange { border-left: .25rem solid #f6c23e !important; }

    .text-brown { color: var(--primary-brown) !important; }
    .text-xs { font-size: .8rem; letter-spacing: .05rem; }
    .text-gray-300 { color: #dddfeb !important; }
    .font-weight-bold { font-weight: 700 !important; }
</style>

{{-- Pesan Selamat Datang yang lebih ringkas --}}
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row">
    <!-- Card: Total Laporan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-brown shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-brown text-uppercase mb-1">
                            Total Laporan</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalReports }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card: Total Hewan -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-green shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Hewan Terdata</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAnimals }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-paw fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card: Total Kategori -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-blue shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Jumlah Kategori</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCategories }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tags fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card: Laporan Pending -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-orange shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Laporan Pending</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ \App\Models\FelishaReport::where('status', 'pending')->count() }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Laporan Terbaru -->
<div class="card shadow mb-4">
    <div class="card-header py-3" style="background-color: var(--primary-brown); color: white;">
        <h6 class="m-0 font-weight-bold">Laporan Terbaru yang Perlu Ditinjau</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Pelapor</th>
                        <th>Nama Hewan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestReports as $report)
                    <tr>
                        <td>{{ $report->user->name ?? 'N/A' }}</td>
                        <td>{{ $report->animal->name ?? '-' }}</td>
                        <td>
                            @php
                                $statusClass = [
                                    'pending' => 'bg-warning text-dark',
                                    'approved' => 'bg-success',
                                    'rejected' => 'bg-danger',
                                ][$report->status] ?? 'bg-secondary';
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ ucfirst($report->status) }}</span>
                        </td>
                        <td>{{ $report->created_at->diffForHumans() }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada laporan yang masuk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

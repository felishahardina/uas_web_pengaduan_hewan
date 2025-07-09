@extends('layouts.app')
@section('title', 'Detail Laporan')
@section('content')
<style>
    :root {
        --primary-brown: #6d4c41;
    }
    .card-header-brown {
        background-color: var(--primary-brown);
        color: white;
    }
    .table-detail th {
        width: 30%;
        background-color: #f8f9fa;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('admin.reports.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Laporan</a>
</div>

<div class="card shadow-sm">
    <div class="card-header card-header-brown">
        <h4 class="mb-0">Detail Laporan #{{ $report->id }}</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <h5>Informasi Laporan</h5>
                <table class="table table-bordered table-detail">
                    <tr>
                        <th>Status Laporan</th>
                        <td>
                            @php
                                $statusClass = [
                                    'pending' => 'bg-warning text-dark',
                                    'approved' => 'bg-success',
                                    'rejected' => 'bg-danger',
                                ][$report->status] ?? 'bg-secondary';
                            @endphp
                            <span class="badge {{ $statusClass }} fs-6">{{ ucfirst($report->status) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Hewan</th>
                        <td>{{ $report->animal->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $report->animal->jenis_kelamin ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>{{ $report->animal->category->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Terlihat</th>
                        <td>{{ $report->address }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $report->description }}</td>
                    </tr>
                </table>

                <h5 class="mt-4">Informasi Pelapor</h5>
                <table class="table table-bordered table-detail">
                    <tr>
                        <th>Nama Pelapor</th>
                        <td>{{ $report->user->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $report->user->email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Nomor Kontak</th>
                        <td>{{ $report->contact_phone }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lapor</th>
                        <td>{{ $report->created_at->format('d F Y, H:i') }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-5">
                <h5>Foto Laporan</h5>
                @if($report->image_path)
                    <img src="{{ asset('storage/' . $report->image_path) }}" class="img-fluid rounded shadow-sm" alt="Foto Laporan">
                @else
                    <div class="alert alert-warning">Tidak ada foto yang diunggah.</div>
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        @if($report->status == 'pending')
            <form action="{{ route('admin.reports.approve', $report->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-success"><i class="fas fa-check me-2"></i>Approve Laporan</button>
            </form>
            <form action="{{ route('admin.reports.reject', $report->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-warning"><i class="fas fa-times me-2"></i>Reject Laporan</button>
            </form>
        @endif
        <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus laporan ini secara permanen?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash me-2"></i>Hapus Permanen</button>
        </form>
    </div>
</div>
@endsection

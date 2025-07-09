@extends('layouts.app')
@section('title', 'Manajemen Laporan')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Manajemen Laporan</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Pelapor</th>
                            <th>Hewan</th>
                            <th>Lokasi</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reports as $report)
                            <tr>
                                <td>{{ $report->user->name ?? 'N/A' }}</td>
                                <td>{{ $report->animal->name ?? '-' }}</td>
                                <td>{{ $report->location->name ?? '-' }}</td>
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
                                <td>{{ $report->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-sm btn-info">Detail</a>

                                    @if($report->status == 'pending')
                                        <form action="{{ route('admin.reports.approve', $report->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.reports.reject', $report->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-secondary">Reject</button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus laporan ini secara permanen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada laporan yang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{ $reports->links() }}
        </div>
    </div>
</div>
@endsection

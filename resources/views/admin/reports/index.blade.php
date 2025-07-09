@extends('layouts.app')

@section('title', 'Manajemen Laporan')

@section('content')
{{-- Menambahkan style kustom untuk tema --}}
<style>
    :root {
        --primary-brown: #6d4c41;
    }
    .card-header-brown {
        background-color: var(--primary-brown);
        color: white;
    }
</style>

<div class="card shadow mb-4">
    <div class="card-header card-header-brown">
        <h6 class="m-0 font-weight-bold"><i class="fas fa-file-alt me-2"></i>Manajemen Laporan Pengguna</h6>
    </div>
    <div class="card-body">
        <p>Tinjau, setujui, atau tolak laporan yang masuk dari pengguna. Laporan yang disetujui akan tampil di halaman utama.</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Pelapor</th>
                        <th>Hewan</th>
                        <th>Kategori</th>
                        <th class="text-center">Status</th>
                        <th>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reports as $report)
                        <tr>
                            <td>{{ $report->user->name ?? 'N/A' }}</td>
                            <td>{{ $report->animal->name ?? '-' }}</td>
                            <td><span class="badge bg-secondary">{{ $report->animal->category->name ?? '-' }}</span></td>
                            <td class="text-center">
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
                            <td class="text-center">
                                <a href="{{ route('admin.reports.show', $report->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                @if($report->status == 'pending')
                                    <form action="{{ route('admin.reports.approve', $report->id) }}" method="POST" class="d-inline" title="Approve">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                                    </form>
                                    <form action="{{ route('admin.reports.reject', $report->id) }}" method="POST" class="d-inline" title="Reject">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-times"></i></button>
                                    </form>
                                @endif

                                <form action="{{ route('admin.reports.destroy', $report->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus laporan ini secara permanen?');" title="Hapus Permanen">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
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
        @if($reports->hasPages())
        <div class="mt-3">
            {{ $reports->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Daftar Hewan')

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
        <h6 class="m-0 font-weight-bold"><i class="fas fa-paw me-2"></i>Daftar Hewan Terdata</h6>
    </div>
    <div class="card-body">
        <p>Berikut adalah daftar semua hewan yang hilang</p>
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Hewan</th>
                        <th>Jenis Kelamin</th>
                        <th>Kategori</th>
                        <th>Tanggal Ditambahkan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($animals as $key => $animal)
                    <tr>
                        <td>{{ $animals->firstItem() + $key }}</td>
                        <td>{{ $animal->name }}</td>
                        <td>{{ $animal->jenis_kelamin }}</td>
                        <td>
                            <span class="badge bg-info">{{ $animal->category->name ?? 'N/A' }}</span>
                        </td>
                        <td>{{ $animal->created_at->format('d F Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data hewan yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($animals->hasPages())
        <div class="mt-3">
            {{ $animals->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

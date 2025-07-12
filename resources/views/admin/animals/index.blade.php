@extends('layouts.app')

@section('title', 'Daftar Hewan')

@section('content')

{{-- Tema Hijau Gelap --}}
<style>
    :root {
        --dark-green: #37473f;
        --soft-green: #4b5f55;
        --white: #ffffff;
        --badge-info-custom: #88b4a3;
    }

    .card-header-darkgreen {
        background: linear-gradient(90deg, var(--dark-green), var(--soft-green));
        color: var(--white);
    }

    .badge-info-custom {
        background-color: var(--badge-info-custom);
        color: #fff;
    }

    .table th {
        background-color: #f5f5f5;
    }
</style>

<div class="card shadow mb-4">
    <div class="card-header card-header-darkgreen">
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
                            <span class="badge badge-info-custom">{{ $animal->category->name ?? 'N/A' }}</span>
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

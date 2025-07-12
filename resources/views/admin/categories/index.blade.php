@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')

{{-- Tema Hijau Gelap --}}
<style>
    :root {
        --dark-green: #37473f;
        --dark-green-hover: #2e3a35;
        --soft-green: #4b5f55;
        --white: #ffffff;
    }

    .btn-darkgreen {
        background-color: var(--dark-green);
        border-color: var(--dark-green);
        color: var(--white);
    }

    .btn-darkgreen:hover {
        background-color: var(--dark-green-hover);
        border-color: var(--dark-green-hover);
        color: var(--white);
    }

    .card-header-darkgreen {
        background-color: var(--dark-green);
        color: var(--white);
    }

    .text-darkgreen {
        color: var(--dark-green);
    }

    .table th {
        background-color: #f4f4f4;
    }
</style>

<div class="row">
    <!-- Kolom Form Tambah/Edit Kategori -->
    <div class="col-lg-4 mb-4">
        <div class="card shadow">
            <div class="card-header card-header-darkgreen">
                <h6 class="m-0 font-weight-bold">Tambah Kategori Baru</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama Kategori</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-darkgreen mt-3 w-100">
                        <i class="fas fa-plus-circle me-2"></i>Tambah
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Kolom Tabel Daftar Kategori -->
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3" style="background: linear-gradient(90deg, var(--dark-green), var(--soft-green)); color: white;">
                <h6 class="m-0 font-weight-bold">Daftar Kategori Hewan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $key }}</td>
                                <td>{{ $category->name }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini? Ini akan menghapus semua hewan yang terkait.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">Belum ada kategori yang ditambahkan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($categories->hasPages())
                <div class="mt-3">
                    {{ $categories->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

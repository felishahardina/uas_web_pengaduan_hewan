@extends('layouts.app')

@section('title', 'Tambah Kategori Baru')

@section('content')
<div class="container mt-5">
    <h1>Tambah Kategori Baru</h1>
    <div class="card">
        <div class="card-body">
            {{-- PERBAIKAN: Menambahkan 'admin.' pada nama route --}}
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                {{-- PERBAIKAN: Menambahkan 'admin.' pada nama route --}}
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

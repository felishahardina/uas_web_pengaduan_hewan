@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="container mt-5">
    <h1>Edit Kategori</h1>
    <div class="card">
        <div class="card-body">
            {{-- PERBAIKAN: Menambahkan 'admin.' pada nama route --}}
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                {{-- PERBAIKAN: Menambahkan 'admin.' pada nama route --}}
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

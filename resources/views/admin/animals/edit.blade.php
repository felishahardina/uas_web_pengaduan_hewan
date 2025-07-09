@extends('layouts.app')
@section('title', 'Edit Hewan')
@section('content')
<div class="container mt-5">
    <h1>Edit Hewan</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.animals.update', $animal->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Hewan</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $animal->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="felisha_category_id" class="form-label">Kategori</label>
                    <select class="form-select @error('felisha_category_id') is-invalid @enderror" id="felisha_category_id" name="felisha_category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('felisha_category_id', $animal->felisha_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('felisha_category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.animals.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection

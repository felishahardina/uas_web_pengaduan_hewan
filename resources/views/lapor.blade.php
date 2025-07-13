@extends('layouts.app-user')

@section('title', 'Buat Laporan Baru')

@section('content')
<style>
    :root {
        --primary-green: #37473f;
        --accent-green: #4b5f55;
        --soft-beige: #f5f5f5;
    }

    body {
        background-color: var(--soft-beige);
    }

    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background-color: var(--primary-green);
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--accent-green);
        box-shadow: 0 0 0 0.25rem rgba(75, 95, 85, 0.25); /* rgba dari accent */
    }

    .form-check-input:checked {
        background-color: var(--primary-green);
        border-color: var(--primary-green);
    }

    .btn-green {
        background-color: var(--primary-green);
        color: white;
        border: none;
    }

    .btn-green:hover {
        background-color: #2d3936;
        color: white;
    }
</style>


<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><i class="fas fa-edit me-2"></i>Formulir Laporan Hewan</div>
                <div class="card-body p-4">
                    <form action="{{ route('lapor') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="new_animal_name" class="form-label">Nama Hewan</label>
                            <input type="text" class="form-control @error('new_animal_name') is-invalid @enderror" id="new_animal_name" name="new_animal_name" value="{{ old('new_animal_name') }}" required placeholder="Contoh: Miko, si Kucing Oren">
                            @error('new_animal_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="d-flex gap-3 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="jantan" value="Jantan" {{ old('jenis_kelamin') == 'Jantan' ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="jantan">Jantan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="betina" value="Betina" {{ old('jenis_kelamin') == 'Betina' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="betina">Betina</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="jenis_kelamin" id="tidak_diketahui" value="Tidak Diketahui" {{ old('jenis_kelamin', 'Tidak Diketahui') == 'Tidak Diketahui' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="tidak_diketahui">Tidak Diketahui</label>
                                </div>
                            </div>
                            @error('jenis_kelamin') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="felisha_category_id" class="form-label">Kategori Hewan</label>
                            <select class="form-select @error('felisha_category_id') is-invalid @enderror" id="felisha_category_id" name="felisha_category_id" required>
                                <option value="" selected disabled>-- Pilih Kategori --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('felisha_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('felisha_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Terakhir Terlihat</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required placeholder="Tuliskan alamat selengkap mungkin...">{{ old('address') }}</textarea>
                            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Nomor Telepon Kontak</label>
                            <input type="tel" class="form-control @error('contact_phone') is-invalid @enderror" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', auth()->user()->phone) }}" required placeholder="Nomor yang bisa dihubungi">
                            @error('contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi Tambahan</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required placeholder="Jelaskan ciri-ciri hewan...">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image_path" class="form-label">Foto Hewan</label>
                            <input class="form-control @error('image_path') is-invalid @enderror" type="file" id="image_path" name="image_path" required>
                            @error('image_path') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-green btn-lg">
                                <i class="fas fa-paper-plane me-2"></i> Kirim Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

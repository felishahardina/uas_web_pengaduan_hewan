@extends('layouts.app-user')

@section('title', 'Register')

@section('content')
<style>
    :root {
        --primary-brown: #6d4c41;
        --secondary-brown: #a1887f;
        --background-beige: #f5f5f5;
    }
    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
    }
    .auth-card {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
    }
    .auth-form-side {
        padding: 3rem;
    }
    .auth-image-side {
        background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('https://placehold.co/600x800/8d6e63/FFFFFF?text=Bergabunglah');
        background-size: cover;
        background-position: center;
    }
    .btn-brown {
        background-color: var(--primary-brown);
        border-color: var(--primary-brown);
        color: #fff;
    }
    .btn-brown:hover {
        background-color: #5d4037;
        border-color: #5d4037;
        color: #fff;
    }
    .form-control:focus {
        border-color: var(--secondary-brown);
        box-shadow: 0 0 0 0.25rem rgba(109, 76, 65, 0.25);
    }
</style>

<div class="container auth-container">
    <div class="row justify-content-center w-100">
        <div class="col-lg-8">
            <div class="card auth-card shadow-lg">
                <div class="row g-0">
                    <div class="col-lg-6 auth-form-side">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-brown"><i class="fas fa-user-plus me-2"></i>Buat Akun Baru</h2>
                            <p class="text-muted">Bergabunglah dengan komunitas peduli hewan.</p>
                        </div>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Lengkap</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-brown btn-lg">Register</button>
                            </div>

                            <div class="text-center">
                                <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 d-none d-lg-block auth-image-side">
                        {{-- Sisi gambar, hanya tampil di layar besar --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

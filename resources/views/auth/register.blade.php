@extends('layouts.app-user')

@section('title', 'Register')

@section('content')
<style>
    :root {
        --primary-green: #37473f;
        --secondary-green: #4b5f55;
        --soft-beige: #f5f5f5;
        --accent: #FFD1BA;
    }

    body {
        background-color: var(--soft-beige);
        font-family: 'Poppins', sans-serif;
    }

    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .auth-card {
        max-width: 640px;
        width: 100%;
        border-radius: 1rem;
        overflow: hidden;
    }

    .auth-form-side {
        padding: 1rem 1.25rem;
        max-width: 260px;
        margin: auto;
        background-color: #fff;
        font-size: 0.9rem;
    }

    .auth-image-side {
        background: url('{{ asset("image/cat.png") }}') no-repeat center center;
        background-size: contain;
        background-color: var(--soft-beige);
    }

    .btn-green {
        background-color: var(--primary-green);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 0.55rem;
        font-size: 0.9rem;
        border-radius: 0.6rem;
        transition: all 0.3s ease;
    }

    .btn-green:hover {
        background-color: var(--secondary-green);
        color: #fff;
    }

    .form-control {
        border-radius: 0.5rem;
        font-size: 0.9rem;
        padding: 0.45rem 0.75rem;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 0.15rem rgba(255, 209, 186, 0.4);
    }

    .form-label {
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
    }

    @media (max-width: 768px) {
        .auth-card {
            flex-direction: column;
        }

        .auth-image-side {
            height: 200px;
            background-size: contain;
        }

        .auth-form-side {
            max-width: 100%;
        }
    }
</style>

<div class="container auth-container">
    <div class="row justify-content-center w-100">
        <div class="col-md-10 mx-auto">
            <div class="card auth-card shadow-lg mx-auto d-flex flex-row">
                <div class="col-lg-6 auth-form-side">
                    <div class="text-center mb-3">
                        <h4 class="fw-bold text-dark mb-1"><i class="fas fa-user-plus me-2"></i>Buat Akun Baru</h4>
                        <p class="text-muted mb-3" style="font-size: 0.85rem;">Bergabunglah dengan komunitas peduli hewan.</p>
                    </div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-2">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password-confirm" class="form-label">Konfirmasi Password</label>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="d-grid mb-2">
                            <button type="submit" class="btn btn-green">Register</button>
                        </div>

                        <div class="text-center">
                            <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 d-none d-lg-block auth-image-side">
                    {{-- Gambar sisi kanan --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
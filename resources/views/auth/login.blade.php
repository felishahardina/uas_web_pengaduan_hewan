@extends('layouts.app-user') {{-- Menggunakan layout user agar navbar konsisten --}}

@section('title', 'Login')

@section('content')
@extends('layouts.app-user')

@section('title', 'Login')

@section('content')
<style>
    :root {
        --primary-dark: #3c4a46; /* hijau gelap */
        --soft-brown: #a1887f;
        --light-bg: #fdf9f4;
        --card-radius: 1.5rem;
    }

    body {
        background-color: var(--light-bg);
        font-family: 'Poppins', sans-serif;
    }

    nav.navbar {
        background-color: var(--primary-dark) !important;
    }

    footer {
        background-color: var(--primary-dark);
        color: #fff;
        padding: 0.75rem 0;
        text-align: center;
        font-size: 0.9rem;
    }

    .auth-container {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .auth-card {
        max-width: 720px;
        width: 100%;
        border: none;
        border-radius: var(--card-radius);
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        background-color: white;
    }

    .auth-image-side {
        background: url("{{ asset('image/cat.png') }}") no-repeat center center;
        background-size: contain;
        background-color: #eee;
    }

    .auth-form-side {
        padding: 2rem 2rem;
    }

    .text-dark-green {
        color: var(--primary-dark);
    }

    .btn-brown {
        background-color: var(--primary-dark);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 0.7rem;
        border-radius: 0.6rem;
        transition: all 0.3s ease;
    }

    .btn-brown:hover {
        background-color: #2f3a37;
    }

    .form-control:focus {
        border-color: var(--soft-brown);
        box-shadow: 0 0 0 0.15rem rgba(161, 136, 127, 0.3);
    }

    .form-control {
        border-radius: 0.6rem;
        background-color: #fefefe;
    }

    @media (max-width: 768px) {
        .auth-card {
            flex-direction: column;
        }

        .auth-image-side {
            height: 200px;
            background-size: cover;
        }
    }
</style>

<div class="container auth-container">
    <div class="row justify-content-center w-100">
        <div class="col-lg-8">
            <div class="card auth-card shadow-lg">
                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-block auth-image-side">
                        {{-- Sisi gambar, hanya tampil di layar besar --}}
                    </div>
                    <div class="col-lg-6 auth-form-side">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold text-brown"><i class="fas fa-paw me-2"></i>Selamat Datang Kembali</h2>
                            <p class="text-muted">Login untuk melanjutkan dan membantu hewan.</p>
                        </div>

                        {{-- Menampilkan pesan error --}}
                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login.process') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-brown btn-lg">Login</button>
                            </div>

                            <div class="text-center">
                                <small>Belum punya akun? <a href="{{ route('register') }}">Register di sini</a></small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
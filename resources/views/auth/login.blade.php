<!-- login.blade.php (UPDATED with consistent colors) -->
@extends('layouts.app-user')

@section('title', 'Login')

@section('content')
<style>
    :root {
        --primary-green: #37473f;
        --secondary-green: #4b5f55;
        --soft-beige: #f5f5f5;
        --accent: #FFD1BA;
        --card-radius: 1.5rem;
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
        padding: 2rem 1rem;
    }

    .auth-card {
        max-width: 720px;
        width: 100%;
        border-radius: var(--card-radius);
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(55, 71, 63, 0.1);
        background-color: #fff;
    }

    .auth-image-side {
        background: url("{{ asset('image/cat.png') }}") no-repeat center center;
        background-size: contain;
        background-color: var(--secondary-green);
    }

    .auth-form-side {
        padding: 2rem;
    }

    .btn-green {
        background-color: var(--primary-green);
        border: none;
        color: #fff;
        font-weight: 600;
        padding: 0.7rem;
        border-radius: 0.6rem;
        transition: all 0.3s ease;
    }

    .btn-green:hover {
        background-color: var(--secondary-green);
    }

    .form-control {
        border-radius: 0.6rem;
        background-color: #fefefe;
    }

    .form-control:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 0.15rem rgba(255, 209, 186, 0.4);
    }

    .password-toggle {
        position: absolute;
        top: 52px;
        right: 1rem;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
        z-index: 5;
        font-size: 1rem;
    }

    .position-relative {
        position: relative;
    }
</style>

<div class="container auth-container">
    <div class="row justify-content-center w-100">
        <div class="col-lg-8">
            <div class="card auth-card shadow-lg">
                <div class="row g-0">
                    <div class="col-lg-6 d-none d-lg-block auth-image-side"></div>
                    <div class="col-lg-6 auth-form-side">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold" style="color: var(--primary-green)"><i class="fas fa-paw me-2"></i>Selamat Datang Kembali</h2>
                            <p class="text-muted">Login untuk melanjutkan dan membantu hewan.</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger text-center">{{ session('error') }}</div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success text-center">{{ session('success') }}</div>
                        @endif

                        <form method="POST" action="{{ route('login.process') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Alamat Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="mb-3 position-relative">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                <i class="fas fa-eye password-toggle" id="togglePassword"></i>
                                @error('password')<span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>@enderror
                            </div>

                            <div class="d-grid mb-3">
                                <button type="submit" class="btn btn-green btn-lg">Login</button>
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

<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    toggle.addEventListener('click', () => {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        toggle.classList.toggle('fa-eye-slash');
    });
</script>
@endsection

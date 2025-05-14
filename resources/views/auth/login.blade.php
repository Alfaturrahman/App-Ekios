@extends('layouts.app', ['hideNavbar' => true])

@section('title', 'Login')

@push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(to right, #fff6b7, #fcd27d);
    }

    .card {
        border: none;
        border-radius: 1rem;
        background-color: #ffffff;
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.2);
    }

    .form-control:focus {
        border-color: #fbc02d;
        box-shadow: 0 0 0 0.2rem rgba(251, 192, 45, 0.25);
    }

    .btn-yellow {
        background-color: #fbc02d;
        color: #fff;
        font-weight: 600;
        border: none;
    }

    .btn-yellow:hover {
        background-color: #f9a825;
    }

    .text-yellow {
        color: #f9a825;
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 1rem;
        transform: translateY(-50%);
        cursor: pointer;
        color: #aaa;
    }
</style>
@endpush

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow p-4 animate__animated animate__fadeIn" style="width: 100%; max-width: 600px;">
        <h2 class="mb-2 text-center fw-bold text-yellow">Selamat Datang</h2>
        <p class="text-center text-muted mb-4">Silakan login untuk melanjutkan</p>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control @error('employee_badge') is-invalid @enderror"
                    name="employee_badge"
                    id="employee_badge"
                    value="{{ old('employee_badge') }}"
                    placeholder="Badge"
                    required
                    autofocus
                >
                <label for="employee_badge">Badge</label>
                @error('employee_badge')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-floating mb-4 position-relative">
                <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    id="password"
                    placeholder="Password"
                    required
                >
                <label for="password">Password</label>
                <i id="togglePassword" class="bi bi-eye toggle-password"></i>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-yellow w-100 py-2 shadow-sm" id="loginBtn">
                <i class="bi bi-box-arrow-in-right me-2"></i> Login
            </button>
        </form>

        <p class="text-center mt-3">
            Belum punya akun? <a href="{{ route('register') }}" class="text-yellow">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#togglePassword').on('click', function () {
            const passwordInput = $('#password');
            const type = passwordInput.attr('type') === 'password' ? 'text' : 'password';
            passwordInput.attr('type', type);
            $(this).toggleClass('bi-eye bi-eye-slash');
        });

        $('#loginForm').on('submit', function (e) {
            let valid = true;

            $(this).find('input[required]').each(function () {
                if (!$(this).val()) {
                    $(this).addClass('is-invalid');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!valid) e.preventDefault();

            $('#loginBtn').prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...'
            );
        });
    });
</script>
@endpush

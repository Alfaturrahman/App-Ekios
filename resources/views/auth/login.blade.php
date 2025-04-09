@extends('layouts.app', ['hideNavbar' => true])

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <h4 class="mb-4 text-center">Login</h4>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="mb-3">
                <label for="employee_badge" class="form-label">Badge</label>
                <input
                    type="text"
                    class="form-control @error('employee_badge') is-invalid @enderror"
                    name="employee_badge"
                    id="employee_badge"
                    value="{{ old('employee_badge') }}"
                    required
                    autofocus
                >
                @error('employee_badge')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 position-relative">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    id="password"
                    required
                >
                <i id="togglePassword" class="fas fa-eye position-absolute" style="top: 38px; right: 15px; cursor: pointer;"></i>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning text-dark w-100" id="loginBtn">Login</button>
        </form>

        <p class="text-center mt-3">
            Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>
        </p>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
        $('#togglePassword').on('click', function () {
            const input = $('#password');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).toggleClass('fa-eye fa-eye-slash');
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
                '<span class="spinner-border spinner-border-sm me-2"></span>Loading...'
            );
        });
    });
    </script>
@endpush

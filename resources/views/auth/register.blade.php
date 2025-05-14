@extends('layouts.app', ['hideNavbar' => true])

@section('title', 'Register')

@push('styles')
<!-- Animate.css for animation -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet" />

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

    .form-control:focus, .form-select:focus {
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

    .form-floating > .form-control:not(:placeholder-shown) ~ label,
    .form-floating > .form-select ~ label {
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow p-4 animate__animated animate__fadeIn" style="width: 100%; max-width: 800px;">
        <h2 class="mb-2 text-center fw-bold text-yellow">Buat Akun Baru</h2>
        <p class="text-center text-muted mb-4">Isi data di bawah untuk mulai menggunakan aplikasi</p>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="employee_name" id="employee_name" placeholder="Nama Lengkap" required>
                <label for="employee_name">Nama Lengkap</label>
                @error('employee_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="employee_badge" id="employee_badge" placeholder="Badge" required>
                <label for="employee_badge">Badge</label>
                @error('employee_badge') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-floating mb-3">
                <select name="department_id" id="department_id" class="form-select" required>
                    <option disabled selected value="">-- Pilih Departemen --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                    @endforeach
                </select>
                <label for="department_id">Departemen</label>
                @error('department_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-floating mb-3">
                <select name="jabatan_id" id="jabatan_id" class="form-select" required>
                    <option disabled selected value="">-- Pilih Jabatan --</option>
                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->jabatan_id }}">{{ $jabatan->name }}</option>
                    @endforeach
                </select>
                <label for="jabatan_id">Jabatan</label>
                @error('jabatan_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password" required>
                <label for="password_confirmation">Konfirmasi Password</label>
            </div>

            <button type="submit" class="btn btn-yellow w-100 py-2 shadow-sm" id="registerBtn">
                <i class="bi bi-person-plus-fill me-2"></i> Daftar
            </button>
        </form>

        <p class="text-center mt-3">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-yellow">Login di sini</a>
        </p>
    </div>
</div>
@endsection

@push('scripts')
<!-- Bootstrap Icons (if not yet included) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script>
    $(document).ready(function () {
        $('#registerForm').on('submit', function (e) {
            let valid = true;

            $(this).find('input[required], select[required]').each(function () {
                if (!$(this).val()) {
                    $(this).addClass('is-invalid');
                    valid = false;
                } else {
                    $(this).removeClass('is-invalid');
                }
            });

            if (!valid) {
                e.preventDefault();
                return;
            }

            $('#registerBtn').prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-2"></span>Memproses...'
            );
        });
    });
</script>
@endpush

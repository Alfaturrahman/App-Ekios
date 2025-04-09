@extends('layouts.app', ['hideNavbar' => true])

@section('title', 'Register')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
        <h4 class="mb-4 text-center">Registrasi Akun</h4>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="mb-3">
                <label for="employee_name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" name="employee_name" id="employee_name" required>
                @error('employee_name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="employee_badge" class="form-label">Badge</label>
                <input type="text" class="form-control" name="employee_badge" id="employee_badge" required>
                @error('employee_badge') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="department_id" class="form-label">Departemen</label>
                <select name="department_id" id="department_id" class="form-select" required>
                    <option disabled selected value="">-- Pilih Departemen --</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                    @endforeach
                </select>
                @error('department_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="jabatan_id" class="form-label">Jabatan</label>
                <select name="jabatan_id" id="jabatan_id" class="form-select" required>
                    <option disabled selected value="">-- Pilih Jabatan --</option>
                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->jabatan_id }}">{{ $jabatan->name }}</option>
                    @endforeach
                </select>
                @error('jabatan_id') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
            </div>

            <button type="submit" class="btn btn-success w-100" id="registerBtn">Register</button>
        </form>

        <p class="text-center mt-3">
            Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
        </p>
    </div>
</div>
@endsection

@push('scripts')
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

            if (!valid) e.preventDefault();

            $('#registerBtn').prop('disabled', true).html(
                '<span class="spinner-border spinner-border-sm me-2"></span>Registering...'
            );
        });
    });
</script>
@endpush

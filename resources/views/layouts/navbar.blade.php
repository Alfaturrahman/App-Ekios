<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- jQuery (CDN) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #DCD135;">
        <div class="container">
            <!-- Ikon Hamburger -->
            <ul class="navbar-nav me-2">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" id="navbarDropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="navbar-toggler-icon-vertical" style="font-size: 2rem;">&#9776;</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenu">
                        <li><a class="dropdown-item" href="{{ url('/') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ url('/') }}">Pengajuan</a></li>
                    </ul>
                </li>
            </ul>
            <!-- Nama Aplikasi -->
            <a class="navbar-brand" href="{{ url('/') }}">
                MySatnusa
            </a>

            <!-- Tombol Toggler untuk Layar Kecil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Kanan  -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <!-- Icon Notifikasi -->
                    <li class="nav-item me-4">
                        <a class="nav-link position-relative" href="#" id="notifikasi">
                            <i class="fas fa-bell fs-5"></i>
                            @if(isset($notifikasiCount) && $notifikasiCount > 0)
                                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">{{ $notifikasiCount }}</span>
                            @endif
                        </a>
                    </li>

                    <!-- Profil dengan Gambar Bulat -->
                    <li class="nav-item me-4">
                        <a class="nav-link d-flex align-items-center" href="#">
                            <!-- Gambar Profil Bulat -->
                            <img src="/profile.png" alt="Profile" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                            <div class="d-flex flex-column text-start">
                                <span class="fw-bold">{{ auth('employee')->user()->employee_name }}</span>
                                <small class="text-muted">{{ auth('employee')->user()->jabatan->name ?? '-' }}</small>
                            </div>
                        </a>
                    </li>

                    <!-- Logout Icon -->
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fs-5"></i>
                        </a>

                        <!-- Hidden logout form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom Scripts -->
    @stack('scripts')
</body>
</html>

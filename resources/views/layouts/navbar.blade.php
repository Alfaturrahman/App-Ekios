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
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #fdd835;">
        <div class="container">
            <!-- Ikon Hamburger -->
            <ul class="navbar-nav me-2">
                <li class="nav-item dropdown">
                    <a class="nav-link text-dark" href="#" id="navbarDropdownMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fs-2">&#9776;</span>
                    </a>
                    <ul class="dropdown-menu shadow-sm rounded-3" aria-labelledby="navbarDropdownMenu">
                        <li><a class="dropdown-item" href="{{ url('/') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ url('/') }}">Pengajuan</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Nama Aplikasi -->
            <a class="navbar-brand fw-bold text-dark" href="{{ url('/') }}">
                MySatnusa
            </a>

            <!-- Toggle Button untuk Mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu Kanan -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                   <!-- Notifikasi -->
                    <li class="nav-item dropdown me-4">
                        <a class="nav-link position-relative text-dark" href="#" id="dropdownNotifikasi" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell fs-5"></i>
                            @if(isset($notifikasiCount) && $notifikasiCount > 0)
                                <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">{{ $notifikasiCount }}</span>
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded-3" aria-labelledby="dropdownNotifikasi" style="width: 300px;">
                            <li class="dropdown-header fw-bold px-3 py-2">Notifikasi</li>
                            @if(isset($notifikasiList) && count($notifikasiList) > 0)
                                @foreach($notifikasiList as $notif)
                                <li>
                                    <a class="dropdown-item small py-2 px-3 border-bottom @if(!$notif->read_at) unread @else read @endif" href="{{ route('notifikasi.read', $notif->id) }}">
                                        <div class="fw-bold">{{ $notif->data['title'] ?? 'Notifikasi' }}</div>
                                        <div class="text-muted">{{ $notif->data['message'] ?? '' }}</div>

                                        @if(isset($notif->data['pengajuan_id']))
                                            <div class="fw-bold">ID Pengajuan: {{ $notif->data['pengajuan_id'] }}</div>
                                        @endif

                                        <div class="text-end text-muted small">{{ $notif->created_at->diffForHumans() }}</div>
                                    </a>
                                </li>
                                @endforeach
                            @else
                                <li>
                                    <span class="dropdown-item text-muted text-center small py-3">Tidak ada notifikasi baru</span>
                                </li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center small fw-semibold" href="{{ route('notifikasi.index') }}">Lihat Semua</a></li>
                        </ul>
                    </li>
                    <!-- Profil -->
                    <li class="nav-item me-4">
                        <a class="nav-link d-flex align-items-center text-dark" href="#">
                            <img src="/profile.png" alt="Profile" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                            <div class="d-flex flex-column text-start">
                                <span class="fw-bold text-dark">{{ auth('employee')->user()->employee_name }}</span>
                                <small class="text-muted">{{ auth('employee')->user()->jabatan->name ?? '-' }}</small>
                            </div>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fs-5"></i>
                        </a>
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
    <style>
        /* Membatasi lebar dropdown */
        .dropdown-menu {
            max-width: 400px; /* Menyesuaikan dengan ukuran layar */
            width: auto;
            word-wrap: break-word; /* Memastikan teks panjang dibungkus */
        }

        /* Memastikan item di dalam dropdown memiliki tinggi dan lebar yang sesuai */
        .dropdown-item {
            white-space: normal; /* Mengizinkan teks untuk dibungkus */
        }

        /* Menyesuaikan ukuran dropdown di tampilan mobile */
        @media (max-width: 768px) {
            .dropdown-menu {
                width: 100%; /* Menggunakan lebar penuh di perangkat kecil */
            }
        }

        /* Notifikasi yang belum dibaca */
        .unread {
            font-weight: bold;
            background-color: #f7f7f7;
        }

        /* Notifikasi yang sudah dibaca */
        .read {
            font-weight: normal;
            background-color: #fff;
        }
    </style>
</body>
</html>

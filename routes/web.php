<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Guest only (kalau belum login)
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // Register
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Authenticated only
Route::middleware('auth')->group(function () {
    // Dashboard (contoh)
    Route::get('/', function () {
        return view('<hrd-qhse/dashboard-hrd');
    });

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

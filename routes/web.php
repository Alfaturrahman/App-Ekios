<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
*/

// Guest only
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Authenticated only
Route::middleware('auth:employee')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Redirect berdasarkan jabatan
    Route::get('/', function () {
        $user = auth('employee')->user();
        $jabatan = strtolower($user->jabatan->name ?? '');
    
        if (in_array($jabatan, ['hrd', 'qhse'])) {
            return redirect()->route('dashboard.hrd');
        } elseif ($jabatan === 'staff') {
            return redirect()->route('register.staff');
        }
    
        abort(403, 'Unauthorized');
    });
    
    // Dashboard HRD dan QHSE (hak akses sama)
    Route::middleware('jabatan:HRD,QHSE')->group(function () {
        Route::get('/dashboard/hrd', [DashboardController::class, 'hrdIndex'])->name('dashboard.hrd');
        Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
        Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('pengajuan.show');
    });

    // Staff akses halaman registrasi langsung
    Route::middleware('jabatan:STAFF')->group(function () {
        Route::get('/register-hp', function () {
            return view('staff.register-staff'); // atau folder sesuai kamu
        })->name('register.staff');
    });
});

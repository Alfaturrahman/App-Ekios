<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotifikasiController;

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
    
        // Semua user (HRD, QHSE, STAFF) yang bisa akses pengajuan
    Route::middleware('jabatan:HRD,QHSE,STAFF')->group(function () {
        Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
        Route::get('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.read');
        Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
        Route::get('/pengajuan/data', [PengajuanController::class, 'data'])->name('pengajuan.data');
        Route::get('/pengajuan/data/employee', [PengajuanController::class, 'dataByEmployee'])->name('pengajuan.data.employee');
        Route::get('/pengajuan/{id}', [PengajuanController::class, 'show'])->name('pengajuan.show');
        Route::get('/departments', function () {
            return \App\Models\Department::select('department_id', 'department_name')->orderBy('department_name')->get();
        });
    });

    // HRD & QHSE khusus
    Route::middleware('jabatan:HRD,QHSE')->group(function () {
        Route::get('/dashboard/hrd', [DashboardController::class, 'hrdIndex'])->name('dashboard.hrd');
        Route::get('/dashboard/data', [DashboardController::class, 'getDashboardData'])->name('dashboard.data');
        Route::post('/pengajuan/{id}/approve', [PengajuanController::class, 'approve']);
        Route::post('/pengajuan/{id}/reject', [PengajuanController::class, 'reject']);
    });

    // STAFF khusus
    Route::middleware('jabatan:STAFF')->group(function () {
        Route::get('/register/staff', [DashboardController::class, 'staffIndex'])->name('register.staff');
    });
});

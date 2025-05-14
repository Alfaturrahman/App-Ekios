<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'employee_badge' => ['required'],
            'password'       => ['required'],
        ]);

        if (Auth::guard('employee')->attempt($credentials)) {

            $request->session()->regenerate();
            $user = Auth::guard('employee')->user();
            $jabatan = $user->jabatan?->name;

            $jabatan = strtolower($user->jabatan?->name ?? '');

            if ($jabatan === 'staff') {
                return redirect()->route('register.staff');
            } elseif (in_array($jabatan, ['hrd', 'qhse'])) {
                return redirect()->route('dashboard.hrd');
            }
        }

        return back()->withErrors([
            'employee_badge' => 'Badge atau password salah.',
        ])->onlyInput('employee_badge');
    }

    public function logout(Request $request)
    {
        Auth::guard('employee')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Tambahkan pengaturan header cache
        return redirect('/login')->withHeaders([
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Expires' => 'Sat, 26 Jul 1997 05:00:00 GMT'
        ]);
    }

}


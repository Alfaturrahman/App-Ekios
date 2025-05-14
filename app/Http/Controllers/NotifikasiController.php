<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Ambil semua notifikasi untuk user yang sedang login
        $notifikasiList = auth('employee')->user()->notifications()->get();
        
        // Tandai notifikasi sebagai sudah dibaca
        auth('employee')->user()->unreadNotifications->markAsRead();

        return view('notifikasi.index', compact('notifikasiList'));
    }

    // Jika ingin menandai notifikasi sebagai dibaca saat diklik
    public function markAsRead($id)
    {
        $notifikasi = auth('employee')->user()->notifications()->findOrFail($id);
        
        // Tandai sebagai dibaca
        $notifikasi->markAsRead();

        return redirect()->route('notifikasi.index'); // Setelah ditandai, kembali ke halaman notifikasi
    }
}

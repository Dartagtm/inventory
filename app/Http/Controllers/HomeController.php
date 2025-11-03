<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Auth facade

class HomeController extends Controller
{
    /**
     * Show the application dashboard based on user role.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil user yang sedang login
        $user = Auth::user();

        // Mengecek role pengguna (menggunakan properti 'role' di tabel users)
        if ($user && $user->role === 'admin') {
            // Jika pengguna adalah admin, arahkan ke dashboard admin
            return view('admin.dashboard');
        } elseif ($user && $user->role === 'gudang_muat') {
            // Jika pengguna adalah gudang muat, arahkan ke dashboard gudang
            return view('gudang_muat.dashboard');
        } elseif ($user && $user->role === 'surat_jalan') {
            // Jika pengguna adalah surat jalan, arahkan ke dashboard surat jalan
            return view('surat_jalan.dashboard');
        }

        // Default redirect jika tidak ada role yang cocok
        return redirect()->route('login');
    }
}

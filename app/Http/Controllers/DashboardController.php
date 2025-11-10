<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total semua alat dari tabel barang
        $totalAlat = Barang::count();

        $totalAlat = Barang::count();

        // Hitung total pelanggan (role = user)
        $totalPelanggan = User::where('role', 'user')->count();

        // Kirim variabel ke view dashboard.blade.php
        return view('admin.dashboard', compact('totalAlat', 'totalPelanggan'));
    }
}

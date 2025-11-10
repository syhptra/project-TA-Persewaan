<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class SewaController extends Controller
{
    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return view('detail', compact('barang'));
    }

    public function store(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->stok <= 0) {
            return back()->with('error', 'Stok barang habis.');
        }

        // contoh sederhana (nanti bisa ditambah tabel transaksi)
        $barang->stok -= 1;
        $barang->save();

        return redirect()->route('index')->with('success', 'Barang berhasil disewa!');
    }
}

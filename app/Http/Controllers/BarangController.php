<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    /**
     * Tampilkan semua barang.
     */
    public function index()
    {
        $barang = Barang::all();
        return view('admin.databarang', compact('barang'));
    }

    /**
     * Form tambah barang.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Simpan barang baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok_total' => 'required|integer|min:0',
            'stok_tersedia' => 'nullable|integer|min:0|max:' . $request->stok_total,
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['nama', 'harga', 'stok_total', 'stok_tersedia', 'deskripsi']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('gambar_barang', 'public');
        }

        Barang::create($data);

        return redirect('/barang')->with('success', 'Barang berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail barang.
     */
    public function show($id)
{
    // ❌ jangan pakai ->get() atau ->all()
    // ✅ ini akan ambil 1 data saja
    $barang = Barang::findOrFail($id);

    return view('admin.products.show', compact('barang'));
}



    /**
     * Form edit barang.
     */
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('admin.products.edit-barang', compact('barang'));
    }

    /**
     * Update barang.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok_total' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0|lte:stok_total',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $barang = Barang::findOrFail($id);

        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->stok_total = $request->stok_total;
        $barang->deskripsi = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
                Storage::disk('public')->delete($barang->gambar);
            }
            $barang->gambar = $request->file('gambar')->store('gambar_barang', 'public');
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    /**
     * Hapus barang.
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->gambar && Storage::disk('public')->exists($barang->gambar)) {
            Storage::disk('public')->delete($barang->gambar);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }

    public function detail($id)
{
    $barang = Barang::findOrFail($id);
    return view('pages.detail', compact('barang'));
}

}

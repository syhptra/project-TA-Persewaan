@extends('layouts.app')
@section('title', 'Tambah Barang')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-success bg-gradient text-white rounded-top-4">
          <h4 class="mb-0 fw-semibold">➕ Tambah Barang Baru</h4>
        </div>

        <div class="card-body p-4">

          {{-- Pesan sukses --}}
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              ✅ {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          {{-- Pesan error validasi --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nama Barang --}}
            <div class="mb-3">
              <label for="nama" class="form-label fw-semibold">Nama Barang</label>
              <input type="text" name="nama" id="nama"
                     class="form-control form-control-lg shadow-sm"
                     placeholder="Masukkan nama barang..." required>
            </div>

            {{-- Harga --}}
            <div class="mb-3">
              <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
              <input type="number" name="harga" id="harga"
                     class="form-control form-control-lg shadow-sm"
                     placeholder="Contoh: 75000" required>
            </div>

            {{-- Stok Total --}}
            <div class="mb-3">
              <label for="stok_total" class="form-label fw-semibold">Stok Total</label>
              <input type="number" name="stok_total" id="stok_total"
                     class="form-control form-control-lg shadow-sm"
                     placeholder="Jumlah keseluruhan barang..." required>
            </div>

            {{-- Stok Tersedia --}}
            <div class="mb-3">
              <label for="stok_tersedia" class="form-label fw-semibold">Stok Tersedia</label>
              <input type="number" name="stok_tersedia" id="stok_tersedia"
                     class="form-control form-control-lg shadow-sm"
                     placeholder="Jumlah barang yang bisa disewa..." required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
              <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
              <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="form-control shadow-sm"
                        placeholder="Tuliskan deskripsi barang..."></textarea>
            </div>

            {{-- Gambar --}}
            <div class="mb-4">
              <label for="gambar" class="form-label fw-semibold">Gambar Barang</label>
              <div class="input-group shadow-sm">
                <span class="input-group-text bg-light">🖼️</span>
                <input type="file" name="gambar" id="gambar" class="form-control form-control-lg">
              </div>
              <small class="text-muted fst-italic">Format: jpg, jpeg, png (maks. 2MB)</small>
            </div>

            <div class="d-flex justify-content-between">
              <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary px-4">← Kembali</a>
              <button type="submit" class="btn btn-success text-white px-4 shadow">💾 Simpan Barang</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection

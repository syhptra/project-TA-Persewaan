@extends('layouts.app')
@section('title', 'Edit Barang')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">

      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-warning bg-gradient text-white rounded-top-4">
          <h4 class="mb-0 fw-semibold">✏️ Edit Barang</h4>
        </div>

        <div class="card-body p-4">

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

          <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-3">
              <label for="nama" class="form-label fw-semibold">Nama Barang</label>
              <input type="text" name="nama" id="nama"
                     class="form-control form-control-lg shadow-sm"
                     value="{{ $barang->nama }}" required>
            </div>

            {{-- Harga --}}
            <div class="mb-3">
              <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
              <input type="number" name="harga" id="harga"
                     class="form-control form-control-lg shadow-sm"
                     value="{{ $barang->harga }}" required>
            </div>

            {{-- Stok Total --}}
            <div class="mb-3">
              <label for="stok_total" class="form-label fw-semibold">Stok Total</label>
              <input type="number" name="stok_total" id="stok_total"
                     class="form-control form-control-lg shadow-sm"
                     value="{{ $barang->stok_total }}" required>
          

            {{-- Deskripsi --}}
            <div class="mb-3">
              <label for="deskripsi" class="form-label fw-semibold">Deskripsi</label>
              <textarea name="deskripsi" id="deskripsi" rows="4"
                        class="form-control shadow-sm">{{ $barang->deskripsi }}</textarea>
            </div>

            {{-- Gambar --}}
            <div class="mb-4">
              <label for="gambar" class="form-label fw-semibold">Gambar Barang</label>
              <div class="d-flex align-items-center gap-3">
                @if($barang->gambar)
                  <div class="position-relative">
                    <img src="{{ asset('storage/' . $barang->gambar) }}" alt="Gambar Barang"
                         class="rounded shadow-sm border" width="150" height="150" style="object-fit: cover;">
                    <span class="badge bg-secondary position-absolute top-0 start-0 m-2">Preview</span>
                  </div>
                @endif
                <div class="flex-grow-1">
                  <input type="file" name="gambar" id="gambar" class="form-control form-control-lg shadow-sm">
                </div>
              </div>
              <small class="text-muted fst-italic">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>

            <div class="d-flex justify-content-between">
              <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary px-4">← Kembali</a>
              <button type="submit" class="btn btn-warning text-white px-4 shadow">💾 Simpan Perubahan</button>
            </div>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection

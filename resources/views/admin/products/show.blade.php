@extends('layouts.app')
@section('title', 'Detail Barang')

@section('content')
<div class="container py-5">
  <div class="card border-0 shadow-lg rounded-4 overflow-hidden p-4 glass-card">
    <div class="row align-items-center g-4">

      {{-- Gambar Barang --}}
      <div class="col-md-5 text-center">
        @if($barang->gambar)
        <img src="{{ asset('storage/' . $barang->gambar) }}"
          class="img-fluid rounded-4 shadow-sm"
          style="max-height: 350px; object-fit: cover;">
        @else
        <img src="https://via.placeholder.com/400x300?text=No+Image"
          class="img-fluid rounded-4 shadow-sm"
          alt="No Image">
        @endif
      </div>

      {{-- Detail Barang --}}
      <div class="col-md-7">
        <h3 class="fw-bold text-dark mb-3">{{ $barang->nama }}</h3>

        <div class="mb-2">
          <span class="badge bg-success fs-6 px-3 py-2 shadow-sm">
            💰 Rp {{ number_format($barang->harga, 0, ',', '.') }}
          </span>
        </div>

        <p class="mt-3 text-secondary">
          {{ $barang->deskripsi ?? 'Tidak ada deskripsi untuk barang ini.' }}
        </p>

        {{-- Informasi stok --}}
        <div class="mt-4">
          <h6 class="fw-semibold text-dark mb-2">📦 Status Stok:</h6>

          @if($barang->stok_tersedia > 0)
          <div class="alert alert-success d-flex align-items-center gap-2 py-2 mb-0" role="alert">
            ✅ Ready Stock — <strong>{{ $barang->stok_tersedia }}</strong> dari total {{ $barang->stok_total }} barang
          </div>
          @else
          <div class="alert alert-danger d-flex align-items-center gap-2 py-2 mb-0" role="alert">
            ❌ Stok Habis
          </div>
          @endif
        </div>

        <div class="mt-5">
          <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
            ⬅️ Kembali
          </a>
          <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-outline-warning rounded-pill px-4 py-2 ms-2">
            ✏️ Edit Barang
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .glass-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(8px);
  }
</style>
@endsection
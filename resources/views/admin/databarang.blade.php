@extends('layouts.app')
@section('title', 'Detail Barang')

@section('content')
<div class="container py-5">
  <h2 class="fw-bold mb-4 text-center">📦 Daftar Barang</h2>

  <div class="row g-4">
    @forelse ($barang as $item)
    <div class="col-md-4">
      <div class="card shadow-lg border-0 rounded-4 overflow-hidden h-100">

        {{-- Gambar Barang --}}
        @if(!empty($item->gambar))
        <img src="{{ asset('storage/' . $item->gambar) }}"
          class="card-img-top"
          alt="{{ $item->nama }}"
          style="height: 220px; object-fit: cover;">
        @else
        <img src="https://via.placeholder.com/400x300?text=No+Image"
          class="card-img-top"
          alt="No Image"
          style="height: 220px; object-fit: cover;">
        @endif

        <div class="card-body d-flex flex-column">

          {{-- Nama & Harga --}}
          <h5 class="fw-bold text-dark mb-2">{{ $item->nama }}</h5>
          <p class="text-muted mb-3">💰 Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</p>

          {{-- Status Stok --}}
          @if(empty($item->stok_total) || $item->stok_total == 0)
          <!-- Aksi atau tampilan jika stok kosong -->
          

          <div class="alert alert-warning py-2 mb-3" role="alert">
            ⚠️ Stok belum ditambahkan
          </div>
          @elseif($item->stok_tersedia > 0)
          <div class="alert alert-success py-2 mb-3" role="alert">
            ✅ Ready Stock: {{ $item->stok_total }}
          </div>
          @else
          <div class="alert alert-danger py-2 mb-3" role="alert">
            ❌ Stok Habis
          </div>
          @endif

          {{-- Tombol Aksi --}}
          <div class="mt-auto d-flex justify-content-between">
            <a href="{{ route('barang.show', $item->id) }}" class="btn btn-info btn-sm px-3">Detail</a>
            <a href="{{ route('barang.edit', $item->id) }}" class="btn btn-warning btn-sm px-3">Edit</a>
            <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus {{ $item->nama }}?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm px-3">Hapus</button>
            </form>
          </div>

        </div>
      </div>
    </div>
    @empty
    <div class="col-12 text-center">
      <div class="alert alert-info">Belum ada barang yang ditambahkan.</div>
    </div>
    @endforelse
  </div>

  {{-- Tombol Tambah Barang --}}
  <div class="mt-5 text-center">
    <a href="{{ route('barang.create') }}" class="btn btn-success rounded-pill px-4 py-2">
      ➕ Tambah Barang
    </a>
  </div>
</div>

{{-- Style tambahan --}}
<style>
  .glass-card {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(8px);
  }

  .btn {
    transition: all 0.2s ease-in-out;
  }

  .btn:hover {
    transform: translateY(-2px);
  }
</style>
@endsection
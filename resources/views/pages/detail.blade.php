@extends('layouts.index')
@section('title', 'Detail Barang')

@section('content')
<div class="container mt-4">
  <div class="card bg-dark border-success text-white">
    <div class="row g-0">
      <div class="col-md-5">
        @if($barang->gambar && file_exists(storage_path('app/public/'.$barang->gambar)))
        <img src="{{ asset('storage/'.$barang->gambar) }}" class="img-fluid rounded-start" alt="{{ $barang->nama }}">
        @else
        <img src="https://via.placeholder.com/400x300?text=No+Image" class="img-fluid rounded-start" alt="No Image">
        @endif
      </div>
      <div class="col-md-7 p-4">
        <h4 class="text-success">{{ $barang->nama }}</h4>
        <p>{{ $barang->deskripsi ?? '-' }}</p>
        <p><strong>Harga per Hari:</strong> Rp {{ number_format($barang->harga,0,',','.') }}</p>
        <p><strong>Stok:</strong> {{ $barang->stok_total }}</p>

        <div class="d-flex gap-2 mt-3">
          <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>

          @if(auth()->check())
          <button class="btn btn-success px-4" data-bs-toggle="modal" data-bs-target="#cartModal" {{ $barang->stok_total <= 0 ? 'disabled' : '' }}>
            Masukkan ke Cart
          </button>
          @else
          <a href="{{ route('auth.login') }}" class="btn btn-success px-4">Login untuk Sewa</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Cart -->
<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('cart.store', $barang->id) }}">
      @csrf
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="cartModalLabel">Pesan Barang: {{ $barang->nama }}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label>Kuantitas</label>
            <input type="number" name="qty" id="qty" class="form-control" min="1" max="{{ $barang->stok_total }}" value="1" required>
          </div>
          <div class="mb-3">
            <label>Jumlah Hari Sewa</label>
            <input type="number" name="hari" id="hari" class="form-control" min="1" value="1" required>
          </div>

          <hr class="bg-white">
          <p><strong>Harga per Hari:</strong> Rp {{ number_format($barang->harga,0,',','.') }}</p>
          <p><strong>Total Harga:</strong> <span id="totalHarga">Rp {{ number_format($barang->harga,0,',','.') }}</span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-success">Tambah ke Cart 🛒</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const qtyInput = document.getElementById('qty');
  const hariInput = document.getElementById('hari');
  const totalHargaEl = document.getElementById('totalHarga');
  const hargaPerHari = Number("{{ $barang->harga }}");

  function updateTotal() {
    const qty = parseInt(qtyInput.value) || 1;
    const hari = parseInt(hariInput.value) || 1;
    const total = qty * hari * hargaPerHari;
    totalHargaEl.innerText = 'Rp ' + total.toLocaleString('id-ID');
  }

  qtyInput.addEventListener('input', updateTotal);
  hariInput.addEventListener('input', updateTotal);
});
</script>
@endsection

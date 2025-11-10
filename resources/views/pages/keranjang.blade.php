@extends('layouts.index')
@section('title', 'Keranjang Sewa')

@section('content')
<div class="container mt-4">
  <h3 class="text-success mb-4">🛒 Keranjang Sewa</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(count($keranjang) > 0)
    <form method="POST" action="{{ route('keranjang.update') }}">
      @csrf
      <table class="table table-dark table-striped align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Produk</th>
            <th>Harga/Hari</th>
            <th>Kuantitas</th>
            <th>Jumlah Hari</th>
            <th>Total Harga</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($keranjang as $id => $item)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item['nama'] }}</td>
            <td>Rp {{ number_format($item['harga'],0,',','.') }}</td>
            <td>
              <input type="number" name="qty[{{ $id }}]" value="{{ $item['qty'] }}" min="1" class="form-control">
            </td>
            <td>
              <input type="number" name="hari[{{ $id }}]" value="{{ $item['hari'] }}" min="1" class="form-control">
            </td>
            <td>Rp {{ number_format($item['total'],0,',','.') }}</td>
            <td>
              <form method="POST" action="{{ route('keranjang.hapus') }}">
                @csrf
                <input type="hidden" name="barang_id" value="{{ $id }}">
                <button class="btn btn-danger btn-sm">Hapus</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="d-flex justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Update Keranjang</button>
      </div>
    </form>
  @else
    <p>Keranjang kosong.</p>
  @endif
</div>
@endsection

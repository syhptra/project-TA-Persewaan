@extends('layouts.index')
@section('title','Keranjang Anda')

@section('content')
<div class="container mt-4">
    <h3 class="text-success mb-3 fw-bold">Keranjang Anda</h3>

    @if($carts->count() > 0)
    <div class="table-responsive">
        <table class="table table-dark table-striped text-white align-middle">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Harga / Hari</th>
                    <th>Kuantitas</th>
                    <th>Jumlah Hari</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                <tr>
                    <td>{{ $cart->barang->nama }}</td>
                    <td>Rp {{ number_format($cart->barang->harga,0,',','.') }}</td>
                    <td>{{ $cart->qty }}</td>
                    <td>{{ $cart->hari }}</td>
                    <td>Rp {{ number_format($cart->total,0,',','.') }}</td>
                    <td>
                        <form action="{{ route('cart.destroy',$cart->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5 class="fw-bold">Total Keseluruhan: Rp {{ number_format($totalHarga,0,',','.') }}</h5>
            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-secondary px-4">Kembali</a>
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success px-4">Pesan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
    @else
    <p>Keranjang kosong 😔</p>
    <a href="{{ route('index') }}" class="btn btn-success mt-3">Kembali ke Beranda</a>
    @endif
</div>
@endsection

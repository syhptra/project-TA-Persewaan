@extends('layouts.index')
@section('title','Checkout')

@section('content')
<div class="container mt-4">
    <h3 class="text-success mb-3">Checkout</h3>

    <div class="table-responsive">
        <table class="table table-dark table-striped text-white">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Harga / Hari</th>
                    <th>Kuantitas</th>
                    <th>Jumlah Hari</th>
                    <th>Total</th>
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
                </tr>
                @endforeach
            </tbody>
        </table>

        <h5 class="fw-bold">Total Keseluruhan: Rp {{ number_format($totalHarga,0,',','.') }}</h5>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success mt-3 px-4">Pesan Sekarang</button>
        </form>
    </div>
</div>
@endsection

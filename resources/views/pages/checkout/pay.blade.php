@extends('layouts.index')
@section('title','Pembayaran')

@section('content')
<div class="container mt-4">
    <h3 class="text-success mb-3">Pembayaran</h3>

    <p><strong>Kode Pesanan:</strong> {{ $order->kode_unik }}</p>
    <p><strong>Total Bayar:</strong> Rp {{ number_format($order->total_harga,0,',','.') }}</p>
    <p><strong>Nomor Rekening:</strong> 1234567890 (Contoh)</p>

    @if(!$order->bukti_transfer)
    <form action="{{ route('checkout.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="bukti_transfer" class="form-label">Upload Bukti Transfer</label>
            <input type="file" name="bukti_transfer" id="bukti_transfer" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Upload & Bayar</button>
    </form>
    @else
    <p class="text-success">Bukti transfer sudah diupload ✅</p>
    @endif
</div>
@endsection

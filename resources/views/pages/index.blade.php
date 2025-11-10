@extends('layouts.index')
@section('title', 'Beranda')

@section('content')
<div class="container mt-4">
    {{-- Header dengan tombol keranjang --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="text-success mb-0 fw-bold">🎒 Daftar Alat Camping</h3>

        @auth
        @php
            $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
        @endphp
        <a href="{{ route('cart.index') }}" class="btn btn-success position-relative">
            🛒 Keranjang
            @if($cartCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $cartCount }}
            </span>
            @endif
        </a>
        @else
        <a href="{{ route('login') }}" class="btn btn-success">
            🛒 Login untuk Lihat Keranjang
        </a>
        @endauth
    </div>

    {{-- Alert success --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Daftar barang --}}
    <div class="row">
        @foreach($barang as $item)
        <div class="col-md-3 mb-4">
            <div class="card bg-dark border-success text-white h-100">
                @if($item->gambar)
                    <img src="{{ asset('storage/'.$item->gambar) }}" class="card-img-top" style="height:180px;object-fit:cover;">
                @else
                    <img src="https://via.placeholder.com/400x300?text=No+Image" class="card-img-top" style="height:180px;object-fit:cover;">
                @endif
                <div class="card-body">
                    <h6 class="fw-bold text-success">{{ $item->nama }}</h6>
                    <p class="small">Rp {{ number_format($item->harga,0,',','.') }}</p>
                </div>
                <div class="card-footer text-center bg-transparent">
                    <a href="{{ route('barang.show', $item->id) }}" class="btn btn-success btn-sm px-3">Lihat Detail</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

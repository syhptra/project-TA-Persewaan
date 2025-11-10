@extends('layouts.index')
@section('title', 'CampRent - Persewaan Alat Camping')

@section('content')
<div class="container text-center mt-5 text-white">
    <h1 class="fw-bold text-success mb-3">🏕️ CampRent</h1>
    <p class="lead">Sewa alat camping dengan mudah dan cepat.</p>
    <a href="{{ route('login') }}" class="btn btn-success mt-3 px-4">Masuk untuk Melihat Barang</a>
</div>
@endsection

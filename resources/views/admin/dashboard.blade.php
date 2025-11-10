@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
  <div class="text-center mb-4">
    <h2 class="text-success fw-semibold">📊 Statistik Persewaan</h2>
    <p class=" text-white">Selamat datang di pusat data CampRent! 🌿</p>
  </div>

  <div class="row g-3 ">
    <div class="col-md-3">
      <div class="card bg-success bg-opacity-25 border-success">
        <div class="card-body text-center text-white">
          <h6>Total Alat</h6>
          <h3 >{{ $totalAlat }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-info bg-opacity-25 border-info">
        <div class="card-body text-center text-white">
          <h6>Penyewaan Aktif</h6>
          <h3>35</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-warning bg-opacity-25 border-warning">
        <div class="card-body text-center text-white">
          <h6>Total Users</h6>
          <h3>{{ $totalPelanggan }}</h3>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-danger bg-opacity-25 border-danger">
        <div class="card-body text-center text-white">
          <h6>Pendapatan Bulan Ini</h6>
          <h3>Rp 8.540.000</h3>
        </div>
      </div>
    </div>
  </div>
@endsection

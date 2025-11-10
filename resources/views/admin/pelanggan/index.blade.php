@extends('layouts.app')
@section('title', 'Data Users')

@section('content')
<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-semibold text-primary">👥 Data Users</h3>
  </div>

  @if($pelanggan->isEmpty())
    <div class="text-center py-5">
      <img src="https://cdn-icons-png.flaticon.com/512/4076/4076508.png" width="100" alt="Empty">
      <h5 class="text-muted mt-3">Belum ada pelanggan terdaftar.</h5>
    </div>
  @else
    <div class="table-responsive shadow-sm rounded-4 bg-white p-3">
      <table class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Role</th>
            <th>Tanggal Daftar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pelanggan as $index => $user)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->alamat ?? '-' }}</td>
              <td>{{ $user->no_hp ?? '-' }}</td>
              <td>
                @if($user->role === 'admin')
                  <span class="badge bg-danger">Admin</span>
                @else
                  <span class="badge bg-secondary">User</span>
                @endif
              </td>
              <td>{{ $user->created_at->format('d M Y') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>
@endsection

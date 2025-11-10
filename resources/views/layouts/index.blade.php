<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>@yield('title')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS Bundle (termasuk Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    body {
      background-color: #111;
      color: white;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark border-bottom border-success">
    <div class="container">
      <a href="{{ route('home') }}" class="navbar-brand text-success fw-bold">🏕️ CampRent</a>
      <div>
        @auth
        {{-- Tombol Beranda (hanya tampil untuk semua user yang login) --}}

        {{-- Tombol Dashboard hanya muncul kalau role user = admin --}}
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('dashboard') }}" class="btn btn-outline-success btn-sm me-2">Dashboard</a>
        @endif

        {{-- Tombol Logout --}}
        <form action="{{ route('auth.logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-outline-success btn-sm">Logout</button>
        </form>
        @else
        {{-- Tombol login muncul kalau belum login --}}
        <a href="{{ route('auth.login') }}" class="btn btn-success btn-sm">Login</a>
        @endauth
      </div>
    </div>
  </nav>

  <main>
    @yield('content')
  </main>
</body>

</html>
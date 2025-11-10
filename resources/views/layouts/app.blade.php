<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | CampRent</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #0f241d;
      color: #e2e8f0;
      font-family: 'Poppins', sans-serif;
    }

    .sidebar {
      min-height: 100vh;
      background: #102a1e;
      padding: 20px;
      position: fixed;
      width: 230px;
    }

    .sidebar h5 {
      color: #9ae6b4;
      margin-bottom: 20px;
      font-weight: 600;
    }

    .sidebar a {
      display: flex;
      align-items: center;
      gap: 10px;
      color: #93c5fd;
      text-decoration: none;
      margin-bottom: 10px;
      padding: 10px;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background: #198754;
      color: #fff;
    }

    .content {
      margin-left: 250px;
      padding: 30px;
    }

    .navbar {
      background: #1b4332;
      padding: 10px 20px;
      border-bottom: 1px solid #14532d;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h5>Navigasi</h5>
    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
      🏠 Dashboard
    </a>
      <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.foto') ? 'active' : 'false' }}">
        🏕️ Data Barang
      </a>

      <a href="{{ route('pelanggan.index') }}" class="nav-link">
        👥 Users
      </a>

      <a href="{{ route('index') }}" class="nav-link">
        👥 index
      </a>
  </div>

  <!-- Main Content -->
  <div class="content">
    <nav class="navbar navbar-dark d-flex justify-content-between align-items-center rounded shadow-sm mb-4">
      <span class="text-light fw-semibold">@yield('title')</span>

      <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button class="btn btn-outline-light btn-sm">Logout</button>
      </form>
    </nav>

    @yield('content')
  </div>
</body>

</html>
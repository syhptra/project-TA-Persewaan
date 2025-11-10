<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Akses Diblokir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #0d1117;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      text-align: center;
    }
    .card {
      background-color: #161b22;
      border: 1px solid #2ea043;
      border-radius: 10px;
      padding: 2rem;
      max-width: 420px;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1 class="text-danger fw-bold">🚫 Akses Diblokir</h1>
    <p class="mt-3 text-secondary">Hahahaaa halaman ini gabisa di masukin user rendahan sepertimu!</p>
    <a href="{{ route('home') }}" class="btn btn-success mt-3">Kembali ke Beranda</a>
  </div>
</body>
</html>

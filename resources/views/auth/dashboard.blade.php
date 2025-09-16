<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyApp</a>
    <div class="d-flex">
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-outline-light">Logout</button>
      </form>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-body">
            <h3>Welcome, {{ auth()->user()->name }} 🎉</h3>
            <p class="text-muted">You are now logged in to your dashboard.</p>
        </div>
    </div>
</div>

</body>
</html>

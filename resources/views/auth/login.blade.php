<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - MyApp</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<style>
  body {
    background: linear-gradient(135deg, #0d6efd 0%, #6f42c1 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .auth-card {
    width: 100%;
    max-width: 420px;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    padding: 2rem;
    animation: fadeIn 0.6s ease;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25);
  }
  .btn-primary {
    background-color: #0d6efd;
    border: none;
  }
  .btn-primary:hover {
    background-color: #0b5ed7;
  }
  .app-title {
    font-weight: 700;
    color: #0d6efd;
  }
  .cursor-pointer { cursor: pointer; }
</style>
</head>
<body>

<div class="auth-card">
  <div class="text-center mb-4">
    <i class="bx bx-lock-open bx-lg text-primary mb-2"></i>
    <h4 class="app-title mb-1">Login to MyApp</h4>
    <p class="text-muted">Welcome back! Please sign in.</p>
  </div>

  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  <form method="POST" action="{{ route('auth.login.post') }}">
    @csrf

    <div class="mb-3">
      <label for="email" class="form-label fw-semibold">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
      <label for="password" class="form-label fw-semibold">Password</label>
      <div class="input-group">
        <input type="password" class="form-control" id="password" name="password" required>
        <span class="input-group-text bg-white cursor-pointer" onclick="togglePassword()">
          <i class="bx bx-hide" id="toggleIcon"></i>
        </span>
      </div>
    </div>

    <button type="submit" class="btn btn-primary w-100 mt-3 py-2">Login</button>

    <p class="text-center mt-4 mb-0">
      <span class="text-muted">New here?</span>
      <a href="{{ route('auth.register') }}" class="text-decoration-none fw-semibold text-primary">Create an account</a>
    </p>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePassword() {
  const input = document.getElementById('password');
  const icon = document.getElementById('toggleIcon');
  if (input.type === 'password') {
    input.type = 'text';
    icon.classList.replace('bx-hide', 'bx-show');
  } else {
    input.type = 'password';
    icon.classList.replace('bx-show', 'bx-hide');
  }
}
</script>
</body>
</html>

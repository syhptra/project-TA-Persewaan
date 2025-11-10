<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Register - MyApp</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<style>
  body {
    background: linear-gradient(135deg, #6f42c1 0%, #0d6efd 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  .auth-card {
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    width: 100%;
    max-width: 460px;
    padding: 2rem;
    animation: fadeIn 0.6s ease;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
  }
  .app-title {
    color: #0d6efd;
    font-weight: 700;
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
  .cursor-pointer { cursor: pointer; }
</style>
</head>
<body>

<div class="auth-card">
  <div class="text-center mb-4">
    <i class="bx bx-user-plus bx-lg text-primary mb-2"></i>
    <h4 class="app-title mb-1">Create an Account</h4>
    <p class="text-muted">Adventure starts here 🚀</p>
  </div>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('auth.register.post') }}">
    @csrf

    <!-- Full Name -->
    <div class="mb-3">
      <label for="name" class="form-label fw-semibold">Full Name</label>
      <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter your full name" required>
    </div>

    <!-- Email -->
    <div class="mb-3">
      <label for="email" class="form-label fw-semibold">Email</label>
      <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required>
    </div>

    <!-- Password -->
    <div class="mb-3">
      <label for="password" class="form-label fw-semibold">Password</label>
      <div class="input-group">
        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        <span class="input-group-text bg-white cursor-pointer" onclick="togglePassword()">
          <i class="bx bx-hide" id="toggleIcon"></i>
        </span>
      </div>
    </div>

    <!-- Confirm Password -->
    <div class="mb-3">
      <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
    </div>

    <!-- Alamat -->
    <div class="mb-3">
      <label for="alamat" class="form-label fw-semibold">Alamat</label>
      <input type="text" id="alamat" name="alamat" class="form-control" value="{{ old('alamat') }}" placeholder="Enter your address">
    </div>

    <!-- No HP -->
    <div class="mb-3">
      <label for="no_hp" class="form-label fw-semibold">No HP</label>
      <input type="text" id="no_hp" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="Enter your phone number">
    </div>

    <button type="submit" class="btn btn-primary w-100 py-2">Sign Up</button>

    <p class="text-center mt-4 mb-0">
      <span class="text-muted">Already have an account?</span>
      <a href="{{ route('auth.login') }}" class="text-decoration-none fw-semibold text-primary">Login instead</a>
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

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Landing Page</title>

  <!-- Bootstrap CSS -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>

  <style>
    body {
      background-color: #FDFDFC;
      color: #1b1b18;
      min-height: 100vh;
      position: relative;
      padding: 2rem;
    }

    .auth-links {
      position: absolute;
      top: 1.5rem;
      right: 1.5rem;
    }

    .custom-btn {
      padding: 0.5rem 1.25rem;
      border-radius: 0.25rem;
      font-size: 0.9rem;
      border: 1px solid rgba(25, 20, 0, 0.2);
      color: #1b1b18;
      background-color: transparent;
      transition: border 0.2s;
    }

    .custom-btn:hover {
      border-color: rgba(25, 20, 0, 0.4);
    }

    .main-content {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100%;
      text-align: center;
      margin-top: 5rem;
    }
  </style>
</head>
<body>


     <!-- Header Auth Links -->
  <div class="auth-links d-flex gap-3">

    <a href="{{ route('login') }}" class="custom-btn text-decoration-none">Log in</a>

    <a href="{{ route('register') }}" class="custom-btn text-decoration-none">Register</a>

  </div>

  <!-- Main Centered Content -->
  <div class="main-content">
    <h1 class="display-5 fw-bold">Login System</h1>
    <p class="lead">Welcome to your application landing page.</p>
  </div>

  <!-- Bootstrap JS -->
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>




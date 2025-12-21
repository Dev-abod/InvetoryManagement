<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login - Inventory Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f6f6f8;
    }

    .login-card {
      border-radius: 1rem;
    }

    .brand-icon {
      width: 56px;
      height: 56px;
      background: #135bec;
      color: #fff;
      border-radius: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 10px 20px rgba(19, 91, 236, 0.3);
    }

    .form-control {
      background: #f8f9fc;
    }
  </style>
</head>

<body class="d-flex align-items-center min-vh-100">

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 col-lg-5">

        <!-- Brand -->
        <div class="text-center mb-4">
          <div class="brand-icon mx-auto mb-3">
            <span class="material-symbols-outlined fs-3">inventory_2</span>
          </div>
          <h1 class="fw-bold">Inventory System</h1>
        </div>

        <!-- Login Card -->
        <div class="card login-card shadow-sm border-0 p-4">
          <div class="card-body">

            <h5 class="fw-bold mb-1">Sign in to your account</h5>
            <p class="text-muted mb-4">Enter your details to access the dashboard.</p>

            {{-- رسالة الخطأ --}}
            @if ($errors->has('login_error'))
            <div class="modal fade show"
              id="loginErrorModal"
              tabindex="-1"
              aria-modal="true"
              role="dialog"
              style="display: block; background: rgba(0,0,0,.5);">

              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">

                  <div class="modal-header">
                    <h5 class="modal-title text-danger">Login Failed</h5>
                  </div>

                  <div class="modal-body text-center">
                    <p class="mb-0">
                      {{ $errors->first('login_error') }}
                    </p>
                  </div>
                  <div class="modal-footer justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                      OK
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endif



            <form method="POST" action="{{ route('login.submit') }}">
              @csrf

              <!-- Username -->
              <div class="mb-3">
                <label class="form-label">Email or Username</label>
                <div class="position-relative">
                  <input
                    type="text"
                    name="username"
                    class="form-control py-3 pe-5"
                    required>
                  <span class="material-symbols-outlined position-absolute top-50 end-0 translate-middle-y me-3 text-muted">
                    person
                  </span>
                </div>
              </div>

              <!-- Password -->
              <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="position-relative">
                  <input
                    type="password"
                    name="password"
                    class="form-control py-3 pe-5"
                    required>
                  <span class="material-symbols-outlined position-absolute top-50 end-0 translate-middle-y me-3 text-muted">
                    lock
                  </span>
                </div>
              </div>

              <!-- Button -->
              <button type="submit" class="btn btn-primary w-100 py-3 fw-semibold">
                Sign in
              </button>

            </form>

          </div>
        </div>

        <!-- Footer -->
        <p class="text-center text-muted small mt-4">
          © 2024 Inventory Management System. All rights reserved.
        </p>

      </div>
    </div>
  </div>

</body>

</html>
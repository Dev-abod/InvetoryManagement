<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>IMS Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f6f6f8;
    }

 .sidebar {
  width: 280px;
  background: linear-gradient(to bottom, #0f172a, #1e3a8a);
  color: #cbd5f5;
}


    .sidebar a {
      color: #94a3b8;
      text-decoration: none;
    }

    .sidebar a.active,
    .sidebar a:hover {
      background: #ffffff;
      color: #135bec;
      border-radius: .5rem;
    }

    .brand-box {
      width: 32px;
      height: 32px;
      background: #135bec;
      border-radius: .5rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .icon-circle {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: #f1f5f9;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .card-hover:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, .1);
    }
  </style>
</head>

<body class="d-flex vh-100 overflow-hidden">

  <!-- Sidebar -->
 <!-- {{-- استدعاء السايدبار --}} -->
    @include('layouts.sidebar')



  <!-- Main -->
  <div class="flex-grow-1 d-flex flex-column">

    <!-- Header -->
    <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
      <div class="fw-semibold text-secondary">
        Home / <span class="text-dark">Dashboard</span>
      </div>

      <div class="d-flex align-items-center gap-3">
        <input class="form-control form-control-sm d-none d-md-block" placeholder="Search..." style="width:200px">
        <button class="btn btn-light rounded-circle">
          <span class="material-symbols-outlined">notifications</span>
        </button>
        <button class="btn btn-light rounded-circle">
          <span class="material-symbols-outlined">settings</span>
        </button>
        <div class="text-end d-none d-md-block">
          <div class="fw-bold">Admin User</div>
          <small class="text-muted">Super Admin</small>
        </div>
      </div>
    </header>

    <!-- Content -->
    <main class="p-4 overflow-auto">
      <h4 class="fw-bold mb-4">Quick Navigation</h4>

      <div class="row g-4">
        <!-- Card -->
        <div class="col-md-6 col-lg-3">
          <div class="card card-hover h-100 text-center p-4 border-0 shadow-sm">
            <div class="icon-circle mx-auto mb-3">
              <span class="material-symbols-outlined fs-2">inventory_2</span>
            </div>
            <h5 class="fw-bold">Product Management</h5>
            <p class="text-muted small">Add, edit, and track inventory items.</p>
            <a href="{{ route('ProductManagement') }}"
              class="btn btn-outline-primary rounded-pill mt-auto">
              Product Management
            </a>

          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card card-hover h-100 text-center p-4 border-0 shadow-sm">
            <div class="icon-circle mx-auto mb-3">
              <span class="material-symbols-outlined fs-2">handshake</span>
            </div>
            <h5 class="fw-bold">Partners</h5>
            <p class="text-muted small">Manage suppliers and distributors.</p>

            <a href="{{ route('SelectorParents') }}"
              class="btn btn-outline-primary rounded-pill mt-auto">
              View Partners
            </a>

          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card card-hover h-100 text-center p-4 border-0 shadow-sm">
            <div class="icon-circle mx-auto mb-3">
              <span class="material-symbols-outlined fs-2">receipt_long</span>
            </div>
            <h5 class="fw-bold">Transactions</h5>
            <p class="text-muted small">Process stock movements.</p>
              <a href="{{ route('TranscationSelector') }}"
              class="btn btn-outline-primary rounded-pill mt-auto">
             View Transactions
            </a>  
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card card-hover h-100 text-center p-4 border-0 shadow-sm">
            <div class="icon-circle mx-auto mb-3">
              <span class="material-symbols-outlined fs-2">bar_chart</span>
            </div>
            <h5 class="fw-bold">Reports</h5>
            <p class="text-muted small">Generate reports and insights.</p>
            <button class="btn btn-outline-primary rounded-pill mt-auto">
              Open Reports
            </button>
          </div>
        </div>
      </div>
    </main>

  </div>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
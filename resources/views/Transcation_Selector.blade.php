<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Transaction Management - Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f6f6f8;
    }

    /* Sidebar */
    .sidebar {
      width: 280px;
      background: linear-gradient(to bottom, #0f172a, #1e3a8a);
      color: #cbd5f5;
    }

    .sidebar a {
      color: #cbd5f5;
      text-decoration: none;
    }

    .sidebar a.active,
    .sidebar a:hover {
      background: #fff;
      color: #135bec;
      border-radius: .75rem;
    }

    /* Cards */
    .action-card {
      transition: all .3s ease;
    }

    .action-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, .15);
    }

    .icon-box {
      width: 56px;
      height: 56px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
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
    <header class="bg-white border-bottom px-4 py-3">
      <nav class="small text-muted">
        Home / <strong class="text-primary">Transaction Management</strong>
      </nav>
    </header>
    
    <!-- Content -->
    <main class="p-4 overflow-auto">
      <div class="d-flex flex-column flex-md-row justify-content-between gap-4 mb-4">
        <div>
          <h2 class="fw-bold">Transaction Management</h2>
          <p class="text-muted">Select an operation type to proceed.</p>
        </div>

        <div class="position-relative" style="max-width: 320px;">
          <span class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
            search
          </span>
          <input class="form-control ps-5 py-2" placeholder="Search transaction types">
        </div>
      </div>

      <!-- Action Cards -->
      <div class="row g-4 mb-5">
        <div class="col-md-6 col-lg-3">
          <div class="card action-card h-100 p-4">
            <div class="icon-box bg-warning bg-opacity-10 text-warning mb-3">
              <span class="material-symbols-outlined fs-3">assignment_return</span>
            </div>
            <h5 class="fw-bold">Exchange Return</h5>
            <p class="text-muted small">Process returned exchanged items.</p>
            <a href="{{ route('operations.index', 'return_out') }}" class="fw-semibold text-primary mt-auto">Start Process</a>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card action-card h-100 p-4">
            <div class="icon-box bg-danger bg-opacity-10 text-danger mb-3">
              <span class="material-symbols-outlined fs-3">local_shipping</span>
            </div>
            <h5 class="fw-bold">Supply Return</h5>
            <p class="text-muted small">Return inventory to supplier.</p>
            <a href="{{ route('operations.index', 'return_in') }}" class="fw-semibold text-primary mt-auto">Start Process</a>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card action-card h-100 p-4">
            <div class="icon-box bg-primary bg-opacity-10 text-primary mb-3">
              <span class="material-symbols-outlined fs-3">swap_horiz</span>
            </div>
            <h5 class="fw-bold">Exchange</h5>
            <p class="text-muted small">Handle customer product exchange.</p>
            <a href="{{ route('operations.index', 'out') }}" class="fw-semibold text-primary mt-auto">Start Process</a>
          </div>
        </div>

        <div class="col-md-6 col-lg-3">
          <div class="card action-card h-100 p-4">
            <div class="icon-box bg-success bg-opacity-10 text-success mb-3">
              <span class="material-symbols-outlined fs-3">inventory</span>
            </div>
            <h5 class="fw-bold">Supply</h5>
            <p class="text-muted small">Log new inventory supply.</p>
            <a href="{{ route('operations.index', 'in') }}" class="fw-semibold text-primary mt-auto">Start Process</a>
          </div>
        </div>
      </div>

     

    </main>
  </div>

</body>

</html>
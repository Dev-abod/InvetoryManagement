<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Supplier Management - Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
      width: 260px;
      background: linear-gradient(to bottom, #0f172a, #1e3a8a);
      color: #cbd5f5;
    }
    .sidebar a {
      color: #cbd5f5;
      text-decoration: none;
    }
    .sidebar a.active,
    .sidebar a:hover {
      background: #ffffff;
      color: #135bec;
      border-radius: .5rem;
    }

    .brand-icon {
      width: 40px;
      height: 40px;
      background: rgba(255,255,255,.15);
      border-radius: .5rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .icon-input {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #6c757d;
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
         <div class="text-secondary small">

      Home / <strong class="text-dark">Partners</strong>
    <div>
    <div class="d-flex gap-2">
      <button class="btn btn-light rounded-circle">
        <span class="material-symbols-outlined">notifications</span>
      </button>
      <button class="btn btn-light rounded-circle">
        <span class="material-symbols-outlined">settings</span>
      </button>
    </div>
  </header>

  <!-- Content -->
  <main class="p-4 overflow-auto">

    <!-- Search -->
    <div class="card mb-4">
      <div class="card-body d-flex flex-column flex-md-row gap-3 align-items-end">
        <div class="flex-grow-1 position-relative">
          <label class="form-label fw-semibold">Search Suppliers</label>
          <span class="material-symbols-outlined icon-input">search</span>
          <input type="text" class="form-control ps-5" placeholder="Enter Supplier ID or Name">
        </div>
        <button class="btn btn-primary px-4">Show</button>
      </div>
    </div>

    <div class="row g-4">

      <!-- Table -->
      <div class="col-lg-8">
        <div class="card h-100">
          <div class="card-header d-flex justify-content-between align-items-center">
            <strong>Supplier List</strong>
            <div>
              <button class="btn btn-sm btn-light">
                <span class="material-symbols-outlined">filter_list</span>
              </button>
              <button class="btn btn-sm btn-light">
                <span class="material-symbols-outlined">download</span>
              </button>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
              <thead class="table-light">
                <tr>
                  <th>Supplier ID</th>
                  <th>Supplier Name</th>
                  <th class="text-end">Phone</th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-primary">
                  <td>S005</td>
                  <td><strong>Umbrella Corp</strong></td>
                  <td class="text-end">555-0105</td>
                </tr>
                <tr>
                  <td>S001</td>
                  <td>Acme Corp</td>
                  <td class="text-end">555-0101</td>
                </tr>
                <tr>
                  <td>S002</td>
                  <td>Globex Inc</td>
                  <td class="text-end">555-0102</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="card-footer d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing 1–7 of 48</small>
            <nav>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link">Prev</a></li>
                <li class="page-item active"><a class="page-link">1</a></li>
                <li class="page-item"><a class="page-link">2</a></li>
                <li class="page-item"><a class="page-link">3</a></li>
                <li class="page-item"><a class="page-link">Next</a></li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

      <!-- Form -->
      <div class="col-lg-4">
        <div class="card sticky-top">
          <div class="card-header fw-bold">
            Manage Details
          </div>
          <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
              <small class="text-muted">Current Selection</small>
              <span class="badge bg-primary">ID: S005</span>
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Supplier Name</label>
              <span class="material-symbols-outlined icon-input">business</span>
              <input type="text" class="form-control ps-5" value="Umbrella Corp">
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Phone Number</label>
              <span class="material-symbols-outlined icon-input">call</span>
              <input type="text" class="form-control ps-5" value="555-0105">
            </div>

            <button class="btn btn-outline-secondary w-100 mb-3">
              <span class="material-symbols-outlined me-1">restart_alt</span>
              Clear to Add New
            </button>

            <button class="btn btn-primary w-100 mb-2">
              <span class="material-symbols-outlined me-1">add_circle</span>
              Add Supplier
            </button>

            <div class="d-flex gap-2 mb-3">
              <button class="btn btn-outline-secondary w-50">
                <span class="material-symbols-outlined me-1">edit</span>
                Edit
              </button>
              <button class="btn btn-outline-danger w-50">
                <span class="material-symbols-outlined me-1">delete</span>
                Delete
              </button>
            </div>

            <a href="#" class="d-block text-center text-primary fw-medium">
              Show All Suppliers →
            </a>

          </div>
        </div>
      </div>

    </div>

  </main>
</div>

</body>
</html>

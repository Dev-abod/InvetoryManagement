<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product Management - Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body { font-family: 'Inter', sans-serif; background:#f6f6f8; }
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
    .icon-badge {
      width:32px;height:32px;border-radius:6px;
      background:#e0ecff;color:#135bec;
      display:flex;align-items:center;justify-content:center;
      font-size:13px;font-weight:700;
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
  <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between">
        <div class="text-secondary small">

      Home / Product Management / <strong class="text-dark">Add Product</strong>
    <div>
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

    <div class="mb-4">
      <h3 class="fw-bold">Product Management</h3>
      <p class="text-muted">Create, update and manage your inventory items.</p>

       <div class="text-end mb-3" >
        <a href="{{ uri('/product-management') }}" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left"></i> Back to Product Management
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card mb-4">
      <div class="card-header fw-bold">Product Details</div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Barcode / SKU</label>
            <input class="form-control" placeholder="Scan or enter barcode">
          </div>
          <div class="col-md-6">
            <label class="form-label">Product Name</label>
            <input class="form-control" placeholder="Enter product name">
          </div>
          <div class="col-md-6">
            <label class="form-label">Category</label>
            <select class="form-select">
              <option>Select Category</option>
              <option>Electronics</option>
              <option>Furniture</option>
            </select>
          </div>
          <div class="col-md-6">
            <label class="form-label">Unit</label>
            <select class="form-select">
              <option>Select Unit</option>
              <option>pcs</option>
              <option>box</option>
            </select>
          </div>
        </div>

        <div class="mt-4 d-flex gap-2">
          <button class="btn btn-outline-primary">Add Product</button>
          <div class="flex-grow-1"></div>
          <button class="btn btn-secondary">Cancel</button>
          <button class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>

    <!-- Table -->
    <div class="card">
      <div class="card-header d-flex justify-content-between">
        <strong>Inventory List</strong>
        <input class="form-control form-control-sm w-25" placeholder="Search...">
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Barcode</th>
              <th>Product</th>
              <th>Category</th>
              <th>Unit</th>
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1001</td>
              <td class="text-muted">883921045</td>
              <td><strong>Office Chair</strong></td>
              <td><span class="badge bg-info-subtle text-info">Furniture</span></td>
              <td>pcs</td>
              <td class="text-end">
                <button class="btn btn-sm btn-light">
                  <span class="material-symbols-outlined">edit</span>
                </button>
                <button class="btn btn-sm btn-light text-danger">
                  <span class="material-symbols-outlined">delete</span>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="card-footer d-flex justify-content-between">
        <small class="text-muted">Page 1 of 12</small>
        <div>
          <button class="btn btn-sm btn-outline-secondary" disabled>Previous</button>
          <button class="btn btn-sm btn-outline-secondary">Next</button>
        </div>
      </div>
    </div>

  </main>
</div>

</body>
</html>

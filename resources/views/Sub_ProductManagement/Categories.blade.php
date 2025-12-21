<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Categories - Inventory Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f0f4f8;
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
    .icon-badge {
      width: 32px;
      height: 32px;
      border-radius: 6px;
      background: #e0ecff;
      color: #135bec;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      font-weight: bold;
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
      Home / Product Management / <strong class="text-dark">Add Categories</strong>
    </div>
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

    <div class="mb-4">
      <h3 class="fw-bold">Categories</h3>
      <p class="text-muted">Manage and organize product categories.</p>
      <div class="text-end mb-3" >
        <a href="/" class="btn btn-outline-primary">
        <i class="bi bi-arrow-left"></i> Back to Product Management
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="row g-3 align-items-end">
          <div class="col-md-4">
            <label class="form-label fw-semibold">Category Name</label>
            <input type="text" class="form-control" placeholder="Electronics">
          </div>
          <!-- <div class="col-md-4">
            <label class="form-label fw-semibold">Description</label>
            <input type="text" class="form-control" placeholder="Optional">
          </div> -->
          <div class="col-md-4 d-flex gap-2">
            <button class="btn btn-primary">
              <span class="material-symbols-outlined me-1">add</span>Add
            </button>
            <button class="btn btn-outline-secondary" disabled>Save</button>
            <button class="btn btn-outline-dark">Cancel</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Table Card -->
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <strong>Category List</strong>
        <input class="form-control form-control-sm w-25" placeholder="Search...">
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Category</th>
              <!-- <th>Description</th>
              <th>Products</th> -->
              <th class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-muted">#1042</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <!-- <div class="icon-badge">EL</div> -->
                  <strong>Electronics</strong>
                </div>
              </td>
              <!-- <td class="text-muted">Devices & gadgets</td>
              <td><span class="badge bg-success-subtle text-success">1240 items</span></td> -->
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

      <!-- Pagination -->
      <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">Showing 1–4 of 24</small>
        <nav>
          <ul class="pagination pagination-sm mb-0">
            <li class="page-item disabled"><a class="page-link">Previous</a></li>
            <li class="page-item active"><a class="page-link">1</a></li>
            <li class="page-item"><a class="page-link">2</a></li>
            <li class="page-item"><a class="page-link">Next</a></li>
          </ul>
        </nav>
      </div>
    </div>

  </main>
</div>

</body>
</html>

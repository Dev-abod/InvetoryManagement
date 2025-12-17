<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Transaction Order - Inventory System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  font-family:'Inter',sans-serif;
  background:#f6f6f8;
}
.sidebar{
  width:280px;
  background:linear-gradient(to bottom,#101622,#1e293b);
  color:#cbd5f5;
}
.sidebar a{
  color:#cbd5f5;
  text-decoration:none;
}
.sidebar a.active,
.sidebar a:hover{
  background:#fff;
  color:#135bec;
  border-radius:.5rem;
}
.brand-icon{
  width:36px;height:36px;
  background:#135bec;
  border-radius:.5rem;
  display:flex;align-items:center;justify-content:center;
}
.icon-input{
  position:absolute;
  left:12px;
  top:50%;
  transform:translateY(-50%);
  color:#6c757d;
}
.table td,.table th{vertical-align:middle;}
</style>
</head>

<body class="d-flex vh-100 overflow-hidden">

<!-- Sidebar -->
<aside class="sidebar d-flex flex-column p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="brand-icon text-white">
      <span class="material-symbols-outlined">inventory_2</span>
    </div>
    <h6 class="mb-0 fw-bold text-white">Inventory Sys</h6>
  </div>

  <ul class="nav nav-pills flex-column gap-1 mb-auto">
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><span class="material-symbols-outlined me-2">home</span>Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><span class="material-symbols-outlined me-2">package_2</span>Product Management</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><span class="material-symbols-outlined me-2">handshake</span>Partners</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active fw-semibold" href="#"><span class="material-symbols-outlined me-2">receipt_long</span>Transaction Management</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-white" href="#"><span class="material-symbols-outlined me-2">analytics</span>Reports</a>
    </li>
  </ul>

  <div class="border-top border-light pt-3 d-flex align-items-center gap-3">
    <img src="https://via.placeholder.com/40" class="rounded-circle">
    <div>
      <div class="fw-semibold text-white">Admin User</div>
      <small class="text-secondary">admin@company.com</small>
    </div>
  </div>
</aside>

<!-- Main -->
<div class="flex-grow-1 d-flex flex-column">

<!-- Header -->
<header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
  <div class="text-muted small">
    Transactions / <strong class="text-primary">New Order</strong>
  </div>
  <div>
    <button class="btn btn-light rounded-circle">
      <span class="material-symbols-outlined">notifications</span>
    </button>
    <button class="btn btn-light rounded-circle">
      <span class="material-symbols-outlined">help</span>
    </button>
  </div>
</header>

<!-- Content -->
<main class="p-4 overflow-auto">

<!-- Page Title + Actions -->
<div class="d-flex justify-content-between flex-wrap gap-3 mb-4">
  <h3 class="fw-bold">Transaction Order</h3>
  <div class="d-flex gap-2">
    <button class="btn btn-outline-secondary">
      <span class="material-symbols-outlined me-1">download</span>Load
    </button>
    <button class="btn btn-primary">
      <span class="material-symbols-outlined me-1">save</span>Save Order
    </button>
    <button class="btn btn-success">
      <span class="material-symbols-outlined me-1">update</span>Update
    </button>
    <button class="btn btn-outline-danger">
      <span class="material-symbols-outlined me-1">delete</span>Delete
    </button>
  </div>
</div>

<!-- Order Header -->
<div class="card mb-4 shadow-sm">
  <div class="card-body bg-primary text-white">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="small">Order No</label>
        <input class="form-control fw-semibold" value="ORD-2023-8834" readonly>
      </div>
      <div class="col-md-4">
        <label class="small">Order Date</label>
        <input type="date" class="form-control" value="2023-10-27">
      </div>
      <div class="col-md-4">
        <label class="small">Customer / Supplier</label>
        <select class="form-select">
          <option>Acme Supply Co.</option>
          <option>Global Logistics Ltd.</option>
        </select>
      </div>
    </div>
  </div>
  <div class="card-footer d-flex gap-4 small">
    <span>Status: <strong class="text-success">Active</strong></span>
    <span>Created by: <strong>Jane Doe</strong></span>
  </div>
</div>

<!-- Items Table -->
<div class="card">
  <div class="card-header d-flex justify-content-between">
    <strong>Item Details</strong>
    <button class="btn btn-sm btn-outline-primary">
      <span class="material-symbols-outlined">add_circle</span> Add Item
    </button>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>#</th>
          <th>Item</th>
          <th>Category</th>
          <th>Unit</th>
          <th>Qty</th>
          <th>Expiry</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><strong>Wireless Mouse M200</strong><br><small class="text-muted">SKU: WM-200-BL</small></td>
          <td><span class="badge bg-info">Electronics</span></td>
          <td>Pcs</td>
          <td><input type="number" class="form-control form-control-sm w-75" value="50"></td>
          <td>2025-12-31</td>
          <td class="text-end">
            <button class="btn btn-sm btn-light"><span class="material-symbols-outlined">edit</span></button>
            <button class="btn btn-sm btn-light text-danger"><span class="material-symbols-outlined">delete</span></button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="card-footer d-flex justify-content-between small text-muted">
    <span>Showing 3 items</span>
    <span>Total Quantity: <strong>85</strong></span>
  </div>
</div>

</main>
</div>

</body>
</html>

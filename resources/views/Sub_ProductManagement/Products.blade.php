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
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

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

    <form method="POST"
      action="{{ isset($editProduct) ? route('Products.update',$editProduct->id) : route('Products.store') }}">
      @csrf

      <div class="row g-3">

        <div class="col-md-6">
          <label class="form-label">Barcode / SKU</label>
          <input class="form-control"
                 name="barcode"
                 value="{{ $editProduct->barcode ?? '' }}"
                 placeholder="Scan or enter barcode">
        </div>

        <div class="col-md-6">
          <label class="form-label">Product Name</label>
          <input class="form-control"
                 name="name"
                 value="{{ $editProduct->name ?? '' }}"
                 placeholder="Enter product name">
        </div>

        <div class="col-md-6">
          <label class="form-label">Category</label>
          <select name="category_id" class="form-select">
            <option>Select Category</option>
            @foreach($categories as $category)
              <option value="{{ $category->id }}"
                {{ isset($editProduct) && $editProduct->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-6">
          <label class="form-label">Unit</label>
          <select name="unit_id" class="form-select">
            <option>Select Unit</option>
            @foreach($units as $unit)
              <option value="{{ $unit->id }}"
                {{ isset($editProduct) && $editProduct->unit_id == $unit->id ? 'selected' : '' }}>
                {{ $unit->name }}
              </option>
            @endforeach
          </select>
        </div>

      </div>

      <div class="mt-4 d-flex gap-2">
        <button class="btn btn-outline-primary"
          {{ isset($editProduct) ? 'disabled' : '' }}>
          Add Product
        </button>

        <div class="flex-grow-1"></div>

        <a href="{{ route('Products') }}" class="btn btn-secondary">
          Cancel
        </a>

        <button class="btn btn-primary"
          {{ isset($editProduct) ? '' : 'disabled' }}>
          Save
        </button>
      </div>

    </form>
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
@foreach($products as $product)
<tr>
  <td>{{ $product->id }}</td>
  <td class="text-muted">{{ $product->barcode }}</td>
  <td><strong>{{ $product->name }}</strong></td>
  <td>
    <span class="badge bg-info-subtle text-info">
      {{ $product->category->name }}
    </span>
  </td>
  <td>{{ $product->unit->name }}</td>
  <td class="text-end">

    <a href="{{ route('Products',['edit'=>$product->id]) }}"
       class="btn btn-sm btn-light">
      <span class="material-symbols-outlined">edit</span>
    </a>

    <form method="POST"
          action="{{ route('Products.delete',$product->id) }}"
          class="d-inline"
          onsubmit="return confirm('Are you sure?')">
      @csrf
      <button class="btn btn-sm btn-light text-danger">
        <span class="material-symbols-outlined">delete</span>
      </button>
    </form>

  </td>
</tr>
@endforeach
</tbody>
        </table>
      </div>

      <!-- <div class="card-footer d-flex justify-content-between">
        <small class="text-muted">Page 1 of 12</small>
        <div>
          <button class="btn btn-sm btn-outline-secondary" disabled>Previous</button>
          <button class="btn btn-sm btn-outline-secondary">Next</button>
        </div>
      </div> -->
    </div>

  </main>
</div>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

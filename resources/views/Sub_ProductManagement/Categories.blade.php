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

{{-- Sidebar --}}
@include('layouts.sidebar')

<!-- Main -->
<div class="flex-grow-1 d-flex flex-column">

  <!-- Header -->
  <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
    <div class="text-secondary small">
      Home / Product Management / <strong class="text-dark">Add Category</strong>
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
      <p class="text-muted">Manage and organize product Categories.</p>
      <div class="text-end mb-3">
        <a href="{{ uri('/product-management') }}" class="btn btn-outline-primary">
          <i class="bi bi-arrow-left"></i> Back to Product Management
        </a>
      </div>
    </div>

    <!-- Form Card -->
    <div class="card mb-4">
      <div class="card-body">
        <form method="POST"
          action="{{ isset($editCategory) ? route('Categories.update',$editCategory->id) : route('Categories.store') }}">
          @csrf

          <div class="row g-3 align-items-end">
            <div class="col-md-4">
              <label class="form-label fw-semibold">Category Name</label>
              <input type="text"
                     name="name"
                     class="form-control"
                     placeholder="Add Category Name"
                     value="{{ $editCategory->name ?? '' }}"
                     required>
            </div>

            <div class="col-md-4 d-flex gap-2">
              <button class="btn btn-primary"
                {{ isset($editCategory) ? 'disabled' : '' }}>
                <span class="material-symbols-outlined me-1">add</span>
                Add
              </button>

              <button class="btn btn-outline-secondary"
                {{ isset($editCategory) ? '' : 'disabled' }}>
                Save
              </button>

              <a href="{{ route('Categories') }}" class="btn btn-outline-dark">
                Cancel
              </a>
            </div>
          </div>
        </form>
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
              <th class="text-end">Actions</th>
            </tr>
          </thead>

          <tbody>
            @foreach($categories as $category)
            <tr>
              <td class="text-muted">#{{ $category->id }}</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <strong>{{ $category->name }}</strong>
                </div>
              </td>

              <td class="text-end">
                <a href="{{ route('Categories',['edit'=>$category->id]) }}"
                   class="btn btn-sm btn-light">
                  <span class="material-symbols-outlined">edit</span>
                </a>

                <form method="POST"
                      action="{{ route('Categories.delete',$category->id) }}"
                      class="d-inline"
                      onsubmit="return confirm('Are you sure you want to delete this category?')">
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

      <!-- Pagination (شكلي فقط مثل الصفحة الأصلية) -->
      <!-- <div class="card-footer d-flex justify-content-between align-items-center">
        <small class="text-muted">Showing 1–4 of {{ $categories->count() }}</small>
        <nav>
          <ul class="pagination pagination-sm mb-0">
            <li class="page-item disabled"><a class="page-link">Previous</a></li>
            <li class="page-item active"><a class="page-link">1</a></li>
            <li class="page-item"><a class="page-link">2</a></li>
            <li class="page-item"><a class="page-link">Next</a></li>
          </ul>
        </nav>
      </div> -->

    </div>

  </main>
</div>

</body>
</html>

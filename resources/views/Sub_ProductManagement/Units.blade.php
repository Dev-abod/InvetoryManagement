<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Units - Inventory Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

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
  </style>
</head>

<body class="d-flex vh-100 overflow-hidden">

@include('layouts.sidebar')

<div class="flex-grow-1 d-flex flex-column">

<header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
  <div class="text-secondary small">
    Home / Product Management / <strong class="text-dark">Add Unit</strong>
  </div>
</header>

<main class="p-4 overflow-auto">

<div class="mb-4">
  <h3 class="fw-bold">Units</h3>
  <p class="text-muted">Manage and organize product Units.</p>
  <div class="text-end mb-3">
    <a href="{{ route('ProductManagement') }}" class="btn btn-outline-primary">
      ← Back to Product Management
    </a>
  </div>
</div>

<!-- Form Card -->
<div class="card mb-4">
  <div class="card-body">

    <form method="POST"
      action="{{ isset($editUnit) ? route('Units.update',$editUnit->id) : route('Units.store') }}">
      @csrf

      <div class="row g-3 align-items-end">
        <div class="col-md-4">
          <label class="form-label fw-semibold">Unit Name</label>
          <input type="text"
                 name="name"
                 class="form-control"
                 placeholder="Add Unit Name"
                 value="{{ $editUnit->name ?? '' }}"
                 required>
        </div>

        <div class="col-md-4 d-flex gap-2">
          <button class="btn btn-primary"
            {{ isset($editUnit) ? 'disabled' : '' }}>
            <span class="material-symbols-outlined me-1">add</span>Add
          </button>

          <button class="btn btn-outline-secondary"
            {{ isset($editUnit) ? '' : 'disabled' }}>
            Save
          </button>

          <a href="{{ route('Units') }}" class="btn btn-outline-dark">
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
    <strong>Unit List</strong>
    <input class="form-control form-control-sm w-25" placeholder="Search...">
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Unit</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>

      <tbody>
        @foreach($units as $unit)
        <tr>
          <td class="text-muted">#{{ $unit->id }}</td>
          <td><strong>{{ $unit->name }}</strong></td>
          <td class="text-end">

            <a href="{{ route('Units',['edit'=>$unit->id]) }}"
               class="btn btn-sm btn-light">
              <span class="material-symbols-outlined">edit</span>
            </a>

            <form method="POST"
                  action="{{ route('Units.delete',$unit->id) }}"
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

</div>

</main>
</div>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>

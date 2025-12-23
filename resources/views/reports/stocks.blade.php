<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Stock Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  font-family:'Inter',sans-serif;
  background:#f6f6f8;
  direction:ltr;
}

/* Sidebar */
.sidebar {
  width:280px;
  min-width:280px;
  background:linear-gradient(to bottom,#0f172a,#1e3a8a);
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
  border-radius:.75rem;
}

/* Tables */
.table td,.table th{
  vertical-align:middle;
  font-size:14px;
}

/* Print Style */
@media print {
  .sidebar,
  button,
  nav {
    display: none !important;
  }

  body {
    background: #fff;
  }

  table {
    font-size: 12px;
  }
}
</style>
</head>

<body class="d-flex vh-100 overflow-hidden">

<!-- Sidebar -->
@include('layouts.sidebar')

<!-- Main -->
<div class="flex-grow-1 d-flex flex-column">

  <!-- Header -->
  <header class="bg-white border-bottom px-4 py-3">
    <nav class="small text-muted">
      Reports / <strong class="text-primary">Stock Report</strong>
    </nav>
  </header>

  <!-- Content -->
  <main class="p-4 overflow-auto">

    <!-- Page Title + Actions -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h2 class="fw-bold mb-0">Current Stock Report</h2>
        <p class="text-muted small mb-0">
          Live quantities per item and warehouse
        </p>
      </div>

      <div class="d-flex gap-2">
        <!-- Print -->
        <button onclick="window.print()"
                class="btn btn-outline-primary">
          Print Report
        </button>

        <!-- Back -->
        <button onclick="window.history.back()"
                class="btn btn-outline-secondary">
          Back
        </button>
      </div>
    </div>

    <!-- Report Table -->
    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover text-center mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Item</th>
              <th>Category</th>
              <th>Warehouse</th>
              <th>Quantity</th>
              <th>Last Update</th>
            </tr>
          </thead>
          <tbody>
            @forelse($stocks as $stock)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $stock->item->name }}</td>
                <td>{{ $stock->item->category->name ?? '-' }}</td>
                <td>{{ $stock->warehouse->name }}</td>
                <td>
                  <span class="badge bg-success">
                    {{ $stock->quantity }}
                  </span>
                </td>
                <td class="text-muted">
                  {{ $stock->updated_at->format('Y-m-d') }}
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-muted py-4">
                  No stock records found
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Inventory Movements Report</title>
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
}

/* Sidebar */
.sidebar{
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

/* Cards */
.filter-card{
  background:#fff;
  border:1px solid #e5e7eb;
}
.table th,
.table td{
  vertical-align:middle;
  font-size:14px;
}
.badge{
  font-size:12px;
}
</style>
</head>

<body class="d-flex vh-100 overflow-hidden">

{{-- Sidebar --}}
@include('layouts.sidebar')

<!-- Main -->
<div class="flex-grow-1 d-flex flex-column">

  <!-- Header -->
  <header class="bg-white border-bottom px-4 py-3">
    <nav class="small text-muted">
      Reports / <strong class="text-primary">Inventory Movements</strong>
    </nav>
  </header>

  <!-- Content -->
  <main class="p-4 overflow-auto">

    <!-- Page Title -->
    <div class="mb-4">
      <h2 class="fw-bold mb-1">Inventory Movements Report</h2>
      <p class="text-muted mb-0">
        Track all inventory in, out, returns, corrections, and cancellations.
      </p>
    </div>

    <!-- Filters -->
    <form method="GET" class="card filter-card p-3 mb-4">
      <div class="row g-3 align-items-end">

        <div class="col-md-3">
          <label class="form-label">Operation Type</label>
          <select name="type" class="form-select">
            <option value="">All</option>
            <option value="in" @selected(($filters['type'] ?? '')=='in')>In</option>
            <option value="out" @selected(($filters['type'] ?? '')=='out')>Out</option>
            <option value="return_in" @selected(($filters['type'] ?? '')=='return_in')>Return In</option>
            <option value="return_out" @selected(($filters['type'] ?? '')=='return_out')>Return Out</option>
            <option value="corrected" @selected(($filters['type'] ?? '')=='corrected')>Corrected</option>
            <option value="cancelled" @selected(($filters['type'] ?? '')=='cancelled')>Cancelled</option>
          </select>
        </div>

        <div class="col-md-3">
          <label class="form-label">Warehouse</label>
          <select name="warehouse_id" class="form-select">
            <option value="">All</option>
            @foreach($warehouses as $warehouse)
              <option value="{{ $warehouse->id }}"
                @selected(($filters['warehouse_id'] ?? '')==$warehouse->id)>
                {{ $warehouse->name }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-md-2">
          <label class="form-label">From</label>
          <input type="date"
                 name="from"
                 value="{{ $filters['from'] ?? '' }}"
                 class="form-control">
        </div>

        <div class="col-md-2">
          <label class="form-label">To</label>
          <input type="date"
                 name="to"
                 value="{{ $filters['to'] ?? '' }}"
                 class="form-control">
        </div>

        <div class="col-md-2 d-flex gap-2">
          <button class="btn btn-primary w-100">
            Filter
          </button>
          <a href="{{ route('reports.operations') }}"
             class="btn btn-outline-secondary w-100">
            Reset
          </a>
        </div>

      </div>
    </form>

    <!-- Table -->
    <div class="card shadow-sm mb-4">
      <div class="table-responsive">
        <table class="table table-hover mb-0 text-center">
          <thead class="table-light">
            <tr>
              <th>Operation No</th>
              <th>Date</th>
              <th>Type</th>
              <th>Warehouse</th>
              <th>Partner</th>
              <th>Status</th>
              <th>View</th>
            </tr>
          </thead>

          <tbody>
          @forelse($operations as $operation)

            @php
              $statusColor = match($operation->status){
                'posted'    => 'primary',
                'corrected' => 'warning',
                'cancelled' => 'danger',
                default     => 'secondary',
              };
            @endphp

            <tr>
              <td class="fw-semibold">{{ $operation->number }}</td>
              <td>{{ $operation->date }}</td>
              <td class="text-uppercase">{{ $operation->operation_type }}</td>
              <td>{{ $operation->warehouse->name }}</td>
              <td>{{ $operation->partner?->name ?? '-' }}</td>
              <td>
                <span class="badge bg-{{ $statusColor }}">
                  {{ ucfirst($operation->status) }}
                </span>
              </td>
              <td>
                <a href="{{ route('operations.show',$operation->id) }}"
                   class="btn btn-sm btn-light">
                  <span class="material-symbols-outlined">visibility</span>
                </a>
              </td>
            </tr>

          @empty
            <tr>
              <td colspan="7" class="text-muted py-4">
                No operations found
              </td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>

      <div class="card-footer">
        {{ $operations->withQueryString()->links() }}
      </div>
    </div>

    <!-- Bottom Actions -->
    <div class="d-flex justify-content-between">
      <button onclick="window.history.back()"
              class="btn btn-secondary">
        Back
      </button>

      <button onclick="window.print()"
              class="btn btn-outline-primary">
        Print Report
      </button>
    </div>

  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

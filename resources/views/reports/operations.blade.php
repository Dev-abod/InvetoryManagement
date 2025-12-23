<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Inventory Operations Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  font-family:'Inter',sans-serif;
  background:#f6f6f8;
}

/* ===== Sidebar (same system style) ===== */
.sidebar{
  width:280px;
  min-width:280px;
  background:linear-gradient(to bottom,#0f172a,#1e3a8a);
  color:#cbd5f5;
}

.sidebar a{
  display:flex;
  align-items:center;
  gap:10px;
  padding:10px 14px;
  color:#cbd5f5;
  text-decoration:none;
  border-radius:.75rem;
  transition:.2s ease;
}

.sidebar a.active,
.sidebar a:hover{
  background:#fff;
  color:#135bec;
}

.sidebar .material-symbols-outlined{
  font-size:20px;
}

/* ===== Tables ===== */
.table td,.table th{
  vertical-align:middle;
  font-size:14px;
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
      Reports / <strong class="text-primary">Inventory Operations</strong>
    </nav>
  </header>

  <!-- Content -->
  <main class="p-4 overflow-auto">

    <!-- Page Title -->
    <div class="mb-4">
      <h2 class="fw-bold mb-1">Inventory Operations Report</h2>
      <p class="text-muted mb-0">
        Review all inventory movements with advanced filtering.
      </p>
    </div>

    <!-- ================= Filters ================= -->
    <form method="GET" class="card mb-4 shadow-sm">
      <div class="card-body">

        <div class="row g-3">

          <div class="col-md-3">
            <label class="form-label">Operation Type</label>
            <select name="type" class="form-select">
              <option value="">All</option>
              <option value="in" @selected(($filters['type'] ?? '')=='in')>In</option>
              <option value="out" @selected(($filters['type'] ?? '')=='out')>Out</option>
              <option value="return_in" @selected(($filters['type'] ?? '')=='return_in')>Return In</option>
              <option value="return_out" @selected(($filters['type'] ?? '')=='return_out')>Return Out</option>
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
              <option value="">All</option>
              <option value="posted" @selected(($filters['status'] ?? '')=='posted')>Posted</option>
              <option value="corrected" @selected(($filters['status'] ?? '')=='corrected')>Corrected</option>
              <option value="cancelled" @selected(($filters['status'] ?? '')=='cancelled')>Cancelled</option>
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">From</label>
            <input type="date" name="from"
                   value="{{ $filters['from'] ?? '' }}"
                   class="form-control">
          </div>

          <div class="col-md-2">
            <label class="form-label">To</label>
            <input type="date" name="to"
                   value="{{ $filters['to'] ?? '' }}"
                   class="form-control">
          </div>

          <div class="col-md-2">
            <label class="form-label">Warehouse</label>
            <select name="warehouse_id" class="form-select">
              <option value="">All</option>
              @foreach($warehouses as $wh)
                <option value="{{ $wh->id }}"
                  @selected(($filters['warehouse_id'] ?? '')==$wh->id)>
                  {{ $wh->name }}
                </option>
              @endforeach
            </select>
          </div>

        </div>

        <div class="mt-3 d-flex gap-2 align-items-center">
          <button class="btn btn-primary">
            <span class="material-symbols-outlined me-1">filter_alt</span>
            Apply
          </button>

          <a href="{{ route('reports.operations') }}"
             class="btn btn-outline-secondary">
            Reset
          </a>

          <button type="button"
                  onclick="window.print()"
                  class="btn btn-outline-success ms-auto">
            <span class="material-symbols-outlined me-1">print</span>
            Print
          </button>
        </div>

      </div>
    </form>

    <!-- ================= Table ================= -->
    <div class="card shadow-sm mb-4">
      <div class="table-responsive">
        <table class="table table-hover text-center mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Operation No</th>
              <th>Date</th>
              <th>Type</th>
              <th>Status</th>
              <th>Warehouse</th>
              <th>Partner</th>
            </tr>
          </thead>
          <tbody>
          @forelse($operations as $op)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td class="fw-semibold">{{ $op->number }}</td>
              <td>{{ $op->date }}</td>
              <td>{{ ucfirst(str_replace('_',' ',$op->operation_type)) }}</td>
              <td>
                <span class="badge bg-{{ 
                  $op->status=='posted' ? 'primary' :
                  ($op->status=='corrected' ? 'warning' : 'danger')
                }}">
                  {{ ucfirst($op->status) }}
                </span>
              </td>
              <td>{{ $op->warehouse->name }}</td>
              <td>{{ $op->partner?->name ?? '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-muted py-4">
                No data found
              </td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>

      <div class="card-footer">
        {{ $operations->links() }}
      </div>
    </div>

    <!-- Back Button -->
    <div>
      <button onclick="window.history.back()"
              class="btn btn-secondary">
        Back
      </button>
    </div>

  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

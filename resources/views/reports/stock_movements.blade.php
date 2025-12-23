<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Stock Movements Report</title>
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

/* Tables */
.table td,.table th{
  vertical-align:middle;
  font-size:14px;
}
</style>
</head>

<body class="d-flex vh-100 overflow-hidden">

{{-- Sidebar --}}
@include('layouts.sidebar')

{{-- Main --}}
<div class="flex-grow-1 d-flex flex-column">

  {{-- Header --}}
  <header class="bg-white border-bottom px-4 py-3">
    <nav class="small text-muted">
      Reports / <strong class="text-primary">Stock Movements</strong>
    </nav>
  </header>

  {{-- Content --}}
  <main class="p-4 overflow-auto">

    <div class="mb-4">
      <h2 class="fw-bold mb-1">Stock Movements Report</h2>
      <p class="text-muted small">
        Detailed inventory movements with balance before and after each operation.
      </p>
    </div>

    {{-- ================= Filters ================= --}}
    <form method="GET" class="card mb-4">
      <div class="card-body">
        <div class="row g-3">

          <div class="col-md-3">
            <label class="form-label">Item</label>
            <select name="item_id" class="form-select">
              <option value="">All</option>
              @foreach($items as $item)
                <option value="{{ $item->id }}"
                  @selected(($filters['item_id'] ?? '') == $item->id)>
                  {{ $item->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-3">
            <label class="form-label">Category</label>
            <select name="category_id" class="form-select">
              <option value="">All</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                  @selected(($filters['category_id'] ?? '') == $cat->id)>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="col-md-2">
            <label class="form-label">Warehouse</label>
            <select name="warehouse_id" class="form-select">
              <option value="">All</option>
              @foreach($warehouses as $wh)
                <option value="{{ $wh->id }}"
                  @selected(($filters['warehouse_id'] ?? '') == $wh->id)>
                  {{ $wh->name }}
                </option>
              @endforeach
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

        </div>

        <div class="mt-3 d-flex gap-2">
          <button class="btn btn-primary">
            <span class="material-symbols-outlined me-1">filter_alt</span>
            Apply
          </button>

          <a href="{{ route('reports.stock.movements') }}"
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

    {{-- ================= Table ================= --}}
    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover text-center mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Date</th>
              <th>Item</th>
              <th>Category</th>
              <th>Warehouse</th>
              <th>Operation</th>
              <th>Qty Change</th>
              <th>Balance Before</th>
              <th>Balance After</th>
            </tr>
          </thead>
          <tbody>
          @forelse($movements as $mv)
            @php
              $before = $mv->balance_after - $mv->quantity_change;
            @endphp
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $mv->created_at->format('Y-m-d') }}</td>
              <td>{{ $mv->item->name }}</td>
              <td>{{ $mv->item->category->name ?? '-' }}</td>
              <td>{{ $mv->warehouse->name }}</td>
              <td>{{ strtoupper($mv->operation->operation_type) }}</td>
              <td class="{{ $mv->quantity_change >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $mv->quantity_change > 0 ? '+' : '' }}{{ $mv->quantity_change }}
              </td>
              <td>{{ $before }}</td>
              <td class="fw-semibold">{{ $mv->balance_after }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-muted py-4">
                No stock movements found
              </td>
            </tr>
          @endforelse
          </tbody>
        </table>
      </div>

      <div class="card-footer">
        {{ $movements->links() }}
      </div>
    </div>

    {{-- Back --}}
    <div class="mt-3">
      <button onclick="window.history.back()"
              class="btn btn-secondary">
        Back
      </button>
    </div>

  </main>
</div>

</body>
</html>

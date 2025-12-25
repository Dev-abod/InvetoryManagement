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

/* Table */
.table td,.table th{
  vertical-align:middle;
  font-size:14px;
}

/* Operation Type Colors */
.op-in        { color:#16a34a; font-weight:600; }   /* Green */
.op-out       { color:#dc2626; font-weight:600; }   /* Red */
.op-return_in { color:#2563eb; font-weight:600; }   /* Blue */
.op-return_out{ color:#ea580c; font-weight:600; }   /* Orange */
.op-adjustment{ color:#7c3aed; font-weight:600; }   /* Purple */
/* Operation Type Circle */
.op-badge{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  min-width:40px;
  height:28px;
  padding:0 10px;
  border-radius:999px; /* دائرة / كبسولة */
  font-size:12px;
  font-weight:600;
  text-transform:uppercase;
}

/* Colors */
.op-in{
  background:#dcfce7;
  color:#166534;
}

.op-out{
  background:#fee2e2;
  color:#991b1b;
}

.op-return_in{
  background:#dbeafe;
  color:#1e40af;
}

.op-return_out{
  background:#ffedd5;
  color:#9a3412;
}

.op-adjustment{
  background:#ede9fe;
  color:#5b21b6;
}

/* Cancelled */
.row-cancelled{
  background-color:#fdecea !important;
}
.op-cancelled{
  text-decoration:line-through;
  color:#b42318;
  font-weight:600;
}

/* Reversed / Corrected */
.row-reversed{
  background-color:#eef2ff !important;
}
.op-reversed{
  color:#4338ca;
  font-weight:600;
}

.original-op{
  font-size:12px;
  color:#6b7280;
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
              <th>Operation No</th>
              <th>Date</th>
              <th>Item</th>
              <th>Category</th>
              <th>Warehouse</th>
              <th>Type</th>
              <th>Qty Change</th>
              <th>Balance Before</th>
              <th>Balance After</th>
            </tr>
          </thead>
          <tbody>
          @forelse($movements as $mv)

            @php
              $before      = $mv->balance_after - $mv->quantity_change;
              $isCancelled = $mv->operation->status === 'cancelled';
              $isReversed  = $mv->operation->originalOperation !== null;
            @endphp

            <tr class="
              {{ $isCancelled ? 'row-cancelled' : '' }}
              {{ $isReversed ? 'row-reversed' : '' }}
            ">
              <td>{{ $loop->iteration }}</td>

              <td>
                <span class="
                  {{ $isCancelled ? 'op-cancelled' : '' }}
                  {{ $isReversed ? 'op-reversed' : '' }}
                ">
                  {{ $mv->operation->number }}
                </span>

                @if($isCancelled)
                  <div class="badge bg-danger bg-opacity-10 text-danger mt-1">
                    Cancelled
                  </div>
                @endif

                @if($isReversed)
                  <div class="original-op">
                    ↩ Reversal of:
                    <strong>{{ $mv->operation->originalOperation->number }}</strong>
                  </div>
                @endif
              </td>

              <td>{{ $mv->created_at->format('Y-m-d') }}</td>
              <td>{{ $mv->item->name }}</td>
              <td>{{ $mv->item->category->name ?? '-' }}</td>
              <td>{{ $mv->warehouse->name }}</td>
             <td>
  <span class="op-badge op-{{ $mv->operation->operation_type }}">
    {{ str_replace('_',' ',$mv->operation->operation_type) }}
  </span>
</td>


              <td class="{{ $mv->quantity_change >= 0 ? 'text-success' : 'text-danger' }}">
                {{ $mv->quantity_change > 0 ? '+' : '' }}{{ $mv->quantity_change }}
              </td>

              <td>{{ $before }}</td>
              <td class="fw-semibold">{{ $mv->balance_after }}</td>
            </tr>

          @empty
            <tr>
              <td colspan="10" class="text-muted py-4">
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
      <button onclick="window.history.back()" class="btn btn-secondary">
        Back
      </button>
    </div>

  </main>
</div>

</body>
</html>

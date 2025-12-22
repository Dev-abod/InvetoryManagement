<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Correct Operation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
  font-family: 'Inter', sans-serif;
  background: #f6f6f8;
}

/* Sidebar */
.sidebar {
  width: 280px;
  min-width: 280px;
  background: linear-gradient(to bottom, #0f172a, #1e3a8a);
  color: #cbd5f5;
}

.sidebar a {
  color: #cbd5f5;
  text-decoration: none;
}

.sidebar a.active,
.sidebar a:hover {
  background: #fff;
  color: #135bec;
  border-radius: .75rem;
}

/* Tables */
.table th,
.table td {
  vertical-align: middle;
  font-size: 14px;
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
      Operations /
      <strong class="text-primary">
        Correct Operation #{{ $operation->number }}
      </strong>
    </nav>
  </header>

  <!-- Content -->
  <main class="p-4 overflow-auto">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h3 class="fw-bold mb-0">Correct Operation</h3>
        <p class="text-muted small mb-0">
          Modify quantities to apply correction
        </p>
      </div>

      <button onclick="window.history.back()"
              class="btn btn-outline-secondary">
        Back
      </button>
    </div>

    <!-- Operation Info -->
    <div class="card mb-4">
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-4">
            <strong>Date</strong><br>
            {{ $operation->date }}
          </div>

          <div class="col-md-4">
            <strong>Warehouse</strong><br>
            {{ $operation->warehouse->name }}
          </div>

          <div class="col-md-4">
            <strong>
              {{ in_array($operation->operation_type,['in','return_in']) ? 'Supplier' : 'Customer' }}
            </strong><br>
            {{ $operation->partner?->name ?? '-' }}
          </div>
        </div>
      </div>
    </div>

    <!-- Correction Form -->
    <form method="POST"
          action="{{ route('operations.correct', $operation->id) }}">
      @csrf

      <div class="card shadow-sm">
        <div class="card-header fw-semibold bg-light">
          Items Correction
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-bordered text-center mb-0">
            <thead class="table-light">
              <tr>
                <th>Item</th>
                <th>Old Qty</th>
                <th>New Qty</th>
              </tr>
            </thead>
            <tbody>
              @foreach($operation->details as $detail)
                <tr>
                  <td class="fw-semibold">
                    {{ $detail->item->name }}
                  </td>
                  <td>
                    <span class="badge bg-secondary">
                      {{ $detail->quantity }}
                    </span>
                  </td>
                  <td>
                    <input type="number"
                           name="items[{{ $detail->item_id }}]"
                           value="{{ $detail->quantity }}"
                           min="0"
                           class="form-control text-center"
                           required>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Actions -->
      <div class="mt-4 d-flex justify-content-end gap-2">
        <button type="button"
                onclick="window.history.back()"
                class="btn btn-outline-secondary">
          Cancel
        </button>

        <button type="submit"
                class="btn btn-warning px-4">
          Apply Correction
        </button>
      </div>

    </form>

  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

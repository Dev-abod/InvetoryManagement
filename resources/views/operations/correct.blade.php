<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Correct Operation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

{{-- Fonts --}}
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

{{-- Bootstrap --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  font-family: 'Inter', sans-serif;
  background: #f6f6f8;
}

.page-header{
  background:#ffffff;
  border-bottom:1px solid #e5e7eb;
}

.card{
  border-radius: 0.75rem;
}

.table th, .table td{
  vertical-align: middle;
  font-size: 14px;
}

.badge-old{
  background:#e5e7eb;
  color:#374151;
}
</style>
</head>

<body>

<div class="container py-4">

  {{-- ================= Header ================= --}}
  <div class="page-header px-4 py-3 mb-4 rounded">
    <div class="d-flex justify-content-between align-items-center">
      <div>
        <h4 class="fw-bold mb-0">Correct Operation</h4>
        <small class="text-muted">
          Operation No: {{ $operation->number }}
        </small>
      </div>

      <button onclick="window.history.back()"
              class="btn btn-outline-secondary btn-sm">
        Back
      </button>
    </div>
  </div>

  {{-- ================= Operation Info ================= --}}
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

  {{-- ================= Correction Form ================= --}}
  <form method="POST" action="{{ route('operations.correct', $operation->id) }}">
  @csrf

  <div class="card shadow-sm">
    <div class="card-header fw-semibold bg-light">
      Items Correction
    </div>

    <div class="table-responsive">
      <table class="table table-hover table-bordered text-center mb-0">
        <thead class="table-light">
          <tr>
            <th style="width:45%">Item</th>
            <th style="width:20%">Old Quantity</th>
            <th style="width:20%">New Quantity</th>
          </tr>
        </thead>
        <tbody>

        @foreach($operation->details as $detail)
          <tr>
            <td class="fw-semibold">
              {{ $detail->item->name }}
            </td>

            <td>
              <span class="badge badge-old">
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

  {{-- ================= Actions ================= --}}
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

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

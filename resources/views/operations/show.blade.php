<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Operation Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  background:#f6f6f8;
  font-family: 'Inter', sans-serif;
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
      Operations / <strong class="text-primary">Operation Details</strong>
    </nav>
  </header>

  <!-- Content -->
  <main class="p-4 overflow-auto">

    {{-- ================= Header ================= --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

      <h4 class="fw-bold mb-0">
        Operation Details
      </h4>

      <div class="d-flex gap-2 flex-wrap">

        {{-- Print Button --}}
        <button onclick="window.print()"
                class="btn btn-outline-primary">
          <span class="material-symbols-outlined me-1">print</span>
          Print Invoice
        </button>

        {{-- Correct Button --}}
        @if($operation->status === 'posted' && $operation->corrections->isEmpty())
          <a href="{{ route('operations.correct.form', $operation->id) }}"
             class="btn btn-warning">
            Correct Operation
          </a>
        @endif

        {{-- Cancel Button --}}
        @if(in_array($operation->status, ['posted','corrected']))
          <form method="POST"
                action="{{ route('operations.cancel', $operation->id) }}"
                onsubmit="return confirm('Are you sure you want to cancel this operation?')">
            @csrf
            <button type="submit" class="btn btn-danger">
              Cancel Operation
            </button>
          </form>
        @endif

      </div>
    </div>

    {{-- ================= Status ================= --}}
    @php
      $statusColor = match($operation->status) {
        'posted'    => 'primary',
        'corrected' => 'warning',
        'cancelled' => 'danger',
        default     => 'secondary',
      };
    @endphp

    <div class="mb-3">
      <span class="badge bg-{{ $statusColor }}">
        {{ ucfirst($operation->status) }}
      </span>
    </div>

    {{-- Alerts --}}
    @if($operation->status === 'corrected')
      <div class="alert alert-warning">
        ⚠ This operation was corrected before.
        Cancelling it will void the original transaction entirely.
      </div>
    @endif

    @if($operation->status === 'cancelled')
      <div class="alert alert-danger">
        ❌ This operation has been cancelled and cannot be modified.
      </div>
    @endif

    {{-- ================= Operation Info ================= --}}
    <div class="card mb-4">
      <div class="card-body">

        <div class="row g-3">
          <div class="col-md-3">
            <strong>Operation No:</strong><br>
            {{ $operation->number }}
          </div>

          <div class="col-md-3">
            <strong>Date:</strong><br>
            {{ $operation->date }}
          </div>

          <div class="col-md-3">
            <strong>Warehouse:</strong><br>
            {{ $operation->warehouse->name }}
          </div>

          <div class="col-md-3">
            <strong>
              {{ in_array($operation->operation_type,['in','return_in']) ? 'Supplier' : 'Customer' }}:
            </strong><br>
            {{ $operation->partner?->name ?? '-' }}
          </div>
        </div>

      </div>
    </div>

    {{-- ================= Original Items ================= --}}
    <div class="card mb-5">
      <div class="card-header fw-semibold">
        Original Items
      </div>

      <div class="table-responsive">
        <table class="table table-bordered text-center mb-0">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Item</th>
              <th>Quantity</th>
            </tr>
          </thead>
          <tbody>
            @foreach($operation->details as $detail)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->item->name }}</td>
                <td>{{ $detail->quantity }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- ================= Corrections History ================= --}}
    @if($operation->corrections->count())

      <h5 class="fw-bold text-danger mb-3">
        Correction History
      </h5>

      @foreach($operation->corrections as $correction)

        <div class="card border-danger mb-4">

          <div class="card-header bg-danger text-white">
            Correction No: {{ $correction->number }}
          </div>

          <div class="card-body">

            <p class="mb-1">
              <strong>Date:</strong> {{ $correction->date }}
            </p>

            <p class="mb-3">
              <strong>Corrected By:</strong> {{ $correction->user->name }}
            </p>

            <div class="table-responsive">
              <table class="table table-sm table-bordered text-center">
                <thead class="table-light">
                  <tr>
                    <th>Item</th>
                    <th>Original Qty</th>
                    <th>Corrected Qty</th>
                    <th>Difference</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($correction->details as $detail)
                    @php
                      $originalQty = optional(
                        $operation->details->firstWhere('item_id', $detail->item_id)
                      )->quantity ?? 0;

                      $diff = $detail->quantity - $originalQty;
                    @endphp

                    <tr>
                      <td>{{ $detail->item->name }}</td>
                      <td>{{ $originalQty }}</td>
                      <td>{{ $detail->quantity }}</td>
                      <td class="{{ $diff >= 0 ? 'text-success' : 'text-danger' }}">
                        {{ $diff > 0 ? '+' : '' }}{{ $diff }}
                      </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>

          </div>
        </div>

      @endforeach

    @endif

    {{-- Back --}}
    <div class="mt-4">
      <button onclick="window.history.back()"
              class="btn btn-secondary">
        Back
      </button>
    </div>

  </main>
</div>

</body>
</html>

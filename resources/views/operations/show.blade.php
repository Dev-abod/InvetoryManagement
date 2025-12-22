<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Operation Details</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="p-4">

<h3 class="fw-bold mb-4">
  Operation #{{ $operation->number }}
</h3>

<div class="card mb-4">
  <div class="card-body">
    <div class="row g-3">

      <div class="col-md-4">
        <label class="form-label">Date</label>
        <input class="form-control" value="{{ $operation->date }}" readonly>
      </div>

      <div class="col-md-4">
        <label class="form-label">Partner</label>
        <input class="form-control" value="{{ $operation->partner?->name }}" readonly>
      </div>

      <div class="col-md-4">
        <label class="form-label">Warehouse</label>
        <input class="form-control" value="{{ $operation->warehouse->name }}" readonly>
      </div>

    </div>
  </div>
</div>

<!-- Items -->
<div class="card mb-4">
  <div class="table-responsive">
    <table class="table table-bordered text-center mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>Item</th>
          <th>Category</th>
          <th>Unit</th>
          <th>Qty</th>
        </tr>
      </thead>
      <tbody>
        @foreach($operation->details as $detail)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $detail->item->name }}</td>
          <td>{{ $detail->item->category?->name }}</td>
          <td>{{ $detail->item->unit?->name }}</td>
          <td>{{ $detail->quantity }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<!-- Actions -->
<a href="{{ route('operations.correct.form', $operation->id) }}"
   class="btn btn-warning">
  <span class="material-symbols-outlined me-1">edit</span>
  Correct
</a>

  <a href="{{ route('operations.index', $operation->operation_type) }}"
     class="btn btn-outline-secondary">
    Back
  </a>

  <button onclick="window.print()" class="btn btn-outline-success">
    Print
  </button>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ $pageTitle }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
body{
  font-family:'Inter',sans-serif;
  background:#f6f6f8;
  direction:ltr;
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
/* Form Box */
.entry-box{
  background:#fff;
  border:1px solid #cfd6dd;
  box-shadow:0 2px 6px rgba(0,0,0,.06);
}

.entry-header{
  background:#e6edf5;
  border-bottom:1px solid #cfd6dd;
  padding:10px 14px;
  font-weight:600;
  color:#1f3b5c;
}

.form-control,.form-select{
  height:32px;
  font-size:13px;
}

.table-entry th{
  background:#f2f5f8;
  font-size:13px;
}

.table-entry td{
  padding:4px;
  vertical-align:middle;
}

.action-bar{
  background:#f2f5f8;
  border-top:1px solid #cfd6dd;
  padding:8px;
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
    Operations / <strong class="text-primary">{{ $pageTitle }}</strong>
  </nav>
</header>

<!-- Content -->
<main class="p-4 overflow-auto">

{{-- Success Message --}}
@if (session('success'))
  <div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<form method="POST" action="{{ route('operations.store', $type) }}">
@csrf

<div class="entry-box">

  <div class="entry-header">
    {{ $pageTitle }}
  </div>

  <!-- Header Data -->
  <div class="p-3">
    <div class="row g-3">

      <div class="col-md-3">
        <label class="form-label">Operation No</label>
        <input class="form-control" value="Auto Generated" readonly>
      </div>

      <div class="col-md-3">
        <label class="form-label">Date</label>
        <input type="date"
               name="date"
               class="form-control"
               value="{{ old('date') }}"
               required>
      </div>

      <div class="col-md-3">
        <label class="form-label">{{ $partnerLabel }}</label>
        <select name="partner_id"
                class="form-select"
                required>
          <option value="">---</option>
          @foreach($partners as $partner)
            <option value="{{ $partner->id }}"
              @selected(old('partner_id') == $partner->id)>
              {{ $partner->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-3">
        <label class="form-label">Warehouse</label>
        <select name="warehouse_id"
                class="form-select"
                required>
          <option value="">---</option>
          @foreach($warehouses as $warehouse)
            <option value="{{ $warehouse->id }}"
              @selected(old('warehouse_id') == $warehouse->id)>
              {{ $warehouse->name }}
            </option>
          @endforeach
        </select>
      </div>

    </div>
  </div>

  <!-- Items Table -->
  <div class="px-3 pb-3">
    <table class="table table-bordered table-entry text-center mb-0">
      <thead>
        <tr>
          <th>#</th>
          <th>🔍</th>
          <th>Item</th>
          <th>Barcode</th>
          <th>Category</th>
          <th>Unit</th>
          @if($type === 'in')
            <th>Expiry</th>
          @endif
          <th>Qty</th>
          <th>+</th>
          <th>×</th>
        </tr>
      </thead>

      <tbody id="items-table">
        <tr>
          <td class="row-index">1</td>

          <td>
            <button type="button"
                    class="btn btn-sm btn-light open-item-modal"
                    data-bs-toggle="modal"
                    data-bs-target="#itemSearchModal">🔍</button>
          </td>

          <td>
            <input type="text" class="form-control form-control-sm item-name" readonly>
            <input type="hidden" class="item-id" name="items[0][item_id]" required>
          </td>

          <td><input type="text" class="form-control form-control-sm barcode" readonly></td>
          <td><input type="text" class="form-control form-control-sm category" readonly></td>
          <td><input type="text" class="form-control form-control-sm unit" readonly></td>

          @if($type === 'in')
          <td>
            <input type="date"
                   class="form-control form-control-sm"
                   name="items[0][expiry_date]"
                   required>
          </td>
          @endif

          <td>
            <input type="number"
                   class="form-control form-control-sm quantity"
                   name="items[0][quantity]"
                   min="1"
                   required>
          </td>

          <td><button type="button" class="btn btn-sm btn-light add-row">➕</button></td>
          <td><button type="button" class="btn btn-sm btn-light text-danger delete-row">✖</button></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Actions -->
  <div class="action-bar d-flex justify-content-between">
    <button type="button"
            onclick="window.history.back()"
            class="btn btn-secondary btn-sm">
      Cancel
    </button>

    <button type="submit" class="btn btn-primary btn-sm">
      Save Operation
    </button>
  </div>

</div>
</form>
</main>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Reports</title>
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
.report-card{
  transition:.3s ease;
}
.report-card:hover{
  transform:translateY(-6px);
  box-shadow:0 12px 30px rgba(0,0,0,.12);
}
.icon-box{
  width:56px;
  height:56px;
  border-radius:14px;
  display:flex;
  align-items:center;
  justify-content:center;
}
</style>
</head>

<body class="d-flex vh-100 overflow-hidden">

@include('layouts.sidebar')

<div class="flex-grow-1 d-flex flex-column">

  <!-- Header -->
  <header class="bg-white border-bottom px-4 py-3">
    <nav class="small text-muted">
      Home / <strong class="text-primary">Reports</strong>
    </nav>
  </header>

  <!-- Content -->
  <main class="p-4 overflow-auto">

    <div class="mb-4">
      <h2 class="fw-bold">Reports</h2>
      <p class="text-muted">
        Analyze products, inventory movements, and current stock levels.
      </p>
    </div>

    <div class="row g-4">

      <!-- Product Reports -->
      <div class="col-md-6 col-lg-4">
        <div class="card report-card h-100 p-4">
          <div class="icon-box bg-primary bg-opacity-10 text-primary mb-3">
            <span class="material-symbols-outlined fs-3">inventory_2</span>
          </div>
          <h5 class="fw-bold">Product Reports</h5>
          <p class="text-muted small">
            View detailed reports about products, categories, and movements.
          </p>
          <a href="{{ route('reports.products') }}"
             class="fw-semibold text-primary mt-auto">
            View Report →
          </a>
        </div>
      </div>

      <!-- Inventory Transactions Reports -->
      <div class="col-md-6 col-lg-4">
        <div class="card report-card h-100 p-4">
          <div class="icon-box bg-warning bg-opacity-10 text-warning mb-3">
            <span class="material-symbols-outlined fs-3">swap_horiz</span>
          </div>
          <h5 class="fw-bold">Inventory Transactions</h5>
          <p class="text-muted small">
            Analyze all inventory in, out, return, and correction operations.
          </p>
          <a href="{{ route('reports.operations') }}"
             class="fw-semibold text-warning mt-auto">
            View Report →
          </a>
        </div>
      </div>

      <!-- Stock Reports -->
      <div class="col-md-6 col-lg-4">
        <div class="card report-card h-100 p-4">
          <div class="icon-box bg-success bg-opacity-10 text-success mb-3">
            <span class="material-symbols-outlined fs-3">warehouse</span>
          </div>
          <h5 class="fw-bold">Stock Reports</h5>
          <p class="text-muted small">
            Check current quantities, low stock, and zero stock items.
          </p>
          <a href="{{ route('reports.stock') }}"
             class="fw-semibold text-success mt-auto">
            View Report →
          </a>
        </div>
      </div>

    </div>

  </main>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>{{ $pageTitle }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
  font-family:'Inter',sans-serif;
  background:#f6f6f8;
  direction: ltr;
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
.table td,.table th{
  vertical-align:middle;
  font-size:14px;
}
</style>
</head>

<body class="d-flex vh-100">

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
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <!-- Page Title + Actions -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mb-4">
  <div>
    <h2 class="fw-bold mb-0">{{ $pageTitle }}</h2>
    <p class="text-muted small mb-0">
      Manage all operations related to this type
    </p>
  </div>

  <div class="d-flex gap-2">
    <!-- Back Button -->
    <a href="{{ route('TranscationSelector') }}"
       class="btn btn-outline-secondary">
      <span class="material-symbols-outlined me-1">arrow_back</span>
      Back
    </a>

    <!-- Create Button -->
    <a href="{{ route('operations.create', $type) }}"
       class="btn btn-primary">
      <span class="material-symbols-outlined me-1">add</span>
      Create New Operation
    </a>
  </div>
</div>

    <!-- Operations Table -->
    <div class="card shadow-sm">
      <div class="table-responsive">
        <table class="table table-hover mb-0 text-center">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Operation No</th>
              <th>Date</th>
              <th>
                {{ in_array($type,['in','return_in']) ? 'Supplier' : 'Customer' }}
              </th>
              <th>Warehouse</th>
              <th>Status</th>
              <th>View</th>
            </tr>
          </thead>

          <tbody>
          @forelse($operations as $operation)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td class="fw-semibold">{{ $operation->number }}</td>
              <td>{{ $operation->date }}</td>
              <td>{{ $operation->partner?->name ?? '-' }}</td>
              <td>{{ $operation->warehouse?->name }}</td>
              <td>
                <span class="badge bg-success">
                  {{ ucfirst($operation->status) }}
                </span>
              </td>
              <td>
               <a href="{{ route('operations.show', $operation->id) }}"
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
        {{ $operations->links() }}
      </div>
    </div>

  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

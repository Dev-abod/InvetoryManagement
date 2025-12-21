<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Supplier Management - Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f6f6f8;
    }

    .card {
      border-radius: 14px;
      border: 1px solid #eef1f6;
    }

    .shadow-soft {
      box-shadow: 0 8px 30px rgba(0, 0, 0, .04);
    }

    .table thead th {
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: .05em;
      color: #6b7280;
    }

    .table tbody tr {
      height: 56px;
    }

    .table tbody tr:hover {
      background: #f9fafb;
    }

    .table tbody td:first-child {
      color: #2563eb;
      font-weight: 600;
    }

    .badge {
      border-radius: 8px;
    }

    .sidebar {
      width: 260px;
      background: linear-gradient(to bottom, #0f172a, #1e3a8a);
      color: #cbd5f5;
    }
  </style>

  <script>
    function selectPartner(id, name, phone) {
      document.getElementById('partner_id').value = id;
      document.querySelector('[name="Supplier_Name"]').value = name;
      document.querySelector('[name="Supplier_Phone"]').value = phone ?? '';

      const form = document.getElementById('partnerForm');
      form.action = `{{ url('partners') }}/${id}`;

      if (!document.getElementById('_method')) {
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'PUT';
        method.id = '_method';
        form.appendChild(method);
      }

      document.getElementById('updateBtn').style.display = 'block';
    }

    function deletePartner() {
      const id = document.getElementById('partner_id').value;

      if (!id) {
        alert('Please select a partner first');
        return;
      }

      if (!confirm('Are you sure you want to delete this partner?')) return;

      const form = document.getElementById('deleteForm');
      form.action = `{{ url('partners') }}/${id}`;

      form.submit();

      // ⬅️ الحل
      setTimeout(() => {
        window.location.reload();
      }, 300);
    }

    document.querySelector('button[type="reset"]').addEventListener('click', () => {
      const form = document.getElementById('partnerForm');
      form.action = "{{ route('partners.store') }}";

      const method = document.getElementById('_method');
      if (method) method.remove();

      document.getElementById('updateBtn').style.display = 'none';
      document.getElementById('partner_id').value = '';
    });
  </script>

</head>

<body class="d-flex vh-100 overflow-hidden">

  <!-- Sidebar -->
  <!-- {{-- استدعاء السايدبار --}} -->
  @include('layouts.sidebar')



  <!-- Main -->
  <div class="flex-grow-1 d-flex flex-column">

    <!-- Header -->
    <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
      <div>
        <h5 class="mb-0 fw-semibold">Supplier Management</h5>
        <small class="text-muted">Manage your partner relationships</small>
      </div>

      <div class="d-flex gap-2">
        <button class="btn btn-light rounded-circle">
          <span class="material-symbols-outlined">notifications</span>
        </button>
        <button class="btn btn-light rounded-circle">
          <span class="material-symbols-outlined">settings</span>
        </button>
      </div>
    </header>

    <!-- Content -->
    <main class="p-4 overflow-auto">

      <!-- Search Card -->
      <div class="card shadow-soft mb-4">
        <div class="card-body">
          <h6 class="text-uppercase text-muted fw-semibold mb-3">
            Search Suppliers
          </h6>

          <form method="GET" action="{{ route('partners.search') }}" class="d-flex gap-3">
            <div class="flex-grow-1 position-relative">
              <span class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">
                search
              </span>
              <input type="text"
                name="search"
                class="form-control ps-5"
                placeholder="Enter Supplier ID or Name..."
                required>

            </div>
            <button class="btn btn-primary px-4">Show</button>
          </form>
        </div>
      </div>

      <div class="row g-4">

        <!-- Table -->
        <div class="col-lg-8">
          <div class="card shadow-soft h-100">

            <div class="card-header bg-white d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center gap-2">
                <span class="material-symbols-outlined text-primary">store</span>
                <strong>{{ $List }}</strong>
              </div>
              <div class="d-flex gap-2">
                <button class="btn btn-sm btn-light">
                  <span class="material-symbols-outlined">filter_list</span>
                </button>
                <button class="btn btn-sm btn-light">
                  <span class="material-symbols-outlined"><a href="{{ route('partners.pdf', $type) }}"
                      class="btn btn-sm btn-light">
                      <span class="material-symbols-outlined">download</span>
                    </a>
                  </span>
                </button>
              </div>
            </div>

            <div class="table-responsive">
              <table class="table align-middle mb-0">
                <thead class="table-light">
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th class="text-end">Phone</th>
                  </tr>
                </thead>

                <tbody>
                  @forelse ($partners as $partner)
                  <tr onclick="selectPartner('{{ $partner->id }}', '{{ $partner->name }}', '{{ $partner->phone }}')" style="cursor:pointer">


                    <td>S{{ str_pad($partner->id, 3, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $partner->name }}</td>
                    <td class="text-end">{{ $partner->phone ?? '-' }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="3" class="text-center text-muted py-4">
                      No data found
                    </td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>


          </div>
        </div>

        <!-- Manage Details -->
        <div class="col-lg-4">
          <div class="card shadow-soft sticky-top">

            <div class="card-header fw-bold">
              Manage Details
            </div>

            <div class="card-body">


              <form id="partnerForm"
                action="{{ route('partners.store') }}"
                method="POST">
                @csrf
                <input type="hidden" name="partner_id" id="partner_id">

                <input type="hidden" name="type" value="{{ $type }}">

                <div class="mb-3">
                  <label class="form-label">{{ $Name }}</label>
                  <input type="text"
                    name="Supplier_Name"
                    class="form-control"
                    required>
                </div>

                <div class="mb-4">
                  <label class="form-label">{{ $Phone }}</label>
                  <input type="text"
                    name="Supplier_Phone"
                    class="form-control"
                    required>
                </div>

                <button type="reset" class="btn btn-outline-secondary w-100 mb-3">
                  <span class="material-symbols-outlined me-1">restart_alt</span>
                  Clear to Add New
                </button>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                  <span class="material-symbols-outlined me-1">add</span>
                  Add {{ $Add }}
                </button>


                <div class="d-flex gap-2 mb-3">

                  <button type="submit"
                    class="btn btn-outline-secondary w-50"
                    id="updateBtn">

                    <span class="material-symbols-outlined me-1">edit</span>
                    Update
                  </button>

                  <button class="btn btn-outline-danger w-50"
                    onclick="deletePartner()">
                    <span class="material-symbols-outlined me-1">delete</span>
                    Delete
                  </button>



                </div>
              </form>

              <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
              </form>
            </div>
          </div>

        </div>
    </main>
  </div>

  <!-- popup -->

  @if(session('searchPartners'))
<div class="modal fade show" id="searchModal" tabindex="-1" style="display:block; background:rgba(0,0,0,.5)">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Search Results</h5>
        <a href="{{ url()->current() }}" class="btn-close"></a>
      </div>

      <div class="modal-body p-0">
        <table class="table table-hover mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th class="text-end">Phone</th>
            </tr>
          </thead>
          <tbody>
            @foreach(session('searchPartners') as $partner)
            <tr onclick="selectPartner('{{ $partner->id }}','{{ $partner->name }}','{{ $partner->phone }}')"
                style="cursor:pointer">
              <td>S{{ str_pad($partner->id, 3, '0', STR_PAD_LEFT) }}</td>
              <td>{{ $partner->name }}</td>
              <td class="text-end">{{ $partner->phone ?? '-' }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="modal-footer">
        <a href="{{ url()->current() }}" class="btn btn-secondary">Close</a>
      </div>

    </div>
  </div>
</div>
@endif
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
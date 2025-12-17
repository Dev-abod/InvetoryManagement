<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Quick Product Actions - Inventory System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f6f6f8;
    }

    /* Sidebar */
    .sidebar {
      width: 280px;
      background: linear-gradient(to bottom, #0f172a, #1e3a8a);
      color: #cbd5f5;
    }

    .sidebar a {
      color: #cbd5f5;
      text-decoration: none;
    }

    .sidebar a.active,
    .sidebar a:hover {
      background: #ffffff;
      color: #135bec;
      border-radius: .5rem;
    }

    .brand-icon {
      width: 40px;
      height: 40px;
      background: #135bec;
      border-radius: .75rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Action cards */
    .action-card {
      transition: all .3s ease;
    }

    .action-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, .15);
      border-color: #135bec;
    }

    .icon-circle {
      width: 56px;
      height: 56px;
      border-radius: 50%;
      background: rgba(19, 91, 236, .1);
      color: #135bec;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 32px;
    }
  </style>
</head>

<body class="d-flex vh-100 overflow-hidden">

  <!-- Sidebar -->
 <!-- {{-- استدعاء السايدبار --}} -->
    @include('layouts.sidebar')



  <!-- Main -->
  <div class="flex-grow-1 d-flex flex-column">

    <!-- Header -->
    <header class="bg-white border-bottom px-4 py-3 d-flex justify-content-between align-items-center">
      <div class="text-secondary small">
        Home / <strong class="text-dark">Product Management</strong>
      </div>

      <div class="d-flex align-items-center gap-3">
        <input class="form-control form-control-sm d-none d-md-block" style="width:220px" placeholder="Search inventory">
        <button class="btn btn-light rounded-circle">
          <span class="material-symbols-outlined">notifications</span>
        </button>
      </div>
    </header>

    <!-- Content -->
    <main class="p-4 overflow-auto">
      <div class="mb-4">
        <h2 class="fw-black">Quick Product Actions</h2>
        <p class="text-muted">Manage your inventory essentials efficiently.</p>
      </div>

      <!-- Action Cards -->
      <div class="row g-4 mb-5">


        <div class="col-md-4">
          <div class="card action-card h-100 p-4">
            <a href="{{ route('Products') }}" class="text-decoration-none">

              <div class="icon-circle mb-3">
                <span class="material-symbols-outlined">add_box</span>
              </div>
              <h5 class="fw-bold">Add Product</h5>
              <p class="text-muted small">Create a new inventory item.</p>
            </a>
          </div>
        </div>


        <div class="col-md-4">
          <div class="card action-card h-100 p-4">
             <a href="{{ route('Units') }}" class="text-decoration-none">
            <div class="icon-circle mb-3">
              <span class="material-symbols-outlined">straighten</span>
            </div>
            <h5 class="fw-bold">Add Unit</h5>
            <p class="text-muted small">Define product measurement units.</p>
             </a>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card action-card h-100 p-4">
             <a href="{{ route('Categories') }}" class="text-decoration-none">
            <div class="icon-circle mb-3">
              <span class="material-symbols-outlined">category</span>
            </div>
            <h5 class="fw-bold">Add Category</h5>
            <p class="text-muted small">Organize products into categories.</p>
             </a>
          </div>
        </div>
      </div>

      <!-- Recent Activity -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <strong>Recent Activity</strong>
          <a href="#" class="text-primary small fw-medium">View Full Log</a>
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
              <tr>
                <th>Action</th>
                <th>User</th>
                <th>Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Added “Wireless Mouse M350”</td>
                <td>Alex Morgan</td>
                <td class="text-muted">Just now</td>
                <td><span class="badge bg-success">Completed</span></td>
              </tr>
              <tr>
                <td>Updated Stock “Dell Monitor 24”</td>
                <td>Sarah Jenkins</td>
                <td class="text-muted">2 hours ago</td>
                <td><span class="badge bg-primary">Pending</span></td>
              </tr>
              <tr>
                <td>New Category “Electronics”</td>
                <td>Alex Morgan</td>
                <td class="text-muted">Yesterday</td>
                <td><span class="badge bg-success">Completed</span></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

    </main>
  </div>

</body>

</html>
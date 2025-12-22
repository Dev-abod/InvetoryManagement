<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Partners Overview - Inventory System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <!-- Bootstrap 5 -->
<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f6f6f8;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(to bottom, #0f172a, #1e3a8a);
            color: #fff;
        }

        .sidebar a {
            color: #c7d2fe;
            text-decoration: none;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .sidebar .icon-box {
            background: rgba(19, 91, 236, 0.2);
            padding: 10px;
            border-radius: 10px;
        }

        .card-hover {
            transition: all .3s ease;
        }

        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .12);
        }

        .icon-circle {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }
    </style>
</head>

<body class="vh-100 overflow-hidden">





    <div class="d-flex h-100">


        <!-- Sidebar -->
        <!-- {{-- استدعاء السايدبار --}} -->
        @include('layouts.sidebar')


        <!-- Main -->
        <main class="flex-grow-1 overflow-auto bg-light">

            <div class="container-fluid py-4 px-4">

                <!-- Header -->
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <div>
                        <h2 class="fw-bold">Partners Overview</h2>
                        <p class="text-muted mb-0">Manage your relationships with suppliers and customers.</p>
                    </div>

                    <div class="position-relative" style="width:300px">
                        <span class="material-symbols-outlined position-absolute top-50 start-0 translate-middle-y ms-3 text-muted">search</span>
                        <input type="text" class="form-control ps-5" placeholder="Search partners...">
                    </div>
                </div>

                <!-- Cards -->
                <div class="row g-4 mb-5">
                    <div class="col-md-6">
                        <div class="card card-hover p-4 h-100">
                            <div class="icon-circle bg-primary bg-opacity-10 text-primary mb-3">
                                <span class="material-symbols-outlined">local_shipping</span>
                            </div>
                            <h4 class="fw-bold">Suppliers</h4>
                            <p class="text-muted">
                                Manage supplier profiles, purchase orders, and procurement contracts.
                            </p>
                            <a href="{{ route('partners.suppliers') }}"
                                class="btn btn-outline-primary">
                                Suppliers
                            </a>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card card-hover p-4 h-100">
                            <div class="icon-circle bg-success bg-opacity-10 text-success mb-3">
                                <span class="material-symbols-outlined">storefront</span>
                            </div>
                            <h4 class="fw-bold">Customers</h4>
                            <p class="text-muted">
                                Access customer database and manage contact details.
                            </p>
                            <a href="{{ route('partners.customers') }}"
                                class="btn btn-outline-success">
                                Customers
                            </a>

                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h6 class="fw-bold mb-0">Recent Partners</h6>
                        <a href="#" class="text-primary">View All</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Partner Name</th>
                                    <th>Type</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Acme Logistics Corp</strong></td>
                                    <td><span class="badge bg-primary">Supplier</span></td>
                                    <td>contact@acme.com</td>
                                    <td class="text-success fw-semibold">Active</td>
                                    <td class="text-end">
                                        <span class="material-symbols-outlined text-muted">more_vert</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Global Tech Solutions</strong></td>
                                    <td><span class="badge bg-success">Customer</span></td>
                                    <td>sales@globaltech.io</td>
                                    <td class="text-success fw-semibold">Active</td>
                                    <td class="text-end">
                                        <span class="material-symbols-outlined text-muted">more_vert</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
<script src="{{ asset('assets/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
<!-- Sidebar -->
<aside class="sidebar d-flex flex-column p-4">
  <div class="d-flex align-items-center gap-3 mb-4">
    <div class="brand-icon">
      <span class="material-symbols-outlined">inventory_2</span>
    </div>
    <div>
      <h6 class="mb-0 fw-bold text-white">NEXUS INV</h6>
      <small class="text-secondary">Admin Dashboard</small>
    </div>
  </div>

  <ul class="nav nav-pills flex-column gap-2 mb-auto">

    <!-- Home -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : 'text-white' }}"
        href="{{ route('home') }}">
        <span class="material-symbols-outlined me-2">home</span>
        Home
      </a>
    </li>

    <!-- Product Management -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('ProductManagement') ? 'active fw-semibold' : 'text-white' }}"
        href="{{ route('ProductManagement') }}">
        <span class="material-symbols-outlined me-2">inventory</span>
        Product Management
      </a>

    </li>

    <!-- Partners -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('SupplierCustomer') ? 'active fw-semibold' : 'text-white' }}"
        href="{{ route('SupplierCustomer') }}">
        <span class="material-symbols-outlined me-2">group</span>
        Partners
      </a>
    </li>

    <!-- Transaction Management -->
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('TranscationSelector') ? 'active fw-semibold' : 'text-white' }}"
        href="{{ route('TranscationSelector') }}">
        <span class="material-symbols-outlined me-2">sync_alt</span>
        Transaction Management
      </a>
    </li>

      <!-- Inventory Management -->
    <!-- <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('TranscationSelector') ? 'active fw-semibold' : 'text-white' }}"
        href="#">
        <span class="material-symbols-outlined me-2">sync_alt</span>
         Inventory Management
      </a>
    </li> -->

    <!-- Reports -->
    <li class="nav-item">
      <a class="nav-link  text-white" href="#"><span class="material-symbols-outlined me-2">bar_chart</span>Reports</a>
    </li>
  </ul>

  <div class="border-top border-light pt-3 d-flex align-items-center gap-3">
    <img src="https://via.placeholder.com/40" class="rounded-circle" alt="User">
    <div>
      <div class="fw-semibold text-white">Jane Doe</div>
      <small class="text-secondary">Super Admin</small>
    </div>
  </div>
</aside>
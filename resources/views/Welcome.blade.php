<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome - Inventory Management System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f6f6f8;
    }

    .avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background-size: cover;
      background-position: center;
    }

    .navbar-blur {
      backdrop-filter: blur(8px);
      background: rgba(246, 246, 248, .9);
    }

    .hero-img {
      aspect-ratio: 1 / 1;
      width: 100%;
      overflow: hidden;
    }

    .hero-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }




    .team-card {
      transition: .3s ease;
    }

    .team-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, .15);
    }

    .avatar {
      width: 96px;
      height: 96px;
      border-radius: 50%;
      background-size: cover;
      background-position: center;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top navbar-blur border-bottom">
    <div class="container">
      <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="#">
        <span class="material-symbols-outlined text-primary">inventory_2</span>
        InventorySys
      </a>
      <a href="{{route('login')}}" class="btn btn-primary d-flex align-items-center gap-1">
        Login <span class="material-symbols-outlined">login</span>
      </a>

    </div>
  </nav>

  <!-- Hero -->
  <section class="pt-5 mt-5">
    <div class="container py-5">
      <div class="row align-items-center g-5">
        <div class="col-lg-6 text-center text-lg-start">
          <h1 class="fw-black display-5">
            Smart <span class="text-primary">Inventory Management</span> System
          </h1>
          <p class="lead text-muted mt-4">
            Manage stock efficiently, track inventory in real time, and make data-driven
             decisions with a powerful and easy-to-use platform.
          </p>

          

          <div class="d-flex flex-wrap gap-4 mt-5 justify-content-center justify-content-lg-start text-muted small">
            <span>✔ Real-time Sync</span>
            <span>✔ 99.9% Uptime</span>
            <span>✔ 24/7 Support</span>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="hero-img">
            <img
              src="{{ asset('images/Inventory.jpg') }}"
              class="avatar mx-auto mb-3 d-block"
              alt="Abdullah"
              loading="eager">
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <!-- Team -->
  <section class="bg-white py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold">Meet the Creators</h2>
        <p class="text-muted mt-3">
          The talented individuals behind our inventory system.
        </p>
      </div>

      <div class="row g-4" style="justify-content: center;">
        <!-- Member -->

        <!-- Abduulah -->
        <div class="col-sm-6 col-lg-2">
          <div class="team-card text-center p-4 rounded bg-light h-100">
            <div class="avatar mx-auto mb-3">
              <img
                src="{{ asset('images/team/Abdullah.webp') }}"
                class="avatar mx-auto mb-3 d-block"
                alt="Abdullah"
                loading="eager">
            </div>
            <h6 class="fw-bold mb-0">Abdullah</h6>
            <small class="text-primary">UI/UX Designer</small>
          </div>
        </div>

        <!-- ala'a -->
        <div class="col-sm-6 col-lg-2">
          <div class="team-card text-center p-4 rounded bg-light h-100">
            <div class="avatar mx-auto mb-3">
              <img
                src="{{ asset('images/team/alaa.webp') }}"
                class="avatar mx-auto mb-3 d-block"
                alt="Abdullah"
                loading="eager">
            </div>
            <h6 class="fw-bold mb-0">Ala'a</h6>
            <small class="text-primary">Data Analizy</small>
          </div>
        </div>

        <!-- Mohammed -->
        <div class="col-sm-6 col-lg-2">
          <div class="team-card text-center p-4 rounded bg-light h-100">
            <div class="avatar mx-auto mb-3">
              <img
                src="{{ asset('images/team/mohammed.webp') }}"
                class="avatar mx-auto mb-3 d-block"
                alt="Abdullah"
                loading="eager">
            </div>
            <h6 class="fw-bold mb-0">Mohammed</h6>
            <small class="text-primary">UI/UX Designer</small>
          </div>
        </div>


        <!-- Ahmed -->
        <div class="col-sm-6 col-lg-2">
          <div class="team-card text-center p-4 rounded bg-light h-100">
            <div class="avatar mx-auto mb-3">
              <img
                src="{{ asset('images/team/ahmed.webp') }}"
                class="avatar mx-auto mb-3 d-block"
                alt="Abdullah"
                loading="eager">
            </div>
            <h6 class="fw-bold mb-0">Ahmed</h6>
            <small class="text-primary">Frontend Developer</small>
          </div>
        </div>


        <!-- Zoher -->
        <div class="col-sm-6 col-lg-2">
          <div class="team-card text-center p-4 rounded bg-light h-100">
            <div class="avatar mx-auto mb-3">
              <img
                src="{{ asset('images/team/zoher.webp') }}"
                class="avatar mx-auto mb-3 d-block"
                alt="Abdullah"
                loading="eager">
            </div>
            <h6 class="fw-bold mb-0">Zoher</h6>
            <small class="text-primary">Backend Developer</small>
          </div>
        </div>

        <!-- كرر نفس الكارد لبقية الأعضاء -->
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="py-5 border-top">
    <div class="container text-center">
      <div class="fw-bold mb-3">
        <span class="material-symbols-outlined text-primary">inventory_2</span>
        InventorySys
      </div>

      <div class="d-flex justify-content-center gap-4 mb-3">
        <a href="#" class="text-muted text-decoration-none">Privacy</a>
        <a href="#" class="text-muted text-decoration-none">Terms</a>
        <a href="#" class="text-muted text-decoration-none">Support</a>
      </div>

      <p class="text-muted small mb-0">
        © 2023 Inventory Management System. All rights reserved.
      </p>
    </div>
  </footer>

</body>

</html>
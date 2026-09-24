<div class="row">
  <!-- Congratulations Card -->
  <div class="col-lg-8 mb-4 order-0">
    <div class="card h-100">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Selamat Datang, <?= ucfirst($this->session->userdata('nama')); ?>! 🎉</h5>
            <p class="mb-4">
              Anda memiliki <span class="fw-bold">4</span> pesan baru dan <span class="fw-bold">2</span> artikel menunggu review hari ini.
            </p>
            <a href="<?= base_url('index.php/admin/manajemen_menu'); ?>" class="btn btn-sm btn-outline-primary">Lihat Manajemen Menu</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <!-- Jika gambar ilustrasi bawaan template Sneat tersedia -->
            <img src="<?= base_url('assets/assets/img/illustrations/man-with-laptop.png') ?>" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop.png" data-app-light-img="illustrations/man-with-laptop.png" onerror="this.style.display='none'">
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Stats Cards -->
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-user-check"></i></span>
              </div>
            </div>
            <span class="fw-semibold d-block mb-1">Pengunjung Aktif</span>
            <h3 class="card-title mb-2">1,234</h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0">
                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-group"></i></span>
              </div>
            </div>
            <span>Total Member</span>
            <h3 class="card-title text-nowrap mb-1">4,679</h3>
            <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +14.82%</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Profit Overview -->
  <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
          <h5 class="m-0 me-2">Statistik Artikel</h5>
          <small class="text-muted">Total Keseluruhan</small>
        </div>
      </div>
      <div class="card-body mt-3">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="d-flex flex-column align-items-center gap-1">
            <h2 class="mb-2">124</h2>
            <span>Artikel Terpublikasi</span>
          </div>
          <div id="orderStatisticsChart"></div>
        </div>
        <ul class="p-0 m-0">
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-book"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Kajian Islami</h6>
                <small class="text-muted">Artikel rutin</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">82</small>
              </div>
            </div>
          </li>
          <li class="d-flex mb-4 pb-1">
            <div class="avatar flex-shrink-0 me-3">
              <span class="avatar-initial rounded bg-label-success"><i class="bx bx-calendar-event"></i></span>
            </div>
            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
              <div class="me-2">
                <h6 class="mb-0">Kegiatan</h6>
                <small class="text-muted">Dokumentasi</small>
              </div>
              <div class="user-progress">
                <small class="fw-semibold">42</small>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </div>
  
  <!-- Activity -->
  <div class="col-md-6 col-lg-8 order-1 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">Aktivitas Terkini</h5>
      </div>
      <div class="card-body">
        <p>Belum ada aktivitas hari ini. Tambahkan artikel atau data baru untuk melihat grafik aktivitas mingguan Anda.</p>
        <div class="alert alert-primary d-flex" role="alert">
          <span class="badge badge-center rounded-pill bg-primary border-label-primary p-3 me-2"><i class="bx bx-command fs-6"></i></span>
          <div class="d-flex flex-column ps-1">
            <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">Gunakan Manajemen Menu (SMC)</h6>
            <span>Anda bisa mengatur menu navigasi utama situs web pada tab Manajemen Menu.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
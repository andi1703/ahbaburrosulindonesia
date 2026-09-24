<?php $uri = $this->uri->segment(2); ?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme shadow-sm border-end">
  <div class="app-brand demo">
    <a href="#" class="app-brand-link">
      <span class="app-brand-logo demo">
        <!-- SVG Sneat Logo -->
        <svg width="25" viewBox="0 0 25 42" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <defs>
            <path d="M13.7918663,0.358365126 L3.39788168,7.44174259 C0.566865006,9.69408886 -0.379795268,12.4788597 0.557900856,15.7960551 C0.68998853,16.2305145 1.09562888,17.7872135 3.12357076,19.2293357 C3.8146334,19.7207684 5.32369333,20.3834223 7.65075054,21.2172976 L7.59773219,21.2525164 L2.63468769,24.5493413 C0.445452254,26.3002124 0.0884951797,28.5083815 1.56381646,31.1738486 C2.83770406,32.8170431 5.20850219,33.2640127 7.09180128,32.5391577 C8.347334,32.0559211 11.4559176,30.0011079 16.4175519,26.3747182 C18.0338572,24.4997857 18.6973423,22.4544883 18.4080071,20.2398461 C17.963753,17.5346866 16.1776345,15.5799961 13.0496516,14.3747546 L10.9194936,13.4715819 L18.6192054,7.984237 C20.0480965,6.62180362 20.3168172,4.86976856 19.4172421,2.72145326 C18.4116087,0.485121287 16.3262608,-0.20336125 13.7918663,0.358365126 Z" id="path-1"></path>
          </defs>
          <g id="g-app-brand" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="Brand-Logo" transform="translate(-27.000000, -15.000000)">
              <g id="Icon" transform="translate(27.000000, 15.000000)">
                <g id="Mask" transform="translate(0.000000, 8.000000)">
                  <mask id="mask-2" fill="white">
                    <use xlink:href="#path-1"></use>
                  </mask>
                  <use fill="#696cff" xlink:href="#path-1"></use>
                </g>
              </g>
            </g>
          </g>
        </svg>
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2 text-uppercase">Ahbaburrosul</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-block" id="custom-sidebar-toggle">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>
  <ul class="menu-inner py-1">
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Utama</span></li>
    <li class="menu-item <?= ($uri == 'dashboard' || $uri == '') ? 'active' : '' ?>">
        <a href="<?= base_url('index.php/admin/dashboard'); ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i> <div data-i18n="Analytics">Dashboard</div>
        </a>
    </li>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Konten CMS</span></li>
    <?php if(has_access('admin/manajemen_menu')): ?>
    <li class="menu-item <?= ($uri == 'manajemen_menu') ? 'active' : '' ?>">
        <a href="<?= base_url('index.php/admin/manajemen_menu'); ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-menu"></i> <div>Manajemen Menu (SMC)</div>
        </a>
    </li>
    <?php endif; ?>

    <?php if(has_access('back_artikel')): ?>
    <li class="menu-item <?= ($uri == 'back_artikel' || $this->uri->segment(1) == 'back_artikel') ? 'active' : '' ?>">
        <a href="<?= base_url('index.php/back_artikel'); ?>" class="menu-link">
            <i class="menu-icon tf-icons bx bx-news"></i> <div>Manajemen Artikel</div>
        </a>
    </li>
    <?php endif; ?>

    <li class="menu-header small text-uppercase"><span class="menu-header-text">Pengaturan</span></li>

    <?php if(has_access('back_role')): ?>
    <li class="menu-item <?= ($this->uri->segment(1) == 'back_role') ? 'active' : '' ?>">
      <a href="<?= base_url('index.php/back_role'); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-shield-quarter"></i> <div>Master Kategori User</div>
      </a>
    </li>
    <?php endif; ?>

    <?php if(has_access('back_user')): ?>
    <li class="menu-item <?= ($this->uri->segment(1) == 'back_user') ? 'active' : '' ?>">
      <a href="<?= base_url('index.php/back_user'); ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i> <div>Manajemen Pengguna</div>
      </a>
    </li>
    <?php endif; ?>
    
    <?php if(has_access('master_data')): ?>
    <li class="menu-item <?= ($uri == 'master_kategori' || $this->uri->segment(1) == 'back_identitas' || $this->uri->segment(1) == 'back_sosmed' || $this->uri->segment(1) == 'back_slider' || $this->uri->segment(1) == 'back_galeri' || $this->uri->segment(1) == 'back_video' || $this->uri->segment(1) == 'back_agenda') ? 'active open' : '' ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-cog"></i>
        <div>Master Data</div>
      </a>
      <ul class="menu-sub">
        <?php if(has_access('back_identitas')): ?><li class="menu-item <?= ($this->uri->segment(1) == 'back_identitas') ? 'active' : '' ?>"><a href="<?= base_url('index.php/back_identitas') ?>" class="menu-link">Identitas Web</a></li><?php endif; ?>
        <?php if(has_access('admin/master_kategori')): ?><li class="menu-item <?= ($uri == 'master_kategori') ? 'active' : '' ?>"><a href="<?= base_url('index.php/admin/master_kategori') ?>" class="menu-link">Kategori Artikel</a></li><?php endif; ?>
        <?php if(has_access('back_sosmed')): ?><li class="menu-item <?= ($this->uri->segment(1) == 'back_sosmed') ? 'active' : '' ?>"><a href="<?= base_url('index.php/back_sosmed') ?>" class="menu-link">Sosial Media</a></li><?php endif; ?>
        <?php if(has_access('back_slider')): ?><li class="menu-item <?= ($this->uri->segment(1) == 'back_slider') ? 'active' : '' ?>"><a href="<?= base_url('index.php/back_slider') ?>" class="menu-link">Slider Beranda</a></li><?php endif; ?>
        <?php if(has_access('back_galeri')): ?><li class="menu-item <?= ($this->uri->segment(1) == 'back_galeri') ? 'active' : '' ?>"><a href="<?= base_url('index.php/back_galeri') ?>" class="menu-link">Galeri Kegiatan</a></li><?php endif; ?>
        <?php if(has_access('back_video')): ?><li class="menu-item <?= ($this->uri->segment(1) == 'back_video') ? 'active' : '' ?>"><a href="<?= base_url('index.php/back_video') ?>" class="menu-link">Video Dakwah</a></li><?php endif; ?>
        <?php if(has_access('back_agenda')): ?><li class="menu-item <?= ($this->uri->segment(1) == 'back_agenda') ? 'active' : '' ?>"><a href="<?= base_url('index.php/back_agenda') ?>" class="menu-link">Agenda Kajian</a></li><?php endif; ?>
      </ul>
    </li>
    <?php endif; ?>
  </ul>
</aside>

    <!-- Layout container -->
    <div class="layout-page">
      <!-- Navbar -->
      <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-block d-xl-none">
          <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
          </a>
        </div>
        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
          <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
              <i class="bx bx-search fs-4 lh-0"></i>
              <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
            </div>
          </div>
          <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
              <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                  <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;font-weight:bold;">
                    <?= strtoupper(substr($this->session->userdata('nama') ?? 'A', 0, 1)); ?>
                  </div>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:40px;height:40px;font-weight:bold;">
                            <?= strtoupper(substr($this->session->userdata('nama') ?? 'A', 0, 1)); ?>
                          </div>
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <span class="fw-semibold d-block"><?= $this->session->userdata('nama'); ?></span>
                        <small class="text-muted">Admin</small>
                      </div>
                    </div>
                  </a>
                </li>
                <li><div class="dropdown-divider"></div></li>
                <li>
                  <a class="dropdown-item" href="<?= base_url('index.php/admin/logout') ?>">
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">

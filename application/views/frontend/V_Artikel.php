<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ========================================================
     HEADER HERO SECTION ARTIKEL (NU Online Vibe)
     ======================================================== -->
<section class="bg-majelis-dark text-white pt-5 pb-4 mt-5" style="background: linear-gradient(135deg, #0a2e1c 0%, #0f5132 100%);">
  <div class="container pt-4">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2" style="letter-spacing:1px; font-size:0.75rem;">
          <i class="bx bx-news me-1"></i> Khazanah & Wawasan Islam
        </span>
        <h1 class="fw-extrabold text-white display-6 mb-2">Artikel Majelis Ahbaburrosul</h1>
        <p class="text-white-50 mb-3" style="font-size: 0.95rem;">
          Kumpulan tulisan, wawasan keislaman, nasihat ulama, dan info kegiatan terkini.
        </p>
      </div>
      <!-- Live Search Bar -->
      <div class="col-lg-5">
        <form action="<?= base_url('index.php/artikel'); ?>" method="GET" class="position-relative">
          <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white p-1">
            <input type="text" name="q" value="<?= htmlspecialchars($keyword ?? ''); ?>"
              class="form-control border-0 ps-3 shadow-none"
              placeholder="Cari judul artikel, topik, atau kata kunci..."
              style="font-size:0.9rem;">
            <button class="btn btn-warning rounded-pill px-4 fw-bold text-dark" type="submit">
              <i class="bx bx-search fs-5 align-middle"></i>
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Horizontal Category Pills Filter (NU Online Style) -->
    <div class="mt-4 pt-2 border-top border-secondary border-opacity-25">
      <div class="nu-pill-nav align-items-center">
        <span class="text-white-50 me-2 small fw-semibold"><i class="bx bx-filter-alt"></i> Kategori:</span>
        <a href="<?= base_url('index.php/artikel'); ?>"
          class="nu-pill-item <?= empty($selected_category) ? 'active' : ''; ?>">
          Semua Kategori
        </a>
        <?php if (!empty($categories)): ?>
          <?php foreach ($categories as $cat): ?>
            <?php $is_cat_active = (($selected_category ?? '') == $cat['nama_kategori']); ?>
            <a href="<?= base_url('index.php/artikel/kategori/' . urlencode($cat['nama_kategori'])); ?>"
              class="nu-pill-item <?= $is_cat_active ? 'active' : ''; ?>">
              <?= htmlspecialchars($cat['nama_kategori']); ?>
            </a>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<!-- ========================================================
     MAIN KONTEN ARTIKEL & SIDEBAR (NU ONLINE GRID 8:4)
     ======================================================== -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">

      <!-- KIRI (8 KOLOM): HEADLINE & DAFTAR ARTIKEL -->
      <div class="col-lg-8">

        <?php if (!empty($keyword)): ?>
          <div class="alert alert-success d-flex align-items-center justify-content-between rounded-3 mb-4 shadow-sm">
            <div>
              <i class="bx bx-search-alt fs-4 me-2"></i>
              Hasil pencarian untuk kata kunci: <strong>"<?= htmlspecialchars($keyword); ?>"</strong>
            </div>
            <a href="<?= base_url('index.php/artikel'); ?>" class="btn btn-sm btn-outline-success">Reset</a>
          </div>
        <?php endif; ?>

        <!-- 1. HEADLINE FEATURED ARTICLE (Gaya NU Online - Gambar Responsif 16:9) -->
        <?php if (!empty($featured_artikel)): ?>
          <div class="nu-featured-card mb-5">
            <div class="nu-featured-img-wrapper">
              <?php
              $cover = !empty($featured_artikel['gambar_cover'])
                ? base_url('assets/img/artikel/' . $featured_artikel['gambar_cover'])
                : base_url('assets/img/no-image.png');
              ?>
              <a href="<?= base_url('index.php/artikel/detail/' . $featured_artikel['slug_artikel']); ?>">
                <img src="<?= $cover; ?>"
                  alt="<?= htmlspecialchars($featured_artikel['judul_artikel']); ?>"
                  onerror="this.src='<?= base_url('assets/img/no-image.png'); ?>';">
              </a>
            </div>
            <div class="p-4 bg-white">
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-majelis-primary px-3 py-1 rounded-pill" style="font-size:0.75rem;">
                  <?= htmlspecialchars($featured_artikel['nama_kategori'] ?? 'Umum'); ?>
                </span>
                <span class="text-muted small">
                  <i class="bx bx-calendar me-1"></i>
                  <?= date('d M Y', strtotime($featured_artikel['tanggal_dibuat'])); ?>
                </span>
                <span class="text-muted small ms-auto">
                  <i class="bx bx-show me-1"></i>
                  <?= number_format($featured_artikel['dibaca'] ?? 0); ?> Dilihat
                </span>
              </div>

              <h2 class="mb-3">
                <a href="<?= base_url('index.php/artikel/detail/' . $featured_artikel['slug_artikel']); ?>"
                  class="nu-featured-title">
                  <?= htmlspecialchars($featured_artikel['judul_artikel']); ?>
                </a>
              </h2>

              <p class="text-secondary mb-3 line-clamp-3" style="font-size:0.95rem; line-height:1.6;">
                <?= htmlspecialchars(strip_tags($featured_artikel['ringkasan'] ?? substr(strip_tags($featured_artikel['konten'] ?? ''), 0, 180))); ?>...
              </p>

              <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                <div class="d-flex align-items-center gap-2">
                  <div class="bg-majelis-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width:34px; height:34px; font-size:0.8rem;">
                    <?= strtoupper(substr($featured_artikel['nama_penulis'] ?? 'A', 0, 1)); ?>
                  </div>
                  <span class="small fw-semibold text-dark">
                    <?= htmlspecialchars($featured_artikel['nama_penulis'] ?? 'Redaksi Ahbaburrosul'); ?>
                  </span>
                </div>
                <a href="<?= base_url('index.php/artikel/detail/' . $featured_artikel['slug_artikel']); ?>"
                  class="btn btn-sm btn-warning text-dark fw-bold px-3 rounded-pill">
                  Baca Selengkapnya <i class="bx bx-right-arrow-alt"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- SECTION TITLE ARTIKEL TEBARU -->
        <?php $artikel_list = $artikel_list ?? []; ?>
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h4 class="fw-bold text-majelis-dark m-0">
            <i class="bx bx-grid-alt text-majelis-primary me-2"></i>
            <?= !empty($selected_category) ? 'Artikel ' . htmlspecialchars($selected_category) : 'Daftar Artikel'; ?>
          </h4>
          <span class="text-muted small">
            Total <?= count($artikel_list) + (!empty($featured_artikel) ? 1 : 0); ?> Artikel
          </span>
        </div>

        <!-- 2. LIST VIEW ARTIKEL SEKUNDER (NU ONLINE STYLE EXPLICIT LAYOUT) -->
        <?php if (!empty($artikel_list)): ?>
          <div class="nu-list-container">
            <?php foreach ($artikel_list as $art): ?>
              <?php
              $art_cover = !empty($art['gambar_cover'])
                ? base_url('assets/img/artikel/' . $art['gambar_cover'])
                : base_url('assets/img/no-image.png');

              // Format Tanggal & Jam Release Bahasa Indonesia (NU Online Format: Rabu, 26 Agustus 2026 | 22:46 WIB)
              $time = strtotime($art['tanggal_dibuat']);
              $hari_arr = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
              $bulan_arr = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

              $hari = $hari_arr[date('l', $time)] ?? date('l', $time);
              $tgl = date('j', $time);
              $bln = $bulan_arr[(int)date('n', $time)] ?? date('F', $time);
              $thn = date('Y', $time);
              $jam = date('H:i', $time);

              $tgl_release = "$hari, $tgl $bln $thn | $jam WIB";
              ?>
              <div class="nu-list-item">
                <div class="row g-3 align-items-center">
                  <!-- Konten Teks Kiri -->
                  <div class="col-8 col-sm-8">
                    <!-- Badge Kategori & Subtag -->
                    <div>
                      <span class="nu-list-badge">
                        <?= htmlspecialchars($art['nama_kategori'] ?? 'Opini'); ?>
                      </span>
                      <?php if (!empty($art['tag_artikel'])): ?>
                        <span class="nu-list-subtag">
                          <?= htmlspecialchars(strtoupper(explode(',', $art['tag_artikel'])[0])); ?>
                        </span>
                      <?php endif; ?>
                    </div>

                    <!-- Judul Artikel -->
                    <h5 class="m-0">
                      <a href="<?= base_url('index.php/artikel/detail/' . $art['slug_artikel']); ?>"
                        class="nu-list-title">
                        <?= htmlspecialchars($art['judul_artikel']); ?>
                      </a>
                    </h5>

                    <!-- Tanggal & Jam Release -->
                    <div class="nu-list-date">
                      <?= $tgl_release; ?>
                    </div>
                  </div>

                  <!-- Gambar Thumbnail Kanan -->
                  <div class="col-4 col-sm-4 text-end d-flex justify-content-end">
                    <a href="<?= base_url('index.php/artikel/detail/' . $art['slug_artikel']); ?>" class="nu-list-img-wrapper">
                      <img src="<?= $art_cover; ?>"
                        alt="<?= htmlspecialchars($art['judul_artikel']); ?>"
                        onerror="this.src='<?= base_url('assets/img/no-image.png'); ?>';">
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <?php if (empty($featured_artikel)): ?>
            <div class="bg-white rounded-3 p-5 text-center shadow-sm border">
              <i class="bx bx-news fs-1 text-muted mb-2"></i>
              <h5 class="fw-bold text-dark">Belum ada artikel ditemukan</h5>
              <p class="text-muted small">Silakan pilih kategori lain atau gunakan kata kunci pencarian yang berbeda.</p>
              <a href="<?= base_url('index.php/artikel'); ?>" class="btn btn-majelis-primary rounded-pill btn-sm px-4">
                Tampilkan Semua Artikel
              </a>
            </div>
          <?php endif; ?>
        <?php endif; ?>

      </div>

      <!-- KANAN (4 KOLOM): SIDEBAR STICKY (NU ONLINE VIBE) -->
      <div class="col-lg-4">
        <div class="nu-sticky-sidebar d-flex flex-column gap-4">

          <!-- WIDGET 1: TERPOPULER (SORTED BY DIBACA DESC) -->
          <div class="bg-white rounded-3 p-3 shadow-sm border">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
              <h5 class="fw-bold text-majelis-dark m-0 d-flex align-items-center gap-2" style="font-size:1.05rem;">
                <span class="bg-warning text-dark rounded-circle px-2 py-1 fs-6 fw-bold">#</span>
                Terpopuler
              </h5>
              <span class="badge bg-light text-success border border-success px-2 py-1" style="font-size:0.7rem;">Paling Banyak Dibaca</span>
            </div>

            <?php if (!empty($artikel_populer)): ?>
              <div class="d-flex flex-column">
                <?php $rank = 1; ?>
                <?php foreach ($artikel_populer as $pop): ?>
                  <div class="nu-popular-item">
                    <span class="nu-popular-num"><?= $rank++; ?></span>
                    <div>
                      <span class="badge bg-light text-success border px-2 py-0 rounded-pill mb-1" style="font-size:0.65rem;">
                        <?= htmlspecialchars($pop['nama_kategori'] ?? 'Umum'); ?>
                      </span>
                      <a href="<?= base_url('index.php/artikel/detail/' . $pop['slug_artikel']); ?>"
                        class="nu-popular-title d-block mb-1">
                        <?= htmlspecialchars($pop['judul_artikel']); ?>
                      </a>
                      <div class="text-muted" style="font-size:0.72rem;">
                        <i class="bx bx-show me-1"></i> <?= number_format($pop['dibaca'] ?? 0); ?> dibaca
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <p class="text-muted small m-0">Belum ada data artikel populer.</p>
            <?php endif; ?>
          </div>

          <!-- WIDGET 2: TERKINI (5 TERBARU) -->
          <div class="bg-white rounded-3 p-3 shadow-sm border">
            <div class="border-bottom pb-2 mb-3">
              <h5 class="fw-bold text-majelis-dark m-0 d-flex align-items-center gap-2" style="font-size:1.05rem;">
                <i class="bx bx-time-five text-success"></i>
                Terkini
              </h5>
            </div>

            <?php if (!empty($artikel_terkini)): ?>
              <div class="d-flex flex-column gap-3">
                <?php foreach ($artikel_terkini as $tk): ?>
                  <div class="border-bottom pb-2">
                    <span class="text-success small fw-semibold d-block mb-1" style="font-size:0.7rem;">
                      <?= htmlspecialchars($tk['nama_kategori'] ?? 'Artikel'); ?> • <?= date('d/m/Y', strtotime($tk['tanggal_dibuat'])); ?>
                    </span>
                    <a href="<?= base_url('index.php/artikel/detail/' . $tk['slug_artikel']); ?>"
                      class="nu-terkini-title d-block">
                      <?= htmlspecialchars($tk['judul_artikel']); ?>
                    </a>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </div>

          <!-- WIDGET 3: TAG POPULER CLOUD -->
          <div class="bg-white rounded-3 p-3 shadow-sm border">
            <h6 class="fw-bold text-majelis-dark border-bottom pb-2 mb-3">
              <i class="bx bx-purchase-tag-alt text-warning me-1"></i> Topik Populer
            </h6>
            <div class="d-flex flex-wrap gap-1">
              <a href="<?= base_url('index.php/artikel?q=Dakwah'); ?>" class="badge bg-light text-dark border p-2 text-decoration-none hover-shadow">#Dakwah</a>
              <a href="<?= base_url('index.php/artikel?q=Majelis'); ?>" class="badge bg-light text-dark border p-2 text-decoration-none hover-shadow">#Majelis</a>
              <a href="<?= base_url('index.php/artikel?q=Sholawat'); ?>" class="badge bg-light text-dark border p-2 text-decoration-none hover-shadow">#Sholawat</a>
              <a href="<?= base_url('index.php/artikel?q=Hikmah'); ?>" class="badge bg-light text-dark border p-2 text-decoration-none hover-shadow">#Hikmah</a>
              <a href="<?= base_url('index.php/artikel?q=Kajian'); ?>" class="badge bg-light text-dark border p-2 text-decoration-none hover-shadow">#Kajian</a>
              <a href="<?= base_url('index.php/artikel?q=Aswaja'); ?>" class="badge bg-light text-dark border p-2 text-decoration-none hover-shadow">#Aswaja</a>
            </div>
          </div>

          <!-- WIDGET 4: BANNER APP / INFO MAJELIS -->
          <div class="bg-majelis-dark text-white rounded-3 p-4 shadow-sm position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #0a2e1c 0%, #157347 100%); border-top: 4px solid #c9a84c;">
            <span class="badge bg-warning text-dark fw-bold mb-2">Majelis Ahbaburrosul</span>
            <h5 class="fw-bold mb-2">Ikuti Kajian & Amalan Rutin</h5>
            <p class="text-white-50 small mb-3" style="font-size:0.82rem;">
              Dapatkan info jadwal majelis, amalan ibadah harian, serta khazanah Islam langsung dari Majelis.
            </p>
            <a href="<?= base_url('index.php/amalan'); ?>" class="btn btn-warning text-dark fw-bold btn-sm rounded-pill px-4">
              Lihat Amalan <i class="bx bx-right-arrow-alt"></i>
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
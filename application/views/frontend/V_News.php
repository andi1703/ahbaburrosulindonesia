<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ========================================================
     HEADER HERO SECTION NEWS & BERITA MAJELIS
     ======================================================== -->
<section class="bg-majelis-dark text-white pt-5 pb-4 mt-5" style="background: linear-gradient(135deg, #0a2e1c 0%, #157347 100%);">
  <div class="container pt-4">
    <div class="row align-items-center">
      <div class="col-lg-7">
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold text-uppercase mb-2" style="letter-spacing:1px; font-size:0.75rem;">
          <i class="bx bx-news me-1"></i> Warta & Berita Resmi
        </span>
        <h1 class="fw-extrabold text-white display-6 mb-2">Berita Majelis Ahbaburrosul</h1>
        <p class="text-white-50 mb-3" style="font-size: 0.95rem;">
          Informasi kegiatan, liputan silaturahmi akbar, pengumuman resmi, dan warta majelis terkini.
        </p>
      </div>
      <!-- Live Search Bar -->
      <div class="col-lg-5">
        <form action="<?= base_url('index.php/news'); ?>" method="GET" class="position-relative">
          <div class="input-group shadow-sm rounded-pill overflow-hidden bg-white p-1">
            <input type="text" name="q" value="<?= htmlspecialchars($keyword ?? ''); ?>"
              class="form-control border-0 ps-3 shadow-none"
              placeholder="Cari berita atau pengumuman..."
              style="font-size:0.9rem;">
            <button class="btn btn-warning rounded-pill px-4 fw-bold text-dark" type="submit">
              <i class="bx bx-search fs-5 align-middle"></i>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<!-- ========================================================
     MAIN KONTEN NEWS & SIDEBAR
     ======================================================== -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row g-4">

      <!-- KIRI (8 KOLOM): HEADLINE & DAFTAR BERITA -->
      <div class="col-lg-8">

        <?php if (!empty($keyword)): ?>
          <div class="alert alert-success d-flex align-items-center justify-content-between rounded-3 mb-4 shadow-sm">
            <div>
              <i class="bx bx-search-alt fs-4 me-2"></i>
              Hasil pencarian berita: <strong>"<?= htmlspecialchars($keyword); ?>"</strong>
            </div>
            <a href="<?= base_url('index.php/news'); ?>" class="btn btn-sm btn-outline-success">Reset</a>
          </div>
        <?php endif; ?>

        <!-- 1. HEADLINE NEWS ARTICLE -->
        <?php if (!empty($featured_news)): ?>
          <div class="nu-featured-card mb-5">
            <div class="nu-featured-img-wrapper">
              <?php
              $cover = !empty($featured_news['gambar_cover'])
                ? base_url('assets/img/artikel/' . $featured_news['gambar_cover'])
                : base_url('assets/img/no-image.png');
              ?>
              <a href="<?= base_url('index.php/artikel/detail/' . $featured_news['slug_artikel']); ?>">
                <img src="<?= $cover; ?>"
                  alt="<?= htmlspecialchars($featured_news['judul_artikel']); ?>"
                  onerror="this.src='<?= base_url('assets/img/no-image.png'); ?>';">
              </a>
            </div>
            <div class="p-4 bg-white">
              <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge bg-danger px-3 py-1 rounded-pill" style="font-size:0.75rem;">
                  <i class="bx bx-radio-circle-marked me-1"></i> Utamanya Warta
                </span>
                <span class="text-muted small">
                  <i class="bx bx-calendar me-1"></i>
                  <?= date('d M Y', strtotime($featured_news['tanggal_dibuat'])); ?>
                </span>
                <span class="text-muted small ms-auto">
                  <i class="bx bx-show me-1"></i>
                  <?= number_format($featured_news['dibaca'] ?? 0); ?> Dilihat
                </span>
              </div>

              <h2 class="mb-3">
                <a href="<?= base_url('index.php/artikel/detail/' . $featured_news['slug_artikel']); ?>"
                  class="nu-featured-title">
                  <?= htmlspecialchars($featured_news['judul_artikel']); ?>
                </a>
              </h2>

              <p class="text-secondary mb-3 line-clamp-3" style="font-size:0.95rem; line-height:1.6;">
                <?= htmlspecialchars(strip_tags($featured_news['ringkasan'] ?? substr(strip_tags($featured_news['konten'] ?? ''), 0, 180))); ?>...
              </p>

              <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                <div class="d-flex align-items-center gap-2">
                  <div class="bg-majelis-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width:34px; height:34px; font-size:0.8rem;">
                    <?= strtoupper(substr($featured_news['nama_penulis'] ?? 'R', 0, 1)); ?>
                  </div>
                  <span class="small fw-semibold text-dark">
                    <?= htmlspecialchars($featured_news['nama_penulis'] ?? 'Redaksi Ahbaburrosul'); ?>
                  </span>
                </div>
                <a href="<?= base_url('index.php/artikel/detail/' . $featured_news['slug_artikel']); ?>"
                  class="btn btn-sm btn-warning text-dark fw-bold px-3 rounded-pill">
                  Baca Berita Lengkap <i class="bx bx-right-arrow-alt"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- SECTION TITLE BERITA TEBARU -->
        <div class="d-flex align-items-center justify-content-between mb-3">
          <h4 class="fw-bold text-majelis-dark m-0">
            <i class="bx bx-news text-majelis-primary me-2"></i> Warta & Liputan Terkini
          </h4>
          <span class="text-muted small">
            Total <?= count($news_list) + (!empty($featured_news) ? 1 : 0); ?> Berita
          </span>
        </div>

        <!-- 2. LIST VIEW NEWS -->
        <?php if (!empty($news_list)): ?>
          <div class="nu-list-container">
            <?php foreach ($news_list as $news): ?>
              <?php
              $news_cover = !empty($news['gambar_cover'])
                ? base_url('assets/img/artikel/' . $news['gambar_cover'])
                : base_url('assets/img/no-image.png');

              $time = strtotime($news['tanggal_dibuat']);
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
                  <div class="col-8 col-sm-8">
                    <div>
                      <span class="nu-list-badge bg-danger">
                        News
                      </span>
                    </div>

                    <h5 class="m-0">
                      <a href="<?= base_url('index.php/artikel/detail/' . $news['slug_artikel']); ?>"
                        class="nu-list-title">
                        <?= htmlspecialchars($news['judul_artikel']); ?>
                      </a>
                    </h5>

                    <div class="nu-list-date">
                      <?= $tgl_release; ?>
                    </div>
                  </div>

                  <div class="col-4 col-sm-4 text-end d-flex justify-content-end">
                    <a href="<?= base_url('index.php/artikel/detail/' . $news['slug_artikel']); ?>" class="nu-list-img-wrapper">
                      <img src="<?= $news_cover; ?>"
                        alt="<?= htmlspecialchars($news['judul_artikel']); ?>"
                        onerror="this.src='<?= base_url('assets/img/no-image.png'); ?>';">
                    </a>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <?php if (empty($featured_news)): ?>
            <div class="bg-white rounded-3 p-5 text-center shadow-sm border">
              <i class="bx bx-news fs-1 text-muted mb-2"></i>
              <h5 class="fw-bold text-dark">Belum ada berita ditemukan</h5>
              <p class="text-muted small">Silakan cari menggunakan kata kunci pencarian yang lain.</p>
              <a href="<?= base_url('index.php/news'); ?>" class="btn btn-majelis-primary rounded-pill btn-sm px-4">
                Tampilkan Semua Berita
              </a>
            </div>
          <?php endif; ?>
        <?php endif; ?>

      </div>

      <!-- KANAN (4 KOLOM): SIDEBAR STICKY -->
      <div class="col-lg-4">
        <div class="nu-sticky-sidebar d-flex flex-column gap-4">

          <!-- WIDGET 1: NEWS TERPOPULER -->
          <div class="bg-white rounded-3 p-3 shadow-sm border">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
              <h5 class="fw-bold text-majelis-dark m-0 d-flex align-items-center gap-2" style="font-size:1.05rem;">
                <span class="bg-danger text-white rounded-circle px-2 py-1 fs-6 fw-bold">#</span>
                Berita Populer
              </h5>
              <span class="badge bg-light text-danger border border-danger px-2 py-1" style="font-size:0.7rem;">Paling Banyak Dibaca</span>
            </div>

            <?php if (!empty($news_populer)): ?>
              <div class="d-flex flex-column">
                <?php $rank = 1; ?>
                <?php foreach ($news_populer as $pop): ?>
                  <div class="nu-popular-item">
                    <span class="nu-popular-num text-danger bg-light"><?= $rank++; ?></span>
                    <div>
                      <span class="badge bg-danger px-2 py-0 rounded-pill mb-1" style="font-size:0.65rem;">
                        News
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
              <p class="text-muted small m-0">Belum ada berita populer.</p>
            <?php endif; ?>
          </div>

          <!-- WIDGET 2: BANNER INFO -->
          <div class="bg-majelis-dark text-white rounded-3 p-4 shadow-sm position-relative overflow-hidden"
            style="background: linear-gradient(135deg, #0a2e1c 0%, #157347 100%); border-top: 4px solid #c9a84c;">
            <span class="badge bg-warning text-dark fw-bold mb-2">Warta Majelis</span>
            <h5 class="fw-bold mb-2">Seputar Kegiatan Majelis</h5>
            <p class="text-white-50 small mb-3" style="font-size:0.82rem;">
              Temukan pula ribuan artikel khazanah, nasihat ulama, dan amalan ibadah harian jamaah.
            </p>
            <a href="<?= base_url('index.php/artikel'); ?>" class="btn btn-warning text-dark fw-bold btn-sm rounded-pill px-4">
              Lihat Karya Tulis <i class="bx bx-right-arrow-alt"></i>
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>

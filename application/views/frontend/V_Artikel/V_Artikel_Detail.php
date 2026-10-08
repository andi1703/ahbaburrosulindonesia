<?php
defined('BASEPATH') or exit('No direct script access allowed');
$artikel = $artikel ?? [];
?>

<!-- MAIN DETAIL ARTIKEL & SIDEBAR -->
<section class="py-5 bg-white mt-5 pt-5">
  <div class="container pt-3">
    <div class="row g-4">

      <!-- KIRI: KONTEN DETAIL ARTIKEL -->
      <div class="col-lg-8">
        <article class="pe-lg-3">

          <!-- Judul Artikel -->
          <h1 class="fw-bold text-dark display-6 mb-4" style="line-height:1.3;">
            <?= htmlspecialchars($artikel['judul_artikel']); ?>
          </h1>

          <!-- Meta Data Penulis, Tag, Tanggal, Views -->
          <div class="d-flex flex-wrap align-items-center gap-3 text-muted border-top border-bottom py-2 mb-4" style="font-size:0.85rem;">
            <div class="d-flex align-items-center gap-2">
              <div class="bg-majelis-primary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width:32px; height:32px; font-size:0.8rem;">
                <?= strtoupper(substr($artikel['nama_penulis'] ?? 'A', 0, 1)); ?>
              </div>
              <span class="fw-semibold text-dark">
                <?= htmlspecialchars($artikel['nama_penulis'] ?? 'Redaksi Ahbaburrosul'); ?>
              </span>
            </div>
            <?php if (!empty($artikel['tag_artikel'])): ?>
              <span>•</span>
              <span class="text-success fw-bold">
                <i class="bx bx-purchase-tag-alt me-1"></i>
                <?= htmlspecialchars(trim(explode(',', $artikel['tag_artikel'])[0])); ?>
              </span>
            <?php endif; ?>
            <span>•</span>
            <span><i class="bx bx-calendar text-success me-1"></i> <?= date('d F Y - H:i', strtotime($artikel['tanggal_dibuat'])); ?> WIB</span>
            <span>•</span>
            <span><i class="bx bx-show text-success me-1"></i> <?= number_format($artikel['dibaca'] ?? 0); ?> Dilihat</span>
          </div>

          <!-- Gambar Cover Utama -->
          <?php if (!empty($artikel['gambar_cover'])): ?>
            <div class="mb-4 rounded-3 overflow-hidden shadow-sm">
              <img src="<?= base_url('assets/img/artikel/' . $artikel['gambar_cover']); ?>"
                alt="<?= htmlspecialchars($artikel['judul_artikel']); ?>"
                class="w-100 object-fit-cover"
                style="max-height: 480px;"
                onerror="this.src='<?= base_url('assets/img/no-image.png'); ?>';">
              <?php if (!empty($artikel['ket_gambar'])): ?>
                <div class="bg-light p-2 px-3 text-muted small fst-italic border-bottom text-center">
                  <i class="bx bx-image-alt me-1"></i> <?= htmlspecialchars($artikel['ket_gambar']); ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>

          <!-- Ringkasan Singkat (Quote Box) -->
          <?php if (!empty($artikel['ringkasan'])): ?>
            <div class="p-3 mb-4 rounded-3 bg-light border-start border-4 border-success fst-italic text-secondary" style="font-size:1.02rem; line-height:1.6;">
              "<?= htmlspecialchars($artikel['ringkasan']); ?>"
            </div>
          <?php endif; ?>

          <!-- Isi Konten Artikel -->
          <div class="article-content text-dark mb-5" style="font-size:1.05rem; line-height:1.8;">
            <?= $artikel['konten']; ?>
          </div>

          <!-- Tags -->
          <?php if (!empty($artikel['tag_artikel'])): ?>
            <div class="d-flex align-items-center gap-2 mb-4 pt-3 border-top">
              <span class="fw-bold text-dark small"><i class="bx bx-purchase-tag-alt me-1 text-warning"></i> Tag:</span>
              <?php
              $tags = explode(',', $artikel['tag_artikel']);
              foreach ($tags as $tag):
                $t = trim($tag);
                if (empty($t)) continue;
              ?>
                <a href="<?= base_url('index.php/artikel?q=' . urlencode($t)); ?>" class="badge bg-light text-dark border p-2 text-decoration-none">
                  #<?= htmlspecialchars($t); ?>
                </a>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <!-- Tombol Bagikan Media Sosial -->
          <div class="bg-light rounded-3 p-3 d-flex align-items-center justify-content-between mb-5 shadow-sm">
            <span class="fw-bold text-dark small"><i class="bx bx-share-alt text-success me-1"></i> Bagikan Artikel Ini:</span>
            <div class="d-flex gap-2">
              <?php $curr_url = current_url(); ?>
              <a href="https://api.whatsapp.com/send?text=<?= urlencode($artikel['judul_artikel'] . ' ' . $curr_url); ?>"
                target="_blank" class="btn btn-sm btn-success rounded-circle px-2" title="Bagikan ke WhatsApp">
                <i class="bx bxl-whatsapp fs-5"></i>
              </a>
              <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($curr_url); ?>"
                target="_blank" class="btn btn-sm btn-primary rounded-circle px-2" title="Bagikan ke Facebook">
                <i class="bx bxl-facebook fs-5"></i>
              </a>
              <a href="https://twitter.com/intent/tweet?url=<?= urlencode($curr_url); ?>&text=<?= urlencode($artikel['judul_artikel']); ?>"
                target="_blank" class="btn btn-sm btn-dark rounded-circle px-2" title="Bagikan ke Twitter/X">
                <i class="bx bxl-twitter fs-5"></i>
              </a>
            </div>
          </div>

          <!-- ARTIKEL TERKAIT -->
          <?php if (!empty($artikel_terkait)): ?>
            <div class="pt-4 border-top">
              <h4 class="fw-bold text-majelis-dark mb-4">
                <i class="bx bx-grid-alt text-success me-2"></i> Artikel Terkait
              </h4>
              <div class="row g-3">
                <?php foreach ($artikel_terkait as $rel): ?>
                  <?php
                  $rel_img = !empty($rel['gambar_cover'])
                    ? base_url('assets/img/artikel/' . $rel['gambar_cover'])
                    : base_url('assets/img/no-image.png');
                  ?>
                  <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-3 h-100 overflow-hidden">
                      <div class="row g-0 align-items-center">
                        <div class="col-4">
                          <img src="<?= $rel_img; ?>"
                            alt="<?= htmlspecialchars($rel['judul_artikel']); ?>"
                            class="w-100 h-100 object-fit-cover" style="min-height:90px;"
                            onerror="this.src='<?= base_url('assets/img/no-image.png'); ?>';">
                        </div>
                        <div class="col-8 p-3">
                          <span class="badge bg-light text-success border px-2 py-0 rounded-pill mb-1" style="font-size:0.65rem;">
                            <?= htmlspecialchars($rel['nama_kategori'] ?? 'Artikel'); ?>
                          </span>
                          <h6 class="mb-1">
                            <a href="<?= base_url('index.php/artikel/detail/' . $rel['slug_artikel']); ?>"
                              class="text-dark fw-bold text-decoration-none hover-primary line-clamp-2" style="font-size:0.85rem;">
                              <?= htmlspecialchars($rel['judul_artikel']); ?>
                            </a>
                          </h6>
                          <span class="text-muted extra-small" style="font-size:0.72rem;">
                            <?= date('d M Y', strtotime($rel['tanggal_dibuat'])); ?>
                          </span>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endif; ?>

        </article>
      </div>

      <!-- KANAN: SIDEBAR TERPOPULER & TERKINI -->
      <div class="col-lg-4">
        <div class="nu-sticky-sidebar d-flex flex-column gap-4">

          <!-- WIDGET 1: TERPOPULER -->
          <div class="bg-white rounded-3 p-3 shadow-sm border">
            <div class="d-flex align-items-center justify-content-between border-bottom pb-2 mb-3">
              <h5 class="fw-bold text-majelis-dark m-0 d-flex align-items-center gap-2" style="font-size:1.05rem;">
                <span class="bg-warning text-dark rounded-circle px-2 py-1 fs-6 fw-bold">#</span>
                Terpopuler
              </h5>
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
            <?php endif; ?>
          </div>

          <!-- WIDGET 2: BANNER MAJELIS -->
          <div class="bg-majelis-dark text-white rounded-3 p-4 shadow-sm" style="background: linear-gradient(135deg, #0a2e1c 0%, #157347 100%);">
            <h5 class="fw-bold text-warning mb-2">Majelis Ahbaburrosul</h5>
            <p class="text-white-50 small mb-3">
              Dapatkan sajian tausiyah, artikel khazanah, dan informasi jadwal majelis rutin.
            </p>
            <a href="<?= base_url('index.php/artikel'); ?>" class="btn btn-warning text-dark fw-bold btn-sm rounded-pill px-4">
              Jelajahi Artikel Lainnya
            </a>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
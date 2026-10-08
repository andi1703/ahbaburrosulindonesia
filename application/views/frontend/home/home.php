<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ===================================================
     1. HERO SLIDER (CMS Driven)
     =================================================== -->
<section id="heroSlider">
    <?php if (!empty($sliders)): ?>
        <div id="carouselHero" class="carousel carousel-fade slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <?php foreach ($sliders as $idx => $sl): ?>
                    <button type="button" data-bs-target="#carouselHero" data-bs-slide-to="<?= $idx; ?>"
                        class="<?= $idx === 0 ? 'active' : ''; ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($sliders as $idx => $sl): ?>
                    <div class="carousel-item <?= $idx === 0 ? 'active' : ''; ?>">
                        <img src="<?= base_url('assets/img/slider/' . $sl['gambar']); ?>"
                            class="hero-slide-img d-block w-100"
                            alt="<?= htmlspecialchars($sl['judul_slider']); ?>">
                        <div class="hero-overlay">
                            <div class="hero-content">
                                <h1 class="mb-2"><?= htmlspecialchars($sl['judul_slider']); ?></h1>
                                <?php if (!empty($sl['sub_judul'])): ?>
                                    <p class="mt-2 mb-0" style="letter-spacing:1px; font-size:.9rem; opacity:.8;">
                                        <?= htmlspecialchars($sl['sub_judul']); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselHero" data-bs-slide="prev">
                <i class='bx bx-chevron-left text-white' style="font-size:1.5rem;"></i>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselHero" data-bs-slide="next">
                <i class='bx bx-chevron-right text-white' style="font-size:1.5rem;"></i>
            </button>
        </div>
    <?php else: ?>
        <div style="background:linear-gradient(135deg,#0a2e1c,#0f5132); height:calc(100vh - 72px - 65px); min-height:460px; display:flex; align-items:center; justify-content:center;">
            <div class="hero-content">
                <p class="mb-2 font-arabic" style="font-size:1.3rem; opacity:.8;">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</p>
                <h1>Selamat Datang di Majelis Ahbaburrosul Indonesia</h1>
                <p><?= htmlspecialchars($identitas['slogan'] ?? ''); ?></p>
            </div>
        </div>
    <?php endif; ?>
</section>


<!-- ===================================================
     AGENDA TICKER BAR (NiceSchool Style)
     =================================================== -->
<?php if (!empty($agenda)): ?>
    <div id="agendaTicker">
        <div class="container-fluid px-0">
            <div class="d-flex align-items-stretch" id="agendaScroll">
                <?php
                $hari_indo = [
                    'Sunday' => 'Minggu',
                    'Monday' => 'Senin',
                    'Tuesday' => 'Selasa',
                    'Wednesday' => 'Rabu',
                    'Thursday' => 'Kamis',
                    'Friday' => 'Jumat',
                    'Saturday' => 'Sabtu'
                ];
                foreach ($agenda as $ag):
                ?>
                    <div class="agenda-item d-flex align-items-center justify-content-center">
                        <div class="agenda-date text-center text-uppercase me-3">
                            <span class="day fw-bold"><?= $hari_indo[date('l', strtotime($ag['tanggal']))]; ?></span>
                            <span class="time d-block"><?= date('H:i', strtotime($ag['jam'])); ?> WIB</span>
                        </div>
                        <div class="agenda-title">
                            <p class="mb-0 fw-bold text-white">
                                <?= htmlspecialchars(mb_strimwidth($ag['nama_kegiatan'], 0, 35, '...')); ?>
                            </p>
                            <?php if (!empty($ag['tempat'])): ?>
                                <small class="text-white-50">
                                    <i class='bx bx-map-pin me-1'></i>
                                    <?= htmlspecialchars(mb_strimwidth($ag['tempat'], 0, 40, '...')); ?>
                                </small>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <style>
        #agendaTicker {
            background: var(--majelis-primary);
            position: relative;
            z-index: 10;
            margin-top: 0;
            box-shadow: 0 -4px 20px rgba(0, 0, 0, 0.2);
        }

        #agendaScroll {
            overflow-x: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        #agendaScroll::-webkit-scrollbar {
            display: none;
        }

        .agenda-item {
            flex: 1;
            min-width: 260px;
            padding: 1.1rem 1.5rem;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .agenda-item:last-child {
            border-right: none;
        }

        .agenda-date {
            color: var(--majelis-gold);
            flex-shrink: 0;
        }

        .agenda-date .day {
            font-size: 1rem;
            line-height: 1.2;
        }

        .agenda-date .time {
            font-size: 0.78rem;
            opacity: 0.9;
        }

        .agenda-title p {
            font-size: 0.88rem;
            line-height: 1.3;
        }

        .agenda-title small {
            font-size: 0.78rem;
        }
    </style>
<?php endif; ?>


<!-- ===================================================
     2. ARTIKEL TERBARU + POPULER (NiceSchool Style)
     =================================================== -->
<section id="artikel-section" class="py-5 bg-white" style="background-color: #ffffff !important;">
    <div class="container">

        <!-- Section Header -->
        <div class="text-center mb-4">
            <h2 class="d-flex align-items-center justify-content-center gap-3 fw-800 mb-2"
                style="font-size:clamp(1.4rem,3vw,2rem);color:var(--majelis-dark);">
                <span style="flex:1;max-width:80px;height:2px;background:var(--majelis-primary);opacity:.4;"></span>
                Artikel &amp; Kajian
                <span style="flex:1;max-width:80px;height:2px;background:var(--majelis-primary);opacity:.4;"></span>
            </h2>
            <p class="text-muted" style="font-size:.9rem;">Kumpulan tulisan dan kajian islami dari Majelis Ahbaburrosul Indonesia</p>
        </div>

        <!-- Filter Tabs — dinamis berdasarkan kategori artikel -->
        <?php
        $kategori_unik = [];
        if (!empty($artikel_terbaru)) {
            foreach ($artikel_terbaru as $a) {
                $kat = $a['nama_kategori'] ?? '';
                if ($kat && !in_array($kat, $kategori_unik)) $kategori_unik[] = $kat;
            }
        }
        ?>
        <div class="d-flex justify-content-center flex-wrap gap-2 mb-4" id="artikelTabs">
            <button class="btn-tab-artikel active" data-filter="semua">Semua</button>
            <?php foreach ($kategori_unik as $kat): ?>
                <button class="btn-tab-artikel" data-filter="<?= htmlspecialchars($kat); ?>">
                    <?= htmlspecialchars($kat); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Article Cards Grid — hanya dari artikel_terbaru, difilter per kategori -->
        <div class="row g-3" id="artikelGrid">

            <?php if (!empty($artikel_terbaru)): ?>
                <?php foreach ($artikel_terbaru as $art): ?>
                    <div class="col-lg-6 artikel-card-wrap" data-kategori="<?= htmlspecialchars($art['nama_kategori'] ?? ''); ?>">
                        <a href="<?= base_url('index.php/artikel/' . $art['slug_artikel']); ?>"
                            class="artikel-card-h text-decoration-none d-flex">
                            <div class="artikel-card-img">
                                <img src="<?= base_url('assets/img/artikel/' . $art['gambar_cover']); ?>"
                                    alt="<?= htmlspecialchars($art['judul_artikel']); ?>"
                                    data-fallback-src="<?= base_url('assets/frontend/img/no-img.jpg'); ?>">
                            </div>
                            <div class="artikel-card-body">
                                <?php if (!empty($art['nama_kategori'])): ?>
                                    <span class="artikel-badge"><?= htmlspecialchars($art['nama_kategori']); ?></span>
                                <?php endif; ?>
                                <h6 class="artikel-card-title">
                                    <?= htmlspecialchars(mb_strimwidth($art['judul_artikel'], 0, 70, '...')); ?>
                                </h6>
                                <div class="artikel-meta">
                                    <span><i class='bx bx-calendar'></i> <?= date('d M Y', strtotime($art['tanggal_dibuat'])); ?></span>
                                    <span><i class='bx bx-show'></i> <?= number_format($art['dibaca']); ?> dibaca</span>
                                </div>
                                <p class="artikel-excerpt">
                                    <?= htmlspecialchars(mb_strimwidth($art['ringkasan'] ?? '', 0, 110, '...')); ?>
                                </p>
                                <span class="artikel-readmore">Baca Selengkapnya <i class='bx bx-right-arrow-alt'></i></span>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class='bx bx-news bx-lg d-block mb-2 opacity-25'></i>Belum ada artikel
                </div>
            <?php endif; ?>

        </div>

        <!-- Lihat Semua -->
        <div class="text-center mt-4">
            <a href="<?= base_url('index.php/artikel'); ?>"
                class="btn px-5 py-2 fw-600"
                style="border:2px solid var(--majelis-primary);color:var(--majelis-primary);border-radius:99px;font-size:.9rem;">
                Lihat Semua Artikel <i class='bx bx-right-arrow-alt'></i>
            </a>
        </div>

    </div>
</section>

<!-- ===================================================
     3. NEWS TERKINI
     =================================================== -->
<?php if (!empty($artikel_news)): ?>
    <section id="news-section" class="py-5 bg-white" style="background-color: #ffffff !important;">
        <div class="container">

            <!-- Section Header -->
            <div class="text-center mb-5">
                <h2 class="d-flex align-items-center justify-content-center gap-3 fw-800 mb-2"
                    style="font-size:clamp(1.4rem,3vw,2rem);color:var(--majelis-dark);">
                    <span style="flex:1;max-width:60px;height:2px;background:var(--majelis-primary);opacity:.5;"></span>
                    News & Update
                    <span style="flex:1;max-width:60px;height:2px;background:var(--majelis-primary);opacity:.5;"></span>
                </h2>
                <p class="text-muted" style="font-size:.9rem;">Informasi dan berita terbaru seputar kegiatan Majelis Ahbaburrosul Indonesia</p>
            </div>

            <!-- News Cards -->
            <div class="row g-4 justify-content-center">
                <?php foreach ($artikel_news as $news): ?>
                    <div class="col-md-4">
                        <a href="<?= base_url('index.php/artikel/' . $news['slug_artikel']); ?>"
                            class="news-card text-decoration-none d-block">
                            <!-- Gambar -->
                            <div class="news-card-img">
                                <img src="<?= base_url('assets/img/artikel/' . $news['gambar_cover']); ?>"
                                    alt="<?= htmlspecialchars($news['judul_artikel']); ?>"
                                    data-fallback-src="<?= base_url('assets/frontend/img/no-img.jpg'); ?>">
                            </div>
                            <!-- Konten -->
                            <div class="news-card-body">
                                <span class="news-cat">News</span>
                                <h6 class="news-title"><?= htmlspecialchars(mb_strimwidth($news['judul_artikel'], 0, 80, '...')); ?></h6>
                                <div class="news-meta">
                                    <span><i class='bx bx-calendar'></i> <?= date('d M Y', strtotime($news['tanggal_dibuat'])); ?></span>
                                    <span><i class='bx bx-show'></i> <?= number_format($news['dibaca']); ?> dibaca</span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Lihat Semua -->
            <div class="text-center mt-4">
                <a href="<?= base_url('index.php/news'); ?>"
                    class="btn px-5 py-2 fw-600"
                    style="border:2px solid var(--majelis-primary);color:var(--majelis-primary);border-radius:99px;font-size:.9rem;">
                    Lihat Semua Berita <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>

        </div>
    </section>
<?php endif; ?>

<!-- ===================================================
     VIDEO DAKWAH (Asymmetrical Premium Grid)
     =================================================== -->
<section id="video-section" class="py-5 bg-white" style="background-color: #ffffff !important;">
    <div class="container">

        <!-- Section Header -->
        <div class="text-center mb-5">
            <h2 class="d-flex align-items-center justify-content-center gap-3 fw-800 mb-2"
                style="font-size:clamp(1.4rem,3vw,2rem);color:var(--majelis-dark);">
                <span style="flex:1;max-width:60px;height:2px;background:var(--majelis-primary);opacity:.5;"></span>
                Video Dakwah
                <span style="flex:1;max-width:60px;height:2px;background:var(--majelis-primary);opacity:.5;"></span>
            </h2>
            <p class="text-muted" style="font-size:.9rem;">Kumpulan dokumentasi video kajian dan dakwah Majelis Ahbaburrosul Indonesia</p>
        </div>

        <?php if (!empty($videos)): ?>
            <?php
            $count = count($videos);
            if ($count >= 5):
                $center_video = $videos[0];
                $left_videos  = [$videos[1], $videos[2]];
                $right_videos = [$videos[3], $videos[4]];
            ?>
                <!-- Asymmetrical Layout (5 videos) -->
                <div class="row g-4 align-items-stretch">

                    <!-- Left Column (2 Small Videos) -->
                    <div class="col-lg-3 col-md-6 col-12 d-flex flex-column justify-content-between gap-4">
                        <?php foreach ($left_videos as $v): ?>
                            <div class="video-card small-card" data-video-id="<?= htmlspecialchars($v['id_youtube'], ENT_QUOTES, 'UTF-8'); ?>" data-video-title="<?= htmlspecialchars($v['judul_video'], ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="video-thumbnail-wrapper">
                                    <img src="https://img.youtube.com/vi/<?= $v['id_youtube']; ?>/hqdefault.jpg"
                                        alt="<?= htmlspecialchars($v['judul_video']); ?>"
                                        class="video-thumbnail"
                                        data-fallback-src="<?= base_url('assets/img/no-image.png'); ?>">
                                    <div class="video-play-btn">
                                        <i class="bx bx-play-circle"></i>
                                    </div>
                                </div>
                                <div class="video-card-body">
                                    <h6 class="video-title text-start mb-0"><?= htmlspecialchars($v['judul_video']); ?></h6>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Center Column (1 Large Video) -->
                    <div class="col-lg-6 col-12">
                        <div class="video-card large-card h-100 d-flex flex-column" data-video-id="<?= htmlspecialchars($center_video['id_youtube'], ENT_QUOTES, 'UTF-8'); ?>" data-video-title="<?= htmlspecialchars($center_video['judul_video'], ENT_QUOTES, 'UTF-8'); ?>">
                            <div class="video-thumbnail-wrapper flex-grow-1">
                                <img src="https://img.youtube.com/vi/<?= $center_video['id_youtube']; ?>/hqdefault.jpg"
                                    alt="<?= htmlspecialchars($center_video['judul_video']); ?>"
                                    class="video-thumbnail"
                                    data-fallback-src="<?= base_url('assets/img/no-image.png'); ?>">
                                <div class="video-play-btn large-play">
                                    <i class="bx bx-play-circle"></i>
                                </div>
                            </div>
                            <div class="video-card-body">
                                <h5 class="video-title text-start mb-0 fw-bold" style="color: var(--majelis-primary);"><?= htmlspecialchars($center_video['judul_video']); ?></h5>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column (2 Small Videos) -->
                    <div class="col-lg-3 col-md-6 col-12 d-flex flex-column justify-content-between gap-4">
                        <?php foreach ($right_videos as $v): ?>
                            <div class="video-card small-card" data-video-id="<?= htmlspecialchars($v['id_youtube'], ENT_QUOTES, 'UTF-8'); ?>" data-video-title="<?= htmlspecialchars($v['judul_video'], ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="video-thumbnail-wrapper">
                                    <img src="https://img.youtube.com/vi/<?= $v['id_youtube']; ?>/hqdefault.jpg"
                                        alt="<?= htmlspecialchars($v['judul_video']); ?>"
                                        class="video-thumbnail"
                                        data-fallback-src="<?= base_url('assets/img/no-image.png'); ?>">
                                    <div class="video-play-btn">
                                        <i class="bx bx-play-circle"></i>
                                    </div>
                                </div>
                                <div class="video-card-body">
                                    <h6 class="video-title text-start mb-0"><?= htmlspecialchars($v['judul_video']); ?></h6>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            <?php else: ?>
                <!-- Standard Grid Layout for < 5 videos -->
                <div class="row g-4 justify-content-center">
                    <?php foreach ($videos as $v): ?>
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="video-card small-card h-100" data-video-id="<?= htmlspecialchars($v['id_youtube'], ENT_QUOTES, 'UTF-8'); ?>" data-video-title="<?= htmlspecialchars($v['judul_video'], ENT_QUOTES, 'UTF-8'); ?>">
                                <div class="video-thumbnail-wrapper">
                                    <img src="https://img.youtube.com/vi/<?= $v['id_youtube']; ?>/hqdefault.jpg"
                                        alt="<?= htmlspecialchars($v['judul_video']); ?>"
                                        class="video-thumbnail"
                                        data-fallback-src="<?= base_url('assets/img/no-image.png'); ?>">
                                    <div class="video-play-btn">
                                        <i class="bx bx-play-circle"></i>
                                    </div>
                                </div>
                                <div class="video-card-body">
                                    <h6 class="video-title text-start mb-0"><?= htmlspecialchars($v['judul_video']); ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5 text-muted">
                <i class='bx bx-video-off bx-lg d-block mb-2 opacity-25'></i>Belum ada video dakwah.
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Modal Video YouTube -->
<div class="modal fade" id="modalVideo" tabindex="-1" aria-labelledby="modalVideoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content video-modal-content border-0">
            <div class="modal-header video-modal-header py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="modal-title video-modal-title" id="modalVideoLabel">Play Video</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe id="youtubePlayer" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===================================================
     4. SEJARAH / PROFIL MAJELIS
     =================================================== -->





<!-- ===================================================
     5. GALERI KEGIATAN
     =================================================== -->
<?php if (!empty($galeri)): ?>
    <!-- CSS Styling Khusus Galeri Asimetris Premium -->
    <style>
        .gallery-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 16px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
            transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease;
            background: #eaeaea;
        }

        .gallery-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            z-index: 2;
        }

        .gallery-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .gallery-wrapper:hover img {
            transform: scale(1.06);
        }

        /* Overlay teks saat hover */
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to top, rgba(10, 46, 28, 0.85) 0%, rgba(10, 46, 28, 0.2) 60%, transparent 100%);
            display: flex;
            align-items: flex-end;
            padding: 1.25rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .gallery-wrapper:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-text {
            transform: translateY(10px);
            transition: transform 0.35s ease;
        }

        .gallery-wrapper:hover .gallery-text {
            transform: translateY(0);
        }

        /* Aspect Ratio yang responsif - 3/2 untuk foto wide (col-8),
           sedangkan foto narrow (col-4) mengisi penuh tinggi kolom agar sejajar sempurna! */
        .gallery-wide {
            aspect-ratio: 3 / 2;
        }

        .gallery-narrow {
            flex: 1 1 auto;
            height: 100%;
        }

        /* Responsivitas untuk Tab & Handphone */
        @media (max-width: 576px) {
            .gallery-wrapper {
                border-radius: 12px;
            }

            .gallery-overlay {
                padding: 0.75rem;
            }

            .gallery-overlay h6 {
                font-size: 0.78rem !important;
            }

            .gallery-overlay small {
                font-size: 0.65rem !important;
            }
        }
    </style>

    <section class="py-5 bg-white" style="background-color: #ffffff !important;">
        <div class="container">

            <!-- Section Header (Serasi dengan Berita Terkini) -->
            <div class="text-center mb-5">
                <h2 class="d-flex align-items-center justify-content-center gap-3 fw-800 mb-2"
                    style="font-size:clamp(1.4rem,3vw,2rem);color:var(--majelis-dark);">
                    <span style="flex:1;max-width:60px;height:2px;background:var(--majelis-primary);opacity:.5;"></span>
                    Galeri Kegiatan
                    <span style="flex:1;max-width:60px;height:2px;background:var(--majelis-primary);opacity:.5;"></span>
                </h2>
                <p class="text-muted" style="font-size:.9rem;">Dokumentasi dan foto rangkaian kegiatan Majelis Ahbaburrosul Indonesia</p>
            </div>

            <div class="row g-4">
                <?php
                // Tampilkan maksimal 8 foto pertama di homepage agar grid simetris
                $homepage_galeri = array_slice($galeri, 0, 8);
                $chunks = array_chunk($homepage_galeri, 4);
                foreach ($chunks as $chunk):
                ?>
                    <!-- Setiap block berisi 4 foto dibungkus col-lg-6 sehingga di desktop ada 2 block berdampingan -->
                    <div class="col-lg-6 col-12">
                        <div class="row g-3 align-items-stretch">

                            <!-- Foto 1: Wide (col-8) -->
                            <?php if (isset($chunk[0])): $foto = $chunk[0]; ?>
                                <div class="col-8">
                                    <div class="gallery-wrapper gallery-wide"
                                        data-bs-toggle="modal" data-bs-target="#modalFoto"
                                        data-gallery-image="<?= htmlspecialchars(base_url('assets/img/galeri/' . $foto['file_foto']), ENT_QUOTES, 'UTF-8'); ?>" data-gallery-caption="<?= htmlspecialchars($foto['judul_foto'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <img src="<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>"
                                            alt="<?= htmlspecialchars($foto['judul_foto']); ?>"
                                            data-fallback-src="<?= base_url('assets/frontend/img/no-img.jpg'); ?>">
                                        <div class="gallery-overlay">
                                            <div class="gallery-text">
                                                <h6 class="mb-0 text-white fw-600"><?= htmlspecialchars($foto['judul_foto']); ?></h6>
                                                <small class="text-white-50"><i class='bx bx-calendar-alt me-1'></i><?= date('d M Y', strtotime($foto['tanggal_upload'] ?? 'today')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Foto 2: Narrow (col-4) -->
                            <?php if (isset($chunk[1])): $foto = $chunk[1]; ?>
                                <div class="col-4 d-flex flex-column">
                                    <div class="gallery-wrapper gallery-narrow w-100"
                                        data-bs-toggle="modal" data-bs-target="#modalFoto"
                                        data-gallery-image="<?= htmlspecialchars(base_url('assets/img/galeri/' . $foto['file_foto']), ENT_QUOTES, 'UTF-8'); ?>" data-gallery-caption="<?= htmlspecialchars($foto['judul_foto'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <img src="<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>"
                                            alt="<?= htmlspecialchars($foto['judul_foto']); ?>"
                                            data-fallback-src="<?= base_url('assets/frontend/img/no-img.jpg'); ?>">
                                        <div class="gallery-overlay">
                                            <div class="gallery-text">
                                                <h6 class="mb-0 text-white fw-600"><?= htmlspecialchars($foto['judul_foto']); ?></h6>
                                                <small class="text-white-50"><i class='bx bx-calendar-alt me-1'></i><?= date('d M Y', strtotime($foto['tanggal_upload'] ?? 'today')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Foto 3: Narrow (col-4) -->
                            <?php if (isset($chunk[2])): $foto = $chunk[2]; ?>
                                <div class="col-4 d-flex flex-column">
                                    <div class="gallery-wrapper gallery-narrow w-100"
                                        data-bs-toggle="modal" data-bs-target="#modalFoto"
                                        data-gallery-image="<?= htmlspecialchars(base_url('assets/img/galeri/' . $foto['file_foto']), ENT_QUOTES, 'UTF-8'); ?>" data-gallery-caption="<?= htmlspecialchars($foto['judul_foto'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <img src="<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>"
                                            alt="<?= htmlspecialchars($foto['judul_foto']); ?>"
                                            data-fallback-src="<?= base_url('assets/frontend/img/no-img.jpg'); ?>">
                                        <div class="gallery-overlay">
                                            <div class="gallery-text">
                                                <h6 class="mb-0 text-white fw-600"><?= htmlspecialchars($foto['judul_foto']); ?></h6>
                                                <small class="text-white-50"><i class='bx bx-calendar-alt me-1'></i><?= date('d M Y', strtotime($foto['tanggal_upload'] ?? 'today')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Foto 4: Wide (col-8) -->
                            <?php if (isset($chunk[3])): $foto = $chunk[3]; ?>
                                <div class="col-8">
                                    <div class="gallery-wrapper gallery-wide"
                                        data-bs-toggle="modal" data-bs-target="#modalFoto"
                                        data-gallery-image="<?= htmlspecialchars(base_url('assets/img/galeri/' . $foto['file_foto']), ENT_QUOTES, 'UTF-8'); ?>" data-gallery-caption="<?= htmlspecialchars($foto['judul_foto'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <img src="<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>"
                                            alt="<?= htmlspecialchars($foto['judul_foto']); ?>"
                                            data-fallback-src="<?= base_url('assets/frontend/img/no-img.jpg'); ?>">
                                        <div class="gallery-overlay">
                                            <div class="gallery-text">
                                                <h6 class="mb-0 text-white fw-600"><?= htmlspecialchars($foto['judul_foto']); ?></h6>
                                                <small class="text-white-50"><i class='bx bx-calendar-alt me-1'></i><?= date('d M Y', strtotime($foto['tanggal_upload'] ?? 'today')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Lihat Semua (Tengah Bawah) -->
            <div class="text-center mt-5">
                <a href="<?= base_url('index.php/galeri'); ?>"
                    class="btn px-5 py-2 fw-600"
                    style="border:2px solid var(--majelis-primary);color:var(--majelis-primary);border-radius:99px;font-size:.9rem;">
                    Lihat Semua Galeri <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>

        </div>
    </section>

    <!-- Modal Foto -->
    <div class="modal fade" id="modalFoto" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0" style="background:transparent;">
                <div class="modal-body p-0 text-center position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 shadow" data-bs-dismiss="modal" style="z-index: 999;"></button>
                    <img id="modalFotoImg" src="" alt="" style="max-width:100%; max-height:85vh; border-radius:16px; box-shadow:0 10px 40px rgba(0,0,0,.6); object-fit: contain;">
                    <div class="p-3 mt-2 text-center" style="background: rgba(0,0,0,0.65); border-radius: 12px; backdrop-filter: blur(10px); display: inline-block;">
                        <p id="modalFotoCaption" class="text-white fw-600 mb-0" style="font-size:1rem;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>

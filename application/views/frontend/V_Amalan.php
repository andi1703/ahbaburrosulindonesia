<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- ========================================================
     AMALAN PAGE — Ahbaburrosul
     ======================================================== -->

<!-- Spacer untuk fixed navbar -->
<div style="padding-top:72px;"></div>

<!-- Page Banner -->
<section class="py-5" style="background:linear-gradient(135deg, var(--majelis-dark) 0%, var(--majelis-primary) 100%); position:relative; overflow:hidden;">
    <div style="position:absolute;top:-60px;right:-60px;width:300px;height:300px;border-radius:50%;background:rgba(201,168,76,0.07);pointer-events:none;"></div>
    <div style="position:absolute;bottom:-80px;left:-40px;width:220px;height:220px;border-radius:50%;background:rgba(255,255,255,0.04);pointer-events:none;"></div>
    <div class="container position-relative">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb" style="font-size:.82rem; opacity:.65;">
                <li class="breadcrumb-item"><a href="<?= base_url(); ?>" class="text-majelis-gold text-decoration-none">Beranda</a></li>
                <li class="breadcrumb-item active text-white">Amalan</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-3">
            <div style="width:54px;height:54px;border-radius:50%;background:rgba(201,168,76,0.18);display:flex;align-items:center;justify-content:center;">
                <i class='bx bx-book-heart text-majelis-gold' style="font-size:1.8rem;"></i>
            </div>
            <div>
                <h1 class="text-white fw-800 mb-0" style="font-size:clamp(1.5rem,3.5vw,2.2rem);">Amalan Ibadah</h1>
                <p class="text-majelis-gold mb-0" style="font-size:.88rem; opacity:.85;">
                    Bacaan Al-Quran, Wirid, Doa &amp; Sholawat harian
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     QUICK ACCESS HUB — 4 Icon Cards
     ======================================================== -->
<section class="py-5 bg-majelis-cream">
    <div class="container">
        <div class="text-center mb-4">
            <span class="section-label"><i class='bx bx-grid-alt me-1'></i>Kategori Amalan</span>
            <h2 class="section-title d-block text-center mx-auto" style="max-width:400px;">
                Pilih Amalan Anda
            </h2>
        </div>

        <div class="row g-3 justify-content-center">

            <!-- Al-Quran -->
            <div class="col-6 col-sm-3 col-lg-2">
                <a href="<?= base_url('index.php/quran'); ?>" class="quick-access-card">
                    <div class="quick-access-icon" style="background:#e8f5e9;">
                        <i class='bx bx-book-open' style="color:#2e7d32;"></i>
                    </div>
                    <p class="quick-access-label">Al-Quran</p>
                    <small style="font-size:.72rem; color:var(--majelis-muted);">Baca &amp; Dengarkan</small>
                </a>
            </div>

            <!-- Tahlil & Yasin -->
            <div class="col-6 col-sm-3 col-lg-2">
                <a href="<?= base_url('index.php/yasin'); ?>" class="quick-access-card">
                    <div class="quick-access-icon" style="background:#fff8e1;">
                        <i class='bx bx-heart' style="color:#f9a825;"></i>
                    </div>
                    <p class="quick-access-label">Tahlil &amp; Yasin</p>
                    <small style="font-size:.72rem; color:var(--majelis-muted);">Bacaan Rutin</small>
                </a>
            </div>

            <!-- Wirid & Doa -->
            <div class="col-6 col-sm-3 col-lg-2">
                <a href="<?= base_url('index.php/doa'); ?>" class="quick-access-card">
                    <div class="quick-access-icon" style="background:#e3f2fd;">
                        <i class='bx bxs-hand' style="color:#1565c0;"></i>
                    </div>
                    <p class="quick-access-label">Wirid &amp; Doa</p>
                    <small style="font-size:.72rem; color:var(--majelis-muted);">Dzikir Harian</small>
                </a>
            </div>

            <!-- Maulid -->
            <div class="col-6 col-sm-3 col-lg-2">
                <a href="<?= base_url('index.php/maulid'); ?>" class="quick-access-card">
                    <div class="quick-access-icon" style="background:#fce4ec;">
                        <i class='bx bxs-star' style="color:#c62828;"></i>
                    </div>
                    <p class="quick-access-label">Maulid Nabi</p>
                    <small style="font-size:.72rem; color:var(--majelis-muted);">Sholawat &amp; Maulid</small>
                </a>
            </div>

        </div><!-- /row -->

        <!-- ── Scroll Pills — Surah Populer ──────────────────── -->
        <div class="bg-white rounded-3 p-3 shadow-sm mt-4">
            <p class="mb-2" style="font-size:.78rem; font-weight:600; color:var(--majelis-muted); text-transform:uppercase; letter-spacing:1px;">
                <i class='bx bx-bookmark me-1 text-majelis-primary'></i>Surah &amp; Bacaan Populer
            </p>
            <div class="scroll-pills-wrap">
                <a href="<?= base_url('index.php/quran/yasin'); ?>" class="pill-tag">📖 Yasin</a>
                <a href="<?= base_url('index.php/quran/al-waqiah'); ?>" class="pill-tag">🌟 Al-Waqi'ah</a>
                <a href="<?= base_url('index.php/quran/al-mulk'); ?>" class="pill-tag">👑 Al-Mulk</a>
                <a href="<?= base_url('index.php/quran/al-kahfi'); ?>" class="pill-tag">📜 Al-Kahfi</a>
                <a href="<?= base_url('index.php/quran/ar-rahman'); ?>" class="pill-tag">💚 Ar-Rahman</a>
                <a href="<?= base_url('index.php/quran/ayat-kursi'); ?>" class="pill-tag">✨ Ayat Kursi</a>
                <a href="<?= base_url('index.php/quran/al-fatihah'); ?>" class="pill-tag">🤲 Al-Fatihah</a>
                <a href="<?= base_url('index.php/quran/al-baqarah'); ?>" class="pill-tag">📗 Al-Baqarah</a>
            </div>
        </div>

    </div>
</section>
<!-- / QUICK ACCESS HUB -->

<!-- ========================================================
     Panduan Amalan Harian (Konten Statis Islami)
     ======================================================== -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <span class="section-label">Panduan</span>
            <h2 class="section-title d-block text-center mx-auto">Amalan Harian Ahlussunnah</h2>
        </div>
        <div class="row g-4">

            <!-- Pagi -->
            <div class="col-md-6 col-lg-3">
                <div class="card-nice p-4 text-center h-100">
                    <div class="quick-access-icon mx-auto mb-3" style="background:#e8f5e9;">
                        <i class='bx bx-sun' style="color:#2e7d32; font-size:1.6rem;"></i>
                    </div>
                    <h6 class="fw-700 mb-2 text-majelis-primary">Wirid Pagi</h6>
                    <p style="font-size:.85rem; color:var(--majelis-muted); line-height:1.7;">
                        Dzikir pagi setelah Sholat Subuh: Ayat Kursi, Al-Ikhlas, Al-Falaq, An-Nas, Istighfar, dan Sholawat.
                    </p>
                    <a href="<?= base_url('index.php/doa/pagi'); ?>"
                        class="btn btn-sm mt-2"
                        style="border:1.5px solid var(--majelis-primary); color:var(--majelis-primary); border-radius:99px; font-weight:600; font-size:.8rem;">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>

            <!-- Siang -->
            <div class="col-md-6 col-lg-3">
                <div class="card-nice p-4 text-center h-100">
                    <div class="quick-access-icon mx-auto mb-3" style="background:#fff8e1;">
                        <i class='bx bxs-sun' style="color:#f9a825; font-size:1.6rem;"></i>
                    </div>
                    <h6 class="fw-700 mb-2" style="color:#b7791f;">Dzikir Siang</h6>
                    <p style="font-size:.85rem; color:var(--majelis-muted); line-height:1.7;">
                        Bacaan tasbih, tahmid, tahlil dan sholawat Nabi saat senggang di waktu siang hari.
                    </p>
                    <a href="<?= base_url('index.php/doa/siang'); ?>"
                        class="btn btn-sm mt-2"
                        style="border:1.5px solid #b7791f; color:#b7791f; border-radius:99px; font-weight:600; font-size:.8rem;">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>

            <!-- Sore / Petang -->
            <div class="col-md-6 col-lg-3">
                <div class="card-nice p-4 text-center h-100">
                    <div class="quick-access-icon mx-auto mb-3" style="background:#e3f2fd;">
                        <i class='bx bx-moon' style="color:#1565c0; font-size:1.6rem;"></i>
                    </div>
                    <h6 class="fw-700 mb-2" style="color:#1565c0;">Wirid Petang</h6>
                    <p style="font-size:.85rem; color:var(--majelis-muted); line-height:1.7;">
                        Dzikir sore setelah Sholat Ashar atau Maghrib, lengkap dengan doa perlindungan malam.
                    </p>
                    <a href="<?= base_url('index.php/doa/petang'); ?>"
                        class="btn btn-sm mt-2"
                        style="border:1.5px solid #1565c0; color:#1565c0; border-radius:99px; font-weight:600; font-size:.8rem;">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>

            <!-- Maulid -->
            <div class="col-md-6 col-lg-3">
                <div class="card-nice p-4 text-center h-100">
                    <div class="quick-access-icon mx-auto mb-3" style="background:#fce4ec;">
                        <i class='bx bxs-star' style="color:#c62828; font-size:1.6rem;"></i>
                    </div>
                    <h6 class="fw-700 mb-2" style="color:#c62828;">Maulid &amp; Sholawat</h6>
                    <p style="font-size:.85rem; color:var(--majelis-muted); line-height:1.7;">
                        Bacaan maulid Barzanji, Diba', Simtuddurar dan sholawat-sholawat pilihan Ahlussunnah.
                    </p>
                    <a href="<?= base_url('index.php/maulid'); ?>"
                        class="btn btn-sm mt-2"
                        style="border:1.5px solid #c62828; color:#c62828; border-radius:99px; font-weight:600; font-size:.8rem;">
                        Baca Selengkapnya
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>
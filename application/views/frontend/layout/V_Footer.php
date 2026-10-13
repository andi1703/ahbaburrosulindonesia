<!-- ========================================================
     FOOTER — Ahbaburrosul
     ======================================================== -->
<footer style="background:#0f1211; color:#e8ecea;" class="pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4 mb-4">

            <!-- Brand & Deskripsi -->
            <div class="col-lg-4">
                <?php if (!empty($identitas['logo'])): ?>
                    <img src="<?= base_url('assets/img/logo/' . $identitas['logo']); ?>"
                        alt="Logo" style="height:46px; border-radius:8px; margin-bottom:.9rem;">
                <?php endif; ?>
                <h5 style="font-weight:700; color:#c9a84c; margin-bottom:.5rem; font-size:1rem;">
                    Majelis <?= htmlspecialchars($identitas['nama_website'] ?? 'Ahbaburrosul'); ?>
                </h5>
                <p style="font-size:.84rem; color:#9aa5a1; line-height:1.8; margin-bottom:1rem;">
                    <?= htmlspecialchars($identitas['deskripsi_footer'] ?? 'Lembaga dakwah Islam Ahlussunnah Wal Jamaah.'); ?>
                </p>
                <!-- Sosmed -->
                <?php if (!empty($sosmeds)): ?>
                    <div class="d-flex gap-2 flex-wrap">
                        <?php foreach ($sosmeds as $sm): ?>
                            <a href="<?= $sm['url']; ?>" target="_blank" rel="noopener"
                                class="d-flex align-items-center justify-content-center text-white"
                                style="width:34px;height:34px;border-radius:50%;background:rgba(255,255,255,.08);font-size:1.05rem;transition:background .22s;"
                                title="<?= htmlspecialchars($sm['nama_sosmed']); ?>"
                                onmouseover="this.style.background='#c9a84c';this.style.color='#000'"
                                onmouseout="this.style.background='rgba(255,255,255,.08)';this.style.color='#fff'">
                                <i class='bx <?= htmlspecialchars($sm['icon']); ?>'></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Menu Navigasi -->
            <div class="col-lg-2 col-6">
                <h6 style="font-size:.7rem;font-weight:700;color:#9aa5a1;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.85rem;">Menu</h6>
                <ul class="list-unstyled mb-0" style="font-size:.85rem;">
                    <li class="mb-2"><a href="<?= base_url(); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#c9a84c'" onmouseout="this.style.color='#cdd4d1'">Beranda</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/amalan'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#c9a84c'" onmouseout="this.style.color='#cdd4d1'">Amalan</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/agenda'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#c9a84c'" onmouseout="this.style.color='#cdd4d1'">Agenda</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/artikel'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#c9a84c'" onmouseout="this.style.color='#cdd4d1'">Artikel</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/galeri'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#c9a84c'" onmouseout="this.style.color='#cdd4d1'">Galeri</a></li>
                </ul>
            </div>

            <!-- Baca / Amalan Links -->
            <div class="col-lg-2 col-6">
                <h6 style="font-size:.7rem;font-weight:700;color:#9aa5a1;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.85rem;">Baca</h6>
                <ul class="list-unstyled mb-0" style="font-size:.85rem;">
                    <li class="mb-2"><a href="<?= base_url('index.php/quran'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#28c3a3'" onmouseout="this.style.color='#cdd4d1'">Al-Qur'an</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/tahlil'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#28c3a3'" onmouseout="this.style.color='#cdd4d1'">Tahlil</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/doa'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#28c3a3'" onmouseout="this.style.color='#cdd4d1'">Doa</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/wirid'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#28c3a3'" onmouseout="this.style.color='#cdd4d1'">Wirid</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/hadits'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#28c3a3'" onmouseout="this.style.color='#cdd4d1'">Hadits</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/jadwal-sholat'); ?>" style="color:#cdd4d1;text-decoration:none;" onmouseover="this.style.color='#28c3a3'" onmouseout="this.style.color='#cdd4d1'">Jadwal Sholat</a></li>
                </ul>
            </div>

            <!-- Kontak + Download App Card -->
            <div class="col-lg-4">
                <h6 style="font-size:.7rem;font-weight:700;color:#9aa5a1;text-transform:uppercase;letter-spacing:.08em;margin-bottom:.85rem;">Kontak Kami</h6>
                <ul class="list-unstyled mb-3" style="font-size:.84rem; color:#9aa5a1; line-height:2;">
                    <?php if (!empty($identitas['alamat'])): ?>
                        <li><i class='bx bx-map-pin me-2' style="color:#c9a84c;"></i><?= htmlspecialchars($identitas['alamat']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($identitas['email'])): ?>
                        <li><i class='bx bx-envelope me-2' style="color:#c9a84c;"></i><?= htmlspecialchars($identitas['email']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($identitas['whatsapp'])): ?>
                        <li>
                            <i class='bx bxl-whatsapp me-2' style="color:#c9a84c;"></i>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $identitas['whatsapp']); ?>"
                                style="color:#9aa5a1;text-decoration:none;"
                                onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#9aa5a1'">
                                <?= htmlspecialchars($identitas['whatsapp']); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- App Download Card -->
                <div style="background:#191c1b;border:1px solid rgba(255,255,255,.07);border-radius:12px;padding:1rem 1.1rem;">
                    <p style="font-size:.75rem;font-weight:700;color:#c9a84c;margin-bottom:.25rem;text-transform:uppercase;letter-spacing:.06em;">Majelis Super App</p>
                    <p style="font-size:.75rem;color:#9aa5a1;margin-bottom:.75rem;line-height:1.55;">Nikmati fitur lengkap Al-Qur'an, Doa, dan Jadwal Sholat di genggaman Anda.</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="#" style="display:inline-flex;align-items:center;gap:.45rem;background:#1a1d1c;border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:.45rem .8rem;color:#fff;text-decoration:none;font-size:.72rem;transition:border-color .2s;" onmouseover="this.style.borderColor='#28c3a3'" onmouseout="this.style.borderColor='rgba(255,255,255,.12)'">
                            <i class='bx bxl-google-plus' style="font-size:1.2rem;color:#28c3a3;"></i>
                            <span><span style="display:block;font-size:.58rem;color:#9aa5a1;">Dapatkan di</span><strong>Google Play</strong></span>
                        </a>
                        <a href="#" style="display:inline-flex;align-items:center;gap:.45rem;background:#1a1d1c;border:1px solid rgba(255,255,255,.12);border-radius:8px;padding:.45rem .8rem;color:#fff;text-decoration:none;font-size:.72rem;transition:border-color .2s;" onmouseover="this.style.borderColor='#28c3a3'" onmouseout="this.style.borderColor='rgba(255,255,255,.12)'">
                            <i class='bx bxl-apple' style="font-size:1.2rem;color:#28c3a3;"></i>
                            <span><span style="display:block;font-size:.58rem;color:#9aa5a1;">Download di</span><strong>App Store</strong></span>
                        </a>
                    </div>
                </div>
            </div>

        </div><!-- /row -->

        <hr style="border-color:rgba(255,255,255,.07);margin-block:0 1rem;">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <p class="mb-0" style="font-size:.78rem; color:#5a6460;">
                &copy; <?= date('Y'); ?> <?= htmlspecialchars($identitas['nama_website'] ?? 'Majelis Ahbaburrosul Indonesia'); ?>. Seluruh hak cipta dilindungi.
            </p>
            <p class="mb-0" style="font-size:.78rem; color:#5a6460;">
                Dibuat dengan <i class='bx bx-heart' style="color:#c9a84c;"></i> untuk dakwah Islam
            </p>
        </div>
    </div>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Navbar Scroll Effect -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.getElementById("mainNavbar");
        if (navbar) {
            const isInnerPage = navbar.classList.contains("navbar-scrolled");
            if (!isInnerPage && window.scrollY > 50) {
                navbar.classList.add("navbar-scrolled");
            }
            window.addEventListener("scroll", function() {
                if (isInnerPage) return;
                if (window.scrollY > 50) {
                    navbar.classList.add("navbar-scrolled");
                } else {
                    navbar.classList.remove("navbar-scrolled");
                }
            });
        }
    });
</script>

<!-- Frontend JS -->
<script src="<?= base_url('assets/frontend/js/main-frontend.js'); ?>?v=2"></script>
<!-- Floating WhatsApp Button -->
<?php if (!empty($identitas['whatsapp'])): ?>
    <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $identitas['whatsapp']); ?>"
        class="btn-whatsapp-floating"
        target="_blank"
        rel="noopener"
        title="Hubungi Kami di WhatsApp">
        <i class='bx bxl-whatsapp'></i>
        <span class="whatsapp-badge">1</span>
    </a>
<?php endif; ?>

</body>

</html>
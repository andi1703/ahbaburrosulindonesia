<!-- ========================================================
     FOOTER — Ahbaburrosul
     ======================================================== -->
<footer class="bg-majelis-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row g-4 mb-4">

            <!-- Brand & Deskripsi -->
            <div class="col-lg-4">
                <?php if (!empty($identitas['logo'])): ?>
                    <img src="<?= base_url('assets/img/logo/' . $identitas['logo']); ?>"
                        alt="Logo" style="height:50px; border-radius:8px; margin-bottom:1rem;">
                <?php endif; ?>
                <h5 class="fw-bold text-majelis-gold mb-2">
                    Majelis <?= htmlspecialchars($identitas['nama_website'] ?? 'Ahbaburrosul'); ?>
                </h5>
                <p style="font-size:.88rem; opacity:.7; line-height:1.8;">
                    <?= htmlspecialchars($identitas['deskripsi_footer'] ?? 'Lembaga dakwah Islam Ahlussunnah Wal Jamaah.'); ?>
                </p>
                <!-- Sosmed -->
                <?php if (!empty($sosmeds)): ?>
                    <div class="d-flex gap-2 mt-3 flex-wrap">
                        <?php foreach ($sosmeds as $sm): ?>
                            <a href="<?= $sm['url']; ?>" target="_blank" rel="noopener"
                                class="d-flex align-items-center justify-content-center text-white"
                                style="width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.1);font-size:1.1rem;transition:all .25s;"
                                title="<?= htmlspecialchars($sm['nama_sosmed']); ?>"
                                onmouseover="this.style.background='var(--majelis-gold)'"
                                onmouseout="this.style.background='rgba(255, 255, 255, 0)'">
                                <i class='bx <?= htmlspecialchars($sm['icon']); ?>'></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Navigasi -->
            <div class="col-lg-2 col-sm-6">
                <h6 class="fw-bold text-majelis-gold mb-3">Menu</h6>
                <ul class="list-unstyled" style="font-size:.88rem;">
                    <li class="mb-2"><a href="<?= base_url(); ?>" class="text-white text-decoration-none opacity-75 hover-gold"><i class='bx bx-chevron-right me-1'></i>Beranda</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/amalan'); ?>" class="text-white text-decoration-none opacity-75"><i class='bx bx-chevron-right me-1'></i>Amalan</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/agenda'); ?>" class="text-white text-decoration-none opacity-75"><i class='bx bx-chevron-right me-1'></i>Agenda</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/artikel'); ?>" class="text-white text-decoration-none opacity-75"><i class='bx bx-chevron-right me-1'></i>Artikel</a></li>
                    <li class="mb-2"><a href="<?= base_url('index.php/galeri'); ?>" class="text-white text-decoration-none opacity-75"><i class='bx bx-chevron-right me-1'></i>Galeri</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-3 col-sm-6">
                <h6 class="fw-bold text-majelis-gold mb-3">Kontak Kami</h6>
                <ul class="list-unstyled" style="font-size:.88rem; opacity:.75; line-height:2;">
                    <?php if (!empty($identitas['alamat'])): ?>
                        <li><i class='bx bx-map-pin me-2 text-majelis-gold'></i><?= htmlspecialchars($identitas['alamat']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($identitas['email'])): ?>
                        <li><i class='bx bx-envelope me-2 text-majelis-gold'></i><?= htmlspecialchars($identitas['email']); ?></li>
                    <?php endif; ?>
                    <?php if (!empty($identitas['whatsapp'])): ?>
                        <li>
                            <i class='bx bxl-whatsapp me-2 text-majelis-gold'></i>
                            <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $identitas['whatsapp']); ?>"
                                class="text-white text-decoration-none">
                                <?= htmlspecialchars($identitas['whatsapp']); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Maps Embed -->
            <div class="col-lg-3">
                <h6 class="fw-bold text-majelis-gold mb-3">Lokasi Majelis</h6>
                <?php if (!empty($identitas['map_url'])): ?>
                    <a href="<?= $identitas['map_url']; ?>" target="_blank" rel="noopener"
                        class="d-flex align-items-center gap-2 text-white text-decoration-none"
                        style="background:rgba(255, 255, 255, 0); border-radius:12px; padding:0.75rem 1rem; font-size:.85rem; border:1px solid rgba(255,255,255,0.1);">
                        <i class='bx bx-map-alt text-majelis-gold' style="font-size:1.5rem;"></i>
                        <span>Buka di Google Maps <i class='bx bx-link-external ms-1'></i></span>
                    </a>
                <?php else: ?>
                    <p style="font-size:.85rem; opacity:.5;">Alamat belum dikonfigurasi di CMS.</p>
                <?php endif; ?>
            </div>

        </div><!-- /row -->

        <hr style="border-color:rgba(255, 255, 255, 0);">
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <p class="mb-0" style="font-size:.8rem; opacity:.45;">
                &copy; <?= date('Y'); ?> Majelis <?= htmlspecialchars($identitas['nama_website'] ?? 'Ahbaburrosul'); ?>. Seluruh hak cipta dilindungi.
            </p>
            <p class="mb-0" style="font-size:.8rem; opacity:.45;">
                Dibuat dengan <i class='bx bx-heart text-majelis-gold'></i> untuk dakwah Islam
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
            // Jika halaman inner (navbar sudah solid dari PHP), jangan pernah ubah
            const isInnerPage = navbar.classList.contains("navbar-scrolled");
            if (!isInnerPage && window.scrollY > 50) {
                navbar.classList.add("navbar-scrolled");
            }
            window.addEventListener("scroll", function() {
                if (isInnerPage) return; // halaman inner: selalu solid, abaikan scroll
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
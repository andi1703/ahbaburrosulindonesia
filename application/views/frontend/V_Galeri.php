<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

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
                <li class="breadcrumb-item active text-white">Galeri</li>
            </ol>
        </nav>
        <div class="d-flex align-items-center gap-3">
            <div style="width:54px;height:54px;border-radius:50%;background:rgba(201,168,76,0.18);display:flex;align-items:center;justify-content:center;">
                <i class='bx bx-images text-majelis-gold' style="font-size:1.8rem;"></i>
            </div>
            <div>
                <h1 class="text-white fw-800 mb-0" style="font-size:clamp(1.5rem,3.5vw,2.2rem);">Galeri Kegiatan</h1>
                <p class="text-majelis-gold mb-0" style="font-size:.88rem; opacity:.85;">
                    Dokumentasi dan arsip foto kegiatan Majelis Ahbaburrosul Indonesia
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ========================================================
     GALLERY GRID — Asymmetric, Modern & Premium
     ======================================================== -->
<section class="py-5 bg-white" style="background-color: #ffffff !important;">
    <div class="container">
        
        <?php if (!empty($galeri)): ?>
            <div class="row g-4">
                <?php 
                // Kelompokkan foto ke dalam kumpulan beranggotakan 4 item
                $chunks = array_chunk($galeri, 4);
                foreach ($chunks as $chunk):
                ?>
                    <!-- Setiap block berisi 4 foto dibungkus col-lg-6 sehingga di desktop ada 2 block berdampingan -->
                    <div class="col-lg-6 col-12">
                        <div class="row g-3 align-items-stretch">
                            
                            <!-- Foto 1 (Index 0): Wide (col-8) -->
                            <?php if (isset($chunk[0])): $foto = $chunk[0]; ?>
                                <div class="col-8">
                                    <div class="gallery-wrapper gallery-wide" 
                                         data-bs-toggle="modal" data-bs-target="#modalFoto"
                                         onclick="openGalleryModal('<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>', '<?= addslashes(htmlspecialchars($foto['judul_foto'])); ?>')">
                                        <img src="<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>" 
                                             alt="<?= htmlspecialchars($foto['judul_foto']); ?>"
                                             onerror="this.src='<?= base_url('assets/frontend/img/no-img.jpg'); ?>'">
                                        <div class="gallery-overlay">
                                            <div class="gallery-text">
                                                <h6 class="mb-0 text-white fw-600"><?= htmlspecialchars($foto['judul_foto']); ?></h6>
                                                <small class="text-white-50"><i class='bx bx-calendar-alt me-1'></i><?= date('d M Y', strtotime($foto['tanggal_upload'] ?? 'today')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Foto 2 (Index 1): Narrow (col-4) -->
                            <?php if (isset($chunk[1])): $foto = $chunk[1]; ?>
                                <div class="col-4 d-flex flex-column">
                                    <div class="gallery-wrapper gallery-narrow w-100" 
                                         data-bs-toggle="modal" data-bs-target="#modalFoto"
                                         onclick="openGalleryModal('<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>', '<?= addslashes(htmlspecialchars($foto['judul_foto'])); ?>')">
                                        <img src="<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>" 
                                             alt="<?= htmlspecialchars($foto['judul_foto']); ?>"
                                             onerror="this.src='<?= base_url('assets/frontend/img/no-img.jpg'); ?>'">
                                        <div class="gallery-overlay">
                                            <div class="gallery-text">
                                                <h6 class="mb-0 text-white fw-600"><?= htmlspecialchars($foto['judul_foto']); ?></h6>
                                                <small class="text-white-50"><i class='bx bx-calendar-alt me-1'></i><?= date('d M Y', strtotime($foto['tanggal_upload'] ?? 'today')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Foto 3 (Index 2): Narrow (col-4) -->
                            <?php if (isset($chunk[2])): $foto = $chunk[2]; ?>
                                <div class="col-4 d-flex flex-column">
                                    <div class="gallery-wrapper gallery-narrow w-100" 
                                         data-bs-toggle="modal" data-bs-target="#modalFoto"
                                         onclick="openGalleryModal('<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>', '<?= addslashes(htmlspecialchars($foto['judul_foto'])); ?>')">
                                        <img src="<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>" 
                                             alt="<?= htmlspecialchars($foto['judul_foto']); ?>"
                                             onerror="this.src='<?= base_url('assets/frontend/img/no-img.jpg'); ?>'">
                                        <div class="gallery-overlay">
                                            <div class="gallery-text">
                                                <h6 class="mb-0 text-white fw-600"><?= htmlspecialchars($foto['judul_foto']); ?></h6>
                                                <small class="text-white-50"><i class='bx bx-calendar-alt me-1'></i><?= date('d M Y', strtotime($foto['tanggal_upload'] ?? 'today')); ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Foto 4 (Index 3): Wide (col-8) -->
                            <?php if (isset($chunk[3])): $foto = $chunk[3]; ?>
                                <div class="col-8">
                                    <div class="gallery-wrapper gallery-wide" 
                                         data-bs-toggle="modal" data-bs-target="#modalFoto"
                                         onclick="openGalleryModal('<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>', '<?= addslashes(htmlspecialchars($foto['judul_foto'])); ?>')">
                                        <img src="<?= base_url('assets/img/galeri/' . $foto['file_foto']); ?>" 
                                             alt="<?= htmlspecialchars($foto['judul_foto']); ?>"
                                             onerror="this.src='<?= base_url('assets/frontend/img/no-img.jpg'); ?>'">
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
        <?php else: ?>
            <div class="text-center py-5 text-muted">
                <i class='bx bx-images bx-lg d-block mb-3 opacity-25'></i>
                <h5 class="fw-600">Galeri Foto Kosung</h5>
                <p class="mb-0">Belum ada dokumentasi foto yang diunggah.</p>
            </div>
        <?php endif; ?>

    </div>
</section>

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

<script>
    function openGalleryModal(imgUrl, caption) {
        document.getElementById('modalFotoImg').src = imgUrl;
        document.getElementById('modalFotoCaption').textContent = caption;
    }
</script>

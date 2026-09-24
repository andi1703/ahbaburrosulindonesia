<?php
$is_edit = isset($identitas);
$action_url = $is_edit ? base_url('index.php/back_identitas/update_aksi') : base_url('index.php/back_identitas/simpan_aksi');
?>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan / Master Data / Identitas Web /</span> <?= $is_edit ? 'Edit Cabang' : 'Tambah Cabang Baru' ?>
</h4>

<div class="row">
    <div class="col-xl-12">
        <?= $this->session->flashdata('pesan'); ?>
    </div>
</div>

<form action="<?= $action_url; ?>" method="POST" enctype="multipart/form-data">
    <?php if($is_edit): ?>
        <input type="hidden" name="id_identitas" value="<?= $identitas['id_identitas']; ?>">
        <input type="hidden" name="old_logo" value="<?= $identitas['logo']; ?>">
    <?php endif; ?>
    
    <div class="row">
        <!-- Kolom Kiri: Informasi Utama -->
        <div class="col-xl-8 col-lg-8 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom mb-3">
                    <h5 class="mb-0">Informasi Utama Cabang</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-primary fw-bold">Nama Cabang / Identitas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_website" class="form-control form-control-lg" value="<?= $is_edit ? htmlspecialchars($identitas['nama_website']) : ''; ?>" placeholder="Contoh: Pondok Pesantren Cabang Jakarta" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Slogan Cabang</label>
                        <input type="text" name="slogan" class="form-control" placeholder="Contoh: Media Dakwah Islam Ahlussunnah Wal Jamaah" value="<?= $is_edit ? htmlspecialchars($identitas['slogan']) : ''; ?>" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Footer (Tentang Kami)</label>
                        <textarea name="deskripsi_footer" class="form-control" rows="4" placeholder="Tuliskan profil singkat cabang yang akan muncul di bagian footer..."><?= $is_edit ? htmlspecialchars($identitas['deskripsi_footer']) : ''; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="3" placeholder="Contoh: Jl. Kyai Haji Hasyim Ashari No. 123, Jakarta"><?= $is_edit ? htmlspecialchars($identitas['alamat']) : ''; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Google Maps Embed URL</label>
                        <textarea name="map_url" class="form-control" rows="3" placeholder="Paste URL src dari Google Maps Embed di sini..."><?= $is_edit ? htmlspecialchars($identitas['map_url']) : ''; ?></textarea>
                        <small class="text-muted">Gunakan URL yang ada di dalam atribut src="..." pada iframe Google Maps.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Kontak & Logo -->
        <div class="col-xl-4 col-lg-4 col-md-12 mb-4">
            
            <!-- Card Kontak -->
            <div class="card mb-4">
                <div class="card-header border-bottom mb-3 bg-label-primary">
                    <h5 class="mb-0 text-primary"><i class="bx bx-phone me-2"></i>Kontak & Sosmed</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">WhatsApp</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bxl-whatsapp"></i></span>
                            <input type="text" name="whatsapp" class="form-control" placeholder="081234567890" value="<?= $is_edit ? htmlspecialchars($identitas['whatsapp']) : ''; ?>" />
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Email</label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="admin@domain.com" value="<?= $is_edit ? htmlspecialchars($identitas['email']) : ''; ?>" />
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bx bx-save me-1"></i> <?= $is_edit ? 'Simpan Perubahan' : 'Tambah Cabang' ?>
                        </button>
                        <a href="<?= base_url('index.php/back_identitas'); ?>" class="btn btn-outline-secondary">
                            <i class="bx bx-x me-1"></i> Batal
                        </a>
                    </div>
                </div>
            </div>

            <!-- Card Logo -->
            <div class="card mb-4">
                <div class="card-header border-bottom mb-3">
                    <h5 class="mb-0"><i class="bx bx-image-alt me-2"></i>Logo Cabang</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Upload Logo</label>
                        <input type="file" name="logo" class="form-control" id="logo" accept="image/*" onchange="previewLogo()">
                        
                        <div class="text-center mt-3">
                            <?php if($is_edit && !empty($identitas['logo'])): ?>
                                <img id="logoPreview" src="<?= base_url('assets/img/logo/'.$identitas['logo']); ?>" class="img-preview img-fluid rounded border shadow-sm p-2 bg-light" style="max-height: 120px; display: inline-block;">
                                <small class="text-muted mt-2 d-block text-start">Biarkan kosong jika tidak ingin mengubah logo.</small>
                            <?php else: ?>
                                <img id="logoPreview" src="" class="img-preview img-fluid rounded border shadow-sm p-2 bg-light" style="max-height: 120px; display: none;">
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<?php $this->load->view('admin/master_data/identitas/V_Identitas_js'); ?>

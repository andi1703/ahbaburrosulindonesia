<?php
$is_edit = isset($artikel);
$action_url = $is_edit ? base_url('index.php/back_artikel/update_aksi') : base_url('index.php/back_artikel/simpan_aksi');
?>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistem / Manajemen Artikel /</span> <?= $is_edit ? 'Edit Artikel' : 'Tulis Artikel Baru' ?>
</h4>

<form action="<?= $action_url; ?>" method="POST" enctype="multipart/form-data">
    <?php if($is_edit): ?>
        <input type="hidden" name="id_artikel" value="<?= $artikel['id_artikel']; ?>">
        <input type="hidden" name="old_gambar" value="<?= $artikel['gambar_cover']; ?>">
    <?php endif; ?>

    <div class="row">
        <!-- Kolom Kiri: Konten Utama -->
        <div class="col-xl-8 col-lg-8 col-md-12 mb-4">
            <div class="card h-100">
                <div class="card-header border-bottom mb-3">
                    <h5 class="mb-0">Konten Utama</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label text-primary fw-bold" for="judul_artikel">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" name="judul_artikel" id="judul_artikel" class="form-control form-control-lg" placeholder="Masukkan judul yang menarik..." value="<?= $is_edit ? htmlspecialchars($artikel['judul_artikel']) : '' ?>" required />
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Ringkasan Pendek (Excerpt)</label>
                        <textarea name="ringkasan" class="form-control" rows="3" placeholder="Tulis 1-2 kalimat pengantar untuk ditampilkan di halaman depan..."><?= $is_edit ? htmlspecialchars($artikel['ringkasan']) : '' ?></textarea>
                        <small class="text-muted">Ringkasan ini penting untuk menarik minat pembaca.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Isi Konten Artikel <span class="text-danger">*</span></label>
                        <textarea id="editor" name="konten"><?= $is_edit ? $artikel['konten'] : '' ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Pengaturan & Atribut -->
        <div class="col-xl-4 col-lg-4 col-md-12 mb-4">
            
            <!-- Card Media & SEO -->
            <div class="card mb-4">
                <div class="card-header border-bottom mb-3">
                    <h5 class="mb-0"><i class="bx bx-image me-2"></i>Media & SEO</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Gambar Cover</label>
                        <input type="file" name="gambar_cover" class="form-control" id="gambar_cover" accept="image/*" onchange="previewImage()">
                        
                        <div class="text-center mt-3">
                            <?php if($is_edit && !empty($artikel['gambar_cover'])): ?>
                                <img id="imagePreview" src="<?= base_url('assets/img/artikel/'.$artikel['gambar_cover']); ?>" class="img-preview img-fluid rounded border shadow-sm" style="max-height: 180px; display: inline-block;">
                                <small class="text-muted mt-2 d-block text-start">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                            <?php else: ?>
                                <img id="imagePreview" src="" class="img-preview img-fluid rounded border shadow-sm" style="max-height: 180px; display: none;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Keterangan Gambar (Caption)</label>
                        <input type="text" name="ket_gambar" class="form-control form-control-sm" placeholder="Sumber: Dokumentasi Pribadi" value="<?= $is_edit ? htmlspecialchars($artikel['ket_gambar']) : '' ?>">
                    </div>

                    <div class="mb-2">
                        <label class="form-label fw-bold">Tags / Kata Kunci</label>
                        <input type="text" name="tag_artikel" class="form-control form-control-sm" placeholder="Contoh: ngaji, kitab kuning, santri" value="<?= $is_edit ? htmlspecialchars($artikel['tag_artikel']) : '' ?>">
                        <small class="text-muted">Pisahkan dengan koma.</small>
                    </div>
                </div>
            </div>

            <!-- Card Publikasi -->
            <div class="card mb-4">
                <div class="card-header border-bottom mb-3 bg-label-primary">
                    <h5 class="mb-0 text-primary"><i class="bx bx-send me-2"></i>Publikasi</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select" required>
                            <option value="Publish" <?= ($is_edit && ($artikel['status'] == 'Publish' || $artikel['status'] == 'publish')) ? 'selected' : '' ?>>🌐 Publish Langsung</option>
                            <option value="Draft" <?= ($is_edit && ($artikel['status'] == 'Draft' || $artikel['status'] == 'draft')) ? 'selected' : '' ?>>📝 Simpan sbg Draft</option>
                        </select>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                        <select name="id_kategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach($categories as $c): ?>
                            <option value="<?= $c['id_kategori']; ?>" <?= ($is_edit && $artikel['id_kategori'] == $c['id_kategori']) ? 'selected' : '' ?>><?= $c['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bx bx-save me-1"></i> <?= $is_edit ? 'Simpan Perubahan' : 'Publish Artikel' ?>
                        </button>
                        <a href="<?= base_url('index.php/back_artikel'); ?>" class="btn btn-outline-secondary">
                            <i class="bx bx-x me-1"></i> Batal
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<?php $this->load->view('admin/artikel/V_Artikel_js'); ?>

<?php
$is_edit    = isset($agenda);
$action_url = $is_edit ? base_url('index.php/back_agenda/update_aksi') : base_url('index.php/back_agenda/simpan_aksi');
?>
<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan / Master Data / Agenda Kajian /</span>
  <?= $is_edit ? 'Edit Agenda' : 'Buat Agenda Baru'; ?>
</h4>

<form action="<?= $action_url; ?>" method="POST" enctype="multipart/form-data">
  <?php if($is_edit): ?>
    <input type="hidden" name="id_agenda" value="<?= $agenda['id_agenda']; ?>">
    <input type="hidden" name="old_poster" value="<?= $agenda['poster'] ?? ''; ?>">
  <?php endif; ?>

  <div class="row">
    <!-- Kolom Kiri: Informasi Utama -->
    <div class="col-xl-8 col-lg-8 mb-4">
      <div class="card h-100">
        <div class="card-header border-bottom mb-3">
          <h5 class="mb-0">Detail Kegiatan</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label fw-bold">Nama Kegiatan <span class="text-danger">*</span></label>
            <input type="text" name="nama_kegiatan" class="form-control form-control-lg"
                   placeholder="Contoh: Haul Akbar Ahbaburrosul"
                   value="<?= $is_edit ? htmlspecialchars($agenda['nama_kegiatan']) : ''; ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Pengisi / Narasumber <span class="text-danger">*</span></label>
            <input type="text" name="pengisi_kajian" class="form-control"
                   placeholder="Contoh: Habib Syech bin Abdul Qadir Assegaf"
                   value="<?= $is_edit ? htmlspecialchars($agenda['pengisi_kajian']) : ''; ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Tempat / Lokasi <span class="text-danger">*</span></label>
            <input type="text" name="tempat" class="form-control"
                   placeholder="Contoh: Masjid Agung Kota Semarang"
                   value="<?= $is_edit ? htmlspecialchars($agenda['tempat']) : ''; ?>" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Link Google Maps (Opsional)</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-map-alt text-success"></i></span>
              <input type="url" name="Maps" class="form-control"
                     placeholder="https://maps.google.com/..."
                     value="<?= $is_edit ? htmlspecialchars($agenda['Maps']) : ''; ?>">
            </div>
            <small class="text-muted">Salin link share dari Google Maps. Jamaah bisa langsung klik untuk navigasi.</small>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Keterangan Tambahan</label>
            <textarea name="keterangan" class="form-control" rows="4"
                      placeholder="Informasi tambahan: Gratis, bawa Al-Quran, dst..."><?= $is_edit ? htmlspecialchars($agenda['keterangan']) : ''; ?></textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- Kolom Kanan: Jadwal & Status -->
    <div class="col-xl-4 col-lg-4 mb-4">

      <!-- Card Jadwal -->
      <div class="card mb-4">
        <div class="card-header border-bottom mb-3 bg-label-primary">
          <h5 class="mb-0 text-primary"><i class="bx bx-calendar-event me-2"></i>Jadwal</h5>
        </div>
        <div class="card-body">
          <div class="mb-3">
            <label class="form-label fw-bold">Tanggal <span class="text-danger">*</span></label>
            <input type="date" name="tanggal" class="form-control"
                   value="<?= $is_edit ? $agenda['tanggal'] : date('Y-m-d'); ?>" required>
          </div>
          <div class="mb-4">
            <label class="form-label fw-bold">Jam Mulai <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-time"></i></span>
              <input type="time" name="jam" class="form-control"
                     value="<?= $is_edit ? $agenda['jam'] : '08:00'; ?>" required>
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label fw-bold">Status Kegiatan <span class="text-danger">*</span></label>
            <select name="status_kegiatan" class="form-select" required>
              <option value="mendatang" <?= ($is_edit && $agenda['status_kegiatan'] == 'mendatang') ? 'selected' : ''; ?>>🔵 Mendatang</option>
              <option value="selesai"   <?= ($is_edit && $agenda['status_kegiatan'] == 'selesai')   ? 'selected' : ''; ?>>✅ Selesai</option>
              <option value="dibatalkan" <?= ($is_edit && $agenda['status_kegiatan'] == 'dibatalkan') ? 'selected' : ''; ?>>🔴 Dibatalkan</option>
            </select>
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="bx bx-save me-1"></i>
              <?= $is_edit ? 'Simpan Perubahan' : 'Buat Agenda'; ?>
            </button>
            <a href="<?= base_url('index.php/back_agenda'); ?>" class="btn btn-outline-secondary">
              <i class="bx bx-x me-1"></i> Batal
            </a>
          </div>
        </div>
      </div>

      <!-- Card Upload Poster -->
      <div class="card mb-4">
        <div class="card-header border-bottom mb-3">
          <h5 class="mb-0"><i class="bx bx-image me-2"></i>Poster Kegiatan</h5>
        </div>
        <div class="card-body">
          <div class="mb-2">
            <label class="form-label fw-bold">Upload Poster (Opsional)</label>
            <input type="file" name="poster" id="poster_agenda" class="form-control" accept="image/*" onchange="previewPoster()">
            <small class="text-muted">Format: JPG/PNG, Maks: 2MB. Rekomendasi rasio 4:5 atau persegi.</small>
          </div>
          <div class="text-center mt-3">
            <?php if($is_edit && !empty($agenda['poster'])): ?>
              <img id="posterPreview" src="<?= base_url('assets/img/poster_agenda/'.$agenda['poster']); ?>"
                   class="img-preview-poster img-fluid rounded border shadow-sm" style="max-height: 200px; display: inline-block;">
              <small class="text-muted mt-2 d-block">Biarkan kosong jika tidak ingin mengubah poster.</small>
            <?php else: ?>
              <img id="posterPreview" src="" class="img-preview-poster img-fluid rounded border shadow-sm" style="max-height: 200px; display: none;">
            <?php endif; ?>
          </div>
        </div>
      </div>

    </div>
  </div>
</form>

<?php $this->load->view('admin/master_data/agenda/V_Agenda_js'); ?>

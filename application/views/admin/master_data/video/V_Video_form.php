<!-- Modal Video -->
<div class="modal fade" id="modalVideo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white" id="modalVideoTitle"><i class="bx bxl-youtube me-2"></i>Tambah Video Dakwah</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formVideo" action="<?= base_url('index.php/back_video/simpan_aksi'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_video" id="id_video">
          
          <div class="mb-3">
            <label class="form-label fw-bold">Judul Video <span class="text-danger">*</span></label>
            <input type="text" id="judul_video" name="judul_video" class="form-control" placeholder="Contoh: Kajian Adab - Habib Ali Al-Jufri" required>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">ID Video YouTube <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bxl-youtube text-danger"></i></span>
              <input type="text" id="id_youtube" name="id_youtube" class="form-control" placeholder="Contoh: dQw4w9WgXcQ" required oninput="updatePreview()">
            </div>
            <small class="text-muted">Ambil kode unik di belakang URL YouTube (setelah <strong>?v=</strong>)</small>
          </div>
          
          <!-- Live Thumbnail Preview -->
          <div class="mb-3" id="thumbnailWrap" style="display:none;">
            <label class="form-label fw-bold text-success">Preview Thumbnail:</label>
            <img id="thumbnailPreview" src="" class="img-fluid rounded border shadow-sm w-100" style="max-height:150px; object-fit:cover;">
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-bold">Kategori</label>
              <select id="kategori_video" name="kategori_video" class="form-select">
                  <option value="Kajian">Kajian</option>
                  <option value="Maulid">Maulid</option>
                  <option value="Shorts">Shorts</option>
                  <option value="Ceramah">Ceramah</option>
                  <option value="Lainnya">Lainnya</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <!-- Spacer for balance -->
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-bold">Keterangan (Opsional)</label>
            <textarea id="keterangan" name="keterangan" class="form-control" rows="2" placeholder="Deskripsi singkat tentang video ini..."></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger" id="btnSimpanVideo"><i class="bx bx-save me-1"></i> Simpan Video</button>
        </div>
      </form>
    </div>
  </div>
</div>

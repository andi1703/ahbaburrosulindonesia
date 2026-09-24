<!-- Modal Slider -->
<div class="modal fade" id="modalSlider" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="modalSliderTitle">Tambah Banner Slider</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formSlider" action="<?= base_url('index.php/back_slider/simpan_aksi'); ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <input type="hidden" name="id_slider" id="id_slider">
          <input type="hidden" name="old_gambar" id="old_gambar">
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Judul Utama <span class="text-danger">*</span></label>
              <input type="text" id="judul_slider" name="judul_slider" class="form-control" placeholder="Teks besar di banner" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Sub Judul</label>
              <input type="text" id="sub_judul" name="sub_judul" class="form-control" placeholder="Teks kecil di bawah judul utama">
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label">Gambar Slider (Rekomendasi 1920x800px) <span class="text-danger">*</span></label>
              <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" onchange="previewSlider(event)">
              <div class="mt-2 text-center">
                  <img id="gambarPreview" src="" class="img-preview img-fluid rounded border" style="max-height: 150px; display: none;">
                  <small id="gambarHelp" class="text-muted d-block mt-1" style="display: none;">Biarkan kosong jika tidak ingin mengubah gambar.</small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label">Link Tombol (Opsional)</label>
              <input type="url" id="link_button" name="link_button" class="form-control" placeholder="https://example.com/promo">
              <small class="text-muted">Jika diisi, banner akan mengarah ke link ini saat diklik.</small>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Urutan Tampil <span class="text-danger">*</span></label>
              <input type="number" id="urutan" name="urutan" class="form-control" value="1" min="1" required>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Status <span class="text-danger">*</span></label>
              <select id="status" name="status" class="form-select" required>
                <option value="aktif">Aktif</option>
                <option value="non-aktif">Non-Aktif</option>
              </select>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary" id="btnSimpanSlider">Simpan Slider</button>
        </div>
      </form>
    </div>
  </div>
</div>

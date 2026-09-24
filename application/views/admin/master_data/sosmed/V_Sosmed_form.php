<!-- Modal Sosmed -->
<div class="modal fade" id="modalSosmed" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-white" id="modalSosmedTitle">Tambah Sosial Media</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="formSosmed" action="<?= base_url('index.php/back_sosmed/simpan_aksi'); ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_sosmed" id="id_sosmed">
          
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">Platform (Nama Sosmed) <span class="text-danger">*</span></label>
              <input type="text" id="nama_sosmed" name="nama_sosmed" class="form-control" placeholder="Contoh: Instagram" required>
            </div>
          </div>
          
          <div class="row">
            <div class="col mb-3">
              <label class="form-label">URL / Link Profil <span class="text-danger">*</span></label>
              <input type="url" id="url" name="url" class="form-control" placeholder="https://instagram.com/ahbaburrosul" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">Icon (Boxicons) <span class="text-danger">*</span></label>
              <input type="text" id="icon" name="icon" class="form-control" placeholder="Contoh: bxl-instagram" required>
              <small class="text-muted">Lihat icon di <a href="https://boxicons.com/" target="_blank">boxicons.com</a></small>
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
          <button type="submit" class="btn btn-primary" id="btnSimpanSosmed">Simpan Data</button>
        </div>
      </form>
    </div>
  </div>
</div>

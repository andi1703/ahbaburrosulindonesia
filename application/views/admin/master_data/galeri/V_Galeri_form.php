<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form action="<?= base_url('index.php/back_galeri/simpan_aksi'); ?>" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white">Upload Koleksi Galeri</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-bold">Judul Foto / Kegiatan <span class="text-danger">*</span></label>
            <input type="text" name="judul_foto" class="form-control" placeholder="Misal: Santunan Anak Yatim 2025" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Nama Album</label>
            <input type="text" name="album" class="form-control" placeholder="Misal: Bakti Sosial, Pengajian, Haul">
            <small class="text-muted">Kosongkan jika tidak ada album khusus (default: Umum).</small>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Pilih Foto <span class="text-danger">*</span></label>
            <input type="file" name="file_foto" id="file_foto" class="form-control" accept="image/*" onchange="previewGaleri(event)" required>
            <small class="text-muted">Format: JPG/PNG, Maks: 2MB</small>
            <div class="mt-2 text-center">
              <img id="galeriPreview" src="" class="img-fluid rounded border shadow-sm mt-2" style="max-height: 200px; display: none;">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary"><i class="bx bx-upload me-1"></i> Simpan Foto</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
function previewGaleri(event) {
    const imgPreview = document.getElementById('galeriPreview');
    imgPreview.style.display = 'inline-block';
    const oFReader = new FileReader();
    oFReader.readAsDataURL(event.target.files[0]);
    oFReader.onload = function(oFREvent) {
        imgPreview.src = oFREvent.target.result;
    }
}
</script>

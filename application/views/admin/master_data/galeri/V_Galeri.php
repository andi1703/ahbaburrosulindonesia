<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Master Data /</span> Galeri Kegiatan
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Dokumentasi Foto</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <span class="tf-icons bx bx-upload me-1"></span>Upload Foto
    </button>
  </div>
  
  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Preview</th>
          <th>Judul Foto</th>
          <th>Album</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if(empty($all_galeri)): ?>
        <tr>
            <td colspan="5" class="text-center text-muted py-4">Belum ada foto di galeri.</td>
        </tr>
        <?php else: ?>
        <?php foreach($all_galeri as $g): ?>
        <tr>
          <td>
            <img src="<?= base_url('assets/img/galeri/'.$g['file_foto']); ?>" width="100" class="rounded shadow-sm" onerror="this.src='<?= base_url('assets/img/no-image.png') ?>';">
          </td>
          <td><strong><?= htmlspecialchars($g['judul_foto']); ?></strong></td>
          <td><span class="badge bg-label-primary"><?= !empty($g['album']) ? htmlspecialchars($g['album']) : 'Umum'; ?></span></td>
          <td><?= date('d M Y', strtotime($g['tanggal_upload'])); ?></td>
          <td>
            <a href="<?= base_url('index.php/back_galeri/hapus/'.$g['id_galeri']); ?>" 
               class="btn btn-sm btn-outline-danger" 
               onclick="return confirm('Yakin ingin menghapus foto ini?')">
                <i class="bx bx-trash me-1"></i> Hapus
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('admin/master_data/galeri/V_Galeri_form'); ?>

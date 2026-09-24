<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan / Master Data /</span> Sosial Media
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Akun Sosial Media</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSosmed" onclick="tambahSosmed()">
        <span class="tf-icons bx bx-plus-circle me-1"></span>Tambah Sosmed
    </button>
  </div>

  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Platform</th>
          <th>URL / Link</th>
          <th>Icon</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php if(empty($all_sosmed)): ?>
        <tr>
            <td colspan="5" class="text-center text-muted py-4">Belum ada data sosial media.</td>
        </tr>
        <?php else: ?>
        <?php foreach($all_sosmed as $s): ?>
        <tr>
          <td><strong><?= $s['nama_sosmed']; ?></strong></td>
          <td><a href="<?= $s['url']; ?>" target="_blank" class="text-primary"><?= $s['url']; ?></a></td>
          <td><i class="bx <?= $s['icon']; ?> bx-sm"></i> <small><?= $s['icon']; ?></small></td>
          <td>
            <span class="badge bg-label-<?= ($s['status'] == 'aktif') ? 'success' : 'secondary'; ?>">
                <?= ucfirst($s['status']); ?>
            </span>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);" onclick="editSosmed('<?= $s['id_sosmed']; ?>', '<?= $s['nama_sosmed']; ?>', '<?= $s['url']; ?>', '<?= $s['icon']; ?>', '<?= $s['status']; ?>')"><i class="bx bx-edit-alt me-1 text-warning"></i> Edit</a>
                <a class="dropdown-item text-danger" href="<?= base_url('index.php/back_sosmed/hapus/'.$s['id_sosmed']); ?>" onclick="return confirm('Yakin ingin menghapus sosial media ini?')"><i class="bx bx-trash me-1"></i> Hapus</a>
              </div>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<?php $this->load->view('admin/master_data/sosmed/V_Sosmed_form'); ?>
<?php $this->load->view('admin/master_data/sosmed/V_Sosmed_js'); ?>

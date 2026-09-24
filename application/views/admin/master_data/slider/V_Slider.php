<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan / Master Data /</span> Slider Beranda
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Banner Slider Aktif</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSlider" onclick="tambahSlider()">
        <span class="tf-icons bx bx-plus-circle me-1"></span>Tambah Slider
    </button>
  </div>

  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Urutan</th>
          <th>Preview Gambar</th>
          <th>Informasi Slider</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php if(empty($all_slider)): ?>
        <tr>
            <td colspan="5" class="text-center text-muted py-4">Belum ada banner slider.</td>
        </tr>
        <?php else: ?>
        <?php foreach($all_slider as $sl): ?>
        <tr>
          <td><strong>#<?= $sl['urutan']; ?></strong></td>
          <td>
            <img src="<?= base_url('assets/img/slider/'.$sl['gambar']); ?>" width="150" class="rounded shadow-sm" onerror="this.src='<?= base_url('assets/img/no-image.png') ?>';">
          </td>
          <td>
            <strong><?= $sl['judul_slider']; ?></strong><br>
            <small class="text-muted"><?= !empty($sl['sub_judul']) ? $sl['sub_judul'] : '-'; ?></small>
          </td>
          <td>
            <span class="badge bg-label-<?= ($sl['status'] == 'aktif') ? 'success' : 'secondary'; ?>">
                <?= ucfirst($sl['status']); ?>
            </span>
          </td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);" onclick="editSlider('<?= $sl['id_slider']; ?>', '<?= htmlspecialchars($sl['judul_slider'], ENT_QUOTES); ?>', '<?= htmlspecialchars($sl['sub_judul'], ENT_QUOTES); ?>', '<?= $sl['gambar']; ?>', '<?= htmlspecialchars($sl['link_button'], ENT_QUOTES); ?>', '<?= $sl['urutan']; ?>', '<?= $sl['status']; ?>')"><i class="bx bx-edit-alt me-1 text-warning"></i> Edit</a>
                <a class="dropdown-item text-danger" href="<?= base_url('index.php/back_slider/hapus/'.$sl['id_slider']); ?>" onclick="return confirm('Yakin ingin menghapus slider ini?')"><i class="bx bx-trash me-1"></i> Hapus</a>
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

<?php $this->load->view('admin/master_data/slider/V_Slider_form'); ?>
<?php $this->load->view('admin/master_data/slider/V_Slider_js'); ?>

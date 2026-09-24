<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Master Data /</span> Kategori Artikel
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Kategori Konten</h5>
    <div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <span class="tf-icons bx bx-plus-circle me-1"></span>Tambah Kategori
        </button>
    </div>
  </div>

  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="10%">No</th>
          <th>Nama Kategori</th>
          <th>Slug</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php if(empty($all_kategori)): ?>
        <tr>
            <td colspan="4" class="text-center text-muted py-4">Belum ada data kategori.</td>
        </tr>
        <?php else: ?>
        <?php $no=1; foreach($all_kategori as $k): ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><strong><?= $k['nama_kategori']; ?></strong></td>
          <td><span class="badge bg-label-info"><?= $k['slug_kategori']; ?></span></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $k['id_kategori']; ?>"><i class="bx bx-edit-alt me-1 text-warning"></i> Edit</a>
                <a class="dropdown-item text-danger" href="<?= base_url('index.php/admin/hapus_kategori/'.$k['id_kategori']); ?>" onclick="return confirm('Hapus kategori <?= $k['nama_kategori']; ?>?');"><i class="bx bx-trash me-1"></i> Hapus</a>
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

<?php $this->load->view('admin/master_data/kategori/V_Kategori_form'); ?>
<?php $this->load->view('admin/master_data/kategori/V_Kategori_js'); ?>

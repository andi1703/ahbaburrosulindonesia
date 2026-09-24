<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistem /</span> Manajemen Artikel
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Artikel & Kajian</h5>
    <a href="<?= base_url('index.php/back_artikel/tambah'); ?>" class="btn btn-primary">
        <span class="tf-icons bx bx-plus-circle me-1"></span>Tulis Artikel
    </a>
  </div>

  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th width="10%">Gambar</th>
          <th>Judul Artikel</th>
          <th>Kategori</th>
          <th>Status</th>
          <th>Dilihat</th>
          <th>Tanggal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php if(empty($all_artikel)): ?>
        <tr>
            <td colspan="7" class="text-center text-muted py-4">Belum ada data artikel.</td>
        </tr>
        <?php else: ?>
        <?php foreach($all_artikel as $a): ?>
        <tr>
          <td>
            <?php if(!empty($a['gambar_cover'])): ?>
                <img src="<?= base_url('assets/img/artikel/'.$a['gambar_cover']); ?>" 
                     alt="Cover" class="rounded" width="60" 
                     onerror="this.src='<?= base_url('assets/img/no-image.png') ?>';">
            <?php else: ?>
                <span class="badge bg-label-secondary">No Image</span>
            <?php endif; ?>
          </td>
          <td>
            <strong><?= substr($a['judul_artikel'], 0, 40); ?><?= strlen($a['judul_artikel']) > 40 ? '...' : '' ?></strong><br>
            <small class="text-muted"><?= $a['slug_artikel']; ?></small>
          </td>
          <td><span class="badge bg-label-info"><?= $a['nama_kategori']; ?></span></td>
          <td><?= ($a['status'] == 'Publish' || $a['status'] == 'publish') ? '<span class="badge bg-label-success">Publish</span>' : '<span class="badge bg-label-secondary">Draft</span>'; ?></td>
          <td><i class="bx bx-show me-1"></i> <?= number_format(isset($a['dibaca']) ? $a['dibaca'] : 0); ?></td>
          <td><?= isset($a['tanggal_dibuat']) ? date('d/m/Y', strtotime($a['tanggal_dibuat'])) : '-'; ?></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?= base_url('index.php/back_artikel/edit/'.$a['id_artikel']); ?>"><i class="bx bx-edit-alt me-1 text-warning"></i> Edit</a>
                <a class="dropdown-item text-danger" href="<?= base_url('index.php/back_artikel/hapus/'.$a['id_artikel']); ?>" onclick="return confirm('Yakin ingin menghapus artikel ini?')"><i class="bx bx-trash me-1"></i> Hapus</a>
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

<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Pengaturan / Master Data /</span> Daftar Cabang (Identitas Web)
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Cabang Pondok / Institusi</h5>
    <a href="<?= base_url('index.php/back_identitas/tambah'); ?>" class="btn btn-primary">
        <span class="tf-icons bx bx-plus-circle me-1"></span>Tambah Cabang Baru
    </a>
  </div>

  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Logo</th>
          <th>Nama Cabang / Website</th>
          <th>Slogan</th>
          <th>Kontak WhatsApp</th>
          <th>Email</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php if(empty($semua_identitas)): ?>
        <tr>
            <td colspan="6" class="text-center text-muted py-4">Belum ada data cabang / identitas.</td>
        </tr>
        <?php else: ?>
        <?php foreach($semua_identitas as $id): ?>
        <tr>
          <td>
            <?php if(!empty($id['logo'])): ?>
                <img src="<?= base_url('assets/img/logo/'.$id['logo']); ?>" alt="Logo" class="rounded border bg-light p-1" width="60" onerror="this.src='<?= base_url('assets/img/no-image.png') ?>';">
            <?php else: ?>
                <span class="badge bg-label-secondary">No Logo</span>
            <?php endif; ?>
          </td>
          <td><strong><?= $id['nama_website']; ?></strong></td>
          <td><?= !empty($id['slogan']) ? substr($id['slogan'], 0, 30) . (strlen($id['slogan']) > 30 ? '...' : '') : '-'; ?></td>
          <td><?= !empty($id['whatsapp']) ? $id['whatsapp'] : '-'; ?></td>
          <td><?= !empty($id['email']) ? $id['email'] : '-'; ?></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="<?= base_url('index.php/back_identitas/edit/'.$id['id_identitas']); ?>"><i class="bx bx-edit-alt me-1 text-warning"></i> Edit</a>
                <a class="dropdown-item text-danger" href="<?= base_url('index.php/back_identitas/hapus/'.$id['id_identitas']); ?>" onclick="return confirm('Yakin ingin menghapus data cabang ini?')"><i class="bx bx-trash me-1"></i> Hapus</a>
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

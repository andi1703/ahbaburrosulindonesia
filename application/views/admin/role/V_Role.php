<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pengaturan /</span> Master Kategori User</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Kategori User</h5>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal" onclick="openRoleModal()"><i class="bx bx-plus me-1"></i>Tambah Kategori</button>
  </div>
  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>
  <div class="table-responsive">
    <table class="table table-hover align-middle">
      <thead><tr><th>No</th><th>Nama Kategori User</th><th>Deskripsi Singkat</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php foreach ($roles as $no => $role): ?>
        <tr>
          <td><?= $no + 1; ?></td>
          <td class="fw-semibold"><?= html_escape($role['role_name']); ?></td>
          <td><?= html_escape($role['description'] ?: '-'); ?></td>
          <td>
            <button class="btn btn-sm btn-icon btn-label-warning" title="Edit" onclick="editRole(<?= (int) $role['id']; ?>, '<?= html_escape($role['role_name'], TRUE); ?>', '<?= html_escape($role['description'], TRUE); ?>')"><i class="bx bx-edit"></i></button>
            <a class="btn btn-sm btn-icon btn-label-danger" title="Hapus" href="<?= base_url('index.php/back_role/hapus_role/'.$role['id']); ?>" onclick="return confirm('Hapus kategori user ini?')"><i class="bx bx-trash"></i></a>
          </td>
        </tr>
        <?php endforeach; ?>
        <?php if (empty($roles)): ?><tr><td colspan="4" class="text-center text-muted py-4">Belum ada kategori user.</td></tr><?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="roleModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog"><div class="modal-content">
    <form method="post" id="roleForm" action="<?= base_url('index.php/back_role/simpan'); ?>">
      <div class="modal-header"><h5 class="modal-title" id="roleModalTitle">Tambah Kategori User</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
      <div class="modal-body">
        <input type="hidden" name="id" id="roleId">
        <div class="mb-3"><label class="form-label" for="roleName">Nama Kategori User</label><input class="form-control" id="roleName" name="role_name" required maxlength="100"></div>
        <div><label class="form-label" for="roleDescription">Deskripsi Singkat</label><textarea class="form-control" id="roleDescription" name="description" maxlength="255" rows="3"></textarea></div>
      </div>
      <div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button><button class="btn btn-primary" type="submit">Simpan</button></div>
    </form>
  </div></div>
</div>

<script>
function openRoleModal() {
  document.getElementById('roleForm').action = '<?= base_url('index.php/back_role/simpan'); ?>';
  document.getElementById('roleModalTitle').textContent = 'Tambah Kategori User';
  document.getElementById('roleId').value = '';
  document.getElementById('roleName').value = '';
  document.getElementById('roleDescription').value = '';
}
function editRole(id, name, description) {
  document.getElementById('roleForm').action = '<?= base_url('index.php/back_role/update'); ?>';
  document.getElementById('roleModalTitle').textContent = 'Edit Kategori User';
  document.getElementById('roleId').value = id;
  document.getElementById('roleName').value = name;
  document.getElementById('roleDescription').value = description;
  new bootstrap.Modal(document.getElementById('roleModal')).show();
}
</script>

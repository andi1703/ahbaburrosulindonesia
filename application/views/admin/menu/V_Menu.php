<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistem /</span> Manajemen Fitur & Hak Akses
</h4>

<form method="post" action="<?= base_url('index.php/admin/simpan_hak_akses'); ?>" id="permissionForm">
  <div class="card">
    <div class="card-header d-flex flex-wrap gap-3 justify-content-between align-items-center">
      <div>
        <h5 class="mb-1">Matriks Hak Akses</h5>
        <small class="text-muted">Pilih role, lalu atur izin baca, tambah, ubah, dan hapus.</small>
      </div>
      <div class="d-flex gap-2 align-items-center">
        <label for="role_id" class="visually-hidden">Kategori User</label>
        <select class="form-select" name="role_id" id="role_id" required>
          <option value="">Pilih Kategori User</option>
          <?php foreach ($roles as $role): ?>
          <option value="<?= (int) $role['id']; ?>" <?= ((int) $role['id'] === (int) $selected_role_id) ? 'selected' : ''; ?>>
            <?= html_escape($role['role_name']); ?>
          </option>
          <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn-primary text-nowrap">
          <i class="bx bx-save me-1"></i>Simpan Hak Akses
        </button>
      </div>
    </div>

    <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>
    <div class="table-responsive text-nowrap">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>Nama Fitur / Modul</th>
            <?php foreach (['read' => 'Baca', 'create' => 'Tambah', 'update' => 'Ubah', 'delete' => 'Hapus'] as $key => $label): ?>
            <th class="text-center">
              <?= $label; ?><br>
              <input type="checkbox" class="form-check-input check-all" data-permission="<?= $key; ?>" aria-label="Pilih semua <?= strtolower($label); ?>">
            </th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($features)): ?>
          <tr><td colspan="5" class="text-center text-muted py-4">Belum ada fitur yang terdaftar.</td></tr>
          <?php endif; ?>
          <?php foreach ($features as $feature): ?>
          <?php $feature_permissions = $permissions[(int) $feature['id']] ?? []; ?>
          <tr>
            <td>
              <span class="fw-semibold"><?= html_escape($feature['feature_name']); ?></span><br>
              <small class="text-muted"><?= html_escape($feature['feature_slug']); ?></small>
            </td>
            <?php foreach (['read', 'create', 'update', 'delete'] as $permission): ?>
            <?php $column = 'can_'.$permission; ?>
            <td class="text-center">
              <input type="checkbox" class="form-check-input permission-<?= $permission; ?>" name="permissions[<?= (int) $feature['id']; ?>][<?= $permission; ?>]" value="1" <?= !empty($feature_permissions[$column]) ? 'checked' : ''; ?> aria-label="<?= $permission; ?> <?= html_escape($feature['feature_name']); ?>">
            </td>
            <?php endforeach; ?>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</form>

<script>
document.querySelectorAll('.check-all').forEach(function (master) {
  master.addEventListener('change', function () {
    document.querySelectorAll('.permission-' + master.dataset.permission).forEach(function (checkbox) {
      checkbox.checked = master.checked;
    });
  });
});

document.getElementById('role_id').addEventListener('change', function () {
  window.location.href = '<?= base_url('index.php/admin/manajemen_menu'); ?>?role_id=' + encodeURIComponent(this.value);
});
</script>

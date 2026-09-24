<h4 class="fw-bold py-3 mb-4">
  <span class="text-muted fw-light">Sistem /</span> Kelola User Admin
</h4>

<div class="card">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Daftar Akun Pengguna</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUser" onclick="bukaModalTambah()">
        <span class="tf-icons bx bx-user-plus me-1"></span>Tambah User Baru
    </button>
  </div>

  <div class="card-body pb-0"><?= $this->session->flashdata('pesan'); ?></div>
  <div class="card-body pb-0"><?= $this->session->flashdata('sukses'); ?></div>

  <div class="table-responsive text-nowrap">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>Nama Lengkap</th>
          <th>Username</th>
          <th>Role / Peran</th>
          <th>Status Akun</th>
          <th>Terdaftar</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        <?php if(empty($all_user)): ?>
        <tr>
            <td colspan="7" class="text-center text-muted py-5">
                <i class="bx bx-user-x bx-lg d-block mb-2 text-secondary"></i>
                Belum ada data pengguna.
            </td>
        </tr>
        <?php else: ?>
        <?php foreach($all_user as $no => $u): ?>
        <tr>
          <td><strong><?= $no + 1; ?></strong></td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <div class="avatar avatar-sm">
                <span class="avatar-initial rounded-circle bg-label-primary fw-bold">
                    <?= strtoupper(substr($u['full_name'], 0, 1)); ?>
                </span>
              </div>
              <span class="fw-semibold"><?= htmlspecialchars($u['full_name']); ?></span>
            </div>
          </td>
          <td><code><?= htmlspecialchars($u['username']); ?></code></td>
          <td>
            <?php 
              // Logika warna badge berdasarkan role
              $badge_color = 'bg-label-secondary'; // Default
              if ($u['role'] == 'Super Admin') {
                  $badge_color = 'bg-label-danger';
              } else if ($u['role'] == 'Editor Content') {
                  $badge_color = 'bg-label-warning';
              } else if ($u['role'] == 'Admin Agenda') {
                  $badge_color = 'bg-label-info';
              }
            ?>
            <span class="badge <?= $badge_color; ?> px-2">
                <i class="bx bx-shield-alt-2 me-1"></i> <?= $u['role']; ?>
            </span>
          </td>
            <td>
              <a href="<?= base_url('index.php/back_user/toggle_status/'.$u['id']); ?>" class="badge <?= !empty($u['is_active']) ? 'bg-label-success' : 'bg-label-secondary'; ?>" title="Ubah status akun">
                <?= !empty($u['is_active']) ? 'Aktif' : 'Nonaktif'; ?>
              </a>
            </td>
            <td><small class="text-muted"><?= date('d M Y', strtotime($u['created_at'])); ?></small></td>
          <td>
            <div class="d-flex align-items-center">
              <a href="<?= base_url('index.php/admin/manajemen_menu'); ?><?= !empty($u['role_id']) ? '?role_id='.(int) $u['role_id'] : ''; ?>" class="btn btn-sm btn-icon btn-label-primary me-2" title="Kelola Hak Akses">
                  <i class="bx bx-cog"></i>
              </a>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                  <a class="dropdown-item text-warning" href="javascript:void(0);"
                     onclick="bukaModalEdit('<?= $u['id']; ?>', '<?= htmlspecialchars($u['full_name'], ENT_QUOTES); ?>', '<?= htmlspecialchars($u['username'], ENT_QUOTES); ?>', '<?= $u['role']; ?>')">
                      <i class="bx bx-edit-alt me-1"></i> Edit
                  </a>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="resetPassword('<?= (int) $u['id']; ?>', '<?= html_escape($u['full_name'], TRUE); ?>')"><i class="bx bx-key me-1"></i> Reset Password</a>
                  <?php if($u['username'] != $this->session->userdata('nama')): ?>
                  <a class="dropdown-item text-danger" href="<?= base_url('index.php/back_user/hapus/'.$u['id']); ?>"
                     onclick="return confirm('Yakin ingin menghapus user <?= htmlspecialchars($u['full_name'], ENT_QUOTES); ?>?')">
                      <i class="bx bx-trash me-1"></i> Hapus
                  </a>
                  <?php else: ?>
                  <span class="dropdown-item text-muted" style="cursor:default;">
                      <i class="bx bx-lock me-1"></i> Akun Aktif
                  </span>
                  <?php endif; ?>
                </div>
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

<?php $this->load->view('admin/login/V_Login_form'); ?>
<?php $this->load->view('admin/login/V_User_js'); ?>

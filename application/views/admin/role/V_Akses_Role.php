<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex justify-content-between align-items-center py-3 mb-4">
        <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Hak Akses /</span> <?= htmlspecialchars($role); ?>
        </h4>
        <div>
            <a href="<?= base_url('index.php/back_user'); ?>" class="btn btn-outline-secondary me-2">Kembali</a>
            <button type="button" id="btnSimpanAkses" class="btn btn-primary" data-role="<?= htmlspecialchars($role); ?>">
                <i class="bx bx-save me-1"></i> Simpan Perubahan
            </button>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Menu</th>
                        <th>Akses</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $i = 1; foreach($all_menu as $m) : ?>
                    <tr>
                        <td><strong><?= $i++; ?></strong></td>
                        <td><?= htmlspecialchars($m['menu_name']); ?></td>
                        <td>
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input check-access" type="checkbox" 
                                    <?= check_access($role, $m['id']); ?> 
                                    data-role="<?= htmlspecialchars($role); ?>" 
                                    data-menu="<?= $m['id']; ?>"
                                    style="cursor: pointer;">
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#btnSimpanAkses').on('click', function() {
        const btn = $(this);
        const role = btn.data('role');
        
        let menuIds = [];
        $('.check-access:checked').each(function() {
            menuIds.push($(this).data('menu'));
        });

        btn.html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Menyimpan...');
        btn.prop('disabled', true);

        $.ajax({
            url: "<?= base_url('index.php/back_role/save_access'); ?>",
            type: 'post',
            data: { role: role, menuIds: menuIds },
            dataType: 'json',
            success: function(response) {
                btn.html('<i class="bx bx-save me-1"></i> Simpan Perubahan');
                btn.prop('disabled', false);
                
                // Panggil toast global yang ada di V_Footer.php
                if(typeof showGlobalToast === "function") {
                    showGlobalToast('success', 'Success', 'Hak akses berhasil disimpan!');
                } else {
                    alert('Hak akses berhasil disimpan!');
                }
            },
            error: function() {
                btn.html('<i class="bx bx-save me-1"></i> Simpan Perubahan');
                btn.prop('disabled', false);
                
                if(typeof showGlobalToast === "function") {
                    showGlobalToast('error', 'Error', 'Terjadi kesalahan saat menyimpan hak akses.');
                } else {
                    alert('Terjadi kesalahan saat menyimpan hak akses.');
                }
            }
        });
    });
});
</script>

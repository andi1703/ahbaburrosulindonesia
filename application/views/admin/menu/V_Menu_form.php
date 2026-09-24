<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('index.php/admin/tambah_menu_aksi'); ?>" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="menu_name" class="form-control" placeholder="Contoh: Galeri" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link (Slug)</label>
                        <input type="text" name="menu_link" class="form-control" placeholder="Contoh: galeri" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="menu_order" class="form-control" placeholder="Contoh: 5" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php foreach($all_menu as $m): ?>
<!-- Modal Edit Menu -->
<div class="modal fade" id="modalEdit<?= $m['id']; ?>" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('index.php/admin/edit_menu_aksi'); ?>" method="POST">
                <div class="modal-body">
                    <!-- Hidden ID -->
                    <input type="hidden" name="id" value="<?= $m['id']; ?>">
                    
                    <div class="mb-3">
                        <label class="form-label">Nama Menu</label>
                        <input type="text" name="menu_name" class="form-control" value="<?= $m['menu_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Link (Slug)</label>
                        <input type="text" name="menu_link" class="form-control" value="<?= $m['menu_link']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" name="menu_order" class="form-control" value="<?= $m['menu_order']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1" <?= ($m['is_active'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                            <option value="0" <?= ($m['is_active'] == 0) ? 'selected' : ''; ?>>Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Modal Tambah / Edit User -->
<div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px; overflow:hidden;">

            <!-- Header Modal -->
            <div class="modal-header border-0" style="background: linear-gradient(135deg, #696cff 0%, #5f63f2 100%); padding: 1.25rem 1.5rem;">
                <div>
                    <h5 class="modal-title text-white fw-bold mb-0" id="modalUserTitle">
                        <i class='bx bx-user-plus me-2'></i>Tambah Akun Baru
                    </h5>
                    <small class="text-white" style="opacity:.65;">Isi semua data dengan benar</small>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Form Tambah/Edit User -->
            <form id="formUser" action="<?= base_url('index.php/admin/registrasi_aksi'); ?>" method="POST">
                <div class="modal-body p-4">
                    <input type="hidden" name="id_user" id="id_user">
                    <input type="hidden" name="mode" id="modeUser" value="tambah">

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="reg_fullname">
                            Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bx-id-card'></i></span>
                            <input type="text" id="reg_fullname" name="full_name"
                                   class="form-control"
                                   placeholder="Contoh: Ahmad Fulan Al-Jawi"
                                   required>
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="reg_username">
                            Username <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bx-user'></i></span>
                            <input type="text" id="reg_username" name="username"
                                   class="form-control"
                                   placeholder="Huruf kecil, tanpa spasi"
                                   pattern="[a-z0-9_]+" title="Hanya huruf kecil, angka, dan underscore"
                                   required>
                        </div>
                        <small class="text-muted">Hanya huruf kecil, angka, dan underscore (_)</small>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="reg_password">
                            Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bx-lock-alt'></i></span>
                            <input type="password" id="reg_password" name="password"
                                   class="form-control"
                                   placeholder="Minimal 6 karakter (kosongkan jika tidak diganti)"
                                   minlength="6"
                                   oninput="checkPasswordStrength(this.value)">
                            <span class="input-group-text cursor-pointer" onclick="togglePassword('reg_password','eyeReg')" title="Tampilkan/Sembunyikan">
                                <i class='bx bx-hide' id="eyeReg" style="font-size:1.1rem;"></i>
                            </span>
                        </div>
                        <!-- Indikator kekuatan password -->
                        <div class="mt-2" id="strengthWrap" style="display:none;">
                            <div class="progress" style="height:5px; border-radius:4px;">
                                <div id="strengthBar" class="progress-bar" role="progressbar" style="width:0%; transition: width 0.3s;"></div>
                            </div>
                            <small id="strengthText" class="text-muted"></small>
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="reg_confirm">
                            Konfirmasi Password <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bx-check-shield'></i></span>
                            <input type="password" id="reg_confirm" name="confirm_password"
                                   class="form-control"
                                   placeholder="Ulangi password di atas"
                                   oninput="checkConfirm()"
                                   required>
                            <span class="input-group-text cursor-pointer" onclick="togglePassword('reg_confirm','eyeConfirm')" title="Tampilkan/Sembunyikan">
                                <i class='bx bx-hide' id="eyeConfirm" style="font-size:1.1rem;"></i>
                            </span>
                        </div>
                        <small id="confirmMsg" class="d-none"></small>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold" for="reg_role">
                            Peran (Role) <span class="text-danger">*</span>
                        </label>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text"><i class='bx bx-shield-quarter'></i></span>
                            <select id="reg_role" name="role_id" class="form-select" required>
                                <option value="">-- Pilih Akses --</option>
                                <?php foreach (($roles ?? []) as $role): ?>
                                <option value="<?= (int) $role['id']; ?>" data-role-name="<?= html_escape($role['role_name']); ?>"><?= html_escape($role['role_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <small class="text-muted">Tentukan hak akses pengguna ini dalam sistem.</small>
                    </div>

                </div>

                <!-- Footer Modal -->
                <div class="modal-footer border-top px-4 pb-4 pt-3">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class='bx bx-x me-1'></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnSimpanUser">
                        <i class='bx bx-user-check me-1'></i> Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

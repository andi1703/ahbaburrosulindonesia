<script>
    // ============================================================
    // Buka modal mode TAMBAH (reset semua field)
    // ============================================================
    function bukaModalTambah() {
        document.getElementById('modalUserTitle').innerHTML = "<i class='bx bx-user-plus me-2'></i>Tambah Akun Baru";
        document.getElementById('btnSimpanUser').innerHTML  = "<i class='bx bx-user-check me-1'></i> Daftarkan Sekarang";
        document.getElementById('formUser').action          = "<?= base_url('index.php/admin/registrasi_aksi'); ?>";

        document.getElementById('modeUser').value    = 'tambah';
        document.getElementById('id_user').value     = '';
        document.getElementById('reg_fullname').value = '';
        document.getElementById('reg_username').value = '';
        document.getElementById('reg_password').value = '';
        document.getElementById('reg_confirm').value  = '';
        document.getElementById('reg_role').value     = '';

        // Wajibkan password di mode tambah
        document.getElementById('reg_password').required = true;
        document.getElementById('reg_confirm').required  = true;

        // Reset indikator
        document.getElementById('strengthWrap').style.display = 'none';
        document.getElementById('confirmMsg').className = 'd-none';
    }

    // ============================================================
    // Buka modal mode EDIT (isi field dengan data yang dipilih)
    // ============================================================
    function bukaModalEdit(id, namaLengkap, username, role) {
        document.getElementById('modalUserTitle').innerHTML = "<i class='bx bx-edit-alt me-2'></i>Edit Akun User";
        document.getElementById('btnSimpanUser').innerHTML  = "<i class='bx bx-save me-1'></i> Simpan Perubahan";
        document.getElementById('formUser').action          = "<?= base_url('index.php/back_user/update_aksi'); ?>";

        document.getElementById('modeUser').value     = 'edit';
        document.getElementById('id_user').value      = id;
        document.getElementById('reg_fullname').value = namaLengkap;
        document.getElementById('reg_username').value = username;
        document.getElementById('reg_password').value = '';
        document.getElementById('reg_confirm').value  = '';
        const roleSelect = document.getElementById('reg_role');
        roleSelect.value = '';
        Array.from(roleSelect.options).forEach(function(option) {
            if (option.dataset.roleName === role) {
                roleSelect.value = option.value;
            }
        });

        // Password tidak wajib di mode edit (kosong = tidak diubah)
        document.getElementById('reg_password').required = false;
        document.getElementById('reg_confirm').required  = false;

        // Reset indikator
        document.getElementById('strengthWrap').style.display = 'none';
        document.getElementById('confirmMsg').className = 'd-none';

        var myModal = new bootstrap.Modal(document.getElementById('modalUser'));
        myModal.show();
    }

    // ============================================================
    // Toggle show/hide password (digunakan oleh semua input password)
    // ============================================================
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'bx bx-show';
        } else {
            input.type = 'password';
            icon.className = 'bx bx-hide';
        }
    }

    // ============================================================
    // Indikator kekuatan password
    // ============================================================
    function checkPasswordStrength(val) {
        const wrap = document.getElementById('strengthWrap');
        const bar  = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');

        if (!val) { wrap.style.display = 'none'; return; }
        wrap.style.display = 'block';

        let score = 0;
        if (val.length >= 6)               score++;
        if (val.length >= 10)              score++;
        if (/[A-Z]/.test(val))             score++;
        if (/[0-9]/.test(val))             score++;
        if (/[^a-zA-Z0-9]/.test(val))     score++;

        const levels = [
            { pct: '20%',  color: '#f44336', label: '😟 Sangat Lemah' },
            { pct: '40%',  color: '#ff9800', label: '😐 Lemah'         },
            { pct: '60%',  color: '#ffc107', label: '🙂 Cukup'         },
            { pct: '80%',  color: '#4caf50', label: '😊 Kuat'          },
            { pct: '100%', color: '#2196f3', label: '💪 Sangat Kuat'   },
        ];
        const lvl = levels[Math.min(score - 1, 4)] || levels[0];
        bar.style.width      = lvl.pct;
        bar.style.background = lvl.color;
        text.textContent     = lvl.label;
        text.style.color     = lvl.color;
    }

    // ============================================================
    // Cek kesesuaian konfirmasi password secara real-time
    // ============================================================
    function checkConfirm() {
        const pw      = document.getElementById('reg_password').value;
        const confirm = document.getElementById('reg_confirm').value;
        const msg     = document.getElementById('confirmMsg');
        const btn     = document.getElementById('btnSimpanUser');

        msg.classList.remove('d-none', 'text-success', 'text-danger');

        if (confirm === '') { msg.classList.add('d-none'); btn.disabled = false; return; }

        if (pw === confirm) {
            msg.textContent = '✅ Password cocok!';
            msg.classList.add('text-success');
            btn.disabled = false;
        } else {
            msg.textContent = '❌ Password tidak cocok!';
            msg.classList.add('text-danger');
            btn.disabled = true;
        }
    }

    function resetPassword(id, name) {
        const password = window.prompt('Password baru untuk ' + name + ' (minimal 6 karakter):');
        if (!password) return;
        const confirm = window.prompt('Ulangi password baru:');
        if (password !== confirm) {
            window.alert('Konfirmasi password tidak cocok.');
            return;
        }
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = "<?= base_url('index.php/back_user/reset_password'); ?>";
        [['id_user', id], ['password', password], ['confirm_password', confirm]].forEach(function (item) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = item[0];
            input.value = item[1];
            form.appendChild(input);
        });
        document.body.appendChild(form);
        form.submit();
    }

    // ============================================================
    // Validasi akhir sebelum submit form user
    // ============================================================
    document.getElementById('formUser').addEventListener('submit', function(e) {
        const pw      = document.getElementById('reg_password').value;
        const confirm = document.getElementById('reg_confirm').value;

        // Jika password diisi, pastikan cocok
        if (pw && pw !== confirm) {
            e.preventDefault();
            const msg = document.getElementById('confirmMsg');
            msg.textContent = '❌ Password tidak cocok, tidak bisa disimpan!';
            msg.classList.remove('d-none', 'text-success');
            msg.classList.add('text-danger');
        }
    });
</script>

<!-- JS: digunakan oleh V_Login.php dan V_Login_form.php -->
<script src="<?= base_url('assets/assets/vendor/libs/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/assets/vendor/libs/popper/popper.js') ?>"></script>
<script src="<?= base_url('assets/assets/vendor/js/bootstrap.js') ?>"></script>

<script>
    // ============================================================
    // [V_Login.php] Toggle show/hide password (dipakai bersama)
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

    // Dedicated listener untuk tombol toggle login page
    document.addEventListener('DOMContentLoaded', function() {
        var toggleBtn = document.getElementById('toggleLoginPw');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                togglePassword('password', 'eyeIconLogin');
            });
        }
    });

    // ============================================================
    // [V_Login_form.php] Indikator kekuatan password registrasi
    // ============================================================
    function checkPasswordStrength(val) {
        const wrap = document.getElementById('strengthWrap');
        const bar  = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');

        if (!val) { wrap.style.display = 'none'; return; }
        wrap.style.display = 'block';

        let score = 0;
        if (val.length >= 6)  score++;
        if (val.length >= 10) score++;
        if (/[A-Z]/.test(val)) score++;
        if (/[0-9]/.test(val)) score++;
        if (/[^a-zA-Z0-9]/.test(val)) score++;

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
    // [V_Login_form.php] Cek kesesuaian konfirmasi password
    // ============================================================
    function checkConfirm() {
        const pw      = document.getElementById('reg_password').value;
        const confirm = document.getElementById('reg_confirm').value;
        const msg     = document.getElementById('confirmMsg');
        const btn     = document.getElementById('btnDaftar');

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

    // ============================================================
    // [V_Login_form.php] Validasi akhir sebelum submit registrasi
    // ============================================================
    const formUser = document.getElementById('formUser');
    if (formUser) {
        formUser.addEventListener('submit', function(e) {
            const pw      = document.getElementById('reg_password').value;
            const confirm = document.getElementById('reg_confirm').value;

            // Jika ada konfirmasi password dan tidak cocok
            if (document.getElementById('reg_confirm') && pw !== confirm) {
                e.preventDefault();
                const msg = document.getElementById('confirmMsg');
                if (msg) {
                    msg.textContent = '❌ Password tidak cocok, tidak bisa mendaftar!';
                    msg.classList.remove('d-none', 'text-success');
                    msg.classList.add('text-danger');
                }
            }
        });
    }
</script>

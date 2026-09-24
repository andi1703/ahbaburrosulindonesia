<!DOCTYPE html>
<html lang="id" class="light-style" dir="ltr" data-theme="theme-default">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login — Ahbaburrosul Admin Panel</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/logo/logo-1778361619.jpeg'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('assets/assets/vendor/css/core.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/assets/css/demo.css') ?>" />
    <script src="<?= base_url('assets/assets/vendor/js/helpers.js') ?>"></script>
    <script src="<?= base_url('assets/assets/js/config.js') ?>"></script>

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            background: #eef0fb;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            font-family: 'Public Sans', sans-serif;
        }

        /* ─── Wrapper ─── */
        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 980px;
            min-height: 590px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(101, 109, 140, 0.20);
        }

        /* ─── Panel Kiri ─── */
        .lp-left {
            width: 42%;
            background: linear-gradient(155deg, #7a7dff 0%, #5254d4 55%, #3a3dcc 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .lp-left::before {
            content: '';
            position: absolute;
            width: 350px; height: 350px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            top: -100px; right: -100px;
        }
        .lp-left::after {
            content: '';
            position: absolute;
            width: 240px; height: 240px;
            border-radius: 50%;
            background: rgba(255,255,255,0.04);
            bottom: -70px; left: -70px;
        }

        .lp-logo {
            width: 88px; height: 88px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(255,255,255,0.4);
            box-shadow: 0 8px 30px rgba(0,0,0,0.28);
            margin-bottom: 1.4rem;
            position: relative; z-index: 2;
        }
        .lp-arabic {
            font-size: 1.2rem;
            color: rgba(255,255,255,0.93);
            font-weight: 500;
            letter-spacing: 1.5px;
            position: relative; z-index: 2;
        }
        .lp-sub {
            font-size: 0.76rem;
            color: rgba(255,255,255,0.52);
            margin-top: 0.25rem;
            margin-bottom: 1.75rem;
            position: relative; z-index: 2;
        }
        .lp-divider {
            width: 36px; height: 2px;
            background: rgba(255,255,255,0.28);
            border-radius: 2px;
            margin: 0 auto 1.5rem;
            position: relative; z-index: 2;
        }
        .lp-title {
            font-size: 1.55rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.6rem;
            position: relative; z-index: 2;
        }
        .lp-desc {
            font-size: 0.8rem;
            color: rgba(255,255,255,0.57);
            line-height: 1.7;
            position: relative; z-index: 2;
        }

        /* ─── Panel Kanan ─── */
        .lp-right {
            width: 58%;
            background: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3.25rem 3.5rem;
        }
        .lp-heading {
            font-size: 1.45rem;
            font-weight: 700;
            color: #444f5c;
            line-height: 1.3;
            margin-bottom: 0.3rem;
        }
        .lp-heading span { color: #696cff; }
        .lp-subheading {
            font-size: 0.845rem;
            color: #a8b3bf;
            margin-bottom: 2rem;
        }

        /* Alert */
        .lp-alert {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            font-size: 0.845rem;
            display: flex;
            align-items: flex-start;
            gap: 0.6rem;
            margin-bottom: 1.5rem;
            line-height: 1.5;
        }
        .lp-alert i { font-size: 1.1rem; flex-shrink: 0; margin-top: 0.05rem; }
        .lp-alert.err { background: #fff4f4; border: 1px solid #ffd6d6; color: #c0392b; }
        .lp-alert.ok  { background: #f0fdf4; border: 1px solid #c6f6d5; color: #1b5e20; }

        /* Label */
        .lp-label {
            font-size: 0.8rem;
            font-weight: 600;
            color: #556474;
            margin-bottom: 0.4rem;
            display: block;
        }

        /* Input Wrap */
        .lp-input-wrap {
            display: flex;
            align-items: center;
            border: 1.5px solid #dce1e9;
            border-radius: 9px;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
            overflow: hidden;
        }
        .lp-input-wrap:focus-within {
            border-color: #696cff;
            box-shadow: 0 0 0 3px rgba(105,108,255,0.13);
        }
        .lp-input-wrap .lp-ico {
            padding: 0 0.9rem;
            color: #b0bac5;
            font-size: 1.05rem;
            display: flex;
            align-items: center;
            flex-shrink: 0;
        }
        .lp-input-wrap input {
            flex: 1;
            border: none;
            outline: none;
            padding: 0.72rem 0.25rem;
            font-size: 0.9rem;
            color: #485568;
            background: transparent;
            font-family: inherit;
        }
        .lp-input-wrap input::placeholder { color: #c8d0da; }
        .lp-input-wrap .lp-eye {
            padding: 0 0.9rem;
            color: #b0bac5;
            cursor: pointer;
            display: flex;
            align-items: center;
            flex-shrink: 0;
            background: transparent;
            border: none;
            transition: color 0.2s;
            font-size: 1.1rem;
            height: 100%;
        }
        .lp-input-wrap .lp-eye:hover { color: #696cff; }

        /* Field Spacing */
        .lp-field { margin-bottom: 1.3rem; }

        /* Submit */
        .lp-btn-submit {
            width: 100%;
            padding: 0.78rem;
            background: linear-gradient(135deg, #696cff 0%, #5254d4 100%);
            color: #fff;
            border: none;
            border-radius: 9px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 18px rgba(105,108,255,0.38);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
            font-family: inherit;
        }
        .lp-btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 26px rgba(105,108,255,0.48);
        }
        .lp-btn-submit:active { transform: translateY(0); }

        /* Divider */
        .lp-divider-or {
            display: flex; align-items: center; gap: 0.75rem;
            color: #c8d0da; font-size: 0.78rem; margin: 1.3rem 0;
        }
        .lp-divider-or::before, .lp-divider-or::after {
            content: ''; flex: 1; height: 1px; background: #edf0f4;
        }

        /* Register */
        .lp-btn-reg {
            width: 100%;
            padding: 0.74rem;
            background: transparent;
            color: #696cff;
            border: 1.5px solid #696cff;
            border-radius: 9px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            font-family: inherit;
        }
        .lp-btn-reg:hover { background: #696cff; color: #fff; }

        /* Footer */
        .lp-foot {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.73rem;
            color: #c8d0da;
        }

        /* Responsive */
        @media (max-width: 680px) {
            .lp-left { display: none; }
            .lp-right { width: 100%; padding: 2.5rem 1.75rem; }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    <!-- Panel Kiri -->
    <div class="lp-left">
        <img src="<?= base_url('assets/img/logo/logo-1778361619.jpeg'); ?>"
             alt="Logo" class="lp-logo"
             onerror="this.style.display='none';">
        <p class="lp-arabic">السَّلاَمُ عَلَيْكُمْ</p>
        <p class="lp-sub">Assalamualaikum, Sahabat Ahbaburrosul</p>
        <div class="lp-divider"></div>
        <h3 class="lp-title">Selamat Datang</h3>
        <p class="lp-desc">Masuk ke panel admin untuk mengelola konten dan aktivitas website Ahbaburrosul.</p>
    </div>

    <!-- Panel Kanan -->
    <div class="lp-right">
        <h4 class="lp-heading">Masuk ke <span>Dashboard</span></h4>
        <p class="lp-subheading">Masukkan kredensial akun Anda untuk melanjutkan.</p>

        <!-- Flash Messages -->
        <?php if($this->session->flashdata('pesan')): ?>
        <div class="lp-alert err">
            <i class='bx bx-error-circle'></i>
            <span><?= $this->session->flashdata('pesan'); ?></span>
        </div>
        <?php endif; ?>
        <?php if($this->session->flashdata('sukses')): ?>
        <div class="lp-alert ok">
            <i class='bx bx-check-circle'></i>
            <span><?= $this->session->flashdata('sukses'); ?></span>
        </div>
        <?php endif; ?>

        <!-- Form Login -->
        <form id="formLogin" action="<?= base_url('index.php/admin/login_process'); ?>" method="post">

            <div class="lp-field">
                <label class="lp-label" for="username">Username</label>
                <div class="lp-input-wrap">
                    <span class="lp-ico"><i class='bx bx-user'></i></span>
                    <input type="text" id="username" name="username"
                           placeholder="Masukkan username Anda"
                           autocomplete="username" required autofocus>
                </div>
            </div>

            <div class="lp-field">
                <label class="lp-label" for="password">Password</label>
                <div class="lp-input-wrap">
                    <span class="lp-ico"><i class='bx bx-lock-alt'></i></span>
                    <input type="password" id="password" name="password"
                           placeholder="••••••••"
                           autocomplete="current-password" required>
                    <button type="button" class="lp-eye" id="toggleLoginPw" title="Tampilkan/Sembunyikan password">
                        <i class='bx bx-hide' id="eyeIconLogin"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="lp-btn-submit">
                <i class='bx bx-log-in'></i> Masuk ke Dashboard
            </button>

        </form>

        <div class="lp-divider-or">atau</div>

        <button type="button" class="lp-btn-reg"
                data-bs-toggle="modal" data-bs-target="#modalUser"
                onclick="bukaModalTambah()">
            <i class='bx bx-user-plus'></i> Daftarkan Akun Baru
        </button>

        <p class="lp-foot">&copy; <?= date('Y'); ?> Majelis Ahbaburrosul Indonesia &mdash; CMS Admin Panel</p>
    </div>

</div>

<!-- Modal Registrasi -->
<?php $this->load->view('admin/login/V_Login_form'); ?>

<!-- JS -->
<?php $this->load->view('admin/login/V_Login_js'); ?>

</body>
</html>
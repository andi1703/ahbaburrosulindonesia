<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style>
    /* ── Amalan Sub-nav ── */
    .am-subnav {
        position: fixed;
        top: 70px;
        left: 0;
        right: 0;
        z-index: 120;
        height: 48px;
        display: flex;
        align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
    }

    .am-subnav-inner {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        width: 100%;
        max-width: 1120px;
        margin-inline: auto;
        padding-inline: 1rem;
        overflow-x: auto;
        scrollbar-width: none;
    }

    .am-subnav-inner::-webkit-scrollbar {
        display: none;
    }

    .am-pill {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        height: 34px;
        padding: 0 .85rem;
        border: 1.5px solid rgba(255, 255, 255, .12);
        border-radius: 8px;
        background: #1a1d1c;
        color: #a8b5b0;
        font: inherit;
        font-size: .73rem;
        white-space: nowrap;
        text-decoration: none;
        cursor: pointer;
        flex-shrink: 0;
        transition: border-color .14s, color .14s, background .14s;
    }

    .am-pill:hover {
        border-color: #28c3a3;
        color: #28c3a3;
    }

    .am-pill.is-active {
        border-color: #28c3a3;
        background: rgba(40, 195, 163, .08);
        color: #28c3a3;
        font-weight: 600;
    }

    .am-arrow {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        height: 34px;
        padding: 0 .65rem;
        border: 1.5px solid rgba(255, 255, 255, .12);
        border-radius: 8px;
        background: #1a1d1c;
        color: #a8b5b0;
        font: inherit;
        font-size: .73rem;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
        transition: border-color .14s, color .14s;
    }

    .am-arrow:hover {
        border-color: #28c3a3;
        color: #28c3a3;
    }

    .am-arrow[aria-disabled="true"] {
        opacity: .3;
        pointer-events: none;
    }

    .am-arrow i {
        font-size: 1.1rem;
    }

    .am-arrow-name {
        display: none;
    }

    @media(min-width:580px) {
        .am-arrow-name {
            display: inline;
        }
    }

    .am-hub-name {
        display: none;
    }

    @media(min-width:960px) {
        .am-hub-name {
            display: inline;
        }
    }

    .am-sel {
        appearance: none;
        height: 34px;
        padding: 0 1.5rem 0 .7rem;
        border: 1.5px solid rgba(255, 255, 255, .12);
        border-radius: 8px;
        background: #1a1d1c url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%236d7e78'/%3E%3C/svg%3E") no-repeat right .55rem center;
        color: #a8b5b0;
        font: inherit;
        font-size: .73rem;
        flex-shrink: 0;
        cursor: pointer;
        outline: none;
    }

    .am-sel:focus {
        border-color: #28c3a3;
    }

    .amalan-page {
        --am-bg: #0b0d0d;
        --am-surface: #191c1b;
        --am-surface-hover: #202523;
        --am-text: #f2f5f4;
        --am-muted: #9aa5a1;
        --am-accent: #28c3a3;
        --am-gold: #c9a84c;
        padding-top: calc(70px + 48px);
        min-height: 100vh;
        color: var(--am-text);
        background: var(--am-bg);
    }

    .amalan-hero {
        position: relative;
        overflow: hidden;
        background-color: #00685f;
        background-image:
            repeating-linear-gradient(45deg, transparent 0 18px, rgba(255, 255, 255, .025) 18px 19px),
            repeating-linear-gradient(-45deg, transparent 0 18px, rgba(0, 0, 0, .035) 18px 19px);
        padding-block: 3rem 2.5rem;
    }

    .amalan-hero-inner {
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
        display: flex;
        align-items: center;
        gap: 1.25rem;
    }

    .amalan-hero-icon {
        display: grid;
        flex: 0 0 56px;
        width: 56px;
        height: 56px;
        place-items: center;
        border: 1px solid rgba(255, 255, 255, .35);
        border-radius: 50%;
        color: #d1fff3;
        font-family: 'Amiri', serif;
        font-size: 1.9rem;
    }

    .amalan-hero-eyebrow {
        margin: 0 0 .15rem;
        color: rgba(255, 255, 255, .72);
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .amalan-hero-title {
        margin: 0;
        color: #fff;
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .amalan-hero-sub {
        margin: .35rem 0 0;
        color: rgba(255, 255, 255, .76);
        font-size: .83rem;
    }

    /* ── Hub Grid ── */
    .amalan-hub {
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
        padding-block: 2rem 4rem;
    }

    .amalan-hub-heading {
        margin: 0 0 1.35rem;
        color: var(--am-muted);
        font-size: .72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .08em;
    }

    .amalan-cards {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: .85rem;
    }

    .amalan-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.15rem 1.2rem;
        border: 1px solid rgba(255, 255, 255, .05);
        border-radius: 12px;
        background: var(--am-surface);
        color: var(--am-text);
        text-decoration: none;
        transition: background-color 150ms ease, border-color 150ms ease, transform 150ms ease;
        cursor: pointer;
    }

    .amalan-card:hover,
    .amalan-card:focus-visible {
        border-color: rgba(40, 195, 163, .5);
        background: var(--am-surface-hover);
        color: #fff;
        transform: translateY(-2px);
    }

    .amalan-card-icon {
        display: grid;
        flex: 0 0 46px;
        width: 46px;
        height: 46px;
        place-items: center;
        border-radius: 10px;
        font-size: 1.45rem;
    }

    .amalan-card-copy {
        min-width: 0;
    }

    .amalan-card-name {
        display: block;
        font-size: .82rem;
        font-weight: 700;
        line-height: 1.3;
        color: inherit;
    }

    .amalan-card-desc {
        display: block;
        margin-top: .2rem;
        font-size: .69rem;
        color: var(--am-muted);
        line-height: 1.4;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .amalan-card-arrow {
        margin-left: auto;
        color: var(--am-muted);
        font-size: 1.1rem;
        flex-shrink: 0;
        transition: color 150ms;
    }

    .amalan-card:hover .amalan-card-arrow {
        color: var(--am-accent);
    }

    /* Color variants for icons */
    .ic-quran {
        background: rgba(40, 195, 163, .15);
        color: #28c3a3;
    }

    .ic-tahlil {
        background: rgba(201, 168, 76, .15);
        color: #c9a84c;
    }

    .ic-doa {
        background: rgba(99, 160, 255, .15);
        color: #63a0ff;
    }

    .ic-wirid {
        background: rgba(255, 140, 80, .15);
        color: #ff8c50;
    }

    .ic-hadits {
        background: rgba(180, 100, 255, .15);
        color: #b464ff;
    }

    .ic-jadwal {
        background: rgba(80, 200, 120, .15);
        color: #50c878;
    }

    @media (max-width: 767.98px) {
        .amalan-cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 479.98px) {
        .amalan-cards {
            grid-template-columns: minmax(0, 1fr);
        }

        .amalan-hero-title {
            font-size: 1.45rem;
        }
    }
</style>

<!-- ── Amalan Sub-nav ── -->
<nav class="am-subnav" aria-label="Navigasi Amalan">
    <div class="am-subnav-inner">
        <a class="am-pill is-active" href="<?= base_url('index.php/amalan'); ?>">
            <i class="bx bx-grid-alt"></i>
            <span class="am-hub-name">Daftar Amalan</span>
        </a>
        <select class="am-sel" id="amPilihSel" aria-label="Pilih Amalan">
            <option value="">Pilih Amalan</option>
            <option value="<?= base_url('index.php/tahlil'); ?>">Tahlil</option>
            <option value="<?= base_url('index.php/doa'); ?>">Doa</option>
            <option value="<?= base_url('index.php/wirid'); ?>">Wirid</option>
            <option value="<?= base_url('index.php/hadits'); ?>">Hadits</option>
            <option value="<?= base_url('index.php/jadwal-sholat'); ?>">Jadwal Sholat</option>
        </select>
    </div>
</nav>
<script>
    (function() {
        var s = document.getElementById('amPilihSel');
        if (s) s.addEventListener('change', function() {
            if (this.value) window.location.href = this.value;
        });
    })();
</script>

<main class="amalan-page">

    <!-- Hero -->
    <header class="amalan-hero">
        <div class="amalan-hero-inner">
            <span class="amalan-hero-icon" aria-hidden="true">۞</span>
            <div>
                <p class="amalan-hero-eyebrow">Bacaan, Doa, Wirid, dan Jadwal</p>
                <h1 class="amalan-hero-title">Amalan</h1>
                <p class="amalan-hero-sub">Panduan lengkap amalan harian Ahlussunnah Wal Jama'ah.</p>
            </div>
        </div>
    </header>

    <!-- Hub Menu -->
    <section class="amalan-hub">
        <p class="amalan-hub-heading">Pilih Amalan</p>

        <div class="amalan-cards">

            <!-- Al-Qur'an -->
            <a class="amalan-card" href="<?= base_url('index.php/quran'); ?>">
                <span class="amalan-card-icon ic-quran">
                    <i class="bx bx-book-open"></i>
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Al-Qur'an</span>
                    <span class="amalan-card-desc">Baca 114 surah dan 30 juz Al-Qur'an lengkap dengan terjemahan.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Tahlil -->
            <a class="amalan-card" href="<?= base_url('index.php/tahlil'); ?>">
                <span class="amalan-card-icon ic-tahlil">
                    <i class="bx bx-moon"></i>
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Tahlil</span>
                    <span class="amalan-card-desc">Rangkaian doa dan dzikir tahlil lengkap untuk berbagai keperluan.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Doa -->
            <a class="amalan-card" href="<?= base_url('index.php/doa'); ?>">
                <span class="amalan-card-icon ic-doa">
                    <i class="bx bx-hand"></i>
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Burdah Al Madih</span>
                    <span class="amalan-card-desc">Kumpulan doa harian, doa sesudah sholat, dan doa-doa pilihan.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Wirid -->
            <a class="amalan-card" href="<?= base_url('index.php/wirid'); ?>">
                <span class="amalan-card-icon ic-wirid">
                    <i class="bx bx-repeat"></i>
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Wirid</span>
                    <span class="amalan-card-desc">Dzikir dan wirid ba'da sholat sesuai tuntunan Ahlussunnah.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Hadits -->
            <a class="amalan-card" href="<?= base_url('index.php/hadits'); ?>">
                <span class="amalan-card-icon ic-hadits">
                    <i class="bx bx-news"></i>
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Hadits</span>
                    <span class="amalan-card-desc">Hadits pilihan Rasulullah SAW sebagai pedoman kehidupan sehari-hari.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Jadwal Sholat -->
            <a class="amalan-card" href="<?= base_url('index.php/jadwal-sholat'); ?>">
                <span class="amalan-card-icon ic-jadwal">
                    <i class="bx bx-time-five"></i>
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Jadwal Sholat</span>
                    <span class="amalan-card-desc">Waktu sholat 5 waktu berdasarkan lokasi dan kota Anda.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

        </div>
    </section>

</main>
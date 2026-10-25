<?php
defined('BASEPATH') or exit('No direct script access allowed');
$_ib = base_url('assets/frontend/icons/islamic/');
?>

<style>
    body {
        background: #0b0d0d;
    }

    /* (sub-nav moved to V_Amalan_Subnav.php) */
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
        border-color: #e8b84b;
        color: #e8b84b;
    }

    .am-pill.is-active {
        border-color: #e8b84b;
        background: rgba(232, 184, 75, .08);
        color: #e8b84b;
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
        border-color: #e8b84b;
        color: #e8b84b;
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
        border-color: #e8b84b;
    }

    .amalan-page {
        --am-bg: #0b0d0d;
        --am-surface: #191c1b;
        --am-surface-hover: #202523;
        --am-text: #f2f5f4;
        --am-muted: #9aa5a1;
        --am-accent: #e8b84b;
        --am-gold: #e8b84b;
        position: relative;
        padding-top: 1rem;
        color: var(--am-text);
        background: var(--am-bg);
        isolation: isolate;
        overflow: hidden;
    }

    /* Same 8-point star tile used by .an-hero above, carried down at low
       opacity so the hub page reads as one continuous surface instead of
       cutting from gold hero straight to flat black. */
    .amalan-page::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Cpath d='M20 3 L22.7 13.5 L32 8 L26.5 17.3 L37 20 L26.5 22.7 L32 32 L22.7 26.5 L20 37 L17.3 26.5 L8 32 L13.5 22.7 L3 20 L13.5 17.3 L8 8 L17.3 13.5 Z' fill='none' stroke='%23e8b84b' stroke-opacity='.5' stroke-width='0.7'/%3E%3C/svg%3E");
        background-size: 40px 40px;
        background-repeat: repeat;
        opacity: .05;
        pointer-events: none;
    }

    /* Vignette layer — a real element (not a 3rd pseudo-element, since
       ::before/::after are already spoken for above) that fades the gold
       hero tone into the dark surface as you scroll into the card grid. */
    .amalan-glow {
        position: absolute;
        inset: 0;
        z-index: 0;
        background:
            radial-gradient(ellipse 120% 55% at 50% 0%, rgba(232, 184, 75, .1), transparent 60%),
            linear-gradient(180deg, rgba(11, 13, 13, .25) 0%, rgba(11, 13, 13, .75) 32%, var(--am-bg) 60%);
        pointer-events: none;
    }

    .amalan-page>*:not(.amalan-glow) {
        position: relative;
        z-index: 1;
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
        border-color: rgba(232, 184, 75, .5);
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

    .amalan-icon-svg {
        width: 26px;
        height: 26px;
        display: block;
        filter: brightness(0) invert(1);
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
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-tahlil {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-doa {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-wirid {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-khawajagan {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-hadits {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-jadwal {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-burdah {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-maulid {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-sholawat {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    .ic-tasbih {
        background: rgba(232, 184, 75, .15);
        color: #e8b84b;
    }

    @media (max-width: 767.98px) {
        .amalan-cards {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .amalan-hub {
            padding-block: 1.25rem 3rem;
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

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<main class="amalan-page">
    <div class="amalan-glow" aria-hidden="true"></div>

    <!-- Hub Menu -->
    <section class="amalan-hub">
        <p class="amalan-hub-heading">Pilih Amalan</p>

        <div class="amalan-cards">

            <!-- Al-Qur'an -->
            <a class="amalan-card" href="<?= base_url('index.php/quran'); ?>">
                <span class="amalan-card-icon ic-quran">
                    <img src="<?= $_ib ?>quran-book.svg" class="amalan-icon-svg" alt="">
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
                    <img src="<?= $_ib ?>islamic-cemetery.svg" class="amalan-icon-svg" alt="">
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Tahlil</span>
                    <span class="amalan-card-desc">Rangkaian doa dan dzikir tahlil lengkap untuk berbagai keperluan.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Burdah Al Madih -->
            <a class="amalan-card" href="<?= base_url('index.php/burdah'); ?>">
                <span class="amalan-card-icon ic-burdah">
                    <img src="<?= $_ib ?>muhammad-calligraphy.svg" class="amalan-icon-svg" alt="">
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Burdah Al Madih</span>
                    <span class="amalan-card-desc">Kasidah Burdah — syair pujian kepada Nabi Muhammad ﷺ karya Imam Al-Bushiri.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Sholawat -->
            <a class="amalan-card" href="<?= base_url('index.php/sholawat'); ?>">
                <span class="amalan-card-icon ic-sholawat">
                    <img src="<?= $_ib ?>takbir-hands.svg" class="amalan-icon-svg" alt="">
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Sholawat</span>
                    <span class="amalan-card-desc">Kumpulan sholawat nasyid dan suluk — kasidah pujian kepada Nabi ﷺ.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Maulid Ad-Diba'i -->
            <a class="amalan-card" href="<?= base_url('index.php/maulid'); ?>">
                <span class="amalan-card-icon ic-maulid">
                    <img src="<?= $_ib ?>crescent-star-frame.svg" class="amalan-icon-svg" alt="">
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Maulid Ad-Diba'i</span>
                    <span class="amalan-card-desc">29 bacaan maulid karya Syaikh Abdurrahman Ad-Diba'i lengkap dengan terjemahan.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Wirid -->
            <a class="amalan-card" href="<?= base_url('index.php/wirid'); ?>">
                <span class="amalan-card-icon ic-wirid">
                    <img src="<?= $_ib ?>prayer-mat.svg" class="amalan-icon-svg" alt="">
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Wirid</span>
                    <span class="amalan-card-desc">Dzikir dan wirid ba'da sholat sesuai tuntunan Ahlussunnah.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Dzikir Khatam Khawajagan -->
            <a class="amalan-card" href="<?= base_url('index.php/khawajagan'); ?>">
                <span class="amalan-card-icon ic-khawajagan">
                    <img src="<?= $_ib ?>prayer-beads-tasbih.svg" class="amalan-icon-svg" alt="">
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Dzikir Khawajagan</span>
                    <span class="amalan-card-desc">Dzikir Khatam dari Silsilah Naqshbandiyyah Al-'Aliyyah.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Manaqib -->
            <a class="amalan-card" href="<?= base_url('index.php/manaqib'); ?>">
                <span class="amalan-card-icon ic-hadits">
                    <img src="<?= $_ib ?>mosque-dome.svg" class="amalan-icon-svg" alt="">
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Manaqib</span>
                    <span class="amalan-card-desc">Manaqib Jawahirul Ma'ani — kisah dan kemuliaan Syekh Abdul Qadir Al-Jailani.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Tasbih Digital -->
            <a class="amalan-card" href="<?= base_url('index.php/tasbih'); ?>">
                <span class="amalan-card-icon ic-tasbih">
                    <img src="<?= $_ib ?>tasbih-ring.svg" class="amalan-icon-svg" alt="">
                </span>
                <span class="amalan-card-copy">
                    <span class="amalan-card-name">Tasbih Digital</span>
                    <span class="amalan-card-desc">Penghitung dzikir digital dengan suara, bead ring, dan dzikir kustom.</span>
                </span>
                <i class="bx bx-chevron-right amalan-card-arrow"></i>
            </a>

            <!-- Jadwal Sholat -->
            <a class="amalan-card" href="<?= base_url('index.php/jadwal-sholat'); ?>">
                <span class="amalan-card-icon ic-jadwal">
                    <img src="<?= $_ib ?>adhan-call.svg" class="amalan-icon-svg" alt="">
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
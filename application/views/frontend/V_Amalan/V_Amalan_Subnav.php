<?php
$CI = &get_instance();
$_uri = strtolower($CI->uri->uri_string());

$_an_active = '';
if (strpos($_uri, 'tahlil') === 0)    $_an_active = 'tahlil';
elseif (strpos($_uri, 'burdah') === 0) $_an_active = 'burdah';
elseif (strpos($_uri, 'wirid') === 0)       $_an_active = 'wirid';
elseif (strpos($_uri, 'khawajagan') === 0)  $_an_active = 'khawajagan';
elseif (strpos($_uri, 'tasbih') === 0)      $_an_active = 'tasbih';
elseif (strpos($_uri, 'manaqib') === 0 || strpos($_uri, 'hadits') === 0) $_an_active = 'manaqib';
elseif (strpos($_uri, 'maulid') === 0)      $_an_active = 'maulid';
elseif (strpos($_uri, 'sholawat') === 0)    $_an_active = 'sholawat';
elseif (strpos($_uri, 'quran') === 0)          $_an_active = 'quran';
elseif (strpos($_uri, 'jadwal-sholat') === 0)  $_an_active = 'jadwal-sholat';

$_an_is_reader  = (bool) $CI->uri->segment(2);
$_an_show_hero  = !$_an_is_reader && in_array($_an_active, ['', 'quran', 'tahlil', 'burdah', 'manaqib', 'maulid', 'sholawat']);

$_an_items = [
    ''           => ['svg' => 'kaaba',               'short' => 'Amalan',    'full' => 'Semua Amalan',      'url' => base_url('index.php/amalan')],
    'quran'      => ['svg' => 'quran-book',          'short' => "Al-Qur'an", 'full' => "Al-Qur'an",         'url' => base_url('index.php/quran')],
    'tahlil'     => ['svg' => 'islamic-cemetery',    'short' => 'Tahlil',    'full' => 'Tahlil',            'url' => base_url('index.php/tahlil')],
    'burdah'     => ['svg' => 'muhammad-calligraphy', 'short' => 'Burdah',    'full' => 'Burdah Al Madih',   'url' => base_url('index.php/burdah')],
    'wirid'      => ['svg' => 'prayer-mat',          'short' => 'Wirid',     'full' => 'Wirid & Dzikir',    'url' => base_url('index.php/wirid')],
    'khawajagan' => ['svg' => 'prayer-beads-tasbih', 'short' => 'Khawajagan', 'full' => 'Dzikir Khawajagan', 'url' => base_url('index.php/khawajagan')],
    'manaqib'    => ['svg' => 'mosque-dome',         'short' => 'Manaqib',   'full' => 'Manaqib',           'url' => base_url('index.php/manaqib')],
    'maulid'     => ['svg' => 'crescent-star-frame', 'short' => 'Maulid',    'full' => "Maulid Ad-Diba'i",  'url' => base_url('index.php/maulid')],
    'sholawat'   => ['svg' => 'takbir-hands',        'short' => 'Sholawat',  'full' => 'Sholawat',          'url' => base_url('index.php/sholawat')],
    'tasbih'     => ['svg' => 'tasbih-ring',          'short' => 'Tasbih',   'full' => 'Tasbih Digital',    'url' => base_url('index.php/tasbih')],
];

$_an_heros = [
    ''        => ['bx' => 'bx-grid-alt',  'title' => 'Amalan',          'sub' => 'Panduan lengkap amalan harian Ahlussunnah Wal Jama\'ah.'],
    'quran'   => ['bx' => 'bx-book-open', 'title' => "Al-Qur'an",       'sub' => '114 surah dan 30 juz dengan terjemahan lengkap.'],
    'tahlil'  => ['bx' => 'bx-moon',      'title' => 'Tahlil',          'sub' => 'Rangkaian doa dan dzikir tahlil untuk berbagai keperluan.'],
    'burdah'  => ['bx' => 'bx-star',      'title' => 'Burdah Al Madih', 'sub' => 'Kasidah Burdah — syair pujian kepada Nabi Muhammad ﷺ.'],
    'khawajagan' => ['bx' => 'bx-infinite', 'title' => 'Dzikir Khatam Khawajagan', 'sub' => 'Dzikir Khatam dari Silsilah Naqshbandiyyah Al-\'Aliyyah.'],
    'manaqib'    => ['bx' => 'bx-news',    'title' => 'Manaqib',                  'sub' => 'Manaqib Jawahirul Ma\'ani — kisah Syekh Abdul Qadir Al-Jailani.'],
    'maulid'     => ['bx' => 'bx-music',   'title' => "Maulid Ad-Diba'i",         'sub' => '29 bacaan maulid karya Syaikh Abdurrahman Ad-Diba\'i.'],
    'sholawat'   => ['bx' => 'bx-heart',  'title' => 'Sholawat',                 'sub' => 'Kumpulan sholawat dan kasidah pujian kepada Nabi Muhammad ﷺ.'],
    'tasbih'     => ['bx' => 'bx-rotate-right', 'title' => 'Tasbih Digital',    'sub' => 'Penghitung dzikir digital dengan suara, bead ring, dan dzikir kustom.'],
];
$_hero = $_an_heros[$_an_active] ?? $_an_heros[''];
$_logo = !empty($identitas['logo']) ? base_url('assets/img/logo/' . $identitas['logo']) : '';
$_site_name = $identitas['nama_website'] ?? 'Majelis Ahbaburrosul Indonesia';
$_an_bg = base_url('assets/frontend/images/amalan-bg.jpg');
?>
<style>
    :root {
        --an-hdr-h: 76px;
    }

    /* ── Hide main site navbar & WhatsApp button on amalan pages ── */
    #mainNavbar {
        display: none !important;
    }

    .btn-whatsapp-floating {
        display: none !important;
    }

    /* ══════════════════════════════════════════
   FLOATING PILL HEADER
   ══════════════════════════════════════════ */
    #anHeader {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 150;
        padding: 16px 14px;
        transition: padding .32s ease;
        pointer-events: none;
    }

    #anPill {
        max-width: 1140px;
        margin: 0 auto;
        background: rgba(7, 10, 9, .94);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-radius: 16px;
        border: 1px solid rgba(255, 255, 255, .1);
        box-shadow: 0 4px 28px rgba(0, 0, 0, .55);
        display: flex;
        align-items: center;
        height: 60px;
        padding-inline: .65rem;
        transition: border-radius .32s ease, max-width .32s ease,
            box-shadow .32s ease, border-color .32s ease;
        pointer-events: auto;
    }

    /* Scrolled: expand to full-width sticky bar */
    #anHeader.an-scrolled {
        padding: 0;
    }

    #anHeader.an-scrolled #anPill {
        border-radius: 0;
        max-width: 100%;
        border-left: none;
        border-right: none;
        border-top: none;
        box-shadow: 0 2px 12px rgba(0, 0, 0, .45);
    }

    /* ── Left: hamburger + brand ── */
    .an-left {
        display: flex;
        align-items: center;
        gap: .45rem;
        flex-shrink: 0;
    }

    .an-brand {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        text-decoration: none;
    }

    .an-brand-logo {
        height: 34px;
        width: 34px;
        border-radius: 8px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid rgba(255, 255, 255, .12);
    }

    .an-brand-text {
        display: none;
        flex-direction: column;
        line-height: 1.15;
    }

    .an-brand-text strong {
        font-size: .72rem;
        font-weight: 800;
        color: #fff;
        letter-spacing: .01em;
    }

    .an-brand-text em {
        font-style: normal;
        font-size: .58rem;
        color: #e8b84b;
        font-weight: 600;
    }

    @media (min-width: 380px) {
        .an-brand-text {
            display: flex;
        }
    }

    /* ── Center: desktop nav links ── */
    .an-center {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0;
        overflow-x: auto;
        scrollbar-width: none;
        min-width: 0;
    }

    .an-center::-webkit-scrollbar {
        display: none;
    }

    /* ── Right: icon buttons ── */
    .an-right {
        display: flex;
        align-items: center;
        gap: .15rem;
        flex-shrink: 0;
    }

    .an-icon-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border-radius: 8px;
        background: transparent;
        color: #7a8f8a;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font: inherit;
        transition: background .14s, color .14s;
    }

    .an-icon-btn:hover {
        background: rgba(255, 255, 255, .08);
        color: #c4d0cc;
    }

    .an-icon-btn i {
        font-size: 1.1rem;
    }

    /* ── Mobile hamburger ── */
    .an-mob-btn {
        display: none;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border: none;
        border-radius: 8px;
        background: rgba(255, 255, 255, .07);
        color: #a8b5b0;
        cursor: pointer;
        transition: background .14s, color .14s;
        flex-shrink: 0;
    }

    .an-mob-btn:hover {
        background: rgba(255, 255, 255, .12);
        color: #fff;
    }

    .an-mob-btn i {
        font-size: 1.2rem;
    }

    /* ── Desktop nav links ── */
    .an-link {
        display: inline-flex;
        align-items: center;
        height: 52px;
        padding: 0 .8rem;
        color: #fff;
        font-size: .72rem;
        font-weight: 500;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
        border-bottom: 2px solid transparent;
        transition: color .14s, border-color .14s;
    }

    .an-link:hover {
        color: #e8b84b;
    }

    .an-link.an-active {
        color: #e8b84b;
        border-bottom-color: #e8b84b;
        font-weight: 600;
    }

    @media (max-width: 639px) {
        .an-link {
            display: none;
        }

        .an-mob-btn {
            display: inline-flex;
        }
    }

    /* ══════════════════════════════════════════
   HERO SECTION
   ══════════════════════════════════════════ */
    .an-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(155deg, #D4880C 0%, #BA7008 30%, #9A5808 58%, #7A4210 84%, #5A3010 100%);
        padding-top: 7.5rem;
        padding-bottom: 5rem;
        box-shadow: 0 3px 0 rgba(232, 184, 75, .40), 0 6px 32px rgba(0, 0, 0, .50);
    }

    /* Islamic 8-point star tile */
    .an-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        z-index: 0;
        background-image:
            url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Cpath d='M20 3 L22.7 13.5 L32 8 L26.5 17.3 L37 20 L26.5 22.7 L32 32 L22.7 26.5 L20 37 L17.3 26.5 L8 32 L13.5 22.7 L3 20 L13.5 17.3 L8 8 L17.3 13.5 Z' fill='none' stroke='white' stroke-opacity='.06' stroke-width='0.7'/%3E%3C/svg%3E");
        background-size: 40px 40px;
        background-position: 0 0;
        background-repeat: repeat;
        pointer-events: none;
    }

    /* The sketch you supplied, used as the hero's skyline silhouette.
       Its white background is dropped via multiply blending so only the
       dark linework reads, as an engraved motif on the gold gradient. */
    .an-hero-photo {
        position: absolute;
        inset: 0;
        z-index: 0;
        background-image: url('<?= $_an_bg ?>');
        /* Scale by height, not width — keeps the whole skyline (towers
           included) in frame instead of cropping the tops off when the
           banner is shorter than the image's natural proportions. */
        background-size: auto 100%;
        background-position: bottom center;
        background-repeat: no-repeat;
        mix-blend-mode: multiply;
        opacity: .6;
        pointer-events: none;
    }

    /* Bright multi-point glow */
    .an-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse 700px 380px at 50% 10%, rgba(255, 225, 90, .32) 0%, transparent 55%),
            radial-gradient(ellipse 420px 300px at 8% 65%, rgba(255, 205, 55, .22) 0%, transparent 55%),
            radial-gradient(ellipse 320px 260px at 92% 60%, rgba(220, 145, 10, .20) 0%, transparent 50%),
            radial-gradient(ellipse 220px 130px at 50% 105%, rgba(30, 12, 0, .50) 0%, transparent 55%);
        pointer-events: none;
    }

    .an-hero-inner {
        position: relative;
        z-index: 1;
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
        display: flex;
        align-items: center;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .an-hero-copy {
        flex: 1;
        min-width: min(100%, 260px);
    }

    /* Search bar (quran page only) */
    .an-hero-search-wrap {
        flex: 0 1 440px;
        min-width: min(100%, 300px);
    }

    .an-hero-search {
        display: flex;
        align-items: center;
        gap: .5rem;
        background: rgba(0, 0, 0, .45);
        border: 1.5px solid rgba(232, 184, 75, .25);
        border-radius: 99px;
        padding: 0 1.1rem;
        transition: border-color .22s;
    }

    .an-hero-search:focus-within {
        border-color: rgba(232, 184, 75, .6);
    }

    .an-hero-search i {
        color: rgba(232, 184, 75, .7);
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .an-hero-search input {
        flex: 1;
        background: none;
        border: none;
        outline: none;
        color: #fff;
        font: inherit;
        font-size: .875rem;
        padding: .75rem 0;
    }

    .an-hero-search input::placeholder {
        color: rgba(255, 255, 255, .35);
    }

    .an-hero-search-hint {
        margin: .5rem 0 0 1.1rem;
        font-size: .68rem;
        color: rgba(255, 255, 255, .5);
    }

    .an-hero-eyebrow {
        margin: 0 0 .2rem;
        font-size: .67rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .62);
    }

    .an-hero-title {
        margin: 0;
        color: #fff;
        font-size: clamp(1.55rem, 4.5vw, 2.4rem);
        font-weight: 800;
        line-height: 1.15;
    }

    .an-hero-sub {
        margin: .35rem 0 0;
        color: rgba(255, 255, 255, .75);
        font-size: .82rem;
        line-height: 1.5;
    }

    @media (max-width: 767.98px) {
        /* auto-100% scales the photo to the hero's height, which on a
           narrow phone makes it far wider than the viewport and crops
           the sides — shrink to fit the whole skyline instead. */
        .an-hero-photo {
            background-size: contain;
        }
    }

    @media (max-width: 479px) {
        .an-hero {
            padding-top: 7rem;
            padding-bottom: 3.75rem;
        }

        .an-hero-inner {
            justify-content: center;
        }

        .an-hero-copy {
            text-align: center;
        }

        .an-hero-title {
            font-size: 1.45rem;
        }
    }

    /* ══════════════════════════════════════════
   BOTTOM SHEET
   ══════════════════════════════════════════ */
    .an-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 800;
        background: rgba(0, 0, 0, .58);
    }

    .an-overlay.an-open {
        display: block;
        animation: an-fadein .2s ease;
    }

    .an-sheet {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 810;
        background: #141716;
        border-radius: 20px 20px 0 0;
        transform: translateY(100%);
        transition: transform .28s cubic-bezier(.32, .72, 0, 1);
        padding-bottom: max(env(safe-area-inset-bottom, 0px), .75rem);
    }

    .an-sheet.an-open {
        transform: translateY(0);
    }

    .an-sheet-handle {
        display: flex;
        justify-content: center;
        padding: .7rem 0 .45rem;
        cursor: grab;
    }

    .an-sheet-handle span {
        width: 38px;
        height: 4px;
        border-radius: 99px;
        background: rgba(255, 255, 255, .18);
    }

    .an-sheet-head {
        padding: 0 1.25rem .6rem;
        font-size: .68rem;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: #5d6e69;
    }

    .an-sheet-row {
        display: flex;
        align-items: center;
        gap: .9rem;
        padding: .8rem 1.25rem;
        color: #bfcbc6;
        font-size: .875rem;
        text-decoration: none;
        border-top: 1px solid rgba(255, 255, 255, .05);
        transition: background .12s;
    }

    .an-sheet-row:hover,
    .an-sheet-row:focus-visible {
        background: rgba(255, 255, 255, .03);
    }

    .an-sheet-row.an-active {
        color: #e8b84b;
        font-weight: 600;
    }

    .an-sheet-row i {
        font-size: 1.2rem;
        width: 1.5rem;
        text-align: center;
        flex-shrink: 0;
    }

    .an-sheet-svg-icon {
        width: 20px;
        height: 20px;
        display: block;
        flex-shrink: 0;
        filter: brightness(0) invert(0.72);
    }

    .an-sheet-row.an-active .an-sheet-svg-icon {
        filter: brightness(0) invert(1);
    }

    .an-sheet-row .an-check {
        margin-left: auto;
        font-size: .95rem;
        opacity: 0;
    }

    .an-sheet-row.an-active .an-check {
        opacity: 1;
    }

    .an-sheet-close {
        display: flex;
        align-items: center;
        justify-content: center;
        width: calc(100% - 2.5rem);
        margin: .75rem 1.25rem 0;
        min-height: 44px;
        border-radius: 10px;
        border: 1.5px solid rgba(255, 255, 255, .09);
        background: #1a1d1c;
        color: #8a9c97;
        font: inherit;
        font-size: .82rem;
        cursor: pointer;
        transition: background .12s, color .12s;
    }

    .an-sheet-close:hover {
        background: #212523;
        color: #fff;
    }

    @keyframes an-fadein {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* ── Settings bottom sheet ── */
    .qr-cfg-overlay {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 900;
        background: rgba(0, 0, 0, .58);
        animation: an-fadein .18s ease;
    }

    .qr-cfg-overlay.is-open {
        display: block;
    }

    .qr-cfg-sheet {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 910;
        background: #141716;
        border-radius: 20px 20px 0 0;
        transform: translateY(100%);
        transition: transform .28s cubic-bezier(.32, .72, 0, 1);
        padding-bottom: max(env(safe-area-inset-bottom, 0px), 1rem);
        max-height: 90vh;
        overflow-y: auto;
    }

    .qr-cfg-sheet.is-open {
        transform: translateY(0);
    }

    .qr-cfg-handle {
        display: flex;
        justify-content: center;
        padding: .7rem 0 .45rem;
        cursor: grab;
    }

    .qr-cfg-handle span {
        width: 38px;
        height: 4px;
        border-radius: 99px;
        background: rgba(255, 255, 255, .18);
    }

    .qr-cfg-hdr {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 1.25rem .75rem;
    }

    .qr-cfg-hdr h2 {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
        color: #eef1ee;
    }

    .qr-cfg-close-btn {
        display: grid;
        place-items: center;
        width: 32px;
        height: 32px;
        border: 0;
        border-radius: 8px;
        background: rgba(255, 255, 255, .08);
        color: #aab5b0;
        font: inherit;
        font-size: 1.1rem;
        cursor: pointer;
        transition: background .12s, color .12s;
    }

    .qr-cfg-close-btn:hover {
        background: rgba(255, 255, 255, .14);
        color: #fff;
    }

    .qr-cfg-sec-label {
        padding: .6rem 1.25rem .2rem;
        font-size: .62rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #4a5e5b;
    }

    .qr-cfg-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: .9rem 1.25rem;
        border-top: 1px solid rgba(255, 255, 255, .05);
    }

    .qr-cfg-label {
        display: block;
        font-size: .87rem;
        font-weight: 500;
        color: #c8d0cc;
    }

    .qr-cfg-hint {
        display: block;
        font-size: .69rem;
        color: #5a706b;
        margin-top: .12rem;
    }

    .qr-cfg-font-ctrl {
        display: flex;
        align-items: center;
        gap: .6rem;
        flex: 1;
        max-width: 200px;
    }

    .qr-cfg-a-sm {
        font-size: .75rem;
        color: #7a8e89;
        font-weight: 700;
        flex-shrink: 0;
    }

    .qr-cfg-a-lg {
        font-size: 1.1rem;
        color: #c8d0cc;
        font-weight: 700;
        flex-shrink: 0;
    }

    input[type="range"].qr-cfg-slider {
        flex: 1;
        -webkit-appearance: none;
        appearance: none;
        height: 4px;
        border-radius: 99px;
        background: #2a3330;
        cursor: pointer;
        outline: none;
    }

    input[type="range"].qr-cfg-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #e8b84b;
        border: 2px solid #141716;
        box-shadow: 0 0 0 3px rgba(232, 184, 75, .25);
    }

    input[type="range"].qr-cfg-slider::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #e8b84b;
        border: 2px solid #141716;
        box-shadow: 0 0 0 3px rgba(232, 184, 75, .25);
    }

    .qr-toggle {
        position: relative;
        display: inline-block;
        width: 44px;
        height: 25px;
        flex-shrink: 0;
    }

    .qr-toggle input {
        opacity: 0;
        width: 0;
        height: 0;
        position: absolute;
    }

    .qr-toggle-track {
        position: absolute;
        inset: 0;
        background: #2d3835;
        border-radius: 99px;
        cursor: pointer;
        transition: background .2s;
    }

    .qr-toggle input:checked+.qr-toggle-track {
        background: #e8b84b;
    }

    .qr-toggle-track::after {
        content: '';
        position: absolute;
        top: 3.5px;
        left: 3.5px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #fff;
        transition: left .18s cubic-bezier(.32, .72, 0, 1);
    }

    .qr-toggle input:checked+.qr-toggle-track::after {
        left: calc(100% - 21.5px);
    }

    /* ── Global amalan reader font sizes ──
       Level 3 = default (no override); others override all amalan Arabic text */
    :root[data-rd-font="1"] .qr-arabic,
    :root[data-rd-font="1"] .kh-bacaan-arab,
    :root[data-rd-font="1"] .wr-dzikir-arab,
    :root[data-rd-font="1"] .bhr-syair-arab,
    :root[data-rd-font="1"] .shr-verse-arab,
    :root[data-rd-font="1"] .thr-pasal-arab,
    :root[data-rd-font="1"] .mqr-bacaan-arab,
    :root[data-rd-font="1"] .mdr-text-arab {
        font-size: 1.1rem !important;
        line-height: 1.85;
    }

    :root[data-rd-font="2"] .qr-arabic,
    :root[data-rd-font="2"] .kh-bacaan-arab,
    :root[data-rd-font="2"] .wr-dzikir-arab,
    :root[data-rd-font="2"] .bhr-syair-arab,
    :root[data-rd-font="2"] .shr-verse-arab,
    :root[data-rd-font="2"] .thr-pasal-arab,
    :root[data-rd-font="2"] .mqr-bacaan-arab,
    :root[data-rd-font="2"] .mdr-text-arab {
        font-size: 1.4rem !important;
        line-height: 1.95;
    }

    :root[data-rd-font="4"] .qr-arabic,
    :root[data-rd-font="4"] .kh-bacaan-arab,
    :root[data-rd-font="4"] .wr-dzikir-arab,
    :root[data-rd-font="4"] .bhr-syair-arab,
    :root[data-rd-font="4"] .shr-verse-arab,
    :root[data-rd-font="4"] .thr-pasal-arab,
    :root[data-rd-font="4"] .mqr-bacaan-arab,
    :root[data-rd-font="4"] .mdr-text-arab {
        font-size: 2.6rem !important;
        line-height: 2.15;
    }

    :root[data-rd-font="5"] .qr-arabic,
    :root[data-rd-font="5"] .kh-bacaan-arab,
    :root[data-rd-font="5"] .wr-dzikir-arab,
    :root[data-rd-font="5"] .bhr-syair-arab,
    :root[data-rd-font="5"] .shr-verse-arab,
    :root[data-rd-font="5"] .thr-pasal-arab,
    :root[data-rd-font="5"] .mqr-bacaan-arab,
    :root[data-rd-font="5"] .mdr-text-arab {
        font-size: 3.2rem !important;
        line-height: 2.25;
    }

    /* Latin */
    :root[data-rd-font="1"] .mdr-text-latin,
    :root[data-rd-font="1"] .shr-verse-latin,
    :root[data-rd-font="1"] .bhr-syair-latin {
        font-size: .67rem !important;
    }

    :root[data-rd-font="2"] .mdr-text-latin,
    :root[data-rd-font="2"] .shr-verse-latin,
    :root[data-rd-font="2"] .bhr-syair-latin {
        font-size: .78rem !important;
    }

    :root[data-rd-font="4"] .mdr-text-latin,
    :root[data-rd-font="4"] .shr-verse-latin,
    :root[data-rd-font="4"] .bhr-syair-latin {
        font-size: 1.1rem !important;
    }

    :root[data-rd-font="5"] .mdr-text-latin,
    :root[data-rd-font="5"] .shr-verse-latin,
    :root[data-rd-font="5"] .bhr-syair-latin {
        font-size: 1.3rem !important;
    }

    /* Terjemahan */
    :root[data-rd-font="1"] .qr-trans {
        font-size: .72rem !important;
    }

    :root[data-rd-font="2"] .qr-trans {
        font-size: .82rem !important;
    }

    :root[data-rd-font="4"] .qr-trans {
        font-size: 1.1rem !important;
    }

    :root[data-rd-font="5"] .qr-trans {
        font-size: 1.3rem !important;
    }

    /* ══════════════════════════════════════════
   LIGHT MODE THEME
   ══════════════════════════════════════════ */
    :root[data-theme="light"] {
        --qr-bg: #FAF5E4;
        --qr-surf: #FFFFFF;
        --qr-border: #E8D5A0;
        --qr-text: #1C1206;
        --qr-muted: #8B7355;
        --quran-bg: #FAF5E4;
        --quran-surface: #FFFFFF;
        --quran-surface-hover: #F2E9D0;
        --quran-text: #1C1206;
        --quran-muted: #8B7355;
        --kh-bg: #FAF5E4;
        --kh-surf: #FFFFFF;
        --kh-border: #E8D5A0;
        --kh-text: #1C1206;
        --kh-muted: #8B7355;
        --wr-bg: #FAF5E4;
        --wr-surf: #FFFFFF;
        --wr-border: #E8D5A0;
        --wr-text: #1C1206;
        --wr-muted: #8B7355;
        --th-bg: #FAF5E4;
        --th-surf: #FFFFFF;
        --th-surface: #FFFFFF;
        --th-surface-hover: #F2E9D0;
        --th-border: #E8D5A0;
        --th-text: #1C1206;
        --th-muted: #8B7355;
        --bhr-bg: #FAF5E4;
        --bhr-surf: #FFFFFF;
        --bhr-border: #E8D5A0;
        --bhr-text: #1C1206;
        --bhr-muted: #8B7355;
        --bh-bg: #FAF5E4;
        --bh-surface: #FFFFFF;
        --bh-surface-hover: #F2E9D0;
        --bh-text: #1C1206;
        --bh-muted: #8B7355;
        --mqr-bg: #FAF5E4;
        --mqr-surf: #FFFFFF;
        --mqr-border: #E8D5A0;
        --mqr-text: #1C1206;
        --mqr-muted: #8B7355;
        --mq-bg: #FAF5E4;
        --mq-surface: #FFFFFF;
        --mq-surface-hover: #F2E9D0;
        --mq-text: #1C1206;
        --mq-muted: #8B7355;
        --mdr-bg: #FAF5E4;
        --mdr-surf: #FFFFFF;
        --mdr-border: #E8D5A0;
        --mdr-text: #1C1206;
        --mdr-muted: #8B7355;
        --mdl-bg: #FAF5E4;
        --mdl-surface: #FFFFFF;
        --mdl-surface-hover: #F2E9D0;
        --mdl-text: #1C1206;
        --mdl-muted: #8B7355;
        --shr-bg: #FAF5E4;
        --shr-surf: #FFFFFF;
        --shr-border: #E8D5A0;
        --shr-text: #1C1206;
        --shr-muted: #8B7355;
        --sh-bg: #FAF5E4;
        --sh-surf: #FFFFFF;
        --sh-surf-h: #F2E9D0;
        --sh-text: #1C1206;
        --sh-muted: #8B7355;
    }

    /* Body */
    :root[data-theme="light"] body {
        background: #FAF5E4 !important;
        color: #1C1206 !important;
    }

    /* Header pill */
    :root[data-theme="light"] #anPill {
        background: rgba(255, 255, 255, .97) !important;
        border-color: #E8D5A0 !important;
        box-shadow: 0 4px 24px rgba(28, 18, 6, .1) !important;
    }

    :root[data-theme="light"] .an-brand-text strong {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .an-link {
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .an-link:hover {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .an-link.an-active {
        color: #C9900A !important;
        border-bottom-color: #C9900A !important;
    }

    :root[data-theme="light"] .an-icon-btn {
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .an-icon-btn:hover {
        background: rgba(28, 18, 6, .07) !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .an-mob-btn {
        background: rgba(28, 18, 6, .07) !important;
        color: #5C4420 !important;
    }

    /* Sub-navs (hardcoded #0d1010) */
    :root[data-theme="light"] .qr-subnav,
    :root[data-theme="light"] .kh-subnav,
    :root[data-theme="light"] .wr-subnav,
    :root[data-theme="light"] .thr-subnav,
    :root[data-theme="light"] .bhr-subnav,
    :root[data-theme="light"] .mqr-subnav,
    :root[data-theme="light"] .mdr-subnav,
    :root[data-theme="light"] .shr-subnav {
        background: #FFFFFF !important;
        border-bottom-color: #E8D5A0 !important;
        box-shadow: 0 2px 8px rgba(28, 18, 6, .06) !important;
    }

    /* Pill/tab buttons in sub-navs */
    :root[data-theme="light"] .kh-pill,
    :root[data-theme="light"] .wr-pill,
    :root[data-theme="light"] .thr-pill,
    :root[data-theme="light"] .bhr-pill,
    :root[data-theme="light"] .mqr-pill,
    :root[data-theme="light"] .mdr-pill,
    :root[data-theme="light"] .shr-pill {
        background: #F2E9D0 !important;
        color: #5C4420 !important;
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .kh-pill.is-active,
    :root[data-theme="light"] .wr-pill.is-active,
    :root[data-theme="light"] .thr-pill.is-active,
    :root[data-theme="light"] .bhr-pill.is-active,
    :root[data-theme="light"] .mqr-pill.is-active,
    :root[data-theme="light"] .mdr-pill.is-active,
    :root[data-theme="light"] .shr-pill.is-active {
        background: #C9900A !important;
        color: #FFFFFF !important;
        border-color: transparent !important;
    }

    :root[data-theme="light"] .kh-pill:hover:not(.is-active),
    :root[data-theme="light"] .wr-pill:hover:not(.is-active),
    :root[data-theme="light"] .thr-pill:hover:not(.is-active),
    :root[data-theme="light"] .bhr-pill:hover:not(.is-active),
    :root[data-theme="light"] .mqr-pill:hover:not(.is-active),
    :root[data-theme="light"] .mdr-pill:hover:not(.is-active),
    :root[data-theme="light"] .shr-pill:hover:not(.is-active) {
        color: #1C1206 !important;
        border-color: #C9900A !important;
    }

    :root[data-theme="light"] .kh-arrow,
    :root[data-theme="light"] .wr-arrow,
    :root[data-theme="light"] .thr-arrow,
    :root[data-theme="light"] .bhr-arrow,
    :root[data-theme="light"] .mqr-arrow,
    :root[data-theme="light"] .mdr-arrow,
    :root[data-theme="light"] .shr-arrow {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .kh-arrow:hover,
    :root[data-theme="light"] .wr-arrow:hover,
    :root[data-theme="light"] .thr-arrow:hover,
    :root[data-theme="light"] .bhr-arrow:hover,
    :root[data-theme="light"] .mqr-arrow:hover,
    :root[data-theme="light"] .mdr-arrow:hover,
    :root[data-theme="light"] .shr-arrow:hover {
        color: #C9900A !important;
        border-color: #C9900A !important;
    }

    /* Sholawat tab strip */
    :root[data-theme="light"] .sh-tab-strip,
    :root[data-theme="light"] .sh-tabs {
        background: #F2E9D0 !important;
    }

    :root[data-theme="light"] .sh-tab {
        background: transparent !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .sh-tab[aria-selected="true"] {
        background: #C9900A !important;
        color: #FFFFFF !important;
    }

    /* Hub page cards */
    :root[data-theme="light"] .quran-card,
    :root[data-theme="light"] .tahlil-card,
    :root[data-theme="light"] .burdah-card,
    :root[data-theme="light"] .sh-card {
        background: #FFFFFF !important;
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .quran-number {
        background: #C9900A !important;
        color: #FFFFFF !important;
    }

    /* Qr verse + reader blocks */
    :root[data-theme="light"] .qr-verse {
        border-bottom-color: #E8D5A0 !important;
    }

    /* Quran dropdown panel */
    :root[data-theme="light"] .qr-dropdown {
        background: #fff !important;
        border-color: rgba(0, 0, 0, .1) !important;
    }

    :root[data-theme="light"] .qr-panel {
        background: #fff !important;
    }

    :root[data-theme="light"] .qr-dropdown-item,
    :root[data-theme="light"] .qr-panel-item {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-dropdown-item:hover,
    :root[data-theme="light"] .qr-panel-item:hover {
        background: rgba(0, 0, 0, .05) !important;
    }

    /* Bottom sheet + settings sheet */
    :root[data-theme="light"] .an-sheet,
    :root[data-theme="light"] .qr-cfg-sheet {
        background: #FFFFFF !important;
    }

    :root[data-theme="light"] .an-sheet-handle span,
    :root[data-theme="light"] .qr-cfg-handle span {
        background: rgba(28, 18, 6, .2) !important;
    }

    :root[data-theme="light"] .an-sheet-head,
    :root[data-theme="light"] .qr-cfg-sec-label {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .an-sheet-row {
        color: #5C4420 !important;
        border-top-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .an-sheet-row:hover {
        background: rgba(28, 18, 6, .03) !important;
    }

    :root[data-theme="light"] .an-sheet-row.an-active {
        color: #C9900A !important;
    }

    :root[data-theme="light"] .an-sheet-svg-icon {
        filter: brightness(0) invert(.2) !important;
    }

    :root[data-theme="light"] .an-sheet-row.an-active .an-sheet-svg-icon {
        filter: brightness(0) saturate(5) hue-rotate(100deg) brightness(.7) !important;
    }

    :root[data-theme="light"] .an-sheet-close {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .qr-cfg-hdr h2 {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-cfg-close-btn {
        background: rgba(28, 18, 6, .07) !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .qr-cfg-label {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-cfg-hint {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .qr-cfg-row {
        border-top-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .qr-cfg-a-sm {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .qr-cfg-a-lg {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] input[type="range"].qr-cfg-slider {
        background: #DFD0B0 !important;
    }

    :root[data-theme="light"] .qr-toggle-track {
        background: #D4B896 !important;
    }

    :root[data-theme="light"] .qr-toggle input:checked+.qr-toggle-track {
        background: #C9900A !important;
    }

    :root[data-theme="light"] input[type="range"].qr-cfg-slider::-webkit-slider-thumb {
        border-color: #FFFFFF !important;
    }

    :root[data-theme="light"] input[type="range"].qr-cfg-slider::-moz-range-thumb {
        border-color: #FFFFFF !important;
    }

    /* Arabic READING text → dark primary */
    :root[data-theme="light"] .qr-arabic,
    :root[data-theme="light"] .kh-bacaan-arab,
    :root[data-theme="light"] .wr-dzikir-arab,
    :root[data-theme="light"] .thr-pasal-arab,
    :root[data-theme="light"] .bhr-syair-arab,
    :root[data-theme="light"] .mqr-bacaan-arab,
    :root[data-theme="light"] .mdr-text-arab,
    :root[data-theme="light"] .shr-verse-arab {
        color: #1C1206 !important;
    }

    /* Ornate verse number badge — light inner ring */
    :root[data-theme="light"] .qr-ornate {
        color: #2a1500 !important;
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
    }

    /* Arabic glyph on SURAH CARDS → gold accent */
    :root[data-theme="light"] .quran-card-arabic {
        color: #C9900A !important;
    }

    /* Card list → green border accent */
    :root[data-theme="light"] .quran-card {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .quran-card:hover,
    :root[data-theme="light"] .quran-card:focus-visible {
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .04) !important;
        color: #1C1206 !important;
    }

    /* Translation / terjemahan text → secondary */
    :root[data-theme="light"] .qr-trans {
        color: #5C4420 !important;
    }

    /* Latin transliteration text → secondary */
    :root[data-theme="light"] .mdr-text-latin,
    :root[data-theme="light"] .shr-verse-latin,
    :root[data-theme="light"] .bhr-syair-latin {
        color: #5C4420 !important;
        font-weight: 600 !important;
    }

    /* ── Amalan Hub page (/amalan) ── */
    :root[data-theme="light"] .amalan-page {
        --am-bg: #FAF5E4;
        --am-surface: #FFFFFF;
        --am-surface-hover: #F2E9D0;
        --am-text: #1C1206;
        --am-muted: #8B7355;
        background: #FAF5E4 !important;
    }

    :root[data-theme="light"] .am-subnav {
        background: #FFFFFF !important;
        border-bottom-color: #E8D5A0 !important;
        box-shadow: 0 2px 8px rgba(28, 18, 6, .06) !important;
    }

    :root[data-theme="light"] .am-pill {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .am-pill.is-active {
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .08) !important;
        color: #C9900A !important;
        font-weight: 600;
    }

    :root[data-theme="light"] .am-pill:hover {
        color: #C9900A !important;
        border-color: #C9900A !important;
    }

    :root[data-theme="light"] .am-arrow {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .am-arrow:hover {
        color: #C9900A !important;
        border-color: #C9900A !important;
    }

    :root[data-theme="light"] .am-sel {
        background-color: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .amalan-card {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .amalan-card:hover,
    :root[data-theme="light"] .amalan-card:focus-visible {
        color: #1C1206 !important;
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .04) !important;
    }

    :root[data-theme="light"] .amalan-icon-svg {
        filter: brightness(0) !important;
    }

    /* Hub background accents (star tile / vignette) are tuned for the
       dark theme by default — restyle them for light so a dark overlay
       doesn't muddy the clean cream surface. */
    :root[data-theme="light"] .amalan-page::before {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Cpath d='M20 3 L22.7 13.5 L32 8 L26.5 17.3 L37 20 L26.5 22.7 L32 32 L22.7 26.5 L20 37 L17.3 26.5 L8 32 L13.5 22.7 L3 20 L13.5 17.3 L8 8 L17.3 13.5 Z' fill='none' stroke='%23C9900A' stroke-opacity='.5' stroke-width='0.7'/%3E%3C/svg%3E") !important;
        opacity: .07 !important;
    }

    :root[data-theme="light"] .amalan-glow {
        background:
            radial-gradient(ellipse 120% 55% at 50% 0%, rgba(201, 144, 10, .07), transparent 60%) !important;
    }

    /* ── Quran surah/juz list page (.quran-page has LOCAL vars — override on element) ── */
    :root[data-theme="light"] .quran-page {
        --quran-bg: #FAF5E4;
        --quran-surface: #FFFFFF;
        --quran-surface-hover: #F2E9D0;
        --quran-text: #1C1206;
        --quran-muted: #8B7355;
        --quran-accent: #C9900A;
        background: #FAF5E4 !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .quran-tabs {
        background: #F2E9D0 !important;
    }

    :root[data-theme="light"] .quran-tab {
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .quran-tab:hover {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .quran-tab[aria-selected="true"] {
        background: #C9900A !important;
        color: #FFFFFF !important;
    }

    :root[data-theme="light"] .quran-sort {
        color: #1C1206 !important;
    }

    /* ── Sholawat hub page (.sh-page has LOCAL vars) ── */
    :root[data-theme="light"] .sh-page {
        --sh-bg: #FAF5E4;
        --sh-surf: #FFFFFF;
        --sh-surf-h: #F2E9D0;
        --sh-text: #1C1206;
        --sh-muted: #8B7355;
        background: #FAF5E4 !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .sh-tab-strip {
        background: #F2E9D0 !important;
    }

    /* ── Quran reader: panel (Pilih Ayat/Surah) — bottom sheet ── */
    :root[data-theme="light"] .qr-panel {
        background: #fff !important;
        box-shadow: 0 -4px 40px rgba(0, 0, 0, .12) !important;
    }

    :root[data-theme="light"] .qr-panel-handle span {
        background: rgba(0, 0, 0, .2) !important;
    }

    :root[data-theme="light"] .qr-panel-title {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .qr-panel-search {
        border-bottom-color: rgba(0, 0, 0, .08) !important;
    }

    :root[data-theme="light"] .qr-panel-search input {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-panel-search i {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .qr-panel-list {
        scrollbar-color: rgba(0, 0, 0, .12) transparent !important;
    }

    :root[data-theme="light"] .qr-panel-item a,
    :root[data-theme="light"] .qr-panel-item button {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-panel-item a:hover,
    :root[data-theme="light"] .qr-panel-item button:hover {
        background: rgba(0, 0, 0, .05) !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-panel-item.is-active a {
        background: rgba(201, 144, 10, .08) !important;
        color: #C9900A !important;
    }

    /* ── Quran reader: verse dots dropdown ── */
    :root[data-theme="light"] .qr-dropdown {
        background: #FFFFFF !important;
        border-color: #E8D5A0 !important;
        box-shadow: 0 8px 24px rgba(28, 18, 6, .08) !important;
    }

    :root[data-theme="light"] .qr-dditem {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-dditem:hover {
        background: rgba(28, 18, 6, .05) !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-sheet-handle {
        background: rgba(28, 18, 6, .15) !important;
    }

    /* ── Quran reader: sub-nav pill buttons ── */
    :root[data-theme="light"] .qr-pill {
        background: #F2E9D0 !important;
        color: #5C4420 !important;
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .qr-pill.is-active {
        background: #C9900A !important;
        color: #FFFFFF !important;
        border-color: transparent !important;
    }

    :root[data-theme="light"] .qr-pill:hover:not(.is-active) {
        color: #1C1206 !important;
    }

    /* ── Quran reader: sub-nav nav-arrows (< Prev, Next >) ── */
    :root[data-theme="light"] .qr-arrow {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .qr-arrow:hover {
        color: #C9900A !important;
        border-color: #C9900A !important;
    }

    /* ── Quran reader: surah header section ── */
    :root[data-theme="light"] .qr-hdr-ar {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-hdr-name {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-hdr-meta {
        background: rgba(28, 18, 6, .05) !important;
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .qr-bismillah {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-divider-ornament {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='9'%3E%3Cpolygon points='7,0 13,4.5 7,9 1,4.5' fill='%23C9900A' opacity='.6'/%3E%3C/svg%3E") !important;
    }

    :root[data-theme="light"] .qr-divider-frame {
        background: #FFFEF9 !important;
    }

    :root[data-theme="light"] .qr-divider-frame::after {
        border-color: rgba(201, 144, 10, .25) !important;
    }

    :root[data-theme="light"] .qr-dc {
        background: #C9900A !important;
    }

    :root[data-theme="light"] .qr-divider-panel {
        border-right-color: rgba(201, 144, 10, .22) !important;
    }

    :root[data-theme="light"] .qr-divider-panel--r {
        border-left-color: rgba(201, 144, 10, .22) !important;
    }

    :root[data-theme="light"] .qr-divider-ar {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-divider-name {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-divider-link {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .qr-divider-num {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .qr-divider-meaning {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .qr-divider-num-label {
        color: #8B7355 !important;
    }

    /* ── Tahlil index page (.tahlil-page has LOCAL vars) ── */
    :root[data-theme="light"] .tahlil-page {
        --th-bg: #FAF5E4;
        --th-surface: #FFFFFF;
        --th-surface-hover: #F2E9D0;
        --th-text: #1C1206;
        --th-muted: #8B7355;
        background: #FAF5E4 !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .tahlil-search {
        border-color: #E8D5A0 !important;
        background: #FFFFFF !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .tahlil-search i {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .tahlil-search input {
        color: #1C1206 !important;
        background: transparent !important;
    }

    :root[data-theme="light"] .tahlil-search input::placeholder {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .tahlil-search-hint {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .tahlil-card {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .tahlil-card:hover,
    :root[data-theme="light"] .tahlil-card:focus-visible {
        color: #1C1206 !important;
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .04) !important;
    }

    :root[data-theme="light"] .tahlil-number {
        background: #C9900A !important;
        color: #FFFFFF !important;
    }

    /* ── Burdah index page (.burdah-page has LOCAL vars) ── */
    :root[data-theme="light"] .burdah-page {
        --bh-bg: #FAF5E4;
        --bh-surface: #FFFFFF;
        --bh-surface-hover: #F2E9D0;
        --bh-text: #1C1206;
        --bh-muted: #8B7355;
        background: #FAF5E4 !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .burdah-search {
        border-color: #E8D5A0 !important;
        background: #FFFFFF !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .burdah-search i {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .burdah-search input {
        color: #1C1206 !important;
        background: transparent !important;
    }

    :root[data-theme="light"] .burdah-search input::placeholder {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .burdah-search-hint {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .burdah-card {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .burdah-card:hover,
    :root[data-theme="light"] .burdah-card:focus-visible {
        color: #1C1206 !important;
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .04) !important;
    }

    :root[data-theme="light"] .burdah-number {
        background: #C9900A !important;
        color: #FFFFFF !important;
    }

    :root[data-theme="light"] .burdah-card-arabic {
        color: #C9900A !important;
    }

    /* ── Manaqib index page (.mq-page has LOCAL vars) ── */
    :root[data-theme="light"] .mq-page {
        --mq-bg: #FAF5E4;
        --mq-surface: #FFFFFF;
        --mq-surface-hover: #F2E9D0;
        --mq-text: #1C1206;
        --mq-muted: #8B7355;
        background: #FAF5E4 !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .mq-search {
        border-color: #E8D5A0 !important;
        background: #FFFFFF !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .mq-search i {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .mq-search input {
        color: #1C1206 !important;
        background: transparent !important;
    }

    :root[data-theme="light"] .mq-search input::placeholder {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .mq-search-hint {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .mq-card {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .mq-card:hover,
    :root[data-theme="light"] .mq-card:focus-visible {
        color: #1C1206 !important;
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .04) !important;
    }

    :root[data-theme="light"] .mq-number {
        background: #C9900A !important;
        color: #FFFFFF !important;
    }

    /* ── Maulid index page (.mdl-page has LOCAL vars) ── */
    :root[data-theme="light"] .mdl-page {
        --mdl-bg: #FAF5E4;
        --mdl-surface: #FFFFFF;
        --mdl-surface-hover: #F2E9D0;
        --mdl-text: #1C1206;
        --mdl-muted: #8B7355;
        background: #FAF5E4 !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .mdl-card {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .mdl-card:hover,
    :root[data-theme="light"] .mdl-card:focus-visible {
        color: #1C1206 !important;
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .04) !important;
    }

    :root[data-theme="light"] .mdl-number {
        background: #C9900A !important;
        color: #FFFFFF !important;
    }

    /* ── Sholawat hub extra overrides (tabs/cards already have .sh-page var override) ── */
    :root[data-theme="light"] .sh-num {
        background: #C9900A !important;
    }

    :root[data-theme="light"] .sh-card {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .sh-card:hover,
    :root[data-theme="light"] .sh-card:focus-visible {
        color: #1C1206 !important;
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .04) !important;
    }

    :root[data-theme="light"] .sh-card-arab {
        color: #1C1206 !important;
    }

    /* ── Reader page: section headings (all hardcode color:#fff) ── */
    :root[data-theme="light"] .thr-hdr-name,
    :root[data-theme="light"] .bhr-hdr-name,
    :root[data-theme="light"] .mqr-hdr-name,
    :root[data-theme="light"] .mdr-hdr-name {
        color: #1C1206 !important;
    }

    /* ── Burdah: pasal Arabic title + subtitle (hardcodes #fff) → dark ── */
    :root[data-theme="light"] .bhr-hdr-pasal,
    :root[data-theme="light"] .bhr-hdr-judul {
        color: #1C1206 !important;
    }

    /* ── Reader: hdr-meta pill badge (hardcodes rgba white bg) ── */
    :root[data-theme="light"] .thr-hdr-meta,
    :root[data-theme="light"] .bhr-hdr-meta,
    :root[data-theme="light"] .mqr-hdr-meta,
    :root[data-theme="light"] .mdr-hdr-meta,
    :root[data-theme="light"] .shr-hdr-meta {
        background: rgba(28, 18, 6, .05) !important;
        color: #8B7355 !important;
    }

    /* ── Sholawat reader: header Arabic calligraphy (hardcode color:#fff) ── */
    :root[data-theme="light"] .shr-hdr-arab {
        color: #1C1206 !important;
    }

    /* ── Reader: shr-verse divider (near-invisible rgba white border) ── */
    :root[data-theme="light"] .shr-verse {
        border-bottom-color: #E8D5A0 !important;
    }

    /* ── Shared .rdr-panel (section picker bottom sheet — all reader pages) ── */
    :root[data-theme="light"] .rdr-panel {
        background: #fff !important;
        box-shadow: 0 -4px 40px rgba(0, 0, 0, .12) !important;
    }

    :root[data-theme="light"] .rdr-panel-handle span {
        background: rgba(0, 0, 0, .2) !important;
    }

    :root[data-theme="light"] .rdr-panel-title {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .rdr-panel-list {
        scrollbar-color: rgba(0, 0, 0, .12) transparent !important;
    }

    :root[data-theme="light"] .rdr-panel-search {
        border-bottom-color: rgba(0, 0, 0, .08) !important;
    }

    :root[data-theme="light"] .rdr-panel-search i {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .rdr-panel-search input {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .rdr-panel-item a {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .rdr-panel-item a:hover {
        background: rgba(0, 0, 0, .05) !important;
        color: #1C1206 !important;
    }

    /* ── Reader: footer nav buttons (fnav) ── */
    :root[data-theme="light"] .thr-fnav-btn,
    :root[data-theme="light"] .bhr-fnav-btn,
    :root[data-theme="light"] .mqr-fnav-btn,
    :root[data-theme="light"] .mdr-fnav-btn,
    :root[data-theme="light"] .shr-fnav-btn {
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .thr-fnav-btn:hover,
    :root[data-theme="light"] .bhr-fnav-btn:hover,
    :root[data-theme="light"] .mqr-fnav-btn:hover,
    :root[data-theme="light"] .mdr-fnav-btn:hover,
    :root[data-theme="light"] .shr-fnav-btn:hover {
        background: #F2E9D0 !important;
        color: #C9900A !important;
        border-color: #C9900A !important;
    }

    /* ── Terjemah/arti translation text (hardcoded light gray) ── */
    :root[data-theme="light"] .bhr-syair-arti {
        color: #1C1206 !important;
        background: rgba(28, 18, 6, .03) !important;
    }

    :root[data-theme="light"] .bhr-syair-arti-label {
        color: #5C4420 !important;
    }

    /* ── Subnav center title in Wirid & Khawajagan (hardcoded #c8d0cc) ── */
    :root[data-theme="light"] .wr-subnav-title,
    :root[data-theme="light"] .kh-subnav-title {
        color: #1C1206 !important;
    }

    /* ── Wirid & Khawajagan: page header title + meta badge + back link ── */
    :root[data-theme="light"] .wr-hdr-name,
    :root[data-theme="light"] .kh-hdr-name {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .wr-hdr-meta,
    :root[data-theme="light"] .kh-hdr-meta {
        background: rgba(28, 18, 6, .05) !important;
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .wr-back,
    :root[data-theme="light"] .kh-back {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    /* ── Sholawat verse divider line ── */
    :root[data-theme="light"] .shr-verse-id {
        color: #5C4420 !important;
    }

    /* ── Manaqib reader: opening doa text (hardcodes mint #b8d4cc) ── */
    :root[data-theme="light"] .mqr-hdr-doa {
        color: #1C1206 !important;
    }

    /* ── Manaqib reader: back link (near-invisible rgba white borders) ── */
    :root[data-theme="light"] .mqr-back {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    /* ── Manaqib reader: closing sholawat card ── */
    :root[data-theme="light"] .mqr-closing {
        background: rgba(201, 144, 10, .04) !important;
        border-color: rgba(201, 144, 10, .2) !important;
    }

    :root[data-theme="light"] .mqr-closing-arab {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .mqr-closing-id {
        color: #5C4420 !important;
    }

    /* ── Hide decorative hdr-icons in all reader detail pages ── */
    .thr-hdr-icon,
    .bhr-hdr-icon,
    .mqr-hdr-icon,
    .mdr-hdr-icon,
    .shr-hdr-icon,
    .wr-hdr-icon,
    .kh-hdr-icon {
        display: none !important;
    }

    /* ── Shared support banner (all amalan reader pages) ── */
    .am-banner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: 2.5rem;
        padding: 1.15rem 1.35rem;
        border-radius: 12px;
        background: linear-gradient(135deg, #7a5818 0%, #5e430c 100%);
    }

    .am-banner-body {
        display: flex;
        align-items: center;
        gap: .9rem;
    }

    .am-banner-ico {
        display: grid;
        place-items: center;
        width: 40px;
        height: 40px;
        border-radius: 10px;
        background: rgba(255, 255, 255, .15);
        color: #fff;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .am-banner-title {
        font-size: .88rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 .15rem;
    }

    .am-banner-sub {
        font-size: .72rem;
        color: rgba(255, 255, 255, .68);
        margin: 0;
    }

    .am-banner-cta {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .5rem 1.1rem;
        border: 0;
        border-radius: 99px;
        background: #fff;
        color: #5e430c;
        font: inherit;
        font-size: .78rem;
        font-weight: 700;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .am-banner-cta:hover {
        background: #fef3d8;
    }

    @media (max-width: 480px) {
        .am-banner {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    /* ── Tasbih Digital — light mode overrides ── */
    :root[data-theme="light"] {
        --ts-bg: #FAF5E4;
        --ts-surf: #FFFFFF;
        --ts-surf2: #F2E9D0;
        --ts-border: #E8D5A0;
        --ts-text: #1C1206;
        --ts-muted: #8B7355;
        --ts-gold-dim: rgba(201, 151, 0, .1);
    }

    :root[data-theme="light"] .ts-subnav {
        background: #FFFFFF !important;
        border-bottom-color: #E8D5A0 !important;
        box-shadow: 0 2px 8px rgba(28, 18, 6, .06) !important;
    }

    :root[data-theme="light"] .ts-subnav-title {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-pill {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .ts-pill:hover {
        color: #C9900A !important;
        border-color: #C9900A !important;
    }

    :root[data-theme="light"] .ts-dzikir-arab-big {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-count-big {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-laps-info {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .ts-prog-val {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-prog-divider {
        background: #E8D5A0 !important;
    }

    :root[data-theme="light"] .ts-tap-btn {
        border-color: rgba(201, 151, 0, .35) !important;
        background: #FDF5DC !important;
    }

    :root[data-theme="light"] .ts-act-btn {
        border-color: #E8D5A0 !important;
        color: #5C4420 !important;
    }

    :root[data-theme="light"] .ts-act-btn:hover {
        border-color: #C9900A !important;
        color: #C9900A !important;
    }

    :root[data-theme="light"] .ts-act-danger:hover {
        border-color: rgba(239, 68, 68, .4) !important;
        color: #c0392b !important;
    }

    :root[data-theme="light"] .ts-tabs {
        border-bottom-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .ts-tab {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .ts-tab.is-active {
        color: #C9900A !important;
        border-bottom-color: #C9900A !important;
    }

    :root[data-theme="light"] .ts-dz-card {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .ts-dz-card:hover {
        border-color: #C9900A !important;
        background: var(--ts-surf) !important;
    }

    :root[data-theme="light"] .ts-dz-card.is-active {
        border-color: #C9900A !important;
        background: rgba(201, 144, 10, .05) !important;
    }

    :root[data-theme="light"] .ts-dz-arab {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-dz-name {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .ts-custom-form {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .ts-form-title {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-input {
        background: #F2E9D0 !important;
        border-color: #E8D5A0 !important;
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-input:focus {
        border-color: #C9900A !important;
    }

    :root[data-theme="light"] .ts-input::placeholder {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .ts-add-btn {
        background: #C9900A !important;
        color: #FFFFFF !important;
    }

    :root[data-theme="light"] .ts-custom-item {
        border-color: #E8D5A0 !important;
    }

    :root[data-theme="light"] .ts-custom-item:hover {
        border-color: #C9900A !important;
    }

    :root[data-theme="light"] .ts-custom-item.is-active {
        border-color: #C9900A !important;
    }

    :root[data-theme="light"] .ts-ci-arab {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-ci-name {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .ts-del-btn {
        color: #8B7355 !important;
    }

    :root[data-theme="light"] .ts-flash-box {
        background: #FFFFFF !important;
        border-color: rgba(201, 144, 10, .25) !important;
        box-shadow: 0 8px 24px rgba(28, 18, 6, .08) !important;
    }

    :root[data-theme="light"] .ts-flash-title {
        color: #1C1206 !important;
    }

    :root[data-theme="light"] .ts-empty i {
        color: #D4B896 !important;
    }

    :root[data-theme="light"] .ts-ring-track {
        stroke: rgba(28, 18, 6, .07) !important;
    }
</style>

<!-- ══ Floating Pill Header ══ -->
<header id="anHeader" aria-label="Navigasi amalan">
    <nav id="anPill">

        <!-- Left: burger + brand -->
        <div class="an-left">
            <button class="an-mob-btn" id="anMobBtn"
                aria-label="Buka menu amalan" aria-expanded="false" aria-controls="anSheet">
                <i class="bx bx-menu"></i>
            </button>
            <a class="an-brand" href="<?= base_url('index.php/amalan'); ?>">
                <?php if ($_logo): ?>
                    <img class="an-brand-logo" src="<?= $_logo; ?>"
                        alt="<?= htmlspecialchars($_site_name); ?>">
                <?php endif; ?>
                <span class="an-brand-text">
                    <strong>Majelis</strong>
                    <em>Ahbaburrosul Indonesia</em>
                </span>
            </a>
        </div>

        <!-- Center: desktop nav links -->
        <div class="an-center">
            <?php foreach ($_an_items as $key => $item):
                $cls = ($_an_active === $key) ? ' an-active' : '';
            ?>
                <a class="an-link<?= $cls ?>" href="<?= $item['url']; ?>">
                    <?= htmlspecialchars($item['short'], ENT_QUOTES, 'UTF-8'); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Right: settings + home -->
        <div class="an-right">
            <button class="an-icon-btn" type="button" id="anCfgBtn"
                aria-label="Pengaturan" title="Pengaturan">
                <i class="bx bx-cog"></i>
            </button>
            <a class="an-icon-btn" href="<?= base_url(); ?>" title="Beranda">
                <i class="bx bx-home-alt-2"></i>
            </a>
        </div>

    </nav>
</header>

<!-- ══ Hero Section (index pages only) ══ -->
<?php if ($_an_show_hero): ?>
    <section class="an-hero">
        <div class="an-hero-photo" aria-hidden="true"></div>
        <div class="an-hero-inner">
            <div class="an-hero-copy">
                <h1 class="an-hero-title">
                    <?= htmlspecialchars($_hero['title'], ENT_QUOTES, 'UTF-8'); ?>
                </h1>
                <p class="an-hero-sub">
                    <?= htmlspecialchars($_hero['sub'], ENT_QUOTES, 'UTF-8'); ?>
                </p>
            </div>
            <?php if ($_an_active === 'quran'): ?>
                <div class="an-hero-search-wrap">
                    <div class="an-hero-search">
                        <i class="bx bx-search" aria-hidden="true"></i>
                        <input id="quranSearch" type="search" autocomplete="off" data-quran-search
                            placeholder="Nama atau nomor surah, mis. Yasin atau 2:124">
                    </div>
                    <p class="an-hero-search-hint">Cari berdasarkan nama, nomor surah, atau nomor ayat.</p>
                </div>
            <?php elseif ($_an_active === 'tahlil'): ?>
                <div class="an-hero-search-wrap">
                    <div class="an-hero-search">
                        <i class="bx bx-search" aria-hidden="true"></i>
                        <input id="tahlilSearch" type="search" autocomplete="off" data-tahlil-search
                            placeholder="Cari nama bagian, mis. Yasin atau Tawasul">
                    </div>
                    <p class="an-hero-search-hint">Cari berdasarkan nama bagian tahlil.</p>
                </div>
            <?php elseif ($_an_active === 'burdah'): ?>
                <div class="an-hero-search-wrap">
                    <div class="an-hero-search">
                        <i class="bx bx-search" aria-hidden="true"></i>
                        <input id="burdahSearch" type="search" autocomplete="off" data-burdah-search
                            placeholder="Cari nama pasal atau tema, mis. Tawassul">
                    </div>
                    <p class="an-hero-search-hint">Cari berdasarkan nama atau tema pasal.</p>
                </div>
            <?php elseif ($_an_active === 'manaqib'): ?>
                <div class="an-hero-search-wrap">
                    <div class="an-hero-search">
                        <i class="bx bx-search" aria-hidden="true"></i>
                        <input id="maqSearch" type="search" autocomplete="off" data-mq-search
                            placeholder="Cari nama bab, mis. Tawasul atau Bab Pertama">
                    </div>
                    <p class="an-hero-search-hint">Cari berdasarkan nama atau nomor bab.</p>
                </div>
            <?php elseif ($_an_active === 'sholawat'): ?>
                <div class="an-hero-search-wrap">
                    <div class="an-hero-search">
                        <i class="bx bx-search" aria-hidden="true"></i>
                        <input id="shSearch" type="search" autocomplete="off" data-sh-search
                            placeholder="Cari nama sholawat, mis. Salamullahi">
                    </div>
                    <p class="an-hero-search-hint">Cari dari <?= (isset($sh_total) ? $sh_total : 0); ?> sholawat Nasyid &amp; Suluk.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>

<!-- ══ Bottom Sheet (mobile) ══ -->
<div class="an-overlay" id="anOverlay" aria-hidden="true"></div>
<div class="an-sheet" id="anSheet" role="dialog" aria-modal="true" aria-label="Pilih amalan">
    <div class="an-sheet-handle" id="anHandle"><span></span></div>
    <p class="an-sheet-head">Pilih Amalan</p>
    <?php foreach ($_an_items as $key => $item):
        $cls = ($_an_active === $key) ? ' an-active' : '';
    ?>
        <a class="an-sheet-row<?= $cls ?>" href="<?= $item['url']; ?>">
            <img src="<?= base_url('assets/frontend/icons/islamic/' . $item['svg'] . '.svg'); ?>" class="an-sheet-svg-icon" alt="">
            <?= htmlspecialchars($item['full'], ENT_QUOTES, 'UTF-8'); ?>
            <i class="bx bx-check an-check"></i>
        </a>
    <?php endforeach; ?>
    <button class="an-sheet-close" id="anSheetClose">Tutup</button>
</div>

<!-- ── Settings sheet (global: all amalan pages) ── -->
<div class="qr-cfg-overlay" id="anCfgOverlay"></div>
<div class="qr-cfg-sheet" id="anCfgSheet" role="dialog"
    aria-modal="true" aria-label="Pengaturan">
    <div class="qr-cfg-handle"><span></span></div>
    <div class="qr-cfg-hdr">
        <h2>Pengaturan</h2>
        <button class="qr-cfg-close-btn" type="button" id="anCfgClose"
            aria-label="Tutup pengaturan"><i class="bx bx-x"></i></button>
    </div>

    <p class="qr-cfg-sec-label">TAMPILAN</p>

    <!-- Dark / Light mode toggle -->
    <div class="qr-cfg-row">
        <div>
            <span class="qr-cfg-label">Mode Gelap</span>
            <span class="qr-cfg-hint">Tampilan gelap untuk semua halaman amalan</span>
        </div>
        <label class="qr-toggle">
            <input type="checkbox" id="anThemeToggle" checked>
            <span class="qr-toggle-track"></span>
        </label>
    </div>

    <p class="qr-cfg-sec-label">BACA</p>

    <!-- Font size (global) -->
    <div class="qr-cfg-row">
        <div>
            <span class="qr-cfg-label">Ukuran Font</span>
            <span class="qr-cfg-hint">Arab, Latin &amp; Terjemahan semua amalan</span>
        </div>
        <div class="qr-cfg-font-ctrl">
            <span class="qr-cfg-a-sm">A</span>
            <input type="range" class="qr-cfg-slider" id="qrFontSlider"
                min="1" max="5" value="3" step="1">
            <span class="qr-cfg-a-lg">A</span>
        </div>
    </div>

    <?php if ($_an_active === 'quran' && $_an_is_reader): ?>
        <!-- Tajwid toggle (Quran reader only) -->
        <div class="qr-cfg-row">
            <div>
                <span class="qr-cfg-label">Tajwid</span>
                <span class="qr-cfg-hint">Warna hukum tajwid pada bacaan Arab</span>
            </div>
            <label class="qr-toggle">
                <input type="checkbox" id="qrTajwidToggle">
                <span class="qr-toggle-track"></span>
            </label>
        </div>

        <!-- Terjemahan toggle (Quran reader only) -->
        <div class="qr-cfg-row">
            <div>
                <span class="qr-cfg-label">Terjemahan</span>
                <span class="qr-cfg-hint">Tampilkan terjemahan Indonesia</span>
            </div>
            <label class="qr-toggle">
                <input type="checkbox" id="qrTransToggle" checked>
                <span class="qr-toggle-track"></span>
            </label>
        </div>
    <?php endif; ?>

</div>

<script>
    (function() {
        /* ── Apply saved theme before first paint ── */
        try {
            if (localStorage.getItem('rd_theme') === 'light') document.documentElement.setAttribute('data-theme', 'light');
        } catch (e) {}

        /* ── Scroll: pill → sticky bar + sync sub-nav ── */
        var hdr = document.getElementById('anHeader');
        var root = document.documentElement;

        function syncHdrH() {
            root.style.setProperty('--an-hdr-h', hdr.classList.contains('an-scrolled') ? '60px' : '76px');
        }
        syncHdrH();
        window.addEventListener('scroll', function() {
            hdr.classList.toggle('an-scrolled', window.scrollY > 40);
            syncHdrH();
        }, {
            passive: true
        });

        /* ── Bottom sheet ── */
        var btn = document.getElementById('anMobBtn');
        var overlay = document.getElementById('anOverlay');
        var sheet = document.getElementById('anSheet');
        var close = document.getElementById('anSheetClose');
        var startY = 0;

        function open() {
            overlay.classList.add('an-open');
            sheet.classList.add('an-open');
            overlay.setAttribute('aria-hidden', 'false');
            if (btn) btn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function shut() {
            overlay.classList.remove('an-open');
            sheet.classList.remove('an-open');
            overlay.setAttribute('aria-hidden', 'true');
            if (btn) btn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        if (btn) btn.addEventListener('click', open);
        if (overlay) overlay.addEventListener('click', shut);
        if (close) close.addEventListener('click', shut);
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') shut();
        });

        /* ── Apply saved font level on every amalan page ── */
        (function() {
            var fl = null;
            try {
                fl = parseInt(localStorage.getItem('rd_font_level'), 10);
            } catch (e) {}
            if (fl && fl >= 1 && fl <= 5 && fl !== 3) {
                document.documentElement.setAttribute('data-rd-font', String(fl));
            }
        })();

        /* ── Settings panel ── */
        var cfgBtn = document.getElementById('anCfgBtn');
        var cfgOverlay = document.getElementById('anCfgOverlay');
        var cfgSheet = document.getElementById('anCfgSheet');
        var cfgClose = document.getElementById('anCfgClose');
        var fontSlider = document.getElementById('qrFontSlider');

        function openCfg() {
            if (cfgSheet) cfgSheet.classList.add('is-open');
            if (cfgOverlay) cfgOverlay.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        }

        function closeCfg() {
            if (cfgSheet) cfgSheet.classList.remove('is-open');
            if (cfgOverlay) cfgOverlay.classList.remove('is-open');
            document.body.style.overflow = '';
        }

        if (cfgBtn) cfgBtn.addEventListener('click', openCfg);
        if (cfgClose) cfgClose.addEventListener('click', closeCfg);
        if (cfgOverlay) cfgOverlay.addEventListener('click', closeCfg);

        /* ── Font size slider ── */
        function applyFontLevel(level) {
            var root = document.documentElement;
            if (level >= 1 && level <= 5 && level !== 3) {
                root.setAttribute('data-rd-font', String(level));
            } else {
                root.removeAttribute('data-rd-font');
            }
        }

        var initFont = 3;
        try {
            initFont = parseInt(localStorage.getItem('rd_font_level'), 10) || 3;
        } catch (e) {}
        if (fontSlider) fontSlider.value = initFont;

        if (fontSlider) {
            fontSlider.addEventListener('input', function() {
                var level = parseInt(this.value, 10);
                applyFontLevel(level);
                try {
                    localStorage.setItem('rd_font_level', JSON.stringify(level));
                } catch (e) {}
            });
        }

        /* ── Dark / Light mode toggle ── */
        var themeToggle = document.getElementById('anThemeToggle');

        function applyTheme(isDark) {
            if (isDark) document.documentElement.removeAttribute('data-theme');
            else document.documentElement.setAttribute('data-theme', 'light');
        }
        var initDark = true;
        try {
            initDark = localStorage.getItem('rd_theme') !== 'light';
        } catch (e) {}
        if (themeToggle) themeToggle.checked = initDark;
        if (themeToggle) {
            themeToggle.addEventListener('change', function() {
                applyTheme(this.checked);
                try {
                    localStorage.setItem('rd_theme', this.checked ? 'dark' : 'light');
                } catch (e) {}
            });
        }

        if (sheet) {
            sheet.addEventListener('touchstart', function(e) {
                startY = e.touches[0].clientY;
            }, {
                passive: true
            });
            sheet.addEventListener('touchend', function(e) {
                if (e.changedTouches[0].clientY - startY > 55) shut();
            }, {
                passive: true
            });
        }
    })();
</script>
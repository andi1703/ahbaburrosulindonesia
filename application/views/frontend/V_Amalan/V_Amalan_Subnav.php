<?php
$CI = &get_instance();
$_uri = strtolower($CI->uri->uri_string());

$_an_active = '';
if (strpos($_uri, 'tahlil') === 0)    $_an_active = 'tahlil';
elseif (strpos($_uri, 'burdah') === 0) $_an_active = 'burdah';
elseif (strpos($_uri, 'wirid') === 0)       $_an_active = 'wirid';
elseif (strpos($_uri, 'khawajagan') === 0)  $_an_active = 'khawajagan';
elseif (strpos($_uri, 'manaqib') === 0 || strpos($_uri, 'hadits') === 0) $_an_active = 'manaqib';
elseif (strpos($_uri, 'maulid') === 0)      $_an_active = 'maulid';
elseif (strpos($_uri, 'sholawat') === 0)    $_an_active = 'sholawat';
elseif (strpos($_uri, 'quran') === 0)       $_an_active = 'quran';

$_an_is_reader  = (bool) $CI->uri->segment(2);
$_an_show_hero  = !$_an_is_reader && in_array($_an_active, ['', 'quran', 'tahlil', 'burdah', 'manaqib', 'maulid', 'sholawat']);

$_an_items = [
    ''           => ['svg' => 'kaaba',               'short' => 'Amalan',    'full' => 'Semua Amalan',      'url' => base_url('index.php/amalan')],
    'quran'      => ['svg' => 'quran-book',          'short' => "Al-Qur'an", 'full' => "Al-Qur'an",         'url' => base_url('index.php/quran')],
    'tahlil'     => ['svg' => 'dua-hands',           'short' => 'Tahlil',    'full' => 'Tahlil',            'url' => base_url('index.php/tahlil')],
    'burdah'     => ['svg' => 'muhammad-calligraphy','short' => 'Burdah',    'full' => 'Burdah Al Madih',   'url' => base_url('index.php/burdah')],
    'wirid'      => ['svg' => 'prayer-mat',          'short' => 'Wirid',     'full' => 'Wirid & Dzikir',    'url' => base_url('index.php/wirid')],
    'khawajagan' => ['svg' => 'prayer-beads-tasbih', 'short' => 'Khawajagan','full' => 'Dzikir Khawajagan', 'url' => base_url('index.php/khawajagan')],
    'manaqib'    => ['svg' => 'mosque-dome',         'short' => 'Manaqib',   'full' => 'Manaqib',           'url' => base_url('index.php/manaqib')],
    'maulid'     => ['svg' => 'crescent-star-frame', 'short' => 'Maulid',    'full' => "Maulid Ad-Diba'i",  'url' => base_url('index.php/maulid')],
    'sholawat'   => ['svg' => 'takbir-hands',        'short' => 'Sholawat',  'full' => 'Sholawat',          'url' => base_url('index.php/sholawat')],
];

$_an_heros = [
    ''        => ['bx' => 'bx-grid-alt',  'title' => 'Amalan',          'sub' => 'Panduan lengkap amalan harian Ahlussunnah Wal Jama\'ah.'],
    'quran'   => ['bx' => 'bx-book-open', 'title' => "Al-Qur'an",       'sub' => '114 surah dan 30 juz dengan terjemahan lengkap.'],
    'tahlil'  => ['bx' => 'bx-moon',      'title' => 'Tahlil',          'sub' => 'Rangkaian doa dan dzikir tahlil untuk berbagai keperluan.'],
    'burdah'  => ['bx' => 'bx-star',      'title' => 'Burdah Al Madih', 'sub' => 'Kasidah Burdah — syair pujian kepada Nabi Muhammad \u{FDFA}.'],
    'khawajagan' => ['bx' => 'bx-infinite', 'title' => 'Dzikir Khatam Khawajagan', 'sub' => 'Dzikir Khatam dari Silsilah Naqshbandiyyah Al-\'Aliyyah.'],
    'manaqib'    => ['bx' => 'bx-news',    'title' => 'Manaqib',                  'sub' => 'Manaqib Jawahirul Ma\'ani — kisah Syekh Abdul Qadir Al-Jailani.'],
    'maulid'     => ['bx' => 'bx-music',   'title' => "Maulid Ad-Diba'i",         'sub' => '29 bacaan maulid karya Syaikh Abdurrahman Ad-Diba\'i.'],
    'sholawat'   => ['bx' => 'bx-heart',  'title' => 'Sholawat',                 'sub' => 'Kumpulan sholawat dan kasidah pujian kepada Nabi Muhammad \u{FDFA}.'],
];
$_hero = $_an_heros[$_an_active] ?? $_an_heros[''];
$_logo = !empty($identitas['logo']) ? base_url('assets/img/logo/' . $identitas['logo']) : '';
$_site_name = $identitas['nama_website'] ?? 'Majelis Ahbaburrosul Indonesia';
?>
<style>
    :root { --an-hdr-h: 62px; }

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
        padding: 10px 14px;
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
        height: 52px;
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
        color: #7a8f8a;
        font-size: .72rem;
        font-weight: 500;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
        border-bottom: 2px solid transparent;
        transition: color .14s, border-color .14s;
    }

    .an-link:hover {
        color: #c4d0cc;
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
        background: linear-gradient(135deg, #7a5818 0%, #5e430c 55%, #3e2c08 100%);
        padding-top: 6rem;
        padding-bottom: 3.5rem;
    }

    /* Islamic geometric dot pattern */
    .an-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            radial-gradient(rgba(255, 255, 255, .09) 1.5px, transparent 1.5px),
            radial-gradient(rgba(255, 255, 255, .05) 1.5px, transparent 1.5px);
        background-size: 32px 32px;
        background-position: 0 0, 16px 16px;
        pointer-events: none;
    }

    /* Soft teal glow */
    .an-hero::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 28%;
        transform: translate(-50%, -50%);
        width: 320px;
        height: 320px;
        background: rgba(232, 184, 75, .14);
        border-radius: 50%;
        filter: blur(70px);
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

    @media (max-width: 479px) {
        .an-hero {
            padding-top: 6.5rem;
            padding-bottom: 3rem;
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

        <!-- Right: home -->
        <div class="an-right">
            <a class="an-icon-btn" href="<?= base_url(); ?>" title="Beranda">
                <i class="bx bx-home-alt-2"></i>
            </a>
        </div>

    </nav>
</header>

<!-- ══ Hero Section (index pages only) ══ -->
<?php if ($_an_show_hero): ?>
    <section class="an-hero">
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

<script>
    (function() {
        /* ── Scroll: pill → sticky bar + sync sub-nav ── */
        var hdr = document.getElementById('anHeader');
        var root = document.documentElement;
        function syncHdrH() {
            root.style.setProperty('--an-hdr-h', hdr.classList.contains('an-scrolled') ? '52px' : '62px');
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
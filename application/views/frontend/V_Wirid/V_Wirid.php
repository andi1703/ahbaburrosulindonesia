<?php
defined('BASEPATH') or exit('No direct script access allowed');
$dzikir_list = $dzikir_list ?? [];
?>
<style>
    body { background: #0b0d0d; }
    @font-face {
        font-family: "LPMQ";
        src: url("<?= base_url('assets/frontend/fonts/LPMQ.ttf'); ?>") format("truetype");
        font-weight: 400;
        font-display: swap;
    }

    :root {
        --wr-bg: #0b0d0d;
        --wr-surf: #131615;
        --wr-border: rgba(255,255,255,.07);
        --wr-text: #eef1ee;
        --wr-muted: #6d7e78;
        --wr-accent: #e8b84b;
        --wr-nav: 62px;
        --wr-sub: 48px;
    }

    .wr-page {
        min-height: 100vh;
        padding-top: calc(var(--wr-nav) + var(--wr-sub));
        padding-bottom: 5rem;
        background: var(--wr-bg);
        color: var(--wr-text);
    }

    /* ── Sub-nav ── */
    .wr-subnav {
        position: fixed;
        top: var(--an-hdr-h, 62px);
        transition: top .32s ease;
        left: 0; right: 0;
        z-index: 120;
        height: var(--wr-sub);
        display: flex;
        align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }

    .wr-subnav-inner {
        display: flex;
        align-items: center;
        gap: .5rem;
        width: 100%;
        max-width: 860px;
        margin-inline: auto;
        padding-inline: 1rem;
    }

    .wr-pill {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        height: 34px;
        padding: 0 .85rem;
        border: 1.5px solid rgba(255,255,255,.12);
        border-radius: 8px;
        background: #1a1d1c;
        color: #a8b5b0;
        font: inherit;
        font-size: .73rem;
        white-space: nowrap;
        text-decoration: none;
        flex-shrink: 0;
        transition: border-color .14s, color .14s;
    }

    .wr-pill:hover { border-color: var(--wr-accent); color: var(--wr-accent); }

    .wr-pill.is-active {
        border-color: var(--wr-accent);
        background: rgba(232,184,75,.08);
        color: var(--wr-accent);
        font-weight: 600;
    }

    .wr-subnav-title {
        flex: 1;
        text-align: center;
        font-size: .75rem;
        font-weight: 600;
        color: #fff;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .wr-subnav-count {
        flex-shrink: 0;
        color: var(--wr-muted);
        font-size: .68rem;
        white-space: nowrap;
    }

    /* ── Content ── */
    .wr-body {
        width: min(100% - 2rem, 820px);
        margin-inline: auto;
    }

    /* ── Header ── */
    .wr-hdr {
        padding: 2.25rem 0 1.65rem;
        text-align: center;
        border-bottom: 1px solid var(--wr-border);
    }

    .wr-hdr-icon {
        display: grid;
        width: 54px;
        height: 54px;
        margin: 0 auto .9rem;
        place-items: center;
        border-radius: 14px;
        background: rgba(232,184,75,.12);
        color: var(--wr-accent);
        font-size: 1.6rem;
    }

    .wr-hdr-name {
        margin: 0 0 .25rem;
        font-size: clamp(1.25rem, 3vw, 1.55rem);
        font-weight: 800;
        color: #fff;
    }

    .wr-hdr-sub {
        margin: 0;
        font-size: .82rem;
        color: var(--wr-muted);
    }

    .wr-hdr-meta {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .28rem .9rem;
        border-radius: 99px;
        background: rgba(255,255,255,.05);
        color: var(--wr-muted);
        font-size: .68rem;
        margin-bottom: 1.1rem;
    }

    /* ── Dzikir block ── */
    .wr-dzikir {
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--wr-border);
        scroll-margin-top: calc(var(--wr-nav) + var(--wr-sub) + .5rem);
    }

    .wr-dzikir-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(232,184,75,.1);
        border: 1px solid rgba(232,184,75,.25);
        color: var(--wr-accent);
        font-size: .62rem;
        font-weight: 700;
        margin-bottom: .85rem;
    }

    .wr-dzikir-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        line-height: 2.1;
        color: #fff;
        direction: rtl;
        text-align: right;
        white-space: pre-line;
    }

    /* ── Section frame (like Quran surah divider) ── */
    .wr-section {
        margin: 1.75rem 0 1.25rem;
        position: relative;
    }

    .wr-section-ornament {
        height: 8px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='8'%3E%3Cpolygon points='7,0 13,4 7,8 1,4' fill='%23e8b84b' opacity='.55'/%3E%3C/svg%3E");
        background-repeat: repeat-x;
        background-size: 14px 8px;
    }

    .wr-section-frame {
        position: relative;
        border: 2px solid var(--wr-accent);
        background: var(--wr-surf);
        padding: .9rem 2rem;
        text-align: center;
    }

    .wr-section-frame::after {
        content: '';
        position: absolute;
        inset: 5px;
        border: 1px solid rgba(232,184,75,.25);
        pointer-events: none;
    }

    .wr-sc {
        position: absolute;
        width: 12px; height: 12px;
        background: var(--wr-accent);
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        z-index: 1;
    }
    .wr-sc--tl { top: -6px; left: -6px; }
    .wr-sc--tr { top: -6px; right: -6px; }
    .wr-sc--bl { bottom: -6px; left: -6px; }
    .wr-sc--br { bottom: -6px; right: -6px; }

    .wr-section-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        font-weight: 700;
        line-height: 1.8;
        color: #fff;
        direction: rtl;
        position: relative;
        z-index: 1;
    }

    /* ── Back link ── */
    .wr-back {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .28rem .75rem;
        border-radius: 99px;
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.08);
        color: var(--wr-muted);
        font-size: .68rem;
        text-decoration: none;
        transition: color 140ms, border-color 140ms;
        margin-bottom: 1.5rem;
    }

    .wr-back:hover { color: var(--wr-accent); border-color: rgba(232,184,75,.4); }

    /* ── Footer back ── */
    .wr-footer {
        padding: 2rem 0 1rem;
        text-align: center;
        border-top: 1px solid var(--wr-border);
        margin-top: 1rem;
    }

    .wr-footer-btn {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        min-height: 40px;
        padding: 0 1.4rem;
        border: 1.5px solid rgba(255,255,255,.1);
        border-radius: 99px;
        background: var(--wr-surf);
        color: var(--wr-text);
        font: inherit;
        font-size: .8rem;
        text-decoration: none;
        transition: border-color 150ms, background 150ms, color 150ms;
    }

    .wr-footer-btn:hover {
        border-color: rgba(232,184,75,.55);
        background: #1a1c1b;
        color: var(--wr-accent);
    }

    @media (max-width: 575.98px) {
        .wr-dzikir-arab { font-size: clamp(1.6rem, 4vw, 2.2rem); line-height: 2.1; }
        .wr-hdr { padding-block: 1.5rem 1.25rem; }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<!-- Sub-nav -->
<nav class="wr-subnav" aria-label="Navigasi Wirid">
    <div class="wr-subnav-inner">
        <a class="wr-pill" href="<?= base_url('index.php/amalan'); ?>" title="Kembali ke Amalan">
            <i class="bx bx-grid-alt"></i>
        </a>

        <span class="wr-subnav-title">Wirid &amp; Dzikir Ba'da Sholat</span>

        <span class="wr-subnav-count"><?= count($dzikir_list); ?> bacaan</span>
    </div>
</nav>

<main class="wr-page" data-wr-page>
    <div class="wr-body">

        <!-- Header -->
        <header class="wr-hdr">
            <span class="wr-hdr-meta">
                <span>Amalan</span>
                <span style="opacity:.4;">·</span>
                <span><?= count($dzikir_list); ?> bacaan dzikir</span>
            </span>

            <span class="wr-hdr-icon" aria-hidden="true">
                <img src="<?= base_url('assets/frontend/icons/islamic/prayer-mat.svg'); ?>" style="width:28px;height:28px;display:block;filter:brightness(0) invert(1);" alt="">
            </span>

            <h1 class="wr-hdr-name">Wirid &amp; Dzikir Ba'da Sholat</h1>
            <p class="wr-hdr-sub">Dzikir dan wirid ba'da sholat sesuai tuntunan Ahlussunnah Wal Jama'ah.</p>
        </header>

        <!-- Dzikir list -->
        <?php foreach ($dzikir_list as $idx => $dzikir): ?>
            <?php
            /* Detect section header: strip harakat then check length */
            $_bare = preg_replace('/[\x{064B}-\x{065F}\x{0610}-\x{061A}\x{06D6}-\x{06ED}]/u', '', trim($dzikir['arab']));
            $_is_header = mb_strlen($_bare, 'UTF-8') <= 15;
            ?>
            <?php if ($_is_header): ?>
            <div class="wr-section" id="dzikir-<?= (int) $dzikir['id']; ?>">
                <div class="wr-section-ornament"></div>
                <div class="wr-section-frame">
                    <div class="wr-sc wr-sc--tl"></div>
                    <div class="wr-sc wr-sc--tr"></div>
                    <div class="wr-sc wr-sc--bl"></div>
                    <div class="wr-sc wr-sc--br"></div>
                    <span class="wr-section-arab" lang="ar" dir="rtl"><?= htmlspecialchars($dzikir['arab'], ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div class="wr-section-ornament"></div>
            </div>
            <?php else: ?>
            <div class="wr-dzikir" id="dzikir-<?= (int) $dzikir['id']; ?>">
                <span class="wr-dzikir-num"><?= $idx + 1; ?></span>
                <span class="wr-dzikir-arab" lang="ar" dir="rtl"><?= htmlspecialchars($dzikir['arab'], ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Footer -->
        <div class="wr-footer">
            <a class="wr-footer-btn" href="<?= base_url('index.php/amalan'); ?>">
                <i class="bx bx-grid-alt"></i> Kembali ke Amalan
            </a>
        </div>

        <?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Banner.php'; ?>
    </div>
</main>

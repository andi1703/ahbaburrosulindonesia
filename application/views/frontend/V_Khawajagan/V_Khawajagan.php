<?php
defined('BASEPATH') or exit('No direct script access allowed');
$khawajagan_list = $khawajagan_list ?? [];
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
        --kh-bg: #0b0d0d;
        --kh-surf: #131615;
        --kh-border: rgba(255,255,255,.07);
        --kh-text: #eef1ee;
        --kh-muted: #6d7e78;
        --kh-accent: #e8b84b;
        --kh-nav: 62px;
        --kh-sub: 48px;
    }

    .kh-page {
        min-height: 100vh;
        padding-top: calc(var(--kh-nav) + var(--kh-sub));
        padding-bottom: 5rem;
        background: var(--kh-bg);
        color: var(--kh-text);
    }

    /* ── Sub-nav ── */
    .kh-subnav {
        position: fixed;
        top: var(--an-hdr-h, 62px);
        transition: top .32s ease;
        left: 0; right: 0;
        z-index: 120;
        height: var(--kh-sub);
        display: flex;
        align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }

    .kh-subnav-inner {
        display: flex;
        align-items: center;
        gap: .5rem;
        width: 100%;
        max-width: 860px;
        margin-inline: auto;
        padding-inline: 1rem;
    }

    .kh-pill {
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

    .kh-pill:hover { border-color: var(--kh-accent); color: var(--kh-accent); }

    .kh-pill.is-active {
        border-color: var(--kh-accent);
        background: rgba(232,184,75,.08);
        color: var(--kh-accent);
        font-weight: 600;
    }

    .kh-subnav-title {
        flex: 1;
        text-align: center;
        font-size: .75rem;
        font-weight: 600;
        color: #fff;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .kh-subnav-count {
        flex-shrink: 0;
        color: var(--kh-muted);
        font-size: .68rem;
        white-space: nowrap;
    }

    /* ── Content ── */
    .kh-body {
        width: min(100% - 2rem, 820px);
        margin-inline: auto;
    }

    /* ── Header ── */
    .kh-hdr {
        padding: 2.25rem 0 1.65rem;
        text-align: center;
        border-bottom: 1px solid var(--kh-border);
    }

    .kh-hdr-icon {
        display: grid;
        width: 54px;
        height: 54px;
        margin: 0 auto .9rem;
        place-items: center;
        border-radius: 14px;
        background: rgba(232,184,75,.12);
        color: var(--kh-accent);
        font-size: 1.6rem;
    }

    .kh-hdr-name {
        margin: 0 0 .25rem;
        font-size: clamp(1.25rem, 3vw, 1.55rem);
        font-weight: 800;
        color: #fff;
    }

    .kh-hdr-sub {
        margin: 0;
        font-size: .82rem;
        color: var(--kh-muted);
    }

    .kh-hdr-meta {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .28rem .9rem;
        border-radius: 99px;
        background: rgba(255,255,255,.05);
        color: var(--kh-muted);
        font-size: .68rem;
        margin-bottom: 1.1rem;
    }

    /* ── Section frame ── */
    .kh-section {
        margin: 1.75rem 0 1.25rem;
        position: relative;
    }
    .kh-section-ornament {
        height: 8px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='8'%3E%3Cpolygon points='7,0 13,4 7,8 1,4' fill='%23e8b84b' opacity='.55'/%3E%3C/svg%3E");
        background-repeat: repeat-x;
        background-size: 14px 8px;
    }
    .kh-section-frame {
        position: relative;
        border: 2px solid var(--kh-accent);
        background: var(--kh-surf);
        padding: .9rem 2rem;
        text-align: center;
    }
    .kh-section-frame::after {
        content: '';
        position: absolute;
        inset: 5px;
        border: 1px solid rgba(232,184,75,.25);
        pointer-events: none;
    }
    .kh-sc {
        position: absolute;
        width: 12px; height: 12px;
        background: var(--kh-accent);
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        z-index: 1;
    }
    .kh-sc--tl { top: -6px; left: -6px; }
    .kh-sc--tr { top: -6px; right: -6px; }
    .kh-sc--bl { bottom: -6px; left: -6px; }
    .kh-sc--br { bottom: -6px; right: -6px; }
    .kh-section-arab {
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

    /* ── Bacaan block ── */
    .kh-bacaan {
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--kh-border);
        scroll-margin-top: calc(var(--kh-nav) + var(--kh-sub) + .5rem);
    }

    .kh-bacaan-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(232,184,75,.1);
        border: 1px solid rgba(232,184,75,.25);
        color: var(--kh-accent);
        font-size: .62rem;
        font-weight: 700;
        margin-bottom: .85rem;
    }

    .kh-bacaan-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        line-height: 2.1;
        color: #fff;
        direction: rtl;
        text-align: right;
        white-space: pre-line;
    }

    /* ── Back link ── */
    .kh-back {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .28rem .75rem;
        border-radius: 99px;
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.08);
        color: var(--kh-muted);
        font-size: .68rem;
        text-decoration: none;
        transition: color 140ms, border-color 140ms;
        margin-bottom: 1.1rem;
    }

    .kh-back:hover { color: var(--kh-accent); border-color: rgba(232,184,75,.4); }

    /* ── Footer ── */
    .kh-footer {
        padding: 2rem 0 1rem;
        text-align: center;
        border-top: 1px solid var(--kh-border);
        margin-top: 1rem;
    }

    .kh-footer-btn {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        min-height: 40px;
        padding: 0 1.4rem;
        border: 1.5px solid rgba(255,255,255,.1);
        border-radius: 99px;
        background: var(--kh-surf);
        color: var(--kh-text);
        font: inherit;
        font-size: .8rem;
        text-decoration: none;
        transition: border-color 150ms, background 150ms, color 150ms;
    }

    .kh-footer-btn:hover {
        border-color: rgba(232,184,75,.55);
        background: #1a1c1b;
        color: var(--kh-accent);
    }

    @media (max-width: 575.98px) {
        .kh-bacaan-arab { font-size: clamp(1.6rem, 4vw, 2.2rem); line-height: 2.1; }
        .kh-hdr { padding-block: 1.5rem 1.25rem; }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<!-- Sub-nav -->
<nav class="kh-subnav" aria-label="Navigasi Khawajagan">
    <div class="kh-subnav-inner">
        <a class="kh-pill" href="<?= base_url('index.php/amalan'); ?>" title="Kembali ke Amalan">
            <i class="bx bx-grid-alt"></i>
        </a>

        <span class="kh-subnav-title">Dzikir Khatam Khawajagan</span>

        <span class="kh-subnav-count"><?= count($khawajagan_list); ?> bacaan</span>
    </div>
</nav>

<main class="kh-page" data-kh-page>
    <div class="kh-body">

        <!-- Header -->
        <header class="kh-hdr">
            <span class="kh-hdr-icon" aria-hidden="true">
                <img src="<?= base_url('assets/frontend/icons/islamic/prayer-beads-tasbih.svg'); ?>" style="width:28px;height:28px;display:block;filter:brightness(0) invert(1);" alt="">
            </span>

            <h1 class="kh-hdr-name">Dzikir Khatam Khawajagan</h1>
            <p class="kh-hdr-sub">Dzikir Khatam dari Silsilah Naqshbandiyyah Al-'Aliyyah.</p>
        </header>

        <!-- Bacaan list -->
        <?php foreach ($khawajagan_list as $idx => $item): ?>
            <?php
            $_bare = preg_replace('/[\x{064B}-\x{065F}\x{0610}-\x{061A}\x{06D6}-\x{06ED}]/u', '', trim($item['arab']));
            $_len = mb_strlen($_bare, 'UTF-8');
            $_is_header = $_len >= 3 && $_len <= 6;
            ?>
            <?php if ($_is_header): ?>
            <div class="kh-section" id="bacaan-<?= (int) $item['id']; ?>">
                <div class="kh-section-ornament"></div>
                <div class="kh-section-frame">
                    <div class="kh-sc kh-sc--tl"></div>
                    <div class="kh-sc kh-sc--tr"></div>
                    <div class="kh-sc kh-sc--bl"></div>
                    <div class="kh-sc kh-sc--br"></div>
                    <span class="kh-section-arab" lang="ar" dir="rtl"><?= htmlspecialchars($item['arab'], ENT_QUOTES, 'UTF-8'); ?></span>
                </div>
                <div class="kh-section-ornament"></div>
            </div>
            <?php else: ?>
            <div class="kh-bacaan" id="bacaan-<?= (int) $item['id']; ?>">
                <span class="kh-bacaan-num"><?= $idx + 1; ?></span>
                <span class="kh-bacaan-arab" lang="ar" dir="rtl"><?= htmlspecialchars($item['arab'], ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>

        <!-- Footer -->
        <div class="kh-footer">
            <a class="kh-footer-btn" href="<?= base_url('index.php/amalan'); ?>">
                <i class="bx bx-grid-alt"></i> Kembali ke Amalan
            </a>
        </div>

        <?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Banner.php'; ?>
    </div>
</main>

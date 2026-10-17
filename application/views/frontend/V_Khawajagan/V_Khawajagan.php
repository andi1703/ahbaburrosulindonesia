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
        color: #c8d0cc;
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
        font-family: "LPMQ", "Amiri", serif;
        font-size: clamp(1.45rem, 4vw, 2rem);
        line-height: 2.2;
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
        .kh-bacaan-arab { font-size: 1.35rem; line-height: 2.1; }
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
            <span class="kh-hdr-meta">
                <span>Amalan</span>
                <span style="opacity:.4;">·</span>
                <span><?= count($khawajagan_list); ?> bacaan dzikir</span>
            </span>

            <span class="kh-hdr-icon" aria-hidden="true">
                <img src="<?= base_url('assets/frontend/icons/islamic/prayer-beads-tasbih.svg'); ?>" style="width:28px;height:28px;display:block;filter:brightness(0) invert(1);" alt="">
            </span>

            <h1 class="kh-hdr-name">Dzikir Khatam Khawajagan</h1>
            <p class="kh-hdr-sub">Dzikir Khatam dari Silsilah Naqshbandiyyah Al-'Aliyyah.</p>
        </header>

        <!-- Bacaan list -->
        <?php foreach ($khawajagan_list as $idx => $item): ?>
            <div class="kh-bacaan" id="bacaan-<?= (int) $item['id']; ?>">
                <span class="kh-bacaan-num"><?= $idx + 1; ?></span>
                <span class="kh-bacaan-arab" lang="ar" dir="rtl"><?= htmlspecialchars($item['arab'], ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
        <?php endforeach; ?>

        <!-- Footer -->
        <div class="kh-footer">
            <a class="kh-footer-btn" href="<?= base_url('index.php/amalan'); ?>">
                <i class="bx bx-grid-alt"></i> Kembali ke Amalan
            </a>
        </div>

    </div>
</main>

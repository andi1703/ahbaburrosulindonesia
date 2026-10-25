<?php
defined('BASEPATH') or exit('No direct script access allowed');
$sh_group       = $sh_group       ?? 'nasyid';
$sh_group_title = $sh_group_title ?? 'Nasyid';
$sh_list        = $sh_list        ?? [];
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
        --shg-bg: #0b0d0d;
        --shg-surf: #131615;
        --shg-surf-h: #1a1d1c;
        --shg-text: #eef1ee;
        --shg-muted: #6d7e78;
        --shg-accent: #e8b84b;
        --shg-nav: 62px;
        --shg-sub: 48px;
    }

    .shg-page {

        padding-top: calc(var(--shg-nav) + var(--shg-sub));
        padding-bottom: 5rem;
        background: var(--shg-bg);
        color: var(--shg-text);
    }

    /* ── Sub-nav ── */
    .shg-subnav {
        position: fixed;
        top: var(--an-hdr-h, 62px); left: 0; right: 0;
        transition: top .32s ease;
        z-index: 120; height: var(--shg-sub);
        display: flex; align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }

    .shg-subnav-inner {
        display: flex; align-items: center; gap: .5rem;
        width: 100%; max-width: 1100px;
        margin-inline: auto; padding-inline: 1rem;
    }

    .shg-pill {
        display: inline-flex; align-items: center; gap: .3rem;
        height: 34px; padding: 0 .85rem;
        border: 1.5px solid rgba(255,255,255,.12); border-radius: 8px;
        background: #1a1d1c; color: #a8b5b0;
        font: inherit; font-size: .73rem; white-space: nowrap;
        text-decoration: none; flex-shrink: 0;
        transition: border-color .14s, color .14s, background .14s;
    }

    .shg-pill:hover { border-color: var(--shg-accent); color: var(--shg-accent); }

    .shg-pill.is-active {
        border-color: var(--shg-accent);
        background: rgba(232,184,75,.08);
        color: var(--shg-accent); font-weight: 600;
    }

    .shg-subnav-spacer { flex: 1; }

    .shg-subnav-count {
        flex-shrink: 0;
        color: var(--shg-muted);
        font-size: .68rem;
        white-space: nowrap;
    }

    /* ── Search bar ── */
    .shg-search-wrap {
        margin: 0 0 1rem;
    }

    .shg-search {
        display: flex; align-items: center; gap: .65rem;
        min-height: 42px; padding: 0 1rem;
        border: 1px solid rgba(255,255,255,.08); border-radius: 99px;
        background: #131615; color: #fff;
        transition: border-color 150ms;
    }

    .shg-search:focus-within { border-color: rgba(232,184,75,.4); }

    .shg-search i { color: #8aa09a; font-size: 1rem; flex-shrink: 0; }

    .shg-search input {
        width: 100%; border: 0; outline: 0;
        background: transparent; color: #fff;
        font: inherit; font-size: .8rem;
    }

    .shg-search input::placeholder { color: #7a8a84; }

    /* ── Grid ── */
    .shg-browser {
        width: min(100% - 2rem, 1100px);
        margin-inline: auto;
        padding-bottom: 2rem;
    }

    .shg-meta { min-height: 1.4rem; margin-bottom: .5rem; color: var(--shg-muted); font-size: .69rem; }

    .shg-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: .5rem;
    }

    .shg-card {
        display: grid;
        grid-template-columns: 28px minmax(0,1fr) auto;
        align-items: center;
        gap: .6rem;
        min-height: 66px;
        padding: .65rem .75rem;
        border: 1px solid rgba(255,255,255,.035);
        border-radius: 8px;
        background: var(--shg-surf);
        color: var(--shg-text);
        text-decoration: none;
        transition: border-color 150ms, background 150ms;
    }

    .shg-card[hidden] { display: none !important; }

    .shg-card:hover {
        border-color: rgba(232,184,75,.45);
        background: var(--shg-surf-h);
        color: #fff;
    }

    .shg-num {
        display: grid; width: 28px; height: 28px;
        place-items: center; border-radius: 6px;
        background: #1e2220; color: #d0d8d4;
        font-size: .64rem; font-weight: 700;
    }

    .shg-card-copy { min-width: 0; overflow: hidden; }

    .shg-card-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: .82rem;
        line-height: 1.5;
        color: #d8e0dc;
        direction: rtl;
        text-align: right;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .shg-card-latin {
        display: block;
        font-size: .62rem;
        color: var(--shg-muted);
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        margin-top: .1rem;
        text-align: right;
    }

    .shg-card-arrow { color: var(--shg-accent); font-size: 1rem; flex-shrink: 0; }

    .shg-empty { padding: 3.5rem 1rem; text-align: center; color: var(--shg-muted); }
    .shg-empty i { display: block; font-size: 1.75rem; color: #3a4540; margin-bottom: .4rem; }
    .shg-empty[hidden] { display: none !important; }

    @media (max-width: 991.98px) {
        .shg-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
    }

    @media (max-width: 575.98px) {
        .shg-grid { grid-template-columns: minmax(0,1fr); gap: .4rem; }
        .shg-card { min-height: 60px; padding-inline: .65rem; }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<!-- Sub-nav -->
<nav class="shg-subnav" aria-label="Navigasi Sholawat">
    <div class="shg-subnav-inner">
        <a class="shg-pill" href="<?= base_url('index.php/sholawat'); ?>" title="Kelompok Sholawat">
            <i class="bx bx-grid-alt"></i>
        </a>

        <a class="shg-pill <?= $sh_group === 'nasyid' ? 'is-active' : ''; ?>"
           href="<?= base_url('index.php/sholawat/nasyid'); ?>">
            <i class="bx bx-heart"></i> Nasyid
        </a>

        <a class="shg-pill <?= $sh_group === 'suluk' ? 'is-active' : ''; ?>"
           href="<?= base_url('index.php/sholawat/suluk'); ?>">
            <i class="bx bx-feather"></i> Suluk
        </a>

        <span class="shg-subnav-spacer"></span>
        <span class="shg-subnav-count" data-shg-count><?= count($sh_list); ?> <?= $sh_group_title; ?></span>
    </div>
</nav>

<main class="shg-page">
    <div class="shg-browser">

        <!-- Search -->
        <div class="shg-search-wrap">
            <label class="shg-search">
                <i class="bx bx-search"></i>
                <input type="search" id="shgSearch" placeholder="Cari sholawat…" autocomplete="off">
            </label>
        </div>

        <p class="shg-meta" aria-live="polite">
            <span data-shg-count-label><?= count($sh_list); ?></span> sholawat ditemukan
        </p>

        <div class="shg-grid" data-shg-grid>
            <?php foreach ($sh_list as $i => $item):
                $search_txt = mb_strtolower($item['latin'] . ' ' . $item['name'], 'UTF-8');
            ?>
                <a class="shg-card" data-shg-card
                   data-search="<?= htmlspecialchars($search_txt, ENT_QUOTES, 'UTF-8'); ?>"
                   href="<?= base_url('index.php/sholawat/' . $sh_group . '/' . rawurlencode($item['slug'])); ?>">
                    <span class="shg-num"><?= $i + 1; ?></span>
                    <span class="shg-card-copy">
                        <span class="shg-card-arab" lang="ar" dir="rtl"><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="shg-card-latin"><?= htmlspecialchars($item['latin'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </span>
                    <i class="bx bx-chevron-right shg-card-arrow" aria-hidden="true"></i>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="shg-empty" data-shg-empty hidden>
            <i class="bx bx-search-alt" aria-hidden="true"></i>
            Tidak ada sholawat yang cocok.
        </div>
    </div>
</main>

<script>
(function () {
    var input   = document.getElementById('shgSearch');
    var cards   = document.querySelectorAll('[data-shg-card]');
    var empty   = document.querySelector('[data-shg-empty]');
    var label   = document.querySelector('[data-shg-count-label]');

    if (!input) return;

    input.addEventListener('input', function () {
        var q = this.value.trim().toLowerCase();
        var n = 0;
        cards.forEach(function (c) {
            var match = !q || c.dataset.search.indexOf(q) !== -1;
            c.hidden = !match;
            if (match) n++;
        });
        if (label) label.textContent = n;
        if (empty) empty.hidden = n > 0;
    });
})();
</script>

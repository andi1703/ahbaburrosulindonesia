<?php
defined('BASEPATH') or exit('No direct script access allowed');
$sh_all_list = $sh_all_list ?? [];
$sh_counts   = $sh_counts   ?? ['nasyid' => 0, 'suluk' => 0];
$sh_total    = count($sh_all_list);
?>
<style>
    body { background: #0b0d0d; }
    @font-face {
        font-family: "LPMQ";
        src: url("<?= base_url('assets/frontend/fonts/LPMQ.ttf'); ?>") format("truetype");
        font-weight: 400;
        font-display: swap;
    }

    .sh-page {
        --sh-bg: #0b0d0d;
        --sh-surf: #191c1b;
        --sh-surf-h: #202523;
        --sh-text: #f2f5f4;
        --sh-muted: #9aa5a1;
        --sh-accent: #e8b84b;
        padding-top: 1rem;
        color: var(--sh-text);
        background: var(--sh-bg);
    }

    .sh-container {
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
    }

    .sh-browser { padding-block: 1.15rem 3.5rem; }

    /* ── Toolbar (tabs + sort) ── */
    .sh-toolbar {
        display: flex; align-items: center;
        justify-content: space-between;
        gap: 1rem; margin-bottom: 1.15rem;
    }

    .sh-tabs {
        display: inline-flex; max-width: 100%;
        padding: 3px; border-radius: 99px;
        background: #242726;
    }

    .sh-tab {
        min-height: 32px; padding: .35rem .85rem;
        border: 0; border-radius: 99px;
        background: transparent; color: #bdc5c2;
        font: inherit; font-size: .7rem;
        white-space: nowrap; cursor: pointer;
        transition: background-color 160ms ease, color 160ms ease;
    }

    .sh-tab:hover { color: #fff; }
    .sh-tab[aria-selected="true"] { background: #454948; color: #fff; }

    .sh-results-meta {
        min-height: 1.4rem; margin-bottom: .55rem;
        color: var(--sh-muted); font-size: .69rem;
    }

    /* ── Grid ── */
    .sh-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: .55rem;
    }

    .sh-grid[hidden], .sh-empty[hidden] { display: none !important; }

    .sh-card {
        display: grid;
        grid-template-columns: 48px minmax(0,1fr) auto;
        align-items: center;
        gap: .9rem;
        min-height: 74px;
        padding: .8rem .9rem;
        border: 1px solid rgba(255,255,255,.055);
        border-radius: 10px;
        background: var(--sh-surf);
        color: var(--sh-text);
        text-decoration: none;
        transition: background-color 150ms ease, border-color 150ms ease;
    }

    .sh-card[hidden] { display: none !important; }
    .sh-card:hover {
        border-color: rgba(232,184,75,.55);
        background: var(--sh-surf-h);
        color: #fff;
    }

    .sh-num {
        display: grid; width: 44px; height: 44px;
        flex-shrink: 0; place-items: center;
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        background: #2c3230; color: var(--sh-accent);
        font-size: .76rem; font-weight: 800;
        font-variant-numeric: tabular-nums;
    }

    .sh-card-copy { display: block; min-width: 0; overflow: hidden; }

    .sh-card-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: 1.2rem; font-weight: 700;
        line-height: 1.5; color: var(--sh-text);
        direction: rtl; text-align: right;
        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
    }

    .sh-card-latin {
        display: block;
        font-size: .72rem; color: var(--sh-muted);
        overflow: hidden; white-space: nowrap; text-overflow: ellipsis;
        margin-top: .22rem;
        text-align: right;
    }

    .sh-card-arrow { color: var(--sh-accent); font-size: 1rem; flex-shrink: 0; }

    .sh-empty {
        padding: 3.5rem 1rem;
        color: var(--sh-muted); text-align: center;
    }
    .sh-empty i { display: block; margin-bottom: .45rem; color: #65716c; font-size: 1.75rem; }

    @media (max-width: 991.98px) {
        .sh-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
    }
    @media (max-width: 575.98px) {
        .sh-tabs { overflow-x: auto; scrollbar-width: none; }
        .sh-tabs::-webkit-scrollbar { display: none; }
        .sh-tab { padding-inline: .67rem; font-size: .66rem; }
        .sh-grid { grid-template-columns: minmax(0,1fr); gap: .45rem; }
        .sh-card { min-height: 66px; padding-inline: .75rem; }
        .sh-card-arab { font-size: 1rem; }
        .sh-card-latin { font-size: .65rem; }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<main class="sh-page" data-sh-page>
    <section class="sh-container sh-browser" aria-label="Daftar sholawat">

        <!-- Toolbar: tabs -->
        <div class="sh-toolbar">
            <div class="sh-tabs" role="tablist" aria-label="Pilih kelompok sholawat">
                <button class="sh-tab" type="button" role="tab" aria-selected="true" data-sh-tab="all">
                    Semua
                </button>
                <button class="sh-tab" type="button" role="tab" aria-selected="false" data-sh-tab="nasyid">
                    Nasyid
                </button>
                <button class="sh-tab" type="button" role="tab" aria-selected="false" data-sh-tab="suluk">
                    Suluk
                </button>
            </div>
        </div>

        <p class="sh-results-meta" aria-live="polite">
            <span id="shCountLabel"><?= $sh_total; ?></span>
            <span id="shCountUnit">sholawat</span>
        </p>

        <div class="sh-grid" id="shGrid">
            <?php $n = 0; foreach ($sh_all_list as $item):
                $n++;
                $search_txt = mb_strtolower($item['latin'] . ' ' . $item['name'] . ' ' . $item['group'], 'UTF-8');
            ?>
                <a class="sh-card"
                   data-sh-card
                   data-group="<?= $item['group']; ?>"
                   data-search="<?= htmlspecialchars($search_txt, ENT_QUOTES, 'UTF-8'); ?>"
                   data-num="<?= $n; ?>"
                   href="<?= base_url('index.php/sholawat/' . $item['group'] . '/' . rawurlencode($item['slug'])); ?>">
                    <span class="sh-num" data-sh-num><?= $n; ?></span>
                    <span class="sh-card-copy">
                        <?php if (!empty($item['name'])): ?>
                            <span class="sh-card-arab" lang="ar" dir="rtl"><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endif; ?>
                        <span class="sh-card-latin"><?= htmlspecialchars($item['latin'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </span>
                    <i class="bx bx-chevron-right sh-card-arrow" aria-hidden="true"></i>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="sh-empty" id="shEmpty" hidden>
            <i class="bx bx-search-alt" aria-hidden="true"></i>
            Tidak ada sholawat yang cocok.
        </div>

    </section>
</main>

<script>
(function () {
    var tabs   = document.querySelectorAll('[data-sh-tab]');
    var cards  = document.querySelectorAll('[data-sh-card]');
    var input  = document.getElementById('shSearch');
    var empty  = document.getElementById('shEmpty');
    var label  = document.getElementById('shCountLabel');
    var unit   = document.getElementById('shCountUnit');

    var activeGroup = 'all';
    var activeQuery = '';

    function applyFilter() {
        var n = 0;
        cards.forEach(function (c) {
            var groupOk  = activeGroup === 'all' || c.dataset.group === activeGroup;
            var searchOk = !activeQuery || c.dataset.search.indexOf(activeQuery) !== -1;
            var show = groupOk && searchOk;
            c.hidden = !show;
            if (show) n++;
        });
        if (label) label.textContent = n;
        if (unit)  unit.textContent  = activeGroup === 'suluk' ? 'suluk' : 'sholawat';
        if (empty) empty.hidden = n > 0;
    }

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            tabs.forEach(function (t) { t.setAttribute('aria-selected', 'false'); });
            tab.setAttribute('aria-selected', 'true');
            activeGroup = tab.dataset.shTab;
            applyFilter();
        });
    });

    if (input) {
        input.addEventListener('input', function () {
            activeQuery = this.value.trim().toLowerCase();
            applyFilter();
        });
    }
})();
</script>

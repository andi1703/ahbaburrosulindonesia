<?php
defined('BASEPATH') or exit('No direct script access allowed');
$maulid_list = $maulid_list ?? [];
?>
<style>
    body { background: #0b0d0d; }
    .mdl-page {
        --mdl-bg: #0b0d0d;
        --mdl-surface: #191c1b;
        --mdl-surface-hover: #202523;
        --mdl-text: #f2f5f4;
        --mdl-muted: #9aa5a1;
        --mdl-accent: #e8b84b;
        padding-top: 1rem;

        color: var(--mdl-text);
        background: var(--mdl-bg);
    }

    .mdl-container {
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
    }

    .mdl-browser { padding-block: 1.15rem 3.5rem; }

    .mdl-results-meta { min-height: 1.4rem; margin-bottom: .55rem; color: var(--mdl-muted); font-size: .69rem; }

    .mdl-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: .55rem;
    }

    .mdl-empty[hidden] { display: none !important; }

    .mdl-card {
        display: grid;
        grid-template-columns: 30px minmax(0,1fr) auto;
        align-items: center;
        gap: .65rem;
        min-height: 68px;
        padding: .7rem .75rem;
        border: 1px solid rgba(255,255,255,.035);
        border-radius: 8px;
        background: var(--mdl-surface);
        color: var(--mdl-text);
        text-decoration: none;
        transition: background-color 150ms ease, border-color 150ms ease;
    }

    .mdl-card[hidden] { display: none !important; }

    .mdl-card:hover, .mdl-card:focus-visible {
        border-color: rgba(232,184,75,.5);
        background: var(--mdl-surface-hover);
        color: #fff;
    }

    .mdl-number {
        display: grid; width: 30px; height: 30px;
        place-items: center; border-radius: 6px;
        background: #282c2a; color: #e3e8e5;
        font-size: .68rem; font-weight: 700;
    }

    .mdl-card-copy { display: block; min-width: 0; overflow: hidden; }

    .mdl-card-title {
        display: block; overflow: hidden; color: inherit;
        font-size: .73rem; font-weight: 700; line-height: 1.3;
        text-overflow: ellipsis; white-space: nowrap;
    }

    .mdl-card-subtitle {
        display: block; overflow: hidden; margin-top: .12rem;
        color: var(--mdl-muted); font-size: .58rem;
        line-height: 1.4; text-overflow: ellipsis; white-space: nowrap;
    }

    .mdl-card-icon { color: var(--mdl-accent); font-size: 1.1rem; flex-shrink: 0; }

    .mdl-empty { padding: 3.5rem 1rem; color: var(--mdl-muted); text-align: center; }
    .mdl-empty i { display: block; margin-bottom: .45rem; color: #65716c; font-size: 1.75rem; }

    @media (max-width: 991.98px) {
        .mdl-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
    }

    @media (max-width: 575.98px) {
        .mdl-container { width: min(100% - 1.5rem, 1120px); }
        .mdl-browser { padding-top: .8rem; }
        .mdl-grid { grid-template-columns: minmax(0,1fr); gap: .45rem; }
        .mdl-card { min-height: 62px; padding-inline: .7rem; }
        .mdl-card-title { font-size: .78rem; }
        .mdl-card-subtitle { font-size: .62rem; }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<main class="mdl-page" data-mdl-page>
    <section class="mdl-container mdl-browser" aria-label="Daftar Maulid Ad-Diba'i">
        <p class="mdl-results-meta" aria-live="polite">
            <span data-mdl-count><?= count($maulid_list); ?></span> bagian
        </p>

        <div class="mdl-grid" data-mdl-grid>
            <?php foreach ($maulid_list as $item):
                $display  = !empty($item['name']) ? $item['name'] : (!empty($item['latin']) ? $item['latin'] : 'Bagian ' . $item['number']);
                $subtitle = !empty($item['name']) && !empty($item['latin']) ? $item['latin'] : '';
                $search   = mb_strtolower($item['number'] . ' ' . $item['name'] . ' ' . $item['latin'], 'UTF-8');
            ?>
                <a class="mdl-card" data-mdl-card
                    data-search="<?= htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>"
                    href="<?= base_url('index.php/maulid/' . (int) $item['number']); ?>">
                    <span class="mdl-number"><?= (int) $item['number']; ?></span>
                    <span class="mdl-card-copy">
                        <span class="mdl-card-title"><?= htmlspecialchars($display, ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php if ($subtitle): ?>
                            <span class="mdl-card-subtitle"><?= htmlspecialchars($subtitle, ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endif; ?>
                    </span>
                    <i class="bx bx-chevron-right mdl-card-icon" aria-hidden="true"></i>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="mdl-empty" data-mdl-empty hidden>
            <i class="bx bx-search-alt" aria-hidden="true"></i>
            Tidak ada bagian yang cocok.
        </div>
    </section>
</main>

<script>
(function () {
    var cards = document.querySelectorAll('[data-mdl-card]');
    var empty = document.querySelector('[data-mdl-empty]');
    var count = document.querySelector('[data-mdl-count]');

    function filter(q) {
        q = q.trim().toLowerCase();
        var visible = 0;
        cards.forEach(function (c) {
            var match = !q || c.dataset.search.indexOf(q) !== -1;
            c.hidden = !match;
            if (match) visible++;
        });
        if (count) count.textContent = visible;
        if (empty) empty.hidden = visible > 0;
    }

    var input = document.getElementById('maulSearch');
    if (input) input.addEventListener('input', function () { filter(this.value); });
})();
</script>

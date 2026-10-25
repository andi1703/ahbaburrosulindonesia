<?php
defined('BASEPATH') or exit('No direct script access allowed');
$tahlil_list = $tahlil_list ?? [];
?>
<style>
    body { background: #0b0d0d; }
    .tahlil-page {
        --th-bg: #0b0d0d;
        --th-surface: #191c1b;
        --th-surface-hover: #202523;
        --th-text: #f2f5f4;
        --th-muted: #9aa5a1;
        --th-accent: #e8b84b;
        padding-top: 1rem;

        color: var(--th-text);
        background: var(--th-bg);
    }

    .tahlil-container {
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
    }

    .tahlil-hero {
        position: relative;
        overflow: hidden;
        background-color: #7a5818;
        background-image:
            repeating-linear-gradient(45deg, transparent 0 18px, rgba(255,255,255,.025) 18px 19px),
            repeating-linear-gradient(-45deg, transparent 0 18px, rgba(0,0,0,.035) 18px 19px);
    }

    .tahlil-hero-inner {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(280px, 0.8fr);
        align-items: end;
        gap: 2rem;
        min-height: 225px;
        padding-block: 2.5rem 2.25rem;
    }

    .tahlil-identity {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .tahlil-mark {
        display: grid;
        flex: 0 0 58px;
        width: 58px;
        height: 58px;
        place-items: center;
        border: 1px solid rgba(255,255,255,.35);
        border-radius: 50%;
        color: #fef3d8;
        font-size: 1.75rem;
    }

    .tahlil-eyebrow {
        margin: 0 0 0.15rem;
        color: rgba(255,255,255,.72);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .tahlil-title {
        margin: 0;
        color: #fff;
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .tahlil-subtitle {
        margin: 0.35rem 0 0;
        color: rgba(255,255,255,.76);
        font-size: 0.82rem;
    }

    .tahlil-search-wrap { width: 100%; }

    .tahlil-search {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        min-height: 44px;
        padding: 0 1rem;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 99px;
        background: #171a19;
        color: #fff;
    }

    .tahlil-search i { color: #c4d0cc; font-size: 1rem; }

    .tahlil-search input {
        width: 100%; min-width: 0; border: 0; outline: 0;
        background: transparent; color: #fff; font: inherit; font-size: 0.76rem;
    }

    .tahlil-search input::placeholder { color: #aab4b0; opacity: 1; }

    .tahlil-search-hint {
        margin: 0.45rem 0 0 1rem;
        color: rgba(255,255,255,.62);
        font-size: 0.68rem;
    }

    .tahlil-browser { padding-block: 1.15rem 3.5rem; }

    .tahlil-results-meta {
        min-height: 1.4rem;
        margin-bottom: 0.55rem;
        color: var(--th-muted);
        font-size: 0.69rem;
    }

    .tahlil-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.55rem;
    }

    .tahlil-grid[hidden],
    .tahlil-empty[hidden] { display: none !important; }

    .tahlil-card {
        display: grid;
        grid-template-columns: 48px minmax(0, 1fr) auto;
        align-items: center;
        gap: 0.9rem;
        min-width: 0;
        min-height: 74px;
        padding: 0.8rem 0.9rem;
        border: 1px solid rgba(255,255,255,.055);
        border-radius: 10px;
        background: var(--th-surface);
        color: var(--th-text);
        text-decoration: none;
        transition: background-color 150ms ease, border-color 150ms ease;
    }

    .tahlil-card[hidden] { display: none !important; }

    .tahlil-card:hover,
    .tahlil-card:focus-visible {
        border-color: rgba(232,184,75,.55);
        background: var(--th-surface-hover);
        color: #fff;
    }

    .tahlil-number {
        display: grid;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        place-items: center;
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        background: #2c3230;
        color: var(--th-accent);
        font-size: 0.76rem;
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }

    .tahlil-card-copy { display: block; min-width: 0; overflow: hidden; }

    .tahlil-card-title {
        display: block;
        overflow: hidden;
        color: inherit;
        font-size: 0.92rem;
        font-weight: 700;
        line-height: 1.3;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .tahlil-card-subtitle {
        display: block;
        overflow: hidden;
        margin-top: 0.22rem;
        color: var(--th-muted);
        font-size: 0.72rem;
        line-height: 1.25;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .tahlil-card-icon {
        color: var(--th-accent);
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .tahlil-empty {
        padding: 3.5rem 1rem;
        color: var(--th-muted);
        text-align: center;
    }

    .tahlil-empty i {
        display: block;
        margin-bottom: 0.45rem;
        color: #65716c;
        font-size: 1.75rem;
    }

    @media (max-width: 991.98px) {
        .tahlil-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .tahlil-hero-inner {
            grid-template-columns: minmax(0, 1fr) minmax(250px, 0.9fr);
            gap: 1.25rem;
        }
    }

    @media (max-width: 575.98px) {
        .tahlil-container { width: min(100% - 1.5rem, 1120px); }
        .tahlil-hero-inner {
            grid-template-columns: 1fr;
            gap: 1.35rem;
            min-height: unset;
            padding-block: 1.65rem 1.35rem;
        }
        .tahlil-title { font-size: 1.45rem; }
        .tahlil-mark { flex-basis: 48px; width: 48px; height: 48px; font-size: 1.45rem; }
        .tahlil-search-hint { margin-left: 0.7rem; font-size: 0.62rem; }
        .tahlil-browser { padding-top: 0.8rem; }
        .tahlil-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 0.45rem;
        }
        .tahlil-card { min-height: 66px; padding-inline: 0.75rem; }
        .tahlil-card-title { font-size: 0.85rem; }
        .tahlil-card-subtitle { font-size: 0.67rem; }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<main class="tahlil-page" data-tahlil-page>
    <section class="tahlil-container tahlil-browser" aria-label="Daftar bagian tahlil">
        <p class="tahlil-results-meta" aria-live="polite">
            <span data-tahlil-count><?= count($tahlil_list); ?></span> bagian
        </p>

        <div class="tahlil-grid" data-tahlil-grid>
            <?php foreach ($tahlil_list as $item): ?>
                <?php $search_text = mb_strtolower($item['id'] . ' ' . $item['name'], 'UTF-8'); ?>
                <a class="tahlil-card" data-tahlil-card
                    data-search="<?= htmlspecialchars($search_text, ENT_QUOTES, 'UTF-8'); ?>"
                    href="<?= base_url('index.php/tahlil/' . (int) $item['id']); ?>">
                    <span class="tahlil-number"><?= (int) $item['id']; ?></span>
                    <span class="tahlil-card-copy">
                        <span class="tahlil-card-title"><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="tahlil-card-subtitle"><?= count($item['pasal']); ?> bagian bacaan</span>
                    </span>
                    <i class="bx bx-chevron-right tahlil-card-icon" aria-hidden="true"></i>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="tahlil-empty" data-tahlil-empty hidden>
            <i class="bx bx-search-alt" aria-hidden="true"></i>
            Tidak ada bagian yang cocok.
        </div>
    </section>
</main>

<script>
(function () {
    var input  = document.getElementById('tahlilSearch');
    var cards  = document.querySelectorAll('[data-tahlil-card]');
    var empty  = document.querySelector('[data-tahlil-empty]');
    var count  = document.querySelector('[data-tahlil-count]');
    if (!input) return;

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

    input.addEventListener('input', function () { filter(this.value); });
})();
</script>

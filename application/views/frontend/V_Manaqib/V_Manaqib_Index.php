<?php
defined('BASEPATH') or exit('No direct script access allowed');
$manaqib_list = $manaqib_list ?? [];
?>
<style>
    body { background: #0b0d0d; }
    .mq-page {
        --mq-bg: #0b0d0d;
        --mq-surface: #191c1b;
        --mq-surface-hover: #202523;
        --mq-text: #f2f5f4;
        --mq-muted: #9aa5a1;
        --mq-accent: #e8b84b;
        padding-top: 1rem;

        color: var(--mq-text);
        background: var(--mq-bg);
    }

    .mq-container {
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
    }

    .mq-hero {
        position: relative;
        overflow: hidden;
        background-color: #7a5818;
        background-image:
            repeating-linear-gradient(45deg, transparent 0 18px, rgba(255,255,255,.025) 18px 19px),
            repeating-linear-gradient(-45deg, transparent 0 18px, rgba(0,0,0,.035) 18px 19px);
    }

    .mq-hero-inner {
        display: grid;
        grid-template-columns: minmax(0,1fr) minmax(280px,0.8fr);
        align-items: end;
        gap: 2rem;
        min-height: 225px;
        padding-block: 2.5rem 2.25rem;
    }

    .mq-identity { display: flex; align-items: center; gap: 1rem; }

    .mq-mark {
        display: grid;
        flex: 0 0 58px;
        width: 58px; height: 58px;
        place-items: center;
        border: 1px solid rgba(255,255,255,.35);
        border-radius: 50%;
        color: #fef3d8;
        font-size: 1.75rem;
    }

    .mq-eyebrow {
        margin: 0 0 .15rem;
        color: rgba(255,255,255,.72);
        font-size: .72rem; font-weight: 700;
        text-transform: uppercase;
    }

    .mq-title {
        margin: 0; color: #fff;
        font-size: 1.75rem; font-weight: 800; line-height: 1.2;
    }

    .mq-subtitle { margin: .35rem 0 0; color: rgba(255,255,255,.76); font-size: .82rem; }

    .mq-search-wrap { width: 100%; }

    .mq-search {
        display: flex; align-items: center; gap: .65rem;
        min-height: 44px; padding: 0 1rem;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 99px; background: #171a19; color: #fff;
    }

    .mq-search i { color: #c4d0cc; font-size: 1rem; }

    .mq-search input {
        width: 100%; min-width: 0; border: 0; outline: 0;
        background: transparent; color: #fff; font: inherit; font-size: .76rem;
    }

    .mq-search input::placeholder { color: #aab4b0; opacity: 1; }

    .mq-search-hint { margin: .45rem 0 0 1rem; color: rgba(255,255,255,.62); font-size: .68rem; }

    .mq-browser { padding-block: 1.15rem 3.5rem; }

    .mq-results-meta { min-height: 1.4rem; margin-bottom: .55rem; color: var(--mq-muted); font-size: .69rem; }

    .mq-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0,1fr));
        gap: .55rem;
    }

    .mq-empty[hidden] { display: none !important; }

    .mq-card {
        display: grid;
        grid-template-columns: 30px minmax(0,1fr) auto;
        align-items: center;
        gap: .65rem;
        min-height: 68px;
        padding: .7rem .75rem;
        border: 1px solid rgba(255,255,255,.035);
        border-radius: 8px;
        background: var(--mq-surface);
        color: var(--mq-text);
        text-decoration: none;
        transition: background-color 150ms ease, border-color 150ms ease;
    }

    .mq-card[hidden] { display: none !important; }

    .mq-card:hover, .mq-card:focus-visible {
        border-color: rgba(232,184,75,.5);
        background: var(--mq-surface-hover);
        color: #fff;
    }

    .mq-number {
        display: grid; width: 30px; height: 30px;
        place-items: center; border-radius: 6px;
        background: #282c2a; color: #e3e8e5;
        font-size: .68rem; font-weight: 700;
    }

    .mq-card-copy { display: block; min-width: 0; overflow: hidden; }

    .mq-card-title {
        display: block; overflow: hidden; color: inherit;
        font-size: .73rem; font-weight: 700; line-height: 1.3;
        text-overflow: ellipsis; white-space: nowrap;
    }

    .mq-card-subtitle {
        display: block; overflow: hidden; margin-top: .12rem;
        color: var(--mq-muted); font-size: .58rem;
        line-height: 1.4; text-overflow: ellipsis; white-space: nowrap;
    }

    .mq-card-icon { color: var(--mq-accent); font-size: 1.1rem; flex-shrink: 0; }

    .mq-empty { padding: 3.5rem 1rem; color: var(--mq-muted); text-align: center; }
    .mq-empty i { display: block; margin-bottom: .45rem; color: #65716c; font-size: 1.75rem; }

    @media (max-width: 991.98px) {
        .mq-grid { grid-template-columns: repeat(2, minmax(0,1fr)); }
        .mq-hero-inner { grid-template-columns: minmax(0,1fr) minmax(250px,.9fr); gap: 1.25rem; }
    }

    @media (max-width: 575.98px) {
        .mq-container { width: min(100% - 1.5rem, 1120px); }
        .mq-hero-inner { grid-template-columns: 1fr; gap: 1.35rem; min-height: unset; padding-block: 1.65rem 1.35rem; }
        .mq-title { font-size: 1.45rem; }
        .mq-mark { flex-basis: 48px; width: 48px; height: 48px; font-size: 1.45rem; }
        .mq-search-hint { margin-left: .7rem; font-size: .62rem; }
        .mq-browser { padding-top: .8rem; }
        .mq-grid { grid-template-columns: minmax(0,1fr); gap: .45rem; }
        .mq-card { min-height: 62px; padding-inline: .7rem; }
        .mq-card-title { font-size: .78rem; }
        .mq-card-subtitle { font-size: .62rem; }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<main class="mq-page" data-mq-page>
    <section class="mq-container mq-browser" aria-label="Daftar bab Manaqib">
        <p class="mq-results-meta" aria-live="polite">
            <span data-mq-count><?= count($manaqib_list); ?></span> bab
        </p>

        <div class="mq-grid" data-mq-grid>
            <?php foreach ($manaqib_list as $item): ?>
                <?php $search_text = mb_strtolower($item['seq'] . ' ' . $item['name'], 'UTF-8'); ?>
                <a class="mq-card" data-mq-card
                    data-search="<?= htmlspecialchars($search_text, ENT_QUOTES, 'UTF-8'); ?>"
                    href="<?= base_url('index.php/manaqib/' . (int) $item['seq']); ?>">
                    <span class="mq-number"><?= (int) $item['seq']; ?></span>
                    <span class="mq-card-copy">
                        <span class="mq-card-title"><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="mq-card-subtitle"><?= count($item['jawahirulmaani']); ?> bacaan</span>
                    </span>
                    <i class="bx bx-chevron-right mq-card-icon" aria-hidden="true"></i>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="mq-empty" data-mq-empty hidden>
            <i class="bx bx-search-alt" aria-hidden="true"></i>
            Tidak ada bab yang cocok.
        </div>
    </section>
</main>

<script>
(function () {
    var input = document.getElementById('maqSearch');
    var cards = document.querySelectorAll('[data-mq-card]');
    var empty = document.querySelector('[data-mq-empty]');
    var count = document.querySelector('[data-mq-count]');
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

<?php
defined('BASEPATH') or exit('No direct script access allowed');
$burdah_list = $burdah_list ?? [];
?>
<style>
    body {
        background: #0b0d0d;
    }

    .burdah-page {
        --bh-bg: #0b0d0d;
        --bh-surface: #191c1b;
        --bh-surface-hover: #202523;
        --bh-text: #f2f5f4;
        --bh-muted: #9aa5a1;
        --bh-accent: #e8b84b;
        padding-top: 1rem;

        color: var(--bh-text);
        background: var(--bh-bg);
    }

    .burdah-container {
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
    }

    .burdah-hero {
        position: relative;
        overflow: hidden;
        background-color: #7a5818;
        background-image:
            repeating-linear-gradient(45deg, transparent 0 18px, rgba(255, 255, 255, .025) 18px 19px),
            repeating-linear-gradient(-45deg, transparent 0 18px, rgba(0, 0, 0, .035) 18px 19px);
    }

    .burdah-hero-inner {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(280px, 0.8fr);
        align-items: end;
        gap: 2rem;
        min-height: 225px;
        padding-block: 2.5rem 2.25rem;
    }

    .burdah-identity {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .burdah-mark {
        display: grid;
        flex: 0 0 58px;
        width: 58px;
        height: 58px;
        place-items: center;
        border: 1px solid rgba(255, 255, 255, .35);
        border-radius: 50%;
        color: #fef3d8;
        font-size: 1.75rem;
    }

    .burdah-eyebrow {
        margin: 0 0 0.15rem;
        color: rgba(255, 255, 255, .72);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .burdah-title {
        margin: 0;
        color: #fff;
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .burdah-subtitle {
        margin: 0.35rem 0 0;
        color: rgba(255, 255, 255, .76);
        font-size: 0.82rem;
    }

    .burdah-search-wrap {
        width: 100%;
    }

    .burdah-search {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        min-height: 44px;
        padding: 0 1rem;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 99px;
        background: #171a19;
        color: #fff;
    }

    .burdah-search i {
        color: #c4d0cc;
        font-size: 1rem;
    }

    .burdah-search input {
        width: 100%;
        min-width: 0;
        border: 0;
        outline: 0;
        background: transparent;
        color: #fff;
        font: inherit;
        font-size: 0.76rem;
    }

    .burdah-search input::placeholder {
        color: #aab4b0;
        opacity: 1;
    }

    .burdah-search-hint {
        margin: 0.45rem 0 0 1rem;
        color: rgba(255, 255, 255, .62);
        font-size: 0.68rem;
    }

    .burdah-browser {
        padding-block: 1.15rem 3.5rem;
    }

    .burdah-results-meta {
        min-height: 1.4rem;
        margin-bottom: 0.55rem;
        color: var(--bh-muted);
        font-size: 0.69rem;
    }

    .burdah-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.55rem;
    }

    .burdah-empty[hidden] {
        display: none !important;
    }

    .burdah-card {
        display: grid;
        grid-template-columns: 48px minmax(0, 1fr) auto;
        align-items: center;
        gap: 0.9rem;
        min-height: 74px;
        padding: 0.8rem 0.9rem;
        border: 1px solid rgba(255, 255, 255, .055);
        border-radius: 10px;
        background: var(--bh-surface);
        color: var(--bh-text);
        text-decoration: none;
        transition: background-color 150ms ease, border-color 150ms ease;
    }

    .burdah-card[hidden] {
        display: none !important;
    }

    .burdah-card:hover,
    .burdah-card:focus-visible {
        border-color: rgba(232, 184, 75, .55);
        background: var(--bh-surface-hover);
        color: #fff;
    }

    .burdah-number {
        display: grid;
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        place-items: center;
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        background: #2c3230;
        color: var(--bh-accent);
        font-size: 0.76rem;
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }

    .burdah-card-copy {
        display: block;
        min-width: 0;
        overflow: hidden;
    }

    .burdah-card-title {
        display: block;
        overflow: hidden;
        color: inherit;
        font-size: 0.92rem;
        font-weight: 700;
        line-height: 1.3;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .burdah-card-subtitle {
        display: block;
        overflow: hidden;
        margin-top: 0.22rem;
        color: var(--bh-muted);
        font-size: 0.72rem;
        line-height: 1.25;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .burdah-card-arabic {
        color: var(--bh-accent);
        direction: rtl;
        font-family: "Amiri", serif;
        font-size: 1.35rem;
        line-height: 1;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .burdah-empty {
        padding: 3.5rem 1rem;
        color: var(--bh-muted);
        text-align: center;
    }

    .burdah-empty i {
        display: block;
        margin-bottom: 0.45rem;
        color: #65716c;
        font-size: 1.75rem;
    }

    @media (max-width: 991.98px) {
        .burdah-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .burdah-hero-inner {
            grid-template-columns: minmax(0, 1fr) minmax(250px, 0.9fr);
            gap: 1.25rem;
        }
    }

    @media (max-width: 575.98px) {
        .burdah-container {
            width: min(100% - 1.5rem, 1120px);
        }

        .burdah-hero-inner {
            grid-template-columns: 1fr;
            gap: 1.35rem;
            min-height: unset;
            padding-block: 1.65rem 1.35rem;
        }

        .burdah-title {
            font-size: 1.45rem;
        }

        .burdah-mark {
            flex-basis: 48px;
            width: 48px;
            height: 48px;
            font-size: 1.45rem;
        }

        .burdah-search-hint {
            margin-left: 0.7rem;
            font-size: 0.62rem;
        }

        .burdah-browser {
            padding-top: 0.8rem;
        }

        .burdah-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 0.45rem;
        }

        .burdah-card {
            min-height: 66px;
            padding-inline: 0.75rem;
        }

        .burdah-card-title {
            font-size: 0.85rem;
        }

        .burdah-card-subtitle {
            font-size: 0.67rem;
        }

        .burdah-card-arabic {
            font-size: 1.15rem;
        }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<main class="burdah-page" data-burdah-page>
    <section class="burdah-container burdah-browser" aria-label="Daftar pasal Burdah Al Madih">
        <p class="burdah-results-meta" aria-live="polite">
            <span data-burdah-count><?= count($burdah_list); ?></span> pasal
        </p>

        <div class="burdah-grid" data-burdah-grid>
            <?php foreach ($burdah_list as $item): ?>
                <?php $search_text = mb_strtolower($item['id'] . ' ' . $item['name'] . ' ' . $item['tentang'] . ' ' . $item['terjemah'], 'UTF-8'); ?>
                <a class="burdah-card" data-burdah-card
                    data-search="<?= htmlspecialchars($search_text, ENT_QUOTES, 'UTF-8'); ?>"
                    href="<?= base_url('index.php/burdah/' . (int) $item['id']); ?>">
                    <span class="burdah-number"><?= (int) $item['id']; ?></span>
                    <span class="burdah-card-copy">
                        <span class="burdah-card-title"><?= htmlspecialchars($item['tentang'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="burdah-card-subtitle"><?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?> · <?= count($item['syairburdah']); ?> syair</span>
                    </span>
                    <span class="burdah-card-arabic" lang="ar" dir="rtl"><?= htmlspecialchars($item['pasal'], ENT_QUOTES, 'UTF-8'); ?></span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="burdah-empty" data-burdah-empty hidden>
            <i class="bx bx-search-alt" aria-hidden="true"></i>
            Tidak ada pasal yang cocok.
        </div>
    </section>
</main>

<script>
    (function() {
        var input = document.getElementById('burdahSearch');
        var cards = document.querySelectorAll('[data-burdah-card]');
        var empty = document.querySelector('[data-burdah-empty]');
        var count = document.querySelector('[data-burdah-count]');
        if (!input) return;

        function filter(q) {
            q = q.trim().toLowerCase();
            var visible = 0;
            cards.forEach(function(c) {
                var match = !q || c.dataset.search.indexOf(q) !== -1;
                c.hidden = !match;
                if (match) visible++;
            });
            if (count) count.textContent = visible;
            if (empty) empty.hidden = visible > 0;
        }

        input.addEventListener('input', function() {
            filter(this.value);
        });
    })();
</script>
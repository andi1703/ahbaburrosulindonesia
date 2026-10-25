<?php
defined('BASEPATH') or exit('No direct script access allowed');

$sh_group       = $sh_group       ?? 'nasyid';
$sh_group_title = $sh_group_title ?? 'Nasyid';
$sh_slug        = $sh_slug        ?? '';
$sh_name        = $sh_name        ?? '';
$sh_latin       = $sh_latin       ?? '';
$sh_texts       = $sh_texts       ?? [];
$sh_trans       = $sh_trans       ?? [];
$sh_total       = $sh_total       ?? 0;
$sh_pos         = $sh_pos         ?? 1;
$prev_url       = $prev_url       ?? null;
$next_url       = $next_url       ?? null;
$prev_latin     = $prev_latin     ?? null;
$next_latin     = $next_latin     ?? null;
$sh_all_list    = $sh_all_list    ?? [];
?>
<style>
    body {
        background: #0b0d0d;
    }

    @font-face {
        font-family: "LPMQ";
        src: url("<?= base_url('assets/frontend/fonts/LPMQ.ttf'); ?>") format("truetype");
        font-weight: 400;
        font-display: swap;
    }

    :root {
        --shr-bg: #0b0d0d;
        --shr-surf: #131615;
        --shr-border: rgba(255, 255, 255, .07);
        --shr-text: #eef1ee;
        --shr-muted: #6d7e78;
        --shr-accent: #e8b84b;
        --shr-nav: 62px;
        --shr-sub: 48px;
    }

    .shr-page {
        padding-top: calc(var(--shr-nav) + var(--shr-sub));
        padding-bottom: 5rem;
        background: var(--shr-bg);
        color: var(--shr-text);
    }

    /* ── Sub-nav ── */
    .shr-subnav {
        position: fixed;
        top: var(--an-hdr-h, 62px);
        transition: top .32s ease;
        left: 0;
        right: 0;
        z-index: 120;
        height: var(--shr-sub);
        display: flex;
        align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
    }

    .shr-subnav-inner {
        display: flex;
        align-items: center;
        gap: .5rem;
        width: 100%;
        max-width: 860px;
        margin-inline: auto;
        padding-inline: 1rem;
    }

    .shr-subnav-left {
        flex-shrink: 0;
    }

    .shr-subnav-center {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        overflow-x: auto;
        scrollbar-width: none;
        min-width: 0;
    }

    .shr-subnav-center::-webkit-scrollbar {
        display: none;
    }

    .shr-subnav-right {
        flex-shrink: 0;
    }

    .shr-pill {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        height: 34px;
        padding: 0 .85rem;
        border: 1.5px solid rgba(255, 255, 255, .12);
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

    .shr-pill:hover {
        border-color: var(--shr-accent);
        color: var(--shr-accent);
    }

    .shr-pill.is-active {
        border-color: var(--shr-accent);
        background: rgba(232, 184, 75, .08);
        color: var(--shr-accent);
        font-weight: 600;
    }

    .shr-arrow {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        height: 34px;
        padding: 0 .65rem;
        border: 1.5px solid rgba(255, 255, 255, .12);
        border-radius: 8px;
        background: #1a1d1c;
        color: #a8b5b0;
        font: inherit;
        font-size: .73rem;
        text-decoration: none;
        white-space: nowrap;
        flex-shrink: 0;
        transition: border-color .14s, color .14s;
    }

    .shr-arrow i {
        font-size: 1.15rem;
    }

    .shr-arrow:hover {
        border-color: var(--shr-accent);
        color: var(--shr-accent);
    }

    .shr-arrow[aria-disabled="true"] {
        opacity: .25;
        pointer-events: none;
    }

    /* ── Content ── */
    .shr-body {
        width: min(100% - 2rem, 820px);
        margin-inline: auto;
    }

    /* ── Header ── */
    .shr-hdr {
        padding: 2.25rem 0 1.65rem;
        text-align: center;
        border-bottom: 1px solid var(--shr-border);
    }

    .shr-hdr-meta {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .28rem .9rem;
        border-radius: 99px;
        background: rgba(255, 255, 255, .05);
        color: var(--shr-muted);
        font-size: .68rem;
        margin-bottom: 1.1rem;
    }

    .shr-hdr-icon {
        display: grid;
        width: 54px;
        height: 54px;
        margin: 0 auto .9rem;
        place-items: center;
        border-radius: 14px;
        background: rgba(232, 184, 75, .12);
        color: var(--shr-accent);
        font-size: 1.6rem;
    }

    .shr-hdr-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        line-height: 1.6;
        color: #fff;
        direction: rtl;
        text-align: center;
        margin-bottom: .35rem;
    }

    .shr-hdr-latin {
        margin: 0;
        font-size: .82rem;
        color: var(--shr-muted);
        font-style: italic;
    }

    /* ── Verses ── */
    .shr-verses {
        padding: 1.5rem 0;
    }

    .shr-verse {
        padding: 1.1rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, .04);
    }

    .shr-verse:last-child {
        border-bottom: none;
    }

    .shr-verse-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        line-height: 2.1;
        color: #fff;
        direction: rtl;
        text-align: right;
        white-space: pre-line;
        margin-bottom: .45rem;
    }

    .shr-verse-latin {
        display: block;
        font-size: .77rem;
        color: #8aa09a;
        font-style: italic;
        line-height: 2.1;
        margin-bottom: .3rem;
    }

    .shr-verse-id {
        display: block;
        font-size: .72rem;
        color: var(--shr-muted);
        line-height: 2.1;
        padding: .45rem .75rem;
        border-left: 2px solid rgba(232, 184, 75, .3);
        background: rgba(255, 255, 255, .018);
        border-radius: 0 6px 6px 0;
    }

    /* ── Footer nav ── */
    .shr-fnav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 2rem 0 1rem;
        border-top: 1px solid var(--shr-border);
        margin-top: .5rem;
    }

    .shr-fnav-btn {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        min-height: 40px;
        padding: 0 1.2rem;
        border: 1.5px solid rgba(255, 255, 255, .1);
        border-radius: 99px;
        background: var(--shr-surf);
        color: var(--shr-text);
        font: inherit;
        font-size: .78rem;
        text-decoration: none;
        transition: border-color 150ms, background 150ms, color 150ms;
    }

    .shr-fnav-btn:hover {
        border-color: rgba(232, 184, 75, .55);
        background: #1a1c1b;
        color: var(--shr-accent);
    }

    .shr-fnav-btn[aria-disabled="true"] {
        opacity: .3;
        pointer-events: none;
    }

    .shr-fnav-label {
        display: none;
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    @media (min-width: 480px) {
        .shr-fnav-label {
            display: inline;
        }
    }

    @media (max-width: 575.98px) {
        .shr-verse-arab {
            font-size: clamp(1.6rem, 4vw, 2.2rem);
            line-height: 2.1;
        }

        .shr-hdr {
            padding-block: 1.5rem 1.25rem;
        }

        .shr-hdr-arab {
            font-size: 1.4rem;
        }
    }

    /* ── Nav Dropdown Panel ── */
    .rdr-nav-trigger .rdr-chev {
        font-size: .85rem;
        margin-left: .15rem;
        transition: transform .15s;
    }

    .rdr-nav-trigger[aria-expanded="true"] .rdr-chev {
        transform: rotate(180deg);
    }

    .rdr-panel {
        position: fixed; bottom: 0; left: 0; right: 0; z-index: 400;
        display: flex; flex-direction: column;
        max-height: 85vh;
        background: #1a1d1c;
        border-radius: 20px 20px 0 0;
        box-shadow: 0 -4px 40px rgba(0,0,0,.6);
        transform: translateY(100%);
        transition: transform .28s cubic-bezier(.32,.72,0,1);
        overflow: hidden;
    }
    .rdr-panel.is-open { transform: translateY(0); }
    .rdr-panel-handle {
        display: flex; justify-content: center;
        padding: .7rem 0 .35rem; flex-shrink: 0; cursor: grab;
    }
    .rdr-panel-handle span {
        width: 38px; height: 4px; border-radius: 99px;
        background: rgba(255,255,255,.18);
    }
    .rdr-panel-search {
        display: flex; align-items: center; gap: .55rem;
        padding: .5rem 1rem .75rem; border-bottom: 1px solid rgba(255,255,255,.07);
        flex-shrink: 0;
    }
    .rdr-panel-search i { color: #6d7e78; font-size: 1.1rem; }
    .rdr-panel-search input {
        flex: 1; background: transparent; border: 0;
        color: #eef1ee; font: inherit; font-size: .88rem; outline: none;
    }
    .rdr-panel-search input::placeholder { color: #6d7e78; }
    .rdr-panel-list {
        flex: 1; overflow-y: auto; margin: 0; padding: .35rem 0 1.5rem;
        list-style: none; scrollbar-width: thin;
        scrollbar-color: rgba(255,255,255,.12) transparent;
    }
    .rdr-panel-item a {
        display: flex; align-items: center; justify-content: space-between;
        width: 100%; padding: .65rem 1rem;
        background: transparent; color: #c4cec9;
        font: inherit; font-size: .88rem;
        text-decoration: none; transition: background .1s, color .1s;
    }
    .rdr-panel-item a:hover { background: rgba(255,255,255,.06); color: #fff; }
    .rdr-panel-item.is-active a { color: #e8b84b; font-weight: 600; background: rgba(232,184,75,.07); }
    .rdr-panel-item.is-hidden { display: none; }
    .rdr-panel-item a i { color: #e8b84b; font-size: 1rem; }
    .rdr-panel-back {
        display: none; position: fixed; inset: 0; z-index: 399;
        background: rgba(0,0,0,.5);
    }
    .rdr-panel-back.is-open { display: block; }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<!-- Sub-nav -->
<nav class="shr-subnav" aria-label="Navigasi Sholawat">
    <div class="shr-subnav-inner">
        <div class="shr-subnav-left">
            <a class="shr-pill" href="<?= base_url('index.php/sholawat'); ?>" title="Daftar Sholawat">
                <i class="bx bx-grid-alt"></i>
            </a>
        </div>

        <div class="shr-subnav-center">
            <a class="shr-arrow"
                href="<?= $prev_url ? htmlspecialchars($prev_url) : '#'; ?>"
                <?= $prev_url ? '' : 'aria-disabled="true"'; ?>
                title="<?= $prev_latin ? 'Sebelumnya: ' . htmlspecialchars($prev_latin) : ''; ?>">
                <i class="bx bx-chevron-left"></i>
            </a>

            <button class="shr-pill is-active rdr-nav-trigger" id="rdrNavTrigger" type="button"
                aria-haspopup="true" aria-expanded="false" style="max-width:200px;">
                <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:150px;"><?= htmlspecialchars($sh_latin); ?></span>
                <i class="bx bx-chevron-down rdr-chev"></i>
            </button>

            <a class="shr-arrow"
                href="<?= $next_url ? htmlspecialchars($next_url) : '#'; ?>"
                <?= $next_url ? '' : 'aria-disabled="true"'; ?>
                title="<?= $next_latin ? 'Selanjutnya: ' . htmlspecialchars($next_latin) : ''; ?>">
                <i class="bx bx-chevron-right"></i>
            </a>
        </div>

        <div class="shr-subnav-right">
            <span style="color:#6d7e78; font-size:.68rem; white-space:nowrap;"><?= (int) $sh_pos; ?> / <?= (int) $sh_total; ?></span>
        </div>
    </div>
</nav>

<div class="rdr-panel-back" id="rdrPanelBack"></div>
<div class="rdr-panel" id="rdrPanel" aria-hidden="true">
    <div class="rdr-panel-handle"><span></span></div>
    <div class="rdr-panel-search">
        <i class="bx bx-search"></i>
        <input type="search" id="rdrPanelSearch" placeholder="Cari sholawat..." autocomplete="off">
    </div>
    <ul class="rdr-panel-list">
        <?php foreach ($sh_all_list as $i => $s): ?>
            <li class="rdr-panel-item <?= $s['slug'] === $sh_slug ? 'is-active' : ''; ?>"
                data-search="<?= htmlspecialchars(strtolower($s['latin']), ENT_QUOTES); ?>">
                <a href="<?= base_url('index.php/sholawat/' . $sh_group . '/' . rawurlencode($s['slug'])); ?>">
                    <span><?= ($i + 1) . '. ' . htmlspecialchars($s['latin']); ?></span>
                    <?php if ($s['slug'] === $sh_slug): ?><i class="bx bx-check"></i><?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<main class="shr-page" data-shr-page>
    <div class="shr-body">

        <!-- Header -->
        <header class="shr-hdr">
            <span class="shr-hdr-meta">
                <span><?= htmlspecialchars($sh_group_title); ?></span>
                <span style="opacity:.4;">·</span>
                <span>Sholawat</span>
            </span>

            <span class="shr-hdr-icon" aria-hidden="true">
                <img src="<?= base_url('assets/frontend/icons/islamic/takbir-hands.svg'); ?>" style="width:28px;height:28px;display:block;filter:brightness(0) invert(1);" alt="">
            </span>

            <?php if (!empty($sh_name)): ?>
                <span class="shr-hdr-arab" lang="ar" dir="rtl"><?= htmlspecialchars($sh_name, ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
            <p class="shr-hdr-latin"><?= htmlspecialchars($sh_latin, ENT_QUOTES, 'UTF-8'); ?></p>
        </header>

        <!-- Verses -->
        <div class="shr-verses">
            <?php foreach ($sh_texts as $key => $item):
                $arabic  = $item['arabic'] ?? '';
                $latin   = $item['latin']  ?? '';
                $id_text = $sh_trans[$key] ?? '';
            ?>
                <div class="shr-verse">
                    <?php if (!empty($arabic)): ?>
                        <span class="shr-verse-arab" lang="ar" dir="rtl"><?= htmlspecialchars($arabic, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($latin)): ?>
                        <span class="shr-verse-latin"><?= htmlspecialchars($latin, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>
                    <?php if (!empty($id_text)): ?>
                        <span class="shr-verse-id"><?= htmlspecialchars($id_text, ENT_QUOTES, 'UTF-8'); ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Footer nav -->
        <nav class="shr-fnav" aria-label="Navigasi antar sholawat">
            <a class="shr-fnav-btn"
                href="<?= $prev_url ? htmlspecialchars($prev_url) : '#'; ?>"
                <?= $prev_url ? '' : 'aria-disabled="true"'; ?>>
                <i class="bx bx-chevron-left"></i>
                <span class="shr-fnav-label"><?= $prev_latin ? htmlspecialchars($prev_latin) : 'Sebelumnya'; ?></span>
            </a>

            <a class="shr-fnav-btn" href="<?= base_url('index.php/sholawat'); ?>">
                <i class="bx bx-grid-alt"></i>
                <span class="shr-fnav-label">Semua Sholawat</span>
            </a>

            <a class="shr-fnav-btn"
                href="<?= $next_url ? htmlspecialchars($next_url) : '#'; ?>"
                <?= $next_url ? '' : 'aria-disabled="true"'; ?>>
                <span class="shr-fnav-label"><?= $next_latin ? htmlspecialchars($next_latin) : 'Selanjutnya'; ?></span>
                <i class="bx bx-chevron-right"></i>
            </a>
        </nav>

        <?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Banner.php'; ?>
    </div>
</main>
<script>
    (function() {
        var trigger = document.getElementById('rdrNavTrigger');
        var panel = document.getElementById('rdrPanel');
        var back = document.getElementById('rdrPanelBack');
        var search = document.getElementById('rdrPanelSearch');
        if (!trigger || !panel) return;

        function filter(q) {
            q = q.toLowerCase().trim();
            panel.querySelectorAll('.rdr-panel-item').forEach(function(li) {
                var s = (li.dataset.search || '').toLowerCase();
                li.classList.toggle('is-hidden', q !== '' && s.indexOf(q) === -1);
            });
        }

        function close() {
            panel.classList.remove('is-open');
            panel.setAttribute('aria-hidden', 'true');
            trigger.setAttribute('aria-expanded', 'false');
            if (back) back.classList.remove('is-open');
            if (search) { search.value = ''; filter(''); }
        }
        trigger.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!panel.classList.contains('is-open')) {
                panel.classList.add('is-open');
                panel.setAttribute('aria-hidden', 'false');
                trigger.setAttribute('aria-expanded', 'true');
                if (back) back.classList.add('is-open');
                var active = panel.querySelector('.rdr-panel-item.is-active a');
                if (active) setTimeout(function() { active.scrollIntoView({ block: 'nearest' }); }, 30);
                if (search) setTimeout(function() { search.focus(); }, 60);
            } else {
                close();
            }
        });
        if (search) search.addEventListener('input', function() {
            filter(this.value);
        });
        if (back) back.addEventListener('click', close);
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') close();
        });
    })();
</script>
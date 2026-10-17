<?php
defined('BASEPATH') or exit('No direct script access allowed');

$section_id   = $section_id   ?? 1;
$section_name = $section_name ?? 'Burdah Al Madih';
$section_pasal = $section_pasal ?? '';
$section_judul = $section_judul ?? '';
$section_terjemah = $section_terjemah ?? '';
$section_tentang  = $section_tentang  ?? '';
$syair_list   = $syair_list   ?? [];
$total        = $total        ?? 10;
$prev_url     = $prev_url     ?? null;
$next_url     = $next_url     ?? null;
$prev_name    = $prev_name    ?? null;
$next_name    = $next_name    ?? null;
$all_sections = $all_sections ?? [];
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
        --bhr-bg: #0b0d0d;
        --bhr-surf: #131615;
        --bhr-border: rgba(255,255,255,.07);
        --bhr-text: #eef1ee;
        --bhr-muted: #6d7e78;
        --bhr-accent: #e8b84b;
        --bhr-nav: 62px;
        --bhr-sub: 48px;
    }

    .bhr-page {
        min-height: 100vh;
        padding-top: calc(var(--bhr-nav) + var(--bhr-sub));
        padding-bottom: 5rem;
        background: var(--bhr-bg);
        color: var(--bhr-text);
    }

    /* ── Sub-nav ── */
    .bhr-subnav {
        position: fixed;
        top: var(--an-hdr-h, 62px);
        transition: top .32s ease;
        left: 0; right: 0;
        z-index: 120;
        height: var(--bhr-sub);
        display: flex;
        align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }

    .bhr-subnav-inner {
        display: flex;
        align-items: center;
        gap: .5rem;
        width: 100%;
        max-width: 860px;
        margin-inline: auto;
        padding-inline: 1rem;
    }

    .bhr-subnav-left  { flex-shrink: 0; }

    .bhr-subnav-center {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        overflow-x: auto;
        scrollbar-width: none;
        min-width: 0;
    }

    .bhr-subnav-center::-webkit-scrollbar { display: none; }
    .bhr-subnav-right { flex-shrink: 0; }

    .bhr-pill {
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
        cursor: pointer;
        flex-shrink: 0;
        transition: border-color .14s, color .14s, background .14s;
    }

    .bhr-pill:hover { border-color: var(--bhr-accent); color: var(--bhr-accent); }

    .bhr-pill.is-active {
        border-color: var(--bhr-accent);
        background: rgba(232,184,75,.08);
        color: var(--bhr-accent);
        font-weight: 600;
    }

    .bhr-arrow {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        height: 34px;
        padding: 0 .65rem;
        border: 1.5px solid rgba(255,255,255,.12);
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

    .bhr-arrow i { font-size: 1.15rem; flex-shrink: 0; }
    .bhr-arrow:hover { border-color: var(--bhr-accent); color: var(--bhr-accent); }
    .bhr-arrow[aria-disabled="true"] { opacity: .25; pointer-events: none; }

    .bhr-arrow-name {
        display: none;
        max-width: 10rem;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (min-width: 580px) { .bhr-arrow-name { display: inline; } }

    /* ── Content ── */
    .bhr-body {
        width: min(100% - 2rem, 820px);
        margin-inline: auto;
    }

    /* ── Header ── */
    .bhr-hdr {
        padding: 2.25rem 0 1.65rem;
        text-align: center;
        border-bottom: 1px solid var(--bhr-border);
    }

    .bhr-hdr-meta {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .28rem .9rem;
        border-radius: 99px;
        background: rgba(255,255,255,.05);
        color: var(--bhr-muted);
        font-size: .68rem;
        margin-bottom: 1.1rem;
    }

    .bhr-hdr-icon {
        display: grid;
        width: 54px;
        height: 54px;
        margin: 0 auto .9rem;
        place-items: center;
        border-radius: 14px;
        background: rgba(232,184,75,.12);
        color: var(--bhr-accent);
        font-size: 1.6rem;
    }

    .bhr-hdr-pasal {
        display: block;
        font-family: "LPMQ", "Amiri", serif;
        font-size: clamp(1.4rem, 4vw, 2rem);
        line-height: 1.8;
        color: #fef3d8;
        direction: rtl;
        margin-bottom: .35rem;
    }

    .bhr-hdr-judul {
        display: block;
        font-family: "LPMQ", "Amiri", serif;
        font-size: clamp(1rem, 2.5vw, 1.3rem);
        line-height: 1.8;
        color: var(--bhr-muted);
        direction: rtl;
        margin-bottom: .85rem;
    }

    .bhr-hdr-name {
        margin: 0 0 .25rem;
        font-size: clamp(1.1rem, 3vw, 1.45rem);
        font-weight: 800;
        color: #fff;
    }

    .bhr-hdr-terjemah {
        margin: 0;
        font-size: .82rem;
        color: var(--bhr-muted);
        font-style: italic;
    }

    /* ── Syair card ── */
    .bhr-syair {
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--bhr-border);
    }

    .bhr-syair-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 50%;
        background: rgba(232,184,75,.1);
        border: 1px solid rgba(232,184,75,.25);
        color: var(--bhr-accent);
        font-size: .62rem;
        font-weight: 700;
        margin-bottom: .85rem;
    }

    .bhr-syair-arab {
        display: block;
        font-family: "LPMQ", "Amiri", serif;
        font-size: clamp(1.5rem, 4.5vw, 2.1rem);
        line-height: 2.2;
        color: #fff;
        direction: rtl;
        text-align: right;
        white-space: pre-line;
        margin-bottom: 1rem;
    }

    .bhr-syair-latin {
        display: block;
        font-size: .82rem;
        line-height: 1.85;
        color: #a8b5b0;
        white-space: pre-line;
        font-style: italic;
        padding: .65rem .9rem;
        border-left: 2px solid rgba(232,184,75,.35);
        margin-bottom: .75rem;
    }

    .bhr-syair-arti {
        display: block;
        font-size: .82rem;
        line-height: 1.75;
        color: #c8d0cc;
        padding: .55rem .9rem;
        background: rgba(255,255,255,.03);
        border-radius: 6px;
    }

    .bhr-syair-arti-label {
        display: inline-block;
        font-size: .62rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: var(--bhr-muted);
        margin-bottom: .3rem;
    }

    /* ── Footer nav ── */
    .bhr-fnav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 2rem 0 1rem;
        border-top: 1px solid var(--bhr-border);
        margin-top: 1rem;
    }

    .bhr-fnav-btn {
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        min-height: 40px;
        padding: 0 1.2rem;
        border: 1.5px solid rgba(255,255,255,.1);
        border-radius: 99px;
        background: var(--bhr-surf);
        color: var(--bhr-text);
        font: inherit;
        font-size: .78rem;
        text-decoration: none;
        transition: border-color 150ms, background 150ms, color 150ms;
    }

    .bhr-fnav-btn:hover {
        border-color: rgba(232,184,75,.55);
        background: #1a1c1b;
        color: var(--bhr-accent);
    }

    .bhr-fnav-btn[aria-disabled="true"] { opacity: .3; pointer-events: none; }

    .bhr-fnav-label {
        display: none;
        max-width: 140px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    @media (min-width: 480px) { .bhr-fnav-label { display: inline; } }

    .bhr-back {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .28rem .75rem;
        border-radius: 99px;
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.08);
        color: var(--bhr-muted);
        font-size: .68rem;
        text-decoration: none;
        transition: color 140ms, border-color 140ms;
    }

    .bhr-back:hover { color: var(--bhr-accent); border-color: rgba(232,184,75,.4); }

    @media (max-width: 575.98px) {
        .bhr-syair-arab { font-size: 1.45rem; line-height: 2.1; }
        .bhr-hdr { padding-block: 1.5rem 1.25rem; }
    }

    /* ── Nav Dropdown Panel ── */
    .rdr-nav-trigger .rdr-chev { font-size: .85rem; margin-left: .15rem; transition: transform .15s; }
    .rdr-nav-trigger[aria-expanded="true"] .rdr-chev { transform: rotate(180deg); }
    .rdr-panel {
        position: fixed; z-index: 250;
        width: min(340px, 90vw); max-height: min(520px, 70vh);
        display: flex; flex-direction: column;
        background: #1a1d1c; border: 1px solid rgba(255,255,255,.1);
        border-radius: 14px; box-shadow: 0 16px 48px rgba(0,0,0,.75);
        overflow: hidden;
    }
    .rdr-panel[hidden] { display: none; }
    .rdr-panel-list {
        flex: 1; overflow-y: auto; margin: 0; padding: .35rem 0;
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
    .rdr-panel-item a i { color: #e8b84b; font-size: 1rem; }
    .rdr-panel-back { display: none; position: fixed; inset: 0; z-index: 249; }
    .rdr-panel-back.is-open { display: block; }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<!-- Sub-nav -->
<nav class="bhr-subnav" aria-label="Navigasi Burdah Al Madih">
    <div class="bhr-subnav-inner">
        <div class="bhr-subnav-left">
            <a class="bhr-pill" href="<?= base_url('index.php/burdah'); ?>" title="Daftar Pasal">
                <i class="bx bx-grid-alt"></i>
            </a>
        </div>

        <div class="bhr-subnav-center">
            <a class="bhr-arrow"
               href="<?= $prev_url ? htmlspecialchars($prev_url) : '#'; ?>"
               <?= $prev_url ? '' : 'aria-disabled="true"'; ?>
               title="<?= $prev_name ? 'Sebelumnya: ' . htmlspecialchars($prev_name) : ''; ?>">
                <i class="bx bx-chevron-left"></i>
                <span class="bhr-arrow-name"><?= $prev_name ? htmlspecialchars($prev_name) : ''; ?></span>
            </a>

            <button class="bhr-pill is-active rdr-nav-trigger" id="rdrNavTrigger" type="button"
                    aria-haspopup="true" aria-expanded="false" style="max-width:200px;">
                <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:150px;"><?= htmlspecialchars($section_name); ?></span>
                <i class="bx bx-chevron-down rdr-chev"></i>
            </button>

            <a class="bhr-arrow"
               href="<?= $next_url ? htmlspecialchars($next_url) : '#'; ?>"
               <?= $next_url ? '' : 'aria-disabled="true"'; ?>
               title="<?= $next_name ? 'Selanjutnya: ' . htmlspecialchars($next_name) : ''; ?>">
                <span class="bhr-arrow-name"><?= $next_name ? htmlspecialchars($next_name) : ''; ?></span>
                <i class="bx bx-chevron-right"></i>
            </a>
        </div>

        <div class="bhr-subnav-right">
            <span style="color:#6d7e78; font-size:.68rem; white-space:nowrap;"><?= (int)$section_id; ?> / <?= (int)$total; ?></span>
        </div>
    </div>
</nav>

<div class="rdr-panel-back" id="rdrPanelBack"></div>
<div class="rdr-panel" id="rdrPanel" hidden>
    <ul class="rdr-panel-list">
        <?php foreach ($all_sections as $i => $s): ?>
            <li class="rdr-panel-item <?= (int)$s['id'] === (int)$section_id ? 'is-active' : ''; ?>">
                <a href="<?= base_url('index.php/burdah/' . (int)$s['id']); ?>">
                    <span><?= ($i + 1) . '. ' . htmlspecialchars($s['name']); ?><?= !empty($s['tentang']) ? ' — ' . htmlspecialchars($s['tentang']) : ''; ?></span>
                    <?php if ((int)$s['id'] === (int)$section_id): ?><i class="bx bx-check"></i><?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<main class="bhr-page" data-bhr-page>
    <div class="bhr-body">

        <!-- Section header -->
        <header class="bhr-hdr">
            <span class="bhr-hdr-meta">
                <span><?= htmlspecialchars($section_name); ?></span>
                <span style="opacity:.4;">·</span>
                <span><?= count($syair_list); ?> syair</span>
            </span>

            <span class="bhr-hdr-icon" aria-hidden="true">
                <img src="<?= base_url('assets/frontend/icons/islamic/muhammad-calligraphy.svg'); ?>" style="width:28px;height:28px;display:block;filter:brightness(0) invert(1);" alt="">
            </span>

            <?php if ($section_pasal): ?>
                <span class="bhr-hdr-pasal" lang="ar" dir="rtl"><?= htmlspecialchars($section_pasal, ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>

            <?php if ($section_judul): ?>
                <span class="bhr-hdr-judul" lang="ar" dir="rtl"><?= htmlspecialchars($section_judul, ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>

            <h1 class="bhr-hdr-name"><?= htmlspecialchars($section_tentang, ENT_QUOTES, 'UTF-8'); ?></h1>
            <p class="bhr-hdr-terjemah"><?= htmlspecialchars($section_terjemah, ENT_QUOTES, 'UTF-8'); ?></p>
        </header>

        <!-- Syair list -->
        <?php foreach ($syair_list as $idx => $syair): ?>
            <div class="bhr-syair" id="syair-<?= (int)$syair['id']; ?>">
                <span class="bhr-syair-num"><?= $idx + 1; ?></span>

                <span class="bhr-syair-arab" lang="ar" dir="rtl"><?= htmlspecialchars($syair['arab'], ENT_QUOTES, 'UTF-8'); ?></span>

                <?php if (!empty($syair['latin'])): ?>
                    <span class="bhr-syair-latin"><?= htmlspecialchars($syair['latin'], ENT_QUOTES, 'UTF-8'); ?></span>
                <?php endif; ?>

                <?php if (!empty($syair['arti'])): ?>
                    <span class="bhr-syair-arti">
                        <span class="bhr-syair-arti-label">Terjemah</span><br>
                        <?= htmlspecialchars($syair['arti'], ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <!-- Footer nav -->
        <nav class="bhr-fnav" aria-label="Navigasi antar pasal">
            <a class="bhr-fnav-btn"
               href="<?= $prev_url ? htmlspecialchars($prev_url) : '#'; ?>"
               <?= $prev_url ? '' : 'aria-disabled="true"'; ?>>
                <i class="bx bx-chevron-left"></i>
                <span class="bhr-fnav-label"><?= $prev_name ? htmlspecialchars($prev_name) : 'Sebelumnya'; ?></span>
            </a>

            <a class="bhr-fnav-btn" href="<?= base_url('index.php/burdah'); ?>">
                <i class="bx bx-grid-alt"></i>
                <span class="bhr-fnav-label">Semua Pasal</span>
            </a>

            <a class="bhr-fnav-btn"
               href="<?= $next_url ? htmlspecialchars($next_url) : '#'; ?>"
               <?= $next_url ? '' : 'aria-disabled="true"'; ?>>
                <span class="bhr-fnav-label"><?= $next_name ? htmlspecialchars($next_name) : 'Selanjutnya'; ?></span>
                <i class="bx bx-chevron-right"></i>
            </a>
        </nav>

    </div>
</main>
<script>
(function() {
  var trigger = document.getElementById('rdrNavTrigger');
  var panel   = document.getElementById('rdrPanel');
  var back    = document.getElementById('rdrPanelBack');
  if (!trigger || !panel) return;
  function position() {
    var r = trigger.getBoundingClientRect();
    var pw = Math.min(340, window.innerWidth * 0.9);
    var mid = r.left + r.width / 2;
    var left = Math.max(8, Math.min(mid - pw / 2, window.innerWidth - pw - 8));
    panel.style.top  = (r.bottom + 4) + 'px';
    panel.style.left = left + 'px';
    panel.style.width = pw + 'px';
  }
  function close() {
    panel.setAttribute('hidden', '');
    trigger.setAttribute('aria-expanded', 'false');
    if (back) back.classList.remove('is-open');
  }
  trigger.addEventListener('click', function(e) {
    e.stopPropagation();
    if (panel.hasAttribute('hidden')) {
      position();
      panel.removeAttribute('hidden');
      trigger.setAttribute('aria-expanded', 'true');
      if (back) back.classList.add('is-open');
      var active = panel.querySelector('.rdr-panel-item.is-active a');
      if (active) setTimeout(function() { active.scrollIntoView({ block: 'nearest' }); }, 30);
    } else { close(); }
  });
  if (back) back.addEventListener('click', close);
  document.addEventListener('keydown', function(e) { if (e.key === 'Escape') close(); });
})();
</script>

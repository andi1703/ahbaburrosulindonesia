<?php
defined('BASEPATH') or exit('No direct script access allowed');

$section_seq  = $section_seq  ?? 1;
$section_name = $section_name ?? 'Manaqib';
$section_doa  = $section_doa  ?? '';
$bacaan_list  = $bacaan_list  ?? [];
$total        = $total        ?? 13;
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
        --mqr-bg: #0b0d0d;
        --mqr-surf: #131615;
        --mqr-border: rgba(255,255,255,.07);
        --mqr-text: #eef1ee;
        --mqr-muted: #6d7e78;
        --mqr-accent: #e8b84b;
        --mqr-nav: 62px;
        --mqr-sub: 48px;
    }

    .mqr-page {
        min-height: 100vh;
        padding-top: calc(var(--mqr-nav) + var(--mqr-sub));
        padding-bottom: 5rem;
        background: var(--mqr-bg);
        color: var(--mqr-text);
    }

    /* ── Sub-nav ── */
    .mqr-subnav {
        position: fixed;
        top: var(--an-hdr-h, 62px); left: 0; right: 0;
        transition: top .32s ease;
        z-index: 120; height: var(--mqr-sub);
        display: flex; align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }

    .mqr-subnav-inner {
        display: flex; align-items: center; gap: .5rem;
        width: 100%; max-width: 860px;
        margin-inline: auto; padding-inline: 1rem;
    }

    .mqr-subnav-left  { flex-shrink: 0; }

    .mqr-subnav-center {
        flex: 1; display: flex; align-items: center;
        justify-content: center; gap: .35rem;
        overflow-x: auto; scrollbar-width: none; min-width: 0;
    }

    .mqr-subnav-center::-webkit-scrollbar { display: none; }
    .mqr-subnav-right { flex-shrink: 0; }

    .mqr-pill {
        display: inline-flex; align-items: center; gap: .3rem;
        height: 34px; padding: 0 .85rem;
        border: 1.5px solid rgba(255,255,255,.12); border-radius: 8px;
        background: #1a1d1c; color: #a8b5b0;
        font: inherit; font-size: .73rem; white-space: nowrap;
        text-decoration: none; flex-shrink: 0;
        transition: border-color .14s, color .14s, background .14s;
    }

    .mqr-pill:hover { border-color: var(--mqr-accent); color: var(--mqr-accent); }

    .mqr-pill.is-active {
        border-color: var(--mqr-accent);
        background: rgba(232,184,75,.08);
        color: var(--mqr-accent); font-weight: 600;
    }

    .mqr-arrow {
        display: inline-flex; align-items: center; gap: .3rem;
        height: 34px; padding: 0 .65rem;
        border: 1.5px solid rgba(255,255,255,.12); border-radius: 8px;
        background: #1a1d1c; color: #a8b5b0;
        font: inherit; font-size: .73rem; text-decoration: none;
        white-space: nowrap; flex-shrink: 0;
        transition: border-color .14s, color .14s;
    }

    .mqr-arrow i { font-size: 1.15rem; flex-shrink: 0; }
    .mqr-arrow:hover { border-color: var(--mqr-accent); color: var(--mqr-accent); }
    .mqr-arrow[aria-disabled="true"] { opacity: .25; pointer-events: none; }

    .mqr-arrow-name { display: none; max-width: 10rem; overflow: hidden; text-overflow: ellipsis; }
    @media (min-width: 580px) { .mqr-arrow-name { display: inline; } }

    /* ── Content ── */
    .mqr-body { width: min(100% - 2rem, 820px); margin-inline: auto; }

    /* ── Header ── */
    .mqr-hdr {
        padding: 2.25rem 0 1.65rem;
        text-align: center;
        border-bottom: 1px solid var(--mqr-border);
    }

    .mqr-hdr-meta {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .28rem .9rem; border-radius: 99px;
        background: rgba(255,255,255,.05); color: var(--mqr-muted);
        font-size: .68rem; margin-bottom: 1.1rem;
    }

    .mqr-hdr-icon {
        display: grid; width: 54px; height: 54px;
        margin: 0 auto .9rem; place-items: center;
        border-radius: 14px;
        background: rgba(232,184,75,.12); color: var(--mqr-accent);
        font-size: 1.6rem;
    }

    .mqr-hdr-name {
        margin: 0 0 .25rem;
        font-size: clamp(1.25rem, 3.5vw, 1.65rem);
        font-weight: 800; color: #fff;
    }

    .mqr-hdr-doa {
        display: block;
        font-family: "LPMQ", "Amiri", serif;
        font-size: clamp(1.1rem, 3vw, 1.5rem);
        line-height: 2.1; color: #b8d4cc;
        direction: rtl; text-align: center;
        white-space: pre-line;
        margin-top: 1rem;
        padding: .85rem 1rem;
        border-top: 1px solid var(--mqr-border);
    }

    /* ── Bacaan ── */
    .mqr-bacaan {
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--mqr-border);
    }

    .mqr-bacaan-num {
        display: inline-flex; align-items: center; justify-content: center;
        width: 26px; height: 26px; border-radius: 50%;
        background: rgba(232,184,75,.1);
        border: 1px solid rgba(232,184,75,.25);
        color: var(--mqr-accent); font-size: .62rem; font-weight: 700;
        margin-bottom: .85rem;
    }

    .mqr-bacaan-arab {
        display: block;
        font-family: "LPMQ", "Amiri", serif;
        font-size: clamp(1.45rem, 4vw, 2rem);
        line-height: 2.2; color: #fff;
        direction: rtl; text-align: right;
        white-space: pre-line;
    }

    /* ── Footer nav ── */
    .mqr-fnav {
        display: flex; align-items: center;
        justify-content: space-between; gap: 1rem;
        padding: 2rem 0 1rem;
        border-top: 1px solid var(--mqr-border);
        margin-top: 1rem;
    }

    .mqr-fnav-btn {
        display: inline-flex; align-items: center; gap: .45rem;
        min-height: 40px; padding: 0 1.2rem;
        border: 1.5px solid rgba(255,255,255,.1); border-radius: 99px;
        background: var(--mqr-surf); color: var(--mqr-text);
        font: inherit; font-size: .78rem; text-decoration: none;
        transition: border-color 150ms, background 150ms, color 150ms;
    }

    .mqr-fnav-btn:hover {
        border-color: rgba(232,184,75,.55);
        background: #1a1c1b; color: var(--mqr-accent);
    }

    .mqr-fnav-btn[aria-disabled="true"] { opacity: .3; pointer-events: none; }

    .mqr-fnav-label {
        display: none; max-width: 140px;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }

    @media (min-width: 480px) { .mqr-fnav-label { display: inline; } }

    .mqr-back {
        display: inline-flex; align-items: center; gap: .3rem;
        padding: .28rem .75rem; border-radius: 99px;
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.08);
        color: var(--mqr-muted); font-size: .68rem; text-decoration: none;
        transition: color 140ms, border-color 140ms;
    }

    .mqr-back:hover { color: var(--mqr-accent); border-color: rgba(232,184,75,.4); }

    @media (max-width: 575.98px) {
        .mqr-bacaan-arab { font-size: 1.35rem; line-height: 2.1; }
        .mqr-hdr { padding-block: 1.5rem 1.25rem; }
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
<nav class="mqr-subnav" aria-label="Navigasi Manaqib">
    <div class="mqr-subnav-inner">
        <div class="mqr-subnav-left">
            <a class="mqr-pill" href="<?= base_url('index.php/manaqib'); ?>" title="Daftar Bab">
                <i class="bx bx-grid-alt"></i>
            </a>
        </div>

        <div class="mqr-subnav-center">
            <a class="mqr-arrow"
               href="<?= $prev_url ? htmlspecialchars($prev_url) : '#'; ?>"
               <?= $prev_url ? '' : 'aria-disabled="true"'; ?>
               title="<?= $prev_name ? 'Sebelumnya: ' . htmlspecialchars($prev_name) : ''; ?>">
                <i class="bx bx-chevron-left"></i>
                <span class="mqr-arrow-name"><?= $prev_name ? htmlspecialchars($prev_name) : ''; ?></span>
            </a>

            <button class="mqr-pill is-active rdr-nav-trigger" id="rdrNavTrigger" type="button"
                    aria-haspopup="true" aria-expanded="false" style="max-width:200px;">
                <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:150px;"><?= htmlspecialchars($section_name); ?></span>
                <i class="bx bx-chevron-down rdr-chev"></i>
            </button>

            <a class="mqr-arrow"
               href="<?= $next_url ? htmlspecialchars($next_url) : '#'; ?>"
               <?= $next_url ? '' : 'aria-disabled="true"'; ?>
               title="<?= $next_name ? 'Selanjutnya: ' . htmlspecialchars($next_name) : ''; ?>">
                <span class="mqr-arrow-name"><?= $next_name ? htmlspecialchars($next_name) : ''; ?></span>
                <i class="bx bx-chevron-right"></i>
            </a>
        </div>

        <div class="mqr-subnav-right">
            <span style="color:#6d7e78; font-size:.68rem; white-space:nowrap;"><?= (int)$section_seq; ?> / <?= (int)$total; ?></span>
        </div>
    </div>
</nav>

<div class="rdr-panel-back" id="rdrPanelBack"></div>
<div class="rdr-panel" id="rdrPanel" hidden>
    <ul class="rdr-panel-list">
        <?php foreach ($all_sections as $s): ?>
            <li class="rdr-panel-item <?= (int)$s['seq'] === (int)$section_seq ? 'is-active' : ''; ?>">
                <a href="<?= base_url('index.php/manaqib/' . (int)$s['seq']); ?>">
                    <span><?= (int)$s['seq'] . '. ' . htmlspecialchars($s['name']); ?></span>
                    <?php if ((int)$s['seq'] === (int)$section_seq): ?><i class="bx bx-check"></i><?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<main class="mqr-page" data-mqr-page>
    <div class="mqr-body">

        <!-- Header -->
        <header class="mqr-hdr">
            <span class="mqr-hdr-meta">
                <span>Bab <?= (int)$section_seq; ?></span>
                <span style="opacity:.4;">·</span>
                <span><?= count($bacaan_list); ?> bacaan</span>
            </span>

            <span class="mqr-hdr-icon" aria-hidden="true">
                <img src="<?= base_url('assets/frontend/icons/islamic/mosque-dome.svg'); ?>" style="width:28px;height:28px;display:block;filter:brightness(0) invert(1);" alt="">
            </span>

            <h1 class="mqr-hdr-name"><?= htmlspecialchars($section_name, ENT_QUOTES, 'UTF-8'); ?></h1>

            <?php if (!empty(trim($section_doa))): ?>
                <span class="mqr-hdr-doa" lang="ar" dir="rtl"><?= htmlspecialchars(trim($section_doa), ENT_QUOTES, 'UTF-8'); ?></span>
            <?php endif; ?>
        </header>

        <!-- Bacaan list -->
        <?php foreach ($bacaan_list as $idx => $bacaan): ?>
            <div class="mqr-bacaan" id="bacaan-<?= $idx + 1; ?>">
                <span class="mqr-bacaan-num"><?= $idx + 1; ?></span>
                <span class="mqr-bacaan-arab" lang="ar" dir="rtl"><?= htmlspecialchars($bacaan['arab'], ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
        <?php endforeach; ?>

        <!-- Footer nav -->
        <nav class="mqr-fnav" aria-label="Navigasi antar bab">
            <a class="mqr-fnav-btn"
               href="<?= $prev_url ? htmlspecialchars($prev_url) : '#'; ?>"
               <?= $prev_url ? '' : 'aria-disabled="true"'; ?>>
                <i class="bx bx-chevron-left"></i>
                <span class="mqr-fnav-label"><?= $prev_name ? htmlspecialchars($prev_name) : 'Sebelumnya'; ?></span>
            </a>

            <a class="mqr-fnav-btn" href="<?= base_url('index.php/manaqib'); ?>">
                <i class="bx bx-grid-alt"></i>
                <span class="mqr-fnav-label">Semua Bab</span>
            </a>

            <a class="mqr-fnav-btn"
               href="<?= $next_url ? htmlspecialchars($next_url) : '#'; ?>"
               <?= $next_url ? '' : 'aria-disabled="true"'; ?>>
                <span class="mqr-fnav-label"><?= $next_name ? htmlspecialchars($next_name) : 'Selanjutnya'; ?></span>
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

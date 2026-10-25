<?php
defined('BASEPATH') or exit('No direct script access allowed');

$maulid_num          = $maulid_num          ?? 1;
$maulid_name         = $maulid_name         ?? '';
$maulid_latin        = $maulid_latin        ?? '';
$maulid_sections     = $maulid_sections     ?? [];
$maulid_translations = $maulid_translations ?? [];
$total               = $total               ?? 29;
$prev_url            = $prev_url            ?? null;
$next_url            = $next_url            ?? null;
$maulid_nav          = $maulid_nav          ?? [];
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
        --mdr-bg: #0b0d0d;
        --mdr-surf: #131615;
        --mdr-border: rgba(255,255,255,.07);
        --mdr-text: #eef1ee;
        --mdr-muted: #6d7e78;
        --mdr-accent: #e8b84b;
        --mdr-nav: 62px;
        --mdr-sub: 48px;
    }

    .mdr-page {
        min-height: 100vh;
        padding-top: calc(var(--mdr-nav) + var(--mdr-sub));
        padding-bottom: 5rem;
        background: var(--mdr-bg);
        color: var(--mdr-text);
    }

    /* ── Sub-nav ── */
    .mdr-subnav {
        position: fixed;
        top: var(--an-hdr-h, 62px); left: 0; right: 0;
        transition: top .32s ease;
        z-index: 120; height: var(--mdr-sub);
        display: flex; align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255,255,255,.06);
    }

    .mdr-subnav-inner {
        display: flex; align-items: center; gap: .5rem;
        width: 100%; max-width: 860px;
        margin-inline: auto; padding-inline: 1rem;
    }

    .mdr-subnav-left  { flex-shrink: 0; }

    .mdr-subnav-center {
        flex: 1; display: flex; align-items: center;
        justify-content: center; gap: .35rem;
        overflow-x: auto; scrollbar-width: none; min-width: 0;
    }

    .mdr-subnav-center::-webkit-scrollbar { display: none; }
    .mdr-subnav-right { flex-shrink: 0; }

    .mdr-pill {
        display: inline-flex; align-items: center; gap: .3rem;
        height: 34px; padding: 0 .85rem;
        border: 1.5px solid rgba(255,255,255,.12); border-radius: 8px;
        background: #1a1d1c; color: #a8b5b0;
        font: inherit; font-size: .73rem; white-space: nowrap;
        text-decoration: none; flex-shrink: 0;
        transition: border-color .14s, color .14s, background .14s;
    }

    .mdr-pill:hover { border-color: var(--mdr-accent); color: var(--mdr-accent); }

    .mdr-pill.is-active {
        border-color: var(--mdr-accent);
        background: rgba(232,184,75,.08);
        color: var(--mdr-accent); font-weight: 600;
    }

    .mdr-arrow {
        display: inline-flex; align-items: center; gap: .3rem;
        height: 34px; padding: 0 .65rem;
        border: 1.5px solid rgba(255,255,255,.12); border-radius: 8px;
        background: #1a1d1c; color: #a8b5b0;
        font: inherit; font-size: .73rem; text-decoration: none;
        white-space: nowrap; flex-shrink: 0;
        transition: border-color .14s, color .14s;
    }

    .mdr-arrow i { font-size: 1.15rem; flex-shrink: 0; }
    .mdr-arrow:hover { border-color: var(--mdr-accent); color: var(--mdr-accent); }
    .mdr-arrow[aria-disabled="true"] { opacity: .25; pointer-events: none; }

    /* ── Content ── */
    .mdr-body { width: min(100% - 2rem, 820px); margin-inline: auto; }

    /* ── Header ── */
    .mdr-hdr {
        padding: 2.25rem 0 1.65rem;
        text-align: center;
        border-bottom: 1px solid var(--mdr-border);
    }

    .mdr-hdr-meta {
        display: inline-flex; align-items: center; gap: .5rem;
        padding: .28rem .9rem; border-radius: 99px;
        background: rgba(255,255,255,.05); color: var(--mdr-muted);
        font-size: .68rem; margin-bottom: 1.1rem;
    }

    .mdr-hdr-icon {
        display: grid; width: 54px; height: 54px;
        margin: 0 auto .9rem; place-items: center;
        border-radius: 14px;
        background: rgba(232,184,75,.12); color: var(--mdr-accent);
        font-size: 1.6rem;
    }

    .mdr-hdr-name {
        margin: 0 0 .25rem;
        font-size: clamp(1.25rem, 3.5vw, 1.65rem);
        font-weight: 800; color: #fff;
    }

    .mdr-hdr-latin {
        margin: 0;
        font-size: .82rem;
        color: var(--mdr-muted);
        font-style: italic;
    }

    /* ── Section blocks ── */
    .mdr-section {
        padding: 1.5rem 0;
        border-bottom: 1px solid var(--mdr-border);
    }

    .mdr-section:last-of-type { border-bottom: none; }

    /* Rawi (prose) */
    .mdr-text-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        line-height: 2.1;
        color: #fff;
        direction: rtl;
        text-align: right;
        white-space: pre-line;
        margin-bottom: .65rem;
    }

    /* Verse (bari) — centered, larger */
    .mdr-section--bari .mdr-text-arab {
        font-size: clamp(1.6rem, 4vw, 2.2rem);
        text-align: center;
        line-height: 2.1;
    }

    /* Closing sholawat */
    .mdr-section--closing {
        padding: 1.25rem 1.25rem;
        margin: 1rem 0 0;
        border: 1px solid rgba(232,184,75,.2);
        border-radius: 12px;
        background: rgba(232,184,75,.05);
        text-align: center;
        border-bottom: 1px solid rgba(232,184,75,.2) !important;
    }

    .mdr-section--closing .mdr-text-arab {
        font-size: clamp(1.4rem, 3.5vw, 1.85rem);
        text-align: center;
        color: #ffd9a8;
        margin-bottom: .4rem;
    }

    /* Latin transliteration */
    .mdr-text-latin {
        display: block;
        font-size: .78rem;
        color: #8aa09a;
        font-style: italic;
        line-height: 2.1;
        margin-bottom: .4rem;
    }

    /* Indonesian translation */
    .mdr-text-id {
        display: block;
        font-size: .73rem;
        color: var(--mdr-muted);
        line-height: 2.1;
        padding: .5rem .75rem;
        border-left: 2px solid rgba(232,184,75,.3);
        background: rgba(255,255,255,.02);
        border-radius: 0 6px 6px 0;
        margin-top: .25rem;
    }

    /* Multi-text spacing inside a section */
    .mdr-text-item + .mdr-text-item {
        margin-top: 1.25rem;
        padding-top: 1.25rem;
        border-top: 1px dashed rgba(255,255,255,.06);
    }

    /* ۞ verse marker */
    .mdr-section--bari .mdr-text-arab {
        /* style the ۞ via CSS hack isn't possible — color handled inline */
    }

    /* ── Footer nav ── */
    .mdr-fnav {
        display: flex; align-items: center;
        justify-content: space-between; gap: 1rem;
        padding: 2rem 0 1rem;
        border-top: 1px solid var(--mdr-border);
        margin-top: 1rem;
    }

    .mdr-fnav-btn {
        display: inline-flex; align-items: center; gap: .45rem;
        min-height: 40px; padding: 0 1.2rem;
        border: 1.5px solid rgba(255,255,255,.1); border-radius: 99px;
        background: var(--mdr-surf); color: var(--mdr-text);
        font: inherit; font-size: .78rem; text-decoration: none;
        transition: border-color 150ms, background 150ms, color 150ms;
    }

    .mdr-fnav-btn:hover {
        border-color: rgba(232,184,75,.55);
        background: #1a1c1b; color: var(--mdr-accent);
    }

    .mdr-fnav-btn[aria-disabled="true"] { opacity: .3; pointer-events: none; }

    .mdr-fnav-label {
        display: none; max-width: 140px;
        overflow: hidden; text-overflow: ellipsis; white-space: nowrap;
    }

    @media (min-width: 480px) { .mdr-fnav-label { display: inline; } }

    @media (max-width: 575.98px) {
        .mdr-text-arab { font-size: clamp(1.6rem, 4vw, 2.2rem); line-height: 2.1; }
        .mdr-section--bari .mdr-text-arab { font-size: clamp(1.6rem, 4vw, 2.2rem); }
        .mdr-hdr { padding-block: 1.5rem 1.25rem; }
    }

    /* ── Nav Dropdown Panel ── */
    .rdr-nav-trigger .rdr-chev { font-size: .85rem; margin-left: .15rem; transition: transform .15s; }
    .rdr-nav-trigger[aria-expanded="true"] .rdr-chev { transform: rotate(180deg); }
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
<nav class="mdr-subnav" aria-label="Navigasi Maulid Ad-Diba'i">
    <div class="mdr-subnav-inner">
        <div class="mdr-subnav-left">
            <a class="mdr-pill" href="<?= base_url('index.php/maulid'); ?>" title="Daftar Bagian">
                <i class="bx bx-grid-alt"></i>
            </a>
        </div>

        <div class="mdr-subnav-center">
            <a class="mdr-arrow"
               href="<?= $prev_url ? htmlspecialchars($prev_url) : '#'; ?>"
               <?= $prev_url ? '' : 'aria-disabled="true"'; ?>
               title="Sebelumnya">
                <i class="bx bx-chevron-left"></i>
            </a>

            <button class="mdr-pill is-active rdr-nav-trigger" id="rdrNavTrigger" type="button"
                    aria-haspopup="true" aria-expanded="false" style="max-width:200px;">
                <span style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:150px;"><?= htmlspecialchars($maulid_name); ?></span>
                <i class="bx bx-chevron-down rdr-chev"></i>
            </button>

            <a class="mdr-arrow"
               href="<?= $next_url ? htmlspecialchars($next_url) : '#'; ?>"
               <?= $next_url ? '' : 'aria-disabled="true"'; ?>
               title="Selanjutnya">
                <i class="bx bx-chevron-right"></i>
            </a>
        </div>

        <div class="mdr-subnav-right">
            <span style="color:#6d7e78; font-size:.68rem; white-space:nowrap;"><?= (int) $maulid_num; ?> / <?= (int) $total; ?></span>
        </div>
    </div>
</nav>

<div class="rdr-panel-back" id="rdrPanelBack"></div>
<div class="rdr-panel" id="rdrPanel" aria-hidden="true">
    <div class="rdr-panel-handle"><span></span></div>
    <div class="rdr-panel-search">
        <i class="bx bx-search"></i>
        <input type="search" id="rdrPanelSearch" placeholder="Cari bacaan Maulid..." autocomplete="off">
    </div>
    <ul class="rdr-panel-list" id="rdrPanelList">
        <?php foreach ($maulid_nav as $s): ?>
            <li class="rdr-panel-item <?= (int)$s['num'] === (int)$maulid_num ? 'is-active' : ''; ?>"
                data-search="<?= htmlspecialchars(strtolower($s['num'] . ' ' . $s['display']), ENT_QUOTES); ?>">
                <a href="<?= base_url('index.php/maulid/' . (int)$s['num']); ?>">
                    <span><?= (int)$s['num'] . '. ' . htmlspecialchars($s['display']); ?></span>
                    <?php if ((int)$s['num'] === (int)$maulid_num): ?><i class="bx bx-check"></i><?php endif; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<main class="mdr-page" data-mdr-page>
    <div class="mdr-body">

        <!-- Header -->
        <header class="mdr-hdr">
            <span class="mdr-hdr-meta">
                <span>Bagian <?= (int) $maulid_num; ?></span>
                <span style="opacity:.4;">·</span>
                <span>Maulid Ad-Diba'i</span>
            </span>

            <span class="mdr-hdr-icon" aria-hidden="true">
                <img src="<?= base_url('assets/frontend/icons/islamic/crescent-star-frame.svg'); ?>" style="width:28px;height:28px;display:block;filter:brightness(0) invert(1);" alt="">
            </span>

            <h1 class="mdr-hdr-name"><?= htmlspecialchars($maulid_name, ENT_QUOTES, 'UTF-8'); ?></h1>
            <?php if (!empty($maulid_latin) && $maulid_latin !== $maulid_name): ?>
                <p class="mdr-hdr-latin"><?= htmlspecialchars($maulid_latin, ENT_QUOTES, 'UTF-8'); ?></p>
            <?php endif; ?>
        </header>

        <!-- Sections -->
        <?php foreach ($maulid_sections as $sec_id => $section):
            $type   = $section['type'] ?? 'rawi';
            $texts  = $section['text'] ?? [];
            $trans  = $maulid_translations[$sec_id]['text'] ?? [];
            $cls    = 'mdr-section';
            if ($type === 'bari')    $cls .= ' mdr-section--bari';
            if ($type === 'closing') $cls .= ' mdr-section--closing';
        ?>
            <div class="<?= $cls; ?>">
                <?php if (!empty($section['name'])): ?>
                    <p style="font-size:.72rem; color:var(--mdr-muted); margin:0 0 .9rem; font-weight:600; text-transform:uppercase; letter-spacing:.04em;">
                        <?= htmlspecialchars($section['name'], ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                <?php endif; ?>

                <?php foreach ($texts as $text_id => $item):
                    $arabic     = $item['arabic'] ?? '';
                    $latin_text = ($type !== 'closing') ? ($item['latin'] ?? '') : '';
                    $id_text    = $trans[$text_id] ?? '';
                ?>
                    <div class="mdr-text-item">
                        <?php if (!empty($arabic)): ?>
                            <span class="mdr-text-arab" lang="ar" dir="rtl"><?= htmlspecialchars($arabic, ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($latin_text)): ?>
                            <span class="mdr-text-latin"><?= htmlspecialchars($latin_text, ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endif; ?>
                        <?php if (!empty($id_text)): ?>
                            <span class="mdr-text-id"><?= htmlspecialchars($id_text, ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <!-- Footer nav -->
        <nav class="mdr-fnav" aria-label="Navigasi antar bagian">
            <a class="mdr-fnav-btn"
               href="<?= $prev_url ? htmlspecialchars($prev_url) : '#'; ?>"
               <?= $prev_url ? '' : 'aria-disabled="true"'; ?>>
                <i class="bx bx-chevron-left"></i>
                <span class="mdr-fnav-label">Sebelumnya</span>
            </a>

            <a class="mdr-fnav-btn" href="<?= base_url('index.php/maulid'); ?>">
                <i class="bx bx-grid-alt"></i>
                <span class="mdr-fnav-label">Semua Bagian</span>
            </a>

            <a class="mdr-fnav-btn"
               href="<?= $next_url ? htmlspecialchars($next_url) : '#'; ?>"
               <?= $next_url ? '' : 'aria-disabled="true"'; ?>>
                <span class="mdr-fnav-label">Selanjutnya</span>
                <i class="bx bx-chevron-right"></i>
            </a>
        </nav>

        <?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Banner.php'; ?>
    </div>
</main>
<script>
(function() {
  var trigger = document.getElementById('rdrNavTrigger');
  var panel   = document.getElementById('rdrPanel');
  var back    = document.getElementById('rdrPanelBack');
  var search  = document.getElementById('rdrPanelSearch');
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
    } else { close(); }
  });
  if (search) search.addEventListener('input', function() { filter(this.value); });
  if (back) back.addEventListener('click', close);
  document.addEventListener('keydown', function(e) { if (e.key === 'Escape') close(); });
})();
</script>

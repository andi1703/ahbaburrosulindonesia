<?php defined('BASEPATH') or exit('No direct script access allowed');
$type = $amalan_type ?? 'amalan';
$labels = [
    'tahlil'       => ['name' => 'Tahlil',        'icon' => 'bx-moon',      'color' => '#e8b84b', 'bg' => 'rgba(232,184,75,.15)'],
    'doa'          => ['name' => 'Doa',            'icon' => 'bx-hand',      'color' => '#e8b84b', 'bg' => 'rgba(232,184,75,.15)'],
    'wirid'        => ['name' => 'Wirid',          'icon' => 'bx-repeat',    'color' => '#e8b84b', 'bg' => 'rgba(232,184,75,.15)'],
    'hadits'       => ['name' => 'Hadits',         'icon' => 'bx-news',      'color' => '#e8b84b', 'bg' => 'rgba(232,184,75,.15)'],
    'jadwal-sholat'=> ['name' => 'Jadwal Sholat',  'icon' => 'bx-time-five', 'color' => '#e8b84b', 'bg' => 'rgba(232,184,75,.15)'],
];
$info = $labels[$type] ?? ['name' => ucfirst($type), 'icon' => 'bx-book', 'color' => '#e8b84b', 'bg' => 'rgba(232,184,75,.15)'];

// ── Sub-nav prev / next ──
$amalan_nav = [
    'tahlil'        => ['name' => 'Tahlil',       'url' => base_url('index.php/tahlil')],
    'doa'           => ['name' => 'Doa',           'url' => base_url('index.php/doa')],
    'wirid'         => ['name' => 'Wirid',         'url' => base_url('index.php/wirid')],
    'hadits'        => ['name' => 'Hadits',        'url' => base_url('index.php/hadits')],
    'jadwal-sholat' => ['name' => 'Jadwal Sholat', 'url' => base_url('index.php/jadwal-sholat')],
];
$nav_keys   = array_keys($amalan_nav);
$nav_pos    = array_search($type, $nav_keys);
$nav_prev   = ($nav_pos !== false && $nav_pos > 0)                    ? $amalan_nav[$nav_keys[$nav_pos - 1]] : null;
$nav_next   = ($nav_pos !== false && $nav_pos < count($nav_keys) - 1) ? $amalan_nav[$nav_keys[$nav_pos + 1]] : null;
$nav_cur    = $amalan_nav[$type] ?? ['name' => $info['name'], 'url' => '#'];
?>
<style>
/* ── Amalan Sub-nav ── */
.am-subnav{
  position:fixed; top:70px; left:0; right:0; z-index:120;
  height:48px; display:flex; align-items:center;
  background:#0d1010; border-bottom:1px solid rgba(255,255,255,.06);
}
.am-subnav-inner{
  display:flex; align-items:center; justify-content:center; gap:.35rem;
  width:100%; max-width:1120px;
  margin-inline:auto; padding-inline:1rem;
  overflow-x:auto; scrollbar-width:none;
}
.am-subnav-inner::-webkit-scrollbar{display:none;}
.am-pill{
  display:inline-flex; align-items:center; gap:.3rem;
  height:34px; padding:0 .85rem;
  border:1.5px solid rgba(255,255,255,.12); border-radius:8px;
  background:#1a1d1c; color:#a8b5b0; font:inherit; font-size:.73rem;
  white-space:nowrap; text-decoration:none; cursor:pointer; flex-shrink:0;
  transition:border-color .14s,color .14s,background .14s;
}
.am-pill:hover{border-color:#e8b84b;color:#e8b84b;}
.am-pill.is-active{
  border-color:#e8b84b; background:rgba(232,184,75,.08);
  color:#e8b84b; font-weight:600;
}
.am-arrow{
  display:inline-flex; align-items:center; gap:.3rem;
  height:34px; padding:0 .65rem;
  border:1.5px solid rgba(255,255,255,.12); border-radius:8px;
  background:#1a1d1c; color:#a8b5b0; font:inherit; font-size:.73rem;
  text-decoration:none; white-space:nowrap; flex-shrink:0;
  transition:border-color .14s,color .14s;
}
.am-arrow:hover{border-color:#e8b84b;color:#e8b84b;}
.am-arrow[aria-disabled="true"]{opacity:.3;pointer-events:none;}
.am-arrow i{font-size:1.1rem;}
.am-arrow-name{display:none;}
@media(min-width:580px){.am-arrow-name{display:inline;}}
.am-hub-name{display:none;}
@media(min-width:960px){.am-hub-name{display:inline;}}
.am-sel{
  appearance:none; height:34px; padding:0 1.5rem 0 .7rem;
  border:1.5px solid rgba(255,255,255,.12); border-radius:8px;
  background:#1a1d1c url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath d='M0 0l5 6 5-6z' fill='%236d7e78'/%3E%3C/svg%3E") no-repeat right .55rem center;
  color:#a8b5b0; font:inherit; font-size:.73rem;
  flex-shrink:0; cursor:pointer; outline:none;
}
.am-sel:focus{border-color:#e8b84b;}

    .coming-page {
        padding-top: calc(70px + 48px);
        min-height: 100vh;
        background: #0b0d0d;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding-bottom: 4rem;
        color: #f2f5f4;
    }
    .coming-icon-wrap {
        display: grid;
        width: 72px;
        height: 72px;
        place-items: center;
        border-radius: 18px;
        margin: 0 auto 1.25rem;
        font-size: 2rem;
    }
    .coming-title {
        font-size: 1.6rem;
        font-weight: 800;
        margin: 0 0 .5rem;
    }
    .coming-sub {
        color: #9aa5a1;
        font-size: .88rem;
        max-width: 340px;
        margin: 0 auto 1.75rem;
        line-height: 1.65;
    }
    .coming-back {
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        padding: .55rem 1.25rem;
        border-radius: 99px;
        background: #191c1b;
        border: 1px solid rgba(255,255,255,.08);
        color: #f2f5f4;
        text-decoration: none;
        font-size: .8rem;
        transition: border-color 150ms, background 150ms;
    }
    .coming-back:hover {
        border-color: rgba(232,184,75,.5);
        background: #202523;
        color: #fff;
    }
</style>

<!-- ── Amalan Sub-nav ── -->
<nav class="am-subnav" aria-label="Navigasi Amalan">
  <div class="am-subnav-inner">

    <!-- Hub icon -->
    <a class="am-pill" href="<?= base_url('index.php/amalan'); ?>">
      <i class="bx bx-grid-alt"></i>
      <span class="am-hub-name">Daftar Amalan</span>
    </a>

    <!-- Prev -->
    <a class="am-arrow"
       href="<?= $nav_prev ? htmlspecialchars($nav_prev['url']) : '#'; ?>"
       <?= $nav_prev ? '' : 'aria-disabled="true"'; ?>
       title="<?= $nav_prev ? 'Sebelumnya: '.htmlspecialchars($nav_prev['name']) : ''; ?>">
      <i class="bx bx-chevron-left"></i>
      <span class="am-arrow-name"><?= $nav_prev ? htmlspecialchars($nav_prev['name']) : ''; ?></span>
    </a>

    <!-- Current (active) -->
    <span class="am-pill is-active" aria-current="page">
      <?= htmlspecialchars($nav_cur['name']); ?>
    </span>

    <!-- Pilih Amalan -->
    <select class="am-sel" id="amPilihSel" aria-label="Pilih Amalan">
      <option value="">Pilih Amalan</option>
      <?php foreach ($amalan_nav as $key => $item): ?>
        <option value="<?= htmlspecialchars($item['url']); ?>"
          <?= $key === $type ? 'selected' : ''; ?>>
          <?= htmlspecialchars($item['name']); ?>
        </option>
      <?php endforeach; ?>
    </select>

    <!-- Next -->
    <a class="am-arrow"
       href="<?= $nav_next ? htmlspecialchars($nav_next['url']) : '#'; ?>"
       <?= $nav_next ? '' : 'aria-disabled="true"'; ?>
       title="<?= $nav_next ? 'Selanjutnya: '.htmlspecialchars($nav_next['name']) : ''; ?>">
      <span class="am-arrow-name"><?= $nav_next ? htmlspecialchars($nav_next['name']) : ''; ?></span>
      <i class="bx bx-chevron-right"></i>
    </a>

  </div>
</nav>
<script>
(function(){
  var s=document.getElementById('amPilihSel');
  if(s) s.addEventListener('change',function(){ if(this.value) window.location.href=this.value; });
})();
</script>

<main class="coming-page">
    <span class="coming-icon-wrap" style="background:<?= $info['bg']; ?>; color:<?= $info['color']; ?>;">
        <i class="bx <?= $info['icon']; ?>"></i>
    </span>
    <h1 class="coming-title"><?= htmlspecialchars($info['name']); ?></h1>
    <p class="coming-sub">Fitur <strong><?= htmlspecialchars($info['name']); ?></strong> sedang dalam pengembangan. Segera hadir dengan konten lengkap untuk Anda.</p>
    <a class="coming-back" href="<?= base_url('index.php/amalan'); ?>">
        <i class="bx bx-arrow-back"></i> Kembali ke Amalan
    </a>
</main>

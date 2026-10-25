<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $_jd_bg = base_url('assets/frontend/images/amalan-bg.jpg'); ?>
<style>
body { background: #090b0a; }

:root {
    --jd-bg:     #090b0a;
    --jd-surf:   #111413;
    --jd-surf2:  #171b19;
    --jd-bdr:    rgba(255,255,255,.07);
    --jd-text:   #e8ece9;
    --jd-muted:  #5a6b63;
    --jd-sub:    #8a9e94;
    --jd-gold:   #e8b84b;
    --jd-gold2:  #c99a30;
}

.jd-page {
    min-height: 100vh;
    padding-bottom: 6rem;
    background: var(--jd-bg);
    color: var(--jd-text);
    font-size: 15px;
}

/* ── HERO ──
   Same gold gradient + star tile + mosque-sketch photo used by .an-hero
   on the other amalan pages, so Jadwal Sholat matches the rest. */
.jd-hero {
    position: relative;
    overflow: hidden;
    padding: 7.5rem 1.5rem 6.5rem;
    background: linear-gradient(155deg, #D4880C 0%, #BA7008 30%, #9A5808 58%, #7A4210 84%, #5A3010 100%);
    border-bottom: 1px solid rgba(232,184,75,.1);
}
.jd-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    z-index: 0;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='40' height='40'%3E%3Cpath d='M20 3 L22.7 13.5 L32 8 L26.5 17.3 L37 20 L26.5 22.7 L32 32 L22.7 26.5 L20 37 L17.3 26.5 L8 32 L13.5 22.7 L3 20 L13.5 17.3 L8 8 L17.3 13.5 Z' fill='none' stroke='white' stroke-opacity='.06' stroke-width='0.7'/%3E%3C/svg%3E");
    background-size: 40px 40px;
    background-position: 0 0;
    background-repeat: repeat;
    pointer-events: none;
}
.jd-hero-photo {
    position: absolute;
    inset: 0;
    z-index: 0;
    background-image: url('<?= $_jd_bg ?>');
    background-size: auto 100%;
    background-position: bottom center;
    background-repeat: no-repeat;
    mix-blend-mode: multiply;
    opacity: .6;
    pointer-events: none;
}
@media (max-width: 767.98px) {
    .jd-hero-photo { background-size: contain; }
}
.jd-hero-inner {
    position: relative;
    z-index: 1;
    max-width: 840px;
    margin-inline: auto;
}

.jd-loc-tag {
    display: none;
    align-items: center;
    gap: .35rem;
    margin: 0 0 .6rem;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .03em;
    color: #ffe2a3;
}
.jd-loc-tag.is-shown { display: inline-flex; }
.jd-loc-tag i { font-size: .9rem; }

.jd-date-line {
    margin: 0 0 .5rem;
    font-size: .78rem;
    color: rgba(255,255,255,.72);
}

.jd-hero-title {
    margin: 0;
    color: #fff;
    font-size: clamp(1.55rem, 4.5vw, 2.3rem);
    font-weight: 800;
    line-height: 1.15;
}

.jd-hero-addr {
    display: flex;
    align-items: flex-start;
    gap: .4rem;
    margin: .65rem 0 0;
    font-size: .85rem;
    color: rgba(255,255,255,.85);
}
.jd-hero-addr i { font-size: 1.05rem; color: var(--jd-gold); flex-shrink: 0; margin-top: .1rem; }

.jd-hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: .6rem;
    margin-top: 1.25rem;
}
.jd-btn-pill {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .6rem 1.1rem;
    border-radius: 999px;
    font-size: .76rem;
    font-weight: 700;
    cursor: pointer;
    border: 1px solid rgba(232,184,75,.4);
    background: rgba(0,0,0,.3);
    color: #fff;
    transition: border-color .15s, background .15s;
}
.jd-btn-pill:hover { border-color: var(--jd-gold); background: rgba(0,0,0,.45); }
.jd-btn-pill--ghost { background: transparent; border-color: rgba(255,255,255,.3); }
.jd-btn-pill--ghost:hover { border-color: #fff; }
.jd-btn-pill i { font-size: .95rem; }
.jd-btn-pill[disabled] { opacity: .5; cursor: default; pointer-events: none; }

.jd-geo-status {
    margin: .6rem 0 0;
    font-size: .7rem;
    color: #ffe2a3;
}

/* Search panel — toggled open by "Ganti lokasi" */
.jd-search-area { display: none; position: relative; margin-top: .9rem; max-width: 420px; }
.jd-search-area.is-open { display: block; }
.jd-search-box {
    display: flex; align-items: center; gap: .6rem;
    background: rgba(0,0,0,.45); border: 1px solid rgba(232,184,75,.25);
    border-radius: 10px; padding: .7rem 1rem;
    transition: border-color .15s;
}
.jd-search-box:focus-within { border-color: rgba(232,184,75,.6); }
.jd-search-box i { color: rgba(255,255,255,.5); font-size: 1rem; flex-shrink: 0; }
.jd-search-box input {
    flex: 1; background: transparent; border: 0; outline: 0;
    color: #fff; font: inherit; font-size: .82rem;
}
.jd-search-box input::placeholder { color: rgba(255,255,255,.4); }
.jd-drop {
    display: none; position: absolute; top: calc(100% + 6px); left: 0; right: 0;
    background: #1c1f1d; border: 1px solid rgba(255,255,255,.09);
    border-radius: 10px; max-height: 220px; overflow-y: auto;
    z-index: 300; box-shadow: 0 8px 32px rgba(0,0,0,.55);
}
.jd-drop.open { display: block; }
.jd-drop-item {
    padding: .6rem 1rem; font-size: .78rem; cursor: pointer;
    color: var(--jd-sub); border-bottom: 1px solid rgba(255,255,255,.04);
    transition: background .1s;
}
.jd-drop-item:last-child { border-bottom: 0; }
.jd-drop-item:hover { background: rgba(232,184,75,.07); color: #fff; }

/* Countdown strip, inside the hero */
.jd-countdown {
    display: none;
    position: relative;
    z-index: 1;
    max-width: 840px;
    margin: 1.75rem auto 0;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    flex-wrap: wrap;
    padding: 1.1rem 1.4rem;
    background: rgba(0,0,0,.35);
    border: 1px solid rgba(232,184,75,.25);
    border-radius: 14px;
}
.jd-countdown.is-shown { display: flex; }
.jd-countdown-label { margin: 0 0 .2rem; font-size: .7rem; color: rgba(255,255,255,.65); }
.jd-countdown-time { margin: 0; font-size: 1.7rem; font-weight: 800; color: #fff; font-variant-numeric: tabular-nums; }
.jd-countdown-left { margin: 0; font-size: 1.15rem; font-weight: 700; color: var(--jd-gold); font-variant-numeric: tabular-nums; }

/* ── WRAP ── */
.jd-wrap { max-width: 840px; margin-inline: auto; padding: 0 1.25rem; }

/* ── Prayer panel (overlaps the hero slightly, like NU Online's card) ── */
.jd-panel {
    position: relative;
    z-index: 2;
    margin-top: -2.5rem;
    background: var(--jd-surf);
    border: 1px solid var(--jd-bdr);
    border-radius: 16px;
    box-shadow: 0 12px 34px rgba(0,0,0,.4);
    overflow: hidden;
}

.jd-day-nav {
    display: flex; align-items: center; justify-content: space-between;
    gap: .75rem; padding: 1rem 1.25rem;
    border-bottom: 1px solid var(--jd-bdr);
}
.jd-day-nav-btn {
    display: flex; align-items: center; justify-content: center;
    width: 2.1rem; height: 2.1rem; flex-shrink: 0;
    border-radius: 50%; border: 1px solid var(--jd-bdr);
    background: var(--jd-surf2); color: var(--jd-sub);
    cursor: pointer; transition: border-color .15s, color .15s;
}
.jd-day-nav-btn:hover { border-color: var(--jd-gold); color: var(--jd-gold); }
.jd-day-nav-mid { text-align: center; min-width: 0; }
.jd-day-nav-date { margin: 0; font-size: .85rem; font-weight: 700; color: var(--jd-text); }
.jd-day-nav-hijri { margin: .1rem 0 0; font-size: .68rem; color: var(--jd-muted); }

.jd-loading { text-align: center; padding: 3rem 1rem; color: var(--jd-muted); }
.jd-loading .spin { display: block; font-size: 1.8rem; margin-bottom: .5rem; animation: jdspin .8s linear infinite; color: var(--jd-gold); }
@keyframes jdspin { to { transform: rotate(360deg); } }

.jd-rows { padding: .25rem 1.25rem 0; }
.jd-row {
    display: flex; align-items: center; justify-content: space-between;
    gap: .75rem; padding: .85rem 0;
    border-bottom: 1px solid var(--jd-bdr);
    border-radius: 10px;
    transition: background .15s;
}
.jd-row:last-child { border-bottom: 0; }
.jd-row-left { display: flex; align-items: center; gap: .65rem; min-width: 0; }
.jd-row-ico {
    display: flex; align-items: center; justify-content: center;
    width: 2rem; height: 2rem; flex-shrink: 0;
    border-radius: 50%; background: var(--jd-surf2); color: var(--jd-sub);
    font-size: 1rem;
}
.jd-row-name { font-size: .85rem; font-weight: 700; color: var(--jd-text); }
.jd-row-time { font-size: 1.05rem; font-weight: 800; color: var(--jd-text); font-variant-numeric: tabular-nums; }
.jd-row.is-active { background: rgba(232,184,75,.08); margin: 0 -1.25rem; padding-inline: 1.25rem; }
.jd-row.is-active .jd-row-name,
.jd-row.is-active .jd-row-time { color: var(--jd-gold); }
.jd-row.is-active .jd-row-ico { background: rgba(232,184,75,.18); color: var(--jd-gold); }

.jd-panel-foot {
    display: flex; justify-content: center; gap: .75rem;
    padding: 1rem 1.25rem; border-top: 1px solid var(--jd-bdr);
}
.jd-foot-btn {
    display: inline-flex; align-items: center; gap: .4rem;
    padding: .55rem 1.1rem; border-radius: 8px;
    font-size: .75rem; font-weight: 700; cursor: pointer;
    background: var(--jd-surf2); border: 1px solid var(--jd-bdr);
    color: var(--jd-text); transition: border-color .15s;
}
.jd-foot-btn:hover { border-color: rgba(232,184,75,.4); color: var(--jd-gold); }

/* ── Monthly section ── */
.jd-month-head { margin: 2.25rem 0 .4rem; font-size: 1rem; font-weight: 800; color: var(--jd-text); }
.jd-month-summary { margin: 0 0 1.1rem; font-size: .78rem; color: var(--jd-sub); line-height: 1.6; }

.jd-week-scroll {
    overflow-x: auto; border-radius: 12px;
    border: 1px solid var(--jd-bdr); margin-bottom: 1.5rem;
}
.jd-week-table { width: 100%; border-collapse: collapse; font-size: .76rem; white-space: nowrap; }
.jd-week-table th {
    padding: .65rem .85rem; background: var(--jd-surf2);
    font-size: .6rem; font-weight: 700; text-transform: uppercase; letter-spacing: .06em;
    color: var(--jd-muted); text-align: center;
    border-bottom: 1px solid var(--jd-bdr);
}
.jd-week-table th:first-child, .jd-week-table th:nth-child(2), .jd-week-table th:nth-child(3) { text-align: left; }
.jd-week-table td {
    padding: .6rem .85rem; border-bottom: 1px solid var(--jd-bdr);
    color: var(--jd-sub); vertical-align: middle; text-align: center; font-weight: 600;
}
.jd-week-table td:first-child, .jd-week-table td:nth-child(2), .jd-week-table td:nth-child(3) {
    text-align: left; color: var(--jd-text);
}
.jd-week-table tr:last-child td { border-bottom: 0; }
.jd-week-table tbody tr:nth-child(even) { background: var(--jd-surf2); }
.jd-week-table tr.is-today td { background: rgba(232,184,75,.07); }
.jd-week-table tr.is-today td:first-child { border-left: 2px solid var(--jd-gold); padding-left: calc(.85rem - 2px); }
.jd-week-table tr.is-today td:first-child { color: var(--jd-gold); font-weight: 700; }

/* ── SOURCE ── */
.jd-source { text-align: center; font-size: .63rem; color: var(--jd-muted); margin-top: 1rem; }
.jd-source a { color: var(--jd-gold); text-decoration: none; }

/* ── PRINT (A4 month sheet, built by the "Cetak" button) ── */
.jd-print-sheet { display: none; }

@media print {
  @page { size: A4; margin: 10mm; }
  body * { visibility: hidden; }
  #jdPrintSheet, #jdPrintSheet * { visibility: visible; }
  #jdPrintSheet {
    display: block !important;
    position: absolute; left: 0; top: 0; width: 100%;
    background: #fff; color: #1a1000;
    -webkit-print-color-adjust: exact; print-color-adjust: exact; color-adjust: exact;
  }
  #jdPrintSheet * { -webkit-print-color-adjust: exact; print-color-adjust: exact; color-adjust: exact; }

  .jd-print-hdr {
    display: flex; align-items: center; gap: 3mm;
    margin-bottom: 4mm; padding-bottom: 2.5mm;
    border-bottom: 2px solid #B8820A;
  }
  .jd-print-logo { width: 11mm; height: 11mm; object-fit: contain; flex-shrink: 0; }
  .jd-print-brand {
    font-size: 8.5pt; font-weight: 700; color: #B8820A;
    letter-spacing: .05em; text-transform: uppercase; margin: 0 0 1mm;
  }
  .jd-print-hdr h1 { font-size: 12.5pt; margin: 0 0 1mm; color: #1a1000; }
  .jd-print-hdr p { font-size: 8.5pt; margin: 0; color: #4a3a1a; }

  .jd-print-table { width: 100%; border-collapse: collapse; font-size: 7.5pt; page-break-inside: avoid; }
  .jd-print-table th, .jd-print-table td { border: 1px solid #c9a44a; padding: .9mm 1.4mm; text-align: center; }
  .jd-print-table th:first-child, .jd-print-table td:first-child,
  .jd-print-table th:nth-child(2), .jd-print-table td:nth-child(2),
  .jd-print-table th:nth-child(3), .jd-print-table td:nth-child(3) { text-align: left; }
  .jd-print-table thead th {
    background: #B8820A !important; color: #fff; font-weight: 700;
    font-size: 7.3pt; text-transform: uppercase; letter-spacing: .03em;
  }
  .jd-print-table tbody tr { page-break-inside: avoid; }
  .jd-print-table tbody tr:nth-child(odd)  { background: #fff !important; }
  .jd-print-table tbody tr:nth-child(even) { background: #F2DA9C !important; }
  .jd-print-table tbody tr.jd-print-today td:first-child {
    border-left: 2px solid #B8820A; font-weight: 700; color: #B8820A;
  }

  .jd-print-foot { margin-top: 3mm; font-size: 6.8pt; color: #7A6035; line-height: 1.4; }
}

/* ── LIGHT MODE ── */
:root[data-theme="light"] {
    --jd-bg: #FAF5E4; --jd-surf: #fff; --jd-surf2: #F2E9D0;
    --jd-bdr: #E0CFA0; --jd-text: #1a1000; --jd-muted: #9A7C45;
    --jd-sub: #7A6035; --jd-gold: #B8820A; --jd-gold2: #9A6C08;
}
:root[data-theme="light"] body { background: #FAF5E4; }
:root[data-theme="light"] .jd-page { background: #FAF5E4; }
:root[data-theme="light"] .jd-drop { background: #fff; border-color: #E0CFA0; }
:root[data-theme="light"] .jd-drop-item { color: #5C4218; }
:root[data-theme="light"] .jd-week-table th { background: #F2E9D0; }

@media (max-width: 520px) {
    .jd-hero { padding-top: 7rem; padding-bottom: 7.5rem; }
    .jd-hero-title { font-size: 1.45rem; }
    .jd-countdown { flex-wrap: nowrap; padding: .9rem 1.1rem; gap: .5rem; }
    .jd-countdown-time { font-size: 1.3rem; }
    .jd-countdown-left { font-size: .95rem; white-space: nowrap; }
    .jd-panel { margin-top: -3.25rem; }
}
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<!-- HERO (sibling of .jd-page, same as .an-hero on the other amalan pages,
     so its gold background starts at the very top of the page instead of
     being pushed down by .jd-page's header-clearing padding) -->
<div class="jd-hero">
  <div class="jd-hero-photo" aria-hidden="true"></div>

  <div class="jd-hero-inner">
    <p class="jd-loc-tag" id="jdLocTag"><i class="bx bx-current-location"></i><span id="jdLocTagText"></span></p>
    <p class="jd-date-line"><span id="jdDateGreg">—</span> · <span id="jdDateHijri">—</span></p>
    <h1 class="jd-hero-title">Jadwal Sholat Hari Ini</h1>
    <p class="jd-hero-addr"><i class="bx bxs-map"></i><span id="jdCityName">Memuat…</span></p>

    <div class="jd-hero-actions">
      <button type="button" class="jd-btn-pill" id="jdBtnSearch"><i class="bx bx-search"></i>Ganti lokasi</button>
      <button type="button" class="jd-btn-pill jd-btn-pill--ghost" id="jdBtnGeo"><i class="bx bx-current-location"></i>Gunakan lokasi saat ini</button>
    </div>
    <p class="jd-geo-status" id="jdGeoStatus" style="display:none"></p>

    <div class="jd-search-area" id="jdSearchArea">
      <div class="jd-search-box">
        <i class="bx bx-search"></i>
        <input type="text" id="jdCityInput" placeholder="Cari kota atau kabupaten…" autocomplete="off">
      </div>
      <div class="jd-drop" id="jdDrop"></div>
    </div>
  </div>

  <div class="jd-countdown" id="jdCountdown">
    <div>
      <p class="jd-countdown-label" id="jdCountdownLabel">Menuju —</p>
      <p class="jd-countdown-time" id="jdCountdownTime">—</p>
    </div>
    <p class="jd-countdown-left" id="jdCountdownLeft">—</p>
  </div>
</div>

<main class="jd-page">

  <div class="jd-wrap">

    <div class="jd-panel">
      <div class="jd-day-nav">
        <button type="button" class="jd-day-nav-btn" id="jdPrevDay" aria-label="Hari sebelumnya"><i class="bx bx-chevron-left"></i></button>
        <div class="jd-day-nav-mid">
          <p class="jd-day-nav-date" id="jdNavDate">—</p>
          <p class="jd-day-nav-hijri" id="jdNavHijri">—</p>
        </div>
        <button type="button" class="jd-day-nav-btn" id="jdNextDay" aria-label="Hari berikutnya"><i class="bx bx-chevron-right"></i></button>
      </div>

      <!-- LOADING -->
      <div class="jd-loading" id="jdLoading">
        <i class="bx bx-loader-alt spin"></i>
        Memuat jadwal salat…
      </div>

      <!-- CONTENT -->
      <div id="jdContent" style="display:none">
        <div class="jd-rows" id="jdRows"></div>
        <div class="jd-panel-foot">
          <button type="button" class="jd-foot-btn" id="jdBtnPrint"><i class="bx bx-printer"></i>Cetak</button>
          <button type="button" class="jd-foot-btn" id="jdBtnShare"><i class="bx bx-share-alt"></i>Bagikan</button>
        </div>
      </div>
    </div>

    <!-- MONTHLY TABLE -->
    <div id="jdMonthSection" style="display:none">
      <h2 class="jd-month-head" id="jdMonthHead">Jadwal sholat bulan ini</h2>
      <p class="jd-month-summary" id="jdMonthSummary"></p>
      <div class="jd-week-scroll">
        <table class="jd-week-table">
          <thead>
            <tr>
              <th>Hari</th>
              <th>Masehi</th>
              <th>Hijriah</th>
              <th>Imsak</th>
              <th>Subuh</th>
              <th>Terbit</th>
              <th>Dhuha</th>
              <th>Zuhur</th>
              <th>Ashar</th>
              <th>Maghrib</th>
              <th>Isya</th>
            </tr>
          </thead>
          <tbody id="jdMonthBody"></tbody>
        </table>
      </div>
    </div>

    <p class="jd-source">Data dari Kemenag RI via <a href="https://api.myquran.com" target="_blank" rel="noopener">api.myquran.com</a></p>

  </div>
</main>

<!-- Print-only A4 sheet (built on demand by the "Cetak" button, hidden on
     screen — @media print hides everything else and shows just this). -->
<div class="jd-print-sheet" id="jdPrintSheet"></div>

<script>
(function(){
  var SITE_LOGO = <?= json_encode($_logo ?? '') ?>;
  var SITE_NAME = <?= json_encode($_site_name ?? 'Majelis Ahbaburrosul Indonesia') ?>;
  var API_KOTA   = 'https://api.myquran.com/v2/sholat/kota/semua';
  var API_JADWAL = 'https://api.myquran.com/v2/sholat/jadwal/';
  var API_GEO    = 'https://nominatim.openstreetmap.org/reverse';

  var PRAYERS = [
    { key:'imsak',   name:'Imsak',   icon:'bx-time-five' },
    { key:'subuh',   name:'Subuh',   icon:'bxs-moon'      },
    { key:'terbit',  name:'Terbit',  icon:'bx-sun'        },
    { key:'dhuha',   name:'Dhuha',   icon:'bxs-sun'       },
    { key:'dzuhur',  name:'Zuhur',   icon:'bxs-sun'       },
    { key:'ashar',   name:'Ashar',   icon:'bx-cloud'      },
    { key:'maghrib', name:'Maghrib', icon:'bx-cloud'      },
    { key:'isya',    name:'Isya',    icon:'bx-moon'       },
  ];
  /* Which of the above actually count toward the "next prayer" countdown
     (the 5 obligatory prayers only — not Imsak/Terbit/Dhuha). */
  var COUNTDOWN_KEYS = ['subuh','dzuhur','ashar','maghrib','isya'];

  var MONTHS_ID    = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
  var MONTHS_SHORT = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  var MN_SHORT  = ['Muh','Saf','R.Awal','R.Akhir','J.Ula','J.Akhir','Raj','Sya\'ban','Ram','Syawal','Dzulqa','Dzulhij'];
  var MN_FULL   = ['Muharram','Safar','Rabi\'ul Awwal','Rabi\'ul Akhir','Jumadal Ula','Jumadal Akhirah','Rajab','Sya\'ban','Ramadan','Syawal','Dzulqa\'dah','Dzulhijjah'];
  var DAYS_ID   = ['Ahad','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

  var $ = function(id){ return document.getElementById(id); };

  var cTimer = null, cityList = [];
  var state = { id: '1301', name: 'KOTA JAKARTA', daerah: '', viewDate: new Date(), lastDay: null };
  var monthCache = {};

  function pad(n){ return String(n).padStart(2,'0'); }
  function sameDay(a,b){ return a.getFullYear()===b.getFullYear() && a.getMonth()===b.getMonth() && a.getDate()===b.getDate(); }

  /* Hijri conversion (Kuwaiti tabular algorithm, via Julian Day Number) */
  function hijriParts(d){
    var gy=d.getFullYear(), gm=d.getMonth()+1, gd=d.getDate();
    var jd;
    if(gy>1582 || (gy===1582 && (gm>10 || (gm===10 && gd>14)))){
      jd = Math.floor((1461*(gy+4800+Math.floor((gm-14)/12)))/4) +
           Math.floor((367*(gm-2-12*Math.floor((gm-14)/12)))/12) -
           Math.floor((3*Math.floor((gy+4900+Math.floor((gm-14)/12))/100))/4) +
           gd - 32075;
    } else {
      jd = 367*gy - Math.floor((7*(gy+5001+Math.floor((gm-9)/7)))/4) +
           Math.floor((275*gm)/9) + gd + 1729777;
    }
    var l=jd-1948440+10632, n=Math.floor((l-1)/10631);
    l=l-10631*n+354;
    var j=Math.floor((10985-l)/5316)*Math.floor((50*l)/17719)+Math.floor(l/5670)*Math.floor((43*l)/15238);
    l=l-Math.floor((30-j)/15)*Math.floor((17719*j)/50)-Math.floor(j/16)*Math.floor((15238*j)/43)+29;
    var mm=Math.floor((24*l)/709);
    var dd=l-Math.floor((709*mm)/24);
    var yy=30*n+j-30;
    return { d: dd, m: mm, y: yy };
  }
  function toHijri(d){ var h=hijriParts(d); return h.d+' '+MN_FULL[h.m-1]+' '+h.y+' H'; }
  function toHijriShort(d){ var h=hijriParts(d); return h.d+' '+MN_SHORT[h.m-1]; }

  /* "Rabi'ul Akhir – Jumadal Ula 1448 H" style range covering a Gregorian month */
  function hijriRangeLabel(year, month0){
    var first = hijriParts(new Date(year, month0, 1));
    var last  = hijriParts(new Date(year, month0+1, 0));
    if(first.m===last.m && first.y===last.y) return MN_FULL[first.m-1]+' '+first.y+' H';
    return MN_FULL[first.m-1]+' – '+MN_FULL[last.m-1]+' '+last.y+' H';
  }

  function fmtGregLong(d){
    return DAYS_ID[d.getDay()]+', '+d.getDate()+' '+MONTHS_ID[d.getMonth()]+' '+d.getFullYear();
  }

  function pt(dateObj, str){
    var p = str.split(':');
    return new Date(dateObj.getFullYear(), dateObj.getMonth(), dateObj.getDate(), +p[0], +p[1], 0);
  }

  function fmtCountdown(ms){
    if(ms<=0) return '00:00:00';
    var h=Math.floor(ms/3600000),m=Math.floor((ms%3600000)/60000),s=Math.floor((ms%60000)/1000);
    return pad(h)+':'+pad(m)+':'+pad(s);
  }

  function normLoc(s){
    return (s||'').toUpperCase()
      .replace(/^KOTA ADMINISTRASI\s+/,'')
      .replace(/^KABUPATEN\s+/,'')
      .replace(/^KAB\.?\s+/,'')
      .replace(/^KOTA\s+/,'')
      .trim();
  }

  /* Display-friendly "Jakarta Pusat" instead of the API's "KOTA JAKARTA PUSAT" */
  function toTitleCase(s){
    return (s||'').toLowerCase().replace(/(^|\s|\.)[a-z]/g, function(c){ return c.toUpperCase(); });
  }
  function displayLoc(s){ return toTitleCase(normLoc(s)); }

  var ABBR_KEEP_UPPER = ['DKI','DI','NTB','NTT'];
  function titleCaseDaerah(s){
    return (s||'').split(' ').filter(Boolean).map(function(w){
      var up = w.toUpperCase();
      if(ABBR_KEEP_UPPER.indexOf(up)!==-1) return up;
      return up.charAt(0)+up.slice(1).toLowerCase();
    }).join(' ');
  }

  /* Best-effort WIB/WITA/WIT label from the province name the API returns
     as "daerah" — myquran.com doesn't expose a timezone field directly. */
  var TZ_WITA = ['KALIMANTAN SELATAN','KALIMANTAN TIMUR','KALIMANTAN UTARA','BALI','NUSA TENGGARA','SULAWESI','GORONTALO'];
  var TZ_WIT  = ['MALUKU','PAPUA'];
  function tzLabel(daerah){
    var d = (daerah||'').toUpperCase();
    for(var i=0;i<TZ_WIT.length;i++)  if(d.indexOf(TZ_WIT[i])!==-1)  return 'WIT';
    for(var i=0;i<TZ_WITA.length;i++) if(d.indexOf(TZ_WITA[i])!==-1) return 'WITA';
    return 'WIB';
  }

  /* ── Day rows + countdown ── */
  function renderDay(jadwal){
    state.lastJadwal = jadwal;
    var isToday = sameDay(state.viewDate, new Date());

    $('jdNavDate').textContent  = (isToday ? 'Hari ini, ' : '') + fmtGregLong(state.viewDate);
    $('jdNavHijri').textContent = toHijri(state.viewDate);
    $('jdDateGreg').textContent  = fmtGregLong(new Date());
    $('jdDateHijri').textContent = toHijri(new Date());

    /* currentKey = the prayer period we're currently in (the last of the
       5 obligatory prayers that has started); nextKey = the next one still
       to come today. Past the day's Isya, there's no nextKey today — the
       countdown rolls over to tomorrow's Subuh, and the Isya row stays
       highlighted (we're still "in" last night's Isya period). Before
       today's Subuh, currentKey also falls back to Isya for the same
       reason — no extra fetch needed since it's the same row either way. */
    var now = new Date();
    var currentKey = null, nextKey = null;
    if(isToday){
      for(var i=0;i<COUNTDOWN_KEYS.length;i++){
        var t = pt(state.viewDate, jadwal[COUNTDOWN_KEYS[i]]);
        if(t <= now) currentKey = COUNTDOWN_KEYS[i];
        else if(nextKey === null) nextKey = COUNTDOWN_KEYS[i];
      }
      if(currentKey === null) currentKey = 'isya';
    }

    var rows = $('jdRows');
    rows.innerHTML = PRAYERS.map(function(p){
      var isActive = isToday && p.key === currentKey;
      return '<div class="jd-row'+(isActive?' is-active':'')+'">'+
        '<div class="jd-row-left">'+
          '<span class="jd-row-ico"><i class="bx '+p.icon+'"></i></span>'+
          '<span class="jd-row-name">'+p.name+'</span>'+
        '</div>'+
        '<span class="jd-row-time">'+jadwal[p.key]+'</span>'+
      '</div>';
    }).join('');

    if(cTimer) clearInterval(cTimer);
    if(!isToday){
      $('jdCountdown').classList.remove('is-shown');
    } else if(nextKey){
      startCountdown(nextKey, pt(state.viewDate, jadwal[nextKey]), jadwal[nextKey], false);
    } else {
      /* past today's Isya — countdown to tomorrow's Subuh */
      $('jdCountdownLabel').textContent = 'Menuju Subuh besok';
      $('jdCountdownTime').textContent  = '—';
      $('jdCountdownLeft').textContent  = '—';
      $('jdCountdown').classList.add('is-shown');
      var tmrw = new Date(state.viewDate.getFullYear(), state.viewDate.getMonth(), state.viewDate.getDate()+1);
      fetch(API_JADWAL+state.id+'/'+tmrw.getFullYear()+'/'+(tmrw.getMonth()+1)+'/'+tmrw.getDate())
        .then(function(r){ return r.json(); })
        .then(function(d){
          var subuh = d.data && d.data.jadwal && d.data.jadwal.subuh;
          if(!subuh){ $('jdCountdown').classList.remove('is-shown'); return; }
          startCountdown('subuh', pt(tmrw, subuh), subuh, true);
        })
        .catch(function(){ $('jdCountdown').classList.remove('is-shown'); });
    }

    $('jdLoading').style.display = 'none';
    $('jdContent').style.display = '';
  }

  function startCountdown(key, target, timeStr, isTomorrow){
    $('jdCountdown').classList.add('is-shown');
    var name = PRAYERS.filter(function(p){ return p.key===key; })[0].name;
    function tick(){
      var d = target - new Date();
      $('jdCountdownLabel').textContent = 'Menuju ' + name + (isTomorrow ? ' besok' : '');
      $('jdCountdownTime').textContent  = timeStr;
      $('jdCountdownLeft').textContent  = '- ' + fmtCountdown(d);
      if(d<=0){ clearInterval(cTimer); fetchDay(); }
    }
    tick(); cTimer = setInterval(tick,1000);
  }

  /* ── Monthly table + summary ── */
  function renderMonth(days){
    var today = new Date();
    var todayStr = today.getFullYear()+'-'+pad(today.getMonth()+1)+'-'+pad(today.getDate());

    var minSubuh=null,maxSubuh=null,minMaghrib=null,maxMaghrib=null;
    days.forEach(function(d){
      if(minSubuh===null || d.subuh < minSubuh) minSubuh = d.subuh;
      if(maxSubuh===null || d.subuh > maxSubuh) maxSubuh = d.subuh;
      if(minMaghrib===null || d.maghrib < minMaghrib) minMaghrib = d.maghrib;
      if(maxMaghrib===null || d.maghrib > maxMaghrib) maxMaghrib = d.maghrib;
    });

    var mLabel = MONTHS_ID[state.viewDate.getMonth()]+' '+state.viewDate.getFullYear();
    $('jdMonthHead').textContent = 'Jadwal sholat ' + (state.name||'') + ' bulan ' + mLabel;
    $('jdMonthSummary').textContent = 'Sepanjang ' + mLabel + ', Subuh di ' + (state.name||'lokasi ini') +
      ' pukul ' + minSubuh + '–' + maxSubuh + ' dan Maghrib pukul ' + minMaghrib + '–' + maxMaghrib + '.';

    $('jdMonthBody').innerHTML = days.map(function(d){
      var dt = new Date(d.date+'T00:00:00');
      var isTd = d.date===todayStr;
      return '<tr'+(isTd?' class="is-today"':'')+'>'+
        '<td>'+DAYS_ID[dt.getDay()]+'</td>'+
        '<td>'+dt.getDate()+' '+MONTHS_SHORT[dt.getMonth()]+'</td>'+
        '<td>'+toHijriShort(dt)+'</td>'+
        '<td>'+d.imsak+'</td>'+
        '<td>'+d.subuh+'</td>'+
        '<td>'+d.terbit+'</td>'+
        '<td>'+d.dhuha+'</td>'+
        '<td>'+d.dzuhur+'</td>'+
        '<td>'+d.ashar+'</td>'+
        '<td>'+d.maghrib+'</td>'+
        '<td>'+d.isya+'</td>'+
      '</tr>';
    }).join('');

    $('jdMonthSection').style.display = '';
  }

  /* ── Fetch orchestration ── */
  function fetchDay(){
    var y = state.viewDate.getFullYear(), m = state.viewDate.getMonth()+1, dd = state.viewDate.getDate();
    var monthKey = state.id+'-'+y+'-'+m;

    $('jdLoading').style.display = '';
    $('jdContent').style.display = 'none';

    var urlDay = API_JADWAL+state.id+'/'+y+'/'+m+'/'+dd;
    var needMonth = !monthCache[monthKey];
    var reqs = [ fetch(urlDay).then(function(r){ return r.json(); }) ];
    if(needMonth) reqs.push(fetch(API_JADWAL+state.id+'/'+y+'/'+m).then(function(r){ return r.json(); }));

    Promise.all(reqs).then(function(res){
      var dayRes = res[0];
      state.name   = dayRes.data.lokasi || state.name;
      state.daerah = dayRes.data.daerah || '';
      $('jdCityName').textContent = state.name + (state.daerah ? ', ' + state.daerah : '');

      renderDay(dayRes.data.jadwal);

      if(needMonth){
        var monthRes = res[1];
        var days = monthRes.data && monthRes.data.jadwal;
        if(days && days.length) monthCache[monthKey] = days;
      }
      if(monthCache[monthKey]) renderMonth(monthCache[monthKey]);

      try{
        localStorage.setItem('jd_id', state.id);
        localStorage.setItem('jd_nm', state.name);
      }catch(e){}
    }).catch(function(){
      $('jdLoading').innerHTML = '<i class="bx bx-error-circle" style="font-size:1.6rem;color:var(--jd-gold)"></i><br>Gagal memuat. Periksa koneksi.';
    });
  }

  function setCity(id, name){
    state.id = id;
    state.name = name;
    monthCache = {};
    fetchDay();
  }

  /* ── Day navigation ── */
  $('jdPrevDay').addEventListener('click', function(){
    state.viewDate = new Date(state.viewDate.getFullYear(), state.viewDate.getMonth(), state.viewDate.getDate()-1);
    fetchDay();
  });
  $('jdNextDay').addEventListener('click', function(){
    state.viewDate = new Date(state.viewDate.getFullYear(), state.viewDate.getMonth(), state.viewDate.getDate()+1);
    fetchDay();
  });

  /* ── Search panel ── */
  var searchArea = $('jdSearchArea'), inp = $('jdCityInput'), drop = $('jdDrop');
  $('jdBtnSearch').addEventListener('click', function(){
    searchArea.classList.toggle('is-open');
    if(searchArea.classList.contains('is-open')) inp.focus();
  });
  inp.addEventListener('input',function(){
    var q = this.value.trim().toUpperCase();
    if(!q){ drop.classList.remove('open'); return; }
    var items = cityList.filter(function(c){ return c.lokasi.indexOf(q)!==-1; });
    drop.innerHTML = items.length
      ? items.slice(0,40).map(function(c){
          return '<div class="jd-drop-item" data-id="'+c.id+'" data-nm="'+c.lokasi+'">'+c.lokasi+'</div>';
        }).join('')
      : '<div class="jd-drop-item" style="cursor:default;color:var(--jd-muted)">Tidak ditemukan</div>';
    drop.classList.add('open');
  });
  drop.addEventListener('click',function(e){
    var it = e.target.closest('[data-id]'); if(!it) return;
    inp.value=''; drop.classList.remove('open'); searchArea.classList.remove('is-open');
    $('jdLocTag').classList.remove('is-shown');
    setCity(it.dataset.id, it.dataset.nm);
  });
  document.addEventListener('click',function(e){
    if(!e.target.closest('.jd-search-area') && !e.target.closest('#jdBtnSearch')) drop.classList.remove('open');
  });

  /* ── "Gunakan lokasi saat ini" — GPS + OpenStreetMap reverse geocoding ──
     myquran.com's city list has no coordinates, so we reverse-geocode the
     device's GPS position to a place name, then fuzzy-match that name
     against the existing city list. Best-effort: may not always find a
     match, in which case the user falls back to manual search. */
  var geoBtn = $('jdBtnGeo'), geoStatus = $('jdGeoStatus');
  function showGeoStatus(msg){ geoStatus.textContent = msg; geoStatus.style.display = msg ? '' : 'none'; }

  geoBtn.addEventListener('click', function(){
    if(!navigator.geolocation){ showGeoStatus('Perangkat/browser tidak mendukung deteksi lokasi.'); return; }
    geoBtn.setAttribute('disabled','');
    showGeoStatus('Mendeteksi lokasi…');

    navigator.geolocation.getCurrentPosition(function(pos){
      var lat = pos.coords.latitude, lon = pos.coords.longitude;
      var url = API_GEO+'?format=jsonv2&lat='+lat+'&lon='+lon+'&accept-language=id&zoom=10';
      fetch(url, { headers: { 'Accept':'application/json' } })
        .then(function(r){ return r.json(); })
        .then(function(d){
          var addr = d.address || {};
          var candidates = [addr.city, addr.town, addr.municipality, addr.county, addr.city_district, addr.state_district, addr.regency, addr.state]
            .filter(Boolean);

          var match = null, matchLabel = null;
          for(var i=0;i<candidates.length && !match;i++){
            var norm = normLoc(candidates[i]);
            match = cityList.filter(function(c){ return normLoc(c.lokasi) === norm; })[0]
                 || cityList.filter(function(c){ return normLoc(c.lokasi).indexOf(norm)!==-1 || norm.indexOf(normLoc(c.lokasi))!==-1; })[0]
                 || null;
            if(match) matchLabel = candidates[i];
          }

          geoBtn.removeAttribute('disabled');
          if(match){
            showGeoStatus('');
            $('jdLocTagText').textContent = ' Lokasi saat ini: sekitar ' + matchLabel;
            $('jdLocTag').classList.add('is-shown');
            searchArea.classList.remove('is-open');
            setCity(match.id, match.lokasi);
          } else {
            showGeoStatus('Lokasi tidak ditemukan di daftar kota, silakan cari manual di bawah.');
            searchArea.classList.add('is-open');
          }
        })
        .catch(function(){
          geoBtn.removeAttribute('disabled');
          showGeoStatus('Gagal mendeteksi nama lokasi. Silakan cari manual.');
          searchArea.classList.add('is-open');
        });
    }, function(){
      geoBtn.removeAttribute('disabled');
      showGeoStatus('Izin lokasi ditolak atau tidak tersedia.');
    }, { timeout: 10000 });
  });

  /* ── Print / Share ── */
  $('jdBtnPrint').addEventListener('click', function(){
    var y = state.viewDate.getFullYear(), m0 = state.viewDate.getMonth();
    var days = monthCache[state.id+'-'+y+'-'+(m0+1)];
    if(!days){ window.print(); return; }

    var mLabel = MONTHS_ID[m0]+' '+y;
    var addr = state.name + (state.daerah ? ', ' + state.daerah : '');
    var today = new Date();
    var todayStr = today.getFullYear()+'-'+pad(today.getMonth()+1)+'-'+pad(today.getDate());

    var rowsHtml = days.map(function(d){
      var dt = new Date(d.date+'T00:00:00');
      var isTd = d.date===todayStr;
      return '<tr'+(isTd?' class="jd-print-today"':'')+'>'+
        '<td>'+DAYS_ID[dt.getDay()]+'</td>'+
        '<td>'+dt.getDate()+' '+MONTHS_SHORT[dt.getMonth()]+'</td>'+
        '<td>'+toHijriShort(dt)+'</td>'+
        '<td>'+d.imsak+'</td>'+
        '<td>'+d.subuh+'</td>'+
        '<td>'+d.terbit+'</td>'+
        '<td>'+d.dhuha+'</td>'+
        '<td>'+d.dzuhur+'</td>'+
        '<td>'+d.ashar+'</td>'+
        '<td>'+d.maghrib+'</td>'+
        '<td>'+d.isya+'</td>'+
      '</tr>';
    }).join('');

    $('jdPrintSheet').innerHTML =
      '<div class="jd-print-hdr">'+
        (SITE_LOGO ? '<img class="jd-print-logo" src="'+SITE_LOGO+'" alt="">' : '')+
        '<div>'+
          '<p class="jd-print-brand">'+SITE_NAME+'</p>'+
          '<h1>Jadwal Shalat Bulan '+mLabel+' ('+hijriRangeLabel(y, m0)+')</h1>'+
          '<p>Lokasi: '+addr+'</p>'+
        '</div>'+
      '</div>'+
      '<table class="jd-print-table">'+
        '<thead><tr>'+
          '<th>Hari</th><th>Masehi</th><th>Hijriah</th><th>Imsak</th><th>Subuh</th>'+
          '<th>Terbit</th><th>Dhuha</th><th>Zuhur</th><th>Ashar</th><th>Maghrib</th><th>Isya</th>'+
        '</tr></thead>'+
        '<tbody>'+rowsHtml+'</tbody>'+
      '</table>'+
      '<p class="jd-print-foot">Jadwal dihitung berdasarkan data Kemenag RI via api.myquran.com. '+
        'Situs ini hanya membantu; silakan periksa kembali jadwal shalat resmi di daerah masing-masing.</p>';

    /* If we print immediately, the logo <img> may not have finished
       loading yet and comes out as a blank box — wait for it first. */
    var logoEl = $('jdPrintSheet').querySelector('img');
    if(logoEl && !logoEl.complete){
      var done = function(){ logoEl.removeEventListener('load', done); logoEl.removeEventListener('error', done); window.print(); };
      logoEl.addEventListener('load', done);
      logoEl.addEventListener('error', done);
      setTimeout(done, 1500); // fallback in case neither event fires
    } else {
      window.print();
    }
  });
  $('jdBtnShare').addEventListener('click', function(){
    if(!state.lastJadwal) return;
    var jadwal = state.lastJadwal;
    var tz = tzLabel(state.daerah);
    var dateLabel = state.viewDate.getDate()+' '+MONTHS_ID[state.viewDate.getMonth()]+' '+state.viewDate.getFullYear();
    var wilayah = 'Wilayah ' + displayLoc(state.name) + (state.daerah ? ', ' + titleCaseDaerah(state.daerah) : '');
    var lines = PRAYERS.map(function(p){ return p.name+': '+jadwal[p.key]+' '+tz; });

    var text = 'Jadwal Shalat\n'+
      wilayah+'\n'+
      'Tanggal '+dateLabel+' / '+toHijri(state.viewDate)+'\n\n'+
      lines.join('\n')+'\n\n'+
      location.href;

    if(navigator.share){
      navigator.share({ title:'Jadwal Shalat', text: text }).catch(function(){});
    } else if(navigator.clipboard){
      navigator.clipboard.writeText(text).then(function(){
        alert('Jadwal disalin ke clipboard.');
      }).catch(function(){});
    }
  });

  /* ── Init ── */
  fetch(API_KOTA).then(function(r){ return r.json(); }).then(function(d){
    cityList = d.data || [];
    var sid, snm;
    try{ sid=localStorage.getItem('jd_id'); snm=localStorage.getItem('jd_nm'); }catch(e){}
    state.id = sid || state.id;
    state.name = snm || state.name;
    fetchDay();
  }).catch(function(){
    $('jdLoading').innerHTML = '<i class="bx bx-error-circle" style="font-size:1.6rem;color:var(--jd-gold)"></i><br>Gagal memuat daftar kota.';
  });
})();
</script>

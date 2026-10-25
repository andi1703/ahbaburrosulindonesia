<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
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
        --ts-bg: #0b0d0d;
        --ts-surf: #131615;
        --ts-surf2: #191c1b;
        --ts-border: rgba(255, 255, 255, .07);
        --ts-text: #eef1ee;
        --ts-muted: #6d7e78;
        --ts-accent: #e8b84b;
        --ts-gold-dim: rgba(232, 184, 75, .12);
        --ts-nav: 62px;
        --ts-sub: 48px;
    }

    .ts-page {
        min-height: 100vh;
        padding-top: calc(var(--an-hdr-h, 62px) + var(--ts-sub));
        padding-bottom: 5rem;
        background: var(--ts-bg);
        color: var(--ts-text);
    }

    /* ── Subnav ── */
    .ts-subnav {
        position: fixed;
        top: var(--an-hdr-h, 62px);
        transition: top .32s ease;
        transition: top .32s ease;
        left: 0;
        right: 0;
        z-index: 120;
        height: var(--ts-sub);
        display: flex;
        align-items: center;
        background: #0d1010;
        border-bottom: 1px solid rgba(255, 255, 255, .06);
    }

    .ts-subnav-inner {
        display: flex;
        align-items: center;
        gap: .5rem;
        width: 100%;
        max-width: 860px;
        margin-inline: auto;
        padding-inline: 1rem;
    }

    .ts-pill {
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
        cursor: pointer;
    }

    .ts-pill:hover {
        border-color: var(--ts-accent);
        color: var(--ts-accent);
    }

    .ts-pill-ico {
        padding: 0 .7rem;
    }

    .ts-subnav-title {
        flex: 1;
        text-align: center;
        font-size: .75rem;
        font-weight: 600;
        color: #c8d0cc;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ── Body ── */
    .ts-body {
        width: min(100% - 2rem, 480px);
        margin-inline: auto;
        padding-block: 1.75rem;
    }

    /* ── Dzikir header ── */
    .ts-dzikir-hdr {
        text-align: center;
        margin-bottom: 1.35rem;
    }

    .ts-dzikir-arab-big {
        display: block;
        font-family: "LPMQ", serif;
        font-size: clamp(1.55rem, 5vw, 2.1rem);
        color: #fff;
        direction: rtl;
        line-height: 1.7;
        margin-bottom: .2rem;
    }

    .ts-dzikir-name-big {
        display: block;
        font-size: .85rem;
        font-weight: 700;
        color: var(--ts-accent);
        margin-bottom: .35rem;
    }

    .ts-target-chip {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        padding: .18rem .7rem;
        border-radius: 99px;
        background: var(--ts-gold-dim);
        color: var(--ts-accent);
        font-size: .68rem;
        font-weight: 600;
    }

    /* ── Ring ── */
    .ts-ring-btn {
        position: relative;
        width: min(270px, 78vw);
        margin: 0 auto 1.35rem;
        display: block;
        background: transparent;
        border: none;
        padding: 0;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
    }

    .ts-ring-btn:focus-visible {
        outline: 2px solid var(--ts-accent);
        outline-offset: 6px;
        border-radius: 50%;
    }

    .ts-ring-svg {
        width: 100%;
        height: auto;
        display: block;
    }

    .ts-ring-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        pointer-events: none;
        user-select: none;
    }

    .ts-count-big {
        display: block;
        font-size: clamp(2.8rem, 14vw, 4rem);
        font-weight: 900;
        color: #fff;
        line-height: 1;
        font-variant-numeric: tabular-nums;
        letter-spacing: -.02em;
    }

    .ts-laps-info {
        display: block;
        font-size: .63rem;
        color: var(--ts-muted);
        margin-top: .3rem;
    }

    /* ── Tap button ── */
    .ts-tap-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: .55rem;
        width: 100%;
        min-height: 60px;
        border: 2px solid rgba(232, 184, 75, .3);
        border-radius: 14px;
        background: rgba(232, 184, 75, .06);
        color: var(--ts-accent);
        font: inherit;
        font-size: .82rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .1s, border-color .1s, transform .08s;
        margin-bottom: 1.15rem;
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
    }

    .ts-tap-btn i {
        font-size: 1.5rem;
    }

    .ts-tap-btn:active {
        background: rgba(232, 184, 75, .14);
        transform: scale(.985);
    }

    /* ── Progress row ── */
    .ts-prog-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.2rem;
        margin-bottom: 1.15rem;
    }

    .ts-prog-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: .12rem;
    }

    .ts-prog-val {
        font-size: 1.3rem;
        font-weight: 800;
        color: #fff;
        font-variant-numeric: tabular-nums;
    }

    .ts-prog-lbl {
        font-size: .62rem;
        color: var(--ts-muted);
    }

    .ts-prog-divider {
        width: 1px;
        height: 26px;
        background: rgba(255, 255, 255, .08);
        flex-shrink: 0;
    }

    /* ── Action row ── */
    .ts-actions {
        display: flex;
        gap: .6rem;
        margin-bottom: 1.75rem;
    }

    .ts-act-btn {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        min-height: 38px;
        padding: 0 .9rem;
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: 99px;
        background: var(--ts-surf2);
        color: var(--ts-muted);
        font: inherit;
        font-size: .73rem;
        cursor: pointer;
        transition: border-color .14s, color .14s;
    }

    .ts-act-btn:hover {
        border-color: rgba(232, 184, 75, .4);
        color: var(--ts-accent);
    }

    .ts-act-danger:hover {
        border-color: rgba(239, 68, 68, .5) !important;
        color: #f87171 !important;
    }

    /* ── Tabs ── */
    .ts-tabs {
        display: flex;
        border-bottom: 1px solid var(--ts-border);
        margin-bottom: 1.15rem;
    }

    .ts-tab {
        flex: 1;
        min-height: 40px;
        padding: 0 .75rem;
        border: 0;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        background: transparent;
        color: var(--ts-muted);
        font: inherit;
        font-size: .76rem;
        cursor: pointer;
        transition: color .14s, border-color .14s;
    }

    .ts-tab.is-active {
        color: var(--ts-accent);
        border-bottom-color: var(--ts-accent);
        font-weight: 600;
    }

    /* ── Built-in dzikir grid ── */
    .ts-dz-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: .55rem;
        margin-bottom: 1.5rem;
    }

    .ts-dz-card {
        padding: .8rem .9rem;
        border: 1.5px solid rgba(255, 255, 255, .07);
        border-radius: 10px;
        background: var(--ts-surf2);
        cursor: pointer;
        text-align: right;
        transition: border-color .14s, background .14s;
    }

    .ts-dz-card:hover {
        border-color: rgba(232, 184, 75, .35);
        background: var(--ts-surf);
    }

    .ts-dz-card.is-active {
        border-color: var(--ts-accent);
        background: rgba(232, 184, 75, .06);
    }

    .ts-dz-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: 1.1rem;
        color: #fff;
        direction: rtl;
        line-height: 1.6;
        margin-bottom: .25rem;
    }

    .ts-dz-name {
        display: block;
        font-size: .65rem;
        color: var(--ts-muted);
        text-align: left;
    }

    .ts-dz-target {
        display: block;
        font-size: .62rem;
        color: var(--ts-accent);
        text-align: left;
        font-weight: 600;
        margin-top: .1rem;
    }

    /* ── Custom panel ── */
    .ts-custom-form {
        padding: 1rem;
        border: 1px solid var(--ts-border);
        border-radius: 12px;
        background: var(--ts-surf2);
        margin-bottom: .85rem;
    }

    .ts-form-title {
        font-size: .78rem;
        font-weight: 700;
        color: #fff;
        margin: 0 0 .8rem;
    }

    .ts-field {
        margin-bottom: .6rem;
    }

    .ts-label {
        display: block;
        font-size: .67rem;
        color: var(--ts-muted);
        margin-bottom: .22rem;
    }

    .ts-input {
        width: 100%;
        min-height: 38px;
        padding: 0 .85rem;
        border: 1px solid rgba(255, 255, 255, .1);
        border-radius: 8px;
        background: #0e1110;
        color: #fff;
        font: inherit;
        font-size: .78rem;
        outline: none;
        box-sizing: border-box;
        transition: border-color .14s;
    }

    .ts-input:focus {
        border-color: rgba(232, 184, 75, .45);
    }

    .ts-input-arab {
        text-align: right;
        direction: rtl;
        font-family: "LPMQ", serif;
        font-size: 1.05rem;
        min-height: 56px;
        padding-block: .55rem;
        resize: none;
    }

    .ts-add-btn {
        width: 100%;
        min-height: 40px;
        border: 0;
        border-radius: 99px;
        background: var(--ts-accent);
        color: #1a1200;
        font: inherit;
        font-size: .78rem;
        font-weight: 700;
        cursor: pointer;
        transition: opacity .14s;
    }

    .ts-add-btn:hover {
        opacity: .88;
    }

    .ts-add-btn:disabled {
        opacity: .45;
        cursor: default;
    }

    .ts-custom-list {
        display: flex;
        flex-direction: column;
        gap: .5rem;
    }

    .ts-custom-item {
        display: flex;
        align-items: center;
        gap: .7rem;
        padding: .75rem .9rem;
        border: 1px solid rgba(255, 255, 255, .07);
        border-radius: 10px;
        background: var(--ts-surf2);
        cursor: pointer;
        transition: border-color .14s;
    }

    .ts-custom-item:hover {
        border-color: rgba(232, 184, 75, .35);
    }

    .ts-custom-item.is-active {
        border-color: var(--ts-accent);
    }

    .ts-ci-copy {
        flex: 1;
        min-width: 0;
    }

    .ts-ci-arab {
        display: block;
        font-family: "LPMQ", serif;
        font-size: 1.05rem;
        color: #fff;
        direction: rtl;
        text-align: right;
        line-height: 1.5;
    }

    .ts-ci-name {
        display: block;
        font-size: .67rem;
        color: var(--ts-muted);
        margin-top: .18rem;
    }

    .ts-del-btn {
        flex-shrink: 0;
        display: grid;
        place-items: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: transparent;
        border: 0;
        color: var(--ts-muted);
        font-size: .95rem;
        cursor: pointer;
        transition: color .14s, background .14s;
    }

    .ts-del-btn:hover {
        color: #f87171;
        background: rgba(239, 68, 68, .08);
    }

    .ts-empty {
        text-align: center;
        padding: 2rem 1rem;
        color: var(--ts-muted);
        font-size: .78rem;
        line-height: 1.6;
    }

    .ts-empty i {
        display: block;
        font-size: 2rem;
        color: #2e3a36;
        margin-bottom: .5rem;
    }

    /* ── Complete overlay ── */
    .ts-flash {
        position: fixed;
        inset: 0;
        z-index: 990;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .78);
        opacity: 0;
        pointer-events: none;
        transition: opacity .28s;
    }

    .ts-flash.is-show {
        opacity: 1;
        pointer-events: auto;
    }

    .ts-flash-box {
        text-align: center;
        padding: 2.5rem 1.75rem;
        border-radius: 20px;
        background: #141716;
        border: 1px solid rgba(232, 184, 75, .28);
        max-width: 300px;
        width: 90%;
        transform: scale(.92);
        transition: transform .28s;
    }

    .ts-flash.is-show .ts-flash-box {
        transform: scale(1);
    }

    .ts-flash-icon {
        font-size: 2.8rem;
        color: var(--ts-accent);
        margin-bottom: .6rem;
    }

    .ts-flash-title {
        font-size: 1.2rem;
        font-weight: 800;
        color: #fff;
        margin: 0 0 .35rem;
    }

    .ts-flash-sub {
        font-size: .78rem;
        color: var(--ts-muted);
        margin: 0 0 1.25rem;
        line-height: 1.5;
    }

    .ts-flash-close {
        display: inline-flex;
        align-items: center;
        gap: .35rem;
        padding: .55rem 1.6rem;
        border: 0;
        border-radius: 99px;
        background: var(--ts-accent);
        color: #1a1200;
        font: inherit;
        font-size: .8rem;
        font-weight: 700;
        cursor: pointer;
    }

    /* ── Lap complete animation ── */
    @keyframes ts-bead-lit {

        0%,
        100% {
            opacity: 1
        }

        50% {
            opacity: .55
        }
    }

    .ts-bead-flash {
        animation: ts-bead-lit .45s ease 2;
    }

    @media (max-width: 479px) {
        .ts-count-big {
            font-size: 2.7rem;
        }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<nav class="ts-subnav" aria-label="Navigasi Tasbih">
    <div class="ts-subnav-inner">
        <a class="ts-pill ts-pill-ico" href="<?= base_url('index.php/amalan'); ?>" title="Kembali ke Amalan">
            <i class="bx bx-grid-alt"></i>
        </a>
        <span class="ts-subnav-title">Tasbih Digital</span>
        <button class="ts-pill ts-pill-ico" id="ts-sound-toggle" type="button" title="Toggle Suara">
            <i class="bx bxs-volume-full" id="ts-sound-icon"></i>
        </button>
    </div>
</nav>

<main class="ts-page">
    <div class="ts-body">

        <!-- Dzikir header -->
        <div class="ts-dzikir-hdr">
            <span class="ts-dzikir-arab-big" lang="ar" dir="rtl" id="ts-hdr-arab">سُبْحَانَ اللَّهِ</span>
            <span class="ts-dzikir-name-big" id="ts-hdr-name">Subhanallah</span>
            <span class="ts-target-chip">
                <i class="bx bx-target-lock"></i>
                Target: <strong id="ts-hdr-target">33</strong>×
            </span>
        </div>

        <!-- Tasbih ring (tappable) -->
        <button class="ts-ring-btn" id="ts-ring-btn" type="button" aria-label="Ketuk untuk dzikir">
            <svg class="ts-ring-svg" viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <!-- Track -->
                <circle class="ts-ring-track" cx="150" cy="150" r="115" fill="none"
                    stroke="rgba(255,255,255,.04)" stroke-width="22" />
                <!-- 33 beads -->
                <?php
                $num_beads = 33;
                for ($i = 0; $i < $num_beads; $i++):
                    $angle   = deg2rad(-90 + (360 / $num_beads) * $i);
                    $bx      = round(150 + 115 * cos($angle), 2);
                    $by      = round(150 + 115 * sin($angle), 2);
                    $is_mark = ($i === 0);
                    $br      = $is_mark ? 11 : 8;
                ?>
                    <circle
                        data-ts-bead="<?= $i ?>"
                        cx="<?= $bx ?>" cy="<?= $by ?>" r="<?= $br ?>"
                        fill="<?= $is_mark ? '#b8850e' : '#1e2422' ?>"
                        stroke="<?= $is_mark ? 'rgba(232,184,75,.55)' : 'rgba(255,255,255,.07)' ?>"
                        stroke-width="1.5" />
                <?php endfor; ?>
                <!-- Inner tap circle -->
                <circle cx="150" cy="150" r="90" fill="rgba(232,184,75,.02)" stroke="none" />
            </svg>
            <!-- Count overlay -->
            <div class="ts-ring-center">
                <span class="ts-count-big" id="ts-count-big">0</span>
                <span class="ts-laps-info" id="ts-laps-info"></span>
            </div>
        </button>

        <!-- Tap button (accessibility + large target) -->
        <button class="ts-tap-btn" id="ts-tap-btn" type="button">
            <i class="bx bxs-hand-up"></i>
            <span>Ketuk untuk Dzikir</span>
        </button>

        <!-- Progress row -->
        <div class="ts-prog-row">
            <div class="ts-prog-item">
                <span class="ts-prog-val" id="ts-prog-total">0</span>
                <span class="ts-prog-lbl">Total</span>
            </div>
            <div class="ts-prog-divider"></div>
            <div class="ts-prog-item">
                <span class="ts-prog-val" id="ts-prog-laps">0</span>
                <span class="ts-prog-lbl">Putaran</span>
            </div>
            <div class="ts-prog-divider"></div>
            <div class="ts-prog-item">
                <span class="ts-prog-val" id="ts-prog-target">33</span>
                <span class="ts-prog-lbl">Target</span>
            </div>
        </div>

        <!-- Action buttons -->
        <div class="ts-actions">
            <button class="ts-act-btn" id="ts-undo-btn" type="button">
                <i class="bx bx-undo"></i> Undo
            </button>
            <button class="ts-act-btn ts-act-danger" id="ts-reset-btn" type="button">
                <i class="bx bx-reset"></i> Reset
            </button>
        </div>

        <!-- Tabs -->
        <div class="ts-tabs" role="tablist">
            <button class="ts-tab is-active" type="button" role="tab" data-ts-tab="dzikir">
                <i class="bx bx-list-ul"></i> Pilih Dzikir
            </button>
            <button class="ts-tab" type="button" role="tab" data-ts-tab="custom">
                <i class="bx bx-plus-circle"></i> Dzikir Saya
            </button>
        </div>

        <!-- Panel: Built-in -->
        <div data-ts-panel="dzikir">
            <div class="ts-dz-grid" id="ts-builtin-grid"></div>
        </div>

        <!-- Panel: Custom -->
        <div data-ts-panel="custom" hidden>
            <div class="ts-custom-form">
                <p class="ts-form-title">Tambah Dzikir Baru</p>
                <div class="ts-field">
                    <label class="ts-label" for="ts-inp-arab">Teks Arab</label>
                    <textarea class="ts-input ts-input-arab" id="ts-inp-arab" rows="2"
                        placeholder="اَللّٰهُ اَكۡبَرُ" dir="rtl"></textarea>
                </div>
                <div class="ts-field">
                    <label class="ts-label" for="ts-inp-name">Nama Dzikir</label>
                    <input class="ts-input" id="ts-inp-name" type="text" placeholder="Allahu Akbar">
                </div>
                <div class="ts-field">
                    <label class="ts-label" for="ts-inp-target">Target Hitungan</label>
                    <input class="ts-input" id="ts-inp-target" type="number" min="1" max="9999" value="33">
                </div>
                <button class="ts-add-btn" id="ts-add-btn" type="button">Simpan Dzikir</button>
            </div>
            <div class="ts-custom-list" id="ts-custom-list"></div>
        </div>

        <?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Banner.php'; ?>

    </div>
</main>

<!-- Complete overlay -->
<div class="ts-flash" id="ts-flash" role="dialog" aria-modal="true">
    <div class="ts-flash-box">
        <div class="ts-flash-icon"><i class="bx bx-award"></i></div>
        <p class="ts-flash-title">Alhamdulillah!</p>
        <p class="ts-flash-sub" id="ts-flash-sub">Target tercapai.<br>Semoga amalan diterima Allah ﷻ</p>
        <button class="ts-flash-close" id="ts-flash-close" type="button">
            <i class="bx bx-check"></i> Lanjutkan
        </button>
    </div>
</div>

<script>
    (function() {
        'use strict';

        /* ── Built-in dzikir ──────────────────────────────────── */
        var BUILTIN = [{
                id: 'subhanallah',
                arab: 'سُبْحَانَ اللَّهِ',
                name: 'Subhanallah',
                target: 33
            },
            {
                id: 'alhamdulillah',
                arab: 'الْحَمْدُ لِلَّهِ',
                name: 'Alhamdulillah',
                target: 33
            },
            {
                id: 'allahu-akbar',
                arab: 'اللَّهُ أَكْبَرُ',
                name: 'Allahu Akbar',
                target: 33
            },
            {
                id: 'la-ilaha-illallah',
                arab: 'لَا إِلَهَ إِلَّا اللَّهُ',
                name: 'La Ilaha Illallah',
                target: 100
            },
            {
                id: 'astaghfirullah',
                arab: 'أَسْتَغْفِرُ اللَّهَ الْعَظِيمَ',
                name: 'Astaghfirullah',
                target: 1000
            },
            {
                id: 'sholawat',
                arab: ' صَلَّى اللهُ عَلَى مُحَمَّد',
                name: 'Sholawat Nabi',
                target: 1000
            },
            {
                id: 'hasbunallah',
                arab: 'حَسْبُنَا اللَّهُ وَنِعْمَ الْوَكِيلُ',
                name: "Hasbunallah Wani'mal Wakil",
                target: 450
            },
            {
                id: 'subhanallahi-wabiham',
                arab: 'اَللّٰهُ',
                name: 'Allah',
                target: 100
            }
        ];

        /* ── State ───────────────────────────────────────────── */
        var state = {
            activeId: 'subhanallah',
            counts: {},
            sound: true,
            custom: []
        };
        var _beads = null;
        var _flashing = false;
        var _lastTap = 0;
        var _audioCtx = null;

        /* ── Storage helpers ─────────────────────────────────── */
        function lsGet(k) {
            try {
                return JSON.parse(localStorage.getItem(k));
            } catch (e) {
                return null;
            }
        }

        function lsSet(k, v) {
            try {
                localStorage.setItem(k, JSON.stringify(v));
            } catch (e) {}
        }

        function loadState() {
            var s = lsGet('ts_state_v2');
            if (s) {
                state.activeId = s.activeId || 'subhanallah';
                state.counts = s.counts || {};
                state.sound = s.sound !== false;
            }
            var c = lsGet('ts_custom');
            if (Array.isArray(c)) state.custom = c;
        }

        function saveState() {
            lsSet('ts_state_v2', {
                activeId: state.activeId,
                counts: state.counts,
                sound: state.sound
            });
        }

        function saveCustom() {
            lsSet('ts_custom', state.custom);
        }

        /* ── Audio ───────────────────────────────────────────── */
        function getAudioCtx() {
            if (!_audioCtx) {
                try {
                    _audioCtx = new(window.AudioContext || window.webkitAudioContext)();
                } catch (e) {}
            }
            return _audioCtx;
        }

        function playClick() {
            if (!state.sound) return;
            try {
                var ctx = getAudioCtx();
                if (!ctx) return;
                if (ctx.state === 'suspended') ctx.resume();
                var t = ctx.currentTime;
                var buf = ctx.createBuffer(1, Math.floor(ctx.sampleRate * 0.055), ctx.sampleRate);
                var d = buf.getChannelData(0);
                for (var i = 0; i < d.length; i++) {
                    d[i] = (Math.random() * 2 - 1) * Math.pow(1 - i / d.length, 1.4) * 0.85;
                }
                var src = ctx.createBufferSource();
                src.buffer = buf;
                var filt = ctx.createBiquadFilter();
                filt.type = 'bandpass';
                filt.frequency.value = 1800;
                filt.Q.value = 0.9;
                var gain = ctx.createGain();
                gain.gain.setValueAtTime(0.6, t);
                gain.gain.exponentialRampToValueAtTime(0.001, t + 0.055);
                src.connect(filt);
                filt.connect(gain);
                gain.connect(ctx.destination);
                src.start(t);
            } catch (e) {}
        }

        function playChime() {
            if (!state.sound) return;
            try {
                var ctx = getAudioCtx();
                if (!ctx) return;
                if (ctx.state === 'suspended') ctx.resume();
                [523, 659, 784].forEach(function(freq, i) {
                    var t = ctx.currentTime + i * 0.13;
                    var osc = ctx.createOscillator();
                    var gain = ctx.createGain();
                    osc.type = 'sine';
                    osc.frequency.value = freq;
                    gain.gain.setValueAtTime(0, t);
                    gain.gain.linearRampToValueAtTime(0.22, t + 0.02);
                    gain.gain.exponentialRampToValueAtTime(0.001, t + 0.25);
                    osc.connect(gain);
                    gain.connect(ctx.destination);
                    osc.start(t);
                    osc.stop(t + 0.25);
                });
            } catch (e) {}
        }

        /* ── Dzikir helpers ──────────────────────────────────── */
        function getAllDzikir() {
            return BUILTIN.concat(state.custom);
        }

        function getDzikir(id) {
            var all = getAllDzikir();
            for (var i = 0; i < all.length; i++) {
                if (all[i].id === id) return all[i];
            }
            return BUILTIN[0];
        }

        function curDzikir() {
            return getDzikir(state.activeId);
        }

        function curCounts() {
            if (!state.counts[state.activeId]) state.counts[state.activeId] = {
                count: 0,
                laps: 0
            };
            return state.counts[state.activeId];
        }

        function total() {
            var c = curCounts();
            return c.laps * 33 + c.count;
        }

        /* ── SVG beads ───────────────────────────────────────── */
        function getBeads() {
            if (!_beads) _beads = document.querySelectorAll('[data-ts-bead]');
            return _beads;
        }

        function isLight() {
            return document.documentElement.getAttribute('data-theme') === 'light';
        }

        function updateBeads(countInLap) {
            if (_flashing) return;
            var light = isLight();
            getBeads().forEach(function(bead) {
                var idx = parseInt(bead.getAttribute('data-ts-bead'), 10);
                if (idx === 0) return; // marker bead stays fixed
                if (idx <= countInLap) {
                    bead.setAttribute('fill', '#e8b84b');
                    bead.setAttribute('stroke', 'rgba(240,200,80,.45)');
                } else if (idx === countInLap + 1) {
                    bead.setAttribute('fill', light ? '#c8dfd6' : '#33402e');
                    bead.setAttribute('stroke', 'rgba(232,184,75,.2)');
                } else {
                    bead.setAttribute('fill', light ? '#d8e8e0' : '#1e2422');
                    bead.setAttribute('stroke', light ? 'rgba(0,0,0,.1)' : 'rgba(255,255,255,.07)');
                }
            });
        }

        function flashBeads(callback) {
            _flashing = true;
            getBeads().forEach(function(bead) {
                if (parseInt(bead.getAttribute('data-ts-bead'), 10) === 0) return;
                bead.setAttribute('fill', '#f0c95e');
                bead.setAttribute('stroke', 'rgba(250,210,90,.6)');
            });
            setTimeout(function() {
                _flashing = false;
                if (callback) callback();
            }, 500);
        }

        /* ── UI update ───────────────────────────────────────── */
        function updateUI() {
            var dz = curDzikir();
            var c = curCounts();
            var tot = total();
            var lapN = c.laps;

            document.getElementById('ts-hdr-arab').textContent = dz.arab;
            document.getElementById('ts-hdr-name').textContent = dz.name;
            document.getElementById('ts-hdr-target').textContent = dz.target;

            document.getElementById('ts-count-big').textContent = tot;
            document.getElementById('ts-laps-info').textContent = lapN > 0 ? lapN + ' putaran selesai' : '';

            document.getElementById('ts-prog-total').textContent = tot;
            document.getElementById('ts-prog-laps').textContent = lapN;
            document.getElementById('ts-prog-target').textContent = dz.target;

            document.getElementById('ts-sound-icon').className = state.sound ? 'bx bxs-volume-full' : 'bx bxs-volume-mute';

            updateBeads(c.count);

            document.querySelectorAll('[data-ts-dz-id]').forEach(function(el) {
                el.classList.toggle('is-active', el.getAttribute('data-ts-dz-id') === state.activeId);
            });
        }

        /* ── Tap handler ─────────────────────────────────────── */
        function handleTap() {
            var now = Date.now();
            if (now - _lastTap < 80) return;
            _lastTap = now;

            var c = curCounts();
            var dz = curDzikir();
            var prevTotal = total();

            c.count++;
            var lapDone = (c.count === 33);

            if (lapDone) {
                c.laps++;
                c.count = 0;
                flashBeads(function() {
                    updateBeads(0);
                });
            }

            var newTotal = total();

            if (prevTotal < dz.target && newTotal >= dz.target) {
                // Target selesai — getar panjang-pendek-panjang
                if (navigator.vibrate) navigator.vibrate([80, 50, 80, 50, 200]);
                showComplete(dz, newTotal);
            } else if (lapDone) {
                // Putaran selesai — 3 getaran pendek
                if (navigator.vibrate) navigator.vibrate([30, 40, 30, 40, 30]);
                playChime();
            } else {
                // Ketukan biasa — getar singkat
                if (navigator.vibrate) navigator.vibrate(14);
                playClick();
            }

            updateUI();
            saveState();
        }

        function showComplete(dz, tot) {
            document.getElementById('ts-flash-sub').innerHTML =
                escHtml(dz.name) + ' × ' + tot + '<br>Semoga amalan diterima Allah ﷻ';
            document.getElementById('ts-flash').classList.add('is-show');
            playChime();
        }

        /* ── Render dzikir cards ─────────────────────────────── */
        function renderBuiltin() {
            var grid = document.getElementById('ts-builtin-grid');
            grid.innerHTML = '';
            BUILTIN.forEach(function(dz) {
                var el = document.createElement('div');
                el.className = 'ts-dz-card' + (dz.id === state.activeId ? ' is-active' : '');
                el.setAttribute('data-ts-dz-id', dz.id);
                el.setAttribute('role', 'button');
                el.setAttribute('tabindex', '0');
                el.innerHTML =
                    '<span class="ts-dz-arab" lang="ar">' + dz.arab + '</span>' +
                    '<span class="ts-dz-name">' + dz.name + '</span>' +
                    '<span class="ts-dz-target"><i class="bx bx-target-lock"></i> ' + dz.target + '×</span>';
                el.addEventListener('click', function() {
                    selectDzikir(dz.id);
                });
                el.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') selectDzikir(dz.id);
                });
                grid.appendChild(el);
            });
        }

        function renderCustom() {
            var list = document.getElementById('ts-custom-list');
            if (state.custom.length === 0) {
                list.innerHTML = '<div class="ts-empty"><i class="bx bx-edit"></i>Belum ada dzikir kustom.<br>Tambahkan di atas.</div>';
                return;
            }
            list.innerHTML = '';
            state.custom.forEach(function(dz) {
                var el = document.createElement('div');
                el.className = 'ts-custom-item' + (dz.id === state.activeId ? ' is-active' : '');
                el.setAttribute('data-ts-dz-id', dz.id);
                el.innerHTML =
                    '<div class="ts-ci-copy">' +
                    '<span class="ts-ci-arab" lang="ar">' + escHtml(dz.arab) + '</span>' +
                    '<span class="ts-ci-name">' + escHtml(dz.name) + ' · ' + (dz.target || 33) + '×</span>' +
                    '</div>' +
                    '<button class="ts-del-btn" type="button" title="Hapus"><i class="bx bx-trash"></i></button>';
                el.querySelector('.ts-ci-copy').addEventListener('click', function() {
                    selectDzikir(dz.id);
                });
                el.querySelector('.ts-del-btn').addEventListener('click', function(e) {
                    e.stopPropagation();
                    deleteCustom(dz.id);
                });
                list.appendChild(el);
            });
        }

        function escHtml(str) {
            return String(str)
                .replace(/&/g, '&amp;').replace(/</g, '&lt;')
                .replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        function selectDzikir(id) {
            state.activeId = id;
            saveState();
            renderBuiltin();
            renderCustom();
            updateUI();
            document.querySelector('.ts-body').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function deleteCustom(id) {
            state.custom = state.custom.filter(function(d) {
                return d.id !== id;
            });
            if (state.activeId === id) {
                state.activeId = 'subhanallah';
                updateUI();
            }
            saveCustom();
            saveState();
            renderCustom();
        }

        /* ── Add custom ──────────────────────────────────────── */
        function addCustom() {
            var arab = document.getElementById('ts-inp-arab').value.trim();
            var name = document.getElementById('ts-inp-name').value.trim();
            var target = parseInt(document.getElementById('ts-inp-target').value, 10) || 33;
            if (!arab || !name) return;
            state.custom.push({
                id: 'c' + Date.now(),
                arab: arab,
                name: name,
                target: target
            });
            saveCustom();
            renderCustom();
            document.getElementById('ts-inp-arab').value = '';
            document.getElementById('ts-inp-name').value = '';
            document.getElementById('ts-inp-target').value = '33';
        }

        /* ── Tabs ────────────────────────────────────────────── */
        function initTabs() {
            var tabs = document.querySelectorAll('[data-ts-tab]');
            var panels = document.querySelectorAll('[data-ts-panel]');
            tabs.forEach(function(tab) {
                tab.addEventListener('click', function() {
                    var tgt = tab.getAttribute('data-ts-tab');
                    tabs.forEach(function(t) {
                        t.classList.toggle('is-active', t.getAttribute('data-ts-tab') === tgt);
                    });
                    panels.forEach(function(p) {
                        p.hidden = p.getAttribute('data-ts-panel') !== tgt;
                    });
                });
            });
        }

        /* ── Reset / Undo ────────────────────────────────────── */
        function resetCurrent() {
            if (!confirm('Reset hitungan ' + curDzikir().name + '?')) return;
            state.counts[state.activeId] = {
                count: 0,
                laps: 0
            };
            saveState();
            updateUI();
        }

        function undoLast() {
            var c = curCounts();
            if (c.count === 0 && c.laps === 0) return;
            if (c.count === 0 && c.laps > 0) {
                c.laps--;
                c.count = 32;
            } else {
                c.count--;
            }
            saveState();
            updateUI();
        }

        /* ── Init ────────────────────────────────────────────── */
        function init() {
            loadState();
            renderBuiltin();
            renderCustom();
            initTabs();
            updateUI();

            var ringBtn = document.getElementById('ts-ring-btn');
            var tapBtn = document.getElementById('ts-tap-btn');
            ringBtn.addEventListener('click', handleTap);
            tapBtn.addEventListener('click', handleTap);

            document.getElementById('ts-sound-toggle').addEventListener('click', function() {
                state.sound = !state.sound;
                getAudioCtx(); // resume context
                saveState();
                updateUI();
            });

            document.getElementById('ts-reset-btn').addEventListener('click', resetCurrent);
            document.getElementById('ts-undo-btn').addEventListener('click', undoLast);
            document.getElementById('ts-add-btn').addEventListener('click', addCustom);

            document.getElementById('ts-inp-arab').addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    addCustom();
                }
            });

            var flash = document.getElementById('ts-flash');
            document.getElementById('ts-flash-close').addEventListener('click', function() {
                flash.classList.remove('is-show');
            });
            flash.addEventListener('click', function(e) {
                if (e.target === flash) flash.classList.remove('is-show');
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            init();
            new MutationObserver(function() {
                updateBeads(curCounts().count);
            }).observe(document.documentElement, {
                attributes: true,
                attributeFilter: ['data-theme']
            });
        });
    })();
</script>
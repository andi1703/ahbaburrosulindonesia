<?php
defined('BASEPATH') or exit('No direct script access allowed');

$verses             = $verses             ?? [];
$reader_title       = $reader_title       ?? 'Al-Qur\'an';
$reader_arabic      = $reader_arabic      ?? 'القرآن الكريم';
$reader_translation = $reader_translation ?? '';
$reader_subtitle    = $reader_subtitle    ?? '';
$reader_type        = $reader_type        ?? 'surah';
$reader_number      = $reader_number      ?? 1;
$reader_juz         = $reader_juz         ?? 1;
$reader_verse_count = $reader_verse_count ?? count($verses);
$prev_name          = $prev_name          ?? null;
$next_name          = $next_name          ?? null;
$last_surah_number  = 0;

/* Convert integer to Arabic-Indic numeral string */
function qr_arabic_num(int $n): string
{
  static $map = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
  $out = '';
  foreach (str_split((string) $n) as $d) {
    $out .= $map[(int)$d];
  }
  return $out;
}
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

  @font-face {
    font-family: "QCF4-QBSML";
    src: url("<?= base_url('assets/frontend/fonts/QCF4_QBSML.woff2'); ?>") format("woff2");
    font-weight: 400;
    font-display: swap;
  }

  /* ── Tokens ── */
  :root {
    --qr-bg: #0b0d0d;
    --qr-surf: #131615;
    --qr-border: rgba(255, 255, 255, .07);
    --qr-text: #eef1ee;
    --qr-muted: #6d7e78;
    --qr-accent: #e8b84b;
    --qr-gold: #e8b84b;
    --qr-nav: 62px;
    --qr-sub: 48px;
  }

  /* ── Page ── */
  .qr-page {
    min-height: 100vh;
    padding-top: calc(var(--qr-nav) + var(--qr-sub));
    padding-bottom: 5rem;
    background: var(--qr-bg);
    color: var(--qr-text);
  }

  /* ── Sub-nav ── */
  .qr-subnav {
    position: fixed;
    top: var(--an-hdr-h, 62px);
    transition: top .32s ease;
    left: 0;
    right: 0;
    z-index: 120;
    height: var(--qr-sub);
    display: flex;
    align-items: center;
    background: #0d1010;
    border-bottom: 1px solid rgba(255, 255, 255, .06);
  }

  .qr-subnav-inner {
    display: flex;
    align-items: center;
    gap: .5rem;
    width: 100%;
    max-width: 860px;
    margin-inline: auto;
    padding-inline: 1rem;
  }

  /* Left slot — always pinned to left edge */
  .qr-subnav-left {
    flex-shrink: 0;
  }

  /* Center slot — takes all remaining space, contents centered */
  .qr-subnav-center {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .35rem;
    overflow-x: auto;
    scrollbar-width: none;
    min-width: 0;
  }

  .qr-subnav-center::-webkit-scrollbar {
    display: none;
  }

  /* pill button */
  .qr-pill {
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
    cursor: pointer;
    flex-shrink: 0;
    transition: border-color .14s, color .14s, background .14s;
  }

  .qr-pill:hover {
    border-color: var(--qr-accent);
    color: var(--qr-accent);
  }

  .qr-pill.is-active {
    border-color: var(--qr-accent);
    background: rgba(232, 184, 75, .08);
    color: var(--qr-accent);
    font-weight: 600;
  }

  /* Surah indicator — juz mode only, auto-updates on scroll */
  .qr-surah-indicator {
    border-color: rgba(232, 184, 75, .3);
    background: rgba(232, 184, 75, .06);
    color: var(--qr-gold);
    pointer-events: none;
    max-width: 9rem;
    overflow: hidden;
    text-overflow: ellipsis;
    opacity: 0;
    transition: opacity .2s;
  }

  .qr-surah-indicator.is-visible {
    opacity: 1;
  }

  /* arrow */
  .qr-arrow {
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

  .qr-arrow i {
    font-size: 1.15rem;
    flex-shrink: 0;
  }

  .qr-arrow:hover {
    border-color: var(--qr-accent);
    color: var(--qr-accent);
  }

  .qr-arrow[aria-disabled="true"] {
    opacity: .25;
    pointer-events: none;
  }

  /* Arrow label: hidden on mobile, shown on wider screens */
  .qr-arrow-name {
    display: none;
    max-width: 10rem;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  @media (min-width: 580px) {
    .qr-arrow-name {
      display: inline;
    }
  }

  /* ── Content wrap ── */
  .qr-body {
    width: min(100% - 2rem, 820px);
    margin-inline: auto;
  }

  /* ── Surah header ── */
  .qr-hdr {
    padding: 1rem 0 1rem;
    text-align: center;
    border-bottom: 1px solid var(--qr-border);
  }

  .qr-hdr--juz {
    padding-top: .6rem;
  }

  .qr-hdr-meta {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .28rem .9rem;
    border-radius: 99px;
    background: rgba(255, 255, 255, .05);
    color: var(--qr-muted);
    font-size: .68rem;
    margin-bottom: .7rem;
  }

  .qr-hdr-meta span+span::before {
    content: '·';
    margin-right: .5rem;
  }

  .qr-hdr-ar {
    display: block;
    font-family: "LPMQ", "Amiri", serif;
    font-size: clamp(2rem, 5vw, 2.8rem);
    line-height: 1.5;
    color: #fff;
    margin-bottom: .2rem;
    direction: rtl;
  }

  .qr-hdr-ar--qbsml {
    font-family: "QCF4-QBSML", serif;
    font-size: clamp(3rem, 8vw, 4.2rem);
    line-height: 1.4;
    max-width: 100%;
    overflow: hidden;
  }

  @media (max-width: 480px) {
    .qr-hdr-ar--qbsml {
      font-size: 3rem !important;
      font-weight: 500;
    }

    .qr-hdr-ar {
      font-size: 1.9rem;
    }
  }

  .qr-hdr-name {
    margin: 0 0 .2rem;
    font-size: clamp(1.3rem, 3.5vw, 1.65rem);
    font-weight: 800;
    color: #fff;
  }

  .qr-hdr-trans {
    margin: 0;
    font-size: .82rem;
    color: var(--qr-muted);
  }

  /* ── Bismillah ── */
  @import url('https://fonts.googleapis.com/css2?family=Amiri&display=swap');

  .qr-bismillah {
    padding: 1.25rem 1rem .85rem;
    text-align: center;
    font-family: "Amiri", "LPMQ", serif;
    font-size: clamp(2.0rem, 5vw, 2.4rem);
    line-height: 1.8;
    color: #fff;
    direction: rtl;
    border-bottom: 1px solid var(--qr-border);
    font-feature-settings: "liga" 1, "calt" 1;
    letter-spacing: 0;
    overflow: hidden;
  }

  :root[data-theme="light"] .qr-bismillah {
    color: #1a0e00;
  }

  /* ── Surah divider (juz) — ornamental frame ── */
  .qr-divider {
    margin: 2.25rem 0 1.75rem;
    position: relative;
  }

  /* Repeating diamond border row */
  .qr-divider-ornament {
    height: 9px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='9'%3E%3Cpolygon points='7,0 13,4.5 7,9 1,4.5' fill='%23e8b84b' opacity='.6'/%3E%3C/svg%3E");
    background-repeat: repeat-x;
    background-size: 14px 9px;
  }

  /* Main ornamental frame */
  .qr-divider-frame {
    position: relative;
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    align-items: center;
    border: 2px solid var(--qr-accent);
    background: var(--qr-surf);
    padding: .85rem 1rem;
  }

  /* Inner double-border via pseudo-element */
  .qr-divider-frame::after {
    content: '';
    position: absolute;
    inset: 5px;
    border: 1px solid rgba(232, 184, 75, .28);
    pointer-events: none;
  }

  /* Corner diamond ornaments */
  .qr-dc {
    position: absolute;
    width: 14px;
    height: 14px;
    background: var(--qr-accent);
    clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
    z-index: 1;
  }

  .qr-dc--tl {
    top: -7px;
    left: -7px;
  }

  .qr-dc--tr {
    top: -7px;
    right: -7px;
  }

  .qr-dc--bl {
    bottom: -7px;
    left: -7px;
  }

  .qr-dc--br {
    bottom: -7px;
    right: -7px;
  }

  /* Left panel: latin surah name + link */
  .qr-divider-panel {
    display: flex;
    flex-direction: column;
    gap: .25rem;
    padding-right: 1rem;
    border-right: 1px solid rgba(232, 184, 75, .22);
  }

  /* Right panel: surah number */
  .qr-divider-panel--r {
    padding-right: 0;
    padding-left: 1rem;
    border-right: none;
    border-left: 1px solid rgba(232, 184, 75, .22);
    align-items: flex-end;
    text-align: right;
  }

  /* Center body: big calligraphic Arabic name */
  .qr-divider-body {
    text-align: center;
    padding: 0 1.25rem;
  }

  .qr-divider-ar {
    font-family: "QCF4-QBSML", serif;
    font-size: 2rem;
    color: var(--qr-text);
    direction: rtl;
    line-height: 1.5;
    display: block;
  }

  .qr-divider-name {
    display: block;
    font-size: .92rem;
    font-weight: 700;
    color: var(--qr-text);
  }

  .qr-divider-meaning {
    display: block;
    font-size: .72rem;
    color: var(--qr-muted);
    font-style: italic;
  }

  /* Surah number — Arabic numeral, prominent */
  .qr-divider-num {
    display: block;
    font-family: "LPMQ", "Amiri", serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--qr-text);
    line-height: 1;
    text-align: right;
    direction: rtl;
  }

  .qr-divider-num-label {
    display: block;
    font-size: .6rem;
    color: var(--qr-muted);
    text-align: right;
    letter-spacing: .04em;
    margin-top: .15rem;
  }

  /* ── Verse ── */
  .qr-verse {
    display: grid;
    grid-template-columns: 40px 1fr;
    gap: 0 .5rem;
    padding: 1.4rem 0;
    border-bottom: 1px solid var(--qr-border);
    scroll-margin-top: calc(var(--qr-nav) + var(--qr-sub) + .5rem);
    position: relative;
  }

  /* last-read indicator */
  .qr-verse.is-last-read::before {
    content: '';
    position: absolute;
    left: -1rem;
    top: 0;
    bottom: 0;
    width: 3px;
    border-radius: 0 2px 2px 0;
    background: var(--qr-accent);
  }

  /* ── Dots menu column ── */
  .qr-dots-col {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 1.1rem;
    position: relative;
  }

  .qr-dots {
    display: grid;
    place-items: center;
    width: 28px;
    height: 28px;
    border: 0;
    border-radius: 6px;
    background: transparent;
    color: var(--qr-muted);
    font-size: 1.25rem;
    cursor: pointer;
    flex-shrink: 0;
    transition: background .13s, color .13s;
  }

  .qr-dots:hover {
    background: rgba(255, 255, 255, .07);
    color: #fff;
  }

  .qr-dots.is-open {
    background: rgba(255, 255, 255, .07);
    color: var(--qr-accent);
  }

  /* overlay backdrop */
  .qr-overlay {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 298;
    background: rgba(0, 0, 0, .55);
  }

  .qr-overlay.is-open {
    display: block;
  }

  /* sheet handle (mobile only) */
  .qr-sheet-handle {
    display: none;
    width: 36px;
    height: 4px;
    border-radius: 99px;
    background: rgba(255, 255, 255, .2);
    margin: 0 auto .65rem;
    flex-shrink: 0;
  }

  /* dropdown — sibling of .qr-dots inside .qr-dots-col */
  .qr-dropdown {
    display: none;
    position: absolute;
    top: calc(1.1rem + 34px);
    left: 0;
    z-index: 299;
    min-width: 210px;
    padding: .4rem 0;
    border: 1px solid rgba(255, 255, 255, .12);
    border-radius: 12px;
    background: #1c2120;
    box-shadow: 0 10px 36px rgba(0, 0, 0, .65);
  }

  .qr-dots.is-open~.qr-dropdown {
    display: block;
  }

  /* mobile: bottom sheet */
  @media(max-width:480px) {
    .qr-dropdown {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      top: auto;
      border-radius: 18px 18px 0 0;
      min-width: 0;
      padding: .6rem 0 max(1.25rem, env(safe-area-inset-bottom));
    }

    .qr-dots.is-open~.qr-dropdown {
      display: flex;
      flex-direction: column;
    }

    .qr-sheet-handle {
      display: block;
    }
  }

  .qr-dditem {
    display: flex;
    align-items: center;
    gap: .7rem;
    width: 100%;
    padding: .6rem 1rem;
    border: 0;
    background: transparent;
    color: #c4cec9;
    font: inherit;
    font-size: .82rem;
    text-align: left;
    cursor: pointer;
    white-space: nowrap;
    transition: background .1s, color .1s;
  }

  .qr-dditem:hover {
    background: rgba(255, 255, 255, .06);
    color: #fff;
  }

  .qr-dditem i {
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
    flex-shrink: 0;
  }

  .qr-dditem.is-active {
    color: var(--qr-accent);
  }

  .qr-dditem.is-active i {
    color: var(--qr-accent);
  }

  @media(max-width:480px) {
    .qr-dditem {
      padding: .85rem 1.5rem;
      font-size: .9rem;
    }

    .qr-dditem i {
      font-size: 1.2rem;
      width: 22px;
    }
  }

  /* ── Verse content column ── */
  .qr-vcontent {
    display: flex;
    flex-direction: column;
    gap: .65rem;
    min-width: 0;
  }

  /* Arabic text + ornate badge (badge is inside RTL flow = appears at right) */
  .qr-arabic {
    margin: 0;
    font-family: "LPMQ", "Amiri", serif;
    font-size: clamp(1.6rem, 4vw, 2.2rem);
    line-height: 2.1;
    color: #fff;
    direction: rtl;
    text-align: right;
  }

  /* Ornate number badge — sits inline at start of RTL text (= right edge visually) */
  .qr-ornate {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2.8rem;
    height: 3.9rem;
    background-image: url("<?= base_url('assets/frontend/icons/islamic/quran-verse-frame.svg'); ?>");
    background-size: 100% 100%;
    background-repeat: no-repeat;
    border: none;
    border-radius: 0;
    box-shadow: none;
    color: var(--qr-text);
    font-family: "LPMQ", "Amiri", serif;
    font-size: 1.1rem;
    font-weight: 800;
    vertical-align: middle;
    margin-inline-start: .6rem;
    line-height: 1;
    padding-bottom: 1.0rem;
    padding-right: .3rem;
  }

  /* Translation */
  .qr-trans {
    margin: 0;
    padding: 0 .1rem;
    font-size: clamp(.84rem, 2.2vw, .95rem);
    line-height: 1.85;
    color: #8fa49d;
  }

  /* Bookmark star indicator */
  .qr-bookmark-star {
    display: none;
    position: absolute;
    right: 0;
    top: 1.4rem;
    color: var(--qr-gold);
    font-size: .85rem;
  }

  .qr-verse.is-bookmarked .qr-bookmark-star {
    display: block;
  }

  /* ── Copy/status ── */
  .qr-status {
    display: block;
    min-height: 1.1rem;
    padding: .4rem 0;
    color: var(--qr-accent);
    font-size: .69rem;
    text-align: center;
  }

  /* ── Bottom nav ── */
  .qr-botnav {
    display: flex;
    justify-content: space-between;
    gap: 1rem;
    padding-top: 1.5rem;
  }

  .qr-botnav a {
    display: inline-flex;
    align-items: center;
    gap: .45rem;
    padding: .65rem 1.1rem;
    border: 1px solid var(--qr-border);
    border-radius: 9px;
    background: var(--qr-surf);
    color: #b8c4bf;
    font-size: .8rem;
    text-decoration: none;
    max-width: 48%;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    transition: border-color .14s, color .14s;
  }

  .qr-botnav a:hover {
    border-color: var(--qr-accent);
    color: var(--qr-accent);
  }

  /* ── Donation banner ── */
  .qr-banner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin-top: 2.5rem;
    padding: 1.15rem 1.35rem;
    border-radius: 12px;
    background: linear-gradient(135deg, #7a5818 0%, #5e430c 100%);
  }

  .qr-banner-body {
    display: flex;
    align-items: center;
    gap: .9rem;
  }

  .qr-banner-ico {
    display: grid;
    place-items: center;
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: rgba(255, 255, 255, .15);
    color: #fff;
    font-size: 1.3rem;
    flex-shrink: 0;
  }

  .qr-banner-title {
    font-size: .88rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 .15rem;
  }

  .qr-banner-sub {
    font-size: .72rem;
    color: rgba(255, 255, 255, .68);
    margin: 0;
  }

  .qr-banner-cta {
    display: inline-flex;
    align-items: center;
    gap: .35rem;
    padding: .5rem 1.1rem;
    border: 0;
    border-radius: 99px;
    background: #fff;
    color: #5e430c;
    font: inherit;
    font-size: .78rem;
    font-weight: 700;
    text-decoration: none;
    white-space: nowrap;
    flex-shrink: 0;
  }

  .qr-banner-cta:hover {
    background: #fef3d8;
  }

  /* ── Responsive ── */
  @media(max-width:480px) {
    .qr-verse {
      grid-template-columns: 34px 1fr;
    }

    .qr-dots {
      width: 24px;
      height: 24px;
      font-size: 1.05rem;
    }

    .qr-banner {
      flex-direction: column;
      align-items: flex-start;
    }
  }

  @media(prefers-reduced-motion:reduce) {

    *,
    *::before,
    *::after {
      transition-duration: .01ms !important;
    }
  }

  /* ── Search panels ── */
  .qr-panel {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 400;
    display: flex;
    flex-direction: column;
    max-height: 85vh;
    background: #1a1d1c;
    border-radius: 20px 20px 0 0;
    box-shadow: 0 -4px 40px rgba(0, 0, 0, .6);
    transform: translateY(100%);
    transition: transform .28s cubic-bezier(.32, .72, 0, 1);
    overflow: hidden;
  }

  .qr-panel.is-open {
    transform: translateY(0);
  }

  .qr-panel-handle {
    display: flex;
    justify-content: center;
    padding: .7rem 0 .35rem;
    flex-shrink: 0;
    cursor: grab;
  }

  .qr-panel-handle span {
    width: 38px;
    height: 4px;
    border-radius: 99px;
    background: rgba(255, 255, 255, .18);
  }

  .qr-panel-title {
    margin: 0 0 .4rem;
    padding: 0 1.2rem;
    font-size: .68rem;
    font-weight: 700;
    letter-spacing: .07em;
    text-transform: uppercase;
    color: #5d6e69;
    flex-shrink: 0;
  }

  .qr-panel-search {
    display: flex;
    align-items: center;
    gap: .55rem;
    padding: .5rem 1rem .75rem;
    border-bottom: 1px solid rgba(255, 255, 255, .07);
    flex-shrink: 0;
  }

  .qr-panel-search i {
    color: #6d7e78;
    font-size: 1.1rem;
  }

  .qr-panel-search input {
    flex: 1;
    background: transparent;
    border: 0;
    color: #eef1ee;
    font: inherit;
    font-size: .88rem;
    outline: none;
  }

  .qr-panel-search input::placeholder {
    color: #6d7e78;
  }

  .qr-panel-list {
    flex: 1;
    overflow-y: auto;
    margin: 0;
    padding: .35rem 0;
    list-style: none;
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, .12) transparent;
  }

  #qrJuzList {
    max-height: 25rem;
    overflow-y: auto;
  }

  .qr-panel-item a,
  .qr-panel-item button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: .65rem 1rem;
    background: transparent;
    border: 0;
    color: #c4cec9;
    font: inherit;
    font-size: .88rem;
    text-align: left;
    text-decoration: none;
    cursor: pointer;
    transition: background .1s, color .1s;
  }

  .qr-panel-item a:hover,
  .qr-panel-item button:hover {
    background: rgba(255, 255, 255, .06);
    color: #fff;
  }

  .qr-panel-item.is-active a {
    color: #e8b84b;
    font-weight: 600;
    background: rgba(232, 184, 75, .07);
  }

  .qr-panel-item.is-hidden {
    display: none;
  }

  .qr-panel-item a i {
    color: #e8b84b;
    font-size: 1rem;
  }

  /* Panel backdrop */
  .qr-panel-back {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 399;
    background: rgba(0, 0, 0, .5);
  }

  .qr-panel-back.is-open {
    display: block;
  }

  /* Hide terjemahan when setting is off */
  [data-qr-trans="0"] .qr-trans {
    display: none;
  }

  /* ── Tajweed coloring (Quran.com v4 class names) ── */
  .qr-arabic .ham_wasl {
    color: #AAAAAA;
  }

  .qr-arabic .slnt {
    color: #AAAAAA;
  }

  .qr-arabic .madda_normal {
    color: #537FFF;
  }

  .qr-arabic .madda_permissible {
    color: #4050FF;
  }

  .qr-arabic .madda_necessary {
    color: #000EBC;
  }

  .qr-arabic .madda_obligatory {
    color: #2144C1;
  }

  .qr-arabic .ikhafa_shafawi {
    color: #D500B7;
  }

  .qr-arabic .ikhafa {
    color: #FF7E1E;
  }

  .qr-arabic .iqlab {
    color: #26BFFD;
  }

  .qr-arabic .idghaam_shafawi {
    color: #58B800;
  }

  .qr-arabic .idghaam_wo_ghunnah {
    color: #169200;
  }

  .qr-arabic .idghaam_with_ghunna {
    color: #169200;
  }

  .qr-arabic .idghaam_ghunnah {
    color: #169200;
  }

  .qr-arabic .ghunnah {
    color: #FF4040;
  }

  .qr-arabic .qalaqah {
    color: #26BFFD;
  }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<!-- ── Sticky sub-nav ── -->
<nav class="qr-subnav" aria-label="Navigasi Al-Qur'an">
  <div class="qr-subnav-inner">

    <!-- Grid icon: always pinned left -->
    <div class="qr-subnav-left">
      <a class="qr-pill" href="<?= base_url('index.php/quran'); ?>" title="Daftar Surah">
        <i class="bx bx-grid-alt"></i>
      </a>
    </div>

    <!-- Center group: prev + surah + ayat + next -->
    <div class="qr-subnav-center">

      <a class="qr-arrow"
        href="<?= $previous_url ?? '#'; ?>"
        <?= empty($previous_url) ? 'aria-disabled="true"' : ''; ?>
        title="<?= $prev_name ? 'Sebelumnya: ' . htmlspecialchars($prev_name) : ''; ?>">
        <i class="bx bx-chevron-left"></i>
        <?php if ($prev_name): ?>
          <span class="qr-arrow-name"><?= htmlspecialchars($prev_name); ?></span>
        <?php endif; ?>
      </a>

      <?php if ($reader_type === 'surah'): ?>
        <button class="qr-pill is-active" type="button" id="qrSurahTrigger"
          aria-haspopup="true" aria-expanded="false" aria-current="page">
          <?= htmlspecialchars($reader_title); ?>
          <i class="bx bx-chevron-down" style="font-size:.85rem;margin-left:.15rem;"></i>
        </button>
      <?php else: ?>
        <button class="qr-pill is-active" type="button" id="qrJuzTrigger"
          aria-haspopup="true" aria-expanded="false" aria-current="page">
          <?= htmlspecialchars($reader_title); ?>
          <i class="bx bx-chevron-down" style="font-size:.85rem;margin-left:.15rem;"></i>
        </button>
        <span class="qr-pill qr-surah-indicator" id="qrCurrentSurah"
          aria-live="polite" aria-atomic="true"></span>
      <?php endif; ?>

      <?php if ($reader_verse_count > 0 && $reader_type !== 'juz'): ?>
        <button class="qr-pill" type="button" id="qrAyatTrigger"
          aria-haspopup="true" aria-expanded="false">
          Pilih Ayat <i class="bx bx-chevron-down" style="font-size:.85rem;margin-left:.15rem;"></i>
        </button>
      <?php endif; ?>

      <a class="qr-arrow"
        href="<?= $next_url ?? '#'; ?>"
        <?= empty($next_url) ? 'aria-disabled="true"' : ''; ?>
        title="<?= $next_name ? 'Selanjutnya: ' . htmlspecialchars($next_name) : ''; ?>">
        <?php if ($next_name): ?>
          <span class="qr-arrow-name"><?= htmlspecialchars($next_name); ?></span>
        <?php endif; ?>
        <i class="bx bx-chevron-right"></i>
      </a>

    </div>

  </div>
</nav>

<!-- Transparent backdrop to close panels -->
<div class="qr-panel-back" id="qrPanelBack"></div>

<!-- ── Surah search panel ── -->
<?php $surah_list = $surah_list ?? []; ?>
<div class="qr-panel" id="qrSurahPanel" aria-hidden="true">
  <div class="qr-panel-handle"><span></span></div>
  <p class="qr-panel-title">Pilih Surah</p>
  <div class="qr-panel-search">
    <i class="bx bx-search"></i>
    <input type="text" id="qrSurahSearch" placeholder="Cari nama atau nomor surah" autocomplete="off">
  </div>
  <ul class="qr-panel-list" id="qrSurahList">
    <?php foreach ($surah_list as $s): ?>
      <li class="qr-panel-item<?= ((int)$s['id'] === (int)$reader_number && $reader_type === 'surah') ? ' is-active' : ''; ?>"
        data-search="<?= $s['id'] . ' ' . strtolower($s['name']); ?>">
        <a href="<?= htmlspecialchars($s['url']); ?>">
          <?= (int)$s['id']; ?>. <?= htmlspecialchars($s['name']); ?>
          <?php if ((int)$s['id'] === (int)$reader_number && $reader_type === 'surah'): ?>
            <i class="bx bx-check"></i>
          <?php endif; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</div>

<!-- ── Juz picker panel (juz reader only) ── -->
<?php if ($reader_type === 'juz'): ?>
  <div class="qr-panel" id="qrJuzPanel" aria-hidden="true">
    <div class="qr-panel-handle"><span></span></div>
    <div class="qr-panel-search">
      <i class="bx bx-search"></i>
      <input type="search" id="qrJuzSearch" placeholder="Cari nomor juz, mis. 5 atau 30" autocomplete="off">
    </div>
    <ul class="qr-panel-list" id="qrJuzList">
      <?php for ($j = 1; $j <= 30; $j++): ?>
        <li class="qr-panel-item<?= ((int)$reader_number === $j) ? ' is-active' : ''; ?>"
          data-search="juz <?= $j; ?>">
          <a href="<?= base_url('index.php/quran/juz/' . $j); ?>">
            Juz <?= $j; ?>
            <?php if ((int)$reader_number === $j): ?><i class="bx bx-check"></i><?php endif; ?>
          </a>
        </li>
      <?php endfor; ?>
    </ul>
  </div>
<?php endif; ?>

<!-- ── Ayat search panel ── -->
<?php if ($reader_verse_count > 0 && $reader_type !== 'juz'): ?>
  <div class="qr-panel" id="qrAyatPanel" aria-hidden="true">
    <div class="qr-panel-handle"><span></span></div>
    <p class="qr-panel-title">Pilih Ayat</p>
    <div class="qr-panel-search">
      <i class="bx bx-search"></i>
      <input type="text" id="qrAyatSearch" placeholder="Cari nomor ayat" autocomplete="off">
    </div>
    <ul class="qr-panel-list" id="qrAyatList">
      <?php for ($i = 1; $i <= $reader_verse_count; $i++): ?>
        <li class="qr-panel-item" data-search="<?= $i; ?>">
          <button type="button" data-goto-ayat="<?= $i; ?>">Ayat <?= $i; ?></button>
        </li>
      <?php endfor; ?>
    </ul>
  </div>
<?php endif; ?>

<!-- ── Reader ── -->
<div class="qr-page" data-qr-page
  data-surah="<?= (int) $reader_number; ?>"
  data-type="<?= htmlspecialchars($reader_type); ?>">
  <div class="qr-body">

    <!-- Surah / Juz header -->
    <header class="qr-hdr<?= $reader_type === 'juz' ? ' qr-hdr--juz' : ''; ?>">
      <?php if ($reader_type === 'surah'): ?>
        <div class="qr-hdr-meta">
          <span><?= htmlspecialchars($reader_subtitle); ?></span>
          <span>Juz <?= (int) $reader_juz; ?></span>
        </div>
      <?php endif; ?>
      <?php if ($reader_type === 'surah'): ?>
        <span class="qr-hdr-ar qr-hdr-ar--qbsml" lang="ar" dir="rtl"><?= mb_chr(0xF100 + (int)$reader_number - 1, 'UTF-8'); ?></span>
      <?php else: ?>
        <span class="qr-hdr-ar qr-hdr-ar--qbsml" lang="ar" dir="rtl"><?= mb_chr(0xF2D0 + (int)$reader_number - 1, 'UTF-8'); ?></span>
      <?php endif; ?>
      <h1 class="qr-hdr-name"><?= htmlspecialchars($reader_title); ?></h1>
      <?php if (!empty($reader_translation)): ?>
        <p class="qr-hdr-trans"><?= htmlspecialchars($reader_translation); ?></p>
      <?php endif; ?>
    </header>

    <!-- Bismillah (surah, not Al-Fatihah, not At-Tawbah) -->
    <?php if ($reader_type === 'surah' && $reader_number !== 1 && $reader_number !== 9): ?>
      <div class="qr-bismillah" lang="ar" aria-label="Bismillahirrahmanirrahim">﷽</div>
    <?php endif; ?>

    <!-- Status -->
    <span class="qr-status" role="status" aria-live="polite" data-copy-status></span>

    <!-- Verses -->
    <section aria-label="Ayat-ayat">
      <?php foreach ($verses as $verse): ?>

        <?php /* Surah divider for juz view */ ?>
        <?php if ($reader_type === 'juz' && $last_surah_number !== $verse['surah_number']): ?>
          <div class="qr-divider">
            <div class="qr-divider-ornament" aria-hidden="true"></div>
            <div class="qr-divider-frame">
              <div class="qr-dc qr-dc--tl" aria-hidden="true"></div>
              <div class="qr-dc qr-dc--tr" aria-hidden="true"></div>
              <div class="qr-dc qr-dc--bl" aria-hidden="true"></div>
              <div class="qr-dc qr-dc--br" aria-hidden="true"></div>
              <div class="qr-divider-panel">
                <span class="qr-divider-name"><?= htmlspecialchars($verse['surah_name']); ?></span>
                <span class="qr-divider-meaning"><?= htmlspecialchars($verse['surah_meaning']); ?></span>
              </div>
              <div class="qr-divider-body">
                <span class="qr-divider-ar" lang="ar" dir="rtl"><?= mb_chr(0xF100 + (int)$verse['surah_number'] - 1, 'UTF-8'); ?></span>
              </div>
              <div class="qr-divider-panel qr-divider-panel--r">
                <span class="qr-divider-num" lang="ar" dir="rtl"><?= qr_arabic_num((int)$verse['surah_number']); ?></span>
                <span class="qr-divider-num-label">Surah ke</span>
              </div>
            </div>
            <div class="qr-divider-ornament" aria-hidden="true"></div>
          </div>
          <?php if ((int)$verse['surah_number'] !== 1 && (int)$verse['surah_number'] !== 9): ?>
            <div class="qr-bismillah" lang="ar" aria-label="Bismillahirrahmanirrahim">﷽</div>
          <?php endif; ?>
          <?php $last_surah_number = $verse['surah_number']; ?>
        <?php endif; ?>

        <?php
        $vid = 'ayat-' . (int)$verse['surah_number'] . '-' . (int)$verse['number'];
        $ar_num = qr_arabic_num((int)$verse['number']);
        ?>
        <article class="qr-verse"
          id="<?= $vid; ?>"
          data-reader-verse
          data-verse-num="<?= (int) $verse['number']; ?>"
          data-surah-num="<?= (int) $verse['surah_number']; ?>"
          data-surah-name="<?= htmlspecialchars($verse['surah_name'], ENT_QUOTES); ?>"
          data-arabic="<?= htmlspecialchars($verse['arabic'], ENT_QUOTES); ?>"
          data-trans="<?= htmlspecialchars($verse['translation'], ENT_QUOTES); ?>">

          <!-- Bookmark star (shown when bookmarked) -->
          <i class="bx bxs-star qr-bookmark-star" aria-hidden="true"></i>

          <!-- Left col: dots menu -->
          <div class="qr-dots-col">
            <button class="qr-dots" type="button"
              aria-label="Menu ayat <?= (int) $verse['number']; ?>"
              data-dots>
              <i class="bx bx-dots-vertical-rounded" aria-hidden="true"></i>
            </button>
            <div class="qr-dropdown" role="menu">
              <div class="qr-sheet-handle" aria-hidden="true"></div>
              <button class="qr-dditem" type="button" role="menuitem" data-action="last-read">
                <i class="bx bx-book-bookmark"></i> Tandai Terakhir Dibaca
              </button>
              <button class="qr-dditem" type="button" role="menuitem" data-action="bookmark">
                <i class="bx bx-star"></i> Simpan ke Bookmark
              </button>
              <button class="qr-dditem" type="button" role="menuitem" data-action="share">
                <i class="bx bx-share-alt"></i> Bagikan
              </button>
              <button class="qr-dditem" type="button" role="menuitem" data-action="copy">
                <i class="bx bx-copy"></i> Copy Text
              </button>
            </div>
          </div>

          <!-- Right col: Arabic + translation -->
          <div class="qr-vcontent">
            <!-- Arabic with ornate badge inline (RTL: badge appears at left edge = end of flow) -->
            <p class="qr-arabic" lang="ar" dir="rtl">
              <?= htmlspecialchars($verse['arabic'], ENT_QUOTES, 'UTF-8'); ?>
              <span class="qr-ornate" aria-hidden="true"><?= $ar_num; ?></span>
            </p>

            <!-- Translation -->
            <p class="qr-trans">
              <?= htmlspecialchars($verse['translation'], ENT_QUOTES, 'UTF-8'); ?>
            </p>
          </div>

        </article>
      <?php endforeach; ?>
    </section>

    <!-- Bottom navigation -->
    <nav class="qr-botnav" aria-label="Navigasi surah">
      <?php if (!empty($previous_url)): ?>
        <a href="<?= htmlspecialchars($previous_url); ?>">
          <i class="bx bx-chevron-left"></i>
          <?= $prev_name ? htmlspecialchars($prev_name) : 'Sebelumnya'; ?>
        </a>
      <?php else: ?>
        <span></span>
      <?php endif; ?>
      <?php if (!empty($next_url)): ?>
        <a href="<?= htmlspecialchars($next_url); ?>">
          <?= $next_name ? htmlspecialchars($next_name) : 'Selanjutnya'; ?>
          <i class="bx bx-chevron-right"></i>
        </a>
      <?php endif; ?>
    </nav>

    <!-- Banner -->
    <div class="qr-banner">
      <div class="qr-banner-body">
        <span class="qr-banner-ico"><i class="bx bxs-book-heart"></i></span>
        <div>
          <p class="qr-banner-title">Dukung Pengembangan Majelis</p>
          <p class="qr-banner-sub">Bantu kami menghadirkan fitur islami yang lebih lengkap.</p>
        </div>
      </div>
      <?php if (!empty($identitas['whatsapp'])): ?>
        <a class="qr-banner-cta"
          href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $identitas['whatsapp']); ?>"
          target="_blank" rel="noopener">
          Hubungi Kami <i class="bx bx-chevron-right"></i>
        </a>
      <?php endif; ?>
    </div>

  </div>
</div>

<!-- Backdrop overlay for mobile bottom sheet -->
<div class="qr-overlay" id="qrOverlay" aria-hidden="true"></div>
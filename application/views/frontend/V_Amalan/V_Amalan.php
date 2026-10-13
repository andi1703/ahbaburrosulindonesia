<?php

defined('BASEPATH') or exit('No direct script access allowed');
$surah_list = $surah_list ?? [];
$juz_list = $juz_list ?? [];
?>
<style>
    .quran-page {
        --quran-bg: #0b0d0d;
        --quran-surface: #191c1b;
        --quran-surface-hover: #202523;
        --quran-text: #f2f5f4;
        --quran-muted: #9aa5a1;
        --quran-accent: #28c3a3;
        padding-top: 72px;
        min-height: 100vh;
        color: var(--quran-text);
        background: var(--quran-bg);
    }

    body.quran-page-body {
        position: relative;
    }

    body.quran-page-body .btn-whatsapp-floating {
        position: absolute;
        right: 1rem;
        bottom: 1.25rem;
    }

    .quran-container {
        width: min(100% - 2rem, 1120px);
        margin-inline: auto;
    }

    .quran-hero {
        position: relative;
        overflow: hidden;
        background-color: #00685f;
        background-image: repeating-linear-gradient(45deg, transparent 0 18px, rgba(255, 255, 255, 0.025) 18px 19px),
            repeating-linear-gradient(-45deg, transparent 0 18px, rgba(0, 0, 0, 0.035) 18px 19px);
    }

    .quran-hero-inner {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(280px, 0.8fr);
        align-items: end;
        gap: 2rem;
        min-height: 225px;
        padding-block: 2.5rem 2.25rem;
    }

    .quran-identity {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .quran-mark {
        display: grid;
        flex: 0 0 58px;
        width: 58px;
        height: 58px;
        place-items: center;
        border: 1px solid rgba(255, 255, 255, 0.35);
        border-radius: 50%;
        color: #d1fff3;
        font-family: "Amiri", serif;
        font-size: 2rem;
    }

    .quran-eyebrow {
        margin: 0 0 0.15rem;
        color: rgba(255, 255, 255, 0.72);
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .quran-title {
        margin: 0;
        color: #fff;
        font-size: 1.75rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .quran-subtitle {
        margin: 0.35rem 0 0;
        color: rgba(255, 255, 255, 0.76);
        font-size: 0.82rem;
    }

    .quran-search-wrap {
        width: 100%;
    }

    .quran-search {
        display: flex;
        align-items: center;
        gap: 0.65rem;
        min-height: 44px;
        padding: 0 1rem;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 99px;
        background: #171a19;
        color: #fff;
    }

    .quran-search i {
        color: #c4d0cc;
        font-size: 1rem;
    }

    .quran-search input {
        width: 100%;
        min-width: 0;
        border: 0;
        outline: 0;
        background: transparent;
        color: #fff;
        font: inherit;
        font-size: 0.76rem;
    }

    .quran-search input::placeholder {
        color: #aab4b0;
        opacity: 1;
    }

    .quran-search-hint {
        margin: 0.45rem 0 0 1rem;
        color: rgba(255, 255, 255, 0.62);
        font-size: 0.68rem;
    }

    .quran-browser {
        padding-block: 1.15rem 3.5rem;
    }

    .quran-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.15rem;
    }

    .quran-tabs {
        display: inline-flex;
        max-width: 100%;
        padding: 3px;
        border-radius: 99px;
        background: #242726;
    }

    .quran-tab {
        min-height: 32px;
        padding: 0.35rem 0.85rem;
        border: 0;
        border-radius: 99px;
        background: transparent;
        color: #bdc5c2;
        font: inherit;
        font-size: 0.7rem;
        white-space: nowrap;
        cursor: pointer;
        transition: background-color 160ms ease, color 160ms ease;
    }

    .quran-tab:hover {
        color: #fff;
    }

    .quran-tab[aria-selected="true"] {
        background: #454948;
        color: #fff;
    }

    .quran-sort {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        min-height: 34px;
        padding: 0.35rem 0.55rem;
        border: 0;
        background: transparent;
        color: #e6eae8;
        font: inherit;
        font-size: 0.7rem;
        cursor: pointer;
    }

    .quran-sort:hover:not(:disabled) {
        color: var(--quran-accent);
    }

    .quran-sort:disabled {
        opacity: 0.45;
        cursor: default;
    }

    .quran-sort i {
        font-size: 0.95rem;
    }

    .quran-results-meta {
        min-height: 1.4rem;
        margin-bottom: 0.55rem;
        color: var(--quran-muted);
        font-size: 0.69rem;
    }

    .quran-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.55rem;
    }

    .quran-grid[hidden],
    .quran-empty[hidden] {
        display: none !important;
    }

    .quran-card {
        display: grid;
        grid-template-columns: 30px minmax(0, 1fr) auto;
        align-items: center;
        gap: 0.65rem;
        min-width: 0;
        min-height: 54px;
        padding: 0.55rem 0.65rem;
        border: 1px solid rgba(255, 255, 255, 0.035);
        border-radius: 8px;
        background: var(--quran-surface);
        color: var(--quran-text);
        text-decoration: none;
        transition: background-color 150ms ease, border-color 150ms ease;
    }

    .quran-card[hidden] {
        display: none !important;
    }

    .quran-card:hover,
    .quran-card:focus-visible {
        border-color: rgba(40, 195, 163, 0.55);
        background: var(--quran-surface-hover);
        color: #fff;
    }

    .quran-number {
        display: grid;
        width: 30px;
        height: 30px;
        place-items: center;
        border-radius: 6px;
        background: #282c2a;
        color: #e3e8e5;
        font-size: 0.68rem;
        font-weight: 700;
        font-variant-numeric: tabular-nums;
    }

    .quran-card-copy {
        display: block;
        min-width: 0;
        overflow: hidden;
    }

    .quran-card-title {
        display: block;
        overflow: hidden;
        color: inherit;
        font-size: 0.73rem;
        font-weight: 700;
        line-height: 1.3;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .quran-card-subtitle {
        display: block;
        overflow: hidden;
        margin-top: 0.12rem;
        color: var(--quran-muted);
        font-size: 0.58rem;
        line-height: 1.25;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .quran-card-arabic {
        color: var(--quran-accent);
        direction: rtl;
        font-family: "Amiri", serif;
        font-size: 1.18rem;
        line-height: 1;
        white-space: nowrap;
    }

    .quran-empty {
        padding: 3.5rem 1rem;
        color: var(--quran-muted);
        text-align: center;
    }

    .quran-empty i {
        display: block;
        margin-bottom: 0.45rem;
        color: #65716c;
        font-size: 1.75rem;
    }

    @media (max-width: 991.98px) {
        .quran-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .quran-hero-inner {
            grid-template-columns: minmax(0, 1fr) minmax(250px, 0.9fr);
            gap: 1.25rem;
        }
    }

    @media (max-width: 575.98px) {
        .quran-container {
            width: min(100% - 1.5rem, 1120px);
        }

        .quran-hero-inner {
            grid-template-columns: 1fr;
            gap: 1.35rem;
            min-height: unset;
            padding-block: 1.65rem 1.35rem;
        }

        .quran-title {
            font-size: 1.45rem;
        }

        .quran-mark {
            flex-basis: 48px;
            width: 48px;
            height: 48px;
            font-size: 1.65rem;
        }

        .quran-search-hint {
            margin-left: 0.7rem;
            font-size: 0.62rem;
        }

        .quran-browser {
            padding-top: 0.8rem;
        }

        .quran-toolbar {
            gap: 0.4rem;
        }

        .quran-tabs {
            overflow-x: auto;
            scrollbar-width: none;
        }

        .quran-tabs::-webkit-scrollbar {
            display: none;
        }

        .quran-tab {
            padding-inline: 0.67rem;
            font-size: 0.66rem;
        }

        .quran-sort {
            padding-inline: 0.25rem;
        }

        .quran-grid {
            grid-template-columns: minmax(0, 1fr);
            gap: 0.45rem;
        }

        .quran-card {
            min-height: 56px;
            padding-inline: 0.7rem;
        }

        .quran-card-title {
            font-size: 0.78rem;
        }

        .quran-card-subtitle {
            font-size: 0.62rem;
        }

        .quran-card-arabic {
            font-size: 1.28rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {

        .quran-page *,
        .quran-page *::before,
        .quran-page *::after {
            scroll-behavior: auto !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<main class="quran-page" data-quran-page>
    <header class="quran-hero">
        <div class="quran-container quran-hero-inner">
            <div class="quran-identity">
                <span class="quran-mark" aria-hidden="true">۞</span>
                <div>
                    <h1 class="quran-title">Al-Qur'an</h1>
                    <p class="quran-subtitle">Jelajahi 114 surah dan 30 juz Al-Qur'an.</p>
                </div>
            </div>

            <div class="quran-search-wrap">
                <label class="visually-hidden" for="quranSearch">Cari surah atau juz</label>
                <div class="quran-search">
                    <i class="bx bx-search" aria-hidden="true"></i>
                    <input id="quranSearch" type="search" autocomplete="off" data-quran-search
                        placeholder="Nama atau nomor surah, mis. Yasin atau 2:124">
                </div>
                <p class="quran-search-hint">Cari berdasarkan nama, nomor surah, atau nomor ayat.</p>
            </div>
        </div>
    </header>

    <section class="quran-container quran-browser" aria-label="Daftar surah dan juz">
        <div class="quran-toolbar">
            <div class="quran-tabs" role="tablist" aria-label="Jenis daftar Al-Qur'an">
                <button class="quran-tab" type="button" role="tab" aria-selected="true" data-quran-mode="surah">Surah</button>
                <button class="quran-tab" type="button" role="tab" aria-selected="false" data-quran-mode="juz">Juz</button>
                <button class="quran-tab" type="button" role="tab" aria-selected="false" data-quran-mode="revelation">Urutan Turun</button>
            </div>
            <button class="quran-sort" type="button" data-quran-sort aria-pressed="false" title="Urutkan A–Z">
                <span data-quran-sort-label>A–Z</span>
                <i class="bx bx-chevron-up" aria-hidden="true"></i>
            </button>
        </div>

        <p class="quran-results-meta" aria-live="polite">
            <span data-quran-count><?= count($surah_list); ?></span>
            <span data-quran-count-label>surah</span>
        </p>

        <div class="quran-grid" role="tabpanel" data-quran-grid="surah">
            <?php foreach ($surah_list as $surah): ?>
                <?php $search_text = mb_strtolower($surah['id'] . ' ' . $surah['name'] . ' ' . $surah['translation'] . ' ' . $surah['arabic'], 'UTF-8'); ?>
                <a class="quran-card" data-quran-card
                    data-search="<?= htmlspecialchars($search_text, ENT_QUOTES, 'UTF-8'); ?>"
                    data-name="<?= htmlspecialchars(mb_strtolower($surah['name'], 'UTF-8'), ENT_QUOTES, 'UTF-8'); ?>"
                    data-number="<?= (int) $surah['id']; ?>"
                    data-revelation="<?= (int) $surah['revelation_order']; ?>"
                    href="<?= base_url('index.php/quran/surah/' . (int) $surah['id']); ?>">
                    <span class="quran-number"><?= (int) $surah['id']; ?></span>
                    <span class="quran-card-copy">
                        <span class="quran-card-title"><?= htmlspecialchars($surah['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                        <span class="quran-card-subtitle"><?= htmlspecialchars($surah['translation'], ENT_QUOTES, 'UTF-8'); ?> · <?= (int) $surah['verses']; ?> ayat</span>
                    </span>
                    <span class="quran-card-arabic" lang="ar" dir="rtl"><?= htmlspecialchars($surah['arabic'], ENT_QUOTES, 'UTF-8'); ?></span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="quran-grid" role="tabpanel" data-quran-grid="juz" hidden>
            <?php foreach ($juz_list as $juz): ?>
                <?php $juz_search = mb_strtolower('juz ' . $juz['number'] . ' ' . $juz['surah'] . ' ' . $juz['number'], 'UTF-8'); ?>
                <a class="quran-card" data-quran-card
                    data-search="<?= htmlspecialchars($juz_search, ENT_QUOTES, 'UTF-8'); ?>"
                    data-name="juz <?= (int) $juz['number']; ?>"
                    data-number="<?= (int) $juz['number']; ?>"
                    href="<?= base_url('index.php/quran/juz/' . (int) $juz['number']); ?>">
                    <span class="quran-number"><?= str_pad((string) $juz['number'], 2, '0', STR_PAD_LEFT); ?></span>
                    <span class="quran-card-copy">
                        <span class="quran-card-title">Juz <?= (int) $juz['number']; ?></span>
                        <span class="quran-card-subtitle">Surah <?= htmlspecialchars($juz['surah'], ENT_QUOTES, 'UTF-8'); ?> · Ayat <?= (int) $juz['verse']; ?> · <?= (int) $juz['verses']; ?> ayat</span>
                    </span>
                    <span class="quran-card-arabic" lang="ar" dir="rtl">الجزء <?= (int) $juz['number']; ?></span>
                </a>
            <?php endforeach; ?>
        </div>

        <div class="quran-empty" data-quran-empty hidden>
            <i class="bx bx-search-alt" aria-hidden="true"></i>
            Tidak ada surah atau juz yang cocok.
        </div>
    </section>
</main>
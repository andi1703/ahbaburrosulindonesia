<?php

defined('BASEPATH') or exit('No direct script access allowed');
$verses = $verses ?? [];
$reader_title = $reader_title ?? 'Al-Qur\'an';
$reader_arabic = $reader_arabic ?? 'القرآن الكريم';
$reader_subtitle = $reader_subtitle ?? '';
$reader_type = $reader_type ?? 'surah';
$last_surah_number = 0;
?>
<style>
  @font-face {
    font-family: "LPMQ";
    src: url("<?= base_url('assets/frontend/fonts/LPMQ.ttf'); ?>") format("truetype");
    font-style: normal;
    font-weight: 400;
    font-display: swap;
  }

  .quran-reader-page {
    --reader-bg: #0b0d0d;
    --reader-surface: #191c1b;
    --reader-border: rgba(255, 255, 255, 0.08);
    --reader-text: #f2f5f4;
    --reader-muted: #a3aeaa;
    --reader-accent: #28c3a3;
    min-height: 100vh;
    padding: 92px 0 3rem;
    background: var(--reader-bg);
    color: var(--reader-text);
  }

  body.quran-reader-body {
    position: relative;
  }

  body.quran-reader-body .btn-whatsapp-floating {
    position: absolute;
    right: 1rem;
    bottom: 1.25rem;
  }

  .quran-reader-container {
    width: min(100% - 2rem, 860px);
    margin-inline: auto;
  }

  .quran-reader-back {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    margin-bottom: 1.4rem;
    color: #c8d2ce;
    font-size: 0.78rem;
    text-decoration: none;
  }

  .quran-reader-back:hover {
    color: var(--reader-accent);
  }

  .quran-reader-heading {
    padding: 1.4rem 1.5rem;
    border: 1px solid var(--reader-border);
    border-radius: 10px;
    background: linear-gradient(135deg, #064b43, #093b35);
  }

  .quran-reader-heading-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
  }

  .quran-reader-title {
    margin: 0;
    color: #fff;
    font-size: 1.45rem;
    font-weight: 800;
    line-height: 1.25;
  }

  .quran-reader-arabic-title {
    display: block;
    margin-top: 0.25rem;
    color: #c7fff2;
    font-family: "LPMQ", "Amiri", serif;
    font-size: 1.5rem;
    line-height: 1.8;
  }

  .quran-reader-subtitle {
    margin: 0.25rem 0 0;
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.75rem;
  }

  .quran-reader-copy-all,
  .quran-verse-copy {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    min-height: 34px;
    padding: 0.4rem 0.65rem;
    border: 1px solid rgba(255, 255, 255, 0.16);
    border-radius: 6px;
    background: rgba(0, 0, 0, 0.14);
    color: #edf8f5;
    font: inherit;
    font-size: 0.68rem;
    cursor: pointer;
  }

  .quran-reader-copy-all:hover,
  .quran-verse-copy:hover {
    border-color: var(--reader-accent);
    color: var(--reader-accent);
  }

  .quran-reader-status {
    min-height: 1.2rem;
    margin: 0.55rem 0 0;
    color: #b1f5e4;
    font-size: 0.7rem;
  }

  .quran-reader-nav {
    display: flex;
    justify-content: space-between;
    gap: 0.75rem;
    margin: 1rem 0;
  }

  .quran-reader-nav a {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    min-height: 36px;
    padding: 0.45rem 0.7rem;
    border: 1px solid var(--reader-border);
    border-radius: 6px;
    color: #dfe7e3;
    font-size: 0.72rem;
    text-decoration: none;
  }

  .quran-reader-nav a:hover {
    border-color: var(--reader-accent);
    color: var(--reader-accent);
  }

  .quran-reader-nav a[aria-disabled="true"] {
    visibility: hidden;
  }

  .quran-reader-surah-divider {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    margin: 1.5rem 0 0.65rem;
    padding: 0.65rem 0.8rem;
    border-left: 3px solid var(--reader-accent);
    border-radius: 4px;
    background: #151918;
  }

  .quran-reader-surah-divider h2 {
    margin: 0;
    color: #eaf3f0;
    font-size: 0.82rem;
    font-weight: 700;
  }

  .quran-reader-surah-divider a {
    color: var(--reader-accent);
    font-size: 0.68rem;
    text-decoration: none;
  }

  .quran-reader-verse {
    margin-top: 0.55rem;
    padding: 1.15rem 1.25rem;
    border: 1px solid var(--reader-border);
    border-radius: 8px;
    background: var(--reader-surface);
    scroll-margin-top: 1.5rem;
  }

  .quran-reader-verse-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.75rem;
    margin-bottom: 0.9rem;
  }

  .quran-reader-verse-number {
    display: grid;
    width: 29px;
    height: 29px;
    place-items: center;
    border-radius: 50%;
    background: #292f2c;
    color: #cfe1da;
    font-size: 0.68rem;
    font-variant-numeric: tabular-nums;
  }

  .quran-reader-verse-arabic {
    margin: 0;
    color: #f2f5f4;
    direction: rtl;
    font-family: "LPMQ", "Amiri", serif;
    font-size: 1.75rem;
    line-height: 2.25;
    text-align: right;
  }

  .quran-reader-verse-translation {
    margin: 0.85rem 0 0;
    padding-top: 0.75rem;
    border-top: 1px solid var(--reader-border);
    color: #c2ccc8;
    font-size: 0.86rem;
    line-height: 1.8;
  }

  @media (max-width: 575.98px) {
    .quran-reader-page {
      padding-top: 82px;
    }

    .quran-reader-container {
      width: min(100% - 1.5rem, 860px);
    }

    .quran-reader-heading {
      padding: 1rem;
    }

    .quran-reader-heading-row {
      align-items: flex-start;
    }

    .quran-reader-title {
      font-size: 1.2rem;
    }

    .quran-reader-arabic-title {
      font-size: 1.35rem;
    }

    .quran-reader-copy-all {
      flex: 0 0 auto;
      width: 36px;
      padding: 0;
      font-size: 0;
    }

    .quran-reader-copy-all i {
      font-size: 1rem;
    }

    .quran-reader-verse {
      padding: 0.9rem;
    }

    .quran-reader-verse-arabic {
      font-size: 1.5rem;
      line-height: 2;
    }

    .quran-reader-verse-translation {
      font-size: 0.8rem;
    }
  }
</style>

<main class="quran-reader-page">
  <div class="quran-reader-container">
    <a class="quran-reader-back" href="<?= base_url('index.php/amalan'); ?>">
      <i class="bx bx-arrow-back" aria-hidden="true"></i> Daftar Al-Qur'an
    </a>

    <header class="quran-reader-heading">
      <div class="quran-reader-heading-row">
        <div>
          <h1 class="quran-reader-title"><?= htmlspecialchars($reader_title, ENT_QUOTES, 'UTF-8'); ?></h1>
          <span class="quran-reader-arabic-title" lang="ar" dir="rtl"><?= htmlspecialchars($reader_arabic, ENT_QUOTES, 'UTF-8'); ?></span>
          <p class="quran-reader-subtitle"><?= htmlspecialchars($reader_subtitle, ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <button class="quran-reader-copy-all" type="button" data-copy-all title="Salin seluruh bacaan">
          <i class="bx bx-copy" aria-hidden="true"></i><span>Salin semua</span>
        </button>
      </div>
      <p class="quran-reader-status" role="status" aria-live="polite" data-copy-status></p>
    </header>

    <nav class="quran-reader-nav" aria-label="Navigasi bacaan">
      <?php if (!empty($previous_url)): ?>
        <a href="<?= htmlspecialchars($previous_url, ENT_QUOTES, 'UTF-8'); ?>">
          <i class="bx bx-chevron-left" aria-hidden="true"></i> Sebelumnya
        </a>
      <?php else: ?>
        <span></span>
      <?php endif; ?>
      <?php if (!empty($next_url)): ?>
        <a href="<?= htmlspecialchars($next_url, ENT_QUOTES, 'UTF-8'); ?>">
          Selanjutnya <i class="bx bx-chevron-right" aria-hidden="true"></i>
        </a>
      <?php endif; ?>
    </nav>

    <section aria-label="Ayat">
      <?php foreach ($verses as $verse): ?>
        <?php if ($reader_type === 'juz' && $last_surah_number !== $verse['surah_number']): ?>
          <div class="quran-reader-surah-divider">
            <h2><?= htmlspecialchars($verse['surah_name'], ENT_QUOTES, 'UTF-8'); ?></h2>
            <a href="<?= base_url('index.php/quran/surah/' . (int) $verse['surah_number']); ?>">Buka surah</a>
          </div>
          <?php $last_surah_number = $verse['surah_number']; ?>
        <?php endif; ?>
        <article class="quran-reader-verse" id="ayat-<?= (int) $verse['surah_number']; ?>-<?= (int) $verse['number']; ?>" data-reader-verse>
          <div class="quran-reader-verse-head">
            <span class="quran-reader-verse-number"><?= (int) $verse['number']; ?></span>
            <button class="quran-verse-copy" type="button" data-copy-verse title="Salin ayat">
              <i class="bx bx-copy" aria-hidden="true"></i><span>Salin</span>
            </button>
          </div>
          <p class="quran-reader-verse-arabic" lang="ar" dir="rtl"><?= htmlspecialchars($verse['arabic'], ENT_QUOTES, 'UTF-8'); ?></p>
          <p class="quran-reader-verse-translation"><?= htmlspecialchars($verse['translation'], ENT_QUOTES, 'UTF-8'); ?></p>
        </article>
      <?php endforeach; ?>
    </section>

    <nav class="quran-reader-nav" aria-label="Navigasi bacaan bawah">
      <?php if (!empty($previous_url)): ?>
        <a href="<?= htmlspecialchars($previous_url, ENT_QUOTES, 'UTF-8'); ?>">
          <i class="bx bx-chevron-left" aria-hidden="true"></i> Sebelumnya
        </a>
      <?php else: ?>
        <span></span>
      <?php endif; ?>
      <?php if (!empty($next_url)): ?>
        <a href="<?= htmlspecialchars($next_url, ENT_QUOTES, 'UTF-8'); ?>">
          Selanjutnya <i class="bx bx-chevron-right" aria-hidden="true"></i>
        </a>
      <?php endif; ?>
    </nav>
  </div>
</main>
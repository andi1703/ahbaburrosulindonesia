<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
(function () {
  'use strict';

  var page    = document.querySelector('[data-qr-page]');
  var status  = document.querySelector('[data-copy-status]');
  var overlay = document.getElementById('qrOverlay');
  if (!page) return;

  function isMobile() { return window.innerWidth <= 480; }

  function openDots(btn) {
    btn.classList.add('is-open');
    if (isMobile() && overlay) overlay.classList.add('is-open');
  }

  function closeAllDots() {
    document.querySelectorAll('[data-dots].is-open').forEach(function (b) {
      b.classList.remove('is-open');
    });
    if (overlay) overlay.classList.remove('is-open');
  }

  /* ── Storage helpers ── */
  function lsGet(k)      { try { return JSON.parse(localStorage.getItem(k)); } catch(e){ return null; } }
  function lsSet(k, v)   { try { localStorage.setItem(k, JSON.stringify(v)); } catch(e){} }

  var LS_LAST = 'qr_last_read';
  var LS_BM   = 'qr_bookmarks';

  /* ── Search panels ── */
  var surahTrigger = document.getElementById('qrSurahTrigger');
  var ayatTrigger  = document.getElementById('qrAyatTrigger');
  var surahPanel   = document.getElementById('qrSurahPanel');
  var ayatPanel    = document.getElementById('qrAyatPanel');
  var surahSearch  = document.getElementById('qrSurahSearch');
  var ayatSearch   = document.getElementById('qrAyatSearch');
  var panelBack    = document.getElementById('qrPanelBack');

  function openPanel(panel, trigger, searchInput) {
    closeAllPanels();
    if (!panel) return;
    panel.removeAttribute('hidden');
    if (trigger) trigger.setAttribute('aria-expanded', 'true');
    if (panelBack) panelBack.classList.add('is-open');
    /* Position panel under its trigger */
    if (trigger) {
      var rect = trigger.getBoundingClientRect();
      var mid  = rect.left + rect.width / 2;
      var pw   = Math.min(340, window.innerWidth * 0.9);
      var left = Math.max(8, Math.min(mid - pw / 2, window.innerWidth - pw - 8));
      panel.style.left = left + 'px';
    }
    if (searchInput) {
      searchInput.value = '';
      filterPanel(panel, '');
      setTimeout(function () { searchInput.focus(); }, 60);
    }
    /* Scroll active item into view */
    var active = panel.querySelector('.is-active');
    if (active) setTimeout(function () {
      active.scrollIntoView({ block: 'nearest' });
    }, 80);
  }

  function closeAllPanels() {
    [surahPanel, ayatPanel].forEach(function (p) {
      if (p) p.setAttribute('hidden', '');
    });
    [surahTrigger, ayatTrigger].forEach(function (t) {
      if (t) t.setAttribute('aria-expanded', 'false');
    });
    if (panelBack) panelBack.classList.remove('is-open');
  }

  function filterPanel(panel, q) {
    q = q.toLowerCase().trim();
    panel.querySelectorAll('.qr-panel-item').forEach(function (li) {
      var s = (li.dataset.search || '').toLowerCase();
      li.classList.toggle('is-hidden', q !== '' && s.indexOf(q) === -1);
    });
  }

  if (surahTrigger && surahPanel) {
    surahTrigger.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = surahPanel.hidden === false;
      if (open) { closeAllPanels(); } else { openPanel(surahPanel, surahTrigger, surahSearch); }
    });
  }

  if (ayatTrigger && ayatPanel) {
    ayatTrigger.addEventListener('click', function (e) {
      e.stopPropagation();
      var open = ayatPanel.hidden === false;
      if (open) { closeAllPanels(); } else { openPanel(ayatPanel, ayatTrigger, ayatSearch); }
    });
  }

  if (surahSearch) {
    surahSearch.addEventListener('input', function () {
      filterPanel(surahPanel, this.value);
    });
  }

  if (ayatSearch) {
    ayatSearch.addEventListener('input', function () {
      filterPanel(ayatPanel, this.value);
    });
  }

  /* Ayat panel items — click to scroll */
  if (ayatPanel) {
    ayatPanel.addEventListener('click', function (e) {
      var btn = e.target.closest('[data-goto-ayat]');
      if (!btn) return;
      var n = parseInt(btn.dataset.gotoAyat, 10);
      if (!n) return;
      closeAllPanels();
      var el = page.querySelector('[data-verse-num="' + n + '"]');
      if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
  }

  /* Backdrop click */
  if (panelBack) {
    panelBack.addEventListener('click', function () { closeAllPanels(); });
  }

  /* Keyboard: Escape to close */
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeAllPanels();
  });

  /* ── Restore UI state on load ── */
  restoreLastRead();
  restoreBookmarks();

  /* ── Hash anchor scroll ── */
  if (/^#ayat-\d+-\d+$/.test(window.location.hash)) {
    var ht = document.getElementById(window.location.hash.slice(1));
    if (ht) setTimeout(function () {
      ht.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }, 150);
  }

  /* ── Close all dropdowns when clicking outside ── */
  document.addEventListener('click', function (e) {
    if (!e.target.closest('[data-dots]') && !e.target.closest('.qr-dropdown')) {
      closeAllDots();
    }
  });

  /* ── Close on overlay tap ── */
  if (overlay) {
    overlay.addEventListener('click', function () { closeAllDots(); });
  }

  /* ── Dots button toggle ── */
  page.addEventListener('click', function (e) {
    /* Toggle dots menu */
    var dotsBtn = e.target.closest('[data-dots]');
    if (dotsBtn && !e.target.closest('[data-action]')) {
      var wasOpen = dotsBtn.classList.contains('is-open');
      closeAllDots();
      if (!wasOpen) openDots(dotsBtn);
      e.stopPropagation();
      return;
    }

    /* Menu item action */
    var actionBtn = e.target.closest('[data-action]');
    if (!actionBtn) return;

    var action = actionBtn.dataset.action;
    var verse  = actionBtn.closest('[data-reader-verse]');
    if (!verse) return;

    /* Close the dropdown */
    closeAllDots();

    if (action === 'last-read') { doLastRead(verse); }
    else if (action === 'bookmark') { doBookmark(verse); }
    else if (action === 'share')    { doShare(verse); }
    else if (action === 'copy')     { doCopy(verse); }
  });

  /* ── Actions ── */

  function doLastRead(verse) {
    var data = verseData(verse);
    lsSet(LS_LAST, data);

    document.querySelectorAll('.qr-verse.is-last-read').forEach(function (v) {
      v.classList.remove('is-last-read');
    });
    verse.classList.add('is-last-read');

    var iconEl = verse.querySelector('[data-action="last-read"] i');
    if (iconEl) iconEl.className = 'bx bxs-book-bookmark';
    flash('Ayat ditandai sebagai terakhir dibaca.');
  }

  function doBookmark(verse) {
    var data  = verseData(verse);
    var key   = data.surahNum + ':' + data.verseNum;
    var bms   = lsGet(LS_BM) || {};
    var isNew = !bms[key];

    if (isNew) {
      bms[key] = data;
      verse.classList.add('is-bookmarked');
      flash('Ayat disimpan ke Bookmark.');
    } else {
      delete bms[key];
      verse.classList.remove('is-bookmarked');
      flash('Bookmark dihapus.');
    }
    lsSet(LS_BM, bms);

    var iconEl = verse.querySelector('[data-action="bookmark"] i');
    if (iconEl) iconEl.className = isNew ? 'bx bxs-star' : 'bx bx-star';
    var btnEl = verse.querySelector('[data-action="bookmark"]');
    if (btnEl) btnEl.classList.toggle('is-active', isNew);
  }

  function doShare(verse) {
    var data = verseData(verse);
    var text = data.arabic + '\n' + data.trans +
               '\n— ' + data.surahName + ' Ayat ' + data.verseNum;
    if (navigator.share) {
      navigator.share({ text: text }).catch(function () {});
    } else {
      copyToClipboard(text, 'Ayat disalin untuk dibagikan.');
    }
  }

  function doCopy(verse) {
    var data = verseData(verse);
    var text = data.arabic + '\n' + data.trans +
               '\n— ' + data.surahName + ' Ayat ' + data.verseNum;
    copyToClipboard(text, 'Ayat berhasil disalin.');
  }

  /* ── Helpers ── */

  function verseData(verse) {
    return {
      surahNum:  parseInt(verse.dataset.surahNum, 10),
      verseNum:  parseInt(verse.dataset.verseNum, 10),
      surahName: verse.dataset.surahName || '',
      arabic:    verse.dataset.arabic || '',
      trans:     verse.dataset.trans  || ''
    };
  }

  function copyToClipboard(text, msg) {
    if (!navigator.clipboard) { flash('Clipboard tidak tersedia.'); return; }
    navigator.clipboard.writeText(text)
      .then(function () { flash(msg); })
      .catch(function () { flash('Gagal menyalin.'); });
  }

  function flash(msg) {
    if (!status) return;
    status.textContent = msg;
    clearTimeout(status._t);
    status._t = setTimeout(function () { status.textContent = ''; }, 2800);
  }

  /* ── Restore last-read ── */
  function restoreLastRead() {
    var saved = lsGet(LS_LAST);
    if (!saved) return;
    var el = page.querySelector(
      '[data-surah-num="' + saved.surahNum + '"][data-verse-num="' + saved.verseNum + '"]'
    );
    if (el) {
      el.classList.add('is-last-read');
      var iconEl = el.querySelector('[data-action="last-read"] i');
      if (iconEl) iconEl.className = 'bx bxs-book-bookmark';
    }
  }

  /* ── Restore bookmarks ── */
  function restoreBookmarks() {
    var bms = lsGet(LS_BM);
    if (!bms) return;
    Object.keys(bms).forEach(function (key) {
      var parts = key.split(':');
      var sn = parts[0], vn = parts[1];
      var el = page.querySelector('[data-surah-num="' + sn + '"][data-verse-num="' + vn + '"]');
      if (el) {
        el.classList.add('is-bookmarked');
        var iconEl = el.querySelector('[data-action="bookmark"] i');
        if (iconEl) iconEl.className = 'bx bxs-star';
        var btnEl = el.querySelector('[data-action="bookmark"]');
        if (btnEl) btnEl.classList.add('is-active');
      }
    });
  }

})();
</script>

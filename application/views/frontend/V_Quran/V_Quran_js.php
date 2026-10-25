<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
  (function() {
    'use strict';

    var page = document.querySelector('[data-qr-page]');
    var status = document.querySelector('[data-copy-status]');
    var overlay = document.getElementById('qrOverlay');
    if (!page) return;

    function isMobile() {
      return window.innerWidth <= 480;
    }

    function openDots(btn) {
      btn.classList.add('is-open');
      if (isMobile() && overlay) overlay.classList.add('is-open');
    }

    function closeAllDots() {
      document.querySelectorAll('[data-dots].is-open').forEach(function(b) {
        b.classList.remove('is-open');
      });
      if (overlay) overlay.classList.remove('is-open');
    }

    /* ── Storage helpers ── */
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

    var LS_LAST = 'qr_last_read';
    var LS_BM = 'qr_bookmarks';

    /* ── Search panels ── */
    var surahTrigger = document.getElementById('qrSurahTrigger');
    var juzTrigger   = document.getElementById('qrJuzTrigger');
    var ayatTrigger  = document.getElementById('qrAyatTrigger');
    var surahPanel   = document.getElementById('qrSurahPanel');
    var juzPanel     = document.getElementById('qrJuzPanel');
    var ayatPanel    = document.getElementById('qrAyatPanel');
    var surahSearch  = document.getElementById('qrSurahSearch');
    var juzSearch    = document.getElementById('qrJuzSearch');
    var ayatSearch   = document.getElementById('qrAyatSearch');
    var panelBack    = document.getElementById('qrPanelBack');

    function openPanel(panel, trigger, searchInput) {
      closeAllPanels();
      if (!panel) return;
      panel.classList.add('is-open');
      panel.setAttribute('aria-hidden', 'false');
      if (trigger) trigger.setAttribute('aria-expanded', 'true');
      if (panelBack) panelBack.classList.add('is-open');
      if (searchInput) {
        searchInput.value = '';
        filterPanel(panel, '');
        setTimeout(function() { searchInput.focus(); }, 60);
      }
      var active = panel.querySelector('.is-active');
      if (active) setTimeout(function() {
        active.scrollIntoView({ block: 'nearest' });
      }, 80);
    }

    function closeAllPanels() {
      [surahPanel, juzPanel, ayatPanel].forEach(function(p) {
        if (p) { p.classList.remove('is-open'); p.setAttribute('aria-hidden', 'true'); }
      });
      [surahTrigger, juzTrigger, ayatTrigger].forEach(function(t) {
        if (t) t.setAttribute('aria-expanded', 'false');
      });
      if (panelBack) panelBack.classList.remove('is-open');
    }

    function filterPanel(panel, q) {
      q = q.toLowerCase().trim();
      panel.querySelectorAll('.qr-panel-item').forEach(function(li) {
        var s = (li.dataset.search || '').toLowerCase();
        li.classList.toggle('is-hidden', q !== '' && s.indexOf(q) === -1);
      });
    }

    if (surahTrigger && surahPanel) {
      surahTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        var open = surahPanel.classList.contains('is-open');
        if (open) { closeAllPanels(); } else { openPanel(surahPanel, surahTrigger, surahSearch); }
      });
    }

    if (juzTrigger && juzPanel) {
      juzTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        var open = juzPanel.classList.contains('is-open');
        if (open) { closeAllPanels(); } else { openPanel(juzPanel, juzTrigger, juzSearch); }
      });
    }

    if (ayatTrigger && ayatPanel) {
      ayatTrigger.addEventListener('click', function(e) {
        e.stopPropagation();
        var open = ayatPanel.classList.contains('is-open');
        if (open) { closeAllPanels(); } else { openPanel(ayatPanel, ayatTrigger, ayatSearch); }
      });
    }

    if (surahSearch) {
      surahSearch.addEventListener('input', function() {
        filterPanel(surahPanel, this.value);
      });
    }

    if (juzSearch) {
      juzSearch.addEventListener('input', function() {
        filterPanel(juzPanel, this.value);
      });
    }

    if (ayatSearch) {
      ayatSearch.addEventListener('input', function() {
        filterPanel(ayatPanel, this.value);
      });
    }

    /* ── Scroll helper (manual offset, more reliable than scrollIntoView + scroll-margin-top) ── */
    function scrollToVerse(el) {
      var s = getComputedStyle(document.documentElement);
      var navH = parseFloat(s.getPropertyValue('--qr-nav')) || 62;
      var subH = parseFloat(s.getPropertyValue('--qr-sub')) || 48;
      var offset = navH + subH + 10;
      var rect = el.getBoundingClientRect();
      var target = rect.top + window.pageYOffset - offset;
      window.scrollTo({ top: target, behavior: 'smooth' });
    }

    /* Ayat panel items — click to scroll */
    if (ayatPanel) {
      ayatPanel.addEventListener('click', function(e) {
        var btn = e.target.closest('[data-goto-ayat]');
        if (!btn) return;
        var n = parseInt(btn.dataset.gotoAyat, 10);
        if (!n) return;
        closeAllPanels();
        var el = page.querySelector('[data-verse-num="' + n + '"]');
        if (el) scrollToVerse(el);
      });
    }

    /* Backdrop click */
    if (panelBack) {
      panelBack.addEventListener('click', function() {
        closeAllPanels();
      });
    }

    /* Keyboard: Escape to close */
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') closeAllPanels();
    });

    /* ── Restore UI state on load ── */
    restoreLastRead();
    restoreBookmarks();

    /* ── Hash anchor scroll ── */
    if (/^#ayat-\d+-\d+$/.test(window.location.hash)) {
      var ht = document.getElementById(window.location.hash.slice(1));
      if (ht) setTimeout(function() {
        scrollToVerse(ht);
      }, 400);
    }

    /* ── Close all dropdowns when clicking outside ── */
    document.addEventListener('click', function(e) {
      if (!e.target.closest('[data-dots]') && !e.target.closest('.qr-dropdown')) {
        closeAllDots();
      }
    });

    /* ── Close on overlay tap ── */
    if (overlay) {
      overlay.addEventListener('click', function() {
        closeAllDots();
      });
    }

    /* ── Dots button toggle ── */
    page.addEventListener('click', function(e) {
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
      var verse = actionBtn.closest('[data-reader-verse]');
      if (!verse) return;

      /* Close the dropdown */
      closeAllDots();

      if (action === 'last-read') {
        doLastRead(verse);
      } else if (action === 'bookmark') {
        doBookmark(verse);
      } else if (action === 'share') {
        doShare(verse);
      } else if (action === 'copy') {
        doCopy(verse);
      }
    });

    /* ── Actions ── */

    function doLastRead(verse) {
      var data = verseData(verse);
      lsSet(LS_LAST, data);

      document.querySelectorAll('.qr-verse.is-last-read').forEach(function(v) {
        v.classList.remove('is-last-read');
      });
      verse.classList.add('is-last-read');

      var iconEl = verse.querySelector('[data-action="last-read"] i');
      if (iconEl) iconEl.className = 'bx bxs-book-bookmark';
      flash('Ayat ditandai sebagai terakhir dibaca.');
    }

    function doBookmark(verse) {
      var data = verseData(verse);
      var key = data.surahNum + ':' + data.verseNum;
      var bms = lsGet(LS_BM) || {};
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
        navigator.share({
          text: text
        }).catch(function() {});
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
        surahNum: parseInt(verse.dataset.surahNum, 10),
        verseNum: parseInt(verse.dataset.verseNum, 10),
        surahName: verse.dataset.surahName || '',
        arabic: verse.dataset.arabic || '',
        trans: verse.dataset.trans || ''
      };
    }

    function copyToClipboard(text, msg) {
      if (!navigator.clipboard) {
        flash('Clipboard tidak tersedia.');
        return;
      }
      navigator.clipboard.writeText(text)
        .then(function() {
          flash(msg);
        })
        .catch(function() {
          flash('Gagal menyalin.');
        });
    }

    function flash(msg) {
      if (!status) return;
      status.textContent = msg;
      clearTimeout(status._t);
      status._t = setTimeout(function() {
        status.textContent = '';
      }, 2800);
    }

    /* ── Juz scroll spy: show current surah in subnav ── */
    if (page && page.dataset.type === 'juz') {
      var currentSurahEl = document.getElementById('qrCurrentSurah');
      var dividers = Array.prototype.slice.call(document.querySelectorAll('.qr-divider'));

      if (currentSurahEl && dividers.length) {
        var s = getComputedStyle(document.documentElement);
        var spyOffset = (parseFloat(s.getPropertyValue('--qr-nav')) || 62)
                      + (parseFloat(s.getPropertyValue('--qr-sub')) || 48)
                      + 24;

        var spyPending = false;

        function updateSurahSpy() {
          var active = dividers[0];
          for (var i = 0; i < dividers.length; i++) {
            if (dividers[i].getBoundingClientRect().top <= spyOffset) {
              active = dividers[i];
            } else {
              break;
            }
          }
          var nameEl = active.querySelector('.qr-divider-name');
          if (nameEl) {
            var name = nameEl.textContent.trim();
            if (currentSurahEl.textContent !== name) {
              currentSurahEl.textContent = name;
            }
            currentSurahEl.classList.add('is-visible');
          }
          spyPending = false;
        }

        window.addEventListener('scroll', function() {
          if (!spyPending) {
            spyPending = true;
            requestAnimationFrame(updateSurahSpy);
          }
        }, { passive: true });

        requestAnimationFrame(updateSurahSpy);
      }
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
      Object.keys(bms).forEach(function(key) {
        var parts = key.split(':');
        var sn = parts[0],
          vn = parts[1];
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

    /* ─────────────────────────────────────────────
       QURAN-SPECIFIC SETTINGS (tajwid + terjemahan)
       Panel UI lives in V_Amalan_Subnav.php
    ───────────────────────────────────────────── */
    var LS_TAJWID = 'qr_tajwid';
    var LS_TRANS  = 'qr_trans';

    var tajwidToggle = document.getElementById('qrTajwidToggle');
    var transToggle  = document.getElementById('qrTransToggle');

    /* ── Terjemahan toggle ── */
    function applyTrans(show) {
      if (page) page.setAttribute('data-qr-trans', show ? '1' : '0');
    }

    var initTrans = lsGet(LS_TRANS);
    if (initTrans === false) {
      if (transToggle) transToggle.checked = false;
      applyTrans(false);
    }

    if (transToggle) {
      transToggle.addEventListener('change', function() {
        var show = this.checked;
        applyTrans(show);
        lsSet(LS_TRANS, show);
      });
    }

    /* ── Tajwid toggle ── */
    var tajweedCache = {};

    function loadTajweed() {
      if (!page) return;
      var surahNum = parseInt(page.dataset.surah, 10);
      var pageType = page.dataset.type;
      if (pageType === 'juz') {
        var seen = [];
        document.querySelectorAll('[data-reader-verse]').forEach(function(v) {
          var n = parseInt(v.dataset.surahNum, 10);
          if (n && seen.indexOf(n) < 0) { seen.push(n); fetchTajweed(n); }
        });
      } else if (surahNum) {
        fetchTajweed(surahNum);
      }
    }

    function fetchTajweed(surahNum) {
      if (tajweedCache[surahNum]) { applyTajweedData(surahNum, tajweedCache[surahNum]); return; }
      var ck = 'qr_tw_' + surahNum;
      var stored = null;
      try { stored = JSON.parse(sessionStorage.getItem(ck)); } catch(e) {}
      if (stored) { tajweedCache[surahNum] = stored; applyTajweedData(surahNum, stored); return; }

      fetch('https://api.quran.com/api/v4/verses/by_chapter/' + surahNum +
            '?fields=text_uthmani_tajweed&per_page=300&page=1')
        .then(function(r) { return r.json(); })
        .then(function(data) {
          if (!data || !data.verses) return;
          var map = {};
          data.verses.forEach(function(v) {
            if (v.verse_number && v.text_uthmani_tajweed) {
              map[v.verse_number] = v.text_uthmani_tajweed;
            }
          });
          tajweedCache[surahNum] = map;
          try { sessionStorage.setItem(ck, JSON.stringify(map)); } catch(e) {}
          applyTajweedData(surahNum, map);
        })
        .catch(function() { /* API unavailable — silently skip */ });
    }

    function applyTajweedData(surahNum, map) {
      document.querySelectorAll('[data-reader-verse]').forEach(function(verse) {
        if (parseInt(verse.dataset.surahNum, 10) !== surahNum) return;
        var verseNum = parseInt(verse.dataset.verseNum, 10);
        var html = map[verseNum];
        if (!html) return;
        var arabEl = verse.querySelector('.qr-arabic');
        if (!arabEl) return;
        if (!arabEl.dataset.origHtml) arabEl.dataset.origHtml = arabEl.innerHTML;
        arabEl.innerHTML = html;
      });
    }

    function removeTajweed() {
      document.querySelectorAll('[data-reader-verse]').forEach(function(verse) {
        var arabEl = verse.querySelector('.qr-arabic');
        if (!arabEl) return;
        if (arabEl.dataset.origHtml) {
          arabEl.innerHTML = arabEl.dataset.origHtml;
          delete arabEl.dataset.origHtml;
        } else {
          var ornate = arabEl.querySelector('.qr-ornate');
          var arabText = verse.dataset.arabic || '';
          arabEl.innerHTML = '';
          arabEl.appendChild(document.createTextNode(arabText + ' '));
          if (ornate) arabEl.appendChild(ornate);
        }
      });
    }

    var initTajwid = lsGet(LS_TAJWID);
    if (initTajwid === true) {
      if (tajwidToggle) tajwidToggle.checked = true;
      loadTajweed();
    }

    if (tajwidToggle) {
      tajwidToggle.addEventListener('change', function() {
        var on = this.checked;
        lsSet(LS_TAJWID, on);
        if (on) { loadTajweed(); } else { removeTajweed(); }
      });
    }

  })();
</script>
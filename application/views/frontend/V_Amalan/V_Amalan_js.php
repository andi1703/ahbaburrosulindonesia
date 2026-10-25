<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
  (function() {
    var page = document.querySelector('[data-quran-page]');
    if (!page) {
      return;
    }

    document.body.classList.add('quran-page-body');

    var tabs = Array.prototype.slice.call(page.querySelectorAll('[data-quran-mode]'));
    var surahGrid   = page.querySelector('[data-quran-grid="surah"]');
    var juzGrid     = page.querySelector('[data-quran-grid="juz"]');
    var populerGrid = page.querySelector('[data-quran-grid="populer"]');
    var searchInput = document.querySelector('[data-quran-search]');
    var sortButton = page.querySelector('[data-quran-sort]');
    var sortLabel = page.querySelector('[data-quran-sort-label]');
    var resultCount = page.querySelector('[data-quran-count]');
    var resultLabel = page.querySelector('[data-quran-count-label]');
    var emptyState = page.querySelector('[data-quran-empty]');
    var activeMode = 'surah';
    var alphabetical = false;

    tabs.forEach(function(tab) {
      tab.addEventListener('click', function() {
        activeMode = this.dataset.quranMode;
        alphabetical = false;

        tabs.forEach(function(item) {
          item.setAttribute('aria-selected', item === tab ? 'true' : 'false');
        });

        updateCatalog();
      });
    });

    sortButton.addEventListener('click', function() {
      if (activeMode !== 'surah' && activeMode !== 'revelation') {
        activeMode = 'surah';
        tabs.forEach(function(item) {
          item.setAttribute('aria-selected', item.dataset.quranMode === 'surah' ? 'true' : 'false');
        });
      }
      alphabetical = !alphabetical;
      updateCatalog();
    });

    searchInput.addEventListener('input', updateCatalog);
    page.addEventListener('click', function(event) {
      var card = event.target.closest('[data-quran-card]');
      var verseSearch = searchInput.value.trim().match(/^(\d+):(\d+)$/);

      if (card && activeMode === 'surah' && verseSearch && Number(verseSearch[1]) === Number(card.dataset.surahId || card.dataset.number)) {
        event.preventDefault();
        window.location.href = card.href + '#ayat-' + Number(verseSearch[1]) + '-' + Number(verseSearch[2]);
      }
    });

    function updateCatalog() {
      var showingJuz     = activeMode === 'juz';
      var showingPopuler = activeMode === 'populer';
      var activeGrid = showingJuz ? juzGrid : (showingPopuler ? populerGrid : surahGrid);
      var searchTerm = searchInput.value.trim().toLocaleLowerCase('id');
      var numericSearch = searchTerm.match(/^(\d+)(?::\d+)?$/);
      var cards = Array.prototype.slice.call(activeGrid.querySelectorAll('[data-quran-card]'));

      surahGrid.hidden   = showingJuz || showingPopuler;
      juzGrid.hidden     = !showingJuz;
      populerGrid.hidden = !showingPopuler;
      sortButton.disabled = showingJuz || showingPopuler;

      if (!showingJuz && !showingPopuler) {
        cards.sort(function(left, right) {
          if (activeMode === 'revelation') {
            return Number(left.dataset.revelation) - Number(right.dataset.revelation);
          }
          if (alphabetical) {
            var leftName = left.dataset.name.replace(/[^a-z0-9]/g, '');
            var rightName = right.dataset.name.replace(/[^a-z0-9]/g, '');
            return leftName.localeCompare(rightName, 'id');
          }
          return Number(left.dataset.number) - Number(right.dataset.number);
        });
        cards.forEach(function(card) {
          activeGrid.appendChild(card);
        });
      }

      var visibleCount = 0;
      cards.forEach(function(card) {
        var matches = !searchTerm || (numericSearch ?
          card.dataset.number === String(Number(numericSearch[1])) :
          card.dataset.search.indexOf(searchTerm) !== -1);
        card.hidden = !matches;
        if (matches) {
          visibleCount += 1;
        }
      });

      resultCount.textContent = String(visibleCount);
      resultLabel.textContent = showingJuz ? 'juz' : 'surah';
      emptyState.hidden = visibleCount > 0;
      sortLabel.textContent = alphabetical ? 'Nomor' : 'A–Z';
      sortButton.setAttribute('aria-pressed', alphabetical ? 'true' : 'false');
      sortButton.title = alphabetical ? 'Urutkan berdasarkan nomor' : 'Urutkan A–Z';
    }
  })();
</script>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
  (function() {
    var page = document.querySelector('.quran-reader-page');
    if (!page) {
      return;
    }

    document.body.classList.add('quran-reader-body');
    var status = page.querySelector('[data-copy-status]');
    var verseTarget = /^#ayat-\d+-\d+$/.test(window.location.hash) ?
      document.getElementById(window.location.hash.substring(1)) :
      null;

    if (verseTarget) {
      verseTarget.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
      });
    }

    page.addEventListener('click', function(event) {
      var copyButton = event.target.closest('[data-copy-verse]');
      var copyAllButton = event.target.closest('[data-copy-all]');

      if (copyButton) {
        var verse = copyButton.closest('[data-reader-verse]');
        copyText(verseText(verse), 'Ayat disalin.');
      } else if (copyAllButton) {
        var verses = Array.prototype.slice.call(page.querySelectorAll('[data-reader-verse]'));
        copyText(verses.map(verseText).join('\n\n'), 'Bacaan disalin.');
      }
    });

    function verseText(verse) {
      return verse.querySelector('.quran-reader-verse-arabic').textContent.trim() +
        '\n' +
        verse.querySelector('.quran-reader-verse-translation').textContent.trim();
    }

    function copyText(text, successMessage) {
      if (!navigator.clipboard) {
        status.textContent = 'Clipboard tidak tersedia di browser ini.';
        return;
      }

      navigator.clipboard.writeText(text).then(function() {
        status.textContent = successMessage;
      }).catch(function() {
        status.textContent = 'Bacaan tidak dapat disalin.';
      });
    }
  })();
</script>
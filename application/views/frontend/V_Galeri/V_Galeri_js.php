<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
  document.addEventListener('click', function(event) {
    var galleryItem = event.target.closest('[data-gallery-image]');
    if (!galleryItem) {
      return;
    }

    var image = document.getElementById('modalFotoImg');
    var caption = document.getElementById('modalFotoCaption');
    if (image && caption) {
      image.src = galleryItem.dataset.galleryImage;
      caption.textContent = galleryItem.dataset.galleryCaption;
    }
  });

  document.addEventListener('error', function(event) {
    var image = event.target;
    var fallback = image.dataset && image.dataset.fallbackSrc;

    if (image.tagName === 'IMG' && fallback && !image.dataset.fallbackApplied) {
      image.dataset.fallbackApplied = 'true';
      image.src = fallback;
    }
  }, true);
</script>
<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
  document.addEventListener('error', function(event) {
    var image = event.target;
    var fallback = image.dataset && image.dataset.fallbackSrc;

    if (image.tagName === 'IMG' && fallback && !image.dataset.fallbackApplied) {
      image.dataset.fallbackApplied = 'true';
      image.src = fallback;
    }
  }, true);
</script>
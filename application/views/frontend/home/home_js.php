<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<script>
    (function() {
        var videoModal = null;

        document.querySelectorAll('.btn-tab-artikel').forEach(function(tab) {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.btn-tab-artikel').forEach(function(item) {
                    item.classList.remove('active');
                });
                this.classList.add('active');

                var filter = this.dataset.filter;
                document.querySelectorAll('.artikel-card-wrap').forEach(function(card) {
                    card.style.display = filter === 'semua' || card.dataset.kategori === filter ? '' : 'none';
                });
            });
        });

        document.addEventListener('click', function(event) {
            var videoCard = event.target.closest('[data-video-id]');
            if (videoCard) {
                playVideo(videoCard.dataset.videoId, videoCard.dataset.videoTitle);
            }

            var galleryItem = event.target.closest('[data-gallery-image]');
            if (galleryItem) {
                openGalleryModal(galleryItem.dataset.galleryImage, galleryItem.dataset.galleryCaption);
            }
        });

        document.addEventListener('error', function(event) {
            var image = event.target;
            var fallback = image.dataset && image.dataset.fallbackSrc;
            if (image.tagName === 'IMG' && fallback && image.src !== new URL(fallback, document.baseURI).href) {
                image.src = fallback;
            }
        }, true);

        document.addEventListener('DOMContentLoaded', function() {
            var modalElement = document.getElementById('modalVideo');
            if (modalElement && typeof bootstrap !== 'undefined') {
                videoModal = new bootstrap.Modal(modalElement);
                modalElement.addEventListener('hidden.bs.modal', stopVideo);
            }

            scrollToRequestedSection();
        });

        function playVideo(youtubeId, title) {
            var player = document.getElementById('youtubePlayer');
            var modalTitle = document.getElementById('modalVideoLabel');

            if (player && modalTitle && videoModal) {
                player.src = 'https://www.youtube.com/embed/' + youtubeId + '?autoplay=1&rel=0';
                modalTitle.textContent = title;
                videoModal.show();
            }
        }

        function stopVideo() {
            var player = document.getElementById('youtubePlayer');
            if (player) {
                player.src = '';
            }
        }

        function openGalleryModal(imageUrl, caption) {
            var image = document.getElementById('modalFotoImg');
            var captionElement = document.getElementById('modalFotoCaption');
            if (image && captionElement) {
                image.src = imageUrl;
                captionElement.textContent = caption;
            }
        }

        function scrollToRequestedSection() {
            var path = window.location.pathname.toLowerCase();
            var targetSection = null;

            if (path.indexOf('/articles') !== -1 || path.indexOf('/artikel') !== -1) {
                targetSection = document.getElementById('artikel-section');
            } else if (path.indexOf('/news') !== -1) {
                targetSection = document.getElementById('news-section');
            } else if (path.indexOf('/sejarah') !== -1 || path.indexOf('/about') !== -1) {
                targetSection = document.getElementById('sejarah-section');
            }

            if (targetSection) {
                setTimeout(function() {
                    var navbar = document.getElementById('mainNavbar');
                    var navbarHeight = navbar ? navbar.offsetHeight : 80;
                    var targetOffset = targetSection.getBoundingClientRect().top + window.scrollY - navbarHeight - 15;
                    window.scrollTo({
                        top: targetOffset,
                        behavior: 'smooth'
                    });
                }, 300);
            }
        }
    })();
</script>
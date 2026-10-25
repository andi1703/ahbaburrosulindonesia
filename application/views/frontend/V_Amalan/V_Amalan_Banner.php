<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php if (!empty($identitas['whatsapp'])): ?>
    <div class="am-banner">
        <div class="am-banner-body">
            <span class="am-banner-ico"><i class="bx bxs-book-heart"></i></span>
            <div>
                <p class="am-banner-title">Dukung Pengembangan Majelis</p>
                <p class="am-banner-sub">Bantu kami menghadirkan fitur islami yang lebih lengkap.</p>
            </div>
        </div>
        <a class="am-banner-cta"
            href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $identitas['whatsapp']); ?>"
            target="_blank" rel="noopener">
            Hubungi Kami <i class="bx bx-chevron-right"></i>
        </a>
    </div>
<?php endif; ?>
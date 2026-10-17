<?php
defined('BASEPATH') or exit('No direct script access allowed');
$sholawat_groups = $sholawat_groups ?? [];
?>
<style>
    body { background: #0b0d0d; }
    .sh-page {
        padding-top: 1rem;

        background: #0b0d0d;
        color: #eef1ee;
    }

    .sh-hub {
        width: min(100% - 2rem, 820px);
        margin-inline: auto;
        padding-block: 1.5rem 4rem;
    }

    .sh-hub-label {
        font-size: .68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .06em;
        color: #6d7e78;
        margin: 0 0 .75rem;
    }

    .sh-groups {
        display: grid;
        grid-template-columns: repeat(2, minmax(0,1fr));
        gap: .75rem;
    }

    .sh-group-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem 1.25rem;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 14px;
        background: #131615;
        text-decoration: none;
        color: #eef1ee;
        transition: border-color 150ms, background 150ms;
    }

    .sh-group-card:hover {
        border-color: rgba(232,184,75,.4);
        background: #181b1a;
    }

    .sh-group-icon {
        display: grid;
        flex-shrink: 0;
        width: 52px; height: 52px;
        place-items: center;
        border-radius: 13px;
        font-size: 1.55rem;
    }

    .sh-group-icon--nasyid {
        background: rgba(232,184,75,.12);
        color: #e8b84b;
    }

    .sh-group-icon--suluk {
        background: rgba(232,184,75,.08);
        color: #c89430;
    }

    .sh-group-copy { min-width: 0; }

    .sh-group-name {
        display: block;
        font-size: 1rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: .2rem;
    }

    .sh-group-desc {
        display: block;
        font-size: .72rem;
        color: #6d7e78;
        line-height: 1.5;
    }

    .sh-group-count {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        margin-top: .45rem;
        padding: .2rem .65rem;
        border-radius: 99px;
        background: rgba(255,255,255,.04);
        font-size: .62rem;
        color: #8aa09a;
    }

    @media (max-width: 575.98px) {
        .sh-groups { grid-template-columns: minmax(0,1fr); }
        .sh-group-card { padding: 1rem; }
    }
</style>

<?php include VIEWPATH . 'frontend/V_Amalan/V_Amalan_Subnav.php'; ?>

<main class="sh-page">
    <div class="sh-hub">
        <p class="sh-hub-label">Pilih Kelompok Sholawat</p>

        <div class="sh-groups">
            <!-- Nasyid -->
            <a class="sh-group-card" href="<?= base_url('index.php/sholawat/nasyid'); ?>">
                <span class="sh-group-icon sh-group-icon--nasyid">
                    <i class="bx bx-heart"></i>
                </span>
                <span class="sh-group-copy">
                    <span class="sh-group-name">Nasyid</span>
                    <span class="sh-group-desc">Sholawat dan kasidah pujian kepada Nabi ﷺ</span>
                    <span class="sh-group-count">
                        <?= $sholawat_groups['Nasyid']['count'] ?? 0; ?> sholawat
                    </span>
                </span>
            </a>

            <!-- Suluk -->
            <a class="sh-group-card" href="<?= base_url('index.php/sholawat/suluk'); ?>">
                <span class="sh-group-icon sh-group-icon--suluk">
                    <i class="bx bx-feather"></i>
                </span>
                <span class="sh-group-copy">
                    <span class="sh-group-name">Suluk</span>
                    <span class="sh-group-desc">Syair suluk dan qasidah spiritual</span>
                    <span class="sh-group-count">
                        <?= $sholawat_groups['Suluk']['count'] ?? 0; ?> suluk
                    </span>
                </span>
            </a>
        </div>
    </div>
</main>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? htmlspecialchars($page_title) . ' — ' : ''; ?><?= htmlspecialchars($identitas['nama_website'] ?? 'Majelis Ahbaburrosul Indonesia'); ?></title>
    <meta name="description" content="<?= htmlspecialchars($identitas['slogan'] ?? 'Majelis Dakwah Ahbaburrosul'); ?>">
    <link rel="icon" href="<?= base_url('assets/img/logo/' . ($identitas['logo'] ?? '')); ?>">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Amiri:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <!-- Custom CSS (Cache Busted) -->
    <link class="main-stylesheet" rel="stylesheet" href="<?= base_url('assets/frontend/css/custom-style.css'); ?>?v=<?= time(); ?>">
</head>

<body>

    <!-- ========================================================
     NAVBAR — Ahbaburrosul (Fixed Top, Emerald-Gold Theme)
     ======================================================== -->
    <nav class="navbar navbar-expand-lg navbar-majelis fixed-top transition-all <?= empty($is_homepage) ? 'navbar-scrolled' : ''; ?>" id="mainNavbar">
        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url(); ?>">
                <?php if (!empty($identitas['logo'])): ?>
                    <img src="<?= base_url('assets/img/logo/' . $identitas['logo']); ?>"
                        alt="Logo <?= htmlspecialchars($identitas['nama_website'] ?? ''); ?>"
                        style="height:42px; border-radius:8px;">
                <?php endif; ?>
                <span class="fw-bold text-white" style="font-size:1.05rem; line-height:1.2;">
                    Majelis<br><span class="text-majelis-gold">Ahbaburrosul Indonesia</span>
                </span>
            </a>

            <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navMain"
                aria-controls="navMain" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">

                    <?php if (!empty($menus)): ?>
                        <?php foreach ($menus as $menu): ?>
                            <?php
                            $slug    = $menu['menu_link'];
                            $is_home = ($slug == 'welcome' || $slug == '');
                            $current = $this->uri->segment(1);
                            $is_active = $is_home
                                ? ($current == '' || $current == 'home')
                                : ($current == $slug);
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $is_active ? 'active' : ''; ?>"
                                    href="<?= $is_home ? base_url() : base_url('index.php/' . $slug); ?>">
                                    <?= htmlspecialchars($menu['menu_name']); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>
    <!-- / NAVBAR -->
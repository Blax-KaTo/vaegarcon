<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Vaegarcon - Fuel & Telemetry Engineering Solutions'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/assets/css/hero-slider.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo" style="display: flex; align-items: center;">
                <a href="<?php echo BASE_URL; ?>/" style="display: flex; align-items: center; text-decoration: none;">
                    <img src="/uploads/logo/logo.jpeg" alt="Vaegar Consulting Logo" style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; margin-right: 12px; vertical-align: middle;" />
                    <h1 style="display: inline-block; vertical-align: middle; margin: 0; font-size: 2rem; font-weight: bold; color: #fff;">Vaegar Consulting LTD</h1>
                </a>
            </div>
            <nav>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>/services">Services</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/industries">Clients</a></li>
                    <li><a href="<?php echo BASE_URL; ?>#results">Results</a></li>
                    <li><a href="<?php echo BASE_URL; ?>#about">About Us</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/blog">Blog</a></li>
                    <?php if (!empty($_SESSION['user_id']) && ($_SESSION['user_role'] ?? '') === 'admin'): ?>
                    <li><a href="<?php echo BASE_URL; ?>/admin">Admin</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/logout">Logout</a></li>
                    <?php else: ?>
                    <li><a href="<?php echo BASE_URL; ?>/login">Login</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo BASE_URL; ?>/home/contact" class="btn-primary">Contact</a></li>
                </ul>
            </nav>
            <div class="mobile-menu-btn">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>
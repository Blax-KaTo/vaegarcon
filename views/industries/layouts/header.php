<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Vaegarcon - Fuel & Telemetry Engineering Solutions'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1><a href="<?php echo BASE_URL; ?>">Vaegarcon</a></h1>
            </div>
            <nav>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>/services">Services</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/industries">Industries</a></li>
                    <li><a href="<?php echo BASE_URL; ?>#results">Results</a></li>
                    <li><a href="<?php echo BASE_URL; ?>#about">About Us</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/blog">Blog</a></li>
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
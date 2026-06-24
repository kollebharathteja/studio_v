<?php require_once __DIR__ . '/functions.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($page_title ?? APP_NAME) ?></title>
    <meta name="description" content="Studio V offers photography, printing, album design, mobile repairs, accessories, and service booking.">
    <link rel="preconnect" href="https://images.unsplash.com">
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/styles.css">
</head>
<body>
<header class="site-header">
    <a class="brand" href="<?= BASE_URL ?>/index.php" aria-label="Studio V home">
        <span class="brand-mark">V</span>
        <span>
            <strong>Studio V</strong>
            <small>Photos & Mobile Care</small>
        </span>
    </a>
    <button class="nav-toggle" type="button" aria-label="Open menu" aria-expanded="false">☰</button>
    <nav class="site-nav" aria-label="Primary navigation">
        <a class="<?= current_page() === 'index.php' ? 'active' : '' ?>" href="<?= BASE_URL ?>/index.php">Home</a>
        <a class="<?= current_page() === 'photo-services.php' ? 'active' : '' ?>" href="<?= BASE_URL ?>/photo-services.php">Photo Studio</a>
        <a class="<?= current_page() === 'mobile-services.php' ? 'active' : '' ?>" href="<?= BASE_URL ?>/mobile-services.php">Mobile Service</a>
        <a class="<?= current_page() === 'booking.php' ? 'active' : '' ?>" href="<?= BASE_URL ?>/booking.php">Book</a>
        <a class="<?= current_page() === 'track.php' ? 'active' : '' ?>" href="<?= BASE_URL ?>/track.php">Track Repair</a>
        <a class="<?= current_page() === 'contact.php' ? 'active' : '' ?>" href="<?= BASE_URL ?>/contact.php">Contact</a>
    </nav>
</header>
<main>
<?php if (!db_available()): ?>
    <div class="setup-alert">Database not connected yet. Import <strong>database/studio_v.sql</strong> into MySQL to enable bookings, admin, and messages.</div>
<?php endif; ?>

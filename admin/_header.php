<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($page_title ?? 'Admin') ?> | Studio V</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/styles.css">
</head>
<body class="admin-body">
<aside class="admin-sidebar">
    <a class="brand admin-brand" href="<?= BASE_URL ?>/admin/dashboard.php">
        <span class="brand-mark">V</span>
        <span><strong>Studio V</strong><small>Admin</small></span>
    </a>
    <nav>
        <a href="<?= BASE_URL ?>/admin/dashboard.php">Dashboard</a>
        <a href="<?= BASE_URL ?>/admin/bookings.php">Bookings</a>
        <a href="<?= BASE_URL ?>/admin/services.php">Services</a>
        <a href="<?= BASE_URL ?>/admin/messages.php">Messages</a>
        <a href="<?= BASE_URL ?>/index.php">View Site</a>
        <a href="<?= BASE_URL ?>/admin/logout.php">Logout</a>
    </nav>
</aside>
<main class="admin-main">

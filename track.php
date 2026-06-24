<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Track Repair | Studio V';
$repair = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && db_available()) {
    $stmt = db()->prepare('SELECT b.*, s.name AS service_name FROM bookings b LEFT JOIN services s ON s.id = b.service_id WHERE b.tracking_code = ? AND b.booking_type = "mobile"');
    $stmt->execute([trim($_POST['tracking_code'])]);
    $repair = $stmt->fetch() ?: null;
}

require_once __DIR__ . '/includes/header.php';
?>
<section class="page-hero track-hero">
    <div>
        <p class="eyebrow">Repair Tracking</p>
        <h1>Check your mobile repair request status.</h1>
        <p>Enter the tracking code provided after submitting your mobile repair request.</p>
    </div>
</section>

<section class="section form-section">
    <form class="studio-form compact-form" method="post">
        <label>Tracking Code <input type="text" name="tracking_code" placeholder="SVR-1234ABCD" required></label>
        <button class="button primary" type="submit" <?= db_available() ? '' : 'disabled' ?>>Track Repair</button>
    </form>
    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <?php if ($repair): ?>
            <article class="tracking-card">
                <p class="eyebrow"><?= e($repair['tracking_code']) ?></p>
                <h2><?= e(repair_status_label($repair['repair_status'])) ?></h2>
                <p><strong>Service:</strong> <?= e($repair['service_name']) ?></p>
                <p><strong>Device:</strong> <?= e($repair['device_model'] ?: 'Not specified') ?></p>
                <p><strong>Submitted:</strong> <?= e(date('d M Y', strtotime($repair['created_at']))) ?></p>
            </article>
        <?php else: ?>
            <div class="notice warning">No repair request found for that tracking code.</div>
        <?php endif; ?>
    <?php endif; ?>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

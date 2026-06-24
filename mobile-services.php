<?php
$page_title = 'Mobile Repair Services | Studio V';
require_once __DIR__ . '/includes/header.php';
$mobile_services = services('mobile');
?>
<section class="page-hero mobile-hero">
    <div>
        <p class="eyebrow">Mobile Service</p>
        <h1>Clear repair guidance and practical service tracking.</h1>
        <p>Request screen replacement, battery service, software updates, accessories, or diagnostics for common mobile issues.</p>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">Repair Desk</p>
        <h2>Service details and starting prices.</h2>
    </div>
    <div class="pricing-table">
        <?php foreach ($mobile_services as $service): ?>
            <article>
                <div>
                    <h3><?= e($service['name']) ?></h3>
                    <p><?= e($service['description']) ?></p>
                </div>
                <strong><?= e($service['price']) ?></strong>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section repair-steps">
    <div>
        <p class="eyebrow">Tracking</p>
        <h2>Every repair request gets a tracking code.</h2>
        <p>After submitting a mobile repair request, customers receive a reference code they can use to check the current repair status online.</p>
    </div>
    <a class="button primary" href="<?= BASE_URL ?>/booking.php?type=mobile">Request Repair</a>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

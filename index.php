<?php
$page_title = 'Studio V | Photo Studio & Mobile Service';
require_once __DIR__ . '/includes/header.php';
$photo_services = array_slice(services('photo'), 0, 3);
$mobile_services = array_slice(services('mobile'), 0, 3);
?>
<section class="hero">
    <div class="hero-copy">
        <p class="eyebrow">Studio V</p>
        <h1>Photography and mobile care from one professional local studio.</h1>
        <p>Book passport photos, wedding and event shoots, print memories, frame portraits, or request fast mobile repair support.</p>
        <div class="hero-actions">
            <a class="button primary" href="<?= BASE_URL ?>/booking.php">Book Appointment</a>
            <a class="button secondary" href="<?= BASE_URL ?>/mobile-services.php">View Repairs</a>
        </div>
    </div>
    <div class="hero-visual" aria-label="Studio V photography and mobile service collage">
        <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?auto=format&fit=crop&w=900&q=80" alt="Professional camera in photo studio">
        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=600&q=80" alt="Mobile phone service desk">
    </div>
</section>

<section class="section two-column">
    <div>
        <p class="eyebrow">What We Do</p>
        <h2>One counter for polished photos and practical phone fixes.</h2>
    </div>
    <p>Studio V helps customers capture important moments and keep everyday devices working. The site brings service discovery, appointment booking, repair requests, customer messages, and admin management into one simple system.</p>
</section>

<section class="section service-split">
    <div class="service-panel photo-panel">
        <div class="panel-content">
            <p class="eyebrow">Photo Studio</p>
            <h2>Portraits, events, prints, frames, and albums.</h2>
            <div class="mini-list">
                <?php foreach ($photo_services as $service): ?>
                    <span><?= e($service['name']) ?></span>
                <?php endforeach; ?>
            </div>
            <a class="text-link" href="<?= BASE_URL ?>/photo-services.php">Explore photo services</a>
        </div>
    </div>
    <div class="service-panel mobile-panel">
        <div class="panel-content">
            <p class="eyebrow">Mobile Service</p>
            <h2>Screen, battery, software, accessories, and repairs.</h2>
            <div class="mini-list">
                <?php foreach ($mobile_services as $service): ?>
                    <span><?= e($service['name']) ?></span>
                <?php endforeach; ?>
            </div>
            <a class="text-link" href="<?= BASE_URL ?>/mobile-services.php">Explore mobile services</a>
        </div>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">Customer Reviews</p>
        <h2>Trusted for important days and urgent repairs.</h2>
    </div>
    <div class="reviews">
        <article>
            <p>"Quick passport photos and excellent print quality. The team was helpful and professional."</p>
            <strong>Meera S.</strong>
        </article>
        <article>
            <p>"They replaced my phone screen the same day and kept me updated through the repair."</p>
            <strong>Arun K.</strong>
        </article>
        <article>
            <p>"Our engagement album came out beautifully. Clean designs and lovely finishing."</p>
            <strong>Nisha R.</strong>
        </article>
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

<?php
$page_title = 'Photo Studio Services | Studio V';
require_once __DIR__ . '/includes/header.php';
$photo_services = services('photo');
?>
<section class="page-hero photo-hero">
    <div>
        <p class="eyebrow">Photo Studio</p>
        <h1>Photos that feel finished before they leave the shop.</h1>
        <p>From quick passport photos to wedding coverage and album design, Studio V handles the full photo workflow.</p>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">Services</p>
        <h2>Photography, printing, framing, and albums.</h2>
    </div>
    <div class="card-grid">
        <?php foreach ($photo_services as $service): ?>
            <article class="service-card">
                <h3><?= e($service['name']) ?></h3>
                <p><?= e($service['description']) ?></p>
                <span><?= e($service['price']) ?></span>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section">
    <div class="section-heading">
        <p class="eyebrow">Gallery</p>
        <h2>Sample studio looks and event coverage.</h2>
    </div>
    <div class="gallery">
        <img src="https://images.unsplash.com/photo-1523438885200-e635ba2c371e?auto=format&fit=crop&w=700&q=80" alt="Wedding couple portrait">
        <img src="https://images.unsplash.com/photo-1505236858219-8359eb29e329?auto=format&fit=crop&w=700&q=80" alt="Event celebration photography">
        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=700&q=80" alt="Studio portrait sample">
        <img src="https://images.unsplash.com/photo-1560472355-536de3962603?auto=format&fit=crop&w=700&q=80" alt="Printed photo layout">
        <img src="https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=700&q=80" alt="Wedding ring photo detail">
        <img src="https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=700&q=80" alt="Wedding photography moment">
    </div>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

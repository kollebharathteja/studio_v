<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Contact Studio V';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && db_available()) {
    $stmt = db()->prepare('INSERT INTO contact_messages (name, phone, email, subject, message) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([
        trim($_POST['name']),
        trim($_POST['phone']),
        trim($_POST['email']),
        trim($_POST['subject']),
        trim($_POST['message']),
    ]);
    flash('success', 'Message sent. Studio V will get back to you soon.');
    redirect('/contact.php');
}

require_once __DIR__ . '/includes/header.php';
?>
<section class="page-hero contact-hero">
    <div>
        <p class="eyebrow">Contact</p>
        <h1>Visit the shop, call, email, or send a message.</h1>
        <p>Studio V is ready for photo work, mobile repair questions, bookings, and service updates.</p>
    </div>
</section>

<section class="section contact-grid">
    <div class="contact-details">
        <h2>Shop Details</h2>
        <p><strong>Location:</strong> <?= e(SHOP_ADDRESS) ?></p>
        <p><strong>Phone:</strong> <?= e(SHOP_PHONE) ?></p>
        <p><strong>Email:</strong> <?= e(SHOP_EMAIL) ?></p>
        <a class="button secondary" href="https://wa.me/<?= e(WHATSAPP_NUMBER) ?>" target="_blank" rel="noopener">Chat on WhatsApp</a>
    </div>
    <form class="studio-form" method="post">
        <?php if ($message = flash('success')): ?>
            <div class="notice success"><?= e($message) ?></div>
        <?php endif; ?>
        <label>Name <input type="text" name="name" required></label>
        <label>Phone <input type="tel" name="phone" required></label>
        <label>Email <input type="email" name="email"></label>
        <label>Subject <input type="text" name="subject" required></label>
        <label>Message <textarea name="message" rows="5" required></textarea></label>
        <button class="button primary" type="submit" <?= db_available() ? '' : 'disabled' ?>>Send Message</button>
    </form>
</section>

<section class="map-wrap">
    <iframe title="Studio V location map" src="<?= e(GOOGLE_MAP_EMBED) ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

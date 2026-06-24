<?php
require_once __DIR__ . '/includes/functions.php';
$page_title = 'Book a Service | Studio V';
$selected_type = $_GET['type'] ?? 'photo';
$tracking_code = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && db_available()) {
    $booking_type = $_POST['booking_type'] === 'mobile' ? 'mobile' : 'photo';
    $tracking_code = $booking_type === 'mobile' ? 'SVR-' . strtoupper(substr(bin2hex(random_bytes(4)), 0, 8)) : null;

    $stmt = db()->prepare(
        'INSERT INTO bookings (customer_name, phone, email, booking_type, service_id, preferred_date, preferred_time, device_model, issue_description, message, tracking_code)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
    );
    $stmt->execute([
        trim($_POST['customer_name']),
        trim($_POST['phone']),
        trim($_POST['email']),
        $booking_type,
        (int) $_POST['service_id'],
        $_POST['preferred_date'] ?: null,
        $_POST['preferred_time'] ?: null,
        trim($_POST['device_model'] ?? ''),
        trim($_POST['issue_description'] ?? ''),
        trim($_POST['message'] ?? ''),
        $tracking_code,
    ]);

    flash('success', $booking_type === 'mobile'
        ? 'Repair request submitted. Tracking code: ' . $tracking_code
        : 'Photography booking submitted. Studio V will contact you soon.');
    redirect('/booking.php' . ($booking_type === 'mobile' ? '?type=mobile' : ''));
}

require_once __DIR__ . '/includes/header.php';
$all_services = services();
?>
<section class="page-hero booking-hero">
    <div>
        <p class="eyebrow">Booking</p>
        <h1>Reserve a photo session or request a mobile repair.</h1>
        <p>Choose the service type, share your details, and the Studio V team will follow up.</p>
    </div>
</section>

<section class="section form-section">
    <?php if ($message = flash('success')): ?>
        <div class="notice success"><?= e($message) ?></div>
    <?php endif; ?>
    <form class="studio-form" method="post">
        <div class="form-row">
            <label>
                Service Type
                <select name="booking_type" id="bookingType" required>
                    <option value="photo" <?= $selected_type !== 'mobile' ? 'selected' : '' ?>>Photography booking</option>
                    <option value="mobile" <?= $selected_type === 'mobile' ? 'selected' : '' ?>>Mobile repair request</option>
                </select>
            </label>
            <label>
                Service
                <select name="service_id" id="serviceSelect" required>
                    <?php foreach ($all_services as $service): ?>
                        <option value="<?= (int) $service['id'] ?>" data-category="<?= e($service['category']) ?>"><?= e($service['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
        </div>
        <div class="form-row">
            <label>
                Name
                <input type="text" name="customer_name" required>
            </label>
            <label>
                Phone
                <input type="tel" name="phone" required>
            </label>
        </div>
        <div class="form-row">
            <label>
                Email
                <input type="email" name="email">
            </label>
            <label>
                Preferred Date
                <input type="date" name="preferred_date">
            </label>
            <label>
                Preferred Time
                <input type="time" name="preferred_time">
            </label>
        </div>
        <div class="mobile-fields">
            <label>
                Device Model
                <input type="text" name="device_model" placeholder="Example: iPhone 13, Redmi Note 12">
            </label>
            <label>
                Issue Description
                <textarea name="issue_description" rows="4" placeholder="Describe the problem, damage, or symptoms"></textarea>
            </label>
        </div>
        <label>
            Message
            <textarea name="message" rows="4" placeholder="Any extra details"></textarea>
        </label>
        <button class="button primary" type="submit" <?= db_available() ? '' : 'disabled' ?>>Submit Request</button>
    </form>
</section>
<?php require_once __DIR__ . '/includes/footer.php'; ?>

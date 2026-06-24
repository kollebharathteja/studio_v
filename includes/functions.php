<?php
declare(strict_types=1);

require_once __DIR__ . '/db.php';

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function current_page(): string
{
    return basename($_SERVER['SCRIPT_NAME']);
}

function redirect(string $path): never
{
    header('Location: ' . BASE_URL . $path);
    exit;
}

function flash(?string $key = null, ?string $message = null): ?string
{
    if ($key !== null && $message !== null) {
        $_SESSION['flash'][$key] = $message;
        return null;
    }

    if ($key === null) {
        return null;
    }

    $value = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $value;
}

function services(?string $category = null): array
{
    if (!db_available()) {
        return fallback_services($category);
    }

    if ($category) {
        $stmt = db()->prepare('SELECT * FROM services WHERE category = ? AND is_active = 1 ORDER BY sort_order, name');
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    }

    return db()->query('SELECT * FROM services WHERE is_active = 1 ORDER BY category, sort_order, name')->fetchAll();
}

function fallback_services(?string $category = null): array
{
    $items = [
        ['id' => 1, 'category' => 'photo', 'name' => 'Passport Photos', 'description' => 'Fast ID-ready photos with clean lighting and print options.', 'price' => 'From Rs. 120'],
        ['id' => 2, 'category' => 'photo', 'name' => 'Wedding Photography', 'description' => 'Ceremony, portraits, candid moments, albums, and edited delivery.', 'price' => 'Custom quote'],
        ['id' => 3, 'category' => 'photo', 'name' => 'Event Photography', 'description' => 'Coverage for birthdays, launches, parties, school functions, and gatherings.', 'price' => 'From Rs. 4,999'],
        ['id' => 4, 'category' => 'photo', 'name' => 'Photo Printing', 'description' => 'High-quality prints in popular sizes with quick turnaround.', 'price' => 'From Rs. 15'],
        ['id' => 5, 'category' => 'photo', 'name' => 'Photo Frames', 'description' => 'Classic and modern frames for portraits, gifts, and wall displays.', 'price' => 'From Rs. 249'],
        ['id' => 6, 'category' => 'photo', 'name' => 'Album Design', 'description' => 'Designed albums with curated layouts and premium finishing.', 'price' => 'From Rs. 1,999'],
        ['id' => 7, 'category' => 'mobile', 'name' => 'Screen Replacement', 'description' => 'Display and touch replacement for popular Android and iPhone models.', 'price' => 'Model based'],
        ['id' => 8, 'category' => 'mobile', 'name' => 'Battery Replacement', 'description' => 'Battery diagnostics and replacement with service warranty.', 'price' => 'Model based'],
        ['id' => 9, 'category' => 'mobile', 'name' => 'Software Updates', 'description' => 'OS updates, app setup, data cleanup, and performance tuning.', 'price' => 'From Rs. 299'],
        ['id' => 10, 'category' => 'mobile', 'name' => 'Mobile Accessories', 'description' => 'Cases, chargers, cables, guards, earphones, and daily essentials.', 'price' => 'Varies'],
        ['id' => 11, 'category' => 'mobile', 'name' => 'General Repairs', 'description' => 'Charging, speaker, microphone, camera, water damage, and diagnostics.', 'price' => 'Inspection first'],
    ];

    return array_values(array_filter($items, fn ($item) => $category === null || $item['category'] === $category));
}

function require_admin(): void
{
    if (empty($_SESSION['admin_id'])) {
        redirect('/admin/login.php');
    }
}

function booking_status_label(string $status): string
{
    return match ($status) {
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        default => 'Pending',
    };
}

function repair_status_label(string $status): string
{
    return match ($status) {
        'diagnosing' => 'Diagnosing',
        'waiting_parts' => 'Waiting for Parts',
        'ready' => 'Ready',
        'delivered' => 'Delivered',
        'cancelled' => 'Cancelled',
        default => 'Received',
    };
}

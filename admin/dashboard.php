<?php
$page_title = 'Dashboard';
require_once __DIR__ . '/_header.php';

$counts = ['bookings' => 0, 'mobile' => 0, 'messages' => 0, 'services' => 0];
if (db_available()) {
    $counts['bookings'] = (int) db()->query('SELECT COUNT(*) FROM bookings')->fetchColumn();
    $counts['mobile'] = (int) db()->query('SELECT COUNT(*) FROM bookings WHERE booking_type = "mobile"')->fetchColumn();
    $counts['messages'] = (int) db()->query('SELECT COUNT(*) FROM contact_messages')->fetchColumn();
    $counts['services'] = (int) db()->query('SELECT COUNT(*) FROM services')->fetchColumn();
    $recent = db()->query('SELECT b.*, s.name AS service_name FROM bookings b LEFT JOIN services s ON s.id = b.service_id ORDER BY b.created_at DESC LIMIT 6')->fetchAll();
} else {
    $recent = [];
}
?>
<div class="admin-top">
    <div>
        <p class="eyebrow">Overview</p>
        <h1>Welcome, <?= e($_SESSION['admin_name'] ?? 'Admin') ?></h1>
    </div>
</div>
<section class="stats-grid">
    <article><span><?= $counts['bookings'] ?></span><strong>Total Bookings</strong></article>
    <article><span><?= $counts['mobile'] ?></span><strong>Repair Requests</strong></article>
    <article><span><?= $counts['messages'] ?></span><strong>Messages</strong></article>
    <article><span><?= $counts['services'] ?></span><strong>Services</strong></article>
</section>
<section class="admin-panel">
    <h2>Recent Requests</h2>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Name</th><th>Type</th><th>Service</th><th>Date</th><th>Status</th></tr></thead>
            <tbody>
            <?php foreach ($recent as $row): ?>
                <tr>
                    <td><?= e($row['customer_name']) ?></td>
                    <td><?= e(ucfirst($row['booking_type'])) ?></td>
                    <td><?= e($row['service_name']) ?></td>
                    <td><?= e($row['preferred_date'] ?: date('d M Y', strtotime($row['created_at']))) ?></td>
                    <td><?= e($row['booking_type'] === 'mobile' ? repair_status_label($row['repair_status']) : booking_status_label($row['status'])) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require_once __DIR__ . '/_footer.php'; ?>

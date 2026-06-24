<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && db_available()) {
    $stmt = db()->prepare('UPDATE bookings SET status = ?, repair_status = ? WHERE id = ?');
    $stmt->execute([$_POST['status'], $_POST['repair_status'], (int) $_POST['id']]);
    flash('success', 'Request updated.');
    redirect('/admin/bookings.php');
}

$page_title = 'Bookings';
require_once __DIR__ . '/_header.php';
$bookings = db_available()
    ? db()->query('SELECT b.*, s.name AS service_name FROM bookings b LEFT JOIN services s ON s.id = b.service_id ORDER BY b.created_at DESC')->fetchAll()
    : [];
?>
<div class="admin-top"><div><p class="eyebrow">Manage</p><h1>Bookings & Repair Requests</h1></div></div>
<?php if ($message = flash('success')): ?><div class="notice success"><?= e($message) ?></div><?php endif; ?>
<section class="admin-panel">
    <div class="table-wrap">
        <table>
            <thead><tr><th>Customer</th><th>Service</th><th>Schedule</th><th>Repair</th><th>Status</th><th>Update</th></tr></thead>
            <tbody>
            <?php foreach ($bookings as $row): ?>
                <tr>
                    <td>
                        <strong><?= e($row['customer_name']) ?></strong><br>
                        <?= e($row['phone']) ?><br><?= e($row['email']) ?>
                    </td>
                    <td><?= e($row['service_name']) ?><br><small><?= e(ucfirst($row['booking_type'])) ?></small></td>
                    <td><?= e($row['preferred_date'] ?: '-') ?><br><?= e($row['preferred_time'] ?: '') ?></td>
                    <td>
                        <?php if ($row['booking_type'] === 'mobile'): ?>
                            <strong><?= e($row['tracking_code']) ?></strong><br>
                            <?= e($row['device_model']) ?><br>
                            <small><?= e($row['issue_description']) ?></small>
                        <?php else: ?>
                            <small><?= e($row['message']) ?></small>
                        <?php endif; ?>
                    </td>
                    <td><?= e($row['booking_type'] === 'mobile' ? repair_status_label($row['repair_status']) : booking_status_label($row['status'])) ?></td>
                    <td>
                        <form method="post" class="inline-form">
                            <input type="hidden" name="id" value="<?= (int) $row['id'] ?>">
                            <select name="status">
                                <?php foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status): ?>
                                    <option value="<?= e($status) ?>" <?= $row['status'] === $status ? 'selected' : '' ?>><?= e(booking_status_label($status)) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <select name="repair_status">
                                <?php foreach (['received', 'diagnosing', 'waiting_parts', 'ready', 'delivered', 'cancelled'] as $status): ?>
                                    <option value="<?= e($status) ?>" <?= $row['repair_status'] === $status ? 'selected' : '' ?>><?= e(repair_status_label($status)) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">Save</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require_once __DIR__ . '/_footer.php'; ?>

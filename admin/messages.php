<?php
$page_title = 'Messages';
require_once __DIR__ . '/_header.php';
$messages = db_available() ? db()->query('SELECT * FROM contact_messages ORDER BY created_at DESC')->fetchAll() : [];
?>
<div class="admin-top"><div><p class="eyebrow">Inbox</p><h1>Contact Messages</h1></div></div>
<section class="admin-panel">
    <div class="table-wrap">
        <table>
            <thead><tr><th>Sender</th><th>Subject</th><th>Message</th><th>Received</th></tr></thead>
            <tbody>
            <?php foreach ($messages as $row): ?>
                <tr>
                    <td><strong><?= e($row['name']) ?></strong><br><?= e($row['phone']) ?><br><?= e($row['email']) ?></td>
                    <td><?= e($row['subject']) ?></td>
                    <td><?= e($row['message']) ?></td>
                    <td><?= e(date('d M Y, h:i A', strtotime($row['created_at']))) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php require_once __DIR__ . '/_footer.php'; ?>

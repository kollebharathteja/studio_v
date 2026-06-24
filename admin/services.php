<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && db_available()) {
    $stmt = db()->prepare('UPDATE services SET name = ?, description = ?, price = ?, is_active = ? WHERE id = ?');
    $stmt->execute([trim($_POST['name']), trim($_POST['description']), trim($_POST['price']), isset($_POST['is_active']) ? 1 : 0, (int) $_POST['id']]);
    flash('success', 'Service updated.');
    redirect('/admin/services.php');
}

$page_title = 'Services';
require_once __DIR__ . '/_header.php';
$items = db_available() ? db()->query('SELECT * FROM services ORDER BY category, sort_order, name')->fetchAll() : [];
?>
<div class="admin-top"><div><p class="eyebrow">Manage</p><h1>Service Details</h1></div></div>
<?php if ($message = flash('success')): ?><div class="notice success"><?= e($message) ?></div><?php endif; ?>
<section class="admin-panel service-editor">
    <?php foreach ($items as $service): ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= (int) $service['id'] ?>">
            <div class="form-row">
                <label>Name <input name="name" value="<?= e($service['name']) ?>" required></label>
                <label>Price <input name="price" value="<?= e($service['price']) ?>"></label>
            </div>
            <label>Description <textarea name="description" rows="3"><?= e($service['description']) ?></textarea></label>
            <label class="check-row"><input type="checkbox" name="is_active" <?= $service['is_active'] ? 'checked' : '' ?>> Active <?= e($service['category']) ?> service</label>
            <button class="button secondary" type="submit">Update Service</button>
        </form>
    <?php endforeach; ?>
</section>
<?php require_once __DIR__ . '/_footer.php'; ?>

<?php
require_once __DIR__ . '/../includes/functions.php';

if (!db_available()) {
    $error = 'Database is not connected. Import database/studio_v.sql first.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = db()->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
    $stmt->execute([trim($_POST['email'])]);
    $user = $stmt->fetch();
    $password = (string) $_POST['password'];
    $valid = $user && (password_verify($password, $user['password_hash']) || hash_equals($user['password_hash'], $password));

    if ($valid) {
        if (hash_equals($user['password_hash'], $password)) {
            $newHash = password_hash($password, PASSWORD_DEFAULT);
            $update = db()->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
            $update->execute([$newHash, $user['id']]);
        }
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_name'] = $user['name'];
        redirect('/admin/dashboard.php');
    }

    $error = 'Invalid admin email or password.';
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Studio V</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/styles.css">
</head>
<body class="admin-login-body">
    <form class="admin-login" method="post">
        <span class="brand-mark">V</span>
        <h1>Studio V Admin</h1>
        <?php if (!empty($error)): ?><div class="notice warning"><?= e($error) ?></div><?php endif; ?>
        <label>Email <input type="email" name="email" required value="admin@studiov.local"></label>
        <label>Password <input type="password" name="password" required></label>
        <button class="button primary" type="submit">Login</button>
        <a href="<?= BASE_URL ?>/index.php">Back to website</a>
    </form>
</body>
</html>

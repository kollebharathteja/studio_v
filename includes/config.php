<?php
declare(strict_types=1);

$sessionPath = dirname(__DIR__) . '/storage/sessions';
if (!is_dir($sessionPath)) {
    mkdir($sessionPath, 0775, true);
}
ini_set('session.save_path', $sessionPath);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Kolkata');

define('APP_NAME', 'Studio V');
define('BASE_URL', '/Studio%20V');

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'studio_v');
define('DB_USER', 'root');
define('DB_PASS', '');

define('SHOP_PHONE', '+91 9000049153');
define('SHOP_EMAIL', 'studiov143@gmail.com');
define('SHOP_ADDRESS', 'Srinivasa complex (Opposite Anna Canteen),Nirugattu Vari Palli,
Madanapalle,
Annamayya District – 517325, India');
define('WHATSAPP_NUMBER', '9000049153');
define('GOOGLE_MAP_EMBED', 'https://www.google.com/maps?q=HFCX%2B9VH%20Sri%20Vinayaka%20Mobiles%2C%20Kadiri%20Rd%2C%20near%20Tomato%20Market%2C%20Neerugattupalle%2C%20Madanapalle%2C%20Andhra%20Pradesh%20517325&z=17&output=embed');

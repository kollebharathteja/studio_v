CREATE DATABASE IF NOT EXISTS studio_v CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE studio_v;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(160) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin') NOT NULL DEFAULT 'admin',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category ENUM('photo', 'mobile') NOT NULL,
    name VARCHAR(160) NOT NULL,
    description TEXT NOT NULL,
    price VARCHAR(80) DEFAULT NULL,
    sort_order INT UNSIGNED NOT NULL DEFAULT 0,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bookings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(160) NOT NULL,
    phone VARCHAR(40) NOT NULL,
    email VARCHAR(160) DEFAULT NULL,
    booking_type ENUM('photo', 'mobile') NOT NULL,
    service_id INT UNSIGNED DEFAULT NULL,
    preferred_date DATE DEFAULT NULL,
    preferred_time TIME DEFAULT NULL,
    device_model VARCHAR(160) DEFAULT NULL,
    issue_description TEXT DEFAULT NULL,
    message TEXT DEFAULT NULL,
    tracking_code VARCHAR(40) DEFAULT NULL UNIQUE,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    repair_status ENUM('received', 'diagnosing', 'waiting_parts', 'ready', 'delivered', 'cancelled') NOT NULL DEFAULT 'received',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_bookings_service FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(160) NOT NULL,
    phone VARCHAR(40) NOT NULL,
    email VARCHAR(160) DEFAULT NULL,
    subject VARCHAR(180) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password_hash, role)
VALUES ('Studio V Admin', 'admin@studiov.local', 'admin123', 'admin')
ON DUPLICATE KEY UPDATE email = VALUES(email);

INSERT INTO services (category, name, description, price, sort_order) VALUES
('photo', 'Passport Photos', 'Fast ID-ready photos with clean lighting and print options.', 'From Rs. 120', 1),
('photo', 'Wedding Photography', 'Ceremony, portraits, candid moments, albums, and edited delivery.', 'Custom quote', 2),
('photo', 'Event Photography', 'Coverage for birthdays, launches, parties, school functions, and gatherings.', 'From Rs. 4,999', 3),
('photo', 'Photo Printing', 'High-quality prints in popular sizes with quick turnaround.', 'From Rs. 15', 4),
('photo', 'Photo Frames', 'Classic and modern frames for portraits, gifts, and wall displays.', 'From Rs. 249', 5),
('photo', 'Album Design', 'Designed albums with curated layouts and premium finishing.', 'From Rs. 1,999', 6),
('mobile', 'Screen Replacement', 'Display and touch replacement for popular Android and iPhone models.', 'Model based', 1),
('mobile', 'Battery Replacement', 'Battery diagnostics and replacement with service warranty.', 'Model based', 2),
('mobile', 'Software Updates', 'OS updates, app setup, data cleanup, and performance tuning.', 'From Rs. 299', 3),
('mobile', 'Mobile Accessories', 'Cases, chargers, cables, guards, earphones, and daily essentials.', 'Varies', 4),
('mobile', 'General Repairs', 'Charging, speaker, microphone, camera, water damage, and diagnostics.', 'Inspection first', 5);

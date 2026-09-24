CREATE TABLE IF NOT EXISTS roles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS features (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    feature_name VARCHAR(150) NOT NULL,
    feature_slug VARCHAR(150) NOT NULL UNIQUE,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS role_permissions (
    role_id INT UNSIGNED NOT NULL,
    feature_id INT UNSIGNED NOT NULL,
    can_read TINYINT(1) NOT NULL DEFAULT 0,
    can_create TINYINT(1) NOT NULL DEFAULT 0,
    can_update TINYINT(1) NOT NULL DEFAULT 0,
    can_delete TINYINT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY (role_id, feature_id),
    CONSTRAINT fk_role_permissions_role FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    CONSTRAINT fk_role_permissions_feature FOREIGN KEY (feature_id) REFERENCES features(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT IGNORE INTO roles (role_name, description) VALUES
('Super Admin', 'Akses penuh seluruh fitur CMS'),
('Admin Konten', 'Mengelola konten CMS'),
('Penulis', 'Membuat dan mengubah konten'),
('Approver', 'Memeriksa dan menyetujui konten');

INSERT IGNORE INTO features (feature_name, feature_slug)
SELECT menu_name, menu_link FROM menus;

INSERT IGNORE INTO features (feature_name, feature_slug) VALUES
('Master Kategori User', 'back_role'),
('User Management', 'back_user'),
('Manajemen Fitur & Hak Akses', 'admin/manajemen_menu');

ALTER TABLE users ADD COLUMN role_id INT UNSIGNED NULL AFTER role;
ALTER TABLE users ADD COLUMN is_active TINYINT(1) NOT NULL DEFAULT 1 AFTER role_id;

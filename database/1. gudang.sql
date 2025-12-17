DROP TABLE IF EXISTS gudang;

CREATE TABLE gudang (
    id_gudang CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nama_gudang VARCHAR(100) NOT NULL,
    lokasi_gudang VARCHAR(255) NOT NULL,
    status_gudang ENUM('trial', 'active', 'expired', 'banned') DEFAULT 'trial',
    expired_date_gudang DATETIME NULL
);

ALTER TABLE `gudang` 
ADD COLUMN `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
ADD COLUMN `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;
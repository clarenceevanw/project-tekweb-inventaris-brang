DROP TABLE IF EXISTS paket_subscription;

CREATE TABLE paket_subscription (
    id_paket CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nama_paket VARCHAR(100) NOT NULL, -- Cth: Basic Bulanan, Pro Tahunan
    harga DECIMAL(15, 2) NOT NULL,    -- Cth: 500000.00
    durasi_hari INT NOT NULL,         -- Cth: 30 (sebulan), 365 (setahun)
    deskripsi TEXT
);
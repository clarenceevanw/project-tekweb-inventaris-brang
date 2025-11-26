DROP TABLE IF EXISTS gudang;

CREATE TABLE gudang (
    id_gudang CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nama_gudang VARCHAR(100) NOT NULL,
    lokasi_gudang VARCHAR(255) NOT NULL
);

DROP TABLE IF EXISTS transaksi;

CREATE TABLE transaksi (
    id_transaksi CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    jenis_transaksi ENUM('supply', 'buy') NOT NULL,
    tanggal_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP,
    harga_transaksi DECIMAL(15, 2) NOT NULL,
    id_mitra CHAR(36),
    id_admin CHAR(36),

    FOREIGN KEY (id_mitra)
        REFERENCES mitra(id_mitra)
        ON DELETE SET NULL
        ON UPDATE CASCADE,
    
    FOREIGN KEY (id_admin)
        REFERENCES admin(id_admin)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

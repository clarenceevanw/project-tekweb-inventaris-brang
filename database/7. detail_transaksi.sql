DROP TABLE IF EXISTS detail_transaksi;

CREATE TABLE detail_transaksi (
    id_detail_transaksi CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    kuantitas_transaksi INT NOT NULL,
    sisa_kuantitas INT NOT NULL,
    expired_date DATE,
    id_transaksi CHAR(36),
    id_barang CHAR(36),

    FOREIGN KEY (id_transaksi)
        REFERENCES transaksi(id_transaksi)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (id_barang)
        REFERENCES barang(id_barang)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

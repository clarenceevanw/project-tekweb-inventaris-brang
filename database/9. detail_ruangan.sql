DROP TABLE IF EXISTS detail_ruangan;

CREATE TABLE detail_ruangan (
    id_detail_ruangan CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    kuantitas_ruangan INT NOT NULL,
    id_ruangan CHAR(36),
    id_detail_transaksi CHAR(36),

    FOREIGN KEY (id_ruangan)
        REFERENCES ruangan(id_ruangan)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    FOREIGN KEY (id_detail_transaksi)
        REFERENCES detail_transaksi(id_detail_transaksi)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

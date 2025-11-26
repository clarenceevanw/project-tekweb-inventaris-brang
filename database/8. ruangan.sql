DROP TABLE IF EXISTS ruangan;

CREATE TABLE ruangan (
    id_ruangan CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nama_ruangan VARCHAR(100) NOT NULL,
    id_gudang CHAR(36),

    FOREIGN KEY (id_gudang)
        REFERENCES gudang(id_gudang)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

DROP TABLE IF EXISTS kategori;

CREATE TABLE kategori (
    id_kategori CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nama_kategori VARCHAR(100) NOT NULL,
    id_gudang CHAR(36),

    FOREIGN KEY (id_gudang)
        REFERENCES gudang(id_gudang)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

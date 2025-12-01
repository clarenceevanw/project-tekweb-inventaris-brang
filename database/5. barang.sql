DROP TABLE IF EXISTS barang;

CREATE TABLE barang (
    id_barang CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nama_barang VARCHAR(100) NOT NULL,
    foto_barang VARCHAR(255),
    id_kategori CHAR(36),

    FOREIGN KEY (id_kategori)
        REFERENCES kategori(id_kategori)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);

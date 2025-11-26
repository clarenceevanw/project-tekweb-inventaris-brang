DROP TABLE IF EXISTS admin;

CREATE TABLE admin (
    id_admin CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nama_admin VARCHAR(100) NOT NULL,
    username_admin VARCHAR(100) UNIQUE NOT NULL,
    password_admin VARCHAR(255) NOT NULL,
    id_gudang CHAR(36),

    FOREIGN KEY (id_gudang)
        REFERENCES gudang(id_gudang)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

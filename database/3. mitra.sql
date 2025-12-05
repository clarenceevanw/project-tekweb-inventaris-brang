DROP TABLE IF EXISTS mitra;

CREATE TABLE mitra (
    id_mitra CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    nama_mitra VARCHAR(100) NOT NULL,
    username_mitra VARCHAR(100) UNIQUE NOT NULL,
    password_mitra VARCHAR(255) NOT NULL,
    email_mitra VARCHAR(255) UNIQUE NOT NULL
);

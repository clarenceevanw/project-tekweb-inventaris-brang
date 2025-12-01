DROP TABLE IF EXISTS transaksi_subscription;

CREATE TABLE transaksi_subscription (
    id_subscription CHAR(36) PRIMARY KEY DEFAULT (UUID()),
    tanggal_bayar DATETIME DEFAULT CURRENT_TIMESTAMP,
    status_bayar ENUM('pending', 'lunas', 'gagal') DEFAULT 'pending',
    
    -- Foreign Keys
    id_gudang CHAR(36) NOT NULL,            -- Gudang mana yang bayar?
    id_paket CHAR(36) NOT NULL,             -- Beli paket apa?

    FOREIGN KEY (id_gudang) REFERENCES gudang(id_gudang) ON DELETE CASCADE,
    FOREIGN KEY (id_paket) REFERENCES paket_subscription(id_paket)
);
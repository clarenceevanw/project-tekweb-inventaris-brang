-- =============================================
-- DROP ALL TABLES IN CORRECT ORDER
-- =============================================

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS detail_ruangan;
DROP TABLE IF EXISTS detail_transaksi;
DROP TABLE IF EXISTS transaksi;
DROP TABLE IF EXISTS transaksi_subscription;
DROP TABLE IF EXISTS paket_subscription;
DROP TABLE IF EXISTS barang;
DROP TABLE IF EXISTS kategori;
DROP TABLE IF EXISTS ruangan;
DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS mitra;
DROP TABLE IF EXISTS gudang;

SET FOREIGN_KEY_CHECKS = 1;

-- =============================================
-- DELETE ALL DATA FROM TABLES
-- =============================================

SET FOREIGN_KEY_CHECKS = 0;

DELETE FROM detail_ruangan;
DELETE FROM detail_transaksi;
DELETE FROM transaksi;
DELETE FROM barang;
DELETE FROM kategori;
DELETE FROM ruangan;
DELETE FROM admin;
DELETE FROM mitra;
DELETE FROM gudang;

SET FOREIGN_KEY_CHECKS = 1;

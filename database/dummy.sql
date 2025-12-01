-- =============================================
-- 1. RESET DATABASE
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

-- =============================================
-- 2. SETUP VARIABLE & MASTER DATA
-- =============================================
SET @pass_default = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

-- ID GUDANG & ADMIN
SET @id_gudang_sby = UUID();
SET @id_gudang_sda = UUID();
SET @id_admin_sby = UUID();
SET @id_admin_sda = UUID();

-- ID MITRA
SET @id_mitra_supply = UUID();
SET @id_mitra_buy = UUID();

-- INSERT MASTER
INSERT INTO gudang VALUES 
(@id_gudang_sby, 'Gudang Pusat Surabaya', 'Jl. Raya Darmo No. 12, Surabaya'),
(@id_gudang_sda, 'Gudang Cabang Sidoarjo', 'Jl. Wahid Hasyim No. 88, Sidoarjo');

INSERT INTO admin VALUES 
(@id_admin_sby, 'Budi Santoso', 'admin1', @pass_default, @id_gudang_sby),
(@id_admin_sda, 'Sutrisno Wijaya', 'admin2', @pass_default, @id_gudang_sda);

INSERT INTO mitra VALUES 
(@id_mitra_supply, 'PT. Indofood Sukses Makmur', 'indofood', @pass_default),
(@id_mitra_buy, 'Toko Kelontong Madura', 'madura_jaya', @pass_default);

-- =============================================
-- 3. STRUKTUR GUDANG 1 (SURABAYA)
-- =============================================
SET @id_ruang_a = UUID(); -- Rak A (Makanan)
SET @id_ruang_b = UUID(); -- Rak B (Minuman/Overload Makanan)

INSERT INTO ruangan VALUES 
(@id_ruang_a, 'Rak A - Utama', @id_gudang_sby),
(@id_ruang_b, 'Rak B - Cadangan', @id_gudang_sby);

SET @id_cat_makanan_sby = UUID();
INSERT INTO kategori VALUES (@id_cat_makanan_sby, 'Makanan Instan', @id_gudang_sby);

SET @id_barang_indomie_sby = UUID();
INSERT INTO barang VALUES (@id_barang_indomie_sby, 'Indomie Goreng Original', @id_cat_makanan_sby);

-- =============================================
-- 4. STRUKTUR GUDANG 2 (SIDOARJO)
-- =============================================
SET @id_ruang_c = UUID();
SET @id_ruang_d = UUID();

INSERT INTO ruangan VALUES 
(@id_ruang_c, 'Rak C - Depan', @id_gudang_sda),
(@id_ruang_d, 'Rak D - Belakang', @id_gudang_sda);

SET @id_cat_snack_sda = UUID();
INSERT INTO kategori VALUES (@id_cat_snack_sda, 'Snack Ringan', @id_gudang_sda);

SET @id_barang_chitato_sda = UUID();
INSERT INTO barang VALUES (@id_barang_chitato_sda, 'Chitato BBQ', @id_cat_snack_sda);

-- =============================================
-- 5. SKENARIO KOMPLEKS: MULTI-BATCH INDOMIE (GUDANG 1)
-- =============================================

-- TRANSAKSI 1: SUPPLY INDOMIE (BATCH LAMA - MARET 2026)
SET @trx_sby_1 = UUID();
INSERT INTO transaksi VALUES (@trx_sby_1, 'supply', DATE_SUB(NOW(), INTERVAL 1 MONTH), @id_mitra_supply, @id_admin_sby);

SET @batch_indomie_maret = UUID();
-- Masuk 500 pcs, Expired Maret 2026
INSERT INTO detail_transaksi VALUES 
(@batch_indomie_maret, 500, 500, '2026-03-30', @trx_sby_1, @id_barang_indomie_sby);

-- Penempatan: Semua masuk Rak A
INSERT INTO detail_ruangan VALUES (UUID(), 500, @id_ruang_a, @batch_indomie_maret);


-- TRANSAKSI 2: SUPPLY INDOMIE (BATCH BARU - DESEMBER 2026) -> KASUS PECAH RUANGAN
SET @trx_sby_2 = UUID();
INSERT INTO transaksi VALUES (@trx_sby_2, 'supply', NOW(), @id_mitra_supply, @id_admin_sby);

SET @batch_indomie_desember = UUID();
-- Masuk 1000 pcs, Expired Desember 2026
INSERT INTO detail_transaksi VALUES 
(@batch_indomie_desember, 1000, 1000, '2026-12-31', @trx_sby_2, @id_barang_indomie_sby);

-- Penempatan (SPLIT ROOM):
-- Rak A cuma muat tambah 600 lagi, sisanya 400 ditaruh di Rak B
INSERT INTO detail_ruangan VALUES (UUID(), 600, @id_ruang_a, @batch_indomie_desember); -- 600 pcs Batch Des di Rak A
INSERT INTO detail_ruangan VALUES (UUID(), 400, @id_ruang_b, @batch_indomie_desember); -- 400 pcs Batch Des di Rak B

-- Hasilnya: Di Rak A ada tumpukan Batch Maret & Batch Desember. Di Rak B ada sisa Batch Desember.

-- =============================================
-- 6. SKENARIO KOMPLEKS: CHITATO (GUDANG 2)
-- =============================================

SET @trx_sda_1 = UUID();
INSERT INTO transaksi VALUES (@trx_sda_1, 'supply', NOW(), @id_mitra_supply, @id_admin_sda);

-- Batch 1: Expired Pendek (Diskon/Promo)
SET @batch_chitato_promo = UUID();
INSERT INTO detail_transaksi VALUES (@batch_chitato_promo, 200, 200, DATE_ADD(NOW(), INTERVAL 2 MONTH), @trx_sda_1, @id_barang_chitato_sda);
-- Taruh Rak Depan (C) biar cepat laku
INSERT INTO detail_ruangan VALUES (UUID(), 200, @id_ruang_c, @batch_chitato_promo);

-- Batch 2: Expired Panjang (Reguler)
SET @batch_chitato_reguler = UUID();
INSERT INTO detail_transaksi VALUES (@batch_chitato_reguler, 800, 800, DATE_ADD(NOW(), INTERVAL 1 YEAR), @trx_sda_1, @id_barang_chitato_sda);
-- Taruh Rak Belakang (D) untuk stok
INSERT INTO detail_ruangan VALUES (UUID(), 800, @id_ruang_d, @batch_chitato_reguler);

-- =============================================
-- 7. TRANSAKSI BUY (PENGURANGAN STOK)
-- =============================================

-- Orang beli Indomie dari Gudang 1
-- Otomatis mengurangi stok secara logika aplikasi, 
-- disini kita catat transaksinya saja.
INSERT INTO transaksi VALUES (UUID(), 'buy', NOW(), @id_mitra_buy, @id_admin_sby);

-- =========================================================
-- 8. TAMBAHAN ITEM BARU: GUDANG 1 (KEBERSIHAN)
-- =========================================================

-- Kategori Baru Gudang 1
SET @id_cat_bersih_sby = UUID();
INSERT INTO kategori VALUES (@id_cat_bersih_sby, 'Perlengkapan Kebersihan', @id_gudang_sby);

-- Barang Baru Gudang 1
SET @id_barang_rinso = UUID();
SET @id_barang_sunlight = UUID();

INSERT INTO barang VALUES 
(@id_barang_rinso, 'Rinso Anti Noda 800g', @id_cat_bersih_sby),
(@id_barang_sunlight, 'Sunlight Jeruk Nipis 750ml', @id_cat_bersih_sby);

-- Transaksi Supply Barang Kebersihan (Admin SBY)
SET @trx_bersih_sby = UUID();
INSERT INTO transaksi VALUES (@trx_bersih_sby, 'supply', NOW(), @id_mitra_supply, @id_admin_sby);

-- Batch Rinso (Exp Lama)
SET @batch_rinso = UUID();
INSERT INTO detail_transaksi VALUES (@batch_rinso, 200, 200, DATE_ADD(CURDATE(), INTERVAL 2 YEAR), @trx_bersih_sby, @id_barang_rinso);

-- Batch Sunlight (Exp Cepat)
SET @batch_sunlight = UUID();
INSERT INTO detail_transaksi VALUES (@batch_sunlight, 150, 150, DATE_ADD(CURDATE(), INTERVAL 1 YEAR), @trx_bersih_sby, @id_barang_sunlight);

-- Masukkan ke Rak B (Gudang 1) - Karena Rak A isinya Makanan
INSERT INTO detail_ruangan VALUES (UUID(), 200, @id_ruang_b, @batch_rinso);
INSERT INTO detail_ruangan VALUES (UUID(), 150, @id_ruang_b, @batch_sunlight);


-- =========================================================
-- 9. TAMBAHAN ITEM BARU: GUDANG 2 (SEMBAKO BERAT)
-- =========================================================

-- Kategori Baru Gudang 2
SET @id_cat_beras_sda = UUID();
INSERT INTO kategori VALUES (@id_cat_beras_sda, 'Beras & Tepung', @id_gudang_sda);

-- Barang Baru Gudang 2
SET @id_barang_beras = UUID();
SET @id_barang_tepung = UUID();

INSERT INTO barang VALUES 
(@id_barang_beras, 'Beras Raja Lele 5kg', @id_cat_beras_sda),
(@id_barang_tepung, 'Tepung Segitiga Biru 1kg', @id_cat_beras_sda);

-- Transaksi Supply Sembako (Admin SDA)
SET @trx_sembako_sda = UUID();
INSERT INTO transaksi VALUES (@trx_sembako_sda, 'supply', NOW(), @id_mitra_supply, @id_admin_sda);

-- Batch Beras (Jumlah banyak)
SET @batch_beras = UUID();
INSERT INTO detail_transaksi VALUES (@batch_beras, 50, 50, DATE_ADD(CURDATE(), INTERVAL 6 MONTH), @trx_sembako_sda, @id_barang_beras);

-- Batch Tepung
SET @batch_tepung = UUID();
INSERT INTO detail_transaksi VALUES (@batch_tepung, 100, 100, DATE_ADD(CURDATE(), INTERVAL 8 MONTH), @trx_sembako_sda, @id_barang_tepung);

-- Masukkan ke Rak D (Gudang 2) - Rak Belakang/Gudang Besar
INSERT INTO detail_ruangan VALUES (UUID(), 50, @id_ruang_d, @batch_beras);
INSERT INTO detail_ruangan VALUES (UUID(), 100, @id_ruang_d, @batch_tepung);

-- =========================================================
-- 10. SIMULASI BARANG 'DEAD STOCK' (GUDANG 1)
-- Barang sudah lama masuk, expired dekat, belum laku (Rak B)
-- =========================================================

SET @trx_dead_stock = UUID();
-- Transaksi 1 Tahun lalu
INSERT INTO transaksi VALUES (@trx_dead_stock, 'supply', DATE_SUB(NOW(), INTERVAL 1 YEAR), @id_mitra_supply, @id_admin_sby);

SET @barang_susu_kotak = UUID();
INSERT INTO barang VALUES (@barang_susu_kotak, 'Susu Ultra Coklat 250ml', @id_cat_minuman_sby); -- Pakai Kategori Minuman yg sudah ada

SET @batch_susu_mau_exp = UUID();
-- Expired tinggal 1 minggu lagi!
INSERT INTO detail_transaksi VALUES 
(@batch_susu_mau_exp, 48, 48, DATE_ADD(NOW(), INTERVAL 1 WEEK), @trx_dead_stock, @barang_susu_kotak);

-- Taruh di Rak B
INSERT INTO detail_ruangan VALUES (UUID(), 48, @id_ruang_b, @batch_susu_mau_exp);
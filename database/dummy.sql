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

-- =============================================
-- SET VARIABLE UUID
-- =============================================
SET @id_gudang = UUID();

SET @id_admin = UUID();
SET @id_mitra_supply = UUID();
SET @id_mitra_buy = UUID();

SET @id_cat_makanan = UUID();
SET @id_cat_minuman = UUID();

SET @id_barang_indomie = UUID();
SET @id_barang_kopi = UUID();

SET @id_ruang_a = UUID();
SET @id_ruang_b = UUID();

SET @id_transaksi_masuk = UUID();

SET @id_detail_batch_1 = UUID(); 
SET @id_detail_batch_2 = UUID();

SET @pass_default = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

-- =============================================
-- 2. INSERT DATA MASTER (Gudang, Admin, Mitra)
-- =============================================

INSERT INTO gudang (id_gudang, nama_gudang, lokasi_gudang) 
VALUES (@id_gudang, 'Gudang Pusat Surabaya', 'Jl. Raya Darmo No. 12, Surabaya');

INSERT INTO admin (id_admin, nama_admin, username_admin, password_admin, id_gudang) 
VALUES (@id_admin, 'Budi Santoso', 'admin1', @pass_default, @id_gudang);

INSERT INTO mitra (id_mitra, nama_mitra, username_mitra, password_mitra) 
VALUES 
(@id_mitra_supply, 'PT. Indofood Sukses Makmur', 'indofood', @pass_default),
(@id_mitra_buy, 'Toko Kelontong Madura', 'madura_jaya', @pass_default);

-- =============================================
-- 3. INSERT STRUKTUR GUDANG
-- =============================================

INSERT INTO ruangan (id_ruangan, nama_ruangan, id_gudang) 
VALUES 
(@id_ruang_a, 'Rak A - Makanan Kering', @id_gudang),
(@id_ruang_b, 'Rak B - Minuman & Cairan', @id_gudang);

INSERT INTO kategori (id_kategori, nama_kategori, id_gudang) 
VALUES 
(@id_cat_makanan, 'Makanan Instan', @id_gudang),
(@id_cat_minuman, 'Minuman Sachet', @id_gudang);

INSERT INTO barang (id_barang, nama_barang, id_kategori) 
VALUES 
(@id_barang_indomie, 'Indomie Goreng Original', @id_cat_makanan),
(@id_barang_kopi, 'Kopi Kapal Api Mix', @id_cat_minuman);

-- =============================================
-- 4. TRANSAKSI & BATCH AWAL
-- =============================================

INSERT INTO transaksi (id_transaksi, jenis_transaksi, tanggal_transaksi, id_mitra, id_admin) 
VALUES (@id_transaksi_masuk, 'supply', NOW(), @id_mitra_supply, @id_admin);

INSERT INTO detail_transaksi (id_detail_transaksi, kuantitas_transaksi, sisa_kuantitas, expired_date, id_transaksi, id_barang) 
VALUES 
(@id_detail_batch_1, 100, 100, DATE_ADD(CURDATE(), INTERVAL 1 YEAR), @id_transaksi_masuk, @id_barang_indomie),
(@id_detail_batch_2, 50, 50, DATE_ADD(CURDATE(), INTERVAL 6 MONTH), @id_transaksi_masuk, @id_barang_kopi);

-- =============================================
-- 5. DETAIL RUANGAN AWAL
-- =============================================

INSERT INTO detail_ruangan VALUES (UUID(), 100, @id_ruang_a, @id_detail_batch_1);
INSERT INTO detail_ruangan VALUES (UUID(), 50, @id_ruang_b, @id_detail_batch_2);

-- =====================================================
-- 6. TAMBAHAN DUMMY DATA: GUDANG BARU + ADMIN BARU
-- =====================================================

SET @id_gudang2 = UUID();
INSERT INTO gudang VALUES (@id_gudang2, 'Gudang Cabang Sidoarjo', 'Jl. Wahid Hasyim No. 88, Sidoarjo');

SET @id_admin2 = UUID();
INSERT INTO admin VALUES (@id_admin2, 'Sutrisno Wijaya', 'admin2', @pass_default, @id_gudang2);

-- Ruangan baru
SET @id_ruang_c = UUID();
SET @id_ruang_d = UUID();

INSERT INTO ruangan VALUES
(@id_ruang_c, 'Rak C - Snack Kering', @id_gudang2),
(@id_ruang_d, 'Rak D - Makanan Kaleng', @id_gudang2);

-- =====================================================
-- 7. KATEGORI TAMBAHAN
-- =====================================================

SET @id_cat_snack = UUID();
SET @id_cat_kaleng = UUID();

INSERT INTO kategori VALUES
(@id_cat_snack, 'Snack Ringan', @id_gudang2),
(@id_cat_kaleng, 'Makanan Kaleng', @id_gudang2);

-- =====================================================
-- 8. BARANG BARU
-- =====================================================

SET @id_barang_chitato = UUID();
SET @id_barang_sarden = UUID();

INSERT INTO barang VALUES
(@id_barang_chitato, 'Chitato BBQ 68g', @id_cat_snack),
(@id_barang_sarden, 'Sarden ABC Kaleng', @id_cat_kaleng);

-- =====================================================
-- 9. TRANSAKSI BARU
-- =====================================================

SET @id_transaksi_masuk2 = UUID();

INSERT INTO transaksi 
VALUES (@id_transaksi_masuk2, 'supply', NOW(), @id_mitra_supply, @id_admin2);

-- =====================================================
-- 10. DETAIL TRANSAKSI BARU (Batch)
-- =====================================================

SET @id_detail_batch_3 = UUID();
SET @id_detail_batch_4 = UUID();
SET @id_detail_batch_5 = UUID();

INSERT INTO detail_transaksi VALUES
(@id_detail_batch_3, 200, 200, DATE_ADD(CURDATE(), INTERVAL 10 MONTH), @id_transaksi_masuk2, @id_barang_indomie),
(@id_detail_batch_4, 80, 80, DATE_ADD(CURDATE(), INTERVAL 9 MONTH), @id_transaksi_masuk2, @id_barang_chitato),
(@id_detail_batch_5, 120, 120, DATE_ADD(CURDATE(), INTERVAL 18 MONTH), @id_transaksi_masuk2, @id_barang_sarden);

-- =====================================================
-- 11. DETAIL RUANGAN BARU
-- =====================================================

-- Indomie batch baru → Gudang 2 Rak C
INSERT INTO detail_ruangan VALUES (UUID(), 200, @id_ruang_c, @id_detail_batch_3);

-- Chitato → dibagi Rak C & Rak A
INSERT INTO detail_ruangan VALUES (UUID(), 40, @id_ruang_c, @id_detail_batch_4);
INSERT INTO detail_ruangan VALUES (UUID(), 40, @id_ruang_a, @id_detail_batch_4);

-- Sarden → Rak D
INSERT INTO detail_ruangan VALUES (UUID(), 120, @id_ruang_d, @id_detail_batch_5);

-- =====================================================
-- 12. TAMBAHAN PENEMPATAN BATCH LAMA
-- =====================================================

-- Pindah sebagian kopi ke gudang 2 (Rak C)
INSERT INTO detail_ruangan VALUES (UUID(), 10, @id_ruang_c, @id_detail_batch_2);
-- =====================================================
-- 13. TAMBAHAN ITEM BARU (UNTUK VARIASI TOP 5)
-- =====================================================
SET @id_cat_sembako = UUID();
INSERT INTO kategori VALUES (@id_cat_sembako, 'Sembako', @id_gudang);

SET @id_barang_minyak = UUID();
SET @id_barang_gula = UUID();
SET @id_barang_teh = UUID();

INSERT INTO barang VALUES
(@id_barang_minyak, 'Minyak Goreng Bimoli 2L', @id_cat_sembako),
(@id_barang_gula, 'Gula Pasir Gulaku 1kg', @id_cat_sembako),
(@id_barang_teh, 'Teh Botol Sosro Kotak', @id_cat_minuman);

-- =====================================================
-- 14. TRANSAKSI HISTORIS (SUPPLY - BULAN LALU)
-- Agar grafik Line Chart ada isinya di bulan-bulan sebelumnya
-- =====================================================

-- Transaksi 3 Bulan yang lalu (Supply Minyak & Gula)
SET @id_trx_history_1 = UUID();
INSERT INTO transaksi VALUES (@id_trx_history_1, 'supply', DATE_SUB(NOW(), INTERVAL 3 MONTH), @id_mitra_supply, @id_admin);

SET @id_batch_minyak = UUID();
SET @id_batch_gula = UUID();

INSERT INTO detail_transaksi VALUES
(@id_batch_minyak, 300, 250, DATE_ADD(CURDATE(), INTERVAL 12 MONTH), @id_trx_history_1, @id_barang_minyak),
(@id_batch_gula, 400, 350, DATE_ADD(CURDATE(), INTERVAL 24 MONTH), @id_trx_history_1, @id_barang_gula);

-- Masukkan ke Rak (Gudang 1)
INSERT INTO detail_ruangan VALUES (UUID(), 250, @id_ruang_a, @id_batch_minyak);
INSERT INTO detail_ruangan VALUES (UUID(), 350, @id_ruang_a, @id_batch_gula);


-- Transaksi 2 Bulan yang lalu (Supply Teh Botol)
SET @id_trx_history_2 = UUID();
INSERT INTO transaksi VALUES (@id_trx_history_2, 'supply', DATE_SUB(NOW(), INTERVAL 2 MONTH), @id_mitra_supply, @id_admin2);

SET @id_batch_teh = UUID();
INSERT INTO detail_transaksi VALUES
(@id_batch_teh, 500, 400, DATE_ADD(CURDATE(), INTERVAL 8 MONTH), @id_trx_history_2, @id_barang_teh);

-- Masukkan ke Rak (Gudang 2)
INSERT INTO detail_ruangan VALUES (UUID(), 400, @id_ruang_c, @id_batch_teh);

-- =====================================================
-- 15. TRANSAKSI 'BUY' (BARANG KELUAR)
-- Agar widget 'Transaksi Buy' terisi
-- =====================================================

-- Mitra Baru (Pembeli)
SET @id_mitra_warung = UUID();
INSERT INTO mitra VALUES (@id_mitra_warung, 'Warung Bu Ijah', 'warung_ijah', @pass_default);

-- Transaksi Keluar 1 (Bulan Lalu) - Beli Indomie & Kopi
SET @id_trx_buy_1 = UUID();
INSERT INTO transaksi VALUES (@id_trx_buy_1, 'buy', DATE_SUB(NOW(), INTERVAL 1 MONTH), @id_mitra_warung, @id_admin);

-- Note: Logic sisa_kuantitas di tabel detail_transaksi untuk 'buy' biasanya 0 
-- atau tidak relevan (tergantung logic PHP kamu), yang penting tercatat transaksinya.
-- Di sini kita anggap detail_transaksi mencatat histori perpindahan barang.
INSERT INTO detail_transaksi (id_detail_transaksi, kuantitas_transaksi, sisa_kuantitas, expired_date, id_transaksi, id_barang) VALUES
(UUID(), 50, 0, NULL, @id_trx_buy_1, @id_barang_indomie),
(UUID(), 20, 0, NULL, @id_trx_buy_1, @id_barang_kopi);


-- Transaksi Keluar 2 (Hari Ini) - Beli Minyak & Teh
SET @id_trx_buy_2 = UUID();
INSERT INTO transaksi VALUES (@id_trx_buy_2, 'buy', NOW(), @id_mitra_buy, @id_admin2);

INSERT INTO detail_transaksi (id_detail_transaksi, kuantitas_transaksi, sisa_kuantitas, expired_date, id_transaksi, id_barang) VALUES
(UUID(), 50, 0, NULL, @id_trx_buy_2, @id_barang_minyak),
(UUID(), 100, 0, NULL, @id_trx_buy_2, @id_barang_teh);

-- =====================================================
-- 16. TRANSAKSI 'SUPPLY' BARU (HARI INI)
-- Untuk lonjakan data di bulan ini
-- =====================================================

SET @id_trx_supply_now = UUID();
INSERT INTO transaksi VALUES (@id_trx_supply_now, 'supply', NOW(), @id_mitra_supply, @id_admin);

SET @id_batch_indomie_new = UUID();

INSERT INTO detail_transaksi VALUES
(@id_batch_indomie_new, 1000, 1000, DATE_ADD(CURDATE(), INTERVAL 12 MONTH), @id_trx_supply_now, @id_barang_indomie);

-- Masukkan Indomie stok baru ke Gudang 1
INSERT INTO detail_ruangan VALUES (UUID(), 1000, @id_ruang_a, @id_batch_indomie_new);
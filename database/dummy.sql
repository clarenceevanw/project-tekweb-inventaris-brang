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

SET @id_detail_batch_1 = UUID(); -- Batch Indomie
SET @id_detail_batch_2 = UUID(); -- Batch Kopi

SET @pass_default = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; -- Hash dari 'password' (default Laravel/PHP)

-- =============================================
-- 2. INSERT DATA MASTER (Gudang, Admin, Mitra)
-- =============================================

-- Buat Gudang
INSERT INTO gudang (id_gudang, nama_gudang, lokasi_gudang) 
VALUES (@id_gudang, 'Gudang Pusat Surabaya', 'Jl. Raya Darmo No. 12, Surabaya');

-- Buat Admin (Username: admin1, Pass: password)
INSERT INTO admin (id_admin, nama_admin, username_admin, password_admin, id_gudang) 
VALUES (@id_admin, 'Budi Santoso', 'admin1', @pass_default, @id_gudang);

-- Buat Mitra (1 Supplier, 1 Buyer)
INSERT INTO mitra (id_mitra, nama_mitra, username_mitra, password_mitra) 
VALUES 
(@id_mitra_supply, 'PT. Indofood Sukses Makmur', 'indofood', @pass_default),
(@id_mitra_buy, 'Toko Kelontong Madura', 'madura_jaya', @pass_default);

-- =============================================
-- 3. INSERT STRUKTUR GUDANG (Ruangan, Kategori, Barang)
-- =============================================

-- Buat Ruangan
INSERT INTO ruangan (id_ruangan, nama_ruangan, id_gudang) 
VALUES 
(@id_ruang_a, 'Rak A - Makanan Kering', @id_gudang),
(@id_ruang_b, 'Rak B - Minuman & Cairan', @id_gudang);

-- Buat Kategori
INSERT INTO kategori (id_kategori, nama_kategori, id_gudang) 
VALUES 
(@id_cat_makanan, 'Makanan Instan', @id_gudang),
(@id_cat_minuman, 'Minuman Sachet', @id_gudang);

-- Buat Barang
INSERT INTO barang (id_barang, nama_barang, id_kategori) 
VALUES 
(@id_barang_indomie, 'Indomie Goreng Original', @id_cat_makanan),
(@id_barang_kopi, 'Kopi Kapal Api Mix', @id_cat_minuman);

-- =============================================
-- 4. INSERT TRANSAKSI & STOK (Batch Tracking)
-- =============================================

-- 4a. Header Transaksi (Supply Masuk)
INSERT INTO transaksi (id_transaksi, jenis_transaksi, tanggal_transaksi, id_mitra, id_admin) 
VALUES (@id_transaksi_masuk, 'supply', NOW(), @id_mitra_supply, @id_admin);

-- 4b. Detail Transaksi (Ini adalah BATCH yang akan di-scan QR-nya)
INSERT INTO detail_transaksi (id_detail_transaksi, kuantitas_transaksi, sisa_kuantitas, expired_date, id_transaksi, id_barang) 
VALUES 
-- Batch 1: Indomie (Masuk 100, Sisa 100) - Expired 1 tahun lagi
(@id_detail_batch_1, 100, 100, DATE_ADD(CURDATE(), INTERVAL 1 YEAR), @id_transaksi_masuk, @id_barang_indomie),

-- Batch 2: Kopi (Masuk 50, Sisa 50) - Expired 6 bulan lagi
(@id_detail_batch_2, 50, 50, DATE_ADD(CURDATE(), INTERVAL 6 MONTH), @id_transaksi_masuk, @id_barang_kopi);

-- =============================================
-- 5. INSERT DETAIL RUANGAN (Penempatan Fisik)
-- =============================================

-- Taruh Batch Indomie di Rak A
INSERT INTO detail_ruangan (id_detail_ruangan, kuantitas_ruangan, id_ruangan, id_detail_transaksi) 
VALUES (UUID(), 100, @id_ruang_a, @id_detail_batch_1);

-- Taruh Batch Kopi di Rak B
INSERT INTO detail_ruangan (id_detail_ruangan, kuantitas_ruangan, id_ruangan, id_detail_transaksi) 
VALUES (UUID(), 50, @id_ruang_b, @id_detail_batch_2);
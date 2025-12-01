SET FOREIGN_KEY_CHECKS = 0;
DELETE FROM transaksi_subscription;
DELETE FROM detail_ruangan;
DELETE FROM detail_transaksi;
DELETE FROM transaksi;
DELETE FROM barang;
DELETE FROM kategori;
DELETE FROM ruangan;
DELETE FROM admin;
DELETE FROM mitra;
DELETE FROM gudang;
DELETE FROM paket_subscription;
SET FOREIGN_KEY_CHECKS = 1;

SET @pass = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';

-- GUDANG SURABAYA
SET @g_sby = UUID();
INSERT INTO gudang VALUES (@g_sby, 'Gudang Pusat Surabaya', 'Jl. Raya Darmo No. 12, Surabaya', 'active', NULL);
SET @adm_sby = UUID();
INSERT INTO admin VALUES (@adm_sby, 'Budi Santoso', 'admin1', @pass, @g_sby);

SET @r_sby_a = UUID();
SET @r_sby_b = UUID();
SET @r_sby_c = UUID();
SET @r_sby_d = UUID();
INSERT INTO ruangan VALUES 
(@r_sby_a, 'Rak A - Mie Instan', @g_sby),
(@r_sby_b, 'Rak B - Mie Overflow', @g_sby),
(@r_sby_c, 'Rak C - Minuman Dingin', @g_sby),
(@r_sby_d, 'Rak D - Minuman Hangat', @g_sby);

SET @k_sby_mie = UUID();
SET @k_sby_minum = UUID();
SET @k_sby_susu = UUID();
INSERT INTO kategori VALUES 
(@k_sby_mie, 'Mie Instan', @g_sby),
(@k_sby_minum, 'Minuman Kemasan', @g_sby),
(@k_sby_susu, 'Susu & Dairy', @g_sby);

SET @b_sby_1 = UUID();
SET @b_sby_2 = UUID();
SET @b_sby_3 = UUID();
SET @b_sby_4 = UUID();
SET @b_sby_5 = UUID();
SET @b_sby_6 = UUID();
SET @b_sby_7 = UUID();
SET @b_sby_8 = UUID();
INSERT INTO barang VALUES 
(@b_sby_1, 'Indomie Goreng', NULL, @k_sby_mie),
(@b_sby_2, 'Indomie Soto', NULL, @k_sby_mie),
(@b_sby_3, 'Mie Sedap Kari', NULL, @k_sby_mie),
(@b_sby_4, 'Sarimi Ayam', NULL, @k_sby_mie),
(@b_sby_5, 'Aqua 600ml', NULL, @k_sby_minum),
(@b_sby_6, 'Teh Botol', NULL, @k_sby_minum),
(@b_sby_7, 'Coca Cola', NULL, @k_sby_minum),
(@b_sby_8, 'Susu Ultra Coklat', NULL, @k_sby_susu);

-- GUDANG SIDOARJO
SET @g_sda = UUID();
INSERT INTO gudang VALUES (@g_sda, 'Gudang Cabang Sidoarjo', 'Jl. Wahid Hasyim No. 88, Sidoarjo', 'active', NULL);
SET @adm_sda = UUID();
INSERT INTO admin VALUES (@adm_sda, 'Sutrisno Wijaya', 'admin2', @pass, @g_sda);

SET @r_sda_e = UUID();
SET @r_sda_f = UUID();
SET @r_sda_g = UUID();
SET @r_sda_h = UUID();
INSERT INTO ruangan VALUES 
(@r_sda_e, 'Rak E - Snack Ringan', @g_sda),
(@r_sda_f, 'Rak F - Snack Berat', @g_sda),
(@r_sda_g, 'Rak G - Sembako Utama', @g_sda),
(@r_sda_h, 'Rak H - Sembako Cadangan', @g_sda);

SET @k_sda_snack = UUID();
SET @k_sda_sembako = UUID();
SET @k_sda_bumbu = UUID();
INSERT INTO kategori VALUES 
(@k_sda_snack, 'Snack & Keripik', @g_sda),
(@k_sda_sembako, 'Beras & Tepung', @g_sda),
(@k_sda_bumbu, 'Bumbu Dapur', @g_sda);

SET @b_sda_1 = UUID();
SET @b_sda_2 = UUID();
SET @b_sda_3 = UUID();
SET @b_sda_4 = UUID();
SET @b_sda_5 = UUID();
SET @b_sda_6 = UUID();
SET @b_sda_7 = UUID();
SET @b_sda_8 = UUID();
INSERT INTO barang VALUES 
(@b_sda_1, 'Chitato BBQ', NULL, @k_sda_snack),
(@b_sda_2, 'Qtela Balado', NULL, @k_sda_snack),
(@b_sda_3, 'Taro Net', NULL, @k_sda_snack),
(@b_sda_4, 'Beras Raja Lele 5kg', NULL, @k_sda_sembako),
(@b_sda_5, 'Tepung Segitiga Biru', NULL, @k_sda_sembako),
(@b_sda_6, 'Gula Gulaku', NULL, @k_sda_sembako),
(@b_sda_7, 'Royco Ayam', NULL, @k_sda_bumbu),
(@b_sda_8, 'Kecap Bango', NULL, @k_sda_bumbu);

-- GUDANG MALANG
SET @g_mlg = UUID();
INSERT INTO gudang VALUES (@g_mlg, 'Gudang Cabang Malang', 'Jl. Soekarno Hatta No. 45, Malang', 'trial', DATE_ADD(NOW(), INTERVAL 7 DAY));
SET @adm_mlg = UUID();
INSERT INTO admin VALUES (@adm_mlg, 'Dewi Lestari', 'admin3', @pass, @g_mlg);

SET @r_mlg_i = UUID();
SET @r_mlg_j = UUID();
SET @r_mlg_k = UUID();
INSERT INTO ruangan VALUES 
(@r_mlg_i, 'Rak I - Elektronik', @g_mlg),
(@r_mlg_j, 'Rak J - Kebersihan', @g_mlg),
(@r_mlg_k, 'Rak K - Alat Tulis', @g_mlg);

SET @k_mlg_elektronik = UUID();
SET @k_mlg_bersih = UUID();
SET @k_mlg_tulis = UUID();
INSERT INTO kategori VALUES 
(@k_mlg_elektronik, 'Elektronik Rumah', @g_mlg),
(@k_mlg_bersih, 'Perlengkapan Kebersihan', @g_mlg),
(@k_mlg_tulis, 'Alat Tulis Kantor', @g_mlg);

SET @b_mlg_1 = UUID();
SET @b_mlg_2 = UUID();
SET @b_mlg_3 = UUID();
SET @b_mlg_4 = UUID();
SET @b_mlg_5 = UUID();
SET @b_mlg_6 = UUID();
SET @b_mlg_7 = UUID();
INSERT INTO barang VALUES 
(@b_mlg_1, 'Lampu LED 12W', NULL, @k_mlg_elektronik),
(@b_mlg_2, 'Kabel NYM 10m', NULL, @k_mlg_elektronik),
(@b_mlg_3, 'Stop Kontak', NULL, @k_mlg_elektronik),
(@b_mlg_4, 'Rinso 800g', NULL, @k_mlg_bersih),
(@b_mlg_5, 'Sunlight 750ml', NULL, @k_mlg_bersih),
(@b_mlg_6, 'Pulpen Snowman', NULL, @k_mlg_tulis),
(@b_mlg_7, 'Buku Tulis Sidu', NULL, @k_mlg_tulis);

-- MITRA
SET @m_supply = UUID();
SET @m_buy = UUID();
INSERT INTO mitra VALUES 
(@m_supply, 'PT. Indofood Sukses Makmur', 'indofood', @pass),
(@m_buy, 'Toko Kelontong Madura', 'madura_jaya', @pass);

-- TRANSAKSI SURABAYA
SET @t1 = UUID();
INSERT INTO transaksi VALUES (@t1, 'supply', DATE_SUB(NOW(), INTERVAL 3 MONTH), 2500000, @m_supply, @adm_sby);
SET @dt1 = UUID();
INSERT INTO detail_transaksi VALUES (@dt1, 1000, 1000, DATE_ADD(CURDATE(), INTERVAL 5 MONTH), 2500000, @t1, @b_sby_1);
INSERT INTO detail_ruangan VALUES (UUID(), 600, @r_sby_a, @dt1);
INSERT INTO detail_ruangan VALUES (UUID(), 400, @r_sby_b, @dt1);

SET @t2 = UUID();
INSERT INTO transaksi VALUES (@t2, 'supply', DATE_SUB(NOW(), INTERVAL 1 MONTH), 3750000, @m_supply, @adm_sby);
SET @dt2 = UUID();
INSERT INTO detail_transaksi VALUES (@dt2, 1500, 1500, DATE_ADD(CURDATE(), INTERVAL 9 MONTH), 3750000, @t2, @b_sby_1);
INSERT INTO detail_ruangan VALUES (UUID(), 800, @r_sby_a, @dt2);
INSERT INTO detail_ruangan VALUES (UUID(), 700, @r_sby_b, @dt2);

SET @t3 = UUID();
INSERT INTO transaksi VALUES (@t3, 'supply', NOW(), 3120000, @m_supply, @adm_sby);
SET @dt3 = UUID();
SET @dt4 = UUID();
INSERT INTO detail_transaksi VALUES (@dt3, 800, 800, DATE_ADD(CURDATE(), INTERVAL 7 MONTH), 1920000, @t3, @b_sby_2);
INSERT INTO detail_transaksi VALUES (@dt4, 600, 600, DATE_ADD(CURDATE(), INTERVAL 6 MONTH), 1200000, @t3, @b_sby_3);
INSERT INTO detail_ruangan VALUES (UUID(), 500, @r_sby_a, @dt3);
INSERT INTO detail_ruangan VALUES (UUID(), 300, @r_sby_b, @dt3);
INSERT INTO detail_ruangan VALUES (UUID(), 600, @r_sby_a, @dt4);

SET @t4 = UUID();
INSERT INTO transaksi VALUES (@t4, 'supply', DATE_SUB(NOW(), INTERVAL 2 WEEK), 1900000, @m_supply, @adm_sby);
SET @dt5 = UUID();
SET @dt6 = UUID();
INSERT INTO detail_transaksi VALUES (@dt5, 400, 400, DATE_ADD(CURDATE(), INTERVAL 8 MONTH), 800000, @t4, @b_sby_3);
INSERT INTO detail_transaksi VALUES (@dt6, 500, 500, DATE_ADD(CURDATE(), INTERVAL 5 MONTH), 1100000, @t4, @b_sby_4);
INSERT INTO detail_ruangan VALUES (UUID(), 250, @r_sby_a, @dt5);
INSERT INTO detail_ruangan VALUES (UUID(), 150, @r_sby_b, @dt5);
INSERT INTO detail_ruangan VALUES (UUID(), 500, @r_sby_b, @dt6);

SET @t5 = UUID();
INSERT INTO transaksi VALUES (@t5, 'supply', NOW(), 6000000, @m_supply, @adm_sby);
SET @dt7 = UUID();
INSERT INTO detail_transaksi VALUES (@dt7, 2000, 2000, DATE_ADD(CURDATE(), INTERVAL 1 YEAR), 6000000, @t5, @b_sby_5);
INSERT INTO detail_ruangan VALUES (UUID(), 2000, @r_sby_c, @dt7);

SET @t6 = UUID();
INSERT INTO transaksi VALUES (@t6, 'supply', DATE_SUB(NOW(), INTERVAL 1 WEEK), 6600000, @m_supply, @adm_sby);
SET @dt8 = UUID();
SET @dt9 = UUID();
INSERT INTO detail_transaksi VALUES (@dt8, 1200, 1200, DATE_ADD(CURDATE(), INTERVAL 10 MONTH), 3600000, @t6, @b_sby_5);
INSERT INTO detail_transaksi VALUES (@dt9, 1000, 1000, DATE_ADD(CURDATE(), INTERVAL 9 MONTH), 3000000, @t6, @b_sby_6);
INSERT INTO detail_ruangan VALUES (UUID(), 1200, @r_sby_c, @dt8);
INSERT INTO detail_ruangan VALUES (UUID(), 1000, @r_sby_c, @dt9);

SET @t7 = UUID();
INSERT INTO transaksi VALUES (@t7, 'supply', NOW(), 5200000, @m_supply, @adm_sby);
SET @dt10 = UUID();
SET @dt11 = UUID();
INSERT INTO detail_transaksi VALUES (@dt10, 800, 800, DATE_ADD(CURDATE(), INTERVAL 8 MONTH), 2800000, @t7, @b_sby_7);
INSERT INTO detail_transaksi VALUES (@dt11, 600, 600, DATE_ADD(CURDATE(), INTERVAL 6 MONTH), 2400000, @t7, @b_sby_8);
INSERT INTO detail_ruangan VALUES (UUID(), 800, @r_sby_c, @dt10);
INSERT INTO detail_ruangan VALUES (UUID(), 400, @r_sby_c, @dt11);
INSERT INTO detail_ruangan VALUES (UUID(), 200, @r_sby_d, @dt11);

-- TRANSAKSI SIDOARJO
SET @t8 = UUID();
INSERT INTO transaksi VALUES (@t8, 'supply', DATE_SUB(NOW(), INTERVAL 2 MONTH), 4800000, @m_supply, @adm_sda);
SET @dt12 = UUID();
INSERT INTO detail_transaksi VALUES (@dt12, 600, 600, DATE_ADD(CURDATE(), INTERVAL 4 MONTH), 4800000, @t8, @b_sda_1);
INSERT INTO detail_ruangan VALUES (UUID(), 600, @r_sda_e, @dt12);

SET @t9 = UUID();
INSERT INTO transaksi VALUES (@t9, 'supply', DATE_SUB(NOW(), INTERVAL 1 MONTH), 10250000, @m_supply, @adm_sda);
SET @dt13 = UUID();
SET @dt14 = UUID();
INSERT INTO detail_transaksi VALUES (@dt13, 800, 800, DATE_ADD(CURDATE(), INTERVAL 6 MONTH), 6400000, @t9, @b_sda_1);
INSERT INTO detail_transaksi VALUES (@dt14, 700, 700, DATE_ADD(CURDATE(), INTERVAL 5 MONTH), 3850000, @t9, @b_sda_2);
INSERT INTO detail_ruangan VALUES (UUID(), 500, @r_sda_e, @dt13);
INSERT INTO detail_ruangan VALUES (UUID(), 300, @r_sda_f, @dt13);
INSERT INTO detail_ruangan VALUES (UUID(), 700, @r_sda_e, @dt14);

SET @t10 = UUID();
INSERT INTO transaksi VALUES (@t10, 'supply', NOW(), 6950000, @m_supply, @adm_sda);
SET @dt15 = UUID();
SET @dt16 = UUID();
INSERT INTO detail_transaksi VALUES (@dt15, 500, 500, DATE_ADD(CURDATE(), INTERVAL 7 MONTH), 2750000, @t10, @b_sda_2);
INSERT INTO detail_transaksi VALUES (@dt16, 600, 600, DATE_ADD(CURDATE(), INTERVAL 6 MONTH), 4200000, @t10, @b_sda_3);
INSERT INTO detail_ruangan VALUES (UUID(), 500, @r_sda_e, @dt15);
INSERT INTO detail_ruangan VALUES (UUID(), 400, @r_sda_e, @dt16);
INSERT INTO detail_ruangan VALUES (UUID(), 200, @r_sda_f, @dt16);

SET @t11 = UUID();
INSERT INTO transaksi VALUES (@t11, 'supply', DATE_SUB(NOW(), INTERVAL 3 WEEK), 18000000, @m_supply, @adm_sda);
SET @dt17 = UUID();
INSERT INTO detail_transaksi VALUES (@dt17, 300, 300, DATE_ADD(CURDATE(), INTERVAL 5 MONTH), 18000000, @t11, @b_sda_4);
INSERT INTO detail_ruangan VALUES (UUID(), 200, @r_sda_g, @dt17);
INSERT INTO detail_ruangan VALUES (UUID(), 100, @r_sda_h, @dt17);

SET @t12 = UUID();
INSERT INTO transaksi VALUES (@t12, 'supply', DATE_SUB(NOW(), INTERVAL 1 WEEK), 19800000, @m_supply, @adm_sda);
SET @dt18 = UUID();
SET @dt19 = UUID();
INSERT INTO detail_transaksi VALUES (@dt18, 250, 250, DATE_ADD(CURDATE(), INTERVAL 6 MONTH), 15000000, @t12, @b_sda_4);
INSERT INTO detail_transaksi VALUES (@dt19, 400, 400, DATE_ADD(CURDATE(), INTERVAL 8 MONTH), 4800000, @t12, @b_sda_5);
INSERT INTO detail_ruangan VALUES (UUID(), 150, @r_sda_g, @dt18);
INSERT INTO detail_ruangan VALUES (UUID(), 100, @r_sda_h, @dt18);
INSERT INTO detail_ruangan VALUES (UUID(), 250, @r_sda_g, @dt19);
INSERT INTO detail_ruangan VALUES (UUID(), 150, @r_sda_h, @dt19);

SET @t13 = UUID();
INSERT INTO transaksi VALUES (@t13, 'supply', NOW(), 8700000, @m_supply, @adm_sda);
SET @dt20 = UUID();
SET @dt21 = UUID();
INSERT INTO detail_transaksi VALUES (@dt20, 350, 350, DATE_ADD(CURDATE(), INTERVAL 7 MONTH), 4200000, @t13, @b_sda_5);
INSERT INTO detail_transaksi VALUES (@dt21, 300, 300, DATE_ADD(CURDATE(), INTERVAL 1 YEAR), 4500000, @t13, @b_sda_6);
INSERT INTO detail_ruangan VALUES (UUID(), 350, @r_sda_g, @dt20);
INSERT INTO detail_ruangan VALUES (UUID(), 200, @r_sda_g, @dt21);
INSERT INTO detail_ruangan VALUES (UUID(), 100, @r_sda_h, @dt21);

SET @t14 = UUID();
INSERT INTO transaksi VALUES (@t14, 'supply', DATE_SUB(NOW(), INTERVAL 2 DAY), 4700000, @m_supply, @adm_sda);
SET @dt22 = UUID();
SET @dt23 = UUID();
INSERT INTO detail_transaksi VALUES (@dt22, 500, 500, DATE_ADD(CURDATE(), INTERVAL 10 MONTH), 1500000, @t14, @b_sda_7);
INSERT INTO detail_transaksi VALUES (@dt23, 400, 400, DATE_ADD(CURDATE(), INTERVAL 1 YEAR), 3200000, @t14, @b_sda_8);
INSERT INTO detail_ruangan VALUES (UUID(), 500, @r_sda_g, @dt22);
INSERT INTO detail_ruangan VALUES (UUID(), 400, @r_sda_g, @dt23);

-- TRANSAKSI MALANG
SET @t15 = UUID();
INSERT INTO transaksi VALUES (@t15, 'supply', DATE_SUB(NOW(), INTERVAL 5 DAY), 18000000, @m_supply, @adm_mlg);
SET @dt24 = UUID();
INSERT INTO detail_transaksi VALUES (@dt24, 600, 600, DATE_ADD(CURDATE(), INTERVAL 2 YEAR), 18000000, @t15, @b_mlg_1);
INSERT INTO detail_ruangan VALUES (UUID(), 600, @r_mlg_i, @dt24);

SET @t16 = UUID();
INSERT INTO transaksi VALUES (@t16, 'supply', DATE_SUB(NOW(), INTERVAL 3 DAY), 24000000, @m_supply, @adm_mlg);
SET @dt25 = UUID();
SET @dt26 = UUID();
INSERT INTO detail_transaksi VALUES (@dt25, 400, 400, DATE_ADD(CURDATE(), INTERVAL 3 YEAR), 12000000, @t16, @b_mlg_1);
INSERT INTO detail_transaksi VALUES (@dt26, 500, 500, DATE_ADD(CURDATE(), INTERVAL 3 YEAR), 12000000, @t16, @b_mlg_2);
INSERT INTO detail_ruangan VALUES (UUID(), 400, @r_mlg_i, @dt25);
INSERT INTO detail_ruangan VALUES (UUID(), 500, @r_mlg_i, @dt26);

SET @t17 = UUID();
INSERT INTO transaksi VALUES (@t17, 'supply', DATE_SUB(NOW(), INTERVAL 1 DAY), 24100000, @m_supply, @adm_mlg);
SET @dt27 = UUID();
SET @dt28 = UUID();
INSERT INTO detail_transaksi VALUES (@dt27, 300, 300, DATE_ADD(CURDATE(), INTERVAL 2 YEAR), 4500000, @t17, @b_mlg_3);
INSERT INTO detail_transaksi VALUES (@dt28, 700, 700, DATE_ADD(CURDATE(), INTERVAL 18 MONTH), 19600000, @t17, @b_mlg_4);
INSERT INTO detail_ruangan VALUES (UUID(), 300, @r_mlg_i, @dt27);
INSERT INTO detail_ruangan VALUES (UUID(), 700, @r_mlg_j, @dt28);

SET @t18 = UUID();
INSERT INTO transaksi VALUES (@t18, 'supply', NOW(), 23600000, @m_supply, @adm_mlg);
SET @dt29 = UUID();
SET @dt30 = UUID();
INSERT INTO detail_transaksi VALUES (@dt29, 500, 500, DATE_ADD(CURDATE(), INTERVAL 15 MONTH), 14000000, @t18, @b_mlg_4);
INSERT INTO detail_transaksi VALUES (@dt30, 600, 600, DATE_ADD(CURDATE(), INTERVAL 12 MONTH), 9600000, @t18, @b_mlg_5);
INSERT INTO detail_ruangan VALUES (UUID(), 500, @r_mlg_j, @dt29);
INSERT INTO detail_ruangan VALUES (UUID(), 600, @r_mlg_j, @dt30);

SET @t19 = UUID();
INSERT INTO transaksi VALUES (@t19, 'supply', NOW(), 22000000, @m_supply, @adm_mlg);
SET @dt31 = UUID();
SET @dt32 = UUID();
INSERT INTO detail_transaksi VALUES (@dt31, 800, 800, DATE_ADD(CURDATE(), INTERVAL 2 YEAR), 4000000, @t19, @b_mlg_6);
INSERT INTO detail_transaksi VALUES (@dt32, 1000, 1000, DATE_ADD(CURDATE(), INTERVAL 2 YEAR), 18000000, @t19, @b_mlg_7);
INSERT INTO detail_ruangan VALUES (UUID(), 1000, @r_mlg_k, @dt32);

-- SUBSCRIPTION
SET @p1 = UUID();
SET @p2 = UUID();
SET @p3 = UUID();
INSERT INTO paket_subscription VALUES
(@p1, 'Trial 7 Hari', 0, 7, 'Paket percobaan gratis 7 hari'),
(@p2, 'Basic Bulanan', 500000, 30, 'Paket dasar untuk 1 bulan'),
(@p3, 'Pro Tahunan', 5000000, 365, 'Paket premium untuk 1 tahun');

INSERT INTO transaksi_subscription VALUES (UUID(), NOW(), 'lunas', @g_sby, @p3);
INSERT INTO transaksi_subscription VALUES (UUID(), NOW(), 'lunas', @g_sda, @p2);
INSERT INTO transaksi_subscription VALUES (UUID(), NOW(), 'pending', @g_mlg, @p1);

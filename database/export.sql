-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2025 at 11:31 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tekweb_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` char(36) NOT NULL DEFAULT (uuid()),
  `nama_admin` varchar(100) NOT NULL,
  `username_admin` varchar(100) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `email_admin` varchar(255) NOT NULL,
  `id_gudang` char(36) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username_admin`, `password_admin`, `email_admin`, `id_gudang`, `deleted_at`, `created_at`, `updated_at`) VALUES
('1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', 'Budi Santoso', 'admin1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'budi.santoso@gudangsby.com', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a', NULL, '2025-12-17 04:30:25', '2025-12-17 04:30:25'),
('1b6f07b7-db01-11f0-bb93-c4efbbdcfd4a', 'Sutrisno Wijaya', 'admin2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'sutrisno.wijaya@gudangsda.com', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a', NULL, '2025-12-17 04:30:25', '2025-12-17 04:30:25'),
('1b715075-db01-11f0-bb93-c4efbbdcfd4a', 'Dewi Lestari', 'admin3', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dewi.lestari@gudangmlg.com', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a', NULL, '2025-12-17 04:30:25', '2025-12-17 04:30:25'),
('2a05d453-b9d7-4212-8f8b-c5299e64cbcb', 'Ezra Santoso', 'adminezra', '$2y$10$PS6SWMW0a5BionJsrXwSfOxTviwEETHpos2FUKWpOg5qZRBAyAhIi', 'c14240069@john.petra.ac.id', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a', NULL, '2025-12-17 08:46:05', '2025-12-17 08:46:05'),
('38006172-8f7a-4b10-ac99-3c0b14cf5fab', 'indomie', 'hjhjh', '$2y$10$/drFqDzQCetswZ/UkFo4gOIKPAWnCwGrH369E1h4N5.5G19k95baq', 'ww@m.com', '5a9903d5-a0e0-4ce3-8c7f-ff93b5a513ca', NULL, '2025-12-17 08:41:25', '2025-12-17 08:41:25'),
('9c7a25bb-0134-442d-b2e2-674e9f533c70', 'Asui', 'asui', 'Bangke123', 'asui@gmail.com', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a', NULL, '2025-12-17 07:15:24', '2025-12-17 07:15:24'),
('d5292441-7dca-40f0-aba4-10a959bc108d', 'Luki', 'luki', '$2y$10$olLJNgly7RvMve8SVLJNY.WPi6AR48BXUhDd367M9TidhyxVZZTJW', 'clarenceevan0907@gmail.com', 'cee0e2ef-d57d-4455-a9e9-63f311e029bb', NULL, '2025-12-17 04:43:58', '2025-12-17 04:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` char(36) NOT NULL DEFAULT (uuid()),
  `nama_barang` varchar(100) NOT NULL,
  `foto_barang` varchar(255) DEFAULT NULL,
  `id_kategori` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `foto_barang`, `id_kategori`) VALUES
('1b6e0583-db01-11f0-bb93-c4efbbdcfd4a', 'Indomie Goreng', '69426ed79da5a.jpeg', '1b6d8cf0-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6e12fa-db01-11f0-bb93-c4efbbdcfd4a', 'Indomie Soto', NULL, '1b6d8cf0-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6e210f-db01-11f0-bb93-c4efbbdcfd4a', 'Mie Sedap Kari', NULL, '1b6d8cf0-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6e2e1b-db01-11f0-bb93-c4efbbdcfd4a', 'Sarimi Ayam', NULL, '1b6d8cf0-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6e3a82-db01-11f0-bb93-c4efbbdcfd4a', 'Aqua 600ml', NULL, '1b6d992b-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6e47d4-db01-11f0-bb93-c4efbbdcfd4a', 'Teh Botol', NULL, '1b6d992b-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6e542c-db01-11f0-bb93-c4efbbdcfd4a', 'Coca Cola', NULL, '1b6d992b-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6e5ec8-db01-11f0-bb93-c4efbbdcfd4a', 'Susu Ultra Coklat', NULL, '1b6da5e4-db01-11f0-bb93-c4efbbdcfd4a'),
('1b703d31-db01-11f0-bb93-c4efbbdcfd4a', 'Chitato BBQ', NULL, '1b6fc162-db01-11f0-bb93-c4efbbdcfd4a'),
('1b704a72-db01-11f0-bb93-c4efbbdcfd4a', 'Qtela Balado', NULL, '1b6fc162-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7055b6-db01-11f0-bb93-c4efbbdcfd4a', 'Taro Net', NULL, '1b6fc162-db01-11f0-bb93-c4efbbdcfd4a'),
('1b706040-db01-11f0-bb93-c4efbbdcfd4a', 'Beras Raja Lele 5kg', NULL, '1b6fcaf4-db01-11f0-bb93-c4efbbdcfd4a'),
('1b706b68-db01-11f0-bb93-c4efbbdcfd4a', 'Tepung Segitiga Biru', NULL, '1b6fcaf4-db01-11f0-bb93-c4efbbdcfd4a'),
('1b70784c-db01-11f0-bb93-c4efbbdcfd4a', 'Gula Gulaku', NULL, '1b6fcaf4-db01-11f0-bb93-c4efbbdcfd4a'),
('1b708355-db01-11f0-bb93-c4efbbdcfd4a', 'Royco Ayam', NULL, '1b6fd3f1-db01-11f0-bb93-c4efbbdcfd4a'),
('1b709b11-db01-11f0-bb93-c4efbbdcfd4a', 'Kecap Bango', NULL, '1b6fd3f1-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7285d8-db01-11f0-bb93-c4efbbdcfd4a', 'Lampu LED 12W', NULL, '1b7218ea-db01-11f0-bb93-c4efbbdcfd4a'),
('1b72947f-db01-11f0-bb93-c4efbbdcfd4a', 'Kabel NYM 10m', NULL, '1b7218ea-db01-11f0-bb93-c4efbbdcfd4a'),
('1b72a0a9-db01-11f0-bb93-c4efbbdcfd4a', 'Stop Kontak', NULL, '1b7218ea-db01-11f0-bb93-c4efbbdcfd4a'),
('1b72af77-db01-11f0-bb93-c4efbbdcfd4a', 'Rinso 800g', NULL, '1b722504-db01-11f0-bb93-c4efbbdcfd4a'),
('1b72be5f-db01-11f0-bb93-c4efbbdcfd4a', 'Sunlight 750ml', NULL, '1b722504-db01-11f0-bb93-c4efbbdcfd4a'),
('1b72cc06-db01-11f0-bb93-c4efbbdcfd4a', 'Pulpen Snowman', NULL, '1b723494-db01-11f0-bb93-c4efbbdcfd4a'),
('1b72f23b-db01-11f0-bb93-c4efbbdcfd4a', 'Buku Tulis Sidu', NULL, '1b723494-db01-11f0-bb93-c4efbbdcfd4a');

-- --------------------------------------------------------

--
-- Table structure for table `detail_ruangan`
--

CREATE TABLE `detail_ruangan` (
  `id_detail_ruangan` char(36) NOT NULL DEFAULT (uuid()),
  `kuantitas_ruangan` int NOT NULL,
  `id_ruangan` char(36) DEFAULT NULL,
  `id_detail_transaksi` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_ruangan`
--

INSERT INTO `detail_ruangan` (`id_detail_ruangan`, `kuantitas_ruangan`, `id_ruangan`, `id_detail_transaksi`) VALUES
('1b74a14a-db01-11f0-bb93-c4efbbdcfd4a', 100, '1b6cfc59-db01-11f0-bb93-c4efbbdcfd4a', '1b74319f-db01-11f0-bb93-c4efbbdcfd4a'),
('1b74ecb2-db01-11f0-bb93-c4efbbdcfd4a', 700, '1b6d0771-db01-11f0-bb93-c4efbbdcfd4a', '1b74319f-db01-11f0-bb93-c4efbbdcfd4a'),
('1b75f40d-db01-11f0-bb93-c4efbbdcfd4a', 800, '1b6cfc59-db01-11f0-bb93-c4efbbdcfd4a', '1b7587be-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7633e5-db01-11f0-bb93-c4efbbdcfd4a', 700, '1b6d0771-db01-11f0-bb93-c4efbbdcfd4a', '1b7587be-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7784e8-db01-11f0-bb93-c4efbbdcfd4a', 500, '1b6cfc59-db01-11f0-bb93-c4efbbdcfd4a', '1b76ce89-db01-11f0-bb93-c4efbbdcfd4a'),
('1b77c991-db01-11f0-bb93-c4efbbdcfd4a', 300, '1b6d0771-db01-11f0-bb93-c4efbbdcfd4a', '1b76ce89-db01-11f0-bb93-c4efbbdcfd4a'),
('1b780f1e-db01-11f0-bb93-c4efbbdcfd4a', 600, '1b6cfc59-db01-11f0-bb93-c4efbbdcfd4a', '1b76e89d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7975d5-db01-11f0-bb93-c4efbbdcfd4a', 250, '1b6cfc59-db01-11f0-bb93-c4efbbdcfd4a', '1b78a6de-db01-11f0-bb93-c4efbbdcfd4a'),
('1b79c6ab-db01-11f0-bb93-c4efbbdcfd4a', 150, '1b6d0771-db01-11f0-bb93-c4efbbdcfd4a', '1b78a6de-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7a0700-db01-11f0-bb93-c4efbbdcfd4a', 500, '1b6d0771-db01-11f0-bb93-c4efbbdcfd4a', '1b78b5ab-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7b0073-db01-11f0-bb93-c4efbbdcfd4a', 2000, '1b6d1332-db01-11f0-bb93-c4efbbdcfd4a', '1b7ab265-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7c67d1-db01-11f0-bb93-c4efbbdcfd4a', 1200, '1b6d1332-db01-11f0-bb93-c4efbbdcfd4a', '1b7bb5e0-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7ca6ed-db01-11f0-bb93-c4efbbdcfd4a', 1000, '1b6d1332-db01-11f0-bb93-c4efbbdcfd4a', '1b7bc4eb-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7de0f6-db01-11f0-bb93-c4efbbdcfd4a', 800, '1b6d1332-db01-11f0-bb93-c4efbbdcfd4a', '1b7d35b6-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7e268e-db01-11f0-bb93-c4efbbdcfd4a', 400, '1b6d1332-db01-11f0-bb93-c4efbbdcfd4a', '1b7d4604-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7e6a71-db01-11f0-bb93-c4efbbdcfd4a', 200, '1b6d1eb1-db01-11f0-bb93-c4efbbdcfd4a', '1b7d4604-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7f61b2-db01-11f0-bb93-c4efbbdcfd4a', 600, '1b6f50c1-db01-11f0-bb93-c4efbbdcfd4a', '1b7f09ac-db01-11f0-bb93-c4efbbdcfd4a'),
('1b80a956-db01-11f0-bb93-c4efbbdcfd4a', 500, '1b6f50c1-db01-11f0-bb93-c4efbbdcfd4a', '1b7ffc05-db01-11f0-bb93-c4efbbdcfd4a'),
('1b810a9f-db01-11f0-bb93-c4efbbdcfd4a', 300, '1b6f59d6-db01-11f0-bb93-c4efbbdcfd4a', '1b7ffc05-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8150a9-db01-11f0-bb93-c4efbbdcfd4a', 700, '1b6f50c1-db01-11f0-bb93-c4efbbdcfd4a', '1b800ae5-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8294e4-db01-11f0-bb93-c4efbbdcfd4a', 500, '1b6f50c1-db01-11f0-bb93-c4efbbdcfd4a', '1b81e4ad-db01-11f0-bb93-c4efbbdcfd4a'),
('1b82d5af-db01-11f0-bb93-c4efbbdcfd4a', 400, '1b6f50c1-db01-11f0-bb93-c4efbbdcfd4a', '1b81f493-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8312b2-db01-11f0-bb93-c4efbbdcfd4a', 200, '1b6f59d6-db01-11f0-bb93-c4efbbdcfd4a', '1b81f493-db01-11f0-bb93-c4efbbdcfd4a'),
('1b83f78a-db01-11f0-bb93-c4efbbdcfd4a', 200, '1b6f632b-db01-11f0-bb93-c4efbbdcfd4a', '1b83a2d8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b843317-db01-11f0-bb93-c4efbbdcfd4a', 100, '1b6f6ea8-db01-11f0-bb93-c4efbbdcfd4a', '1b83a2d8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8559ae-db01-11f0-bb93-c4efbbdcfd4a', 150, '1b6f632b-db01-11f0-bb93-c4efbbdcfd4a', '1b84b683-db01-11f0-bb93-c4efbbdcfd4a'),
('1b859682-db01-11f0-bb93-c4efbbdcfd4a', 100, '1b6f6ea8-db01-11f0-bb93-c4efbbdcfd4a', '1b84b683-db01-11f0-bb93-c4efbbdcfd4a'),
('1b85d4f1-db01-11f0-bb93-c4efbbdcfd4a', 250, '1b6f632b-db01-11f0-bb93-c4efbbdcfd4a', '1b84c5c4-db01-11f0-bb93-c4efbbdcfd4a'),
('1b860cbc-db01-11f0-bb93-c4efbbdcfd4a', 150, '1b6f6ea8-db01-11f0-bb93-c4efbbdcfd4a', '1b84c5c4-db01-11f0-bb93-c4efbbdcfd4a'),
('1b87330d-db01-11f0-bb93-c4efbbdcfd4a', 350, '1b6f632b-db01-11f0-bb93-c4efbbdcfd4a', '1b8687e3-db01-11f0-bb93-c4efbbdcfd4a'),
('1b878d2f-db01-11f0-bb93-c4efbbdcfd4a', 200, '1b6f632b-db01-11f0-bb93-c4efbbdcfd4a', '1b8699ab-db01-11f0-bb93-c4efbbdcfd4a'),
('1b87c8b5-db01-11f0-bb93-c4efbbdcfd4a', 100, '1b6f6ea8-db01-11f0-bb93-c4efbbdcfd4a', '1b8699ab-db01-11f0-bb93-c4efbbdcfd4a'),
('1b88fd1f-db01-11f0-bb93-c4efbbdcfd4a', 500, '1b6f632b-db01-11f0-bb93-c4efbbdcfd4a', '1b885bb0-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8938c9-db01-11f0-bb93-c4efbbdcfd4a', 400, '1b6f632b-db01-11f0-bb93-c4efbbdcfd4a', '1b886ae5-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8a16c9-db01-11f0-bb93-c4efbbdcfd4a', 600, '1b71a620-db01-11f0-bb93-c4efbbdcfd4a', '1b89c6be-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8b4a6c-db01-11f0-bb93-c4efbbdcfd4a', 400, '1b71a620-db01-11f0-bb93-c4efbbdcfd4a', '1b8aabd6-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8b8963-db01-11f0-bb93-c4efbbdcfd4a', 500, '1b71a620-db01-11f0-bb93-c4efbbdcfd4a', '1b8abc65-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8cddb2-db01-11f0-bb93-c4efbbdcfd4a', 300, '1b71a620-db01-11f0-bb93-c4efbbdcfd4a', '1b8c35e0-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8d1827-db01-11f0-bb93-c4efbbdcfd4a', 700, '1b71b147-db01-11f0-bb93-c4efbbdcfd4a', '1b8c44cd-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8e46d1-db01-11f0-bb93-c4efbbdcfd4a', 500, '1b71b147-db01-11f0-bb93-c4efbbdcfd4a', '1b8da240-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8e8144-db01-11f0-bb93-c4efbbdcfd4a', 600, '1b71b147-db01-11f0-bb93-c4efbbdcfd4a', '1b8db1af-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8fc34e-db01-11f0-bb93-c4efbbdcfd4a', 1000, '1b71bf84-db01-11f0-bb93-c4efbbdcfd4a', '1b8f286e-db01-11f0-bb93-c4efbbdcfd4a');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail_transaksi` char(36) NOT NULL DEFAULT (uuid()),
  `kuantitas_transaksi` int NOT NULL,
  `sisa_kuantitas` int NOT NULL,
  `expired_date` date DEFAULT NULL,
  `harga_detail_transaksi` decimal(15,2) NOT NULL,
  `id_transaksi` char(36) DEFAULT NULL,
  `id_barang` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detail_transaksi`, `kuantitas_transaksi`, `sisa_kuantitas`, `expired_date`, `harga_detail_transaksi`, `id_transaksi`, `id_barang`) VALUES
('1b74319f-db01-11f0-bb93-c4efbbdcfd4a', 1000, 800, '2026-05-17', '2500000.00', '1b73d151-db01-11f0-bb93-c4efbbdcfd4a', '1b6e0583-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7587be-db01-11f0-bb93-c4efbbdcfd4a', 1500, 1500, '2026-09-17', '3750000.00', '1b753115-db01-11f0-bb93-c4efbbdcfd4a', '1b6e0583-db01-11f0-bb93-c4efbbdcfd4a'),
('1b76ce89-db01-11f0-bb93-c4efbbdcfd4a', 800, 800, '2026-07-17', '1920000.00', '1b7679c9-db01-11f0-bb93-c4efbbdcfd4a', '1b6e12fa-db01-11f0-bb93-c4efbbdcfd4a'),
('1b76e89d-db01-11f0-bb93-c4efbbdcfd4a', 600, 600, '2026-06-17', '1200000.00', '1b7679c9-db01-11f0-bb93-c4efbbdcfd4a', '1b6e210f-db01-11f0-bb93-c4efbbdcfd4a'),
('1b78a6de-db01-11f0-bb93-c4efbbdcfd4a', 400, 400, '2026-08-17', '800000.00', '1b7858e5-db01-11f0-bb93-c4efbbdcfd4a', '1b6e210f-db01-11f0-bb93-c4efbbdcfd4a'),
('1b78b5ab-db01-11f0-bb93-c4efbbdcfd4a', 500, 500, '2026-05-17', '1100000.00', '1b7858e5-db01-11f0-bb93-c4efbbdcfd4a', '1b6e2e1b-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7ab265-db01-11f0-bb93-c4efbbdcfd4a', 2000, 2000, '2026-12-17', '6000000.00', '1b7a4d11-db01-11f0-bb93-c4efbbdcfd4a', '1b6e3a82-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7bb5e0-db01-11f0-bb93-c4efbbdcfd4a', 1200, 1200, '2026-10-17', '3600000.00', '1b7b44ee-db01-11f0-bb93-c4efbbdcfd4a', '1b6e3a82-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7bc4eb-db01-11f0-bb93-c4efbbdcfd4a', 1000, 1000, '2026-09-17', '3000000.00', '1b7b44ee-db01-11f0-bb93-c4efbbdcfd4a', '1b6e47d4-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7d35b6-db01-11f0-bb93-c4efbbdcfd4a', 800, 800, '2026-08-17', '2800000.00', '1b7ce524-db01-11f0-bb93-c4efbbdcfd4a', '1b6e542c-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7d4604-db01-11f0-bb93-c4efbbdcfd4a', 600, 600, '2026-06-17', '2400000.00', '1b7ce524-db01-11f0-bb93-c4efbbdcfd4a', '1b6e5ec8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7f09ac-db01-11f0-bb93-c4efbbdcfd4a', 600, 600, '2026-04-17', '4800000.00', '1b7eb9eb-db01-11f0-bb93-c4efbbdcfd4a', '1b703d31-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7ffc05-db01-11f0-bb93-c4efbbdcfd4a', 800, 800, '2026-06-17', '6400000.00', '1b7fa79f-db01-11f0-bb93-c4efbbdcfd4a', '1b703d31-db01-11f0-bb93-c4efbbdcfd4a'),
('1b800ae5-db01-11f0-bb93-c4efbbdcfd4a', 700, 700, '2026-05-17', '3850000.00', '1b7fa79f-db01-11f0-bb93-c4efbbdcfd4a', '1b704a72-db01-11f0-bb93-c4efbbdcfd4a'),
('1b81e4ad-db01-11f0-bb93-c4efbbdcfd4a', 500, 500, '2026-07-17', '2750000.00', '1b818e67-db01-11f0-bb93-c4efbbdcfd4a', '1b704a72-db01-11f0-bb93-c4efbbdcfd4a'),
('1b81f493-db01-11f0-bb93-c4efbbdcfd4a', 600, 600, '2026-06-17', '4200000.00', '1b818e67-db01-11f0-bb93-c4efbbdcfd4a', '1b7055b6-db01-11f0-bb93-c4efbbdcfd4a'),
('1b83a2d8-db01-11f0-bb93-c4efbbdcfd4a', 300, 300, '2026-05-17', '18000000.00', '1b83548b-db01-11f0-bb93-c4efbbdcfd4a', '1b706040-db01-11f0-bb93-c4efbbdcfd4a'),
('1b84b683-db01-11f0-bb93-c4efbbdcfd4a', 250, 250, '2026-06-17', '15000000.00', '1b846afb-db01-11f0-bb93-c4efbbdcfd4a', '1b706040-db01-11f0-bb93-c4efbbdcfd4a'),
('1b84c5c4-db01-11f0-bb93-c4efbbdcfd4a', 400, 400, '2026-08-17', '4800000.00', '1b846afb-db01-11f0-bb93-c4efbbdcfd4a', '1b706b68-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8687e3-db01-11f0-bb93-c4efbbdcfd4a', 350, 350, '2026-07-17', '4200000.00', '1b864408-db01-11f0-bb93-c4efbbdcfd4a', '1b706b68-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8699ab-db01-11f0-bb93-c4efbbdcfd4a', 300, 300, '2026-12-17', '4500000.00', '1b864408-db01-11f0-bb93-c4efbbdcfd4a', '1b70784c-db01-11f0-bb93-c4efbbdcfd4a'),
('1b885bb0-db01-11f0-bb93-c4efbbdcfd4a', 500, 500, '2026-10-17', '1500000.00', '1b880f46-db01-11f0-bb93-c4efbbdcfd4a', '1b708355-db01-11f0-bb93-c4efbbdcfd4a'),
('1b886ae5-db01-11f0-bb93-c4efbbdcfd4a', 400, 400, '2026-12-17', '3200000.00', '1b880f46-db01-11f0-bb93-c4efbbdcfd4a', '1b709b11-db01-11f0-bb93-c4efbbdcfd4a'),
('1b89c6be-db01-11f0-bb93-c4efbbdcfd4a', 600, 600, '2027-12-17', '18000000.00', '1b8976c0-db01-11f0-bb93-c4efbbdcfd4a', '1b7285d8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8aabd6-db01-11f0-bb93-c4efbbdcfd4a', 400, 400, '2028-12-17', '12000000.00', '1b8a5e7e-db01-11f0-bb93-c4efbbdcfd4a', '1b7285d8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8abc65-db01-11f0-bb93-c4efbbdcfd4a', 500, 500, '2028-12-17', '12000000.00', '1b8a5e7e-db01-11f0-bb93-c4efbbdcfd4a', '1b72947f-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8c35e0-db01-11f0-bb93-c4efbbdcfd4a', 300, 300, '2027-12-17', '4500000.00', '1b8bec20-db01-11f0-bb93-c4efbbdcfd4a', '1b72a0a9-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8c44cd-db01-11f0-bb93-c4efbbdcfd4a', 700, 700, '2027-06-17', '19600000.00', '1b8bec20-db01-11f0-bb93-c4efbbdcfd4a', '1b72af77-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8da240-db01-11f0-bb93-c4efbbdcfd4a', 500, 500, '2027-03-17', '14000000.00', '1b8d568d-db01-11f0-bb93-c4efbbdcfd4a', '1b72af77-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8db1af-db01-11f0-bb93-c4efbbdcfd4a', 600, 600, '2026-12-17', '9600000.00', '1b8d568d-db01-11f0-bb93-c4efbbdcfd4a', '1b72be5f-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8f1117-db01-11f0-bb93-c4efbbdcfd4a', 800, 800, '2027-12-17', '4000000.00', '1b8ec09c-db01-11f0-bb93-c4efbbdcfd4a', '1b72cc06-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8f286e-db01-11f0-bb93-c4efbbdcfd4a', 1000, 1000, '2027-12-17', '18000000.00', '1b8ec09c-db01-11f0-bb93-c4efbbdcfd4a', '1b72f23b-db01-11f0-bb93-c4efbbdcfd4a'),
('7ff673b9-9334-4cb0-94af-ff0cd13d70da', 200, 0, NULL, '200000.00', '11f6c162-87ab-42f5-84cb-01aff94d1e12', '1b6e0583-db01-11f0-bb93-c4efbbdcfd4a');

-- --------------------------------------------------------

--
-- Table structure for table `gudang`
--

CREATE TABLE `gudang` (
  `id_gudang` char(36) NOT NULL DEFAULT (uuid()),
  `nama_gudang` varchar(100) NOT NULL,
  `lokasi_gudang` varchar(255) NOT NULL,
  `status_gudang` enum('trial','active','expired','banned') DEFAULT 'trial',
  `expired_date_gudang` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gudang`
--

INSERT INTO `gudang` (`id_gudang`, `nama_gudang`, `lokasi_gudang`, `status_gudang`, `expired_date_gudang`, `created_at`, `updated_at`) VALUES
('1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a', 'Gudang Cabang Surabaya', 'Jl. Raya Darmo No. 12, Surabaya', 'active', '2026-02-15 05:36:57', '2025-12-17 04:30:24', '2025-12-17 09:00:54'),
('1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a', 'Gudang Cabang Sidoarjo', 'Jl. Wahid Hasyim No. 88, Sidoarjo', 'active', '2026-01-16 00:00:00', '2025-12-17 04:30:25', '2025-12-17 04:39:38'),
('1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a', 'Gudang Cabang Malang', 'Jl. Soekarno Hatta No. 45, Malang', 'expired', '2025-12-24 11:30:25', '2025-12-17 04:30:25', '2025-12-17 07:17:24'),
('5a9903d5-a0e0-4ce3-8c7f-ff93b5a513ca', 'asdfgh', 'qwerty', 'trial', '2025-12-24 15:41:25', '2025-12-17 08:41:25', '2025-12-17 08:41:25'),
('cee0e2ef-d57d-4455-a9e9-63f311e029bb', 'Gudang Garam', 'Jln. Rungkut No 512, Surabaya', 'trial', '2025-12-21 05:43:58', '2025-12-17 04:43:58', '2025-12-17 04:55:07');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` char(36) NOT NULL DEFAULT (uuid()),
  `nama_kategori` varchar(100) NOT NULL,
  `id_gudang` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `id_gudang`) VALUES
('1b6d8cf0-db01-11f0-bb93-c4efbbdcfd4a', 'Mie Instan', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6d992b-db01-11f0-bb93-c4efbbdcfd4a', 'Minuman Kemasan', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6da5e4-db01-11f0-bb93-c4efbbdcfd4a', 'Susu & Dairy', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6fc162-db01-11f0-bb93-c4efbbdcfd4a', 'Snack & Keripik', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6fcaf4-db01-11f0-bb93-c4efbbdcfd4a', 'Beras & Tepung', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6fd3f1-db01-11f0-bb93-c4efbbdcfd4a', 'Bumbu Dapur', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7218ea-db01-11f0-bb93-c4efbbdcfd4a', 'Elektronik Rumah', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a'),
('1b722504-db01-11f0-bb93-c4efbbdcfd4a', 'Perlengkapan Kebersihan', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a'),
('1b723494-db01-11f0-bb93-c4efbbdcfd4a', 'Alat Tulis Kantor', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` char(36) NOT NULL DEFAULT (uuid()),
  `nama_mitra` varchar(100) NOT NULL,
  `username_mitra` varchar(100) NOT NULL,
  `password_mitra` varchar(255) NOT NULL,
  `email_mitra` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_mitra`, `username_mitra`, `password_mitra`, `email_mitra`, `created_at`, `updated_at`) VALUES
('1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', 'PT. Indofood Sukses Makmur', 'indofood', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'clarenceevan0907@gmail.com', '2025-12-17 04:30:25', '2025-12-17 04:54:07'),
('1b736a46-db01-11f0-bb93-c4efbbdcfd4a', 'Toko Kelontong Madura', 'madura_jaya', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'madura@kelontong.com', '2025-12-17 04:30:25', '2025-12-17 04:30:25');

-- --------------------------------------------------------

--
-- Table structure for table `paket_subscription`
--

CREATE TABLE `paket_subscription` (
  `id_paket` char(36) NOT NULL DEFAULT (uuid()),
  `nama_paket` varchar(100) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `durasi_hari` int NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `paket_subscription`
--

INSERT INTO `paket_subscription` (`id_paket`, `nama_paket`, `harga`, `durasi_hari`, `deskripsi`) VALUES
('1b900737-db01-11f0-bb93-c4efbbdcfd4a', 'Trial 7 Hari', '0.00', 7, 'Paket percobaan gratis 7 hari'),
('1b90123d-db01-11f0-bb93-c4efbbdcfd4a', 'Basic Bulanan', '500000.00', 30, 'Paket dasar untuk 1 bulan'),
('1b9021b1-db01-11f0-bb93-c4efbbdcfd4a', 'Pro Tahunan', '5000000.00', 365, 'Paket premium untuk 1 tahun');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id_ruangan` char(36) NOT NULL DEFAULT (uuid()),
  `nama_ruangan` varchar(100) NOT NULL,
  `id_gudang` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id_ruangan`, `nama_ruangan`, `id_gudang`) VALUES
('1b6cfc59-db01-11f0-bb93-c4efbbdcfd4a', 'Rak A - Mie Instan', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6d0771-db01-11f0-bb93-c4efbbdcfd4a', 'Rak B - Mie Overflow', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6d1332-db01-11f0-bb93-c4efbbdcfd4a', 'Rak C - Minuman Dingin', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6d1eb1-db01-11f0-bb93-c4efbbdcfd4a', 'Rak D - Minuman Hangat', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6f50c1-db01-11f0-bb93-c4efbbdcfd4a', 'Rak E - Snack Ringan', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6f59d6-db01-11f0-bb93-c4efbbdcfd4a', 'Rak F - Snack Berat', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6f632b-db01-11f0-bb93-c4efbbdcfd4a', 'Rak G - Sembako Utama', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b6f6ea8-db01-11f0-bb93-c4efbbdcfd4a', 'Rak H - Sembako Cadangan', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b71a620-db01-11f0-bb93-c4efbbdcfd4a', 'Rak I - Elektronik', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a'),
('1b71b147-db01-11f0-bb93-c4efbbdcfd4a', 'Rak J - Kebersihan', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a'),
('1b71bf84-db01-11f0-bb93-c4efbbdcfd4a', 'Rak K - Alat Tulis', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a');

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id_superadmin` char(36) NOT NULL DEFAULT (uuid()),
  `nama_superadmin` varchar(100) NOT NULL,
  `email_superadmin` varchar(100) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `status` enum('aktif','tidak_aktif') DEFAULT 'aktif',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id_superadmin`, `nama_superadmin`, `email_superadmin`, `telepon`, `status`, `created_at`, `updated_at`) VALUES
('5b72b41a-da9a-11f0-acc0-00ffb0a37626', 'Super Admin 1', 'c14240053@john.petra.ac.id', NULL, 'aktif', '2025-12-16 16:14:54', '2025-12-16 16:14:54'),
('5b72b73d-da9a-11f0-acc0-00ffb0a37626', 'Super Admin 2', 'c14240069@john.petra.ac.id', NULL, 'aktif', '2025-12-16 16:14:54', '2025-12-16 16:14:54'),
('5b72b832-da9a-11f0-acc0-00ffb0a37626', 'Super Admin 3', 'c14240075@john.petra.ac.id', NULL, 'aktif', '2025-12-16 16:14:54', '2025-12-16 16:14:54'),
('5b72b893-da9a-11f0-acc0-00ffb0a37626', 'Super Admin 4', 'c14240085@john.petra.ac.id', NULL, 'aktif', '2025-12-16 16:14:54', '2025-12-16 16:14:54'),
('5b72b8e6-da9a-11f0-acc0-00ffb0a37626', 'Super Admin 5', 'c14240128@john.petra.ac.id', NULL, 'aktif', '2025-12-16 16:14:54', '2025-12-16 16:14:54');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` char(36) NOT NULL DEFAULT (uuid()),
  `jenis_transaksi` enum('supply','buy') NOT NULL,
  `tanggal_transaksi` datetime DEFAULT CURRENT_TIMESTAMP,
  `harga_transaksi` decimal(15,2) NOT NULL,
  `id_mitra` char(36) DEFAULT NULL,
  `id_admin` char(36) DEFAULT NULL,
  `id_gudang` char(36) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `jenis_transaksi`, `tanggal_transaksi`, `harga_transaksi`, `id_mitra`, `id_admin`, `id_gudang`) VALUES
('11f6c162-87ab-42f5-84cb-01aff94d1e12', 'buy', '2025-12-17 15:59:33', '200000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b73d151-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-09-17 11:30:25', '2500000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b753115-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-11-17 11:30:25', '3750000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7679c9-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-17 11:30:25', '3120000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7858e5-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-03 11:30:25', '1900000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7a4d11-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-17 11:30:25', '6000000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7b44ee-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-10 11:30:25', '6600000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7ce524-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-17 11:30:25', '5200000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6c8fd3-db01-11f0-bb93-c4efbbdcfd4a', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7eb9eb-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-10-17 11:30:25', '4800000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6f07b7-db01-11f0-bb93-c4efbbdcfd4a', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b7fa79f-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-11-17 11:30:25', '10250000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6f07b7-db01-11f0-bb93-c4efbbdcfd4a', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b818e67-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-17 11:30:25', '6950000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6f07b7-db01-11f0-bb93-c4efbbdcfd4a', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b83548b-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-11-26 11:30:25', '18000000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6f07b7-db01-11f0-bb93-c4efbbdcfd4a', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b846afb-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-10 11:30:25', '19800000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6f07b7-db01-11f0-bb93-c4efbbdcfd4a', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b864408-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-17 11:30:25', '8700000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6f07b7-db01-11f0-bb93-c4efbbdcfd4a', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b880f46-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-15 11:30:25', '4700000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b6f07b7-db01-11f0-bb93-c4efbbdcfd4a', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8976c0-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-12 11:30:25', '18000000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b715075-db01-11f0-bb93-c4efbbdcfd4a', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8a5e7e-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-14 11:30:25', '24000000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b715075-db01-11f0-bb93-c4efbbdcfd4a', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8bec20-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-16 11:30:25', '24100000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b715075-db01-11f0-bb93-c4efbbdcfd4a', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8d568d-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-17 11:30:25', '23600000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b715075-db01-11f0-bb93-c4efbbdcfd4a', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a'),
('1b8ec09c-db01-11f0-bb93-c4efbbdcfd4a', 'supply', '2025-12-17 11:30:25', '22000000.00', '1b7355f7-db01-11f0-bb93-c4efbbdcfd4a', '1b715075-db01-11f0-bb93-c4efbbdcfd4a', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_subscription`
--

CREATE TABLE `transaksi_subscription` (
  `id_subscription` char(36) NOT NULL DEFAULT (uuid()),
  `tanggal_bayar` datetime DEFAULT CURRENT_TIMESTAMP,
  `status_bayar` enum('pending','lunas','gagal') DEFAULT 'pending',
  `id_gudang` char(36) NOT NULL,
  `id_paket` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaksi_subscription`
--

INSERT INTO `transaksi_subscription` (`id_subscription`, `tanggal_bayar`, `status_bayar`, `id_gudang`, `id_paket`) VALUES
('1b908eef-db01-11f0-bb93-c4efbbdcfd4a', '2025-12-17 11:30:25', 'lunas', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a', '1b9021b1-db01-11f0-bb93-c4efbbdcfd4a'),
('1b90d3b9-db01-11f0-bb93-c4efbbdcfd4a', '2025-12-17 11:30:25', 'lunas', '1b6ebee8-db01-11f0-bb93-c4efbbdcfd4a', '1b90123d-db01-11f0-bb93-c4efbbdcfd4a'),
('1b9113e7-db01-11f0-bb93-c4efbbdcfd4a', '2025-12-17 11:30:25', 'lunas', '1b70f9ff-db01-11f0-bb93-c4efbbdcfd4a', '1b900737-db01-11f0-bb93-c4efbbdcfd4a'),
('3528f2c3-5ebe-4076-9641-2130212dfcb0', '2025-12-17 15:41:25', 'lunas', '5a9903d5-a0e0-4ce3-8c7f-ff93b5a513ca', '1b900737-db01-11f0-bb93-c4efbbdcfd4a'),
('a80b84b0-6b1b-4711-92d1-5cb798421637', '2025-12-17 11:36:39', 'lunas', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a', '1b90123d-db01-11f0-bb93-c4efbbdcfd4a'),
('d130d452-b053-42c3-b07b-f996579f69cd', '2025-12-17 16:00:39', 'lunas', '1b6a9a8d-db01-11f0-bb93-c4efbbdcfd4a', '1b90123d-db01-11f0-bb93-c4efbbdcfd4a'),
('fc3ace37-430f-473f-82cc-49f9e22059a7', '2025-12-14 11:43:58', 'lunas', 'cee0e2ef-d57d-4455-a9e9-63f311e029bb', '1b900737-db01-11f0-bb93-c4efbbdcfd4a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username_admin` (`username_admin`),
  ADD UNIQUE KEY `email_admin` (`email_admin`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `detail_ruangan`
--
ALTER TABLE `detail_ruangan`
  ADD PRIMARY KEY (`id_detail_ruangan`),
  ADD KEY `id_ruangan` (`id_ruangan`),
  ADD KEY `id_detail_transaksi` (`id_detail_transaksi`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `gudang`
--
ALTER TABLE `gudang`
  ADD PRIMARY KEY (`id_gudang`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`),
  ADD UNIQUE KEY `username_mitra` (`username_mitra`),
  ADD UNIQUE KEY `email_mitra` (`email_mitra`);

--
-- Indexes for table `paket_subscription`
--
ALTER TABLE `paket_subscription`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id_ruangan`),
  ADD KEY `id_gudang` (`id_gudang`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`id_superadmin`),
  ADD UNIQUE KEY `email_superadmin` (`email_superadmin`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_gudang` (`id_gudang`),
  ADD KEY `id_mitra` (`id_mitra`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `transaksi_subscription`
--
ALTER TABLE `transaksi_subscription`
  ADD PRIMARY KEY (`id_subscription`),
  ADD KEY `id_gudang` (`id_gudang`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `detail_ruangan`
--
ALTER TABLE `detail_ruangan`
  ADD CONSTRAINT `detail_ruangan_ibfk_1` FOREIGN KEY (`id_ruangan`) REFERENCES `ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_ruangan_ibfk_2` FOREIGN KEY (`id_detail_transaksi`) REFERENCES `detail_transaksi` (`id_detail_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `kategori`
--
ALTER TABLE `kategori`
  ADD CONSTRAINT `kategori_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD CONSTRAINT `ruangan_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_mitra`) REFERENCES `mitra` (`id_mitra`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_subscription`
--
ALTER TABLE `transaksi_subscription`
  ADD CONSTRAINT `transaksi_subscription_ibfk_1` FOREIGN KEY (`id_gudang`) REFERENCES `gudang` (`id_gudang`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_subscription_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket_subscription` (`id_paket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

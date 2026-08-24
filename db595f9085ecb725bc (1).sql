-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql-dbas-jkt-001.sumobase.my.id:63306
-- Waktu pembuatan: 28 Jul 2026 pada 14.45
-- Versi server: 8.0.46
-- Versi PHP: 8.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `db595f9085ecb725bc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `loggable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `loggable_id` bigint UNSIGNED NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` enum('web','n8n','system') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'web',
  `actor_type` enum('user','n8n_workflow','system') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `actor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actor_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field_changed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `old_value` text COLLATE utf8mb4_unicode_ci,
  `new_value` text COLLATE utf8mb4_unicode_ci,
  `metadata` json DEFAULT NULL,
  `n8n_event_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `loggable_type`, `loggable_id`, `action`, `source`, `actor_type`, `actor_id`, `actor_name`, `field_changed`, `old_value`, `new_value`, `metadata`, `n8n_event_id`, `created_at`) VALUES
(1, 'App\\Models\\Barang', 122, 'stock_updated', 'n8n', 'user', '081234567890', NULL, 'stok', '1', '0', '{\"merk\": \"GGCLink\", \"satuan\": \"unit\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Deny\", \"user_id\": \"081234567890\", \"username\": \"\"}, \"kode_aset\": \"B045\", \"nama_aset\": \"Modem Baru\", \"tipe_spek\": \"-\", \"keterangan\": \"Pengurangan 1 unit untuk Deny - pemasangan baru site Disa\", \"sub_kategori\": \"Modem\", \"lokasi_penyimpanan\": \"Gudang\"}', '3257_stok', '2026-07-02 11:45:02'),
(3, 'App\\Models\\Barang', 162, 'updated', 'n8n', 'user', 'Deny - 8195053569', NULL, 'stok_tersedia', '3', '2', '{\"merk\": \"Fiber Tekno\", \"satuan\": \"unit\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Deny\", \"user_id\": \"8195053569\", \"username\": \"\"}, \"kode_aset\": \"B085\", \"nama_aset\": \"Modem Second\", \"tipe_spek\": \"XPON\", \"keterangan\": \"Pengurangan 1 unit untuk Deny - maintenance client Villo ID 11210123\", \"sub_kategori\": \"Modem\", \"lokasi_penyimpanan\": \"Gudang\"}', '3535_stok_tersedia', '2026-07-02 15:29:15'),
(4, 'App\\Models\\Barang', 204, 'created', 'web', 'user', '1', NULL, NULL, NULL, NULL, '{\"kode_aset\": \"B110\", \"nama_aset\": \"Test\"}', NULL, '2026-07-02 15:35:13'),
(5, 'App\\Models\\Barang', 204, 'updated', 'web', 'user', '1', NULL, 'stok', '10', '9', NULL, NULL, '2026-07-02 15:36:54'),
(6, 'App\\Models\\Barang', 204, 'deleted', 'web', 'user', '1', NULL, NULL, NULL, NULL, '{\"kode_aset\": \"B110\", \"nama_aset\": \"Test\"}', NULL, '2026-07-02 15:37:16'),
(7, 'App\\Models\\Barang', 121, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok', '51', '50', '{\"merk\": \"VSOL\", \"satuan\": \"unit\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": \"\"}, \"kode_aset\": \"B044\", \"nama_aset\": \"Modem Baru\", \"tipe_spek\": \"-\", \"keterangan\": \"Pengurangan 1 unit (good) untuk Deny - maintenance client Villo ID 11210120\", \"sub_kategori\": \"Modem\", \"lokasi_penyimpanan\": \"Gudang\"}', '11413_stok', '2026-07-05 07:58:25'),
(8, 'App\\Models\\Barang', 80, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '91', '90', '{\"merk\": \"Netconnect\", \"satuan\": \"pcs\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B002\", \"nama_aset\": \"Kabel LAN\", \"tipe_spek\": \"DTC 3 meter\", \"keterangan\": \"Dimas ambil Untuk uplink Indibiz Palmnet\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"Gudang\"}', '17456_stok_tersedia', '2026-07-08 04:38:03'),
(11, 'App\\Models\\Barang', 33, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '1', '0', '{\"merk\": \"\", \"satuan\": \"unit\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"A031\", \"nama_aset\": \"Bor Drill Besar\", \"tipe_spek\": \"\", \"keterangan\": \"Membuat prakarya di rumah\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '19066_33_stok_tersedia', '2026-07-10 03:53:04'),
(12, 'App\\Models\\Barang', 35, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '4', '3', '{\"merk\": \"\", \"satuan\": \"unit\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"A033\", \"nama_aset\": \"Bor Battery\", \"tipe_spek\": \"\", \"keterangan\": \"Membuat prakarya di rumah\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '19066_35_stok_tersedia', '2026-07-10 03:53:04'),
(13, 'App\\Models\\Barang', 34, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '6', '5', '{\"merk\": \"\", \"satuan\": \"unit\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"A032\", \"nama_aset\": \"Bor Listrik\", \"tipe_spek\": \"\", \"keterangan\": \"Membuat prakarya di rumah\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '19066_34_stok_tersedia', '2026-07-10 03:53:04'),
(14, 'App\\Models\\Barang', 52, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '1', '0', '{\"merk\": \"\", \"satuan\": \"unit\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"A050\", \"nama_aset\": \"Gunting Pipa\", \"tipe_spek\": \"\", \"keterangan\": \"Membuat prakarya di rumah\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '19066_52_stok_tersedia', '2026-07-10 03:53:04'),
(15, 'App\\Models\\Barang', 121, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '29', '23', '{\"merk\": \"\", \"satuan\": \"unit\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B044\", \"nama_aset\": \"Modem VSOL Baru\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_121_stok_tersedia', '2026-07-13 04:48:30'),
(16, 'App\\Models\\Barang', 81, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '0', '0', '{\"merk\": \"\", \"satuan\": \"roll\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B003\", \"nama_aset\": \"Kabel Precon 150m\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_81_stok_tersedia', '2026-07-13 04:48:30'),
(17, 'App\\Models\\Barang', 113, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '4', '3', '{\"merk\": \"\", \"satuan\": \"pack\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B036\", \"nama_aset\": \"Protect Sleeve Besar\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_113_stok_tersedia', '2026-07-13 04:48:30'),
(18, 'App\\Models\\Barang', 82, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '38', '37', '{\"merk\": \"\", \"satuan\": \"roll\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B004\", \"nama_aset\": \"Kabel Precon 100m\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_82_stok_tersedia', '2026-07-13 04:48:30'),
(19, 'App\\Models\\Barang', 115, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '15', '10', '{\"merk\": \"\", \"satuan\": \"unit\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B038\", \"nama_aset\": \"Switch TP-Link 8 Port\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_115_stok_tersedia', '2026-07-13 04:48:30'),
(20, 'App\\Models\\Barang', 118, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '70', '48', '{\"merk\": \"\", \"satuan\": \"pcs\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B041\", \"nama_aset\": \"RJ45 SPG CAT5\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_118_stok_tersedia', '2026-07-13 04:48:30'),
(21, 'App\\Models\\Barang', 162, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '8', '9', '{\"merk\": \"\", \"satuan\": \"unit\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B085\", \"nama_aset\": \"Modem Second Fiber Tekno\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_162_stok_tersedia', '2026-07-13 04:48:30'),
(22, 'App\\Models\\Barang', 164, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '10', '11', '{\"merk\": \"\", \"satuan\": \"unit\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B087\", \"nama_aset\": \"Modem Second GGCLink\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_164_stok_tersedia', '2026-07-13 04:48:30'),
(23, 'App\\Models\\Barang', 80, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '90', '91', '{\"merk\": \"\", \"satuan\": \"pcs\", \"kategori\": \"\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B002\", \"nama_aset\": \"Kabel LAN DTC 3m\", \"tipe_spek\": \"\", \"keterangan\": \"\", \"sub_kategori\": \"\", \"lokasi_penyimpanan\": \"\"}', '23713_80_stok_tersedia', '2026-07-13 04:48:30'),
(27, 'App\\Models\\Barang', 124, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '10', '9', '{\"merk\": \"Standard\", \"satuan\": \"pack\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B047\", \"nama_aset\": \"Kabel Ties\", \"tipe_spek\": \"30 cm\", \"keterangan\": \"\", \"sub_kategori\": \"Office Appliance\", \"lokasi_penyimpanan\": null}', '23913_124_stok_tersedia_0', '2026-07-13 07:55:34'),
(28, 'App\\Models\\Barang', 125, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '21', '20', '{\"merk\": \"Standard\", \"satuan\": \"pack\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B048\", \"nama_aset\": \"Kabel Ties\", \"tipe_spek\": \"10 cm\", \"keterangan\": \"\", \"sub_kategori\": \"Office Appliance\", \"lokasi_penyimpanan\": null}', '23913_125_stok_tersedia_1', '2026-07-13 07:55:34'),
(29, 'App\\Models\\Barang', 181, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '3', '2', '{\"merk\": \"Standard\", \"satuan\": \"pcs\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B104\", \"nama_aset\": \"Closure Case ( No Kaset )\", \"tipe_spek\": \"8 core\", \"keterangan\": \"\", \"sub_kategori\": \"Lainnya\", \"lokasi_penyimpanan\": null}', '23913_181_stok_tersedia_2', '2026-07-13 07:55:34'),
(30, 'App\\Models\\Barang', 82, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '32', '31', '{\"merk\": \"Standard\", \"satuan\": \"roll\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B004\", \"nama_aset\": \"Kabel Precon\", \"tipe_spek\": \"100 meter\", \"keterangan\": \"Untuk penambahan penarikan Indibiz ke kontrakan baru\", \"sub_kategori\": \"Kabel\", \"lokasi_penyimpanan\": null}', '23917_82_stok_tersedia_0', '2026-07-13 07:56:58'),
(31, 'App\\Models\\Barang', 15, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '1', '3', '{\"merk\": \"-\", \"satuan\": \"unit\", \"kategori\": \"Alat\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"A013\", \"nama_aset\": \"Senter FO\", \"tipe_spek\": \"-\", \"keterangan\": \"\", \"sub_kategori\": \"Utilitas FO\", \"lokasi_penyimpanan\": null}', '23921_15_stok_tersedia_0', '2026-07-13 07:59:58'),
(32, 'App\\Models\\Barang', 164, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '10', '9', '{\"merk\": \"GGCLink\", \"satuan\": \"unit\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B087\", \"nama_aset\": \"Modem Second\", \"tipe_spek\": \"XPON\", \"keterangan\": \"\", \"sub_kategori\": \"Modem\", \"lokasi_penyimpanan\": null}', '23921_164_stok_tersedia_1', '2026-07-13 07:59:58'),
(33, 'App\\Models\\Barang', 113, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '3', '2', '{\"merk\": \"Standard\", \"satuan\": \"pack\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B036\", \"nama_aset\": \"Protect Sleeve\", \"tipe_spek\": \"Besar\", \"keterangan\": \"\", \"sub_kategori\": \"FO Appliance\", \"lokasi_penyimpanan\": null}', '23921_113_stok_tersedia_2', '2026-07-13 07:59:58'),
(34, 'App\\Models\\Barang', 82, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '31', '30', '{\"merk\": \"Standard\", \"satuan\": \"roll\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B004\", \"nama_aset\": \"Kabel Precon\", \"tipe_spek\": \"100 meter\", \"keterangan\": \"\", \"sub_kategori\": \"Kabel\", \"lokasi_penyimpanan\": null}', '23921_82_stok_tersedia_3', '2026-07-13 07:59:58'),
(35, 'App\\Models\\Barang', 8, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '1', '0', '{\"merk\": \"-\", \"satuan\": \"unit\", \"kategori\": \"Alat\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"A006\", \"nama_aset\": \"OTDR (Optical Time Domain Reflectometer)\", \"tipe_spek\": \"-\", \"keterangan\": \"\", \"sub_kategori\": \"Utilitas FO\", \"lokasi_penyimpanan\": null}', '23929_8_stok_tersedia_0', '2026-07-13 08:07:18'),
(36, 'App\\Models\\Barang', 149, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '3', '2', '{\"merk\": \"Standard\", \"satuan\": \"roll\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B072\", \"nama_aset\": \"Terminal Kabel\", \"tipe_spek\": \"-\", \"keterangan\": \"\", \"sub_kategori\": \"Lainnya\", \"lokasi_penyimpanan\": null}', '23929_149_stok_tersedia_1', '2026-07-13 08:07:18'),
(37, 'App\\Models\\Barang', 121, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '19', '13', '{\"merk\": \"VSOL\", \"satuan\": \"unit\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B044\", \"nama_aset\": \"Modem Baru\", \"tipe_spek\": \"-\", \"keterangan\": \"\", \"sub_kategori\": \"Modem\", \"lokasi_penyimpanan\": null}', '23929_121_stok_tersedia_2', '2026-07-13 08:07:18'),
(38, 'App\\Models\\Barang', 82, 'stock_updated', 'n8n', 'user', '8195053569', 'Dikuy', 'stok_tersedia', '30', '29', '{\"merk\": \"Standard\", \"satuan\": \"roll\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Dikuy\", \"user_id\": \"8195053569\", \"username\": null}, \"kode_aset\": \"B004\", \"nama_aset\": \"Kabel Precon\", \"tipe_spek\": \"100 meter\", \"keterangan\": \"\", \"sub_kategori\": \"Kabel\", \"lokasi_penyimpanan\": null}', '23929_82_stok_tersedia_3', '2026-07-13 08:07:18'),
(39, 'App\\Models\\Barang', 8, 'updated', 'web', 'user', '1', NULL, 'stok', '0', '2', NULL, NULL, '2026-07-14 03:53:18'),
(40, 'App\\Models\\Barang', 82, 'stock_updated', 'n8n', 'user', '7161070066', 'Ri Ki', 'stok_tersedia', '29', '28', '{\"merk\": \"Standard\", \"satuan\": \"roll\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Ri Ki\", \"user_id\": \"7161070066\", \"username\": null}, \"kode_aset\": \"B004\", \"nama_aset\": \"Kabel Precon\", \"tipe_spek\": \"100 meter\", \"keterangan\": \"Perlengkapan teknisi\", \"sub_kategori\": \"Kabel\", \"lokasi_penyimpanan\": null}', '26024_82_stok_tersedia_0', '2026-07-14 15:44:31'),
(41, 'App\\Models\\Barang', 125, 'stock_updated', 'n8n', 'user', '7161070066', 'Ri Ki', 'stok_tersedia', '20', '19', '{\"merk\": \"Standard\", \"satuan\": \"pack\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Ri Ki\", \"user_id\": \"7161070066\", \"username\": null}, \"kode_aset\": \"B048\", \"nama_aset\": \"Kabel Ties\", \"tipe_spek\": \"10 cm\", \"keterangan\": \"Perlengkapan teknisi\", \"sub_kategori\": \"Office Appliance\", \"lokasi_penyimpanan\": null}', '26024_125_stok_tersedia_1', '2026-07-14 15:44:31'),
(42, 'App\\Models\\Barang', 124, 'stock_updated', 'n8n', 'user', '7161070066', 'Ri Ki', 'stok_tersedia', '9', '8', '{\"merk\": \"Standard\", \"satuan\": \"pack\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Ri Ki\", \"user_id\": \"7161070066\", \"username\": null}, \"kode_aset\": \"B047\", \"nama_aset\": \"Kabel Ties\", \"tipe_spek\": \"30 cm\", \"keterangan\": \"Perlengkapan teknisi\", \"sub_kategori\": \"Office Appliance\", \"lokasi_penyimpanan\": null}', '26024_124_stok_tersedia_2', '2026-07-14 15:44:31'),
(43, 'App\\Models\\Barang', 148, 'stock_updated', 'n8n', 'user', '7161070066', 'Ri Ki', 'stok_tersedia', '47', '45', '{\"merk\": \"Standard\", \"satuan\": \"pack\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Ri Ki\", \"user_id\": \"7161070066\", \"username\": null}, \"kode_aset\": \"B071\", \"nama_aset\": \"Paku Klem\", \"tipe_spek\": \"6 mm\", \"keterangan\": \"Perlengkapan teknisi\", \"sub_kategori\": \"Lainnya\", \"lokasi_penyimpanan\": null}', '26024_148_stok_tersedia_3', '2026-07-14 15:44:31'),
(54, 'App\\Models\\Barang', 121, 'stock_updated', 'n8n', 'user', '7161070066', 'Ri Ki', 'stok_tersedia', '13', '12', '{\"merk\": \"VSOL\", \"satuan\": \"unit\", \"kategori\": \"Bahan\", \"pengirim\": {\"nama\": \"Ri Ki\", \"user_id\": \"7161070066\", \"username\": null}, \"kode_aset\": \"B044\", \"nama_aset\": \"Modem Baru\", \"tipe_spek\": \"-\", \"keterangan\": \"Riki Untuk ganti modem client villonet id 11210179\", \"sub_kategori\": \"Modem\", \"lokasi_penyimpanan\": null}', '33325_121_stok_tersedia_0', '2026-07-20 13:12:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barangs`
--

CREATE TABLE `barangs` (
  `id` int NOT NULL,
  `kode_aset` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `kategori_id` bigint UNSIGNED DEFAULT NULL,
  `sub_kategori` varchar(100) DEFAULT NULL,
  `sub_kategori_id` bigint UNSIGNED DEFAULT NULL,
  `nama_aset` varchar(255) NOT NULL,
  `merk` varchar(100) DEFAULT NULL,
  `merk_id` bigint UNSIGNED DEFAULT NULL,
  `tipe_spek` varchar(255) DEFAULT NULL,
  `tipe_spek_id` bigint UNSIGNED DEFAULT NULL,
  `serial_number` varchar(150) DEFAULT NULL,
  `mac_address` varchar(100) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT 'unit',
  `satuan_id` bigint UNSIGNED DEFAULT NULL,
  `stok` int DEFAULT '0',
  `kondisi` enum('Baik','Rusak','Retur','Hilang','Second') DEFAULT 'Baik',
  `kondisi_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('Ready Stock','Dipinjam','Terpasang') DEFAULT 'Ready Stock',
  `status_id` bigint UNSIGNED DEFAULT NULL,
  `lokasi` varchar(150) DEFAULT 'Gudang',
  `lokasi_id` bigint UNSIGNED DEFAULT NULL,
  `pic` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by_type` enum('user','n8n','system') DEFAULT NULL,
  `updated_by_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `barangs`
--

INSERT INTO `barangs` (`id`, `kode_aset`, `kategori`, `kategori_id`, `sub_kategori`, `sub_kategori_id`, `nama_aset`, `merk`, `merk_id`, `tipe_spek`, `tipe_spek_id`, `serial_number`, `mac_address`, `satuan`, `satuan_id`, `stok`, `kondisi`, `kondisi_id`, `status`, `status_id`, `lokasi`, `lokasi_id`, `pic`, `keterangan`, `created_at`, `updated_at`, `updated_by_type`, `updated_by_id`) VALUES
(3, 'A001', 'Alat', 1, 'Utilitas LAN', 1, 'LAN Tester', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 8, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(4, 'A002', 'Alat', 1, 'Utilitas LAN', 1, 'LAN Stripper', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(5, 'A003', 'Alat', 1, 'Utilitas LAN', 1, 'LAN Tracker', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Rusak', 2, 'Ready Stock', 1, 'Gudang', 1, NULL, '1 tidak lengkap | Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 1', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(6, 'A004', 'Alat', 1, 'Utilitas LAN', 1, 'LAN Cleaver', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(7, 'A005', 'Alat', 1, 'Utilitas FO', 2, 'OPM (Optical Power Meter)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Rusak', 2, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Rusak 2 unit ada di gudang, 3 unit ada di teknisi | Stok tersedia asli: 1 | Kondisi baik: 3, rusak: 2', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(8, 'A006', 'Alat', 1, 'Utilitas FO', 2, 'OTDR (Optical Time Domain Reflectometer)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', 'user', '1'),
(9, 'A007', 'Alat', 1, 'Utilitas FO', 2, 'OTP (Optical Termination Point)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 16 | Kondisi baik: 16, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(10, 'A008', 'Alat', 1, 'Utilitas FO', 2, 'Slitter Patchcore', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(11, 'A009', 'Alat', 1, 'Utilitas FO', 2, 'FO Cleaver (Cleaver untuk FO)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 5, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '3 di teknisi | Stok tersedia asli: 5 | Kondisi baik: 7, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(12, 'A010', 'Alat', 1, 'Utilitas FO', 2, 'FO Slitter', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(13, 'A011', 'Alat', 1, 'Utilitas FO', 2, 'FO Stripper', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '2 ada di Amad, 1 ada di Anang | Stok tersedia asli: 1 | Kondisi baik: 5, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(14, 'A012', 'Alat', 1, 'Utilitas FO', 2, 'Laser Pointer', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(15, 'A013', 'Alat', 1, 'Utilitas FO', 2, 'Senter FO', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia tertulis: 1 rusak | Stok tersedia asli: 1 rusak | Kondisi baik: 3, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', 'n8n', NULL),
(16, 'A014', 'Alat', 1, 'Utilitas FO', 2, 'Splicer FO', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '1 ada di Amad | Stok tersedia asli: 2 | Kondisi baik: 4, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(17, 'A015', 'Alat', 1, 'Tang', 3, 'Tang Crimping', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 16, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '2 tang di teknisi (anang, deny) | Stok tersedia asli: 16 | Kondisi baik: 17, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(18, 'A016', 'Alat', 1, 'Tang', 3, 'Tang Potong', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '1 tang di Amad, 1 tang Deny, 1 tang Anang | Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', 'n8n', NULL),
(19, 'A017', 'Alat', 1, 'Tang', 3, 'Tang Kombinasi', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(20, 'A018', 'Alat', 1, 'Tang', 3, 'Tang Pipih', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(21, 'A019', 'Alat', 1, 'Tang', 3, 'Tang Stripper Kabel Dropcore', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(22, 'A020', 'Alat', 1, 'Cable Management', 4, 'Print Label', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '1 ada di Deny | Stok tersedia asli: 1 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(23, 'A021', 'Alat', 1, 'Cable Management', 4, 'Wire Management', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(24, 'A022', 'Alat', 1, 'Cable Management', 4, 'Trackper Kabel', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(25, 'A023', 'Alat', 1, 'Cable Management', 4, 'Pengupas KU', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(26, 'A024', 'Alat', 1, 'Cable Management', 4, 'Cable Comb (Sisir Kabel)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(27, 'A025', 'Alat', 1, 'Tangga', 5, 'Tangga Lipat Telescopic', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Ada di garasi Disa | Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(28, 'A026', 'Alat', 1, 'Tangga', 5, 'Tangga 2 Meter', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(29, 'A027', 'Alat', 1, 'Tangga', 5, 'Tangga 3 Meter', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(30, 'A028', 'Alat', 1, 'Tangga', 5, 'Tangga 5 Meter', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Sudah kembali dari proyek Bandara', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(31, 'A029', 'Alat', 1, 'Tangga', 5, 'Tangga Kuning Besar', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Ada di garasi Disa | Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(32, 'A030', 'Alat', 1, 'Tangga', 5, 'Tangga Steger', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 4, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Ada di garasi Disa | Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(33, 'A031', 'Alat', 1, 'Bor', 6, 'Bor Drill Besar', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', 'n8n', NULL),
(34, 'A032', 'Alat', 1, 'Bor', 6, 'Bor Listrik', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 5, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 6 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', 'n8n', NULL),
(35, 'A033', 'Alat', 1, 'Bor', 6, 'Bor Battery', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 4 | Kondisi baik: 5, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', 'n8n', NULL),
(36, 'A034', 'Alat', 1, 'Bor', 6, 'Battery Bor', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 9, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 9 | Kondisi baik: 12, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(37, 'A035', 'Alat', 1, 'Bor', 6, 'Charger Bor', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(38, 'A036', 'Alat', 1, 'Perkakas', 7, 'Gerinda', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '1 ada di Dimas | Stok tersedia asli: 0 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(39, 'A037', 'Alat', 1, 'Perkakas', 7, 'Mata Gerinda', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(40, 'A038', 'Alat', 1, 'Perkakas', 7, 'Palu', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 6, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, '1 ada di Amad, 1 palu godem | Stok tersedia asli: 6 (palu pendek 0) | Kondisi baik: 8, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(41, 'A039', 'Alat', 1, 'Perkakas', 7, 'Gergaji Besi', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 7, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(42, 'A040', 'Alat', 1, 'Perkakas', 7, 'Kape', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(43, 'A041', 'Alat', 1, 'Perkakas', 7, 'Pahat', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(44, 'A042', 'Alat', 1, 'Perkakas', 7, 'Sendok Semen', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(45, 'A043', 'Alat', 1, 'Perkakas', 7, 'Mesin Gergaji Kayu', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(46, 'A044', 'Alat', 1, 'Perkakas', 7, 'Expansion Bolt Extracting Gun', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 12, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', 'n8n', NULL),
(47, 'A045', 'Alat', 1, 'Perkakas', 7, 'Meteran (Alat Ukur Meteran)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(48, 'A046', 'Alat', 1, 'Perkakas', 7, 'Ramset (Alat Tembak)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(49, 'A047', 'Alat', 1, 'Perkakas', 7, 'Staples Besar', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(50, 'A048', 'Alat', 1, 'Perkakas', 7, 'Cutter', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 4, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(51, 'A049', 'Alat', 1, 'Perkakas', 7, 'Gunting Plat', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(52, 'A050', 'Alat', 1, 'Perkakas', 7, 'Gunting Pipa', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', 'n8n', NULL),
(53, 'A051', 'Alat', 1, 'Perkakas', 7, 'Obeng', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 6, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 5(kombinasi 3) | Kondisi baik: 4, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(54, 'A052', 'Alat', 1, 'Perkakas', 7, 'Sealent', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(55, 'A053', 'Alat', 1, 'Perkakas', 7, 'Kunci pas 9 mm', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(56, 'A054', 'Alat', 1, 'Perkakas', 7, 'Kunci pas 10 mm', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(57, 'A055', 'Alat', 1, 'Perkakas', 7, 'Kunci pas 11 mm', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(58, 'A056', 'Alat', 1, 'Perkakas', 7, 'Kunci pas 12 mm', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(59, 'A057', 'Alat', 1, 'Perkakas', 7, 'Kunci pas 13 mm', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(60, 'A058', 'Alat', 1, 'Perkakas', 7, 'Kunci pas 14 mm', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(61, 'A059', 'Alat', 1, 'Perkakas', 7, 'Kunci pas 19 mm', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(62, 'A060', 'Alat', 1, 'K3', 8, 'Body Harmess', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(63, 'A061', 'Alat', 1, 'K3', 8, 'Rompi', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 4, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 4 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(64, 'A062', 'Alat', 1, 'K3', 8, 'Helm Proyek', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 8, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 8 | Kondisi baik: 4, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(65, 'A063', 'Alat', 1, 'K3', 8, 'Kacamata', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(66, 'A064', 'Alat', 1, 'K3', 8, 'Headlamp (Senter Kepala)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(67, 'A065', 'Alat', 1, 'Komunikasi', 9, 'HT', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 6, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 6 | Kondisi baik: 6, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(68, 'A066', 'Alat', 1, 'Komunikasi', 9, 'Charger HT', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 4, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 4 | Kondisi baik: 4, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(69, 'A067', 'Alat', 1, 'Lainnya', 10, 'Lampu Mikolite LED', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(70, 'A068', 'Alat', 1, 'Lainnya', 10, 'Antena', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 14, 'Rusak', 2, 'Ready Stock', 1, 'Gudang', 1, NULL, '1 antena tidak komplit | Stok tersedia asli: 13 | Kondisi baik: 13, rusak: 1', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(71, 'A069', 'Alat', 1, 'Lainnya', 10, 'Charger Laptop', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(72, 'A070', 'Alat', 1, 'Lainnya', 10, 'Steker T', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(73, 'A071', 'Alat', 1, 'K3', 8, 'Senter LED (Model Tempel)', '-', 1, '-', 1, NULL, NULL, 'unit', 1, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(74, 'A072', 'Alat', 1, 'K3', 8, 'Jas Hujan', '-', 1, '-', 1, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(75, 'A073', 'Alat', 1, 'Lainnya', 10, 'Click Cleaner', '-', 1, '-', 1, NULL, NULL, 'pcs', 2, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(76, 'A074', 'Alat', 1, 'Lainnya', 10, 'Wire Stripper', '-', 1, '-', 1, NULL, NULL, 'pcs', 2, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(77, 'A075', 'Alat', 1, 'Lainnya', 10, 'Gunting Baja', '-', 1, '-', 1, NULL, NULL, 'pcs', 2, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(78, 'A076', 'Alat', 1, 'Lainnya', 10, 'Kunci T 14mm', '-', 1, '-', 1, NULL, NULL, 'pcs', 2, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:55:58', '2026-07-28 14:38:24', NULL, NULL),
(79, 'B001', 'Bahan', 2, 'Kabel', 11, 'Kabel LAN', 'Netconnect', 2, 'DTC 1 meter', 2, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(80, 'B002', 'Bahan', 2, 'Kabel', 11, 'Kabel LAN', 'Netconnect', 2, 'DTC 3 meter', 3, NULL, NULL, 'pcs', 2, 91, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 120 | Kondisi baik: 102, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'user', '1'),
(81, 'B003', 'Bahan', 2, 'Kabel', 11, 'Kabel Precon', 'Standard', 3, '150 meter', 4, NULL, NULL, 'roll', 4, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 12 | Kondisi baik: 12, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(82, 'B004', 'Bahan', 2, 'Kabel', 11, 'Kabel Precon', 'Standard', 3, '100 meter', 5, NULL, NULL, 'roll', 4, 28, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Pengurangan oleh Anang (1 roll). Stok sebelumnya: 39', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(83, 'B005', 'Bahan', 2, 'Kabel', 11, 'Kabel Precon', 'Standard', 3, '80 meter', 6, NULL, NULL, 'roll', 4, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(84, 'B006', 'Bahan', 2, 'Kabel', 11, 'Kabel Precon', 'Standard', 3, '50 meter', 7, NULL, NULL, 'roll', 4, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(85, 'B007', 'Bahan', 2, 'Kabel', 11, 'Kabel Dropcore', 'Standard', 3, '1 km', 8, NULL, NULL, 'roll', 4, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(86, 'B009', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'SC/UPC - SC/UPC 1 m', 9, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(87, 'B010', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'SC/UPC - SC/UPC 2 m', 10, NULL, NULL, 'pack', 7, 6, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 10 | Kondisi baik: 10, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(88, 'B011', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'SC/UPC - SC/UPC 5 m', 11, NULL, NULL, 'pcs', 2, 6, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 6 | Kondisi baik: 6, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(89, 'B012', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'SC/UPC - SC/APC 2 m', 12, NULL, NULL, 'pcs', 2, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(90, 'B013', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'LC/UPC - SC/UPC 1 m', 13, NULL, NULL, 'pcs', 2, 17, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 17 | Kondisi baik: 17, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(91, 'B014', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'LC/UPC - SC/UPC 3 m', 14, NULL, NULL, 'pcs', 2, 19, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 19 | Kondisi baik: 19, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(92, 'B015', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'LC/PC - LC/PC OM2 10 m', 15, NULL, NULL, 'pcs', 2, 7, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 7 | Kondisi baik: 7, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(93, 'B016', 'Bahan', 2, 'Kabel', 11, 'Kabel PoE', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 9, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 9 | Kondisi baik: 9, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(94, 'B017', 'Bahan', 2, 'Kabel', 11, 'Pigtail', 'Standard', 3, 'LC/UPC 1,5 m', 16, NULL, NULL, 'pcs', 2, 20, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 20 | Kondisi baik: 20, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(95, 'B018', 'Bahan', 2, 'Kabel', 11, 'Pigtail', 'Standard', 3, 'SC OM4 1,5 m', 17, NULL, NULL, 'pcs', 2, 12, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 12 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(96, 'B019', 'Bahan', 2, 'Kabel', 11, 'Pigtail', 'Standard', 3, 'SC/UPC 1,5 m', 18, NULL, NULL, 'pcs', 2, 10, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 10 | Kondisi baik: 10, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(97, 'B020', 'Bahan', 2, 'Kabel', 11, 'Pigtail', 'Standard', 3, 'SC/APC 1,5 m', 19, NULL, NULL, 'pcs', 2, 220, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 220 | Kondisi baik: 220, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(98, 'B021', 'Bahan', 2, 'Kabel', 11, 'Kabel Power', 'Standard', 3, 'Untuk Modem Merk GGC', 20, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: - | Kondisi baik: 113, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(99, 'B022', 'Bahan', 2, 'Kabel', 11, 'Kabel Power', 'Standard', 3, 'Untuk Modem Merk TP-Link', 21, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: - | Kondisi baik: 29, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(100, 'B023', 'Bahan', 2, 'FO Appliance', 12, 'HTB (Side A dan Side B)', 'Standard', 3, '-', 1, NULL, NULL, 'pasang', 8, 4, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 6 pasang + 1 side B | Kondisi baik: 7, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(101, 'B024', 'Bahan', 2, 'FO Appliance', 12, 'ODP Baru (Box)', 'Tarmoc', 4, '1:16', 22, NULL, NULL, 'unit', 1, 4, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(102, 'B025', 'Bahan', 2, 'FO Appliance', 12, 'PLC Splitter', 'Standard', 3, '1:4', 23, NULL, NULL, 'pcs', 2, 10, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 10 | Kondisi baik: 10, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(103, 'B026', 'Bahan', 2, 'FO Appliance', 12, 'PLC Splitter', 'Standard', 3, '1:8', 24, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(104, 'B027', 'Bahan', 2, 'FO Appliance', 12, 'PLC Splitter', 'Standard', 3, '1:16', 22, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(105, 'B028', 'Bahan', 2, 'FO Appliance', 12, 'Splitter box', 'Standard', 3, '1:8', 24, NULL, NULL, 'pcs', 2, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(106, 'B029', 'Bahan', 2, 'FO Appliance', 12, 'Splitter box', 'Standard', 3, '1:16', 22, NULL, NULL, 'pcs', 2, 5, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(107, 'B030', 'Bahan', 2, 'FO Appliance', 12, 'Roset', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 14, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 15 | Kondisi baik: 15, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(108, 'B031', 'Bahan', 2, 'FO Appliance', 12, 'Roset', 'Indihome', 5, '-', 1, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(109, 'B032', 'Bahan', 2, 'FO Appliance', 12, 'Ring ODP', 'Standard', 3, 'Besar', 25, NULL, NULL, 'pcs', 2, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(110, 'B033', 'Bahan', 2, 'FO Appliance', 12, 'Ring ODP', 'Standard', 3, 'Kecil', 26, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(111, 'B034', 'Bahan', 2, 'FO Appliance', 12, 'Konektor SC', 'Standard', 3, 'Single', 27, NULL, NULL, 'pcs', 2, 263, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 174 | Kondisi baik: 158, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(112, 'B035', 'Bahan', 2, 'FO Appliance', 12, 'Konektor SC', 'Standard', 3, 'Double', 28, NULL, NULL, 'pcs', 2, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(113, 'B036', 'Bahan', 2, 'FO Appliance', 12, 'Protect Sleeve', 'Standard', 3, 'Besar', 25, NULL, NULL, 'pack', 7, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 5 | Kondisi baik: 7, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(114, 'B037', 'Bahan', 2, 'FO Appliance', 12, 'Protect Sleeve', 'Standard', 3, 'Kecil', 26, NULL, NULL, 'pack', 7, 6, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 6 | Kondisi baik: 7, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(115, 'B038', 'Bahan', 2, 'Network Appliance', 13, 'Switch', 'TP-Link', 6, '8 port', 29, NULL, NULL, 'unit', 1, 10, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Pengurangan 1 unit untuk Dimas (kondisi rusak)', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(116, 'B039', 'Bahan', 2, 'Network Appliance', 13, 'Barel', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 198, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 201 | Kondisi baik: 220, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(117, 'B040', 'Bahan', 2, 'Network Appliance', 13, 'PoE (Power of Ethernet)', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 20, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 17 | Kondisi baik: 17, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(118, 'B041', 'Bahan', 2, 'Network Appliance', 13, 'RJ45', 'SPG', 7, 'CAT5', 30, NULL, NULL, 'pcs', 2, 48, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 113 | Kondisi baik: 176, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(119, 'B042', 'Bahan', 2, 'Network Appliance', 13, 'RJ45', 'Belden', 8, 'CAT6', 31, NULL, NULL, 'pcs', 2, 129, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 129 | Kondisi baik: 120, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(120, 'B043', 'Bahan', 2, 'Network Appliance', 13, 'Panduit', 'Standard', 3, '-', 1, NULL, NULL, 'box', 6, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(121, 'B044', 'Bahan', 2, 'Modem', 14, 'Modem Baru', 'VSOL', 9, '-', 1, NULL, NULL, 'unit', 1, 12, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Pengurangan 1 unit (good) untuk pengganti client rusak - Amad | +1 unit Rusak (return dari client)', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(122, 'B045', 'Bahan', 2, 'Modem', 14, 'Modem Baru', 'GGCLink', 10, '-', 1, NULL, NULL, 'unit', 1, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(123, 'B046', 'Bahan', 2, 'Office Appliance', 15, 'Solasi Kertas', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(124, 'B047', 'Bahan', 2, 'Office Appliance', 15, 'Kabel Ties', 'Standard', 3, '30 cm', 32, NULL, NULL, 'pack', 7, 8, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 9 | Kondisi baik: 19, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(125, 'B048', 'Bahan', 2, 'Office Appliance', 15, 'Kabel Ties', 'Standard', 3, '10 cm', 33, NULL, NULL, 'pack', 7, 19, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 24 | Kondisi baik: 34, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(126, 'B049', 'Bahan', 2, 'Office Appliance', 15, 'Battery', 'Alkaline', 11, 'AAA', 34, NULL, NULL, 'pcs', 2, 10, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 12 | Kondisi baik: 22, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(127, 'B050', 'Bahan', 2, 'Office Appliance', 15, 'Battery', 'ABC', 12, 'AA', 35, NULL, NULL, 'pcs', 2, 20, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 15 | Kondisi baik: 4, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(128, 'B051', 'Bahan', 2, 'Office Appliance', 15, 'Battery', 'Standard', 3, '9 volt', 36, NULL, NULL, 'pcs', 2, 14, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 17 | Kondisi baik: 8, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(129, 'B052', 'Bahan', 2, 'Office Appliance', 15, 'Solasi', 'Standard', 3, 'Hitam', 37, NULL, NULL, 'pcs', 2, 10, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 16 | Kondisi baik: 16, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(130, 'B053', 'Bahan', 2, 'Office Appliance', 15, 'Solasi', 'Standard', 3, 'Bening', 38, NULL, NULL, 'pcs', 2, 8, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(131, 'B054', 'Bahan', 2, 'Office Appliance', 15, 'Solasi', '3M', 13, 'Busa', 39, NULL, NULL, 'pcs', 2, 47, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Pengurangan 1 pcs untuk Dimas', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(132, 'B055', 'Bahan', 2, 'Office Appliance', 15, 'Selongsong Bakar (Solasi Bakar)', 'Standard', 3, '-', 1, NULL, NULL, 'roll', 4, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(133, 'B056', 'Bahan', 2, 'Office Appliance', 15, 'Kertas Print Label', 'Standard', 3, 'Clear', 40, NULL, NULL, 'pack', 7, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(134, 'B057', 'Bahan', 2, 'Office Appliance', 15, 'Kertas Print Label', 'Standard', 3, 'Putih', 41, NULL, NULL, 'pack', 7, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 4 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(135, 'B058', 'Bahan', 2, 'Office Appliance', 15, 'Isi Cutter', 'Standard', 3, '-', 1, NULL, NULL, 'pack', 7, 7, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 7 | Kondisi baik: 18, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(136, 'B059', 'Bahan', 2, 'Cable Management', 4, 'Faceplate', 'Standard', 3, '1 port LAN', 42, NULL, NULL, 'pcs', 2, 19, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 19 | Kondisi baik: 19, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(137, 'B060', 'Bahan', 2, 'Cable Management', 4, 'Faceplate', 'Standard', 3, '2 port LAN', 43, NULL, NULL, 'pcs', 2, 4, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 4 | Kondisi baik: 4, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(138, 'B061', 'Bahan', 2, 'Cable Management', 4, 'Faceplate', 'Standard', 3, 'HDMI', 44, NULL, NULL, 'pcs', 2, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(139, 'B062', 'Bahan', 2, 'Cable Management', 4, 'Faceplate', 'Standard', 3, 'Type C', 45, NULL, NULL, 'pcs', 2, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(140, 'B063', 'Bahan', 2, 'Cable Management', 4, 'Plugboot LAN', 'Standard', 3, 'CAT6', 31, NULL, NULL, 'pcs', 2, 213, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 220 | Kondisi baik: 342, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(141, 'B064', 'Bahan', 2, 'Cable Management', 4, 'Elbow Conduit', 'Standard', 3, 'Hitam', 37, NULL, NULL, 'pcs', 2, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(142, 'B065', 'Bahan', 2, 'Cable Management', 4, 'Velcro Tape', 'Standard', 3, '-', 1, NULL, NULL, 'roll', 4, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(143, 'B066', 'Bahan', 2, 'Lainnya', 10, 'Shock Socket', 'Standard', 3, 'Abu-abu', 46, NULL, NULL, 'pcs', 2, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(144, 'B067', 'Bahan', 2, 'Lainnya', 10, 'Shock Pipa PVC', 'Standard', 3, 'Hitam', 37, NULL, NULL, 'pcs', 2, 79, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 79 | Kondisi baik: 79, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(145, 'B068', 'Bahan', 2, 'Lainnya', 10, 'Shock Drat Luar PVC', 'Standard', 3, 'Abu-abu', 46, NULL, NULL, 'pcs', 2, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 2 | Kondisi baik: 2, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(146, 'B069', 'Bahan', 2, 'Lainnya', 10, 'Modular', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 17, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 17 | Kondisi baik: 17, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(147, 'B070', 'Bahan', 2, 'Lainnya', 10, 'Klem Pipa Conduit', 'Standard', 3, 'Besar', 25, NULL, NULL, 'pcs', 2, 11, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: - | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(148, 'B071', 'Bahan', 2, 'Lainnya', 10, 'Paku Klem', 'Standard', 3, '6 mm', 47, NULL, NULL, 'pack', 7, 45, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 53 | Kondisi baik: 67, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(149, 'B072', 'Bahan', 2, 'Lainnya', 10, 'Terminal Kabel', 'Standard', 3, '-', 1, NULL, NULL, 'roll', 4, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 4 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(150, 'B073', 'Bahan', 2, 'Lainnya', 10, 'Paku Roofing', 'Standard', 3, '-', 1, NULL, NULL, 'pack', 7, 100, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: - | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(151, 'B074', 'Bahan', 2, 'Lainnya', 10, 'Alkohol 70%', 'Standard', 3, '-', 1, NULL, NULL, 'pack', 7, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(152, 'B075', 'Bahan', 2, 'Lainnya', 10, 'Lampu', 'Standard', 3, '10 watt', 48, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(153, 'B076', 'Bahan', 2, 'Kabel', 11, 'Kabel Dropcore', 'Standard', 3, '4 core 3 sling', 49, NULL, NULL, 'roll', 4, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(154, 'B077', 'Bahan', 2, 'FO Appliance', 12, 'ODP Baru (Box)', 'Standard', 3, '1:4', 23, NULL, NULL, 'unit', 1, 5, 'Rusak', 2, 'Ready Stock', 1, 'Gudang', 1, NULL, 'bekas FMI | Stok tersedia asli: 1 | Kondisi baik: 0, rusak: 1', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(155, 'B078', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'DTC Netconnect', 14, 'LC/UPC - LC/UPC Duplex 2 m', 50, NULL, NULL, 'pcs', 2, 33, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 33 | Kondisi baik: 33, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(156, 'B079', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'LC/UPC - SC/UPC 5 m', 51, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: - | Kondisi baik: 19, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(157, 'B080', 'Bahan', 2, 'Kabel', 11, 'Kabel Patchcord', 'Standard', 3, 'SC/APC - SC/APC 2 m', 52, NULL, NULL, 'pcs', 2, 6, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 6 | Kondisi baik: 6, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(158, 'B081', 'Bahan', 2, 'Kabel', 11, 'Pigtail', 'Standard', 3, 'LC/UPC 1 m', 53, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: - | Kondisi baik: 12, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(159, 'B082', 'Bahan', 2, 'Kabel', 11, 'Lakban', 'Standard', 3, 'Bening', 38, NULL, NULL, 'pcs', 2, 5, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 5 | Kondisi baik: 6, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(160, 'B083', 'Bahan', 2, 'FO Appliance', 12, 'Konektor LC', 'Standard', 3, 'Double', 28, NULL, NULL, 'pcs', 2, 7, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 7 | Kondisi baik: 20, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(161, 'B084', 'Bahan', 2, 'Modem', 14, 'Modem Second', 'No Merk', 15, 'XPON', 54, NULL, NULL, 'unit', 1, 20, 'Second', 4, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 7 | Kondisi baik: 3, rusak: 7', '2026-06-19 13:59:46', '2026-07-28 14:42:48', 'n8n', NULL),
(162, 'B085', 'Bahan', 2, 'Modem', 14, 'Modem Second', 'Fiber Tekno', 16, 'XPON', 54, NULL, NULL, 'unit', 1, 9, 'Second', 4, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 6, rusak: 1', '2026-06-19 13:59:46', '2026-07-28 14:42:48', 'n8n', NULL),
(163, 'B086', 'Bahan', 2, 'Modem', 14, 'Modem Second', 'Huawei', 17, 'XPON', 54, NULL, NULL, 'unit', 1, 0, 'Second', 4, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 2', '2026-06-19 13:59:46', '2026-07-28 14:42:48', NULL, NULL),
(164, 'B087', 'Bahan', 2, 'Modem', 14, 'Modem Second', 'GGCLink', 10, 'XPON', 54, NULL, NULL, 'unit', 1, 9, 'Second', 4, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Pengurangan 1 unit untuk perbaikan client ID 11120012', '2026-06-19 13:59:46', '2026-07-28 14:42:48', 'n8n', NULL),
(165, 'B088', 'Bahan', 2, 'Modem', 14, 'Modem Second', 'VSOL', 9, 'XPON', 54, NULL, NULL, 'unit', 1, 6, 'Second', 4, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 5, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:42:48', NULL, NULL),
(166, 'B089', 'Bahan', 2, 'FO Appliance', 12, 'ODP Second (Box)', 'Standard', 3, '1:16', 22, NULL, NULL, 'unit', 1, 3, 'Second', 4, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 nempel di kantor | Kondisi baik: 0, rusak: 1', '2026-06-19 13:59:46', '2026-07-28 14:42:48', NULL, NULL),
(167, 'B090', 'Bahan', 2, 'FO Appliance', 12, 'Fast Connector', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 10, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 10 | Kondisi baik: 10, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(168, 'B091', 'Bahan', 2, 'FO Appliance', 12, 'Soc Connector', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 278, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 278 | Kondisi baik: 278, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(169, 'B092', 'Bahan', 2, 'FO Appliance', 12, 'Splitter box', 'Standard', 3, '1:4', 23, NULL, NULL, 'pcs', 2, 5, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(170, 'B093', 'Bahan', 2, 'FO Appliance', 12, 'PLC Splitter', 'Standard', 3, '1:2', 55, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 0 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(171, 'B094', 'Bahan', 2, 'FO Appliance', 12, 'OTP (Optical Termination Point) FO', 'Standard', 3, '-', 1, NULL, NULL, 'pcs', 2, 19, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 14 | Kondisi baik: 14, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(172, 'B095', 'Bahan', 2, 'Office Appliance', 15, 'Marker Ties (Label Ties)', 'Standard', 3, '10 cm', 33, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: - | Kondisi baik: 60, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(173, 'B096', 'Bahan', 2, 'Lainnya', 10, 'Duradus', 'Standard', 3, 'Putih', 41, NULL, NULL, 'pcs', 2, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(174, 'B097', 'Bahan', 2, 'Lainnya', 10, 'Duradus', 'Standard', 3, 'Hitam', 37, NULL, NULL, 'pcs', 2, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(175, 'B098', 'Bahan', 2, 'Lainnya', 10, 'T Dus', 'Standard', 3, 'Hitam', 37, NULL, NULL, 'pcs', 2, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(176, 'B099', 'Bahan', 2, 'Lainnya', 10, 'T Dus', 'Standard', 3, 'Putih', 41, NULL, NULL, 'pcs', 2, 13, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 25 | Kondisi baik: 25, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(177, 'B100', 'Bahan', 2, 'Lainnya', 10, 'Shock Conduit', 'Standard', 3, 'Putih', 41, NULL, NULL, 'pcs', 2, 220, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 220 | Kondisi baik: 160, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(178, 'B101', 'Bahan', 2, 'Lainnya', 10, 'Alcohol Swab', 'Standard', 3, '-', 1, NULL, NULL, 'pack', 7, 1, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(179, 'B102', 'Bahan', 2, 'Modem', 14, 'Modem Second', 'TP-Link', 6, '-', 1, NULL, NULL, 'unit', 1, 9, 'Second', 4, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 5 | Kondisi baik: 5, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:42:48', NULL, NULL),
(180, 'B103', 'Bahan', 2, 'Lainnya', 10, 'Klem Kuping', 'Standard', 3, '-', 1, NULL, NULL, 'unit', 1, 11, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 11 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(181, 'B104', 'Bahan', 2, 'Lainnya', 10, 'Closure Case ( No Kaset )', 'Standard', 3, '8 core', 56, NULL, NULL, 'pcs', 2, 2, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', 'n8n', NULL),
(182, 'B105', 'Bahan', 2, 'Lainnya', 10, 'Kabel Dropcore', 'Standard', 3, '2 core 3 sling', 57, NULL, NULL, 'roll', 4, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 1, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(183, 'B106', 'Bahan', 2, 'Lainnya', 10, 'ODP Baru (Box)', 'Standard', 3, '1:8', 24, NULL, NULL, 'pcs', 2, 0, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 1 | Kondisi baik: 0, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(184, 'B107', 'Bahan', 2, 'Lainnya', 10, 'Modem Baru', 'TP-Link', 6, '-', 1, NULL, NULL, 'pcs', 2, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 3 | Kondisi baik: 3, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL),
(185, 'B108', 'Bahan', 2, 'Lainnya', 10, 'Modem Second', 'TP-Link', 6, '-', 1, NULL, NULL, 'pcs', 2, 6, 'Second', 4, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Pengurangan 1 unit untuk Amad - pengganti modem GGCLink rusak', '2026-06-19 13:59:46', '2026-07-28 14:42:48', NULL, NULL),
(186, 'B109', 'Bahan', 2, 'Lainnya', 10, 'Kabel Patchcord hitam', 'Standard', 3, 'SC/UPC - SC/UPC 2 m', 10, NULL, NULL, 'pcs', 2, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, 'Stok tersedia asli: 15 | Kondisi baik: 15, rusak: 0', '2026-06-19 13:59:46', '2026-07-28 14:38:24', NULL, NULL);
INSERT INTO `barangs` (`id`, `kode_aset`, `kategori`, `kategori_id`, `sub_kategori`, `sub_kategori_id`, `nama_aset`, `merk`, `merk_id`, `tipe_spek`, `tipe_spek_id`, `serial_number`, `mac_address`, `satuan`, `satuan_id`, `stok`, `kondisi`, `kondisi_id`, `status`, `status_id`, `lokasi`, `lokasi_id`, `pic`, `keterangan`, `created_at`, `updated_at`, `updated_by_type`, `updated_by_id`) VALUES
(187, 'B110', 'Bahan', 2, 'Lainnya', 10, 'Mini closure', 'Standard', 3, '1 : 4', 58, NULL, NULL, 'pcs', 2, 8, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, NULL, '2026-07-05 03:04:56', '2026-07-28 14:38:24', 'n8n', NULL),
(188, 'B111', 'Bahan', 2, 'Lainnya', 10, 'Terminal Kabel', 'Standard', 3, '1 Port', 59, NULL, NULL, 'pcs', 2, 3, 'Baik', 1, 'Ready Stock', 1, 'Gudang', 1, NULL, NULL, '2026-07-05 03:04:56', '2026-07-28 14:38:24', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('inventory-disa-cache-spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:23:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"view dashboard\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:5;i:2;i:6;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"view barang\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:5;i:2;i:6;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:13:\"create barang\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:13:\"update barang\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:13:\"delete barang\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"export barang\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:3;i:1;i:5;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:17:\"view activity_log\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:5;i:2;i:6;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:17:\"view stock_opname\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:5;i:2;i:6;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:19:\"create stock_opname\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:21:\"finalize stock_opname\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:19:\"delete stock_opname\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:21:\"view master_reference\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:3;i:1;i:5;i:2;i:6;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:23:\"create master_reference\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:23:\"update master_reference\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:23:\"delete master_reference\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:5;}}i:15;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:20:\"view user_management\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:22:\"create user_management\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:22:\"update user_management\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:22:\"delete user_management\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:20:\"view role_management\";s:1:\"c\";s:3:\"web\";}i:20;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:22:\"create role_management\";s:1:\"c\";s:3:\"web\";}i:21;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:22:\"update role_management\";s:1:\"c\";s:3:\"web\";}i:22;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:22:\"delete role_management\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:7:\"Finance\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:12:\"Admin Gudang\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:5:\"Owner\";s:1:\"c\";s:3:\"web\";}}}', 1785309553);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kategori`
--

CREATE TABLE `master_kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_kategori`
--

INSERT INTO `master_kategori` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Alat', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(2, 'Bahan', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_kondisi`
--

CREATE TABLE `master_kondisi` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_kondisi`
--

INSERT INTO `master_kondisi` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Baik', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(2, 'Rusak', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(3, 'Retur', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(4, 'Second', 1, '2026-07-05 06:57:59', '2026-07-28 08:11:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_lokasi`
--

CREATE TABLE `master_lokasi` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_lokasi`
--

INSERT INTO `master_lokasi` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Gudang', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_merk`
--

CREATE TABLE `master_merk` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_merk`
--

INSERT INTO `master_merk` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '-', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(2, 'Netconnect', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(3, 'Standard', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(4, 'Tarmoc', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(5, 'Indihome', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(6, 'TP-Link', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(7, 'SPG', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(8, 'Belden', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(9, 'VSOL', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(10, 'GGCLink', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(11, 'Alkaline', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(12, 'ABC', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(13, '3M', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(14, 'DTC Netconnect', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(15, 'No Merk', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(16, 'Fiber Tekno', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(17, 'Huawei', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_satuan`
--

CREATE TABLE `master_satuan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_satuan`
--

INSERT INTO `master_satuan` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Unit', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(2, 'Pcs', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(3, 'Set', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(4, 'Roll', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(5, 'Meter', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(6, 'Box', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(7, 'pack', 1, '2026-07-05 06:58:00', '2026-07-05 06:58:00'),
(8, 'pasang', 1, '2026-07-05 06:58:00', '2026-07-05 06:58:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_status`
--

CREATE TABLE `master_status` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_status`
--

INSERT INTO `master_status` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Ready Stock', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(2, 'Dipinjam', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(3, 'Terpasang', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_sub_kategori`
--

CREATE TABLE `master_sub_kategori` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_sub_kategori`
--

INSERT INTO `master_sub_kategori` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Utilitas LAN', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(2, 'Utilitas FO', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(3, 'Tang', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(4, 'Cable Management', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(5, 'Tangga', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(6, 'Bor', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(7, 'Perkakas', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(8, 'K3', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(9, 'Komunikasi', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(10, 'Lainnya', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(11, 'Kabel', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(12, 'FO Appliance', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(13, 'Network Appliance', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(14, 'Modem', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(15, 'Office Appliance', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_tipe_spek`
--

CREATE TABLE `master_tipe_spek` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `master_tipe_spek`
--

INSERT INTO `master_tipe_spek` (`id`, `nama`, `is_active`, `created_at`, `updated_at`) VALUES
(1, '-', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(2, 'DTC 1 meter', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(3, 'DTC 3 meter', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(4, '150 meter', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(5, '100 meter', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(6, '80 meter', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(7, '50 meter', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(8, '1 km', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(9, 'SC/UPC - SC/UPC 1 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(10, 'SC/UPC - SC/UPC 2 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(11, 'SC/UPC - SC/UPC 5 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(12, 'SC/UPC - SC/APC 2 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(13, 'LC/UPC - SC/UPC 1 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(14, 'LC/UPC - SC/UPC 3 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(15, 'LC/PC - LC/PC OM2 10 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(16, 'LC/UPC 1,5 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(17, 'SC OM4 1,5 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(18, 'SC/UPC 1,5 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(19, 'SC/APC 1,5 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(20, 'Untuk Modem Merk GGC', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(21, 'Untuk Modem Merk TP-Link', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(22, '1:16', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(23, '1:4', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(24, '1:8', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(25, 'Besar', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(26, 'Kecil', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(27, 'Single', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(28, 'Double', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(29, '8 port', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(30, 'CAT5', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(31, 'CAT6', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(32, '30 cm', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(33, '10 cm', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(34, 'AAA', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(35, 'AA', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(36, '9 volt', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(37, 'Hitam', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(38, 'Bening', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(39, 'Busa', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(40, 'Clear', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(41, 'Putih', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(42, '1 port LAN', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(43, '2 port LAN', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(44, 'HDMI', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(45, 'Type C', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(46, 'Abu-abu', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(47, '6 mm', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(48, '10 watt', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(49, '4 core 3 sling', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(50, 'LC/UPC - LC/UPC Duplex 2 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(51, 'LC/UPC - SC/UPC 5 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(52, 'SC/APC - SC/APC 2 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(53, 'LC/UPC 1 m', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(54, 'XPON', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(55, '1:2', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(56, '8 core', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(57, '2 core 3 sling', 1, '2026-07-05 06:57:59', '2026-07-05 06:57:59'),
(58, '1 : 4', 1, '2026-07-28 14:31:43', '2026-07-28 14:31:43'),
(59, '1 Port', 1, '2026-07-28 14:31:43', '2026-07-28 14:31:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_03_062523_create_barangs_table', 1),
(5, '2025_12_03_062525_create_stock_ins_table', 1),
(6, '2025_12_03_062526_create_stock_outs_table', 1),
(7, '2025_12_03_064303_add_username_and_role_to_users_table', 1),
(8, '2026_07_02_000000_reconcile_barangs_table_schema', 2),
(9, '2026_07_02_000001_create_activity_logs_table', 2),
(10, '2026_07_02_000002_add_tracking_columns_to_barangs_table', 2),
(11, '2026_07_02_000003_add_search_indexes_to_barangs_table', 3),
(12, '2026_07_02_000004_add_actor_name_to_activity_logs_table', 3),
(13, '2026_07_02_000006_create_master_reference_tables', 4),
(14, '2026_07_02_000008_create_permission_tables', 5),
(15, '2026_07_02_000009_create_rbac_audit_logs_table', 5),
(16, '2026_07_02_000099_drop_role_column_from_users', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(5, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(6, 'App\\Models\\User', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view dashboard', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(2, 'view barang', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(3, 'create barang', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(4, 'update barang', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(5, 'delete barang', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(6, 'export barang', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(7, 'view activity_log', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(8, 'view stock_opname', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(9, 'create stock_opname', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(10, 'finalize stock_opname', 'web', '2026-07-08 04:23:48', '2026-07-08 04:23:48'),
(11, 'delete stock_opname', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(12, 'view master_reference', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(13, 'create master_reference', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(14, 'update master_reference', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(15, 'delete master_reference', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(16, 'view user_management', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(17, 'create user_management', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(18, 'update user_management', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(19, 'delete user_management', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(20, 'view role_management', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(21, 'create role_management', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(22, 'update role_management', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(23, 'delete role_management', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rbac_audit_logs`
--

CREATE TABLE `rbac_audit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changes` json DEFAULT NULL,
  `actor_id` bigint UNSIGNED DEFAULT NULL,
  `actor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rbac_audit_logs`
--

INSERT INTO `rbac_audit_logs` (`id`, `action`, `subject_type`, `subject_label`, `changes`, `actor_id`, `actor_name`, `created_at`) VALUES
(1, 'role.updated', 'Role', 'Admin Gudang', '{\"to\": \"Admin Gudang\", \"from\": \"Admin\"}', 1, 'admin', '2026-07-08 07:45:21'),
(2, 'permission.granted', 'Role', 'Staff', '{\"permission\": \"finalize stock_opname\"}', 1, 'admin', '2026-07-08 07:45:46'),
(3, 'permission.revoked', 'Role', 'Staff', '{\"permission\": \"finalize stock_opname\"}', 1, 'admin', '2026-07-08 07:45:47'),
(4, 'permission.granted', 'Role', 'Staff', '{\"permission\": \"finalize stock_opname\"}', 1, 'admin', '2026-07-08 07:45:48'),
(5, 'permission.revoked', 'Role', 'Staff', '{\"permission\": \"finalize stock_opname\"}', 1, 'admin', '2026-07-08 07:45:49'),
(6, 'permission.revoked', 'Role', 'Staff', '{\"permission\": \"create stock_opname\"}', 1, 'admin', '2026-07-08 07:45:54'),
(7, 'permission.revoked', 'Role', 'Staff', '{\"permission\": \"view role_management\"}', 1, 'admin', '2026-07-08 07:46:01'),
(8, 'permission.revoked', 'Role', 'Staff', '{\"permission\": \"view user_management\"}', 1, 'admin', '2026-07-08 07:46:02'),
(9, 'role.updated', 'Role', 'Finance', '{\"to\": \"Finance\", \"from\": \"Staff\"}', 1, 'admin', '2026-07-08 07:46:07'),
(10, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"create barang\"}', 1, 'admin', '2026-07-08 08:09:11'),
(11, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"create barang\"}', 1, 'admin', '2026-07-08 08:09:11'),
(12, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:13:03'),
(13, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:13:04'),
(14, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:17:22'),
(15, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:17:22'),
(16, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:17:23'),
(17, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:17:25'),
(18, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:18:25'),
(19, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:18:26'),
(20, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:18:26'),
(21, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:18:28'),
(22, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:18:52'),
(23, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:18:52'),
(24, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:21:09'),
(25, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:21:09'),
(26, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:21:10'),
(27, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:21:11'),
(28, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"create barang\"}', 1, 'admin', '2026-07-08 08:25:15'),
(29, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"create barang\"}', 1, 'admin', '2026-07-08 08:25:18'),
(30, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view dashboard\"}', 1, 'admin', '2026-07-08 08:26:28'),
(31, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view dashboard\"}', 1, 'admin', '2026-07-08 08:26:30'),
(32, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"create master_reference\"}', 1, 'admin', '2026-07-08 08:28:29'),
(33, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"create master_reference\"}', 1, 'admin', '2026-07-08 08:28:31'),
(34, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"create master_reference\"}', 1, 'admin', '2026-07-08 08:28:32'),
(35, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"create master_reference\"}', 1, 'admin', '2026-07-08 08:28:32'),
(36, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view dashboard\"}', 1, 'admin', '2026-07-08 08:29:16'),
(37, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view dashboard\"}', 1, 'admin', '2026-07-08 08:29:17'),
(38, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:33:31'),
(39, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-08 08:33:31'),
(40, 'user.created', 'User', 'Finance', '{\"roles\": [\"Finance\"]}', 1, 'admin', '2026-07-08 08:53:05'),
(41, 'user.updated', 'User', 'Finance', '{\"roles_to\": [\"Finance\"], \"roles_from\": [\"Finance\"]}', 1, 'admin', '2026-07-08 08:53:20'),
(42, 'user.deleted', 'User', 'Finance', NULL, 1, 'admin', '2026-07-08 08:56:02'),
(43, 'role.created', 'Role', 'Teknisi', NULL, 1, 'admin', '2026-07-08 08:56:19'),
(44, 'role.deleted', 'Role', 'Teknisi', NULL, 1, 'admin', '2026-07-08 08:56:52'),
(45, 'user.created', 'User', 'test', '{\"roles\": [\"Finance\"]}', 1, 'admin', '2026-07-08 08:59:26'),
(46, 'role.deleted', 'Role', 'Admin Gudang', NULL, 1, 'admin', '2026-07-08 09:07:39'),
(47, 'user.deleted', 'User', 'test', NULL, 1, 'admin', '2026-07-08 09:12:17'),
(48, 'role.created', 'Role', 'Admin', NULL, 1, 'admin', '2026-07-08 09:13:47'),
(49, 'permission.revoked', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-09 07:06:53'),
(50, 'permission.granted', 'Role', 'Finance', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-09 07:06:53'),
(51, 'role.updated', 'Role', 'Finance', '{\"to\": \"Finance\", \"from\": \"Finance\"}', 1, 'admin', '2026-07-09 07:06:54'),
(52, 'role.updated', 'Role', 'Finance', '{\"to\": \"Finance\", \"from\": \"Finance\"}', 1, 'admin', '2026-07-09 07:24:16'),
(53, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"view dashboard\"}', 1, 'admin', '2026-07-09 08:14:26'),
(54, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-09 08:14:27'),
(55, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"create barang\"}', 1, 'admin', '2026-07-09 08:14:27'),
(56, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"update barang\"}', 1, 'admin', '2026-07-09 08:14:28'),
(57, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"delete barang\"}', 1, 'admin', '2026-07-09 08:14:28'),
(58, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"export barang\"}', 1, 'admin', '2026-07-09 08:14:28'),
(59, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"view activity_log\"}', 1, 'admin', '2026-07-09 08:14:31'),
(60, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"view stock_opname\"}', 1, 'admin', '2026-07-09 08:14:32'),
(61, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"create stock_opname\"}', 1, 'admin', '2026-07-09 08:14:32'),
(62, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"finalize stock_opname\"}', 1, 'admin', '2026-07-09 08:14:34'),
(63, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"delete stock_opname\"}', 1, 'admin', '2026-07-09 08:14:36'),
(64, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"view master_reference\"}', 1, 'admin', '2026-07-09 08:14:38'),
(65, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"create master_reference\"}', 1, 'admin', '2026-07-09 08:14:39'),
(66, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"update master_reference\"}', 1, 'admin', '2026-07-09 08:14:39'),
(67, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"delete master_reference\"}', 1, 'admin', '2026-07-09 08:14:40'),
(68, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"view user_management\"}', 1, 'admin', '2026-07-09 08:14:42'),
(69, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"create user_management\"}', 1, 'admin', '2026-07-09 08:14:42'),
(70, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"update user_management\"}', 1, 'admin', '2026-07-09 08:14:42'),
(71, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"delete user_management\"}', 1, 'admin', '2026-07-09 08:14:42'),
(72, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"delete role_management\"}', 1, 'admin', '2026-07-09 08:14:43'),
(73, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"update role_management\"}', 1, 'admin', '2026-07-09 08:14:43'),
(74, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"create role_management\"}', 1, 'admin', '2026-07-09 08:14:43'),
(75, 'permission.granted', 'Role', 'Admin', '{\"permission\": \"view role_management\"}', 1, 'admin', '2026-07-09 08:14:44'),
(76, 'role.updated', 'Role', 'Admin Gudang', '{\"to\": \"Admin Gudang\", \"from\": \"Admin\"}', 1, 'admin', '2026-07-09 08:14:50'),
(77, 'role.created', 'Role', 'Owner', NULL, 1, 'admin', '2026-07-09 08:15:01'),
(78, 'permission.granted', 'Role', 'Owner', '{\"permission\": \"view dashboard\"}', 1, 'admin', '2026-07-09 08:15:05'),
(79, 'permission.granted', 'Role', 'Owner', '{\"permission\": \"view barang\"}', 1, 'admin', '2026-07-09 08:15:07'),
(80, 'permission.granted', 'Role', 'Owner', '{\"permission\": \"view activity_log\"}', 1, 'admin', '2026-07-09 08:15:11'),
(81, 'permission.granted', 'Role', 'Owner', '{\"permission\": \"view stock_opname\"}', 1, 'admin', '2026-07-09 08:15:14'),
(82, 'permission.granted', 'Role', 'Owner', '{\"permission\": \"view master_reference\"}', 1, 'admin', '2026-07-09 08:15:14'),
(83, 'permission.granted', 'Role', 'Owner', '{\"permission\": \"view user_management\"}', 1, 'admin', '2026-07-09 08:15:15'),
(84, 'permission.granted', 'Role', 'Owner', '{\"permission\": \"view role_management\"}', 1, 'admin', '2026-07-09 08:15:15'),
(85, 'permission.revoked', 'Role', 'Owner', '{\"permission\": \"view role_management\"}', 1, 'admin', '2026-07-09 08:15:17'),
(86, 'permission.revoked', 'Role', 'Owner', '{\"permission\": \"view user_management\"}', 1, 'admin', '2026-07-09 08:15:17'),
(87, 'role.updated', 'Role', 'Owner', '{\"to\": \"Owner\", \"from\": \"Owner\"}', 1, 'admin', '2026-07-09 08:15:28'),
(88, 'permission.revoked', 'Role', 'Admin Gudang', '{\"permission\": \"view role_management\"}', 1, 'admin', '2026-07-09 08:15:33'),
(89, 'permission.revoked', 'Role', 'Admin Gudang', '{\"permission\": \"view user_management\"}', 1, 'admin', '2026-07-09 08:15:34'),
(90, 'permission.revoked', 'Role', 'Admin Gudang', '{\"permission\": \"create user_management\"}', 1, 'admin', '2026-07-09 08:15:35'),
(91, 'permission.revoked', 'Role', 'Admin Gudang', '{\"permission\": \"create role_management\"}', 1, 'admin', '2026-07-09 08:15:35'),
(92, 'permission.revoked', 'Role', 'Admin Gudang', '{\"permission\": \"update user_management\"}', 1, 'admin', '2026-07-09 08:15:36'),
(93, 'permission.revoked', 'Role', 'Admin Gudang', '{\"permission\": \"update role_management\"}', 1, 'admin', '2026-07-09 08:15:36'),
(94, 'permission.revoked', 'Role', 'Admin Gudang', '{\"permission\": \"delete user_management\"}', 1, 'admin', '2026-07-09 08:15:37'),
(95, 'permission.revoked', 'Role', 'Admin Gudang', '{\"permission\": \"delete role_management\"}', 1, 'admin', '2026-07-09 08:15:37'),
(96, 'role.updated', 'Role', 'Admin Gudang', '{\"to\": \"Admin Gudang\", \"from\": \"Admin Gudang\"}', 1, 'admin', '2026-07-09 08:15:42'),
(97, 'user.created', 'User', 'Syaifuddin', '{\"roles\": [\"Admin Gudang\"]}', 1, 'admin', '2026-07-09 09:56:04'),
(98, 'user.created', 'User', 'Aldila', '{\"roles\": [\"Finance\"]}', 1, 'admin', '2026-07-09 09:57:41'),
(99, 'user.created', 'User', 'Eca', '{\"roles\": [\"Finance\"]}', 1, 'admin', '2026-07-09 09:58:16'),
(100, 'user.updated', 'User', 'Syaifuddin', '{\"roles_to\": [\"Admin Gudang\"], \"roles_from\": [\"Admin Gudang\"]}', 1, 'admin', '2026-07-09 09:59:06'),
(101, 'user.updated', 'User', 'Syaifuddin', '{\"roles_to\": [\"Admin Gudang\"], \"roles_from\": [\"Admin Gudang\"]}', 1, 'admin', '2026-07-09 09:59:29'),
(102, 'user.created', 'User', 'Dimas', '{\"roles\": [\"Owner\"]}', 1, 'admin', '2026-07-09 10:00:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2026-07-08 04:23:49', '2026-07-08 04:23:49'),
(3, 'Finance', 'web', '2026-07-08 04:23:49', '2026-07-08 07:46:07'),
(5, 'Admin Gudang', 'web', '2026-07-08 09:13:47', '2026-07-09 08:14:50'),
(6, 'Owner', 'web', '2026-07-09 08:15:01', '2026-07-09 08:15:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 3),
(2, 3),
(6, 3),
(7, 3),
(8, 3),
(12, 3),
(1, 5),
(2, 5),
(3, 5),
(4, 5),
(5, 5),
(6, 5),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(11, 5),
(12, 5),
(13, 5),
(14, 5),
(15, 5),
(1, 6),
(2, 6),
(7, 6),
(8, 6),
(12, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1ro06VNAQIg7DL1isYRrqHPjNYOZFztbzN177BAt', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUkVUMU1nQURNNEtPU3hwV3FYWTFqVnVlUnA4a01SdTV5aHNUV2RVSCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785220955),
('5Cp8HosTHc71g4UqpKLfa1WnsRLTk06zS23b5FkG', NULL, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUGRONTFVMmxWaUVzZ3V6NDFOZ09renMxNDZoU1NmR0hUSmhRMVN4OCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785137959),
('6PtkjZXu45Jo5k7BfaPPpGWIceCfYHnUoLJSPvPw', NULL, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVBnb0piOGR2Ym1pQjVOSXpqdFhrOXdrTFo1OVEyN3VudmlHd1RXNyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9fQ==', 1784452834),
('a3UuOraBKQ5iWPPmEvvQ6bB8PPcUFbt4Exyiu4yJ', NULL, '36.89.203.58', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibVZVNThPUGE0cmk5eGdNZkQ5cmpnZ1p2Sng5eG5LTjRUSU9VUkFCMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1784866880),
('bHrAT6YhdyxthCRTfQ06WVWBjqlQoVrdjvVn6tHC', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWkROM1M2em9IZFJCbG56aWs5b1FXNU50TktWN2I0YzhCMDM5SXJYViI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785221889),
('bkgf5Yod7X9q7mhyXXWVRk6ORAjxwOrqdeJmeZYv', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRVlrVE5CY25OS1hSQmtYS2JhYUF6QW16bTRrQVBranR0a0RZR3VYNyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1785214951),
('BOywuROI284MTcEMv4nhh4qoTISpJGzd41ot6kJt', NULL, '114.124.211.100', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicHhOYk1FNmUyaHBycmdFNHNUSThPejJSRHhLTE16S2l0QTRnTW03VyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785218270),
('chjNRrIU1JJRqpWPPLenVmyUrYBFVwequ1e63dbT', NULL, '114.124.211.100', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibHFSVEd6VVcwTldQemNWTThXa01qcThGNzlJWXRIT3doSVhMZmxuMyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785218274),
('DCNN2WeMQlOXXKtPrEkgI8VLZceHfxTESW8VaKyl', 1, '103.217.217.74', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZDQzaVpwY0ZVMjdKODVhRVYxMk5sV21XdmhhRVkxS2ZPUUN3VzBYciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NTE6Imh0dHBzOi8vaW52ZW50b3J5LnphaGRpa2FmYWhyaXphLndlYi5pZC9iYXJhbmdzLzEyMSI7czo1OiJyb3V0ZSI7czoxMjoiYmFyYW5ncy5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1784556867),
('EFoirxr55mXon2sH71zHdl3adzdLlAlYqWIPugnG', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSUhaVkluTUxRZE1zUHRjUlZZMVdlcWZNYVg2cHc0SGQ2SjJhV2lVOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1785215726),
('emaQVOH2BGyaKxUttmXnvxCSFTjALhahe6ksatdQ', NULL, '114.124.211.100', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2M4QUtmdU9vTTRKcXB4U2t4VG1DZ2tYM2FBa0t3d1V2Q2NkNER5QyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjY6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0IjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1785218263),
('GklcA6jKSVlh25dVFmV5w1zQYncwXimFzC0sfWNU', NULL, '172.18.0.1', 'curl/8.5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZDhRUWpGNkg3dmwzM1U5SktsWmJ2OFFXY3I5ekdXYlVSWGtVOGRlNSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785223026),
('j8GCKdoPBfq23rQBunjQWq3NZievIeH9dTkBp2H2', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZm5MVVVpNFZhbERDYTVkc2ZyMmRaanhRR3JBZ3EwbzFMcXliRmtIbCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785221557),
('JdOgP99txdcHLiUJNs55jJt4vnvj7R8Leg39t9rt', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiOWdyZ201RWVSMVZ6cXFKeGxKMUxQbEk3UWdxSVBkaUhVUWNVNWdZVSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785222884),
('jgh87Me05CLxRRuQrbt9DUSZc4sq0hhNmu9ucZOQ', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNnBDQWwwOGExZUJnWVpPRWV6RkJwSUx6VDFmaGdZQ3ZXVmxZNmZzYSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785222146),
('k2za5C7ei1tw6Ruex8wJlfp0dEVUsf3XOvMsdkFM', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVGs5NzJJNlZsblR1anUySjZweWZnN3BobzRUdloxM3pEMHRwd0ZoWCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785223153),
('LGZarSFjOL9T33B2AfiozCg3pzOfLQJnJXiBS64h', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiV2FYZGNGdTVQZDVYbmNpUEh1TnFNV2VqUkJGMGx1bDY2U2ZqT1hIayI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785221835),
('M9gBbNqkMmwwV4SOei069fQ6VVkd2QpQVGaLdu5t', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiN1duNVJvcVNzdHZneHNBcGhiQm0yN1dWWFVOV0ZxZVVjM2lTakhPMSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785216000),
('OQLIvvJExm8WrVSale8AQ3hqCLyQhI69DGE608ca', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMWRqOEZYc2lkcloyOGJUTldDUDZJRWlKcWQ2YjNVYzVyZERXQUwwSCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785222044),
('qlB7NZxf0jWKvJb9Vjfoeo5Fm5Hr466z6DgFSYbx', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNGdieFkzc2h1SEZKb2pUUTF3UXJBNzFIY3ByZzlEaEVZTUVmeW9DNyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785221981),
('qOigRzYDhXr5RN5rnJNUsWbfvkXk8hMWsL0JTkS5', 1, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNFc0VGNBNWVBYWZuckNUWUs0Q1RsNWEzMHpMOTJRWnNyMjFJWklmTSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjMyOiJodHRwczovL25pc2EuZGlzYWNsb3VkLm5ldC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785220572),
('S7F9vJvasmMq1LMfeU7EQRwucpDvv7U71w0kneLL', NULL, '172.18.0.1', 'curl/8.5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZmRPYUhvUnVTbDg5aXlQcDdEYm00ck8xM2dEWUZadFpjcGh0dWhQRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785223152),
('sSV8ZQ583EFW2HUyBqHRKJbOBPWLeyoRouW9pB5O', 1, '172.31.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTFJPdDZVOElic08yMlE5VnpFZWhKbHVqWFNGb2hDbVMzYmpuTGFlOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMC43My43My40OjgwMDAvZGFzaGJvYXJkIjtzOjU6InJvdXRlIjtzOjk6ImRhc2hib2FyZCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1785223153),
('Svvlb7dE8fX9LZY2SGMFUGRQBbGjaoIQGN3BLCbC', NULL, '114.124.211.100', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY0Z2Vm9PZGIxdFM1YmFWMWpWdkdaSzVwYnBBQ1ltOUhpZWc0dzBjYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1785223325),
('tkGVaFluKvMDG5byq1DC2pVu9H55ZK0xKgnuiLEN', NULL, '103.120.168.252', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNm52WVlrTkhXNVpUV3NOeFN0ZkQ0VmhLQ1FON2NmNnVDblNrYTd4ViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1784872093),
('wAM2X4bwc3kuC1v1QMqmGdIgUZnnums9mRafS6ZM', NULL, '172.18.0.1', 'curl/8.5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidVdxMmRUanJIVlJrSVpPYmZqYWpNeWJ3djZLTEg5ZXZMdzZJWHl5TiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785223275),
('wqLdDv4mG4pebnq5btedT6c1eTKaZz1oAN3DexTq', NULL, '172.18.0.1', 'curl/8.5.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidE1IUE1XN2NCeUVIaGd4a1pFQUJVZHU3UHJrMnUzdUdwVWNtU2VBbyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1785222642),
('X7TeZsNxWejSF7olV9UnNBH5Y4KPgExWSVsnAtQF', NULL, '103.116.13.228', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGxockNMV05GcEswMzNMNk9kdFgwM0FvcERrSk5ua3dJTE55NXVJOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHBzOi8vbmlzYS5kaXNhY2xvdWQubmV0L2xvZ2luIjtzOjU6InJvdXRlIjtzOjU6ImxvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1784866884);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname_items`
--

CREATE TABLE `stock_opname_items` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `kode_aset` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_aset` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stok_bulan_lalu` int DEFAULT NULL,
  `stok_sistem` int NOT NULL,
  `stok_so` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_opname_items`
--

INSERT INTO `stock_opname_items` (`id`, `session_id`, `barang_id`, `kode_aset`, `nama_aset`, `stok_bulan_lalu`, `stok_sistem`, `stok_so`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'A001', 'LAN Tester', NULL, 8, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(2, 1, 4, 'A002', 'LAN Stripper', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(3, 1, 5, 'A003', 'LAN Tracker', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(4, 1, 6, 'A004', 'LAN Cleaver', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(5, 1, 7, 'A005', 'OPM (Optical Power Meter)', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(6, 1, 8, 'A006', 'OTDR (Optical Time Domain Reflectometer)', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(7, 1, 9, 'A007', 'OTP (Optical Termination Point)', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(8, 1, 10, 'A008', 'Slitter Patchcore', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(9, 1, 11, 'A009', 'FO Cleaver (Cleaver untuk FO)', NULL, 5, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(10, 1, 12, 'A010', 'FO Slitter', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(11, 1, 13, 'A011', 'FO Stripper', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(12, 1, 14, 'A012', 'Laser Pointer', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(13, 1, 15, 'A013', 'Senter FO', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(14, 1, 16, 'A014', 'Splicer FO', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(15, 1, 17, 'A015', 'Tang Crimping', NULL, 16, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(16, 1, 18, 'A016', 'Tang Potong', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(17, 1, 19, 'A017', 'Tang Kombinasi', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(18, 1, 20, 'A018', 'Tang Pipih', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(19, 1, 21, 'A019', 'Tang Stripper Kabel Dropcore', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(20, 1, 22, 'A020', 'Print Label', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(21, 1, 23, 'A021', 'Wire Management', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(22, 1, 24, 'A022', 'Trackper Kabel', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(23, 1, 25, 'A023', 'Pengupas KU', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(24, 1, 26, 'A024', 'Cable Comb (Sisir Kabel)', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(25, 1, 27, 'A025', 'Tangga Lipat Telescopic', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(26, 1, 28, 'A026', 'Tangga 2 Meter', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(27, 1, 29, 'A027', 'Tangga 3 Meter', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(28, 1, 30, 'A028', 'Tangga 5 Meter', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(29, 1, 31, 'A029', 'Tangga Kuning Besar', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(30, 1, 32, 'A030', 'Tangga Steger', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(31, 1, 33, 'A031', 'Bor Drill Besar', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(32, 1, 34, 'A032', 'Bor Listrik', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(33, 1, 35, 'A033', 'Bor Battery', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(34, 1, 36, 'A034', 'Battery Bor', NULL, 9, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(35, 1, 37, 'A035', 'Charger Bor', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(36, 1, 38, 'A036', 'Gerinda', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(37, 1, 39, 'A037', 'Mata Gerinda', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(38, 1, 40, 'A038', 'Palu', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(39, 1, 41, 'A039', 'Gergaji Besi', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(40, 1, 42, 'A040', 'Kape', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(41, 1, 43, 'A041', 'Pahat', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(42, 1, 44, 'A042', 'Sendok Semen', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(43, 1, 45, 'A043', 'Mesin Gergaji Kayu', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(44, 1, 46, 'A044', 'Expansion Bolt Extracting Gun', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(45, 1, 47, 'A045', 'Meteran (Alat Ukur Meteran)', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(46, 1, 48, 'A046', 'Ramset (Alat Tembak)', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(47, 1, 49, 'A047', 'Staples Besar', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(48, 1, 50, 'A048', 'Cutter', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(49, 1, 51, 'A049', 'Gunting Plat', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(50, 1, 52, 'A050', 'Gunting Pipa', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(51, 1, 53, 'A051', 'Obeng', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(52, 1, 54, 'A052', 'Sealent', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(53, 1, 55, 'A053', 'Kunci pas 9 mm', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(54, 1, 56, 'A054', 'Kunci pas 10 mm', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(55, 1, 57, 'A055', 'Kunci pas 11 mm', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(56, 1, 58, 'A056', 'Kunci pas 12 mm', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(57, 1, 59, 'A057', 'Kunci pas 13 mm', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(58, 1, 60, 'A058', 'Kunci pas 14 mm', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(59, 1, 61, 'A059', 'Kunci pas 19 mm', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(60, 1, 62, 'A060', 'Body Harmess', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(61, 1, 63, 'A061', 'Rompi', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(62, 1, 64, 'A062', 'Helm Proyek', NULL, 8, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(63, 1, 65, 'A063', 'Kacamata', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(64, 1, 66, 'A064', 'Headlamp (Senter Kepala)', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(65, 1, 67, 'A065', 'HT', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(66, 1, 68, 'A066', 'Charger HT', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(67, 1, 69, 'A067', 'Lampu Mikolite LED', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(68, 1, 70, 'A068', 'Antena', NULL, 14, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(69, 1, 71, 'A069', 'Charger Laptop', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(70, 1, 72, 'A070', 'Steker T', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(71, 1, 73, 'A071', 'Senter LED (Model Tempel)', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(72, 1, 74, 'A072', 'Jas Hujan', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(73, 1, 75, 'A073', 'Click Cleaner', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(74, 1, 76, 'A074', 'Wire Stripper', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(75, 1, 77, 'A075', 'Gunting Baja', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(76, 1, 78, 'A076', 'Kunci T 14mm', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(77, 1, 79, 'B001', 'Kabel LAN', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(78, 1, 80, 'B002', 'Kabel LAN', NULL, 91, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(79, 1, 81, 'B003', 'Kabel Precon', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(80, 1, 82, 'B004', 'Kabel Precon', NULL, 38, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(81, 1, 83, 'B005', 'Kabel Precon', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(82, 1, 84, 'B006', 'Kabel Precon', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(83, 1, 85, 'B007', 'Kabel Dropcore', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(84, 1, 86, 'B009', 'Kabel Patchcord', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(85, 1, 87, 'B010', 'Kabel Patchcord', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(86, 1, 88, 'B011', 'Kabel Patchcord', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(87, 1, 89, 'B012', 'Kabel Patchcord', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(88, 1, 90, 'B013', 'Kabel Patchcord', NULL, 17, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(89, 1, 91, 'B014', 'Kabel Patchcord', NULL, 19, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(90, 1, 92, 'B015', 'Kabel Patchcord', NULL, 7, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(91, 1, 93, 'B016', 'Kabel PoE', NULL, 9, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(92, 1, 94, 'B017', 'Pigtail', NULL, 20, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(93, 1, 95, 'B018', 'Pigtail', NULL, 12, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(94, 1, 96, 'B019', 'Pigtail', NULL, 10, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(95, 1, 97, 'B020', 'Pigtail', NULL, 220, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(96, 1, 98, 'B021', 'Kabel Power', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(97, 1, 99, 'B022', 'Kabel Power', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(98, 1, 100, 'B023', 'HTB (Side A dan Side B)', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(99, 1, 101, 'B024', 'ODP Baru (Box)', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(100, 1, 102, 'B025', 'PLC Splitter', NULL, 10, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(101, 1, 103, 'B026', 'PLC Splitter', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(102, 1, 104, 'B027', 'PLC Splitter', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(103, 1, 105, 'B028', 'Splitter box', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(104, 1, 106, 'B029', 'Splitter box', NULL, 5, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(105, 1, 107, 'B030', 'Roset', NULL, 14, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(106, 1, 108, 'B031', 'Roset', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(107, 1, 109, 'B032', 'Ring ODP', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(108, 1, 110, 'B033', 'Ring ODP', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(109, 1, 111, 'B034', 'Konektor SC', NULL, 263, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(110, 1, 112, 'B035', 'Konektor SC', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(111, 1, 113, 'B036', 'Protect Sleeve', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(112, 1, 114, 'B037', 'Protect Sleeve', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(113, 1, 115, 'B038', 'Switch', NULL, 15, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(114, 1, 116, 'B039', 'Barel', NULL, 198, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(115, 1, 117, 'B040', 'PoE (Power of Ethernet)', NULL, 20, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(116, 1, 118, 'B041', 'RJ45', NULL, 70, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(117, 1, 119, 'B042', 'RJ45', NULL, 129, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(118, 1, 120, 'B043', 'Panduit', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(119, 1, 121, 'B044', 'Modem Baru', NULL, 29, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(120, 1, 122, 'B045', 'Modem Baru', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(121, 1, 123, 'B046', 'Solasi Kertas', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(122, 1, 124, 'B047', 'Kabel Ties', NULL, 10, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(123, 1, 125, 'B048', 'Kabel Ties', NULL, 21, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(124, 1, 126, 'B049', 'Battery', NULL, 10, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(125, 1, 127, 'B050', 'Battery', NULL, 20, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(126, 1, 128, 'B051', 'Battery', NULL, 14, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(127, 1, 129, 'B052', 'Solasi', NULL, 10, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(128, 1, 130, 'B053', 'Solasi', NULL, 8, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(129, 1, 131, 'B054', 'Solasi', NULL, 47, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(130, 1, 132, 'B055', 'Selongsong Bakar (Solasi Bakar)', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(131, 1, 133, 'B056', 'Kertas Print Label', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(132, 1, 134, 'B057', 'Kertas Print Label', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(133, 1, 135, 'B058', 'Isi Cutter', NULL, 7, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(134, 1, 136, 'B059', 'Faceplate', NULL, 19, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(135, 1, 137, 'B060', 'Faceplate', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(136, 1, 138, 'B061', 'Faceplate', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(137, 1, 139, 'B062', 'Faceplate', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(138, 1, 140, 'B063', 'Plugboot LAN', NULL, 213, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(139, 1, 141, 'B064', 'Elbow Conduit', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(140, 1, 142, 'B065', 'Velcro Tape', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(141, 1, 143, 'B066', 'Shock Socket', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(142, 1, 144, 'B067', 'Shock Pipa PVC', NULL, 79, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(143, 1, 145, 'B068', 'Shock Drat Luar PVC', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(144, 1, 146, 'B069', 'Modular', NULL, 17, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(145, 1, 147, 'B070', 'Klem Pipa Conduit', NULL, 11, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(146, 1, 148, 'B071', 'Paku Klem', NULL, 51, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(147, 1, 149, 'B072', 'Terminal Kabel', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(148, 1, 150, 'B073', 'Paku Roofing', NULL, 100, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(149, 1, 151, 'B074', 'Alkohol 70%', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(150, 1, 152, 'B075', 'Lampu', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(151, 1, 153, 'B076', 'Kabel Dropcore', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(152, 1, 154, 'B077', 'ODP Baru (Box)', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(153, 1, 155, 'B078', 'Kabel Patchcord', NULL, 33, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(154, 1, 156, 'B079', 'Kabel Patchcord', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(155, 1, 157, 'B080', 'Kabel Patchcord', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(156, 1, 158, 'B081', 'Pigtail', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(157, 1, 159, 'B082', 'Lakban', NULL, 5, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(158, 1, 160, 'B083', 'Konektor LC', NULL, 7, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(159, 1, 161, 'B084', 'Modem Second', NULL, 17, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(160, 1, 162, 'B085', 'Modem Second', NULL, 8, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(161, 1, 163, 'B086', 'Modem Second', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(162, 1, 164, 'B087', 'Modem Second', NULL, 10, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(163, 1, 165, 'B088', 'Modem Second', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(164, 1, 166, 'B089', 'ODP Second (Box)', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(165, 1, 167, 'B090', 'Fast Connector', NULL, 10, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(166, 1, 168, 'B091', 'Soc Connector', NULL, 278, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(167, 1, 169, 'B092', 'Splitter box', NULL, 5, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(168, 1, 170, 'B093', 'PLC Splitter', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(169, 1, 171, 'B094', 'OTP (Optical Termination Point) FO', NULL, 19, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(170, 1, 172, 'B095', 'Marker Ties (Label Ties)', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(171, 1, 173, 'B096', 'Duradus', NULL, 2, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(172, 1, 174, 'B097', 'Duradus', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(173, 1, 175, 'B098', 'T Dus', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(174, 1, 176, 'B099', 'T Dus', NULL, 13, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(175, 1, 177, 'B100', 'Shock Conduit', NULL, 220, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(176, 1, 178, 'B101', 'Alcohol Swab', NULL, 1, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(177, 1, 179, 'B102', 'Modem Second', NULL, 9, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(178, 1, 180, 'B103', 'Klem Kuping', NULL, 11, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(179, 1, 181, 'B104', 'Closure Case ( No Kaset )', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(180, 1, 182, 'B105', 'Kabel Dropcore', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(181, 1, 183, 'B106', 'ODP Baru (Box)', NULL, 0, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(182, 1, 184, 'B107', 'Modem Baru', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(183, 1, 185, 'B108', 'Modem Second', NULL, 6, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(184, 1, 186, 'B109', 'Kabel Patchcord hitam', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(185, 1, 187, 'B110', 'Mini closure', NULL, 4, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15'),
(186, 1, 188, 'B111', 'Terminal Kabel', NULL, 3, NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname_sessions`
--

CREATE TABLE `stock_opname_sessions` (
  `id` bigint UNSIGNED NOT NULL,
  `kode_so` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','finalized') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `created_by_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finalized_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_opname_sessions`
--

INSERT INTO `stock_opname_sessions` (`id`, `kode_so`, `status`, `catatan`, `created_by`, `created_by_name`, `finalized_at`, `created_at`, `updated_at`) VALUES
(1, 'SO-20260707-001', 'draft', NULL, 1, 'admin', NULL, '2026-07-07 03:53:15', '2026-07-07 03:53:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, '$2y$12$Yw2fITjzR0wr4y1zKpspre611owZNSEo5Q8StJUpoLtdL5S6FG6Gi', NULL, '2026-07-01 05:51:24', '2026-07-01 05:51:24'),
(4, 'Syaifuddin', 'sai', 'sai@gmail.com', NULL, '$2y$12$ywQDNkGk1KtRj.PYtditHOn.Y7u2hPj5hoCVJLG52.ReDOW8C5wRa', NULL, '2026-07-09 09:56:04', '2026-07-09 09:59:29'),
(5, 'Aldila', 'aldila', 'aldila@gmail.com', NULL, '$2y$12$2hm9w5Si8drqIEKNvoS4.OZHBSkS/oV/BsuSN2am5pPbozh/dW3ju', NULL, '2026-07-09 09:57:41', '2026-07-09 09:57:41'),
(6, 'Eca', 'eca', 'eca@gmail.com', NULL, '$2y$12$fSQ7ahfBtqQZC4LIhBZfyulYImMQrObd.h9CHr4zwdLOmLC/6fT22', NULL, '2026-07-09 09:58:16', '2026-07-09 09:58:16'),
(7, 'Dimas', 'dimas', 'dimas@gmail.com', NULL, '$2y$12$8kxQ9Jp5G7kJeCuaPLMv8OGZVKn4./3O5sHBt3Z5RXM2gzia.Peiq', NULL, '2026-07-09 10:00:01', '2026-07-09 10:00:01');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `activity_logs_n8n_event_id_unique` (`n8n_event_id`),
  ADD KEY `activity_logs_loggable_type_loggable_id_index` (`loggable_type`,`loggable_id`),
  ADD KEY `activity_logs_source_index` (`source`),
  ADD KEY `activity_logs_created_at_index` (`created_at`),
  ADD KEY `activity_logs_actor_name_index` (`actor_name`);

--
-- Indeks untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_aset` (`kode_aset`),
  ADD KEY `barangs_nama_aset_index` (`nama_aset`),
  ADD KEY `barangs_kategori_index` (`kategori`),
  ADD KEY `barangs_lokasi_index` (`lokasi`),
  ADD KEY `fk_barangs_kategori` (`kategori_id`),
  ADD KEY `fk_barangs_sub_kategori` (`sub_kategori_id`),
  ADD KEY `fk_barangs_merk` (`merk_id`),
  ADD KEY `fk_barangs_satuan` (`satuan_id`),
  ADD KEY `fk_barangs_kondisi` (`kondisi_id`),
  ADD KEY `fk_barangs_lokasi` (`lokasi_id`),
  ADD KEY `fk_barangs_tipe_spek` (`tipe_spek_id`),
  ADD KEY `fk_barangs_status` (`status_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_kategori`
--
ALTER TABLE `master_kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_kategori_nama_unique` (`nama`);

--
-- Indeks untuk tabel `master_kondisi`
--
ALTER TABLE `master_kondisi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_kondisi_nama_unique` (`nama`);

--
-- Indeks untuk tabel `master_lokasi`
--
ALTER TABLE `master_lokasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_lokasi_nama_unique` (`nama`);

--
-- Indeks untuk tabel `master_merk`
--
ALTER TABLE `master_merk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_merk_nama_unique` (`nama`);

--
-- Indeks untuk tabel `master_satuan`
--
ALTER TABLE `master_satuan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_satuan_nama_unique` (`nama`);

--
-- Indeks untuk tabel `master_status`
--
ALTER TABLE `master_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_status_nama_unique` (`nama`);

--
-- Indeks untuk tabel `master_sub_kategori`
--
ALTER TABLE `master_sub_kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_sub_kategori_nama_unique` (`nama`);

--
-- Indeks untuk tabel `master_tipe_spek`
--
ALTER TABLE `master_tipe_spek`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `master_tipe_spek_nama_unique` (`nama`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `rbac_audit_logs`
--
ALTER TABLE `rbac_audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rbac_audit_logs_action_index` (`action`),
  ADD KEY `rbac_audit_logs_created_at_index` (`created_at`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `stock_opname_items`
--
ALTER TABLE `stock_opname_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_opname_items_session_id_foreign` (`session_id`);

--
-- Indeks untuk tabel `stock_opname_sessions`
--
ALTER TABLE `stock_opname_sessions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_opname_sessions_kode_so_unique` (`kode_so`),
  ADD KEY `stock_opname_sessions_status_index` (`status`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT untuk tabel `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `master_kategori`
--
ALTER TABLE `master_kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `master_kondisi`
--
ALTER TABLE `master_kondisi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `master_lokasi`
--
ALTER TABLE `master_lokasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `master_merk`
--
ALTER TABLE `master_merk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `master_satuan`
--
ALTER TABLE `master_satuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `master_status`
--
ALTER TABLE `master_status`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `master_sub_kategori`
--
ALTER TABLE `master_sub_kategori`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `master_tipe_spek`
--
ALTER TABLE `master_tipe_spek`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `rbac_audit_logs`
--
ALTER TABLE `rbac_audit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `stock_opname_items`
--
ALTER TABLE `stock_opname_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=745;

--
-- AUTO_INCREMENT untuk tabel `stock_opname_sessions`
--
ALTER TABLE `stock_opname_sessions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barangs`
--
ALTER TABLE `barangs`
  ADD CONSTRAINT `fk_barangs_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `master_kategori` (`id`),
  ADD CONSTRAINT `fk_barangs_kondisi` FOREIGN KEY (`kondisi_id`) REFERENCES `master_kondisi` (`id`),
  ADD CONSTRAINT `fk_barangs_lokasi` FOREIGN KEY (`lokasi_id`) REFERENCES `master_lokasi` (`id`),
  ADD CONSTRAINT `fk_barangs_merk` FOREIGN KEY (`merk_id`) REFERENCES `master_merk` (`id`),
  ADD CONSTRAINT `fk_barangs_satuan` FOREIGN KEY (`satuan_id`) REFERENCES `master_satuan` (`id`),
  ADD CONSTRAINT `fk_barangs_status` FOREIGN KEY (`status_id`) REFERENCES `master_status` (`id`),
  ADD CONSTRAINT `fk_barangs_sub_kategori` FOREIGN KEY (`sub_kategori_id`) REFERENCES `master_sub_kategori` (`id`),
  ADD CONSTRAINT `fk_barangs_tipe_spek` FOREIGN KEY (`tipe_spek_id`) REFERENCES `master_tipe_spek` (`id`);

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_opname_items`
--
ALTER TABLE `stock_opname_items`
  ADD CONSTRAINT `stock_opname_items_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `stock_opname_sessions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

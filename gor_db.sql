-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Mar 2025 pada 03.26
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gor`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(150) NOT NULL,
  `satuan` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL,
  `status_aktif` int(11) NOT NULL COMMENT '0=tidak aktif, 1=aktif',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `satuan`, `stok`, `status_aktif`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
('BLF', 'Bola Futsal', 'Pcs', 10, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
('NET', 'Net', 'Pcs', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
('SK', 'Shuttlecock', 'Pcs', 50, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `check_in_out`
--

CREATE TABLE `check_in_out` (
  `id` int(11) NOT NULL,
  `kodeMember` varchar(100) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `no_telepon` varchar(50) DEFAULT NULL,
  `checkIn` datetime DEFAULT NULL,
  `checkOut` datetime DEFAULT NULL,
  `user_create` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `check_in_out`
--

INSERT INTO `check_in_out` (`id`, `kodeMember`, `nama`, `no_telepon`, `checkIn`, `checkOut`, `user_create`, `created_at`) VALUES
(3, 'MBR0001', 'buya', '082123123', '2024-11-11 16:05:00', '2024-11-11 16:10:00', NULL, NULL),
(4, 'MBR0001', 'Yono', '082123123', '2024-11-11 17:07:00', '2024-11-18 18:39:00', NULL, NULL),
(5, 'MBR0003', 'Bambang', '085640777777', '2024-11-13 08:52:00', '2024-11-18 18:39:00', NULL, NULL),
(6, 'MBR0001', 'Yono', '082123123', '2024-11-13 08:53:00', '2024-11-13 10:53:00', NULL, NULL),
(7, 'MBR0001', 'Yono', '082123123', '2024-11-15 10:07:00', '2024-11-18 18:39:00', NULL, NULL),
(8, 'MBR0001', 'Yono', '082123123', '2024-11-15 11:07:00', '2024-11-18 18:40:00', NULL, NULL),
(9, 'MBR0003', 'Bambang', '085640777777', '2024-11-18 18:40:00', '2024-12-02 10:55:00', NULL, NULL),
(10, 'MBR0001', 'Yono', '082123123', '2024-11-26 08:14:00', '2024-12-02 10:55:00', NULL, NULL),
(11, 'MBR0002', 'Yani', '1023823', '2024-11-26 08:20:00', '2024-12-02 10:55:00', NULL, NULL),
(13, 'MBR0003', 'Bambang', '085640777777', '2024-12-02 10:59:00', NULL, NULL, NULL),
(14, 'MBR0001', 'Yono', '082123123', '2024-12-02 00:59:00', NULL, NULL, NULL),
(15, 'MBR0002', 'Yani', '1023823', '2025-01-03 12:42:00', NULL, NULL, NULL),
(16, 'MBR0004', 'iqbal', '0829891822', '2025-01-09 14:28:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hak_akses`
--

CREATE TABLE `hak_akses` (
  `id` int(11) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `akses_create` varchar(10) DEFAULT NULL,
  `akses_read` varchar(10) DEFAULT NULL,
  `akses_update` varchar(10) DEFAULT NULL,
  `akses_delete` varchar(10) DEFAULT NULL,
  `akses_cetak` varchar(10) DEFAULT NULL,
  `menu_master` varchar(10) DEFAULT NULL,
  `menu_pengguna` varchar(10) NOT NULL,
  `menu_operasional` varchar(10) NOT NULL,
  `menu_akuntansi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `hak_akses`, `akses_create`, `akses_read`, `akses_update`, `akses_delete`, `akses_cetak`, `menu_master`, `menu_pengguna`, `menu_operasional`, `menu_akuntansi`) VALUES
(1, 'Administrator', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif'),
(3, 'Staff', 'Aktif', 'Aktif', 'Aktif', 'Aktif', NULL, 'Aktif', 'Non Aktif', 'Aktif', 'Non Aktif'),
(4, 'Pemilik', 'Aktif', 'Aktif', 'Aktif', 'Aktif', NULL, 'Non Aktif', 'Non Aktif', 'Non Aktif', 'Aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_sesi`
--

CREATE TABLE `jadwal_sesi` (
  `id_jadwal_sesi` int(11) NOT NULL,
  `id_kategori_olahraga` int(11) NOT NULL,
  `jam_sesi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `jadwal_sesi`
--

INSERT INTO `jadwal_sesi` (`id_jadwal_sesi`, `id_kategori_olahraga`, `jam_sesi`) VALUES
(1, 1, '08:00 - 09:00'),
(2, 1, '09:00 - 10:00'),
(3, 1, '10:00 - 11:00'),
(4, 1, '11:00 - 12:00'),
(5, 1, '12:00 - 13:00'),
(6, 1, '13:00 - 14:00 '),
(7, 1, '14:00 - 15:00'),
(10, 2, '08:00 - 09:00'),
(11, 2, '09:00 - 10:00'),
(12, 2, '10:00 - 11:00'),
(13, 2, '11:00 - 12:00'),
(14, 2, '12:00 - 13:00'),
(15, 2, '13:00 - 14:00'),
(16, 2, '14:00 - 15:00'),
(17, 2, '15:00 - 16:00'),
(18, 2, '16:00 - 17:00'),
(19, 2, '17:00 - 18:00'),
(20, 2, '18:00 - 19:00'),
(21, 2, '19:00 - 20:00'),
(22, 1, '15:00 - 16:00'),
(23, 1, '16:00 - 17:00'),
(24, 1, '17:00 - 18:00'),
(25, 1, '18:00 - 19:00'),
(26, 1, '19:00 - 20:00'),
(27, 1, '20:00 - 21:00'),
(28, 1, '21:00 - 22:00'),
(29, 2, '20:00 - 21:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_umum`
--

CREATE TABLE `jurnal_umum` (
  `id_jurnal` int(11) NOT NULL,
  `periode` varchar(10) NOT NULL,
  `kode_jenis_jurnal` varchar(5) NOT NULL,
  `no_bukti` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `no_referensi` varchar(50) NOT NULL,
  `dari` varchar(20) NOT NULL,
  `kepada` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `last_numb_perperiode` double NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`id_jurnal`, `periode`, `kode_jenis_jurnal`, `no_bukti`, `tanggal`, `no_referensi`, `dari`, `kepada`, `keterangan`, `last_numb_perperiode`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
(16, '202410', 'QRIS', 'QRIS001-202410', '2024-10-12', 'TRXFITNES0005', 'Yono', 'Kasir', 'Pendapatan Fitness dari Yono QRIS001-202410', 1, '2024-10-12 00:09:35', '0000-00-00 00:00:00', 'administrator', ''),
(17, '202410', 'QRIS', 'QRIS002-202410', '2024-11-12', 'TRXFITNES0005', 'Yono', 'Kasir', 'Pendapatan Fitness dari Yono QRIS002-202410', 2, '2024-10-12 00:09:35', '0000-00-00 00:00:00', 'administrator', ''),
(18, '202410', 'CASH', 'CASH003-202410', '2024-10-12', 'TRXFITNES0006', 'Yani', 'Kasir', 'Pendapatan Fitness dari Yani CASH003-202410', 3, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(19, '202410', 'CASH', 'CASH004-202410', '2024-11-12', 'TRXFITNES0006', 'Yani', 'Kasir', 'Pendapatan Fitness dari Yani CASH004-202410', 4, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(20, '202410', 'CASH', 'CASH005-202410', '2024-12-12', 'TRXFITNES0006', 'Yani', 'Kasir', 'Pendapatan Fitness dari Yani CASH005-202410', 5, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(29, '202410', 'QRIS', 'QRIS006-202410', '2024-10-16', 'TRX131024101256', 'Test Diskon', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX131024101256', 6, '2024-10-13 10:24:44', '0000-00-00 00:00:00', 'administrator', ''),
(30, '202410', 'CASH', 'CASH007-202410', '2024-10-13', 'TRX131024102524', 'Test DP', 'administrator', 'Hasil Sewa Lapangan Lapangan C - TRX131024102524', 7, '2024-10-13 10:25:57', '0000-00-00 00:00:00', 'administrator', ''),
(38, '202410', 'CNCL', 'CNCL008-202410', '2024-10-13', 'TRX131024102524', 'Test DP', 'administrator', 'Pembatalan Sewa Lapangan  - TRX131024102524', 8, '2024-10-13 11:24:06', '0000-00-00 00:00:00', 'administrator', ''),
(41, '202410', 'CNCL', 'CNCL009-202410', '2024-10-16', 'TRX131024101256', 'Test Diskon', 'administrator', 'Pembatalan Sewa Lapangan  - TRX131024101256', 9, '2024-10-13 11:30:41', '0000-00-00 00:00:00', 'administrator', ''),
(47, '202410', 'QRIS', 'QRIS0011-202410', '2024-10-13', 'TRX141024202855', 'Test DP Selesai', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX141024202855', 11, '2024-10-14 20:29:34', '0000-00-00 00:00:00', 'administrator', ''),
(51, '202410', 'KM', 'KM0012-202410', '2024-10-14', 'TRX141024202855', 'Test DP Selesai', 'administrator', 'Pendapatan Sewa Lapangan  - TRX141024202855', 12, '2024-10-14 20:37:31', '0000-00-00 00:00:00', 'administrator', ''),
(52, '202410', 'KM', 'KM0013-202410', '2024-10-14', 'TRX141024195200', 'Test Diskon Selesai', 'administrator', 'Pendapatan Sewa Lapangan  - TRX141024195200', 13, '2024-10-14 20:37:59', '0000-00-00 00:00:00', 'administrator', ''),
(53, '202410', 'QRIS', 'QRIS0014-202410', '2024-10-24', 'TRXFITPP0007', 'Yono', 'administrator', 'Pendapatan Fitness dari Perpanjangan Yono QRIS0014-202410', 14, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(54, '202410', 'QRIS', 'QRIS0015-202410', '2024-11-24', 'TRXFITPP0007', 'Yono', 'administrator', 'Pendapatan Fitness dari Perpanjangan Yono QRIS0015-202410', 15, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(55, '202410', 'QRIS', 'QRIS0016-202410', '2024-12-24', 'TRXFITPP0007', 'Yono', 'administrator', 'Pendapatan Fitness dari Perpanjangan Yono QRIS0016-202410', 16, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(56, '202410', 'QRIS', 'QRIS0017-202410', '2024-10-16', 'TRX261024064727', 'Member Nol Satu', 'administrator', 'Hasil Sewa Lapangan Lapangan B - TRX261024064727', 17, '2024-10-26 07:25:57', '0000-00-00 00:00:00', 'administrator', ''),
(67, '202411', 'CASH', 'CASH001-202411', '2024-11-14', 'TRX131124082557', 'maul', 'penjualan', 'Hasil Sewa Lapangan Lapangan A - TRX131124082557', 1, '2024-11-13 08:26:21', '0000-00-00 00:00:00', 'penjualan', ''),
(68, '202411', 'KM', 'KM002-202411', '2024-11-13', 'TRX131124082557', 'maul', 'penjualan', 'Pendapatan Sewa Lapangan  - TRX131124082557', 2, '2024-11-13 08:27:14', '0000-00-00 00:00:00', 'penjualan', ''),
(69, '202411', 'QRIS', 'QRIS003-202411', '2024-11-14', 'TRX131124083353', 'yudhis', 'penjualan', 'Hasil Sewa Lapangan Lapangan A - TRX131124083353', 3, '2024-11-13 08:40:10', '0000-00-00 00:00:00', 'penjualan', ''),
(70, '202411', 'CASH', 'CASH004-202411', '2024-11-15', 'TRX131124084830', 'winarto', 'penjualan', 'Hasil Sewa Lapangan Lapangan A - TRX131124084830', 4, '2024-11-13 08:50:31', '0000-00-00 00:00:00', 'penjualan', ''),
(71, '202411', 'KM', 'KM005-202411', '2024-11-13', 'TRX131124084830', 'winarto', 'penjualan', 'Pendapatan Sewa Lapangan  - TRX131124084830', 5, '2024-11-13 08:51:13', '0000-00-00 00:00:00', 'penjualan', ''),
(72, '202411', 'QRIS', 'QRIS006-202411', '2024-11-23', 'TRX181124205810', 'yudhis', 'administrator', 'Hasil Sewa Lapangan Lapangan C - TRX181124205810', 6, '2024-11-18 20:59:17', '0000-00-00 00:00:00', 'administrator', ''),
(73, '202411', 'CASH', 'CASH007-202411', '2024-11-29', 'TRX191124150826', 'yudhis', 'penjualan', 'Hasil Sewa Lapangan Lapangan B - TRX191124150826', 7, '2024-11-19 15:10:31', '0000-00-00 00:00:00', 'penjualan', ''),
(74, '202411', 'KM', 'KM008-202411', '2024-11-19', 'TRX191124150826', 'yudhis', 'administrator', 'Pendapatan Sewa Lapangan  - TRX191124150826', 8, '2024-11-19 15:34:55', '0000-00-00 00:00:00', 'administrator', ''),
(75, '202411', 'QRIS', 'QRIS009-202411', '2024-11-30', 'TRX261124083344', 'jonny', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX261124083344', 9, '2024-11-26 08:34:04', '0000-00-00 00:00:00', 'administrator', ''),
(76, '202411', 'KM', 'KM0010-202411', '2024-11-26', 'TRX261124083344', 'jonny', 'administrator', 'Pendapatan Sewa Lapangan  - TRX261124083344', 10, '2024-11-26 08:35:27', '0000-00-00 00:00:00', 'administrator', ''),
(77, '202412', 'QRIS', 'QRIS001-202412', '2024-12-02', 'TRX021224104225', 'jonny', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX021224104225', 1, '2024-12-02 10:44:51', '0000-00-00 00:00:00', 'administrator', ''),
(78, '202412', 'KM', 'KM002-202412', '2024-12-02', 'TRX021224104225', 'jonny', 'administrator', 'Pendapatan Sewa Lapangan  - TRX021224104225', 2, '2024-12-02 10:49:45', '0000-00-00 00:00:00', 'administrator', ''),
(79, '202412', 'CASH', 'CASH003-202412', '2024-12-02', 'TRXFITPP0008', 'Bambang', 'administrator', 'Pendapatan Fitness dari Perpanjangan Bambang CASH003-202412', 3, '2024-12-02 10:55:10', '0000-00-00 00:00:00', 'administrator', ''),
(80, '202412', 'CASH', 'CASH004-202412', '2024-12-03', 'TRXFITPP0009', 'iqbal', 'administrator', 'Pendapatan Fitness dari Perpanjangan iqbal CASH004-202412', 4, '2024-12-03 12:25:31', '0000-00-00 00:00:00', 'administrator', ''),
(83, '202501', 'CASH', 'CASH001-202501', '2025-01-11', 'TRX030125131939', 'jonny', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX030125131939', 1, '2025-01-03 13:20:04', '0000-00-00 00:00:00', 'administrator', ''),
(84, '202501', 'KM', 'KM002-202501', '2025-01-11', 'TRX030125131939', 'jonny', 'administrator', 'Pendapatan Sewa Lapangan  - TRX030125131939', 2, '2025-01-03 13:21:06', '0000-00-00 00:00:00', 'administrator', ''),
(85, '202501', 'CASH', 'CASH003-202501', '2025-01-11', 'TRX030125132130', 'maul', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX030125132130', 3, '2025-01-03 13:22:07', '0000-00-00 00:00:00', 'administrator', ''),
(86, '202501', 'CNCL', 'CNCL004-202501', '2025-01-11', 'TRX030125132130', 'maul', 'administrator', 'Pembatalan Sewa Lapangan  - TRX030125132130', 4, '2025-01-03 13:23:12', '0000-00-00 00:00:00', 'administrator', ''),
(87, '202412', '', 'JL006-202412', '2024-12-20', 'PRCH090125103722', 'administrator', 'Pengeluaran', 'perbaikan alas lapangan badminton A', 6, '2025-01-09 10:38:24', '0000-00-00 00:00:00', 'administrator', ''),
(88, '202501', 'QRIS', 'QRIS005-202501', '2025-01-31', 'TRX100125162105', 'jonny', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX100125162105', 5, '2025-01-10 16:21:34', '0000-00-00 00:00:00', 'administrator', ''),
(89, '202501', 'CNCL', 'CNCL006-202501', '2025-01-31', 'TRX100125162224', 'maul', 'administrator', 'Pembatalan Sewa Lapangan  - TRX100125162224', 6, '2025-01-10 16:23:03', '0000-00-00 00:00:00', 'administrator', ''),
(90, '202501', 'KM', 'KM007-202501', '2025-01-31', 'TRX100125162105', 'jonny', 'administrator', 'Pendapatan Sewa Lapangan  - TRX100125162105', 7, '2025-01-10 16:26:49', '0000-00-00 00:00:00', 'administrator', ''),
(91, '202501', 'CASH', 'CASH008-202501', '2025-01-10', 'TRXFITPP0010', 'Yani', 'administrator', 'Pendapatan Fitness dari Perpanjangan Yani CASH008-202501', 8, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(92, '202501', 'CASH', 'CASH009-202501', '2025-02-10', 'TRXFITPP0010', 'Yani', 'administrator', 'Pendapatan Fitness dari Perpanjangan Yani CASH009-202501', 9, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(93, '202501', 'CASH', 'CASH0010-202501', '2025-03-10', 'TRXFITPP0010', 'Yani', 'administrator', 'Pendapatan Fitness dari Perpanjangan Yani CASH0010-202501', 10, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(94, '202501', 'QRIS', 'QRIS0011-202501', '2025-01-16', 'TRX100125162224', 'maul', 'penjualan', 'Hasil Sewa Lapangan Lapangan A - TRX100125162224', 11, '2025-01-16 11:42:27', '0000-00-00 00:00:00', 'penjualan', ''),
(95, '202501', 'KM', 'KM0012-202501', '2025-01-31', 'TRX100125162224', 'maul', 'penjualan', 'Pendapatan Sewa Lapangan  - TRX100125162224', 12, '2025-01-16 11:42:41', '0000-00-00 00:00:00', 'penjualan', ''),
(96, '202501', 'QRIS', 'QRIS0013-202501', '2025-01-16', 'TRX160125114714', 'Pam', 'penjualan', 'Hasil Sewa Lapangan Lapangan A - TRX160125114714', 13, '2025-01-16 11:49:49', '0000-00-00 00:00:00', 'penjualan', ''),
(97, '202501', 'KM', 'KM0014-202501', '2025-01-30', 'TRX160125114714', 'Pam', 'penjualan', 'Pendapatan Sewa Lapangan  - TRX160125114714', 14, '2025-01-16 12:01:06', '0000-00-00 00:00:00', 'penjualan', ''),
(98, '202501', 'QRIS', 'QRIS0015-202501', '2025-01-16', 'TRX160125120253', 'Pam', 'penjualan', 'Hasil Sewa Lapangan Lapangan A - TRX160125120253', 15, '2025-01-16 12:04:21', '0000-00-00 00:00:00', 'penjualan', ''),
(99, '202501', 'CASH', 'CASH0016-202501', '2025-01-16', 'TRXFITPP0011', 'Bambang', 'administrator', 'Pendapatan Fitness dari Perpanjangan Bambang CASH0016-202501', 16, '2025-01-16 12:15:35', '0000-00-00 00:00:00', 'administrator', ''),
(100, '202501', 'QRIS', 'QRIS0017-202501', '2025-01-16', 'TRXFITPP0012', 'iqbal', 'administrator', 'Pendapatan Fitness dari Perpanjangan iqbal QRIS0017-202501', 17, '2025-01-16 13:40:28', '0000-00-00 00:00:00', 'administrator', ''),
(101, '202502', 'QRIS', 'QRIS001-202502', '2025-02-05', 'TRX050225211132', 'jonny', 'penjualan', 'Hasil Sewa Lapangan Lapangan A - TRX050225211132', 1, '2025-02-05 21:16:51', '0000-00-00 00:00:00', 'penjualan', ''),
(102, '202502', 'QRIS', 'QRIS002-202502', '2025-02-05', 'TRXFITPP0013', 'Yono', 'administrator', 'Pendapatan Fitness dari Yono QRIS002-202502', 2, '2025-02-05 21:24:12', '0000-00-00 00:00:00', 'administrator', ''),
(103, '202502', 'QRIS', 'QRIS003-202502', '2025-03-05', 'TRXFITPP0013', 'Yono', 'administrator', 'Pendapatan Fitness dari Yono QRIS003-202502', 3, '2025-02-05 21:24:12', '0000-00-00 00:00:00', 'administrator', ''),
(105, '202502', '', 'JL004-202502', '2025-02-06', 'PRCH060225134300', 'administrator', 'Pengeluaran', 'gaji pegawai - PRCH060225134300', 4, '2025-02-06 13:43:20', '0000-00-00 00:00:00', 'administrator', ''),
(106, '202502', '', 'JL005-202502', '2025-02-06', 'PRCH060225134328', 'administrator', 'Pengeluaran', 'Semen tiga roda 1 sak - PRCH060225134328', 5, '2025-02-06 13:44:16', '0000-00-00 00:00:00', 'administrator', ''),
(108, '202502', '', 'JL006-202502', '2025-02-12', 'PRCH120225141410', 'administrator', 'Pengeluaran', 'token listrik - PRCH120225141410', 6, '2025-02-12 14:14:57', '0000-00-00 00:00:00', 'administrator', ''),
(109, '202502', 'QRIS', 'QRIS007-202502', '2025-02-12', 'TRXFITPP0014', 'iqbal', 'administrator', 'Pendapatan Fitness dari iqbal QRIS007-202502', 7, '2025-02-12 14:20:47', '0000-00-00 00:00:00', 'administrator', ''),
(110, '202502', 'QRIS', 'QRIS008-202502', '2025-03-12', 'TRXFITPP0014', 'iqbal', 'administrator', 'Pendapatan Fitness dari iqbal QRIS008-202502', 8, '2025-02-12 14:20:47', '0000-00-00 00:00:00', 'administrator', ''),
(111, '202502', 'QRIS', 'QRIS009-202502', '2025-02-12', 'TRX120225152114', 'maul', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX120225152114', 9, '2025-02-12 15:21:43', '0000-00-00 00:00:00', 'administrator', ''),
(112, '202502', 'KM', 'KM0010-202502', '2025-02-12', 'TRX120225152114', 'maul', 'administrator', 'Pendapatan Sewa Lapangan  - TRX120225152114', 10, '2025-02-12 15:21:47', '0000-00-00 00:00:00', 'administrator', ''),
(113, '202502', 'CASH', 'CASH0011-202502', '2025-02-12', 'TRX120225160245', 'jonny', 'administrator', 'Hasil Sewa Lapangan Lapangan B - TRX120225160245', 11, '2025-02-12 16:03:02', '0000-00-00 00:00:00', 'administrator', ''),
(114, '202502', 'KM', 'KM0012-202502', '2025-02-12', 'TRX120225160245', 'jonny', 'administrator', 'Pendapatan Sewa Lapangan  - TRX120225160245', 12, '2025-02-12 16:03:06', '0000-00-00 00:00:00', 'administrator', ''),
(115, '202502', 'CASH', 'CASH0013-202502', '2025-02-12', 'TRX120225201328', 'Pam', 'administrator', 'Hasil Sewa Lapangan Lapangan C - TRX120225201328', 13, '2025-02-12 20:13:45', '0000-00-00 00:00:00', 'administrator', ''),
(116, '202502', 'KM', 'KM0014-202502', '2025-02-12', 'TRX120225201328', 'Pam', 'administrator', 'Pendapatan Sewa Lapangan  - TRX120225201328', 14, '2025-02-12 20:13:48', '0000-00-00 00:00:00', 'administrator', ''),
(117, '202502', 'CASH', 'CASH0015-202502', '2025-02-12', 'TRX120225201409', 'jonny', 'administrator', 'Hasil Sewa Lapangan Lapangan E - TRX120225201409', 15, '2025-02-12 20:14:37', '0000-00-00 00:00:00', 'administrator', ''),
(118, '202502', 'CASH', 'CASH0016-202502', '2025-02-26', 'TRX230225000449', 'jonny', 'administrator', 'Hasil Sewa Lapangan Lapangan A - TRX230225000449', 16, '2025-02-23 00:05:15', '0000-00-00 00:00:00', 'administrator', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_umum_detail`
--

CREATE TABLE `jurnal_umum_detail` (
  `id_jurnal_detail` int(11) NOT NULL,
  `no_bukti` varchar(50) NOT NULL,
  `id_kode_akuntansi` int(11) NOT NULL,
  `uraian` varchar(200) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `jurnal_umum_detail`
--

INSERT INTO `jurnal_umum_detail` (`id_jurnal_detail`, `no_bukti`, `id_kode_akuntansi`, `uraian`, `debet`, `kredit`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
(25, 'QRIS001-202410', 8, 'Merchant Qris', 120000, 0, '2024-10-12 00:09:35', '0000-00-00 00:00:00', 'administrator', ''),
(26, 'QRIS001-202410', 8, 'Pendapatan Fitness', 0, 120000, '2024-10-12 00:09:35', '0000-00-00 00:00:00', 'administrator', ''),
(27, 'QRIS002-202410', 8, 'Merchant Qris', 120000, 0, '2024-10-12 00:09:35', '0000-00-00 00:00:00', 'administrator', ''),
(28, 'QRIS002-202410', 8, 'Pendapatan Fitness', 0, 120000, '2024-10-12 00:09:35', '0000-00-00 00:00:00', 'administrator', ''),
(29, 'CASH003-202410', 3, 'Kas Kecil', 120000, 0, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(30, 'CASH003-202410', 3, 'Pendapatan Fitness', 0, 120000, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(31, 'CASH004-202410', 3, 'Kas Kecil', 120000, 0, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(32, 'CASH004-202410', 3, 'Pendapatan Fitness', 0, 120000, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(33, 'CASH005-202410', 3, 'Kas Kecil', 120000, 0, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(34, 'CASH005-202410', 3, 'Pendapatan Fitness', 0, 120000, '2024-10-12 00:10:03', '0000-00-00 00:00:00', 'administrator', ''),
(47, 'QRIS006-202410', 8, 'Merchant Qris', 190000, 0, '2024-10-13 10:24:44', '0000-00-00 00:00:00', 'administrator', ''),
(48, 'QRIS006-202410', 8, 'Biaya Potongan Sewa', 20000, 0, '2024-10-13 10:24:44', '0000-00-00 00:00:00', 'administrator', ''),
(49, 'QRIS006-202410', 8, 'Pembayaran sewa lapangan', 0, 210000, '2024-10-13 10:24:44', '0000-00-00 00:00:00', 'administrator', ''),
(50, 'CASH007-202410', 3, 'Kas Kecil', 70000, 0, '2024-10-13 10:25:57', '0000-00-00 00:00:00', 'administrator', ''),
(51, 'CASH007-202410', 3, 'Biaya Potongan Sewa', 5000, 0, '2024-10-13 10:25:57', '0000-00-00 00:00:00', 'administrator', ''),
(52, 'CASH007-202410', 3, 'Pembayaran sewa lapangan', 0, 75000, '2024-10-13 10:25:57', '0000-00-00 00:00:00', 'administrator', ''),
(69, 'CNCL008-202410', 37, 'Pembayaran sewa lapangan', 75000, 0, '2024-10-13 11:24:06', '0000-00-00 00:00:00', 'administrator', ''),
(70, 'CNCL008-202410', 37, 'Pendapatan Cancel Sewa Lapangan', 0, 70000, '2024-10-13 11:24:06', '0000-00-00 00:00:00', 'administrator', ''),
(71, 'CNCL008-202410', 37, 'Biaya Potongan Sewa', 0, 5000, '2024-10-13 11:24:06', '0000-00-00 00:00:00', 'administrator', ''),
(76, 'CNCL009-202410', 37, 'Pembayaran sewa lapangan', 210000, 0, '2024-10-13 11:30:41', '0000-00-00 00:00:00', 'administrator', ''),
(77, 'CNCL009-202410', 37, 'Pendapatan Cancel Sewa Lapangan', 0, 95000, '2024-10-13 11:30:41', '0000-00-00 00:00:00', 'administrator', ''),
(78, 'CNCL009-202410', 37, 'Merchant Qris', 0, 95000, '2024-10-13 11:30:41', '0000-00-00 00:00:00', 'administrator', ''),
(79, 'CNCL009-202410', 37, 'Biaya Potongan Sewa', 0, 20000, '2024-10-13 11:30:41', '0000-00-00 00:00:00', 'administrator', ''),
(94, 'QRIS0011-202410', 8, 'Merchant Qris', 95000, 0, '2024-10-14 20:29:34', '0000-00-00 00:00:00', 'administrator', ''),
(95, 'QRIS0011-202410', 8, 'Biaya Potongan Sewa', 10000, 0, '2024-10-14 20:29:34', '0000-00-00 00:00:00', 'administrator', ''),
(96, 'QRIS0011-202410', 8, 'Pembayaran Sewa Lapangan', 0, 105000, '2024-10-14 20:29:34', '0000-00-00 00:00:00', 'administrator', ''),
(107, 'KM0012-202410', 37, 'Pembayaran Sewa Lapangan', 105000, 0, '2024-10-14 20:37:31', '0000-00-00 00:00:00', 'administrator', ''),
(108, 'KM0012-202410', 37, 'Pendapatan Sewa Lapangan', 0, 210000, '2024-10-14 20:37:31', '0000-00-00 00:00:00', 'administrator', ''),
(109, 'KM0012-202410', 37, 'Merchant Qris', 95000, 0, '2024-10-14 20:37:31', '0000-00-00 00:00:00', 'administrator', ''),
(110, 'KM0012-202410', 37, 'Biaya Potongan Sewa', 10000, 0, '2024-10-14 20:37:31', '0000-00-00 00:00:00', 'administrator', ''),
(111, 'KM0013-202410', 37, 'Pembayaran Sewa Lapangan', 210000, 0, '2024-10-14 20:37:59', '0000-00-00 00:00:00', 'administrator', ''),
(112, 'KM0013-202410', 37, 'Pendapatan Sewa Lapangan', 0, 210000, '2024-10-14 20:37:59', '0000-00-00 00:00:00', 'administrator', ''),
(113, 'QRIS0014-202410', 8, 'Merchant Qris', 120000, 0, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(114, 'QRIS0014-202410', 8, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(115, 'QRIS0015-202410', 8, 'Merchant Qris', 120000, 0, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(116, 'QRIS0015-202410', 8, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(117, 'QRIS0016-202410', 8, 'Merchant Qris', 120000, 0, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(118, 'QRIS0016-202410', 8, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2024-10-24 22:09:40', '0000-00-00 00:00:00', 'administrator', ''),
(119, 'QRIS0017-202410', 8, 'Merchant Qris', 70000, 0, '2024-10-26 07:25:57', '0000-00-00 00:00:00', 'administrator', ''),
(120, 'QRIS0017-202410', 8, 'Pembayaran Sewa Lapangan', 0, 70000, '2024-10-26 07:25:57', '0000-00-00 00:00:00', 'administrator', ''),
(147, 'CASH001-202411', 3, 'Kas Kecil', 70000, 0, '2024-11-13 08:26:21', '0000-00-00 00:00:00', 'penjualan', ''),
(148, 'CASH001-202411', 3, 'Pembayaran Sewa Lapangan', 0, 70000, '2024-11-13 08:26:21', '0000-00-00 00:00:00', 'penjualan', ''),
(149, 'KM002-202411', 37, 'Pembayaran Sewa Lapangan', 70000, 0, '2024-11-13 08:27:14', '0000-00-00 00:00:00', 'penjualan', ''),
(150, 'KM002-202411', 37, 'Pendapatan Sewa Lapangan', 0, 140000, '2024-11-13 08:27:14', '0000-00-00 00:00:00', 'penjualan', ''),
(151, 'KM002-202411', 37, 'Merchant Qris', 70000, 0, '2024-11-13 08:27:14', '0000-00-00 00:00:00', 'penjualan', ''),
(152, 'QRIS003-202411', 8, 'Merchant Qris', 100000, 0, '2024-11-13 08:40:10', '0000-00-00 00:00:00', 'penjualan', ''),
(153, 'QRIS003-202411', 8, 'Biaya Potongan Sewa', 5000, 0, '2024-11-13 08:40:10', '0000-00-00 00:00:00', 'penjualan', ''),
(154, 'QRIS003-202411', 8, 'Pembayaran Sewa Lapangan', 0, 105000, '2024-11-13 08:40:10', '0000-00-00 00:00:00', 'penjualan', ''),
(155, 'CASH004-202411', 3, 'Kas Kecil', 135000, 0, '2024-11-13 08:50:31', '0000-00-00 00:00:00', 'penjualan', ''),
(156, 'CASH004-202411', 3, 'Biaya Potongan Sewa', 5000, 0, '2024-11-13 08:50:31', '0000-00-00 00:00:00', 'penjualan', ''),
(157, 'CASH004-202411', 3, 'Pembayaran Sewa Lapangan', 0, 140000, '2024-11-13 08:50:31', '0000-00-00 00:00:00', 'penjualan', ''),
(158, 'KM005-202411', 37, 'Pembayaran Sewa Lapangan', 140000, 0, '2024-11-13 08:51:13', '0000-00-00 00:00:00', 'penjualan', ''),
(159, 'KM005-202411', 37, 'Pendapatan Sewa Lapangan', 0, 280000, '2024-11-13 08:51:13', '0000-00-00 00:00:00', 'penjualan', ''),
(160, 'KM005-202411', 37, 'Merchant Qris', 135000, 0, '2024-11-13 08:51:13', '0000-00-00 00:00:00', 'penjualan', ''),
(161, 'KM005-202411', 37, 'Biaya Potongan Sewa', 5000, 0, '2024-11-13 08:51:13', '0000-00-00 00:00:00', 'penjualan', ''),
(162, 'QRIS006-202411', 8, 'Merchant Qris', 165000, 0, '2024-11-18 20:59:17', '0000-00-00 00:00:00', 'administrator', ''),
(163, 'QRIS006-202411', 8, 'Biaya Potongan Sewa', 10000, 0, '2024-11-18 20:59:17', '0000-00-00 00:00:00', 'administrator', ''),
(164, 'QRIS006-202411', 8, 'Pembayaran Sewa Lapangan', 0, 175000, '2024-11-18 20:59:17', '0000-00-00 00:00:00', 'administrator', ''),
(165, 'CASH007-202411', 3, 'Kas Kecil', 480000, 0, '2024-11-19 15:10:31', '0000-00-00 00:00:00', 'penjualan', ''),
(166, 'CASH007-202411', 3, 'Biaya Potongan Sewa', 10000, 0, '2024-11-19 15:10:31', '0000-00-00 00:00:00', 'penjualan', ''),
(167, 'CASH007-202411', 3, 'Pembayaran Sewa Lapangan', 0, 490000, '2024-11-19 15:10:31', '0000-00-00 00:00:00', 'penjualan', ''),
(168, 'KM008-202411', 37, 'Pembayaran Sewa Lapangan', 490000, 0, '2024-11-19 15:34:55', '0000-00-00 00:00:00', 'administrator', ''),
(169, 'KM008-202411', 37, 'Pendapatan Sewa Lapangan', 0, 490000, '2024-11-19 15:34:55', '0000-00-00 00:00:00', 'administrator', ''),
(170, 'QRIS009-202411', 8, 'Merchant Qris', 105000, 0, '2024-11-26 08:34:04', '0000-00-00 00:00:00', 'administrator', ''),
(171, 'QRIS009-202411', 8, 'Pembayaran Sewa Lapangan', 0, 105000, '2024-11-26 08:34:04', '0000-00-00 00:00:00', 'administrator', ''),
(172, 'KM0010-202411', 37, 'Pembayaran Sewa Lapangan', 105000, 0, '2024-11-26 08:35:27', '0000-00-00 00:00:00', 'administrator', ''),
(173, 'KM0010-202411', 37, 'Pendapatan Sewa Lapangan', 0, 210000, '2024-11-26 08:35:27', '0000-00-00 00:00:00', 'administrator', ''),
(174, 'KM0010-202411', 37, 'Kas Kecil', 105000, 0, '2024-11-26 08:35:27', '0000-00-00 00:00:00', 'administrator', ''),
(175, 'QRIS001-202412', 8, 'Merchant Qris', 235000, 0, '2024-12-02 10:44:51', '0000-00-00 00:00:00', 'administrator', ''),
(176, 'QRIS001-202412', 8, 'Biaya Potongan Sewa', 10000, 0, '2024-12-02 10:44:51', '0000-00-00 00:00:00', 'administrator', ''),
(177, 'QRIS001-202412', 8, 'Pembayaran Sewa Lapangan', 0, 245000, '2024-12-02 10:44:51', '0000-00-00 00:00:00', 'administrator', ''),
(178, 'KM002-202412', 37, 'Pembayaran Sewa Lapangan', 245000, 0, '2024-12-02 10:49:45', '0000-00-00 00:00:00', 'administrator', ''),
(179, 'KM002-202412', 37, 'Pendapatan Sewa Lapangan', 0, 490000, '2024-12-02 10:49:45', '0000-00-00 00:00:00', 'administrator', ''),
(180, 'KM002-202412', 37, 'Kas Kecil', 240000, 0, '2024-12-02 10:49:45', '0000-00-00 00:00:00', 'administrator', ''),
(181, 'KM002-202412', 37, 'Biaya Potongan Sewa', 5000, 0, '2024-12-02 10:49:45', '0000-00-00 00:00:00', 'administrator', ''),
(182, 'CASH003-202412', 3, 'Kas Kecil', 120000, 0, '2024-12-02 10:55:10', '0000-00-00 00:00:00', 'administrator', ''),
(183, 'CASH003-202412', 3, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2024-12-02 10:55:10', '0000-00-00 00:00:00', 'administrator', ''),
(184, 'CASH004-202412', 3, 'Kas Kecil', 120000, 0, '2024-12-03 12:25:31', '0000-00-00 00:00:00', 'administrator', ''),
(185, 'CASH004-202412', 3, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2024-12-03 12:25:31', '0000-00-00 00:00:00', 'administrator', ''),
(191, 'CASH001-202501', 3, 'Kas Kecil', 140000, 0, '2025-01-03 13:20:04', '0000-00-00 00:00:00', 'administrator', ''),
(192, 'CASH001-202501', 3, 'Piutang Sewa Lapangan', 0, 140000, '2025-01-03 13:20:04', '0000-00-00 00:00:00', 'administrator', ''),
(193, 'KM002-202501', 37, 'Piutang Sewa Lapangan', 140000, 0, '2025-01-03 13:21:06', '0000-00-00 00:00:00', 'administrator', ''),
(194, 'KM002-202501', 37, 'Pendapatan Sewa Lapangan', 0, 140000, '2025-01-03 13:21:06', '0000-00-00 00:00:00', 'administrator', ''),
(195, 'CASH003-202501', 3, 'Kas Kecil', 105000, 0, '2025-01-03 13:22:07', '0000-00-00 00:00:00', 'administrator', ''),
(196, 'CASH003-202501', 3, 'Piutang Sewa Lapangan', 0, 105000, '2025-01-03 13:22:07', '0000-00-00 00:00:00', 'administrator', ''),
(197, 'CNCL004-202501', 37, 'Piutang Sewa Lapangan', 105000, 0, '2025-01-03 13:23:12', '0000-00-00 00:00:00', 'administrator', ''),
(198, 'CNCL004-202501', 37, 'Pendapatan Cancel Sewa Lapangan', 0, 105000, '2025-01-03 13:23:12', '0000-00-00 00:00:00', 'administrator', ''),
(199, 'JL006-202412', 5, 'Bank BCA', 0, 100000, '2025-01-09 10:38:24', '0000-00-00 00:00:00', 'administrator', ''),
(200, 'JL006-202412', 39, 'BEBAN USAHA', 1000000, 0, '2025-01-09 10:38:24', '0000-00-00 00:00:00', 'administrator', ''),
(201, 'QRIS005-202501', 8, 'Merchant Qris', 70000, 0, '2025-01-10 16:21:34', '0000-00-00 00:00:00', 'administrator', ''),
(202, 'QRIS005-202501', 8, 'Piutang Sewa Lapangan', 0, 70000, '2025-01-10 16:21:34', '0000-00-00 00:00:00', 'administrator', ''),
(203, 'CNCL006-202501', 37, 'Piutang Sewa Lapangan', 175000, 0, '2025-01-10 16:23:03', '0000-00-00 00:00:00', 'administrator', ''),
(204, 'CNCL006-202501', 37, 'Pendapatan Cancel Sewa Lapangan', 0, 172500, '2025-01-10 16:23:03', '0000-00-00 00:00:00', 'administrator', ''),
(205, 'CNCL006-202501', 37, 'Biaya Potongan Sewa', 0, 5000, '2025-01-10 16:23:03', '0000-00-00 00:00:00', 'administrator', ''),
(206, 'KM007-202501', 37, 'Piutang Sewa Lapangan', 70000, 0, '2025-01-10 16:26:49', '0000-00-00 00:00:00', 'administrator', ''),
(207, 'KM007-202501', 37, 'Pendapatan Sewa Lapangan', 0, 140000, '2025-01-10 16:26:49', '0000-00-00 00:00:00', 'administrator', ''),
(208, 'KM007-202501', 37, 'Merchant Qris', 70000, 0, '2025-01-10 16:26:49', '0000-00-00 00:00:00', 'administrator', ''),
(209, 'CASH008-202501', 3, 'Kas Kecil', 120000, 0, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(210, 'CASH008-202501', 3, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(211, 'CASH009-202501', 3, 'Kas Kecil', 120000, 0, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(212, 'CASH009-202501', 3, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(213, 'CASH0010-202501', 3, 'Kas Kecil', 120000, 0, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(214, 'CASH0010-202501', 3, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2025-01-10 16:58:49', '0000-00-00 00:00:00', 'administrator', ''),
(215, 'QRIS0011-202501', 8, 'Merchant Qris', 345000, 0, '2025-01-16 11:42:27', '0000-00-00 00:00:00', 'penjualan', ''),
(216, 'QRIS0011-202501', 8, 'Biaya Potongan Sewa', 5000, 0, '2025-01-16 11:42:27', '0000-00-00 00:00:00', 'penjualan', ''),
(217, 'QRIS0011-202501', 8, 'Piutang Sewa Lapangan', 0, 350000, '2025-01-16 11:42:27', '0000-00-00 00:00:00', 'penjualan', ''),
(218, 'KM0012-202501', 37, 'Piutang Sewa Lapangan', 350000, 0, '2025-01-16 11:42:41', '0000-00-00 00:00:00', 'penjualan', ''),
(219, 'KM0012-202501', 37, 'Pendapatan Sewa Lapangan', 0, 700000, '2025-01-16 11:42:41', '0000-00-00 00:00:00', 'penjualan', ''),
(220, 'KM0012-202501', 37, 'Kas Kecil', 345000, 0, '2025-01-16 11:42:41', '0000-00-00 00:00:00', 'penjualan', ''),
(221, 'KM0012-202501', 37, 'Biaya Potongan Sewa', 5000, 0, '2025-01-16 11:42:41', '0000-00-00 00:00:00', 'penjualan', ''),
(222, 'QRIS0013-202501', 8, 'Merchant Qris', 242500, 0, '2025-01-16 11:49:49', '0000-00-00 00:00:00', 'penjualan', ''),
(223, 'QRIS0013-202501', 8, 'Biaya Potongan Sewa', 2500, 0, '2025-01-16 11:49:49', '0000-00-00 00:00:00', 'penjualan', ''),
(224, 'QRIS0013-202501', 8, 'Piutang Sewa Lapangan', 0, 245000, '2025-01-16 11:49:49', '0000-00-00 00:00:00', 'penjualan', ''),
(225, 'KM0014-202501', 37, 'Piutang Sewa Lapangan', 245000, 0, '2025-01-16 12:01:06', '0000-00-00 00:00:00', 'penjualan', ''),
(226, 'KM0014-202501', 37, 'Pendapatan Sewa Lapangan', 0, 490000, '2025-01-16 12:01:06', '0000-00-00 00:00:00', 'penjualan', ''),
(227, 'KM0014-202501', 37, 'Kas Kecil', 242500, 0, '2025-01-16 12:01:06', '0000-00-00 00:00:00', 'penjualan', ''),
(228, 'KM0014-202501', 37, 'Biaya Potongan Sewa', 2500, 0, '2025-01-16 12:01:06', '0000-00-00 00:00:00', 'penjualan', ''),
(229, 'QRIS0015-202501', 8, 'Merchant Qris', 480000, 0, '2025-01-16 12:04:21', '0000-00-00 00:00:00', 'penjualan', ''),
(230, 'QRIS0015-202501', 8, 'Biaya Potongan Sewa', 10000, 0, '2025-01-16 12:04:21', '0000-00-00 00:00:00', 'penjualan', ''),
(231, 'QRIS0015-202501', 8, 'Piutang Sewa Lapangan', 0, 490000, '2025-01-16 12:04:21', '0000-00-00 00:00:00', 'penjualan', ''),
(232, 'CASH0016-202501', 3, 'Kas Kecil', 120000, 0, '2025-01-16 12:15:35', '0000-00-00 00:00:00', 'administrator', ''),
(233, 'CASH0016-202501', 3, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2025-01-16 12:15:35', '0000-00-00 00:00:00', 'administrator', ''),
(234, 'QRIS0017-202501', 8, 'Merchant Qris', 120000, 0, '2025-01-16 13:40:28', '0000-00-00 00:00:00', 'administrator', ''),
(235, 'QRIS0017-202501', 8, 'Pendapatan Fitness Perpanjangan', 0, 120000, '2025-01-16 13:40:28', '0000-00-00 00:00:00', 'administrator', ''),
(236, 'QRIS001-202502', 8, 'Merchant Qris', 205000, 0, '2025-02-05 21:16:51', '0000-00-00 00:00:00', 'penjualan', ''),
(237, 'QRIS001-202502', 8, 'Biaya Potongan Sewa', 5000, 0, '2025-02-05 21:16:51', '0000-00-00 00:00:00', 'penjualan', ''),
(238, 'QRIS001-202502', 8, 'Piutang Sewa Lapangan', 0, 210000, '2025-02-05 21:16:51', '0000-00-00 00:00:00', 'penjualan', ''),
(239, 'QRIS002-202502', 8, 'Merchant Qris', 120000, 0, '2025-02-05 21:24:12', '0000-00-00 00:00:00', 'administrator', ''),
(240, 'QRIS002-202502', 8, 'Pendapatan Fitness', 0, 120000, '2025-02-05 21:24:12', '0000-00-00 00:00:00', 'administrator', ''),
(241, 'QRIS003-202502', 8, 'Biaya potongan fitness', 12000, 0, '2025-02-05 21:24:12', '0000-00-00 00:00:00', 'administrator', ''),
(242, 'QRIS003-202502', 8, 'Merchant Qris', 108000, 0, '2025-02-05 21:24:12', '0000-00-00 00:00:00', 'administrator', ''),
(243, 'QRIS003-202502', 8, 'Pendapatan Fitness', 0, 120000, '2025-02-05 21:24:12', '0000-00-00 00:00:00', 'administrator', ''),
(246, 'JL004-202502', 3, 'Kas Kecil', 0, 1000000, '2025-02-06 13:43:20', '0000-00-00 00:00:00', 'administrator', ''),
(247, 'JL004-202502', 39, 'BEBAN USAHA', 1000000, 0, '2025-02-06 13:43:20', '0000-00-00 00:00:00', 'administrator', ''),
(248, 'JL005-202502', 3, 'Kas Kecil', 0, 20000, '2025-02-06 13:44:16', '0000-00-00 00:00:00', 'administrator', ''),
(249, 'JL005-202502', 39, 'BEBAN USAHA', 20000, 0, '2025-02-06 13:44:16', '0000-00-00 00:00:00', 'administrator', ''),
(252, 'JL006-202502', 3, 'Kas Kecil', 0, 1000000, '2025-02-12 14:14:57', '0000-00-00 00:00:00', 'administrator', ''),
(253, 'JL006-202502', 57, 'Kas Admin', 0, 1000000, '2025-02-12 14:14:57', '0000-00-00 00:00:00', 'administrator', ''),
(254, 'JL006-202502', 40, 'Beban Listrik', 2000000, 0, '2025-02-12 14:14:57', '0000-00-00 00:00:00', 'administrator', ''),
(255, 'QRIS007-202502', 8, 'Biaya potongan fitness', 12000, 0, '2025-02-12 14:20:47', '0000-00-00 00:00:00', 'administrator', ''),
(256, 'QRIS007-202502', 8, 'Merchant Qris', 108000, 0, '2025-02-12 14:20:47', '0000-00-00 00:00:00', 'administrator', ''),
(257, 'QRIS007-202502', 8, 'Pendapatan Fitness', 0, 120000, '2025-02-12 14:20:47', '0000-00-00 00:00:00', 'administrator', ''),
(258, 'QRIS008-202502', 8, 'Biaya potongan fitness', 12000, 0, '2025-02-12 14:20:47', '0000-00-00 00:00:00', 'administrator', ''),
(259, 'QRIS008-202502', 8, 'Merchant Qris', 108000, 0, '2025-02-12 14:20:47', '0000-00-00 00:00:00', 'administrator', ''),
(260, 'QRIS008-202502', 8, 'Pendapatan Fitness', 0, 120000, '2025-02-12 14:20:47', '0000-00-00 00:00:00', 'administrator', ''),
(261, 'QRIS009-202502', 8, 'Merchant Qris', 490000, 0, '2025-02-12 15:21:43', '0000-00-00 00:00:00', 'administrator', ''),
(262, 'QRIS009-202502', 8, 'Piutang Sewa Lapangan', 0, 490000, '2025-02-12 15:21:43', '0000-00-00 00:00:00', 'administrator', ''),
(263, 'KM0010-202502', 37, 'Piutang Sewa Lapangan', 490000, 0, '2025-02-12 15:21:47', '0000-00-00 00:00:00', 'administrator', ''),
(264, 'KM0010-202502', 37, 'Pendapatan Sewa Lapangan', 0, 490000, '2025-02-12 15:21:47', '0000-00-00 00:00:00', 'administrator', ''),
(265, 'CASH0011-202502', 3, 'Kas Kecil', 140000, 0, '2025-02-12 16:03:02', '0000-00-00 00:00:00', 'administrator', ''),
(266, 'CASH0011-202502', 3, 'Piutang Sewa Lapangan', 0, 140000, '2025-02-12 16:03:02', '0000-00-00 00:00:00', 'administrator', ''),
(267, 'KM0012-202502', 37, 'Piutang Sewa Lapangan', 140000, 0, '2025-02-12 16:03:06', '0000-00-00 00:00:00', 'administrator', ''),
(268, 'KM0012-202502', 37, 'Pendapatan Sewa Lapangan', 0, 140000, '2025-02-12 16:03:06', '0000-00-00 00:00:00', 'administrator', ''),
(269, 'CASH0013-202502', 3, 'Kas Kecil', 150000, 0, '2025-02-12 20:13:45', '0000-00-00 00:00:00', 'administrator', ''),
(270, 'CASH0013-202502', 3, 'Piutang Sewa Lapangan', 0, 150000, '2025-02-12 20:13:45', '0000-00-00 00:00:00', 'administrator', ''),
(271, 'KM0014-202502', 37, 'Piutang Sewa Lapangan', 150000, 0, '2025-02-12 20:13:48', '0000-00-00 00:00:00', 'administrator', ''),
(272, 'KM0014-202502', 37, 'Pendapatan Sewa Lapangan', 0, 150000, '2025-02-12 20:13:48', '0000-00-00 00:00:00', 'administrator', ''),
(273, 'CASH0015-202502', 3, 'Kas Kecil', 150000, 0, '2025-02-12 20:14:37', '0000-00-00 00:00:00', 'administrator', ''),
(274, 'CASH0015-202502', 3, 'Piutang Sewa Lapangan', 0, 150000, '2025-02-12 20:14:37', '0000-00-00 00:00:00', 'administrator', ''),
(275, 'CASH0016-202502', 3, 'Kas Kecil', 210000, 0, '2025-02-23 00:05:15', '0000-00-00 00:00:00', 'administrator', ''),
(276, 'CASH0016-202502', 3, 'Piutang Sewa Lapangan', 0, 210000, '2025-02-23 00:05:15', '0000-00-00 00:00:00', 'administrator', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_olahraga`
--

CREATE TABLE `kategori_olahraga` (
  `id_kategori_olahraga` int(11) NOT NULL,
  `kategori_olahraga` varchar(100) NOT NULL,
  `memiliki_lapangan` int(11) NOT NULL COMMENT 'Ya=1, Tidak=0',
  `keterangan_lapangan` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kategori_olahraga`
--

INSERT INTO `kategori_olahraga` (`id_kategori_olahraga`, `kategori_olahraga`, `memiliki_lapangan`, `keterangan_lapangan`) VALUES
(1, 'Futsal', 1, ''),
(2, 'Badminton', 1, ''),
(3, 'Fitnes', 0, ''),
(4, 'paddle', 1, 'test keterangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_akuntansi`
--

CREATE TABLE `kode_akuntansi` (
  `id_kode_akuntansi` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `is_parent` int(11) NOT NULL COMMENT '1=Ya, 0=Tidak',
  `kode_parent` varchar(50) NOT NULL,
  `kode_akun` varchar(50) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `saldo_normal` varchar(10) NOT NULL,
  `pos` varchar(20) NOT NULL COMMENT 'Laba Rugi, Neraca',
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kode_akuntansi`
--

INSERT INTO `kode_akuntansi` (`id_kode_akuntansi`, `level`, `is_parent`, `kode_parent`, `kode_akun`, `nama_akun`, `saldo_normal`, `pos`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
(1, 2, 0, '-', '0', 'Ayat Silang', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2024-08-24 10:15:46', 'admin', 'administrator'),
(2, 1, 1, '-', '11', 'KAS', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-12-05 14:33:18', 'admin', 'administrator'),
(3, 2, 0, '11', '11.1', 'Kas Kecil', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-05-24 22:29:54', 'admin', ''),
(4, 1, 1, '-', '12', 'BANK', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-05-24 22:30:04', 'admin', ''),
(5, 2, 0, '12', '12.1', 'Bank BCA', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-05-24 22:30:25', 'admin', ''),
(6, 1, 1, '-', '14', 'PIUTANG USAHA', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-05-29 12:41:54', 'admin', ''),
(7, 2, 0, '14', '14.1', 'Piutang Usaha', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-05-29 12:42:18', 'admin', ''),
(8, 2, 0, '12', '12.2', 'Merchant Qris', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2024-05-28 11:28:43', 'admin', 'administrator'),
(9, 1, 1, '-', '13', 'PERSEDIAAN', 'Debet', 'Neraca', '2023-05-12 22:04:50', '0000-00-00 00:00:00', 'admin', ''),
(10, 2, 0, '13', '13.1', 'Persediaan ', 'Debet', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(17, 1, 1, '-', '15', 'HUTANG USAHA', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-05-29 12:43:18', 'admin', ''),
(18, 2, 0, '15', '15.1', 'Hutang Usaha - Galaksy Sport', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-05-29 12:43:46', 'admin', ''),
(20, 1, 1, '-', '21', 'MODAL', 'Kredit', 'Neraca', '2023-05-12 22:04:50', '0000-00-00 00:00:00', 'admin', ''),
(22, 1, 1, '-', '31', 'PENJUALAN', 'Kredit', 'Neraca', '2023-05-12 22:04:50', '0000-00-00 00:00:00', 'admin', ''),
(23, 2, 0, '31', '31.1', 'Penjualan Utama', 'Kredit', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(24, 2, 0, '31', '31.2', 'Penjualan Lainnya', 'Kredit', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(25, 1, 1, '-', '41', 'HARGA POKOK PENJUALAN', 'Debet', '- - - Pilih - - -', '2023-05-12 22:04:50', '2024-08-14 17:10:07', 'admin', 'administrator'),
(26, 2, 0, '41', '41.1', 'Harga Pokok Penjualan Sewa', 'Debet', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(31, 1, 1, '-', '51', 'ADMIN BANK', 'Debet', 'Laba Rugi', '2023-05-12 22:04:50', '2024-08-14 10:30:42', 'admin', 'administrator'),
(32, 2, 0, '51', '51.1', 'Admin Bank BCA', 'Debet', 'Laba Rugi', '2023-05-12 22:05:37', '2024-08-14 10:30:50', 'admin', 'administrator'),
(33, 2, 0, '51', '51.2', 'Admin Bank Mandiri', 'Debet', 'Laba Rugi', '2023-05-12 22:05:37', '2024-08-14 10:30:13', 'admin', 'administrator'),
(36, 1, 1, '-', '71', 'Pendapatan', 'Kredit', 'Laba Rugi', '2023-05-12 22:04:50', '2024-05-28 11:29:13', 'admin', 'administrator'),
(37, 2, 0, '71', '71.1', 'Pendapatan Sewa Lapangan', 'Kredit', 'Laba Rugi', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(38, 2, 0, '71', '71.2', 'Pendapatan Fitness', 'Kredit', 'Laba Rugi', '2023-05-12 22:05:37', '2024-05-28 11:29:52', 'admin', 'administrator'),
(39, 1, 1, '-', '81', 'BEBAN USAHA', 'Debet', 'Laba Rugi', '2023-05-12 22:04:50', '0000-00-00 00:00:00', 'admin', ''),
(40, 2, 0, '81', '81.1', 'Beban Listrik', 'Debet', 'Laba Rugi', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(41, 2, 0, '81', '81.2', 'Beban Air', 'Debet', 'Laba Rugi', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(42, 2, 0, '81', '81.3', 'Beban Gaji Karyawan', 'Debet', 'Laba Rugi', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(43, 2, 0, '81', '81.4', 'Beban Internet', 'Debet', 'Laba Rugi', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(45, 1, 1, '-', '91', 'PAJAK', 'Debet', 'Laba Rugi', '2023-05-12 22:04:50', '0000-00-00 00:00:00', 'admin', ''),
(46, 2, 0, '91', '91.1', 'Beban Pajak 11%', 'Debet', 'Laba Rugi', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(47, 2, 0, '21', '21.1', 'Untung', 'Kredit', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(48, 2, 0, '21', '21.2', 'Pemilik Usaha', 'Kredit', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(49, 2, 0, '21', '21.3', 'Rugi', 'Kredit', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(50, 2, 0, '21', '21.4', 'Prive', 'Kredit', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(51, 2, 0, '13', '13.7', 'Persediaan Lainnya', 'Debet', 'Neraca', '2023-06-09 09:44:24', '0000-00-00 00:00:00', 'admin', ''),
(52, 2, 0, '81', '81.5', 'Beban Pembelian Perlengkapan Lapangan', 'Debet', 'Laba Rugi', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(53, 2, 0, '71', '71.3', 'Pendapatan Lain ', 'Kredit', 'Laba Rugi', '2024-05-28 11:30:36', '0000-00-00 00:00:00', 'administrator', ''),
(54, 2, 0, '71', '71.4', 'Piutang sewa lapangan', 'Kredit', 'Laba Rugi', '2024-08-14 19:51:58', '0000-00-00 00:00:00', 'administrator', ''),
(55, 2, 0, '81', '81.6', 'Beban potongan sewa', 'Debet', 'Laba Rugi', '2024-08-18 18:11:30', '0000-00-00 00:00:00', 'administrator', ''),
(57, 2, 0, '11', '11.2', 'Kas Admin', 'Debet', 'Neraca', '2024-12-06 17:31:29', '0000-00-00 00:00:00', 'administrator', ''),
(58, 2, 0, '81', '81.7', 'Beban maintenance & service', 'Debet', 'Laba Rugi', '2025-02-12 16:21:52', '2025-02-12 16:22:08', 'administrator', 'administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_jenis_jurnal`
--

CREATE TABLE `kode_jenis_jurnal` (
  `kode_jenis_jurnal` varchar(5) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kode_jenis_jurnal`
--

INSERT INTO `kode_jenis_jurnal` (`kode_jenis_jurnal`, `deskripsi`) VALUES
('BK', 'Bank Keluar'),
('BM', 'Bank Masuk'),
('INV', 'Penjualan'),
('KK', 'Kas Keluar'),
('KM', 'Kas Masuk'),
('PB', 'Pembelian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuota_fitness`
--

CREATE TABLE `kuota_fitness` (
  `id` int(11) NOT NULL,
  `kuota` bigint(20) DEFAULT NULL,
  `user_create` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `kuota_fitness`
--

INSERT INTO `kuota_fitness` (`id`, `kuota`, `user_create`, `created_at`) VALUES
(0, 50, 'administrator', '2025-01-03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lapangan`
--

CREATE TABLE `lapangan` (
  `id_lapangan` int(11) NOT NULL,
  `id_kategori_olahraga` int(11) NOT NULL,
  `nama_lapangan` varchar(100) NOT NULL,
  `ukuran_lapangan` varchar(45) NOT NULL,
  `maksimal_kapasitas_orang` int(11) NOT NULL,
  `status_aktif` int(11) NOT NULL COMMENT 'Aktif=1, 0=Tidak Aktif',
  `status_booking` varchar(45) NOT NULL COMMENT 'Booked = 1, Ready = 0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `lapangan`
--

INSERT INTO `lapangan` (`id_lapangan`, `id_kategori_olahraga`, `nama_lapangan`, `ukuran_lapangan`, `maksimal_kapasitas_orang`, `status_aktif`, `status_booking`) VALUES
(1, 1, 'Lapangan A', '25x15 Meter', 15, 1, '0'),
(2, 1, 'Lapangan B', '25x15 Meter', 15, 1, '0'),
(3, 2, 'Lapangan C', '15x6 Meter', 5, 1, '0'),
(4, 2, 'Lapangan D', '15x6 Meter', 15, 1, '0'),
(5, 2, 'Lapangan E', '15x6 Meter', 5, 1, '0'),
(6, 2, 'Lapangan F', '15x6 Meter', 5, 1, '0'),
(7, 2, 'Lapangan G', '15x6 Meter', 6, 1, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `kodeMember` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nope` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `usia` varchar(10) NOT NULL,
  `jk` varchar(11) NOT NULL,
  `expired_member` date NOT NULL,
  `user_create` varchar(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `kodeMember`, `nama`, `nope`, `email`, `alamat`, `usia`, `jk`, `expired_member`, `user_create`, `created_at`) VALUES
(16, 'MBR0001', 'Yono', '082123123', 'yono@mail.com', '', '', 'L', '2025-04-06', '', '2024-10-12'),
(17, 'MBR0002', 'Yani', '1023823', 'test@mail.com', 'Jl Ir Sutami 36 A, Surakarta,', '', 'P', '2025-04-10', '', '2024-10-12'),
(18, 'MBR0003', 'Bambang', '085640777777', 'test@mail.com', 'Jl Ir Sutami 36 A, Surakarta,', '', 'L', '2025-02-15', '', '2024-10-24'),
(19, 'MBR0004', 'iqbal', '0829891822', 'iqbal@gmail.com', 'surabaya', '', 'P', '2025-04-13', '', '2024-11-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_pelanggan`
--

CREATE TABLE `member_pelanggan` (
  `id` int(11) NOT NULL,
  `id_member` varchar(25) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `usia` varchar(5) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `user_create` varchar(255) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `member_pelanggan`
--

INSERT INTO `member_pelanggan` (`id`, `id_member`, `nama_pelanggan`, `no_telepon`, `email`, `alamat`, `usia`, `jenis_kelamin`, `user_create`, `created_at`) VALUES
(5, 'NONMEMBER', 'NON MEMBER', '0', '', '', '', '', NULL, NULL),
(6, 'GORMBR001', 'PASCAL PRAHARDHIKA', '0895368200241', '', '', '', '', NULL, NULL),
(7, 'GORMBR002', 'yudhis', '0878999912', '', '', '', '', NULL, NULL),
(8, 'GORMBR003', 'wawan', '0812231232', '', '', '', '', NULL, NULL),
(9, 'GORMBR004', 'Puyol', '0812121209', '', '', '', '', NULL, NULL),
(10, 'GORMBR005', 'Pam', '082247292183', '', '', '', '', NULL, NULL),
(11, 'GORMBR006', 'jonny', '0822112211', '', '', '', '', NULL, NULL),
(12, 'GORMBR007', 'maul', '089654321', '', '', '', '', NULL, NULL),
(13, 'GORMBR008', 'winarto', '08651212', '', '', '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_trx`
--

CREATE TABLE `member_trx` (
  `id` int(11) NOT NULL,
  `memberID` int(11) NOT NULL,
  `nomorTransaksi` varchar(100) NOT NULL,
  `paketID` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `metodebayar` varchar(100) NOT NULL,
  `durasiMember` varchar(30) NOT NULL,
  `tanggalMulai` date NOT NULL,
  `tanggalSelesai` date NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `member_trx`
--

INSERT INTO `member_trx` (`id`, `memberID`, `nomorTransaksi`, `paketID`, `harga`, `metodebayar`, `durasiMember`, `tanggalMulai`, `tanggalSelesai`, `created_at`) VALUES
(22, 12, 'TRXFITNES0001', 3, 120000, 'qris', '60', '2024-10-10', '2024-12-09', '2024-10-11'),
(23, 13, 'TRXFITNES0002', 3, 120000, 'qris', '60', '2024-10-11', '2024-12-10', '2024-10-11'),
(24, 14, 'TRXFITNES0003', 3, 120000, 'qris', '60', '2024-10-11', '2024-12-10', '2024-10-11'),
(25, 15, 'TRXFITNES0004', 3, 120000, 'cash', '90', '2024-10-11', '2025-01-09', '2024-10-11'),
(26, 16, 'TRXFITNES0005', 3, 120000, 'qris', '60', '2024-10-11', '2024-12-10', '2024-10-12'),
(27, 17, 'TRXFITNES0006', 3, 120000, 'cash', '90', '2024-10-11', '2025-01-09', '2024-10-12'),
(35, 16, 'TRXFITPP0007', 3, 120000, 'qris', '90', '2024-10-24', '2025-01-22', '2024-10-24'),
(36, 18, 'TRXFITPP0008', 3, 120000, 'cash', '30', '2024-12-02', '2025-01-01', '2024-12-02'),
(37, 19, 'TRXFITPP0009', 3, 120000, 'cash', '30', '2024-12-01', '2024-12-31', '2024-12-03'),
(38, 17, 'TRXFITPP0010', 3, 120000, 'cash', '90', '2025-01-10', '2025-04-10', '2025-01-10'),
(39, 18, 'TRXFITPP0011', 3, 120000, 'cash', '30', '2025-01-16', '2025-02-15', '2025-01-16'),
(40, 19, 'TRXFITPP0012', 3, 120000, 'qris', '30', '2025-01-01', '2025-01-31', '2025-01-16'),
(41, 16, 'TRXFITPP0013', 3, 120000, 'qris', '60', '2025-02-05', '2025-04-06', '2025-02-05'),
(42, 19, 'TRXFITPP0014', 3, 120000, 'qris', '60', '2025-02-12', '2025-04-13', '2025-02-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_sewa`
--

CREATE TABLE `paket_sewa` (
  `id_paket_sewa` int(11) NOT NULL,
  `id_kategori_olahraga` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `harga` double NOT NULL,
  `info` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `paket_sewa`
--

INSERT INTO `paket_sewa` (`id_paket_sewa`, `id_kategori_olahraga`, `id_satuan`, `harga`, `info`) VALUES
(1, 1, 3, 70000, ''),
(2, 2, 3, 50000, ''),
(3, 3, 2, 120000, 'Per Bulan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nomor_member` varchar(150) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `usia` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `NA` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `no_pembelian` varchar(100) NOT NULL,
  `data_tahun` double NOT NULL,
  `periode` double NOT NULL,
  `last_numb_perperiode` double NOT NULL,
  `tanggal` date NOT NULL,
  `nota_pembelian` varchar(100) NOT NULL,
  `kode_suplier` varchar(100) NOT NULL,
  `cara_bayar` varchar(50) NOT NULL,
  `total` double NOT NULL,
  `kode_jenis_jurnal` varchar(5) NOT NULL,
  `id_kode_akun_beban_debet` int(11) NOT NULL,
  `id_kode_akun_pembayaran_kas_kredit` int(11) NOT NULL,
  `id_kode_akun_hutang_bertambah_kredit` int(11) NOT NULL,
  `no_bukti_jurnal` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`no_pembelian`, `data_tahun`, `periode`, `last_numb_perperiode`, `tanggal`, `nota_pembelian`, `kode_suplier`, `cara_bayar`, `total`, `kode_jenis_jurnal`, `id_kode_akun_beban_debet`, `id_kode_akun_pembayaran_kas_kredit`, `id_kode_akun_hutang_bertambah_kredit`, `no_bukti_jurnal`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
('NBGOR001-202405', 2024, 202405, 1, '2024-05-20', '178/20/06/2024', 'SUP001', 'Transfer', 0, 'PB', 52, 5, 0, 'PB001-202405', '2024-05-20 10:00:53', '0000-00-00 00:00:00', 'administrator', ''),
('NBGOR002-202401', 2024, 202401, 2, '2024-01-19', 'GS009', 'SUP001', 'Cash', 550000, 'KK', 52, 3, 0, 'KK002-202401', '2024-01-19 14:18:35', '0000-00-00 00:00:00', 'administrator', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id_pembelian_detail` int(11) NOT NULL,
  `no_pembelian` varchar(100) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` double NOT NULL,
  `harga_beli` double NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_pembelian_detail`, `no_pembelian`, `kode_barang`, `jumlah`, `harga_beli`, `subtotal`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
(3, 'NBGOR002-202401', 'BLF', 2, 150000, 300000, '2024-01-19 14:59:23', '0000-00-00 00:00:00', 'administrator', ''),
(4, 'NBGOR002-202401', 'NET', 1, 250000, 250000, '2024-01-19 14:59:48', '0000-00-00 00:00:00', 'administrator', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perubahan_modal`
--

CREATE TABLE `perubahan_modal` (
  `id_perubahan_modal` int(11) NOT NULL,
  `periode` varchar(10) NOT NULL,
  `id_kode_akuntansi` int(11) NOT NULL,
  `sampai_dengan_tanggal` date NOT NULL,
  `uraian` varchar(225) NOT NULL,
  `debet` double NOT NULL,
  `kredit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `perubahan_modal`
--

INSERT INTO `perubahan_modal` (`id_perubahan_modal`, `periode`, `id_kode_akuntansi`, `sampai_dengan_tanggal`, `uraian`, `debet`, `kredit`) VALUES
(1, '202301', 47, '2023-01-31', 'Perubahan Modal Januari 2023', 0, 5000000),
(2, '202301', 48, '2023-01-31', 'Perubahan Modal Pemilik Usaha Januari 2023', 0, 40000000),
(3, '202301', 49, '2023-01-31', 'Perubahan Modal (Rugi) Januari 2023', 10000000, 0),
(4, '202301', 50, '2023-01-31', 'Perubahan Modal (Prive) Januari 2023', 10000000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_sewa`
--

CREATE TABLE `satuan_sewa` (
  `id_satuan_sewa` int(11) NOT NULL,
  `satuan_sewa` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `satuan_sewa`
--

INSERT INTO `satuan_sewa` (`id_satuan_sewa`, `satuan_sewa`) VALUES
(1, 'Jam'),
(2, 'Member'),
(3, 'Sesi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting_penjualan_terhadap_kode_akuntansi`
--

CREATE TABLE `setting_penjualan_terhadap_kode_akuntansi` (
  `id_setting` int(11) NOT NULL,
  `kode_akun` varchar(50) NOT NULL,
  `nama_akun` varchar(100) NOT NULL,
  `posisi_saldo` varchar(10) NOT NULL COMMENT 'Kredit, Debet',
  `kode_jenis_jurnal` varchar(5) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `setting_penjualan_terhadap_kode_akuntansi`
--

INSERT INTO `setting_penjualan_terhadap_kode_akuntansi` (`id_setting`, `kode_akun`, `nama_akun`, `posisi_saldo`, `kode_jenis_jurnal`, `deskripsi`) VALUES
(1, '71.1', 'Pendapatan Sewa Lapangan', 'Kredit', 'KM', 'Laba Rugi - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(2, '11.1', 'Kas Kecil', 'Debet', 'KM', 'Neraca - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(3, '31.1', 'Penjualan Utama', 'Kredit', 'INV', 'Neraca - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(4, '0', 'Ayat Silang', 'Debet', 'INV', 'Neraca - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(5, '12.2', 'Merchant Qris', 'Debet', 'QRIS', 'Neraca - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(6, '11.1', 'Kas Kecil', 'Debet', 'CASH', 'Neraca - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(7, '71.1', 'Pendapatan Sewa Lapangan', 'Kredit', 'CNCL', 'Laba Rugi - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE `suplier` (
  `kode_suplier` varchar(100) NOT NULL,
  `nama_suplier` varchar(200) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL,
  `user_created` varchar(100) NOT NULL,
  `user_modified` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`kode_suplier`, `nama_suplier`, `alamat`, `telepon`, `email`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
('SUP001', 'Galaksy Sport', 'Waru', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pengeluaran`
--

CREATE TABLE `transaksi_pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `jumlah` double NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `status_transaksi` varchar(255) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` varchar(255) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `transaksi_pengeluaran`
--

INSERT INTO `transaksi_pengeluaran` (`id`, `tanggal`, `no_transaksi`, `jumlah`, `keterangan`, `status_transaksi`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
(16, '2024-12-31', 'PRCH030125105709', 0, 'gaji pegawai 002', 'Void', 'administrator', '2025-01-03 10:57:51', 'administrator', '2025-01-11 15:04:09'),
(17, '2024-12-20', 'PRCH090125103722', 0, 'perbaikan alas lapangan badminton A', 'Sukses', 'administrator', '2025-01-09 10:38:24', '', '0000-00-00 00:00:00'),
(18, '2025-02-05', 'PRCH050225212958', 20000, 'bahan untuk servis kipas', 'Void', 'administrator', '2025-02-05 21:32:58', 'administrator', '2025-02-05 21:34:26'),
(19, '2025-02-06', 'PRCH060225134300', 1000000, 'gaji pegawai', 'Sukses', 'administrator', '2025-02-06 13:43:20', '', '0000-00-00 00:00:00'),
(20, '2025-02-06', 'PRCH060225134328', 20000, 'Semen tiga roda 1 sak', 'Sukses', 'administrator', '2025-02-06 13:44:16', '', '0000-00-00 00:00:00'),
(21, '2025-02-07', 'PRCH070225225135', 11000, 'perlengkapan meja kasir', 'Void', 'administrator', '2025-02-07 22:52:38', 'administrator', '2025-02-12 14:14:08'),
(22, '2025-02-12', 'PRCH120225141410', 2000000, 'token listrik', 'Sukses', 'administrator', '2025-02-12 14:14:57', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pengeluaran_detil`
--

CREATE TABLE `transaksi_pengeluaran_detil` (
  `id` int(11) NOT NULL,
  `no_transaksi` varchar(255) NOT NULL,
  `id_kode_akun_debet` int(11) DEFAULT NULL,
  `id_kode_akun_kredit` int(11) DEFAULT NULL,
  `nominal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `transaksi_pengeluaran_detil`
--

INSERT INTO `transaksi_pengeluaran_detil` (`id`, `no_transaksi`, `id_kode_akun_debet`, `id_kode_akun_kredit`, `nominal`) VALUES
(46, 'PRCH030125105709', NULL, 3, 1000000),
(47, 'PRCH030125105709', NULL, 8, 1000000),
(48, 'PRCH030125105709', 39, NULL, 2000000),
(49, 'PRCH090125103722', NULL, 5, 100000),
(50, 'PRCH090125103722', 39, NULL, 1000000),
(51, 'PRCH050225212958', NULL, 3, 20000),
(52, 'PRCH050225212958', 39, NULL, 20000),
(53, 'PRCH060225134300', NULL, 3, 1000000),
(54, 'PRCH060225134300', 39, NULL, 1000000),
(55, 'PRCH060225134328', NULL, 3, 20000),
(56, 'PRCH060225134328', 39, NULL, 20000),
(57, 'PRCH070225225135', NULL, 3, 10000),
(58, 'PRCH070225225135', 39, NULL, 11000),
(59, 'PRCH120225141410', NULL, 3, 1000000),
(60, 'PRCH120225141410', NULL, 57, 1000000),
(61, 'PRCH120225141410', 40, NULL, 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_sewa`
--

CREATE TABLE `transaksi_sewa` (
  `id_transaksi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `member` varchar(5) NOT NULL COMMENT 'Ya/Tidak',
  `id_member` varchar(25) NOT NULL,
  `id_kategori_olahraga` int(11) NOT NULL,
  `id_paket_sewa` int(11) NOT NULL,
  `id_lapangan` int(11) NOT NULL,
  `lama_sewa` int(11) NOT NULL,
  `jenis_bayar` varchar(255) DEFAULT NULL,
  `metode_bayar` varchar(255) DEFAULT NULL,
  `harga` double NOT NULL,
  `diskon` double NOT NULL,
  `total` double NOT NULL,
  `status_transaksi` varchar(100) NOT NULL COMMENT 'Draft, Booking, Check-In, Selesai, Pengajuan Diskon',
  `created_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `transaksi_sewa`
--

INSERT INTO `transaksi_sewa` (`id_transaksi`, `tanggal`, `nama_pelanggan`, `no_telepon`, `member`, `id_member`, `id_kategori_olahraga`, `id_paket_sewa`, `id_lapangan`, `lama_sewa`, `jenis_bayar`, `metode_bayar`, `harga`, `diskon`, `total`, `status_transaksi`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
('TRX021224103732', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX021224104225', '2024-12-02', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 1, 1, 7, 'dp', 'qris', 70000, 10000, 490000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX030125131939', '2025-01-11', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 1, 1, 2, 'lunas', 'cash', 70000, 0, 140000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX030125132130', '2025-01-11', 'maul', '089654321', 'Ya', 'GORMBR007', 1, 1, 1, 3, 'dp', 'cash', 70000, 0, 210000, 'Cancel', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX050225211132', '2025-02-28', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 1, 1, 6, 'dp', 'qris', 0, 10000, 420000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX100125162105', '2025-01-31', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 1, 1, 2, 'dp', 'qris', 70000, 0, 140000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX100125162224', '2025-01-31', 'maul', '089654321', 'Ya', 'GORMBR007', 1, 1, 1, 10, 'dp', 'qris', 0, 10000, 700000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX120125113416', '2025-01-12', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 1, 1, 5, 'lunas', 'qris', 70000, 10000, 350000, 'Validasi', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX120225152114', '2025-02-12', 'maul', '089654321', 'Ya', 'GORMBR007', 1, 1, 1, 7, 'lunas', 'qris', 70000, 0, 490000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX120225160245', '2025-02-12', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 1, 2, 2, 'lunas', 'cash', 70000, 0, 140000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX120225201328', '2025-02-12', 'Pam', '082247292183', 'Ya', 'GORMBR005', 2, 2, 3, 3, 'lunas', 'cash', 50000, 0, 150000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX120225201409', '2025-02-12', 'jonny', '0822112211', 'Ya', 'GORMBR006', 2, 2, 5, 3, 'lunas', 'cash', 50000, 0, 150000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX120225201457', '0000-00-00', '', '', '', '', 1, 0, 2, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX121124103045', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX121124105724', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX121124105850', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX121124105950', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX121124210748', '2024-11-16', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 0, 1, 0, NULL, NULL, 0, 20000, 0, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX131024092114', '2024-10-11', 'Test Input', '09889898', 'Tidak', 'NONMEMBER', 2, 2, 3, 2, 'lunas', 'qris', 50000, 10000, 100000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX131024101256', '2024-10-16', 'Test Diskon', '09889898', 'Tidak', 'NONMEMBER', 1, 1, 1, 3, 'lunas', 'qris', 70000, 20000, 210000, 'Cancel', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX131024102524', '2024-10-13', 'Test DP', '09889898', 'Tidak', 'NONMEMBER', 2, 2, 3, 3, 'dp', 'cash', 50000, 10000, 150000, 'Cancel', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX131124082557', '2024-11-14', 'maul', '089654321', 'Ya', 'GORMBR007', 1, 1, 1, 2, 'dp', 'cash', 70000, 0, 140000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX131124083353', '2024-11-14', 'yudhis', '0878999912', 'Ya', 'GORMBR002', 1, 1, 1, 3, 'dp', 'qris', 70000, 10000, 210000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX131124084733', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX131124084830', '2024-11-15', 'winarto', '08651212', 'Ya', 'GORMBR008', 1, 1, 1, 4, 'dp', 'cash', 70000, 10000, 280000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX141024195200', '2024-10-15', 'Test Diskon Selesai', '123', 'Tidak', 'NONMEMBER', 1, 1, 1, 3, 'lunas', 'qris', 70000, 20000, 210000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX141024202855', '2024-10-13', 'Test DP Selesai', '123123', 'Tidak', 'NONMEMBER', 1, 1, 1, 3, 'dp', 'qris', 70000, 20000, 210000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX160125114714', '2025-01-30', 'Pam', '082247292183', 'Ya', 'GORMBR005', 1, 1, 1, 7, 'dp', 'qris', 70000, 5000, 490000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX160125120211', '2025-01-30', 'Pam', '082247292183', 'Ya', 'GORMBR005', 1, 0, 1, 0, NULL, NULL, 0, 10000, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX160125120253', '2025-01-29', 'Pam', '082247292183', 'Ya', 'GORMBR005', 1, 1, 1, 7, 'lunas', 'qris', 70000, 10000, 490000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX180225162809', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX181124184134', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX181124205804', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX181124205810', '2024-11-23', 'yudhis', '0878999912', 'Ya', 'GORMBR002', 2, 2, 3, 7, 'dp', 'qris', 50000, 20000, 350000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX191124150826', '2024-11-29', 'yudhis', '0878999912', 'Ya', 'GORMBR002', 1, 1, 2, 7, 'lunas', 'cash', 70000, 10000, 490000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX230225000449', '2025-02-26', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 1, 1, 3, 'lunas', 'cash', 70000, 0, 210000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX250225145836', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX250225145933', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX261024064727', '2024-10-16', 'Member Nol Satu', '09889898', 'Tidak', 'NONMEMBER', 1, 1, 2, 1, 'lunas', 'qris', 70000, 0, 70000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX261124082819', '2024-11-30', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 0, 1, 0, NULL, NULL, 0, 10000, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX261124083344', '2024-11-30', 'jonny', '0822112211', 'Ya', 'GORMBR006', 1, 1, 1, 3, 'dp', 'qris', 70000, 0, 210000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX261124191253', '0000-00-00', '', '', '', '', 1, 0, 1, 0, NULL, NULL, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_sewa_detil`
--

CREATE TABLE `transaksi_sewa_detil` (
  `id_transaksi_detil` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `id_jadwal_sesi` int(11) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `transaksi_sewa_detil`
--

INSERT INTO `transaksi_sewa_detil` (`id_transaksi_detil`, `id_transaksi`, `id_jadwal_sesi`, `harga`) VALUES
(69, 'TRX131024101256', 1, 70000),
(70, 'TRX131024101256', 2, 70000),
(71, 'TRX131024101256', 3, 70000),
(72, 'TRX131024102524', 10, 50000),
(73, 'TRX131024102524', 11, 50000),
(74, 'TRX131024102524', 12, 50000),
(75, 'TRX141024195200', 1, 70000),
(76, 'TRX141024195200', 2, 70000),
(77, 'TRX141024195200', 3, 70000),
(78, 'TRX141024202855', 1, 70000),
(79, 'TRX141024202855', 2, 70000),
(80, 'TRX141024202855', 3, 70000),
(81, 'TRX261024064727', 1, 70000),
(92, 'TRX131124082557', 1, 70000),
(93, 'TRX131124082557', 2, 70000),
(94, 'TRX131124083353', 26, 70000),
(95, 'TRX131124083353', 27, 70000),
(96, 'TRX131124083353', 28, 70000),
(97, 'TRX131124084830', 24, 70000),
(98, 'TRX131124084830', 25, 70000),
(99, 'TRX131124084830', 26, 70000),
(100, 'TRX131124084830', 27, 70000),
(101, 'TRX181124205810', 10, 50000),
(102, 'TRX181124205810', 11, 50000),
(103, 'TRX181124205810', 12, 50000),
(104, 'TRX181124205810', 13, 50000),
(105, 'TRX181124205810', 14, 50000),
(106, 'TRX181124205810', 15, 50000),
(107, 'TRX181124205810', 16, 50000),
(108, 'TRX191124150826', 1, 70000),
(109, 'TRX191124150826', 2, 70000),
(110, 'TRX191124150826', 3, 70000),
(111, 'TRX191124150826', 4, 70000),
(112, 'TRX191124150826', 5, 70000),
(113, 'TRX191124150826', 6, 70000),
(114, 'TRX191124150826', 7, 70000),
(115, 'TRX261124083344', 1, 70000),
(116, 'TRX261124083344', 2, 70000),
(117, 'TRX261124083344', 3, 70000),
(118, 'TRX021224104225', 1, 70000),
(119, 'TRX021224104225', 2, 70000),
(120, 'TRX021224104225', 3, 70000),
(121, 'TRX021224104225', 4, 70000),
(122, 'TRX021224104225', 5, 70000),
(123, 'TRX021224104225', 6, 70000),
(124, 'TRX021224104225', 7, 70000),
(125, 'TRX030125131939', 1, 70000),
(126, 'TRX030125131939', 2, 70000),
(127, 'TRX030125132130', 3, 70000),
(128, 'TRX030125132130', 4, 70000),
(129, 'TRX030125132130', 5, 70000),
(130, 'TRX100125162105', 1, 70000),
(131, 'TRX100125162105', 2, 70000),
(132, 'TRX100125162224', 24, 70000),
(133, 'TRX100125162224', 25, 70000),
(134, 'TRX100125162224', 26, 70000),
(135, 'TRX100125162224', 27, 70000),
(136, 'TRX100125162224', 28, 70000),
(137, 'TRX100125162224', 24, 70000),
(138, 'TRX100125162224', 25, 70000),
(139, 'TRX100125162224', 26, 70000),
(140, 'TRX100125162224', 27, 70000),
(141, 'TRX100125162224', 28, 70000),
(142, 'TRX120125113416', 1, 70000),
(143, 'TRX120125113416', 2, 70000),
(144, 'TRX120125113416', 3, 70000),
(145, 'TRX120125113416', 4, 70000),
(146, 'TRX120125113416', 5, 70000),
(147, 'TRX160125114714', 1, 70000),
(148, 'TRX160125114714', 2, 70000),
(149, 'TRX160125114714', 3, 70000),
(150, 'TRX160125114714', 4, 70000),
(151, 'TRX160125114714', 5, 70000),
(152, 'TRX160125114714', 6, 70000),
(153, 'TRX160125114714', 7, 70000),
(154, 'TRX160125120253', 22, 70000),
(155, 'TRX160125120253', 23, 70000),
(156, 'TRX160125120253', 24, 70000),
(157, 'TRX160125120253', 25, 70000),
(158, 'TRX160125120253', 26, 70000),
(159, 'TRX160125120253', 27, 70000),
(160, 'TRX160125120253', 28, 70000),
(161, 'TRX050225211132', 1, 70000),
(162, 'TRX050225211132', 2, 70000),
(163, 'TRX050225211132', 3, 70000),
(164, 'TRX050225211132', 4, 70000),
(165, 'TRX050225211132', 5, 70000),
(166, 'TRX050225211132', 6, 70000),
(167, 'TRX120225152114', 1, 70000),
(168, 'TRX120225152114', 2, 70000),
(169, 'TRX120225152114', 3, 70000),
(170, 'TRX120225152114', 4, 70000),
(171, 'TRX120225152114', 5, 70000),
(172, 'TRX120225152114', 6, 70000),
(173, 'TRX120225152114', 7, 70000),
(174, 'TRX120225160245', 27, 70000),
(175, 'TRX120225160245', 28, 70000),
(176, 'TRX120225201328', 13, 50000),
(177, 'TRX120225201328', 14, 50000),
(178, 'TRX120225201328', 15, 50000),
(179, 'TRX120225201409', 20, 50000),
(180, 'TRX120225201409', 21, 50000),
(181, 'TRX120225201409', 29, 50000),
(182, 'TRX230225000449', 1, 70000),
(183, 'TRX230225000449', 2, 70000),
(184, 'TRX230225000449', 3, 70000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_sewa_tanggal`
--

CREATE TABLE `transaksi_sewa_tanggal` (
  `id` int(11) NOT NULL,
  `id_transaksi` varchar(255) DEFAULT NULL,
  `tanggal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `transaksi_sewa_tanggal`
--

INSERT INTO `transaksi_sewa_tanggal` (`id`, `id_transaksi`, `tanggal`) VALUES
(2, 'TRX261024064727', '2024-10-16'),
(3, 'TRX261024064727', '2024-10-24'),
(20, 'TRX121124210748', '2024-11-16'),
(21, 'TRX131124082557', '2024-11-14'),
(22, 'TRX131124083353', '2024-11-14'),
(23, 'TRX131124084830', '2024-11-15'),
(24, 'TRX181124205810', '2024-11-23'),
(25, 'TRX191124150826', '2024-11-29'),
(26, 'TRX261124082819', '2024-11-30'),
(27, 'TRX261124083344', '2024-11-30'),
(28, 'TRX021224104225', '2024-12-02'),
(29, 'TRX030125131939', '2025-01-11'),
(30, 'TRX030125132130', '2025-01-11'),
(31, 'TRX100125162105', '2025-01-31'),
(33, 'TRX100125162224', '2025-01-31'),
(36, 'TRX120125113416', '2025-01-12'),
(37, 'TRX160125114714', '2025-01-30'),
(38, 'TRX160125120211', '2025-01-30'),
(39, 'TRX160125120253', '2025-01-29'),
(40, 'TRX050225211132', '2025-02-28'),
(41, 'TRX120225152114', '2025-02-12'),
(42, 'TRX120225152302', '2025-02-12'),
(43, 'TRX120225152327', '2025-02-12'),
(44, 'TRX120225152345', '2025-02-12'),
(45, 'TRX120225160245', '2025-02-12'),
(46, 'TRX120225201328', '2025-02-12'),
(47, 'TRX120225201409', '2025-02-12'),
(48, 'TRX230225000449', '2025-02-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `foto` text NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `username`, `password`, `hak_akses`, `foto`, `status`) VALUES
(1, 'Administrator', 'administrator', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator', 'admin.png', 'Aktif'),
(3, 'staff penjualan', 'staff', '81dc9bdb52d04dc20036dbd8313ed055', 'Staff', '1.png', 'Aktif'),
(4, 'Admin 2', 'administrator2', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator', '1.png', 'Aktif'),
(5, 'Pemilik', 'pemilik', '81dc9bdb52d04dc20036dbd8313ed055', 'Pemilik', '1.png', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`) USING BTREE;

--
-- Indeks untuk tabel `check_in_out`
--
ALTER TABLE `check_in_out`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `jadwal_sesi`
--
ALTER TABLE `jadwal_sesi`
  ADD PRIMARY KEY (`id_jadwal_sesi`) USING BTREE;

--
-- Indeks untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  ADD PRIMARY KEY (`id_jurnal`) USING BTREE;

--
-- Indeks untuk tabel `jurnal_umum_detail`
--
ALTER TABLE `jurnal_umum_detail`
  ADD PRIMARY KEY (`id_jurnal_detail`) USING BTREE;

--
-- Indeks untuk tabel `kategori_olahraga`
--
ALTER TABLE `kategori_olahraga`
  ADD PRIMARY KEY (`id_kategori_olahraga`) USING BTREE;

--
-- Indeks untuk tabel `kode_akuntansi`
--
ALTER TABLE `kode_akuntansi`
  ADD PRIMARY KEY (`id_kode_akuntansi`) USING BTREE;

--
-- Indeks untuk tabel `kode_jenis_jurnal`
--
ALTER TABLE `kode_jenis_jurnal`
  ADD PRIMARY KEY (`kode_jenis_jurnal`) USING BTREE;

--
-- Indeks untuk tabel `kuota_fitness`
--
ALTER TABLE `kuota_fitness`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  ADD PRIMARY KEY (`id_lapangan`) USING BTREE;

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `member_pelanggan`
--
ALTER TABLE `member_pelanggan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `member_trx`
--
ALTER TABLE `member_trx`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `paket_sewa`
--
ALTER TABLE `paket_sewa`
  ADD PRIMARY KEY (`id_paket_sewa`) USING BTREE;

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_pembelian`) USING BTREE;

--
-- Indeks untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id_pembelian_detail`) USING BTREE;

--
-- Indeks untuk tabel `perubahan_modal`
--
ALTER TABLE `perubahan_modal`
  ADD PRIMARY KEY (`id_perubahan_modal`) USING BTREE;

--
-- Indeks untuk tabel `satuan_sewa`
--
ALTER TABLE `satuan_sewa`
  ADD PRIMARY KEY (`id_satuan_sewa`) USING BTREE;

--
-- Indeks untuk tabel `setting_penjualan_terhadap_kode_akuntansi`
--
ALTER TABLE `setting_penjualan_terhadap_kode_akuntansi`
  ADD PRIMARY KEY (`id_setting`) USING BTREE;

--
-- Indeks untuk tabel `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`kode_suplier`) USING BTREE;

--
-- Indeks untuk tabel `transaksi_pengeluaran`
--
ALTER TABLE `transaksi_pengeluaran`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `transaksi_pengeluaran_detil`
--
ALTER TABLE `transaksi_pengeluaran_detil`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `transaksi_sewa`
--
ALTER TABLE `transaksi_sewa`
  ADD PRIMARY KEY (`id_transaksi`) USING BTREE;

--
-- Indeks untuk tabel `transaksi_sewa_detil`
--
ALTER TABLE `transaksi_sewa_detil`
  ADD PRIMARY KEY (`id_transaksi_detil`) USING BTREE;

--
-- Indeks untuk tabel `transaksi_sewa_tanggal`
--
ALTER TABLE `transaksi_sewa_tanggal`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id` (`id`) USING BTREE,
  ADD KEY `username` (`username`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `check_in_out`
--
ALTER TABLE `check_in_out`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `hak_akses`
--
ALTER TABLE `hak_akses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `jadwal_sesi`
--
ALTER TABLE `jadwal_sesi`
  MODIFY `id_jadwal_sesi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `jurnal_umum`
--
ALTER TABLE `jurnal_umum`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT untuk tabel `jurnal_umum_detail`
--
ALTER TABLE `jurnal_umum_detail`
  MODIFY `id_jurnal_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT untuk tabel `kategori_olahraga`
--
ALTER TABLE `kategori_olahraga`
  MODIFY `id_kategori_olahraga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kode_akuntansi`
--
ALTER TABLE `kode_akuntansi`
  MODIFY `id_kode_akuntansi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `lapangan`
--
ALTER TABLE `lapangan`
  MODIFY `id_lapangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `member_pelanggan`
--
ALTER TABLE `member_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `member_trx`
--
ALTER TABLE `member_trx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `paket_sewa`
--
ALTER TABLE `paket_sewa`
  MODIFY `id_paket_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id_pembelian_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `perubahan_modal`
--
ALTER TABLE `perubahan_modal`
  MODIFY `id_perubahan_modal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `satuan_sewa`
--
ALTER TABLE `satuan_sewa`
  MODIFY `id_satuan_sewa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `setting_penjualan_terhadap_kode_akuntansi`
--
ALTER TABLE `setting_penjualan_terhadap_kode_akuntansi`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pengeluaran`
--
ALTER TABLE `transaksi_pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pengeluaran_detil`
--
ALTER TABLE `transaksi_pengeluaran_detil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `transaksi_sewa_detil`
--
ALTER TABLE `transaksi_sewa_detil`
  MODIFY `id_transaksi_detil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT untuk tabel `transaksi_sewa_tanggal`
--
ALTER TABLE `transaksi_sewa_tanggal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

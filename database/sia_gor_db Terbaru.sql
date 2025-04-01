-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Agu 2024 pada 10.20
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
-- Database: `sia_gor_db`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `satuan`, `stok`, `status_aktif`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
('BLF', 'Bola Futsal', 'Pcs', 10, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
('NET', 'Net', 'Pcs', 4, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', ''),
('SK', 'Shuttlecock', 'Pcs', 50, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hak_akses`
--

INSERT INTO `hak_akses` (`id`, `hak_akses`, `akses_create`, `akses_read`, `akses_update`, `akses_delete`, `akses_cetak`, `menu_master`, `menu_pengguna`, `menu_operasional`, `menu_akuntansi`) VALUES
(1, 'Administrator', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif', 'Aktif'),
(2, 'Penjualan', 'Aktif', 'Aktif', 'Aktif', 'Aktif', '', '', 'Aktif', 'Aktif', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_sesi`
--

CREATE TABLE `jadwal_sesi` (
  `id_jadwal_sesi` int(11) NOT NULL,
  `id_kategori_olahraga` int(11) NOT NULL,
  `jam_sesi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal_umum`
--

INSERT INTO `jurnal_umum` (`id_jurnal`, `periode`, `kode_jenis_jurnal`, `no_bukti`, `tanggal`, `no_referensi`, `dari`, `kepada`, `keterangan`, `last_numb_perperiode`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
(1, '202406', 'BM', 'BM001-202406', '2024-06-21', 'TRXFITNES0001', '', '', '', 1, '2024-06-21 18:56:01', '0000-00-00 00:00:00', 'administrator', ''),
(2, '202406', 'BM', 'BM002-202406', '2024-06-21', 'TRXFITNES0001', '', '', '', 2, '2024-06-21 19:40:02', '0000-00-00 00:00:00', 'administrator', ''),
(3, '202406', 'BM', 'BM003-202406', '2024-06-21', 'TRXFITNES0002', '', '', '', 3, '2024-06-21 19:41:07', '0000-00-00 00:00:00', 'administrator', '');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurnal_umum_detail`
--

INSERT INTO `jurnal_umum_detail` (`id_jurnal_detail`, `no_bukti`, `id_kode_akuntansi`, `uraian`, `debet`, `kredit`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
(1, 'BM001-202406', 38, 'Fitnes', 100000, 0, '2024-06-21 18:56:01', '0000-00-00 00:00:00', 'administrator', ''),
(2, 'BM002-202406', 38, 'Fitnes', 0, 100000, '2024-06-21 19:40:02', '0000-00-00 00:00:00', 'administrator', ''),
(3, 'BM003-202406', 38, 'Fitnes', 100000, 0, '2024-06-21 19:41:07', '0000-00-00 00:00:00', 'administrator', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_olahraga`
--

CREATE TABLE `kategori_olahraga` (
  `id_kategori_olahraga` int(11) NOT NULL,
  `kategori_olahraga` varchar(100) NOT NULL,
  `memiliki_lapangan` int(11) NOT NULL COMMENT 'Ya=1, Tidak=0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori_olahraga`
--

INSERT INTO `kategori_olahraga` (`id_kategori_olahraga`, `kategori_olahraga`, `memiliki_lapangan`) VALUES
(1, 'Futsal', 1),
(2, 'Badminton', 1),
(3, 'Fitnes', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kode_akuntansi`
--

INSERT INTO `kode_akuntansi` (`id_kode_akuntansi`, `level`, `is_parent`, `kode_parent`, `kode_akun`, `nama_akun`, `saldo_normal`, `pos`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
(1, 2, 0, '-', '0', 'Ayat Silang', 'Debet', 'Neraca', '0000-00-00 00:00:00', '2023-12-05 14:33:18', 'admin', 'administrator'),
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
(25, 1, 1, '-', '41', 'HARGA POKOK PENJUALAN', 'Debet', 'Neraca', '2023-05-12 22:04:50', '0000-00-00 00:00:00', 'admin', ''),
(26, 2, 0, '41', '41.1', 'Harga Pokok Penjualan Sewa', 'Debet', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(31, 1, 1, '-', '51', 'ADMIN BANK', 'Debet', 'Neraca', '2023-05-12 22:04:50', '0000-00-00 00:00:00', 'admin', ''),
(32, 2, 0, '51', '51.1', 'Admin Bank BCA', 'Debet', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
(33, 2, 0, '51', '51.2', 'Admin Bank Mandiri', 'Debet', 'Neraca', '2023-05-12 22:05:37', '0000-00-00 00:00:00', 'admin', ''),
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
(53, 2, 0, '71', '71.3', 'Pendapatan Lain ', 'Kredit', 'Laba Rugi', '2024-05-28 11:30:36', '0000-00-00 00:00:00', 'administrator', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kode_jenis_jurnal`
--

CREATE TABLE `kode_jenis_jurnal` (
  `kode_jenis_jurnal` varchar(5) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id` int(11) NOT NULL,
  `kodeMember` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nope` varchar(30) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `usia` varchar(10) DEFAULT NULL,
  `jk` varchar(11) DEFAULT NULL,
  `expired_member` date DEFAULT NULL,
  `user_create` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id`, `kodeMember`, `nama`, `nope`, `email`, `alamat`, `usia`, `jk`, `expired_member`, `user_create`, `created_at`) VALUES
(1, 'MBR0001', 'Pariatur Incididunt', 'Aute unde dolore adi', 'jagori@mailinator.com', 'Est eu ut aliquam pr', NULL, '- - - Pilih', '2024-07-21', NULL, '2024-06-21'),
(2, 'MBR0002', 'Ullamco iste volupta', 'Est laborum Aute ni', 'vodo@mailinator.com', 'Autem commodo dignis', NULL, 'L', '2024-07-22', NULL, '2024-06-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member_pelanggan`
--

CREATE TABLE `member_pelanggan` (
  `id_member` varchar(25) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `usia` varchar(5) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member_pelanggan`
--

INSERT INTO `member_pelanggan` (`id_member`, `nama_pelanggan`, `no_telepon`, `email`, `alamat`, `usia`, `jenis_kelamin`) VALUES
('GORMBR001', 'Member Nol Satu', '088255244', 'membersatu@gmail.ocm', 'sidoarjo', '25', 'Laki-laki');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member_trx`
--

INSERT INTO `member_trx` (`id`, `memberID`, `nomorTransaksi`, `paketID`, `harga`, `metodebayar`, `durasiMember`, `tanggalMulai`, `tanggalSelesai`, `created_at`) VALUES
(1, 1, 'TRXFITNES0001', 3, 100000, 'cash', '30', '2024-06-21', '2024-07-21', '2024-06-21'),
(2, 2, 'TRXFITNES0002', 3, 100000, 'qris', '30', '2024-06-22', '2024-07-22', '2024-06-21');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_sewa`
--

INSERT INTO `paket_sewa` (`id_paket_sewa`, `id_kategori_olahraga`, `id_satuan`, `harga`, `info`) VALUES
(1, 1, 3, 70000, ''),
(2, 2, 3, 50000, ''),
(3, 3, 2, 100000, 'Per Bulan');

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
  `status` int(11) DEFAULT NULL,
  `NA` char(1) NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `setting_penjualan_terhadap_kode_akuntansi`
--

INSERT INTO `setting_penjualan_terhadap_kode_akuntansi` (`id_setting`, `kode_akun`, `nama_akun`, `posisi_saldo`, `kode_jenis_jurnal`, `deskripsi`) VALUES
(1, '71.1', 'Pendapatan Sewa Lapangan', 'Kredit', 'KM', 'Laba Rugi - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(2, '11.1', 'Kas Kecil', 'Debet', 'KM', 'Neraca - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(3, '31.1', 'Penjualan Utama', 'Kredit', 'INV', 'Neraca - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(4, '0', 'Ayat Silang', 'Debet', 'INV', 'Neraca - Setup penjualan otomatis masuk ke jurnal akuntansi sesuai kode akun'),
(5, '71.2', 'Pendapatan Fitness', 'Debet', 'BM', 'tes'),
(6, '71.2', 'Pendapatan Fitness', 'Kredit', 'BM', 'tes');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`kode_suplier`, `nama_suplier`, `alamat`, `telepon`, `email`, `created_at`, `modified_at`, `user_created`, `user_modified`) VALUES
('SUP001', 'Galaksy Sport', 'Waru', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '');

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
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `status_transaksi` varchar(15) NOT NULL COMMENT 'Draft, Booking, Check-In, Selesai',
  `created_by` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` varchar(100) NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_sewa`
--

INSERT INTO `transaksi_sewa` (`id_transaksi`, `tanggal`, `nama_pelanggan`, `no_telepon`, `member`, `id_member`, `id_kategori_olahraga`, `id_paket_sewa`, `id_lapangan`, `lama_sewa`, `harga`, `total`, `status_transaksi`, `created_by`, `created_at`, `modified_by`, `modified_at`) VALUES
('TRX030124135806', '2024-01-03', 'Member Nol Satu', '088255244', 'Ya', 'GORMBR001', 1, 1, 1, 3, 0, 450000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX030124165515', '2024-01-04', 'Diana', '098765432', 'Tidak', 'NONMEMBER', 1, 1, 2, 4, 150000, 600000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX030124165710', '2024-01-04', 'Dav', '2423565746354', 'Tidak', 'NONMEMBER', 1, 1, 3, 2, 150000, 300000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX060524144438', '2024-06-01', 'Johny', '082247292183', 'Tidak', 'NONMEMBER', 1, 1, 1, 2, 150000, 300000, 'Selesai', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX060524144830', '2024-06-01', 'Puyol', '0812121212', 'Tidak', 'NONMEMBER', 1, 1, 1, 2, 150000, 300000, 'Check-In', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX060524161038', '2024-06-01', 'Yudhis', '0812231232', 'Tidak', 'NONMEMBER', 1, 1, 1, 2, 150000, 300000, 'Check-In', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX190124121115', '2024-01-17', 'YUDHIS', '0312345678', 'Tidak', 'NONMEMBER', 2, 2, 4, 3, 80000, 240000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX190524174941', '2024-06-01', 'Dani', '099999', 'Tidak', 'NONMEMBER', 1, 1, 1, 1, 150000, 150000, 'Booking', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX200524003907', '0000-00-00', '', '', '', '', 1, 0, 1, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX200524090122', '2024-06-02', 'wawan', '08080808', 'Tidak', 'NONMEMBER', 1, 0, 1, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX200524090200', '2024-06-01', 'wawan', '099999', 'Tidak', 'NONMEMBER', 1, 0, 1, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX200524090412', '2024-06-01', 'Pam', '0812121212', 'Tidak', 'NONMEMBER', 2, 0, 3, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX200524091624', '2024-06-05', 'Pam', '0812231232', 'Tidak', 'NONMEMBER', 1, 0, 1, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
('TRX200524091658', '2024-05-21', 'Pam', '082247292183', 'Tidak', 'NONMEMBER', 2, 0, 3, 0, 0, 0, 'Draft', '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_sewa_detil`
--

CREATE TABLE `transaksi_sewa_detil` (
  `id_transaksi_detil` int(11) NOT NULL,
  `id_transaksi` varchar(100) NOT NULL,
  `id_jadwal_sesi` int(11) NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_sewa_detil`
--

INSERT INTO `transaksi_sewa_detil` (`id_transaksi_detil`, `id_transaksi`, `id_jadwal_sesi`, `harga`) VALUES
(2, 'TRX030124135806', 2, 150000),
(3, 'TRX030124135806', 3, 150000),
(4, 'TRX030124135806', 4, 150000),
(6, 'TRX030124165515', 1, 150000),
(7, 'TRX030124165515', 2, 150000),
(8, 'TRX030124165515', 3, 150000),
(9, 'TRX030124165515', 4, 150000),
(10, 'TRX030124165710', 5, 150000),
(13, 'TRX030124165710', 7, 150000),
(14, 'TRX190124121115', 10, 80000),
(15, 'TRX190124121115', 11, 80000),
(16, 'TRX190124121115', 12, 80000),
(17, 'TRX060524144438', 1, 150000),
(18, 'TRX060524144438', 2, 150000),
(19, 'TRX060524144830', 4, 150000),
(20, 'TRX060524144830', 6, 150000),
(21, 'TRX060524161038', 5, 150000),
(23, 'TRX060524161038', 7, 150000),
(24, 'TRX190524174941', 3, 150000);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama_lengkap`, `username`, `password`, `hak_akses`, `foto`, `status`) VALUES
(1, 'Administrator', 'administrator', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator', 'admin.png', 'Aktif'),
(3, 'Penjualan', 'penjualan', '81dc9bdb52d04dc20036dbd8313ed055', 'Penjualan', '1.jpg', 'Aktif'),
(4, 'Admin 2', 'administrator2', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator', '1.png', '1');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

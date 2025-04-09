SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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
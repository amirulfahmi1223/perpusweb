-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Mar 2024 pada 01.18
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ukk2024`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_admin`
--

CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telepon` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `level` enum('Admin','Petugas') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `nama`, `telepon`, `email`, `username`, `password`, `foto`, `level`, `created_at`, `updated_at`, `status`) VALUES
(1, 'M.AMIRUL FAHMI', '082338928028', 'amirulfahmi148@gmail.com', 'fahmi', '123', 'profil1709684143.jpeg', 'Admin', '2024-01-11 17:41:48', '2024-03-06 07:15:43', 1),
(4, 'Nadia Shivana', '082338929230', 'nadia7262@gmail.com', 'nadia', '123', 'new-default.png', 'Petugas', '2024-02-07 13:15:34', '2024-03-06 07:18:19', 1),
(7, 'M.AMIRUL FAHMI', '082338928025', 'amirulfahmi148@gmail.com', 'fahmi123', '123', 'new-default.png', 'Petugas', '2024-02-16 09:05:02', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `id_anggota` char(11) NOT NULL,
  `nisn` varchar(16) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kelas` varchar(25) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` varchar(40) DEFAULT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_anggota`
--

INSERT INTO `tb_anggota` (`id_anggota`, `nisn`, `nama`, `kelas`, `username`, `password`, `foto`, `created_at`, `updated_at`, `status`) VALUES
('USR-0001', '005922393', 'Nadia Shivana', 'XI RPL2', 'fahmi', '123', 'profil1708088301.jpeg', '2024-01-26 17:00:00', '2024-02-16 19:58:21', 1),
('USR-0002', '0059223933', 'Nadia Shivana', 'X RPL4', 'admin', '123', 'profil1706865366.jpeg', '2024-01-26 17:00:00', '2024-02-02 16:16:06', 1),
('USR-0003', '59223933', 'M.AMIRUL FAHMI', 'XII RPL2', 'rubymum', '123', 'new-default.png', '2024-02-08 18:06:27', NULL, 1),
('USR-0004', '0062152918', 'Naruto Shipuden', 'XI TB1', 'naruto', '123', 'profil1707461297.jpeg', '2024-02-08 18:37:12', '2024-02-09 13:48:17', 1),
('USR-0005', '0059223933', 'Zidan  Rahman', 'XI RPL2', 'zidan', '123', 'profil1707482489.jpeg', '2024-02-09 00:40:41', '2024-02-09 19:41:29', 1),
('USR-0006', '029736734', 'Ahmad Firdaus', 'X-TP', 'afirdaus', '123', 'new-default.png', '2024-02-16 01:38:09', NULL, 1),
('USR-0007', '000273635', 'Putri Indah', 'X-GP', 'pindah', '123', 'image1709683963.jpg', '2024-02-16 01:39:01', '2024-03-06 07:12:43', 1),
('USR-0008', '59345673', 'Budi Santoso', 'X-RPL1', 'bsantoso', '123', 'profil1708326597.jpg', '2024-02-16 01:40:09', '2024-02-19 14:09:57', 1),
('USR-0009', '006215213', 'Dewi Lestari', 'X-PH', 'dlestari', '123', 'new-default.png', '2024-02-16 01:41:00', NULL, 1),
('USR-0010', '005243745', ' Rudi Setiawan', 'X-KL', ' rsetiawan', '123', 'new-default.png', '2024-02-16 01:41:38', NULL, 1),
('USR-0011', '00635242', 'Siti Rahayu', 'X-RPL2', 'srahayu', '123', 'new-default.png', '2024-02-16 01:42:54', NULL, 1),
('USR-0012', '00425347', 'Irfan Nugroho', 'X-ATR', 'inugroho', '123', 'new-default.png', '2024-02-16 01:43:39', NULL, 1),
('USR-0013', '00872543', ' Hadi Prabowo', 'XI-TP', 'rabowo12', '123', 'new-default.png', '2024-02-16 01:44:23', NULL, 1),
('USR-0014', '0976354343', 'Nita Handayani', 'XI-GP', ' nhandayani', '123', 'new-default.png', '2024-02-16 01:46:05', NULL, 1),
('USR-0015', '008844233', 'Tri Wulandari', 'XI-RPL', 'twulan', '123', 'new-default.png', '2024-02-16 01:46:34', NULL, 1),
('USR-0016', '005566778', ' Andi Susanto', 'XI-PH', 'susantoo', '123', 'new-default.png', '2024-02-16 01:47:13', NULL, 1),
('USR-0017', '004466222', ' Maya Puspita', 'XI-KL', 'maya23', '123', 'new-default.png', '2024-02-16 01:48:17', NULL, 1),
('USR-0018', '00992166', 'Rina Sari', 'XII-RPL', 'sariroti12', '123', 'new-default.png', '2024-02-16 01:48:52', NULL, 1),
('USR-0019', '007888213', 'Hendra Agustina', 'XII-RPL2', 'hendra44', '123', 'new-default.png', '2024-02-16 01:49:39', NULL, 1),
('USR-0020', '00778856', 'Ando Srikandi', 'XII-RPL', 'srikandi22', '123', 'new-default.png', '2024-02-16 01:50:27', NULL, 1),
('USR-0021', '0062152934', 'ALEX SISWATO', 'XII-RPL2', 'alex', '123', 'new-default.png', '2024-02-18 18:19:13', NULL, 1),
('USR-0022', '0062152918', 'M. AMIRUL FAHMI', 'XII-RPL2', 'fahmi1', '123', 'new-default.png', '2024-02-20 05:03:35', NULL, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` char(13) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `th_terbit` date DEFAULT NULL,
  `id_kategori` int(11) NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `lokasi` varchar(25) NOT NULL,
  `gambar` varchar(50) NOT NULL,
  `created_by` int(11) NOT NULL,
  `tgl_input` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `th_terbit`, `id_kategori`, `jumlah_buku`, `lokasi`, `gambar`, `created_by`, `tgl_input`) VALUES
('BK-0001', 'Pemograman Web', 'Amirul Fahmi S.Kom Gr', 'Sinar jaya', '2024-01-10', 6, 12, 'RAK-8C', 'image1706585780.jpeg', 1, '2024-01-29'),
('BK-0002', 'Belajar Coding', 'Suntoyo Mashuri S.Kom', 'Go Yon', '2024-01-09', 6, 12, 'RAK-6D', 'image1706585891.jpeg', 1, '2024-01-29'),
('BK-0003', 'Politik Islam', 'Mashuriyan S.sh', 'Sinar jaya', '2024-01-03', 12, 0, 'RAK-8C', 'image1706585251.jpeg', 1, '2024-01-30'),
('BK-0004', 'Ilmu Politik', 'Drs. Bustomi Iskandar M.Sh', 'Sinar jaya', '2023-12-31', 12, 5, 'RAK-8D', 'buku1706585166.jpeg', 1, '2024-01-30'),
('BK-0005', 'Pemograman X', 'Fahmi S.Pd', 'Jaya Tbk', '2024-01-06', 6, 40, 'RAK-8D', 'buku1706585981.jpeg', 1, '2024-01-30'),
('BK-0006', 'Ekonomi Makro', 'Hartoyo S,E', 'Sinar jaya', '2024-01-17', 10, 5, 'RAK-8D', 'buku1706586674.jpeg', 1, '2024-01-30'),
('BK-0007', 'NENEK KU ZOMBIE', 'Ririn Susana', 'Javana Komik', '2018-07-09', 13, 8, 'A-45', 'buku1708316784.jpg', 1, '2024-02-19'),
('BK-0008', 'Mermaid Message', 'Susanti ', 'PT. Limas Tigas', '2020-05-19', 13, 14, 'A-45', 'buku1708317011.jpg', 1, '2024-02-19'),
('BK-0009', 'Basket Boys', 'Puji Hartoyo S.pd', 'PT. Limas Tigas', '2023-01-23', 13, 10, 'A-45', 'buku1708317107.jpg', 1, '2024-02-19'),
('BK-0010', 'Unicorn Party', 'Luki Fadilah', 'PT. Limas Tigas', '2024-02-13', 13, 14, 'RAK-8D', 'buku1708317501.jpg', 1, '2024-02-19'),
('BK-0011', 'Hacker Cilik', 'Paddya Indrawan', 'Go Yon', '2020-05-11', 13, 8, 'A-45', 'buku1708317662.jpg', 1, '2024-02-19'),
('BK-0012', 'Jagoan Karate', 'Dimas Agustina', 'Jaya Tbk', '2020-06-16', 13, 11, 'A-45', 'buku1708317772.jpg', 1, '2024-02-19'),
('BK-0013', 'Kamu tak harus sempurna', 'Anastasia M.Si', 'Pendekar Jaya', '2023-05-15', 2, 15, 'RAK-B11', 'buku1708318038.jpg', 1, '2024-02-19'),
('BK-0014', 'azgara', 'Anita Lestari S.Pd', 'Jannah lomo', '2024-02-07', 2, 20, 'RAK-8C', 'buku1708318179.jpg', 1, '2024-02-19'),
('BK-0015', 'Karzey ', 'Zizimarlan', 'PT. Limas Tigas', '2023-02-20', 2, 19, 'RAK-8D', 'buku1708318403.jpg', 1, '2024-02-19'),
('BK-0016', 'Senja Hujan cerita', 'Muslih Supriyanto', 'Jaya Tbk', '2024-02-06', 2, 11, 'RAK-6D', 'buku1708321605.jpg', 1, '2024-02-19'),
('BK-0017', 'Badboys Sholeh', 'Cintya Putri', 'PT. Limas Tigas', '2022-06-14', 2, 14, 'RAK-AK44', 'buku1708321693.jpg', 1, '2024-02-19'),
('BK-0018', 'Kamus Bahasa Jepang', 'Mitika Sinzui', 'Putra Yas ', '2024-02-13', 7, 15, 'RAK-8D', 'buku1708321870.jpg', 1, '2024-02-19'),
('BK-0019', 'Bahasa Inggris 999Triliun', 'Sukamti M.Pd', 'Jaya Tbk', '2019-05-22', 7, 21, 'RAK-C9', 'buku1708322054.jpg', 1, '2024-02-19'),
('BK-0020', 'Bahasa Jepang', 'Matrio M.Pd', 'PT. Limas Tigas', '2024-02-15', 7, 12, 'RAK-8C', 'buku1708322109.jpg', 1, '2024-02-19'),
('BK-0021', 'Ekonomi Moneter', 'Budiono', 'Piji Poros', '2022-05-24', 10, 15, 'RAK-B11', 'buku1708322235.jpg', 1, '2024-02-19'),
('BK-0022', 'Ekonomi Bisnis', 'Suhardi', 'Cimas Cendikia', '2021-02-19', 10, 33, 'RAK-8D', 'buku1708325975.jpg', 1, '2024-02-19'),
('BK-0023', 'Kamus Bahasa Indonesia', 'Krakatau Simatulu', 'PT. Limas Tigas', '2023-06-06', 7, 12, 'RAK A-45', 'buku1708326050.jpg', 1, '2024-02-19'),
('BK-0024', 'Kamus Lengkap', 'Shifa Muljoko', 'Jaya Tbk', '2024-02-14', 7, 10, 'RAK-B11', 'buku1708326130.jpg', 1, '2024-02-19'),
('BK-0025', 'Psikologi Hukum', 'Anas Riyadi', 'Pintrer Muslih', '2022-05-19', 11, 6, 'RAK-6D', 'buku1708326296.jpg', 1, '2024-02-19'),
('BK-0026', 'Filsafat Hukum', 'Paddya Indrawan M.Sh', 'Go Yon', '2024-02-07', 11, 14, 'RAK-AK44', 'buku1708326358.jpg', 1, '2024-02-19'),
('BK-0027', 'Cyber Law', 'Drs. Didik Andika', 'Jakarta Publik', '2022-11-22', 11, 5, 'RAK-B11', 'buku1708326477.jpg', 1, '2024-02-19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`, `created_at`) VALUES
(2, 'Novel', '2024-01-29'),
(6, 'Pemograman', '2024-01-30'),
(7, 'Bahasa', '2024-01-30'),
(8, 'Kesenian dan Hiburan', '2024-01-30'),
(10, 'Ekonomi', '2024-01-30'),
(11, 'Hukum', '2024-01-30'),
(12, 'Ilmu Politik', '2024-01-30'),
(13, 'Komik', '2024-02-16'),
(14, 'Sejarah', '2024-02-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_koleksi`
--

CREATE TABLE `tb_koleksi` (
  `id_koleksi` int(11) NOT NULL,
  `id_buku` char(15) NOT NULL,
  `id_user` char(15) NOT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_koleksi`
--

INSERT INTO `tb_koleksi` (`id_koleksi`, `id_buku`, `id_user`, `created_at`) VALUES
(2, 'BK-0002', 'USR-0002', '2024-02-08'),
(4, 'BK-0005', 'USR-0001', '2024-02-08'),
(6, 'BK-0003', 'USR-0001', '2024-02-08'),
(7, 'BK-0004', 'USR-0001', '2024-02-08'),
(9, 'BK-0003', 'USR-0001', '2024-02-09'),
(11, 'BK-0001', 'USR-0004', '2024-02-09'),
(12, 'BK-0004', 'USR-0020', '2024-02-16'),
(13, 'BK-0006', 'USR-0007', '2024-02-16'),
(14, 'BK-0012', 'USR-0001', '2024-02-19'),
(15, 'BK-0013', 'USR-0001', '2024-02-19'),
(16, 'BK-0027', 'USR-0001', '2024-02-19'),
(17, 'BK-0027', 'USR-0008', '2024-02-19'),
(18, 'BK-0001', 'USR-0022', '2024-02-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` char(13) NOT NULL,
  `id_buku` char(15) NOT NULL,
  `id_peminjam` char(15) NOT NULL,
  `tgl_pinjam` varchar(16) DEFAULT NULL,
  `tgl_kembali` varchar(16) DEFAULT NULL,
  `status_buku` enum('Proses','Pinjam','Kembali') NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `id_buku`, `id_peminjam`, `tgl_pinjam`, `tgl_kembali`, `status_buku`, `ket`) VALUES
('TRX-00001', 'BK-0002', 'USR-0001', '02-01-2024', '11-01-2024', 'Kembali', 'cek\r\n'),
('TRX-00003', 'BK-0002', 'USR-0001', '31-01-2024', '18-02-2024', 'Kembali', 'tes              '),
('TRX-00004', 'BK-0004', 'USR-0002', '02-02-2024', '09-02-2024', 'Kembali', 'tes'),
('TRX-00005', 'BK-0006', 'USR-0001', '08-02-2024', '20-02-2024', 'Kembali', 'buat belajar'),
('TRX-00006', 'BK-0003', 'USR-0001', '09-02-2024', '21-02-2024', 'Kembali', 'buat belajar'),
('TRX-00007', 'BK-0005', 'USR-0004', '09-02-2024', '21-02-2024', 'Kembali', 'belajar koding\r\n'),
('TRX-00008', 'BK-0003', 'USR-0004', '28-01-2024', '10-02-2024', 'Kembali', 'tes'),
('TRX-00009', 'BK-0005', 'USR-0004', '15-02-2024', '27-02-2024', 'Kembali', 'pinjam dulu'),
('TRX-00010', 'BK-0001', 'USR-0020', '16-02-2024', '28-02-2024', 'Kembali', 'pinjam dulu'),
('TRX-00011', 'BK-0004', 'USR-0020', '16-02-2024', '07-03-2024', 'Pinjam', 'sebentar'),
('TRX-00012', 'BK-0006', 'USR-0001', '16-02-2024', '07-03-2024', 'Pinjam', 'pinjam'),
('TRX-00013', 'BK-0003', 'USR-0007', '16-02-2024', '28-02-2024', 'Proses', 'pnjam dulu bos'),
('TRX-00014', 'BK-0027', 'USR-0008', '19-02-2024', '10-03-2024', 'Pinjam', 'Pinjam Untuk Belajar!'),
('TRX-00015', 'BK-0002', 'USR-0001', '20-02-2024', '03-03-2024', 'Proses', 'pinjam'),
('TRX-00016', 'BK-0009', 'USR-0001', '20-02-2024', '03-03-2024', 'Kembali', 'sss'),
('TRX-00017', 'BK-0001', 'USR-0022', '20-02-2024', '11-03-2024', 'Kembali', 'pinjam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ulasan`
--

CREATE TABLE `tb_ulasan` (
  `id_ulasan` int(11) NOT NULL,
  `id_buku` varchar(15) NOT NULL,
  `id_anggota` varchar(15) NOT NULL,
  `ulasan` text NOT NULL,
  `rating` varchar(25) NOT NULL,
  `tgl_ulasan` varchar(40) NOT NULL,
  `balasan` varchar(100) DEFAULT NULL,
  `tgl_balasan` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ulasan`
--

INSERT INTO `tb_ulasan` (`id_ulasan`, `id_buku`, `id_anggota`, `ulasan`, `rating`, `tgl_ulasan`, `balasan`, `tgl_balasan`) VALUES
(4, 'BK-0002', 'USR-0001', 'Buku yang luar biasa dan tidak membosankan', '4', '08-02-2024 12:30', 'Terimakasih telah berkunjung dan memberikan rating yang bagus              ', '09-02-2024 02:13'),
(5, 'BK-0004', 'USR-0002', 'Ini adalah buku yang luar biasa membuka pikiran saya tentang politik.', '5', '09-02-2024 07:12', '                    Terima kasih telah berkomentar!              ', '09-02-2024 07:46'),
(6, 'BK-0006', 'USR-0001', 'Buku ini sungguh bermanfaat bagi kalian yg ingin mempelajari ekonomi.', '4', '09-02-2024 07:40', '', ''),
(8, 'BK-0001', 'USR-0020', 'Buku yang mudah dipahami untuk pemula seperti saya!', '5', '16-02-2024 09:04', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indeks untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_koleksi`
--
ALTER TABLE `tb_koleksi`
  ADD PRIMARY KEY (`id_koleksi`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_peminjam` (`id_peminjam`);

--
-- Indeks untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD PRIMARY KEY (`id_ulasan`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_koleksi`
--
ALTER TABLE `tb_koleksi`
  MODIFY `id_koleksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  MODIFY `id_ulasan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD CONSTRAINT `tb_buku_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `tb_admin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_buku_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_koleksi`
--
ALTER TABLE `tb_koleksi`
  ADD CONSTRAINT `tb_koleksi_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_koleksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `tb_peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_peminjaman_ibfk_2` FOREIGN KEY (`id_peminjam`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_ulasan`
--
ALTER TABLE `tb_ulasan`
  ADD CONSTRAINT `tb_ulasan_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `tb_anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_ulasan_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Sep 2023 pada 09.19
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mstorenew`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` enum('ACC','PART','OTH') NOT NULL,
  `deskripsi_kategori` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `nama_kategori`, `deskripsi_kategori`) VALUES
(1, '', 'Aksesoris Iphone, Macbook dll.'),
(2, '', 'Sparepart Iphone, Macbook dll.'),
(3, '', 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `produk` varchar(255) NOT NULL,
  `kuantitas_terjual` int(11) NOT NULL,
  `harga_produk` decimal(10,0) DEFAULT NULL,
  `total_harga` decimal(10,0) NOT NULL,
  `metode_pembayaran` varchar(50) DEFAULT NULL,
  `status_pembayaran` varchar(20) DEFAULT NULL,
  `tanggal_penjualan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `nama_pelanggan`, `produk`, `kuantitas_terjual`, `harga_produk`, `total_harga`, `metode_pembayaran`, `status_pembayaran`, `tanggal_penjualan`) VALUES
(1, 'Rusdi', 'Batre Iphone XR', 1, 1800000, 1800000, 'Tunai', 'Selesai', '2023-09-14'),
(2, 'Intan', 'Softcase Iphone XR', 2, 350000, 350000, 'Tunai', 'Selesai', '2023-09-18'),
(3, 'Sandra', 'Hardcase Macbook Air/Pro 15 inch', 3, 250000, 123, 'Tunai', 'Selesai', '2023-09-18'),
(4, 'Andri', 'Installasi OS Windows', 2, 150000, 150000, 'Tunai', 'Selesai', '2023-09-19'),
(5, 'Rusdi', 'Flashdisk 8 Gb', 1, 150000, 1234, 'Transfer', 'Selesai', '2023-09-20'),
(6, 'Rani', 'Cable C to C Macbook 2 Meter', 1, 300000, 300000, 'Transfer', 'Pending', '2023-09-20'),
(7, 'asd', 'asd', 1, 1, 1, 'Transfer', 'Belum Lunas', '2023-09-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `pesan` text NOT NULL,
  `waktu_pengiriman` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesan`
--

INSERT INTO `pesan` (`id`, `nama`, `nomor_telepon`, `pesan`, `waktu_pengiriman`) VALUES
(1, 'rusdi', '081234567890', 'test', '2023-09-21 12:30:42'),
(2, 'asd', '083175884093', 'test', '2023-09-21 12:31:19'),
(3, 'ruuuussssdddiiiiiiii', '081234432112', 'tes aja ', '2023-09-21 12:32:58'),
(4, 'ruuuussssdddiiiiiiii', '081234432112', 'tes aja ', '2023-09-21 12:33:19'),
(5, '\'', '\'', '\'', '2023-09-21 12:48:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori_produk` varchar(50) DEFAULT NULL,
  `harga_jual` decimal(10,0) NOT NULL,
  `harga_beli` decimal(10,0) NOT NULL,
  `stok` int(11) NOT NULL,
  `tanggal_upload` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `deskripsi`, `kategori_produk`, `harga_jual`, `harga_beli`, `stok`, `tanggal_upload`) VALUES
(1, 'ACC1', 'Cable Type C to C Macbook 2 Meter', 'Kabel Charger Macbook C to C Panjang 2 Meter', 'ACC', 300000, 250000, 7, '2023-09-11'),
(2, 'FD', 'Flashdisk', 'Flashdisk 8 Gb', 'ACC', 150000, 100000, 9, '2023-09-11'),
(3, 'BTX', 'Batre Iphone XR', 'Batre Iphone XR', 'PART', 1800000, 1500000, 3, '2023-09-12'),
(4, 'HA2', 'Hardcase Macbook Air/Pro 15 inch', 'Hardcase Macbook Air/Pro 15 inch', 'ACC', 250000, 200000, 5, '2023-09-12'),
(5, 'LCX', 'LCD Iphone XR', 'LCD Iphone XR', 'PART', 1800000, 1500000, 5, '2023-09-20'),
(6, 'LC11', 'LCD Iphone 11', 'LCD Iphone 11', 'PART', 1500000, 1000000, 3, '2023-09-20'),
(7, 'SC', 'Softcase Iphone XR', 'Softcase Iphone XR', 'ACC', 250000, 200000, 5, '2023-09-20'),
(8, 'TGI', 'Tempered Glass Iphone', 'Tempered Glass Iphone', 'ACC', 150000, 100000, 10, '2023-09-20'),
(9, 'TGM', 'Tempered Glass Macbook', 'Tempered Glass Macbook', 'ACC', 350000, 300000, 10, '2023-09-20'),
(10, 'INW', 'Installasi OS Windows', 'Installasi OS Windows 7,8,10,11', 'OTH', 250000, 100000, 99, '2023-09-20'),
(11, 'IAW', 'Installasi Aplikasi Windows', 'Installasi Aplikasi Windows', 'OTH', 150000, 99, 99, '2023-09-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`) VALUES
(1, 'Rusdi', 'rusdi1337', 'rusdi1337'),
(2, 'Admin', 'mstore', 'mstore82'),
(3, 'Manager', 'sandra', 'sandra'),
(4, 'Admin', 'rezka', 'rezka'),
(5, 'Admin', 'kartini', 'kartini'),
(6, 'Teknisi', 'andri', 'andri'),
(7, 'Teknisi', 'ade', 'ade'),
(8, 'Sales', 'fitri', 'fitri');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

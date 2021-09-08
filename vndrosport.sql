-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 08, 2021 at 04:07 PM
-- Server version: 10.2.40-MariaDB-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vndrosport21_data`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(11) NOT NULL,
  `email_admin` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `level`, `email_admin`) VALUES
(1, 'admin', '$2a$10$I4WobUyILHg08Ij4KY5BwuExe09ypyrcfvyyWMUVa3jraQ7oVPAae', 1, 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mykey` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT 0,
  `is_private_key` tinyint(1) NOT NULL DEFAULT 0,
  `ip_addresses` text DEFAULT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `user_id`, `mykey`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 0, '92K5wAWs7MPqY54St72HB3ETEqjvRP22', 0, 0, 0, NULL, '2021-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `detailkeranjang`
--

CREATE TABLE `detailkeranjang` (
  `id` int(11) NOT NULL,
  `id_keranjang` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `m_sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detailuser`
--

CREATE TABLE `detailuser` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notelp` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desa` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamatan` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kabupaten` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provinsi` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detailuser`
--

INSERT INTO `detailuser` (`id`, `nama_lengkap`, `notelp`, `alamat`, `desa`, `kecamatan`, `kabupaten`, `provinsi`, `id_user`) VALUES
(6, 'pendi sport', '08123456789', 'sidodadi', NULL, NULL, NULL, NULL, 8),
(8, 'olympus sport', '087715886219', NULL, NULL, NULL, NULL, NULL, 10),
(9, 'Mitra', '089631973797', NULL, NULL, NULL, NULL, NULL, 11),
(10, 'wayhalim', '08789912378', NULL, NULL, NULL, NULL, NULL, 12),
(11, 'soccer', '082387986547', NULL, NULL, NULL, NULL, NULL, 13),
(12, 'Gilang Yoga', '082176616541', 'Perumahan Nusantara Permai', NULL, NULL, NULL, NULL, 14),
(13, 'deni', '08976268300', NULL, NULL, NULL, NULL, NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `id_pesanan`, `id_produk`, `jumlah`, `sub_total`, `status`) VALUES
(28, 66, 31, 2, 160000, 2),
(29, 66, 26, 2, 160000, 2),
(30, 67, 32, 1, 80000, 3),
(31, 67, 25, 1, 80000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` mediumint(11) NOT NULL,
  `id_provinsi` smallint(11) NOT NULL,
  `nama_kabupaten` varchar(128) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `id_provinsi`, `nama_kabupaten`, `created_at`, `updated_at`) VALUES
(1, 1, 'sawah besar', NULL, NULL),
(2, 2, 'SLEMAN', NULL, NULL),
(3, 2, 'Bantul', NULL, NULL),
(4, 2, 'paingan', NULL, NULL),
(6, 1, 'jakarta pusat', NULL, NULL),
(7, 2, 'mrican', 1625699232, 1625699232),
(8, 1, 'roxy mas', 1625699292, 1625699292),
(9, 4, 'bandarlampung', 1625701346, 1625701346),
(10, 4, 'metro', 1625701358, 1625701358),
(11, 4, 'waikanan', 1625701368, 1625701368),
(12, 3, 'aceh singkil', 1625703876, 1625703876);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`) VALUES
(5, 'CELANA BADMINTON'),
(6, 'SHUTTLECOCK'),
(7, 'BAJU BADMINTON'),
(8, 'BOLA VOLI'),
(9, 'TAS BADMINTON'),
(11, 'SARUNG TANGAN BOLA'),
(12, 'RAKET'),
(13, 'SEPATU FUTSAL'),
(14, 'SEPATU VOLI'),
(15, 'BAJU VOLI'),
(16, 'CELANA VOLI'),
(17, 'BOLA FUTSAL'),
(18, 'BAJU BOLA'),
(19, 'BOLA BASKET'),
(20, 'BAJU'),
(21, 'CELANA'),
(23, 'BOLA');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `sub_total` int(11) NOT NULL,
  `biaya_antar` int(11) NOT NULL,
  `total_biaya` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id` int(11) NOT NULL,
  `nama_merek` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id`, `nama_merek`) VALUES
(1, 'YONEX'),
(4, 'SUPERNOVA SHUTTLECOCK'),
(5, 'MUNICH'),
(6, 'EVA SHUTTLECOCK'),
(7, 'MVA 300'),
(8, 'BARRACUDA'),
(9, 'MIZUNO'),
(10, 'ASICS'),
(11, 'JOMA CHAMPION'),
(12, 'SPECS'),
(13, 'MIKASA'),
(14, 'BERWYN'),
(15, 'LAKERS'),
(16, 'AIR JORDAN'),
(17, 'IOWA'),
(18, 'MOLTEN'),
(19, 'REINFORCE SPEED'),
(20, 'ORTUSEIGHT'),
(21, 'NIKE'),
(22, 'LINING'),
(23, 'ADIDAS');

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE `negara` (
  `id` int(11) NOT NULL,
  `iso` varchar(2) NOT NULL,
  `code` varchar(3) NOT NULL,
  `nama_negara` varchar(128) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`id`, `iso`, `code`, `nama_negara`, `created_at`, `updated_at`) VALUES
(1, 'id', 'ina', 'indonesia', 1625617501, 1625617501);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `biaya_antar` int(11) NOT NULL,
  `total_jumlah` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_user`, `judul`, `tanggal`, `sub_total`, `biaya_antar`, `total_jumlah`, `status`) VALUES
(66, 14, 'Baju Badminton', 1631091291, 320000, 20000, 340000, 3),
(67, 14, 'Jersey Futsal Adidas', 1631091388, 160000, 20000, 180000, 4);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_merek` int(11) NOT NULL,
  `nama_produk` varchar(80) NOT NULL,
  `warna` varchar(20) NOT NULL,
  `ukuran` varchar(10) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(128) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `id_toko` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `id_kategori`, `id_merek`, `nama_produk`, `warna`, `ukuran`, `harga`, `stok`, `gambar`, `deskripsi`, `id_toko`, `created_at`, `updated_at`, `status`) VALUES
(7, 5, 1, 'Celana Badminton', 'Hitam', 'M,L', 50000, 5, '3L4fne9ncQ.jpeg', 'Celana pendek badminton', 3, 1630650325, 1630650325, 1),
(8, 13, 8, 'Sepatu Futsal', 'Merah', '39-42', 300000, 5, '2pB7NIFkAA.jpeg', 'Sepatu Futsal', 5, 1630654157, 1630654157, 1),
(9, 6, 6, 'Shuttlecock eva', 'Biru', 'All size', 70000, 10, 'rSBDz59GiZ.jpg', 'Shuttlecock eva', 3, 1630731499, 1630731499, 1),
(10, 14, 9, 'SEPATU VOLI MIZUNO WAVE LIGHTNING Z6 WLZ6', 'Putih', '30-36', 350, 10, 'LP609Ijh3i.jpeg', 'Septu voli original', 6, 1630809250, 1630809250, 1),
(11, 11, 5, 'Sarung tangan bola', 'Kuning', '8,9,10', 150000, 5, 'yTQFWVEX8C.jpg', 'Sarung Tangan sepak bola', 8, 1630809450, 1630809450, 1),
(12, 13, 11, 'Sepatu Futsal Joma Champion', 'Biru', '40-45', 250000, 10, 'nOJpU7ckck.jpg', 'Sepatu Futsal', 8, 1630809893, 1630809893, 1),
(13, 15, 10, 'Baju voli asics', 'Hitam', 'S-XL', 100000, 12, 'tlTHRvKWZW.jpeg', 'Baju voli fullprinting original langsung dari china', 6, 1630809899, 1630809899, 1),
(14, 8, 7, 'Bola Voli', 'Biru kuning', '-', 385000, 3, 'JSl8p6EybB.jpg', 'Bola Voli', 8, 1630810123, 1630810123, 1),
(15, 16, 9, 'Celana Voli Mizuno', 'Biru navy', 'S-XL', 50000, 9, 'ZerH02GpHS.jpeg', 'Celana voli original merek mizuno \r\nUkuran S-XL', 6, 1630810131, 1630810131, 1),
(16, 14, 10, 'Sepatu voli Asics Gel-task Mt 2', 'Hitam', '30-36', 390000, 6, 'rKD5EdRjm7.jpeg', 'Sepatu volley Asics Gel-task Mt 2 original ukuran 30-36', 6, 1630810423, 1630810423, 1),
(17, 17, 12, 'Bola Futsal Specs', 'Hijau', '-', 199000, 10, 'YNrh3xcvbq.jpg', 'Bola Futsal', 8, 1630810536, 1630810536, 1),
(18, 8, 13, 'Bola Volley Mikasa', 'Kuning, biru', '-', 270000, 6, 'Ud8z0tf0Cl.jpeg', 'Bola volley original merek mikasa', 6, 1630810712, 1630810712, 1),
(19, 18, 12, 'Baju Timnas Indonesia', 'Merah', 'S-XL', 399000, 15, 'R1aR854wva.jpg', 'Baju Timnas Indonesia', 8, 1630810855, 1630810855, 1),
(20, 19, 14, 'Bola Basket berwyn', 'Merah marun', '-', 300000, 8, '9mwamv5S6Y.jpeg', 'Bola basket original merek berwyn', 7, 1630811052, 1630811052, 1),
(21, 20, 15, 'Baju Basket Lakers', 'Kuning', 'S-XL', 120000, 15, 'GsMVZa89Q2.jpeg', 'Baju basket original merek lekers', 7, 1630811445, 1630811445, 1),
(22, 21, 16, 'Celana Basket Air Jordan', 'Hitam', 'S-XL', 150000, 9, '4DhdHVI9TK.jpeg', 'Celana basket air jordan original', 7, 1630811643, 1630811643, 1),
(23, 20, 17, 'Baju Basket Iowa', 'Hitam', 'S-XL', 120000, 16, 'tX1QJd2hQJ.jpeg', 'Baju basket iowa original ukuran S-XL', 7, 1630811903, 1630811903, 1),
(24, 23, 18, 'Bola Basket Molten', 'Coklat', '-', 300000, 8, 'CCJVXOwRzo.jpeg', 'Bola basket molten coklat original', 7, 1630812043, 1630812043, 1),
(25, 20, 1, 'Baju Badminton Yonex', 'Biru', 'M-XL', 75000, 5, 'F0DYLB1F5P.jpg', 'Jersey Badminton', 3, 1630812065, 1630812065, 1),
(26, 12, 19, 'Raket Badminton', 'Abu-Abu', '-', 470000, 5, 'Dhlc0pgWqx.jpg', 'Raket Badminton sang juara', 3, 1630812325, 1630812325, 1),
(27, 20, 20, 'Jersey Futsal Ortuseight', 'Blackgold', 'S-XL', 125000, 6, 'yDsIVCx423.jpeg', 'Jersey 1 set ortuseight original ukuran S-XL', 5, 1630812705, 1630812705, 1),
(28, 9, 1, 'Tas Badminton', 'Biru', '-', 430000, 3, 'Qr7IjKwAH8.jpg', 'Tas Badminton', 3, 1630812743, 1630812743, 1),
(29, 21, 21, 'Celana Futsal Nike', 'Hitam', 'S-XL', 75000, 8, '692J644Ecb.jpeg', 'Celana futsal warna hitam nike ukuran S-XL', 5, 1630812854, 1630812854, 1),
(30, 23, 12, 'Bola Futsal Specs', 'Kuning', '-', 240000, 6, 'soxXhYyImk.jpeg', 'Bola futsal specs original', 5, 1630812982, 1630812982, 1),
(31, 20, 22, 'Baju Badminton', 'Merah', 'M-XL', 75000, 5, 'HWLJ0cvWIP.jpg', 'Baju Badminton', 3, 1630813055, 1630813055, 1),
(32, 20, 23, 'Jersey Futsal Adidas', 'Hijau', 'S-XL', 80000, 14, 'sZxqIigJqZ.jpeg', 'Jersey Futsal adidas ukuran S-XL', 5, 1630813272, 1630813272, 1);

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE `provinsi` (
  `id` smallint(11) NOT NULL,
  `id_negara` int(11) NOT NULL,
  `nama_provinsi` varchar(128) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id`, `id_negara`, `nama_provinsi`, `created_at`, `updated_at`) VALUES
(1, 1, 'dki jakarta', 1625693739, 1625693739),
(2, 1, 'diy yogyakarta', 1625694613, 1625694613),
(3, 1, 'aceh', 1625697889, 1625697889),
(4, 1, 'sumatera barat', 1625701327, 1625701327);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `spesial`
--

CREATE TABLE `spesial` (
  `id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `telp` varchar(30) NOT NULL,
  `alamat` text NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `last_online` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id`, `nama_toko`, `email`, `telp`, `alamat`, `id_user`, `last_online`) VALUES
(3, 'pendi sport2', 'pendisport@gmail.com', '08123456789', 'ada', 8, 1630649797),
(5, 'olympus sport', 'olympus@gmail.com', '087715886219', '', 10, 1630653343),
(6, 'Mitra', 'mitra@gmail.com', '089631973797', '', 11, 1630808268),
(7, 'wayhalim', 'wayhalimsport@gmail.com', '08789912378', '', 12, 1630808646),
(8, 'soccer', 'soccercorner@gmail.com', '082387986547', '', 13, 1630809174),
(9, 'Gilang Yoga', 'gilangyoga@gmail.com', '082176616541', '', 14, 1630819219),
(10, 'deni', 'deni@gmail.com', '08976268300', '', 15, 1631025308);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'pendisport@gmail.com', '$2y$10$RfCiV5c47NoHQojFA1gRZ.7GviNU3N6rgJjuqSJf7Y5b.2WdOTX1K', 'dkHzIi8cVP', 1630649797, 1630652594),
(10, 'olympus@gmail.com', '$2y$10$dFVaZ0GFiFJUo1QsSBPDSeouVdumQ7m0ehNFpp33bELCg6y8csdfm', 'IitFSFZ2GD', 1630653343, 1630653343),
(11, 'mitra@gmail.com', '$2y$10$1GA/g6FuuUX6fmcEmmwCguFRMDQSQizqXwkaQ8N1PpJtB26lLgISC', 'IvCYCl7yiK', 1630808268, 1630808268),
(12, 'wayhalimsport@gmail.com', '$2y$10$hyZwjTzeTNf0HaS.TLicrevmfNXRW1pDpyNjTveDymw8F5tBD68PG', '09cpEPnBJ0', 1630808646, 1630808646),
(13, 'soccercorner@gmail.com', '$2y$10$5cUg.7hR88r9ikMUx.6Oeu/Dr.5h7cjG8h68TbD1MDD0jKrFKTZlC', 'QnBjY8xsxK', 1630809174, 1630809174),
(14, 'gilangyoga@gmail.com', '$2y$10$ZR0j9hF.p/XbN7/NIUSsqOYYp76vgTKS0dEfd9XHQFcnmofD.R11e', 'xi0K0uzsmt', 1630819219, 1630819368),
(15, 'deni@gmail.com', '$2y$10$FJc.yF.85uhRvciU5Swv1.mX5QGofhAi2jbiYwEau84OJcE8JDBiO', 'tygolTGrOk', 1631025308, 1631025308);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detailkeranjang`
--
ALTER TABLE `detailkeranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_keranjang` (`id_keranjang`);

--
-- Indexes for table `detailuser`
--
ALTER TABLE `detailuser`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_provinsi` (`id_provinsi`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `negara`
--
ALTER TABLE `negara`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_merek` (`id_merek`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indexes for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_negara` (`id_negara`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `spesial`
--
ALTER TABLE `spesial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `detailkeranjang`
--
ALTER TABLE `detailkeranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `detailuser`
--
ALTER TABLE `detailuser`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `negara`
--
ALTER TABLE `negara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `provinsi`
--
ALTER TABLE `provinsi`
  MODIFY `id` smallint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `spesial`
--
ALTER TABLE `spesial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailkeranjang`
--
ALTER TABLE `detailkeranjang`
  ADD CONSTRAINT `detailkeranjang_ibfk_1` FOREIGN KEY (`id_keranjang`) REFERENCES `keranjang` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `detailuser`
--
ALTER TABLE `detailuser`
  ADD CONSTRAINT `detailuser_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD CONSTRAINT `detail_pesanan_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD CONSTRAINT `kabupaten_ibfk_1` FOREIGN KEY (`id_provinsi`) REFERENCES `provinsi` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `keranjang_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`id_merek`) REFERENCES `merek` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `produk_ibfk_3` FOREIGN KEY (`id_toko`) REFERENCES `toko` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `provinsi`
--
ALTER TABLE `provinsi`
  ADD CONSTRAINT `provinsi_ibfk_1` FOREIGN KEY (`id_negara`) REFERENCES `negara` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `spesial`
--
ALTER TABLE `spesial`
  ADD CONSTRAINT `spesial_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `toko`
--
ALTER TABLE `toko`
  ADD CONSTRAINT `toko_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

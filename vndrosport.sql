-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2021 at 10:34 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vndrosport`
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
(1, 'wakanda2', '0856020130021', 'alamatku2', NULL, NULL, NULL, NULL, 1),
(2, 'samantha', '08123456789', NULL, NULL, NULL, NULL, NULL, 4),
(3, 'Aaa', 'adadsad', NULL, NULL, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id`, `id_pesanan`, `id_produk`, `jumlah`, `sub_total`) VALUES
(1, 1, 2, 13, 5850000),
(2, 1, 3, 13, 1430000),
(3, 1, 4, 3, 750000),
(4, 2, 6, 1, 25000),
(5, 3, 6, 1, 25000),
(6, 4, 6, 2, 50000);

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
(1, 'Raket'),
(2, 'Bola');

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
(1, 'YONEX');

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
(1, 1, 'Raket aluminium kelas atas', 1628562417, 8030000, 20000, 8050000, 1),
(2, 1, 'adadada', 1628563245, 25000, 20000, 45000, 1),
(3, 1, 'adadada', 1628563560, 25000, 20000, 45000, 1),
(4, 1, 'adadada', 1628576506, 50000, 20000, 70000, 1);

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
(2, 1, 1, 'Raket aluminium kelas atas', 'polos', 'L', 450000, 12, 'raket.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, ', 1, 1221212, 1212121, 1),
(3, 1, 1, 'Sepatu Bola Legendaris', 'merah', 'L', 110000, 12, 'sepatu.png', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, ', 1, 1221212, 1212121, 1),
(4, 2, 1, 'Bola Sepak Keren', 'merah', 'L', 250000, 12, 'bola.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, ', 1, 1221212, 1212121, 1),
(5, 2, 1, 'adada', 'dada', 'dadada', 2323232, 0, 'ad8HmrA6TI.jpg', '', 1, 0, 0, 0),
(6, 2, 1, 'adadada', 'Merah', 'allsize', 25000, 0, 'sDiZju62g6.jpg', 'adada', 1, 0, 0, 0);

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

--
-- Dumping data for table `spesial`
--

INSERT INTO `spesial` (`id`, `id_produk`, `harga`) VALUES
(1, 2, 400000),
(2, 3, 400000);

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
(1, 'Alex Sport', 'alexistdev@gmail.com', '082371408678', 'Waykandis', 1, 1625616177),
(2, 'Aaa', 'dekil@gmail.com', 'adadsad', '', 5, 1628399018);

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
(1, 'alexistdev@gmail.com', '$2y$10$gSQbKOqpeYVMvxKMN1UCC.B1UtqH6H7O9aSh7X3CM1UxpXi.bowBW', 'XiTYHklpnU', 1625616177, 1628576476),
(4, 'samantha@gmail.com', '$2y$10$eiOMo1Q0N72zHqM0pHie1eGK6I7CtmpEDTH9ETv7VWS8LgwzDDt6G', 'yekdXH2yl1', 1628397578, 1628397578),
(5, 'dekil@gmail.com', '$2y$10$dsyJk4W0baiGbsa8nLwDWubqcSaWEdozy3O2g7w0r6plwiT8lONdu', '2KGdKDHsEs', 1628399018, 1628399018);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detailuser`
--
ALTER TABLE `detailuser`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` mediumint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `negara`
--
ALTER TABLE `negara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

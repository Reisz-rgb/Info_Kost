-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 03, 2025 at 01:54 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hero_kost`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `kost_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `kost_id`, `created_at`) VALUES
(3, 5, 4, '2025-06-03 08:33:30'),
(4, 1, 4, '2025-06-03 08:38:39'),
(5, 1, 5, '2025-06-03 08:38:53');

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id` int(11) NOT NULL,
  `nama_kos` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `sisa_kamar` int(11) DEFAULT 0,
  `harga` int(11) NOT NULL,
  `fasilitas_kamar` text DEFAULT NULL,
  `fasilitas_umum` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `rating` int(20) NOT NULL DEFAULT 10,
  `tipe` enum('Putra','Putri','Campur') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kost`
--

INSERT INTO `kost` (`id`, `nama_kos`, `alamat`, `deskripsi`, `sisa_kamar`, `harga`, `fasilitas_kamar`, `fasilitas_umum`, `gambar`, `created_at`, `user_id`, `rating`, `tipe`) VALUES
(4, 'Kos Griya Mawar', 'Ngaliyan', 'Kos daerah Ngaliyan Semarang dekat dengan kampus 3 UIN Walisongo', 4, 250000, 'Kasur', 'Kamar Mandi', 'uploads/1748939669_abubga.jpg', '2025-06-01 15:40:49', 3, 0, 'Putra'),
(5, 'Kos Griya Lestari', 'Sekaran', 'Kos berposisi di daerah sekarang yang berposisi dekat dengan UNNES', 2, 300000, 'Kasur', 'Kamar Mandi', 'uploads/1748876879_istockphoto-1124562627-612x612.jpg', '2025-06-02 15:07:59', 4, 10, 'Campur');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `kost_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 10),
  `ulasan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `kost_id`, `user_id`, `rating`, `ulasan`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 5, 'Jelek Banget Sumpah', '2025-06-03 08:39:47', '2025-06-03 08:39:47');

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kost_id` int(11) DEFAULT NULL,
  `checkin` date DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `status` enum('Menunggu Pembayaran','Dibatalkan','Selesai') DEFAULT 'Menunggu Pembayaran',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `metode_pembayaran` enum('BRI','BCA') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id`, `user_id`, `kost_id`, `checkin`, `durasi`, `status`, `created_at`, `metode_pembayaran`) VALUES
(3, 1, 4, '2025-06-18', 1, 'Selesai', '2025-06-03 05:07:23', 'BCA'),
(4, 5, 5, '2025-06-19', 3, 'Menunggu Pembayaran', '2025-06-03 08:19:51', 'BCA'),
(5, 1, 5, '2025-06-12', 6, 'Menunggu Pembayaran', '2025-06-03 08:48:17', 'BCA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text NOT NULL,
  `gender` enum('Laki-Laki','Perempuan') NOT NULL,
  `role` enum('pencari','pemilik') NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `gender`, `role`, `telepon`, `alamat`, `foto`, `created_at`) VALUES
(1, 'Yanto', 'Yanto@gmail.com', '$2y$10$2KOPqEx/MpYr/Mhpejj1UOnxakbjl6wONHOtEIfK5jl6OHoloveKy', 'Laki-Laki', 'pencari', '+6287745673150', 'Sekaran', '683c0245d4fd6.png', '2025-06-01 07:33:25'),
(2, 'Andi', 'Andi@gmail.com', '$2y$10$.ypkin0z7MENM87VxYrA..PpRo3AyL8QeTSwIkwdZRj71IhhBqHPC', 'Laki-Laki', 'pencari', '0874567310', 'Sekaran', '683c03135d35e.png', '2025-06-01 07:36:51'),
(3, 'Siti', 'siti@gmail.com', '$2y$10$Gh19iXH5MiCBgvGX79rQHujoPi.gDPYD59vCdDNEuynwRAklXVDSq', 'Laki-Laki', 'pemilik', '+62874441674', 'Gunung Pati', '683c5e08b5edd.jpg', '2025-06-01 08:22:16'),
(4, 'Rudi', 'rudi@gmail.com', '$2y$10$JG/wJeI.UG0OUGAW203E3ubrRdlhZNQLyIfH/vZkqT60tHl3gKS1q', 'Laki-Laki', 'pemilik', '0842345569', 'Sekaran', '683db9ace2d69.jpg', '2025-06-02 14:48:12'),
(5, 'Toni', 'toni@gmail.com', '$2y$10$EKzfOa7EBlOppsxvXuLBROPmsmfmz5G9Jiq2MjKhKgr70mDhosIXG', 'Laki-Laki', 'pencari', '+627623452311', 'Cepiring', '683eb0063fd88.jpg', '2025-06-03 08:19:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`kost_id`),
  ADD KEY `kost_id` (`kost_id`);

--
-- Indexes for table `kost`
--
ALTER TABLE `kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_review` (`kost_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kost`
--
ALTER TABLE `kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`kost_id`) REFERENCES `kost` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`kost_id`) REFERENCES `kost` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

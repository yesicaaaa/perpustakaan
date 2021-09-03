-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2021 at 04:03 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` bigint(20) NOT NULL,
  `judul` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pengarang` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penerbit` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `foto` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bahasa` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jml_halaman` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `foto`, `bahasa`, `genre`, `jml_halaman`, `stok`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'A Book of Lost Friends', 'Lisa Wingate', 'Elexmedia', 2018, 'A_Book_of_Lost_Friends.jpg', 'Inggris', 'Drama', 398, 29, 1, '2021-07-23 02:34:50', '2021-08-12 06:38:52', NULL),
(2, 'Anak Rantau', 'A. Fuadi', 'Gagas Media', 2004, 'Anak_Rantau.jpg', 'Indonesia', 'Adventure', 128, 21, 3, '2021-07-23 02:36:54', NULL, NULL),
(3, 'Senja Dimata Bintang', 'Andrea Hirata', 'Gramedia', 2012, 'Senja_Dimata_Bintang.jpg', 'Indonesia', 'Romance', 238, 2, 3, '2021-07-23 02:37:53', '2021-08-12 06:38:52', NULL),
(4, 'Peony\'s World', 'Kezia Evi Wiadji', 'Gramedia', 2019, 'Peony\'s_World.jpg', 'Indonesia', 'Romance', 293, 8, 1, '2021-08-02 01:59:22', NULL, NULL),
(5, 'Bukan Cinderella', 'Dheti Azmi', 'Grasindo', 2017, 'Bukan_Cinderella.jpg', 'Indonesia', 'Romance', 287, 2, 1, '2021-08-02 02:04:44', NULL, NULL),
(6, 'Dhirga', 'Natalia Tan', 'Grasindo', 2012, 'Dhirga.jpg', 'Indonesia', 'Romance', 328, 20, 3, '2021-08-02 02:06:01', NULL, NULL),
(7, 'Nebula', 'Tere Liye', 'Gramedia', 2018, 'Nebula.jpg', 'Indonesia', 'Mistery', 281, 12, 3, '2021-08-02 02:07:30', NULL, NULL),
(8, 'Sam Kok', 'Andri Wang', 'Elexmedia', 2010, 'Sam_Kok.jpg', 'Indonesia', 'Action', 323, 12, 2, '2021-08-02 02:09:11', NULL, NULL),
(9, 'Negeri Para Bedebah', 'Tere Liye', 'Gramedia', 2018, 'Negeri_Para_Bedebah.png', 'Indonesia', 'Drama', 298, 0, 2, '2021-08-02 02:55:19', NULL, NULL),
(10, 'Wujud Tanpa Suara', 'Nurul Izzah Andini', 'Deepublish', 2017, 'Wujud_Tanpa_Suara.jpg', 'Indonesia', 'Horor', 287, 12, 0, '2021-08-24 16:16:01', NULL, NULL),
(11, 'The Divines', 'Ellie Eaton', 'Deepublish', 2014, 'The_Divines.jpg', 'Inggris', 'Drama', 321, 3, 0, '2021-08-24 16:18:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(11, '2021_07_12_051354_laratrust_setup_tables', 2),
(12, '2021_07_12_074206_rename_column_id_user_from_users_table', 3),
(13, '2021_07_12_092138_add_column_image_to_users_table', 4),
(20, '2021_07_13_041100_create_series_table', 5),
(30, '2021_07_13_040513_create_buku_table', 6),
(31, '2021_07_23_022641_create_peminjaman_table', 6),
(32, '2021_07_26_040443_rename_column_in_peminjaman_table', 7),
(34, '2021_08_23_035447_add_column_to_users_table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('yesicaagrn654@gmail.com', '$2y$10$aeNWL9EFpW9v4G5zq.uZ4uGaPpw7N4z9gOHQXQt2U8pyVO3/C5js2', '2021-08-24 20:19:57');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` bigint(20) NOT NULL,
  `id_anggota` bigint(20) UNSIGNED NOT NULL,
  `id_buku` bigint(20) NOT NULL,
  `qty` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `perpanjang_pinjam` int(11) DEFAULT NULL,
  `tgl_hrs_kembali` date NOT NULL,
  `id_petugas` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_anggota`, `id_buku`, `qty`, `tgl_pinjam`, `perpanjang_pinjam`, `tgl_hrs_kembali`, `id_petugas`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 13, 3, 1, '2021-07-28', 3, '2021-08-07', 3, 'Dikembalikan', '2021-07-28 11:07:32', '2021-08-03 07:45:23', NULL),
(5, 13, 2, 1, '2021-07-28', NULL, '2021-08-09', 3, 'Dikembalikan', '2021-07-28 11:13:14', '2021-08-13 08:31:51', NULL),
(9, 13, 4, 1, '2021-08-03', NULL, '2021-08-10', 3, 'Dikembalikan', '2021-08-03 03:07:00', NULL, NULL),
(10, 8, 5, 1, '2021-08-13', NULL, '2021-08-20', 9, 'Dikembalikan', '2021-08-13 08:50:13', NULL, NULL),
(11, 8, 7, 1, '2021-08-01', NULL, '2021-08-08', 9, 'Dikembalikan', '2021-08-13 14:09:10', '2021-08-13 02:21:45', NULL),
(12, 13, 8, 1, '2021-08-23', 5, '2021-09-04', 3, 'Dipinjam', '2021-08-23 14:29:38', '2021-08-24 09:23:19', NULL),
(13, 13, 11, 1, '2021-08-24', NULL, '2021-08-31', 9, 'Dipinjam', '2021-08-24 16:51:52', NULL, NULL);

--
-- Triggers `peminjaman`
--
DELIMITER $$
CREATE TRIGGER `after_buku_dipinjam` AFTER INSERT ON `peminjaman` FOR EACH ROW BEGIN
	UPDATE buku 
    SET stok = stok - NEW.qty
    WHERE id_buku = NEW.id_buku;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` bigint(20) NOT NULL,
  `id_peminjaman` bigint(20) NOT NULL,
  `tgl_kembali` date NOT NULL,
  `terlambat` int(11) DEFAULT NULL,
  `denda` int(11) DEFAULT NULL,
  `id_petugas` bigint(10) UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_peminjaman`, `tgl_kembali`, `terlambat`, `denda`, `id_petugas`, `created_at`, `updated_at`) VALUES
(1, 4, '2021-08-12', 5, 15000, 9, '2021-08-12 13:40:31', '2021-08-12 13:40:31'),
(2, 9, '2021-08-12', 2, 6000, 3, '2021-08-12 13:41:59', '2021-08-12 13:41:59'),
(3, 5, '2021-08-12', 8, 24000, 9, '2021-08-12 15:03:49', '2021-08-12 15:03:49'),
(4, 10, '2021-08-13', NULL, NULL, 9, '2021-08-13 09:18:57', '2021-08-13 09:18:57'),
(5, 11, '2021-08-13', 4, 12000, 9, '2021-08-13 14:23:56', '2021-08-13 14:23:56');

--
-- Triggers `pengembalian`
--
DELIMITER $$
CREATE TRIGGER `after_buku_dikembalikan` AFTER INSERT ON `pengembalian` FOR EACH ROW BEGIN
	UPDATE peminjaman 
    SET status = 'Dikembalikan'
    WHERE id_peminjaman = NEW.id_peminjaman;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'users-create', 'Create Users', 'Create Users', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(2, 'users-read', 'Read Users', 'Read Users', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(3, 'users-update', 'Update Users', 'Update Users', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(4, 'users-delete', 'Delete Users', 'Delete Users', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(5, 'payments-create', 'Create Payments', 'Create Payments', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(6, 'payments-read', 'Read Payments', 'Read Payments', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(7, 'payments-update', 'Update Payments', 'Update Payments', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(8, 'payments-delete', 'Delete Payments', 'Delete Payments', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(9, 'profile-read', 'Read Profile', 'Read Profile', '2021-07-12 00:23:39', '2021-07-12 00:23:39'),
(10, 'profile-update', 'Update Profile', 'Update Profile', '2021-07-12 00:23:39', '2021-07-12 00:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 3),
(10, 1),
(10, 2),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Admin', 'Admin', '2021-07-12 00:23:38', '2021-07-12 00:23:38'),
(2, 'petugas', 'Petugas', 'Petugas', '2021-07-12 00:23:40', '2021-07-12 00:23:40'),
(3, 'anggota', 'Anggota', 'Anggota', '2021-07-12 00:23:41', '2021-07-12 00:23:41');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`, `user_type`) VALUES
(1, 1, 'App\\Models\\User'),
(2, 2, 'App\\Models\\User'),
(2, 3, 'App\\Models\\User'),
(2, 4, 'App\\Models\\User'),
(2, 5, 'App\\Models\\User'),
(3, 6, 'App\\Models\\User'),
(3, 7, 'App\\Models\\User'),
(3, 8, 'App\\Models\\User'),
(2, 9, 'App\\Models\\User'),
(3, 12, 'App\\Models\\User'),
(3, 13, 'App\\Models\\User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `phone`, `alamat`, `image`, `password`, `remember_token`, `is_active`, `created_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Yesica Anggraeni', 'yesicaagrn654@gmail.com', NULL, '089487785433', 'Jl. Ciparay Tengah', 'default.png', '$2y$10$rPI1uMWGrn4SSJ6bH1wjSuawrahnTgDcctE2EPZ1OX9YtHHkRFdnO', NULL, 0, 1, NULL, '2021-07-12 07:40:40', '2021-09-02 02:00:13'),
(3, 'Ajeng Maelani', 'ajeng@gmail.com', NULL, '081574838900', 'Jl. Ciparay Tengah', 'default.png', '$2y$10$XfS0y/mSfxlXi3yGQaPtxOjobObQPP76yuYhHjfCb4BBBT6PzM0o.', NULL, 0, 1, NULL, '2021-07-15 19:55:43', '2021-09-02 02:03:04'),
(8, 'Alma Damayanti', 'alma@gmail.com', NULL, '089578883201', 'Cicaheum', 'Alma_Damayanti.jpg', '$2y$10$j7fh8g3UmJ2iG.CUKBh.Me6PDKqA.7qMo4ocPl0R7KsO8UMS1u3lu', NULL, 0, 3, NULL, '2021-07-19 03:00:09', '2021-08-11 23:22:35'),
(9, 'Riana Damayanti', 'riana@gmail.com', NULL, '089567773284', 'Jl. Cibaduyut Raya', 'Riana_Damayanti.jpg', '$2y$10$.t1b1O20YhAtQufOqmzttu.H4ZfQFF7w/lCO6YAzdProRr0APRpsy', NULL, 1, 9, NULL, '2021-07-21 02:01:42', '2021-09-02 02:52:17'),
(13, 'Kirani Desta', 'kirani@gmail.com', NULL, '089578884389', 'Jl. Terusan Buah Batu', 'Kirani_Desta.jpg', '$2y$10$aVCc1jYufCqTqfV0QXwx4eF8caCsJj7FbZK/fpIY6hp3MdtFkvnbi', NULL, 0, 1, NULL, '2021-07-22 03:42:39', '2021-09-02 02:50:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `peminjaman_id_anggota_foreign` (`id_anggota`),
  ADD KEY `peminjaman_id_petugas_foreign` (`id_petugas`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`user_type`,`role_id`) USING BTREE,
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_id_anggota_foreign` FOREIGN KEY (`id_anggota`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjaman_id_petugas_foreign` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

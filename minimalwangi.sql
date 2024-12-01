-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 03:17 AM
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
-- Database: `minimalwangi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('0716d9708d321ffb6a00818614779e779925365c', 'i:2;', 1732876284),
('0716d9708d321ffb6a00818614779e779925365c:timer', 'i:1732876284;', 1732876284),
('68fc6a5c447b430c4b0b712fa40f2cba', 'i:1;', 1732876386),
('68fc6a5c447b430c4b0b712fa40f2cba:timer', 'i:1732876386;', 1732876386),
('711b68263fd556095f15a8d5d6d1913d', 'i:1;', 1732633280),
('711b68263fd556095f15a8d5d6d1913d:timer', 'i:1732633280;', 1732633280),
('71fb086aa4a5c7b658559e6fc8fbce64', 'i:1;', 1732931569),
('71fb086aa4a5c7b658559e6fc8fbce64:timer', 'i:1732931569;', 1732931569),
('9e6a55b6b4563e652a23be9d623ca5055c356940', 'i:1;', 1732927417),
('9e6a55b6b4563e652a23be9d623ca5055c356940:timer', 'i:1732927417;', 1732927417),
('a6cf3449fbccdc26d9aeadb6f26b8c25', 'i:1;', 1732931328),
('a6cf3449fbccdc26d9aeadb6f26b8c25:timer', 'i:1732931328;', 1732931328),
('fa35e192121eabf3dabf9f5ea6abdbcbc107ac3b', 'i:1;', 1732875251),
('fa35e192121eabf3dabf9f5ea6abdbcbc107ac3b:timer', 'i:1732875251;', 1732875251),
('romeo@gmail.com|127.0.0.1', 'i:1;', 1732633280),
('romeo@gmail.com|127.0.0.1:timer', 'i:1732633280;', 1732633280);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `created_at`, `updated_at`, `name`, `email`, `no_telp`, `alamat`, `nama_produk`, `jumlah`, `harga`, `image`, `user_id`, `product_id`) VALUES
(80, '2024-11-29 02:22:53', '2024-11-29 02:22:53', 'Rafly Romeo', 'rafly@gmail.com', '08213456335', 'gshshsdh', 'Dolce Gabannna', '1', '1800000', '1732654288.webp', '6', '3');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `categories_name`, `created_at`, `updated_at`) VALUES
(1, 'Men', '2024-11-25 17:59:10', '2024-11-25 17:59:10'),
(2, 'Women', '2024-11-25 17:59:19', '2024-11-25 17:59:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(10, '0001_01_01_000000_create_users_table', 1),
(11, '0001_01_01_000001_create_cache_table', 1),
(12, '0001_01_01_000002_create_jobs_table', 1),
(13, '2024_11_15_233629_add_two_factor_columns_to_users_table', 1),
(14, '2024_11_15_233726_create_personal_access_tokens_table', 1),
(15, '2024_11_16_071628_create_categories_table', 1),
(16, '2024_11_16_090943_create_products_table', 1),
(21, '2024_11_16_105257_rename_categories_to_categories_name_in_products_table', 2),
(22, '2024_11_16_205516_create_carts_table', 2),
(23, '2024_11_26_041644_create_orders_table', 3),
(24, '2024_11_26_044349_create_orders_detail_table', 4),
(25, '2024_11_26_061804_create_order_details_table', 5),
(26, '2024_11_28_225758_create_reviews_table', 6),
(27, '2024_11_29_014127_create_reviews_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `no_resi` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `delivery_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `nama_produk`, `jumlah`, `harga`, `product_id`, `created_at`, `updated_at`) VALUES
(14, '15', 'Dolce Gabannna', '2', '1800000', '3', '2024-11-27 10:00:23', '2024-11-27 10:00:23'),
(15, '16', 'Becausr it\'s you', '1', '1350000', '5', '2024-11-27 10:04:30', '2024-11-27 10:04:30'),
(16, '16', 'Emporio armani', '1', '1330000', '6', '2024-11-27 10:04:30', '2024-11-27 10:04:30'),
(17, '17', 'Calvin Klein', '1', '1700000', '2', '2024-11-28 01:00:00', '2024-11-28 01:00:00'),
(18, '18', 'Dolce Gabannna', '2', '1800000', '3', '2024-11-28 02:43:24', '2024-11-28 02:43:24'),
(19, '19', 'Calvin Klein', '1', '1700000', '2', '2024-11-28 03:28:09', '2024-11-28 03:28:09'),
(20, '19', 'lataffa', '3', '900000', '4', '2024-11-28 03:28:09', '2024-11-28 03:28:09'),
(21, '20', 'Calvin Klein', '1', '1700000', '2', '2024-11-28 03:28:52', '2024-11-28 03:28:52'),
(22, '21', 'Calvin Klein', '1', '1700000', '2', '2024-11-28 04:53:24', '2024-11-28 04:53:24'),
(23, '21', 'Vera wang Princess', '4', '1955000', '7', '2024-11-28 04:53:24', '2024-11-28 04:53:24'),
(24, '22', 'Rexonax', '3', '193600', '1', '2024-11-28 07:43:28', '2024-11-28 07:43:28'),
(25, '23', 'Calvin Klein', '3', '1700000', '2', '2024-11-29 01:43:52', '2024-11-29 01:43:52'),
(26, '24', 'Calvin Klein', '1', '1700000', '2', '2024-11-29 02:22:02', '2024-11-29 02:22:02'),
(27, '25', 'Becausr it\'s you', '2', '1350000', '5', '2024-11-29 03:33:33', '2024-11-29 03:33:33'),
(28, '26', 'Emporio armani', '1', '1330000', '6', '2024-11-29 08:06:24', '2024-11-29 08:06:24'),
(29, '27', 'Calvin Klein', '1', '1700000', '2', '2024-11-29 18:24:42', '2024-11-29 18:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('rafly@gmail.com', '$2y$12$JcFJwMtTNKTJPAVktIHVbeOv2kcsLBcyCfVdHaytLNoRGmP7BLlsK', '2024-11-28 07:45:25');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `diskon` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `nama_produk`, `deskripsi`, `image`, `categories_name`, `jumlah`, `harga`, `diskon`, `created_at`, `updated_at`) VALUES
(1, 'Rexonax', 'fagaegeagshrhw', '1732583060.webp', 'Men', '23', '220000', '12', '2024-11-25 18:04:20', '2024-11-25 18:04:20'),
(2, 'Calvin Klein', 'Wangiiiiiiiii', '1732654250.webp', 'Women', '34', '2000000', '15', '2024-11-26 13:50:50', '2024-11-26 13:50:50'),
(3, 'Dolce Gabannna', 'Harummmmm', '1732654288.webp', 'Men', '12', '2000000', '10', '2024-11-26 13:51:28', '2024-11-26 13:51:28'),
(4, 'lataffa', 'fasagagahdasha', '1732654341.webp', 'Men', '10', '900000', '0', '2024-11-26 13:52:21', '2024-11-26 13:52:21'),
(5, 'Becausr it\'s you', 'karena kamu', '1732654392.jpg', 'Women', '10', '1500000', '10', '2024-11-26 13:53:12', '2024-11-26 13:53:12'),
(6, 'Emporio armani', 'giagaogaopjpoa', '1732654433.webp', 'Women', '15', '1400000', '5', '2024-11-26 13:53:53', '2024-11-26 13:53:53'),
(7, 'Vera wang Princess', 'shshfdjdgjtjtejet', '1732654476.jpg', 'Women', '5', '2300000', '15', '2024-11-26 13:54:36', '2024-11-26 13:54:36'),
(8, 'Stronger with you', 'sbxfnfsdnfnsfdndf', '1732654526.webp', 'Men', '5', '2500000', '15', '2024-11-26 13:55:26', '2024-11-26 13:55:26'),
(9, 'Dior Sauvage', 'agdasbdsbsf', '1732654565.webp', 'Men', '5', '1500000', '10', '2024-11-26 13:56:05', '2024-11-26 13:56:05'),
(10, 'Armani code', 'eoidodnaiognao', '1732654603.jpg', 'Men', '10', '1750000', '0', '2024-11-26 13:56:43', '2024-11-26 13:56:43'),
(11, 'YSL Kouros', 'ajfaisoifashpifjasijfoaij iaehfoahsofiha', '1732654685.jpg', 'Men', '15', '150000', '14', '2024-11-26 13:58:05', '2024-11-26 13:58:05');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('r2BnLdMYU6ZZe7dZKqihCU9kjkGyufkXLPPESlF2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMDFmYVNlM1EzSmw5SkQ3c0VrT2l2Y0dnZnluSUtxbWRJejJubXQzbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1732932466);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `no_telp`, `alamat`, `usertype`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(5, 'Rafly Romeo', 'admin@admin.com', '30539026204', 'admin@admin.com', '1', '2024-11-28 10:34:26', '$2y$12$f397gAOuDeDCYz/DoW9uiOqhgjiJeCEJmRg/C/6NJWjjkd/Qu/xYe', NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-25 12:04:19', '2024-11-25 12:04:19'),
(17, 'Rafly Romeo', 'yutuberbeken@gmail.com', '392850923858', 'kaman', '0', '2024-11-29 03:30:43', '$2y$12$RX1hFykPmezzGn50NepmvumNsyZU6c26ZGwXh/7rypK3sVsyHR9Zy', NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-29 03:28:04', '2024-11-29 17:50:51'),
(18, 'Rafly Romeo', '2211102265@ittelkom-pwt.ac.id', '80938509280935', 'aiognaooin', '0', '2024-11-29 17:42:39', '$2y$12$D3Y6I7eetDYdh3rE4X7ZNO8toJjaUm5B75ajX6lqL57CyKwcBgkPm', NULL, NULL, NULL, NULL, NULL, NULL, '2024-11-29 17:41:37', '2024-11-29 17:42:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

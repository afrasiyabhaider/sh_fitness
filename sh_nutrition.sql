-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 05, 2020 at 05:39 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sh_nutrition`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categories_title_unique` (`title`),
  KEY `categories_parent_id_foreign` (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Protien', 0, '2020-04-05 12:10:13', '2020-04-05 12:10:13', NULL),
(4, 'Whey', 3, '2020-04-05 12:10:45', '2020-04-05 12:15:38', NULL),
(5, 'Test', 3, '2020-04-05 12:15:51', '2020-04-05 12:15:51', NULL),
(6, 'Accessories', 0, '2020-04-05 12:16:06', '2020-04-05 12:33:11', '2020-04-05 12:33:11'),
(7, 'Belt', 6, '2020-04-05 12:17:41', '2020-04-05 12:33:11', '2020-04-05 12:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `flavours`
--

DROP TABLE IF EXISTS `flavours`;
CREATE TABLE IF NOT EXISTS `flavours` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `flavours_title_unique` (`title`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `flavours`
--

INSERT INTO `flavours` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'Strawberry', '2020-03-31 08:28:04', '2020-03-31 08:28:04', NULL),
(4, 'Chocolate', '2020-04-05 07:15:21', '2020-04-05 07:15:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_29_103930_create_permission_tables', 1),
(5, '2020_03_30_131414_create_media_table', 2),
(6, '2020_03_30_132152_create_categories_table', 3),
(7, '2020_03_30_132629_create_flavours_table', 3),
(8, '2020_03_30_132726_create_sizes_table', 3),
(9, '2020_03_30_134505_create_products_table', 3),
(11, '2020_03_30_135402_create_product_sizes_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Register Portal User', 'web', '2020-04-05 07:39:42', '2020-04-05 07:39:42'),
(2, 'View Portal Users', 'web', '2020-04-05 07:39:53', '2020-04-05 07:39:53'),
(3, 'Edit Portal Users', 'web', '2020-04-05 07:39:59', '2020-04-05 07:39:59'),
(4, 'Disable Portal Users', 'web', '2020-04-05 07:40:03', '2020-04-05 07:40:03'),
(5, 'Enable Portal Users', 'web', '2020-04-05 07:40:07', '2020-04-05 07:40:07'),
(6, 'Permanent Delete Portal Users', 'web', '2020-04-05 07:40:14', '2020-04-05 07:40:14'),
(7, 'Reset Portal User Password', 'web', '2020-04-05 07:40:49', '2020-04-05 07:40:49'),
(8, 'Register Role', 'web', '2020-04-05 07:41:07', '2020-04-05 07:41:07'),
(9, 'View Roles', 'web', '2020-04-05 07:41:12', '2020-04-05 07:41:12'),
(10, 'Edit Role', 'web', '2020-04-05 07:41:20', '2020-04-05 07:41:20'),
(11, 'Delete Role', 'web', '2020-04-05 07:41:40', '2020-04-05 07:41:40'),
(12, 'Assign Role', 'web', '2020-04-05 07:41:54', '2020-04-05 07:41:54'),
(14, 'Revoke Role', 'web', '2020-04-05 07:41:59', '2020-04-05 07:41:59'),
(15, 'Assign Permission to Role', 'web', '2020-04-05 07:42:22', '2020-04-05 07:42:22'),
(16, 'Revoke Permission', 'web', '2020-04-05 07:42:31', '2020-04-05 07:42:31'),
(17, 'View Role Permissions', 'web', '2020-04-05 07:42:41', '2020-04-05 07:42:41'),
(18, 'Register Flavour', 'web', '2020-04-05 07:42:57', '2020-04-05 07:42:57'),
(19, 'View Flavours', 'web', '2020-04-05 07:43:01', '2020-04-05 07:43:01'),
(20, 'Edit Flavour', 'web', '2020-04-05 07:43:22', '2020-04-05 07:43:22'),
(21, 'Disable Flavour', 'web', '2020-04-05 07:43:47', '2020-04-05 07:43:47'),
(22, 'Register Size', 'web', '2020-04-05 07:43:59', '2020-04-05 07:43:59'),
(23, 'View Sizes', 'web', '2020-04-05 07:44:06', '2020-04-05 07:44:06'),
(24, 'Edit Size', 'web', '2020-04-05 07:44:13', '2020-04-05 07:44:13'),
(25, 'Disable Size', 'web', '2020-04-05 07:44:18', '2020-04-05 07:44:18'),
(13, 'View Assigned Roles', 'web', '2020-04-05 07:41:55', '2020-04-04 19:00:00'),
(27, 'Revoke Permission', 'web', '2020-04-05 07:52:11', '2020-04-05 07:52:11'),
(28, 'Enable Flavour', 'web', '2020-04-05 08:40:06', '2020-04-05 08:40:06'),
(29, 'Permanent Delete Flavour', 'web', '2020-04-05 08:40:17', '2020-04-05 08:40:17'),
(30, 'Enable Size', 'web', '2020-04-05 08:40:28', '2020-04-05 08:40:28'),
(31, 'Permanent Delete Size', 'web', '2020-04-05 08:40:38', '2020-04-05 08:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_qty` tinyint(4) NOT NULL,
  `total_sizes` tinyint(4) NOT NULL,
  `total_flavours` tinyint(4) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `is_featured` tinyint(4) NOT NULL DEFAULT 0,
  `wishlist_count` tinyint(4) NOT NULL DEFAULT 0,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

DROP TABLE IF EXISTS `product_sizes`;
CREATE TABLE IF NOT EXISTS `product_sizes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `flavour_id` bigint(20) UNSIGNED NOT NULL,
  `currency_symbol` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `is_discounted` tinyint(4) NOT NULL DEFAULT 0,
  `discount` decimal(3,2) DEFAULT NULL,
  `price_after_discount` decimal(9,2) DEFAULT NULL,
  `qty` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_sizes_product_id_foreign` (`product_id`),
  KEY `product_sizes_size_id_foreign` (`size_id`),
  KEY `product_sizes_flavour_id_foreign` (`flavour_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2020-04-05 07:45:26', '2020-04-05 07:45:26'),
(11, 'test', 'web', '2020-04-05 08:34:13', '2020-04-05 08:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(2, 11),
(3, 1),
(3, 11),
(4, 1),
(4, 11),
(5, 1),
(5, 11),
(6, 1),
(6, 11),
(7, 1),
(7, 11),
(8, 1),
(8, 11),
(9, 1),
(9, 11),
(10, 1),
(10, 11),
(11, 1),
(11, 11),
(12, 1),
(12, 11),
(13, 1),
(13, 11),
(14, 1),
(14, 11),
(15, 1),
(15, 11),
(16, 1),
(16, 11),
(17, 1),
(17, 11),
(18, 1),
(18, 11),
(19, 1),
(19, 11),
(20, 1),
(20, 11),
(21, 1),
(21, 11),
(22, 1),
(22, 11),
(23, 1),
(23, 11),
(24, 1),
(24, 11),
(25, 1),
(25, 11),
(27, 1),
(27, 11),
(28, 1),
(29, 1),
(30, 1),
(31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `weight` decimal(5,2) DEFAULT NULL,
  `unit` enum('kg','lbs','gram','pcs','mg','S','M','L','Xl') COLLATE utf8mb4_unicode_ci NOT NULL,
  `servings` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `weight`, `unit`, `servings`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2.00', 'kg', 60, NULL, '2020-03-31 07:21:46', NULL),
(2, '0.50', 'kg', 20, '2020-03-30 15:58:54', '2020-03-31 06:14:02', NULL),
(4, '1.00', 'kg', 30, '2020-03-31 07:24:12', '2020-03-31 07:24:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'images/avatar.png',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Male','Female','Others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `password`, `gender`, `phone_number`, `address`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sukraat Haris', 'images/avatar.png', 'shnutritions1@gmail.com', '$2y$10$EQHakHMHYRBrHLSA2Z0Kquxlyswh3D6A6ByOK6c7d14RrC/Q2/GAu', 'Male', '0304212354', 'Gujrat Punjab Pakistan', NULL, NULL, NULL, NULL),
(2, 'Test User', 'images/portal_users//WQHK5GB5euRQGVhpznvsLawRseD4g6tJzcwWaYLJ.jpeg', 'testUser@gmail.com', '$2y$10$imVATmvxWaXpQmWhMgERz.Xyhh/eq9AcBE/DMz2IGEUR1PxH.mDd6', 'Male', '10211223313', 'Gujrat Punjab Pakistan', NULL, '2020-03-29 07:03:48', '2020-04-05 08:45:58', NULL),
(3, 'Afrasiyab Haider', 'images/avatar.png', 'testing@gmail.com', '$2y$10$AFhVsjlooToeChWijthjpemidRxJS6Sk9NfkjT/uNXK0AfxGSYnlq', 'Male', '03357997550', 'Shadman colony, rehman shaheed road', NULL, '2020-04-05 07:21:36', '2020-04-05 08:37:07', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

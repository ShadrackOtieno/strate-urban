-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 24, 2026 at 09:51 AM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `strateurban`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `developments`
--

DROP TABLE IF EXISTS `developments`;
CREATE TABLE IF NOT EXISTS `developments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'completed',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `highlights` text COLLATE utf8mb4_unicode_ci,
  `unit_types` text COLLATE utf8mb4_unicode_ci,
  `how_it_works` text COLLATE utf8mb4_unicode_ci,
  `investment_note` text COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `developments_slug_unique` (`slug`),
  KEY `developments_location_id_foreign` (`location_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `developments`
--

INSERT INTO `developments` (`id`, `location_id`, `name`, `slug`, `tagline`, `status`, `address`, `summary`, `body`, `highlights`, `unit_types`, `how_it_works`, `investment_note`, `cover_image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 'Kingfisher Suites (sample)', 'kingfisher-suites-sample', 'Furnished suites above the city', 'completed', 'Westlands, Nairobi', 'Completed, furnished studio and one-bedroom suites with a rooftop pool, gym and restaurant. A sample development: replace with your own.', 'Completed, furnished studio and one-bedroom suites with a rooftop pool, gym and restaurant. A sample development: replace with your own.\n\nThis is placeholder copy. Describe the building, the neighbourhood, who it suits and what makes it a sound purchase. Add real photographs from the back office.', 'Rooftop pool and sun deck\nGym and wellness room\nRestaurant and lounge\n24-hour security and backup power\nFully furnished, move-in ready', 'Studio: from KSh 9,500,000\nOne bedroom: from KSh 14,000,000', 'Reserve your unit with a small booking fee\nSign the sale agreement and pay the agreed deposit\nPay the balance in monthly instalments\nReceive your unit on completion and handover', 'Any projected income is an estimate, not a guarantee. Ask us for the full numbers and the operator agreement before you decide.', 'images/sample/dev-kingfisher.svg', 0, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(2, 1, 'Airport Gate Residences (sample)', 'airport-gate-residences-sample', 'Hotel apartments minutes from the airport', 'under_construction', 'Nairobi, Nairobi', 'Serviced apartments positioned for business travellers and airline crews, designed to be run by a professional hotel operator. A sample development.', 'Serviced apartments positioned for business travellers and airline crews, designed to be run by a professional hotel operator. A sample development.\n\nThis is placeholder copy. Describe the building, the neighbourhood, who it suits and what makes it a sound purchase. Add real photographs from the back office.', 'Close to the main airport\nProfessional operator model\nFurnished, hotel-grade finishes\nSecure parking\nFlexible instalment plan', 'Studio: from KSh 7,800,000\nOne bedroom: from KSh 11,500,000', 'Reserve your unit with a small booking fee\nSign the sale agreement and pay the agreed deposit\nPay the balance in monthly instalments\nReceive your unit on completion and handover', 'Any projected income is an estimate, not a guarantee. Ask us for the full numbers and the operator agreement before you decide.', 'images/sample/dev-jkia.svg', 1, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(3, 2, 'Sports Road Apartments (sample)', 'sports-road-apartments-sample', 'Modern living in the heart of Westlands', 'off_plan', 'Westlands, Nairobi', 'An off-plan development of contemporary apartments near restaurants, offices and schools. A sample development.', 'An off-plan development of contemporary apartments near restaurants, offices and schools. A sample development.\n\nThis is placeholder copy. Describe the building, the neighbourhood, who it suits and what makes it a sound purchase. Add real photographs from the back office.', 'Walkable Westlands location\nBalconies and city views\nShared pool and gym\nGenerator and borehole\nPayment plan over 24 months', 'Studio: from KSh 8,200,000\nTwo bedroom: from KSh 16,500,000', 'Reserve your unit with a small booking fee\nSign the sale agreement and pay the agreed deposit\nPay the balance in monthly instalments\nReceive your unit on completion and handover', 'Any projected income is an estimate, not a guarantee. Ask us for the full numbers and the operator agreement before you decide.', 'images/sample/dev-westgate.svg', 2, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `enquiries`
--

DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE IF NOT EXISTS `enquiries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `property_id` bigint UNSIGNED DEFAULT NULL,
  `development_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `interest` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'general',
  `unit_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `admin_notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `enquiries_reference_unique` (`reference`),
  KEY `enquiries_property_id_foreign` (`property_id`),
  KEY `enquiries_development_id_foreign` (`development_id`),
  KEY `enquiries_status_index` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE IF NOT EXISTS `faqs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `answer`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'How do I buy a property through you?', 'Choose a property, book a viewing, and reserve it with a booking fee. We then prepare the sale agreement, agree a payment plan if you need one, and manage the process until you receive your keys or title.', 0, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(2, 'Can I pay in instalments?', 'Many of our developments offer a deposit followed by monthly instalments. The plan for each property is shown on its page and confirmed in writing before you pay.', 1, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(3, 'How do I know the property is genuine?', 'We check title, approvals and ownership before listing, and we share the documents with you during due diligence. You are also free to bring your own lawyer.', 2, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(4, 'Do you handle rentals as well as sales?', 'Yes. We list homes and land for rent and lease, and we can manage the property for you after it is let.', 3, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(5, 'Are projected returns guaranteed?', 'No. Any figure we share about rental or hotel income is an estimate based on assumptions. Always ask for the full workings and the operator agreement.', 4, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `county` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `locations_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `slug`, `county`, `description`, `image`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Nairobi', 'nairobi', 'Nairobi County', 'The capital: business districts, serviced apartments near the airport, leafy suburbs and fast-growing satellite towns.', 'images/sample/loc-nairobi.svg', 0, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(2, 'Westlands', 'westlands', 'Nairobi County', 'Nairobi\'s dining, nightlife and office hub, popular with professionals, expatriates and short-stay guests.', 'images/sample/loc-westlands.svg', 1, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(3, 'Kiambu', 'kiambu', 'Kiambu County', 'Green, well-connected residential land and homes just north of the city, ideal for families and long-term holds.', 'images/sample/loc-kiambu.svg', 2, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(4, 'Nyeri', 'nyeri', 'Nyeri County', 'Cool highland living below Mount Kenya, with affordable land and a strong lifestyle appeal.', 'images/sample/loc-nyeri.svg', 3, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_11_000001_add_is_admin_to_users_table', 1),
(5, '2026_10_26_000002_create_estate_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `location_id` bigint UNSIGNED DEFAULT NULL,
  `development_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'apartment',
  `purpose` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sale',
  `price` bigint UNSIGNED NOT NULL DEFAULT '0',
  `price_period` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bedrooms` tinyint UNSIGNED DEFAULT NULL,
  `bathrooms` tinyint UNSIGNED DEFAULT NULL,
  `size` decimal(10,2) DEFAULT NULL,
  `size_unit` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sqm',
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `features` text COLLATE utf8mb4_unicode_ci,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'available',
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `properties_slug_unique` (`slug`),
  KEY `properties_location_id_foreign` (`location_id`),
  KEY `properties_development_id_foreign` (`development_id`),
  KEY `properties_is_active_purpose_type_index` (`is_active`,`purpose`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `location_id`, `development_id`, `title`, `slug`, `type`, `purpose`, `price`, `price_period`, `bedrooms`, `bathrooms`, `size`, `size_unit`, `address`, `short_description`, `description`, `features`, `cover_image`, `status`, `is_featured`, `is_hot`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'Furnished studio at Kingfisher Suites (sample)', 'furnished-studio-at-kingfisher-suites-sample', 'apartment', 'sale', 9500000, NULL, 0, 1, 38.00, 'sqm', 'Westlands, Kenya', 'Furnished studio with rooftop pool, gym and restaurant access.', 'Furnished studio with rooftop pool, gym and restaurant access.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-studio-1.svg', 'available', 1, 1, 1, 0, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(2, 2, 1, 'One-bedroom hotel apartment, Westlands (sample)', 'one-bedroom-hotel-apartment-westlands-sample', 'apartment', 'sale', 14000000, NULL, 1, 1, 62.00, 'sqm', 'Westlands, Kenya', 'Bright one-bedroom suite in a managed hotel building.', 'Bright one-bedroom suite in a managed hotel building.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-studio-2.svg', 'available', 1, 1, 1, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(3, 2, 3, 'Two-bedroom apartment, Sports Road (sample)', 'two-bedroom-apartment-sports-road-sample', 'apartment', 'sale', 16500000, NULL, 2, 2, 98.00, 'sqm', 'Westlands, Kenya', 'Off-plan two-bedroom apartment with balcony and city views.', 'Off-plan two-bedroom apartment with balcony and city views.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-apartment-1.svg', 'available', 1, 0, 1, 2, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(4, 1, 2, 'Airport-side studio apartment (sample)', 'airport-side-studio-apartment-sample', 'apartment', 'sale', 7800000, NULL, 0, 1, 34.00, 'sqm', 'Nairobi, Kenya', 'Compact furnished studio designed for short-stay demand.', 'Compact furnished studio designed for short-stay demand.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-apartment-3.svg', 'available', 0, 1, 1, 3, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(5, 2, NULL, 'Modern studio to let, Westlands (sample)', 'modern-studio-to-let-westlands-sample', 'apartment', 'rent', 150000, 'month', 0, 1, 40.00, 'sqm', 'Westlands, Kenya', 'Furnished studio with fibre internet, gym and secure parking.', 'Furnished studio with fibre internet, gym and secure parking.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-apartment-2.svg', 'available', 0, 1, 1, 4, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(6, 1, NULL, 'Three-bedroom apartment to let, Nairobi (sample)', 'three-bedroom-apartment-to-let-nairobi-sample', 'apartment', 'rent', 210000, 'month', 3, 3, 160.00, 'sqm', 'Nairobi, Kenya', 'Spacious family apartment with a DSQ, backup power and a shared pool.', 'Spacious family apartment with a DSQ, backup power and a shared pool.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-apartment-4.svg', 'available', 1, 0, 1, 5, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(7, 3, NULL, 'Four-bedroom maisonette, Kiambu (sample)', 'four-bedroom-maisonette-kiambu-sample', 'house', 'rent', 180000, 'month', 4, 4, 320.00, 'sqm', 'Kiambu, Kenya', 'Gated maisonette with garden, DSQ and ample parking.', 'Gated maisonette with garden, DSQ and ample parking.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-house-1.svg', 'available', 1, 1, 1, 6, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(8, 1, NULL, 'Five-bedroom villa, Nairobi (sample)', 'five-bedroom-villa-nairobi-sample', 'house', 'rent', 450000, 'month', 5, 5, 520.00, 'sqm', 'Nairobi, Kenya', 'Quiet residential villa with pool, large garden and staff quarters.', 'Quiet residential villa with pool, large garden and staff quarters.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-house-2.svg', 'available', 0, 0, 1, 7, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(9, 3, NULL, 'Contemporary home to let, Kiambu (sample)', 'contemporary-home-to-let-kiambu-sample', 'house', 'rent', 135000, 'month', 3, 3, 240.00, 'sqm', 'Kiambu, Kenya', 'Three-bedroom home in a secure estate with a clubhouse.', 'Three-bedroom home in a secure estate with a clubhouse.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', '24-hour security\nBackup power\nAmple parking\nHigh-speed internet\nBorehole or reliable water', 'images/sample/p-house-3.svg', 'available', 0, 0, 1, 8, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(10, 3, NULL, 'Quarter-acre plot for sale, Kiambu (sample)', 'quarter-acre-plot-for-sale-kiambu-sample', 'land', 'sale', 3800000, NULL, NULL, NULL, 0.25, 'acres', 'Kiambu, Kenya', 'Ready title, murram roads, water and power on site.', 'Ready title, murram roads, water and power on site.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', 'Title deed ready\nAccess road\nWater and power nearby\nSecure area', 'images/sample/p-land-1.svg', 'available', 1, 1, 1, 9, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(11, 4, NULL, 'Half-acre plot for sale, Nyeri (sample)', 'half-acre-plot-for-sale-nyeri-sample', 'land', 'sale', 2400000, NULL, NULL, NULL, 0.50, 'acres', 'Nyeri, Kenya', 'Gently sloping plot with mountain views and fertile soil.', 'Gently sloping plot with mountain views and fertile soil.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', 'Title deed ready\nAccess road\nWater and power nearby\nSecure area', 'images/sample/p-land-2.svg', 'available', 0, 1, 1, 10, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(12, 4, NULL, 'Five acres for lease, Nyeri (sample)', 'five-acres-for-lease-nyeri-sample', 'land', 'lease', 600000, 'year', NULL, NULL, 5.00, 'acres', 'Nyeri, Kenya', 'Open farmland available on a multi-year lease.', 'Open farmland available on a multi-year lease.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', 'Title deed ready\nAccess road\nWater and power nearby\nSecure area', 'images/sample/p-land-3.svg', 'available', 0, 0, 1, 11, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(13, 3, NULL, 'Two acres for lease, Kiambu (sample)', 'two-acres-for-lease-kiambu-sample', 'land', 'lease', 450000, 'year', NULL, NULL, 2.00, 'acres', 'Kiambu, Kenya', 'Fenced land with borehole, suited to farming or storage.', 'Fenced land with borehole, suited to farming or storage.\n\nThis is a sample listing. Replace it with a real description, accurate details and photographs from the back office.', 'Title deed ready\nAccess road\nWater and power nearby\nSecure area', 'images/sample/p-land-4.svg', 'available', 0, 0, 1, 12, '2026-10-27 03:30:34', '2026-10-27 03:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

DROP TABLE IF EXISTS `property_images`;
CREATE TABLE IF NOT EXISTS `property_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` bigint UNSIGNED NOT NULL,
  `path` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `property_images_property_id_foreign` (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `summary` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `icon`, `summary`, `body`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Property sales', 'home', 'We list, market and sell apartments, houses and land, and guide buyers from viewing to title transfer.', NULL, 0, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(2, 'Rentals and leasing', 'key', 'Find tenants or find a home: we match the right people to the right property and handle agreements.', NULL, 1, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(3, 'Investment advisory', 'bar-chart', 'Plain-language advice on hotel apartments, rental yields, off-plan and land, with the risks explained.', NULL, 2, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(4, 'Land and due diligence', 'map-pin', 'Title searches, survey checks and approvals confirmed before you pay a shilling.', NULL, 3, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(5, 'Property management', 'wrench', 'Rent collection, maintenance and tenant care for owners who want their property looked after.', NULL, 4, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(6, 'Legal and documentation', 'file-text', 'Sale agreements, payment schedules and handover documents prepared and explained.', NULL, 5, 1, '2026-10-27 03:30:34', '2026-10-27 03:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'company_name', 'Strateurban', '2026-10-27 03:30:33', '2026-10-27 04:32:44'),
(2, 'tagline', 'Premium property in Nairobi and beyond', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(3, 'meta_description', 'Buy, rent and invest in apartments, houses, hotel apartments and land across Kenya with Kilele Properties.', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(4, 'hero_title', 'Property worth holding on to.', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(5, 'hero_text', 'Hotel apartments, residences and land across Kenya, chosen carefully and sold with clear paperwork and honest numbers.', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(6, 'cta_title', 'Let us find the right property for you.', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(7, 'cta_text', 'Tell us what you are looking for. A consultant will call you within one working day with options that fit your budget.', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(8, 'about_intro', 'Kilele Properties is a Nairobi real estate company that helps people buy, sell, rent and lease quality property across Kenya.\r\n\r\nWe focus on well-located apartments, hotel apartments, family homes and land, and we handle the work around the sale: viewings, due diligence, payment plans and handover.', '2026-10-27 03:30:33', '2026-10-27 03:52:06'),
(9, 'mission', 'To make owning and investing in Kenyan property clear, safe and rewarding.', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(10, 'values', 'Clear paperwork: Every property is checked for title and approvals before we list it.\r\nHonest numbers: Prices, fees and payment plans are explained in writing, with no surprises.\r\nReal service: One consultant stays with you from first viewing to handover.\r\nLong-term thinking: We recommend what suits your goals, not what is easiest to sell.', '2026-10-27 03:30:33', '2026-10-27 03:52:06'),
(11, 'email', 'hello@kilele.test', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(12, 'notify_email', 'hello@kilele.test', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(13, 'phone', '+254 700 000 001', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(14, 'phone2', '+254 700 000 002', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(15, 'whatsapp', '254700000001', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(16, 'address', 'Your building, Your street, Nairobi', '2026-10-27 03:30:33', '2026-10-27 03:30:33'),
(17, 'hours', 'Mon to Sat, 8:00 to 17:00 EAT', '2026-10-27 03:30:34', '2026-10-27 03:30:34'),
(18, 'map_embed', NULL, '2026-10-27 03:30:34', '2026-10-27 03:52:06'),
(19, 'primary_color', '#352a7f', '2026-10-27 03:30:34', '2026-10-27 03:54:43'),
(20, 'accent_color', '#ff0000', '2026-10-27 03:30:34', '2026-10-27 03:52:06'),
(21, 'facebook', NULL, '2026-10-27 03:30:34', '2026-10-27 03:52:06'),
(22, 'instagram', NULL, '2026-10-27 03:30:34', '2026-10-27 03:52:06'),
(23, 'linkedin', NULL, '2026-10-27 03:30:34', '2026-10-27 03:52:06'),
(24, 'twitter', NULL, '2026-10-27 03:30:34', '2026-10-27 03:52:06'),
(25, 'youtube', NULL, '2026-10-27 03:30:34', '2026-10-27 03:52:06'),
(26, 'logo', 'branding/IvFfaK1026xKeYUHOiEU0260RhUraQjpWlHvEgrx.png', '2026-10-27 04:33:42', '2026-10-27 04:33:42');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscribers_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'rackotii@gmail.com', '2026-10-27 03:56:20', '2026-10-27 03:56:20');

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

DROP TABLE IF EXISTS `team_members`;
CREATE TABLE IF NOT EXISTS `team_members` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `title`, `bio`, `photo`, `phone`, `email`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Your Name', 'Director', 'Replace with a real bio and photo, then tick \"Show on website\".', NULL, NULL, NULL, 0, 0, '2026-10-27 03:30:34', '2026-10-27 03:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_place` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quote` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL DEFAULT '5',
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `author_name`, `author_place`, `quote`, `rating`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Client Name', 'Town', 'Replace with a real quote from a client who has agreed to be quoted.', 5, 0, 0, '2026-10-27 03:30:34', '2026-10-27 03:30:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kilele Admin', 'admin@kilele.test', NULL, '$2y$12$Hl0aeZ/dKYyX6oG83evFYO7gUPV4WWaC6XlPMpm3jJNtcy/v9uEYq', 1, NULL, '2026-10-27 03:30:33', '2026-10-27 03:30:33');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `developments`
--
ALTER TABLE `developments`
  ADD CONSTRAINT `developments_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `enquiries`
--
ALTER TABLE `enquiries`
  ADD CONSTRAINT `enquiries_development_id_foreign` FOREIGN KEY (`development_id`) REFERENCES `developments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `enquiries_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_development_id_foreign` FOREIGN KEY (`development_id`) REFERENCES `developments` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `properties_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

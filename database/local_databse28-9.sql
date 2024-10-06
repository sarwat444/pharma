-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 05:01 PM
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
-- Database: `itqan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `super_admin` tinyint(4) NOT NULL DEFAULT 0,
  `program_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `mayear_id` int(11) DEFAULT NULL,
  `role` enum('program_manager','teaching_manager') NOT NULL,
  `matrial_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `college_id`, `super_admin`, `program_id`, `type`, `mayear_id`, `role`, `matrial_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$4ijV4bzb6MVdlJeZHINvNOZelYl20xZbzGy8a1JboI0njKruQbRlS', 1, 1, NULL, 0, NULL, 'program_manager', 1, NULL, '2024-09-27 04:32:39', '2024-09-27 04:32:39'),
(2, 'test teacher', 'm@gmail.cm', NULL, '133', 1, 0, NULL, 0, NULL, 'program_manager', NULL, NULL, '2024-09-27 08:30:22', '2024-09-27 08:30:22'),
(3, 'عضو هيئة تدريس', 't@gmail.com', NULL, '$2y$10$44X/3DHSv8sbR6rn4WDOfumB.ZRZPEc4jqjsIQr38BDitwLrzG4Ge', 1, 0, 1, 3, NULL, 'teaching_manager', NULL, NULL, '2024-09-27 17:54:37', '2024-09-27 17:54:37'),
(4, 'عضو هيئة تدريس #1', 'Teacher@gmail.com', NULL, '$2y$10$Cdz4p/tnHmWz9lYLUrN73.qgodVGVNdu5oC.NGcx/4nmntcbAPZz6', 1, 0, 1, 3, NULL, 'teaching_manager', 1, NULL, '2024-09-27 18:57:23', '2024-09-27 18:57:23'),
(5, 'Allistair Raymond', 'zavok@mailinator.com', NULL, '$2y$10$miWFvjv/K7hGb4tZ.K9g6OUlnJhSBxqa3tteteeu2aCl1sDqLrMtS', 1, 0, 1, 3, NULL, 'teaching_manager', 1, NULL, '2024-09-27 19:04:00', '2024-09-27 19:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `category_questions`
--

CREATE TABLE `category_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `survey_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `colleges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `colleges` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'المعهد العالى للعلوم الأدارية باوسيم ', '2024-09-27 04:32:39', '2024-09-27 04:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `eduction_methods`
--

CREATE TABLE `eduction_methods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `main_type` enum('map','week_report') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eduction_method_weeks`
--

CREATE TABLE `eduction_method_weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eduction_output_maps`
--

CREATE TABLE `eduction_output_maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `teaching_outputs_id` bigint(20) UNSIGNED NOT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) DEFAULT NULL,
  `main_type` enum('map','week_report') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `goal` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `innvoices`
--

CREATE TABLE `innvoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `main_type` enum('map','week_report') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `innvoice_weeks`
--

CREATE TABLE `innvoice_weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knowledge`
--

CREATE TABLE `knowledge` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matarials`
--

CREATE TABLE `matarials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `units` int(11) DEFAULT NULL,
  `nazary` int(11) DEFAULT NULL,
  `tamren` int(11) DEFAULT NULL,
  `amaly` int(11) DEFAULT NULL,
  `team` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matarials`
--

INSERT INTO `matarials` (`id`, `code`, `type`, `name`, `units`, `nazary`, `tamren`, `amaly`, `team`, `section`, `program_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 'مقرر جديد ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-27 04:32:39', '2024-09-27 04:32:39'),
(2, NULL, 0, 'مقرر جديد ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-27 04:32:39', '2024-09-27 04:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `matarial_descriptions`
--

CREATE TABLE `matarial_descriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `week_number` int(11) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `educaion_output` text DEFAULT NULL,
  `matarial_content` text DEFAULT NULL,
  `educaion_method` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `takwem_methods` varchar(255) DEFAULT NULL,
  `innvoice` varchar(255) DEFAULT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matarial_maps`
--

CREATE TABLE `matarial_maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `material_program_matches`
--

CREATE TABLE `material_program_matches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `education_output_id` bigint(20) UNSIGNED NOT NULL,
  `program_output_id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mayear_mokassies`
--

CREATE TABLE `mayear_mokassies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2024_07_13_212221_create_colleges_table', 1),
(11, '2024_07_14_150611_create_programs_table', 1),
(12, '2024_07_19_115031_create_knowledge_table', 1),
(13, '2024_07_19_145746_create_work_skills_table', 1),
(14, '2024_07_19_181931_create_public_skills_table', 1),
(15, '2024_07_19_185647_create_standards_table', 1),
(16, '2024_07_19_213822_create_references_table', 1),
(17, '2024_07_19_230035_create_structures_table', 1),
(18, '2024_07_19_233728_create_matarials_table', 1),
(19, '2024_07_20_121356_create_matarial_descriptions_table', 1),
(20, '2024_07_20_212221_create_admins_table', 1),
(21, '2024_07_21_205816_create_teaching_outputs_table', 1),
(22, '2024_07_22_170408_create_matarial_maps_table', 1),
(23, '2024_07_23_164308_create_mokrrer_contents_table', 1),
(24, '2024_07_23_222626_create_eduction_methods_table', 1),
(25, '2024_07_24_221726_create_taqweems_table', 1),
(26, '2024_07_25_075414_create_program_levels_table', 1),
(27, '2024_07_25_113830_create_innvoices_table', 1),
(28, '2024_07_26_090031_create_teaching_output_weeks_table', 1),
(29, '2024_07_26_090053_create_mokrrer_content_weeks_table', 1),
(30, '2024_07_26_090111_create_eduction_method_weeks_table', 1),
(31, '2024_07_26_090236_create_innvoice_weeks_table', 1),
(32, '2024_07_26_090251_create_taqweem_weeks_table', 1),
(33, '2024_07_28_222340_create_eduction_output_maps_table', 1),
(34, '2024_07_29_191812_create_permission_tables', 1),
(35, '2024_07_29_211327_create_media_table', 1),
(36, '2024_08_04_183836_create_students_table', 1),
(37, '2024_08_05_143412_create_questions_table', 1),
(38, '2024_08_06_181946_create_student_results_table', 1),
(39, '2024_08_15_230357_create_survey_questions_table', 1),
(40, '2024_08_23_130920_create_student_matarials_table', 1),
(41, '2024_08_26_205844_create_student_survey_answers_table', 1),
(42, '2024_08_27_215724_create_myears_table', 1),
(43, '2024_08_27_221037_create_mokashers_table', 1),
(44, '2024_08_27_223019_create_momarsas_table', 1),
(45, '2024_08_27_234316_create_momarsat_files_table', 1),
(46, '2024_08_4_223300_create_surveys_table', 1),
(47, '2024_08_6_174426_create_category_questions_table', 1),
(48, '2024_09_01_231050_create_rating_momarsas_table', 1),
(49, '2024_09_06_075829_create_rating_members_table', 1),
(50, '2024_09_07_193132_create_mayear_mokassies_table', 1),
(51, '2024_09_07_195442_create_mokasher_mokassies_table', 1),
(52, '2024_09_09_203113_create_momarsa_mokassyas_table', 1),
(53, '2024_09_10_140427_create_momarsat_mokassy_files_table', 1),
(54, '2024_09_11_140841_create_rating_mokassya_members_table', 1),
(55, '2024_09_12_233455_create_rating_momarsa_mokassies_table', 1),
(56, '2024_09_21_205728_create_material_program_matches_table', 1),
(57, '2024_09_24_195342_update_student_survey_answers_table', 1),
(58, '2024_09_24_195717_update_student_survey_answers_table', 1),
(59, '2024_09_30_092324_create_minds_table', 1),
(60, '2024_10_21_182413_create_week_reports_table', 1),
(61, '2024_9_22_230338_create_gools_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `minds`
--

CREATE TABLE `minds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mokashers`
--

CREATE TABLE `mokashers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `myear_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mokasher_mokassies`
--

CREATE TABLE `mokasher_mokassies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mayear_mokassy_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mokrrer_contents`
--

CREATE TABLE `mokrrer_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mokrrer_content_weeks`
--

CREATE TABLE `mokrrer_content_weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `momarsas`
--

CREATE TABLE `momarsas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mokasher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `momarsat_files`
--

CREATE TABLE `momarsat_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `momarsa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `momarsat_mokassy_files`
--

CREATE TABLE `momarsat_mokassy_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `momarsa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `momarsa_mokassyas`
--

CREATE TABLE `momarsa_mokassyas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mokasher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `myears`
--

CREATE TABLE `myears` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `secret` varchar(100) DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `redirect` text NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) NOT NULL,
  `access_token_id` varchar(100) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program` varchar(255) DEFAULT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `section` varchar(255) DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program`, `college_id`, `type`, `section`, `added_date`, `created_at`, `updated_at`) VALUES
(1, 'برنامج جديد', 1, 0, NULL, NULL, '2024-09-27 04:32:39', '2024-09-27 04:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `program_levels`
--

CREATE TABLE `program_levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `public_skills`
--

CREATE TABLE `public_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `teaching_outputs_id` bigint(20) UNSIGNED NOT NULL,
  `h_degree` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `name`, `added_by`, `teaching_outputs_id`, `h_degree`, `created_at`, `updated_at`) VALUES
(1, 'سؤال #1', 1, 1, 20.00, '2024-09-28 08:48:45', '2024-09-28 08:48:45'),
(2, 'سؤال #2', 1, 1, 30.00, '2024-09-28 08:48:55', '2024-09-28 08:48:55'),
(3, 'سؤال #4', 1, 1, 10.00, '2024-09-28 08:49:03', '2024-09-28 08:49:03'),
(4, 'سؤال #1', 1, 2, 10.00, '2024-09-28 11:54:19', '2024-09-28 11:54:19'),
(5, 'سؤال #2', 1, 2, 10.00, '2024-09-28 11:54:46', '2024-09-28 11:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `rating_members`
--

CREATE TABLE `rating_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` int(11) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_members`
--

INSERT INTO `rating_members` (`id`, `name`, `email`, `password`, `college_id`, `program_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Rating Member', 'rating@rating.com', '$2y$10$.9IgSopWjlb18etjhruJ3./eJOCeX4iiG8bCn2XcKwmcsAsQPzeCm', 1, NULL, 1, '2024-09-27 04:32:39', '2024-09-27 04:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `rating_mokassya_members`
--

CREATE TABLE `rating_mokassya_members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `mayear_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_momarsas`
--

CREATE TABLE `rating_momarsas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `momarsa_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_momarsa_mokassies`
--

CREATE TABLE `rating_momarsa_mokassies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rate` int(11) NOT NULL,
  `momarsa_id` bigint(20) UNSIGNED NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE `references` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `structures`
--

CREATE TABLE `structures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `class` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `matarial_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `class`, `email`, `password`, `matarial_id`, `created_at`, `updated_at`) VALUES
(1, 'محمد مصطفى ', 'الاولى ', 'm@gmail.com', '123', 1, '2024-09-11 11:49:34', '2024-09-28 11:49:34');

-- --------------------------------------------------------

--
-- Table structure for table `student_matarials`
--

CREATE TABLE `student_matarials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_results`
--

CREATE TABLE `student_results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `grade` double(8,2) DEFAULT NULL,
  `teaching_output_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_results`
--

INSERT INTO `student_results` (`id`, `question_id`, `student_id`, `grade`, `teaching_output_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 20.00, 1, '2024-09-28 08:50:21', '2024-09-28 08:50:21'),
(2, 2, 1, 30.00, 1, '2024-09-28 08:50:23', '2024-09-28 08:50:23'),
(3, 3, 1, 10.00, 1, '2024-09-28 08:50:25', '2024-09-28 08:50:25'),
(4, 4, 1, 10.00, 2, '2024-09-28 11:54:26', '2024-09-28 11:54:26'),
(5, 5, 1, 0.00, 2, '2024-09-28 11:54:53', '2024-09-28 11:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `student_survey_answers`
--

CREATE TABLE `student_survey_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `answer` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taqweems`
--

CREATE TABLE `taqweems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 0,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `main_type` enum('map','week_report') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taqweem_weeks`
--

CREATE TABLE `taqweem_weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teaching_outputs`
--

CREATE TABLE `teaching_outputs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) DEFAULT NULL,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teaching_outputs`
--

INSERT INTO `teaching_outputs` (`id`, `type`, `week_number`, `name`, `added_by`, `matarial_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'معلومات ومفاهيم', 1, 1, '2024-09-28 08:42:00', '2024-09-28 08:42:00'),
(2, 1, NULL, 'معلومات ومفاهيم #2', 1, 1, '2024-09-28 08:42:08', '2024-09-28 08:42:08'),
(3, 2, NULL, 'مهاره ذهنية', 1, 1, '2024-09-28 08:45:16', '2024-09-28 08:45:16'),
(4, 2, NULL, 'ناتج تعلم  #2', 1, 1, '2024-09-28 08:45:36', '2024-09-28 08:45:36'),
(5, 3, NULL, 'مهاره مهنيه', 1, 1, '2024-09-28 08:45:44', '2024-09-28 08:45:44'),
(6, 3, NULL, 'مهاره مهنيه #2', 1, 1, '2024-09-28 08:45:52', '2024-09-28 08:45:52'),
(7, 4, NULL, 'مهاره  عامه #1', 1, 1, '2024-09-28 08:46:01', '2024-09-28 08:46:01'),
(8, 4, NULL, 'مهاره عامه #2', 1, 1, '2024-09-28 08:46:08', '2024-09-28 08:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `teaching_output_weeks`
--

CREATE TABLE `teaching_output_weeks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `job_number` varchar(255) DEFAULT NULL,
  `geha` text DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `job_number`, `geha`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '123', 'كليه الطب  جامعه ينها', '$2y$10$uTfDhB7gxUJ2bvw1T1b4wO03DSl92cDptKQBo35RLGf7qUutJ.N4i', 'xzUyv1uSbM', '2024-09-27 04:32:39', '2024-09-27 04:32:39');

-- --------------------------------------------------------

--
-- Table structure for table `week_reports`
--

CREATE TABLE `week_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `teaching_output_id` bigint(20) UNSIGNED NOT NULL,
  `matarial_id` bigint(20) UNSIGNED NOT NULL,
  `execution` tinyint(4) NOT NULL DEFAULT 0,
  `innvoice` varchar(255) DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_skills`
--

CREATE TABLE `work_skills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD KEY `admins_college_id_foreign` (`college_id`);

--
-- Indexes for table `category_questions`
--
ALTER TABLE `category_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_questions_survey_id_foreign` (`survey_id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eduction_methods`
--
ALTER TABLE `eduction_methods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eduction_methods_added_by_foreign` (`added_by`),
  ADD KEY `eduction_methods_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `eduction_method_weeks`
--
ALTER TABLE `eduction_method_weeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eduction_method_weeks_added_by_foreign` (`added_by`),
  ADD KEY `eduction_method_weeks_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `eduction_output_maps`
--
ALTER TABLE `eduction_output_maps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eduction_output_maps_teaching_outputs_id_foreign` (`teaching_outputs_id`),
  ADD KEY `eduction_output_maps_added_by_foreign` (`added_by`),
  ADD KEY `eduction_output_maps_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `goals_program_id_foreign` (`program_id`);

--
-- Indexes for table `innvoices`
--
ALTER TABLE `innvoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `innvoices_added_by_foreign` (`added_by`),
  ADD KEY `innvoices_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `innvoice_weeks`
--
ALTER TABLE `innvoice_weeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `innvoice_weeks_added_by_foreign` (`added_by`),
  ADD KEY `innvoice_weeks_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `knowledge`
--
ALTER TABLE `knowledge`
  ADD PRIMARY KEY (`id`),
  ADD KEY `knowledge_program_id_foreign` (`program_id`);

--
-- Indexes for table `matarials`
--
ALTER TABLE `matarials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matarials_program_id_foreign` (`program_id`);

--
-- Indexes for table `matarial_descriptions`
--
ALTER TABLE `matarial_descriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matarial_descriptions_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `matarial_maps`
--
ALTER TABLE `matarial_maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_program_matches`
--
ALTER TABLE `material_program_matches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mayear_mokassies`
--
ALTER TABLE `mayear_mokassies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mayear_mokassies_college_id_foreign` (`college_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  ADD KEY `media_order_column_index` (`order_column`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minds`
--
ALTER TABLE `minds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `minds_program_id_foreign` (`program_id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `mokashers`
--
ALTER TABLE `mokashers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokashers_myear_id_foreign` (`myear_id`);

--
-- Indexes for table `mokasher_mokassies`
--
ALTER TABLE `mokasher_mokassies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokasher_mokassies_mayear_mokassy_id_foreign` (`mayear_mokassy_id`);

--
-- Indexes for table `mokrrer_contents`
--
ALTER TABLE `mokrrer_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokrrer_contents_added_by_foreign` (`added_by`),
  ADD KEY `mokrrer_contents_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `mokrrer_content_weeks`
--
ALTER TABLE `mokrrer_content_weeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mokrrer_content_weeks_added_by_foreign` (`added_by`),
  ADD KEY `mokrrer_content_weeks_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `momarsas`
--
ALTER TABLE `momarsas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `momarsas_mokasher_id_foreign` (`mokasher_id`);

--
-- Indexes for table `momarsat_files`
--
ALTER TABLE `momarsat_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `momarsat_files_momarsa_id_foreign` (`momarsa_id`);

--
-- Indexes for table `momarsat_mokassy_files`
--
ALTER TABLE `momarsat_mokassy_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `momarsat_mokassy_files_momarsa_id_foreign` (`momarsa_id`);

--
-- Indexes for table `momarsa_mokassyas`
--
ALTER TABLE `momarsa_mokassyas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `momarsa_mokassyas_mokasher_id_foreign` (`mokasher_id`);

--
-- Indexes for table `myears`
--
ALTER TABLE `myears`
  ADD PRIMARY KEY (`id`),
  ADD KEY `myears_program_id_foreign` (`program_id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programs_college_id_foreign` (`college_id`);

--
-- Indexes for table `program_levels`
--
ALTER TABLE `program_levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `program_levels_program_id_foreign` (`program_id`);

--
-- Indexes for table `public_skills`
--
ALTER TABLE `public_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `public_skills_program_id_foreign` (`program_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_added_by_foreign` (`added_by`),
  ADD KEY `questions_teaching_outputs_id_foreign` (`teaching_outputs_id`);

--
-- Indexes for table `rating_members`
--
ALTER TABLE `rating_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rating_members_email_unique` (`email`),
  ADD KEY `rating_members_college_id_foreign` (`college_id`);

--
-- Indexes for table `rating_mokassya_members`
--
ALTER TABLE `rating_mokassya_members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rating_mokassya_members_email_unique` (`email`),
  ADD KEY `rating_mokassya_members_college_id_foreign` (`college_id`);

--
-- Indexes for table `rating_momarsas`
--
ALTER TABLE `rating_momarsas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_momarsas_momarsa_id_foreign` (`momarsa_id`);

--
-- Indexes for table `rating_momarsa_mokassies`
--
ALTER TABLE `rating_momarsa_mokassies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rating_momarsa_mokassies_momarsa_id_foreign` (`momarsa_id`);

--
-- Indexes for table `references`
--
ALTER TABLE `references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `references_program_id_foreign` (`program_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `standards_program_id_foreign` (`program_id`);

--
-- Indexes for table `structures`
--
ALTER TABLE `structures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `structures_program_id_foreign` (`program_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_matarials`
--
ALTER TABLE `student_matarials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_matarials_student_id_foreign` (`student_id`),
  ADD KEY `student_matarials_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `student_results`
--
ALTER TABLE `student_results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_results_question_id_foreign` (`question_id`),
  ADD KEY `student_results_student_id_foreign` (`student_id`),
  ADD KEY `student_results_teaching_output_id_foreign` (`teaching_output_id`);

--
-- Indexes for table `student_survey_answers`
--
ALTER TABLE `student_survey_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_survey_answers_question_id_foreign` (`question_id`),
  ADD KEY `student_survey_answers_student_id_foreign` (`student_id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surveys_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taqweems`
--
ALTER TABLE `taqweems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taqweems_added_by_foreign` (`added_by`),
  ADD KEY `taqweems_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `taqweem_weeks`
--
ALTER TABLE `taqweem_weeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `taqweem_weeks_added_by_foreign` (`added_by`),
  ADD KEY `taqweem_weeks_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `teaching_outputs`
--
ALTER TABLE `teaching_outputs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teaching_outputs_added_by_foreign` (`added_by`),
  ADD KEY `teaching_outputs_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `teaching_output_weeks`
--
ALTER TABLE `teaching_output_weeks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teaching_output_weeks_added_by_foreign` (`added_by`),
  ADD KEY `teaching_output_weeks_matarial_id_foreign` (`matarial_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `week_reports`
--
ALTER TABLE `week_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `week_reports_teaching_output_id_foreign` (`teaching_output_id`),
  ADD KEY `week_reports_matarial_id_foreign` (`matarial_id`),
  ADD KEY `week_reports_added_by_foreign` (`added_by`);

--
-- Indexes for table `work_skills`
--
ALTER TABLE `work_skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_skills_program_id_foreign` (`program_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_questions`
--
ALTER TABLE `category_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `colleges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `eduction_methods`
--
ALTER TABLE `eduction_methods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eduction_method_weeks`
--
ALTER TABLE `eduction_method_weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eduction_output_maps`
--
ALTER TABLE `eduction_output_maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `innvoices`
--
ALTER TABLE `innvoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `innvoice_weeks`
--
ALTER TABLE `innvoice_weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matarials`
--
ALTER TABLE `matarials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `matarial_descriptions`
--
ALTER TABLE `matarial_descriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matarial_maps`
--
ALTER TABLE `matarial_maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_program_matches`
--
ALTER TABLE `material_program_matches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mayear_mokassies`
--
ALTER TABLE `mayear_mokassies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `minds`
--
ALTER TABLE `minds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mokashers`
--
ALTER TABLE `mokashers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mokasher_mokassies`
--
ALTER TABLE `mokasher_mokassies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mokrrer_contents`
--
ALTER TABLE `mokrrer_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mokrrer_content_weeks`
--
ALTER TABLE `mokrrer_content_weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `momarsas`
--
ALTER TABLE `momarsas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `momarsat_files`
--
ALTER TABLE `momarsat_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `momarsat_mokassy_files`
--
ALTER TABLE `momarsat_mokassy_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `momarsa_mokassyas`
--
ALTER TABLE `momarsa_mokassyas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `myears`
--
ALTER TABLE `myears`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `program_levels`
--
ALTER TABLE `program_levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `public_skills`
--
ALTER TABLE `public_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rating_members`
--
ALTER TABLE `rating_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rating_mokassya_members`
--
ALTER TABLE `rating_mokassya_members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_momarsas`
--
ALTER TABLE `rating_momarsas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_momarsa_mokassies`
--
ALTER TABLE `rating_momarsa_mokassies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_matarials`
--
ALTER TABLE `student_matarials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_results`
--
ALTER TABLE `student_results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student_survey_answers`
--
ALTER TABLE `student_survey_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taqweems`
--
ALTER TABLE `taqweems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taqweem_weeks`
--
ALTER TABLE `taqweem_weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teaching_outputs`
--
ALTER TABLE `teaching_outputs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teaching_output_weeks`
--
ALTER TABLE `teaching_output_weeks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `week_reports`
--
ALTER TABLE `week_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_skills`
--
ALTER TABLE `work_skills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category_questions`
--
ALTER TABLE `category_questions`
  ADD CONSTRAINT `category_questions_survey_id_foreign` FOREIGN KEY (`survey_id`) REFERENCES `surveys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eduction_methods`
--
ALTER TABLE `eduction_methods`
  ADD CONSTRAINT `eduction_methods_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eduction_methods_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eduction_method_weeks`
--
ALTER TABLE `eduction_method_weeks`
  ADD CONSTRAINT `eduction_method_weeks_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eduction_method_weeks_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `eduction_output_maps`
--
ALTER TABLE `eduction_output_maps`
  ADD CONSTRAINT `eduction_output_maps_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eduction_output_maps_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `eduction_output_maps_teaching_outputs_id_foreign` FOREIGN KEY (`teaching_outputs_id`) REFERENCES `teaching_outputs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `innvoices`
--
ALTER TABLE `innvoices`
  ADD CONSTRAINT `innvoices_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `innvoices_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `innvoice_weeks`
--
ALTER TABLE `innvoice_weeks`
  ADD CONSTRAINT `innvoice_weeks_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `innvoice_weeks_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `knowledge`
--
ALTER TABLE `knowledge`
  ADD CONSTRAINT `knowledge_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matarials`
--
ALTER TABLE `matarials`
  ADD CONSTRAINT `matarials_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `matarial_descriptions`
--
ALTER TABLE `matarial_descriptions`
  ADD CONSTRAINT `matarial_descriptions_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mayear_mokassies`
--
ALTER TABLE `mayear_mokassies`
  ADD CONSTRAINT `mayear_mokassies_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `minds`
--
ALTER TABLE `minds`
  ADD CONSTRAINT `minds_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mokashers`
--
ALTER TABLE `mokashers`
  ADD CONSTRAINT `mokashers_myear_id_foreign` FOREIGN KEY (`myear_id`) REFERENCES `myears` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mokasher_mokassies`
--
ALTER TABLE `mokasher_mokassies`
  ADD CONSTRAINT `mokasher_mokassies_mayear_mokassy_id_foreign` FOREIGN KEY (`mayear_mokassy_id`) REFERENCES `mayear_mokassies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mokrrer_contents`
--
ALTER TABLE `mokrrer_contents`
  ADD CONSTRAINT `mokrrer_contents_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mokrrer_contents_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mokrrer_content_weeks`
--
ALTER TABLE `mokrrer_content_weeks`
  ADD CONSTRAINT `mokrrer_content_weeks_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mokrrer_content_weeks_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `momarsas`
--
ALTER TABLE `momarsas`
  ADD CONSTRAINT `momarsas_mokasher_id_foreign` FOREIGN KEY (`mokasher_id`) REFERENCES `mokashers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `momarsat_files`
--
ALTER TABLE `momarsat_files`
  ADD CONSTRAINT `momarsat_files_momarsa_id_foreign` FOREIGN KEY (`momarsa_id`) REFERENCES `momarsas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `momarsat_mokassy_files`
--
ALTER TABLE `momarsat_mokassy_files`
  ADD CONSTRAINT `momarsat_mokassy_files_momarsa_id_foreign` FOREIGN KEY (`momarsa_id`) REFERENCES `mokasher_mokassies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `momarsa_mokassyas`
--
ALTER TABLE `momarsa_mokassyas`
  ADD CONSTRAINT `momarsa_mokassyas_mokasher_id_foreign` FOREIGN KEY (`mokasher_id`) REFERENCES `mokasher_mokassies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `myears`
--
ALTER TABLE `myears`
  ADD CONSTRAINT `myears_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `programs`
--
ALTER TABLE `programs`
  ADD CONSTRAINT `programs_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `program_levels`
--
ALTER TABLE `program_levels`
  ADD CONSTRAINT `program_levels_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `public_skills`
--
ALTER TABLE `public_skills`
  ADD CONSTRAINT `public_skills_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_teaching_outputs_id_foreign` FOREIGN KEY (`teaching_outputs_id`) REFERENCES `teaching_outputs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_members`
--
ALTER TABLE `rating_members`
  ADD CONSTRAINT `rating_members_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_mokassya_members`
--
ALTER TABLE `rating_mokassya_members`
  ADD CONSTRAINT `rating_mokassya_members_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_momarsas`
--
ALTER TABLE `rating_momarsas`
  ADD CONSTRAINT `rating_momarsas_momarsa_id_foreign` FOREIGN KEY (`momarsa_id`) REFERENCES `momarsas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_momarsa_mokassies`
--
ALTER TABLE `rating_momarsa_mokassies`
  ADD CONSTRAINT `rating_momarsa_mokassies_momarsa_id_foreign` FOREIGN KEY (`momarsa_id`) REFERENCES `momarsa_mokassyas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `references`
--
ALTER TABLE `references`
  ADD CONSTRAINT `references_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `standards`
--
ALTER TABLE `standards`
  ADD CONSTRAINT `standards_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `structures`
--
ALTER TABLE `structures`
  ADD CONSTRAINT `structures_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_matarials`
--
ALTER TABLE `student_matarials`
  ADD CONSTRAINT `student_matarials_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_matarials_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_results`
--
ALTER TABLE `student_results`
  ADD CONSTRAINT `student_results_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_results_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_results_teaching_output_id_foreign` FOREIGN KEY (`teaching_output_id`) REFERENCES `teaching_outputs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_survey_answers`
--
ALTER TABLE `student_survey_answers`
  ADD CONSTRAINT `student_survey_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `survey_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_survey_answers_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `surveys`
--
ALTER TABLE `surveys`
  ADD CONSTRAINT `surveys_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taqweems`
--
ALTER TABLE `taqweems`
  ADD CONSTRAINT `taqweems_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taqweems_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `taqweem_weeks`
--
ALTER TABLE `taqweem_weeks`
  ADD CONSTRAINT `taqweem_weeks_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `taqweem_weeks_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teaching_outputs`
--
ALTER TABLE `teaching_outputs`
  ADD CONSTRAINT `teaching_outputs_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teaching_outputs_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teaching_output_weeks`
--
ALTER TABLE `teaching_output_weeks`
  ADD CONSTRAINT `teaching_output_weeks_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teaching_output_weeks_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `week_reports`
--
ALTER TABLE `week_reports`
  ADD CONSTRAINT `week_reports_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `week_reports_matarial_id_foreign` FOREIGN KEY (`matarial_id`) REFERENCES `matarials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `week_reports_teaching_output_id_foreign` FOREIGN KEY (`teaching_output_id`) REFERENCES `teaching_outputs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `work_skills`
--
ALTER TABLE `work_skills`
  ADD CONSTRAINT `work_skills_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

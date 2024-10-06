-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 22, 2024 at 11:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.18

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
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_id` bigint UNSIGNED NOT NULL,
  `super_admin` tinyint NOT NULL DEFAULT '0',
  `program_id` int DEFAULT NULL,
  `type` int NOT NULL DEFAULT '0',
  `mayear_id` int DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `college_id`, `super_admin`, `program_id`, `type`, `mayear_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$WZfWWx5uXZS6aUIPk3/PEOZapNKt9P4HevHonlo5aPbpnpLmFEXiG', 1, 1, NULL, 0, NULL, NULL, '2024-09-22 16:09:24', '2024-09-22 16:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `category_questions`
--

CREATE TABLE `category_questions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `survey_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_questions`
--

INSERT INTO `category_questions` (`id`, `name`, `survey_id`, `created_at`, `updated_at`) VALUES
(1, 'محور  #1', 1, '2024-09-22 19:15:26', '2024-09-22 19:15:26'),
(2, 'محور #2', 1, '2024-09-22 19:15:30', '2024-09-22 19:15:30'),
(3, 'محور #3', 1, '2024-09-22 19:15:35', '2024-09-22 19:15:35'),
(4, 'محور أسئله #1', 2, '2024-09-22 19:49:57', '2024-09-22 19:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `colleges` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `colleges` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'المعهد العالى للعلوم الأدارية باوسيم ', '2024-09-22 16:09:24', '2024-09-22 16:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `eduction_methods`
--

CREATE TABLE `eduction_methods` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `main_type` enum('map','week_report') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eduction_method_weeks`
--

CREATE TABLE `eduction_method_weeks` (
  `id` bigint UNSIGNED NOT NULL,
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `eduction_output_maps`
--

CREATE TABLE `eduction_output_maps` (
  `id` bigint UNSIGNED NOT NULL,
  `week_number` int DEFAULT NULL,
  `teaching_outputs_id` bigint UNSIGNED NOT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `type` int DEFAULT NULL,
  `main_type` enum('map','week_report') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` bigint UNSIGNED NOT NULL,
  `goal` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `innvoices`
--

CREATE TABLE `innvoices` (
  `id` bigint UNSIGNED NOT NULL,
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `main_type` enum('map','week_report') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `innvoice_weeks`
--

CREATE TABLE `innvoice_weeks` (
  `id` bigint UNSIGNED NOT NULL,
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `knowledge`
--

CREATE TABLE `knowledge` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `knowledge`
--

INSERT INTO `knowledge` (`id`, `name`, `program_id`, `created_at`, `updated_at`) VALUES
(1, 'معرفه وفهم #1', 1, '2024-09-22 16:14:23', '2024-09-22 16:14:23'),
(2, 'معرفه وفهم 2', 1, '2024-09-22 16:14:29', '2024-09-22 16:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `matarials`
--

CREATE TABLE `matarials` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `units` int DEFAULT NULL,
  `nazary` int DEFAULT NULL,
  `tamren` int DEFAULT NULL,
  `amaly` int DEFAULT NULL,
  `team` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matarials`
--

INSERT INTO `matarials` (`id`, `code`, `type`, `name`, `units`, `nazary`, `tamren`, `amaly`, `team`, `section`, `program_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 'مقرر جديد ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(2, NULL, 0, 'مقرر جديد ', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `matarial_descriptions`
--

CREATE TABLE `matarial_descriptions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `week_number` int DEFAULT NULL,
  `type` tinyint NOT NULL DEFAULT '0',
  `educaion_output` text COLLATE utf8mb4_unicode_ci,
  `matarial_content` text COLLATE utf8mb4_unicode_ci,
  `educaion_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `takwem_methods` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `innvoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matarial_maps`
--

CREATE TABLE `matarial_maps` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `material_program_matches`
--

CREATE TABLE `material_program_matches` (
  `id` bigint UNSIGNED NOT NULL,
  `material_id` bigint UNSIGNED NOT NULL,
  `education_output_id` bigint UNSIGNED NOT NULL,
  `program_output_id` bigint UNSIGNED NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `material_program_matches`
--

INSERT INTO `material_program_matches` (`id`, `material_id`, `education_output_id`, `program_output_id`, `category`, `created_at`, `updated_at`) VALUES
(118, 2, 11, 2, 'public_skills', '2024-09-22 18:49:50', '2024-09-22 18:49:50'),
(122, 1, 1, 1, 'public_skills', '2024-09-22 18:49:58', '2024-09-22 18:49:58'),
(123, 1, 2, 1, 'public_skills', '2024-09-22 18:49:58', '2024-09-22 18:49:58'),
(128, 1, 1, 1, 'knowledge', '2024-09-22 18:50:54', '2024-09-22 18:50:54'),
(129, 1, 2, 1, 'knowledge', '2024-09-22 18:50:54', '2024-09-22 18:50:54'),
(130, 1, 3, 1, 'knowledge', '2024-09-22 18:51:03', '2024-09-22 18:51:03'),
(131, 1, 4, 1, 'knowledge', '2024-09-22 18:51:03', '2024-09-22 18:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `mayear_mokassies`
--

CREATE TABLE `mayear_mokassies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(57, '2024_09_30_092324_create_minds_table', 1),
(58, '2024_10_21_182413_create_week_reports_table', 1),
(59, '2024_9_22_230338_create_gools_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `minds`
--

CREATE TABLE `minds` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mokashers`
--

CREATE TABLE `mokashers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `myear_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mokasher_mokassies`
--

CREATE TABLE `mokasher_mokassies` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mayear_mokassy_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mokrrer_contents`
--

CREATE TABLE `mokrrer_contents` (
  `id` bigint UNSIGNED NOT NULL,
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mokrrer_content_weeks`
--

CREATE TABLE `mokrrer_content_weeks` (
  `id` bigint UNSIGNED NOT NULL,
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `momarsas`
--

CREATE TABLE `momarsas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mokasher_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `momarsat_files`
--

CREATE TABLE `momarsat_files` (
  `id` bigint UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `momarsa_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `momarsat_mokassy_files`
--

CREATE TABLE `momarsat_mokassy_files` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `momarsa_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `momarsa_mokassyas`
--

CREATE TABLE `momarsa_mokassyas` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mokasher_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `myears`
--

CREATE TABLE `myears` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
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
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint UNSIGNED NOT NULL,
  `client_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `id` bigint UNSIGNED NOT NULL,
  `program` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_id` bigint UNSIGNED NOT NULL,
  `type` tinyint NOT NULL DEFAULT '0',
  `section` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `program`, `college_id`, `type`, `section`, `added_date`, `created_at`, `updated_at`) VALUES
(1, 'برنامج جديد', 1, 0, NULL, NULL, '2024-09-22 16:09:24', '2024-09-22 16:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `program_levels`
--

CREATE TABLE `program_levels` (
  `id` bigint UNSIGNED NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `public_skills`
--

CREATE TABLE `public_skills` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `public_skills`
--

INSERT INTO `public_skills` (`id`, `name`, `program_id`, `created_at`, `updated_at`) VALUES
(1, 'مهارات عامه', 1, '2024-09-22 16:14:56', '2024-09-22 16:14:56'),
(2, 'مهارات عامه #2', 1, '2024-09-22 16:15:03', '2024-09-22 16:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `teaching_outputs_id` bigint UNSIGNED NOT NULL,
  `h_degree` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_members`
--

CREATE TABLE `rating_members` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_id` bigint UNSIGNED NOT NULL,
  `program_id` int DEFAULT NULL,
  `type` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating_members`
--

INSERT INTO `rating_members` (`id`, `name`, `email`, `password`, `college_id`, `program_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Rating Member', 'rating@rating.com', '$2y$10$cHFQEbynftp2Xe4otq6cwOGDBkugyq2w6KE7U9KQM1wu1oFDRYAxG', 1, NULL, 1, '2024-09-22 16:09:25', '2024-09-22 16:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `rating_mokassya_members`
--

CREATE TABLE `rating_mokassya_members` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college_id` bigint UNSIGNED NOT NULL,
  `mayear_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_momarsas`
--

CREATE TABLE `rating_momarsas` (
  `id` bigint UNSIGNED NOT NULL,
  `rate` int NOT NULL,
  `momarsa_id` bigint UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating_momarsa_mokassies`
--

CREATE TABLE `rating_momarsa_mokassies` (
  `id` bigint UNSIGNED NOT NULL,
  `rate` int NOT NULL,
  `momarsa_id` bigint UNSIGNED NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `references`
--

CREATE TABLE `references` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `structures`
--

CREATE TABLE `structures` (
  `id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `college_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `user_password`, `college_id`, `created_at`, `updated_at`) VALUES
(1, 'مصباح السعيد', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(2, 'لجين الجريد', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(3, 'أفنان عبادة الأسمري', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(4, 'زينات جواهرجي', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(5, 'داوود الفدا', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(6, 'الدكتورة ىمنة باشا', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(7, 'غدير سليم العقل', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(8, 'مهران الفيفي', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(9, 'سميح الشيباني', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(10, 'مؤثر زكريا السليم', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(11, 'عبد اللطيف كفاح عبد الهادي السليم', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(12, 'رسلان عبد الحافظ الماجد', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(13, 'سلام جواهرجي', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(14, 'رجب الشهيل', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24'),
(15, 'زهرة السويلم', NULL, NULL, NULL, 1, '2024-09-22 16:09:24', '2024-09-22 16:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `student_matarials`
--

CREATE TABLE `student_matarials` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_results`
--

CREATE TABLE `student_results` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `grade` double(8,2) DEFAULT NULL,
  `teaching_output_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_survey_answers`
--

CREATE TABLE `student_survey_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `question_id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `answer_1` tinyint NOT NULL DEFAULT '0',
  `answer_2` tinyint NOT NULL DEFAULT '0',
  `answer_3` tinyint NOT NULL DEFAULT '0',
  `answer_4` tinyint NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '0',
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surveys`
--

INSERT INTO `surveys` (`id`, `name`, `status`, `matarial_id`, `created_at`, `updated_at`) VALUES
(1, 'أستبيان  خاص  بمقرر الاقتصاد', 1, 1, '2024-09-22 19:15:10', '2024-09-22 19:15:10'),
(2, 'أستبيان #1', 1, 2, '2024-09-22 19:49:31', '2024-09-22 19:49:31');

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `name`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'سؤال #22222', 1, '2024-09-22 19:17:28', '2024-09-22 19:17:28'),
(2, 'سؤال #1', 4, '2024-09-22 19:50:19', '2024-09-22 19:50:19'),
(3, 'أستبيان #2', 2, '2024-09-22 19:50:58', '2024-09-22 19:50:58'),
(4, 'سؤال #1', 3, '2024-09-22 19:51:04', '2024-09-22 19:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `taqweems`
--

CREATE TABLE `taqweems` (
  `id` bigint UNSIGNED NOT NULL,
  `active` tinyint NOT NULL DEFAULT '0',
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `main_type` enum('map','week_report') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taqweem_weeks`
--

CREATE TABLE `taqweem_weeks` (
  `id` bigint UNSIGNED NOT NULL,
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teaching_outputs`
--

CREATE TABLE `teaching_outputs` (
  `id` bigint UNSIGNED NOT NULL,
  `type` int DEFAULT NULL,
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teaching_outputs`
--

INSERT INTO `teaching_outputs` (`id`, `type`, `week_number`, `name`, `added_by`, `matarial_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'معلومات  ومفاهيم #1', 1, 1, '2024-09-22 16:12:55', '2024-09-22 16:13:00'),
(2, 1, NULL, 'معلومات ومفاهيم #2', 1, 1, '2024-09-22 16:13:09', '2024-09-22 16:13:09'),
(3, 2, NULL, 'مهارات ذهنية #1', 1, 1, '2024-09-22 16:13:18', '2024-09-22 16:13:18'),
(4, 2, NULL, 'مهارات ذهنية #2', 1, 1, '2024-09-22 16:13:27', '2024-09-22 16:13:27'),
(5, 3, NULL, 'مهارات مهنية #1', 1, 1, '2024-09-22 16:13:35', '2024-09-22 16:13:35'),
(6, 3, NULL, 'مهارات مهنيه #2', 1, 1, '2024-09-22 16:13:43', '2024-09-22 16:13:43'),
(7, 4, NULL, 'مهارات عامه #', 1, 1, '2024-09-22 16:13:53', '2024-09-22 16:13:53'),
(8, 4, NULL, 'مهارات عامه #2', 1, 1, '2024-09-22 16:14:03', '2024-09-22 16:14:03'),
(9, 1, NULL, 'معلومات #22222', 1, 2, '2024-09-22 18:17:40', '2024-09-22 18:17:40'),
(10, 2, NULL, 'مهاررات #22', 1, 2, '2024-09-22 18:17:49', '2024-09-22 18:17:49'),
(11, 3, NULL, 'مهارات مهنيه #22', 1, 2, '2024-09-22 18:17:57', '2024-09-22 18:17:57'),
(12, 4, NULL, 'مهراه عامه #222', 1, 2, '2024-09-22 18:18:05', '2024-09-22 18:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `teaching_output_weeks`
--

CREATE TABLE `teaching_output_weeks` (
  `id` bigint UNSIGNED NOT NULL,
  `week_number` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `job_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `geha` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `job_number`, `geha`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '123', 'كليه الطب  جامعه ينها', '$2y$10$.2aRINVleHrLkw4cFkqUZeSZieSY9GqQm9Wv5CkeV4AAtAkTBalnG', 'NNJUwlffUN', '2024-09-22 16:09:24', '2024-09-22 16:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `week_reports`
--

CREATE TABLE `week_reports` (
  `id` bigint UNSIGNED NOT NULL,
  `teaching_output_id` bigint UNSIGNED NOT NULL,
  `matarial_id` bigint UNSIGNED NOT NULL,
  `execution` tinyint NOT NULL DEFAULT '0',
  `innvoice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `added_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `work_skills`
--

CREATE TABLE `work_skills` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_skills`
--

INSERT INTO `work_skills` (`id`, `name`, `program_id`, `created_at`, `updated_at`) VALUES
(1, 'مهارات مهنيه #1', 1, '2024-09-22 16:14:38', '2024-09-22 16:14:38'),
(2, 'مهارات علميه #', 1, '2024-09-22 16:14:46', '2024-09-22 16:14:46');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_college_id_foreign` (`college_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_questions`
--
ALTER TABLE `category_questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `colleges`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `eduction_methods`
--
ALTER TABLE `eduction_methods`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eduction_method_weeks`
--
ALTER TABLE `eduction_method_weeks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eduction_output_maps`
--
ALTER TABLE `eduction_output_maps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `innvoices`
--
ALTER TABLE `innvoices`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `innvoice_weeks`
--
ALTER TABLE `innvoice_weeks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `knowledge`
--
ALTER TABLE `knowledge`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `matarials`
--
ALTER TABLE `matarials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `matarial_descriptions`
--
ALTER TABLE `matarial_descriptions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matarial_maps`
--
ALTER TABLE `matarial_maps`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `material_program_matches`
--
ALTER TABLE `material_program_matches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `mayear_mokassies`
--
ALTER TABLE `mayear_mokassies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `minds`
--
ALTER TABLE `minds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mokashers`
--
ALTER TABLE `mokashers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mokasher_mokassies`
--
ALTER TABLE `mokasher_mokassies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mokrrer_contents`
--
ALTER TABLE `mokrrer_contents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mokrrer_content_weeks`
--
ALTER TABLE `mokrrer_content_weeks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `momarsas`
--
ALTER TABLE `momarsas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `momarsat_files`
--
ALTER TABLE `momarsat_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `momarsat_mokassy_files`
--
ALTER TABLE `momarsat_mokassy_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `momarsa_mokassyas`
--
ALTER TABLE `momarsa_mokassyas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `myears`
--
ALTER TABLE `myears`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `program_levels`
--
ALTER TABLE `program_levels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `public_skills`
--
ALTER TABLE `public_skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_members`
--
ALTER TABLE `rating_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rating_mokassya_members`
--
ALTER TABLE `rating_mokassya_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_momarsas`
--
ALTER TABLE `rating_momarsas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating_momarsa_mokassies`
--
ALTER TABLE `rating_momarsa_mokassies`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `references`
--
ALTER TABLE `references`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `structures`
--
ALTER TABLE `structures`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student_matarials`
--
ALTER TABLE `student_matarials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_results`
--
ALTER TABLE `student_results`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_survey_answers`
--
ALTER TABLE `student_survey_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taqweems`
--
ALTER TABLE `taqweems`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taqweem_weeks`
--
ALTER TABLE `taqweem_weeks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teaching_outputs`
--
ALTER TABLE `teaching_outputs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `teaching_output_weeks`
--
ALTER TABLE `teaching_output_weeks`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `week_reports`
--
ALTER TABLE `week_reports`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `work_skills`
--
ALTER TABLE `work_skills`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `student_survey_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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

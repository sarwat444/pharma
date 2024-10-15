-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2024 at 10:47 PM
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
-- Database: `taysser_pharmacy`
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
-- Table structure for table `cosmatics`
--

CREATE TABLE `cosmatics` (
  `id` int(11) NOT NULL,
  `name` varchar(225) DEFAULT NULL,
  `price` int(225) DEFAULT NULL,
  `quinity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cosmatics`
--

INSERT INTO `cosmatics` (`id`, `name`, `price`, `quinity`, `created_at`, `updated_at`) VALUES
(1, 'فاتيكا زيت شعر كبير', 35, 29, NULL, NULL),
(2, 'فاتيكا زيت شعر  وسط', 22, 16, NULL, NULL),
(3, 'فاتيكا زيت شعر صغير', 12, 5, NULL, NULL),
(4, 'جل كعب غزال', 30, 5, NULL, NULL),
(5, 'نيفيا سوفت كبير', 50, 5, NULL, NULL),
(6, 'نيفيا للبشره كبير', 50, 1, NULL, NULL),
(7, 'نيفيا للبشره وسط', 35, 4, NULL, NULL),
(8, 'مناديل مبلله كبيره', 35, 3, NULL, NULL),
(9, 'مناديل مبلله وسط', 25, 1, NULL, NULL),
(10, 'جونسون مناديل مبلله ', 75, 1, NULL, NULL),
(11, 'افوفا بادي سبلاش', 45, 3, NULL, NULL),
(12, 'ايفا كريم صغير', 12, 14, NULL, NULL),
(13, 'فازلين صغير', 15, 13, NULL, NULL),
(14, 'فازلين بيور وسط ', 20, 1, NULL, NULL),
(15, 'فازلين بيور كبير ', 30, 3, NULL, NULL),
(16, 'هير كريم كبير', 25, 5, NULL, NULL),
(17, 'هير كريم صغير', 20, 2, NULL, NULL),
(18, 'فيبيكس مزيل عرق ROII', 40, 2, NULL, NULL),
(19, 'شامبو جونسون كبر', 70, 1, NULL, NULL),
(20, 'شامبو جونسون صغير ', 45, 3, NULL, NULL),
(21, 'زيت جونسون كبير', 105, 2, NULL, NULL),
(22, 'زيت جونسون صغير ', 55, 1, NULL, NULL),
(23, 'زيت دابر املا كبير', 90, 2, NULL, NULL),
(24, 'زيت دابر املا وسط', 70, 5, NULL, NULL),
(25, 'زيت دابر املا صغير ', 40, 3, NULL, NULL),
(26, 'فاتيكا حمام كريم ', 45, 2, NULL, NULL),
(27, 'حرير سويت', 20, 10, NULL, NULL),
(28, 'فاتيكا كريم شعر كبير', 55, 4, NULL, NULL),
(29, 'الو ايفا كريم شعر كبير', 55, 1, NULL, NULL),
(30, 'فاتيكا كريم شعر صغير', 35, 3, NULL, NULL),
(31, 'جونسون كريم للبشره وسط', 65, 2, NULL, NULL),
(32, 'بودره تلك ', 20, 7, NULL, NULL),
(33, 'فيانسيه كريم شعر رجالي ', 45, 4, NULL, NULL),
(34, 'ONE كريم ازاله الشعر وسط ', 30, 11, NULL, NULL),
(35, 'ONE كريم ازاله الشعر كبير ', 45, 4, NULL, NULL),
(36, 'جليسرين طبي  ROLL', 19, 8, NULL, NULL),
(37, 'ملمع احذيه ', 20, 5, NULL, NULL),
(38, 'فاتيكا جل شعر ', 35, 2, NULL, NULL),
(39, 'المسواك معجون اسنان', 25, 4, NULL, NULL),
(40, 'فلور معجون اسنان اطفال', 30, 3, NULL, NULL),
(41, 'سنسوداين معجون اسنان وسط', 65, 6, NULL, NULL),
(42, 'ديبوردنت معجون لتبيض الاسنان', 50, 2, NULL, NULL),
(43, 'سيجنال معجون اسنان وسط', 30, 25, NULL, NULL),
(44, 'سيجنال معجون اسنان كبير ', 50, 9, NULL, NULL),
(45, 'سيجنال معجون اسنان صغير', 20, 17, NULL, NULL),
(46, 'باردونتكس معجون اسنان ', 30, 6, NULL, NULL),
(47, 'سنسوداين معجون اسنان كبير', 80, 2, NULL, NULL),
(48, 'مان لوك جل للشعر', 40, 5, NULL, NULL),
(49, 'لورد فوم حلاقه', 55, 4, NULL, NULL),
(50, 'ايفا بادي سبلاش', 175, 1, NULL, NULL),
(51, 'شيلز سبراي', 85, 3, NULL, NULL),
(52, 'ELEGANCE سبراي', 110, 1, NULL, NULL),
(53, 'نيفيا اسبراي مزيل عرق', 140, 1, NULL, NULL),
(54, 'REXONA ROLL SMALL', 30, 6, NULL, NULL),
(55, 'REXONA ROLL BIG', 75, 3, NULL, NULL),
(56, 'NIVEA ROLL', 75, 3, NULL, NULL),
(57, 'FA ROLL', 60, 1, NULL, NULL),
(58, 'فيبيكس ديو كريم', 35, 5, NULL, NULL),
(59, 'جومانا حنه للاظافر', 15, 5, NULL, NULL),
(60, ' فير اند لافلي كريم وسط', 30, 2, NULL, NULL),
(61, 'فير اند لافلي كريم صغير ', 30, 2, NULL, NULL),
(62, 'مخمريه العود الملكي ', 35, 9, NULL, NULL),
(63, 'جليسوليد كريم كبير', 55, 1, NULL, NULL),
(64, 'جليسوليد كريم وسط ', 25, 9, NULL, NULL),
(65, 'جليسوليد كريم صغير', 15, 2, NULL, NULL),
(66, 'فيانسيه زيت شعر كبير', 40, 19, NULL, NULL),
(67, 'الو ايفا زيت شعر كبير ', 60, 3, NULL, NULL),
(68, 'باندولين كريم شعر ', 90, 1, NULL, NULL),
(69, 'فيانسيه بديل زيت ', 45, 1, NULL, NULL),
(70, 'مينك  حمام كريم كبير', 50, 1, NULL, NULL),
(71, 'افوفا عجينه لازاله الشعر ', 35, 4, NULL, NULL),
(72, 'بالمز كريم لتصفيف الشعر ', 145, 2, NULL, NULL),
(73, 'بليس كريم للشعر الكيرلي', 60, 1, NULL, NULL),
(74, 'ايفا كريم شعر', 45, 2, NULL, NULL),
(75, 'بالمز كريم للشعر انبوبه', 70, 2, NULL, NULL),
(76, 'بالمز كريم للشعر علبه', 155, 2, NULL, NULL),
(77, 'ماسك للوجه ', 25, 3, NULL, NULL),
(78, 'صنفره للوجه', 25, 3, NULL, NULL),
(79, 'معطر جو فريده ', 60, 2, NULL, NULL),
(80, 'ايلفيف بديل الزيت للشعر ', 110, 1, NULL, NULL),
(81, 'الو ايفا بديل الزيت للشعر ', 95, 1, NULL, NULL),
(82, 'شاور جل فريده', 90, 3, NULL, NULL),
(83, 'كولور ناتشرلز صبغه للشعر', 100, 4, NULL, NULL),
(84, 'لوكس شاور جل', 85, 1, NULL, NULL),
(85, 'بلو شاور جل ', 55, 1, NULL, NULL),
(86, 'ايلفيف شامبو صغير ', 80, 2, NULL, NULL),
(87, 'ايلفيف شامبو كبير', 135, 1, NULL, NULL),
(88, 'صانسيلك شامبو صغير', 45, 3, NULL, NULL),
(89, 'صانسيلك شامبو كبير ', 90, 1, NULL, NULL),
(90, 'سباركل شامبو', 60, 4, NULL, NULL),
(91, 'كلير شامبو كبير رجالي ', 110, 2, NULL, NULL),
(92, 'كلير شامبو كبير حريمي ', 120, 1, NULL, NULL),
(93, 'كلير شامبو صغير حريمي ', 85, 2, NULL, NULL),
(94, 'كلير شامبو صغير رجالي', 75, 3, NULL, NULL),
(95, 'دوف شامبو كبير ', 99, 1, NULL, NULL),
(96, 'دوف شامبو صغير', 75, 2, NULL, NULL),
(97, 'بيرسول ', 35, 6, NULL, NULL),
(98, 'نابلسي شاهين صابون', 8, 4, NULL, NULL),
(99, 'الويز صغير', 35, 30, NULL, NULL),
(100, 'مناديل كبيره', 30, 28, NULL, NULL),
(101, 'الويز  كبيره', 60, 25, NULL, NULL),
(102, 'سوفي ', 55, 16, NULL, NULL),
(103, 'ديتول صابون كبير', 35, 8, NULL, NULL),
(104, 'ديتول صابون صغير', 20, 11, NULL, NULL),
(105, 'ريفولي صابون ', 15, 27, NULL, NULL),
(106, 'لوكس صابون ', 20, 18, NULL, NULL),
(107, 'ليفه مغربيه', 25, 4, NULL, NULL),
(108, 'شراب سيليكون', 110, 2, NULL, NULL),
(109, 'نيدو حليب ', 110, 1, NULL, NULL),
(110, 'نعناع', 18, 11, NULL, NULL),
(111, 'كركاديه', 18, 3, NULL, NULL),
(112, 'قرفه', 18, 1, NULL, NULL),
(113, 'ينسون', 18, 3, NULL, NULL),
(114, 'ايجي جروث مكمل غذائي', 100, 1, NULL, NULL),
(115, 'سويتال شاي اخضر', 75, 2, NULL, NULL),
(116, 'سويتال سكر دايت كبير', 100, 1, NULL, NULL),
(117, 'سويتال سكر دايت صغير', 35, 1, NULL, NULL),
(118, 'عضاضه اطفال ', 10, 12, NULL, NULL),
(119, 'فازلين احمر مرطب شفاه', 25, 4, NULL, NULL),
(120, 'صابون دروو 5 قطع', 50, 1, NULL, NULL),
(121, 'بانتين صغير', 85, 1, NULL, NULL),
(122, 'لفيه طبيه', 25, 7, NULL, NULL),
(123, 'ركبه', 45, 5, NULL, NULL),
(124, 'رقبه', 65, 1, NULL, NULL),
(125, 'حامل ذراع', 25, 2, NULL, NULL),
(126, 'رباط ضغط', 20, 6, NULL, NULL),
(127, 'ريجيم رويال شاي اخضر', 45, 2, NULL, NULL),
(128, ' سويتال سكر دايت برطمان', 140, 3, NULL, NULL),
(129, 'جروث فورميلا مكمل غذائي', 160, 1, NULL, NULL),
(130, 'بريما جروث', 136, 1, NULL, NULL),
(131, 'اعشاب السعال', 20, 1, NULL, NULL),
(132, 'ببرونه كبيره', 35, 5, NULL, NULL),
(133, 'ببرونه صغيره', 50, 1, NULL, NULL),
(134, 'مناديل فاميليا رول', 15, 16, NULL, NULL),
(135, 'لهايات ', 15, 27, NULL, NULL),
(136, ' طقم ببرونه 3*1', 85, 2, NULL, NULL),
(137, 'فرشاه اسنان', 15, 17, NULL, NULL),
(138, ' اجهزه ناموس ريد', 130, 2, NULL, NULL),
(139, 'شينكي جهاز ناموس', 75, 2, NULL, NULL),
(140, 'سائل جهاز القاتل للناموس بربر', 45, 3, NULL, NULL),
(141, 'سائل جهاز القاتل للناموس جوري', 25, 1, NULL, NULL),
(142, 'فليت بودره حشرات', 20, 1, NULL, NULL),
(143, 'كرت شفره حلاقه', 10, 15, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(2) DEFAULT NULL,
  `total_amount` varchar(225) DEFAULT NULL,
  `invoice_date` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(11) NOT NULL,
  `code` varchar(225) DEFAULT NULL,
  `name` varchar(225) DEFAULT NULL,
  `price` varchar(225) DEFAULT NULL,
  `strip_price` varchar(22) DEFAULT NULL,
  `expire` varchar(225) DEFAULT NULL,
  `quinity` varchar(225) DEFAULT NULL,
  `strip_number` int(11) DEFAULT NULL,
  `updated_at` varchar(225) DEFAULT NULL,
  `created_at` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `code`, `name`, `price`, `strip_price`, `expire`, `quinity`, `strip_number`, `updated_at`, `created_at`) VALUES
(1174, '6223002642267', 'Antopral 20 mg', '61', '30.5', '2025-08-01', '4', 2, '2024-10-06 16:40:16', '2024-10-06 16:28:02'),
(1176, NULL, 'Antopral 40 mg', '87', '43.5', '2025-09-01', '4', 8, '2024-10-06 17:04:06', '2024-10-06 17:00:39'),
(1177, '6223004190964', 'astint 20', '29', '14.5', '2027-05-24', '3', 6, '2024-10-06 17:17:55', '2024-10-06 17:17:55'),
(1178, '6221045011101', 'abimol extra', '16', '8', '2026-08-01', '1', 2, '2024-10-06 17:19:45', '2024-10-06 17:19:45'),
(1179, '6221045011286', 'augmentin 625', '117', '117', '2026-02-01', '2', 2, '2024-10-06 17:21:45', '2024-10-06 17:21:45'),
(1180, '6221045011279', 'augmentin 1g', '210', '105', '2025-02-01', '5', 10, '2024-10-06 17:24:36', '2024-10-06 17:24:36'),
(1181, '6221025022431', 'antinal', '52', '26', '2027-06-01', '7', 13, '2024-10-06 17:32:36', '2024-10-06 17:32:36'),
(1182, '6224009435470', 'alverinspasm', '49', '24.5', '2026-03-01', '4', 7, '2024-10-06 17:35:10', '2024-10-06 17:35:10'),
(1183, '6221043010328', 'aspocid', '22.5', '4.5', '2026-06-01', '8', 40, '2024-10-06 17:37:29', '2024-10-06 17:37:29'),
(1184, '6221060005239', 'achtenon', '34.5', '11.5', '2027-12-01', '14', 42, '2024-10-06 17:41:35', '2024-10-06 17:41:35'),
(1185, '6221045000341', 'abimol', '13', '6.5', '2025-10-01', '9', 18, '2024-10-06 17:45:09', '2024-10-06 17:45:09'),
(1186, '6223002144938', 'ambezim', '102', '34', '2027-01-02', '6', 18, '2024-10-06 17:48:08', '2024-10-06 17:48:08'),
(1187, '6221025030733', 'alphintern', '87', '29', '2026-06-01', '10', 28, '2024-10-06 17:50:45', '2024-10-06 17:50:45'),
(1188, NULL, 'Alkapress 10mg', '78', '26', '2026-09-01', '3', 9, '2024-10-06 17:54:31', '2024-10-06 17:54:31'),
(1189, NULL, 'alkapress 5 mg', '41', '20.5', '2026-09-01', '8', 16, '2024-10-06 17:56:34', '2024-10-06 17:56:34'),
(1190, '16223003270001', 'atacand 4mg', '40', '40', '2026-01-01', '1', 1, '2024-10-06 17:58:09', '2024-10-06 17:57:48'),
(1191, '6223003270049', 'atacand 416/15.5mg', '116', '116', '2026-12-01', '2', 2, '2024-10-06 17:59:36', '2024-10-06 17:59:16'),
(1192, '6223003270032', 'atacand 16mg', '85', '85', '2026-07-01', '1', 1, '2024-10-06 18:00:52', '2024-10-06 18:00:52'),
(1193, '6221060008964', 'amigraine adco', '63', '21', '2026-10-01', '4', 10, '2024-10-06 18:04:09', '2024-10-06 18:04:09'),
(1194, '6221050032689', 'Aspirin Protect100', '78', '26', '2025-11-01', '6', 17, '2024-10-06 18:06:16', '2024-10-06 18:06:16'),
(1195, '6223012330048', 'alkapride 50 mg', '61.5', '20.5', '2027-05-01', '3', 8, '2024-10-06 18:09:01', '2024-10-06 18:09:01'),
(1196, '6221076610243', 'aspricarlo', '28.5', '9.5', '2025-12-01', '3', 7, '2024-10-06 18:10:56', '2024-10-06 18:10:56'),
(1197, '6224009671175', 'atmiprazole40g', '116', '58', '2026-12-23', '3', 6, '2024-10-06 18:15:24', '2024-10-06 18:15:24'),
(1198, '6221032110107', 'altiazem60g', '46', '11.5', '2027-11-01', '3', 12, '2024-10-06 18:17:22', '2024-10-06 18:17:22'),
(1199, NULL, 'arthrofast150g', '83', '41.5', '2025-05-12', '2', 2, '2024-10-06 18:19:26', '2024-10-06 18:19:26'),
(1200, '6221025003843', 'antodine40g', '93', '31', '2027-07-01', '2', 5, '2024-10-06 18:21:05', '2024-10-06 18:21:05'),
(1201, NULL, 'antodine20g', '60', '20', '2027-07-01', '2', 11, '2024-10-06 18:23:17', '2024-10-06 18:23:17'),
(1202, '6223004692659', 'amipride50g', '111', '37', '2026-08-01', '6', 17, '2024-10-06 18:26:05', '2024-10-06 18:26:05'),
(1203, NULL, 'aig esomeprazole 40g', '296', '74', '2027-06-01', '2', 6, '2024-10-06 18:28:09', '2024-10-06 18:28:09'),
(1204, '6221068904527', 'aldomet', '73.5', '24.5', '2027-05-01', '3', 9, '2024-10-06 18:30:40', '2024-10-06 18:30:40'),
(1206, NULL, 'amigrawest 2.5g', '39', '39', '2025-08-01', '2', 2, '2024-10-06 18:33:02', '2024-10-06 18:33:02'),
(1208, '6223002640065', 'anuva 50g', '17.5', '17.5', '2025-12-01', '1', 1, '2024-10-06 18:38:45', '2024-10-06 18:38:45'),
(1209, '6223005980069', 'antiflan up pharma 50g', '22.5', '11', '2025-09-01', '1', 1, '2024-10-06 18:40:49', '2024-10-06 18:40:49'),
(1210, '6223004519710', 'amaglust 30\\2g', '67.5', '22.5', '2026-11-01', '2', 4, '2024-10-06 18:44:44', '2024-10-06 18:44:01'),
(1211, '6224008179078', 'averozolid 600g', '231', '231', '2027-08-01', '2', 2, '2024-10-06 18:46:28', '2024-10-06 18:46:28'),
(1212, '6222006502102', 'angiosartan plus 40\\25g', '58', '14.5', '2025-05-01', '1', 4, '2024-10-06 18:48:42', '2024-10-06 18:48:42'),
(1213, '6222006502096', 'angiosartan plus 20\\25g', '46', '11.5', '2026-01-01', '1', 4, '2024-10-06 18:50:22', '2024-10-06 18:50:22'),
(1214, '6222006502126', 'angiosartan plus 40\\12.5g', '54', '13.5', '2026-02-01', '1', 4, '2024-10-06 18:51:42', '2024-10-06 18:51:42'),
(1215, '6222006502072', 'angiosartan 20g', '40', '10', '2027-07-01', '1', 4, '2024-10-06 18:54:23', '2024-10-06 18:54:23'),
(1216, '6223002642793', 'asmakast 10g', '105', '35', '2026-04-01', '1', 2, '2024-10-06 19:19:45', '2024-10-06 19:19:45'),
(1217, '6224008179474', 'averothiazide 20\\5\\12.5g', '93', '31', '2026-08-01', '4', 12, '2024-10-06 19:23:22', '2024-10-06 19:23:22'),
(1218, '6221068001158', 'anallerge 4g', '30', '10', '2028-06-01', '1', 3, '2024-10-06 19:25:19', '2024-10-06 19:25:19'),
(1219, '6223003973872', 'aggrex 75g', '33', '5.5', '2026-04-01', '5', 26, '2024-10-06 19:29:17', '2024-10-06 19:29:17'),
(1220, '6224009003181', 'albendazole 400g', '31', '31', '2026-10-01', '3', 3, '2024-10-06 19:30:44', '2024-10-06 19:30:44'),
(1221, '6221068101001', 'a viton', '19', '19', '2026-06-01', '1', 1, '2024-10-06 19:41:38', '2024-10-06 19:41:38'),
(1222, '6223003200671', 'allerban sr 2g', '24', '12', '2026-06-01', '1', 2, '2024-10-06 19:43:18', '2024-10-06 19:42:46'),
(1223, '6224000834036', 'azgovanc 40\\110g', '27', '27', '2025-10-01', '1', 1, '2024-10-06 19:44:56', '2024-10-06 19:44:56'),
(1224, '6224000834029', 'azgovanc 20\\1100g', '24.5', '24.5', '2026-05-01', '1', 1, '2024-10-06 19:49:30', '2024-10-06 19:49:30');

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
-- Indexes for table `cosmatics`
--
ALTER TABLE `cosmatics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cosmatics`
--
ALTER TABLE `cosmatics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1225;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

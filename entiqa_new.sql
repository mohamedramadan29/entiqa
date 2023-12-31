-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 30, 2023 at 09:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `entiqa_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_prev` int NOT NULL COMMENT '1 : الادمن \r\n2: فريق الخدمة \r\n3 : المدرب\r\n',
  `cat_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pass_code` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `session_token` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_email`, `admin_prev`, `cat_name`, `pass_code`, `session_token`) VALUES
(1, 'admin', 'admin', 'rawantarek770@gmail.com', 1, '', 'BEVGwYVl', '85e8d43e7822468730dbe622bda840fa'),
(2, 'admin2', 'entifkut_entiqa_test', 'saherkhayat@hotmail.com', 2, '', NULL, '40cc203f6e3ac241ea1189b29168beff'),
(3, 'admin33', 'entifkut_entiqa_test', 'mohamedramadan2930@outlook.com', 3, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `batch_id` int NOT NULL,
  `batch_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch_coach` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch_start` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch_min` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch_max` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch_created_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ind_num` int NOT NULL,
  `batch_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`batch_id`, `batch_name`, `batch_coach`, `batch_start`, `batch_min`, `batch_max`, `batch_created_at`, `ind_num`, `batch_status`) VALUES
(7, 'الدفعه الاخيرة', '7', '2023-12-24', '5', '10', '', 5, 'استقطاب'),
(8, 'الدفعة الاولى', '4', '2023-08-01', '15', '2', '', 1, ''),
(11, 'الدفعة الاولى ', '18', '2023-09-26', '5', '12', '', 2, ''),
(12, 'دفعة جديدة', '20', '2023-10-24', '7', '5', '', 1, 'تم التأهيل بنجاح'),
(13, 'دفعة computer science', '-- اختر المدرب --', '2023-10-19', '1', '10', '', 0, 'تم التأهيل بنجاح'),
(14, 'دفعه 2023 جديده', '18', '2023-10-18', '1', '10', '', 1, 'تم التأهيل بنجاح'),
(15, 'دفعه جديده 33', '1', '2023-09-27', '2', '1', '', 0, 'تم التأهيل بنجاح'),
(16, 'دفعة 2023', '16', '2023-09-27', '5', '8', '', 0, ''),
(17, 'دفعة 9', '16', '2023-09-28', '6', '8', '', 1, ''),
(19, 'class2023', '19', '2023-09-30', '10', '35', '', 0, ''),
(20, 'دفعه جديده ', '21', '2023-09-27', '1', '10', '', 0, 'تم التأهيل بنجاح'),
(21, 'دفعة تجريبية ', '-- اختر المدرب --', '2023-09-20', '1', '10', '', 8, 'تم التأهيل بنجاح'),
(22, 'دفعة تست 1', '20', '2023-10-09', '1', '10', '2023-10-09', 3, 'تم التأهيل بنجاح'),
(23, 'دفغة 10/10', '18', '2024-10-10', '0', '2', '2023-10-10', 2, 'استقطاب'),
(25, 'new grad 11', '23', '2023-10-18', '1', '10', '2023-10-18', 5, 'تم التأهيل بنجاح'),
(27, '2024', '23', '2023-12-26', '1', '2', '2023-10-19', 2, 'استقطاب'),
(28, 'computer science', '-- اختر المدرب --', '2023-10-19', '1', '1', '2023-10-19', 0, 'قيد التدريب'),
(29, 'computer science', '-- اختر المدرب --', '2023-10-19', '1', '1', '2023-10-19', 0, 'قيد التدريب'),
(30, 'computer science', '-- اختر المدرب --', '2023-10-19', '1', '1', '2023-10-19', 0, 'قيد التدريب'),
(31, 'computer science', '-- اختر المدرب --', '2023-10-19', '1', '1', '2023-10-19', 0, 'قيد التدريب'),
(32, 'computer science', '-- اختر المدرب --', '2023-10-19', '1', '1', '2023-10-19', 0, 'قيد التدريب'),
(33, 'computer science', '-- اختر المدرب --', '2023-10-19', '1', '1', '2023-10-19', 0, 'قيد التدريب'),
(34, 'computer science', '-- اختر المدرب --', '2023-10-04', '2', '3', '2023-10-19', 0, 'قيد التدريب'),
(35, 'computer science', '20', '2023-12-24', '-8', '-5', '2023-10-19', 0, 'استقطاب'),
(36, 'دفعة تجريبية', '23', '2023-12-26', '1', '5', '2023-10-19', 2, 'استقطاب'),
(37, 'test grad', '8', '2023-10-23', '1', '2', '2023-10-23', 0, 'استقطاب'),
(38, 'دفعة 2025', '-- اختر المدرب --', '2023-10-23', '1', '1', '2023-10-23', 0, 'استقطاب'),
(39, 'دفعة 2025', '-- اختر المدرب --', '2023-10-23', '2', '3', '2023-10-23', 0, 'استقطاب'),
(41, 'دفعة 2025', '-- اختر المدرب --', '2023-10-23', '2', '3', '2023-10-23', 0, 'استقطاب'),
(43, 'test grad', '1', '2023-10-24', '1', '1', '2023-10-24', 0, 'استقطاب'),
(44, 'test grad', '1', '2023-10-24', '1', '1', '2023-10-24', 0, 'استقطاب'),
(45, 'test grad', '1', '2023-10-24', '1', '1', '2023-10-24', 0, 'استقطاب'),
(46, 'دفعة 2027', '1', '2023-12-24', '3', '7', '2023-12-24', 0, 'استقطاب'),
(47, 'دفعة تست', '20', '2023-12-25', '-4', '-3', '2023-12-24', 0, 'استقطاب'),
(48, 'دفعة تست 3', '1', '2023-12-24', '1', '3', '2023-12-24', 0, 'استقطاب'),
(49, 'test delete ', '77', '2023-12-25', '5', '20', '2023-12-24', 0, 'استقطاب'),
(50, 'دفعة تجريبية 2', '20', '2023-12-26', '1', '4', '2023-12-24', 3, 'استقطاب'),
(51, 'دفعة تجريبية', '21', '2023-12-26', '-7', '-2', '2023-12-25', 0, 'استقطاب'),
(52, 'دفعة sz', '20', '2023-12-26', '2', '5', '2023-12-26', 0, 'استقطاب');

-- --------------------------------------------------------

--
-- Table structure for table `batches_notification`
--

CREATE TABLE `batches_notification` (
  `id` int NOT NULL,
  `batch` int NOT NULL,
  `cosh` int DEFAULT NULL,
  `ind` int NOT NULL,
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `batches_notification`
--

INSERT INTO `batches_notification` (`id`, `batch`, `cosh`, `ind`, `status`) VALUES
(34, 6, NULL, 165, 1),
(35, 5, NULL, 171, 1),
(36, 7, NULL, 171, 1),
(37, 0, NULL, 171, 1),
(38, 6, NULL, 165, 1),
(39, 12, NULL, 139, 1),
(40, 12, NULL, 139, 1),
(41, 7, NULL, 141, 0),
(42, 16, NULL, 144, 1),
(43, 16, NULL, 144, 1),
(44, 0, NULL, 147, 1),
(45, 14, NULL, 159, 1),
(46, 14, NULL, 159, 1),
(47, 14, NULL, 159, 1),
(48, 0, NULL, 154, 1),
(49, 0, NULL, 154, 1),
(50, 12, NULL, 174, 1),
(51, 0, NULL, 138, 0),
(52, 0, NULL, 138, 0),
(53, 14, NULL, 174, 1),
(54, 14, NULL, 159, 1),
(55, 14, NULL, 154, 1),
(56, 23, NULL, 154, 1),
(57, 14, NULL, 187, 0),
(58, 25, NULL, 195, 1),
(59, 25, NULL, 194, 1),
(60, 25, NULL, 177, 0),
(61, 25, NULL, 163, 0),
(62, 21, NULL, 142, 1),
(63, 36, NULL, 142, 1),
(64, 36, NULL, 148, 1),
(65, 36, NULL, 183, 0),
(66, 25, NULL, 165, 0),
(67, 36, NULL, 153, 0),
(68, 33, NULL, 170, 0),
(69, 35, NULL, 188, 0),
(70, 35, NULL, 150, 0),
(71, 35, NULL, 186, 0),
(72, 7, NULL, 136, 0),
(73, 35, NULL, 201, 0),
(74, 35, NULL, 201, 0),
(75, 14, NULL, 159, 0),
(76, 0, NULL, 175, 0),
(77, 21, NULL, 151, 1),
(78, 36, NULL, 151, 0),
(79, 7, NULL, 136, 0),
(80, 7, NULL, 136, 0),
(81, 30, NULL, 179, 0),
(82, 14, NULL, 174, 0),
(83, 14, NULL, 174, 0),
(84, 14, NULL, 174, 0),
(85, 0, NULL, 172, 0),
(86, 7, NULL, 136, 0),
(87, 7, NULL, 136, 0),
(88, 7, NULL, 136, 0),
(89, 50, NULL, 193, 0),
(90, 50, NULL, 152, 0),
(91, 17, NULL, 215, 0),
(92, 36, NULL, 209, 0),
(93, 50, NULL, 211, 0),
(94, 7, NULL, 146, 0),
(95, 0, NULL, 137, 0);

-- --------------------------------------------------------

--
-- Table structure for table `change_status_notification`
--

CREATE TABLE `change_status_notification` (
  `id` int NOT NULL,
  `ind_id` int NOT NULL,
  `change_status` varchar(255) NOT NULL,
  `status_show` int NOT NULL DEFAULT '0',
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `change_status_notification`
--

INSERT INTO `change_status_notification` (`id`, `ind_id`, `change_status`, `status_show`, `date`) VALUES
(2, 193, '0', 0, '2023-12-24'),
(3, 152, '0', 0, '2023-12-24'),
(4, 139, '0', 0, '2023-12-25'),
(5, 159, '-1', 0, '2023-12-25'),
(6, 215, '3', 0, '2023-12-30'),
(7, 209, '2', 0, '2023-12-25'),
(8, 136, '2', 0, '2023-12-25'),
(9, 211, '2', 0, '2023-12-25'),
(10, 146, '1', 0, '2023-12-25'),
(11, 137, '0', 0, '2023-12-30'),
(12, 138, '0', 0, '2023-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int NOT NULL,
  `from_person` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `to_person` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `msg` text COLLATE utf8mb4_general_ci NOT NULL,
  `msg_files` longtext COLLATE utf8mb4_general_ci,
  `date` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `send_type` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `admin_noti` int NOT NULL DEFAULT '0',
  `ind_noti` int NOT NULL DEFAULT '0',
  `com_noti` int NOT NULL DEFAULT '0',
  `coash_id` int NOT NULL DEFAULT '0',
  `batch_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coash_notification`
--

CREATE TABLE `coash_notification` (
  `id` int NOT NULL,
  `ind_id` int NOT NULL,
  `noti_desc` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `noti_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `coash_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `coash_notification`
--

INSERT INTO `coash_notification` (`id`, `ind_id`, `noti_desc`, `status`, `noti_date`, `coash_id`) VALUES
(1, 127, 'انتهاء اختبار ', 0, '2023-06-17 21:00:00', NULL),
(2, 127, 'انتهاء اختبار ', 1, '2023-06-17 21:00:00', 2),
(3, 127, 'انتهاء اختبار ', 0, '2023-06-18 21:00:00', NULL),
(4, 127, 'انتهاء اختبار ', 0, '2023-06-18 21:00:00', NULL),
(5, 136, 'انتهاء اختبار ', 1, '2023-06-22 04:00:00', 8),
(6, 136, 'انتهاء اختبار ', 1, '2023-07-03 04:00:00', 8),
(7, 165, 'انتهاء اختبار ', 1, '2023-08-11 04:00:00', 8),
(8, 171, 'انتهاء اختبار ', 1, '2023-08-13 04:00:00', 8),
(9, 174, 'انتهاء اختبار ', 1, '2023-10-09 04:00:00', 18),
(10, 174, 'انتهاء اختبار ', 1, '2023-10-09 04:00:00', 18),
(11, 174, 'انتهاء اختبار ', 1, '2023-10-09 04:00:00', 18),
(12, 174, 'انتهاء اختبار ', 1, '2023-10-09 04:00:00', 18),
(13, 159, 'انتهاء اختبار ', 1, '2023-10-09 04:00:00', 18),
(14, 148, 'انتهاء اختبار ', 0, '2023-10-10 04:00:00', NULL),
(15, 148, 'انتهاء اختبار ', 0, '2023-10-10 04:00:00', NULL),
(16, 194, 'انتهاء اختبار ', 1, '2023-10-10 04:00:00', 18),
(17, 194, 'انتهاء اختبار ', 1, '2023-10-10 04:00:00', 18),
(18, 146, 'انتهاء اختبار ', 1, '2023-10-10 04:00:00', 18),
(19, 154, 'انتهاء اختبار ', 1, '2023-10-10 04:00:00', 18),
(20, 146, 'انتهاء اختبار ', 1, '2023-10-10 04:00:00', 18),
(21, 194, 'انتهاء اختبار ', 0, '2023-10-10 04:00:00', 18),
(22, 195, 'انتهاء اختبار ', 1, '2023-10-18 04:00:00', 23),
(23, 195, 'انتهاء اختبار ', 1, '2023-10-18 04:00:00', 23),
(24, 195, 'انتهاء اختبار ', 1, '2023-10-18 04:00:00', 23),
(25, 195, 'انتهاء اختبار ', 1, '2023-10-18 04:00:00', 23),
(26, 195, 'انتهاء اختبار ', 1, '2023-10-18 04:00:00', 23),
(27, 194, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23),
(28, 194, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23),
(29, 195, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23),
(30, 194, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23),
(31, 195, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23),
(32, 194, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23),
(33, 195, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23),
(34, 195, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23),
(35, 194, 'انتهاء اختبار ', 1, '2023-10-19 04:00:00', 23);

-- --------------------------------------------------------

--
-- Table structure for table `company_register`
--

CREATE TABLE `company_register` (
  `com_id` int NOT NULL,
  `com_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_name_en` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_phone` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `com_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `com_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_num` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_active` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_place` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_braches` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_founded` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_work_h` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_work_libs` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_weekend_num` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `com_work_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_salary` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `com_commission` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `com_info` longtext COLLATE utf8mb4_general_ci,
  `code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `com_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `com_confirm` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `com_balance` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `com_updated` int NOT NULL DEFAULT '0',
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_status` int DEFAULT '0',
  `active_status_code` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_number` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_register`
--

INSERT INTO `company_register` (`com_id`, `com_name`, `com_name_en`, `com_username`, `com_email`, `com_phone`, `com_image`, `com_password`, `com_num`, `com_active`, `com_place`, `com_braches`, `com_founded`, `com_work_h`, `com_work_libs`, `com_weekend_num`, `com_work_type`, `com_salary`, `com_commission`, `com_info`, `code`, `com_status`, `com_confirm`, `com_balance`, `com_updated`, `start_date`, `active_status`, `active_status_code`, `order_number`) VALUES
(33, 'lamar', 'lamar', 'mohamed', 'mohamedramadan2930@gmail.com', NULL, NULL, '11111111', '1110', 'نشاط تجاري ', 'المدينة المنورة', 'damanhour ', '2022', 'من 8 صباحا الي 8 مساءا', '2', '2', ' عمل ميداني ', '1000', '100', NULL, NULL, '1', '0', '1000', 1, '2023-09-24 15:47:33', 1, '24199', NULL),
(39, 'testing', 'testing', 'test', 'test@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 08:31:05', 0, '4593f18cab388505bedad02531d234ee', NULL),
(41, 'softzone', 'softzone', 'fatmaalzharaa', 'mohamedramadan2930@gmail.com	', '', '1696776726_216599260_blue_e1.webp', '123456', '@@@', 'software', 'الرياض', 'مكة', '2000', '5', '2', '2', 'عمل ميداني', '80000', '20', '', NULL, '1', '0', '0', 1, '2023-10-08 11:42:51', 0, '1798ad3814d01c8488304f38c0078799', NULL),
(42, 'test11', 'test', 'test11', 'test22@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:06:36', 0, '9fd0ecdf5dd2d62a289083fca4053897', NULL),
(43, 'test111', 'test', 'test111', 'test11@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:07:05', 0, '89e76fe26312e33dd92bce02db1805eb', NULL),
(44, 'تستنج', 'testing', 'aya', 'aya@gmail.com', '', NULL, '12345678', '1234567', 'تدريب', 'جدة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', '', NULL, '0', '0', '0', 1, '2023-10-08 12:17:26', 0, '2ecc0122e8b722a3e21a086e9f7588cc', NULL),
(45, 'testing', 'testing', 'testing', 'testing@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:22:14', 0, 'a3d3fdc1133b46b96c2748ac3e90fa7e', NULL),
(46, 'testing1', 'testing1', 'testing1', 'testing1@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:23:52', 0, 'e5541332d8d4a0f8adc51d991053b951', NULL),
(47, 'testing111', 'testing111', 'testing111', 'testing111@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:26:20', 0, '45466ca4f28af3582623d0035d8092c3', NULL),
(48, 'tichtich', 'tichtich', 'Tichtich', 'bokegar320@gronasu.com', NULL, NULL, 'Asd@1234', '25984', 'Technology', 'الرياض', '2', '2000', '9', '2', '2', 'عمل ميداني', '5000', '20', NULL, '16992', '1', '0', '-948', 1, '2023-10-08 12:32:02', 0, '17b3c741d93b54ba1f84365f23e779c2', NULL),
(49, 'tranning company', 'tranning company', 'tranning company', 'tranningcompany@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:35:23', 0, 'd49fb5c84cf656cd98ba865375612c41', NULL),
(50, 'ayyyy', 'ayyyy', 'ayyyy', 'ayyyy@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:44:50', 0, 'c1f94aa77b8981a94b831aae0a423793', NULL),
(52, 'ayaayaaya', 'ayaayaaya', 'ayaayaaya', 'aya1234@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'جدة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:50:11', 0, '8e860342f02b4fed2b8d9240cfd86120', NULL),
(53, 'AyaAyaAyaAya', 'AyaAyaAyaAya', 'AyaAyaAyaAya', 'Aya222@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:52:44', 0, '45931c93807a26edbcd9592d7659d7b2', NULL),
(54, 'AyaAyaAyaAyaAya', 'AyaAyaAyaAyaAya', 'AyaAyaAyaAyaAya', 'aya12345@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'جدة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 12:57:22', 0, '33b3d805ba0a23daa1f14d7d8891e58f', NULL),
(55, 'شركه للتدريب', 'شركه للتدريب', 'aya test', 'aya1@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '1', '0', '1', 1, '2023-10-08 14:11:42', 0, '674254a33515b4f7e0cffbdee29d93a2', NULL),
(56, 'testing', 'testing', 'aya test test', 'ayatest2@gmail.com', NULL, NULL, '123', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 14:26:49', 0, '42670b52a582936b425e8cb5a716cebc', NULL),
(57, 'test tanning', 'test tanning', 'aya testtt', 'testtranning@gmail.com', NULL, NULL, '123', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 14:36:33', 0, '5055d4d61f2194b3a1e9a3f7ef41c3b0', NULL),
(58, 'testinggg', 'testinggg', 'ayatesttest', 'testingg@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 15:00:11', 0, '85baa996d56f595d7c0fa3e3e6ab81d8', NULL),
(59, 'testinggg', 'testinggg', 'ayatesttestt', 'testinggg@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 15:04:48', 0, 'd3470bdc1d74260b097f06295753da20', NULL),
(60, 'testingtest', 'testingtesting', 'ayatesttesttt', 'testingggg@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 15:09:55', 0, '993d508bc8481855280b4607fe059c6c', NULL),
(61, 'testingtranning', 'testingtranning', 'ayatest22', 'testingtranning@gmail.com', NULL, NULL, '12345678', '123456', 'train', 'زلفي', 'egy', '2023', '2', '1', '2', 'عمل مكتبي', '100', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-08 15:13:42', 0, 'c3ebc82a0705bb1e41cdf2cf24b98396', NULL),
(62, 'softzone', 'softzone', 'fatmaelzharaa', 'fatmaalzharaa.softzone@gmail.com', '1234456789', NULL, '123456', '6556', 'برمجةةة', 'الرياض', 'الرياض', '2000', '77', '2', '2', 'عمل ميداني', '80000', '20', '', NULL, '1', '0', '-946', 1, '2023-10-09 06:24:27', 0, 'c20a0ec61a682e24e0ef261c87323fd1', NULL),
(63, 'softzone', 'softzone', 'afatmaelzharaa', '.fatmaalzharaa.softzone@gmail.com', NULL, NULL, '123456', '6556', 'software', 'زلفي', 'مكة', '2000', 'sss', '2', '2', 'عمل مكتبي', '80000', '20', NULL, NULL, '1', '0', '0', 1, '2023-10-09 06:25:35', 0, '663ead0b7020c73aebface2b7547d6de', NULL),
(64, 'ComanyTest55', 'ComanyTest55', 'ComanyTest55', 'ComanyTest55@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 06:35:13', 0, '66b54c8dff0d9295de5fd5bf2d8a5ed4', NULL),
(65, 'dd', 'ddd', 'ddd', 'ddd@gmail.com', NULL, NULL, '123456', '123', 'ss', 'جدة', 'test', '1111111', '-15', '-2', '-1', 'عمل ميداني', '-900', '-20', NULL, NULL, '0', '0', '0', 1, '2023-10-09 06:36:10', 0, 'adb2db82b40ce0169d4e05f177b03fa1', NULL),
(66, 'ComanyTest555', 'ComanyTest55', 'ComanyTest555', 'ComapnyTest555@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'جدة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 06:37:09', 0, '8e3cf19913aa77eded03e7fec3dfb37c', NULL),
(67, 'ComanyTestttt', 'ComanyTest55', 'ComanyTesttt', 'ComanyTestttt@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 06:38:48', 0, '4ae01ec82b667560c1249a3182f744b4', NULL),
(68, 'ComanyTesttttr', 'ComanyTest55', 'ComanyTestttr', 'Companytetstttt@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 06:45:45', 0, '318a9f6f5045678e9ae482403746e81d', NULL),
(69, 'testing tranning22', 'testing tranning22', 'username22', 'username@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '1', '0', '0', 1, '2023-10-09 06:49:28', 0, '417f7eb69ec92476e9308c027e703e33', NULL),
(70, 'testing tranning22', 'testing tranning22', 'username111', 'username11@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 07:15:39', 0, '4e794ea1559cecca4599489205f21410', NULL),
(71, 'comapny111111', 'comapny111111', '1', 'comapny11111@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 07:36:21', 0, 'b85d1f6e2203d6b68f0cc4a2e3f5a41d', NULL),
(72, 'comapny111111', 'comapny111111', '@#', 'comapny111113@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '1', '0', '2', 1, '2023-10-09 07:36:42', 0, '93470d3ea5d7975e0c4fd619417bc0a7', NULL),
(74, 'comapny1111113', 'comapny1111113', '*#', 'comapny1111134@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 07:38:26', 0, '2a577c286b9912665fec5103cf150b85', NULL),
(75, 'ZONE', 'ZONE', 'OSAMA', 'wojokon400@gronasu.com', NULL, NULL, 'Asd@1234', '25984', 'Technology', 'الرياض', '2', '2000', '9', '2', '2', 'عمل مكتبي', '5000', '20', NULL, NULL, '0', '0', '0', 1, '2023-10-09 08:00:56', 0, '82af3a46be6aa287a9f7f2d906f1fdf5', NULL),
(78, 'softtranningg', 'softtranningg', '&amp;*', 'softtranningg@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 08:20:49', 0, '9b683c4562f80d207fac80f444a3ce2b', NULL),
(84, 'softtrain', 'softtrain', 'شركه جيد', 'aya333@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'جدة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 09:01:16', 0, '44425456bf5a6cb765f4d3227bdd7a7a', NULL),
(85, 'softtrainn', 'softtrainn', 'شركه تد', 'aya3333@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 09:02:50', 0, '6302b73f490240db37cb9b36018578b0', NULL),
(86, 'ComanyTest5566', 'ComanyTest5566', 'new new', 'ComanyTest5566@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'مكة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 09:14:43', 0, '4b7c83cfc0b33671b8a2da7e12cb4847', NULL),
(87, 'newC', 'شركه سي', 'newC', 'newC@gmail.com', NULL, NULL, '12345678', '-----------', 'تدريب', 'جدة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 09:38:37', 0, '6138c02875d68de9e3f714437b02d756', NULL),
(88, 'newCC', 'شركه سيي', 'newCC', 'newCC@gmail.com', NULL, NULL, '12345678', '1', 'تدريب', 'مكة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 09:45:01', 0, '59651f4798c599075bb3266f14bfae64', NULL),
(89, 'newCCC', 'شركه سيي', 'newCCC', 'newCCC@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '1', '0', '1', 1, '2023-10-09 09:48:37', 0, '0bbcadfc967972256571bee27147c32d', NULL),
(90, 'newCCCC', 'شركه تسلا', 'newCCCC', 'newCCCC@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'جدة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 09:49:53', 0, 'd726188b4a238ba7bcf6800612108415', NULL),
(91, 'شركه سوفت ر3', 'softr', 'شركه د', 'softr3@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 11:21:51', 0, '1d5cc613d8966bba79746f133436d74c', NULL),
(92, 'شركه سوفت شركه سوفت شركه سوفت شركه سوفت شركه سوفت شركه سوفت', 'softrr', 'شركه س', 'softr33@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 11:22:41', 0, '1500ffc5e0140bd41a26319a19649c99', NULL),
(93, 'شركه333', 'softr', 'شركه س2', 'company44@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'عنيزة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 11:25:27', 0, '5a81ef2f485f320a4feb3d5b88cf651f', NULL),
(94, 'شركه دد', 'c1', 'شركه دد', 'c@gmail.com', NULL, NULL, '12345678', '123456', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,', 'الرياض', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل ميداني', '1000', '10', NULL, NULL, '0', '0', '0', 1, '2023-10-09 11:30:51', 0, '12a094022cad8276f9c13f1b6a7758f1', NULL),
(95, 'شركه ددد', 'cc', 'شركه ددد', 'cc@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'زلفي', 'جدة-الرياض', '-2', '8', '1', '2', 'عمل مكتبي', '1000', '1', NULL, NULL, '0', '0', '0', 1, '2023-10-09 11:39:05', 0, '4f3f6ad5d87622bafc869a9a9bc0115f', NULL),
(96, 'شركه ddd', 'dd', 'شركه ddd', 'dd@gmail.com', NULL, NULL, '12345678', '123456', 'تدريب', 'مكة', 'جدة-الرياض', '2023', '8', '1', '2', 'عمل مكتبي', '1000', '120', NULL, NULL, '0', '0', '0', 1, '2023-10-09 11:52:42', 0, 'dce9d9065746e43a2c6b90e108bb5325', NULL),
(97, 'magenta', 'magenta', 'magenta', 'dipolip991@locawin.com', NULL, NULL, 'Asd@1234', '2598444', 'ads', 'الرياض', '2', '2000', '9', '2', '2', 'عمل مكتبي', '5000', '20', NULL, NULL, '0', '0', '0', 1, '2023-10-18 09:54:53', 0, 'd944598161f467f91d782cbe80f601c2', NULL),
(98, 'magentaa', 'magenta', 'magentaa', 'pexobam170@ibtrades.com', NULL, NULL, 'Asd@1234', '2598444', 'ads', 'زلفي', '2', '2000', '9', '2', '2', 'عمل مكتبي', '5000', '20', NULL, NULL, '0', '0', '0', 1, '2023-10-18 09:56:22', 0, '8d82c4b536740d260ccf2692e1d02703', NULL),
(99, 'comany@gmail.com', 'comany@gmail.com', 'comany@gmail.com', 'comany@gmail.com', '3698521477', NULL, '123456', '96325874145', 'التجارة', 'الرياض', 'جدة ، القاهرة، الرياض', 'comany@gmail.com', '8:2', '1', '3', 'عمل ميداني', '20000', '5', 'id ornare arcu odio ut sem nulla pharetra diam sit amet nisl suscipit adipiscing bibendum est ultricies integer quis auctor elit sed vulputate mi sit amet mauris commodo quis imperdiet massa tincidunt nunc pulvinar sapien et ligula ullamcorper malesuada proin libero nunc consequat interdum varius sit amet mattis vulputate enim', NULL, '1', '0', '-949', 1, '2023-10-18 14:42:54', 0, 'a4d59926d15f08279603dc21fae7e4f1', NULL),
(100, 'Microsoft', 'ميكروسوفت', 'Microsoft', 'pesac48915@wermink.com', NULL, NULL, 'شسي@1234', '96385', 'Technology', 'الرياض', '2', '2000', '9', '2', '2', 'عمل مكتبي', '5000', '20', NULL, NULL, '1', '0', '1', 1, '2023-10-19 06:44:04', 0, '6a42841bdebb807e2894a83209ddd5e3', NULL),
(101, 'Demetrius Sharp', 'Amanda Grimes', 'google', 'nutebipy@mailinator.com', NULL, NULL, '12345678', 'Minima iure aliquip', 'Neque quas minus ali', 'حفر الباطن', 'Quo minus ut aut omn', 'Illo qui dolore faci', 'Qui elit rerum quis', 'Duis voluptas volupt', 'Reiciendis esse ali', 'عمل ميداني', 'Reprehenderit hic c', 'Sint eveniet pariat', NULL, NULL, '1', '0', '1000', 1, '2023-10-19 07:03:40', 0, '627c2c262d12d67ec8af0032fe7960e6', NULL),
(102, 'رنين', 'Patrick Hamilton', 'رنين', 'civisaqi@mailinator.com', NULL, NULL, '12345678', 'Qui tempore error e', 'Dolores voluptas ex', 'عسير', 'Laborum Dolores ill', 'Molestiae dolore aut', 'Neque minus vel minu', 'Dicta obcaecati et n', 'Nulla natus sunt fa', 'عمل مكتبي', 'Itaque ut ea libero', 'Quos ratione alias s', NULL, NULL, '1', '0', '1', 1, '2023-10-19 07:20:09', 0, '0557fc0aa0b4907d5c3a9bc987188109', NULL),
(103, 'twitter', 'تويتر', 'elonmusk', 'jefihag614@wisnick.com', NULL, NULL, 'شسي@1234', '3657', 'Technology', 'الرياض', '2', '2000', '9', '2', '2', 'عمل مكتبي', '5000', '20', NULL, NULL, '1', '0', '0', 1, '2023-10-19 07:49:04', 0, 'd034f67723bfffcc3ed1b1b90d288913', NULL),
(104, 'comy', 'comy', 'comy', 'comy@gmail.com', NULL, NULL, '123456', '123456', 'ww', 'الرياض', 'ed', '1999', '8', '1', '5', 'عمل مكتبي', '9000', '100', NULL, NULL, '0', '0', '0', 1, '2023-10-19 09:08:07', 0, '3f0f39a6042c2aafe1e46d3fd31a8f8d', NULL),
(106, 'rewan', 'rewan', 'rewan', 'camadoh716@wermink.com', NULL, NULL, '123456', '123456789098', 'rr', 'الرياض', 'rr', '2000', '8', '1', '2', 'عمل مكتبي', '5400', '200', NULL, NULL, '1', '0', '-949', 1, '2023-10-19 11:21:50', 0, '8145ca3b64dfe1f1c551e994c5c20fe9', NULL),
(107, 'نماء', 'NAMAA', 'Sayed', 'sqc.acc@gmail.com', NULL, NULL, '123456', '369852147', 'النشر والتوزيع', 'الرياض', 'المدينة، مكة، الرياض', '2020', '2:8', '2', '3', 'عمل مكتبي', '10000', '5', NULL, NULL, '1', '0', '2', 1, '2023-10-23 14:19:52', 0, 'c45ff6953e85a43c3e39453f398bf45d', NULL),
(108, 'Vodafone', 'Sebastian Henry', 'Vodafone', 'nafiguz@mailinator.com', NULL, NULL, '12345678', 'Labore commodo quide', 'Aut et minima eos s', 'القنفذة', 'Aut et veniam nisi', 'Dolor soluta velit', 'Minus inventore adip', 'Magni magnam est qu', 'Ipsa laboris est fa', 'عمل مكتبي', 'Sunt in sed vero ut', 'Irure eum nemo cupid', NULL, NULL, '1', '0', '-949', 1, '2023-10-24 07:57:32', 0, 'b0ddcefe7344a4a7186806e4a8c46fbe', NULL),
(109, 'Etisalat', 'Isabelle Bartlett', 'Etisalat', 'hady@mailinator.com', NULL, NULL, '12345678', 'Earum repudiandae at', 'Atque qui impedit f', 'خميس مشيط', 'Neque ullamco dolore', 'Sit qui est ipsum', 'Voluptas voluptas nu', 'Rerum ducimus repel', 'Dolore proident num', 'عمل مكتبي', 'Sint deserunt deseru', 'Cupidatat quaerat qu', NULL, NULL, '1', '0', '1', 1, '2023-10-24 08:19:06', 0, 'bda65e0e3354e99f168ab6bdf0b89832', NULL),
(110, 'GOLD&#039;s GYM', 'GOLD&#039;s GYM', 'GOLD', 'contact@gold.com', NULL, NULL, '123456', '369852147', 'FITNESS', 'جدة', 'المدينة، مكة، الرياض، جدة', '2020', '12:12', '5', '5', 'عمل ميداني', '10000', '5', NULL, NULL, '0', '0', '0', 1, '2023-10-24 08:49:00', 0, '9738a2706cdb548976945b2c8ae36ca1', NULL),
(111, 'GOLD&#039;s GYM', 'GOLD&#039;s GYM', 'GOLD&#039;s GYM', 'contact@goldsgym.com', NULL, NULL, '123456', '369852147', 'FITNESS', 'مكة', 'المدينة، مكة، الرياض، جدة', '2020', '12:12', '5', '5', 'عمل مكتبي', '10000', '5', NULL, NULL, '1', '0', '1', 1, '2023-10-24 08:50:07', 0, '3c7846293e227bdfa2816d4565e5eaa2', NULL),
(112, 'we', 'Cheryl Oneil', 'we', 'jafu@mailinator.com', NULL, NULL, '12345678', 'Voluptate magnam ame', 'Occaecat aliquip vol', 'الدمام', 'Et incidunt lorem a', 'Lorem minus molestia', 'Veritatis sit aute', 'Qui sit aute expedit', 'Non perferendis aut', 'عمل ميداني', 'Voluptatibus at natu', 'Quo voluptatem Inci', NULL, NULL, '1', '0', '1', 1, '2023-10-24 09:16:02', 0, '2cf764c6db3ea316da8e3a4b80fb245f', NULL),
(113, 'ركن الدلال', 'Roken aldalal', 'rokenaldalal', 'rokenaldalal@outlook.sa', '05329820555', NULL, 'hanouf5501562', '1122299444', 'صالون تزيين', 'الرياض', '3', '1995', '8 ساعات', '2', '1', 'عمل ميداني', '5000', 'غير محدد', NULL, NULL, '1', '0', '1000', 1, '2023-12-19 17:23:51', 1, '39174', NULL),
(114, 's', 's', 'sssss', 'sss@ss.s', '15', NULL, 's', 's', 's', 'جدة', 's', 's', 's', 's', 's', 'عمل ميداني', 's', 's', NULL, NULL, '0', '0', '0', 1, '2023-12-24 08:12:25', 0, '12794', NULL),
(115, 'Kelly Berg', 'Virginia Wolf', 'recity', 'fumoxyn@mailinator.com', '5547587878', NULL, '12345678', 'Et aut est soluta la', 'Ullam eos et nihil e', 'المدينة المنورة', 'Rerum dolor inventor', 'Facere est cupidatat', 'Similique minima nul', 'Aut animi consequat', 'Quia dolore vel blan', 'عمل ميداني', 'Laboriosam error qu', 'Nulla quaerat in qui', NULL, NULL, '0', '0', '0', 1, '2023-12-25 11:39:37', 0, '36013', NULL),
(116, 'Cathleen Herman', 'Samson Mcintosh', 'fixogeh', 'lutrilorzo@gufum.com', '545454754', NULL, '12345678', 'Modi ea soluta obcae', 'Labore minima at max', 'القطيف', 'Veritatis consectetu', 'Modi sunt amet por', 'Placeat aut volupta', 'Ad ipsa deserunt no', 'Id labore sapiente o', 'عمل ميداني', 'Laborum Ducimus fu', 'Facilis sunt rerum N', NULL, NULL, '1', '0', '1', 1, '2023-12-25 11:41:07', 1, '9985', NULL),
(117, 'QULACOM', 'QULACOM', 'QULACOM', 'bowed31646@vkr1.com', '010968848451', NULL, '12345678', '654987321', 'الاتصالات', 'الرياض', 'الرياض، جدة', '2000', '8 ل 10', '4', '3', 'عمل مكتبي', '5000', '3.5', 'Breakthrough innovations, real-world technology insights, and thought leadership from voices across Qualcomm.', NULL, '1', '0', '1', 1, '2023-12-25 12:15:52', 1, '37790', NULL),
(120, 'ORANGE', 'ORANGE', 'ORANGE', 'jimegab152@wikfee.com', '32165498777', NULL, '12345678', '32165498755', 'الاتصالات', 'الرياض', 'الرياض وجدة', '2000', '5', '2', '2', 'عمل مكتبي', '20000', '5', NULL, NULL, '0', '0', '1', 1, '2023-12-26 09:01:51', 1, '48052', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_review`
--

CREATE TABLE `company_review` (
  `rev_id` int NOT NULL,
  `com_id` int NOT NULL,
  `ind_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `com_review` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `rev_show` int NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_review`
--

INSERT INTO `company_review` (`rev_id`, `com_id`, `ind_id`, `com_review`, `rev_show`, `date`) VALUES
(37, 112, '176', 'rate entiqa', 1, '2023-10-25 02:37:05'),
(38, 112, '160', 'eeeeee', 1, '2023-10-25 02:43:47'),
(44, 116, '168', 'تم التقييم', 1, '2023-12-26 03:03:59');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `con_id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_noti` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`con_id`, `first_name`, `last_name`, `email`, `mobile`, `message`, `date`, `admin_noti`) VALUES
(1, 'mohamed', 'ramadan', 'mr319242@gmail.com', '', 'السلام عليكم ورحمة الله', '', 1),
(2, 'mohamed', 'ramadan', 'mr319242@gmail.com', '', 'السلام عليكم ورحمة الله', '', 1),
(3, 'mohamed', 'ramadan', 'mr319242@gmail.com', '', '4ص5ص', '', 1),
(5, 'hassan', '', '', '', '', '', 1),
(6, 'الهنوف', 'سعد', 'alhanouf.alqhtani@hotmail.com', '', 'سلام عليكم\r\n تم الدفع للمنصة ولم يتم التفعيل ولا التواصل ', '', 1),
(8, 'خالد ', 'عبدالله', 'khalid.abdallaj@hotmail.com', '0532982054', 'السلام عليكم ممكن احد يتواصل معاي حاب استفسر', '', 1),
(9, 'Raleigh Godley', 'Raleigh Godley', 'raleigh.godley@gmail.com', '260-403-5290', '', '', 1),
(10, '', '', '', '', '', '', 1),
(11, '', '', '', '', '', '', 1),
(12, '', '', '', '', '', '', 1),
(13, '', '', '', '', '', '', 1),
(14, '', '', '', '', '', '', 1),
(15, '', '', '', '', '', '', 1),
(16, '', '', '', '', '', '', 1),
(17, '', '', '', '', '', '', 1),
(19, '', '', '', '', '', '', 1),
(20, '', '', '', '', '', '', 1),
(21, '', '', '', '', '', '', 1),
(22, '', '', '', '', '', '', 1),
(23, '', '', '', '', '', '', 1),
(24, '', '', '', '', '', '', 1),
(25, '', '', '', '', '', '', 1),
(26, 'mohamed', 'mohamed', 'moelsaygh7@gmail.com', '047987975822', 'اهلا بكم ', '', 1),
(27, '', '', '', '', '', '', 1),
(28, '', '', '', '', '', '', 1),
(29, '', '', '', '', '', '', 1),
(30, '', 's', 's@gmail.com', 's', 's', '', 1),
(31, '', '', 's@gmail.com', '', '', '', 1),
(32, '', 's', 's@gmail.com', 's', 's', '', 1),
(33, 's', '', 's@gmail.com', 's', 's', '', 1),
(34, 'mohamed', 's', 's@gmail.com', '047987975822', '', '', 1),
(35, 'mohamed', 's', '', '047987975822', 's', '', 1),
(36, 's', 's', 's@gmail.com', '', 's', '', 1),
(37, '', '', '', '', '', '', 1),
(38, '', '', '', '', '', '', 1),
(39, '', '', '', '', '', '', 1),
(41, '', '', '', '', '', '', 1),
(42, '', '', '', '', '', '', 1),
(43, '', '', '', '', '', '', 1),
(44, '', '', '', '', '', '', 1),
(45, '', '', '', '', '', '', 1),
(46, '', '', '', '', '', '', 1),
(47, '', '', '', '', '', '', 1),
(48, '', '', '', '', '', '', 1),
(49, '', '', '', '', '', '', 1),
(50, '', '', '', '', '', '', 1),
(51, '', '', '', '', '', '', 1),
(52, '', '', '', '', '', '', 1),
(53, '', '', '', '', '', '', 1),
(54, 'ss', 'ss', 's@gmail.com', 's', 'ssss', '', 1),
(55, 'ss', 'ss', 's@gmail.com', 's', 'ssss', '', 1),
(56, 'ss', 'ss', 's@gmail.com', 's', 'ssss', '', 1),
(57, '', '', '', '', '', '', 1),
(58, '', '', '', '', '', '', 1),
(59, '', '', '', '', '', '', 1),
(60, 'mohamed', 's', 's@gmail.com', '047987975822', 'hh', '', 1),
(61, 'mohamed', 's', 's@gmail.com', '047987975822', 'hh', '', 1),
(62, 'dd', 'dd', 'dd@gmail.com', '047987975822', 'dddd', '', 1),
(63, 'dd', 'dd', 'dd@gmail.com', '047987975822', 'dddd', '', 1),
(64, 'dd', 'dd', 'dd@gmail.com', '047987975822', 'dddd', '', 1),
(65, 'cx', 'f', 's@gmail', 'f', 'f', '', 1),
(66, 'mohamed', 'mohamed', 'moelsaygh7@gmail.com', '12345678899', 'fff', '', 1),
(68, 'mohamed', '', 'moelsaygh7@gmail.com', '12345678899', 'd', '', 1),
(69, '', 'd', 'mo@gmail.com', '12345678899', 's', '', 1),
(70, 's', 's', '', '12345678899', 's', '', 1),
(71, 'd', 'd', 's@gmail.com', '047987975822', '', '', 1),
(72, 'd', 'd', 's@gmail.com', '047987975822', '', '', 1),
(73, '', '', '', '', '', '', 1),
(74, '', '', '', '', '', '', 1),
(75, '', '', '', '', '', '', 1),
(76, '', '', '', '', '', '', 1),
(77, '', '', '', '', '', '', 1),
(78, '', '', '', '', '', '', 1),
(79, '', '', '', '', '', '', 1),
(80, 'a', 'a', 'a@gmail.com', 'a', 'a', '', 1),
(81, 'a', 'a', 'a@gmail.com', 'a', 'a', '', 1),
(83, 'a', 'a', 'a@gmail.com', 'a', 'a', '', 1),
(84, 'a', 'a', 'a@gmail.com', 'a', 'a', '', 1),
(86, 'a', 'a', 'a@gmail.com', 'a', 'a', '', 1),
(90, 'ahmad ', 'ali', 'ali@gmail.com', '1234566', 'test', '', 1),
(91, 'ali', 'ali', 'user_38@gmail.com', '10234444', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,', '', 1),
(92, 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,', 'info@targemly.com', '1234566', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis,', '', 1),
(94, 'mohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmoh', 'mohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmoh', 'mr312893@gmail.com', '01011642731', 'mohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmohamedmoh', '', 1),
(95, 'rawan', 'tarek', 'rawantare770@gmail.com', '1055559449', 'السلام عليكم اود الاستفسار عن شئ', '2023-12-25', 1),
(96, 'rawan', 'tarek', 'rawantare770@gmail.com', '1055559449', 'رسالة الى الادمن من المتدرب ', '2023-12-25', 1),
(97, 'ALazhar', 'hospital', 'test@gmail.com', '0512369888', ',hkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', '2023-12-25', 1),
(98, 'sd', 'ds', 'mr@gmail.com', '01011642731', 'asasssaasasasassdsdsds', '2023-12-26', 1),
(99, 'NNNNN', 'NNNNN', 'NNNN@gmail.com', '1545724547', 'testing messages testing messagestesting messagestesting messages', '2023-12-26', 1),
(100, '854354', '88', '8888@gmail.com', '88888', '8888888888888888888888888888888888', '2023-12-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contract_cancel`
--

CREATE TABLE `contract_cancel` (
  `con_cancel_id` int NOT NULL,
  `company_id` int NOT NULL,
  `ind_id` int NOT NULL,
  `cancel_reason` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender` int NOT NULL DEFAULT '0',
  `recieve` int NOT NULL DEFAULT '0',
  `update_at` varchar(300) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `cancel_com_admin` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contract_cancel`
--

INSERT INTO `contract_cancel` (`con_cancel_id`, `company_id`, `ind_id`, `cancel_reason`, `date`, `sender`, `recieve`, `update_at`, `cancel_com_admin`) VALUES
(14, 62, 148, 'كدا ', '2023-10-18 08:39:32', 148, 0, '23-10-18', 1),
(15, 62, 148, '', '2023-10-18 10:00:39', 148, 0, '0', 1),
(16, 101, 147, '', '2023-10-19 03:07:56', 0, 0, '23-10-19', 1),
(17, 101, 147, '', '2023-10-19 03:09:11', 147, 0, '23-10-19', 1),
(18, 105, 142, '', '2023-10-19 05:41:50', 0, 0, '23-10-19', 1),
(19, 105, 142, '', '2023-10-19 05:42:34', 0, 0, '23-10-19', 1),
(20, 108, 194, '', '2023-10-24 04:06:28', 194, 0, '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contract_complete`
--

CREATE TABLE `contract_complete` (
  `con_com_id` int NOT NULL,
  `company_id` int NOT NULL,
  `ind_id` int NOT NULL,
  `con_com_price` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `con_com_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sender` int DEFAULT NULL,
  `recieve` int DEFAULT NULL,
  `update_at` varchar(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `con_com_admin` int NOT NULL DEFAULT '0',
  `ind_noti` int NOT NULL DEFAULT '0',
  `com_noti` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contract_complete`
--

INSERT INTO `contract_complete` (`con_com_id`, `company_id`, `ind_id`, `con_com_price`, `con_com_date`, `sender`, `recieve`, `update_at`, `con_com_admin`, `ind_noti`, `com_noti`) VALUES
(24, 2, 131, '100', '2023-06-11 07:06:27', NULL, NULL, '23-06-11', 1, 0, 0),
(25, 3, 136, '100', '2023-06-26 15:28:04', NULL, NULL, '23-06-26', 1, 0, 0),
(26, 29, 165, '950', '2023-08-11 18:01:06', NULL, NULL, '23-08-11', 1, 0, 0),
(27, 30, 171, '950', '2023-08-13 07:08:05', NULL, NULL, '23-08-13', 1, 0, 0),
(28, 48, 154, '950', '2023-10-10 03:45:40', NULL, NULL, '23-10-10', 1, 0, 0),
(29, 62, 148, '950', '2023-10-18 09:58:08', NULL, NULL, '23-10-18', 1, 0, 0),
(30, 99, 159, '950', '2023-10-19 03:57:11', NULL, NULL, '23-10-19', 1, 0, 0),
(31, 101, 147, '950', '2023-10-19 04:45:18', NULL, NULL, '0', 1, 0, 0),
(32, 106, 142, '950', '2023-10-19 08:53:22', NULL, NULL, '0', 1, 0, 0),
(33, 105, 142, '950', '2023-10-19 08:53:41', NULL, NULL, '0', 1, 0, 0),
(34, 108, 194, '950', '2023-10-24 04:05:39', NULL, NULL, '0', 1, 0, 0),
(35, 116, 209, '1', '2023-12-25 06:50:34', NULL, NULL, '23-12-25', 1, 0, 0),
(36, 116, 215, '1', '2023-12-25 08:55:34', NULL, NULL, '0', 1, 0, 0),
(37, 121, 211, '1', '2023-12-26 05:12:23', NULL, NULL, '23-12-26', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coshes`
--

CREATE TABLE `coshes` (
  `co_id` int NOT NULL,
  `co_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `co_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `co_phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `co_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `co_services` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `co_exper` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pass_code` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coshes`
--

INSERT INTO `coshes` (`co_id`, `co_name`, `co_password`, `co_phone`, `co_email`, `co_services`, `co_exper`, `pass_code`) VALUES
(1, 'المدرب الاول  بعد التعديل', 'new', '01011642731', 'mr319242@gmail.com', 'مقدم خدمات ', '4', NULL),
(3, 'new', 'new', '100000100', 'بسلايب', 'ds', '10', NULL),
(4, 'mai', 'mai', '1111', 'mai@gmail.com', 'تدريب ', '10', NULL),
(5, 'أحمد حسين ', '5501562', '', 'newnew_2023@outlook.com', '', '5', NULL),
(8, 'Abdallah', 'hanouf5501562', '+966532982054', 'abdalla@gmail.com', 'مبيعات ', '5', NULL),
(9, 'Coach_Ahmad', '5501562', '0500054342', 'remot_2023@outlook.com', 'مدرب مبيعات', '10', NULL),
(10, 'mahmoud ahmed', '123456789', '0105677745', 'mmm@gmail.com', '2', '200', NULL),
(11, 'mahmoud ahmed', '123456789', '0105677745', 'mmm@gmail.com', '2', '200', NULL),
(12, 'mahmoud ahmed', '123456789', '0105677745', 'mmm@gmail.com', '2', '200', NULL),
(13, 'mahmoud ahmed', '123456789', '0105677745', 'mmm@gmail.com', '2', '200', NULL),
(15, 'aal', '123456', '12345678', 'a@gmail.com', '', '3', NULL),
(16, 'aa', '123456', '12345678', 'a@gmail.com', 'aa', '12', NULL),
(17, 'Ramy Saleh', '123456', '12345679', 'Tasnem.softzone@gmail.com', 'training', '5', NULL),
(18, 'updated rawan', '123456', '52587778', 'rawan@gmail.com', 'مدرب', '3', NULL),
(19, 'روان ', '123456', '12345678', 'aya@gmail.com', 'تدريب ', '2', NULL),
(20, 'ايه ', '123456', '12345678', 'aya1@gmail.com', 'تدريب ', '10', NULL),
(21, 'mohamed ', '123456', '12345678', 'mohamed@gmail.com', 'تدريب ', '10', NULL),
(23, 'new trainer ', '123456', '123456', 'newtrainer@gmail.com', 'tttt', '11', NULL),
(24, 'osama', 'osama', 'osama', 'osama@gmail.com', 'التدريب', '5', NULL),
(25, 'Trainer', '12345', '966369852147', 'trainer@gmail.com', 'التدريب', '5', NULL),
(26, 'mohamed M', '123456', '125578787758', 'rawan@gmail.com', 'مدرب', '11', NULL),
(27, 'ahmed', '               ', '            ', 'ahmd@gmail.com', '         ', '1', NULL),
(28, 'a', ' ', '', '', '', '', NULL),
(29, '.', '1', '', '', '', '', NULL),
(30, 'q', 'q', '', '', '', '', NULL),
(31, 'zain', 'zain', 'zain', 'mmm@gmail.com', 'training ', '1', NULL),
(32, 'ahmad ', '123', '123456', 'mmm@gmail.com', 'ser', '1', NULL),
(33, 'fatma', '123', '12345', 'hocid31336@wermink.com', '', '', NULL),
(34, 'ali ', '1234', '966369852147', 'hocid31336@wermink.com', 'ser', '12', NULL),
(35, 'ali', '          ', '123456789', 'ahmd@gmail.com', 'ser', '-12', NULL),
(36, '     ', '         ', '         ', '', '          ', '', NULL),
(37, 'Mohmmed ', '12345', '966369852147', 'hocid31336@wermink.com', 'training ', '10', NULL),
(38, 'ahmad ', '123', '966369852147', 'hocid31336@wermink.com', 'training ', '1', NULL),
(39, 'mena', '123456', '52587778', 'mena@gmail.com', 'مدرب', '3', NULL),
(40, 'ali', 'ali', '966369852147+', 'mmm@gmail.com', 'training ', '1', NULL),
(41, 'ahmad ', '123', '', '', '', '', NULL),
(42, 'ahmad ', '123', '', '', '', '', NULL),
(43, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '2', NULL),
(44, 'mona', '12345678', '12345678', 'menna@gmail.com', 'tttt', '1', NULL),
(45, 'mohamed', '11111111', '01011642731', 'mr319242@gmail.com', 'مقدم خدمات ', '2', NULL),
(46, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '1', NULL),
(47, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '1', NULL),
(48, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '1', NULL),
(49, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '1', NULL),
(50, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '1', NULL),
(51, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '1', NULL),
(52, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '1', NULL),
(53, 'ahmad ', '123', '966369852147', 'mmm@gmail.com', 'training ', '1', NULL),
(54, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(55, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(56, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(57, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(58, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(59, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(60, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(61, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(62, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(63, 'test duplicated ', '123', '123456', 'hocid31336@wermink.com', 'training ', '11', NULL),
(66, 'Ramy Salahh', '123456789', '856456464', 'Ramyy@gmail.com', 'training', '5', NULL),
(69, 'abdelrahman', '12345678', '02589637', 'abdelrahman@gmail.com', 'training', '5', NULL),
(72, 'sssssssssss', 'sssssssssss', 'ssssssss', 'ss@sss.com', 'ssssss', '5', NULL),
(73, 'ahmedahmed', '12345678', '12336655444', 'ahmedk@gmail.com', 'training and media', '5', NULL),
(74, 'trtrtr', '123456as', '1020405060', 'fatmaaalzharaa@gmail.com', 'training', '12', NULL),
(75, 'sdsfsfsff', '12345qwr', '123131434', 'fatmaalzhar.softzone@gmail.com', 'training', '1', NULL),
(76, 'saffa', 'safa1234', '10306052002', 'safa@gmail.com', 'training', '1', NULL),
(77, 'mohamedOsama', '12345678', '5555555555', 'sendingsoftzonesz@gmail.com', 'training and media', '5', NULL),
(80, 'new member', 'fatma0100', '105039494545', 'rikalik812@wenkuu.com', 'training', '5', NULL),
(81, 'sendingsoftzonesz@gmail.com', 'fatma0100', '123456789461212', 'dgdg@gmail.com', 'training', '7', NULL),
(82, 'vvvvv', '12345678', '12345666', 'vv2@nn.vv', 'vvvvv', '1', NULL),
(83, 'CCCDCC', '12345678', 'ADSWEW3E', 'SAS@GMAIL.COM', 'SASFRR', '1', NULL),
(84, 'john.doe@sub.example.com', '12345678', '050236987854', 'john.doe@sub.example.com', 'training', '7', NULL),
(85, 'user@.example.com', '12345678', '123459647654', 'user@example', 'training', '4', NULL),
(87, 'fatmaalzharaa', '12345678', 'fatmaalzharaa', 'fatmaalzhar.smmoftzone@gmail.com', 'training', '20', NULL),
(88, 'ddfatmaalzharaa', '12345678', 'fatmaalzharaac', 'fatmaalzhar.sooftzone@gmail.com', 'training', '5', NULL),
(89, 'tatas', '12345678', 'dddddddd', 'fatmaalzzhar.socoftzone@gmail.com', 'training', '5', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `ex_id` int NOT NULL,
  `ex_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ex_total_question` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ex_time` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ex_date_publish` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ex_desc` text COLLATE utf8mb4_general_ci,
  `ex_type` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `ex_batch_num` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `coash_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`ex_id`, `ex_title`, `ex_total_question`, `ex_time`, `ex_date_publish`, `ex_desc`, `ex_type`, `ex_batch_num`, `coash_id`) VALUES
(13, 'الاختبار التجريبي ', '5', '10', '2023-06-08', 'للتجربه ', 'قصير', '5', NULL),
(16, 'الاختبار النهائي ', '6', '1', '2023-06-11', 'اختبار نهائي للطلاب المرحلة الاولى ', 'نهائي', '5', NULL),
(23, 'الاختبار الثاني ', '2', '10', '2023-06-19', NULL, 'نهائي', '5', NULL),
(27, 'الاختبار الاول ', '2', '3', '2023-06-19', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(30, 'الاختبار الاول ', '2', '10', '2023-06-21', NULL, 'قصير', '-- اختر رقم الدفعه --', 7),
(34, 'أختبار  كيفية تحديد عميلك و فهم مشاكله. ', '3', '15', '2023-08-11', NULL, 'قصير', '6', 8),
(35, 'مبادئ مبيعات', '2', '5', '2023-08-13', NULL, 'قصير', '7', 8),
(36, 'مبادئ مبيعات', '1', '1', '2023-08-15', NULL, 'قصير', '-- اختر رقم الدفعه --', 8),
(37, 'اختبار قصير', '10', '5', '2023-08-20', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(38, 'r', '4', '4', '2023-08-22', NULL, 'نهائي', '6', 3),
(40, 'aa', '4', '3', '2023-09-10', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(41, 'aa', '1', '1', '2023-09-10', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(42, 'aa', '1', '1', '2023-09-10', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(43, 'اختبار جودة المتصفح ', '5', '1', '2023-09-26', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(44, 'اختبار جودة المتصفح ', '5', '2', '2023-09-25', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(45, 'اختبار جودة المتصفح ', '3', '3', '2023-09-26', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(46, 'اختبار جديد ', '2', '10', '2023-09-27', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(47, 'اختبار جودة المتصفح ', '4', '3', '2023-09-27', NULL, 'نهائي', '-- اختر رقم الدفعه --', 19),
(48, 'اختبار جودة المتصفح ', '3', '3', '2023-09-27', NULL, 'نهائي', '14', NULL),
(49, 'اختبار جودة المتصفح ', '3', '3', '2023-09-27', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(50, 'اختبار جودة المتصفح ', '3', '5', '2023-10-09', NULL, 'قصير', '14', 18),
(51, 'اختبار جودة المتصفح ', '5', '5', '2023-10-09', NULL, 'قصير', '14', 18),
(53, 'exama', '5', '10', '2023-10-10', NULL, 'تحديد المستوي', '21', NULL),
(54, '                          ', '1', '3', '2023-09-18', NULL, 'تحديد المستوي', '23', 18),
(57, 'اختبار جودة المتصفح اختبار جودة المتصاختبار جودة المتصفح اختبار جودة المتصفح اختبار جودة المتصفح اختبار جودة المتصفح اختبار جودة المتصفح اختبار جودة المتصفح اختبار جودة المتصفح اختبار جودة المتصفح اختبار جودة المتصفح اختبار جودة المتصفح فحاختبار جودة المت', '5', '10', '2023-10-10', NULL, 'قصير', '23', 18),
(58, 'final', '5', '15', '2023-08-20', NULL, 'نهائي', '23', 18),
(60, 'aa', '-20', '1', '0200-10-10', NULL, 'نهائي', '23', 18),
(61, 'assessment ', '1', '0', '2023-10-10', NULL, 'نهائي', '23', 18),
(64, 'dd', '1', '0', '2023-10-10', NULL, '-- اختر توع الاختبار --', '-- اختر رقم الدفعه --', 18),
(65, 'test exam type ', '2', '10', '2023-10-10', NULL, '-- اختر توع الاختبار --', '-- اختر رقم الدفعه --', 18),
(66, 'test exam type	', '1', '1', '2023-10-10', NULL, '-- اختر توع الاختبار --', '7', 18),
(67, 'اختبار جديد تست ', '10', '3', '2023-10-11', NULL, 'قصير', '23', 18),
(68, 'اختبار جديد مهم جدا', '20', '1', '2023-10-17', NULL, 'قصير', '20', 18),
(69, 'اختبار جديد 1', '10', '10', '2023-10-11', NULL, 'قصير', '8', 18),
(70, 'exam', '1', '2', '2023-02-01', NULL, 'قصير', '-- اختر رقم الدفعه --', 18),
(71, 'اختبار جديد ', '1', '1', '2023-10-10', NULL, 'قصير', '-- اختر رقم الدفعه --', 18),
(72, 'اختبار جديد ', '1', '1', '2023-10-10', NULL, 'قصير', '-- اختر رقم الدفعه --', 18),
(73, 'اختبار جديد ', '1', '1', '2023-10-11', NULL, 'نهائي', '-- اختر رقم الدفعه --', 18),
(74, 'اختبار جديد ', '1', '1', '2023-10-11', NULL, 'تحديد المستوي', '-- اختر رقم الدفعه --', 18),
(75, 'اختبار جديد ', '1', '1', '2023-10-11', NULL, 'نهائي', '-- اختر رقم الدفعه --', 18),
(76, 'اختبار جديد ', '1', '1', '2023-10-12', NULL, 'نهائي', '-- اختر رقم الدفعه --', 18),
(77, 'اختبار جديد ', '1', '1', '2023-10-12', NULL, 'نهائي', '-- اختر رقم الدفعه --', 18),
(78, 'exam', '4', '03', '2023-10-18', NULL, '-- اختر توع الاختبار --', '-- اختر رقم الدفعه --', 23),
(79, '              ', '1', '1', '2023-10-18', NULL, 'قصير', '25', 23),
(81, '@@', '1', '0', '2023-10-18', NULL, '-- اختر توع الاختبار --', '-- اختر رقم الدفعه --', 23),
(83, '..', '3', '1', '2023-10-18', NULL, 'قصير', '25', 23),
(84, 'test time ', '1', '0', '2023-10-18', NULL, 'قصير', '25', 23),
(86, 'exam', '1', '131', '2023-10-18', NULL, 'نهائي', '-- اختر رقم الدفعه --', 23),
(87, 'aa', '1', '1', '0001-10-18', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(88, 'اختبار جديد ', '3', '2', '2023-10-18', NULL, 'قصير', '25', 23),
(89, 'testr', '2', '2', '2023-10-25', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(90, 'testr', '2', '2', '2023-10-25', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(91, 'kk', '1', '1', '2023-10-12', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(93, 'اختبار جديد مهم جدا', '3', '6', '2023-10-12', NULL, 'نهائي', '21', 23),
(94, ' rawan exam', '2', '2', '2023-10-18', NULL, 'قصير', '25', 18),
(95, 'test date ', '11', '20', '2023-10-30', NULL, 'تحديد المستوي', '22', 23),
(96, 'test date ', '11', '20', '2023-10-25', NULL, 'تحديد المستوي', '8', 23),
(97, 'test du', '12', '22', '2023-10-25', NULL, '-- اختر توع الاختبار --', '8', 23),
(98, 'الادمن', '10', '10', '2023-10-18', NULL, '-- اختر توع الاختبار --', '25', 23),
(99, 'exam', '2', '3', '2023-10-12', NULL, 'قصير', '25', 23),
(100, 'اختبار جديد مهم  ', '20', '2', '2023-10-25', NULL, 'نهائي', '25', 23),
(101, '..', '900000000000000000000000000000000000000000000000000000000000000000000000000000000', '11', '2023-10-18', NULL, '-- اختر توع الاختبار --', '-- اختر رقم الدفعه --', 23),
(102, 'New quiz 2', '1', '2', '2023-10-18', NULL, '-- اختر توع الاختبار --', '25', 23),
(103, 'testdtt', '11', '11', '2023-10-18', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(105, 'امتحان', '2', '1', '2023-10-18', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(106, 'امتحان', '1', '1', '2023-10-18', NULL, 'نهائي', '-- اختر رقم الدفعه --', 23),
(107, 'test auth ', '5', '5', '2023-10-19', NULL, 'قصير', '25', 23),
(109, 'test choices ', '2', '3', '2023-10-19', NULL, 'قصير', '25', 23),
(110, 'test choices 2', '1', '1', '2023-10-19', NULL, 'نهائي', '25', 23),
(111, 'test choices 3', '1', '2', '2023-10-19', NULL, 'قصير', '25', 23),
(112, 'final question ', '2', '1', '2023-10-19', NULL, 'نهائي', '25', 23),
(114, 'new test exam ', '1', '2', '2023-10-19', NULL, 'تحديد المستوي', '25', 23),
(115, 'New quiz 2', '1', '2', '2023-10-23', NULL, 'نهائي', '25', 23),
(116, 'اختبار جديد', '10', '10', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(117, 'اختبار قصير', '5', '5', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(118, 'new test', '5', '20', '2023-12-24', NULL, 'نهائي', '-- اختر رقم الدفعه --', 23),
(119, 'اختبار قصير', '3', '5', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(120, 'new test', '2', '5', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(121, 'اختبار طو يل', '2', '5', '2023-12-24', NULL, 'نهائي', '-- اختر رقم الدفعه --', 23),
(122, 'اختبار مهم', '2', '5', '2023-12-24', NULL, 'تحديد المستوي', '-- اختر رقم الدفعه --', 23),
(123, 'اختبار جديد', '3', '5', '2023-12-25', NULL, 'تحديد المستوي', '-- اختر رقم الدفعه --', 23),
(124, 'اختبار قصير', '3', '5', '2023-12-24', NULL, 'تحديد المستوي', '-- اختر رقم الدفعه --', 23),
(125, 'edit test', '10', '5', '2023-12-27', NULL, '-- اختر توع الاختبار --', '-- اختر رقم الدفعه --', 23),
(126, 'test', '3', '5', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(127, 'اختبار قصير', '4', '5', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(128, 'new exam', '6', '7', '2023-12-25', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(129, 'test', '7', '12', '2023-12-24', NULL, 'نهائي', '-- اختر رقم الدفعه --', 23),
(131, 'اختبار', '3', '10', '2023-12-24', NULL, '-- اختر توع الاختبار --', '-- اختر رقم الدفعه --', NULL),
(132, 'اختبار مهم', '2', '5', '2023-12-24', NULL, 'تحديد المستوي', '-- اختر رقم الدفعه --', 23),
(133, 'test exam', '10', '5', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(134, 'اختبار مهم جدا جدا', '2', '5', '2023-12-25', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(135, 'new exam new exam new exam new exam new exam new e', '1', '5', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(136, 'ميدتيرم', '2', '10', '2023-12-24', NULL, 'قصير', '-- اختر رقم الدفعه --', 18),
(137, 'tet', '20', '10', '2023-12-24', NULL, '-- اختر توع الاختبار --', '-- اختر رقم الدفعه --', NULL),
(138, 'اختبار قصير', '2', '5', '2023-12-25', NULL, 'قصير', '-- اختر رقم الدفعه --', 20),
(139, 'اختبار', '3', '5', '2023-12-25', NULL, 'قصير', '-- اختر رقم الدفعه --', 20),
(140, 'اختبار قصير', '2', '5', '2023-12-25', NULL, 'قصير', '-- اختر رقم الدفعه --', NULL),
(141, 'الاختبار الاول', '2', '6', '2023-12-26', NULL, 'قصير', '-- اختر رقم الدفعه --', 1),
(142, 'test', '5', '10', '2023-12-26', NULL, 'قصير', '27', 23),
(143, 'test', '6', '7', '2023-12-26', NULL, 'قصير', '36', 23),
(144, 'اختبار مهم', '3', '5', '2024-01-02', NULL, 'قصير', '36', 23),
(145, 'mm', '3', '9', '2023-12-26', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(146, 'm', '2', '14', '2023-12-26', NULL, 'قصير', '-- اختر رقم الدفعه --', 23),
(147, 'm', '3', '11', '2023-12-26', NULL, 'نهائي', '-- اختر رقم الدفعه --', 23),
(148, 'fgfgfg', '2', '6', '2023-12-30', NULL, 'قصير', '-- اختر رقم الدفعه --', 4),
(149, 'dfdfdff', '2', '5', '2023-12-30', NULL, 'نهائي', '-- اختر رقم الدفعه --', 4),
(150, 'اال', '2', '8', '2023-12-30', NULL, 'تحديد المستوي', '-- اختر رقم الدفعه --', 4);

-- --------------------------------------------------------

--
-- Table structure for table `exam_noti`
--

CREATE TABLE `exam_noti` (
  `id` int NOT NULL,
  `ex_id` int NOT NULL,
  `ind_id` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ind_congrat`
--

CREATE TABLE `ind_congrat` (
  `id` int NOT NULL,
  `ind_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ind_congrat`
--

INSERT INTO `ind_congrat` (`id`, `ind_id`, `name`, `description`, `status`, `date`) VALUES
(1, 130, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-06-19 16:19:41'),
(2, 127, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-06-19 16:20:34'),
(3, 136, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-07-03 07:59:24'),
(4, 165, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-08-11 16:36:47'),
(5, 171, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-08-13 10:50:16'),
(6, 159, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-10-10 05:46:41'),
(7, 174, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-10-10 05:47:22'),
(8, 154, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-10-10 07:23:08'),
(9, 187, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-10-10 07:37:46'),
(10, 146, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-10-10 09:36:28'),
(11, 148, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-10-18 12:20:10'),
(12, 142, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-10-18 14:12:09'),
(13, 163, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-10-19 07:08:24'),
(14, 195, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-10-19 08:25:58'),
(15, 194, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-10-19 08:45:01'),
(16, 152, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-10-19 13:21:15'),
(17, 177, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-10-19 13:30:34'),
(18, 141, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-10-24 07:06:42'),
(19, 151, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-10-24 09:21:57'),
(20, 168, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-12-24 13:33:52'),
(21, 215, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-12-25 09:05:24'),
(22, 209, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 1, '2023-12-25 11:47:41'),
(23, 211, 'تأهيل', ' مبروك تم تأهيلك معنا في المنصة , يمكنك مشاهدة النتائج في صفحتك مع الشهادة المستحقة المرفقه لديك  ', 0, '2023-12-26 10:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `ind_register`
--

CREATE TABLE `ind_register` (
  `ind_id` int NOT NULL,
  `ind_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ind_password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ind_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ind_birthdate` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ind_phone` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ind_image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_nationality` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_gender` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_transfer` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_english` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_sub_exam` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_final_exam` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_exer_exam` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_attend` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_degree_percen` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_status` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_status_show` int NOT NULL DEFAULT '0',
  `ind_status2` int NOT NULL DEFAULT '0',
  `ind_emp` int NOT NULL DEFAULT '0',
  `ind_batch` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `ind_info` longtext COLLATE utf8mb4_general_ci,
  `code` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ind_updated` int NOT NULL DEFAULT '0',
  `ind_certificate` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `active_status` int NOT NULL DEFAULT '0',
  `active_status_code` varchar(300) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `order_number` int DEFAULT '10000000',
  `ind_payment_charge` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `rating_star` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ind_register`
--

INSERT INTO `ind_register` (`ind_id`, `ind_username`, `ind_password`, `ind_name`, `ind_birthdate`, `ind_email`, `ind_phone`, `ind_image`, `ind_nationality`, `ind_address`, `ind_gender`, `ind_transfer`, `ind_english`, `ind_sub_exam`, `ind_final_exam`, `ind_exer_exam`, `ind_attend`, `ind_degree_percen`, `ind_status`, `ind_status_show`, `ind_status2`, `ind_emp`, `ind_batch`, `ind_info`, `code`, `ind_updated`, `ind_certificate`, `active_status`, `active_status_code`, `order_number`, `ind_payment_charge`, `video`, `rating_star`) VALUES
(136, 'mohamed', '11111111', 'محمد رمضان السيد ', '2023-09-24', 'mohamedramadan2930@gmail.com', '100000100', NULL, 'مصري ', 'الرياض', 'ذكر', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, '2', 0, 0, 0, '7', NULL, '16017', 1, '1703915584_quality.png', 0, '40876', 10000048, NULL, NULL, NULL),
(137, 'fatma', 'Fatma@0100', 'فاطمة الزهراء حسن ', '1976-12-06', 'fatma@gmail.com', '52145363232', NULL, 'السعودية', 'الرياض', 'انثي', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, '0', NULL, NULL, 1, '1703915517_quality.png', 0, 'd992d79b8517ee6583b5cd85317208f9', 10000048, NULL, NULL, NULL),
(138, 'fatmazha', 'Fatma@0100', 'فاطمة الزهراء حسن ', '1976-12-06', 'fatmazha@gmail.com', '123456789', NULL, 'السعودية', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, '0', NULL, NULL, 1, '1703915543_quality.png', 0, 'b70cf5e17a8be8be2aec0b9f0f1f1dc6', 29, NULL, NULL, NULL),
(139, 'rawan', '123456شش', 'روان طارق روان طارق ', '2021-11-26', 'rawantarek770@gmail.com', '588787777', NULL, 'سعودى ', 'زلفي', 'انثي', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, '0', 0, 0, 0, '12', NULL, '15902', 1, '1703915617_quality.png', 0, '0729891d0bce937a4bc1209d98e4840a', 13, NULL, NULL, NULL),
(140, 'mo', '12345678', 'mo mo mo om', '2023-09-26', 'm@gmail.com', '0235567656', NULL, 'male', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '15', NULL, NULL, 1, NULL, 0, '30a31f94e05ae465d47e4f227b5f84e6', 10000048, NULL, NULL, NULL),
(141, 'fatmazhaa', 'Fatma@0100', 'فاطمة الزهراء حسن ', '1998-12-06', 'cogawij370@armablog.com', '52145363232', NULL, 'السعودية', 'الرياض', 'انثي', 'نعم', 'متقدم', '20', '100', '100', '100', '50', '1', 0, 0, 0, '7', NULL, NULL, 1, '1695730948_file.docx', 0, 'ad0f89cdbdec3e60820646c0c5c731ec', 10000048, NULL, NULL, NULL),
(142, 'momo', '12345678', 'mo mo mo om', '111111-11-11', 'moelsaygh7@gmail.com', '0235567656', NULL, 'male', 'الرياض', 'انثي', 'لا', 'مبتدئ', '50', '50', '50', '20', '100', '3', 0, 0, 0, '36', NULL, NULL, 1, NULL, 0, 'e12dc4f8ec276b5b0ff603acb8225cbc', 10000048, NULL, NULL, NULL),
(145, 'fatmalzharaa', 'Fatma@0100', 'فاطمة الزهراء حسن ', '11111-12-02', 'fatmaalzharaa@gmail.com', '51234566111', NULL, 'السعودية ', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '22', NULL, NULL, 1, NULL, 0, '9a7a2dc0eedc11053536760d2c7c2e6a', 10000028, NULL, NULL, NULL),
(146, '222fatmalzharaa', 'Fatma@0100', 'فاطمة الزهراء حسن ', '11111-12-02', 'fatmaalzharaa2222@gmail.com', '51234566111', NULL, 'السعودية ', 'زلفي', 'انثي', 'لا', 'مبتدئ', '0', '5', '20', '0', '50', '1', 0, 0, 0, '7', NULL, NULL, 1, NULL, 0, '63fce5830731d7aee7b8e627eedc35ba', 10000028, NULL, NULL, NULL),
(147, 'rawann', '123456aa', 'روان طارق روان طارق ', '2023-09-27', 'rawan@gmail.com', '5647874745', NULL, 'سعودى ', 'زلفي', 'انثي', 'لا', 'مبتدئ', '50', '', '50', '50', '200', '3', 1, 0, 0, '21', NULL, NULL, 1, NULL, 0, 'db08cb22d3a12b7834d0b948b933d0f3', 10000028, NULL, NULL, NULL),
(148, 'hanen', '123456aa', 'روان طارق روان روان', '2023-09-27', 'rawantare770@gmail.com', '5647874745', NULL, 'سعودى ', 'الرياض', 'انثي', 'نعم', 'مبتدئ', '50', '100', '50', '50', '100', NULL, 1, 0, 0, '36', NULL, NULL, 1, NULL, 0, 'd535d5533c5a0d750e16a91fb8fafb8c', 27, NULL, NULL, NULL),
(149, 'rana', 'Fatma@0100', 'رنا احمد ', '2000-12-05', 'rana@gmail.com', '123456744', NULL, 'السعودية', 'الرياض', 'انثي', 'نعم', 'متقدم', '50', '50', '50', '50', '200', '2', 0, 0, 0, '21', NULL, NULL, 1, NULL, 0, '613d6f6e63ffa8a75b4b1debe8adc9d2', 10000028, NULL, NULL, NULL),
(150, 'yara', '12345678', 'yara yara yara yara ', '2023-09-27', 'yara@gmail.com', '12345678', NULL, 'مصري ', 'الرياض', 'انثي', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '35', NULL, NULL, 1, NULL, 0, '8bf70d3bf46f41e37e65f7f50ff95409', 10000028, NULL, NULL, NULL),
(151, 'menna ', '12345678', 'menna menna menna menna ', '2023-09-27', 'menna@gmail.com', '12345678', NULL, 'مصري ', 'الرياض', 'انثي', 'نعم', 'متقدم', '50', '50', '50', '50', '100', '1', 0, 0, 0, '36', NULL, NULL, 1, NULL, 0, '07dfe01888b7baaca2db77d797e8a383', 10000028, NULL, NULL, NULL),
(152, 'mennaa', '12345678', 'menna menna menna menna ', '2023-09-27', 'mennaa@gmail.com', '12345678', NULL, 'مصري ', 'الرياض', 'انثي', 'لا', 'مبتدئ', '50', '50', '50', '8', '50', '1', 0, 0, 0, '50', NULL, NULL, 1, NULL, 0, 'f8f422d8f99d12a274a5720aa4ffc6d6', 10000028, 'CAPTURED', NULL, 4),
(153, 'mohhhamed', 'Asd@1234', 'محمد ـحمد', '2001-05-23', 'mohamedddd@gmail.com', '1234564587', NULL, 'ٍسعودي', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '36', NULL, NULL, 1, NULL, 0, '92ff5d25a446530b64f175e3a567ee63', 10000028, NULL, NULL, NULL),
(154, 'mohameeed', 'Asd@1234', 'محمد محمد محمد', '2001-05-23', 'bokegar320@gronasu.com', '1234564587', '1696928975_images.jpg', 'ٍسعودي', 'الرياض ', 'ذكر', 'لا', 'مبتدئ', '', '', '', '', '', '3', 1, 0, 0, '23', NULL, '13034', 1, NULL, 0, '6a5de41a4d3920e6d84aa2a69169b954', 7, 'CAPTURED', NULL, NULL),
(156, 'zharaa', 'Fatma@0100', 'رنا احمد', '0666-12-06', 'zharaa@gmail.com', '52145363232', NULL, 'السعودية', 'الرياض', 'انثي', 'لا', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '22', NULL, NULL, 1, NULL, 0, '9d82641f980c923d2192913cadd53d76', 10000026, NULL, NULL, NULL),
(157, '12345zharaa', 'Fatma@0100', 'رنا احمد', '0666-12-06', 'zharaa12345@gmail.com', '52145363232', NULL, 'السعودية', 'زلفي', 'انثي', 'لا', 'مبتدئ', '', '', '', '', '', '0', 0, 0, 0, '25', NULL, NULL, 1, NULL, 0, '6cd0defa8262133b5d92be04f98a929e', 10000026, NULL, NULL, NULL),
(159, 'osamaJR', '12345@Aa', 'سيد محمد علي إبراهيم حامد علي سيد', '2000-03-30', 'sqcacc@gmail.com', '010556699841', '1696930324_avatar.jpg', 'أيرلندي', 'الرياض', 'ذكر', 'لا', 'متقدم', '20', '50', '20', '10', '222222222222222222222222222', '-1', 1, 0, 0, '14', NULL, '18959', 1, NULL, 0, 'fbe61e018428bf2a519297430f80853b', 6, 'CAPTURED', NULL, NULL),
(160, 'fatmaelzharaa', 'Fatma@0100', 'فاطمة الزهراء حسن', '2222-12-05', 'rawan@gmail.com', '123456789', NULL, 'السعودية', 'مكة', 'انثي', 'نعم', 'متقدم', '50', '', '50', '50', '200', '2', 0, 0, 0, '21', NULL, NULL, 1, NULL, 0, 'b45a9decfe82af50fb27f5e8a53e52f0', 26, NULL, NULL, NULL),
(161, 'rawanttt', '12345678', 'rawan r r r', '2023-10-08', 'rawantarek@gmail.com', '564787474555', NULL, 'مصرى', 'الرياض', 'انثي', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '25', NULL, NULL, 1, NULL, 0, 'bbfaab11647c629b7ee1e2881f15b5b6', 10000025, NULL, NULL, NULL),
(162, 'rawantt', '12345678', 'rawan r r r', '2023-10-08', 'rawantarek728@gmail.com', '6654545454', NULL, 'مصرى', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '21', NULL, NULL, 1, NULL, 0, '0589b2d5cf6ae214419ef285fdc903ee', 10000025, NULL, NULL, NULL),
(163, 'Tasnem', 'شسي@1234', 'تسنيم', '2000-01-01', 'Tasnem.softzone@gmail.com', '236578912', NULL, 'ٍسعودي', 'الرياض', 'انثي', 'نعم', 'متقدم', '10', '100', '10', '10', '130', '-1', 0, 0, 0, '25', NULL, '38880', 1, NULL, 0, 'a8233bdc7b747aa9fd52683b0f103393', 10000025, NULL, NULL, NULL),
(164, 'mohamed M', '12345678', 'Mohemed M M M', '2023-10-08', 'mohamedtt@gmail.com', 'dojfidhfdgfd', NULL, 'سعودى', 'الرياض', 'انثي', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '7', NULL, NULL, 1, NULL, 0, 'b3a080b507c3f7920f759f59768f13cd', 10000025, NULL, NULL, NULL),
(165, 'fatma h', '12345678', 'fatma M M M', '2023-10-08', 'fatmatt@gmail.com', 'jkhhhjggg', NULL, 'مصرى', 'الرياض', 'انثي', 'نعم', 'متقدم', '20', '100', '100', '100', '100', '1', 0, 0, 0, '25', NULL, NULL, 1, NULL, 0, '26981b162c2868fc9e33e3f06aecc4d6', 10000025, NULL, NULL, NULL),
(166, 'rawannnn', '12345678', 'Mohemed M M M', '2023-10-08', '......@gmail.com', '5647874745', NULL, 'مصرى', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '7', NULL, NULL, 1, NULL, 0, 'ef0756ad6c59e442888dcb25bf27dc98', 10000021, NULL, NULL, NULL),
(167, 'rawannnnn', '12345678', 'Mohemed M M M', '2023-10-08', '.........@gmail.com', '5647874745', NULL, 'مصرى', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 1, NULL, 0, 'e510b84e09d005705dd7a52aa10473dd', 10000021, NULL, NULL, NULL),
(168, 'rawannnnnn', '123456aa', 'Mohemed M M M', '2023-10-08', '**@gmail.com', '5647874745', NULL, 'مصرى', 'زلفي', 'انثي', 'لا', 'مبتدئ', '5', '5', '5', '5', '5', '1', 0, 0, 0, '11', NULL, NULL, 1, NULL, 0, '53c88f441e838bef58b5ad0958a729e8', 10000021, NULL, NULL, 4),
(169, 'tarek', '12345678', 'روان طارق روان روان', '2023-10-08', '!!!!!@gmail.com', '5555536525', NULL, 'مصرى', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '25', NULL, NULL, 1, NULL, 0, '0e8b4aa61299d0f77c0304a332034ef0', 10000021, NULL, NULL, NULL),
(170, 'hanaa', 'شسي@1234', 'هناء محمد', '2001-02-06', 'wojokon400@gronasu.com', '645654564', NULL, 'ٍسعودي', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '33', NULL, NULL, 1, NULL, 0, 'f32c58ee2d3fa0b3f3c2a12db84b1e2c', 10000021, NULL, NULL, NULL),
(171, 'tasneemmm', '12345678', 'fatma M M M', '2023-10-08', '!!!!@gmail.com', '5647874745', NULL, 'مصرى', 'الرياض', 'انثي', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 1, NULL, 0, '389ad5c7a90e1e4cefad3982787c7769', 10000021, NULL, NULL, NULL),
(172, 'daqenogox', 'Pa$$w0rd!', 'Erich Goodwin', '2006-09-20', 'nogi@mailinator.com', '+1 (878) 339-4046', NULL, 'Dolorum enim quam ad', 'سكاكا', 'انثي', 'لا', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, '1698301095_testing..pdf', 0, '565589697cdf26ceb1a3d8ba8f2c5d95', 10000019, NULL, NULL, NULL),
(173, 'salma', 'Pa$$w0rd!', 'Anne Dean', '2023-10-08', 'syzubucu@mailinator.com', '+1 (148) 119-9516', NULL, 'Veritatis libero sin', 'الرياض', 'ذكر', 'لا', 'متقدم', '50', '50', '50', '50', '200', '2', 0, 0, 0, '21', NULL, NULL, 1, NULL, 0, 'a51e9ab250151d4d5c793cd044f12cb2', 10000019, NULL, NULL, NULL),
(174, 'mena', 'Pa$$w0rd!', 'Maxwell Leblanc', '1986-07-10', 'mena@gmail.com', '+1 (732) 566-6802', NULL, 'Quibusdam sed tempor', 'الظهران', 'ذكر', 'نعم', 'مبتدئ', '20', '40', '20', '20', '100', NULL, 1, 0, 0, '14', NULL, NULL, 1, '1698300460_sample-1.m4a', 0, '935bb068ecb9ca58e81f92f495cec481', 9, NULL, NULL, NULL),
(175, 'menaa', '12345678', 'mena tarek', '2004-08-18', 'funoxufo@mailinator.com', '+1 (447) 106-2054', NULL, '!!!!!!', 'جدة', 'ذكر', 'لا', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, '1698134141_data.png', 0, '0717679da22b9d00d77edde2c481a945', 10000019, NULL, NULL, NULL),
(176, 'menaaa', '12345678', 'mena tarek', '2004-08-18', 'nalotunej@mailinator.com', '+1 (447) 106-2054', NULL, '!!!!!!', 'زلفي', 'انثي', 'نعم', 'مبتدئ', '30', '50', '10', '10', '100', '2', 0, 0, 0, '21', NULL, NULL, 1, NULL, 0, '57f6d47dbae45b535c773a3c07e0d88a', 10000019, NULL, NULL, NULL),
(177, 'tamara', '12345678', 'mena tarek', '2023-10-08', 'dere@mailinator.com', '5647874745', NULL, 'سعودى', 'جدة', 'ذكر', 'نعم', 'متقدم', '-1', '-1', '-2', '-3', '-1', '0', 0, 0, 0, '25', NULL, NULL, 1, NULL, 0, '09fc77cc45c8206741369a9c1a62854d', 10000019, NULL, NULL, NULL),
(178, 'tamaraa', 'Pa$$w0rd!', 'Tamara Calderon', '1982-10-08', 'user@gmail', '+1 (702) 976-4224', NULL, 'Excepturi proident', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 1, NULL, 0, 'aa9d6ea369edb090aad5ff8db1b4ae2a', 10000019, NULL, NULL, NULL),
(179, 'tamaraaa', 'Pa$$w0rd!', 'Tamara Calderon', '1982-10-08', 'user@gmail.c-o-m', '+1 (702) 976-4224', NULL, 'Excepturi proident', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '30', NULL, NULL, 1, NULL, 0, 'c4708eb54daeaaa29628fb577e5c3f64', 10000019, NULL, NULL, NULL),
(180, 'selia', 'Pa$$w0rd!', 'Nissim Petty', '1984-12-28', 'user1@gmail', '+1 (913) 971-3941', NULL, 'Temporibus perferend', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 1, NULL, 0, '8ddf50b7e37b675ceaa89ea926273ef5', 10000019, NULL, NULL, NULL),
(181, 'seliaa', 'Pa$$w0rd!', 'Nissim Petty', '1984-12-28', 'user2@gmail', '+1 (913) 971-3941', NULL, 'Temporibus perferend', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 1, NULL, 0, '362bcc0fee7e26c33bb6a249ce6671e2', 10000019, NULL, NULL, NULL),
(182, 'ranaaaaa', 'ranaaaaa', 'Anthony Cain', '2007-09-08', 'womafega@mailinator.com', '+1 (781) 462-7131', NULL, 'Iure nihil voluptate', 'القصيم', 'انثي', 'لا', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '28c26d87466dbf615e3f83c104bffee8', 10000019, NULL, NULL, NULL),
(183, 'tameem', 'Pa$$w0rd!', 'Dante Lloyd', '2023-10-09', 'dowahe@mailinator.com', '+1 (758) 479-7189', NULL, 'Aliquam error perspi', 'أبها', 'انثي', 'نعم', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '36', NULL, NULL, 1, NULL, 0, '65382b2f582fd2490c83d139769b744d', 10000019, NULL, NULL, NULL),
(185, 'يوسف', '12345678', 'يوسف', '2024-05-11', 'jo@gmail.com', '4565566655t', NULL, 'مصرى', 'الرياض', 'ذكر', 'لا', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '8', NULL, NULL, 1, NULL, 0, 'b5b40ade5d5405e2bd7e203ffb64ae2c', 10000017, NULL, NULL, NULL),
(186, 'ti', 'Pa$$w0rd!', 'Vernon Moody', '1971-03-13', 'lagogu@mailinator.com', '+1 (266) 726-3169', NULL, 'Consequat Et corpor', 'الرياض', 'ذكر', 'لا', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '35', NULL, NULL, 1, NULL, 0, 'b0dc1ecd538985954b1cd65db95fb4f3', 10000017, NULL, NULL, NULL),
(187, 'حسن', '12345678', 'Gabriel Jacobs', '1998-05-01', 'hassan@mailinator.com', '+1 (114) 277-7922', NULL, 'Esse aut alias rem', 'زلفي', 'انثي', 'لا', 'مبتدئ', '20', '20', '20', '20', '100', '1', 0, 0, 0, '14', NULL, NULL, 1, NULL, 0, '8c64c9d15bd37f0aa9b961bf99e29f22', 10000016, NULL, NULL, NULL),
(188, 'منه', '12345678', 'Gabriel Jacobs', '1998-05-01', '......@mailinator.com', '+1 (114) 277-7922', NULL, 'Esse aut alias rem', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '35', NULL, NULL, 1, NULL, 0, 'cb048cbd701e6a0b6378004732c9c78b', 10000015, NULL, NULL, NULL),
(193, 'osama', '12345678', 'سيد علي إبراهيم خالد عادل', '2000-01-01', 'osama@gmail.com', '966369852147', '1696921903_Suit Rick Sanchez.jpg', 'مصري', 'مكة', 'ذكر', 'نعم', 'متقدم', '2', '', '2', '2', '2', '0', 0, 0, 0, '50', NULL, NULL, 1, NULL, 0, '5ecdf09c3166476615d8d626b8440da1', 10000007, 'CAPTURED', NULL, 4),
(194, 'aya', '12345678', 'aya aya aya aya', '2023-10-10', 'aya@gmail.com', '12345678', NULL, 'مصري', 'جدة', 'انثي', 'نعم', 'متقدم', '', '', '', '', '', '3', 1, 0, 0, '25', NULL, NULL, 1, NULL, 0, 'd43d558a52c55a59dd55836f2ebf79bf', 10000007, NULL, NULL, NULL),
(195, 'fatem', '12345678', 'fatem fatem fatem', '2023-10-18', 'fatama@gmail.com', '12345678', NULL, 'سعودي ف', 'الرياض', 'انثي', 'نعم', 'متقدم', '200', '100', '20', '200', '20', '-1', 1, 0, 0, '25', NULL, NULL, 1, NULL, 0, 'a792fe99820cce8913085941db1720e1', 1, NULL, NULL, NULL),
(197, 'new trainee', '12345678', 'aya aya aya aya', '2023-10-19', 'new@gmail.com', '12345678', NULL, 'مصري', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '25', NULL, NULL, 1, NULL, 0, 'bd1b21ccf1166e0f86810c58340618ee', 10000005, NULL, NULL, NULL),
(198, 'AyaTest', '12345678', 'aya aya aya aya', '2023-10-23', 'aya122@gmail.com', '12345678', NULL, 'مصري', 'زلفي', 'انثي', 'لا', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '', NULL, NULL, 1, NULL, 0, 'e362a6b59dbbfb6cd74160abc3792110', 10000004, NULL, NULL, NULL),
(201, 'ayaTest1', '12345678', 'aya aya aya aya', '1999-06-23', 'ayaTest33@gmail.com', '12345678', NULL, 'مصري', 'جدة', 'انثي', 'لا', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '35', NULL, NULL, 1, NULL, 0, '09f641fbed2949fb010dee029f9c8ee8', 10000004, NULL, NULL, NULL),
(202, 'new user', '12345@ِش', 'سيد إبراهيم', '2000-01-01', 'nwuser@gmail.com', '966369852147', NULL, 'مصري', 'الرياض', 'ذكر', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '36', NULL, NULL, 1, NULL, 0, 'a4487b954881af3151e4fe28d87749ae', 10000000, NULL, NULL, NULL),
(203, 'hanouf', 'hanouf5501562', 'الهنوف خالد', '1993-02-04', 'alhanouf.alqhtani@hotmail.com', '0532982054', NULL, 'سعودي', 'الرياض', 'انثي', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '7521', 10000000, NULL, NULL, NULL),
(204, 'ramadan', '11111111', 'لمار محمد', '2023-12-19', 'finiwo3933@avucon.com', '01011642731', NULL, 'يسي', 'بلجرشي', 'ذكر', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 1, '14730', 10000000, NULL, NULL, NULL),
(205, 'ramadan_mohamed', '11111111', 'asa', '2023-12-19', 'judranurko@gufum.com', '0101164271', NULL, 'zzx', 'مكة', 'ذكر', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 1, '45297', 10000000, NULL, NULL, NULL),
(206, 'alhanouf', 'hanouf5501562', 'الهنوف خالد', '1997-02-05', 'hanoufhanouf@outlook.sa', '05329899987', NULL, 'سعودي', 'المدينة المنورة', 'انثي', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 1, '13394', 10000000, NULL, NULL, NULL),
(207, 'ahmed', '12345678ABCabc@#$', 'أحمد محمود أحمد محمود', '2010-01-01', 'ahmed@gmail.con', '01234567890', NULL, 'مصري', 'الرياض', 'ذكر', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '33505', 10000000, NULL, NULL, NULL),
(208, 'ahmed12', '12345678ABCabc@#$', 'أحمد محمود أحمد محمود', '2010-01-01', 'rehiy75087@vasteron.com', '012345675590', NULL, 'مصري', 'الرياض', 'ذكر', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '6140', 10000000, NULL, NULL, NULL),
(209, 'rawannn', '12345678', 'rawan rawan rawan', '2023-12-24', 'tihen29300@wikfee.com', '44785944788', NULL, 'مصرى', 'مكة', 'انثي', 'لا', 'متوسط', '0', '0', '0', '0', '0', '2', 0, 0, 0, '36', NULL, NULL, 1, NULL, 1, '52781', 10000000, 'CAPTURED', NULL, 1),
(210, 'mmmnndjdn', '12345678', 'testetteeeete', '2023-05-23', 'ttihen29300@wikfee.com', '092889298298', NULL, 'مصري', 'جدة', 'انثي', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '37161', 10000000, NULL, NULL, NULL),
(211, 'testesttest', '12345678', 'testetstetste', '2023-02-08', 'nisos93383@wenkuu.com', '0339339833983', NULL, 'مصري', 'جدة', 'انثي', 'نعم', 'متوسط', '20', '20', '30', '40', '50', '1', 0, 0, 0, '50', NULL, NULL, 1, NULL, 1, '52267', 10000000, 'CAPTURED', NULL, 4),
(212, 'ayaaaa', '12345678', 'ايه', '2023-12-24', 'memletarta@gufum.com', '547857877877', NULL, 'مصرى', 'مكة', 'انثي', 'نعم', 'متوسط', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '14839', 10000000, NULL, NULL, NULL),
(213, 'dinaaaaa', '12345678', 'dina', '2023-12-24', 'elam95wfgr@rentforsale7.com', '788789797', NULL, 'مصرى', 'مكة', 'انثي', 'نعم', 'مبتدئ', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '54537', 10000000, NULL, NULL, NULL),
(214, 'tetstesttest', '12345678', 'test test test', '2023-06-05', 'wohegam624@watrf.com', '029283893898', NULL, 'suadi', 'الرياض', 'ذكر', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '10577', 10000000, NULL, NULL, NULL),
(215, 'lalalalala', '12345678', 'test test test', '2023-06-05', 'peyec75938@wikfee.com', '029283893333', NULL, 'suadi', 'الرياض', 'ذكر', 'نعم', 'متقدم', '100', '100', '100', '100', '100', '3', 0, 0, 0, '17', NULL, NULL, 1, '1703920467_نبات-ست-الحسن-7-scaled-1.webp', 1, '25712', 10000000, 'CAPTURED', NULL, 4),
(216, 'ola1234', 'ola@0100', 'علا محمد', '2015-06-09', 'ola@gmail.com', '12345679669', NULL, 'مصرية', 'المدينة المنورة', 'انثي', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '54650', 10000000, NULL, NULL, NULL),
(217, 'ola123', 'ola@0100', 'علا محمد احمد', '2023-11-02', 'yedixe8561@wenkuu.com', '16994975874', NULL, 'مصري', 'المدينة المنورة', 'انثي', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '40758', 10000000, NULL, NULL, NULL),
(218, 'ola123456', 'ola@0100', 'علا محمد احمد', '2023-11-02', 'latadi8244@watrf.com', '16994975822222274', NULL, 'مصري', 'المدينة المنورة', 'انثي', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '51611', 10000000, NULL, NULL, NULL),
(219, 'ola121314', 'ola12345', 'علا محمد احمد', '2023-12-02', 'mofim22377@wikfee.com', '134578000000', NULL, 'شش', 'الطائف', 'انثي', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '54790', 10000000, NULL, NULL, NULL),
(220, 'New_User', '12345678', 'New_User', '2000-01-01', 'a44465658ab7b8@cashbenties.com', '3698521478', NULL, 'مصري', 'الرياض', 'ذكر', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, '4029', 1, NULL, 0, '37273', 10000000, NULL, NULL, NULL),
(221, '44mixed@desertsu', '12345678', 'New_User', '2000-01-01', '44mixed@desertsundesigns.com', '36985214587', NULL, 'مصري', 'الرياض', 'ذكر', 'نعم', 'متقدم', NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '0', NULL, NULL, 1, NULL, 0, '9561', 10000000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ind_review`
--

CREATE TABLE `ind_review` (
  `rev_id` int NOT NULL,
  `ind_id` int NOT NULL,
  `ind_review` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `rev_show` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ind_review`
--

INSERT INTO `ind_review` (`rev_id`, `ind_id`, `ind_review`, `rev_show`) VALUES
(3, 148, 'شكرا', 1),
(6, 148, '10/10', 0),
(7, 148, '', 0),
(10, 160, 'rate', 0),
(11, 160, 'dgfdfgdfg', 0),
(12, 160, 'trtrtryr', 0),
(13, 209, 'منصه انتقاء تقييم ', 0),
(14, 211, 'تقييم', 0),
(15, 211, 'تقييم انتقاء', 0),
(16, 211, 'تقييم من المتدرب', 0),
(17, 211, 'تقييم مره اخري ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `interview_notificaion`
--

CREATE TABLE `interview_notificaion` (
  `noti_id` int NOT NULL,
  `noti_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `noti_person_link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `noti_com_link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `interview_date` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `interview_time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sender` int NOT NULL DEFAULT '0',
  `recieve` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `inter_admin_noti` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interview_notificaion`
--

INSERT INTO `interview_notificaion` (`noti_id`, `noti_title`, `noti_person_link`, `noti_com_link`, `interview_date`, `interview_time`, `sender`, `recieve`, `created_at`, `update_at`, `inter_admin_noti`) VALUES
(18, '  طلب مقابلة شخصية ', '128', '3', '2023-07-11', '23:21', 0, 0, '2023-07-11 17:21:27', '23-08-14', 1),
(19, '  طلب مقابلة شخصية ', '130', '3', '2023-06-22', '12:24', 0, 0, '2023-07-11 17:21:54', '0', 1),
(20, '  طلب مقابلة شخصية ', '127', '3', '2023-08-23', '13:35', 0, 0, '2023-08-10 18:31:25', '0', 1),
(21, '  طلب مقابلة شخصية ', '165', '29', '2023-08-11', '11:35', 0, 0, '2023-08-11 19:35:48', '23-08-12', 1),
(22, '  طلب مقابلة شخصية ', '171', '30', '2023-08-13', '14:09', 0, 0, '2023-08-13 11:07:21', '23-08-13', 1),
(23, '  طلب مقابلة شخصية ', '154', '48', '2023-10-10', '10:32', 0, 0, '2023-10-10 07:31:43', '23-10-10', 1),
(24, '  طلب مقابلة شخصية ', '148', '62', '2023-10-18', '15:40', 0, 0, '2023-10-18 12:38:05', '23-10-18', 1),
(25, '  طلب مقابلة شخصية ', '142', '105', '2222-12-22', '12:11', 0, 0, '2023-10-19 09:29:50', '23-10-19', 1),
(26, '  طلب مقابلة شخصية ', '209', '116', '', '', 0, 0, '2023-12-25 11:49:52', '23-12-25', 1),
(27, '  طلب مقابلة شخصية ', '211', '116', '', '', 0, 0, '2023-12-25 12:21:39', '23-12-26', 1),
(28, '  طلب مقابلة شخصية ', '211', '117', '', '', 0, 0, '2023-12-26 08:12:11', '23-12-26', 1),
(29, '  طلب مقابلة شخصية ', '211', '33', '2024-01-01 12:05', NULL, 0, 0, '2023-12-30 09:05:24', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_notification`
--

CREATE TABLE `message_notification` (
  `id` int NOT NULL,
  `noti_title` varchar(255) NOT NULL,
  `noti_person_link` varchar(200) NOT NULL,
  `noti_com_link` varchar(200) NOT NULL,
  `sender` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_notification`
--

INSERT INTO `message_notification` (`id`, `noti_title`, `noti_person_link`, `noti_com_link`, `sender`) VALUES
(1, '????? ?????', '209', 'coash', '209'),
(2, '????? ?????', '209', 'coash', '209'),
(3, '????? ?????', '209', 'admin', '209'),
(4, '????? ?????', '209', 'admin', '209'),
(5, '????? ?????', '209', 'admin', '209'),
(6, '????? ?????', '209', 'admin', '209'),
(7, '????? ?????', '209', 'admin', '209'),
(8, '????? ?????', '211', 'admin', '211'),
(9, '????? ?????', '211', 'admin', '211'),
(10, '????? ?????', '211', 'admin', '211'),
(11, '????? ?????', '211', 'admin', '211'),
(12, '????? ?????', '211', 'admin', '211'),
(13, '????? ?????', '211', 'admin', '211'),
(14, '????? ?????', '211', 'admin', '211'),
(15, '????? ?????', '215', 'admin', '215'),
(16, '????? ?????', '211', 'admin', '211'),
(17, '????? ?????', '211', 'admin', '211'),
(18, '????? ?????', '209', 'admin', '209'),
(19, '????? ?????', '209', 'admin', '209'),
(20, '????? ?????', '209', 'admin', '209'),
(21, '????? ?????', 'rawannn', '116', '116'),
(22, '????? ?????', '209', 'fixogeh', '209'),
(23, '????? ?????', 'admin', '116', '116'),
(24, '????? ?????', 'admin', '116', '116'),
(25, '????? ?????', 'admin', '116', '116'),
(26, '????? ?????', 'admin', '116', '116'),
(27, '????? ?????', 'admin', '116', '116'),
(28, '????? ?????', 'admin', '116', '116'),
(29, '????? ?????', 'testesttest', '116', '116'),
(30, '????? ?????', '211', 'fixogeh', '211'),
(31, '????? ?????', 'rawannn', '116', '116'),
(32, '????? ?????', 'rawannn', '116', '116'),
(33, '????? ?????', 'rawannn', '116', '116'),
(34, '????? ?????', 'rawannn', '116', '116'),
(35, '????? ?????', 'rawannn', '116', '116'),
(36, '????? ?????', 'rawannn', '116', '116'),
(37, '????? ?????', 'admin', '116', '116'),
(38, '????? ?????', 'admin', '116', '116'),
(39, '????? ?????', 'admin', '116', '116'),
(40, '????? ?????', '209', 'fixogeh', '209'),
(41, '????? ?????', 'rawannn', '116', '116'),
(42, '????? ?????', '209', 'fixogeh', '209'),
(43, '????? ?????', 'lalalalala', '116', '116'),
(44, '????? ?????', '215', 'fixogeh', '215'),
(45, '????? ?????', 'lalalalala', '116', '116'),
(46, '????? ?????', '215', 'fixogeh', '215'),
(47, '????? ?????', 'rawannn', '116', '116'),
(48, '????? ?????', 'rawannn', '116', '116'),
(49, '????? ?????', '209', 'fixogeh', '209'),
(50, '????? ?????', 'lalalalala', '116', '116'),
(51, '????? ?????', 'rana', '116', '116'),
(52, '????? ?????', 'rana', '116', '116'),
(53, '????? ?????', 'rana', '116', '116'),
(54, '????? ?????', '209', 'fixogeh', '209'),
(55, '????? ?????', '209', 'fixogeh', '209'),
(56, '????? ?????', '209', 'fixogeh', '209'),
(57, '????? ?????', 'admin', '117', '117'),
(58, '????? ?????', 'admin', '117', '117'),
(59, '????? ?????', 'testesttest', '117', '117'),
(60, '????? ?????', 'admin', '116', '116'),
(61, '????? ?????', 'admin', '116', '116'),
(62, '????? ?????', 'testesttest', '116', '116'),
(63, '????? ?????', 'rawannn', '116', '116');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `ques_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `ques_ques` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`ques_id`, `exam_id`, `ques_ques`) VALUES
(130, 119, 'Question1'),
(131, 116, 'Question1'),
(132, 119, 'ما هي أهمية التدريب في بيئة العمل؟'),
(134, 122, 'ما هي أهمية التدريب في بيئة العمل؟'),
(135, 122, 'ما هي أهمية التدريب'),
(136, 121, 'ما هي أهمية التدريب في بيئة العمل؟'),
(137, 123, 'ما هي أهمية التدريب في بيئة العمل؟'),
(138, 124, 'ما هي أهمية التدريب في بيئة العمل؟'),
(139, 126, 'الأول'),
(140, 126, 'الثاني'),
(141, 126, 'الثالث'),
(142, 127, 'ما هي أهمية التدريب في بيئة العمل؟'),
(143, 129, 'ما هي أهمية التدريب في بيئة العمل؟'),
(146, 136, 'الأول'),
(147, 136, 'الثاني'),
(148, 140, 'fdf'),
(149, 140, 'd'),
(150, 141, 'يب'),
(151, 143, 'tets'),
(152, 143, 'اختيارات '),
(153, 147, 'ما هي أهمية التدريب في بيئة العمل؟'),
(154, 147, 'ما هي أهمية التدريب'),
(157, 144, 'لماذا نحن هنا');

-- --------------------------------------------------------

--
-- Table structure for table `question_answer`
--

CREATE TABLE `question_answer` (
  `ques_ans_id` int NOT NULL,
  `user_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `question_answer` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `question_answer_grade` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_answer`
--

INSERT INTO `question_answer` (`ques_ans_id`, `user_id`, `exam_id`, `question`, `question_answer`, `question_answer_grade`) VALUES
(150, 10, 8, '12', '46', ''),
(151, 10, 8, '13', '50', ''),
(152, 10, 8, '14', '56', ''),
(153, 10, 10, '15', '59', ''),
(154, 10, 10, '16', '61', ''),
(155, 10, 10, '17', '68', ''),
(156, 27, 8, '12', '45', ''),
(157, 27, 8, '13', '51', ''),
(158, 27, 8, '14', '56', ''),
(159, 27, 10, '15', '60', ''),
(160, 27, 10, '16', '62', ''),
(161, 27, 10, '17', '66', ''),
(162, 29, 13, '18', '72', NULL),
(163, 29, 13, '19', '74', NULL),
(164, 10, 12, '20', '77', NULL),
(165, 10, 12, '21', '81', NULL),
(166, 10, 12, '22', '88', NULL),
(167, 120, 13, '18', '70', NULL),
(168, 120, 13, '19', '75', NULL),
(169, 120, 13, '24', '94', NULL),
(170, 120, 13, '25', '97', NULL),
(171, 131, 16, '28', '0', NULL),
(172, 131, 16, '29', '113', NULL),
(173, 127, 28, '32', '126', NULL),
(174, 127, 28, '32', '126', NULL),
(175, 127, 29, '33', '132', NULL),
(176, 174, 51, '52', '207', NULL),
(177, 174, 52, '53', '209', NULL),
(178, 159, 52, '53', '209', NULL),
(179, 148, 53, '54', '0', NULL),
(180, 148, 53, '55', '0', NULL),
(181, 148, 53, '56', '0', NULL),
(182, 148, 53, '57', '0', NULL),
(183, 146, 54, '58', '0', NULL),
(184, 146, 54, '59', '0', NULL),
(185, 146, 54, '60', '0', NULL),
(186, 146, 54, '61', '0', NULL),
(187, 146, 54, '62', '0', NULL),
(188, 146, 54, '63', '0', NULL),
(189, 146, 61, '68', '0', NULL),
(190, 146, 61, '69', '0', NULL),
(191, 146, 61, '70', '0', NULL),
(192, 194, 56, '65', '257', NULL),
(193, 194, 56, '66', '262', NULL),
(194, 194, 56, '67', '267', NULL),
(195, 195, 82, '71', '281', NULL),
(196, 195, 82, '72', '286', NULL),
(197, 195, 85, '73', '289', NULL),
(198, 195, 85, '74', '293', NULL),
(199, 195, 100, '89', '0', NULL),
(200, 195, 100, '90', '357', NULL),
(201, 194, 108, '122', '0', NULL),
(202, 194, 109, '123', '489', NULL),
(203, 195, 109, '123', '491', NULL),
(204, 194, 110, '124', '494', NULL),
(205, 195, 110, '124', '496', NULL),
(206, 194, 111, '125', '497', NULL),
(207, 194, 111, '126', '503', NULL),
(208, 195, 112, '128', '0', NULL),
(209, 195, 114, '129', '516', NULL),
(210, 194, 114, '129', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_option`
--

CREATE TABLE `question_option` (
  `option_id` int NOT NULL,
  `option_text` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `question_id` int NOT NULL,
  `is_right` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_option`
--

INSERT INTO `question_option` (`option_id`, `option_text`, `question_id`, `is_right`) VALUES
(45, 'a', 12, 1),
(46, 'b', 12, 0),
(47, 'c', 12, 0),
(48, 'd', 12, 0),
(49, 'ش', 13, 0),
(50, 'لا', 13, 0),
(51, 'ؤ', 13, 1),
(52, 'ي', 13, 0),
(53, 'ahmed', 14, 0),
(54, 'mohamed', 14, 0),
(55, 'ali', 14, 0),
(56, 'hassan', 14, 1),
(57, 'a', 15, 0),
(58, 'b', 15, 0),
(59, 'c', 15, 0),
(60, 'd', 15, 1),
(61, 'a', 16, 0),
(62, 'b', 16, 0),
(63, 'c', 16, 1),
(64, 'd', 16, 0),
(65, 'a', 17, 0),
(66, 'b', 17, 0),
(67, 'c', 17, 0),
(68, 'd', 17, 1),
(69, 'a', 18, 0),
(70, 'b', 18, 0),
(71, 'c', 18, 0),
(72, 'd', 18, 1),
(73, 'a', 19, 0),
(74, 'b', 19, 0),
(75, 'c', 19, 1),
(76, 'd', 19, 0),
(77, 'a', 20, 0),
(78, 'b', 20, 0),
(79, 'c', 20, 1),
(80, 'd', 20, 0),
(81, 'a', 21, 1),
(82, 'b', 21, 0),
(83, 'c', 21, 0),
(84, 'd', 21, 0),
(85, 'a', 22, 0),
(86, 'b', 22, 0),
(87, 'c', 22, 0),
(88, 'd', 22, 1),
(93, 'اصفر احمر ازرق', 24, 0),
(94, 'اصفر احمر اخضر', 24, 1),
(95, 'اصفر اخضر ازرق', 24, 0),
(96, 'احمر اخضر  ابيض ', 24, 0),
(97, 'الناتيج 10 ', 25, 1),
(98, 'الناتج 11', 25, 0),
(99, 'الناتج 21', 25, 0),
(100, 'الناتج 3', 25, 0),
(105, 'جدة', 26, 0),
(106, 'الرياض', 26, 1),
(107, 'الدمام', 26, 0),
(108, 'الباحة', 26, 0),
(109, '4', 26, 0),
(110, '5', 26, 0),
(111, '6', 26, 1),
(112, '9', 26, 1),
(113, '2', 29, 1),
(114, '5', 29, 0),
(115, '6', 29, 1),
(116, '9', 29, 1),
(117, 'a', 30, 0),
(118, 'b', 30, 0),
(119, 'cd', 30, 0),
(120, 'd', 30, 1),
(121, 'الاخيار الاول ', 31, 0),
(122, 'الاخيار الثاني ', 31, 0),
(123, 'الاخيار الثالث', 31, 0),
(124, 'الاخيار الرابع ', 31, 1),
(125, 's', 32, 0),
(126, 'd', 32, 0),
(127, 's', 32, 0),
(128, 'f', 32, 1),
(129, 'ي', 33, 0),
(130, 'ب', 33, 0),
(131, 'يب', 33, 0),
(132, 'بي', 33, 1),
(133, 'هي لغة برمجة ويب ومواقع الكترونية ', 34, 1),
(134, 'هي برمجة تطبيقات الموبايل ', 34, 0),
(135, 'لغه برمجة ديسك ', 34, 0),
(136, 'يبابخابابع9ا', 34, 0),
(141, '2000 سعره ', 36, 0),
(142, '3500 سعره ', 36, 0),
(143, 'حسب وزنه ', 36, 1),
(144, 'حسب طولة ', 36, 0),
(145, '365', 37, 1),
(146, '255', 37, 0),
(147, '328', 37, 0),
(148, '335', 37, 0),
(149, '11', 38, 0),
(150, '12', 38, 0),
(151, '7', 38, 1),
(152, '6', 38, 0),
(169, '150 سم ', 43, 0),
(170, '200 سم', 43, 0),
(171, '100سم', 43, 1),
(172, '140 سم ', 43, 0),
(173, 'اطرح اسئلة التحليلية لكي لا اضيع وقتي مع العميل', 44, 1),
(174, 'احاول اقناعه وتشويقة للمنتج ', 44, 0),
(175, 'اتركه لوحده يأتي ويسأل ', 44, 0),
(176, 'ارحب به واكون علاقة معه ', 44, 0),
(177, 'اجيب على الاسئلة فقط', 45, 0),
(178, 'استمع لمشكلته اولا لايجاد حل يناسب رغبته', 45, 1),
(179, 'اشرح له تفاصيل المنتج ولا اجعله يذهب حتى يقتنع ', 45, 0),
(180, 'اجعله يجرب المنتج او الخدمة فوراً ليقرر الشراء ', 45, 0),
(181, 'اطرح اسئلة التي تجعله متردد ومحتار لأيجاد حلاً لها ليطمئن بعد الشراء', 46, 1),
(182, 'اتركة ولا اضيع وقتا معه ', 46, 0),
(183, 'اجعله ياخذ عينه يجربها ليقرر لاحقا ', 46, 0),
(184, 'اخذ رقمة للتواصل عندما يؤكد القرار ', 46, 0),
(185, 'اسئلة ماذا يحتاج', 47, 0),
(186, 'اسئلة عن البدجت ', 47, 0),
(187, 'اتركة يختار وينظر بنفسة', 47, 0),
(188, 'اسمع مايريد', 47, 1),
(189, 'اقنعه فورا ولا اجعله يزداد توترا', 48, 0),
(190, 'اعطية خيارات افضل واساعدة ', 48, 1),
(191, 'اتركة يقرر ', 48, 0),
(192, 'اتابع مايريد', 48, 0),
(193, 'عام الفيل', 49, 1),
(194, 'قبل الميلاد ', 49, 0),
(195, '1250 هجري', 49, 0),
(196, '1250', 49, 0),
(197, 'عدد لا نهائي', 50, 1),
(198, '100مليار', 50, 0),
(199, '3مليار', 50, 0),
(200, '500مليون', 50, 0),
(201, 'نحرص على ضمان رضا العملاء من خلال مراقبة جودة المنتجات والخدمات والاستجابة السريعة لأية مشكلة تواجههم. نقوم بإرسال استبيانات رضا العملاء بانتظام ونعمل على تحسين أدائنا بناءً على تعليقاتهم.', 51, 1),
(202, 'نقدم برنامج مكافآت يمنح العملاء نقاطًا عند كل عملية شراء يمكنهم استخدامها للحصول على تخفيضات في المستقبل. كما نقدم هدايا مجانية للعملاء المميزين بشكل دوري.', 51, 0),
(203, 'نحن نجمع ملاحظات العملاء من خلال استبيانات رضا العملاء ومنصات التواصل الاجتماعي. نستخدم هذه الملاحظات لتحسين منتجاتنا وتكييف خدماتنا وضمان استجابتنا لاحتياجات العملاء.\r\n', 51, 0),
(204, 'نقدم دورات تدريبية عبر الإنترنت ومواد تعليمية تساعد العملاء على استخدام منتجاتنا بشكل أفضل. نهدف إلى تعزيز تجربتهم وزيادة قيمة مشترياتهم.\r\n', 51, 0),
(205, 'O(1)', 52, 0),
(206, 'O(n)', 52, 1),
(207, 'O(log n)', 52, 0),
(208, ' O(n^2)', 52, 0),
(209, 'التفاعل مع المستخدم', 53, 1),
(210, 'تنظيم هياكل الصفحة وتنسيق المظهر', 53, 1),
(211, 'استرجاع البيانات من قاعدة البيانات', 53, 1),
(212, ' تنفيذ البرمجة الخلفية', 53, 1),
(213, 'test', 54, 1),
(214, 'test1', 54, 0),
(215, 'test1', 54, 0),
(216, 'test3', 54, 0),
(217, 'q1', 55, 0),
(218, 'q2', 55, 0),
(219, 'q3', 55, 0),
(220, 'q4', 55, 1),
(221, 'q1', 56, 0),
(222, 'q2', 56, 1),
(223, 'q2', 56, 0),
(224, 'q3', 56, 0),
(225, 'q1', 57, 1),
(226, 'q2', 57, 0),
(227, 'q3', 57, 0),
(228, 'q4', 57, 0),
(229, '1', 58, 0),
(230, 'a1', 58, 0),
(231, 'a2aa3', 58, 0),
(232, 'aaaaaaaaaa4', 58, 0),
(233, 'q', 59, 0),
(234, 'q', 59, 0),
(235, 'q', 59, 0),
(236, 'q', 59, 0),
(237, 'q', 60, 0),
(238, 'q', 60, 0),
(239, 'q', 60, 0),
(240, 'q', 60, 0),
(241, 'q1q2', 61, 0),
(242, 'q2', 61, 0),
(243, 'q3', 61, 0),
(244, 'q3', 61, 0),
(245, 'q1', 62, 1),
(246, 'q2', 62, 0),
(247, 'q3', 62, 0),
(248, 'q4', 62, 0),
(249, 'w', 63, 0),
(250, 's', 63, 0),
(251, 's', 63, 0),
(252, 's', 63, 0),
(253, 'جيم جواب', 64, 1),
(254, 'ألف أسد', 64, 0),
(255, 'باء بطة ', 64, 0),
(256, 'تاء تفاحة', 64, 0),
(257, 'a', 65, 0),
(258, 'a', 65, 0),
(259, 'a', 65, 0),
(260, 'a', 65, 0),
(261, 'z', 66, 0),
(262, 'z', 66, 0),
(263, 'z', 66, 0),
(264, 'z', 66, 0),
(265, 'a', 67, 0),
(266, 'a', 67, 0),
(267, 'a', 67, 0),
(268, 'a', 67, 0),
(269, 'z', 68, 0),
(270, 'z', 68, 0),
(271, 'z', 68, 0),
(272, 'z', 68, 0),
(273, 'z', 69, 0),
(274, 'a', 69, 1),
(275, 'z', 69, 0),
(276, 'z', 69, 0),
(277, 'a', 70, 0),
(278, 'a', 70, 0),
(279, 'a', 70, 0),
(280, 'a', 70, 0),
(281, 'q1', 71, 1),
(282, 'q2', 71, 0),
(283, 'q3', 71, 0),
(284, 'q4', 71, 0),
(285, 'A1', 72, 1),
(286, 'A2', 72, 0),
(287, 'A3', 72, 0),
(288, 'A4', 72, 0),
(289, 'q1', 73, 1),
(290, 'q2', 73, 0),
(291, 'q3', 73, 0),
(292, 'q4', 73, 0),
(293, 'q1', 74, 0),
(294, 'q2', 74, 0),
(295, 'q3', 74, 0),
(296, 'q4', 74, 0),
(301, 'q2', 75, 0),
(302, 'q3', 75, 0),
(303, 'q4', 75, 0),
(304, 'q5', 75, 0),
(305, '1', 75, 0),
(306, '2', 75, 0),
(307, '3', 75, 0),
(308, '4', 75, 0),
(309, 'q1', 75, 0),
(310, 'q2', 75, 0),
(311, 'q3', 75, 0),
(312, 'q4', 75, 0),
(313, '1', 75, 0),
(314, '2', 75, 0),
(315, '3', 75, 0),
(316, '4', 75, 0),
(317, '1', 75, 0),
(318, '2', 75, 0),
(319, '3', 75, 0),
(320, '4', 75, 0),
(321, '1', 75, 0),
(322, '2', 75, 0),
(323, '3', 75, 0),
(324, '4', 75, 0),
(329, '1', 82, 0),
(330, '2', 82, 0),
(331, '3', 82, 0),
(332, 'Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Que', 82, 0),
(353, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n\r\n\r\n', 82, 0),
(354, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 82, 0),
(355, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 82, 0),
(356, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 82, 0),
(357, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 90, 0),
(358, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 90, 0),
(359, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 90, 0),
(360, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 90, 0),
(361, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 91, 0),
(362, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 91, 0),
(363, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 91, 0),
(364, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير ', 91, 0),
(369, 'vcvcv', 92, 0),
(370, 'hmjhjh', 92, 0),
(371, 'jkjkjkjkj', 92, 0),
(372, 'hjhhgfgffdfffsd', 92, 0),
(373, 'a', 94, 0),
(374, 'a', 94, 0),
(375, 'a', 94, 0),
(376, 'a', 94, 0),
(377, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 92, 0),
(378, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 92, 0),
(379, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 92, 0),
(380, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.', 92, 0),
(381, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 96, 0),
(382, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 96, 0),
(383, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 96, 0),
(384, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 96, 0),
(385, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 97, 0),
(386, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 97, 0),
(387, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 97, 1),
(388, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\n', 97, 0),
(389, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير ', 98, 0),
(390, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير ', 98, 0),
(391, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير ', 98, 0),
(392, 'أهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير مهارات الموظفين، زيادة الإنتاجية، تحسين الجودة، وزيادة رضا العملاء.\r\nأهمية التدريب في بيئة العمل تشمل تطوير ', 98, 0),
(393, 'Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Que', 99, 0),
(394, 'Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Que', 99, 0),
(395, 'Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Que', 99, 0),
(396, 'Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Question1Que', 99, 0),
(397, 'Question1Question1Question1Question1Question1Question1Question1Question1', 100, 1),
(398, 'Question1Question1Question1Question1Question1Question1Question1Question1', 100, 1),
(399, 'Question1Question1Question1Question1Question1Question1Question1Question1', 100, 1),
(400, 'Question1Question1Question1Question1Question1Question1Question1Question1', 100, 1),
(401, 'c', 101, 0),
(402, 'c', 101, 1),
(403, 'c', 101, 0),
(404, 'c', 101, 0),
(405, 'c', 101, 0),
(406, 'c', 101, 1),
(407, 'c', 101, 0),
(408, 'c', 101, 0),
(409, 'a1', 101, 1),
(410, 'a2', 101, 1),
(411, 'a3', 101, 1),
(412, 'a4', 101, 1),
(413, 'q1', 104, 0),
(414, 'q2', 104, 0),
(415, 'q3', 104, 0),
(416, 'q4', 104, 0),
(417, 'q1', 104, 0),
(418, 'q2', 104, 0),
(419, 'q3', 104, 0),
(420, 'q4', 104, 0),
(421, '1', 106, 0),
(422, '2', 106, 0),
(423, '3', 106, 0),
(424, '4', 106, 0),
(425, '1', 106, 0),
(426, '2', 106, 0),
(427, '3', 106, 0),
(428, '4', 106, 0),
(429, '1', 106, 0),
(430, '2', 106, 0),
(431, '3', 106, 0),
(432, '4', 106, 0),
(433, '1', 106, 0),
(434, '2', 106, 0),
(435, '3', 106, 0),
(436, '4', 106, 0),
(437, 'ض', 110, 0),
(438, 'ض', 110, 0),
(439, 'ض', 110, 0),
(440, 'ض', 110, 0),
(441, 'ش', 111, 0),
(442, 'ش', 111, 0),
(443, 'ش', 111, 0),
(444, 'ش', 111, 0),
(445, '1', 110, 0),
(446, '2', 110, 0),
(447, '3', 110, 0),
(448, '4', 110, 0),
(449, '1', 110, 0),
(450, '2', 110, 0),
(451, '3', 110, 0),
(452, '4', 110, 0),
(453, '1', 110, 0),
(454, '2', 110, 0),
(455, '3', 110, 0),
(456, '4', 110, 0),
(457, '1', 110, 0),
(458, '2', 110, 0),
(459, '3', 110, 0),
(460, '4', 110, 0),
(461, 'question1', 116, 0),
(462, '3', 116, 0),
(463, '4', 116, 0),
(464, '6', 116, 0),
(465, 'question12222222222222222222222222222222222222222222222222222', 117, 0),
(466, '32222222222222222222222222222222222222222222222222222222222222223ee@###', 117, 0),
(467, '4@@@@@@@@@@@@@@@@@##############$$$222EEE1111', 117, 0),
(468, '4@@@@@@@@@@@@@@@@@##############$$$222EEE1111', 117, 0),
(469, '1', 118, 1),
(470, '2', 118, 1),
(471, '3', 118, 1),
(472, '4', 118, 1),
(473, '1', 119, 0),
(474, '2', 119, 0),
(475, '3', 119, 0),
(476, '4', 119, 0),
(477, '1', 120, 1),
(478, '2', 120, 1),
(479, '3de', 120, 1),
(480, 'e', 120, 1),
(481, 'q1', 121, 1),
(482, 'q2', 121, 1),
(483, 'q3', 121, 1),
(484, 'q4', 121, 1),
(485, 'مهمه جدا ', 122, 1),
(486, 'غير مهمه ', 122, 1),
(487, 'مهمه جدا جدا ', 122, 1),
(488, 'غير مهمه اطلاقا ', 122, 1),
(489, 'مهم ', 123, 1),
(490, 'مهم جدا ', 123, 0),
(491, 'غير مهم ', 123, 0),
(492, 'مهم جدا جدا ', 123, 0),
(493, 'تحسين الأداء: يمكن للتدريب تحسين أداء الموظفين عن طريق تطوير مهاراتهم ومعرفتهم. ذلك يساعد في زيادة إنتاجية العمل وجودة الخدمة.\r\n\r\n', 124, 0),
(494, 'تطوير المهارات: يمكن للتدريب تزويد الموظفين بالمهارات الجديدة والتقنيات الحديثة التي تساعدهم في مواكبة التطورات في مجالهم.\r\n\r\nزيادة التفوقية: تساعد التدريب على تعزيز تفوق المنظمة في سوق العمل من خلال تمكين الموظفين من تحقيق أعلى مستويات الأداء والكفاءة.\r\n', 124, 0),
(495, 'زيادة التفوقية: تساعد التدريب على تعزيز تفوق المنظمة في سوق العمل من خلال تمكين الموظفين من تحقيق أعلى مستويات الأداء والكفاءة.\r\n\r\n', 124, 0),
(496, 'رفع معنويات الموظفين: عندما يشعرون الموظفون بأن المؤسسة تستثمر في تطويرهم وتحسين مهاراتهم، فإن ذلك يؤدي إلى زيادة معنوياتهم وإشباعهم في العمل.\r\n\r\n', 124, 0),
(497, '1', 125, 0),
(498, '2', 125, 0),
(499, '3', 125, 0),
(500, '4', 125, 0),
(501, '1', 126, 0),
(502, '2', 126, 0),
(503, '3', 126, 0),
(504, '4', 126, 0),
(505, '1', 127, 0),
(506, '2', 127, 0),
(507, '3', 127, 1),
(508, '4', 127, 0),
(509, 'مهم ', 128, 0),
(510, 'مهم جدا ', 128, 0),
(511, 'غير مهم ', 128, 0),
(512, 'مهم جدا جدا ', 128, 0),
(513, '1', 129, 0),
(514, '2', 129, 0),
(515, '3', 129, 0),
(516, '4', 129, 0),
(517, '1', 1, 1),
(518, '1', 1, 0),
(519, '1', 1, 0),
(520, '1', 1, 0),
(521, '1', 131, 0),
(522, '2', 131, 0),
(523, '3', 131, 0),
(524, '4', 131, 1),
(525, 'مهمه جدا', 132, 0),
(526, 'مهمه جدا جدا', 132, 1),
(527, 'مهمه ', 132, 0),
(528, 'ليست مهمه ', 132, 0),
(533, '2', 133, 0),
(534, '2', 133, 0),
(535, '2', 133, 1),
(536, '2', 133, 0),
(537, 'مهمه ', 135, 1),
(538, 'مهمه جدا ', 135, 0),
(539, 'مهمه جدا ', 135, 0),
(540, 'مهمه جدا ', 135, 0),
(541, 'مهمه ', 136, 0),
(542, 'مهمه جدا ', 136, 1),
(543, 'مهمه ', 136, 0),
(544, 'مهمه جدا جدا ', 136, 0),
(545, 'مهم جدا ', 137, 0),
(546, 'مهم ', 137, 1),
(547, 'مهم جدا جدا ', 137, 0),
(548, 'مهم ', 137, 0),
(549, 'مهمه ', 138, 0),
(550, 'مهمه جداا', 138, 1),
(551, 'جداا', 138, 0),
(552, 'مهمه ', 138, 0),
(553, '5', 139, 1),
(554, '5', 139, 0),
(555, '3', 139, 0),
(556, '4', 139, 0),
(557, '1', 140, 0),
(558, '6', 140, 0),
(559, '9', 140, 1),
(560, '8', 140, 0),
(561, '5', 141, 0),
(562, '6', 141, 0),
(563, '5', 141, 1),
(564, '2', 141, 0),
(565, 'مهم ', 141, 0),
(566, 'مهم ', 141, 0),
(567, 'مهم ', 141, 1),
(568, 'مهم ', 141, 0),
(569, 'مهم ', 143, 0),
(570, 'مهم ', 143, 1),
(571, 'مهم ', 143, 0),
(572, 'مهم ', 143, 0),
(577, '1', 144, 0),
(578, '2', 144, 0),
(579, '3', 144, 1),
(580, '4', 144, 0),
(581, '6', 144, 1),
(582, '2', 144, 0),
(583, '3', 144, 0),
(584, '5', 144, 0),
(585, '12', 147, 1),
(586, '645', 147, 0),
(587, '546', 147, 0),
(588, '312', 147, 0),
(589, 'df', 148, 1),
(590, 'f', 148, 0),
(591, 'df', 148, 0),
(592, 'd', 148, 0),
(593, 'd', 149, 0),
(594, 'd', 149, 0),
(595, 'd', 149, 1),
(596, 'f', 149, 0),
(597, 'يب', 150, 0),
(598, 'ي', 150, 1),
(599, 'ي', 150, 0),
(600, 'ب', 150, 0),
(601, '1', 151, 0),
(602, '2', 151, 1),
(603, '3', 151, 0),
(604, '4', 151, 0),
(605, 'a', 152, 0),
(606, 'b', 152, 0),
(607, 'c', 152, 1),
(608, 'd', 152, 0),
(609, 'مهم ', 153, 0),
(610, 'مهم ', 153, 0),
(611, 'مهم ', 153, 0),
(612, 'مهم ', 153, 1),
(613, '1', 154, 1),
(614, '2', 154, 0),
(615, '3', 154, 0),
(616, '4', 154, 0),
(621, '1', 155, 0),
(622, '2', 155, 0),
(623, '3', 155, 0),
(624, '4', 155, 1),
(625, 'سؤال صعب', 155, 0),
(626, 'سؤال صعب جدا', 155, 1),
(627, 'سؤال يراودني', 155, 0),
(628, 'سؤال يراودنييي', 155, 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_team`
--

CREATE TABLE `service_team` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pass_code` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `service_team`
--

INSERT INTO `service_team` (`id`, `name`, `email`, `password`, `pass_code`) VALUES
(2, 'mohamed', 'mohamedramadan2930@gmail.com', '123456789', NULL),
(6, 'mamhoud service', 'mmabuhassira@gmail.com', '123456789', NULL),
(7, 'Aya ', 'aya@gmail.com', '123456', NULL),
(8, 'mo', 'mo@gmail.com', '123456', NULL),
(10, 'rawan', 'rawan@gmail.com', '123456', NULL),
(18, 'TASNEM', 'tasnem.soft@gmail.com', '12345678', NULL),
(20, 'Fatma', 'fatmaalzharaa.softzone@gmail.com', '123456', NULL),
(21, 'mahmoud', 'mahmouud@gmail.com', '693582777', NULL),
(22, 'fatma', '', '123', NULL),
(23, 'ali', 'hocid31336@wermink.com', '123456', NULL),
(24, '@', '.@gmail.com', '@', NULL),
(25, '    ', '', '         ', NULL),
(26, '    ', '', '    ', NULL),
(28, 'ABDELRAHMAN', 'abdelrahman@gmail.com', '12345678', NULL),
(30, 'ibrahiem', 'ibrahiem@gmail.com', '123456789', NULL),
(31, 'AAya', 'ayaemara226@gmail.com', '12345678a', NULL),
(34, 'admin4', 'admin4@gmail.com', '12345678', NULL),
(35, 'RAWANT', 'rawantare770@gmail.com', 'ADMIN123', NULL),
(36, 'RAWANTT', 'rawantarek770@gmail.com', 'admin123', NULL),
(37, 'admin55', 'rawan55@gmail.com', 'admin123', NULL),
(38, 'admin555', 'rawan77@gmail.com', 'admin123', NULL),
(39, 'ayayya', 'ayayya@gmail.com', '12345678', NULL),
(40, 'admin8', 'rawan8@gmail.com', 'admin123', NULL),
(41, 'admin9', 'rawan9@gmail.com', 'admin123', NULL),
(42, 'llllalal', 'ayayyeea@gmail.com', '12345678', NULL),
(43, 'RAWANNN', 'tihen29300@wikfee.com', 'admin123', NULL),
(44, 'Alall', 'ayaemar33453@gmail.com', '12345678', NULL),
(45, 'ayayaya', 'aya44543@gmail.com', '12345678', NULL),
(47, 'يسسسسسس', 'cogawij370@armablog.com', 'entifkut_entiqa_test', NULL),
(48, 'admin', 'testnn@gmail.com', 'eqN6yfSx', NULL),
(49, 'rawantarek', 'rawantarek728@gmail.com', 'rawan123', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int NOT NULL,
  `ind_subscribe` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `company_subscribe` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `ind_subscribe`, `company_subscribe`) VALUES
(2, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id` int NOT NULL,
  `com_id` int NOT NULL,
  `with_method` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `with_price` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `with_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `with_status` int NOT NULL DEFAULT '0',
  `with_admin_noti` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `batches_notification`
--
ALTER TABLE `batches_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `change_status_notification`
--
ALTER TABLE `change_status_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `coash_notification`
--
ALTER TABLE `coash_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ind_exam` (`ind_id`),
  ADD KEY `coash_exam` (`coash_id`);

--
-- Indexes for table `company_register`
--
ALTER TABLE `company_register`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `company_review`
--
ALTER TABLE `company_review`
  ADD PRIMARY KEY (`rev_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `contract_cancel`
--
ALTER TABLE `contract_cancel`
  ADD PRIMARY KEY (`con_cancel_id`);

--
-- Indexes for table `contract_complete`
--
ALTER TABLE `contract_complete`
  ADD PRIMARY KEY (`con_com_id`);

--
-- Indexes for table `coshes`
--
ALTER TABLE `coshes`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `exam_noti`
--
ALTER TABLE `exam_noti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ind_congrat`
--
ALTER TABLE `ind_congrat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ind_cong` (`ind_id`);

--
-- Indexes for table `ind_register`
--
ALTER TABLE `ind_register`
  ADD PRIMARY KEY (`ind_id`);

--
-- Indexes for table `ind_review`
--
ALTER TABLE `ind_review`
  ADD PRIMARY KEY (`rev_id`);

--
-- Indexes for table `interview_notificaion`
--
ALTER TABLE `interview_notificaion`
  ADD PRIMARY KEY (`noti_id`);

--
-- Indexes for table `message_notification`
--
ALTER TABLE `message_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`ques_id`),
  ADD KEY `ques_exam` (`exam_id`);

--
-- Indexes for table `question_answer`
--
ALTER TABLE `question_answer`
  ADD PRIMARY KEY (`ques_ans_id`);

--
-- Indexes for table `question_option`
--
ALTER TABLE `question_option`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `ques_option` (`question_id`);

--
-- Indexes for table `service_team`
--
ALTER TABLE `service_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `batch_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `batches_notification`
--
ALTER TABLE `batches_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `change_status_notification`
--
ALTER TABLE `change_status_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coash_notification`
--
ALTER TABLE `coash_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `company_register`
--
ALTER TABLE `company_register`
  MODIFY `com_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `company_review`
--
ALTER TABLE `company_review`
  MODIFY `rev_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `con_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `contract_cancel`
--
ALTER TABLE `contract_cancel`
  MODIFY `con_cancel_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `contract_complete`
--
ALTER TABLE `contract_complete`
  MODIFY `con_com_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `coshes`
--
ALTER TABLE `coshes`
  MODIFY `co_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `ex_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `exam_noti`
--
ALTER TABLE `exam_noti`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ind_congrat`
--
ALTER TABLE `ind_congrat`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ind_register`
--
ALTER TABLE `ind_register`
  MODIFY `ind_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT for table `ind_review`
--
ALTER TABLE `ind_review`
  MODIFY `rev_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `interview_notificaion`
--
ALTER TABLE `interview_notificaion`
  MODIFY `noti_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `message_notification`
--
ALTER TABLE `message_notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `ques_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `question_answer`
--
ALTER TABLE `question_answer`
  MODIFY `ques_ans_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `question_option`
--
ALTER TABLE `question_option`
  MODIFY `option_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=629;

--
-- AUTO_INCREMENT for table `service_team`
--
ALTER TABLE `service_team`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_exam` FOREIGN KEY (`exam_id`) REFERENCES `exam` (`ex_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

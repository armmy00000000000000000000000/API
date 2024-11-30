-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2024 at 09:52 AM
-- Server version: 8.0.36
-- PHP Version: 8.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoponline_partner`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `name`, `status`, `date_time`) VALUES
(1, 'admin@admin.com', '$2y$10$I6RIlzGvFEImBT.RohucEu0U7XnHzn0wssYcofhstPyk48mH2wYAe', 'armmy', 'admin', '2024-10-25 06:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `list_preview_product`
--

CREATE TABLE `list_preview_product` (
  `id` int NOT NULL,
  `img_preview` varchar(255) NOT NULL,
  `id_product` int NOT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `list_preview_product`
--

INSERT INTO `list_preview_product` (`id`, `img_preview`, `id_product`, `date_time`) VALUES
(1, 'preview_product/product_6721ee510d7ed9.22226086.png', 3, '2024-10-30 15:29:05'),
(2, 'preview_product/product_6721ee97d9c1f5.38566294.png', 3, '2024-10-30 15:30:15'),
(3, 'preview_product/product_6721ee9a350e22.40349009.png', 3, '2024-10-30 15:30:18'),
(5, 'preview_product/product_6731cadad679d8.61265877.png', 28, '2024-11-11 16:14:02'),
(12, 'preview_product/product_6731d12500ee78.22740511.png', 29, '2024-11-11 16:40:53'),
(14, 'preview_product/product_6732bb324a2336.27699249.png', 27, '2024-11-12 09:19:30'),
(15, 'preview_product/product_6732bb4d6d8670.41956085.png', 27, '2024-11-12 09:19:57'),
(16, 'preview_product/product_67344579537a76.28296115.png', 30, '2024-11-13 13:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `login_store`
--

CREATE TABLE `login_store` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_store` int NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `login_store`
--

INSERT INTO `login_store` (`id`, `email`, `password`, `id_store`, `status`, `date_time`) VALUES
(1, 'armmy7777@gmail.com', '$2y$10$xCAURZHtiWbNUZXhFpf3OONCfubVGNoqxwLWCGqlv3pxhq5A7hTdS', 2, 'manager', '2024-10-21 15:33:25'),
(9, 'arm000@gmail.com', '$2y$10$mrhsYTnIOuUFqv6hzJRWkuAvfufux.59nqsJ/0FuYsqo1C1X6eA/.', 2, 'manager', '2024-10-30 15:32:01'),
(10, 'lima551@gmail.com', '$2y$10$/.pzTbAbxFcgePM6IieqoO.LuSXocXRheE4ue0Xsw6BPEpZNz3Tjy', 2, 'employee', '2024-10-30 15:36:11'),
(11, 'store@gmail.com', '$2y$10$5x8s09kEtOexJd6mikNzx.QNQ6QpeGHS975/yyLy7e0ZEML/tWJYK', 2, 'employee', '2024-10-30 15:38:40'),
(12, 'lima03@gmail.com', '$2y$10$EGQSHsXNJ5Kb5Kt6nktU4.2.ZSnrDNHQnf2edwWXs8qew3Hc3S6PK', 2, 'employee', '2024-10-30 15:39:15'),
(13, 'lima011@gmail.com', '$2y$10$UUfJslUetunsKKnBRsIolePP0UOUZJaKksQs67BmDHpnAhq0IWQvq', 2, 'employee', '2024-10-30 15:39:38'),
(14, 'armmy22@gmail.com', '$2y$10$kGT5rZywQmP985FC8KCVuebj/EbSYj8rhflbXXQOS0sxaU.4QNBoW', 2, 'manager', '2024-10-30 15:40:40'),
(18, 'lima01@gmail.com', '$2y$10$aR41kAjYeHC8A5oEy8KWvuhe0SVO/qn.0zwfWE2Wfs70smZi/e0v2', 16, 'manager', '2024-11-02 15:44:55'),
(19, 'lima@gmail.com', '$2y$10$Wb.fieWCmBrEHMHCUyc8YOwhNxexrIBx5JJI1.2byh1XuTmYIJ/dy', 2, 'manager', '2024-11-04 14:32:25'),
(20, 'lima55@gmail.com', '$2y$10$MkF8pTfDU7SQREgM/Ojz3uHkJPL/KMY57g2syaXm6y3ciY1FqCo.6', 4, 'manager', '2024-11-11 10:37:03'),
(21, 'lima19@gmail.com', '$2y$10$OtbF4EeHWyZ3mwRreijr8OTAX7jvwlaOmHwIC57Ralk3olEsdve.G', 19, 'manager', '2024-11-11 10:45:50'),
(22, 'lima23@gmail.com', '$2y$10$7.iCUARMBYYOPyZt7kdine/4VChUOFQozqJ6h6o4r3mRzQUOIGZbu', 17, 'manager', '2024-11-13 13:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `order_date` datetime NOT NULL,
  `product_id` int NOT NULL,
  `store_id` int NOT NULL,
  `quantity` int NOT NULL,
  `size` varchar(50) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `buyer_id` int DEFAULT NULL,
  `shipping_address` varchar(50) DEFAULT NULL,
  `payment_status` enum('pending','approved','cancel') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `payment_method` varchar(50) DEFAULT NULL,
  `slip` varchar(255) DEFAULT NULL,
  `line_token` varchar(255) DEFAULT NULL,
  `preparation_status` enum('awaiting_payment_verification','preparing','shipped') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'awaiting_payment_verification',
  `shipping_status` enum('pending','shipped') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `shipping_provider` varchar(100) DEFAULT NULL,
  `tracking_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `order_date`, `product_id`, `store_id`, `quantity`, `size`, `total_price`, `buyer_id`, `shipping_address`, `payment_status`, `payment_method`, `slip`, `line_token`, `preparation_status`, `shipping_status`, `shipping_provider`, `tracking_number`, `created_at`, `updated_at`) VALUES
(22, '02320241029002', '2024-10-29 10:55:30', 3, 2, 30, '3', 300.00, 1, '1', 'approved', 'qrcode', 'slips/02320241029002_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'shipped', 'pending', 'Kerry Expres', '#0202020202020202', '2024-10-29 03:55:30', '2024-10-31 09:11:06'),
(23, '02320241029003', '2024-10-29 10:56:11', 3, 2, 30, '3', 300.00, 1, '1', 'approved', 'qrcode', 'slips/02320241029003_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'shipped', 'pending', 'Kerry Expres', '#0202020202020202', '2024-10-29 03:56:11', '2024-10-31 05:52:32'),
(28, '02320241030001', '2024-10-30 10:40:00', 3, 2, 30, '', 300.00, 1, '1', 'approved', 'qrcode', 'slips/02320241030001_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'shipped', 'pending', 'Kerry Expres', '#0202020202020203', '2024-10-30 03:40:00', '2024-10-31 09:11:12'),
(29, '02320241030002', '2024-10-30 10:40:06', 3, 2, 30, '', 300.00, 1, '1', 'approved', 'ิิิิิิิิิิิิbank', 'slips/02320241030002_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'preparing', 'pending', '', '', '2024-10-30 03:40:06', '2024-11-08 04:19:34'),
(30, '02320241030003', '2024-10-30 10:40:11', 3, 2, 30, '', 300.00, 1, '1', 'approved', 'qrcode', 'slips/02320241030003_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'preparing', 'pending', '', '', '2024-10-30 03:40:11', '2024-11-08 05:00:34'),
(31, '02320241030004', '2024-10-30 10:40:23', 3, 2, 30, '', 300.00, 1, '1', 'approved', 'qrcode', 'slips/02320241030004_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'shipped', 'pending', '', '', '2024-10-30 03:40:23', '2024-11-08 08:38:35'),
(48, '021320241030005', '2024-10-30 13:22:02', 13, 2, 30, '', 300.00, 1, '1', 'approved', 'ิิิิิิิิิิิิbank', 'slips/021320241030005_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'preparing', 'pending', '', '', '2024-10-30 06:22:02', '2024-11-08 05:10:39'),
(49, '021320241030006', '2024-10-30 13:23:34', 13, 2, 30, '', 300.00, 1, '1', 'approved', 'ิิิิิิิิิิิิbank', 'slips/021320241030006_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'preparing', 'pending', '', '', '2024-10-30 06:23:34', '2024-11-08 06:36:39'),
(50, '031320241030001', '2024-10-30 13:24:17', 13, 2, 30, '', 300.00, 1, '1', 'pending', NULL, NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-30 06:24:17', '2024-10-31 05:52:45'),
(51, '021320241031001', '2024-10-31 10:01:48', 13, 2, 30, '', 300.00, 1, '1', 'pending', NULL, NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 03:01:48', '2024-10-31 05:52:47'),
(52, '021320241031002', '2024-10-31 11:28:51', 13, 2, 30, '', 300.00, 1, '1', 'cancel', NULL, NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 04:28:51', '2024-10-31 05:52:48'),
(53, '021320241031003', '2024-10-31 13:04:26', 13, 2, 30, '', 300.00, 1, '1', 'pending', 'ิิิิิิิิิิิิbank', NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 06:04:26', '2024-10-31 09:34:37'),
(54, '021320241031004', '2024-10-31 13:08:09', 13, 2, 30, '', 300.00, 1, '1', 'pending', NULL, NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 06:08:09', '2024-10-31 06:08:38'),
(55, '021320241031005', '2024-10-31 13:09:11', 13, 2, 30, '', 300.00, 1, '', 'pending', '', NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 06:09:11', '2024-10-31 06:09:11'),
(56, '021320241031006', '2024-10-31 14:40:57', 13, 2, 30, '', 300.00, 1, '', 'pending', '', NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 07:40:57', '2024-10-31 07:40:57'),
(57, '021320241031007', '2024-10-31 14:42:28', 13, 2, 30, '', 300.00, 1, NULL, 'pending', NULL, NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 07:42:28', '2024-10-31 07:42:28'),
(58, '021320241031008', '2024-10-31 14:42:50', 13, 2, 30, '', 300.00, 1, '', 'pending', '', NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 07:42:50', '2024-10-31 07:42:50'),
(59, '021320241031009', '2024-10-31 14:43:15', 13, 2, 30, '', 300.00, 1, '', 'pending', '', NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 07:43:15', '2024-10-31 07:43:15'),
(60, '02320241031010', '2024-10-31 14:54:20', 3, 2, 4, '2', 1120.00, 1, '', 'approved', 'ิิิิิิิิิิิิbank', 'slips/021320241030006_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'preparing', 'pending', NULL, NULL, '2024-10-31 07:54:20', '2024-10-31 09:34:42'),
(61, '02320241031011', '2024-10-31 14:54:24', 3, 2, 4, '2', 1120.00, 1, '', 'pending', '', NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 07:54:24', '2024-10-31 07:54:24'),
(62, '02320241031012', '2024-10-31 15:17:32', 3, 2, 3, '5', 840.00, 1, '2', 'pending', 'qrcode', 'slips/02320241031012_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-10-31 08:17:32', '2024-11-01 09:33:28'),
(63, '02320241031013', '2024-10-31 15:21:25', 3, 2, 8, '4', 2240.00, 1, '', 'approved', 'ิิิิิิิิิิิิbank', 'slips/021320241030006_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'preparing', 'pending', NULL, NULL, '2024-10-31 08:21:25', '2024-10-31 09:34:47'),
(64, '02320241031014', '2024-10-31 15:26:42', 3, 2, 20, '6', 5600.00, 1, '', 'approved', 'ิิิิิิิิิิิิbank', 'slips/021320241030006_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'preparing', 'pending', '', '', '2024-10-31 08:26:42', '2024-11-08 02:33:52'),
(65, '02420241101001', '2024-11-01 09:08:12', 4, 2, 1, '', 280.00, 1, '1', 'pending', 'qrcode', 'slips/02420241101001_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-01 02:08:12', '2024-11-01 03:43:02'),
(66, '0242024110100002', '2024-11-01 09:23:57', 4, 2, 3, '', 840.00, 1, '2', 'pending', 'bank', 'slips/0242024110100002_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-01 02:23:57', '2024-11-01 03:42:02'),
(67, '0232024110100003', '2024-11-01 09:27:27', 3, 2, 2, '6', 560.00, 1, '1', 'pending', 'bank', 'slips/0232024110100003_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-01 02:27:27', '2024-11-01 03:37:31'),
(68, '0232024110100004', '2024-11-01 09:32:35', 3, 2, 2, '5', 560.00, 1, '1', 'pending', 'qrcode', 'slips/0232024110100004_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-01 02:32:35', '2024-11-01 03:29:52'),
(69, '02312024110100005', '2024-11-01 09:51:03', 3, 2, 1, '3', 280.00, 1, '1', 'approved', 'qrcode', 'slips/02312024110100005_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'shipped', 'pending', 'Kerry Expres', '#0202020202020203', '2024-11-01 02:51:03', '2024-11-01 03:40:02'),
(70, '02412024110100006', '2024-11-01 16:34:34', 4, 2, 6, '', 1680.00, 1, '1', 'pending', 'bank', 'slips/02412024110100006_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-01 09:34:34', '2024-11-01 09:34:54'),
(71, '021212024110400001', '2024-11-04 11:19:30', 12, 2, 3, '', 840.00, 1, '1', 'pending', 'bank', 'slips/021212024110400001_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-04 04:19:30', '2024-11-04 04:19:42'),
(72, '02512024110400002', '2024-11-04 11:20:15', 5, 2, 3, '', 840.00, 1, '1', 'pending', 'qrcode', 'slips/02512024110400002_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-04 04:20:15', '2024-11-04 04:20:30'),
(73, '02312024110400003', '2024-11-04 14:37:10', 3, 2, 36, '3', 10080.00, 1, '2', 'pending', 'qrcode', 'slips/02312024110400003_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-04 07:37:10', '2024-11-04 07:37:46'),
(74, '02312024110400004', '2024-11-04 14:38:18', 3, 2, 2, '3', 560.00, 1, '2', 'pending', 'qrcode', 'slips/02312024110400004_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-04 07:38:18', '2024-11-04 07:38:30'),
(75, '02312024110400005', '2024-11-04 15:03:59', 3, 2, 30, '3', 8400.00, 1, '4', 'approved', 'bank', 'slips/02312024110400005_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'preparing', 'pending', NULL, NULL, '2024-11-04 08:03:59', '2024-11-04 08:06:19'),
(76, '02312024110400006', '2024-11-04 15:18:25', 3, 2, 1, '', 280.00, 1, '4', 'pending', 'qrcode', 'slips/02312024110400006_014310090305BTF08028.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-04 08:18:25', '2024-11-05 06:29:15'),
(77, '02312024110400007', '2024-11-04 15:18:47', 3, 2, 5, '', 280.00, 1, '', 'pending', '', NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-04 08:18:47', '2024-11-04 08:18:47'),
(78, '02312024110400008', '2024-11-04 16:53:36', 3, 2, 1, '5', 280.00, 1, '4', 'pending', 'qrcode', 'slips/02312024110400008_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-04 09:53:36', '2024-11-04 09:53:48'),
(79, '02312024110400009', '2024-11-04 17:10:21', 3, 2, 2, '6', 560.00, 1, '1', 'pending', 'qrcode', 'slips/02312024110400009_014309085320APM00052.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-04 10:10:21', '2024-11-04 10:10:42'),
(80, '02312024110500001', '2024-11-05 12:53:06', 3, 2, 3, '1', 840.00, 1, '4', 'pending', 'qrcode', 'slips/02312024110500001_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-05 05:53:06', '2024-11-05 05:53:16'),
(81, '02512024110500002', '2024-11-05 13:15:34', 5, 2, 1, '', 280.00, 1, '1', 'pending', 'bank', 'slips/02512024110500002_014310090305BTF08028.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-05 06:15:34', '2024-11-05 06:15:50'),
(82, '02412024110500003', '2024-11-05 15:07:21', 4, 2, 2, ' ', 560.00, 1, '2', 'pending', 'bank', 'slips/02412024110500003_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-05 08:07:21', '2024-11-05 08:07:33'),
(83, '02372024110500004', '2024-11-05 16:21:00', 3, 2, 2, '5', 560.00, 7, '5', 'pending', 'qrcode', 'slips/02372024110500004_014310140155ATF07163.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-05 09:21:00', '2024-11-05 09:21:28'),
(84, '02372024110500005', '2024-11-05 16:40:27', 3, 2, 2, '3', 560.00, 7, '5', 'pending', 'bank', 'slips/02372024110500005_slip-history-05.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-05 09:40:27', '2024-11-05 09:40:38'),
(85, '021512024110600001', '2024-11-06 15:04:15', 15, 2, 5, '', 280.00, 1, '', 'pending', '', NULL, 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-06 08:04:15', '2024-11-06 08:04:15'),
(86, '02572024110700001', '2024-11-07 10:19:09', 5, 2, 5, 'null', 1400.00, 7, '5', 'approved', 'qrcode', 'slips/02572024110700001_014312085801APM01621.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'shipped', 'pending', 'thaipost', '#2020258377', '2024-11-07 03:19:09', '2024-11-08 07:19:43'),
(87, '02572024110800001', '2024-11-08 15:34:18', 5, 2, 2, 'null', 560.00, 7, '5', 'pending', 'bank', 'slips/02572024110800001_014313085426APM09371.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-08 08:34:18', '2024-11-08 08:34:50'),
(88, '022772024111100001', '2024-11-11 13:28:56', 27, 2, 2, '', 318.00, 7, '5', 'pending', 'bank', 'slips/022772024111100001_17928.jpg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-11 06:28:56', '2024-11-11 06:29:33'),
(89, '02572024111300001', '2024-11-13 16:01:49', 5, 2, 2, '', 560.00, 7, '5', 'pending', 'qrcode', 'slips/02572024111300001_014318154549BPP00223.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-13 09:01:49', '2024-11-13 09:02:00'),
(90, '02372024111300002', '2024-11-13 16:05:04', 3, 2, 3, '5', 840.00, 7, '5', 'approved', 'bank', 'slips/02372024111300002_014318121300APP08877.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'shipped', 'pending', 'flash', '#0202154652125', '2024-11-13 09:05:04', '2024-11-13 09:06:27'),
(91, '02572024111900001', '2024-11-19 13:02:02', 5, 2, 3, '', 840.00, 7, '5', 'approved', 'qrcode', 'slips/02572024111900001_014324085024APM13770.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'shipped', 'pending', 'kerry', '#2022215121321212', '2024-11-19 06:02:02', '2024-11-19 06:03:32'),
(92, '02512024112500001', '2024-11-25 15:13:49', 5, 2, 0, '', 0.00, 1, '4', 'pending', 'qrcode', 'slips/02512024112500001_014330084422BPM13337.jpeg', 'U82578e5cfaf2a8e5d5f64ea2732949fb', 'awaiting_payment_verification', 'pending', NULL, NULL, '2024-11-25 08:13:49', '2024-11-25 08:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `payment_store`
--

CREATE TABLE `payment_store` (
  `id_payment` int NOT NULL,
  `payment_name` varchar(255) NOT NULL,
  `account_owner` varchar(255) NOT NULL,
  `qr_payment` varchar(255) DEFAULT NULL,
  `number_payment` varchar(255) NOT NULL,
  `id_store` int NOT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `payment_store`
--

INSERT INTO `payment_store` (`id_payment`, `payment_name`, `account_owner`, `qr_payment`, `number_payment`, `id_store`, `date_time`) VALUES
(4, 'ธนาคารกรุงเทพ', 'Chaiya Tonsai', 'qr_payment/qr_67346d67cfbd19.76525838.webp', '1348925758888', 2, '2024-10-28 12:48:14'),
(5, 'ธนาคารกรุงไทย', 'ไชยา ต้นสาย', 'qr_payment/qr_67317cb4f374f9.95442617.png', '0990239924', 4, '2024-11-11 10:40:36'),
(6, 'ธนาคารกรุงไทย', 'ไชยา ต้นสาย', NULL, '0990239924', 5, '2024-11-11 10:40:49'),
(7, 'ธนาคารกรุงไทย', 'aasaaa', 'qr_payment/qr_6734447fbf7aa3.83346364.png', '12345678989', 19, '2024-11-11 11:14:01'),
(8, 'ธนาคารออมสิน', 'lima 239 Shop', 'qr_payment/qr_673433a56dea65.60523056.png', '1234567890', 16, '2024-11-13 12:05:41'),
(9, 'ธนาคารกรุงไทย', 'lima23 Shop', 'qr_payment/qr_6734450ea152c1.35951264.png', '2323232323230', 17, '2024-11-13 13:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id_category` int NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id_category`, `category_name`, `date_time`) VALUES
(1, 'ของใช้', '2024-10-26 16:19:27'),
(2, 'เสื้อผ้า', '2024-10-26 16:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id_rating` int NOT NULL,
  `id_product` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id_rating`, `id_product`, `user_id`, `rating`, `created_at`) VALUES
(1, 4, 1, 1.0, '2024-10-29 06:16:36'),
(2, 4, 2, 4.5, '2024-10-29 06:17:05'),
(3, 4, 3, 4.5, '2024-10-29 06:17:12'),
(4, 4, 4, 2.5, '2024-10-29 06:17:21'),
(5, 3, 4, 2.5, '2024-10-29 06:55:02'),
(6, 5, 4, 3.5, '2024-10-29 06:55:35'),
(7, 10, 4, 1.5, '2024-10-30 04:03:07'),
(8, 10, 2, 5.0, '2024-10-30 04:04:29'),
(9, 5, 1, 5.0, '2024-11-04 04:12:26'),
(10, 10, 1, 5.0, '2024-11-04 04:13:01'),
(12, 3, 2, 3.0, '2024-11-04 04:17:20'),
(14, 27, 1, 5.0, '2024-11-11 06:30:05'),
(15, 26, 1, 2.0, '2024-11-11 06:59:23'),
(16, 3, 1, 4.0, '2024-11-13 09:05:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `id` int NOT NULL,
  `size` varchar(100) DEFAULT NULL,
  `id_product` varchar(100) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`id`, `size`, `id_product`, `datetime`) VALUES
(1, 'S', '3', '2024-10-26 09:57:11'),
(2, 'M', '3', '2024-10-26 09:57:17'),
(3, 'XL', '3', '2024-10-26 09:57:24'),
(4, '2XL', '3', '2024-10-26 09:57:31'),
(5, '3XL', '3', '2024-10-26 09:57:37'),
(6, '4XL', '3', '2024-10-28 02:57:18'),
(9, '8XL', '3', '2024-11-11 09:58:51'),
(11, 'M', '29', '2024-11-11 10:03:20'),
(13, 'M', '27', '2024-11-12 02:20:24'),
(15, 'S', '27', '2024-11-12 02:21:49'),
(20, 'M', '28', '2024-11-13 06:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `product_store`
--

CREATE TABLE `product_store` (
  `id_product` int NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `id_category` int NOT NULL,
  `option_product` varchar(255) DEFAULT NULL,
  `quantity_product` int NOT NULL,
  `quantity_sold` int DEFAULT NULL,
  `price_product` decimal(10,2) NOT NULL,
  `preview_product` varchar(255) DEFAULT NULL,
  `product_detall` text,
  `id_store` varchar(50) DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `publish_status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `product_store`
--

INSERT INTO `product_store` (`id_product`, `name_product`, `id_category`, `option_product`, `quantity_product`, `quantity_sold`, `price_product`, `preview_product`, `product_detall`, `id_store`, `date_time`, `publish_status`) VALUES
(3, 'ของที่ระลึกเสื้อหมูเด้ง', 2, 'yes', 381, 300, 280.00, 'preview_product/product_671cb7db0322c9.54931292.png', 'ของที่ระลึกสุดน่ารักของหมูเด้ง', '2', '2024-10-26 16:35:23', 'public'),
(4, 'ของที่ระลึกหมวกหมูเด้ง', 2, 'no', 475, 125, 280.00, 'preview_product/product_671cb8355b2ab1.04621537.png', 'ของที่ระลึกสุดน่ารักของหมูเด้ง', '2', '2024-10-26 16:36:53', 'private'),
(5, 'ของที่ระลึกหมวกหมูเด้ง', 2, 'no', 556, 44, 280.00, 'preview_product/product_671cb8504809e9.12327691.png', 'ของที่ระลึกสุดน่ารักของหมูเด้ง', '2', '2024-10-26 16:37:20', 'public'),
(10, 'ของที่ระลึกหมวกหมูเด้ง', 2, 'yes', 6000, 600, 2800.00, 'preview_product/product_671f182c52d753.64277055.png', 'ของที่ระลึกสุดน่ารักของหมูเด้ง zoo', '2', '2024-10-28 11:34:56', 'public'),
(13, 'ของที่ระลึกหมวกหมูเด้ง', 2, 'no', 586, 14, 280.00, 'preview_product/product_671f1abcca9066.48606079.png', 'ของที่ระลึกสุดน่ารักของหมูเด้ง', '2', '2024-10-28 12:01:48', 'private'),
(15, 'ของที่ระลึกหมวกหมูเด้ง', 2, 'no', 595, 5, 280.00, 'preview_product/product_672b22ca90f1f9.01777843.png', 'ของที่ระลึกสุดน่ารักของหมูเด้ง', '2', '2024-11-06 15:03:22', 'private'),
(26, 'เสื้อเด้งๆ', 2, 'yes', 3999, 1, 599.00, 'preview_product/product_6732bf0285e576.19596560.png', 'หมูเด้ง', '2', '2024-11-09 12:01:24', 'public'),
(27, 'กะทะคากิ', 1, 'yes', 598, 2, 159.00, 'preview_product/product_672f2585375b26.00974062.png', 'กะทะไฟฟ้า', '2', '2024-11-09 12:03:04', 'public'),
(28, 'เสื้อเด้งๆ -edit', 1, 'yes', 4000, NULL, 599.00, 'preview_product/product_6731aeeaa6cdb0.55807862.png', 'หมูเด้ง -edit', '19', '2024-11-11 14:14:50', 'undefined'),
(29, 'เสื้อเด้งๆ ', 2, 'yes', 4000, NULL, 599.00, 'preview_product/product_6731cc942ef272.24351716.png', 'หมูเด้ง -edit', '19', '2024-11-11 16:21:24', 'undefined'),
(30, 'กางเกงหมู่เด้ง', 2, 'no', 8900, NULL, 359.00, 'preview_product/product_673446af838633.40561852.png', 'หมูเด้ง-สวนสัตว์เปิดเขาเขียว', '17', '2024-11-13 13:21:24', 'private');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id_cart` int NOT NULL,
  `id_user` int NOT NULL,
  `id_product` int NOT NULL,
  `name_product` varchar(255) NOT NULL,
  `quantity_product` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `size` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `id_store` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `shopping_cart`
--

INSERT INTO `shopping_cart` (`id_cart`, `id_user`, `id_product`, `name_product`, `quantity_product`, `unit_price`, `total_price`, `size`, `date_time`, `id_store`) VALUES
(1, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 30, 280.00, 300.00, '3', '2024-10-30 13:40:38', 2),
(2, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, '3', '2024-11-04 11:39:12', 2),
(3, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, '3', '2024-11-05 14:47:53', 2),
(4, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, '\'\'', '2024-11-05 14:54:28', 2),
(5, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, 'hjj', '2024-11-05 14:57:57', 2),
(6, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, '\'\'', '2024-11-05 14:59:57', 2),
(7, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, '\'\'', '2024-11-05 15:04:51', 2),
(8, 1, 5, 'ของที่ระลึกหมวกหมูเด้ง', 1, 280.00, 280.00, '3', '2024-11-05 15:05:17', 2),
(9, 1, 4, 'ของที่ระลึกหมวกหมูเด้ง', 1, 280.00, 280.00, ' ', '2024-11-05 15:06:57', 2),
(10, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 2, 280.00, 560.00, '6', '2024-11-05 15:11:13', 2),
(21, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, '\' \'', '2024-11-05 16:25:09', 2),
(26, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, '4', '2024-11-05 16:26:10', 2),
(29, 1, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 1, 280.00, 280.00, '\'\'', '2024-11-05 16:28:10', 2),
(32, 7, 5, 'ของที่ระลึกหมวกหมูเด้ง', 1, 280.00, 280.00, 'null', '2024-11-05 16:39:50', 2),
(33, 7, 3, 'ของที่ระลึกเสื้อหมูเด้ง', 2, 280.00, 560.00, '3', '2024-11-05 16:40:13', 2),
(34, 7, 4, 'ของที่ระลึกหมวกหมูเด้ง', 1, 280.00, 280.00, 'null', '2024-11-05 16:42:25', 2),
(35, 7, 5, 'ของที่ระลึกหมวกหมูเด้ง', 5, 280.00, 1400.00, 'null', '2024-11-07 10:18:54', 2),
(36, 7, 27, 'กะทะคากิ', 1, 159.00, 159.00, 'null', '2024-11-11 13:29:56', 2),
(37, 7, 27, 'กะทะคากิ', 3, 159.00, 477.00, 'null', '2024-11-11 13:30:01', 2),
(38, 7, 5, 'ของที่ระลึกหมวกหมูเด้ง', 1, 280.00, 280.00, 'null', '2024-11-12 14:35:34', 2),
(39, 7, 5, 'ของที่ระลึกหมวกหมูเด้ง', 10, 280.00, 2800.00, 'null', '2024-11-19 13:10:21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `store_data`
--

CREATE TABLE `store_data` (
  `id_store` int NOT NULL,
  `store_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `store_detail` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `img_profile_store` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `status_store` varchar(50) DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `store_data`
--

INSERT INTO `store_data` (`id_store`, `store_name`, `store_detail`, `img_profile_store`, `status`, `phone`, `status_store`, `date_time`) VALUES
(2, 'Armmy Shop Online', 'ตัวแทนจำหน่ายของที่ระลึก', 'store_profile/product_672f23880dbaf6.85855958._672f23880dbb9.png', 'partner', '0807498791', 'public', '2024-10-21 14:49:55'),
(4, 'armmy shop', 'ร้านค้าตัวแทนจำหน่าย zoo', 'store_profile/671f03bcd12f8_text-logo zooeticket-line-01.png', 'partner', '0990239924', 'private', '2024-10-25 11:53:21'),
(5, 'Chaiyc Shop', 'ร้านค้าตัวแทนจำหน่าย zoo', 'store_profile/671f03bcd12f8_text-logo zooeticket-line-01.png', 'partner', '0990239924', 'public', '2024-10-28 10:23:40'),
(8, 'ร้านค้าตัวแทนจำหน่าย zoo e-ticket-99', 'ร้านค้าตัวแทนจำหน่าย', 'store_profile/product_671f189b6d6334.89445803._671f189b6d63d.png', 'partner', '0807498791', 'public', '2024-10-28 10:29:37'),
(16, 'lims shop239', 'ของที่ระลึก', 'store_profile/product_6725af9988b0c6.28541818._6725af9988b15.png', 'partner', '085-9658749', 'public', '2024-11-02 11:50:33'),
(17, 'lims shop23', 'ของที่ระลึก', 'store_profile/product_6725afae5f2725.02355521._6725afae5f27b.jpg', 'partner', '085-9658749', 'public', '2024-11-02 11:50:54'),
(19, 'lims shop88', 'ตัวแทนจำหน่ายของที่ระลึก', 'store_profile/product_6729945111f454.97514438._6729945111f4e.jpg', 'partner', '0321231234', 'private', '2024-11-05 10:43:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id_address` int NOT NULL,
  `address_name` varchar(255) NOT NULL,
  `address_phon` varchar(15) NOT NULL,
  `address_full` text NOT NULL,
  `address_road` varchar(255) DEFAULT NULL,
  `address_province` varchar(255) DEFAULT NULL,
  `address_district` varchar(255) DEFAULT NULL,
  `address_subdistrict` varchar(255) DEFAULT NULL,
  `address_code` varchar(10) DEFAULT NULL,
  `id_user` varchar(50) DEFAULT NULL,
  `date_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id_address`, `address_name`, `address_phon`, `address_full`, `address_road`, `address_province`, `address_district`, `address_subdistrict`, `address_code`, `id_user`, `date_time`) VALUES
(1, 'ไชยา ต้นสาย', '0990239924', '123 หมู่.10 บ้านโนนศิริ ตำบลโนนกลาง', '-', 'จังหวัดอุบลราชธานี', 'อำเภอพิบูลมังสาหาร', 'โนนกลาง', '34110', '1', '2024-10-31 10:23:39'),
(2, 'ไชยา ต้นสาย', '0990239924', '123 หมู่.10 บ้านโนนศิริ ตำบลโนนกลาง', '-', 'จังหวัดอุบลราชธานี', 'อำเภอพิบูลมังสาหาร', 'โนนกลาง', '34110', '1', '2024-10-31 13:00:46'),
(4, 'KUNAKON APIRAT', '0990239924', 'บ้านเลขที่ 123 หมู่ที่ 10 บ.โนนศิริ ต.โนนกลาง', '-', 'อุบลราชธานี', 'พิบูลมังสาหาร', 'โนนกาหลง', '34110', '1', '2024-11-04 15:03:19'),
(5, 'คุณอาร์ม สุดหล่อ', '0990239924', '123/10 บ.โนนสิริ', '-', 'ฉะเชิงเทรา', 'บ้านโพธิ์', 'ดอนทราย', '24140', '7', '2024-11-05 16:18:45'),
(6, 'ศิริมาเมธ์วดี ศิรธนิตรา', '0618182888', '36/4 ', 'สถิตนิมาลการ', 'อุบลราชธานี', 'พิบูลมังสาหาร', 'พิบูล', '34110', 'undefined', '2024-11-11 10:41:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id_user` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `token` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id_user`, `name`, `email`, `token`, `date_time`) VALUES
(1, 'Arm', 'U82578e5cfaf2a8e5d5f64ea2732949fb@Shopzoo.co', 'U82578e5cfaf2a8e5d5f64ea2732949fb', '2024-11-05 04:54:23'),
(2, 'Nim', 'Uff5146ff0367e0112930f21ed9151e0b@Shopzoo.com', 'Uff5146ff0367e0112930f21ed9151e0b', '2024-11-05 06:19:00'),
(3, 'Pacharawora ⑧ ϟ ⑥ ❃', 'Ua9e53efa2b2372f3a3637d5171e77b1e@Shopzoo.com', 'Ua9e53efa2b2372f3a3637d5171e77b1e', '2024-11-05 06:20:25'),
(4, 'Arb', 'U82578e5cfaf2a8e5d5f64ea2732949fm@Shopzoo.com', 'U82578e5cfaf2a8e5d5f64ea2732949fm', '2024-11-05 08:56:41'),
(7, 'Arm', 'U82578e5cfaf2a8e5d5f64ea2732949fb@Shopzoo.com', 'U82578e5cfaf2a8e5d5f64ea2732949fb', '2024-11-05 09:04:57'),
(9, 'ป๊อปเอง 🤪', 'U3ae48f30d2b81c3a05fe89abc22c7c79@Shopzoo.com', 'U3ae48f30d2b81c3a05fe89abc22c7c79', '2024-11-05 09:11:45'),
(10, 'Dr.Ju', 'U63abb94e71dd4240498a08753f2e359a@Shopzoo.com', 'U63abb94e71dd4240498a08753f2e359a', '2024-11-11 03:36:28'),
(11, 'อรรถพร ศรีเหรัญ', 'Ud2b7e1a400e4e7b63a57d5aabee68fc8@Shopzoo.com', 'Ud2b7e1a400e4e7b63a57d5aabee68fc8', '2024-11-20 09:25:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_preview_product`
--
ALTER TABLE `list_preview_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `login_store`
--
ALTER TABLE `login_store`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_store` (`id_store`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_number` (`order_number`);

--
-- Indexes for table `payment_store`
--
ALTER TABLE `payment_store`
  ADD PRIMARY KEY (`id_payment`),
  ADD KEY `id_store` (`id_store`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id_rating`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_store`
--
ALTER TABLE `product_store`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `store_data`
--
ALTER TABLE `store_data`
  ADD PRIMARY KEY (`id_store`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id_address`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `list_preview_product`
--
ALTER TABLE `list_preview_product`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `login_store`
--
ALTER TABLE `login_store`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `payment_store`
--
ALTER TABLE `payment_store`
  MODIFY `id_payment` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id_rating` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_size`
--
ALTER TABLE `product_size`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `product_store`
--
ALTER TABLE `product_store`
  MODIFY `id_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id_cart` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `store_data`
--
ALTER TABLE `store_data`
  MODIFY `id_store` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id_address` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `list_preview_product`
--
ALTER TABLE `list_preview_product`
  ADD CONSTRAINT `list_preview_product_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product_store` (`id_product`);

--
-- Constraints for table `login_store`
--
ALTER TABLE `login_store`
  ADD CONSTRAINT `login_store_ibfk_1` FOREIGN KEY (`id_store`) REFERENCES `store_data` (`id_store`);

--
-- Constraints for table `payment_store`
--
ALTER TABLE `payment_store`
  ADD CONSTRAINT `payment_store_ibfk_1` FOREIGN KEY (`id_store`) REFERENCES `store_data` (`id_store`);

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `product_store` (`id_product`) ON DELETE CASCADE;

--
-- Constraints for table `product_store`
--
ALTER TABLE `product_store`
  ADD CONSTRAINT `product_store_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `product_category` (`id_category`);

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `product_store` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

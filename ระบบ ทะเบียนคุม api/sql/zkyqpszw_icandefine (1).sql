-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2024 at 03:14 AM
-- Server version: 8.0.36-cll-lve
-- PHP Version: 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zkyqpszw_icandefine`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocation_name`
--

CREATE TABLE `allocation_name` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `allocation_name`
--

INSERT INTO `allocation_name` (`id`, `name`) VALUES
(1, 'รายได้แผ่นดิน'),
(2, 'เงินกองทุนฯ'),
(3, 'เงินรางวัลจราจร'),
(4, 'เงินเทศบาล'),
(5, 'เงิน อบต.'),
(6, 'เงินสินบน'),
(7, 'เงินรางวัล'),
(8, 'กองทุนค่าใช้จ่ายในการดำเนินงาน'),
(9, 'ค่าใช้จ่ายในการดำเนินงานจราจร');

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int NOT NULL,
  `key` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `api_keys`
--

INSERT INTO `api_keys` (`id`, `key`, `status`) VALUES
(1, 'c6e4d2b12b3fc9d21612eeaebdbcd19b', 'active'),
(2, 'ac90cc570a9866689c5d386bd3348942', 'active'),
(3, 'acebbd2a5a93b2fb5845ebec537e6df0', 'active'),
(4, 'ce82e7e81711b2bb095fd70284dae3c1', 'active'),
(5, 'a825d4b12994373cbddde20d23c98da9', 'active'),
(6, '93e9e50e34c678ec452f93216187530e', 'active'),
(7, '43dfa9088a27b64411018f4cea834f23', 'active'),
(8, 'bbc2676c6e56160139460eda29af5c27', 'active'),
(9, '7b8b49b168a8ce1045172f404cb4d9c8', 'active'),
(10, '282c536a9287104698b7c57d26ae61b6', 'active'),
(11, 'af5c764aee104cdf9e34a082283eec1d', 'active'),
(12, '2e2e802d7d22813e8b2ea577eb5022f0', 'active'),
(13, '4b29cb76be457688bbc5d83f6e2170a3', 'active'),
(14, 'ec68998deb747865fe629843e8f9070d', 'active'),
(15, '63a4a2e7e4b35b52ee5f7c623324e19d', 'active'),
(16, '220a93f48f43dd481b7e2bbb37ff1042', 'active'),
(17, 'b8c52b0b4a606c0ade17188261056252', 'active'),
(18, 'f62df558d8f7e0202d97e90cde8268dd', 'active'),
(19, 'cb310463738ccf712efe0531294a3662', 'active'),
(20, 'b9af2eba464cfa15b43460087b5ebfba', 'active'),
(21, 'd14519b8c6b3aa30113b6c91afe512b7', 'active'),
(22, 'ebca955774d4a57ac7449c7992ab6c99', 'active'),
(23, '96ae5a13034233827ed5bca4ac55eaa2', 'active'),
(24, '5fa9cf6012090eb023823199e51d3300', 'active'),
(25, '75dded7410563bc5e4b6f19811e946fa', 'active'),
(26, 'eb680bbe6db57740b657cef37bdc5d19', 'active'),
(27, 'd68ac37cb2763fa8668ea3ed4151f487', 'active'),
(28, '7da1e4618f091961ca1b0a82b260a845', 'active'),
(29, 'e733282fb4ffb78679451fe1edf213dd', 'active'),
(30, '3f4c8a2e34c6f03902dcb70dec8a6895', 'active'),
(31, 'c4c48d69f311780cbdae32a2fabc3e15', 'active'),
(32, '764affe8de84d87199ee861e16227f67', 'active'),
(33, '97c0916f870ea684b240ee5f100f310c', 'active'),
(34, '814679cbfabbcb375c5a2329b0ea89b5', 'active'),
(35, '2e263e68e4ae59e12bc7248a5c6f81f1', 'active'),
(36, '179eb1c1cd56815c0980463beb471e73', 'active'),
(37, '10b82a53be719687a7f66a38fb948a05', 'active'),
(38, 'cfd3363151369afd1c1ff2eb1663f36c', 'active'),
(39, 'a22ac3de42394d1338f8d90733b97c21', 'active'),
(40, '18ec436ba6b7242af0c910358958b5a8', 'active'),
(41, '4907d641c124465500dc4885445e1edf', 'active'),
(42, '13a8c72fdb0e8fe5501a3e722fbaef35', 'active'),
(43, '448d0670738071c6178782de2103a851', 'active'),
(44, '368716712fe9280af53704fb035f25de', 'active'),
(45, '9af8165923c4ea592abbe3acd533f807', 'active'),
(46, 'aff61e8a33211c792f7867f0a0aa131c', 'active'),
(47, 'b3039928ccd43768691d2153801d18b8', 'active'),
(48, '517cb494d22cc791bc8bea7650a7786f', 'active'),
(49, '1419791679aecafdd644e0d195bd7cba', 'active'),
(50, '7263a8765172700c044eebc94caf0298', 'active'),
(51, '8db8145317e089da9da526ec210259bc', 'active'),
(52, 'c6af63d7d1975cdbe0a4223c2f4e73b2', 'active'),
(53, 'b6508856f2d18852b3db5c969b0feeba', 'active'),
(54, 'c142d4422ddd30ca8bf782541150a6dc', 'active'),
(55, '8996e023847e21da94d754915b171686', 'active'),
(56, '25618414af5003a7b9b289ae0e688b18', 'active'),
(57, 'a5e2b573c4bbea80ef72365ae834e874', 'active'),
(58, 'c482e482e323bd327fb64c9702e82b5b', 'active'),
(59, '84362c7c2a169f6e160f4b202072a074', 'active'),
(60, 'ac337e928eaac409da35ec341b59e00f', 'active'),
(61, '74f0fdcfde5d0987a9f457d63a87652e', 'active'),
(62, '133af580750d7ec4470cb8ef5d150f60', 'active'),
(63, '7839921b302242426898fd81260192b4', 'active'),
(64, 'd31292e4e8fa53a9444a25bc1eb36b60', 'active'),
(65, '7b3d3db2cd4cdd41e5c882a6ac2f7110', 'active'),
(66, 'c69652ec136769ec7816d7f841078ebf', 'active'),
(67, 'ff155f18e9d5450c6a706991c659a031', 'active'),
(68, '23725f43f4e83d04787a6539a027d811', 'active'),
(69, 'd1f05ab0b5f369512a041fcc607a6988', 'active'),
(70, 'a1cff4cba18c9411c54a9fbfe69895e6', 'active'),
(71, 'adbba875fa00ffd9f2297d214e69b16c', 'active'),
(72, '131dc3bb3d8fd63458139de3383a2c0a', 'active'),
(73, 'a5fb00152a8ab43721a8d7d34720108d', 'active'),
(74, 'f3b4719d4d0de63554f750f2afdae93e', 'active'),
(75, '1a927d766ea0aa73490fd00e1c335533', 'active'),
(76, '5a1c5d94412f041502a096809cd5d25f', 'active'),
(77, '06790bb75ffea6ceec50df6e2d78b5e7', 'active'),
(78, '6f13b511d01eeecde994d36cd06f2a49', 'active'),
(79, '24c994eb748f631a1cf6cfa825a85c17', 'active'),
(80, '8c025acb77673d21bdfc7648a2cb9730', 'active'),
(81, '22a73e6a00c51ec4f13058c95cf8d2fa', 'active'),
(82, 'ab57aeed2e043d53d4c85433cd2c029f', 'active'),
(83, 'b1d44f4491ca975ff16696612ece8b66', 'active'),
(84, '4138279b7bbcfb2fb66cedb26b4931dc', 'active'),
(85, '8091a907bfcf437336436b3d725fdf24', 'active'),
(86, '746b5cb3f2fc8f6ee09d4b8c193a864f', 'active'),
(87, '2c86a773771bea15d0396173e89a0867', 'active'),
(88, '374c481822f052d51a1df3539a2c2785', 'active'),
(89, 'c1ef614e70f0e384ce0c7c57b74d406a', 'active'),
(90, '1ed5243948e87ea87780a820cabf7d64', 'active'),
(91, '27a0caf3a7966cdb6deab31a68572f3c', 'active'),
(92, 'e863deffc47c4ec3d4d0ad1557326eca', 'active'),
(93, '2e81fbe69c165fd2a2932faa27a529fd', 'active'),
(94, '98a23327a409f56762980a6de7d15319', 'active'),
(95, '560560907272a2aa176fc77b6b3ca4bc', 'active'),
(96, '297bb606540bfe904737e2f2ee23b3e2', 'active'),
(97, '9b42febe264fa626f9faf548f1f420ae', 'active'),
(98, '396c9e555f1a1d9bcb7f4930c7eb83c3', 'active'),
(99, 'e84e3c39832e6291fc4d9f8befc09351', 'active'),
(100, '7d4792789e612e6b36fa189b7226aefd', 'active'),
(101, '63ca5b960af5d5b941b2153cf66d59fc', 'active'),
(102, '637fdb62e910f331178b88bc072e8550', 'active'),
(103, '28d7b4093c629e05ab293acdf67cc26c', 'active'),
(104, '5ab82f8585fade36bd91b57e26c3a0e6', 'active'),
(105, '789e5fe21d62b470d1df13394e70cbce', 'active'),
(106, '8dbeeaeb02b3e05ead5bfd2c4b20802e', 'active'),
(107, '56fdd6537ec13860850c1d3566e5ed19', 'active'),
(108, '74f431d2e8d422f16f82306c8cc669a3', 'active'),
(109, 'be7d85f94698f96c7c79b8b254665a76', 'active'),
(110, '89f8fff39b9cdbb144ac092f508154e7', 'active'),
(111, '85c910c48603dfe67cf6dfad83a19abd', 'active'),
(112, '4aedbc5dd0ff49c42a03cc9193d2dff8', 'active'),
(113, 'a5d00f7b244c9e78fcc0e205be20cc9f', 'active'),
(114, '5f130891f42296e10a2a498d0e7f6290', 'active'),
(115, '9e3bece84b3fe71df66043488f778a7e', 'active'),
(116, 'e7cd21f9d0e1cad5919c29424023cff1', 'active'),
(117, '27954206084a9331fea9ef53a6e34ab5', 'active'),
(118, 'bc766a0005f0454b4a969cc73d74de45', 'active'),
(119, '3223395ac96acb03e260cc8bf69a3123', 'active'),
(120, 'bcc8e5ee625295b8fb67564ac1d9bd7a', 'active'),
(121, '5a384aa762c8d49e86689f3b0f556dcd', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `data_police_station`
--

CREATE TABLE `data_police_station` (
  `id` int NOT NULL,
  `at_number` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `rank` varchar(100) DEFAULT NULL,
  `executive_name` varchar(100) DEFAULT NULL,
  `station` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `data_police_station`
--

INSERT INTO `data_police_station` (`id`, `at_number`, `tel`, `rank`, `executive_name`, `station`) VALUES
(1, '0018(10)(12)1/4089', '045-321215 ต่อ 510', 'พ.ต.อ.', 'สุพจน์ จงอุตส่าห์', '3');

-- --------------------------------------------------------

--
-- Table structure for table `deliver`
--

CREATE TABLE `deliver` (
  `dirver_id` int NOT NULL,
  `income_id` int DEFAULT NULL,
  `income_type_id` int DEFAULT NULL,
  `allocation_name` varchar(500) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `station` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `income_id` int NOT NULL,
  `income_date` date NOT NULL,
  `document_number` varchar(20) NOT NULL,
  `payment_type` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `income_type_id` int NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `station` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `year` varchar(250) DEFAULT NULL,
  `status_type` varchar(100) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `income_allocation`
--

CREATE TABLE `income_allocation` (
  `allocation_id` int NOT NULL,
  `income_type_id` int NOT NULL,
  `allocation_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `income_allocation`
--

INSERT INTO `income_allocation` (`allocation_id`, `income_type_id`, `allocation_name`) VALUES
(51, 20, 'รายได้แผ่นดิน'),
(52, 20, 'เงินกองทุนฯ'),
(53, 21, 'รายได้แผ่นดิน'),
(54, 21, 'เงินกองทุนฯ'),
(55, 21, 'เงินรางวัลจราจร'),
(56, 22, 'รายได้แผ่นดิน'),
(57, 22, 'เงินกองทุนฯ'),
(58, 22, 'เงินรางวัลจราจร'),
(59, 23, 'รายได้แผ่นดิน'),
(60, 23, 'เงินกองทุนฯ'),
(61, 23, 'เงินรางวัลจราจร'),
(62, 23, 'เงินสินบน'),
(63, 23, 'เงินรางวัล'),
(64, 23, 'กองทุนค่าใช้จ่ายในการดำเนินงาน'),
(65, 24, 'รายได้แผ่นดิน'),
(66, 24, 'เงินกองทุนฯ'),
(67, 24, 'เงินรางวัลจราจร'),
(68, 24, 'เงินเทศบาล'),
(69, 24, 'เงิน อบต.'),
(70, 25, 'รายได้แผ่นดิน'),
(71, 25, 'เงินกองทุนฯ'),
(72, 25, 'เงินเทศบาล'),
(73, 25, 'เงิน อบต.'),
(74, 26, 'รายได้แผ่นดิน'),
(75, 26, 'เงินกองทุนฯ'),
(76, 26, 'เงินเทศบาล'),
(77, 26, 'เงิน อบต.'),
(78, 26, 'ค่าใช้จ่ายในการดำเนินงานจราจร'),
(79, 27, 'รายได้แผ่นดิน'),
(80, 28, 'รายได้แผ่นดิน'),
(81, 29, 'รายได้แผ่นดิน'),
(82, 30, 'รายได้แผ่นดิน'),
(83, 31, 'รายได้แผ่นดิน'),
(84, 32, 'รายได้แผ่นดิน'),
(85, 33, 'รายได้แผ่นดิน'),
(86, 34, 'รายได้แผ่นดิน'),
(87, 35, 'เงินกองทุนฯ'),
(88, 21, 'อบต'),
(89, 22, 'เงินกองทุนฯ'),
(90, 22, 'รายได้แผ่นดิน');

-- --------------------------------------------------------

--
-- Table structure for table `income_allocation_data`
--

CREATE TABLE `income_allocation_data` (
  `allocation_data_id` int NOT NULL,
  `income_id` int NOT NULL,
  `allocation_id` int NOT NULL,
  `sub_allocation_id` int DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `income_type`
--

CREATE TABLE `income_type` (
  `income_type_id` int NOT NULL,
  `income_type_code` varchar(10) NOT NULL,
  `income_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `income_type`
--

INSERT INTO `income_type` (`income_type_id`, `income_type_code`, `income_type_name`) VALUES
(20, '804', 'คดีอาญา'),
(21, '804', 'พ.ร.บ.รถยนต์'),
(22, '804', 'พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ'),
(23, '804', '101 พ.ร.บ.'),
(24, '805', 'พ.ร.บ.จราจร'),
(25, '805', 'พ.ร.บ.จราจร (พงส.ปรับ)'),
(26, '805', 'พ.ร.บ.จราจรด้วยอุปกรณ์ทางอิเล็กทรอนิกส์'),
(27, '810', 'ค่าปรับอื่น'),
(28, '821', 'รายได้ดอกเบี้ยอื่น'),
(29, '830', 'รายได้เบ็ดเตล็ดอื่น'),
(30, '641', 'ค่าขายของกลาง/ริบของกลาง'),
(31, '642', 'ค่าขายทอดตลาด'),
(32, '406', 'ค่าใบอนุญาติต่างด้าว'),
(33, '811', 'เงินเหลือจ่ายปีเก่าส่งคืน'),
(34, '815', 'เงินชดใช้ค่าเสียหายจากการละเมิด'),
(35, '821', 'ดอกเบี้ยเงินกองทุนฯ'),
(36, '', 'นำส่งเงิน ภ.จว.อุบลราชธานี');

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `id_user` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` int NOT NULL,
  `status` varchar(50) NOT NULL,
  `station` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`id_user`, `name`, `email`, `password`, `status`, `station`) VALUES
(1, 'armmy', 'armmy@gmail.com', 123456, 'สภ', '3'),
(2, 'สมฤทัย สายแวว', 'somruthai.2345@gmail.com', 123456, 'ภจว', '37');

-- --------------------------------------------------------

--
-- Table structure for table `police_station`
--

CREATE TABLE `police_station` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `police_station`
--

INSERT INTO `police_station` (`id`, `name`) VALUES
(1, 'สภ.เมืองอุบลราชธานี'),
(2, 'สภ.เหล่าเสือโก้ก'),
(3, 'สภ.วารินชำราบ'),
(4, 'สภ.ห้วยขะยุง'),
(5, 'สภ.พิบูลมังสาหาร'),
(6, 'สภ.นาโพธิ์(พิบูลฯ)'),
(7, 'สภ.คันไร่'),
(8, 'สภ.เขื่องใน'),
(9, 'สภ.โขงเจียม'),
(10, 'สภ.ตาลสุม'),
(11, 'สภ.สำโรง'),
(12, 'สภ.ม่วงสามสิบ'),
(13, 'สภ.เขมราฐ'),
(14, 'สภ.ม่วงเฒ่า'),
(15, 'สภ.ศรีเมืองใหม่'),
(16, 'สภ.เอือดใหญ่'),
(17, 'สภ.หนามแท่ง'),
(18, 'สภ.กุดข้าวปุ้น'),
(19, 'สภ.โพธิ์ไทร'),
(20, 'สภ.ตระการพืชผล'),
(21, 'สภ.โนนกุง'),
(22, 'สภ.โคกจาน'),
(23, 'สภ.เดชอุดม'),
(24, 'สภ.นาเยีย'),
(25, 'สภ.น้ำยืน'),
(26, 'สภ.บุณฑริก'),
(27, 'สภ.นาโพธิ์(บุณฑริก)'),
(28, 'สภ.ห้วยข่า'),
(29, 'สภ.นาจะหลวย'),
(30, 'สภ.สิรินธร'),
(31, 'สภ.ดอนมดแดง'),
(32, 'สภ.ทุ่งศรีอุดม'),
(33, 'สภ.นาตาล'),
(34, 'สภ.สว่างวีระวงศ์'),
(35, 'สภ.น้ำขุ่น'),
(36, 'สภ.ช่องเม็ก'),
(37, 'ภ.จว.อุบลราชธานี');

-- --------------------------------------------------------

--
-- Table structure for table `sub_allocation`
--

CREATE TABLE `sub_allocation` (
  `sub_allocation_id` int NOT NULL,
  `allocation_id` int NOT NULL,
  `sub_allocation_name` varchar(50) NOT NULL,
  `station` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `sub_allocation`
--

INSERT INTO `sub_allocation` (`sub_allocation_id`, `allocation_id`, `sub_allocation_name`, `station`) VALUES
(27, 68, 'เทศบาลเมืองวารินชำราบ', '3'),
(28, 68, 'เทศบาลตำบลแสนสุข', '3'),
(29, 68, 'เทศบาลตำบลคำน้ำแซบ', '3'),
(30, 68, 'เทศบาลตำบลเมืองศรีไค', '3'),
(31, 68, 'เทศบาลตำบลคำขวาง', '3'),
(32, 68, 'เทศบาลตำบลธาตุ', '3'),
(33, 68, 'เทศบาลตำบลบุ่งไหม', '3'),
(34, 72, 'เทศบาลตำบลเมืองวารินชำราบ', '3'),
(35, 72, 'เทศบาลตำบลแสนสุข', '3'),
(36, 72, 'เทศบาลตำบลคำน้ำแซบ', '3'),
(37, 72, 'เทศบาลตำบลเมืองศรีไค', '3'),
(38, 72, 'เทศบาลตำบลคำขวาง', '3'),
(39, 72, 'เทศบาลตำบลธาตุ', '3'),
(40, 72, 'เทศบาลตำบลบุ่งไหม', '3'),
(41, 76, 'เทศบาลเมืองวารินชำราบ', '3'),
(42, 76, 'เทศบาลตำบลแสนสุข', '3'),
(43, 76, 'เทศบาลตำบลคำน้ำแซบ', '3'),
(44, 76, 'เทศบาลตำบลเมืองศรีไค', '3'),
(45, 76, 'เทศบาลตำบลคำขวาง', '3'),
(46, 76, 'เทศบาลตำบลธาตุ', '3'),
(47, 76, 'เทศบาลตำบลบุ่งไหม', '3'),
(48, 69, 'อบต.โนนผึ้ง', '3'),
(49, 69, 'อบต.โนนโหนน', '3'),
(50, 69, 'อบต.คูเมือง', '3'),
(51, 69, 'อบต.หนองกินเพล', '3'),
(52, 69, 'อบต.โพธิ์ใหญ่', '3'),
(53, 69, 'อบต.สระสมิง', '3'),
(54, 73, 'อบต.โนนผึ้ง', '3'),
(55, 73, 'อบต.โนนโหนน', '3'),
(56, 73, 'อบต.คูเมือง', '3'),
(57, 73, 'อบต.หนองกินเพล', '3'),
(58, 73, 'อบต.โพธิ์ใหญ่', '3'),
(59, 73, 'อบต.สระสมิง', '3'),
(60, 77, 'อบต.โนนผึ้ง', '3'),
(61, 77, 'อบต.โนนโหนน', '3'),
(62, 77, 'อบต.คูเมือง', '3'),
(63, 77, 'อบต.หนองกินเพล', '3'),
(64, 77, 'อบต.โพธิ์ใหญ่', '3'),
(65, 77, 'อบต.สระสมิง', '3');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `id_withdraw` int NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `allocation_name` varchar(100) DEFAULT NULL,
  `station` varchar(50) DEFAULT NULL,
  `income_id` varchar(50) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocation_name`
--
ALTER TABLE `allocation_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_police_station`
--
ALTER TABLE `data_police_station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliver`
--
ALTER TABLE `deliver`
  ADD PRIMARY KEY (`dirver_id`);

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `income_type_id` (`income_type_id`);

--
-- Indexes for table `income_allocation`
--
ALTER TABLE `income_allocation`
  ADD PRIMARY KEY (`allocation_id`),
  ADD KEY `income_type_id` (`income_type_id`);

--
-- Indexes for table `income_allocation_data`
--
ALTER TABLE `income_allocation_data`
  ADD PRIMARY KEY (`allocation_data_id`),
  ADD KEY `income_id` (`income_id`),
  ADD KEY `allocation_id` (`allocation_id`),
  ADD KEY `sub_allocation_id` (`sub_allocation_id`);

--
-- Indexes for table `income_type`
--
ALTER TABLE `income_type`
  ADD PRIMARY KEY (`income_type_id`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `police_station`
--
ALTER TABLE `police_station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_allocation`
--
ALTER TABLE `sub_allocation`
  ADD PRIMARY KEY (`sub_allocation_id`),
  ADD KEY `allocation_id` (`allocation_id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`id_withdraw`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocation_name`
--
ALTER TABLE `allocation_name`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `data_police_station`
--
ALTER TABLE `data_police_station`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliver`
--
ALTER TABLE `deliver`
  MODIFY `dirver_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `income_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `income_allocation`
--
ALTER TABLE `income_allocation`
  MODIFY `allocation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `income_allocation_data`
--
ALTER TABLE `income_allocation_data`
  MODIFY `allocation_data_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=573;

--
-- AUTO_INCREMENT for table `income_type`
--
ALTER TABLE `income_type`
  MODIFY `income_type_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `Login`
--
ALTER TABLE `Login`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `police_station`
--
ALTER TABLE `police_station`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sub_allocation`
--
ALTER TABLE `sub_allocation`
  MODIFY `sub_allocation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `id_withdraw` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`income_type_id`) REFERENCES `income_type` (`income_type_id`);

--
-- Constraints for table `income_allocation`
--
ALTER TABLE `income_allocation`
  ADD CONSTRAINT `income_allocation_ibfk_1` FOREIGN KEY (`income_type_id`) REFERENCES `income_type` (`income_type_id`);

--
-- Constraints for table `income_allocation_data`
--
ALTER TABLE `income_allocation_data`
  ADD CONSTRAINT `income_allocation_data_ibfk_1` FOREIGN KEY (`income_id`) REFERENCES `income` (`income_id`),
  ADD CONSTRAINT `income_allocation_data_ibfk_2` FOREIGN KEY (`allocation_id`) REFERENCES `income_allocation` (`allocation_id`),
  ADD CONSTRAINT `income_allocation_data_ibfk_3` FOREIGN KEY (`sub_allocation_id`) REFERENCES `sub_allocation` (`sub_allocation_id`);

--
-- Constraints for table `sub_allocation`
--
ALTER TABLE `sub_allocation`
  ADD CONSTRAINT `sub_allocation_ibfk_1` FOREIGN KEY (`allocation_id`) REFERENCES `income_allocation` (`allocation_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

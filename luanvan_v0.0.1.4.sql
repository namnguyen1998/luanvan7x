-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2020 at 07:47 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `luanvan`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id_brand` int(11) NOT NULL,
  `name_brand` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `logo_ brand` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id_brand`, `name_brand`, `logo_ brand`) VALUES
(1, 'Casio', ''),
(2, 'Nike', ''),
(3, 'Apple', '2020-07-10 19:17:59'),
(4, 'Seiko', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `icon_category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`, `img_category`, `icon_category`) VALUES
(1, 'Đồng hồ & Đồ trang sức', '08072020_cfbd0cf71acd7aac4b46b769b2374419.jpg', 'dongho.png'),
(2, 'Điện thoại & Phụ kiện', '08072020_4abe1bd67c6b2a5e7a2d23c104a3d4e0.jpg', 'dienthoai&phukien.png'),
(3, 'Máy tính & Laptop', '08072020_6aa64c585ff9dfb4a56489fbce34a7bf.jpg', 'maytinh&laptop.png'),
(4, 'Thể thao & Du lịch', '08072020_3e0b2d7901a4660a33f21ff7173e0a55.jpg', 'thethao&dulich.png'),
(5, 'Thời trang nam', '08072020_6ababfd277f8cd3eb564ff6a44e70fe1.jpg', 'thoitrangnam.png'),
(6, 'Thời trang nữ', '08072020_a5fdeff0b6b98f76f1b40001c3db38db.jpg', 'thoitrangnu.png');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id_customer` int(11) NOT NULL,
  `email_customer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_customer` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name_customer` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_customer` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_customer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex_customer` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `date_customer` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id_customer`, `email_customer`, `password_customer`, `name_customer`, `phone_customer`, `img_customer`, `provider_id`, `sex_customer`, `date_customer`, `updated_at`, `created_at`) VALUES
(2, '123456789@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Tui nè', NULL, NULL, NULL, 1, NULL, '2020-07-03 05:21:02', '2020-07-03 12:21:02'),
(5, 'nguyenhoangnam0922@gmail.com', '', 'Nam Nguyễn', NULL, 'https://lh3.googleusercontent.com/a-/AOh14Gg9b0xC2k6P7fAOjAvZLN3qSvJIwTaBxv2no9Fp', NULL, 0, NULL, '2020-06-30 17:56:53', '2020-06-30 17:56:53'),
(10, 'nguyenhoangnam092@gmail.com', '', 'Nam Nguyễn', NULL, 'https://lh3.googleusercontent.com/a-/AOh14Gg9b0xC2k6P7fAOjAvZLN3qSvJIwTaBxv2no9Fp', '113814889806946866050', 0, NULL, '2020-06-30 11:30:49', '2020-06-30 11:30:49'),
(11, 'le.trong.an256@gmail.com', '', 'Trong An Le', '123456789', 'https://lh3.googleusercontent.com/a-/AOh14Gjo7gGn1_sz5vTQYjA6pixVrZ_2vCBE1gfX4nDGjw', '101141285191228131954', 0, NULL, '2020-07-07 15:40:48', '2020-07-07 15:40:48');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_orders` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `price_orders` int(11) NOT NULL,
  `shipping cost` int(11) NOT NULL,
  `phone_order` int(11) NOT NULL,
  `address_order` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id_payment` int(11) NOT NULL,
  `name_payment` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id_payment`, `name_payment`) VALUES
(1, 'Thanh toán khi nhận hàng'),
(2, 'Thanh toán qua Airpay');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `madeby` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `img_product` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img1_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img2_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img3_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_product` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price_product` int(11) NOT NULL,
  `status_product` tinyint(4) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `madeby`, `sub_category_id`, `brand_id`, `customer_id`, `img_product`, `img1_product`, `img2_product`, `img3_product`, `note_product`, `description_product`, `price_product`, `status_product`, `is_deleted`, `updated_at`, `created_at`) VALUES
(9, 'Casio Gsock', 'china', 1, 1, 11, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 12345678, 1, 0, '2020-07-13 03:54:16', '2020-07-13 03:54:16'),
(10, 'GoPro 8', 'china', 3, 1, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 8000000, 1, 1, '2020-07-14 05:27:34', '2020-07-14 05:27:34'),
(11, 'IPhone 11', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 23000000, 0, 0, '2020-07-10 12:18:38', '2020-07-10 12:18:38'),
(12, 'IPhone X', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 11000000, -1, 0, '2020-07-10 12:23:51', '2020-07-10 12:23:51'),
(13, 'IPhone XS', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 14000000, 0, 0, '2020-07-10 12:19:35', '2020-07-10 12:19:35'),
(14, 'IPhone XS Max', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 16000000, 0, 0, '2020-07-10 12:19:35', '2020-07-10 12:19:35'),
(15, 'IPhone 11 Pro Max', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 25000000, 0, 0, '2020-07-10 12:19:35', '2020-07-10 12:19:35'),
(16, 'IPhone 7', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 5000000, 0, 0, '2020-07-10 12:19:35', '2020-07-10 12:19:35'),
(17, 'IPhone 7 Plus', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 5500000, 0, 0, '2020-07-10 12:19:35', '2020-07-10 12:19:35'),
(18, 'IPhone 8', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 5500000, 1, 0, '2020-07-14 04:46:25', '2020-07-14 04:46:25'),
(19, 'IPhone 8 Plus', 'china', 3, 3, 2, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 600000, 1, 0, '2020-07-14 04:46:21', '2020-07-14 04:46:21'),
(25, 'SEIKO PRESAGE SSA850J1 - NỮ - KÍNH SAPPHIRE - AUTOMATIC (TỰ ĐỘNG) CHÍNH HÃNG', 'Japan', 2, 4, 8, '14072020_615842aee2487f8ae79e392021c4f578.jpg', '14072020_374b9e6018ddec1ae62fa317c12d03e0.jpg', '14072020_92f1b6828c17804c915530c6e7a79830.jpg', '14072020_2cfff08f01818cf6b29aa50af83bcc54.jpg', NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Seiko</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>SSA850J1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phầm</td>\r\n			<td>Presage Skeleton&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nữ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Automatic (Tự động - Made in Japan) Caliber No: 4R38</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ mạ v&agrave;ng c&ocirc;ng nghệ PVD</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ mạ v&agrave;ng c&ocirc;ng nghệ PVD</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh chống trầy (Sapphire crystal)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>X&agrave; cừ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>34mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>10mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>100m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Xem giờ, Lộ m&aacute;y&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh&nbsp;Ch&iacute;nh H&atilde;ng</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Tại 24H</td>\r\n			<td>5 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 10000000, 1, 0, '2020-07-14 05:06:08', '2020-07-14 05:06:08'),
(26, 'CASIO LTP-V004L-1B - NỮ - QUARTZ (PIN) DÂY DA - CHÍNH HÃNG', 'Japan', 2, 1, 8, '14072020_f4570674de921b6b32f706bd6b1ab88f.jpg', '14072020_70929084f28874f30313acfcd90c537c.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>LTP-V004L-1BUDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Giới T&iacute;nh</td>\r\n			<td>Nữ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>D&acirc;y da ch&iacute;nh h&atilde;ng&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>30.2*35.2 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y Mặt</td>\r\n			<td>7.8mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Quốc Tế</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Tại 24H</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 720000, 1, 0, '2020-07-14 05:06:01', '2020-07-14 05:06:01'),
(27, 'CASIO MTP-1374SG-1A - NAM - QUARTZ (PIN) DÂY KIM LOẠI - CHÍNH HÃNG', 'Japan', 1, 1, 8, '14072020_e1b1918aba96e876a6536c2beb3c075b.jpg', '14072020_30d52f0532aadc9d00dc17400daa1510.jpg', '14072020_da054a407f8c729fdd17b90a162ba668.jpg', '14072020_f7ed05f3003863eecb77514d4828b914.jpg', NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-1374SG-1AVDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ mạ v&agrave;ng PVD</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>43.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ d&agrave;y</td>\r\n			<td>10.4 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>50 m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>&middot;&nbsp; Hiển thị<br />\r\n			&middot;&nbsp; Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (Giờ, ph&uacute;t, gi&acirc;y) 3 kim (Thứ, ng&agrave;y, giờ 24h)<br />\r\n			&middot;&nbsp; Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			&middot;&nbsp; Tuổi thọ pin xấp xỉ: 3 năm với pin SR920W</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 2583000, 1, 0, '2020-07-14 05:05:57', '2020-07-14 05:05:57'),
(28, 'CASIO MCW-100H-9A2V - NAM - QUARTZ (PIN) DÂY NHỰA - CHÍNH HÃNG', 'Japan', 1, 1, 8, '14072020_3ddd5c70474f1f034c316be3f833e8e1.jpg', '14072020_ea177b65e401e458dbb7b09372d4c136.jpg', '14072020_46623e61859d327938e8d4625d84dd84.jpg', '14072020_6baddb8b99c3861ea8ca77dc3fb1cc10.jpg', NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MCW-100H-9A2VDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>D&acirc;y nhựa (Resin band)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Vỏ nhựa&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt</td>\r\n			<td>Đen&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>49.3*51.8 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>13 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh nhựa (Resin glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>100m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>\r\n			<ul>\r\n				<li>&middot;&nbsp;&nbsp;Đồng hồ bấm giờ 1 gi&acirc;y<br />\r\n				Khả năng đo: 29&#39;59<br />\r\n				Ch&ecirc;́ đ&ocirc;̣ đo: Thời gian đ&atilde; tr&ocirc;i qua, ngắt giờ, thời gian v&ecirc;̀ đ&iacute;ch thứ nh&acirc;́t - thứ hai<br />\r\n				&middot;&nbsp;&nbsp;Hiển thị ng&agrave;y<br />\r\n				&middot;&nbsp;&nbsp;Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n				Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y), 3 mặt số (ph&uacute;t đồng hồ bấm giờ, gi&acirc;y đồng hồ bấm giờ, 24 giờ)<br />\r\n				&middot;&nbsp;&nbsp;Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n				&middot;&nbsp;&nbsp;Tuổi thọ pin xấp xỉ: 3 năm với pin SR920S</li>\r\n			</ul>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 1810000, 1, 0, '2020-07-14 05:05:54', '2020-07-14 05:05:54'),
(30, '[FREESHIP TQ] Áo thun nữ trắng thời trang 2019 Cotton co giãn 4 chiều - áo nữ kiểu thời trang', 'China', 7, 2, 9, '14072020_2770c2e50cde069834d4b69b7b4f658e.jpg', '14072020_a8322e7238bacc06de864873ff3ccfa8.jpg', '14072020_74089288dd47a079339e70874a3b96d5.jpg', NULL, NULL, '<p>&lt;span&gt;[FREESHIP TQ] &Aacute;o thun nữ m&agrave;u trắng thời trang 2019 Cotton co gi&atilde;n 4 chiều - &aacute;o thun ngắn tay kh&ocirc;ng cổ - &aacute;o ngắn tay</p>\r\n\r\n<p>Store gi&agrave;y đẹp mang đến mẫu &aacute;o thun cực HOT cho mua h&egrave; thu 2019 d&agrave;nh cho c&aacute;c bạn nữ<br />\r\n&Aacute;O THUN NỮ IN H&Igrave;NH - CHẤT THUN COTTON 4 CHIỀU - MỀM MỊN&nbsp;<br />\r\nCO GI&Atilde;N TỐT - &nbsp;IN 6D SẮC N&Eacute;T KH&Ocirc;NG BONG TR&Oacute;C<br />\r\n&nbsp;<br />\r\nT&ecirc;n sản phẩm: &aacute;o thun HH&nbsp;<br />\r\nChất liệu: cotton<br />\r\nKiểu d&aacute;ng: tay ngắn<br />\r\nXuất xứ: h&agrave;ng Quảng ch&acirc;u cao cấp<br />\r\nSize: S,M,L,XL<br />\r\nLưu &yacute;: Form chuẩn ph&ugrave; hợp với c&aacute;c bạn từ 40kg -60kg mặc vừa đẹp</p>\r\n\r\n<p>? CAM KẾT&nbsp;<br />\r\n&nbsp;✔️ H&Agrave;NG CHUẨN 100%<br />\r\n&nbsp;✔️ BẢO H&Agrave;NH 06 TH&Aacute;NG ĐỔI LU&Ocirc;N Đ&Ocirc;I MỚI ( Lỗi do sản xuất )&nbsp;<br />\r\n&nbsp;✔️ H&Igrave;NH ẢNH THẬT 100%&nbsp;<br />\r\n&nbsp;✔️ Kiểu d&aacute;ng hiện đại, phong c&aacute;ch<br />\r\n&nbsp;✔️ Vải mềm mịn, chất liệu cotton m&aacute;t mẻ, t&ocirc;n d&aacute;ng<br />\r\n&nbsp;✔️ Giao h&agrave;ng to&agrave;n quốc<br />\r\n&nbsp;✔️Kiểm h&agrave;ng TRƯỚC &ndash; Trả tiền SAU<br />\r\nHotline 091.245.9393<br />\r\nKhi đặt h&agrave;ng kh&aacute;ch y&ecirc;u vui l&ograve;ng ghi ch&uacute; cụ thể để tr&aacute;nh t&igrave;nh trạng soạn sai , soạn nhầm mẩu ạ&lt;/span&gt;&lt;br&gt;</p>', 150000, 1, 0, '2020-07-14 05:16:10', '2020-07-14 05:16:10'),
(31, 'Áo thun nam có cổ Riooshop cực đẹp 2019 RXP044', 'China', 6, 2, 9, '14072020_f3308904bbd3d7e6e1a16a5637b8f450.jpg', '14072020_a91dafd8680f0d2c4351fd322e407e28.jpg', NULL, NULL, NULL, '<p>Lưu &yacute;: Nhập m&atilde; FREESHIP khi đặt anh/ chị nh&eacute;. Lấy m&atilde; ở phần th&ocirc;ng b&aacute;o của shopee! Nhấn v&agrave;o &ocirc; nhập m&atilde; sẽ c&oacute; m&atilde; hiện ra.<br />\r\n&Aacute;o thun nam c&oacute; cổ từ l&acirc;u đ&atilde; được ph&aacute;i mạnh ưa chuộng bởi sự năng động pha một ch&uacute;t cổ điển của n&oacute;. Nếu bạn đang c&acirc;n nhắc một chiếc &aacute;o thời trang, thanh lịch v&agrave; chất lượng th&igrave; &Aacute;o thun nam c&oacute; cổ cực đẹp 2019 cao cấp mới n&agrave;y d&agrave;nh cho bạn đ&acirc;y!</p>\r\n\r\n<blockquote>\r\n<p>? ĐIỂM NỔI BẬT CỦA &Aacute;O THUN NAM C&Oacute; CỔ MỚI 2019<br />\r\n- Được l&agrave;m từ thun c&aacute; sấu cao cấp, &aacute;o co d&atilde;n, thấm h&uacute;t mồ h&ocirc;i, để bạn vận động một c&aacute;ch thoải m&aacute;i.<br />\r\n- &Aacute;o thun nam c&oacute; cổ mới 2019 được may cẩn thận, chăm ch&uacute;t từng đường chỉ, tinh tế từng &aacute;o một để ra sản phẩm tốt phục vụ kh&aacute;ch h&agrave;ng của Riooshop.<br />\r\n- &Aacute;o thun trơn đơn giản, dễ mặc dễ phối đồ, gi&uacute;p bạn lu&ocirc;n tự tin khi ra đường.<br />\r\n- &Aacute;o c&oacute; đến 5 m&agrave;u sắc kh&aacute;c nhau, lại dễ d&agrave;ng phối hợp với quần jeans, kaki, short,... một sự lựa chọn ho&agrave;n hảo!</p>\r\n</blockquote>\r\n\r\n<p>? CHI TIẾT SẢN PHẨM &Aacute;O THUN NAM C&Oacute; CỔ MỚI<br />\r\n? K&iacute;ch cỡ: M [50-58 Kg], L [59 - 65 Kg], XL [66-75 Kg], XXL [76-85 Kg]<br />\r\n? 5 M&agrave;u: Trắng, X&aacute;m đen, Xanh r&ecirc;u, Xanh b&iacute;ch<br />\r\n? Chất liệu: Thun c&aacute; sấu cao cấp, co d&atilde;n 4 chiều.</p>\r\n\r\n<p>? HƯỚNG DẪN ĐẶT H&Agrave;NG<br />\r\nLần lượt th&ecirc;m v&agrave;o giỏ ph&acirc;n loại h&agrave;ng (M&agrave;u, Size) những &aacute;o muốn đặt, sau khi th&ecirc;m xong v&agrave;o giỏ h&agrave;ng nhấn MUA NGAY v&agrave; điền th&ocirc;ng tin thanh to&aacute;n</p>', 200000, 1, 0, '2020-07-14 05:19:08', '2020-07-14 05:19:08'),
(32, 'Jean Nữ Nike', 'China', 8, 2, 9, '14072020_ada0f1fc2d85cdd79c01b50d3ea106c6.jpg', '14072020_58c779a6411580e5a74d983a89261fbc.jpg', NULL, NULL, NULL, '<p>HÀNG Đ&Ocirc;̣C QUY&Ecirc;̀N CHỈ CÓ TẠI QU&Ocirc;́C CƯỜNG SPORT<br />\r\n?. &Aacute;o Nike cổ c&ocirc;ng ngh&ecirc;̣ ép nhi&ecirc;̣t mới nh&acirc;́t kh&ocirc;ng đường may<br />\r\n? Vải thun lạnh cao cấp, logo sắc nét sờ mát tay lu&ocirc;n<br />\r\n? Form cho người Việt Nam th&acirc;n thiện ??<br />\r\n? Size S M L XL (45-80kg)<br />\r\n? Chấm . một c&aacute;i để em b&aacute;o gi&aacute; giật m&igrave;nh nha<br />\r\n#&aacute;onam<br />\r\n#thunlanhj<br />\r\n#cổ đức</p>\r\n\r\n<p>??QUỐC CƯỜNG SPORT??<br />\r\n??? Link mua h&agrave;ng freeship: shopee.vn/htpt145<br />\r\n? SN 132, Khu Đo&agrave;i, Dục Nội, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội<br />\r\n? 09666 21 866 - 0377 039 095<br />\r\n? Ship COD to&agrave;n quốc</p>', 350000, 1, 0, '2020-07-14 05:46:15', '2020-07-14 05:46:15');

-- --------------------------------------------------------

--
-- Stand-in structure for view `products_category`
-- (See below for the actual view)
--
CREATE TABLE `products_category` (
`id_product` int(11)
,`name_product` varchar(255)
,`description_product` longtext
,`img1_product` varchar(50)
,`img2_product` varchar(50)
,`img3_product` varchar(50)
,`img_product` varchar(50)
,`status_product` tinyint(4)
,`created_at` timestamp
,`updated_at` timestamp
,`customer_id` int(11)
,`madeby` varchar(50)
,`price_product` int(11)
,`is_deleted` tinyint(4)
,`email_customer` varchar(100)
,`name_sub` varchar(50)
,`name_brand` varchar(50)
,`name_category` varchar(50)
,`category_id` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description_role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id_role`, `name_role`, `description_role`) VALUES
(1, 'Admin', 'Tất cả các quyền, vai trò'),
(2, 'Quản lý danh mục', 'Được toàn quyền quản lý danh muc'),
(3, 'Quản lý sản phẩm', 'Được toàn quyền quản lý sản phẩm'),
(4, 'Quản lý nhân viên', 'Được toàn quyền quản lý nhân viên'),
(5, 'Quản lý Shop', 'Được toàn quyền quản lý Shop');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_address`
--

CREATE TABLE `shipping_address` (
  `id_address` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `address_default` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`id_address`, `customer_id`, `address_default`, `address_customer`) VALUES
(1, 11, 'Quận 8, TPHCM', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id_shop` int(11) NOT NULL,
  `email_shop` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_shop` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_shop` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_shop` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `img_shop` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_shop` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_shop` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id_shop`, `email_shop`, `password_shop`, `name_shop`, `phone_shop`, `customer_id`, `img_shop`, `address_shop`, `status_shop`, `created_at`, `updated_at`) VALUES
(8, 'le.trong.an256@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Trọng Ân', '1234567890', 11, '08072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '25', 1, '2020-07-08 04:41:50', '2020-07-08 04:41:50'),
(9, 'nguyenhoangnam092@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Shop Shop', '0907016564', 2, '08072020_4289c22172f76e44ccda0ea79ea89d79.jpg', '385/35, Quang Trung, P10, Q.GV', 1, '2020-07-08 07:03:02', '2020-07-08 07:03:02');

-- --------------------------------------------------------

--
-- Stand-in structure for view `shop_customer`
-- (See below for the actual view)
--
CREATE TABLE `shop_customer` (
`id_product` int(11)
,`created_at` timestamp
,`name_shop` varchar(50)
,`id_shop` int(11)
,`name_product` varchar(255)
,`madeby` varchar(50)
,`price_product` int(11)
,`status_product` tinyint(4)
,`brand_id` int(11)
,`name_brand` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id_sub` int(11) NOT NULL,
  `name_sub` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id_sub`, `name_sub`, `category_id`) VALUES
(1, 'Đồng hồ nam', 1),
(2, 'Đồng hồ nữ', 1),
(3, 'Điện thoại', 2),
(4, 'Ốp lưng', 2),
(5, 'Áo thun nam', 5),
(6, 'Áo thun có cổ nam', 5),
(7, 'Áo thun nữ', 6),
(8, 'Jean nữ', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `username_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone_user` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username_user`, `password_user`, `name_user`, `email_user`, `phone_user`, `role_id`, `updated_at`, `created_at`) VALUES
(1, 'admin', 'd93a5def7511da3d0f2d171d9c344e91', '', 'admin@gmail.com', '09070116564', 1, '2020-07-12 17:34:08', '2020-07-12 17:34:08'),
(2, 'namnguyen', 'd93a5def7511da3d0f2d171d9c344e91', 'Nguyễn Hoàng Nam', 'nguyenhoangnam092@gmail.com', '0907016564', 4, '2020-07-12 18:28:09', '2020-07-12 18:28:09');

-- --------------------------------------------------------

--
-- Structure for view `products_category`
--
DROP TABLE IF EXISTS `products_category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_category`  AS  select `p`.`id_product` AS `id_product`,`p`.`name_product` AS `name_product`,`p`.`description_product` AS `description_product`,`p`.`img1_product` AS `img1_product`,`p`.`img2_product` AS `img2_product`,`p`.`img3_product` AS `img3_product`,`p`.`img_product` AS `img_product`,`p`.`status_product` AS `status_product`,`p`.`created_at` AS `created_at`,`p`.`updated_at` AS `updated_at`,`p`.`customer_id` AS `customer_id`,`p`.`madeby` AS `madeby`,`p`.`price_product` AS `price_product`,`p`.`is_deleted` AS `is_deleted`,`c`.`email_customer` AS `email_customer`,`sc`.`name_sub` AS `name_sub`,`b`.`name_brand` AS `name_brand`,`cat`.`name_category` AS `name_category`,`cat`.`id_category` AS `category_id` from ((((`products` `p` left join `sub_category` `sc` on((`p`.`sub_category_id` = `sc`.`id_sub`))) left join `brands` `b` on((`p`.`brand_id` = `b`.`id_brand`))) left join `customers` `c` on((`p`.`customer_id` = `c`.`id_customer`))) left join `category` `cat` on((`sc`.`category_id` = `cat`.`id_category`))) ;

-- --------------------------------------------------------

--
-- Structure for view `shop_customer`
--
DROP TABLE IF EXISTS `shop_customer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `shop_customer`  AS  select `p`.`id_product` AS `id_product`,`p`.`created_at` AS `created_at`,`s`.`name_shop` AS `name_shop`,`s`.`id_shop` AS `id_shop`,`p`.`name_product` AS `name_product`,`p`.`madeby` AS `madeby`,`p`.`price_product` AS `price_product`,`p`.`status_product` AS `status_product`,`p`.`brand_id` AS `brand_id`,`b`.`name_brand` AS `name_brand` from (((`products` `p` join `customers` `c` on((`p`.`customer_id` = `c`.`id_customer`))) join `shop` `s` on((`c`.`id_customer` = `s`.`customer_id`))) join `brands` `b` on((`b`.`id_brand` = `p`.`brand_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id_brand`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `payment_status` (`payment_id`),
  ADD KEY `address_order` (`address_order`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_detail`),
  ADD KEY `orders_id` (`orders_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `sub_category_id` (`sub_category_id`),
  ADD KEY `users_id` (`customer_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD PRIMARY KEY (`id_address`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id_shop`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id_shop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id_customer`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id_customer`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id_payment`),
  ADD CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`address_order`) REFERENCES `shipping_address` (`id_address`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id_orders`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id_product`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id_brand`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id_sub`);

--
-- Constraints for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD CONSTRAINT `shipping_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id_customer`);

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id_customer`);

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2020 at 08:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
(3, 'Apple', '2020-07-10 19:17:59');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `icon_category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug_category` varchar(55) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`, `img_category`, `icon_category`, `slug_category`) VALUES
(1, 'Đồng hồ & Đồ trang sức', '08072020_cfbd0cf71acd7aac4b46b769b2374419.jpg', 'dongho.png', 'dong-ho-do-trang-suc'),
(2, 'Điện thoại & Phụ kiện', '08072020_4abe1bd67c6b2a5e7a2d23c104a3d4e0.jpg', 'dienthoai&phukien.png', 'dien-thoai-phu-kien'),
(3, 'Máy tính & Laptop', '08072020_6aa64c585ff9dfb4a56489fbce34a7bf.jpg', 'maytinh&laptop.png', 'may-tinh-laptop'),
(4, 'Thể thao & Du lịch', '08072020_3e0b2d7901a4660a33f21ff7173e0a55.jpg', 'thethao&dulich.png', 'the-thao-du-lich'),
(5, 'Thời trang nam', '08072020_6ababfd277f8cd3eb564ff6a44e70fe1.jpg', 'thoitrangnam.png', 'thoi-trang-nam'),
(6, 'Thời trang nữ', '08072020_a5fdeff0b6b98f76f1b40001c3db38db.jpg', 'thoitrangnu.png', 'thoi-trang-nu');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
  `sex_customer` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `date_customer` date DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
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
  `payment_id` int(11) DEFAULT NULL,
  `price_orders` int(11) NOT NULL,
  `shipping cost` int(11) NOT NULL,
  `address_order` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_order` tinyint(4) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `customer_id`, `payment_id`, `price_orders`, `shipping cost`, `address_order`, `note`, `status_order`, `updated_at`, `created_at`) VALUES
(1, 10, NULL, 1750000, 0, 4, 'gọi trước khi giao hàng', 0, '2020-07-21 14:34:38', '2020-07-21 14:34:38'),
(4, 10, NULL, 1750000, 0, 5, 'gọi trước khi giao hàng', 1, '2020-07-21 05:54:59', '2020-07-22 05:54:59'),
(5, 10, NULL, 1772000, 22000, 5, 'gọi trước khi giao hàng', 0, '2020-07-21 14:46:36', '2020-07-21 14:46:36'),
(6, 2, NULL, 123506789, 50000, 5, 'gọi trước khi giao hàng. Cảm ơn', 0, '2020-07-21 14:48:49', '2020-07-21 14:48:49'),
(7, 2, NULL, 123506789, 50000, 7, 'gọi trước khi giao hàng. Cảm ơn', 0, '2020-07-21 14:51:24', '2020-07-21 14:51:24'),
(8, 2, NULL, 124178789, 22000, 7, NULL, 2, '2020-07-27 14:11:48', '2020-06-26 14:11:33'),
(9, 2, NULL, 15500000, 22000, 7, NULL, 1, '2020-07-27 13:52:52', '2020-07-26 17:00:49'),
(10, 2, NULL, 200000, 22000, 7, NULL, 1, '2020-07-27 16:58:49', '2020-07-27 16:58:49'),
(11, 10, NULL, 1750000, 22000, 5, 'gọi trước khi giao hàng', 0, '2020-07-28 14:46:36', '2020-07-28 14:46:36'),
(12, 10, NULL, 1750000, 22000, 5, 'gọi trước khi giao hàng', 0, '2020-07-28 16:59:59', '2020-07-28 16:59:59'),
(13, 2, NULL, 123506789, 50000, 7, 'gọi trước khi giao hàng. Cảm ơn', 0, '2020-07-28 08:55:35', '2020-07-27 08:54:52'),
(14, 2, NULL, 123506789, 50000, 7, 'gọi trước khi giao hàng. Cảm ơn', 0, '2020-07-23 14:51:24', '2020-07-23 14:51:24'),
(15, 2, NULL, 124178789, 22000, 7, NULL, 2, '2020-07-29 15:22:38', '2020-07-29 15:22:33'),
(16, 2, NULL, 124178789, 22000, 7, NULL, 2, '2020-07-29 06:11:48', '2020-07-29 06:11:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_order_detail`, `orders_id`, `product_id`, `quantity`, `updated_at`, `created_at`) VALUES
(1, 1, 2, 2, '2020-07-21 14:36:20', '2020-07-21 14:36:20'),
(2, 1, 4, 2, '2020-07-21 14:36:20', '2020-07-21 14:36:20'),
(3, 1, 1, 1, '2020-07-21 14:36:20', '2020-07-21 14:36:20'),
(4, 4, 2, 2, '2020-07-21 14:44:13', '2020-07-21 14:44:13'),
(5, 4, 4, 2, '2020-07-21 14:44:13', '2020-07-21 14:44:13'),
(6, 4, 1, 1, '2020-07-21 14:44:13', '2020-07-21 14:44:13'),
(7, 5, 2, 2, '2020-07-21 14:46:36', '2020-07-21 14:46:36'),
(8, 5, 4, 2, '2020-07-21 14:46:36', '2020-07-21 14:46:36'),
(9, 5, 1, 1, '2020-07-21 14:46:36', '2020-07-21 14:46:36'),
(10, 6, 3, 1, '2020-07-21 14:48:49', '2020-07-21 14:48:49'),
(11, 7, 3, 1, '2020-07-21 14:51:24', '2020-07-21 14:51:24'),
(12, 8, 3, 1, '2020-07-21 14:58:17', '2020-07-21 14:58:17'),
(13, 8, 2, 2, '2020-07-21 14:58:17', '2020-07-21 14:58:17'),
(14, 12, 2, 2, '2020-07-28 14:58:17', '2020-07-28 14:58:17'),
(15, 8, 13, 1, '2020-07-29 06:40:27', '2020-07-29 06:40:27'),
(16, 8, 13, 2, '2020-07-29 06:40:27', '2020-07-29 06:40:27'),
(17, 15, 13, 2, '2020-07-29 06:40:27', '2020-07-29 06:40:27'),
(18, 15, 13, 2, '2020-07-29 06:40:27', '2020-07-29 06:40:27'),
(19, 16, 13, 2, '2020-07-29 06:40:27', '2020-07-29 06:40:27');

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
  `name_product` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `madeby` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `img_product` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img1_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img2_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img3_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note_product` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description_product` longtext COLLATE utf8_unicode_ci NOT NULL,
  `price_product` int(11) NOT NULL,
  `status_product` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `slug`, `madeby`, `sub_category_id`, `brand_id`, `shop_id`, `img_product`, `img1_product`, `img2_product`, `img3_product`, `note_product`, `description_product`, `price_product`, `status_product`, `is_deleted`, `updated_at`, `created_at`) VALUES
(1, 'Casio Gsock', 'casio-gsock', 'Japan', 1, 1, 8, '18072020_32bc52a4eea5dabad16b73c746dcc99a.jpg', '18072020_dd16d078a2dc6b6fa21ba29a09fb404b.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 350000, 0, 0, '2020-07-25 16:09:17', '2020-07-25 16:09:17'),
(2, 'WoMen\'s G-Shock Anti-Magnetic resistance Watch G100-1BV', 'womens-g-shock-anti-magnetic-resistance-watch-g100-1bv', 'China', 2, 1, 8, '18072020_d4b25b4fe06a3036820d4c477b6c888b.jpg', '18072020_c20aedb4dc58dac4c6bef22dcf6c4234.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 350000, 0, 0, '2020-07-25 16:09:20', '2020-07-25 16:09:20'),
(3, 'Áo Nike', 'ao-nike', 'China', 5, 2, 10, '18072020_d55c948f5eec1e222821ed8838af2664.jpg', '18072020_6f02acb058ee0e333f35c9adb265a479.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;Lưu &yacute;: Nhập m&atilde; FREESHIP khi đặt anh/ chị nh&eacute;. Lấy m&atilde; ở phần th&ocirc;ng b&aacute;o của shopee! Nhấn v&agrave;o &ocirc; nhập m&atilde; sẽ c&oacute; m&atilde; hiện ra.<br />\r\n&Aacute;o thun nam c&oacute; cổ từ l&acirc;u đ&atilde; được ph&aacute;i mạnh ưa chuộng bởi sự năng động pha một ch&uacute;t cổ điển của n&oacute;. Nếu bạn đang c&acirc;n nhắc một chiếc &aacute;o thời trang, thanh lịch v&agrave; chất lượng th&igrave; &Aacute;o thun nam c&oacute; cổ cực đẹp 2019 cao cấp mới n&agrave;y d&agrave;nh cho bạn đ&acirc;y!</p>\r\n\r\n<p>? ĐIỂM NỔI BẬT CỦA &Aacute;O THUN NAM C&Oacute; CỔ MỚI 2019<br />\r\n- Được l&agrave;m từ thun c&aacute; sấu cao cấp, &aacute;o co d&atilde;n, thấm h&uacute;t mồ h&ocirc;i, để bạn vận động một c&aacute;ch thoải m&aacute;i.<br />\r\n- &Aacute;o thun nam c&oacute; cổ mới 2019 được may cẩn thận, chăm ch&uacute;t từng đường chỉ, tinh tế từng &aacute;o một để ra sản phẩm tốt phục vụ kh&aacute;ch h&agrave;ng của Riooshop.<br />\r\n- &Aacute;o thun trơn đơn giản, dễ mặc dễ phối đồ, gi&uacute;p bạn lu&ocirc;n tự tin khi ra đường.<br />\r\n- &Aacute;o c&oacute; đến 5 m&agrave;u sắc kh&aacute;c nhau, lại dễ d&agrave;ng phối hợp với quần jeans, kaki, short,... một sự lựa chọn ho&agrave;n hảo!</p>\r\n\r\n<p>? CHI TIẾT SẢN PHẨM &Aacute;O THUN NAM C&Oacute; CỔ MỚI<br />\r\n? K&iacute;ch cỡ: M [50-58 Kg], L [59 - 65 Kg], XL [66-75 Kg], XXL [76-85 Kg]<br />\r\n? 5 M&agrave;u: Trắng, X&aacute;m đen, Xanh r&ecirc;u, Xanh b&iacute;ch<br />\r\n? Chất liệu: Thun c&aacute; sấu cao cấp, co d&atilde;n 4 chiều.</p>\r\n\r\n<p>? HƯỚNG DẪN ĐẶT H&Agrave;NG<br />\r\nLần lượt th&ecirc;m v&agrave;o giỏ ph&acirc;n loại h&agrave;ng (M&agrave;u, Size) những &aacute;o muốn đặt, sau khi th&ecirc;m xong v&agrave;o giỏ h&agrave;ng nhấn MUA NGAY v&agrave; điền th&ocirc;ng tin thanh to&aacute;n.&lt;/span&gt;&lt;br&gt;</p>', 123456789, 0, 0, '2020-07-25 16:09:23', '2020-07-25 16:09:23'),
(4, 'Áo thun nam Polo', 'ao-thun-nam-polo', 'china', 7, 2, 10, '18072020_44fce461f02df6a652f937aab5b6c6b7.jpg', '18072020_fada64993f2fc80986d3761e8d4a9b73.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;HÀNG Đ&Ocirc;̣C QUY&Ecirc;̀N CHỈ CÓ TẠI QU&Ocirc;́C CƯỜNG SPORT<br />\r\n?. &Aacute;o Nike cổ c&ocirc;ng ngh&ecirc;̣ ép nhi&ecirc;̣t mới nh&acirc;́t kh&ocirc;ng đường may<br />\r\n? Vải thun lạnh cao cấp, logo sắc nét sờ mát tay lu&ocirc;n<br />\r\n? Form cho người Việt Nam th&acirc;n thiện ??<br />\r\n? Size S M L XL (45-80kg)<br />\r\n? Chấm . một c&aacute;i để em b&aacute;o gi&aacute; giật m&igrave;nh nha<br />\r\n#&aacute;onam<br />\r\n#thunlanhj<br />\r\n#cổ đức</p>\r\n\r\n<p>??QUỐC CƯỜNG SPORT??<br />\r\n??? Link mua h&agrave;ng freeship: shopee.vn/htpt145<br />\r\n? SN 132, Khu Đo&agrave;i, Dục Nội, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội<br />\r\n? 09666 21 866 - 0377 039 095<br />\r\n? Ship COD to&agrave;n quốc&lt;/span&gt;&lt;br&gt;</p>', 350000, 0, 0, '2020-07-25 16:09:25', '2020-07-25 16:09:25'),
(5, 'iphone 8 plus', 'iphone-8-plus', 'China', 3, 3, 9, '18072020_071a6a42e9d795962f6a4c504db2d81b.jpg', NULL, NULL, NULL, 'Hàng nội địa trung quốc', '<h3>Th&ocirc;ng số kỹ thuật chi tiết iPhone 8 Plus 64GB</h3>\r\n\r\n<p><img alt=\"Thông số kỹ thuật 114110\" src=\"https://cdn.tgdd.vn/Products/Images/42/114110/Kit/iphone-8-plus-mo-ta-chuc-nang.jpg\" style=\"height:430px; width:500px\" /></p>\r\n\r\n<ul>\r\n	<li>﻿</li>\r\n	<li>M&agrave;n h&igrave;nh</li>\r\n	<li>C&ocirc;ng nghệ m&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-ledbacklit-ips-lcd-la-gi-905757\" target=\"_blank\">LED-backlit IPS LCD</a></p>\r\n	</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#fullhd\" target=\"_blank\">Full HD (1080 x 1920 Pixels)</a></p>\r\n	</li>\r\n	<li>M&agrave;n h&igrave;nh rộng\r\n	<p>5.5&quot;</p>\r\n	</li>\r\n	<li>Mặt k&iacute;nh cảm ứng\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/kinh-oleophobic-ion-cuong-luc-tren-cac-dong-appl-1167791\" target=\"_blank\">K&iacute;nh cường lực oleophobic (ion cường lực)</a></p>\r\n	</li>\r\n	<li>Camera sau</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>Ch&iacute;nh 12 MP &amp; Phụ 12 MP</p>\r\n	</li>\r\n	<li>Quay phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-bi-1174134#4k\" target=\"_blank\">Quay phim 4K 2160p@60fps</a></p>\r\n	</li>\r\n	<li>Đ&egrave;n Flash\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-cac-loai-den-flash-tren-camera-dien-thoai-1143808#flash4bongled\" target=\"_blank\">4 đ&egrave;n LED (2 t&ocirc;ng m&agrave;u)</a></p>\r\n	</li>\r\n	<li>Chụp ảnh n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-xoa-phong-la-gi-no-co-tac-dung-nhu-the-na-1138006\" target=\"_blank\">Xo&aacute; ph&ocirc;ng</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-che-do-lay-net-du-doan-tren-smartphone-1172238\" target=\"_blank\">Lấy n&eacute;t dự đo&aacute;n</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-autofocus-trong-chup-anh-tren-smartphone-906408\" target=\"_blank\">Tự động lấy n&eacute;t (AF)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-touch-focus-khi-chup-anh-tren-smartphone-906412\" target=\"_blank\">Chạm lấy n&eacute;t</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-panorama-toan-canh-tren-camera-cua-smar-906425\" target=\"_blank\">To&agrave;n cảnh (Panorama)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chong-rung-quang-hoc-ois-chup-anh-tren-sm-906416\" target=\"_blank\">Chống rung quang học (OIS)</a></p>\r\n	</li>\r\n	<li>Camera trước</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>7 MP</p>\r\n	</li>\r\n	<li>Videocall\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/goi-video-call-la-gi-neu-may-khong-trang-bi-san-1174141\" target=\"_blank\">C&oacute;</a></p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-1174134#fullhd\" target=\"_blank\">Quay video Full HD</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a></p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh - CPU</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tat-ca-nhung-tinh-nang-moi-duoc-cap-nhat-tren-ios-1171206\" target=\"_blank\">iOS 13</a></p>\r\n	</li>\r\n	<li>Chipset (h&atilde;ng SX CPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple A11 Bionic 6 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Tốc độ CPU\r\n	<p>2.39 GHz</p>\r\n	</li>\r\n	<li>Chip đồ họa (GPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple GPU 3 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Bộ nhớ &amp; Lưu trữ</li>\r\n	<li>RAM\r\n	<p>3 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>64 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ c&ograve;n lại (khả dụng)\r\n	<p>Khoảng 55 GB</p>\r\n	</li>\r\n	<li>Kết nối</li>\r\n	<li>Mạng di động\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/mang-4g-la-gi-4g-la-gi-4gva-4g-lte-giong-hay-khac-nhau-900599\" target=\"_blank\">3G, 4G LTE Cat 16</a></p>\r\n	</li>\r\n	<li>SIM\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-loai-sim-thong-dung-sim-thuong-micro--590216#nanosim\" target=\"_blank\">1 Nano SIM</a></p>\r\n	</li>\r\n	<li>Wifi\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#80211ac\" target=\"_blank\">Wi-Fi 802.11 a/b/g/n/ac</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/wifi-dual-band-la-gi-736489\" target=\"_blank\">Dual-band</a>,&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#wifihotspot\" target=\"_blank\">Wi-Fi hotspot</a></p>\r\n	</li>\r\n	<li>GPS\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#a-gps\" target=\"_blank\">A-GPS</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#glonass\" target=\"_blank\">GLONASS</a></p>\r\n	</li>\r\n	<li>Bluetooth\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-a2dp-la-gi-723725\" target=\"_blank\">A2DP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#le\" target=\"_blank\">LE</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#edr\" target=\"_blank\">EDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/bluetooth-50-chuan-bluetooth-danh-cho-thoi-dai-1113891\" target=\"_blank\">v5.0</a></p>\r\n	</li>\r\n	<li>C&ocirc;̉ng k&ecirc;́t n&ocirc;́i/sạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Jack tai nghe\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Kết nối kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-nfc-tren-dien-thoai-may-tinh-bang-la-gi-1172835\" target=\"_blank\">NFC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-otg-la-gi-otg-duoc-su-dung-cho-muc-dich-gi-1172882\" target=\"_blank\">OTG</a></p>\r\n	</li>\r\n	<li>Thiết kế &amp; Trọng lượng</li>\r\n	<li>Thiết kế\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-kieu-thiet-ke-tren-di-dong-va-may-tin-597153#nguyenkhoi\" target=\"_blank\">Nguy&ecirc;n khối</a></p>\r\n	</li>\r\n	<li>Chất liệu\r\n	<p>Khung kim loại &amp; Mặt lưng k&iacute;nh cường lực</p>\r\n	</li>\r\n	<li>K&iacute;ch thước\r\n	<p>D&agrave;i 158.4 mm - Ngang 78.1 mm - D&agrave;y 7.5 mm</p>\r\n	</li>\r\n	<li>Trọng lượng\r\n	<p>202 g</p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin pin &amp; Sạc</li>\r\n	<li>Dung lượng pin\r\n	<p>2691 mAh</p>\r\n	</li>\r\n	<li>Loại pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-pin-li-ion-la-gi-985040\" target=\"_blank\">Pin chuẩn Li-Ion</a></p>\r\n	</li>\r\n	<li>C&ocirc;ng nghệ pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-tiet-kiem-pin-va-sieu-tiet-kiem-pin-la-gi-926730\" target=\"_blank\">Tiết kiệm pin</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-nhanh-tren-smartphone-755549\" target=\"_blank\">Sạc pin nhanh</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-khong-day-la-gi-761328\" target=\"_blank\">Sạc pin kh&ocirc;ng d&acirc;y</a></p>\r\n	</li>\r\n	<li>Tiện &iacute;ch</li>\r\n	<li>Bảo mật n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cam-bien-van-tay-tren-smartphone-la-gi-908163\" target=\"_blank\">Mở kh&oacute;a bằng v&acirc;n tay</a></p>\r\n	</li>\r\n	<li>T&iacute;nh năng đặc biệt\r\n	<p><a href=\"https://www.thegioididong.com/dtdd/11/6/2019\" target=\"_blank\">3D Touch</a></p>\r\n	</li>\r\n	<li>Ghi &acirc;m\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/microphone-chong-on-la-gi-894183\" target=\"_blank\">C&oacute;, microphone chuy&ecirc;n dụng chống ồn</a></p>\r\n	</li>\r\n	<li>Xem phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-pho-bien-hien-nay-740243#h265\" target=\"_blank\">H.265</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#3gp\" target=\"_blank\">3GP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp4\" target=\"_blank\">MP4</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#avi\" target=\"_blank\">AVI</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wmv\" target=\"_blank\">WMV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h263\" target=\"_blank\">H.263</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h264\" target=\"_blank\">H.264(MPEG4-AVC)</a></p>\r\n	</li>\r\n	<li>Nghe nhạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#midi\" target=\"_blank\">Midi</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#lossless\" target=\"_blank\">Lossless</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp3\" target=\"_blank\">MP3</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wav\" target=\"_blank\">WAV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA9</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC+</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC++</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#eaac+\" target=\"_blank\">eAAC+</a></p>\r\n	</li>\r\n</ul>', 123456789, 0, 0, '2020-07-25 16:09:27', '2020-07-25 16:09:27'),
(6, 'Casio Gsock1', 'casio-gsock-1', 'Japan', 1, 1, 8, '18072020_32bc52a4eea5dabad16b73c746dcc99a.jpg', '18072020_dd16d078a2dc6b6fa21ba29a09fb404b.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 300000, 0, 0, '2020-07-25 16:09:17', '2020-07-25 16:09:17'),
(7, 'Magnetic resistance Watch G100-1BV', 'Magnetic resistance Watch G100-1BV', 'China', 2, 1, 8, '18072020_d4b25b4fe06a3036820d4c477b6c888b.jpg', '18072020_c20aedb4dc58dac4c6bef22dcf6c4234.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 380000, 0, 0, '2020-07-25 16:09:20', '2020-07-25 16:09:20'),
(8, 'Áo Nike 3000', 'ao-nike-3000', 'China', 5, 2, 10, '18072020_d55c948f5eec1e222821ed8838af2664.jpg', '18072020_6f02acb058ee0e333f35c9adb265a479.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;Lưu &yacute;: Nhập m&atilde; FREESHIP khi đặt anh/ chị nh&eacute;. Lấy m&atilde; ở phần th&ocirc;ng b&aacute;o của shopee! Nhấn v&agrave;o &ocirc; nhập m&atilde; sẽ c&oacute; m&atilde; hiện ra.<br />\r\n&Aacute;o thun nam c&oacute; cổ từ l&acirc;u đ&atilde; được ph&aacute;i mạnh ưa chuộng bởi sự năng động pha một ch&uacute;t cổ điển của n&oacute;. Nếu bạn đang c&acirc;n nhắc một chiếc &aacute;o thời trang, thanh lịch v&agrave; chất lượng th&igrave; &Aacute;o thun nam c&oacute; cổ cực đẹp 2019 cao cấp mới n&agrave;y d&agrave;nh cho bạn đ&acirc;y!</p>\r\n\r\n<p>? ĐIỂM NỔI BẬT CỦA &Aacute;O THUN NAM C&Oacute; CỔ MỚI 2019<br />\r\n- Được l&agrave;m từ thun c&aacute; sấu cao cấp, &aacute;o co d&atilde;n, thấm h&uacute;t mồ h&ocirc;i, để bạn vận động một c&aacute;ch thoải m&aacute;i.<br />\r\n- &Aacute;o thun nam c&oacute; cổ mới 2019 được may cẩn thận, chăm ch&uacute;t từng đường chỉ, tinh tế từng &aacute;o một để ra sản phẩm tốt phục vụ kh&aacute;ch h&agrave;ng của Riooshop.<br />\r\n- &Aacute;o thun trơn đơn giản, dễ mặc dễ phối đồ, gi&uacute;p bạn lu&ocirc;n tự tin khi ra đường.<br />\r\n- &Aacute;o c&oacute; đến 5 m&agrave;u sắc kh&aacute;c nhau, lại dễ d&agrave;ng phối hợp với quần jeans, kaki, short,... một sự lựa chọn ho&agrave;n hảo!</p>\r\n\r\n<p>? CHI TIẾT SẢN PHẨM &Aacute;O THUN NAM C&Oacute; CỔ MỚI<br />\r\n? K&iacute;ch cỡ: M [50-58 Kg], L [59 - 65 Kg], XL [66-75 Kg], XXL [76-85 Kg]<br />\r\n? 5 M&agrave;u: Trắng, X&aacute;m đen, Xanh r&ecirc;u, Xanh b&iacute;ch<br />\r\n? Chất liệu: Thun c&aacute; sấu cao cấp, co d&atilde;n 4 chiều.</p>\r\n\r\n<p>? HƯỚNG DẪN ĐẶT H&Agrave;NG<br />\r\nLần lượt th&ecirc;m v&agrave;o giỏ ph&acirc;n loại h&agrave;ng (M&agrave;u, Size) những &aacute;o muốn đặt, sau khi th&ecirc;m xong v&agrave;o giỏ h&agrave;ng nhấn MUA NGAY v&agrave; điền th&ocirc;ng tin thanh to&aacute;n.&lt;/span&gt;&lt;br&gt;</p>', 160000, 0, 0, '2020-07-25 16:09:23', '2020-07-25 16:09:23'),
(9, 'Áo thun nam ', 'ao-thun-nam', 'china', 7, 2, 10, '18072020_44fce461f02df6a652f937aab5b6c6b7.jpg', '18072020_fada64993f2fc80986d3761e8d4a9b73.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;HÀNG Đ&Ocirc;̣C QUY&Ecirc;̀N CHỈ CÓ TẠI QU&Ocirc;́C CƯỜNG SPORT<br />\r\n?. &Aacute;o Nike cổ c&ocirc;ng ngh&ecirc;̣ ép nhi&ecirc;̣t mới nh&acirc;́t kh&ocirc;ng đường may<br />\r\n? Vải thun lạnh cao cấp, logo sắc nét sờ mát tay lu&ocirc;n<br />\r\n? Form cho người Việt Nam th&acirc;n thiện ??<br />\r\n? Size S M L XL (45-80kg)<br />\r\n? Chấm . một c&aacute;i để em b&aacute;o gi&aacute; giật m&igrave;nh nha<br />\r\n#&aacute;onam<br />\r\n#thunlanhj<br />\r\n#cổ đức</p>\r\n\r\n<p>??QUỐC CƯỜNG SPORT??<br />\r\n??? Link mua h&agrave;ng freeship: shopee.vn/htpt145<br />\r\n? SN 132, Khu Đo&agrave;i, Dục Nội, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội<br />\r\n? 09666 21 866 - 0377 039 095<br />\r\n? Ship COD to&agrave;n quốc&lt;/span&gt;&lt;br&gt;</p>', 150000, 0, 0, '2020-07-25 16:09:25', '2020-07-25 16:09:25'),
(10, 'iphone 7 plus', 'iphone-7-plus', 'China', 3, 3, 9, '18072020_071a6a42e9d795962f6a4c504db2d81b.jpg', NULL, NULL, NULL, 'Hàng nội địa trung quốc', '<h3>Th&ocirc;ng số kỹ thuật chi tiết iPhone 8 Plus 64GB</h3>\r\n\r\n<p><img alt=\"Thông số kỹ thuật 114110\" src=\"https://cdn.tgdd.vn/Products/Images/42/114110/Kit/iphone-8-plus-mo-ta-chuc-nang.jpg\" style=\"height:430px; width:500px\" /></p>\r\n\r\n<ul>\r\n	<li>﻿</li>\r\n	<li>M&agrave;n h&igrave;nh</li>\r\n	<li>C&ocirc;ng nghệ m&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-ledbacklit-ips-lcd-la-gi-905757\" target=\"_blank\">LED-backlit IPS LCD</a></p>\r\n	</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#fullhd\" target=\"_blank\">Full HD (1080 x 1920 Pixels)</a></p>\r\n	</li>\r\n	<li>M&agrave;n h&igrave;nh rộng\r\n	<p>5.5&quot;</p>\r\n	</li>\r\n	<li>Mặt k&iacute;nh cảm ứng\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/kinh-oleophobic-ion-cuong-luc-tren-cac-dong-appl-1167791\" target=\"_blank\">K&iacute;nh cường lực oleophobic (ion cường lực)</a></p>\r\n	</li>\r\n	<li>Camera sau</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>Ch&iacute;nh 12 MP &amp; Phụ 12 MP</p>\r\n	</li>\r\n	<li>Quay phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-bi-1174134#4k\" target=\"_blank\">Quay phim 4K 2160p@60fps</a></p>\r\n	</li>\r\n	<li>Đ&egrave;n Flash\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-cac-loai-den-flash-tren-camera-dien-thoai-1143808#flash4bongled\" target=\"_blank\">4 đ&egrave;n LED (2 t&ocirc;ng m&agrave;u)</a></p>\r\n	</li>\r\n	<li>Chụp ảnh n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-xoa-phong-la-gi-no-co-tac-dung-nhu-the-na-1138006\" target=\"_blank\">Xo&aacute; ph&ocirc;ng</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-che-do-lay-net-du-doan-tren-smartphone-1172238\" target=\"_blank\">Lấy n&eacute;t dự đo&aacute;n</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-autofocus-trong-chup-anh-tren-smartphone-906408\" target=\"_blank\">Tự động lấy n&eacute;t (AF)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-touch-focus-khi-chup-anh-tren-smartphone-906412\" target=\"_blank\">Chạm lấy n&eacute;t</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-panorama-toan-canh-tren-camera-cua-smar-906425\" target=\"_blank\">To&agrave;n cảnh (Panorama)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chong-rung-quang-hoc-ois-chup-anh-tren-sm-906416\" target=\"_blank\">Chống rung quang học (OIS)</a></p>\r\n	</li>\r\n	<li>Camera trước</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>7 MP</p>\r\n	</li>\r\n	<li>Videocall\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/goi-video-call-la-gi-neu-may-khong-trang-bi-san-1174141\" target=\"_blank\">C&oacute;</a></p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-1174134#fullhd\" target=\"_blank\">Quay video Full HD</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a></p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh - CPU</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tat-ca-nhung-tinh-nang-moi-duoc-cap-nhat-tren-ios-1171206\" target=\"_blank\">iOS 13</a></p>\r\n	</li>\r\n	<li>Chipset (h&atilde;ng SX CPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple A11 Bionic 6 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Tốc độ CPU\r\n	<p>2.39 GHz</p>\r\n	</li>\r\n	<li>Chip đồ họa (GPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple GPU 3 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Bộ nhớ &amp; Lưu trữ</li>\r\n	<li>RAM\r\n	<p>3 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>64 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ c&ograve;n lại (khả dụng)\r\n	<p>Khoảng 55 GB</p>\r\n	</li>\r\n	<li>Kết nối</li>\r\n	<li>Mạng di động\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/mang-4g-la-gi-4g-la-gi-4gva-4g-lte-giong-hay-khac-nhau-900599\" target=\"_blank\">3G, 4G LTE Cat 16</a></p>\r\n	</li>\r\n	<li>SIM\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-loai-sim-thong-dung-sim-thuong-micro--590216#nanosim\" target=\"_blank\">1 Nano SIM</a></p>\r\n	</li>\r\n	<li>Wifi\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#80211ac\" target=\"_blank\">Wi-Fi 802.11 a/b/g/n/ac</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/wifi-dual-band-la-gi-736489\" target=\"_blank\">Dual-band</a>,&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#wifihotspot\" target=\"_blank\">Wi-Fi hotspot</a></p>\r\n	</li>\r\n	<li>GPS\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#a-gps\" target=\"_blank\">A-GPS</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#glonass\" target=\"_blank\">GLONASS</a></p>\r\n	</li>\r\n	<li>Bluetooth\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-a2dp-la-gi-723725\" target=\"_blank\">A2DP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#le\" target=\"_blank\">LE</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#edr\" target=\"_blank\">EDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/bluetooth-50-chuan-bluetooth-danh-cho-thoi-dai-1113891\" target=\"_blank\">v5.0</a></p>\r\n	</li>\r\n	<li>C&ocirc;̉ng k&ecirc;́t n&ocirc;́i/sạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Jack tai nghe\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Kết nối kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-nfc-tren-dien-thoai-may-tinh-bang-la-gi-1172835\" target=\"_blank\">NFC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-otg-la-gi-otg-duoc-su-dung-cho-muc-dich-gi-1172882\" target=\"_blank\">OTG</a></p>\r\n	</li>\r\n	<li>Thiết kế &amp; Trọng lượng</li>\r\n	<li>Thiết kế\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-kieu-thiet-ke-tren-di-dong-va-may-tin-597153#nguyenkhoi\" target=\"_blank\">Nguy&ecirc;n khối</a></p>\r\n	</li>\r\n	<li>Chất liệu\r\n	<p>Khung kim loại &amp; Mặt lưng k&iacute;nh cường lực</p>\r\n	</li>\r\n	<li>K&iacute;ch thước\r\n	<p>D&agrave;i 158.4 mm - Ngang 78.1 mm - D&agrave;y 7.5 mm</p>\r\n	</li>\r\n	<li>Trọng lượng\r\n	<p>202 g</p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin pin &amp; Sạc</li>\r\n	<li>Dung lượng pin\r\n	<p>2691 mAh</p>\r\n	</li>\r\n	<li>Loại pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-pin-li-ion-la-gi-985040\" target=\"_blank\">Pin chuẩn Li-Ion</a></p>\r\n	</li>\r\n	<li>C&ocirc;ng nghệ pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-tiet-kiem-pin-va-sieu-tiet-kiem-pin-la-gi-926730\" target=\"_blank\">Tiết kiệm pin</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-nhanh-tren-smartphone-755549\" target=\"_blank\">Sạc pin nhanh</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-khong-day-la-gi-761328\" target=\"_blank\">Sạc pin kh&ocirc;ng d&acirc;y</a></p>\r\n	</li>\r\n	<li>Tiện &iacute;ch</li>\r\n	<li>Bảo mật n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cam-bien-van-tay-tren-smartphone-la-gi-908163\" target=\"_blank\">Mở kh&oacute;a bằng v&acirc;n tay</a></p>\r\n	</li>\r\n	<li>T&iacute;nh năng đặc biệt\r\n	<p><a href=\"https://www.thegioididong.com/dtdd/11/6/2019\" target=\"_blank\">3D Touch</a></p>\r\n	</li>\r\n	<li>Ghi &acirc;m\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/microphone-chong-on-la-gi-894183\" target=\"_blank\">C&oacute;, microphone chuy&ecirc;n dụng chống ồn</a></p>\r\n	</li>\r\n	<li>Xem phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-pho-bien-hien-nay-740243#h265\" target=\"_blank\">H.265</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#3gp\" target=\"_blank\">3GP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp4\" target=\"_blank\">MP4</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#avi\" target=\"_blank\">AVI</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wmv\" target=\"_blank\">WMV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h263\" target=\"_blank\">H.263</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h264\" target=\"_blank\">H.264(MPEG4-AVC)</a></p>\r\n	</li>\r\n	<li>Nghe nhạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#midi\" target=\"_blank\">Midi</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#lossless\" target=\"_blank\">Lossless</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp3\" target=\"_blank\">MP3</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wav\" target=\"_blank\">WAV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA9</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC+</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC++</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#eaac+\" target=\"_blank\">eAAC+</a></p>\r\n	</li>\r\n</ul>', 5500000, 0, 0, '2020-07-25 16:09:27', '2020-07-25 16:09:27'),
(11, 'Casio Gsock 2', 'casio-gsock-2', 'Japan', 1, 1, 8, '18072020_32bc52a4eea5dabad16b73c746dcc99a.jpg', '18072020_dd16d078a2dc6b6fa21ba29a09fb404b.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 290000, 0, 0, '2020-07-25 16:09:17', '2020-07-25 16:09:17'),
(12, 'WoMen\'s Watch G100-1BV', 'womens-g-shock-anti-magnetic-resistance-watch-g100-1bv', 'China', 2, 1, 8, '18072020_d4b25b4fe06a3036820d4c477b6c888b.jpg', '18072020_c20aedb4dc58dac4c6bef22dcf6c4234.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 990000, 0, 0, '2020-07-25 16:09:20', '2020-07-25 16:09:20'),
(13, 'Áo Adidas', 'ao-adidas', 'China', 5, 2, 10, '18072020_d55c948f5eec1e222821ed8838af2664.jpg', '18072020_6f02acb058ee0e333f35c9adb265a479.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;Lưu &yacute;: Nhập m&atilde; FREESHIP khi đặt anh/ chị nh&eacute;. Lấy m&atilde; ở phần th&ocirc;ng b&aacute;o của shopee! Nhấn v&agrave;o &ocirc; nhập m&atilde; sẽ c&oacute; m&atilde; hiện ra.<br />\r\n&Aacute;o thun nam c&oacute; cổ từ l&acirc;u đ&atilde; được ph&aacute;i mạnh ưa chuộng bởi sự năng động pha một ch&uacute;t cổ điển của n&oacute;. Nếu bạn đang c&acirc;n nhắc một chiếc &aacute;o thời trang, thanh lịch v&agrave; chất lượng th&igrave; &Aacute;o thun nam c&oacute; cổ cực đẹp 2019 cao cấp mới n&agrave;y d&agrave;nh cho bạn đ&acirc;y!</p>\r\n\r\n<p>? ĐIỂM NỔI BẬT CỦA &Aacute;O THUN NAM C&Oacute; CỔ MỚI 2019<br />\r\n- Được l&agrave;m từ thun c&aacute; sấu cao cấp, &aacute;o co d&atilde;n, thấm h&uacute;t mồ h&ocirc;i, để bạn vận động một c&aacute;ch thoải m&aacute;i.<br />\r\n- &Aacute;o thun nam c&oacute; cổ mới 2019 được may cẩn thận, chăm ch&uacute;t từng đường chỉ, tinh tế từng &aacute;o một để ra sản phẩm tốt phục vụ kh&aacute;ch h&agrave;ng của Riooshop.<br />\r\n- &Aacute;o thun trơn đơn giản, dễ mặc dễ phối đồ, gi&uacute;p bạn lu&ocirc;n tự tin khi ra đường.<br />\r\n- &Aacute;o c&oacute; đến 5 m&agrave;u sắc kh&aacute;c nhau, lại dễ d&agrave;ng phối hợp với quần jeans, kaki, short,... một sự lựa chọn ho&agrave;n hảo!</p>\r\n\r\n<p>? CHI TIẾT SẢN PHẨM &Aacute;O THUN NAM C&Oacute; CỔ MỚI<br />\r\n? K&iacute;ch cỡ: M [50-58 Kg], L [59 - 65 Kg], XL [66-75 Kg], XXL [76-85 Kg]<br />\r\n? 5 M&agrave;u: Trắng, X&aacute;m đen, Xanh r&ecirc;u, Xanh b&iacute;ch<br />\r\n? Chất liệu: Thun c&aacute; sấu cao cấp, co d&atilde;n 4 chiều.</p>\r\n\r\n<p>? HƯỚNG DẪN ĐẶT H&Agrave;NG<br />\r\nLần lượt th&ecirc;m v&agrave;o giỏ ph&acirc;n loại h&agrave;ng (M&agrave;u, Size) những &aacute;o muốn đặt, sau khi th&ecirc;m xong v&agrave;o giỏ h&agrave;ng nhấn MUA NGAY v&agrave; điền th&ocirc;ng tin thanh to&aacute;n.&lt;/span&gt;&lt;br&gt;</p>', 1500000, 0, 0, '2020-07-25 16:09:23', '2020-07-25 16:09:23'),
(14, 'Áo thun trơn', 'ao-thun-tron', 'china', 7, 2, 10, '18072020_44fce461f02df6a652f937aab5b6c6b7.jpg', '18072020_fada64993f2fc80986d3761e8d4a9b73.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;HÀNG Đ&Ocirc;̣C QUY&Ecirc;̀N CHỈ CÓ TẠI QU&Ocirc;́C CƯỜNG SPORT<br />\r\n?. &Aacute;o Nike cổ c&ocirc;ng ngh&ecirc;̣ ép nhi&ecirc;̣t mới nh&acirc;́t kh&ocirc;ng đường may<br />\r\n? Vải thun lạnh cao cấp, logo sắc nét sờ mát tay lu&ocirc;n<br />\r\n? Form cho người Việt Nam th&acirc;n thiện ??<br />\r\n? Size S M L XL (45-80kg)<br />\r\n? Chấm . một c&aacute;i để em b&aacute;o gi&aacute; giật m&igrave;nh nha<br />\r\n#&aacute;onam<br />\r\n#thunlanhj<br />\r\n#cổ đức</p>\r\n\r\n<p>??QUỐC CƯỜNG SPORT??<br />\r\n??? Link mua h&agrave;ng freeship: shopee.vn/htpt145<br />\r\n? SN 132, Khu Đo&agrave;i, Dục Nội, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội<br />\r\n? 09666 21 866 - 0377 039 095<br />\r\n? Ship COD to&agrave;n quốc&lt;/span&gt;&lt;br&gt;</p>', 35000, 0, 0, '2020-07-25 16:09:25', '2020-07-25 16:09:25');
INSERT INTO `products` (`id_product`, `name_product`, `slug`, `madeby`, `sub_category_id`, `brand_id`, `shop_id`, `img_product`, `img1_product`, `img2_product`, `img3_product`, `note_product`, `description_product`, `price_product`, `status_product`, `is_deleted`, `updated_at`, `created_at`) VALUES
(15, 'iphone 9', 'iphone-9', 'China', 3, 3, 9, '18072020_071a6a42e9d795962f6a4c504db2d81b.jpg', NULL, NULL, NULL, 'Hàng nội địa trung quốc', '<h3>Th&ocirc;ng số kỹ thuật chi tiết iPhone 8 Plus 64GB</h3>\r\n\r\n<p><img alt=\"Thông số kỹ thuật 114110\" src=\"https://cdn.tgdd.vn/Products/Images/42/114110/Kit/iphone-8-plus-mo-ta-chuc-nang.jpg\" style=\"height:430px; width:500px\" /></p>\r\n\r\n<ul>\r\n	<li>﻿</li>\r\n	<li>M&agrave;n h&igrave;nh</li>\r\n	<li>C&ocirc;ng nghệ m&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-ledbacklit-ips-lcd-la-gi-905757\" target=\"_blank\">LED-backlit IPS LCD</a></p>\r\n	</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#fullhd\" target=\"_blank\">Full HD (1080 x 1920 Pixels)</a></p>\r\n	</li>\r\n	<li>M&agrave;n h&igrave;nh rộng\r\n	<p>5.5&quot;</p>\r\n	</li>\r\n	<li>Mặt k&iacute;nh cảm ứng\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/kinh-oleophobic-ion-cuong-luc-tren-cac-dong-appl-1167791\" target=\"_blank\">K&iacute;nh cường lực oleophobic (ion cường lực)</a></p>\r\n	</li>\r\n	<li>Camera sau</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>Ch&iacute;nh 12 MP &amp; Phụ 12 MP</p>\r\n	</li>\r\n	<li>Quay phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-bi-1174134#4k\" target=\"_blank\">Quay phim 4K 2160p@60fps</a></p>\r\n	</li>\r\n	<li>Đ&egrave;n Flash\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-cac-loai-den-flash-tren-camera-dien-thoai-1143808#flash4bongled\" target=\"_blank\">4 đ&egrave;n LED (2 t&ocirc;ng m&agrave;u)</a></p>\r\n	</li>\r\n	<li>Chụp ảnh n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-xoa-phong-la-gi-no-co-tac-dung-nhu-the-na-1138006\" target=\"_blank\">Xo&aacute; ph&ocirc;ng</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-che-do-lay-net-du-doan-tren-smartphone-1172238\" target=\"_blank\">Lấy n&eacute;t dự đo&aacute;n</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-autofocus-trong-chup-anh-tren-smartphone-906408\" target=\"_blank\">Tự động lấy n&eacute;t (AF)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-touch-focus-khi-chup-anh-tren-smartphone-906412\" target=\"_blank\">Chạm lấy n&eacute;t</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-panorama-toan-canh-tren-camera-cua-smar-906425\" target=\"_blank\">To&agrave;n cảnh (Panorama)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chong-rung-quang-hoc-ois-chup-anh-tren-sm-906416\" target=\"_blank\">Chống rung quang học (OIS)</a></p>\r\n	</li>\r\n	<li>Camera trước</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>7 MP</p>\r\n	</li>\r\n	<li>Videocall\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/goi-video-call-la-gi-neu-may-khong-trang-bi-san-1174141\" target=\"_blank\">C&oacute;</a></p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-1174134#fullhd\" target=\"_blank\">Quay video Full HD</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a></p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh - CPU</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tat-ca-nhung-tinh-nang-moi-duoc-cap-nhat-tren-ios-1171206\" target=\"_blank\">iOS 13</a></p>\r\n	</li>\r\n	<li>Chipset (h&atilde;ng SX CPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple A11 Bionic 6 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Tốc độ CPU\r\n	<p>2.39 GHz</p>\r\n	</li>\r\n	<li>Chip đồ họa (GPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple GPU 3 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Bộ nhớ &amp; Lưu trữ</li>\r\n	<li>RAM\r\n	<p>3 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>64 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ c&ograve;n lại (khả dụng)\r\n	<p>Khoảng 55 GB</p>\r\n	</li>\r\n	<li>Kết nối</li>\r\n	<li>Mạng di động\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/mang-4g-la-gi-4g-la-gi-4gva-4g-lte-giong-hay-khac-nhau-900599\" target=\"_blank\">3G, 4G LTE Cat 16</a></p>\r\n	</li>\r\n	<li>SIM\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-loai-sim-thong-dung-sim-thuong-micro--590216#nanosim\" target=\"_blank\">1 Nano SIM</a></p>\r\n	</li>\r\n	<li>Wifi\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#80211ac\" target=\"_blank\">Wi-Fi 802.11 a/b/g/n/ac</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/wifi-dual-band-la-gi-736489\" target=\"_blank\">Dual-band</a>,&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#wifihotspot\" target=\"_blank\">Wi-Fi hotspot</a></p>\r\n	</li>\r\n	<li>GPS\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#a-gps\" target=\"_blank\">A-GPS</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#glonass\" target=\"_blank\">GLONASS</a></p>\r\n	</li>\r\n	<li>Bluetooth\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-a2dp-la-gi-723725\" target=\"_blank\">A2DP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#le\" target=\"_blank\">LE</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#edr\" target=\"_blank\">EDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/bluetooth-50-chuan-bluetooth-danh-cho-thoi-dai-1113891\" target=\"_blank\">v5.0</a></p>\r\n	</li>\r\n	<li>C&ocirc;̉ng k&ecirc;́t n&ocirc;́i/sạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Jack tai nghe\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Kết nối kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-nfc-tren-dien-thoai-may-tinh-bang-la-gi-1172835\" target=\"_blank\">NFC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-otg-la-gi-otg-duoc-su-dung-cho-muc-dich-gi-1172882\" target=\"_blank\">OTG</a></p>\r\n	</li>\r\n	<li>Thiết kế &amp; Trọng lượng</li>\r\n	<li>Thiết kế\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-kieu-thiet-ke-tren-di-dong-va-may-tin-597153#nguyenkhoi\" target=\"_blank\">Nguy&ecirc;n khối</a></p>\r\n	</li>\r\n	<li>Chất liệu\r\n	<p>Khung kim loại &amp; Mặt lưng k&iacute;nh cường lực</p>\r\n	</li>\r\n	<li>K&iacute;ch thước\r\n	<p>D&agrave;i 158.4 mm - Ngang 78.1 mm - D&agrave;y 7.5 mm</p>\r\n	</li>\r\n	<li>Trọng lượng\r\n	<p>202 g</p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin pin &amp; Sạc</li>\r\n	<li>Dung lượng pin\r\n	<p>2691 mAh</p>\r\n	</li>\r\n	<li>Loại pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-pin-li-ion-la-gi-985040\" target=\"_blank\">Pin chuẩn Li-Ion</a></p>\r\n	</li>\r\n	<li>C&ocirc;ng nghệ pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-tiet-kiem-pin-va-sieu-tiet-kiem-pin-la-gi-926730\" target=\"_blank\">Tiết kiệm pin</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-nhanh-tren-smartphone-755549\" target=\"_blank\">Sạc pin nhanh</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-khong-day-la-gi-761328\" target=\"_blank\">Sạc pin kh&ocirc;ng d&acirc;y</a></p>\r\n	</li>\r\n	<li>Tiện &iacute;ch</li>\r\n	<li>Bảo mật n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cam-bien-van-tay-tren-smartphone-la-gi-908163\" target=\"_blank\">Mở kh&oacute;a bằng v&acirc;n tay</a></p>\r\n	</li>\r\n	<li>T&iacute;nh năng đặc biệt\r\n	<p><a href=\"https://www.thegioididong.com/dtdd/11/6/2019\" target=\"_blank\">3D Touch</a></p>\r\n	</li>\r\n	<li>Ghi &acirc;m\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/microphone-chong-on-la-gi-894183\" target=\"_blank\">C&oacute;, microphone chuy&ecirc;n dụng chống ồn</a></p>\r\n	</li>\r\n	<li>Xem phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-pho-bien-hien-nay-740243#h265\" target=\"_blank\">H.265</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#3gp\" target=\"_blank\">3GP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp4\" target=\"_blank\">MP4</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#avi\" target=\"_blank\">AVI</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wmv\" target=\"_blank\">WMV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h263\" target=\"_blank\">H.263</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h264\" target=\"_blank\">H.264(MPEG4-AVC)</a></p>\r\n	</li>\r\n	<li>Nghe nhạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#midi\" target=\"_blank\">Midi</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#lossless\" target=\"_blank\">Lossless</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp3\" target=\"_blank\">MP3</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wav\" target=\"_blank\">WAV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA9</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC+</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC++</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#eaac+\" target=\"_blank\">eAAC+</a></p>\r\n	</li>\r\n</ul>', 8690000, 0, 0, '2020-07-25 16:09:27', '2020-07-25 16:09:27'),
(16, 'Casio Gsock 3', 'casio-gsock-3', 'Japan', 1, 1, 8, '18072020_32bc52a4eea5dabad16b73c746dcc99a.jpg', '18072020_dd16d078a2dc6b6fa21ba29a09fb404b.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 450000, 0, 0, '2020-07-25 16:09:17', '2020-07-25 16:09:17'),
(17, 'Watch G100-1BV', 'Watch G100-1BV', 'China', 2, 1, 8, '18072020_d4b25b4fe06a3036820d4c477b6c888b.jpg', '18072020_c20aedb4dc58dac4c6bef22dcf6c4234.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 1200000, 0, 0, '2020-07-25 16:09:20', '2020-07-25 16:09:20'),
(18, 'Áo Nike 2000', 'ao-nike-2000', 'China', 5, 2, 10, '18072020_d55c948f5eec1e222821ed8838af2664.jpg', '18072020_6f02acb058ee0e333f35c9adb265a479.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;Lưu &yacute;: Nhập m&atilde; FREESHIP khi đặt anh/ chị nh&eacute;. Lấy m&atilde; ở phần th&ocirc;ng b&aacute;o của shopee! Nhấn v&agrave;o &ocirc; nhập m&atilde; sẽ c&oacute; m&atilde; hiện ra.<br />\r\n&Aacute;o thun nam c&oacute; cổ từ l&acirc;u đ&atilde; được ph&aacute;i mạnh ưa chuộng bởi sự năng động pha một ch&uacute;t cổ điển của n&oacute;. Nếu bạn đang c&acirc;n nhắc một chiếc &aacute;o thời trang, thanh lịch v&agrave; chất lượng th&igrave; &Aacute;o thun nam c&oacute; cổ cực đẹp 2019 cao cấp mới n&agrave;y d&agrave;nh cho bạn đ&acirc;y!</p>\r\n\r\n<p>? ĐIỂM NỔI BẬT CỦA &Aacute;O THUN NAM C&Oacute; CỔ MỚI 2019<br />\r\n- Được l&agrave;m từ thun c&aacute; sấu cao cấp, &aacute;o co d&atilde;n, thấm h&uacute;t mồ h&ocirc;i, để bạn vận động một c&aacute;ch thoải m&aacute;i.<br />\r\n- &Aacute;o thun nam c&oacute; cổ mới 2019 được may cẩn thận, chăm ch&uacute;t từng đường chỉ, tinh tế từng &aacute;o một để ra sản phẩm tốt phục vụ kh&aacute;ch h&agrave;ng của Riooshop.<br />\r\n- &Aacute;o thun trơn đơn giản, dễ mặc dễ phối đồ, gi&uacute;p bạn lu&ocirc;n tự tin khi ra đường.<br />\r\n- &Aacute;o c&oacute; đến 5 m&agrave;u sắc kh&aacute;c nhau, lại dễ d&agrave;ng phối hợp với quần jeans, kaki, short,... một sự lựa chọn ho&agrave;n hảo!</p>\r\n\r\n<p>? CHI TIẾT SẢN PHẨM &Aacute;O THUN NAM C&Oacute; CỔ MỚI<br />\r\n? K&iacute;ch cỡ: M [50-58 Kg], L [59 - 65 Kg], XL [66-75 Kg], XXL [76-85 Kg]<br />\r\n? 5 M&agrave;u: Trắng, X&aacute;m đen, Xanh r&ecirc;u, Xanh b&iacute;ch<br />\r\n? Chất liệu: Thun c&aacute; sấu cao cấp, co d&atilde;n 4 chiều.</p>\r\n\r\n<p>? HƯỚNG DẪN ĐẶT H&Agrave;NG<br />\r\nLần lượt th&ecirc;m v&agrave;o giỏ ph&acirc;n loại h&agrave;ng (M&agrave;u, Size) những &aacute;o muốn đặt, sau khi th&ecirc;m xong v&agrave;o giỏ h&agrave;ng nhấn MUA NGAY v&agrave; điền th&ocirc;ng tin thanh to&aacute;n.&lt;/span&gt;&lt;br&gt;</p>', 450000, 0, 0, '2020-07-25 16:09:23', '2020-07-25 16:09:23'),
(19, 'Áo thun nữ', 'ao-thun-nu', 'china', 6, 2, 10, '18072020_44fce461f02df6a652f937aab5b6c6b7.jpg', '18072020_fada64993f2fc80986d3761e8d4a9b73.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;HÀNG Đ&Ocirc;̣C QUY&Ecirc;̀N CHỈ CÓ TẠI QU&Ocirc;́C CƯỜNG SPORT<br />\r\n?. &Aacute;o Nike cổ c&ocirc;ng ngh&ecirc;̣ ép nhi&ecirc;̣t mới nh&acirc;́t kh&ocirc;ng đường may<br />\r\n? Vải thun lạnh cao cấp, logo sắc nét sờ mát tay lu&ocirc;n<br />\r\n? Form cho người Việt Nam th&acirc;n thiện ??<br />\r\n? Size S M L XL (45-80kg)<br />\r\n? Chấm . một c&aacute;i để em b&aacute;o gi&aacute; giật m&igrave;nh nha<br />\r\n#&aacute;onam<br />\r\n#thunlanhj<br />\r\n#cổ đức</p>\r\n\r\n<p>??QUỐC CƯỜNG SPORT??<br />\r\n??? Link mua h&agrave;ng freeship: shopee.vn/htpt145<br />\r\n? SN 132, Khu Đo&agrave;i, Dục Nội, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội<br />\r\n? 09666 21 866 - 0377 039 095<br />\r\n? Ship COD to&agrave;n quốc&lt;/span&gt;&lt;br&gt;</p>', 70000, 0, 0, '2020-07-25 16:09:25', '2020-07-25 16:09:25'),
(20, 'iphone X', 'iphone-x', 'China', 3, 3, 9, '18072020_071a6a42e9d795962f6a4c504db2d81b.jpg', NULL, NULL, NULL, 'Hàng nội địa trung quốc', '<h3>Th&ocirc;ng số kỹ thuật chi tiết iPhone 8 Plus 64GB</h3>\r\n\r\n<p><img alt=\"Thông số kỹ thuật 114110\" src=\"https://cdn.tgdd.vn/Products/Images/42/114110/Kit/iphone-8-plus-mo-ta-chuc-nang.jpg\" style=\"height:430px; width:500px\" /></p>\r\n\r\n<ul>\r\n	<li>﻿</li>\r\n	<li>M&agrave;n h&igrave;nh</li>\r\n	<li>C&ocirc;ng nghệ m&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-ledbacklit-ips-lcd-la-gi-905757\" target=\"_blank\">LED-backlit IPS LCD</a></p>\r\n	</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#fullhd\" target=\"_blank\">Full HD (1080 x 1920 Pixels)</a></p>\r\n	</li>\r\n	<li>M&agrave;n h&igrave;nh rộng\r\n	<p>5.5&quot;</p>\r\n	</li>\r\n	<li>Mặt k&iacute;nh cảm ứng\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/kinh-oleophobic-ion-cuong-luc-tren-cac-dong-appl-1167791\" target=\"_blank\">K&iacute;nh cường lực oleophobic (ion cường lực)</a></p>\r\n	</li>\r\n	<li>Camera sau</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>Ch&iacute;nh 12 MP &amp; Phụ 12 MP</p>\r\n	</li>\r\n	<li>Quay phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-bi-1174134#4k\" target=\"_blank\">Quay phim 4K 2160p@60fps</a></p>\r\n	</li>\r\n	<li>Đ&egrave;n Flash\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-cac-loai-den-flash-tren-camera-dien-thoai-1143808#flash4bongled\" target=\"_blank\">4 đ&egrave;n LED (2 t&ocirc;ng m&agrave;u)</a></p>\r\n	</li>\r\n	<li>Chụp ảnh n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-xoa-phong-la-gi-no-co-tac-dung-nhu-the-na-1138006\" target=\"_blank\">Xo&aacute; ph&ocirc;ng</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-che-do-lay-net-du-doan-tren-smartphone-1172238\" target=\"_blank\">Lấy n&eacute;t dự đo&aacute;n</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-autofocus-trong-chup-anh-tren-smartphone-906408\" target=\"_blank\">Tự động lấy n&eacute;t (AF)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-touch-focus-khi-chup-anh-tren-smartphone-906412\" target=\"_blank\">Chạm lấy n&eacute;t</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-panorama-toan-canh-tren-camera-cua-smar-906425\" target=\"_blank\">To&agrave;n cảnh (Panorama)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chong-rung-quang-hoc-ois-chup-anh-tren-sm-906416\" target=\"_blank\">Chống rung quang học (OIS)</a></p>\r\n	</li>\r\n	<li>Camera trước</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>7 MP</p>\r\n	</li>\r\n	<li>Videocall\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/goi-video-call-la-gi-neu-may-khong-trang-bi-san-1174141\" target=\"_blank\">C&oacute;</a></p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-1174134#fullhd\" target=\"_blank\">Quay video Full HD</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a></p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh - CPU</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tat-ca-nhung-tinh-nang-moi-duoc-cap-nhat-tren-ios-1171206\" target=\"_blank\">iOS 13</a></p>\r\n	</li>\r\n	<li>Chipset (h&atilde;ng SX CPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple A11 Bionic 6 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Tốc độ CPU\r\n	<p>2.39 GHz</p>\r\n	</li>\r\n	<li>Chip đồ họa (GPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple GPU 3 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Bộ nhớ &amp; Lưu trữ</li>\r\n	<li>RAM\r\n	<p>3 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>64 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ c&ograve;n lại (khả dụng)\r\n	<p>Khoảng 55 GB</p>\r\n	</li>\r\n	<li>Kết nối</li>\r\n	<li>Mạng di động\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/mang-4g-la-gi-4g-la-gi-4gva-4g-lte-giong-hay-khac-nhau-900599\" target=\"_blank\">3G, 4G LTE Cat 16</a></p>\r\n	</li>\r\n	<li>SIM\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-loai-sim-thong-dung-sim-thuong-micro--590216#nanosim\" target=\"_blank\">1 Nano SIM</a></p>\r\n	</li>\r\n	<li>Wifi\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#80211ac\" target=\"_blank\">Wi-Fi 802.11 a/b/g/n/ac</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/wifi-dual-band-la-gi-736489\" target=\"_blank\">Dual-band</a>,&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#wifihotspot\" target=\"_blank\">Wi-Fi hotspot</a></p>\r\n	</li>\r\n	<li>GPS\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#a-gps\" target=\"_blank\">A-GPS</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#glonass\" target=\"_blank\">GLONASS</a></p>\r\n	</li>\r\n	<li>Bluetooth\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-a2dp-la-gi-723725\" target=\"_blank\">A2DP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#le\" target=\"_blank\">LE</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#edr\" target=\"_blank\">EDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/bluetooth-50-chuan-bluetooth-danh-cho-thoi-dai-1113891\" target=\"_blank\">v5.0</a></p>\r\n	</li>\r\n	<li>C&ocirc;̉ng k&ecirc;́t n&ocirc;́i/sạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Jack tai nghe\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Kết nối kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-nfc-tren-dien-thoai-may-tinh-bang-la-gi-1172835\" target=\"_blank\">NFC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-otg-la-gi-otg-duoc-su-dung-cho-muc-dich-gi-1172882\" target=\"_blank\">OTG</a></p>\r\n	</li>\r\n	<li>Thiết kế &amp; Trọng lượng</li>\r\n	<li>Thiết kế\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-kieu-thiet-ke-tren-di-dong-va-may-tin-597153#nguyenkhoi\" target=\"_blank\">Nguy&ecirc;n khối</a></p>\r\n	</li>\r\n	<li>Chất liệu\r\n	<p>Khung kim loại &amp; Mặt lưng k&iacute;nh cường lực</p>\r\n	</li>\r\n	<li>K&iacute;ch thước\r\n	<p>D&agrave;i 158.4 mm - Ngang 78.1 mm - D&agrave;y 7.5 mm</p>\r\n	</li>\r\n	<li>Trọng lượng\r\n	<p>202 g</p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin pin &amp; Sạc</li>\r\n	<li>Dung lượng pin\r\n	<p>2691 mAh</p>\r\n	</li>\r\n	<li>Loại pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-pin-li-ion-la-gi-985040\" target=\"_blank\">Pin chuẩn Li-Ion</a></p>\r\n	</li>\r\n	<li>C&ocirc;ng nghệ pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-tiet-kiem-pin-va-sieu-tiet-kiem-pin-la-gi-926730\" target=\"_blank\">Tiết kiệm pin</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-nhanh-tren-smartphone-755549\" target=\"_blank\">Sạc pin nhanh</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-khong-day-la-gi-761328\" target=\"_blank\">Sạc pin kh&ocirc;ng d&acirc;y</a></p>\r\n	</li>\r\n	<li>Tiện &iacute;ch</li>\r\n	<li>Bảo mật n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cam-bien-van-tay-tren-smartphone-la-gi-908163\" target=\"_blank\">Mở kh&oacute;a bằng v&acirc;n tay</a></p>\r\n	</li>\r\n	<li>T&iacute;nh năng đặc biệt\r\n	<p><a href=\"https://www.thegioididong.com/dtdd/11/6/2019\" target=\"_blank\">3D Touch</a></p>\r\n	</li>\r\n	<li>Ghi &acirc;m\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/microphone-chong-on-la-gi-894183\" target=\"_blank\">C&oacute;, microphone chuy&ecirc;n dụng chống ồn</a></p>\r\n	</li>\r\n	<li>Xem phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-pho-bien-hien-nay-740243#h265\" target=\"_blank\">H.265</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#3gp\" target=\"_blank\">3GP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp4\" target=\"_blank\">MP4</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#avi\" target=\"_blank\">AVI</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wmv\" target=\"_blank\">WMV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h263\" target=\"_blank\">H.263</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h264\" target=\"_blank\">H.264(MPEG4-AVC)</a></p>\r\n	</li>\r\n	<li>Nghe nhạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#midi\" target=\"_blank\">Midi</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#lossless\" target=\"_blank\">Lossless</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp3\" target=\"_blank\">MP3</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wav\" target=\"_blank\">WAV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA9</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC+</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC++</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#eaac+\" target=\"_blank\">eAAC+</a></p>\r\n	</li>\r\n</ul>', 8000000, 0, 0, '2020-07-25 16:09:27', '2020-07-25 16:09:27'),
(21, 'Casio Gsock 4', 'casio-gsock-4', 'Japan', 2, 1, 8, '18072020_32bc52a4eea5dabad16b73c746dcc99a.jpg', '18072020_dd16d078a2dc6b6fa21ba29a09fb404b.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 2000000, 0, 0, '2020-07-25 16:09:17', '2020-07-25 16:09:17'),
(22, 'WoMen\'s G-Shock 2', 'womens-g-shock-2', 'China', 2, 1, 8, '18072020_d4b25b4fe06a3036820d4c477b6c888b.jpg', '18072020_c20aedb4dc58dac4c6bef22dcf6c4234.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 2500000, 0, 0, '2020-07-25 16:09:20', '2020-07-25 16:09:20'),
(23, 'Áo Punam', 'ao-puma', 'China', 5, 2, 10, '18072020_d55c948f5eec1e222821ed8838af2664.jpg', '18072020_6f02acb058ee0e333f35c9adb265a479.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;Lưu &yacute;: Nhập m&atilde; FREESHIP khi đặt anh/ chị nh&eacute;. Lấy m&atilde; ở phần th&ocirc;ng b&aacute;o của shopee! Nhấn v&agrave;o &ocirc; nhập m&atilde; sẽ c&oacute; m&atilde; hiện ra.<br />\r\n&Aacute;o thun nam c&oacute; cổ từ l&acirc;u đ&atilde; được ph&aacute;i mạnh ưa chuộng bởi sự năng động pha một ch&uacute;t cổ điển của n&oacute;. Nếu bạn đang c&acirc;n nhắc một chiếc &aacute;o thời trang, thanh lịch v&agrave; chất lượng th&igrave; &Aacute;o thun nam c&oacute; cổ cực đẹp 2019 cao cấp mới n&agrave;y d&agrave;nh cho bạn đ&acirc;y!</p>\r\n\r\n<p>? ĐIỂM NỔI BẬT CỦA &Aacute;O THUN NAM C&Oacute; CỔ MỚI 2019<br />\r\n- Được l&agrave;m từ thun c&aacute; sấu cao cấp, &aacute;o co d&atilde;n, thấm h&uacute;t mồ h&ocirc;i, để bạn vận động một c&aacute;ch thoải m&aacute;i.<br />\r\n- &Aacute;o thun nam c&oacute; cổ mới 2019 được may cẩn thận, chăm ch&uacute;t từng đường chỉ, tinh tế từng &aacute;o một để ra sản phẩm tốt phục vụ kh&aacute;ch h&agrave;ng của Riooshop.<br />\r\n- &Aacute;o thun trơn đơn giản, dễ mặc dễ phối đồ, gi&uacute;p bạn lu&ocirc;n tự tin khi ra đường.<br />\r\n- &Aacute;o c&oacute; đến 5 m&agrave;u sắc kh&aacute;c nhau, lại dễ d&agrave;ng phối hợp với quần jeans, kaki, short,... một sự lựa chọn ho&agrave;n hảo!</p>\r\n\r\n<p>? CHI TIẾT SẢN PHẨM &Aacute;O THUN NAM C&Oacute; CỔ MỚI<br />\r\n? K&iacute;ch cỡ: M [50-58 Kg], L [59 - 65 Kg], XL [66-75 Kg], XXL [76-85 Kg]<br />\r\n? 5 M&agrave;u: Trắng, X&aacute;m đen, Xanh r&ecirc;u, Xanh b&iacute;ch<br />\r\n? Chất liệu: Thun c&aacute; sấu cao cấp, co d&atilde;n 4 chiều.</p>\r\n\r\n<p>? HƯỚNG DẪN ĐẶT H&Agrave;NG<br />\r\nLần lượt th&ecirc;m v&agrave;o giỏ ph&acirc;n loại h&agrave;ng (M&agrave;u, Size) những &aacute;o muốn đặt, sau khi th&ecirc;m xong v&agrave;o giỏ h&agrave;ng nhấn MUA NGAY v&agrave; điền th&ocirc;ng tin thanh to&aacute;n.&lt;/span&gt;&lt;br&gt;</p>', 490000, 0, 0, '2020-07-25 16:09:23', '2020-07-25 16:09:23'),
(24, 'Áo dài', 'ao-dai', 'china', 6, 2, 10, '18072020_44fce461f02df6a652f937aab5b6c6b7.jpg', '18072020_fada64993f2fc80986d3761e8d4a9b73.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;HÀNG Đ&Ocirc;̣C QUY&Ecirc;̀N CHỈ CÓ TẠI QU&Ocirc;́C CƯỜNG SPORT<br />\r\n?. &Aacute;o Nike cổ c&ocirc;ng ngh&ecirc;̣ ép nhi&ecirc;̣t mới nh&acirc;́t kh&ocirc;ng đường may<br />\r\n? Vải thun lạnh cao cấp, logo sắc nét sờ mát tay lu&ocirc;n<br />\r\n? Form cho người Việt Nam th&acirc;n thiện ??<br />\r\n? Size S M L XL (45-80kg)<br />\r\n? Chấm . một c&aacute;i để em b&aacute;o gi&aacute; giật m&igrave;nh nha<br />\r\n#&aacute;onam<br />\r\n#thunlanhj<br />\r\n#cổ đức</p>\r\n\r\n<p>??QUỐC CƯỜNG SPORT??<br />\r\n??? Link mua h&agrave;ng freeship: shopee.vn/htpt145<br />\r\n? SN 132, Khu Đo&agrave;i, Dục Nội, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội<br />\r\n? 09666 21 866 - 0377 039 095<br />\r\n? Ship COD to&agrave;n quốc&lt;/span&gt;&lt;br&gt;</p>', 550000, 0, 0, '2020-07-25 16:09:25', '2020-07-25 16:09:25'),
(25, 'iphone XR', 'iphone-xr', 'China', 3, 3, 9, '18072020_071a6a42e9d795962f6a4c504db2d81b.jpg', NULL, NULL, NULL, 'Hàng nội địa trung quốc', '<h3>Th&ocirc;ng số kỹ thuật chi tiết iPhone 8 Plus 64GB</h3>\r\n\r\n<p><img alt=\"Thông số kỹ thuật 114110\" src=\"https://cdn.tgdd.vn/Products/Images/42/114110/Kit/iphone-8-plus-mo-ta-chuc-nang.jpg\" style=\"height:430px; width:500px\" /></p>\r\n\r\n<ul>\r\n	<li>﻿</li>\r\n	<li>M&agrave;n h&igrave;nh</li>\r\n	<li>C&ocirc;ng nghệ m&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-ledbacklit-ips-lcd-la-gi-905757\" target=\"_blank\">LED-backlit IPS LCD</a></p>\r\n	</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#fullhd\" target=\"_blank\">Full HD (1080 x 1920 Pixels)</a></p>\r\n	</li>\r\n	<li>M&agrave;n h&igrave;nh rộng\r\n	<p>5.5&quot;</p>\r\n	</li>\r\n	<li>Mặt k&iacute;nh cảm ứng\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/kinh-oleophobic-ion-cuong-luc-tren-cac-dong-appl-1167791\" target=\"_blank\">K&iacute;nh cường lực oleophobic (ion cường lực)</a></p>\r\n	</li>\r\n	<li>Camera sau</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>Ch&iacute;nh 12 MP &amp; Phụ 12 MP</p>\r\n	</li>\r\n	<li>Quay phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-bi-1174134#4k\" target=\"_blank\">Quay phim 4K 2160p@60fps</a></p>\r\n	</li>\r\n	<li>Đ&egrave;n Flash\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-cac-loai-den-flash-tren-camera-dien-thoai-1143808#flash4bongled\" target=\"_blank\">4 đ&egrave;n LED (2 t&ocirc;ng m&agrave;u)</a></p>\r\n	</li>\r\n	<li>Chụp ảnh n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-xoa-phong-la-gi-no-co-tac-dung-nhu-the-na-1138006\" target=\"_blank\">Xo&aacute; ph&ocirc;ng</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-che-do-lay-net-du-doan-tren-smartphone-1172238\" target=\"_blank\">Lấy n&eacute;t dự đo&aacute;n</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-autofocus-trong-chup-anh-tren-smartphone-906408\" target=\"_blank\">Tự động lấy n&eacute;t (AF)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-touch-focus-khi-chup-anh-tren-smartphone-906412\" target=\"_blank\">Chạm lấy n&eacute;t</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-panorama-toan-canh-tren-camera-cua-smar-906425\" target=\"_blank\">To&agrave;n cảnh (Panorama)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chong-rung-quang-hoc-ois-chup-anh-tren-sm-906416\" target=\"_blank\">Chống rung quang học (OIS)</a></p>\r\n	</li>\r\n	<li>Camera trước</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>7 MP</p>\r\n	</li>\r\n	<li>Videocall\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/goi-video-call-la-gi-neu-may-khong-trang-bi-san-1174141\" target=\"_blank\">C&oacute;</a></p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-1174134#fullhd\" target=\"_blank\">Quay video Full HD</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a></p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh - CPU</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tat-ca-nhung-tinh-nang-moi-duoc-cap-nhat-tren-ios-1171206\" target=\"_blank\">iOS 13</a></p>\r\n	</li>\r\n	<li>Chipset (h&atilde;ng SX CPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple A11 Bionic 6 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Tốc độ CPU\r\n	<p>2.39 GHz</p>\r\n	</li>\r\n	<li>Chip đồ họa (GPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple GPU 3 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Bộ nhớ &amp; Lưu trữ</li>\r\n	<li>RAM\r\n	<p>3 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>64 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ c&ograve;n lại (khả dụng)\r\n	<p>Khoảng 55 GB</p>\r\n	</li>\r\n	<li>Kết nối</li>\r\n	<li>Mạng di động\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/mang-4g-la-gi-4g-la-gi-4gva-4g-lte-giong-hay-khac-nhau-900599\" target=\"_blank\">3G, 4G LTE Cat 16</a></p>\r\n	</li>\r\n	<li>SIM\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-loai-sim-thong-dung-sim-thuong-micro--590216#nanosim\" target=\"_blank\">1 Nano SIM</a></p>\r\n	</li>\r\n	<li>Wifi\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#80211ac\" target=\"_blank\">Wi-Fi 802.11 a/b/g/n/ac</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/wifi-dual-band-la-gi-736489\" target=\"_blank\">Dual-band</a>,&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#wifihotspot\" target=\"_blank\">Wi-Fi hotspot</a></p>\r\n	</li>\r\n	<li>GPS\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#a-gps\" target=\"_blank\">A-GPS</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#glonass\" target=\"_blank\">GLONASS</a></p>\r\n	</li>\r\n	<li>Bluetooth\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-a2dp-la-gi-723725\" target=\"_blank\">A2DP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#le\" target=\"_blank\">LE</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#edr\" target=\"_blank\">EDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/bluetooth-50-chuan-bluetooth-danh-cho-thoi-dai-1113891\" target=\"_blank\">v5.0</a></p>\r\n	</li>\r\n	<li>C&ocirc;̉ng k&ecirc;́t n&ocirc;́i/sạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Jack tai nghe\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Kết nối kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-nfc-tren-dien-thoai-may-tinh-bang-la-gi-1172835\" target=\"_blank\">NFC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-otg-la-gi-otg-duoc-su-dung-cho-muc-dich-gi-1172882\" target=\"_blank\">OTG</a></p>\r\n	</li>\r\n	<li>Thiết kế &amp; Trọng lượng</li>\r\n	<li>Thiết kế\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-kieu-thiet-ke-tren-di-dong-va-may-tin-597153#nguyenkhoi\" target=\"_blank\">Nguy&ecirc;n khối</a></p>\r\n	</li>\r\n	<li>Chất liệu\r\n	<p>Khung kim loại &amp; Mặt lưng k&iacute;nh cường lực</p>\r\n	</li>\r\n	<li>K&iacute;ch thước\r\n	<p>D&agrave;i 158.4 mm - Ngang 78.1 mm - D&agrave;y 7.5 mm</p>\r\n	</li>\r\n	<li>Trọng lượng\r\n	<p>202 g</p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin pin &amp; Sạc</li>\r\n	<li>Dung lượng pin\r\n	<p>2691 mAh</p>\r\n	</li>\r\n	<li>Loại pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-pin-li-ion-la-gi-985040\" target=\"_blank\">Pin chuẩn Li-Ion</a></p>\r\n	</li>\r\n	<li>C&ocirc;ng nghệ pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-tiet-kiem-pin-va-sieu-tiet-kiem-pin-la-gi-926730\" target=\"_blank\">Tiết kiệm pin</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-nhanh-tren-smartphone-755549\" target=\"_blank\">Sạc pin nhanh</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-khong-day-la-gi-761328\" target=\"_blank\">Sạc pin kh&ocirc;ng d&acirc;y</a></p>\r\n	</li>\r\n	<li>Tiện &iacute;ch</li>\r\n	<li>Bảo mật n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cam-bien-van-tay-tren-smartphone-la-gi-908163\" target=\"_blank\">Mở kh&oacute;a bằng v&acirc;n tay</a></p>\r\n	</li>\r\n	<li>T&iacute;nh năng đặc biệt\r\n	<p><a href=\"https://www.thegioididong.com/dtdd/11/6/2019\" target=\"_blank\">3D Touch</a></p>\r\n	</li>\r\n	<li>Ghi &acirc;m\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/microphone-chong-on-la-gi-894183\" target=\"_blank\">C&oacute;, microphone chuy&ecirc;n dụng chống ồn</a></p>\r\n	</li>\r\n	<li>Xem phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-pho-bien-hien-nay-740243#h265\" target=\"_blank\">H.265</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#3gp\" target=\"_blank\">3GP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp4\" target=\"_blank\">MP4</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#avi\" target=\"_blank\">AVI</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wmv\" target=\"_blank\">WMV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h263\" target=\"_blank\">H.263</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h264\" target=\"_blank\">H.264(MPEG4-AVC)</a></p>\r\n	</li>\r\n	<li>Nghe nhạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#midi\" target=\"_blank\">Midi</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#lossless\" target=\"_blank\">Lossless</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp3\" target=\"_blank\">MP3</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wav\" target=\"_blank\">WAV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA9</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC+</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC++</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#eaac+\" target=\"_blank\">eAAC+</a></p>\r\n	</li>\r\n</ul>', 8800000, 0, 0, '2020-07-25 16:09:27', '2020-07-25 16:09:27'),
(26, 'Casio Gsock Nữ', 'casio-gsock-nữ', 'Japan', 6, 1, 8, '18072020_32bc52a4eea5dabad16b73c746dcc99a.jpg', '18072020_dd16d078a2dc6b6fa21ba29a09fb404b.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 3200000, 0, 0, '2020-07-25 16:09:17', '2020-07-25 16:09:17');
INSERT INTO `products` (`id_product`, `name_product`, `slug`, `madeby`, `sub_category_id`, `brand_id`, `shop_id`, `img_product`, `img1_product`, `img2_product`, `img3_product`, `note_product`, `description_product`, `price_product`, `status_product`, `is_deleted`, `updated_at`, `created_at`) VALUES
(27, 'Resistance Watch G100-1BV', 'Magnetic resistance Watch G100-1BV', 'China', 2, 1, 8, '18072020_d4b25b4fe06a3036820d4c477b6c888b.jpg', '18072020_c20aedb4dc58dac4c6bef22dcf6c4234.jpg', NULL, NULL, NULL, '<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" summary=\"Product Details\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Thương Hiệu</td>\r\n			<td>Casio</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Xuất Xứ</td>\r\n			<td>Nhật</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&atilde; Sản Phẩm</td>\r\n			<td>MTP-V004D-1B2UDF</td>\r\n		</tr>\r\n		<tr>\r\n			<td>D&ograve;ng Sản Phẩm</td>\r\n			<td>Standard</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kiểu D&aacute;ng</td>\r\n			<td>Nam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&aacute;y</td>\r\n			<td>Quartz (D&ugrave;ng pin)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu D&acirc;y</td>\r\n			<td>Th&eacute;p kh&ocirc;ng gỉ</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chất Liệu Vỏ</td>\r\n			<td>Kim loại mạ ion</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Đường K&iacute;nh Mặt</td>\r\n			<td>41.5*47 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Độ D&agrave;y</td>\r\n			<td>8.3 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>M&agrave;u Mặt Số</td>\r\n			<td>Đen</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mặt K&iacute;nh</td>\r\n			<td>K&iacute;nh kho&aacute;ng (Mineral glass)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chống Nước</td>\r\n			<td>30m</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Chức Năng</td>\r\n			<td>Giờ hiện h&agrave;nh th&ocirc;ng thường<br />\r\n			Đồng hồ kim: 3 kim (giờ, ph&uacute;t, gi&acirc;y c&ugrave;ng lịch ng&agrave;y)<br />\r\n			Độ ch&iacute;nh x&aacute;c: &plusmn;20 gi&acirc;y một th&aacute;ng<br />\r\n			Tuổi thọ pin xấp xỉ: 3 năm với pin SR626SW</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Bảo H&agrave;nh Ch&iacute;nh H&atilde;ng&nbsp;</td>\r\n			<td>1 Năm</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><img alt=\"waterresist\" src=\"https://dongho24h.com/templates/dongho24h/images/waterresist.png\" /></p>', 380000, 0, 0, '2020-07-25 16:09:20', '2020-07-25 16:09:20'),
(28, 'Áo cá sấu', 'ao-ca-sau', 'China', 5, 2, 10, '18072020_d55c948f5eec1e222821ed8838af2664.jpg', '18072020_6f02acb058ee0e333f35c9adb265a479.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;Lưu &yacute;: Nhập m&atilde; FREESHIP khi đặt anh/ chị nh&eacute;. Lấy m&atilde; ở phần th&ocirc;ng b&aacute;o của shopee! Nhấn v&agrave;o &ocirc; nhập m&atilde; sẽ c&oacute; m&atilde; hiện ra.<br />\r\n&Aacute;o thun nam c&oacute; cổ từ l&acirc;u đ&atilde; được ph&aacute;i mạnh ưa chuộng bởi sự năng động pha một ch&uacute;t cổ điển của n&oacute;. Nếu bạn đang c&acirc;n nhắc một chiếc &aacute;o thời trang, thanh lịch v&agrave; chất lượng th&igrave; &Aacute;o thun nam c&oacute; cổ cực đẹp 2019 cao cấp mới n&agrave;y d&agrave;nh cho bạn đ&acirc;y!</p>\r\n\r\n<p>? ĐIỂM NỔI BẬT CỦA &Aacute;O THUN NAM C&Oacute; CỔ MỚI 2019<br />\r\n- Được l&agrave;m từ thun c&aacute; sấu cao cấp, &aacute;o co d&atilde;n, thấm h&uacute;t mồ h&ocirc;i, để bạn vận động một c&aacute;ch thoải m&aacute;i.<br />\r\n- &Aacute;o thun nam c&oacute; cổ mới 2019 được may cẩn thận, chăm ch&uacute;t từng đường chỉ, tinh tế từng &aacute;o một để ra sản phẩm tốt phục vụ kh&aacute;ch h&agrave;ng của Riooshop.<br />\r\n- &Aacute;o thun trơn đơn giản, dễ mặc dễ phối đồ, gi&uacute;p bạn lu&ocirc;n tự tin khi ra đường.<br />\r\n- &Aacute;o c&oacute; đến 5 m&agrave;u sắc kh&aacute;c nhau, lại dễ d&agrave;ng phối hợp với quần jeans, kaki, short,... một sự lựa chọn ho&agrave;n hảo!</p>\r\n\r\n<p>? CHI TIẾT SẢN PHẨM &Aacute;O THUN NAM C&Oacute; CỔ MỚI<br />\r\n? K&iacute;ch cỡ: M [50-58 Kg], L [59 - 65 Kg], XL [66-75 Kg], XXL [76-85 Kg]<br />\r\n? 5 M&agrave;u: Trắng, X&aacute;m đen, Xanh r&ecirc;u, Xanh b&iacute;ch<br />\r\n? Chất liệu: Thun c&aacute; sấu cao cấp, co d&atilde;n 4 chiều.</p>\r\n\r\n<p>? HƯỚNG DẪN ĐẶT H&Agrave;NG<br />\r\nLần lượt th&ecirc;m v&agrave;o giỏ ph&acirc;n loại h&agrave;ng (M&agrave;u, Size) những &aacute;o muốn đặt, sau khi th&ecirc;m xong v&agrave;o giỏ h&agrave;ng nhấn MUA NGAY v&agrave; điền th&ocirc;ng tin thanh to&aacute;n.&lt;/span&gt;&lt;br&gt;</p>', 160000, 0, 0, '2020-07-25 16:09:23', '2020-07-25 16:09:23'),
(29, 'Áo khỉ', 'ao-khi', 'china', 6, 2, 10, '18072020_44fce461f02df6a652f937aab5b6c6b7.jpg', '18072020_fada64993f2fc80986d3761e8d4a9b73.jpg', NULL, NULL, NULL, '<p>&lt;span&gt;HÀNG Đ&Ocirc;̣C QUY&Ecirc;̀N CHỈ CÓ TẠI QU&Ocirc;́C CƯỜNG SPORT<br />\r\n?. &Aacute;o Nike cổ c&ocirc;ng ngh&ecirc;̣ ép nhi&ecirc;̣t mới nh&acirc;́t kh&ocirc;ng đường may<br />\r\n? Vải thun lạnh cao cấp, logo sắc nét sờ mát tay lu&ocirc;n<br />\r\n? Form cho người Việt Nam th&acirc;n thiện ??<br />\r\n? Size S M L XL (45-80kg)<br />\r\n? Chấm . một c&aacute;i để em b&aacute;o gi&aacute; giật m&igrave;nh nha<br />\r\n#&aacute;onam<br />\r\n#thunlanhj<br />\r\n#cổ đức</p>\r\n\r\n<p>??QUỐC CƯỜNG SPORT??<br />\r\n??? Link mua h&agrave;ng freeship: shopee.vn/htpt145<br />\r\n? SN 132, Khu Đo&agrave;i, Dục Nội, Việt H&ugrave;ng, Đ&ocirc;ng Anh, H&agrave; Nội<br />\r\n? 09666 21 866 - 0377 039 095<br />\r\n? Ship COD to&agrave;n quốc&lt;/span&gt;&lt;br&gt;</p>', 120000, 0, 0, '2020-07-25 16:09:25', '2020-07-25 16:09:25'),
(30, 'iphone 7 ', 'iphone-7', 'China', 3, 3, 9, '18072020_071a6a42e9d795962f6a4c504db2d81b.jpg', NULL, NULL, NULL, 'Hàng nội địa trung quốc', '<h3>Th&ocirc;ng số kỹ thuật chi tiết iPhone 8 Plus 64GB</h3>\r\n\r\n<p><img alt=\"Thông số kỹ thuật 114110\" src=\"https://cdn.tgdd.vn/Products/Images/42/114110/Kit/iphone-8-plus-mo-ta-chuc-nang.jpg\" style=\"height:430px; width:500px\" /></p>\r\n\r\n<ul>\r\n	<li>﻿</li>\r\n	<li>M&agrave;n h&igrave;nh</li>\r\n	<li>C&ocirc;ng nghệ m&agrave;n h&igrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/man-hinh-ledbacklit-ips-lcd-la-gi-905757\" target=\"_blank\">LED-backlit IPS LCD</a></p>\r\n	</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/do-phan-giai-man-hinh-qhd-hd-fullhd-2k-4k-la-gi--592178#fullhd\" target=\"_blank\">Full HD (1080 x 1920 Pixels)</a></p>\r\n	</li>\r\n	<li>M&agrave;n h&igrave;nh rộng\r\n	<p>5.5&quot;</p>\r\n	</li>\r\n	<li>Mặt k&iacute;nh cảm ứng\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/kinh-oleophobic-ion-cuong-luc-tren-cac-dong-appl-1167791\" target=\"_blank\">K&iacute;nh cường lực oleophobic (ion cường lực)</a></p>\r\n	</li>\r\n	<li>Camera sau</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>Ch&iacute;nh 12 MP &amp; Phụ 12 MP</p>\r\n	</li>\r\n	<li>Quay phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-bi-1174134#4k\" target=\"_blank\">Quay phim 4K 2160p@60fps</a></p>\r\n	</li>\r\n	<li>Đ&egrave;n Flash\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-cac-loai-den-flash-tren-camera-dien-thoai-1143808#flash4bongled\" target=\"_blank\">4 đ&egrave;n LED (2 t&ocirc;ng m&agrave;u)</a></p>\r\n	</li>\r\n	<li>Chụp ảnh n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-xoa-phong-la-gi-no-co-tac-dung-nhu-the-na-1138006\" target=\"_blank\">Xo&aacute; ph&ocirc;ng</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-che-do-lay-net-du-doan-tren-smartphone-1172238\" target=\"_blank\">Lấy n&eacute;t dự đo&aacute;n</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-autofocus-trong-chup-anh-tren-smartphone-906408\" target=\"_blank\">Tự động lấy n&eacute;t (AF)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-touch-focus-khi-chup-anh-tren-smartphone-906412\" target=\"_blank\">Chạm lấy n&eacute;t</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chup-anh-panorama-toan-canh-tren-camera-cua-smar-906425\" target=\"_blank\">To&agrave;n cảnh (Panorama)</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/che-do-chong-rung-quang-hoc-ois-chup-anh-tren-sm-906416\" target=\"_blank\">Chống rung quang học (OIS)</a></p>\r\n	</li>\r\n	<li>Camera trước</li>\r\n	<li>Độ ph&acirc;n giải\r\n	<p>7 MP</p>\r\n	</li>\r\n	<li>Videocall\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/goi-video-call-la-gi-neu-may-khong-trang-bi-san-1174141\" target=\"_blank\">C&oacute;</a></p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-chup-anh-hdr-tren-smartphone-la-gi-906400\" target=\"_blank\">HDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-chuan-quay-phim-tren-dien-thoai-tablet-pho-1174134#fullhd\" target=\"_blank\">Quay video Full HD</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/chuc-nang-nhan-dien-khuon-mat-la-gi-907903\" target=\"_blank\">Nhận diện khu&ocirc;n mặt</a></p>\r\n	</li>\r\n	<li>Hệ điều h&agrave;nh - CPU</li>\r\n	<li>Hệ điều h&agrave;nh\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tat-ca-nhung-tinh-nang-moi-duoc-cap-nhat-tren-ios-1171206\" target=\"_blank\">iOS 13</a></p>\r\n	</li>\r\n	<li>Chipset (h&atilde;ng SX CPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple A11 Bionic 6 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Tốc độ CPU\r\n	<p>2.39 GHz</p>\r\n	</li>\r\n	<li>Chip đồ họa (GPU)\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/chip-apple-a11-bionic-la-gi-1170872\" target=\"_blank\">Apple GPU 3 nh&acirc;n</a></p>\r\n	</li>\r\n	<li>Bộ nhớ &amp; Lưu trữ</li>\r\n	<li>RAM\r\n	<p>3 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ trong\r\n	<p>64 GB</p>\r\n	</li>\r\n	<li>Bộ nhớ c&ograve;n lại (khả dụng)\r\n	<p>Khoảng 55 GB</p>\r\n	</li>\r\n	<li>Kết nối</li>\r\n	<li>Mạng di động\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/mang-4g-la-gi-4g-la-gi-4gva-4g-lte-giong-hay-khac-nhau-900599\" target=\"_blank\">3G, 4G LTE Cat 16</a></p>\r\n	</li>\r\n	<li>SIM\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-loai-sim-thong-dung-sim-thuong-micro--590216#nanosim\" target=\"_blank\">1 Nano SIM</a></p>\r\n	</li>\r\n	<li>Wifi\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#80211ac\" target=\"_blank\">Wi-Fi 802.11 a/b/g/n/ac</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/wifi-dual-band-la-gi-736489\" target=\"_blank\">Dual-band</a>,&nbsp;<a href=\"https://www.thegioididong.com/tin-tuc/wifi-la-gi-cai-dat-wifi-hotspot-nhu-the-nao--590309#wifihotspot\" target=\"_blank\">Wi-Fi hotspot</a></p>\r\n	</li>\r\n	<li>GPS\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#a-gps\" target=\"_blank\">A-GPS</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/gps-la-gi-806129#glonass\" target=\"_blank\">GLONASS</a></p>\r\n	</li>\r\n	<li>Bluetooth\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-a2dp-la-gi-723725\" target=\"_blank\">A2DP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#le\" target=\"_blank\">LE</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-bluetooth-743602#edr\" target=\"_blank\">EDR</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/bluetooth-50-chuan-bluetooth-danh-cho-thoi-dai-1113891\" target=\"_blank\">v5.0</a></p>\r\n	</li>\r\n	<li>C&ocirc;̉ng k&ecirc;́t n&ocirc;́i/sạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Jack tai nghe\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cong-lightning-la-gi-868282\" target=\"_blank\">Lightning</a></p>\r\n	</li>\r\n	<li>Kết nối kh&aacute;c\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-nfc-tren-dien-thoai-may-tinh-bang-la-gi-1172835\" target=\"_blank\">NFC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/ket-noi-otg-la-gi-otg-duoc-su-dung-cho-muc-dich-gi-1172882\" target=\"_blank\">OTG</a></p>\r\n	</li>\r\n	<li>Thiết kế &amp; Trọng lượng</li>\r\n	<li>Thiết kế\r\n	<p><a href=\"https://www.thegioididong.com/tin-tuc/tim-hieu-cac-kieu-thiet-ke-tren-di-dong-va-may-tin-597153#nguyenkhoi\" target=\"_blank\">Nguy&ecirc;n khối</a></p>\r\n	</li>\r\n	<li>Chất liệu\r\n	<p>Khung kim loại &amp; Mặt lưng k&iacute;nh cường lực</p>\r\n	</li>\r\n	<li>K&iacute;ch thước\r\n	<p>D&agrave;i 158.4 mm - Ngang 78.1 mm - D&agrave;y 7.5 mm</p>\r\n	</li>\r\n	<li>Trọng lượng\r\n	<p>202 g</p>\r\n	</li>\r\n	<li>Th&ocirc;ng tin pin &amp; Sạc</li>\r\n	<li>Dung lượng pin\r\n	<p>2691 mAh</p>\r\n	</li>\r\n	<li>Loại pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/tim-hieu-pin-li-ion-la-gi-985040\" target=\"_blank\">Pin chuẩn Li-Ion</a></p>\r\n	</li>\r\n	<li>C&ocirc;ng nghệ pin\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/che-do-tiet-kiem-pin-va-sieu-tiet-kiem-pin-la-gi-926730\" target=\"_blank\">Tiết kiệm pin</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-nhanh-tren-smartphone-755549\" target=\"_blank\">Sạc pin nhanh</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cong-nghe-sac-khong-day-la-gi-761328\" target=\"_blank\">Sạc pin kh&ocirc;ng d&acirc;y</a></p>\r\n	</li>\r\n	<li>Tiện &iacute;ch</li>\r\n	<li>Bảo mật n&acirc;ng cao\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cam-bien-van-tay-tren-smartphone-la-gi-908163\" target=\"_blank\">Mở kh&oacute;a bằng v&acirc;n tay</a></p>\r\n	</li>\r\n	<li>T&iacute;nh năng đặc biệt\r\n	<p><a href=\"https://www.thegioididong.com/dtdd/11/6/2019\" target=\"_blank\">3D Touch</a></p>\r\n	</li>\r\n	<li>Ghi &acirc;m\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/microphone-chong-on-la-gi-894183\" target=\"_blank\">C&oacute;, microphone chuy&ecirc;n dụng chống ồn</a></p>\r\n	</li>\r\n	<li>Xem phim\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-pho-bien-hien-nay-740243#h265\" target=\"_blank\">H.265</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#3gp\" target=\"_blank\">3GP</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp4\" target=\"_blank\">MP4</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#avi\" target=\"_blank\">AVI</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wmv\" target=\"_blank\">WMV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h263\" target=\"_blank\">H.263</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#h264\" target=\"_blank\">H.264(MPEG4-AVC)</a></p>\r\n	</li>\r\n	<li>Nghe nhạc\r\n	<p><a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#midi\" target=\"_blank\">Midi</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#lossless\" target=\"_blank\">Lossless</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#mp3\" target=\"_blank\">MP3</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wav\" target=\"_blank\">WAV</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#wma\" target=\"_blank\">WMA9</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC+</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#aac\" target=\"_blank\">AAC++</a>,&nbsp;<a href=\"https://www.thegioididong.com/hoi-dap/cac-dinh-dang-video-va-am-thanh-740243#eaac+\" target=\"_blank\">eAAC+</a></p>\r\n	</li>\r\n</ul>', 3100000, 0, 0, '2020-07-25 16:09:27', '2020-07-25 16:09:27');

-- --------------------------------------------------------

--
-- Stand-in structure for view `products_category`
-- (See below for the actual view)
--
CREATE TABLE `products_category` (
`id_product` int(11)
,`name_product` varchar(100)
,`slug` varchar(100)
,`madeby` varchar(50)
,`sub_category_id` int(11)
,`brand_id` int(11)
,`shop_id` int(11)
,`img_product` varchar(50)
,`img1_product` varchar(50)
,`img2_product` varchar(50)
,`img3_product` varchar(50)
,`note_product` varchar(50)
,`description_product` longtext
,`price_product` int(11)
,`status_product` tinyint(4)
,`is_deleted` tinyint(4)
,`updated_at` timestamp
,`created_at` timestamp
,`name_shop` varchar(50)
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
  `name_recipient` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_recipient` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_default` tinyint(4) NOT NULL DEFAULT 0,
  `address_customer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipping_address`
--

INSERT INTO `shipping_address` (`id_address`, `customer_id`, `name_recipient`, `phone_recipient`, `status_default`, `address_customer`) VALUES
(3, 10, 'Nam Nguyễn', '0907016564', 0, '385/35 Quang Trung, Phường 10, Quận Gò Vấp, HCM'),
(4, 10, 'Nam Nguyễn', '0907016564', 0, '385/35 Quang Trung, Phường 10, Quận Gò Vấp, HCM'),
(5, 10, 'Nguyễn Hoàng Nam', '0907016564', 0, '385/35 Quang Trung, Phường 10, Quận Gò Vấp, HCM'),
(7, 2, 'Nguyễn Hoàng Nam', '0907016564', 1, '385/35 Quang Trung, Phường 10, Gò Vấp, Hồ Chí Minh'),
(8, 10, NULL, NULL, 1, '180 Cao Lỗ, Quận 8, Hồ Chí Minh'),
(9, 10, NULL, NULL, 0, '385/35 Quang Trung, Phường 10, Quận Gò Vấp, HCM');

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
  `status_shop` int(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id_shop`, `email_shop`, `password_shop`, `name_shop`, `phone_shop`, `customer_id`, `img_shop`, `address_shop`, `status_shop`, `created_at`, `updated_at`) VALUES
(8, 'le.trong.an256@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lê Trọng Ân', '1234567890', 11, '08072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '180 Cao Lỗ, phường 14, Quận 8, TPHCM', 1, '2020-07-08 04:41:50', '2020-07-08 04:41:50'),
(9, 'nguyenhoangnam092@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Shop Shop', '0907016564', 2, '08072020_4289c22172f76e44ccda0ea79ea89d79.jpg', '385/35, Quang Trung, P10, Q.GV', 1, '2020-07-08 07:03:02', '2020-07-08 07:03:02'),
(10, '123456789@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Shop đồng hồ', '1234567890', 2, '17072020_539ff2b2cd4ad0f109010ab0c5d57ca2.jpg', 'Quận 8, TPHCM', 1, '2020-07-17 15:20:15', '2020-07-17 15:20:15');

-- --------------------------------------------------------

--
-- Stand-in structure for view `shop_customer`
-- (See below for the actual view)
--
CREATE TABLE `shop_customer` (
`id_product` int(11)
,`created_at` timestamp
,`name_shop` varchar(50)
,`email_shop` varchar(50)
,`address_shop` varchar(255)
,`customer_id` int(11)
,`name_product` varchar(100)
,`madeby` varchar(50)
,`price_product` int(11)
,`status_product` tinyint(4)
,`brand_id` int(11)
,`name_brand` varchar(50)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `shop_oder_product`
-- (See below for the actual view)
--
CREATE TABLE `shop_oder_product` (
`created_at` timestamp
,`name_shop` varchar(50)
,`orders_id` int(11)
,`id_order_detail` int(11)
,`product_id` int(11)
,`id_shop` int(11)
,`price_product` int(11)
,`quantity` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id_sub` int(11) NOT NULL,
  `name_sub` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id_sub`, `name_sub`, `slug`, `category_id`) VALUES
(1, 'Đồng hồ nam', NULL, 1),
(2, 'Đồng hồ nữ', NULL, 1),
(3, 'Điện thoại', NULL, 2),
(4, 'Ốp lưng', NULL, 2),
(5, 'Áo thun nam', NULL, 5),
(6, 'Áo thun nữ', NULL, 6),
(7, 'Áo có cổ nam', NULL, 5),
(8, 'Jean nữ', NULL, 6);

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
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `username_user`, `password_user`, `name_user`, `email_user`, `phone_user`, `role_id`, `updated_at`, `created_at`) VALUES
(1, 'admin', 'd93a5def7511da3d0f2d171d9c344e91', '', 'admin@gmail.com', '09070116564', 1, '2020-07-12 17:34:08', '2020-07-12 17:34:08'),
(2, 'namnguyen', 'd93a5def7511da3d0f2d171d9c344e91', 'Nguyễn Hoàng Nam', 'nguyenhoangnam092@gmail.com', '0907016564', 3, '2020-07-25 16:01:10', '2020-07-25 16:01:10');

-- --------------------------------------------------------

--
-- Structure for view `products_category`
--
DROP TABLE IF EXISTS `products_category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_category`  AS  select `p`.`id_product` AS `id_product`,`p`.`name_product` AS `name_product`,`p`.`slug` AS `slug`,`p`.`madeby` AS `madeby`,`p`.`sub_category_id` AS `sub_category_id`,`p`.`brand_id` AS `brand_id`,`p`.`shop_id` AS `shop_id`,`p`.`img_product` AS `img_product`,`p`.`img1_product` AS `img1_product`,`p`.`img2_product` AS `img2_product`,`p`.`img3_product` AS `img3_product`,`p`.`note_product` AS `note_product`,`p`.`description_product` AS `description_product`,`p`.`price_product` AS `price_product`,`p`.`status_product` AS `status_product`,`p`.`is_deleted` AS `is_deleted`,`p`.`updated_at` AS `updated_at`,`p`.`created_at` AS `created_at`,`s`.`name_shop` AS `name_shop`,`sub`.`name_sub` AS `name_sub`,`b`.`name_brand` AS `name_brand`,`c`.`name_category` AS `name_category`,`c`.`id_category` AS `category_id` from ((((`products` `p` join `shop` `s` on(`p`.`shop_id` = `s`.`id_shop`)) join `sub_category` `sub` on(`sub`.`id_sub` = `p`.`sub_category_id`)) join `category` `c` on(`c`.`id_category` = `sub`.`category_id`)) join `brands` `b` on(`b`.`id_brand` = `p`.`brand_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `shop_customer`
--
DROP TABLE IF EXISTS `shop_customer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `shop_customer`  AS  select `p`.`id_product` AS `id_product`,`p`.`created_at` AS `created_at`,`s`.`name_shop` AS `name_shop`,`s`.`email_shop` AS `email_shop`,`s`.`address_shop` AS `address_shop`,`s`.`customer_id` AS `customer_id`,`p`.`name_product` AS `name_product`,`p`.`madeby` AS `madeby`,`p`.`price_product` AS `price_product`,`p`.`status_product` AS `status_product`,`p`.`brand_id` AS `brand_id`,`b`.`name_brand` AS `name_brand` from ((`products` `p` join `shop` `s` on(`p`.`shop_id` = `s`.`id_shop`)) join `brands` `b` on(`b`.`id_brand` = `p`.`brand_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `shop_oder_product`
--
DROP TABLE IF EXISTS `shop_oder_product`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `shop_oder_product`  AS  select `oder`.`created_at` AS `created_at`,`s`.`name_shop` AS `name_shop`,`o`.`orders_id` AS `orders_id`,`o`.`id_order_detail` AS `id_order_detail`,`o`.`product_id` AS `product_id`,`s`.`id_shop` AS `id_shop`,`p`.`price_product` AS `price_product`,`o`.`quantity` AS `quantity` from (((`order_detail` `o` join `orders` `oder` on(`o`.`orders_id` = `oder`.`id_orders`)) join `products` `p` on(`o`.`product_id` = `p`.`id_product`)) join `shop` `s` on(`s`.`id_shop` = `p`.`shop_id`)) ;

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
  ADD PRIMARY KEY (`id_category`),
  ADD UNIQUE KEY `slug` (`slug_category`);

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
  ADD KEY `users_id` (`shop_id`);

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
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id_orders` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id_payment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `id_shop` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id_sub`),
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id_shop`);

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

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2020 at 04:52 AM
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
(2, 'Nike', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img_category` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `banner_category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`, `img_category`, `banner_category`) VALUES
(1, 'Đồng hồ & Đồ trang sức', 'dongho.png', NULL),
(2, 'Điện thoại & Phụ kiện', 'dienthoai&phukien.png', NULL),
(3, 'Máy tính & Laptop', 'maytinh&laptop.png', NULL),
(4, 'Thể thao & Du lịch', 'thethao&dulich.png', NULL);

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
(11, 'le.trong.an256@gmail.com', '', 'Trong An Le', '123456789', 'https://lh3.googleusercontent.com/a-/AOh14Gjo7gGn1_sz5vTQYjA6pixVrZ_2vCBE1gfX4nDGjw', '101141285191228131954', 0, NULL, '2020-07-03 05:21:48', '2020-07-03 12:21:48');

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
  `name_product` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
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
(9, 'Casio Gsock', 'china', 1, 1, 11, '03072020_2cd4fa5b9e09451723a92216c856fc5e.jpg', '03072020_864e4925e96a1e96ae2d6f7ccdc725b5.jpg', '03072020_68735183c36654058705c509185ce2ae.jpg', NULL, 'Hàng nội địa trung quốc', '<p><img alt=\"\" src=\"http://127.0.0.1:8080/luanvan7x/public/uploads/1-30.jpg\" style=\"height:64px; width:100px\" /></p>\r\n\r\n<p>Th&ocirc;ng số kĩ thuật</p>\r\n\r\n<ul>\r\n	<li>Mặt k&iacute;nh</li>\r\n	<li>M&aacute;y</li>\r\n	<li>Pin</li>\r\n</ul>\r\n<coccocgrammar></coccocgrammar>', 12345678, 1, 0, '2020-07-04 01:55:09', '2020-07-04 01:55:09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `products_category`
-- (See below for the actual view)
--
CREATE TABLE `products_category` (
`id_product` int(11)
,`name_product` varchar(50)
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
(2, 'Kiểm duyệt', 'Phê duyệt bài viết'),
(3, 'Khách hàng', 'Khách hàng đăng ký bán hàng trên hệ thống của mình');

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
(1, 11, 'Quận 8, TPHCM', 'Quận 7, TPHCM');

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
(4, 'Ốp lưng', 2);

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
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '', 'admin@gmail.com', '09070116564', 1, '2020-06-30 17:17:27', '2020-06-30 17:17:27');

-- --------------------------------------------------------

--
-- Structure for view `products_category`
--
DROP TABLE IF EXISTS `products_category`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `products_category`  AS  select `p`.`id_product` AS `id_product`,`p`.`name_product` AS `name_product`,`p`.`description_product` AS `description_product`,`p`.`img1_product` AS `img1_product`,`p`.`img2_product` AS `img2_product`,`p`.`img3_product` AS `img3_product`,`p`.`img_product` AS `img_product`,`p`.`status_product` AS `status_product`,`p`.`created_at` AS `created_at`,`p`.`updated_at` AS `updated_at`,`p`.`customer_id` AS `customer_id`,`p`.`madeby` AS `madeby`,`p`.`price_product` AS `price_product`,`p`.`is_deleted` AS `is_deleted`,`c`.`email_customer` AS `email_customer`,`sc`.`name_sub` AS `name_sub`,`b`.`name_brand` AS `name_brand`,`cat`.`name_category` AS `name_category`,`cat`.`id_category` AS `category_id` from ((((`products` `p` left join `sub_category` `sc` on((`p`.`sub_category_id` = `sc`.`id_sub`))) left join `brands` `b` on((`p`.`brand_id` = `b`.`id_brand`))) left join `customers` `c` on((`p`.`customer_id` = `c`.`id_customer`))) left join `category` `cat` on((`sc`.`category_id` = `cat`.`id_category`))) ;

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
  MODIFY `id_brand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shipping_address`
--
ALTER TABLE `shipping_address`
  MODIFY `id_address` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `products_ibfk_4` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id_customer`);

--
-- Constraints for table `shipping_address`
--
ALTER TABLE `shipping_address`
  ADD CONSTRAINT `shipping_address_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id_customer`);

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

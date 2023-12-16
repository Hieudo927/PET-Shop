-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 02:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` tinytext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `meta_title` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `careated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `image`, `meta_title`, `status`, `popular`, `careated_at`) VALUES
(42, 'Husky', '1', '1702694809.jpg', 'Chó Husky', 0, 1, '2023-12-16 02:46:49'),
(43, 'Shinba', '1', '1702694838.jpg', 'Chó Sinba', 0, 1, '2023-12-16 02:47:18'),
(44, 'Alaska', '1', '1702694896.jpg', 'Chó Alaska', 0, 1, '2023-12-16 02:47:47'),
(45, 'Pug', '1', '1702694887.jpg', 'Chó Pug', 0, 1, '2023-12-16 02:48:07'),
(46, 'Abyssinian', '2', '1702694956.jpg', 'Mèo Abyssinian', 0, 1, '2023-12-16 02:49:16'),
(47, 'Mèo Anh Lông Dài', '2', '1702694993.jpg', 'Mèo Anh Lông Dài', 0, 0, '2023-12-16 02:49:53'),
(48, 'Mèo Anh Lông Ngắn', '2', '1702695019.jpg', 'Mèo Anh Lông Ngắn', 0, 0, '2023-12-16 02:50:19'),
(49, 'Bàn Cào', '3', '1702695772.jpg', 'Bàn cào cho mèo', 0, 0, '2023-12-16 03:02:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `tracking_no` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pincode` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total_price` int(11) NOT NULL,
  `payment_mode` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_id` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tracking_no`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_mode`, `payment_id`, `status`, `comments`, `create_at`) VALUES
(2, 'DH56994329256059', 10, 'Hiếu Đỗ', 'hieudo927@gmail.com', '+84329256059', 'Yên Lạc', '100000', 46000000, 'COD', '', 1, '', '2023-12-15 17:03:30'),
(3, 'DH13814329256059', 11, 'Hiếu Đỗ', 'hieudo927@gmail.com', '+84329256059', 'Ngh 193/192, Phú Diễn, Bắc Từ Liêm, Hà Nội', '100000', 31500000, 'COD', '', 1, '', '2023-12-16 03:05:31'),
(4, 'DH86124329256059', 11, 'Hiếu Đỗ', 'hieudo927@gmail.com', '+84329256059', 'Ngh 193/192, Phú Diễn, Bắc Từ Liêm, Hà Nội', '100000', 25500000, 'COD', '', 0, '', '2023-12-16 03:22:54'),
(5, 'DH65774329256059', 11, 'fweewyery', 'hieudo927@gmail.com', '+84329256059', 'ưeyterurti', '100000', 11500000, 'COD', '', 2, '', '2023-12-16 07:46:28'),
(6, 'DH82384329256059', 11, 'fweewyery', 'hieudo927@gmail.com', '+84329256059', 'sdaghdfjghk', '100000', 8500000, 'COD', '', 0, '', '2023-12-16 08:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(191) NOT NULL,
  `product_id` int(191) NOT NULL,
  `qty` int(191) NOT NULL,
  `price` int(191) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `qty`, `price`, `create_at`) VALUES
(3, 2, 4, 3, 11500000, '2023-12-15 17:03:30'),
(4, 2, 3, 1, 11500000, '2023-12-15 17:03:30'),
(5, 3, 24, 1, 11500000, '2023-12-16 03:05:31'),
(6, 3, 26, 1, 11500000, '2023-12-16 03:05:31'),
(7, 3, 22, 1, 8500000, '2023-12-16 03:05:31'),
(8, 4, 22, 3, 8500000, '2023-12-16 03:22:54'),
(9, 5, 26, 1, 11500000, '2023-12-16 07:46:28'),
(10, 6, 22, 1, 8500000, '2023-12-16 08:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `original_price` int(11) NOT NULL,
  `selling_price` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `gender`, `month`, `description`, `original_price`, `selling_price`, `image`, `quantity`, `status`, `create_at`) VALUES
(22, 42, 'Husky Đen Trắng Cái', 0, 5, 'Phí vận chuyển.\r\nPhí & lãi suất trả góp.\r\nISO Microchip.\r\nBảo hành sức khỏe 30 ngày.\r\nHỗ trợ bác sĩ thú y miễn phí trọn đời.\r\nGiảm trọn đời 20% Spa Grooming; 5% phụ kiện.\r\nHợp đồng.\r\nSổ theo dõi sức khoẻ.\r\nTẩy giun.\r\nĐiều trị chống ký sinh trùng.\r\nTiêm chủng cập nhật.\r\nSách hướng dẫn chăm sóc.', 9000000, 8500000, '1702695230.jpg', 6, 0, '2023-12-16 02:53:03'),
(23, 42, 'Husky Đen Trắng Đực C13154', 1, 9, 'Phí vận chuyển.\r\nPhí & lãi suất trả góp.\r\nISO Microchip.\r\nBảo hành sức khỏe 30 ngày.\r\nHỗ trợ bác sĩ thú y miễn phí trọn đời.\r\nGiảm trọn đời 20% Spa Grooming; 5% phụ kiện.\r\nHợp đồng.\r\nSổ theo dõi sức khoẻ.\r\nTẩy giun.\r\nĐiều trị chống ký sinh trùng.\r\nTiêm chủng cập nhật.\r\nSách hướng dẫn chăm sóc.', 12000000, 11500000, '1702695358.jpg', 1, 0, '2023-12-16 02:55:58'),
(24, 47, 'Anh Lông Dài Bicolor Đực M12384', 1, 12, 'Phí vận chuyển.\r\nPhí & lãi suất trả góp.\r\nISO Microchip.\r\nBảo hành sức khỏe 30 ngày.\r\nHỗ trợ bác sĩ thú y miễn phí trọn đời.\r\nGiảm trọn đời 20% Spa Grooming; 5% phụ kiện.\r\nHợp đồng.\r\nSổ theo dõi sức khoẻ.\r\nTẩy giun.\r\nĐiều trị chống ký sinh trùng.\r\nTiêm chủng cập nhật.\r\nSách hướng dẫn chăm sóc.', 12000000, 11500000, '1702695471.jpg', 1, 0, '2023-12-16 02:57:51'),
(25, 47, 'Anh Lông Dài Trắng Cái M12032', 0, 3, '', 12000000, 11500000, '1702695532.jpg', 3, 0, '2023-12-16 02:58:52'),
(26, 44, 'Alaska Standard Đen Trắng Cái C12937', 0, 6, '', 12000000, 11500000, '1702695668.jpg', 12, 0, '2023-12-16 03:01:08'),
(27, 49, 'NHÀ CÂY MÈO LZ0143', 2, 0, '', 1200000, 1150000, '1702695845.jpg', 12, 0, '2023-12-16 03:03:54'),
(28, 49, 'TRỤ CÀO ĐA NĂNG LỚN', 2, 0, 'mô tả', 3000000, 2500000, '1702723622.jpg', 22, 0, '2023-12-16 10:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
  `gender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role_as` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `birthday`, `gender`, `phone`, `address`, `email`, `password`, `role_as`, `created_at`) VALUES
(10, 'Nguyễn Văn A', '17/08/2002', 'Nam', '+84329256059', 'Yên Lạc-Vĩnh Phúc', 'test@gmail.com', '$2y$10$v53SbGihPWUjOf8ZRMyVT.FY3hPcf7yUYvgv5tKJQHYw9kD7OOYYy', 0, '2023-11-28 16:38:01'),
(11, 'Admin', '17/08/2002', 'Nam', '+84329256059', 'Ngh 193/192, Phú Diễn, Bắc Từ Liêm, Hà Nội', 'admin@gmail.com', '$2y$10$LFxlidMUD2uHB4V1WyDxyeXF7GrhQleCRzQlM7DyXum41WxH18cmS', 1, '2023-11-29 07:03:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

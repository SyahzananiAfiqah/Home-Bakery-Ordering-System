-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2023 at 05:17 AM
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
-- Database: `mia-jasmine`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'nani', 'nani', '02ea2ae2a237c042285e093e6972eaa9');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cake`
--

CREATE TABLE `tbl_cake` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `price_loaf` decimal(10,2) NOT NULL,
  `price_half` decimal(10,2) NOT NULL,
  `price_full` decimal(10,2) DEFAULT NULL,
  `best_seller` enum('Yes','No') NOT NULL DEFAULT 'No',
  `active` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `featured` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cake`
--

INSERT INTO `tbl_cake` (`id`, `title`, `description`, `category_id`, `image_name`, `price`, `price_loaf`, `price_half`, `price_full`, `best_seller`, `active`, `featured`) VALUES
(7, 'Masam Manis', '-', 1, 'Cake-Name-4566.png', 0.00, 20.00, 40.00, 60.00, 'No', 'Yes', 'Yes'),
(8, 'Fattzura', '-', 1, 'Cake-Name-5364.png', 0.00, 50.00, 100.00, 150.00, 'Yes', 'Yes', 'Yes'),
(9, 'DoorGift', 'Loaf Price - 50Pcs\r\nHalf Price - 100Pcs\r\nFull Price - 150Pcs', 4, 'Cake-Name-795.png', 0.00, 100.00, 200.00, 300.00, 'Yes', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `active` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `featured` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `active`, `featured`) VALUES
(1, 'Classic', 'Cake_Category_536.png', 'Yes', 'Yes'),
(2, 'Premium', 'Cake_Category_819.png', 'Yes', 'Yes'),
(3, 'Mix', 'Cake_Category_55.png', 'Yes', 'Yes'),
(4, 'DoorGift', 'Cake_Category_333.png', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

CREATE TABLE `tbl_images` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `search_tags` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_address` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `delivery_method` enum('pickup','delivery') NOT NULL,
  `payment_method` enum('cash','debit_card','online_transfer') NOT NULL,
  `bank` varchar(255) DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `card_holder` varchar(255) DEFAULT NULL,
  `expiry_date` varchar(5) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_status` enum('Processing','Delivered','Cancelled') NOT NULL DEFAULT 'Processing',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `customer_name`, `customer_contact`, `customer_address`, `phone`, `address`, `status`, `delivery_method`, `payment_method`, `bank`, `card_number`, `card_holder`, `expiry_date`, `cvv`, `total_price`, `order_status`, `order_date`, `email`, `customer_email`) VALUES
(1, 'syahzanani afiqah', '0173446652', '53A, Jalan Jasmin3,\r\nLaman Jasmin, Nilai Impian', '', '', 'Ordered', 'delivery', '', NULL, NULL, NULL, NULL, NULL, 70.00, 'Processing', '2023-08-06 01:31:58', '', ''),
(2, 'syahzanani afiqah', '0173446652', '53A, Jalan Jasmin3,\r\nLaman Jasmin, Nilai Impian', '', '', 'Ordered', 'pickup', '', NULL, NULL, NULL, NULL, NULL, 20.00, 'Processing', '2023-08-06 01:59:00', '', 'syahzananiafiqah2@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_items`
--

CREATE TABLE `tbl_order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `cake_id` int(11) NOT NULL,
  `size` varchar(10) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_items`
--

INSERT INTO `tbl_order_items` (`id`, `order_id`, `cake_id`, `size`, `quantity`) VALUES
(1, 1, 8, 'loaf', 1),
(2, 1, 7, 'loaf', 1),
(3, 2, 7, 'loaf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `active` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cake`
--
ALTER TABLE `tbl_cake`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `cake_id` (`cake_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_cake`
--
ALTER TABLE `tbl_cake`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cake`
--
ALTER TABLE `tbl_cake`
  ADD CONSTRAINT `tbl_cake_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_order_items`
--
ALTER TABLE `tbl_order_items`
  ADD CONSTRAINT `tbl_order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`id`),
  ADD CONSTRAINT `tbl_order_items_ibfk_2` FOREIGN KEY (`cake_id`) REFERENCES `tbl_cake` (`id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

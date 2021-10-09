-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2020 at 08:05 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ent_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `ent_categories`
--

CREATE TABLE `ent_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ent_categories`
--

INSERT INTO `ent_categories` (`id`, `category_name`) VALUES
(1, 'Mobile Phones'),
(2, 'Accessories'),
(3, 'Computer & Laptop'),
(4, 'Electronics & Home Appliances'),
(8, 'Smart Products'),
(9, 'Fashion Accessories'),
(11, 'Home Appliance');

-- --------------------------------------------------------

--
-- Table structure for table `ent_products`
--

CREATE TABLE `ent_products` (
  `id` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `old_price` float DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `short_desc` varchar(1000) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `manufacturer` varchar(50) DEFAULT NULL,
  `review` varchar(100) DEFAULT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ent_products`
--

INSERT INTO `ent_products` (`id`, `name`, `price`, `old_price`, `code`, `quantity`, `short_desc`, `photo`, `user_id`, `category_id`, `manufacturer`, `review`, `update_date`) VALUES
(2, 'Head phone', 400, 400, 'C-02', 8, '\r\n            \r\n            Black mouse', '11.jpg', 2, 1, 'A4-Tech', 'This is Good condition', '2020-11-10 04:32:48'),
(3, 'Lenovo G40-70', 50000, 50000, 'C-03', 5, '\r\n            This is a intake laptop', 'laptop.png', 1, 2, 'Lenovo', 'This is Good condition', '2020-11-10 06:39:57'),
(7, 'Pen', 5, NULL, 'p-11', 10, '\r\n             This is a matador pen', 'pen.jpg', NULL, 2, 'Matador', NULL, '2020-11-10 06:51:00'),
(8, 'Fan', 2500, NULL, 'f-01', 11, '\r\n            \r\n            Super high fan', 'fan.jpg', NULL, 1, 'BRB', NULL, '2020-11-10 06:51:34'),
(9, 'test', 11, NULL, '11', 11, 'sldfkj', '4.jpg', NULL, 1, 'fdsaf', NULL, '2020-11-10 04:07:32'),
(12, 'Watter Pot', 111, NULL, 'a', 10, '\r\n            \r\n             This is product', 'download.jpg', NULL, 2, 'product', NULL, '2020-11-10 07:02:39'),
(13, 'Head phone', 1200, NULL, 'h-0', 5, 'This is headphone', '11.jpg', NULL, 1, 'Lenovo', NULL, '2020-11-10 04:11:46'),
(14, 'Rice Cooker', 2000, NULL, 's-01', 5, 'High quality box', '10.jpg', NULL, 11, 'RFL', NULL, '2020-11-10 04:18:09');

-- --------------------------------------------------------

--
-- Table structure for table `ent_purchase`
--

CREATE TABLE `ent_purchase` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `ref_no` varchar(20) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ent_purchase`
--

INSERT INTO `ent_purchase` (`id`, `vendor_id`, `ref_no`, `purchase_date`, `due_date`) VALUES
(10, 1, 'ent-02', '2020-11-03', '2020-11-14'),
(11, 4, 'A-001', '2020-11-03', '2020-11-20'),
(12, 1, 'aaa', '2020-11-07', '2020-11-18'),
(13, 2, 'aaa', '2020-11-01', '2020-11-20'),
(14, 4, 'A-012', '2020-11-05', '2020-11-20'),
(15, 1, 'A-01', '2020-11-09', '2020-11-14'),
(16, 6, 'A-01', '2020-11-09', '2020-11-20');

-- --------------------------------------------------------

--
-- Table structure for table `ent_purchasedetails`
--

CREATE TABLE `ent_purchasedetails` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `Qty` float DEFAULT NULL,
  `cost` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ent_purchasedetails`
--

INSERT INTO `ent_purchasedetails` (`id`, `purchase_id`, `product_id`, `Qty`, `cost`) VALUES
(1, 1, 1, 10, 300),
(2, 2, 2, 15, 200),
(3, 2, 2, 5, 200),
(4, 3, 3, 5, 40000),
(5, 10, 1, 3, 400),
(6, 10, 2, 3, 400),
(7, 11, 4, 5, 3000),
(8, 11, 2, 5, 500),
(9, 12, 2, 2, 500),
(10, 12, 5, 3, 222),
(11, 13, 2, 2, 500),
(12, 14, 8, 3, 2500),
(13, 14, 6, 5, 4),
(14, 14, 3, 2, 40000),
(15, 15, 3, 2, 40000),
(16, 15, 2, 50, 500),
(17, 16, 14, 5, 1500),
(18, 16, 8, 6, 2500),
(19, 16, 12, 10, 100);

-- --------------------------------------------------------

--
-- Table structure for table `ent_roles`
--

CREATE TABLE `ent_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ent_roles`
--

INSERT INTO `ent_roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'Modaretor'),
(4, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `ent_uom`
--

CREATE TABLE `ent_uom` (
  `id` int(11) NOT NULL,
  `name` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ent_uom`
--

INSERT INTO `ent_uom` (`id`, `name`) VALUES
(1, 'Pice'),
(2, 'Kg'),
(3, 'Li');

-- --------------------------------------------------------

--
-- Table structure for table `ent_users`
--

CREATE TABLE `ent_users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `photo` varchar(25) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `active_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ent_users`
--

INSERT INTO `ent_users` (`id`, `name`, `photo`, `role_id`, `password`, `active_status`) VALUES
(1, 'azizul', 'DSC_0063.JPG', 1, '1e4eda5b9f3ad342a7dcb49db963eb37', 0),
(3, 'rasel', 'DSC_0014.JPG', 3, '2b272cbcd91c2d762fcb8261307d295e', 0),
(5, 'admin', 'Untitled-1.jpg', 1, '698d51a19d8a121ce581499d7b701668', 0),
(6, 'name', NULL, NULL, '111', 0),
(9, 'ariful', 'photo.jpg', NULL, '111', 0),
(10, 'raju', NULL, NULL, '698d51a19d8a121ce581499d7b701668', 0),
(11, 'rakib', 'DSC_0024.JPG', 4, '3049a1f0f1c808cdaa4fbed0e01649b1', 0),
(12, 'azizul656589@gmail.com', 'FB_IMG_1566742495527.jpg', 4, '3049a1f0f1c808cdaa4fbed0e01649b1', 0),
(13, 'nahid', 'FB_IMG_1566742456552.jpg', 1, '698d51a19d8a121ce581499d7b701668', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ent_vendor`
--

CREATE TABLE `ent_vendor` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `phone` int(15) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ent_vendor`
--

INSERT INTO `ent_vendor` (`id`, `name`, `phone`, `address`) VALUES
(1, 'Akmol Hossain', 1738040301, 'West Rajabazar road 10 H#48/i'),
(2, 'Rasel Hossain', 173804019, 'Mirpur-10'),
(3, 'Ridoy Khan', 1738040309, 'Shymoli '),
(4, 'Ariful Islam', 162934541, 'Middle Baddah'),
(6, 'Mirajul Islam', 1701986619, 'Mirpur 60 feet');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ent_categories`
--
ALTER TABLE `ent_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent_products`
--
ALTER TABLE `ent_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent_purchase`
--
ALTER TABLE `ent_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent_purchasedetails`
--
ALTER TABLE `ent_purchasedetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent_roles`
--
ALTER TABLE `ent_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent_uom`
--
ALTER TABLE `ent_uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ent_users`
--
ALTER TABLE `ent_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `ent_vendor`
--
ALTER TABLE `ent_vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ent_categories`
--
ALTER TABLE `ent_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ent_products`
--
ALTER TABLE `ent_products`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `ent_purchase`
--
ALTER TABLE `ent_purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ent_purchasedetails`
--
ALTER TABLE `ent_purchasedetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ent_roles`
--
ALTER TABLE `ent_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ent_uom`
--
ALTER TABLE `ent_uom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ent_users`
--
ALTER TABLE `ent_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ent_vendor`
--
ALTER TABLE `ent_vendor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

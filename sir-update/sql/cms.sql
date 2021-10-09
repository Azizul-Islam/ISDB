-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 01:49 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ad_course` ()  begin
insert into cms_courses(title,price,user_id)values('PHP Web Application',14000,1);
select * from cms_courses;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ad_user` (IN `name` VARCHAR(10), IN `pwd` VARCHAR(50), IN `rid` INT(10))  begin
insert into cms_users(username,password,role_id)values(name,md5(pwd),rid);

select * from cms_users;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_inventory` ()  select count(*) from cms_courses$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `count_users` () RETURNS INT(11) begin
declare count int;
select count(*) into count from cms_users;
return count;
end$$

CREATE DEFINER=`root`@`localhost` FUNCTION `sum_price` () RETURNS FLOAT begin
declare total float;
select sum(price) into total from cms_courses;
return total;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cms_admission`
--

CREATE TABLE `cms_admission` (
  `id` int(10) NOT NULL,
  `student_id` int(10) DEFAULT NULL,
  `course_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_admission`
--

INSERT INTO `cms_admission` (`id`, `student_id`, `course_id`, `created_at`) VALUES
(1, 1, 1, '2020-10-05 12:47:56'),
(2, 2, 1, '2020-10-05 12:47:56'),
(3, 1, 2, '2020-10-05 12:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `cms_courses`
--

CREATE TABLE `cms_courses` (
  `id` int(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `price` float DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `inactive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_courses`
--

INSERT INTO `cms_courses` (`id`, `title`, `price`, `user_id`, `inactive`) VALUES
(1, 'Web development with PHP', 15000, 1, 0),
(2, 'Android Application Development', 12000, 1, 0),
(3, 'ASP.NET Application Development', 20000, 2, 0),
(4, 'PHP Web Application', 14000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cms_payment`
--

CREATE TABLE `cms_payment` (
  `id` int(10) NOT NULL,
  `student_id` int(10) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remark` varchar(20) DEFAULT NULL,
  `method` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_payment`
--

INSERT INTO `cms_payment` (`id`, `student_id`, `amount`, `discount`, `created_at`, `remark`, `method`) VALUES
(1, 1, 10000, 5000, '2020-10-05 12:47:57', 'Txs344333', 'BKash'),
(2, 2, 15000, 0, '2020-10-05 12:47:57', 'Txs334533', 'Cash');

-- --------------------------------------------------------

--
-- Table structure for table `cms_products`
--

CREATE TABLE `cms_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `uom_id` int(10) UNSIGNED NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_products`
--

INSERT INTO `cms_products` (`id`, `name`, `uom_id`, `price`) VALUES
(1, 'Apple', 1, 120),
(2, 'Orange', 1, 140),
(3, 'Banana', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cms_purchase`
--

CREATE TABLE `cms_purchase` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `purchase_at` datetime NOT NULL,
  `ref_no` varchar(20) NOT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_purchase`
--

INSERT INTO `cms_purchase` (`id`, `supplier_id`, `purchase_at`, `ref_no`, `remark`) VALUES
(1, 1, '2020-10-31 00:00:00', '3433', 'na'),
(2, 1, '2020-11-02 00:00:00', '34324234', 'na'),
(3, 2, '2020-11-02 00:00:00', '44534433', 'na'),
(4, 2, '2020-11-02 00:00:00', '3545545444', 'na');

-- --------------------------------------------------------

--
-- Table structure for table `cms_purchase_details`
--

CREATE TABLE `cms_purchase_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_id` varchar(45) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `qty` float NOT NULL,
  `cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_purchase_details`
--

INSERT INTO `cms_purchase_details` (`id`, `purchase_id`, `product_id`, `qty`, `cost`) VALUES
(1, '2', 2, 6, 100),
(2, '2', 3, 4, 200),
(3, '3', 1, 4, 200),
(4, '3', 2, 2, 120),
(5, '3', 3, 12, 9),
(6, '4', 2, 5, 400);

-- --------------------------------------------------------

--
-- Table structure for table `cms_roles`
--

CREATE TABLE `cms_roles` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_roles`
--

INSERT INTO `cms_roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `cms_students`
--

CREATE TABLE `cms_students` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_students`
--

INSERT INTO `cms_students` (`id`, `name`, `mobile`, `email`, `created_at`) VALUES
(1, 'Rana Miah', '01777664786', 'miahmudrana21@gmail.', '2020-10-05 12:47:56'),
(2, 'Md Azizul Islam', '01738040305', 'azizul65689@gmail.co', '2020-10-05 12:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `cms_suppliers`
--

CREATE TABLE `cms_suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_suppliers`
--

INSERT INTO `cms_suppliers` (`id`, `name`, `address`, `mobile`, `email`) VALUES
(1, 'Admin, Inc.', '795 Folsom Ave, Suite 600\r\nSan Francisco, CA 94107', '(804) 123-5432', 'info@almasaeedstudio.com'),
(2, 'Yasin Ali', 'Khilgaw', '45454545455', 'yasin@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `cms_uom`
--

CREATE TABLE `cms_uom` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_uom`
--

INSERT INTO `cms_uom` (`id`, `name`) VALUES
(1, 'Piece'),
(2, 'Kg'),
(3, 'Li');

-- --------------------------------------------------------

--
-- Table structure for table `cms_users`
--

CREATE TABLE `cms_users` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `role_id` int(10) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `inactive` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_users`
--

INSERT INTO `cms_users` (`id`, `username`, `role_id`, `password`, `inactive`) VALUES
(1, 'Jahid', 2, '96e79218965eb72c92a549dd5a330112', 0),
(2, 'yasin', 3, '92a35d8b542d4b11a6430f4db05c7e8d', 0),
(4, 'Towhid', 1, 'd593db4e52fa9ddca35ad15f2e5ed1bc', 0),
(5, 'Nazrul Islam', 1, '5a8dccb220de5c6775c873ead6ff2e43', 1),
(6, 'Azizul', 2, '670df58df5a2ec63b0a33e054418105a', 0);

-- --------------------------------------------------------

--
-- Stand-in structure for view `user_report`
-- (See below for the actual view)
--
CREATE TABLE `user_report` (
`id` int(10)
,`username` varchar(20)
,`role` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure for view `user_report`
--
DROP TABLE IF EXISTS `user_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_report`  AS  select `u`.`id` AS `id`,`u`.`username` AS `username`,`r`.`name` AS `role` from (`cms_users` `u` join `cms_roles` `r`) where `r`.`id` = `u`.`role_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cms_admission`
--
ALTER TABLE `cms_admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_courses`
--
ALTER TABLE `cms_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_payment`
--
ALTER TABLE `cms_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_products`
--
ALTER TABLE `cms_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_purchase`
--
ALTER TABLE `cms_purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_purchase_details`
--
ALTER TABLE `cms_purchase_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_roles`
--
ALTER TABLE `cms_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_students`
--
ALTER TABLE `cms_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_suppliers`
--
ALTER TABLE `cms_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_uom`
--
ALTER TABLE `cms_uom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_users`
--
ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cms_admission`
--
ALTER TABLE `cms_admission`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_courses`
--
ALTER TABLE `cms_courses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms_payment`
--
ALTER TABLE `cms_payment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_products`
--
ALTER TABLE `cms_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_purchase`
--
ALTER TABLE `cms_purchase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cms_purchase_details`
--
ALTER TABLE `cms_purchase_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cms_roles`
--
ALTER TABLE `cms_roles`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_students`
--
ALTER TABLE `cms_students`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_suppliers`
--
ALTER TABLE `cms_suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_uom`
--
ALTER TABLE `cms_uom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_users`
--
ALTER TABLE `cms_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

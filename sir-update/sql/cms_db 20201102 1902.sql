-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.11-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema cms
--

CREATE DATABASE IF NOT EXISTS cms;
USE cms;

--
-- Temporary table structure for view `user_report`
--
DROP TABLE IF EXISTS `user_report`;
DROP VIEW IF EXISTS `user_report`;
CREATE TABLE `user_report` (
  `id` int(10),
  `username` varchar(20),
  `role` varchar(20)
);

--
-- Definition of table `cms_admission`
--

DROP TABLE IF EXISTS `cms_admission`;
CREATE TABLE `cms_admission` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) DEFAULT NULL,
  `course_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_admission`
--

/*!40000 ALTER TABLE `cms_admission` DISABLE KEYS */;
INSERT INTO `cms_admission` (`id`,`student_id`,`course_id`,`created_at`) VALUES 
 (1,1,1,'2020-10-05 18:47:56'),
 (2,2,1,'2020-10-05 18:47:56'),
 (3,1,2,'2020-10-05 18:47:56');
/*!40000 ALTER TABLE `cms_admission` ENABLE KEYS */;


--
-- Definition of table `cms_courses`
--

DROP TABLE IF EXISTS `cms_courses`;
CREATE TABLE `cms_courses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `price` float DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `inactive` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_courses`
--

/*!40000 ALTER TABLE `cms_courses` DISABLE KEYS */;
INSERT INTO `cms_courses` (`id`,`title`,`price`,`user_id`,`inactive`) VALUES 
 (1,'Web development with PHP',15000,1,0),
 (2,'Android Application Development',12000,1,0),
 (3,'ASP.NET Application Development',20000,2,0),
 (4,'PHP Web Application',14000,1,0);
/*!40000 ALTER TABLE `cms_courses` ENABLE KEYS */;


--
-- Definition of table `cms_payment`
--

DROP TABLE IF EXISTS `cms_payment`;
CREATE TABLE `cms_payment` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `student_id` int(10) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `discount` float DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `remark` varchar(20) DEFAULT NULL,
  `method` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_payment`
--

/*!40000 ALTER TABLE `cms_payment` DISABLE KEYS */;
INSERT INTO `cms_payment` (`id`,`student_id`,`amount`,`discount`,`created_at`,`remark`,`method`) VALUES 
 (1,1,10000,5000,'2020-10-05 18:47:57','Txs344333','BKash'),
 (2,2,15000,0,'2020-10-05 18:47:57','Txs334533','Cash');
/*!40000 ALTER TABLE `cms_payment` ENABLE KEYS */;


--
-- Definition of table `cms_products`
--

DROP TABLE IF EXISTS `cms_products`;
CREATE TABLE `cms_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `uom_id` int(10) unsigned NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_products`
--

/*!40000 ALTER TABLE `cms_products` DISABLE KEYS */;
INSERT INTO `cms_products` (`id`,`name`,`uom_id`,`price`) VALUES 
 (1,'Apple',1,120),
 (2,'Orange',1,140),
 (3,'Banana',1,10);
/*!40000 ALTER TABLE `cms_products` ENABLE KEYS */;


--
-- Definition of table `cms_purchase`
--

DROP TABLE IF EXISTS `cms_purchase`;
CREATE TABLE `cms_purchase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(10) unsigned NOT NULL,
  `purchase_at` datetime NOT NULL,
  `ref_no` varchar(20) NOT NULL,
  `remark` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_purchase`
--

/*!40000 ALTER TABLE `cms_purchase` DISABLE KEYS */;
INSERT INTO `cms_purchase` (`id`,`supplier_id`,`purchase_at`,`ref_no`,`remark`) VALUES 
 (1,1,'2020-10-31 00:00:00','3433','na'),
 (2,1,'2020-11-02 00:00:00','34324234','na'),
 (3,2,'2020-11-02 00:00:00','44534433','na'),
 (4,2,'2020-11-02 00:00:00','3545545444','na');
/*!40000 ALTER TABLE `cms_purchase` ENABLE KEYS */;


--
-- Definition of table `cms_purchase_details`
--

DROP TABLE IF EXISTS `cms_purchase_details`;
CREATE TABLE `cms_purchase_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` varchar(45) NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `qty` float NOT NULL,
  `cost` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_purchase_details`
--

/*!40000 ALTER TABLE `cms_purchase_details` DISABLE KEYS */;
INSERT INTO `cms_purchase_details` (`id`,`purchase_id`,`product_id`,`qty`,`cost`) VALUES 
 (1,'2',2,6,100),
 (2,'2',3,4,200),
 (3,'3',1,4,200),
 (4,'3',2,2,120),
 (5,'3',3,12,9),
 (6,'4',2,5,400);
/*!40000 ALTER TABLE `cms_purchase_details` ENABLE KEYS */;


--
-- Definition of table `cms_roles`
--

DROP TABLE IF EXISTS `cms_roles`;
CREATE TABLE `cms_roles` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_roles`
--

/*!40000 ALTER TABLE `cms_roles` DISABLE KEYS */;
INSERT INTO `cms_roles` (`id`,`name`) VALUES 
 (1,'Admin'),
 (2,'Editor'),
 (3,'Member');
/*!40000 ALTER TABLE `cms_roles` ENABLE KEYS */;


--
-- Definition of table `cms_students`
--

DROP TABLE IF EXISTS `cms_students`;
CREATE TABLE `cms_students` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_students`
--

/*!40000 ALTER TABLE `cms_students` DISABLE KEYS */;
INSERT INTO `cms_students` (`id`,`name`,`mobile`,`email`,`created_at`) VALUES 
 (1,'Rana Miah','01777664786','miahmudrana21@gmail.','2020-10-05 18:47:56'),
 (2,'Md Azizul Islam','01738040305','azizul65689@gmail.co','2020-10-05 18:47:56');
/*!40000 ALTER TABLE `cms_students` ENABLE KEYS */;


--
-- Definition of table `cms_suppliers`
--

DROP TABLE IF EXISTS `cms_suppliers`;
CREATE TABLE `cms_suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_suppliers`
--

/*!40000 ALTER TABLE `cms_suppliers` DISABLE KEYS */;
INSERT INTO `cms_suppliers` (`id`,`name`,`address`,`mobile`,`email`) VALUES 
 (1,'Admin, Inc.','795 Folsom Ave, Suite 600\r\nSan Francisco, CA 94107','(804) 123-5432','info@almasaeedstudio.com'),
 (2,'Yasin Ali','Khilgaw','45454545455','yasin@yahoo.com');
/*!40000 ALTER TABLE `cms_suppliers` ENABLE KEYS */;


--
-- Definition of table `cms_uom`
--

DROP TABLE IF EXISTS `cms_uom`;
CREATE TABLE `cms_uom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_uom`
--

/*!40000 ALTER TABLE `cms_uom` DISABLE KEYS */;
INSERT INTO `cms_uom` (`id`,`name`) VALUES 
 (1,'Piece'),
 (2,'Kg'),
 (3,'Li');
/*!40000 ALTER TABLE `cms_uom` ENABLE KEYS */;


--
-- Definition of table `cms_users`
--

DROP TABLE IF EXISTS `cms_users`;
CREATE TABLE `cms_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `role_id` int(10) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `inactive` tinyint(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_users`
--

/*!40000 ALTER TABLE `cms_users` DISABLE KEYS */;
INSERT INTO `cms_users` (`id`,`username`,`role_id`,`password`,`inactive`) VALUES 
 (1,'Jahid',2,'96e79218965eb72c92a549dd5a330112',0),
 (2,'yasin',3,'92a35d8b542d4b11a6430f4db05c7e8d',0),
 (4,'Towhid',1,'d593db4e52fa9ddca35ad15f2e5ed1bc',0),
 (5,'Nazrul Islam',1,'5a8dccb220de5c6775c873ead6ff2e43',1),
 (6,'Azizul',2,'670df58df5a2ec63b0a33e054418105a',0);
/*!40000 ALTER TABLE `cms_users` ENABLE KEYS */;


--
-- Definition of function `count_users`
--

DROP FUNCTION IF EXISTS `count_users`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` FUNCTION `count_users`() RETURNS int(11)
begin
declare count int;
select count(*) into count from cms_users;
return count;
end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of function `sum_price`
--

DROP FUNCTION IF EXISTS `sum_price`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` FUNCTION `sum_price`() RETURNS float
begin
declare total float;
select sum(price) into total from cms_courses;
return total;
end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `ad_course`
--

DROP PROCEDURE IF EXISTS `ad_course`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ad_course`()
begin
insert into cms_courses(title,price,user_id)values('PHP Web Application',14000,1);
select * from cms_courses;
end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `ad_user`
--

DROP PROCEDURE IF EXISTS `ad_user`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ad_user`(IN name varchar(10),IN pwd varchar(50) ,IN rid int(10))
begin
insert into cms_users(username,password,role_id)values(name,md5(pwd),rid);

select * from cms_users;

end $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of procedure `get_inventory`
--

DROP PROCEDURE IF EXISTS `get_inventory`;

DELIMITER $$

/*!50003 SET @TEMP_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_inventory`()
select count(*) from cms_courses $$
/*!50003 SET SESSION SQL_MODE=@TEMP_SQL_MODE */  $$

DELIMITER ;

--
-- Definition of view `user_report`
--

DROP TABLE IF EXISTS `user_report`;
DROP VIEW IF EXISTS `user_report`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `user_report` AS select `u`.`id` AS `id`,`u`.`username` AS `username`,`r`.`name` AS `role` from (`cms_users` `u` join `cms_roles` `r`) where `r`.`id` = `u`.`role_id`;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

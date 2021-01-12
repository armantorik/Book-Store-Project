-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2021 at 01:42 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group20commercialupd`
--
CREATE DATABASE IF NOT EXISTS `group20commercialupd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `group20commercialupd`;

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE IF NOT EXISTS `basket` (
  `book_id` int(11) NOT NULL,
  `quantity` int(30) NOT NULL,
  `custProductId` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`custProductId`),
  KEY `custProductId` (`custProductId`),
  KEY `user_id` (`user_id`),
  KEY `book_id` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bought_books`
--

CREATE TABLE IF NOT EXISTS `bought_books` (
  `c_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`c_id`,`p_id`),
  KEY `p` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cancel_purchase_of`
--

CREATE TABLE IF NOT EXISTS `cancel_purchase_of` (
  `sm_id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  PRIMARY KEY (`sm_id`,`order_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `change_status_of`
--

CREATE TABLE IF NOT EXISTS `change_status_of` (
  `sm_id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  PRIMARY KEY (`sm_id`,`order_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `c_id` int(30) NOT NULL AUTO_INCREMENT,
  `c_password` varchar(30) NOT NULL,
  `c_name` varchar(30) NOT NULL,
  `c_phone` varchar(200) NOT NULL,
  `c_mail` varchar(30) NOT NULL,
  `c_address` varchar(30) NOT NULL,
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_id` (`c_id`),
  UNIQUE KEY `c_id_2` (`c_id`),
  UNIQUE KEY `c_id_3` (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2138 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_password`, `c_name`, `c_phone`, `c_mail`, `c_address`) VALUES
(2137, 'newPASS', 'armn', '23123', 'armn@gmail.com', 'ist');

-- --------------------------------------------------------

--
-- Table structure for table `customer_comment_product`
--

CREATE TABLE IF NOT EXISTS `customer_comment_product` (
  `c_id` int(30) NOT NULL,
  `p_id` int(30) NOT NULL,
  `comment` varchar(200) NOT NULL,
  PRIMARY KEY (`c_id`,`p_id`),
  KEY `c_c2` (`p_id`),
  KEY `comment_2` (`comment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer_creates_order`
--

CREATE TABLE IF NOT EXISTS `customer_creates_order` (
  `customer_id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  PRIMARY KEY (`customer_id`,`order_id`),
  KEY `c_create2` (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE IF NOT EXISTS `guests` (
  `g_id` int(30) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10001 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`g_id`) VALUES
(10000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(30) NOT NULL AUTO_INCREMENT,
  `invoice` int(30) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_summary` varchar(50) NOT NULL,
  `Status` varchar(15) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pm_edit`
--

CREATE TABLE IF NOT EXISTS `pm_edit` (
  `pm_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  PRIMARY KEY (`pm_id`,`product_id`),
  KEY `c_pm_edit2` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pm_edit`
--

INSERT INTO `pm_edit` (`pm_id`, `product_id`) VALUES
(2, 15),
(4, 15),
(6, 12),
(6, 16),
(10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pid` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `rating` varchar(30) NOT NULL,
  `price` int(30) NOT NULL,
  `info` varchar(100) NOT NULL,
  `category` varchar(30) NOT NULL,
  `image` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `rating`, `price`, `info`, `category`, `image`, `author`, `keywords`) VALUES
(0, 'da', '', 0, '', '', '', '', ''),
(2, 'Beyaz', '9', 60, 'The Lord of the Rings is an ep', 'Fiction', 'lord.jpg', 'J.R.R. Tolkien', 'Lord, Of, The, Rings, Tolkien, fiction'),
(11, 'hello', '9', 51, 'Bilbo Baggins, a hobbit, is pe', 'Fantasy', 'hobbit.jpg', 'J.R.R. Tolkien', 'hobbit, tolkien'),
(12, 'hello', '8.5', 152, 'Arguably the best Sci-Fi book ', 'Sci-Fi', 'cityof.jpg', 'Elizabeth Gilbert', 'city, girls, city of girls'),
(13, 'hello', '8.5', 32, 'Jean Valjean, a prisoner, brea', 'Drama', 'les.jpg', 'Victor Hugo', 'les, miserables, hugo, victor'),
(14, 'hello', '9', 12, 'After a pilot is forced to mak', 'Children', 'little.jpg', 'Antoine de Saint-Exupery', 'little, prince, antoine'),
(15, 'hello', '5', 16, 'Everything was perfect until i', 'Romance', 'succ.jpg', 'Gilda Sask', 'successful, marriage, glida, sask'),
(16, 'hello', '9', 42, 'The third book of the series G', 'Fiction', 'dance.jpg', 'George R.R. Martin', 'martin, george, dance, dragons'),
(18, 'sad', '7.4', 33, 'a wealthy bachelor starts livi', 'Romance', 'pride.jpg', 'Jane Austen', 'pride, prejudice, jane, austen'),
(43, 'das', '42', 222, 'das', 'das', 'as', 'ds', 'asd'),
(213, 'teh', '4', 321, 'no', 'no', 'no', 'no', 'no'),
(222, 'da', '', 0, '', '', '', '', ''),
(232, 'da', '', 0, 'sd', 'ads', 'da', 'ad', 'da'),
(321, 'teh lurd of thei reings', '10', 23232, 'the real hist', 'Reality', 'no', 'jr', 'no'),
(323, 'da', '', 0, '', '', '', '', ''),
(423, 'da', '', 553, 'da', 'da', 'ad', 'ad', 'ad'),
(543, 'da', '', 231, 'da', 'da', 'da', 'da', 'daa'),
(2121, 'Beyaz Dis', '', 213, 'info', 'Dram', 'null', 'Jack London', 'dog, love'),
(2132, 'new', '2', 23, 'sdsa', 'sa', 'sdsa', 'sda', 'sds'),
(2312, 'da', '', 213, 'da', 'da', 'da', 'da', 'da'),
(2321, 'adasda', '', 0, 'da', 'ad', 'da', 'd', 'ad'),
(2441, 'da', '', 41, 'as', 'da', 'ad', 'da', 'da'),
(5412, 'da', '', 0, 'da', 'da', 'da', 'a', 'sd'),
(21331, 'da', '', 23, 'sda', 'da', 'ad', 'ad', 'ad');

-- --------------------------------------------------------

--
-- Table structure for table `product_manager`
--

CREATE TABLE IF NOT EXISTS `product_manager` (
  `pm_id` int(30) NOT NULL,
  `pm_password` varchar(30) NOT NULL,
  `pm_username` varchar(30) NOT NULL,
  PRIMARY KEY (`pm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_manager`
--

INSERT INTO `product_manager` (`pm_id`, `pm_password`, `pm_username`) VALUES
(1, 'cs876', 'Arman Torikoglu'),
(2, '09dark', 'Beyza Cavusoglu'),
(3, 'cip101', 'Meltem Derelli'),
(4, 'hum241', 'Nurbanu Yilmaz'),
(5, '854654su', 'Ayse Sabuncu'),
(6, '615piano', 'Ezgi Tas'),
(7, 'v3e5r3a', 'Ali Uslu'),
(8, 'choco.la?te', 'Berk Gulak'),
(9, '23.91kljkjn', 'Arda Demir'),
(10, '5#coding', 'Esra Mutlu'),
(11, 'SutluKahve5', 'Mert Sutsuz'),
(12, 'Devrim878', 'Cengiz Turk'),
(13, 'ElekFur56', 'Furkan Elek'),
(14, 'SaglikliEce', 'Ece Saglik'),
(15, 'renksizHayat32', 'Fatma Renksiz'),
(111, 'asdasd', 'arman');

-- --------------------------------------------------------

--
-- Table structure for table `sales_manager`
--

CREATE TABLE IF NOT EXISTS `sales_manager` (
  `sm_id` int(30) NOT NULL,
  `sm_password` varchar(30) NOT NULL,
  `sm_username` varchar(30) NOT NULL,
  PRIMARY KEY (`sm_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_manager`
--

INSERT INTO `sales_manager` (`sm_id`, `sm_password`, `sm_username`) VALUES
(1, 'yavyav23', 'Orkun Yaver'),
(2, 'Yavag2', 'Yavuz Gaye'),
(3, 'Handan12', 'Murat Han'),
(4, 'Eysan3', 'Cansu Dere'),
(5, 'Sadakatsiz12', 'Asya Arslan'),
(6, 'bilHal34', 'Halit Bilginer'),
(7, 'intikam34', 'Ezel Onat'),
(8, 'dfhs34', 'Can Korkut'),
(9, 'karDer5', 'Derya Karaca'),
(10, 'MuhyuzY2983', 'Meryem Hunerli'),
(11, 'dusukbel12', 'Paris Hilton'),
(12, 'Toxic12', 'Britney Spears'),
(13, 'Hukukcuyuz12', 'Sena Yargi'),
(14, 'Platon12', 'Eflatun Mor'),
(15, 'Kemal21', 'Kemal Namuran'),
(1312, 'pass', 'ara');

-- --------------------------------------------------------

--
-- Table structure for table `user_rates`
--

CREATE TABLE IF NOT EXISTS `user_rates` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `u_id` (`u_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `customers` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `guests` (`g_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `basket_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bought_books`
--
ALTER TABLE `bought_books`
  ADD CONSTRAINT `bought_books_ibfk_2` FOREIGN KEY (`c_id`) REFERENCES `basket` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `p` FOREIGN KEY (`p_id`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cancel_purchase_of`
--
ALTER TABLE `cancel_purchase_of`
  ADD CONSTRAINT `cancel_purchase_of_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cstrr` FOREIGN KEY (`sm_id`) REFERENCES `sales_manager` (`sm_id`) ON DELETE CASCADE;

--
-- Constraints for table `change_status_of`
--
ALTER TABLE `change_status_of`
  ADD CONSTRAINT `cssacs` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `csssss` FOREIGN KEY (`sm_id`) REFERENCES `sales_manager` (`sm_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_comment_product`
--
ALTER TABLE `customer_comment_product`
  ADD CONSTRAINT `customer_comment_product_ibfk_1` FOREIGN KEY (`c_id`,`p_id`) REFERENCES `bought_books` (`c_id`, `p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_creates_order`
--
ALTER TABLE `customer_creates_order`
  ADD CONSTRAINT `cToC` FOREIGN KEY (`customer_id`) REFERENCES `basket` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cat` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `pm_edit`
--
ALTER TABLE `pm_edit`
  ADD CONSTRAINT `c_pm_edit2` FOREIGN KEY (`product_id`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cstr` FOREIGN KEY (`pm_id`) REFERENCES `product_manager` (`pm_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_rates`
--
ALTER TABLE `user_rates`
  ADD CONSTRAINT `user_rates_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `bought_books` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rates_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `bought_books` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

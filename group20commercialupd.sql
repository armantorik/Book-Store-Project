-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2021 at 01:18 PM
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
  KEY `book_id` (`book_id`),
  KEY `basket_ibfk_1` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`book_id`, `quantity`, `custProductId`, `user_id`) VALUES
(11, 1, 223, 10020),
(14, 1, 224, 10020);

-- --------------------------------------------------------

--
-- Table structure for table `bought_books_customer`
--

CREATE TABLE IF NOT EXISTS `bought_books_customer` (
  `c_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  PRIMARY KEY (`c_id`,`p_id`),
  KEY `p` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bought_books_customer`
--

INSERT INTO `bought_books_customer` (`c_id`, `p_id`) VALUES
(2138, 14),
(2138, 18),
(10018, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bought_books_guest`
--

CREATE TABLE IF NOT EXISTS `bought_books_guest` (
  `g_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bought_books_guest`
--

INSERT INTO `bought_books_guest` (`g_id`, `p_id`) VALUES
(10018, 2),
(10018, 14),
(10014, 2),
(10014, 13),
(10019, 11),
(10019, 14),
(10020, 2),
(10020, 13);

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
) ENGINE=InnoDB AUTO_INCREMENT=2139 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_password`, `c_name`, `c_phone`, `c_mail`, `c_address`) VALUES
(2137, 'newPASS', 'armn', '23123', 'armn@gmail.com', 'ist'),
(2138, 'arman', 'arman', '21023120', 'arman@gmail.com', 'ist');

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

--
-- Dumping data for table `customer_comment_product`
--

INSERT INTO `customer_comment_product` (`c_id`, `p_id`, `comment`) VALUES
(10018, 2, 'dsdsadsd');

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
  `ip` varchar(20) NOT NULL,
  `ip2` varchar(11) NOT NULL,
  `ip3` varchar(11) NOT NULL,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10023 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`g_id`, `ip`, `ip2`, `ip3`) VALUES
(10017, '', '', ''),
(10018, '', '', ''),
(10019, '', '', ''),
(10020, '', '', ''),
(10021, '', '', ''),
(10022, '', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=208 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `invoice`, `customer_id`, `invoice_summary`, `Status`) VALUES
(197, 33, 2138, 'sad/', 'Delivered'),
(200, 12, 2138, 'hello/', 'In Progress'),
(201, 60, 10018, 'Beyaz/', 'In Progress'),
(202, 60, 10018, 'Beyaz/', 'In Progress'),
(203, 60, 10018, 'Beyaz/', 'In Progress'),
(204, 12, 10018, 'hello/', 'In Progress'),
(205, 92, 10014, 'Beyaz/hello/', 'In Progress'),
(206, 63, 10019, 'hello/hello/', 'In Progress'),
(207, 212, 10020, 'Siyah/hello/', 'In Progress');

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
(2, 'Siyah', '9', 60, 'The Lord of the Rings is an ep', 'Fiction', 'lord.jpg', 'J.R.R. Tolkien', 'Lord, Of, The, Rings, Tolkien, fiction'),
(11, 'hello', '9', 51, 'Bilbo Baggins, a hobbit, is pe', 'Fantasy', 'hobbit.jpg', 'J.R.R. Tolkien', 'hobbit, tolkien'),
(12, 'hello', '8.5', 152, 'Arguably the best Sci-Fi book ', 'Sci-Fi', 'cityof.jpg', 'Elizabeth Gilbert', 'city, girls, city of girls'),
(13, 'hello', '8.5', 32, 'Jean Valjean, a prisoner, brea', 'Drama', 'les.jpg', 'Victor Hugo', 'les, miserables, hugo, victor'),
(14, 'hello', '9', 12, 'After a pilot is forced to mak', 'Children', 'little.jpg', 'Antoine de Saint-Exupery', 'little, prince, antoine'),
(15, 'hello', '5', 16, 'Everything was perfect until i', 'Romance', 'succ.jpg', 'Gilda Sask', 'successful, marriage, glida, sask'),
(16, 'hello', '9', 42, 'The third book of the series G', 'Fiction', 'dance.jpg', 'George R.R. Martin', 'martin, george, dance, dragons'),
(18, 'sad', '7.4', 33, 'a wealthy bachelor starts livi', 'Romance', 'pride.jpg', 'Jane Austen', 'pride, prejudice, jane, austen');

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rates`
--

INSERT INTO `user_rates` (`r_id`, `u_id`, `rating`, `p_id`) VALUES
(28, 10018, 2, 14);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket`
--
ALTER TABLE `basket`
  ADD CONSTRAINT `basket_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bought_books_customer`
--
ALTER TABLE `bought_books_customer`
  ADD CONSTRAINT `p` FOREIGN KEY (`p_id`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_comment_product`
--
ALTER TABLE `customer_comment_product`
  ADD CONSTRAINT `customer_comment_product_ibfk_1` FOREIGN KEY (`c_id`,`p_id`) REFERENCES `bought_books_customer` (`c_id`, `p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_creates_order`
--
ALTER TABLE `customer_creates_order`
  ADD CONSTRAINT `cToC` FOREIGN KEY (`customer_id`) REFERENCES `basket` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cat` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);

--
-- Constraints for table `user_rates`
--
ALTER TABLE `user_rates`
  ADD CONSTRAINT `user_rates_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `bought_books_customer` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_rates_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `bought_books_customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

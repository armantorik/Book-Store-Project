-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2021 at 10:05 AM
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
  `customer_mail` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`book_id`, `quantity`, `customer_mail`) VALUES
(10, 0, ''),
(1, 0, 'kaya@gmail.com'),
(10, 0, 'ibrahim@gmail.com'),
(1, 0, 'ibrahim@gmail.com'),
(1, 0, 'aritortor@gmail.com'),
(5, 0, 'aritortor@gmail.com'),
(1, 0, 'yeni@gmail.com'),
(5, 0, 'yeni@gmail.com'),
(1, 0, 'newIbra@gmail.com'),
(5, 0, 'newIbra@gmail.com'),
(5, 0, 'newmail@gmail.com'),
(10, 0, 'newmail@gmail.com'),
(1, 0, 'newKaya@gmail.com'),
(5, 0, 'newKaya@gmail.com'),
(1, 0, 'kaya@gmail.com'),
(5, 0, 'kaya@gmail.com'),
(10, 0, '29'),
(13, 0, '29'),
(5, 0, '30'),
(11, 0, '31'),
(2, 0, '30');

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

--
-- Dumping data for table `cancel_purchase_of`
--

INSERT INTO `cancel_purchase_of` (`sm_id`, `order_id`) VALUES
(1, 2),
(2, 6),
(3, 1),
(3, 6),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(5, 7),
(6, 2),
(7, 7),
(8, 4),
(9, 8),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`name`) VALUES
('Drama'),
('Horror'),
('Science-Fiction');

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

--
-- Dumping data for table `change_status_of`
--

INSERT INTO `change_status_of` (`sm_id`, `order_id`) VALUES
(1, 2),
(2, 3),
(2, 7),
(3, 4),
(3, 6),
(4, 5),
(5, 4),
(6, 2),
(7, 7),
(8, 3),
(8, 4),
(9, 8),
(10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `c_id` int(30) NOT NULL AUTO_INCREMENT,
  `c_password` varchar(30) NOT NULL,
  `c_name` varchar(30) NOT NULL,
  `c_mail` varchar(50) NOT NULL,
  `c_phone` varchar(200) NOT NULL,
  `c_address` varchar(50) NOT NULL,
  PRIMARY KEY (`c_id`,`c_mail`),
  UNIQUE KEY `c_id` (`c_id`),
  UNIQUE KEY `c_id_2` (`c_id`,`c_address`),
  UNIQUE KEY `c_id_3` (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2136 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`c_id`, `c_password`, `c_name`, `c_mail`, `c_phone`, `c_address`) VALUES
(1, 'sifrene', 'Kaya', 'newKaya@gmail.com', '05324567891', 'kocaeli'),
(2, 'se7en', 'ali', 'yeni@gmail.com', '05324567665', 'nigde'),
(3, 'tree3', 'David Baker', 'baker@gmail.com', '05374567891', 'gumushane'),
(4, 'f81ile', 'Ahmet Akyol', 'ahmet@gmail.com', '05494567891', 'ankara'),
(5, 'gjltmg564', ' Melisa Kucuk', 'melisa@gmail.com', '05388767891', 'cankiri'),
(6, 'cs306', 'Su Kaplan', 'kaplan@gmail.com', '05324588904', 'kayseri'),
(7, 'sps303', 'Cengiz Gurbuz', 'gurbuz@gmail.com', '05324324691', 'malatya'),
(8, 'biktim87', 'Hilal Kadi', 'hilal@gmail.com', '05224567891', 'eskisehir'),
(9, 'phpmyadminsql', 'Bal Kaymak', 'kaymak@gmail.com', '05067567891', 'izmir'),
(10, 'blue32', 'Mavi Sahin', 'muhabbetkusumavis@gmail.com', '05327783891', 'istanbul'),
(11, 'mackac23', 'Cemal Topsoz', 'cemal@gmail.com', '05332543678', 'Van'),
(12, 'DonmemAsla12', 'Gaye Donmez', 'gaye@gmail.com', '05543216788', 'Rize'),
(13, 'Melunal22', 'Melis Unal', 'melis@gmail.com', '05328965431', 'Ordu'),
(14, 'toktok12', 'Cemil Tok', 'cemil@gmail.com', '05346789100', 'Samsun'),
(21, 'sasda', 'adas', 'adsa', 'adsa', 'sadas'),
(123, '23', 'saea', 'asda', 'sadas', 'adaa'),
(222, 'ada', 'sadas', 'asdas', 'asdsas', 'asdsa'),
(323, 'seas', 'sda', 'asd', 'asda', 'asd'),
(444, '21321', 'adas', 'asda', 'asdas', 'adsa'),
(2131, 'asdas', 'ada', 'sad', 'dasda', 'asdsa'),
(2132, 'asdsad', 'asdsada', 'sadasd@hotmail.com', '21321321', 'asda'),
(2133, 'ibraGod', 'Ibrahim', 'newmail@gmail.com', '02120010100', 'Stokholm'),
(2135, 'itsu', 'no anonim', 'anonim@gmail.com', '023132213', 'ist');

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
  KEY `comment` (`comment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_comment_product`
--

INSERT INTO `customer_comment_product` (`c_id`, `p_id`, `comment`) VALUES
(2, 8, 'cliche'),
(6, 15, 'cliche'),
(2, 12, 'great'),
(10, 1, 'great'),
(8, 10, 'i miss going to my campus'),
(1, 12, 'romantic'),
(10, 8, 'romantic'),
(6, 1, 'sad'),
(6, 3, 'sad'),
(10, 3, 'sad'),
(1, 2, 'stunning'),
(3, 9, 'the future is female!'),
(7, 9, 'the future is female!');

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

--
-- Dumping data for table `customer_creates_order`
--

INSERT INTO `customer_creates_order` (`customer_id`, `order_id`) VALUES
(2, 7),
(3, 10),
(4, 4),
(4, 9),
(5, 5),
(6, 3),
(6, 5),
(6, 8),
(7, 4),
(7, 9),
(8, 1),
(9, 6),
(10, 1),
(10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE IF NOT EXISTS `guests` (
  `g_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`g_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`g_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(30) NOT NULL,
  `invoice` varchar(30) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `invoice`) VALUES
(1, '15.75tl'),
(2, '36.46tl'),
(3, '102tl'),
(4, '67.75tl'),
(5, '96.85tl'),
(6, '20.40tl'),
(7, '43.50tl'),
(8, '130.25tl'),
(9, '84.75tl'),
(10, '215tl'),
(11, '11.98tl'),
(12, '77.68tl'),
(13, '34.12tl'),
(14, '45.98tl'),
(15, '32.76tl');

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
(1, 8),
(2, 1),
(2, 8),
(2, 15),
(3, 3),
(4, 8),
(4, 15),
(6, 3),
(6, 8),
(6, 12),
(6, 16),
(8, 8),
(9, 3),
(9, 5),
(10, 16);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `pid` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `rating` varchar(30) NOT NULL,
  `price` varchar(30) NOT NULL,
  `info` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `image` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`),
  UNIQUE KEY `comment` (`comment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `name`, `rating`, `price`, `info`, `category`, `comment`, `image`, `author`, `keywords`) VALUES
(1, '1984', '8', '35', 'Dystopian social science ficti', 'Dystopia', 'great', '1984.jpg', 'George Orwell', '1984 , Dystopia, George, Orwell'),
(2, 'The Lord Of The Rings', '9', '60', 'The Lord of the Rings is an ep', 'Fiction', 'I can feel his gaze watching me even after finishing the book', 'lord.jpg', 'J.R.R. Tolkien', 'Lord, Of, The, Rings, Tolkien, fiction'),
(3, 'The Mad Science Book', '5', '22', 'A book about the academic life', 'Educational', 'i miss going to my campus', 'themad.jpg', 'Retu U. Schneider', 'Mad, Science, Book, retu, schneider'),
(5, 'Introduction to Linear Algebra', '9', '422', 'A must, for CS students', 'Science', 'boring but educational', 'introlinear.jpg', 'Frank M. Stewart', 'Introduction, Linear, Algebra, frank, stewart, science'),
(8, 'The Names They Gave Us', '8', '72', 'Adventures of Batman and his a', 'Comics', 'perfect duo', 'thenames.jpg', 'Emery Lord', 'Names, They, Gave, Us, emery, lord, batman'),
(9, 'The rise of Wonder Woman', '6', '62', 'talks about superhero', 'Comics', 'the future is female!', 'alch.jpg', 'Paulo Coelho', 'rise, Wonder, Woman, superhero, paulo, coelho'),
(10, 'The Woman in the Window', '9.2', '22', 'A fierce battle between 3 oppo', 'Western', 'cliche', 'thewoman.jpg', 'A. J. Finn', 'Woman, Window, finn'),
(11, 'The Hobbit', '9', '50.98', 'Bilbo Baggins, a hobbit, is pe', 'Fantasy', 'Fantastic!', 'hobbit.jpg', 'J.R.R. Tolkien', 'hobbit, tolkien'),
(12, 'City of Girls', '8.5', '152', 'Arguably the best Sci-Fi book ', 'Sci-Fi', 'stunning', 'cityof.jpg', 'Elizabeth Gilbert', 'city, girls, city of girls'),
(13, 'Les miserables', '8.5', '32', 'Jean Valjean, a prisoner, brea', 'Drama', 'Left me speechless', 'les.jpg', 'Victor Hugo', 'les, miserables, hugo, victor'),
(14, 'Little Prince', '9', '12', 'After a pilot is forced to mak', 'Children', 'A must for every age.', 'little.jpg', 'Antoine de Saint-Exupery', 'little, prince, antoine'),
(15, 'Successful Marriage', '5', '16', 'Everything was perfect until i', 'Romance', 'romantic', 'succ.jpg', 'Gilda Sask', 'successful, marriage, glida, sask'),
(16, 'A Dance with Dragons', '9', '42', 'The third book of the series G', 'Fiction', 'sad', 'dance.jpg', 'George R.R. Martin', 'martin, george, dance, dragons'),
(18, 'Pride and Prejudice ', '7.4', '33', 'a wealthy bachelor starts livi', 'Romance', 'Life changing', 'pride.jpg', 'Jane Austen', 'pride, prejudice, jane, austen');

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

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cancel_purchase_of`
--
ALTER TABLE `cancel_purchase_of`
  ADD CONSTRAINT `cancel_purchase_of_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `cstrr` FOREIGN KEY (`sm_id`) REFERENCES `sales_manager` (`sm_id`) ON DELETE CASCADE;

--
-- Constraints for table `change_status_of`
--
ALTER TABLE `change_status_of`
  ADD CONSTRAINT `change_status_of_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `csssss` FOREIGN KEY (`sm_id`) REFERENCES `sales_manager` (`sm_id`) ON DELETE CASCADE;

--
-- Constraints for table `customer_comment_product`
--
ALTER TABLE `customer_comment_product`
  ADD CONSTRAINT `cc` FOREIGN KEY (`p_id`) REFERENCES `products` (`pid`) ON DELETE CASCADE,
  ADD CONSTRAINT `com` FOREIGN KEY (`comment`) REFERENCES `products` (`comment`) ON DELETE CASCADE;

--
-- Constraints for table `customer_creates_order`
--
ALTER TABLE `customer_creates_order`
  ADD CONSTRAINT `c_create2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `pm_edit`
--
ALTER TABLE `pm_edit`
  ADD CONSTRAINT `c_pm_edit2` FOREIGN KEY (`product_id`) REFERENCES `products` (`pid`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `cstr` FOREIGN KEY (`pm_id`) REFERENCES `product_manager` (`pm_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

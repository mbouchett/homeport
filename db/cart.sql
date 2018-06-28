-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2018 at 10:10 PM
-- Server version: 5.6.39
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homeport_2018`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_ID` int(7) NOT NULL,
  `cart_date` text CHARACTER SET utf8 NOT NULL,
  `customer` int(7) NOT NULL,
  `regnum` int(8) DEFAULT NULL,
  `ip` text CHARACTER SET utf8 NOT NULL,
  `item_ID` int(8) NOT NULL,
  `cart_retail` text CHARACTER SET utf8 NOT NULL,
  `cart_qty` int(3) NOT NULL,
  `cart_purch_date` text CHARACTER SET utf8
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_ID`, `cart_date`, `customer`, `regnum`, `ip`, `item_ID`, `cart_retail`, `cart_qty`, `cart_purch_date`) VALUES
(7589, '2018-06-20', 2856, 286, '173.179.2.126', 14527, '59.99', 1, '2018-06-20'),
(7588, '2018-06-20', 2856, 286, '173.179.2.126', 50573, '14.99', 1, '2018-06-20'),
(7587, '2018-06-20', 2856, 286, '173.179.2.126', 45266, '9.99', 1, '2018-06-20'),
(7619, '2018-06-26', 36581, 300, '66.61.102.100', 9388, '89.99', 1, '2018-06-26'),
(7578, '2018-06-19', 14162, 300, '209.6.151.38', 51118, '14.99', 1, '2018-06-19'),
(7577, '2018-06-19', 14162, 300, '209.6.151.38', 40209, '84.99', 1, '2018-06-19'),
(7574, '2018-06-19', 12786, NULL, '209.61.160.96', 54003, '3.99', 1, '2018-06-19'),
(7573, '2018-06-18', 12147, NULL, '209.61.160.96', 17976, '10.99', 1, '2018-06-18'),
(7570, '2018-06-18', 10281, NULL, '209.61.160.96', 44958, '35.99', 1, '2018-06-18'),
(7598, '2018-06-23', 22347, 283, '104.162.170.50', 45647, '23.99', 1, '2018-06-23'),
(7617, '2018-06-25', 2877, 306, '65.183.135.36', 37100, '24.99', 1, '2018-06-25'),
(7615, '2018-06-25', 2877, 306, '65.183.135.36', 41219, '11.99', 4, '2018-06-25'),
(7616, '2018-06-25', 2877, 306, '65.183.135.36', 36789, '8.99', 1, '2018-06-25'),
(7614, '2018-06-25', 2877, 306, '65.183.135.36', 52429, '21.99', 1, '2018-06-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7622;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

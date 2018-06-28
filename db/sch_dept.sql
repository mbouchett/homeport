-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 28, 2018 at 10:18 AM
-- Server version: 5.7.22-0ubuntu18.04.1
-- PHP Version: 7.2.5-0ubuntu0.18.04.1

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
-- Table structure for table `sch_dept`
--

CREATE TABLE `sch_dept` (
  `sch_dept_ID` int(11) NOT NULL,
  `sch_dept_name` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `sch_dept_abbv` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `sch_dept_color` tinytext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sch_dept`
--

INSERT INTO `sch_dept` (`sch_dept_ID`, `sch_dept_name`, `sch_dept_abbv`, `sch_dept_color`) VALUES
(1, 'First Floor', '1st', 'ffdb28'),
(2, 'Second Floor', '2nd', '18aaff'),
(3, 'CVR', 'CVR', 'FF0000'),
(4, 'Basement', 'HLD', '1bc448'),
(5, 'Mezzanine', 'MZZ', 'f765f0'),
(6, 'Non-Office', 'NOF', '888888'),
(7, 'Not Scheduled', 'OFF', 'FFFFFF'),
(8, 'Vacation', 'VCA', '000000'),
(9, 'Warehouse', 'WHS', '897053');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sch_dept`
--
ALTER TABLE `sch_dept`
  ADD PRIMARY KEY (`sch_dept_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sch_dept`
--
ALTER TABLE `sch_dept`
  MODIFY `sch_dept_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

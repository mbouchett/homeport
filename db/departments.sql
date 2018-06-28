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
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `dept_ID` int(7) NOT NULL,
  `dept_name` text NOT NULL,
  `oldDep` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `dept_belongs_to` int(11) NOT NULL,
  `area_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`dept_ID`, `dept_name`, `oldDep`, `dept_belongs_to`, `area_ID`) VALUES
(1, 'Shelving', '\0\0\00\0\0\01', 1, 3),
(2, 'Organization', '\0\0\00\0\0\02', 2, 3),
(3, 'Office Furniture', '\0\0\00\0\0\03', 3, 3),
(4, 'Household', '\0\0\00\0\0\04', 4, 3),
(5, 'Miscellaneous Lower Level', '\0\0\00\0\0\05', 5, 3),
(6, 'Stationary', '\0\0\00\0\0\06', 6, 1),
(7, 'Kitchen Storage', '\0\0\00\0\0\07', 7, 1),
(8, 'Kitchen Prep', '\0\0\00\0\0\08', 8, 1),
(9, 'Table Top', '\0\0\00\0\0\09', 9, 1),
(10, 'Garden', '\0\0\01\0\0\00', 10, 1),
(11, 'Candles', '\0\0\01\0\0\01', 11, 4),
(12, 'Personal Care', '\0\0\01\0\0\02', 12, 4),
(13, 'Zen', '\0\0\01\0\0\03', 13, 4),
(14, 'Bath Decor', '\0\0\01\0\0\04', 14, 4),
(16, 'Furniture Accents', '\0\0\01\0\0\06', 16, 2),
(17, 'Rugs', '\0\0\01\0\0\07', 17, 2),
(18, 'Pillows', '\0\0\01\0\0\08', 18, 2),
(19, 'Outdoor Tropical Furniture', '\0\0\01\0\0\09', 19, 2),
(20, 'Decorative Accessories', '\0\0\02\0\0\00', 20, 2),
(21, 'Kitchen Accessories', '\0\0\02\0\0\01', 21, 1),
(22, 'Gift Cards', '\0\0\02\0\0\02', 22, 1),
(23, 'Seasonal Items', '\0\0\02\0\0\03', 23, 1),
(24, 'Dining Furniture & Carts', '\0\0\02\0\0\04', 24, 1),
(25, 'Toys', '\0\0\02\0\0\05', 25, 2),
(26, 'Lamps & Lighting', '\0\0\02\0\0\06', 26, 2),
(27, 'Window Coverings', '\0\0\02\0\0\07', 27, 2),
(28, 'Furniture Upholstered', '\0\0\02\0\0\08', 28, 2),
(29, 'Greeting Cards', '\0\0\02\0\0\09', 29, 1),
(30, 'Kitchen Electrics', '\0\0\03\0\0\00', 30, 1),
(31, 'Bedding', '\0\0\03\0\0\01', 31, 2),
(32, 'Cook and Bakeware', '\0\0\03\0\0\02', 32, 1),
(33, 'Kitchen Service', '\0\0\03\0\0\03', 33, 1),
(34, 'Knives', '\0\0\03\0\0\04', 34, 1),
(36, 'Vermont Items', '\0\0\05\0\0\03', 36, 1),
(45, 'Personal Accessories', NULL, 45, 4),
(44, 'Bathroom Hardware', NULL, 44, 4),
(43, 'Room Fresheners', NULL, 43, 4),
(42, 'Bath Accessories', NULL, 42, 4),
(41, 'Candle Holders', NULL, 41, 4),
(61, 'Travel Accessories', '\0\0\00\0\0\05\0\0\0t', 5, 3),
(62, 'Food', NULL, 62, 1),
(63, 'Candy', '\0\0\00\0\0\06\0\0\0c', 62, 1),
(64, 'Gift Bags', '\0\0\00\0\0\06\0\0\0g', 6, 1),
(65, 'Journals & Notebooks', '\0\0\00\0\0\06\0\0\0j', 6, 1),
(66, 'Wall Clocks', '\0\0\00\0\0\06\0\0\0l', 6, 1),
(67, 'Metal Signs', '\0\0\00\0\0\06\0\0\0s', 20, 1),
(15, 'Beaded Curtains', '\0\0\01\0\0\05', 15, 4),
(68, 'Coloring Books', '\0\0\00\0\0\06\0\0\0x', 6, 1),
(69, 'Drink Dispensers', '\0\0\00\0\0\07\0\0\0d', 33, 1),
(70, 'Glass Food Storage & Jars', '\0\0\00\0\0\07\0\0\0j', 7, 1),
(71, 'Plastic Food Storage', '\0\0\00\0\0\07\0\0\0p', 7, 1),
(72, 'Spice Jars & Racks', '\0\0\00\0\0\07\0\0\0r', 7, 1),
(73, 'Bottles', '\0\0\00\0\0\07\0\0\0s', 7, 1),
(74, 'Baking Accessories', '\0\0\00\0\0\08\0\0\0a', 8, 1),
(75, 'Barbeque', '\0\0\00\0\0\08\0\0\0b', 8, 1),
(76, 'Cutting Boards', '\0\0\00\0\0\08\0\0\0e', 8, 1),
(77, 'Kitchen Gadgets', '\0\0\00\0\0\08\0\0\0g', 8, 1),
(78, 'Sauces', '\0\0\00\0\0\08\0\0\0H', 62, 1),
(79, 'Measuring Devices', '\0\0\00\0\0\08\0\0\0m', 8, 1),
(80, 'Kitchen Utensils', '\0\0\00\0\0\08\0\0\0u', 8, 1),
(81, 'Serving Accessories', '\0\0\00\0\0\08\0\0\0z', 33, 1),
(82, 'Asian Dinnerware', '\0\0\00\0\0\09\0\0\0a', 9, 1),
(83, 'Barware', '\0\0\00\0\0\09\0\0\0b', 9, 1),
(84, 'Coasters', '\0\0\00\0\0\09\0\0\0c', 9, 1),
(85, 'Dinnerware', '\0\0\00\0\0\09\0\0\0d', 9, 1),
(86, 'Flatware', '\0\0\00\0\0\09\0\0\0f', 9, 1),
(87, 'Glassware', '\0\0\00\0\0\09\0\0\0g', 9, 1),
(88, 'Table Linens', '\0\0\00\0\0\09\0\0\0l', 9, 1),
(89, 'Mugs', '\0\0\00\0\0\09\0\0\0m', 9, 1),
(90, 'Outdoor Entertaining', '\0\0\00\0\0\09\0\0\0o', 9, 1),
(91, 'Pitchers', '\0\0\00\0\0\09\0\0\0p', 9, 1),
(92, 'Ramekins', '\0\0\00\0\0\09\0\0\0r', 9, 1),
(94, 'Travel Mugs & Sports Bottles', '\0\0\00\0\0\09\0\0\0t', 9, 1),
(95, 'Wine Racks', '\0\0\00\0\0\09\0\0\0w', 9, 1),
(96, 'Live Bamboo', '\0\0\01\0\0\00\0\0\0b', 10, 1),
(97, 'Hammocks', '\0\0\01\0\0\00\0\0\0h', 10, 1),
(98, 'Garden Lights', '\0\0\01\0\0\00\0\0\0l', 10, 1),
(99, 'Flower Pots', '\0\0\01\0\0\00\0\0\0p', 10, 1),
(100, 'Windchimes Outdoor', '\0\0\01\0\0\00\0\0\0w', 10, 1),
(101, 'Candle Holders', '\0\0\01\0\0\01\0\0\0h', 11, 4),
(102, 'Body Care', '\0\0\01\0\0\02\0\0\0b', 12, 4),
(103, 'Incense & Oils', '\0\0\01\0\0\03\0\0\0i', 13, 4),
(227, 'Seasonal Candle Holders', NULL, 41, 4),
(106, 'Shower Curtains', '\0\0\01\0\0\04\0\0\0s', 14, 4),
(107, 'Beaded Curtains', '\0\0\01\0\0\05\0\0\0b', 15, 4),
(108, 'Jewelry Accessories & Charms', '\0\0\01\0\0\05\0\0\0j', 15, 4),
(109, 'Scarves', '\0\0\01\0\0\05\0\0\0s', 15, 4),
(110, 'Bar Stools', '\0\0\01\0\0\06\0\0\0b', 16, 2),
(111, 'Dining Furniture Top Floor', '\0\0\01\0\0\06\0\0\0d', 16, 2),
(112, 'Furniture Hardware & Accessories', '\0\0\01\0\0\06\0\0\0f\0\0\0h\0\0\0w', 16, 2),
(114, 'Poufs', '\0\0\01\0\0\06\0\0\0p', 16, 2),
(115, 'Floor Screens & Room Dividers', '\0\0\01\0\0\06\0\0\0s', 16, 2),
(116, 'Doormats', '\0\0\01\0\0\07\0\0\0d', 17, 2),
(117, 'Outdoor Rugs', '\0\0\01\0\0\07\0\0\0o', 17, 2),
(118, 'Rug Pads', '\0\0\01\0\0\07\0\0\0p', 17, 2),
(119, 'Chair Cushions', '\0\0\01\0\0\08\0\0\0c', 18, 2),
(120, 'Rocking Chair Cushions', '\0\0\01\0\0\08\0\0\0r', 18, 2),
(121, 'Decorative Balls', '\0\0\02\0\0\00\0\0\0b\0\0\0l\0\0\0l', 20, 2),
(122, 'Decorative Boxes', '\0\0\02\0\0\00\0\0\0b\0\0\0x', 20, 2),
(123, 'Frames', '\0\0\02\0\0\00\0\0\0f', 50, 2),
(124, 'Dried Grasses', '\0\0\02\0\0\00\0\0\0g', 20, 2),
(125, 'Wall Mirrors', '\0\0\02\0\0\00\0\0\0m', 20, 2),
(127, 'Vases', '\0\0\02\0\0\00\0\0\0v', 20, 2),
(128, 'Canvas Art', '\0\0\02\0\0\00\0\0\0w', 50, 2),
(129, 'Wind Chimes Wooden and Capiz', '\0\0\02\0\0\00\0\0\0w\0\0\0c', 20, 2),
(130, 'Aprons', '\0\0\02\0\0\01\0\0\0a', 21, 1),
(131, 'Pet Supplies', '\0\0\02\0\0\01\0\0\0p', 51, 1),
(132, 'Christmas Decor', '\0\0\02\0\0\03\0\0\0c', 23, 1),
(133, 'Easter', '\0\0\02\0\0\03\0\0\0e', 23, 1),
(135, 'Halloween', '\0\0\02\0\0\03\0\0\0h', 53, 1),
(136, 'Holiday Crackers', '\0\0\02\0\0\03\0\0\0k', 23, 1),
(137, 'Holiday Lights', '\0\0\02\0\0\03\0\0\0l', 23, 1),
(138, 'Ornaments', '\0\0\02\0\0\03\0\0\0o', 23, 1),
(139, 'Christmas Table Top', '\0\0\02\0\0\03\0\0\0t', 23, 1),
(144, 'Toys Fun Stuff', '\0\0\02\0\0\05\0\0\0d', 25, 2),
(141, 'Toys Bath', '\0\0\02\0\0\05\0\0\0b', 25, 2),
(142, 'Toys Puzzles & Brainteasers ', '\0\0\02\0\0\05\0\0\0b\0\0\0t', 25, 2),
(143, 'Toys Arts & Crafts', '\0\0\02\0\0\05\0\0\0c', 25, 2),
(145, 'Kids Furniture', '\0\0\02\0\0\05\0\0\0f', 25, 2),
(146, 'Toys Games', '\0\0\02\0\0\05\0\0\0g', 25, 2),
(147, 'Toys Musical ', '\0\0\02\0\0\05\0\0\0m', 25, 2),
(148, 'Toys Novelty', '\0\0\02\0\0\05\0\0\0n', 25, 2),
(149, 'Toys Nostalgig & Classic', '\0\0\02\0\0\05\0\0\0n\0\0\0s', 25, 2),
(150, 'Toys Outdoor', '\0\0\02\0\0\05\0\0\0o', 25, 2),
(151, 'Toys Pretend Play', '\0\0\02\0\0\05\0\0\0p\0\0\0p', 25, 2),
(152, 'Toys Puppets', '\0\0\02\0\0\05\0\0\0p\0\0\0u', 25, 2),
(153, 'Toys Science ', '\0\0\02\0\0\05\0\0\0s', 25, 2),
(154, 'Toys Stuffed Animals', '\0\0\02\0\0\05\0\0\0s\0\0\0a', 25, 2),
(155, 'Toys Toddler & Infant', '\0\0\02\0\0\05\0\0\0t', 25, 2),
(156, 'Toys Vehicles', '\0\0\02\0\0\05\0\0\0v', 25, 2),
(157, 'Toys Wind Up', '\0\0\02\0\0\05\0\0\0w', 25, 2),
(158, 'Toys Winter Fun', '\0\0\02\0\0\05\0\0\0w\0\0\0i', 25, 2),
(159, 'Upholstered Chairs', '\0\0\02\0\0\08\0\0\0c', 28, 2),
(160, 'Upholstered Ottomans', '\0\0\02\0\0\08\0\0\0o', 28, 2),
(161, 'Upholstered Sofas', '\0\0\02\0\0\08\0\0\0s', 28, 2),
(162, 'Anniversary Cards', '\0\0\02\0\0\09\0\0\0a', 29, 1),
(163, 'Birthday Cards', '\0\0\02\0\0\09\0\0\0b', 29, 1),
(164, 'Christmas Cards', '\0\0\02\0\0\09\0\0\0c', 36, 1),
(165, 'Get Well Cards', '\0\0\02\0\0\09\0\0\0g', 29, 1),
(166, 'Holiday Cards', '\0\0\02\0\0\09\0\0\0h', 36, 1),
(167, 'Life Moment Cards', '\0\0\02\0\0\09\0\0\0l', 29, 1),
(168, 'Any Occasion Cards', '\0\0\02\0\0\09\0\0\0o', 29, 1),
(169, 'Sympathy Cards', '\0\0\02\0\0\09\0\0\0s', 29, 1),
(170, 'Thank You Cards', '\0\0\02\0\0\09\0\0\0t', 29, 1),
(171, 'Vermont Cards', '\0\0\02\0\0\09\0\0\0v', 29, 1),
(172, 'Wedding Cards', '\0\0\02\0\0\09\0\0\0w', 29, 1),
(173, 'Boxed Cards', '\0\0\02\0\0\09\0\0\0x', 29, 1),
(174, 'Baby Cards', '\0\0\02\0\0\09\0\0\0y', 29, 1),
(175, 'Blenders', '\0\0\03\0\0\00\0\0\0b', 30, 1),
(176, 'Coffee Makers', '\0\0\03\0\0\00\0\0\0c', 30, 1),
(177, 'Food Processors', '\0\0\03\0\0\00\0\0\0f', 30, 1),
(178, 'Coffee Grinders', '\0\0\03\0\0\00\0\0\0g', 30, 1),
(179, 'Electric Juicers', '\0\0\03\0\0\00\0\0\0j', 30, 1),
(180, 'Electric Kettles', '\0\0\03\0\0\00\0\0\0k', 30, 1),
(181, 'Electric Milk Frothers', '\0\0\03\0\0\00\0\0\0m', 30, 1),
(182, 'Popcorn Makers', '\0\0\03\0\0\00\0\0\0p', 30, 1),
(183, 'Electric Sandwich Presses', '\0\0\03\0\0\00\0\0\0s', 30, 1),
(184, 'Toasters', '\0\0\03\0\0\00\0\0\0t', 30, 1),
(185, 'Waffle Makers', '\0\0\03\0\0\00\0\0\0w', 30, 1),
(186, 'Throw Blankets', '\0\0\03\0\0\01\0\0\0b', 31, 2),
(188, 'Tapestries', '\0\0\03\0\0\01\0\0\0t', 31, 2),
(189, 'Salad Bowls', '\0\0\03\0\0\03\0\0\0a', 33, 1),
(190, 'Butter Dishes', '\0\0\03\0\0\03\0\0\0b', 33, 1),
(191, 'Coffee', '\0\0\03\0\0\03\0\0\0c', 33, 1),
(192, 'Hot Sauces', '\0\0\03\0\0\03\0\0\0h', 62, 1),
(193, 'Ice Trays & Ice Cream Accessories', '\0\0\03\0\0\03\0\0\0i', 9, 1),
(194, 'Mortar & Pestle', '\0\0\03\0\0\03\0\0\0m', 8, 1),
(195, 'Cruets & Dressing Bottles', '\0\0\03\0\0\03\0\0\0o', 33, 1),
(196, 'Salt & Pepper Shakers & Mills', '\0\0\03\0\0\03\0\0\0p', 33, 1),
(197, 'Serving Trays', '\0\0\03\0\0\03\0\0\0s', 33, 1),
(198, 'Tea', '\0\0\03\0\0\03\0\0\0t', 33, 1),
(202, 'Bookshelves', NULL, 1, 3),
(51, 'Pets', NULL, 51, 1),
(226, 'Seasonal Candles', NULL, 11, 4),
(203, 'Single Shelves', NULL, 1, 3),
(204, 'Storage Baskets', NULL, 2, 3),
(205, 'Waste Baskets', NULL, 2, 3),
(206, 'Hooks', NULL, 2, 3),
(207, 'Jewelry Organizers', NULL, 2, 3),
(208, 'Kitchen Organizers', NULL, 2, 3),
(209, 'Home Office', NULL, 2, 3),
(210, 'Armoires', NULL, 3, 3),
(211, 'Desk Chairs', NULL, 3, 3),
(212, 'Desks', NULL, 3, 3),
(214, 'Cleaning', NULL, 4, 3),
(215, 'Dish Racks & Sink Supplies', NULL, 4, 3),
(216, 'Laundry', NULL, 4, 3),
(217, 'Alarm Clocks', NULL, 5, 3),
(218, 'Bags & Totes', NULL, 5, 3),
(219, 'Desk Toys', NULL, 5, 3),
(220, 'Tech Accessories', NULL, 5, 3),
(221, 'Home Improvement', NULL, 5, 3),
(222, 'Key Chains & Key Caps', NULL, 5, 3),
(223, 'Lunchbags & Accessories', NULL, 5, 3),
(224, 'Nightlights', NULL, 5, 3),
(225, 'Desk Lamps', NULL, 5, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`dept_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `dept_ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

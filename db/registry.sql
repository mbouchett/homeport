-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 27, 2018 at 10:14 PM
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
-- Table structure for table `registry`
--

CREATE TABLE `registry` (
  `reg_ID` int(7) NOT NULL,
  `reg_associate` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_partner1F` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_partner1L` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_partner2F` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_partner2L` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_email01` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_phone01` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reg_event_date` date DEFAULT NULL,
  `reg_addr01` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_addr02` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_addr03` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_contact` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_relation` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_cphone01` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_cphone02` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_cemail` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_email02` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_phone02` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_postaddr01` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_postaddr02` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_postaddr03` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_username` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reg_password` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `reg_pw` tinytext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registry`
--

INSERT INTO `registry` (`reg_ID`, `reg_associate`, `reg_partner1F`, `reg_partner1L`, `reg_partner2F`, `reg_partner2L`, `reg_email01`, `reg_phone01`, `reg_date`, `reg_event_date`, `reg_addr01`, `reg_addr02`, `reg_addr03`, `reg_contact`, `reg_relation`, `reg_cphone01`, `reg_cphone02`, `reg_cemail`, `reg_email02`, `reg_phone02`, `reg_postaddr01`, `reg_postaddr02`, `reg_postaddr03`, `reg_comment`, `reg_note`, `reg_username`, `reg_password`, `reg_pw`) VALUES
(60, NULL, 'Kim', 'Jaquish', 'John', 'Benoit', 'kjaquish381@yahoo.com', '802-363-4623', '2011-02-03 17:46:54', '2015-09-01', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'jaqben', 'rightontrack', ''),
(62, NULL, 'Jessica', 'Dalley', 'Bill', 'Frasure', 'jessica.dalley@ahs.state.vt.us', '802-825-3556', '2011-02-03 18:00:46', '2013-01-05', '33 Wildberry Lane', '', 'Underhill, VT', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'dalfra', 'summerrain', ''),
(63, NULL, 'Stephanie', 'Burr', 'Jeff', 'Gingras', 'stephanieburr06@yahoo.com', '802-363-2963', '2011-02-03 18:06:14', '2013-01-05', '', '', '', '', '', '', '', '', '', '802-922-4188', '', '', '', NULL, NULL, 'burrging', 'windyfield', ''),
(64, NULL, 'Rachel', 'Bailey', 'David', 'DiBiase', 'rfbailey333@yahoo.com', '802-881-1749', '2011-02-03 18:26:25', '2013-01-05', '81 South Water Street', '', 'Vergennes, VT 05491', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'baidib', 'angeleyes', ''),
(127, NULL, 'Deirdre', 'Perkins', 'Kendrick', 'Bissonette', 'Deeperkins333@gmail.com', '802 578 7328', '2012-04-29 14:14:58', '2013-09-21', 'P.O. BOX 601', '', 'Williston, Vermont, 05495', 'Heather Caldera', 'Mother of the bride', '1 339 832 0907', '1 339 832 0906', '', 'Kbissonette@gmail.com', '802 345 3049', '', '', '', NULL, NULL, 'DPerkins333', 'tootsie84', ''),
(84, NULL, 'Jessica', 'Juczak', 'Tim', 'Fisher', 'jjuczak@gmail.com', '802-355-1215', '2012-02-08 14:14:55', '2013-09-14', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'juczakfisher', '29luck', ''),
(89, NULL, 'Anthony', 'Ottaviand', 'Tammy', 'Bertrand', 'tonyottav@yahoo.com', '802-777-4247', '2012-02-08 18:15:50', '2013-01-05', '88 Birch Ct', '', 'Burlington, VT 05408', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'ottabert', '7vermont9', ''),
(94, NULL, 'Emily', 'Danaher', 'Justin', 'Roberts', 'emmiegirl43@comcast.net', '802-324-1431', '2012-02-08 20:50:31', '2013-01-05', '15 Creek Ln.', '', 'Richmond, VT 05477', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'danarobe', 'fire99works', ''),
(102, NULL, 'Sarah', 'Shappy', '', '', 'homeport@homeportonline.com', '989-2215', '2012-02-09 16:35:34', '2013-07-06', '834 Nichols Rd', '', 'New Haven, VT 05472', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'sarashap', 'blarg12', ''),
(104, NULL, 'Amanda', 'Rotunda', 'Chris', 'Pugh', 'homeport@homeportonline.com', '373-3666', '2012-02-09 17:22:54', '2013-09-01', '459 Shaw Rd', '', 'Cambridge VT 05444', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'rotupugh', 'green19', ''),
(107, NULL, 'Jaclyn', 'Baker', 'Harliss', 'Fortin', 'jaclynbkr23@gmail.com', '782-2407', '2012-02-09 17:52:15', '2013-08-23', '1265 Rugg Rd', '', 'Fairfield VT 05455', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'bakefort', 'red25', ''),
(108, NULL, 'Sarah', 'Doyle', 'Tom', 'Breeyear', 'sarah_1_doyle@yahoo.com', '518-637-1550', '2012-02-09 18:16:43', '2013-08-24', 'PO Box 54', '', 'Elizabeth Town NY 12932', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'doylbree', 'purple13', ''),
(110, NULL, 'Kayla ', 'Powul', 'Daniel', 'Emerson', 'k.powul@gmail.com', '802-343-3245', '2012-02-09 19:26:09', '2013-06-22', '70B Clearview Dr', '', 'Salisbury VT 05769', '', '', '', '', '', 'vtolds@gmail.com', '', '', '', '', NULL, NULL, 'powuemer', 'wind76', ''),
(115, NULL, 'Samantha', 'Mozingo', 'James', 'Badman', 'sam.mozingo@gmail.com', '609-719-8536', '2012-02-09 20:05:33', '2013-07-13', '709 Joseph Ave.', '', 'Lanoka Harbor, NJ 08734', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'mozibadm', 'super16', ''),
(116, NULL, 'Kristine', 'Morin', 'Daren', 'Deforge', 'deforge57@yahoo.com', '802-782-9640', '2012-02-09 20:42:17', '2013-01-05', '10 Evergreen Drive', '', 'Milton VT 05468', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'moridefo', 'rose34', ''),
(205, NULL, 'Lindsay ', 'Tatro', 'Rebecca', 'Barratt', 'Linds102001@yahoo.com', '8027526878', '2013-06-21 23:37:19', '2013-09-21', '39 Bushey Street', '', 'Swanton VT 05488', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Linds102001', 'kodybug28', ''),
(132, NULL, 'Mary', 'Marshall', 'Sam', 'Carleton', 'marshall.marym@gmail.com', '802-343-7449', '2012-09-09 00:27:19', '2013-07-20', '108 S. Willard St.', '', 'Burlington, VT 05401', '', '', '', '', '', 'sacarlet@uvm.edu', '802-236-1832', '108 S. Willard St.', '', 'Burlington, VT 05401', NULL, NULL, 'marysam', 'trotnixon7', ''),
(133, NULL, 'Nichole', 'Caisse', 'Alex', 'Andors', 'nlcaisse@gmail.com', '802-497-1042', '2012-10-25 15:17:53', '2013-04-13', '87 Rudgate Rd', '', 'Colchester, VT 05446', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'andorswedding', 'alexnichole', ''),
(134, NULL, 'Amy', 'Richardson', 'Nathan', 'Mitchell', 'amester18@gmail.com', '802-279-5683', '2012-11-09 19:30:01', '2013-04-21', '49 Berkley Street', '', 'South Burlington, VT 05403', '', '', '', '', '', 'soxwalker@hotmail.com', '802-399-6393', '', '', '', NULL, NULL, 'Richmitch', 'april18', ''),
(135, NULL, 'Jennifer', 'Moore', 'Ryan', 'Murphy', 'ryanmurphy83@hotmail.com', '603-496-4789', '2012-11-10 13:12:08', '2013-06-15', '112 Maple Street', 'Apt. 2', 'Burlington, VT 05401', 'Mary Ellen Moore', 'mother', '603-496-3727', '603-225-6006', 'mooremandm@aol.com', 'jmoore9@mail.smcvt.edu', '802-497-1182', '', '', '', NULL, NULL, 'moore-murphy', 'jenn28', ''),
(136, NULL, 'Tiffany', 'Silliman', 'Rachel', 'Cohen', 'Tiffany.Silliman@gmail.com', '802-363-7886', '2012-12-28 02:53:40', '2013-09-28', '24 St Louis Street', '', 'Burlington, VT 05401', '', '', '', '', '', 'Rachel.is.Cohen@gmail.com', '646-489-7224', '', '', '', NULL, NULL, 'RachelTiffany', 'vermont1982', ''),
(138, NULL, 'Jon', 'McCartney', 'Katie', 'Kinnaird', 'katiekinnaird@gmail.com', '518-536-0374', '2013-02-02 19:46:49', '2013-07-13', '263 Hildred Drive', '', 'Burlington, VT 05401', '', '', '', '', '', '', '301-452-4081', '', '', '', NULL, NULL, 'jonkatie', 'thyme531', ''),
(139, NULL, 'Maureen', 'Golda', 'Mike', 'Randall', 'irishgold67@yahoo.com', '802-338-7097', '2013-02-05 21:38:24', '2013-11-02', '', '', '', '', '', '', '', '', '', '802-338-7097', '101 West Milton Rd', '', 'Milton, VT, 05468', NULL, NULL, 'ghendrickson', '1234', ''),
(140, NULL, 'Kiersten ', 'Bradley', 'David', 'Badger', 'kbradley@cssu.org', '363-3236', '2013-02-05 21:45:15', '2014-06-06', '32 Green Street', '', 'Milton, VT, 05468', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'kierdavi', 'pin110', ''),
(141, NULL, 'Emily', 'Regan', 'Greg', 'Abrami', 'reganemily@live.com', '802-863-4644', '2013-02-05 21:51:01', '2014-07-05', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'emilgreg', 'grey41', ''),
(142, NULL, 'Dina ', 'Roberts', 'John', 'Royer', 'holtravell@ad.com', '802-863-4644', '2013-02-05 21:59:19', '2014-07-05', '201 West Canal St', '', 'Winooski, VT', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Dinajohn', 'pink111', ''),
(143, NULL, 'Joletta', 'Groves', 'Rob', '', 'joletta7@yahoo.com', '802-863-4644', '2013-02-05 22:03:48', '2013-10-31', '302 Manhatten Drive', '', 'Burlington, VT, 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Joletrob', 'red01', ''),
(144, NULL, 'Gena', 'Sedelnick', 'Ervin', 'Stark', 'gns198819@hotmail.com', '802-349-4017', '2013-02-05 22:12:34', '2014-08-23', '20 Hillside Drive', '', 'Vergennes VT 05491', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'genaervi', 'Red02', ''),
(145, NULL, 'Emily', 'Raymond', 'James', '', 'savard@yahoo.com', '865-6914', '2013-02-05 22:18:19', '2013-05-01', '17 South Meadow Drive', '', 'Burlington, VT, 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Emiljame', 'Red03', ''),
(146, NULL, 'Megan', 'DeVinny', 'Ryan', 'Duprat', 'mdevinny@gmail.com', '802-236-2778', '2013-02-05 22:23:50', '2013-08-31', '20 Burritt Rd', '', 'Hinesburg VT 05461', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'megaryan', 'red04', ''),
(147, NULL, 'Morgan', 'Trombly', 'Roland', 'Laroche', 'mtromblyrt@icloud.com', '802-782-5108', '2013-02-05 22:31:00', '2013-10-05', '3429 Rice Hill Road', '', 'Franklin, VT 05454', '', '', '', '', '', 'rolandlaroche', '', '', '', '', NULL, NULL, 'MogeRola', 'Red05', ''),
(149, NULL, 'Tiffany', 'McSweeney', 'Beau', 'Davis', 'silver2flower@gmail.com', '802-734-1167', '2013-02-05 22:39:02', '2013-07-13', '6 East shore', '', 'North Grand Isle VT 05458', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'TiffBeau', 'Red07', ''),
(150, NULL, 'Krista', 'Lyman', 'Eric', 'Smith', 'homeport@homeportonline.com', '752-5992', '2013-02-05 22:42:39', '2013-09-28', 'P.O. Box 337', '', 'Fairfax VT 05454', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'kriseric', 'red08', ''),
(151, NULL, 'Brittany', 'Ryea', 'Nick', 'Williams', 'homeport@homeportonline.com', '802-527-7767', '2013-02-05 22:47:01', '2013-09-21', '82 Pike Farm Estates', '', 'Swanton VT 05488', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'britnick', 'red09', ''),
(152, NULL, 'Shelly', 'Hanson', '', '', 'homeport@homeportonline.com', '443-340-1216', '2013-02-05 22:50:18', '2013-10-03', '88 S Main St', '', 'Waterbury VT 05676', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'shellyha', 'red10', ''),
(153, NULL, 'Nikki', 'Lavaette', 'Sean ', 'Ryan', 'rainlessgem@hotmail.com', '324-6861', '2013-02-05 22:54:41', '2014-07-12', '63 Cortland Lane', '', 'Colchester VT 05446', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'nikksean', 'red11', ''),
(154, NULL, 'Amanda', 'Lamonde', 'Jason', 'Brown', 'monsterface2905@oal.com', '777-9834', '2013-02-05 22:58:59', '2014-11-22', '162 West St', '', 'Essex Jct VT 05452', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'amanjaso', 'red12', ''),
(155, NULL, 'Chris', 'LaMothe', 'Karina', 'Lopez', 'Kicksv24@yahoo.com', '802-338-9212', '2013-02-10 18:01:46', '2013-10-05', '14 Florida Ave', '', 'Winooski, VT. 05404', '', '', '', '', '', 'Clamoth@us.ibm.com', '802-769-6599', '', '', '', NULL, NULL, 'Kicksv24', 'karina', ''),
(156, NULL, 'Allison', 'Clark', 'David ', 'Walker', 'Homeport@homeportonline.com', '802-933-2475', '2013-02-12 17:17:28', '2013-09-21', '2332 Woodward Neighborhood Road', '', 'Richford VT 05476', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'AlliDavi', 'Blue29', ''),
(157, NULL, 'Barbara ', 'Huggins', 'N/A', 'N/A', 'Homeport@homeportonline.com', '802-933-2475', '2013-02-12 17:23:18', '2014-06-07', '2332 Woodward Neighborhood Road', '', 'Richford VT 05476', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'barbhugg', 'Blue97', ''),
(158, NULL, 'Kristen', 'Villeneuve', 'Michal', 'Cetalano', 'brendabcoldinvt@hotmail.com', '802-899-1239', '2013-02-12 17:34:59', '2014-07-12', '41 Jebb Rd', '', 'Coehram Ville, PA', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'krismich', 'Blue107', ''),
(159, NULL, 'Hillary', 'Mason', 'Freddy', 'Edwards', 'iheartoasidy@gmail.com', '728-4463', '2013-02-12 17:41:15', '2013-10-20', '887 Ovdos Rd', '', 'Braintree VT 05060', '', '', '', '', '', '', '272-8975', '', '', '', NULL, NULL, 'hillfred', 'Red219', ''),
(160, NULL, 'Rhiannon', 'Brooks', 'Anthony', 'Deth', 'rhiannon_brooks2002@yahoo.com', '802-473-8024', '2013-02-12 17:49:08', '2013-09-14', '469 Gaskell Hill Rd', '', 'West Burke VT 05871', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'rhiaanth', 'orange27', ''),
(161, NULL, 'Marnie', 'Rivett', '', '', 'marnie.rivett@gmail.com', '802-863-4644', '2013-02-12 17:52:54', '2014-07-12', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'marnrive', 'yellow179', ''),
(162, NULL, 'Tamra', 'Blaisdell', 'Randy', 'Wessar', 'Homeport@homeportonline.com', '802-644-6773', '2013-02-12 21:37:45', '2014-06-21', '1756 Bartlett Hill Rd', '', 'Jeffersonville VT 05464', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'tamrrand', 'Blue198', ''),
(164, NULL, 'Emily', 'Dewitt', 'Nick', 'Fredette', 'emdewitt415@gmail.com', '802-999-8649', '2013-02-12 21:50:04', '2013-10-19', '362 S. Winooski Ave Apt F', '', 'Burlington VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Emilnick', 'Red93', ''),
(165, NULL, 'June', 'Russin', '', '', 'junerussin@yahoo.co.nz', '782-5245', '2013-02-12 21:56:24', '2013-08-20', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'juneruss', 'Red77', ''),
(166, NULL, 'Amber', 'Nicholson', 'David', 'Macmurtry', 'macmurtry2013@gmail.com', '802-922-1979', '2013-02-12 22:00:34', '2013-09-22', '440 Rt 7 So #105', '', 'Milton VT 05648', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'AmbeDavi', 'Green13', ''),
(167, NULL, 'Tracy ', 'Clemon', 'Andrew ', 'Whyte', 'reichan42@yahoo.com', '999-1100', '2013-02-12 22:06:10', '2013-09-01', '65 Ardet St apt A', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'tracandr', 'Blue19', ''),
(168, NULL, 'Jessie', 'Alderman', 'Jeff', 'Morgan', 'jessieald13@yahoo.com', '802-922-7653', '2013-02-12 22:11:25', '2014-09-13', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Jessjeff', 'Green158', ''),
(169, NULL, 'Crystal ', 'Buhler', 'Skyler', 'Bailey', 'crybuh@gmail.com', '802-863-4644', '2013-02-12 22:14:14', '2014-06-14', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'crysskyl', 'Red133', ''),
(170, NULL, 'Holly ', 'Strippe', 'Kristopher', 'Shephard', 'holpol13@yahoo.com', '802-780-0235', '2013-02-12 22:23:24', '2013-08-24', '147 Grove Ln', '', 'Waterbury ctr, VT 05677', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Hollkris', 'Blue199', ''),
(171, NULL, 'Dana', 'Geer', 'Jon', 'Ewing', 'danamg@gmail.com', '802-461-5578', '2013-02-12 22:33:05', '2013-06-01', '401 Shelburne Rd', '', 'Burlington VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Danajone', 'Red198', ''),
(172, NULL, 'Ashli', 'Domina', 'Jacob', 'Irish', 'ashli.domina@yahoo.com', '802-782-2500', '2013-02-12 22:39:19', '2014-06-07', 'P.O. Box 831', '', 'Enosburg VT 05450', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'ashljaco', 'Blue49', ''),
(173, NULL, 'Jennie', 'Kernoff', 'Bradley', 'Patnaude', 'homeport@homeportonline.com', '318-8356', '2013-02-12 22:45:55', '2013-05-26', '14 Twin Oaks Terrace', '', 'South Burlington VT 05403', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'JennBrad', 'Red35', ''),
(174, NULL, 'Dimple', 'Advani', 'Erik', 'Shanks', 'djadvani@gmail.com', '802-310-7366', '2013-02-12 22:49:47', '2013-08-18', '10 Joseph Lane', '', 'Essex Jct VT 05452', '', '', '', '', '', '', '', '122 White St Apt 1', '', 'So Burlington vt 05403', NULL, NULL, 'Dimperik', 'Red38', ''),
(175, NULL, 'Sharon', 'Berard', 'Jesse', 'Baker', 'ransgirl78@yahoo.com', '802-238-5461', '2013-02-12 22:52:49', '2013-06-30', '105 Lincoln Dr Apt 4', '', 'Colchester VT 05446', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'sharjess', 'blue55', ''),
(176, NULL, 'Kaitlyn', 'Bedell', 'Patrick', 'Rooney', 'krbedell89@gmail.com', '802-863-4644', '2013-02-18 16:00:26', '2014-06-14', '117 John Fay Rd ', 'Unit 103', 'South Burlington VT 05403', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'kaitpatr', 'Red338', ''),
(177, NULL, 'Laura', 'Murray', 'Adam', 'Shortsleve', 'laurarosemurray@gmail.com', '802-989-5818', '2013-02-18 16:05:29', '2013-08-31', '4763 VT Route 116', '', 'starksburo VT 05487', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Lauradam', 'Blue199', ''),
(178, NULL, 'Amy', 'Pioesser', 'Josh', 'Sharpe', 'amploesspr@gmail.com', '922-2393', '2013-02-18 16:12:07', '2013-04-27', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Amypjosh', 'orange444', ''),
(179, NULL, 'Heather', 'Tassie', 'Ray', 'Hill', 'htassiec2@aol.com', '818-1620', '2013-02-18 16:32:12', '2013-08-20', '268 Pettingill Rd', '', 'Essex Jct VT 05452', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Heatrayh', 'white119', ''),
(180, NULL, 'Laura', 'Thompson', 'Chris', 'Breen', 'lthompson@vbt.com', '802-310-6887', '2013-02-18 16:37:09', '2013-08-10', '1040 Upper Meehan Rd', '', 'Bristol VT 05443', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'laurchri', 'yellow938', ''),
(181, NULL, 'Jennifer', 'Menard', 'George', '', 'flutterby4jen@yahoo.com', '802-279-8943', '2013-02-18 16:43:16', '2014-08-16', 'P.O. Box 559', '', 'E Barre VT 05649', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'jenngeor', 'Blue945', ''),
(182, NULL, 'Lori', 'Williams', 'David ', 'Hill', 'loriw383@yahoo.com', '802-863-4644', '2013-02-18 16:45:58', '2014-08-16', '500 Hill Top Drive', '', 'Enosburg falls VT 05450', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'loridavi', 'Red888', ''),
(183, NULL, 'Mary', 'Hill', 'Randy', 'Parish', 'parishrandy@yahoo.com', '802-863-4644', '2013-02-18 16:51:12', '2014-08-16', '4 Isle Lane apt 489', '', 'Grand Isle VT 05458', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'maryrand', 'Red339', ''),
(184, NULL, 'Jenna', 'Wilder', 'Garret', '', 'jwvt1986@yahoo.com', '622-0042', '2013-02-18 16:55:36', '2013-08-17', 'P.O. Box 566', '', 'E. Barre VT 05649', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'jenngarr', 'Blue934', ''),
(185, NULL, 'Summer', 'Beausoleil', 'Mike', 'Willis', 'sbeausoleil77@comcast.net', '802-598-1153', '2013-02-18 17:07:00', '2014-08-09', '255 S Main St ', '', 'St Albins VT 05478', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'summmike', 'Red432', ''),
(186, NULL, 'Heidi', 'Ainsworth', 'Damian', 'Hook', 'ainsworth.h@gmail.com', '535-5419', '2013-02-18 17:11:45', '2013-08-10', '35 Middle Road', '', 'Barre vt 05641', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'HeidDami', 'white45', ''),
(187, NULL, 'Kandi', 'Clark', 'David', 'Marlow', 'Homeport@homeportonline.com', '802-598-1729', '2013-02-18 17:19:06', '2014-08-16', '230 whitefield Drive', '', 'Jeffersonville VT 05464', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Kanddavi', 'Red333', ''),
(190, NULL, 'Melissa', 'Beck', 'Brendon', 'Miller', 'beckm22@gmail.com', '3155426696', '2013-03-06 04:35:29', '2015-05-15', '2 Woodburne Dr', '', 'Whitesboro,NY,13492', 'Melissa Beck', '', '', '', 'beckm22@gmail.com', '', '', '', '', '', NULL, NULL, 'beckm22', 'Inspiration34', ''),
(192, NULL, 'Jennifer', 'Smith', 'Robert', 'Jones', 'mark@markbouchett.com', '802-555-1212', '2013-03-11 17:08:01', '2013-08-10', '1234 Elm Street', '', 'Burlington, VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'jenrob', 'jenrob', ''),
(196, NULL, 'Megan', 'LaFramboise', 'Thomas', 'Walker', 'raspberry_412@yahoo.com', '802-373-3090', '2013-03-29 21:45:51', '2013-06-22', '104 Lamoile Terrace', '', 'Milton, VT 05468', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'megtho', 'megtho', ''),
(197, NULL, 'Lisa', 'Mase', 'Ryan', '-', 'lisamase@gmail.com', '802-598-9206', '2013-04-06 19:07:56', '2013-07-13', '116 White Rock Dr. #1', '', 'Montpelier, VT 05602', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'lisamase@gmail.com', 'shiva108', ''),
(198, NULL, 'Elissa ', 'Schuett', 'Chris', 'Guros', 'eschuett@gmail.com', '508-274-1514', '2013-04-10 20:27:50', '2014-12-20', '1433 North Ave', '', 'Burlington, VT 05408', '', '', '', '', '', '', '802-318-5378', '', '', '', NULL, NULL, 'eschuett', 'icecream29', ''),
(199, NULL, 'Kara', 'Tymon', 'Rick', 'Krawiec', 'ktymon@nsmvt.org', '8022246443', '2013-04-23 21:12:41', '2013-08-03', '204 Pope Rd', '', 'Westfield, VT 05874', 'Brittany', 'Friend-Bridesmaid', '8027777311 *best form of communication', '', 'brittle317@gmail.com', 'papacass_112304@yahoo.com', '8027442202', '', '', '', NULL, NULL, 'ktymon', 'Sheila1984', ''),
(202, NULL, 'John ', 'Ledoux', 'Rose', 'Nelson', 'theleduo@gmail.com', '802-324-8342', '2013-04-28 14:44:33', '2013-09-07', '12 Clarke St', 'Apt 1', 'Burlington, VT 05401', '', '', '', '', '', 'ramblinrose28@gmail.com', '607-244-4201', '', '', '', NULL, NULL, 'jbandrose', 'flower4075', ''),
(203, NULL, 'Jess', 'Sorgule', 'Dave', 'Putvain', 'jsorgule@gmail.com', '518 524-7975', '2013-06-04 17:26:26', '2013-09-14', '1444 North Ave.', 'Burlington, VT', '05408', 'Jess Sorgule', '', '518 524-7975', '518 524-7975', 'jsorgule@gmail.com', 'jsorgule@gmail.com', '518 524-7975', '', '', '', NULL, NULL, 'jsorgule', '177bantu', ''),
(204, NULL, 'Jessica', 'Andreoletti', 'Richard', 'Demar', 'jessoletti@gmail.com', '802-777-1760', '2013-06-11 21:12:33', '2013-07-27', '502 Piette Meadow Rd', '', 'Hinesburg, VT 05461', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'jessoletti', 'h2o2h2o', ''),
(208, NULL, 'Caroline', 'Bright', 'Dillon', 'Hupp', 'cbrightvt@gmail.com', '802.752.5753', '2013-06-29 17:08:57', '2013-08-24', '6206 Georgia Shore Road', '', 'St. Albans VT 05478', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'carolinebright', 'cerulean624', ''),
(209, NULL, 'Kayla', 'Brown', 'Kristina', 'Smith', 'kabrown1627@gmail.com', '802-989-4497', '2013-08-17 02:40:10', '2013-12-25', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'kabrown1627', 'bsbrules01', ''),
(210, NULL, 'Julie', 'Laba', 'Stephen', 'Shaw', 'jmlabavt@gmail.com', '8023244320', '2013-11-05 02:42:33', '2014-07-12', '8 Pointe Dr.', '', 'Essex Junction', '', '', '', '', 'jmlabavt@gmail.com', '', '', '8 Pointe Dr.', '', 'Essex Junction', NULL, NULL, 'jmlabavt', 'Legna4u2!', ''),
(211, NULL, 'Ashli', 'Domina', 'Jacob ', 'Irish', 'ashli.domina@yahoo.com', '802-782-2500', '2013-11-05 15:26:24', '2014-09-20', '117 Berkshire Estates', '', 'Enosburg Falls VT 05450', 'Babette Coons/ Wendy Domina', 'Mother in Law/ Mother', '527-9929/ 933-9669', '', '', '', '', '', '', '', NULL, NULL, 'ashlidomina', 'kolbyirish', ''),
(213, NULL, 'Hannah', 'Ausmann', 'John', 'Helme', 'ausmann.hannah@gmail.com', '802-272-0778', '2013-11-21 20:29:44', '2014-05-24', '27 Westwood Parkway', '', 'Barre, VT 05641', 'Charlotte Ausmann', 'Sister', '802-272-3172', '', 'charlotte.ausmann@gmail.com', 'jhelme@outlook.com', '802-522-3962', '', '', '', NULL, NULL, 'ausmann&helme', 'caringone1', ''),
(214, NULL, 'Sabrina ', 'LaCharite', 'Joel', 'Shedd', 'slacharite1@gmail.com', '8027344902', '2014-01-02 12:37:26', '2014-08-02', '35 Thasha Ln Apt A-5', '8027344902', 'Essex Junction, 05452', '', '', '8027344902', '8027344902', 'slacharite1@gmail.com', 'joelkartel@yahoo.com', '8027344902', '35 Thasha Ln Apt A-5', '', 'Essex Junction, 05452', NULL, NULL, 'SSMANNO', '1452', ''),
(216, NULL, 'Leah', 'Tansey', 'Josh', 'Stewart', 'info@joshandleah.net', '8022911155', '2014-01-10 00:36:07', '2014-09-20', '190 Howard Street', 'Unit 1', 'Burlington, Vermont 05401', '', '', '', '', '', 'leah.tansey@yahoo.com', '4135376401', '', '', '', NULL, NULL, 'jslt', 'Stella5758', ''),
(218, NULL, 'Meghan', 'D\'Arcy', 'Michael', 'Wixted', 'meghandarcy@hotmail.com', '802-324-8088', '2014-01-21 13:01:31', '2014-07-04', '55 Green STreet', 'Unit D125', 'Clinton, MA 01510', '', '', '', '', '', '', '617-276-6154', '', '', '', NULL, NULL, 'meghandarcy@hotmail.com', 'Leemann16', ''),
(219, NULL, 'Wendy', 'Lumepy', 'Roger', 'Timbleberry', 'mbouchett@homeportonline.com', '802-555-1212', '2014-01-28 15:20:20', '2014-08-09', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'timlum', '1234567', ''),
(220, NULL, 'Kimberly', 'Jordan', 'Sarah', 'Mell', 'kimberlingo@gmail.com', '802-318-0934', '2014-01-31 01:38:12', '2014-07-18', '78 Rose St. #12', '', 'Burlington, VT 05401', 'Heather Mell', 'sister-in-law (to be)', '857-869-2866', '', '', 'sapho77@yahoo.com', '802-318-5753', 'Grand Isle Lake House', '', 'Grand Isle, VT', NULL, NULL, 'kimsarah71814', 'love', ''),
(221, NULL, 'Amy', 'Wild', 'John', 'Flanagan', 'amywild15@gmail.com', '339-227-0683', '2014-02-26 13:33:58', '2014-04-19', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'AmyWild', 'ciaowbc0', ''),
(222, NULL, 'Ohanga', 'Losambe', 'Isabella', 'Fout', 'ohangalosambe@gmail.com', '8025982743', '2014-03-08 21:55:43', '2014-08-08', '20 Dubois Drive', '', 'South Burlington,VT,05403', '', '', '', '', '', 'isabellafout@gmail.com', '8023731999', '', '', '', NULL, NULL, 'freddie-bella', '1@wedding', ''),
(223, NULL, 'Danielle', 'Von Ancken', 'AJ', 'Twombly', 'sunrise5309@gmail.com', '203-610-2314', '2014-03-15 20:33:09', '2014-06-21', '65 Winooski falls Way', 'APT 105', 'Winooski, VT 05404', 'Rachel Williams', 'Friend', '203-362-9149', '', 'racchell13@gmail.com', 'ajtwombly@aol.com', '203-731-1433', '', '', '', NULL, NULL, 'AJDanielle', 'sammie88', ''),
(224, NULL, 'Hannah', 'Hurlburt', 'Earl', 'Hurlburt', 'thegoodwitch.mendys@hotmail.com', '802-545-2659', '2014-03-28 14:56:44', '2014-06-21', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'smriggs', '1234', ''),
(225, NULL, 'Heather', 'Pulver-gaillard', 'Phil', 'Batalion', 'pbatalion@gmail.com', '201-705-7622', '2014-04-12 18:01:49', '2014-08-31', '456 North ave', '', 'Burlington, VT 05401', '', '', '', '', '', 'Heatherpg@gmail.com', '802-710-7912', '', '', '', NULL, NULL, 'pbatalion', 'june25', ''),
(226, NULL, 'Julia', 'Wilkinson', 'Chris', 'Allen', 'softballcatch14@yahoo.com', '8029898064', '2014-04-29 01:54:54', '2014-10-25', '4522 Ethan Allen HWY', '', 'New Haven, VT, 05472', 'Deb Wilkinson', 'Mother', '8029898064', '8029227158', '', '', '', '', '', '', NULL, NULL, 'softballcatch14', 'pandas14', ''),
(227, NULL, 'Gabrielle', 'Towers', 'Dillon', 'LaForce', 'towers2laforce@gmail.com', '8024826023', '2014-05-05 15:44:33', '2014-10-18', '216 Lavigne Hill Rd', '', 'Hinesburg, VT 05462', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'towers2laforce', 'October182014', ''),
(229, NULL, 'Jamiee', 'Murray', 'Jonathan', 'Smith', 'jlmurray@g.cofc.edu', '8022744301', '2014-05-26 02:06:48', '2014-08-09', '2724 Joes Brook RD', '', 'Saint Johnsbury, Vermont, 05819', '', '', '', '', '', '', '8644198705', '', '', '', NULL, NULL, 'jamieemurray', 'freedom09', ''),
(230, NULL, 'Kyle', 'Brunelle', 'Susan', 'Thomas', 'Kbrunelle126@gmail.com', '2033839161', '2014-07-05 16:51:13', '2015-12-20', '105-1 Archibald st', '', 'Burlington VT 05401', '', '', '', '', '', 'Sthomas819@gmail.com', '2039930553', '', '', '', NULL, NULL, 'Kbrunelle126', 'susan819', ''),
(231, NULL, 'Amanda', 'Holland', 'Brian', 'Eckenroth', 'akholland@yahoo.com', '8023101539', '2014-07-21 01:18:10', '2014-09-21', '23 Appletree Ct', '', 'South Burlington, VT 05403', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'akholland', '23Appletree', ''),
(232, NULL, 'Maxwelle', 'Couser', '', '', 'calico9999@aol.com', '830-535-4630', '2014-10-12 15:33:38', '2014-11-15', '408 Deer Creek Drive East', '', 'Pipe Creek, TX  78063', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'calico9999', 'ssunny99', ''),
(233, NULL, 'Victoria', 'Barnak', 'Michael', 'Sommers', 'v.barnak@gmail.com', '5702699464', '2014-11-17 17:43:41', '2015-09-05', '232 Manhattan Dr.', 'Unit 7', '05401', '', '', '', '', '', 'drmichaelsommers@gmail.com', '', '', '', '', NULL, NULL, 'vbarnak', 'vickyb1989', ''),
(234, NULL, 'Jacquelyn', 'Burrell', 'Patrick', 'McAndrew', 'patrickjackiewedding@gmail.com', '802-578-0551', '2014-12-10 00:47:59', '2015-08-22', '272 South Winooski Ave. 2', '', 'Burlington, VT 05401', '', '', '', '', '', 'jburrell616@gmail.com', '917-685-5617', '', '', '', NULL, NULL, 'jackiepatrickwedding', 'ramdaug', ''),
(235, NULL, 'Laura ', 'Newberry', 'John', 'Calhoun', 'Cocolover90@icloud.com', '5185247575', '2014-12-23 20:25:59', '2019-01-12', '773 County Rt. 22', '', 'Wadhams, NY, 12993', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Laura.Newberry90', 'BabyGirl143!', ''),
(236, NULL, 'Nicole', 'Kanehl', 'Jake', 'Adams', 'nicole.kanehl@gmail.com', '631-553-2835', '2015-01-25 19:58:20', '2015-10-17', '30 Caernarvon Street', '', 'Fairhaven, VT 05743', '', '', '', '', '', '', '802-3428011', '', '', '', NULL, NULL, 'nkanehl', 'ilovejake', ''),
(237, NULL, 'Ashley', 'Boyd', 'Alex', 'Hodgetts', 'anboyd7@gmail.com', '802-598-7099', '2015-01-25 20:52:12', '2015-08-08', '7548 Route 2A', '', 'St. George, VT 05495', '', '', '', '', '', '', '802-922-7276', '', '', '', NULL, NULL, 'anboyd', 'hodgetts8815', ''),
(238, NULL, 'Kirsten', 'McKnight', 'James', 'Kerrigan', 'kmcknight4@yahoo.com', '4062237374', '2015-03-05 19:20:34', '2015-06-27', '19 Margaret Street', '', 'Burlington, VT, 05401', '', '', '', '', '', 'kirsten.c.mcknight@gmail.com', '4062237374', '', '', '', NULL, NULL, 'kmcknight', 'jekkcm62715', ''),
(239, NULL, 'Heather', 'Deal', 'Ryan', 'McCrea', 'purpletulip05@gmail.com', '8025783996', '2015-04-07 15:32:41', '2015-08-29', '2789 Greenbush Road Apt. B', '8025783996', 'Charlotte, VT 05445', '', '', '', '', '', 'ryanmccrea@rocketmail.com', '8159789551', '', '', '', NULL, NULL, 'handr2015', 'wedding15', ''),
(240, NULL, 'Allison', 'Sleeper', 'Michael', 'Sorrell', 'amsleeper25@hotmail.com', '802-349-5548', '2015-04-19 17:36:48', '2015-07-25', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'amsleeper', 'SilverSnakes25', ''),
(241, NULL, 'Mark', 'Bouchett', 'Carolle', 'Larue', 'mark@markbouchett.com', '802-373-1035', '2015-05-18 19:07:00', '2015-09-30', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'mbouchett', 'quixote', ''),
(242, NULL, 'Emily', 'Horning', 'Derek', 'Coffrin', 'dcoffrin@gmail.com', '8023101806', '2015-05-21 00:32:33', '2015-08-30', '61 Pinnacle Dr.', 'Apt. 103', 'Jeffersonville, VT 05464', '', 'Fiancee', '', '', '', 'emhorning@myfairpoint.net', '8025989556', '62 Green Leaf Drive', '', 'Jeffersonville, VT 05464', NULL, NULL, 'Molly2015', 'wedding2015', ''),
(243, NULL, 'Alyson', 'Richards', 'James ', 'Pepper', 'Alyson.h.richards@gmail.com', '802-371-9750', '2015-05-25 20:31:09', '2015-08-15', '545 Foster Rd', '', 'East Montpelier, VT 05651', '', '', '', '', '', 'Jpepper23@gmail.com', '802-371-6235', '', '', '', NULL, NULL, 'AlyandJames', 'ourspicyromance', ''),
(244, NULL, 'Francois', 'Bouchett', '', '', 'fbouchett@gmail.com', '8028634644', '2015-05-28 21:44:25', '2015-12-10', '', '', '', '', '', '', '', '', '', '8028634644', '', '', '', NULL, NULL, 'fbouchett', 'homeport', ''),
(245, NULL, 'Fred', 'Flintstone', 'Wilma', 'Flintstone', 'fbouchett@gmail.com', '8028634644', '2015-05-28 21:49:31', '2015-12-10', '', '', '', '', '', '', '', '', '', '8028634644', '', '', '', NULL, NULL, 'fredwilma', 'homeport', ''),
(246, NULL, 'Taryn', 'Maitland', 'Francois', 'Bouchett', 'tarynmaitland@gmail.com', '917-922-2297', '2015-06-10 18:13:33', '2017-10-07', '4458 greenbush Road', '', 'Charlotte, VT 05445', 'Kate Maitland', 'Mother', '917-838-5391', '', 'kwmaitland@earthlink.net', 'fbouchett@gmail.com', '802-363-0546', '', '', '', NULL, NULL, 'ttmait', 'eggs', ''),
(247, NULL, 'Sarah', 'Stone', 'David', 'LaBelle', 'saritastone_88@yahoo.com', '8023180844', '2015-06-24 02:25:47', '2015-09-05', '3595 roosevelt hwy ', '', 'Colchester vt, 05446', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Sarahanddavid9515', 'sara01337', ''),
(248, NULL, 'Jessica', 'Barrow', 'Adrienne', 'Lees', 'jbarrow818@gmail.com', '802-238-7928', '2015-10-20 01:08:25', '2016-10-15', '57 Brigham Rd', '', 'St Albans, VT 05478', '', '', '', '', '', 'navan.lees@gmail.com', '401-835-3893', '', '', '', NULL, NULL, 'AJBarrow', 'ajbarrow57', ''),
(249, NULL, 'Sam', 'Fried', 'Matt', 'Bean', 'Sam@kingstreetcenter.org', '9178432752', '2015-11-08 03:31:51', '2016-10-15', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Sam2146', 'Dean2146', ''),
(250, NULL, 'Meghan', 'Mallat', 'Jeffrey', 'Baule', 'mjmallat@gmail.com', '802-922-3144', '2015-11-14 20:24:17', '2016-06-11', '6142 Route 116', '', 'Shelburne, VT, 05482', '', '', '', '', '', 'jeffreybaule@gmail.com', '262-227-0126', '', '', '', NULL, NULL, 'mjmallat', 'Baullat2016', ''),
(251, NULL, 'Kirstie', 'Paschall', 'Loren', 'Munger', 'Kkpaschall@gmail.com', '8023438524', '2015-12-13 04:05:23', '2016-09-03', '300 Hinesburg rd #4', '8023438524', 'south burlington, vt 05403', '', '', '8023438524', '8023438524', 'Kkpaschall@suffolk.edu', 'Kkpaschall@suffolk.edu', '', '300 Hinesburg rd', '4', 'SOUTH BURLINGTON, vt 05403', NULL, NULL, 'Kkpaschall', 'kirstie17', ''),
(252, NULL, 'Jessica', 'Summer', 'John', 'Szewczyk', 'jessica.l.summer@gmail.com', '828-612-3899', '2015-12-15 01:49:37', '2016-09-03', '42 Susie Wilson Road ', 'Unit 208', 'Essex Junction, VT 05452', '', '', '', '', '', 'jsez444@gmail.com', '', '', '', '', NULL, NULL, 'jlsummer', 'NUovp223pass', ''),
(253, NULL, 'Ana', 'DiMarino', 'John', 'Zdoe', 'ana01720@gmail.com', '978-844-6602', '2016-01-12 15:08:38', '2016-09-01', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'ana01720', 'coco01720', ''),
(254, NULL, 'Kirstie ', 'Paschall', 'Loren', 'Munger', 'lorenwashere@gmail.com', '802-343-8524', '2016-01-18 19:01:05', '2016-09-03', '300 Hinesburg Rd #4', '', 'South Burlington, VT, 05403', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'klpaschallmunger', 'kirstie17', ''),
(255, NULL, 'Taryn', 'Maitland', 'Jack', 'Ripper', 'tmaitland@homeportonline.com', '2125808070', '2016-01-22 20:23:39', '2016-01-29', '2121', '2121', '212121', '3232', '32323', '', '2121', '212121', 'tmaitland@homeportonline.com', '3323', '21212', '2121', '2121', NULL, NULL, 'tmaitland', 'eggs', ''),
(256, NULL, 'Joshua', 'Fenty', 'Molly', 'Pahuta', 'fentywedding@gmail.com', '802-595-2069', '2016-01-30 17:02:45', '2016-11-05', '33 Weswind Road', '', 'Chelsea, VT, 05038', '', '', '', '', '', 'fentywedding@gmail.com', '908-303-3557', '', '', '', NULL, NULL, 'fentywedding', 'PA$$word', ''),
(257, NULL, 'Julie', 'Hoppmann', 'Bill', 'Wockenfuss', 'jhoppmann6@gmail.com', '(540) 272-8510', '2016-02-01 17:37:27', '2016-08-06', '236 Mechanic Street', 'Canton, MA 02021', '', '', '', '', '', '', 'billwock@gmail.com', '', '', '', '', NULL, NULL, 'jhoppmann', 'hoppenfuss', ''),
(258, NULL, 'Carly', 'Pepin', 'Jordan', 'Marut', 'Carlypepin26@gmail.com', '8028811141', '2016-02-11 00:19:13', '2016-08-26', '9 fuller place ', 'Unit 308', 'Essex vt 05452', '', '', '', '', '', '', '8025982029', '', '', '', NULL, NULL, 'Carlypep', 'Capture27!', ''),
(259, NULL, 'Cheyenne ', 'Sargent ', 'Erick ', 'Cinotti ', 'cheyenne.sargent@gmail.com', '8027775668', '2016-02-18 20:39:09', '2017-06-10', '702 Riverview Road ', '', 'Green Island, NY 12183', '', '', '', '', '', '', '2017883846', '', '', '', NULL, NULL, 'cheyennesargent', 'Verm0nt802', ''),
(260, NULL, 'Shelby ', 'LaRock', 'Jesse', 'Pecor', 'larock_s@hotmail.com', '8029228704', '2016-02-28 17:09:57', '2017-09-02', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Pecor Wedding', 'Kimber1921!', ''),
(261, NULL, 'Ericka', 'Page', 'Kyle', 'Behrsing', 'Epagevt@gmail.com', '802-535-1736', '2016-03-21 23:22:03', '2017-07-22', '1716 Maple Hill Rd', '', 'Barton, VT 05822', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Epagevt', 'lavender', ''),
(262, NULL, 'Chelsea', 'Purinton', 'Judson', 'Hescock', 'chelsea.purinton@gmail.com', '8023499966', '2016-03-23 15:50:09', '2016-08-06', '1367 South St', '', 'New Haven, VT 05472', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'chelsea.purinton', 'c0wgirl1', ''),
(263, NULL, 'Maureen', 'Jackson', 'Josh', 'Tomkin', 'maureenjackson417@aol.com', '8458913825', '2016-03-28 20:21:33', '2017-02-04', '41 Nicole Lane', '', 'Wingdale NY 12594', 'Susan Jackson', 'Mother', '8457972452', '', 'sjackson627@aol.com', '', '', '', '', '', NULL, NULL, 'maureenandjosh2017', 'Notebook17', ''),
(264, NULL, 'Krystal', 'Graham', 'Sam', 'Nelson', 'krystal.k1@gmail.com', '6037620354', '2016-04-08 20:52:06', '2016-07-16', '35 Little Eagle Bay', '', 'Burlington, VT 05408', '', '', '', '', '', 'samnelson4011@gmail.com', '8023108029', '', '', '', NULL, NULL, 'krystal.k1', 'runfast1', ''),
(265, NULL, 'Kenzi ', 'Carr', 'Zachary ', 'Nelson', 'kjcarr89@gmail.com', '603-991-4433', '2016-04-24 21:29:11', '2016-08-27', '1191 North Avenue, Apt 409', '', 'Burlington, VT 05408', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Nelson2016', 'Nelson2016', ''),
(266, NULL, 'Emily', 'Ringer', 'Benjamin', 'Smith', 'emilyjoringer@gmail.com', '4065802747', '2016-06-11 16:32:54', '2016-07-30', '93 Hildred Drive', '', 'Burlington, VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'emilyandben', 'arnold93', ''),
(267, NULL, 'Jillian', 'White', 'Lucas', 'Towne', 'lucasdonovantowne@gmail.com', '802-881-4418', '2016-06-15 01:34:43', '2016-10-16', '3260 Greenbush Rd', '', 'Charlotte, VT 05445', '', '', '', '', '', '', '802-881-1854', '', '', '', NULL, NULL, 'lucasjill2016', 'J+L4ever', ''),
(268, NULL, 'Joseph', 'MacGowan', '', '', 'macgowanw@yahoo.com', '8025227254', '2016-07-02 22:58:55', '2016-07-07', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'jmacgowa', 'Elibitch7', ''),
(269, NULL, 'Kristine', 'Foley', 'Colden', 'McClurg', 'kfoley0525@gmail.com', '907-444-9398', '2016-08-04 17:50:46', '2016-09-17', '25 Hickok Street', '', 'Winooski Vt 05404', '', '', '', '', '', '', '315-413-1245', '', '', '', NULL, NULL, 'kfoley', 'Hodge', ''),
(270, NULL, 'Rachael ', 'Roberts', '', '', 'rroberts4@antioch.edu', '603968331', '2016-10-06 12:45:30', '2016-12-25', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'rroberts4', 'rachaelroberts33', ''),
(271, NULL, 'Elysse', 'Parente', 'Adam', 'Wood', 'elysse.parente@benjerry.com', '8028817319', '2017-01-02 17:56:14', '2017-09-09', '46 Old Brooklyn Court', '', 'Richmond, VT 05477', '', '', '', '', '', 'elysse523@yahoo.com', '8027354702', '', '', '', NULL, NULL, 'elysse523', 'vrd2pk', ''),
(272, NULL, 'Lexi', 'Naylor', 'Jake', 'Shinder', 'lexi.naylor@gmail.com', '8439577551', '2017-01-05 22:04:30', '2017-07-01', '44 Marble Ave unit 3', '', 'Burlington, VT 05401', '', '', '', '', '', 'jacobshinder@gmail.com', '', '', '', '', NULL, NULL, 'lnaylor', 'Puravida4!', ''),
(273, NULL, 'Julia', 'Hebrard', 'Nate', 'Kenney', 'julihebrard1@gmail.com', '8024344090', '2017-01-31 20:03:11', '2017-07-29', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'jnk2017', 'eagles75', ''),
(274, NULL, 'Jessica', 'LaMothe', 'Okephief', 'Robinson', 'jlamothe.wsd@gmail.com', '8035786749', '2017-03-05 14:47:20', '2017-05-28', '1162 North Avenue Unit #3', '', 'Burlington, VT 05408', '', '', '', '', '', '', '8023997898', '', '', '', NULL, NULL, 'OkephiefandJess', 'newin1992', ''),
(275, NULL, 'Valerie', 'Esposito', 'Mathew', 'Haskins', 'vle04240@gmail.com', '8023382819', '2017-03-07 18:08:59', '2017-05-27', '12 Logwood Street', '', 'So. Burlington, VT 05403', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'vle04240', 'mathewvalerie2017', ''),
(276, NULL, 'Kristen', 'Brassard', 'Erik', 'Wirkkala', 'shmooliefest@gmail.com', '6033039746', '2017-03-28 23:53:17', '2017-08-05', '21 South Williams Street #6', '', 'Burlington, VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'shmooliefest', 'Alpaca8517', ''),
(277, NULL, 'Annie', 'McNally', 'Todd', 'Hoffmann', 'annelaurenmcnally@gmail.com', '973-590-0074', '2017-04-25 14:32:04', '2017-10-07', '210 Texas Hill Rd.', '', 'Huntington, VT 05462', 'Mary McNally', '', '', '', 'marymcnal@gmail.com', 'toddjhoffmann@gmail.com', '', '', '', '', NULL, NULL, 'annietodd', 'apple123', ''),
(278, NULL, 'Kelsi', 'Powers', 'Elliott', 'Cross', 'kelsi.powers@gmail.com', '802-363-1074', '2017-04-29 17:59:11', '2017-10-07', '73 Air Park Road', 'Apartment 4', 'Shelburne, VT 05482', '', '', '', '', '', 'he.likessoup@gmail.com', '', '', '', '', NULL, NULL, 'CrossPow', '@CritR0le', ''),
(279, NULL, 'Sarah', 'Henry', 'CJ', 'Crow', 'sehenry88@gmail.com', '401-275-3382', '2017-05-28 17:10:25', '2018-09-08', '42 S State St', '', 'Concord, NH 03301', '', '', '', '', '', 'clcrowjr@gmail.com', '603-496-5718', '', '', '', NULL, NULL, 'sehenry88', 'aragorn88', ''),
(280, NULL, 'Sonya', 'Krakoff', 'Alex', 'Epstein', 'sckrakoff@gmail.com', '978-844-1945', '2017-07-09 20:43:43', '2017-09-23', '309 Juniper Drive', '', 'South Burlington, VT 05403', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'sckrakoff', 'alpacas2017', ''),
(281, NULL, 'Garrett', 'Scheier', 'Chana', 'Datskovsky', 'gcs5001@gmail.com', '9083436836', '2017-09-03 21:35:35', '2017-11-19', '659 Lincoln Ave', '', 'Manville, NJ 08835', '', '', '', '', '', 'chanad187@yahoo.com', '6102479010', '', '', '', NULL, NULL, 'GRat', 'Kislev5778', ''),
(282, NULL, 'Emily', 'Ferro', 'Matt', 'Newton', 'EFerr0512@gmail.com', '2032339190', '2017-10-19 10:36:38', '2018-09-01', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'M&E9118', 'Hooked', ''),
(283, NULL, 'Julie', 'Corwin', 'RJ', 'Steinert', 'juliebcorwin@gmail.com', '4435672834', '2017-11-03 15:34:27', '2018-10-14', '69 Joy Drive', 'Apt H2', 'South Burlington, VT 05403', 'Debbie Dennis', 'Sister', '508-596-6486', '', 'deborahelisedennis@gmail.com', '', '', '', '', '', NULL, NULL, 'jcorwin', 'October14', '$2a$07$theclockswerestrikingerDe.OG7fJqJt1klUqtqXRUidJ8u9u/C'),
(284, NULL, 'Sarah', 'Mendonca', 'Brondon', 'Flinigan', 'SarahSMendonca967@gmail.com', '781576961', '2017-11-14 16:31:42', '2020-09-19', '2 Spruce Street', '', 'Stoneham, MA 02180', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'smendonca967', 'C7179r967', ''),
(285, NULL, 'Annie', 'Schneider', 'Josh', 'Wronski', 'wronskischneider2018@gmail.com', '8024977598', '2017-11-18 04:27:49', '2018-09-15', '9 School St', '', 'Burlington, VT, 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'wronskischneider2018', 'Hskiski&7', ''),
(286, NULL, 'Angelie', 'Bouchett', 'Paul', 'Hatfield', 'abouchett@gmail.com', '802-373-1038', '2017-12-03 17:36:05', '2018-08-18', '2 McGregor St', '', 'Essex Jct, VT, 05452', 'Kara Bouchett', 'Sister In Law', '802-734-3163', '', 'Karabouchett@gmail.com', 'pwhatfield@gmail.com', '215-806-7177', '', '', '', NULL, NULL, 'abouchett', 'starstar', ''),
(287, NULL, 'Kirsten', 'Isgro', '', '', 'kisgro@gmail.com', '802-598-0700', '2017-12-06 23:45:38', '2017-12-25', '124 Park Street', '', 'Burlington, VT  05401', '', '', '', '', '', 'tjschicker@gmail.com', '802-881-3690', '', '', '', NULL, NULL, 'uma23sylvie', '1-23-2006', ''),
(288, NULL, 'Jacqueline', 'Lawler', 'Kyle', 'Ross', 'Lawler.Jacqueline@gmail.com', '4012158888', '2017-12-19 17:30:25', '2018-09-22', '176 Intervale Ave', '', 'Burlington, VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'JaquieLaw', 'Angel143', ''),
(289, NULL, 'Megan', 'Foy', 'Jeff', 'Rowe', 'meganraefoy@gmail.com', '8022747213', '2018-01-14 15:36:11', '2018-07-07', '84 Mount Medad Road', '', 'Groton, VT 05046', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'meganfoy', 'MFoy2010', ''),
(290, NULL, 'Amy', 'Sercel', 'CharlieDan', 'Sheffy', 'amysercel@gmail.com', '(603)321-6715', '2018-01-21 19:59:53', '2018-08-11', '193 Saint Paul Street #302', '', 'Burlington, VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'AmySercel', 'Lavender978', ''),
(291, NULL, 'Johanna', 'Kelley', 'David', 'Curley', 'kelley.curley519@gmail.com', '802-989-5913', '2018-02-09 20:57:28', '2018-05-19', '58 Central Street', '', 'South Burlinton, VT 05482', 'Deb', 'Mom', '802-989-8085', '', '', 'Davecurley12@gmail.com', '802-557-2619', '', '', '', NULL, NULL, 'jkelley', 'kc051918', ''),
(293, NULL, 'Elizabeth', 'Pattison', 'Peter', 'Vant', 'pmvekpwedding@gmail.com', '5855076383', '2018-02-17 20:44:03', '2018-10-13', '60 University Terrace', '', 'Burlington, Vermont 05401', '', '', '', '', '', '', '5185784919', '', '', '', NULL, NULL, 'pmvekpwedding', 'alottleditto', ''),
(294, NULL, 'Peter', 'Vant', 'Elizabeth', 'Pattison', 'pmvekpwedding@gmail.com', '5855076383', '2018-02-19 21:03:15', '2018-10-13', '60 University Terr', '', 'Burlington, VT 05401', '', '', '', '', '', '', '5185784919', '', '', '', NULL, NULL, 'pmvekp', 'dittoalottle', ''),
(295, NULL, 'Neal', 'Goswami', 'Erin', 'Sigrist', 'neal.goswami@gmail.com', '802-233-6419', '2018-02-24 22:52:53', '2018-09-09', '68 East State Street Apt 1', '05602', 'Montpelier, VT 05602', '', '', '', '', '', 'neal.@gmail.com', '', '', '', '', NULL, NULL, 'erinandneal', 'erinandneal1', ''),
(306, NULL, 'Susie', 'Schroeder', 'Matt', 'Perry', 'schroeder.susie.q@gmail.com', '8025982823', '2018-06-25 15:33:33', '2018-08-18', '34 Hoover St. ', '', 'Burlington, VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'averyperrywedding', NULL, '$2a$07$theclockswerestrikingeGOBSQ81I6DSbRoXliZhTULXDSg83RDW'),
(297, NULL, 'Meghan', 'Clancy', 'Alissa', 'Carberry', 'majc2018@gmail.com', '5082509637', '2018-03-07 22:29:27', '2018-09-29', '48 Monroe street #2', '', 'Burlington VT 05401', '', '', '', '', '', 'm.a.clancy4823@gmail.com', '5084046110', '', '', '', NULL, NULL, 'majc2018', 'weddingdog18', ''),
(298, NULL, 'Cristiana', 'Martinez', 'Elliot', 'Franklin', 'cefwed@gmail.com', '9789982812', '2018-03-10 22:05:26', '2018-07-22', '86 Silver Fox Cove', '', 'Shelburne, VT. 05482', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'cefwed', 'cefwed', ''),
(299, NULL, 'Rita', 'Wozniak ', 'William ', 'Veve', 'ukulelelulu@gmail.com', '917-686-2136', '2018-03-27 21:34:00', '2018-09-09', 'PO box 1088', '', 'Jericho Center, VT 05465', '', '', '', '', '', '', '802-497-4922', '', '', '', NULL, NULL, 'RitaCheetah ', 'weddingmonkey2018', ''),
(300, NULL, 'Alexa', 'DeLorge', 'Matt', 'Croto', 'adelorge.hp@gmail.com', '8029228777', '2018-04-06 19:47:19', '2018-10-31', '82 Intervale Ave', '', 'Burlington VT 05401', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'adelorge', 'ypsyg0122', ''),
(301, NULL, 'Lindsey ', 'Warner', 'Brad', 'Collins', 'warner.a.lindsey@gmail.com', '8025359155', '2018-04-06 22:48:30', '2018-08-25', '', '', '', '', '', '', '', '', '', '8025357692', '', '', '', NULL, NULL, 'lwarner329', 'slowtrain144', ''),
(302, NULL, 'James', 'Shea', 'Dorothy', '', 'james2shea@yahoo.com', '7737122335', '2018-04-08 14:42:29', '2018-07-15', '13 Bailey Avenue', '', 'Montpelier, VT, 05602', '', '', '', '', '', '', '', '', '', '', NULL, NULL, 'jameshea', 'doublecity2012', ''),
(303, NULL, 'Karen', 'Nickerson', 'Karen', 'Nickerson', 'nickersonkp@gmail.com', '607-222-4637', '2018-04-28 19:47:03', '2019-04-11', '', '', '', 'karen', '', '', '', '', '', '', '', '', '', NULL, NULL, 'Karen1950', 'Dustypearl', ''),
(305, NULL, 'Charlotte ', 'Nye', 'Oscar ', 'Isaac', 'oscarisaac@theguyfromstarwars.com', '657 654 9986', '2018-06-22 22:07:30', '2018-08-17', '465 Mezzanine Ave ', 'Tatooine', 'Star Wars Planet 978640', '', '', '', '', '', 'charlotte.nye@thisisafakereistryformark.gov', '265 809 6755', '465 Mezzanine Ave', 'Tatooine', 'Star Wars Planet 978640', NULL, NULL, 'csnye', NULL, '$2a$07$theclockswerestrikingeYfIppkW6QrSRsraH.Xf7wgRzsrcVeXq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registry`
--
ALTER TABLE `registry`
  ADD PRIMARY KEY (`reg_ID`),
  ADD UNIQUE KEY `regnum` (`reg_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registry`
--
ALTER TABLE `registry`
  MODIFY `reg_ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2017 at 05:33 PM
-- Server version: 5.6.29-76.2-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myendzsb_janaushadhi`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerName` text NOT NULL,
  `customerAddress` text NOT NULL,
  `mobile_number` varchar(100) NOT NULL,
  `doctor_name` varchar(250) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `total_amount` float(10,2) NOT NULL,
  `date` date NOT NULL,
  `note` text NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDelete` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customerName`, `customerAddress`, `mobile_number`, `doctor_name`, `invoice_no`, `total_amount`, `date`, `note`, `createAt`, `isDelete`) VALUES
(1, 'Brijesh', 'A-6/7,Shyamnagar Society, Nr. Vasantbhikha''s wadi,\r\nL.H Road,Varachha', '9033668627', 'Doctor', 'inv2016121', 241.50, '2016-12-18', 'rarwa', '2016-12-17 19:35:10', 0),
(2, 'Dy', 'Tfu', '568', 'Chjh', 'inv2016122', 538.65, '2016-12-21', '', '2016-12-21 06:24:41', 0),
(3, 'MR.XYZ', 'XYZ', '9912366015', 'DR RANA', 'inv2016123', 11.22, '2016-12-21', 'PATIENT HISTORY-DIABETIC', '2016-12-21 10:33:58', 0),
(4, 'MR.M', 'ZZZ', '86767567645', 'ZZZ', 'inv2016124', 168.60, '2016-12-21', '', '2016-12-21 11:08:09', 0),
(5, 'XYZ', 'FHYFG', '636363636', 'FYHR', 'inv2016125', 113.40, '2016-12-21', '', '2016-12-21 10:52:09', 0),
(6, 'NN', 'SSSSS', '5557747737', 'VVVV', 'inv2016126', 144.06, '2016-12-21', '', '2016-12-21 11:01:24', 0),
(7, 'FFF', 'DDD', '677477474574', 'DDD', 'inv2016127', 151.20, '2016-12-21', '', '2016-12-21 11:03:10', 0),
(8, 'BBBB', 'YHUTJ', '564754869769', 'GHTUH', 'inv2016128', 189.00, '2016-12-21', '', '2016-12-21 11:04:09', 0),
(9, 'HTRYTH', 'HTRR', '756760736', 'FH', 'inv2016129', 189.00, '2016-12-21', '', '2016-12-21 11:04:53', 0),
(10, 'BHFDHD', 'GJGFJF', '855658', 'GJKM', 'inv20161210', 33.66, '2016-12-21', '', '2017-02-11 18:06:52', 0),
(11, 'XXX', 'XXX', 'XXX', 'XXX', 'inv20161211', 22.44, '2016-12-21', '', '2016-12-21 13:11:39', 0),
(12, 'XXX', 'XXX', 'XX', 'XX', 'inv20161212', 67.32, '2016-12-21', '', '2016-12-21 13:12:13', 0),
(13, 'XX', 'X', 'XX', 'X', 'inv20161213', 44.95, '2016-12-21', '', '2016-12-21 13:31:33', 0),
(14, 'Brijesh12', 'A-6/7,Shyamnagar Society, Nr. Vasantbhikha''s wadi,\r\nL.H Road,Varachha', '9033668627', 'Doctor', 'inv20161214', 522.00, '2016-12-21', 'test note1', '2016-12-21 18:01:05', 0),
(15, 'xxx', 'xxx', 'xxx', 'xxx1', 'inv20161215', 53.95, '2016-12-24', '', '2016-12-29 14:12:19', 0),
(16, 'xxx', 'xxx', 'xxx', 'xxx', 'inv20170116', 44.95, '2017-01-27', '', '2017-01-27 10:07:30', 0),
(17, 'jinal patel', '17 raghuvir bunglows \r\ncity light\r\nsurat', '9723029693', 'dr  h k patel', 'inv20170217', 53.95, '2017-02-02', '', '2017-02-02 04:51:45', 0),
(18, 'PRIYA PATEL', '', '', '', 'inv20170218', 286.00, '2017-02-06', '', '2017-02-11 18:10:02', 0),
(19, 'Brijes', '', '', '', 'inv20170219', 45.00, '2017-02-11', 'Test', '2017-02-11 18:15:10', 0),
(20, 'Bri', '', '', '', 'inv20170220', 48.00, '2017-02-12', '', '2017-02-11 18:38:32', 0),
(21, 'TEst', '', '', '', 'inv20170221', 108.00, '2017-02-15', 'Testing\r\n', '2017-02-14 19:16:58', 0),
(22, 'Tt', '', '', '', 'inv20170222', 108.00, '2017-02-15', '', '2017-02-14 19:18:40', 0),
(23, 'Test', '', '', '', 'inv20170223', 298.65, '2017-02-15', '', '2017-02-17 08:04:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `medcine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` float(10,2) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isDelete` tinyint(1) NOT NULL COMMENT '1=deleted',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `customer_id`, `medcine_id`, `quantity`, `discount`, `total`, `createdAt`, `isDelete`) VALUES
(3, 1, 1, 2, 0, 194.00, '2016-12-17 19:35:10', 0),
(4, 1, 2, 1, 0, 47.50, '2016-12-17 19:35:10', 0),
(5, 2, 3, 1, 5, 538.65, '2016-12-21 06:24:41', 0),
(9, 3, 9, 1, 67, 11.22, '2016-12-21 10:36:14', 0),
(11, 5, 10, 3, 20, 113.40, '2016-12-21 10:52:09', 0),
(12, 6, 7, 1, 40, 93.00, '2016-12-21 11:01:24', 0),
(13, 6, 8, 1, 61, 13.26, '2016-12-21 11:01:24', 0),
(14, 6, 10, 1, 20, 37.80, '2016-12-21 11:01:24', 0),
(15, 7, 10, 4, 20, 151.20, '2016-12-21 11:03:10', 0),
(16, 8, 10, 5, 20, 189.00, '2016-12-21 11:04:09', 0),
(17, 9, 10, 5, 20, 189.00, '2016-12-21 11:04:53', 0),
(18, 10, 9, 3, 67, 33.66, '2016-12-21 11:06:52', 0),
(19, 4, 10, 2, 20, 75.60, '2016-12-21 11:08:09', 0),
(20, 4, 7, 1, 40, 93.00, '2016-12-21 11:08:09', 0),
(21, 11, 9, 2, 67, 22.44, '2016-12-21 13:11:39', 0),
(22, 12, 9, 6, 67, 67.32, '2016-12-21 13:12:13', 0),
(23, 13, 11, 1, 69, 44.95, '2016-12-21 13:31:33', 0),
(28, 14, 11, 4, 10, 522.00, '2016-12-21 18:01:05', 0),
(41, 15, 11, 1, 69, 44.95, '2016-12-29 14:12:29', 0),
(42, 15, 12, 1, 10, 9.00, '2016-12-29 14:12:29', 0),
(43, 16, 11, 1, 69, 44.95, '2017-01-27 10:07:30', 0),
(44, 17, 11, 1, 69, 44.95, '2017-02-02 04:51:45', 0),
(45, 17, 12, 1, 10, 9.00, '2017-02-02 04:51:45', 0),
(76, 18, 13, 1, 40, 60.00, '2017-02-11 18:08:59', 0),
(77, 18, 11, 5, 69, 217.50, '2017-02-11 18:08:59', 0),
(78, 18, 12, 1, 10, 9.00, '2017-02-11 18:08:59', 0),
(81, 19, 11, 1, 69, 45.00, '2017-02-11 18:37:49', 0),
(82, 20, 11, 1, 67, 48.00, '2017-02-11 18:38:32', 0),
(85, 21, 14, 1, 10, 108.00, '2017-02-14 19:17:15', 0),
(87, 22, 14, 1, 10, 108.00, '2017-02-14 19:18:40', 0),
(90, 23, 14, 2, 10, 216.00, '2017-02-17 08:04:17', 0),
(91, 23, 15, 1, 5, 82.65, '2017-02-17 08:04:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE IF NOT EXISTS `medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `company_name` text NOT NULL,
  `code` varchar(100) NOT NULL,
  `batch_code` varchar(100) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `amount_cost` float(10,2) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT '0',
  `quantity` int(11) NOT NULL,
  `discription` text NOT NULL,
  `expiry` date NOT NULL,
  `isDelete` tinyint(1) NOT NULL COMMENT '1=deleted',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `name`, `company_name`, `code`, `batch_code`, `amount`, `amount_cost`, `discount`, `quantity`, `discription`, `expiry`, `isDelete`, `createdAt`) VALUES
(1, 'Aspirin', 'Aspirin', '3984', 'sd92', 100.00, 85.00, 0, 85, 'Aspirin medicine', '2016-12-20', 1, '2016-12-21 09:32:19'),
(2, 'Sophramycine', 'Sophramycin', '23423', 'r8494r', 50.00, 45.00, 5, 30, 'tetseets', '2016-12-31', 1, '2016-12-21 09:32:17'),
(3, 'Gfgh', 'Fty', 'Try', '66', 567.00, 578.00, 5, 2, 'Yhugg', '2016-12-20', 1, '2016-12-21 09:25:33'),
(4, 'RESUTA 10', 'GERMAN', '01', 'Z111', 145.00, 19.68, 69, 40, 'ROSUVASTATINE 10 MG', '2018-05-30', 1, '2016-12-21 09:32:22'),
(5, 'MONTENA-L', 'SAYONA', 'XYZ', 'XYZ', 14.01, 99.00, 60, 4, 'montelukast', '2017-12-30', 1, '2016-12-21 09:51:27'),
(6, 'MONTENA-L', 'SAYONA', 'XYZ', 'XYZ', 99.00, 14.01, 60, 1, 'MONTELUKAST', '2017-12-30', 1, '2016-12-21 13:18:09'),
(7, 'COBLANA-CA', 'SAYONA', 'XYZ', 'XYZ', 155.00, 24.72, 40, 10, 'MECOBALAMINE,ALPHA LIPOIC ACID,FOLIC ACID PYRIDOXINE HYDROCHLORIDE', '2017-11-29', 1, '2016-12-21 13:18:07'),
(8, 'ZYROCON 100MG', 'XYZ', 'XYZ', 'XYZ', 34.00, 7.87, 61, 1, 'ALLOPURINOL 100MG', '2017-11-20', 1, '2016-12-21 13:18:05'),
(9, 'EL-PIO-15', 'ELDER', 'XYZ', 'XYZ', 34.00, 6.03, 67, 15, 'PIOGLITAZONE 150 MG', '2017-06-12', 1, '2016-12-21 13:18:03'),
(10, 'GLIMIMORE-2MF', 'XYZ', 'XYZ', 'XYZ', 47.25, 8.29, 20, 20, 'GLIMEPIRIDE NAD ', '2017-12-11', 1, '2016-12-21 13:18:01'),
(11, 'RESUTA 10MG', 'GERMAN', '111', '000', 145.00, 19.68, 69, 15, 'ROSUVASTATINE 10 MG', '2018-06-13', 1, '2017-02-13 07:57:17'),
(12, 'RESUTA 112MG', 'RESUTA 112MG', 'RESUTA 112MG', 'RESUTA 112MG', 10.00, 9.00, 10, 11, 'RESTA 112MG', '2016-12-27', 1, '2017-02-13 07:57:14'),
(13, 'COBLONA PLUS', 'AAD PHARMA', '112554', 'XXC12', 100.00, 10.00, 40, 10, 'METHYLCOBLAMIN PYRIDOXIN', '2022-12-01', 1, '2017-02-13 07:57:12'),
(14, 'Test', 'test', 'test', 'test', 120.00, 100.00, 10, 120, 'Data', '2017-02-15', 0, '2017-02-14 19:12:30'),
(15, 'Test1', 'Testcompany', '2735', '48383', 87.00, 90.00, 5, 10, 'Test ', '2017-02-17', 0, '2017-02-17 08:02:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

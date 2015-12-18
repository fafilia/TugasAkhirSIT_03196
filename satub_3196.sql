-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2015 at 03:29 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `satub_3196`
--

-- --------------------------------------------------------

--
-- Table structure for table `valuta_asing`
--

CREATE TABLE IF NOT EXISTS `valuta_asing` (
  `mata_uang` varchar(3) NOT NULL,
  `jual` decimal(20,2) NOT NULL,
  `beli` decimal(20,2) NOT NULL,
  `rec_upd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `valuta_asing`
--

INSERT INTO `valuta_asing` (`mata_uang`, `jual`, `beli`, `rec_upd`) VALUES
('USD', '14035.00', '14015.00', '18 Des 2015 / 08:17 WIB'),
('SGD', '9889.55', '9869.55', '18 Des 2015 / 08:17 WIB'),
('EUR', '15253.10', '15153.10', '18 Des 2015 / 08:17 WIB'),
('AUD', '10033.52', '9953.52', '18 Des 2015 / 08:17 WIB'),
('DKK', '2077.81', '1997.81', '18 Des 2015 / 08:17 WIB'),
('SEK', '1680.29', '1600.29', '18 Des 2015 / 08:17 WIB'),
('CAD', '10095.21', '10015.21', '18 Des 2015 / 08:17 WIB'),
('CHF', '14149.74', '14049.74', '18 Des 2015 / 08:17 WIB'),
('NZD', '9438.16', '9358.16', '18 Des 2015 / 08:17 WIB'),
('GBP', '20956.37', '20856.37', '18 Des 2015 / 08:17 WIB'),
('HKD', '1824.06', '1794.06', '18 Des 2015 / 08:17 WIB'),
('JPY', '116.27', '112.87', '18 Des 2015 / 08:17 WIB'),
('SAR', '3779.28', '3699.28', '18 Des 2015 / 08:17 WIB'),
('CNY', '2174.84', '2094.84', '18 Des 2015 / 08:17 WIB');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

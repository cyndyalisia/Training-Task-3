-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2017 at 01:37 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `training3`
--

-- --------------------------------------------------------

--
-- Table structure for table `wordpress`
--

CREATE TABLE `wordpress` (
  `ID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `phone_number` int(12) NOT NULL,
  `testimonial` varchar(100) NOT NULL,
  `blog_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wordpress`
--

INSERT INTO `wordpress` (`ID`, `name`, `email`, `phone_number`, `testimonial`, `blog_id`) VALUES
(948, 'dasdsad', 'asdbsbd@adjasbd.com', 9182812, 'ddjsd asbdhsbdhas', 'http://127.0.0.1/trainingTask3/thirdsite'),
(2, 'sad vfrf', 'rt@gaga.com', 89999, 'dbd dasdsad sadsdb sfsdf', 'http://127.0.0.1/trainingTask3/secondsite'),
(90, 'bbbvb bbbb', 'hahaha@ffa.com', 8722239, 'sdsdc bvbdhd cncmmkdj chdysim vv', 'http://127.0.0.1/trainingTask3/secondsite'),
(65, 'g bbbbnh', 'jkkk@ggg.com', 54321, 'zxcvb cvbng dfghj', 'http://127.0.0.1/trainingTask3/firstsite/');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

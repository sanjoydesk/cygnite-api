-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 03, 2012 at 01:02 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `guestbook`
--

CREATE TABLE IF NOT EXISTS `guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `EntryDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Comment` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `EntryDate` (`EntryDate`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `guestbook`
--

INSERT INTO `guestbook` (`id`, `Name`, `EntryDate`, `Comment`) VALUES
(1, 'Sanjay', '2012-04-23 00:00:00', 'Hi !!! How r u all ??'),
(5, 'Sanjay', '2012-04-25 00:00:00', 'Hmmmm So Gorge where are you residing currently ??'),
(8, 'Ashish', '2012-04-26 00:00:00', 'HI !!! All how do u do ?? '),
(13, 'Ashish Kumar', '2012-05-12 00:00:00', 'Hi !!! How r You all ??'),
(14, 'Akhil', '2012-05-15 00:00:00', 'I am working with your code. Its Awesome and working gud. '),
(15, 'Akhil', '2012-05-15 00:00:00', 'I am working with your code. Its Awesome and working gud. '),
(16, 'Sanjay', '2012-05-15 00:00:00', 'Hello Akhil. Thank You. Keep using. I will add lots of features to it. '),
(18, 'Abhilash', '2012-05-15 00:00:00', 'Hi !!! This is Stored Procedure.'),
(19, 'Sanjay', '2012-06-04 15:21:48', 'Hai !! This EVent'),
(20, 'Sanjay', '2012-06-04 15:21:50', 'Hai !! This EVent');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

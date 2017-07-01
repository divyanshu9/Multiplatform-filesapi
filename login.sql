-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2017 at 10:13 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL,
  `securityquestion` varchar(100) NOT NULL,
  `securityanswer` varchar(20) NOT NULL,
  `points` int(11) NOT NULL,
  `firsttime` varchar(10) NOT NULL DEFAULT 'TRUE',
  `wizard` int(1) NOT NULL,
  `ppic` varchar(15) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `occupation` varchar(20) NOT NULL,
  `state` varchar(25) NOT NULL,
  `city` varchar(25) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `circlelist` varchar(255) NOT NULL,
  `requests` varchar(255) NOT NULL,
  `files` varchar(1000) NOT NULL,
  `apikey` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `fullname`, `email`, `password`, `securityquestion`, `securityanswer`, `points`, `firsttime`, `wizard`, `ppic`, `dob`, `occupation`, `state`, `city`, `gender`, `circlelist`, `requests`, `files`, `apikey`) VALUES
(25, 'divyanshu9', 'Divyanshu Mishra', 'mishradivyanshu05@gmail.com', '137406', 'What is Your birth place?', 'lucknow', 0, 'FALSE', 0, 'divyanshu9.png', '10/05/1995', 'Student', '', 'Karnal', 'male', '27 26 ', '', '', ''),
(26, 'rajivmishra', 'RAJIV MISHRA', 'rajivmishra12@rediffmail.com', '123', 'What is Your birth place?', 'lucknow', 0, 'FALSE', 0, 'rajivmishra.jpg', '26/10/1972', 'Service', '', 'Karnal', 'male', '27 25 ', '', '', ''),
(27, 'divyansu7', 'Prince Mishra', 'mishradivyansu7@gmail.com', '12', 'What is Your favourite destination?', 'goa', 0, 'FALSE', 0, 'divyansu7.jpg', '05/10/1995', 'Student', '', 'Karnal', 'male', '26 25 ', '', '', ''),
(40, 'e', '', 'e', 'e1671797c52e15f763380b45e841ec32', '', '', 0, 'TRUE', 0, '', '', '', '', '', '', '', '', 'Admit_Card.pdf Sr.pdf ', 't9kCh286QTqy8XXqDJcaQYAB'),
(41, 'f', '', 'f', '8fa14cdd754f91cc6554c9e71929cce7', '', '', 0, 'TRUE', 0, '', '', '', '', '', '', '', '', 'bzip.zip samajwadisp.pdf ', 'XO85TyahJCOczxhh0NbcyUwY');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

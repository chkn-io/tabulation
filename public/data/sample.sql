-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2015 at 07:16 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=143 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `age`) VALUES
(135, 'data1', '27be4f8929966693fa34ef9225fc891e', 'data1 name', 1),
(136, 'data2', '27be4f8929966693fa34ef9225fc891e', 'data2 name', 1),
(137, 'data3', 'fb98cb5fc7a6f68bfb3722fec79ca3b3', 'data3 name', 4),
(138, 'data4', 'fb98cb5fc7a6f68bfb3722fec79ca3b3', 'data4 name', 4),
(139, 'data5', 'fb98cb5fc7a6f68bfb3722fec79ca3b3', 'data5 name', 4),
(140, 'rexie', '85ce5b16a7e160e9b8c346c4cce3edfd', 'rexie', 90),
(141, 'Percian', '85ce5b16a7e160e9b8c346c4cce3edfd', 'rexie', 90),
(142, 'rexie', '5c41ccf564ebd90e1d92f11c8ee8ef14', 'maria resureccion maan', 90);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=143;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

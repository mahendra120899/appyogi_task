-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2023 at 05:17 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appyogi`
--

-- --------------------------------------------------------

--
-- Table structure for table `aquire_control_by`
--

CREATE TABLE `aquire_control_by` (
  `id` int(11) NOT NULL,
  `user_id` enum('1','2','0','') NOT NULL DEFAULT '0',
  `acessupto_time` varchar(255) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aquire_control_by`
--

INSERT INTO `aquire_control_by` (`id`, `user_id`, `acessupto_time`) VALUES
(1, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `romote_keys`
--

CREATE TABLE `romote_keys` (
  `id` int(255) NOT NULL,
  `color` enum('white','red','yellow','') NOT NULL DEFAULT 'white'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `romote_keys`
--

INSERT INTO `romote_keys` (`id`, `color`) VALUES
(1, 'white'),
(2, 'white'),
(3, 'white'),
(4, 'white'),
(5, 'white'),
(6, 'white'),
(7, 'white'),
(8, 'white'),
(9, 'white'),
(10, 'white');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aquire_control_by`
--
ALTER TABLE `aquire_control_by`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `romote_keys`
--
ALTER TABLE `romote_keys`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aquire_control_by`
--
ALTER TABLE `aquire_control_by`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `romote_keys`
--
ALTER TABLE `romote_keys`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

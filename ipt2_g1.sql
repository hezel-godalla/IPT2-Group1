-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 03:23 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ipt2_g1`
--

-- --------------------------------------------------------

--
-- Table structure for table `celebrities`
--

CREATE TABLE `celebrities` (
  `id` int(255) NOT NULL,
  `Nam` varchar(255) NOT NULL,
  `Age` int(10) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `Occupation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `celebrities`
--

INSERT INTO `celebrities` (`id`, `Nam`, `Age`, `Gender`, `Occupation`) VALUES
(5, 'Jessica Mantes', 17, 'Female', 'Dancer'),
(6, 'Hezel Godalla', 12, 'Female', 'Dancer'),
(7, 'jordan smith', 69, '50/50', 'Singer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `celebrities`
--
ALTER TABLE `celebrities`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table milktea
--
ALTER TABLE 'celebrities'
  MODIFY 'id' int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table registeredusers
--

CREATE TABLE registeredusers (
  'id' int(255) NOT NULL,
  'name' varchar(255) NOT NULL,
  'email' varchar(255) NOT NULL,
  'username' varchar(255) NOT NULL,
  'password' varchar(255) NOT NULL,
  'creationdate' timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for table registeredusers
--
ALTER TABLE 'registeredusers'
  ADD PRIMARY KEY ('id');

--
-- AUTO_INCREMENT for table registeredusers
--
ALTER TABLE 'registeredusers'
  MODIFY 'id' int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
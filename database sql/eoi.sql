-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2025 at 02:45 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `JobReferenceNumber` varchar(10) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `StreetAddress` varchar(40) NOT NULL,
  `SuburbTown` varchar(40) NOT NULL,
  `State` char(3) NOT NULL,
  `Postcode` char(4) NOT NULL,
  `EmailAddress` varchar(255) NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL,
  `skill1` tinyint(1) DEFAULT NULL,
  `skill2` tinyint(1) DEFAULT NULL,
  `skill3` tinyint(1) DEFAULT NULL,
  `OtherSkills` text DEFAULT NULL,
  `Status` enum('New','Current','Final') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `JobReferenceNumber`, `FirstName`, `LastName`, `DateOfBirth`, `Gender`, `StreetAddress`, `SuburbTown`, `State`, `Postcode`, `EmailAddress`, `PhoneNumber`, `skill1`, `skill2`, `skill3`, `OtherSkills`, `Status`) VALUES
(1, 'DEV001', 'Lee Min', 'Hoo', '2003-10-07', 'male', '6 hẻm 29/70/20 Khương Hạ', 'Quận Thanh Xuân', 'VIC', '1234', 'phuongeds10@gmail.com', '081515080607', 0, 1, 0, 'Professional Actor', 'New'),
(2, 'DEV001', 'Ki', 'Song Jong', '1993-11-08', 'male', '6 hẻm 29/70/20 Khương Hạ', 'Quận Thanh Xuân', 'VIC', '8386', 'songjongkinamdinh@gmail.com', '060715088386', 0, 1, 0, 'Professional actor', 'New'),
(3, 'DEV001', 'Ki', 'Song Jong', '1993-11-08', 'male', '6 hẻm 29/70/20 Khương Hạ', 'Quận Thanh Xuân', 'VIC', '8386', 'songjongkinamdinh@gmail.com', '060715088386', 0, 1, 0, 'Professional actor', 'New');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

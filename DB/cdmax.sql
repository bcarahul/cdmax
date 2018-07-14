-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2018 at 04:57 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdmax`
--

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`, `created_at`, `updated_at`) VALUES
(31, 'Ford', '2018-07-14 05:42:14', '2018-07-14 09:12:14'),
(41, 'sdsdsd', '2018-07-14 10:58:01', '2018-07-14 14:28:01'),
(43, 'dsadas', '2018-07-14 10:58:14', '2018-07-14 14:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `modal_details`
--

CREATE TABLE `modal_details` (
  `id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `modal_name` varchar(100) NOT NULL,
  `manufacturing_year` tinytext NOT NULL,
  `registration_number` varchar(50) NOT NULL,
  `note` varchar(400) NOT NULL,
  `color` varchar(22) NOT NULL,
  `pic1` varchar(300) NOT NULL,
  `pic2` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modal_details`
--

INSERT INTO `modal_details` (`id`, `manufacturer_id`, `modal_name`, `manufacturing_year`, `registration_number`, `note`, `color`, `pic1`, `pic2`, `created_at`, `updated_at`) VALUES
(1, 31, 'Skoda', '1900', 'MH-03 TH-1920', 'Comment', 'RED', 'uploads/Personality Test Results.png', 'uploads/image004.png', '2018-07-14 05:43:11', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modal_details`
--
ALTER TABLE `modal_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mafacturer_id` (`manufacturer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `modal_details`
--
ALTER TABLE `modal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `modal_details`
--
ALTER TABLE `modal_details`
  ADD CONSTRAINT `modal_details_ibfk_1` FOREIGN KEY (`manufacturer_id`) REFERENCES `manufacturers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

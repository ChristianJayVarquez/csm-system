-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 06:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csm_results`
--

-- --------------------------------------------------------

--
-- Table structure for table `cc_awareness`
--

CREATE TABLE `cc_awareness` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `responses` int(11) NOT NULL,
  `percentage` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_quality`
--

CREATE TABLE `service_quality` (
  `id` int(11) NOT NULL,
  `dimension` varchar(255) NOT NULL,
  `strongly_agree` int(11) NOT NULL,
  `agree` int(11) NOT NULL,
  `neutral` int(11) NOT NULL,
  `disagree` int(11) NOT NULL,
  `strongly_disagree` int(11) NOT NULL,
  `total_responses` int(11) GENERATED ALWAYS AS (`strongly_agree` + `agree` + `neutral` + `disagree` + `strongly_disagree`) STORED,
  `overall` decimal(5,2) GENERATED ALWAYS AS ((`strongly_agree` + `agree`) * 100.0 / nullif(`total_responses`,0)) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cc_awareness`
--
ALTER TABLE `cc_awareness`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_quality`
--
ALTER TABLE `service_quality`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cc_awareness`
--
ALTER TABLE `cc_awareness`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_quality`
--
ALTER TABLE `service_quality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

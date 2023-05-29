-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2023 at 09:07 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbumbra`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bingo_numbers`
--

CREATE TABLE `tbl_bingo_numbers` (
  `id` int(11) NOT NULL,
  `game_sessions` varchar(255) NOT NULL,
  `letter` varchar(10) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cards`
--

CREATE TABLE `tbl_cards` (
  `id` int(11) NOT NULL,
  `game_sessions` varchar(255) NOT NULL,
  `letter` varchar(10) NOT NULL,
  `number` int(11) NOT NULL,
  `row` int(11) NOT NULL,
  `is_marked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_game_sessions`
--

CREATE TABLE `tbl_game_sessions` (
  `id` int(11) NOT NULL,
  `game_sessions` varchar(25) NOT NULL,
  `is_game_ended` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bingo_numbers`
--
ALTER TABLE `tbl_bingo_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_sessions_index` (`game_sessions`);

--
-- Indexes for table `tbl_cards`
--
ALTER TABLE `tbl_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_sessions_index` (`game_sessions`);

--
-- Indexes for table `tbl_game_sessions`
--
ALTER TABLE `tbl_game_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `game_sessions_index` (`game_sessions`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bingo_numbers`
--
ALTER TABLE `tbl_bingo_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_cards`
--
ALTER TABLE `tbl_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_game_sessions`
--
ALTER TABLE `tbl_game_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2024 at 03:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mon`
--

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE `websites` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `status_code` int(11) DEFAULT NULL,
  `last_check_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `url`, `status_code`, `last_check_time`) VALUES
(66, 'https://www.google.com', 200, '2024-03-19 13:50:08'),
(67, 'https://www.google.com', 200, '2024-03-19 13:50:12'),
(68, 'https://www.google.com', 200, '2024-03-19 13:50:20'),
(69, 'https://www.google.com', 200, '2024-03-19 13:50:24'),
(70, 'https://www.google.com', 200, '2024-03-19 13:52:11'),
(71, 'https://www.google.com', 200, '2024-03-19 13:57:40'),
(72, 'https://www.google.com', 200, '2024-03-19 13:52:19'),
(73, 'https://www.google.co', 301, '2024-03-19 13:58:31'),
(74, 'https://www.google.co', 301, '2024-03-19 13:58:35'),
(75, 'https://www.google', 400, '2024-03-19 13:58:42'),
(76, 'https://www.google', 400, '2024-03-19 13:58:45'),
(77, 'https://www.google', 400, '2024-03-19 13:58:48'),
(78, 'https://www.google', 400, '2024-03-19 13:58:50'),
(79, 'https://www.google.com', 200, '2024-03-19 14:09:10'),
(80, 'https://www.google.com', 200, '2024-03-19 14:09:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `websites`
--
ALTER TABLE `websites`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `websites`
--
ALTER TABLE `websites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

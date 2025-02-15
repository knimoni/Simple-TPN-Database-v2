-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2025 at 02:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tpn-dtbs-v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `child_id` int(3) NOT NULL,
  `child_name` varchar(100) NOT NULL,
  `child_identifier` varchar(15) NOT NULL,
  `child_gender` varchar(7) NOT NULL,
  `child_height` varchar(3) DEFAULT NULL,
  `child_birthday` varchar(255) DEFAULT NULL,
  `child_bloodtype` varchar(2) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0',
  `images` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`child_id`, `child_name`, `child_identifier`, `child_gender`, `child_height`, `child_birthday`, `child_bloodtype`, `is_delete`, `images`) VALUES
(1, 'Norman', '22194', 'Male', '175', '2034-03-21', 'B', b'1', 'norman.jpg'),
(2, 'Emma', '63194', 'Female', '161', '2034-08-22', 'O', b'0', 'emma.jpg'),
(3, 'Ray', '81194', 'Male', '177', '2034-01-16', 'AB', b'0', 'ray.jpg'),
(4, 'Yugo', 'ETR3M8', 'Male', '182', '2017-12-24', 'A', b'0', 'yugo.jpg'),
(5, 'Lucas', 'KGX2A7', 'Male', '186', '2017-11-28', 'B', b'0', 'lucas.jpg'),
(6, 'Gillian', 'QI 231-493', 'Female', '150', '2030-09-30', 'B', b'0', 'gillian.jpg'),
(7, 'Oliver', 'AII 866-890', 'Male', '174', '2028-10-25', 'B', b'0', 'oliver.jpg'),
(8, 'Violet', 'DIV 332-198', 'Female', '146', '2032-06-12', 'AB', b'0', 'violet.jpg'),
(9, 'Barbara', '-', 'Female', '160', '2031-06-18', 'AB', b'0', 'barbara.jpg'),
(10, 'Zazie', '-', 'Male', '200', '2042-02-02', 'O', b'0', 'zazie.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `locations_id` int(3) NOT NULL,
  `locations_name` varchar(100) NOT NULL,
  `locations_status` varchar(20) NOT NULL,
  `locations_type` varchar(10) NOT NULL,
  `child_id` int(3) NOT NULL,
  `observer_id` int(3) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`locations_id`, `locations_name`, `locations_status`, `locations_type`, `child_id`, `observer_id`, `is_delete`) VALUES
(1, 'Grace Field House', 'The Demon World', 'Plantation', 2, 1, b'0'),
(2, 'Glory Pond', 'The Demon World', 'Plantation', 5, 2, b'0'),
(3, 'Grand Valley', 'The Demon World', 'Plantation', 6, 3, b'1'),
(4, 'Goodwill Ridge', 'The Demon World', 'Plantation', 9, 4, b'0'),
(5, 'Lambda 7214', 'The Demon World', 'Plantation', 10, 5, b'0'),
(6, 'The Promise', 'The Demon World', '-', 1, 8, b'0'),
(7, 'Demon Forest', 'The Demon World', '-', 3, 7, b'0'),
(8, 'Goldy Pond', 'The Demon World', '-', 4, 9, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `observer`
--

CREATE TABLE `observer` (
  `observer_id` int(3) NOT NULL,
  `observer_name` varchar(100) NOT NULL,
  `observer_species` varchar(20) NOT NULL,
  `observer_gender` varchar(7) NOT NULL,
  `is_delete` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `observer`
--

INSERT INTO `observer` (`observer_id`, `observer_name`, `observer_species`, `observer_gender`, `is_delete`) VALUES
(1, 'Isabella', 'Human', 'Female', b'0'),
(2, 'Yukko', 'Human', 'Female', b'0'),
(3, 'Sarah', 'Human', 'Female', b'0'),
(4, 'Matilda', 'Human', 'Female', b'0'),
(5, 'Smee', 'Human', 'Male', b'0'),
(6, 'James Ratri', 'Human', 'Male', b'0'),
(7, 'Sonju', 'Demon', 'Male', b'0'),
(8, 'Mujika', 'Demon', 'Female', b'0'),
(9, 'Leuvis', 'Demon', 'Male', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(9) NOT NULL,
  `username` varchar(44) NOT NULL,
  `password` varchar(221) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `created_at`) VALUES
(3, 'admin', '$2y$10$Y21SMCRIKjEMKgnqTcruZeHw7X6ZQ5NPa6E9Nr/a3EWF4nsQeUUAW', '2022-12-05 19:31:56'),
(5, 'norman', '$2y$10$HxNmRMVRw0WZhIUAvTI0MOCJGfOuG8Jg.k6IWugJFvYK.CLWPYa5m', '2025-02-15 08:21:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`locations_id`),
  ADD KEY `child_id` (`child_id`),
  ADD KEY `observer_id` (`observer_id`);

--
-- Indexes for table `observer`
--
ALTER TABLE `observer`
  ADD PRIMARY KEY (`observer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `locations_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `child` (`child_id`),
  ADD CONSTRAINT `locations_ibfk_2` FOREIGN KEY (`observer_id`) REFERENCES `observer` (`observer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

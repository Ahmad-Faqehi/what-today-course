-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2021 at 02:26 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `summer`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `courseName` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseDay` int(11) NOT NULL,
  `courseTime` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseClass` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `courseTime_inWeek` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `courseName`, `courseDay`, `courseTime`, `courseClass`, `courseTime_inWeek`, `user_id`) VALUES
(1, 'DataBase', 1, '08:00 AM', 'B-41', '3', 2),
(2, 'Algorithm', 1, '9:00 AM', 'C-22', '3', 2),
(3, 'Java', 3, '09:00 AM', 'C77', '3', 2),
(5, 'TEST', 3, '9:00 AM', 'B-01', '3', 1),
(6, 'C++', 2, '08:40 AM', 'C-25', '3', 2),
(8, 'Software Engineering ', 4, '11:00 AM', 'C-25', '3', 2),
(9, 'Tfs', 1, '09:30 AM', 'C-25', '3', 2),
(10, 'HCI', 2, '01:00 PM', 'C-25', '3', 2),
(12, 'Algorithm 2', 2, '02:00 PM', 'C-03', '3', 2),
(13, 'Java', 2, '10:55 AM', '', '', 3),
(14, 'C++', 1, '10:56 AM', '', '', 3),
(15, 'Algorithm 1', 5, '11:00 AM', 'C-25', '3', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `email`, `password`) VALUES
(1, 'Ahmad', 'Faqehi', 'ali@mail.com', 123),
(2, 'Sara', 'Moh', 'Moh@mail.com', 1122),
(3, 'Sultan', 'Ali', 'Ad@mail.com', 123);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

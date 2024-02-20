-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Feb 20, 2024 at 05:02 AM
-- Server version: 11.2.2-MariaDB-1:11.2.2+maria~ubu2204
-- PHP Version: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jac`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `age`) VALUES
(1, 'John Doe', 'john.doe@example.com', 28),
(2, 'Jane Smith', 'jane.smith@example.com', 32),
(5, 'Jessica Williams', 'jessica.williams@example.com', 22),
(6, 'aaa', 'jessica.williams@example.com', 32),
(7, 'bbb', 'bbb@example.com', 44),
(8, 'Daniel Davis', 'daniel.davis@example.com', 42),
(9, 'Laura Garcia', 'laura.garcia@example.com', 26),
(10, 'Kevin Martinez', 'kevin.martinez@example.com', 38),
(11, 'Amanda Rodriguez', 'amanda.rodriguez@example.com', 19),
(12, 'Brian Lee', 'brian.lee@example.com', 33),
(13, 'Sophia Hernandez', 'sophia.hernandez@example.com', 21),
(14, 'Ethan Gonzalez', 'ethan.gonzalez@example.com', 29),
(15, 'Madison Wilson', 'madison.wilson@example.com', 36),
(16, 'Alexander Moore', 'alexander.moore@example.com', 40),
(17, 'Olivia Taylor', 'olivia.taylor@example.com', 23),
(18, 'James Anderson', 'james.anderson@example.com', 31),
(19, 'Victoria Thomas', 'victoria.thomas@example.com', 25),
(20, 'Logan Jackson', 'logan.jackson@example.com', 34);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

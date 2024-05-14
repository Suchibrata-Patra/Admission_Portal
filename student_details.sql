-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 14, 2024 at 02:33 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `reg_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'NA',
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'NA',
  `district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'NA',
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'NA',
  `PIN Code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'NA',
  `terms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailVerify` int(255) NOT NULL DEFAULT '0',
  `numberVerify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `forgot_password_otp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_reset_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ispaymentdone` int(1) NOT NULL DEFAULT '0',
  `issubmitted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`reg_no`, `fname`, `lname`, `email`, `phoneNumber`, `dob`, `Address`, `city`, `district`, `state`, `PIN Code`, `terms`, `password`, `emailVerify`, `numberVerify`, `forgot_password_otp`, `password_reset_status`, `ispaymentdone`, `issubmitted`) VALUES
('1233122', 'Suchibrata', 'Patra', 'suchibratapatra2003@gmail.com', '9475755847', '2003-01-01', 'NA', 'NA', 'NA', 'NA', 'NA', 'on', '2003', 1, '1', NULL, NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`reg_no`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`),
  ADD UNIQUE KEY `reg_no` (`reg_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

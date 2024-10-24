-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 22, 2024 at 05:50 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `secure_login_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `Secure_Login_Stack`
--

CREATE TABLE `Secure_Login_Stack` (
  `secure_admin_login_id` int(11) NOT NULL,
  `secure_admin_username` varchar(50) NOT NULL,
  `secure_admin_password_hash` varchar(255) NOT NULL,
  `secure_otp_code` varchar(10) DEFAULT NULL,
  `secure_otp_expires_at` timestamp NULL DEFAULT NULL,
  `secure_admin_account_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Secure_Login_Stack`
--

INSERT INTO `Secure_Login_Stack` (`secure_admin_login_id`, `secure_admin_username`, `secure_admin_password_hash`, `secure_otp_code`, `secure_otp_expires_at`, `secure_admin_account_created_at`) VALUES
(4, '2003', '$2y$10$DB12ajHi/csM3sEWrNQOq./cx4kjuj56703kyVkYxWu82g/Yaq3qO', NULL, NULL, '2024-10-18 18:38:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Secure_Login_Stack`
--
ALTER TABLE `Secure_Login_Stack`
  ADD PRIMARY KEY (`secure_admin_login_id`),
  ADD UNIQUE KEY `secure_admin_username` (`secure_admin_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Secure_Login_Stack`
--
ALTER TABLE `Secure_Login_Stack`
  MODIFY `secure_admin_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

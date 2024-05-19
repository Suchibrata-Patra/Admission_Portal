-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 19, 2024 at 03:08 AM
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
-- Table structure for table `9475755847_HOI_Login_Credentials`
--

CREATE TABLE `9475755847_HOI_Login_Credentials` (
  `HOI_UDISE_ID` varchar(20) NOT NULL,
  `HOI_Password` varchar(100) NOT NULL,
  `HOI_Email_ID` varchar(50) NOT NULL,
  `HOI_Mobile_No` varchar(50) DEFAULT NULL,
  `is_HOI_Account_Verified` int(2) NOT NULL DEFAULT '0',
  `emailVerify` varchar(10) NOT NULL DEFAULT '0',
  `numberVerify` varchar(10) NOT NULL DEFAULT '0',
  `Institution_Name` varchar(255) DEFAULT NULL,
  `HOI_Name` varchar(50) DEFAULT NULL,
  `Institution_Address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `9475755847_HOI_Login_Credentials`
--

INSERT INTO `9475755847_HOI_Login_Credentials` (`HOI_UDISE_ID`, `HOI_Password`, `HOI_Email_ID`, `HOI_Mobile_No`, `is_HOI_Account_Verified`, `emailVerify`, `numberVerify`, `Institution_Name`, `HOI_Name`, `Institution_Address`) VALUES
('320873240676', '$2y$10$Rzv6wh1J.M0wuxYmTZNnluLc3OX4lvMRsSvzVznl6gcyAwLj6GYjy', 'suchibratapatra2003@gmail.com', '9475755847', 0, '0', '0', NULL, 'Kamal Kumar Patra', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `9475755847_HOI_Login_Credentials`
--
ALTER TABLE `9475755847_HOI_Login_Credentials`
  ADD PRIMARY KEY (`HOI_UDISE_ID`),
  ADD UNIQUE KEY `HOI_UDISE_ID` (`HOI_UDISE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

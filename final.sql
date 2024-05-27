-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 27, 2024 at 06:27 PM
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
-- Table structure for table `9475755847_Subject_Details`
--

CREATE TABLE `9475755847_Subject_Details` (
  `Combo_ID` int(255) NOT NULL,
  `Stream` varchar(20) NOT NULL,
  `Subject_Combinations` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `9475755847_Subject_Details`
--

INSERT INTO `9475755847_Subject_Details` (`Combo_ID`, `Stream`, `Subject_Combinations`) VALUES
(14, 'Science', 'Physics + Chemistry + Maths + Biology'),
(15, 'Science', 'Physics + Chemistry + Maths + Computer Sc.'),
(16, 'Science', 'Physics + Chemistry + Maths + Statistics'),
(17, 'Arts', 'Pol Sc. + Hist + Geography + Sanskrit'),
(18, 'Commerce', 'abcd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `9475755847_Subject_Details`
--
ALTER TABLE `9475755847_Subject_Details`
  ADD PRIMARY KEY (`Combo_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `9475755847_Subject_Details`
--
ALTER TABLE `9475755847_Subject_Details`
  MODIFY `Combo_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 30, 2024 at 11:34 AM
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
-- Database: `Timora`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `ID` int(11) NOT NULL,
  `Weekday` varchar(10) NOT NULL,
  `Class` varchar(10) DEFAULT NULL,
  `Teacher_ID` int(11) DEFAULT NULL,
  `Class_Time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `class_schedule`
--

INSERT INTO `class_schedule` (`ID`, `Weekday`, `Class`, `Teacher_ID`, `Class_Time`) VALUES
(88, 'Monday', '5A', 29, '3rd'),
(89, 'Monday', '5B', 29, '4th'),
(90, 'Monday', '5A', 1, '1st'),
(91, 'Monday', '5A', 2, '2nd'),
(92, 'Monday', '5B', 1, '2nd'),
(95, 'Monday', '5B', 2, '1st'),
(96, 'Monday', '6A', 2, '1st'),
(97, 'Monday', '6A', 3, '2nd');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `Teacher_ID` int(11) NOT NULL,
  `Teacher_Name` varchar(100) NOT NULL,
  `Subjects` varchar(200) DEFAULT NULL,
  `5_allowed` int(1) NOT NULL DEFAULT '1',
  `6_allowed` int(1) NOT NULL DEFAULT '1',
  `7_allowed` int(1) NOT NULL DEFAULT '1',
  `8_allowed` int(1) NOT NULL DEFAULT '1',
  `9_allowed` int(1) NOT NULL DEFAULT '1',
  `10_allowed` int(1) NOT NULL DEFAULT '1',
  `11_allowed` int(1) NOT NULL DEFAULT '1',
  `12_allowed` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`Teacher_ID`, `Teacher_Name`, `Subjects`, `5_allowed`, `6_allowed`, `7_allowed`, `8_allowed`, `9_allowed`, `10_allowed`, `11_allowed`, `12_allowed`) VALUES
(1, 'S.M', 'Bengali', 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'R.J.M', 'English', 1, 1, 1, 1, 1, 1, 1, 1),
(3, 'P.B', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(4, 'A.K.S', 'Bengali', 1, 1, 1, 1, 1, 1, 1, 1),
(5, 'A.P', 'English', 1, 1, 1, 1, 1, 1, 1, 1),
(6, 'S.M.B', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(7, 'G.C.N', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(8, 'D.S', 'Science', 1, 1, 1, 1, 1, 1, 1, 1),
(9, 'D.B', 'Science', 1, 1, 1, 1, 1, 1, 1, 1),
(10, 'M.S', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(11, 'R.S', 'Science', 1, 1, 1, 1, 1, 1, 1, 1),
(12, 'S.M.P', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(13, 'S.D', 'Science', 1, 1, 1, 1, 1, 1, 1, 1),
(14, 'U.M', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(15, 'P.P', 'Science', 1, 1, 1, 1, 1, 1, 1, 1),
(16, 'G.B', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(17, 'B.M', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(18, 'K.H', 'English', 1, 1, 1, 1, 1, 1, 1, 1),
(19, 'S.H', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(20, 'B.C.B', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(21, 'R.M', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(22, 'B.B', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(23, 'S.B', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(24, 'B.B.H', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(25, 'P.D', 'Bengali', 1, 1, 1, 1, 1, 1, 1, 1),
(26, 'M.K.H', 'English', 1, 1, 1, 1, 1, 1, 1, 1),
(27, 'J.K', 'Bengali', 1, 1, 1, 1, 1, 1, 1, 1),
(28, 'S.Dey', 'Science', 1, 1, 1, 1, 1, 1, 1, 1),
(29, 'B.D', 'English', 1, 1, 1, 1, 1, 1, 1, 1),
(30, 'P.M', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(31, 'S.K.M', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(32, 'G.M', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(33, 'A.B', 'Maths', 1, 1, 1, 1, 1, 1, 1, 1),
(34, 'H.M', 'English', 1, 1, 1, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `unique_schedule` (`Weekday`,`Class`,`Class_Time`),
  ADD KEY `Teacher_ID` (`Teacher_ID`);

--
-- Indexes for table `teacher_profile`
--
ALTER TABLE `teacher_profile`
  ADD PRIMARY KEY (`Teacher_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD CONSTRAINT `class_schedule_ibfk_1` FOREIGN KEY (`Teacher_ID`) REFERENCES `teacher_profile` (`Teacher_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

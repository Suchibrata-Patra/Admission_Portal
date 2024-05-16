-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 16, 2024 at 05:50 AM
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
  `issubmitted` int(1) NOT NULL DEFAULT '0',
  `previous_school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_whatsapp_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_card_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_religion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_caste` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_student_PWD` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_student_EWS` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `student_village_town` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_pin_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_police_station` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_district` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bengali_marks` int(4) DEFAULT NULL,
  `bengali_full_marks` int(4) DEFAULT '100',
  `english_marks` int(4) DEFAULT NULL,
  `english_full_marks` int(4) DEFAULT '100',
  `mathematics_marks` int(4) DEFAULT NULL,
  `mathematics_full_marks` int(4) DEFAULT '100',
  `physical_science_marks` int(4) DEFAULT NULL,
  `physical_science_full_marks` int(4) DEFAULT '100',
  `life_science_marks` int(4) DEFAULT NULL,
  `life_science_full_marks` int(4) DEFAULT '100',
  `history_marks` int(4) DEFAULT NULL,
  `history_full_marks` int(4) DEFAULT '100',
  `geography_marks` int(4) DEFAULT NULL,
  `geography_full_marks` int(4) DEFAULT '100',
  `language_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `select_stream` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_comb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ifsc_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instittuion_fees_payment_done` int(11) DEFAULT '0',
  `institution_fees_payments_ID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portal_fees_payment_done` int(11) DEFAULT '0',
  `portal_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`reg_no`, `fname`, `lname`, `email`, `phoneNumber`, `dob`, `Address`, `city`, `district`, `state`, `PIN Code`, `terms`, `password`, `emailVerify`, `numberVerify`, `forgot_password_otp`, `password_reset_status`, `ispaymentdone`, `issubmitted`, `previous_school_name`, `fathers_name`, `mothers_name`, `current_whatsapp_no`, `aadhar_card_no`, `student_religion`, `student_caste`, `is_student_PWD`, `is_student_EWS`, `student_village_town`, `student_city`, `student_pin_code`, `student_police_station`, `student_district`, `student_state`, `bengali_marks`, `bengali_full_marks`, `english_marks`, `english_full_marks`, `mathematics_marks`, `mathematics_full_marks`, `physical_science_marks`, `physical_science_full_marks`, `life_science_marks`, `life_science_full_marks`, `history_marks`, `history_full_marks`, `geography_marks`, `geography_full_marks`, `language_1`, `language_2`, `select_stream`, `sub_comb`, `bank_name`, `bank_account_no`, `bank_ifsc_code`, `instittuion_fees_payment_done`, `institution_fees_payments_ID`, `portal_fees_payment_done`, `portal_payment_id`) VALUES
('1233122', 'Suchibrata', 'Patra', 'suchibratapatra2003@gmail.com', '9475755847', '2003-01-01', 'NA', 'NA', 'NA', 'NA', 'NA', 'on', '2003', 1, '1', NULL, NULL, 0, 1, 'DHBSSPV', 'Kamal Kumar Patra ', 'Susmita Maity Patra ', '9475755847', '320873240676', 'Hindu', 'General', 'No', 'No', 'Diamond Harbour ', 'Diamond Harbour ', 'Diamond Harbour ', 'Diamond Harbour ', 'Enter District', 'West Bengal', 98, 100, 98, 100, 89, 100, 91, 100, 78, 100, 90, 100, 97, 100, 'Bengali', 'English', 'Science', 'Chemistry+Stat + CS', 'State Bank of INDIA', '0112345674822', 'UBIN031810000538', 0, '', 1, 'pay_OB3RO7YFVqBjpq');

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

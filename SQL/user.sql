-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 10, 2024 at 06:55 AM
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
-- Database: `user`
--

-- --------------------------------------------------------

--
-- Table structure for table `222_HOI_Login_Credentials`
--

CREATE TABLE `222_HOI_Login_Credentials` (
  `HOI_UDISE_ID` varchar(20) NOT NULL,
  `HOI_Password` varchar(100) NOT NULL,
  `HOI_Email_ID` varchar(50) NOT NULL,
  `HOI_Mobile_No` varchar(50) DEFAULT NULL,
  `HOI_Whatsapp_No` varchar(20) DEFAULT NULL,
  `is_HOI_Account_Verified` tinyint(1) NOT NULL DEFAULT '0',
  `emailVerify` tinyint(1) NOT NULL DEFAULT '0',
  `numberVerify` tinyint(1) NOT NULL DEFAULT '0',
  `Institution_Name` varchar(255) DEFAULT NULL,
  `HOI_Name` varchar(50) DEFAULT NULL,
  `Institution_Address` varchar(255) DEFAULT NULL,
  `Coed_Or_Not` varchar(10) DEFAULT 'Coed',
  `Application_Fees` int(5) DEFAULT '200',
  `Bank_Account_No` varchar(30) DEFAULT NULL,
  `Bank_IFSC_Code` varchar(30) DEFAULT NULL,
  `Bank_Branch_Name` varchar(50) DEFAULT NULL,
  `Formfillup_Start_Date` date DEFAULT NULL,
  `Formfillup_Last_Date` date DEFAULT NULL,
  `First_merit_list_date` date DEFAULT NULL,
  `Admission_Beginning_for_First_List` date DEFAULT NULL,
  `Admission_Closes_For_First_List` date DEFAULT NULL,
  `Second_List` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `222_Student_Details`
--

CREATE TABLE `222_Student_Details` (
  `reg_no` varchar(20) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `terms` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `emailVerify` tinyint(1) NOT NULL DEFAULT '0',
  `numberVerify` tinyint(1) NOT NULL DEFAULT '0',
  `is_finally_submitted` tinyint(1) NOT NULL DEFAULT '0',
  `issubmitted` tinyint(1) NOT NULL DEFAULT '0',
  `previous_school_name` varchar(255) DEFAULT NULL,
  `fathers_name` varchar(255) DEFAULT NULL,
  `mothers_name` varchar(255) DEFAULT NULL,
  `current_whatsapp_no` varchar(255) DEFAULT NULL,
  `aadhar_card_no` varchar(255) DEFAULT NULL,
  `student_religion` varchar(255) DEFAULT NULL,
  `student_caste` varchar(255) DEFAULT NULL,
  `is_student_PWD` varchar(4) DEFAULT NULL,
  `is_student_EWS` tinyint(1) NOT NULL DEFAULT '0',
  `student_village_town` varchar(255) DEFAULT NULL,
  `student_city` varchar(50) DEFAULT NULL,
  `student_pin_code` varchar(20) DEFAULT NULL,
  `student_police_station` varchar(50) DEFAULT NULL,
  `student_district` varchar(50) DEFAULT NULL,
  `student_state` varchar(50) DEFAULT NULL,
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
  `obtained_marks` int(3) DEFAULT '0',
  `language_1` varchar(255) DEFAULT NULL,
  `language_2` varchar(255) DEFAULT NULL,
  `select_stream` varchar(255) DEFAULT NULL,
  `sub_comb` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_account_no` varchar(20) DEFAULT NULL,
  `bank_ifsc_code` varchar(20) DEFAULT NULL,
  `institution_fees_payment_done` tinyint(1) DEFAULT '0',
  `institution_fees_payments_ID` varchar(255) DEFAULT NULL,
  `portal_fees_payment_done` tinyint(1) DEFAULT '0',
  `portal_payment_id` varchar(255) DEFAULT NULL,
  `passport_size_photo_uploaded` tinyint(1) DEFAULT '0',
  `aadhar_card_uploaded` tinyint(1) DEFAULT '0',
  `madhyamik_marksheet_uploaded` tinyint(1) DEFAULT '0',
  `madhyamik_certificate_uploaded` tinyint(1) DEFAULT '0',
  `signature_uploaded` tinyint(1) DEFAULT '0',
  `Registration_Time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_Admission_Allowed` tinyint(1) DEFAULT '0',
  `Admitted_Or_Not` tinyint(1) NOT NULL DEFAULT '0',
  `Reminder_Email_Sent` tinyint(2) NOT NULL DEFAULT '0',
  `is_Student_Want_Change_School` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `222_Subject_Details`
--

CREATE TABLE `222_Subject_Details` (
  `Combo_ID` int(255) NOT NULL,
  `Stream` varchar(20) NOT NULL,
  `Subject_Combinations` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `9475755847_HOI_Login_Credentials`
--

CREATE TABLE `9475755847_HOI_Login_Credentials` (
  `HOI_UDISE_ID` varchar(20) NOT NULL,
  `HOI_Password` varchar(100) NOT NULL,
  `HOI_Email_ID` varchar(50) NOT NULL,
  `HOI_Mobile_No` varchar(50) DEFAULT NULL,
  `HOI_Whatsapp_No` varchar(20) DEFAULT NULL,
  `is_HOI_Account_Verified` int(2) NOT NULL DEFAULT '0',
  `emailVerify` varchar(10) NOT NULL DEFAULT '0',
  `numberVerify` varchar(10) NOT NULL DEFAULT '0',
  `Institution_Name` varchar(255) DEFAULT NULL,
  `HOI_Name` varchar(50) DEFAULT 'NULL',
  `Institution_Address` varchar(255) DEFAULT NULL,
  `Coed_Or_Not` varchar(10) DEFAULT 'Coed',
  `Application_Fees` int(5) DEFAULT '200',
  `Bank_Account_No` varchar(30) DEFAULT 'Bank Account No',
  `Bank_IFSC_Code` varchar(30) DEFAULT 'Bank IFSC ',
  `Bank_Branch_Name` varchar(50) DEFAULT 'Bank Branch Name',
  `Formfillup_Start_Date` date DEFAULT NULL,
  `Formfillup_Last_Date` date DEFAULT NULL,
  `First_merit_list_date` date DEFAULT NULL,
  `Admission_Beginning_for_First_List` date DEFAULT NULL,
  `Admission_Closes_For_First_List` date DEFAULT NULL,
  `Second_List` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `9475755847_HOI_Login_Credentials`
--

INSERT INTO `9475755847_HOI_Login_Credentials` (`HOI_UDISE_ID`, `HOI_Password`, `HOI_Email_ID`, `HOI_Mobile_No`, `HOI_Whatsapp_No`, `is_HOI_Account_Verified`, `emailVerify`, `numberVerify`, `Institution_Name`, `HOI_Name`, `Institution_Address`, `Coed_Or_Not`, `Application_Fees`, `Bank_Account_No`, `Bank_IFSC_Code`, `Bank_Branch_Name`, `Formfillup_Start_Date`, `Formfillup_Last_Date`, `First_merit_list_date`, `Admission_Beginning_for_First_List`, `Admission_Closes_For_First_List`, `Second_List`) VALUES
('9475755847', '$2y$10$u.jGAQC6auap1ZkBbdC4cOdAEtHOdF.HR69r74eytithNUQme/BLG', 'kamalkumarpatra1972@gmail.com', '9475755847', '9475755847', 0, '1', '1', 'DHBSSPV', 'Kamal Patra', 'Madhabpur, Diamond Harbour , 743331, South 24 Pgs , West Bengal, India . ', 'Boys Only', 120, 'Bank Account No', 'Bank IFSC ', 'Bank Branch Name', '2024-11-17', '2024-12-30', '2024-07-09', '2024-06-24', '2024-06-19', '2024-06-19');

-- --------------------------------------------------------

--
-- Table structure for table `9475755847_Student_Details`
--

CREATE TABLE `9475755847_Student_Details` (
  `reg_no` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailVerify` int(255) NOT NULL DEFAULT '0',
  `numberVerify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_finally_submitted` int(1) NOT NULL DEFAULT '0',
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
  `obtained_marks` int(3) DEFAULT '0',
  `language_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `language_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `select_stream` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_comb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_ifsc_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `institution_fees_payment_done` int(11) DEFAULT '0',
  `institution_fees_payments_ID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portal_fees_payment_done` int(11) DEFAULT '0',
  `portal_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_size_photo_uploaded` int(11) DEFAULT '0',
  `aadhar_card_uploaded` int(11) DEFAULT '0',
  `madhyamik_marksheet_uploaded` int(11) DEFAULT '0',
  `madhyamik_certificate_uploaded` int(11) DEFAULT '0',
  `signature_uploaded` int(11) DEFAULT '0',
  `Registration_Time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_Admission_Allowed` int(1) DEFAULT '0',
  `Admitted_Or_Not` int(1) NOT NULL DEFAULT '0',
  `Reminder_Email_Sent` int(2) NOT NULL DEFAULT '0',
  `Merit_List_No` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `9475755847_Student_Details`
--

INSERT INTO `9475755847_Student_Details` (`reg_no`, `fname`, `lname`, `email`, `phoneNumber`, `dob`, `terms`, `password`, `emailVerify`, `numberVerify`, `is_finally_submitted`, `issubmitted`, `previous_school_name`, `fathers_name`, `mothers_name`, `current_whatsapp_no`, `aadhar_card_no`, `student_religion`, `student_caste`, `is_student_PWD`, `is_student_EWS`, `student_village_town`, `student_city`, `student_pin_code`, `student_police_station`, `student_district`, `student_state`, `bengali_marks`, `bengali_full_marks`, `english_marks`, `english_full_marks`, `mathematics_marks`, `mathematics_full_marks`, `physical_science_marks`, `physical_science_full_marks`, `life_science_marks`, `life_science_full_marks`, `history_marks`, `history_full_marks`, `geography_marks`, `geography_full_marks`, `obtained_marks`, `language_1`, `language_2`, `select_stream`, `sub_comb`, `bank_name`, `bank_account_no`, `bank_ifsc_code`, `institution_fees_payment_done`, `institution_fees_payments_ID`, `portal_fees_payment_done`, `portal_payment_id`, `passport_size_photo_uploaded`, `aadhar_card_uploaded`, `madhyamik_marksheet_uploaded`, `madhyamik_certificate_uploaded`, `signature_uploaded`, `Registration_Time_Stamp`, `is_Admission_Allowed`, `Admitted_Or_Not`, `Reminder_Email_Sent`, `Merit_List_No`) VALUES
('1234', 'Lorem', 'Epsum', 'patra.group.official@gmail.com', '9475755812', '2003-01-01', 'on', '$2y$10$5clz77n6BK1R2r.vbY5nseNyg.vg5ZkZAsuuvz.luW9mVNv72a6Gu', 1, '1', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'No', '0', NULL, NULL, NULL, NULL, NULL, NULL, 90, 100, 91, 100, 92, 100, 93, 100, 94, 100, 95, 100, 95, 100, 650, NULL, NULL, 'Science', 'Maths + Coms+Phys+CS', NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, 0, '2024-06-10 21:13:10', 1, 0, 1, 1),
('123456789', 'Enter Full', 'Name', 'suchibratapatra2003@gmail.com', 'Enter Mobile No', '2003-01-01', 'on', '$2y$10$POkJF2LqyM.H.jrPcVdfm.JoSgnT4B7w8nF86pKr1r9Xg4pCHyrYi', 1, '1', 0, 0, 'St Xavier\'s College', 'Kamal Kumar Patra', 'Susmita Maity Patra', '94757555847', '320873240676', 'Hindu', 'General', 'No', 'No', 'Diamond Harbour', 'Diamond Harbour', '743331', 'Diamond Harbour', 'South 24 Pgs', 'West Bengal', 90, 100, 91, 100, 92, 100, 93, 100, 94, 100, 95, 100, 96, 100, 648, 'Bengali', 'English', 'Science', 'Phy + Maths + coms + Stat', 'Union Bank Of India', 'UBIN05448391', 'MYIFSCCODEE', 1, 'pay_OUd8zo1G5mTXRb', 1, 'pay_OUd9aTQt1ifvT7', 0, 0, 0, 0, 0, '2024-07-04 16:58:29', 0, 0, 0, 0),
('6542', 'Lorem', 'Epsum', 'kamalkumarpatra1972@gmail.com', '', '', '', '$2y$10$3fPGmExx0tV6hqJUkGbAveKnXKon9kp6k.rOTJ3cVxb08x.ojUede', 0, '0', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, 100, NULL, 100, NULL, 100, NULL, 100, NULL, 100, NULL, 100, 652, NULL, NULL, 'Commerce', 'Acc+Eco+Maths+Geo', NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, 0, '2024-06-15 10:58:48', 1, 0, 1, 1),
('7324', 'Lorem', 'Epsum', 'patrasuchi2003@gmail.coms', '9475755846', '2003-01-01', 'on', '$2y$10$nDHxbdQaf48wXKu2tD5MweyNQI73Hg.QCe4INps8hM6eiJKH1KMy2', 1, '1', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, 100, NULL, 100, NULL, 100, NULL, 100, NULL, 100, NULL, 100, 623, NULL, NULL, 'Commerce', NULL, NULL, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, 0, 0, '2024-06-14 16:26:05', 1, 0, 1, 1),
('8292', 'Lorem', 'Epsum', 'trading.suchibrata.com@gmail.com', '9475754903', '2003-01-01', 'on', '$2y$10$4nX1k8sjtZSkqgYyAtXR3.G9qN9Jv3DWK.DSzYGSnvWHsoPiLvqMW', 1, '1', 1, 1, 'DHBSSPV', 'This is Papa_3', 'This is Mummy_3', '94757553432sd', '3208732406763ew', 'Muslim', 'SC/ST', 'Yes', 'Yes', 'Diamond Harbour23232', 'Diamond Harbour2323', '74333131313', 'Diamond Harbours', 'South 24 Pgs2323', 'Uttar Pradesh', 95, 100, 91, 100, 92, 100, 93, 100, 45, 100, 95, 100, 20, 100, 531, 'Bengali', 'English', 'Arts', 'Pol Sc. + Hist + Geography + Sanskrit', 'asdsasas', 'assasas', 'aassaasasas', 1, 'pay_OD3uLT6bnoRSvg', 1, 'pay_ODUzL8vsNTLOmU', 0, 0, 0, 0, 0, '2024-05-23 07:52:31', 1, 0, 1, 1);

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
(19, 'Science', 'Phy + Maths + coms + Stat'),
(20, 'Commerce', 'Accountancy + Economics + Computer Sc + Maths'),
(21, 'Arts', 'Stats + Coms +Geo');

-- --------------------------------------------------------

--
-- Table structure for table `edu_org_records`
--

CREATE TABLE `edu_org_records` (
  `udise_id` varchar(20) NOT NULL,
  `school_name` varchar(255) DEFAULT NULL,
  `profile_lock_or_not` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `edu_org_records`
--

INSERT INTO `edu_org_records` (`udise_id`, `school_name`, `profile_lock_or_not`) VALUES
('2003', NULL, 0),
('222', NULL, 0),
('9475755847', 'Institution_Name', 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `reg_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneNumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `terms` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailVerify` int(255) NOT NULL DEFAULT '0',
  `numberVerify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `is_finally_submitted` int(1) NOT NULL DEFAULT '0',
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
  `institution_fees_payment_done` int(11) DEFAULT '0',
  `institution_fees_payments_ID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portal_fees_payment_done` int(11) DEFAULT '0',
  `portal_payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_size_photo_uploaded` int(11) DEFAULT '0',
  `aadhar_card_uploaded` int(11) DEFAULT '0',
  `madhyamik_marksheet_uploaded` int(11) DEFAULT '0',
  `madhyamik_certificate_uploaded` int(11) DEFAULT '0',
  `signature_uploaded` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`reg_no`, `fname`, `lname`, `email`, `phoneNumber`, `dob`, `terms`, `password`, `emailVerify`, `numberVerify`, `is_finally_submitted`, `issubmitted`, `previous_school_name`, `fathers_name`, `mothers_name`, `current_whatsapp_no`, `aadhar_card_no`, `student_religion`, `student_caste`, `is_student_PWD`, `is_student_EWS`, `student_village_town`, `student_city`, `student_pin_code`, `student_police_station`, `student_district`, `student_state`, `bengali_marks`, `bengali_full_marks`, `english_marks`, `english_full_marks`, `mathematics_marks`, `mathematics_full_marks`, `physical_science_marks`, `physical_science_full_marks`, `life_science_marks`, `life_science_full_marks`, `history_marks`, `history_full_marks`, `geography_marks`, `geography_full_marks`, `language_1`, `language_2`, `select_stream`, `sub_comb`, `bank_name`, `bank_account_no`, `bank_ifsc_code`, `institution_fees_payment_done`, `institution_fees_payments_ID`, `portal_fees_payment_done`, `portal_payment_id`, `passport_size_photo_uploaded`, `aadhar_card_uploaded`, `madhyamik_marksheet_uploaded`, `madhyamik_certificate_uploaded`, `signature_uploaded`) VALUES
('108108', 'Kamal', 'Patra', 'me@gmail.com', '9878263278', '2003-01-01', 'on', '2003', 1, '1', 0, 0, 'DHBSSPV', 'Kamal Kumar Patra', 'Susmita Maity Patra', '947575847', '320873240676', 'Hindu', 'General', 'No', 'No', 'Diamond Harbour ', 'Diamond Harbour ', '743331 ', 'Diamond Harbour ', 'South 24 pgs', 'West Bengal', 90, 100, 91, 100, 92, 100, 93, 100, 94, 100, 95, 100, 96, 100, '', '', '', '', 'UNION BANK OF INDIA', 'acc_947575848', 'UBIN053387', 0, 'pay_OBHWM6Mu9O46W1', 0, 'pay_OBHWgxPfO6D0hW', 0, 0, 0, 0, 0),
('1233122', 'Suchibrata', 'Patra', 'suchibratapatra2003@gmail.com', '9475755847', '2003-01-01', 'on', '2003', 1, '1', 0, 0, 'DHBSSPV', 'Kamal Kumar Patra ', 'Susmita Maity Patra ', '9475755847', '', 'Hindu', 'General', 'No', 'No', 'Diamond Harbour ', 'Diamond Harbour ', '', 'Diamond Harbour ', '', 'West Bengal', 98, 100, 98, 100, 89, 100, 91, 100, 78, 100, 90, 100, 97, 100, '', '', '', '', 'State Bank of INDIA', '0112345674822', 'UBIN031810000538', 1, 'pay_OBJx3OK6H0C40x', 1, 'pay_OBK4wioRCHFiDZ', 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `222_Student_Details`
--
ALTER TABLE `222_Student_Details`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `9475755847_HOI_Login_Credentials`
--
ALTER TABLE `9475755847_HOI_Login_Credentials`
  ADD PRIMARY KEY (`HOI_UDISE_ID`),
  ADD UNIQUE KEY `HOI_UDISE_ID` (`HOI_UDISE_ID`);

--
-- Indexes for table `9475755847_Student_Details`
--
ALTER TABLE `9475755847_Student_Details`
  ADD PRIMARY KEY (`reg_no`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`),
  ADD UNIQUE KEY `reg_no` (`reg_no`);

--
-- Indexes for table `9475755847_Subject_Details`
--
ALTER TABLE `9475755847_Subject_Details`
  ADD PRIMARY KEY (`Combo_ID`);

--
-- Indexes for table `edu_org_records`
--
ALTER TABLE `edu_org_records`
  ADD PRIMARY KEY (`udise_id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`reg_no`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`),
  ADD UNIQUE KEY `reg_no` (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `9475755847_Subject_Details`
--
ALTER TABLE `9475755847_Subject_Details`
  MODIFY `Combo_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

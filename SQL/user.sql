
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `9475755848_HOI_Login_Credentials` (
  `HOI_UDISE_ID` varchar(20) NOT NULL,
  `HOI_Password` varchar(100) NOT NULL,
  `HOI_Email_ID` varchar(50) NOT NULL,
  `HOI_Mobile_No` varchar(50) DEFAULT NULL,
  `is_HOI_Account_Verified` int(2) NOT NULL DEFAULT '0',
  `emailVerify` varchar(10) NOT NULL DEFAULT '0',
  `numberVerify` varchar(10) NOT NULL DEFAULT '0',
  `Institution_Name` varchar(255) DEFAULT NULL,
  `HOI_Name` varchar(50) DEFAULT NULL,
  `Institution_Address` varchar(255) DEFAULT NULL,
  `Bank_Account_No` varchar(30) DEFAULT 'Bank Account No',
  `Bank_IFSC_Code` varchar(30) DEFAULT 'Bank IFSC ',
  `Bank_Branch_Name` varchar(50) DEFAULT 'Bank Branch Name',
  `Formfillup_Start_Date` date DEFAULT NULL,
  `Formfillup_Last_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `9475755848_Student_Details` (
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
  `signature_uploaded` int(11) DEFAULT '0',
  `Registration_Time_Stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `9475755848_Subject_Details` (
  `Combo_ID` int(255) NOT NULL,
  `Stream` varchar(20) NOT NULL,
  `Subject_Combinations` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `9475755848_HOI_Login_Credentials`
--
ALTER TABLE `9475755848_HOI_Login_Credentials`
  ADD PRIMARY KEY (`HOI_UDISE_ID`),
  ADD UNIQUE KEY `HOI_UDISE_ID` (`HOI_UDISE_ID`);

--
-- Indexes for table `9475755848_Student_Details`
--
ALTER TABLE `9475755848_Student_Details`
  ADD PRIMARY KEY (`reg_no`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phonenumber_unique` (`phoneNumber`),
  ADD UNIQUE KEY `reg_no` (`reg_no`);

--
-- Indexes for table `9475755848_Subject_Details`
--
ALTER TABLE `9475755848_Subject_Details`
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
-- AUTO_INCREMENT for table `9475755848_Subject_Details`
--
ALTER TABLE `9475755848_Subject_Details`
  MODIFY `Combo_ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

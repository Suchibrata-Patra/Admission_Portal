<?php
// Start the session and include the session management script
require 'Admin_Session.php';
$servername = "localhost"; 
$username = "root"; 
$password = "root"; 
$database = "user"; 

// Create a connection 
$db = mysqli_connect($servername, $username, $password, $database); 

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Server Connected Successfully";
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the UDISE ID from the form
    $udise_id = $_POST['udise_id'];
    // Sanitize the input to prevent SQL injection
    $udise_id = preg_replace('/[^0-9]/', '', $udise_id); // Only allow numbers

    // Your SQL dump as a string to create tables
    $sql = "
    CREATE TABLE IF NOT EXISTS `{$udise_id}_HOI_Login_Credentials` (
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

    CREATE TABLE IF NOT EXISTS `{$udise_id}_Student_Details` (
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

    CREATE TABLE IF NOT EXISTS `{$udise_id}_Subject_Details` (
      `Combo_ID` int(255) NOT NULL,
      `Stream` varchar(20) NOT NULL,
      `Subject_Combinations` varchar(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    ";

    // Execute the SQL to create tables
    if (mysqli_multi_query($db, $sql)) {
        do {
            // Store the result set in case of SELECT query
            if ($result = mysqli_store_result($db)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($db));
        echo "<div class='success-message'>Tables created successfully.</div>";
    } else {
        echo "<div class='error-message'>Error creating tables: " . mysqli_error($db) . "</div>";
    }
}

// Close the database connection
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Create Tables</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .success-message {
            color: green;
            text-align: center;
            margin-top: 20px;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Create Tables</h1>
    <form method="POST" action="">
        <label for="udise_id">Enter UDISE ID:</label>
        <input type="text" id="udise_id" name="udise_id" required>
        <input type="submit" value="Create Tables">
    </form>
</body>
</html>
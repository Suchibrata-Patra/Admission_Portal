<?php
// Enable error reporting for debugging (disable in production)
ini_set('display_errors', 0);
error_reporting(0);

// Start session and require the Admin_Session file
session_start();
require 'Admin_Session.php';

// Regenerate session ID to prevent session fixation
session_regenerate_id(true);

// Function to copy a directory recursively
function copyDirectory($source, $destination) {
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true); // Create destination folder if it doesn't exist
    }
    $files = scandir($source); // Get files and directories in the source folder
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $sourceFile = $source . '/' . $file;
            $destinationFile = $destination . '/' . $file;
            if (is_dir($sourceFile)) {
                copyDirectory($sourceFile, $destinationFile); // Recursively copy subdirectories
            } else {
                if (!is_readable($sourceFile) || !is_writable($destination)) {
                    throw new Exception("Permission denied for file operation.");
                }
                copy($sourceFile, $destinationFile); // Copy individual files
            }
        }
    }
}

// Function to sanitize UDISE ID
function sanitizeUdiseId($id) {
    return preg_replace('/[^a-zA-Z0-9_]/', '', $id); // Allow only alphanumeric characters and underscores
}

// // Database connection details
// $servername = "localhost";
// $username = "root";
// $password = "root";
// $database = "user";

// // Create a connection
// $db = new mysqli($servername, $username, $password, $database);
$servername = getenv('DB_HOST') ?: 'localhost'; // Use 'localhost' as default if not set
$username = getenv('DB_USER') ?: 'root';        // Use 'root' as default if not set
$password = getenv('DB_PASS') ?: 'root';        // Use 'root' as default if not set
$database = getenv('DB_NAME') ?: 'user';        // Use 'user' as default if not set

// Create a connection
$db = mysqli_connect($servername, $username, $password, $database);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . htmlspecialchars($db->connect_error));
}

// Initialize message variable
$message = "";

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get UDISE ID from the form input and sanitize it
    $udise_id = sanitizeUdiseId($_POST['udise_id']);
    
    if (!empty($udise_id)) {
        // Define source and destination paths for folder copying
        $source_folder = realpath('../New_Reg_Dummy_Folder'); // Use absolute path for source
        $destination_folder = realpath('..') . '/' . basename($udise_id); // Absolute path for destination

        // Check if source folder exists
        if (is_dir($source_folder)) {
            // Copy the directory
            try {
                copyDirectory($source_folder, $destination_folder);
                $message .= "Folder copied successfully to <strong>" . htmlspecialchars($destination_folder) . "</strong>.<br>";
            } catch (Exception $e) {
                $message .= "Error copying folder: " . htmlspecialchars($e->getMessage()) . "<br>";
            }
        } else {
            $message .= "Source folder does not exist.<br>";
        }

        // Prepare SQL to create tables
        $sql = "
        CREATE TABLE IF NOT EXISTS `{$udise_id}_HOI_Login_Credentials` (
            `HOI_UDISE_ID` VARCHAR(20) NOT NULL,
            `HOI_Password` VARCHAR(100) NOT NULL,
            `HOI_Email_ID` VARCHAR(50) NOT NULL,
            `HOI_Mobile_No` VARCHAR(50) DEFAULT NULL,
            `HOI_Whatsapp_No` VARCHAR(20) DEFAULT NULL,
            `is_HOI_Account_Verified` TINYINT(1) NOT NULL DEFAULT '0',
            `emailVerify` TINYINT(1) NOT NULL DEFAULT '0',
            `numberVerify` TINYINT(1) NOT NULL DEFAULT '0',
            `Institution_Name` VARCHAR(255) DEFAULT NULL,
            `HOI_Name` VARCHAR(50) DEFAULT NULL,
            `Institution_Address` VARCHAR(255) DEFAULT NULL,
            `Coed_Or_Not` VARCHAR(10) DEFAULT 'Coed',
            `Application_Fees` INT(5) DEFAULT '200',
            `Bank_Account_No` VARCHAR(30) DEFAULT NULL,
            `Bank_IFSC_Code` VARCHAR(30) DEFAULT NULL,
            `Bank_Branch_Name` VARCHAR(50) DEFAULT NULL,
            `Formfillup_Start_Date` DATE DEFAULT NULL,
            `Formfillup_Last_Date` DATE DEFAULT NULL,
            `First_merit_list_date` DATE DEFAULT NULL,
            `Admission_Beginning_for_First_List` DATE DEFAULT NULL,
            `Admission_Closes_For_First_List` DATE DEFAULT NULL,
            `Second_List` DATE DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS `{$udise_id}_Student_Details` (
            `reg_no` VARCHAR(20) NOT NULL,
            `fname` VARCHAR(50) DEFAULT NULL,
            `lname` VARCHAR(50) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `phoneNumber` VARCHAR(50) NOT NULL,
            `dob` DATE NOT NULL,
            `terms` VARCHAR(10) NOT NULL,
            `password` VARCHAR(255) NOT NULL,
            `emailVerify` TINYINT(1) NOT NULL DEFAULT '0',
            `numberVerify` TINYINT(1) NOT NULL DEFAULT '0',
            `is_finally_submitted` TINYINT(1) NOT NULL DEFAULT '0',
            `issubmitted` TINYINT(1) NOT NULL DEFAULT '0',
            `previous_school_name` VARCHAR(255) DEFAULT NULL,
            `fathers_name` VARCHAR(255) DEFAULT NULL,
            `mothers_name` VARCHAR(255) DEFAULT NULL,
            `current_whatsapp_no` VARCHAR(255) DEFAULT NULL,
            `aadhar_card_no` VARCHAR(255) DEFAULT NULL,
            `student_religion` VARCHAR(255) DEFAULT NULL,
            `student_caste` VARCHAR(255) DEFAULT NULL,
            `is_student_PWD` VARCHAR(4) DEFAULT NULL,
            `is_student_EWS` TINYINT(1) NOT NULL DEFAULT '0',
            `student_village_town` VARCHAR(255) DEFAULT NULL,
            `student_city` VARCHAR(50) DEFAULT NULL,
            `student_pin_code` VARCHAR(20) DEFAULT NULL,
            `student_police_station` VARCHAR(50) DEFAULT NULL,
            `student_district` VARCHAR(50) DEFAULT NULL,
            `student_state` VARCHAR(50) DEFAULT NULL,
            `bengali_marks` INT(4) DEFAULT NULL,
            `bengali_full_marks` INT(4) DEFAULT '100',
            `english_marks` INT(4) DEFAULT NULL,
            `english_full_marks` INT(4) DEFAULT '100',
            `mathematics_marks` INT(4) DEFAULT NULL,
            `mathematics_full_marks` INT(4) DEFAULT '100',
            `physical_science_marks` INT(4) DEFAULT NULL,
            `physical_science_full_marks` INT(4) DEFAULT '100',
            `life_science_marks` INT(4) DEFAULT NULL,
            `life_science_full_marks` INT(4) DEFAULT '100',
            `history_marks` INT(4) DEFAULT NULL,
            `history_full_marks` INT(4) DEFAULT '100',
            `geography_marks` INT(4) DEFAULT NULL,
            `geography_full_marks` INT(4) DEFAULT '100',
            `obtained_marks` INT(3) DEFAULT '0',
            `language_1` VARCHAR(255) DEFAULT NULL,
            `language_2` VARCHAR(255) DEFAULT NULL,
            `select_stream` VARCHAR(255) DEFAULT NULL,
            `sub_comb` VARCHAR(255) DEFAULT NULL,
            `bank_name` VARCHAR(255) DEFAULT NULL,
            `bank_account_no` VARCHAR(20) DEFAULT NULL,
            `bank_ifsc_code` VARCHAR(20) DEFAULT NULL,
            `institution_fees_payment_done` TINYINT(1) DEFAULT '0',
            `institution_fees_payments_ID` VARCHAR(255) DEFAULT NULL,
            `portal_fees_payment_done` TINYINT(1) DEFAULT '0',
            `portal_payment_id` VARCHAR(255) DEFAULT NULL,
            `passport_size_photo_uploaded` TINYINT(1) DEFAULT '0',
            `aadhar_card_uploaded` TINYINT(1) DEFAULT '0',
            `madhyamik_marksheet_uploaded` TINYINT(1) DEFAULT '0',
            `madhyamik_certificate_uploaded` TINYINT(1) DEFAULT '0',
            `signature_uploaded` TINYINT(1) DEFAULT '0',
            `Registration_Time_Stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `is_Admission_Allowed` TINYINT(1) DEFAULT '0',
            `Admitted_Or_Not` TINYINT(1) NOT NULL DEFAULT '0',
            `Reminder_Email_Sent` TINYINT(2) NOT NULL DEFAULT '0',
            `is_Student_Want_Change_School` TINYINT(1) NOT NULL DEFAULT '0',
            PRIMARY KEY (`reg_no`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

        CREATE TABLE IF NOT EXISTS `{$udise_id}_Subject_Details` (
          `Combo_ID` int(255) NOT NULL,
          `Stream` varchar(20) NOT NULL,
          `Subject_Combinations` varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
        
          INSERT INTO edu_org_records (udise_id, school_name) VALUES ($udise_id, NULL);
        ";
        // Execute the SQL
        if ($db->multi_query($sql)) {
            do {
                // Store first result set
                if ($result = $db->store_result()) {
                    $result->free();
                }
            } while ($db->more_results() && $db->next_result());
            $message .= "Tables for UDISE ID <strong>" . htmlspecialchars($udise_id) . "</strong> created successfully.<br>";
            
        } else {
            $message .= "Error creating tables: " . htmlspecialchars($db->error) . "<br>";
        }

        // Redirect to the same page to prevent form resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit; // Ensure no further code is executed
    } else {
        $message .= "UDISE ID cannot be empty.<br>";
    }
}

// Close the database connection
$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../../Assets/images/favicon.png" type="image/svg+xml">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="/../../../../Assets/css/Generalised_HOI_Stylesheet.css">

    <title style="font-family: 'Roboto', Times, serif;">Register New</title>
</head>

<body style="font-family: 'Roboto', sans-serif;">

    <!-- SIDEBAR -->
    <?php include('Admin_Sidebar.php') ?>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>

            <!-- HOI_Notification_Icon -->
            <?php include 'Admin_Notification.php'; ?>

            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <h1>Create Account and Database</h1>
            <div class="card" style="border-radius: 8px;">
            <div class="card-body">
                <h1 class="card-title text-center" style="color: #333;font-size: 18px;">Create Folder & Database</h1>
                <form method="post">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="udise_id"><strong>Enter UDISE ID:</strong></label>
                            <input type="text" id="udise_id" name="udise_id" class="form-control" required style="font-size: 16px;">
                        </div>
                       
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                </form>
                <div class="message mt-3" style="font-size: 14px; color: #333;">
                    <?php echo $message; ?>
                </div>
            </div>
        </div>
        </main>

        <!-- MAIN -->
    </section>

    <script src="script.js"></script>
</body>

</html>
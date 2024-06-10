<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

$table_name = $udise_code . '_HOI_Login_Credentials';
$student_table_name = $udise_code .'_Student_Details';

$udiseid = mysqli_real_escape_string($db, $udiseid);
$query = "SELECT * FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1";
$results = mysqli_query($db, $query);

if (!$results) {
    die("Error in query: " . mysqli_error($db));
}

$user = mysqli_fetch_assoc($results);
if ($user['numberVerify'] != 1 || $user['emailVerify'] != 1) {
    echo "<script>window.location.href = 'HOI_verify.php';</script>"; 
}
if (!$user) {
    die("User not found");
}
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = mysqli_real_escape_string($db, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($db, $_POST['end_date']);

    // Check if end date is before start date
    if (strtotime($end_date) < strtotime($start_date)) {
        $message = "Error: End date must be after the start date.";
    } else {
        // Update admission dates in the database
        $update_query = "UPDATE $table_name
                         SET `Formfillup_Start_Date` = '$start_date', `Formfillup_Last_Date` = '$end_date'
                         WHERE `HOI_UDISE_ID` = '$udiseid'";
        $update_result = mysqli_query($db, $update_query);

        if ($update_result) {
            $message = "Admission dates updated successfully.";
        } else {
            $message = "Error updating admission dates: " . mysqli_error($db);
        }
    }
}


// Fetch the current admission dates
$admission_query = "SELECT `Formfillup_Start_Date`, `Formfillup_Last_Date` FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1";
$admission_results = mysqli_query($db, $admission_query);
$admission_dates = mysqli_fetch_assoc($admission_results);

$current_date = date('Y-m-d');
if ($admission_dates['Formfillup_Last_Date'] < $current_date) {
    $application_status = "Admission Deadline is Over";
} else {
    $application_status = "Application Portal is Live !";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <title style="font-family: 'Roboto', Times, serif;">Haggle</title>
</head>

<body style="font-family: 'Roboto', sans-serif;">

    <!-- SIDEBAR -->
    <?php include('HOI_Sidebar.php') ?>
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
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="container">
                <div class="head-title">
                    <div class="left">
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="HOI_Bank_Details.php">Bank Details</a></li>
                        </ul>
                    </div>
                    <!-- <a href="#" class="btn-download">
                        <i class='bx'><span class="material-symbols-outlined">download</span></i>
                    </a> -->
                </div>
                <span class="institution-name">
                    <?php echo $user['Institution_Name']; ?>
                </span>

                <?php if (isset($message)) : ?>
                <div class="alert alert-info">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>

                <!-- Admission Date Form -->
                <div class="admission-date-form">
                    <h3>Bank Account Details</h3>
                    <form action="#" method="POST" id="admission-form">
                        <div class="container">
                            <div class="col">
                                <label for="exampleInputEmail1">Bank Account No</label>
                                <input type="text" class="form-control"
                                    placeholder="<?php echo htmlspecialchars($user['Bank_Account_No']); ?>"
                                    disabled="disabled"> <!-- Added disabled attribute -->
                            </div>
                            <div class="col">
                                <label for="exampleInputEmail1">Bank IFSC Code</label>
                                <input type="text" class="form-control"
                                    placeholder="<?php echo htmlspecialchars($user['Bank_IFSC_Code']); ?>"
                                    disabled="disabled"> <!-- Added disabled attribute -->
                            </div>
                            <div class="col">
                                <label for="exampleInputEmail1">Bank Branch</label>
                                <input type="text" class="form-control"
                                    placeholder="<?php echo htmlspecialchars($user['Bank_Branch_Name']); ?>"
                                    disabled="disabled"> <!-- Added disabled attribute -->
                                <small id="emailHelp" class="form-text text-muted">We Never Share the bank Account
                                    Details With any other Third Party.</small>
                                <br>
                                <button type="button" class="btn btn-info" onclick="window.open('https://forms.gle/Dm4GYYjzGW8BQyPS6', '_blank')">Request for Bank Details Update</button>
                            </div>
                        </div>
                        
                    </form>
                    
                    <br>
                    <div class="instructions" style="padding:0.15rem;">
                        <h5>Instructions for Updating Bank Details</h5>
                        <p>Please be aware of the following guidelines regarding the update of bank details:</p>
                        <ul style="list-style-type: disc; padding-left: 20px;">
                            <li>• Bank details cannot be updated while the Application Window for Students are Open.</li>
                            <li>• To update bank details, please ensure that no application is live at the time.</li>
                            <li>• If it is essential to update the bank details during an active application period,
                                please contact our customer support team.</li>
                            <li>• Once we receive the necessary information, we will process the update as soon as
                                possible.</li>
                        </ul>
                    </div>

                </div>
                <!-- End of Admission Date Form -->
            </div>
        </main>
        <!-- MAIN -->
    </section>
    <script src="script.js"></script>
</body>

</html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_Session.php';
require 'HOI_Super_Admin.php';

if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

$student_table_name = $udise_code . '_Student_Details';

$udiseid = mysqli_real_escape_string($db, $udiseid);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profile_update'])) {
    // Check each field individually and update if provided
    $update_query = "UPDATE $table_name SET ";
    $set_values = [];

    // Check and append each field to the update query
    if (!empty($_POST['Institution_Name'])) {
        $Institution_Name = mysqli_real_escape_string($db, $_POST['Institution_Name']);
        $set_values[] = "Institution_Name = '$Institution_Name'";
    }
    if (!empty($_POST['Institution_Address'])) {
        $Institution_Address = mysqli_real_escape_string($db, $_POST['Institution_Address']);
        $set_values[] = "Institution_Address = '$Institution_Address'";
    }
    if (!empty($_POST['HOI_Name'])) {
        $HOI_Name = mysqli_real_escape_string($db, $_POST['HOI_Name']);
        $set_values[] = "HOI_Name = '$HOI_Name'";
    }
    if (!empty($_POST['HOI_Whatsapp_No'])) {
        $HOI_Whatsapp_No = mysqli_real_escape_string($db, $_POST['HOI_Whatsapp_No']);
        $set_values[] = "HOI_Whatsapp_No = '$HOI_Whatsapp_No'";
    }
    if (!empty($_POST['HOI_Mobile_No'])) {
        $HOI_Mobile_No = mysqli_real_escape_string($db, $_POST['HOI_Mobile_No']);
        $set_values[] = "HOI_Mobile_No = '$HOI_Mobile_No'";
    }
    if (!empty($_POST['Application_Fees'])) {
        $Application_Fees = mysqli_real_escape_string($db, $_POST['Application_Fees']);
        $set_values[] = "Application_Fees = '$Application_Fees'";
    }
    if (isset($_POST['Coed_Or_Not'])) {
        $Coed_Or_Not = mysqli_real_escape_string($db, $_POST['Coed_Or_Not']);
        $set_values[] = "Coed_Or_Not = '$Coed_Or_Not'";
    }

    // Construct the SET clause of the update query
    $set_clause = implode(', ', $set_values);

    // Complete the update query
    if (!empty($set_clause)) {
        $update_query .= "$set_clause WHERE HOI_UDISE_ID = '$udiseid'";

        // Execute the update query
        if (mysqli_query($db, $update_query)) {
            // echo "Profile updated successfully.";
        } else {
            echo "Error updating record: " . mysqli_error($db);
        }
    } else {
        echo "No fields to update.";
    }
}
$query = "SELECT * FROM $table_name WHERE HOI_UDISE_ID = '$udiseid'";
$result = mysqli_query($db, $query);

// Check if data is fetched successfully
if ($result && mysqli_num_rows($result) > 0) {
    $profile_data = mysqli_fetch_assoc($result);
} else {
    // Handle errors or set default values for profile data
    $profile_data = array();
}
// Close the database connection
mysqli_close($db);
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
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
        <center>
    <p style="padding-top:25%; font-size: 18px;">This Feature Coming Soon!</p>
    <p style="font-size: 16px;">We're working really hard to bring This Feature Live.</p>
    <p style="font-size: 16px;">Keep an eye out for next Version Updates!</p>
</center>    </main>
    </section>
    <script src="script.js"></script>

</body>

</html>
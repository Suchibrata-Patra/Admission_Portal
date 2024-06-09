<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

// $table_name = $udise_code . '_HOI_Login_Credentials';
$student_table_name = $udise_code . '_Student_Details';

$udiseid = mysqli_real_escape_string($db, $udiseid);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profile_update'])) {
    // Check each field individually and update if provided
    $update_query = "UPDATE $table_name SET ";
    $set_values = [];

    // Check and append each field to the update query
    if (!empty($_POST['First_merit_list_date'])) {
        $First_merit_list_date = mysqli_real_escape_string($db, $_POST['First_merit_list_date']);
        $set_values[] = "First_merit_list_date = '$First_merit_list_date'";
    }
    if (!empty($_POST['Admission_Beginning_for_First_List'])) {
        $Admission_Beginning_for_First_List = mysqli_real_escape_string($db, $_POST['Admission_Beginning_for_First_List']);
        $set_values[] = "Admission_Beginning_for_First_List = '$Admission_Beginning_for_First_List'";
    }
    if (!empty($_POST['Admission_Closes_For_First_List'])) {
        $Admission_Closes_For_First_List = mysqli_real_escape_string($db, $_POST['Admission_Closes_For_First_List']);
        $set_values[] = "Admission_Closes_For_First_List = '$Admission_Closes_For_First_List'";
    }
    if (isset($_POST['Second_List'])) {
        $Second_List = mysqli_real_escape_string($db, $_POST['Second_List']);
        $set_values[] = "Second_List = '$Second_List'";
    }

    // Construct the SET clause of the update query
    $set_clause = implode(', ', $set_values);

    // Complete the update query
    if (!empty($set_clause)) {
        $update_query .= "$set_clause WHERE HOI_UDISE_ID = '$udiseid'";

        // Execute the update query
        if (mysqli_query($db, $update_query)) {
            echo "Profile updated successfully.";
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
    <div class="container">
    <div class="head-title">
                    <div class="left">
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="HOI_Bank_Details.php">School Preferences</a></li>
                        </ul>
                    </div>
                    <!-- <a href="#" class="btn-download">
                        <i class='bx'><span class="material-symbols-outlined">download</span></i>
                    </a> -->
                </div>
        <h2>School Preferences</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="First_merit_list_date">School Name</label>
                <input type="text" class="form-control" id="First_merit_list_date" name="First_merit_list_date"
                    value="<?php echo isset($profile_data['First_merit_list_date']) ? $profile_data['First_merit_list_date'] : ''; ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="Admission_Beginning_for_First_List">School Address</label>
                <input type="text" class="form-control" id="Admission_Beginning_for_First_List" name="Admission_Beginning_for_First_List"
                    value="<?php echo isset($profile_data['Admission_Beginning_for_First_List']) ? $profile_data['Admission_Beginning_for_First_List'] : ''; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="First_merit_list_date">H.M Name</label>
                <input type="text" class="form-control" id="First_merit_list_date" name="First_merit_list_date"
                    value="<?php echo isset($profile_data['First_merit_list_date']) ? $profile_data['First_merit_list_date'] : ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Admission_Beginning_for_First_List">H.M Whatsapp No</label>
                <input type="text" class="form-control" id="Admission_Beginning_for_First_List" name="Admission_Beginning_for_First_List"
                    value="<?php echo isset($profile_data['Admission_Beginning_for_First_List']) ? $profile_data['Admission_Beginning_for_First_List'] : ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Admission_Beginning_for_First_List">H.M Whatsapp No</label>
                <input type="text" class="form-control" id="Admission_Beginning_for_First_List" name="Admission_Beginning_for_First_List"
                    value="<?php echo isset($profile_data['Admission_Beginning_for_First_List']) ? $profile_data['Admission_Beginning_for_First_List'] : ''; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="Admission_Closes_For_First_List">School Whatsapp No</label>
                <input type="text" class="form-control" id="Admission_Closes_For_First_List" name="Admission_Closes_For_First_List"
                    value="<?php echo isset($profile_data['Admission_Closes_For_First_List']) ? $profile_data['Admission_Closes_For_First_List'] : ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Second_List">School Address</label>
                <input type="text" class="form-control" id="Second_List" name="Second_List"
                    value="<?php echo isset($profile_data['Second_List']) ? $profile_data['Second_List'] : ''; ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="Second_List">Boys / Coed School</label>
                <input type="text" class="form-control" id="Second_List" name="Second_List"
                    value="<?php echo isset($profile_data['Second_List']) ? $profile_data['Second_List'] : ''; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <button type="submit" name="profile_update" class="btn btn-info">Update</button>
        </div>
    </div>
</form>
<br>
                    <div class="instructions" style="padding:0.15rem;">
                        <h5>Instructions for Updating School Preferences</h5>
                        <p>Please be aware of the following guidelines regarding the update of details:</p>
                        <ul style="list-style-type: disc; padding-left: 20px;">
                            <li>• These School Preferences gets Immediate Effect When you Update them.</li>
                            <li>• To update bank details, please ensure that no application is live at the time.</li>
                            <li>• If it is essential to update the bank details during an active application period,
                                please contact our customer support team.</li>
                            <li>• Once we receive the necessary information, we will process the update as soon as
                                possible.</li>
                        </ul>
    </div>
</main>


    </section>
    <script src="script.js"></script>

</body>

</html>
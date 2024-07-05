<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

$table_name = $udise_code . '_HOI_Login_Credentials';

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
$school_name_updation_query = "UPDATE edu_org_records SET school_name ='Institution_Name' WHERE udise_id = '$udiseid'";
$result_updation = mysqli_query($db, $school_name_updation_query);
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


            	<!-- HOI_Notification_Icon -->
   <?php include 'HOI_Notification_Icon.php'; ?>
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
                            <li><a class="active" href="HOI_School_Preferences.php">School Preferences</a></li>
                        </ul>
                    </div>
                    <!-- <a href="#" class="btn-download">
                        <i class='bx'><span class="material-symbols-outlined">download</span></i>
                    </a> -->
                </div>
        <h2>School Preferences</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="Institution_Name">School Name</label>
                <input type="text" class="form-control" id="Institution_Name" name="Institution_Name" placeholder="Enter School Name Here"
                    value="<?php echo isset($profile_data['Institution_Name']) ? $profile_data['Institution_Name'] : ''; ?>" disabled >
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="HOI_UDISE_ID">Udise Id</label>
                <input type="text" class="form-control" id="HOI_UDISE_ID" name="HOI_UDISE_ID" placeholder="Enter School Name Here"
                    value="<?php echo isset($profile_data['HOI_UDISE_ID']) ? $profile_data['HOI_UDISE_ID'] : ''; ?>" disabled >
            </div>
        </div>
        <div class="col-md-4">
    <div class="form-group">
        <label for="Institution_Address">School Address</label>
        <textarea class="form-control" id="Institution_Address" name="Institution_Address" rows="2" required><?php echo isset($profile_data['Institution_Address']) ? $profile_data['Institution_Address'] : ''; ?></textarea>
    </div>
</div>

    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="HOI_Name">H.M Name</label>
                <input type="text" class="form-control" id="HOI_Name" name="HOI_Name" placeholder="Enter H.M Name"
                    value="<?php echo isset($profile_data['HOI_Name']) ? $profile_data['HOI_Name'] : ''; ?>" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="HOI_Whatsapp_No">H.M Whatsapp No</label>
                <input type="text" class="form-control" id="HOI_Whatsapp_No" name="HOI_Whatsapp_No"
                    value="<?php echo isset($profile_data['HOI_Whatsapp_No']) ? $profile_data['HOI_Whatsapp_No'] : ''; ?>" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="HOI_Mobile_No">School Contact No</label>
                <input type="text" class="form-control" id="HOI_Mobile_No" name="HOI_Mobile_No"
                    value="<?php echo isset($profile_data['HOI_Mobile_No']) ? $profile_data['HOI_Mobile_No'] : ''; ?>" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="Application_Fees">Application Fees (Rs.)</label>
                <input type="number" class="form-control" id="Application_Fees" name="Application_Fees" Placeholder="Modify Application Fees"
       value="<?php echo isset($profile_data['Application_Fees']) ? $profile_data['Application_Fees'] : ''; ?>"
       min="0" max="10000" step="any" required>

            </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">
    <label for="Coed_Or_Not">Boys / Coed School</label>
    <select class="form-control" id="Coed_Or_Not" name="Coed_Or_Not">
        <option value="Boys Only" <?php echo isset($profile_data['Coed_Or_Not']) && $profile_data['Coed_Or_Not'] == 'Boys Only' ? 'selected' : ''; ?>>Boys Only</option>
        <option value="Girls Only" <?php echo isset($profile_data['Coed_Or_Not']) && $profile_data['Coed_Or_Not'] == 'Girls Only' ? 'selected' : ''; ?>>Girls Only</option>
        <option value="Co-ed" <?php echo isset($profile_data['Coed_Or_Not']) && $profile_data['Coed_Or_Not'] == 'Co-ed' ? 'selected' : ''; ?>>Co-ed</option>
    </select>
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
    <script>
document.addEventListener('DOMContentLoaded', function() {
    var applicationFeesInput = document.getElementById('Application_Fees');
    
    applicationFeesInput.oninput = function() {
        var value = parseFloat(applicationFeesInput.value);
        if (value > 10000) {
            applicationFeesInput.setCustomValidity('Maximum Application Fees Allowed is Rs.10,000');
        } else {
            applicationFeesInput.setCustomValidity('');
        }
    };
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var applicationFeesInput = document.getElementById('Application_Fees');
    
    applicationFeesInput.addEventListener('input', function() {
        // Remove non-numeric characters using regular expression
        this.value = this.value.replace(/[^0-9.]/g, '');
    });
});
</script>


    <script src="script.js"></script>

</body>

</html>
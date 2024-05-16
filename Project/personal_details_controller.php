<?php 
ini_set('display_errors', 1); error_reporting(E_ALL);
require 'session.php';

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// Check if user is logged in
if (!isset($_SESSION['reg_no']) || !isset($_SESSION['email'])) {
    // Redirect user to login page or handle authentication error
    header('Location: login.php');
    exit(); // Stop further execution
}
// Initialize session variables
$reg_no = $_SESSION['reg_no'];
$email = $_SESSION['email'];

// Fetch user details from the database
$query = "SELECT * FROM student_details WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
$registration_no = $user['reg_no'];

// Check if form is submitted
if (isset($_POST['submit_personal_details'])) {
    // Receive and sanitize input values
    $previous_school_name = mysqli_real_escape_string($db, $_POST['previous_school_name']);
    $fathers_name = mysqli_real_escape_string($db, $_POST['fathers_name']);
    $mothers_name = mysqli_real_escape_string($db, $_POST['mothers_name']);
    $current_whatsapp_no = mysqli_real_escape_string($db, $_POST['current_whatsapp_no']);
    $aadhar_card_no = mysqli_real_escape_string($db, $_POST['aadhar_card_no']);
    $student_religion = mysqli_real_escape_string($db, $_POST['student_religion']);
    $student_caste = mysqli_real_escape_string($db, $_POST['student_caste']);
    $is_student_PWD = mysqli_real_escape_string($db, $_POST['is_student_PWD']);
    $is_student_EWS = mysqli_real_escape_string($db, $_POST['is_student_EWS']);
    $student_village_town = mysqli_real_escape_string($db, $_POST['student_village_town']);
    $student_city = mysqli_real_escape_string($db, $_POST['student_city']);
    $student_pin_code = mysqli_real_escape_string($db, $_POST['student_pin_code']);
    $student_police_station = mysqli_real_escape_string($db, $_POST['student_police_station']);
    $student_district = mysqli_real_escape_string($db, $_POST['student_district']);
    $student_state = mysqli_real_escape_string($db, $_POST['student_state']);
    $bank_name = mysqli_real_escape_string($db, $_POST['bank_name']);
    $bank_account_no = mysqli_real_escape_string($db, $_POST['bank_account_no']);
    $bank_ifsc_code = mysqli_real_escape_string($db, $_POST['bank_ifsc_code']);



# Check if Data is empty or not
# Check if Data is empty or not
// if (empty($previous_school_name)) { 
//     array_push($errors, "Prev School Name is required");
//     header("location:personal_details.php?error=Prev School Name is required"); 
// }
// if (empty($fathers_name)) { 
//     array_push($errors, "Fathers Name is required");
//     header("location:personal_details.php?error=Fathers Name is required"); 
// }
// if (empty($mothers_name)) { 
//     array_push($errors, "Mothers Name is required");
//     header("location:personal_details.php?error=Mothers Name is required"); 
// }
// if (empty($current_whatsapp_no)) { 
//     array_push($errors, "Current Whatsapp no is required");
//     header("location:personal_details.php?error=Current Whatsapp no is required"); 
// }
// if (empty($aadhar_card_no)) { 
//     array_push($errors, "Aadhr Card no is required");
//     header("location:personal_details.php?error=Aadhr Card no is required"); 
// }
// if (empty($student_religion)) { 
//     array_push($errors, "religion is required");
//     header("location:personal_details.php?error=religion is required"); 
// }
// if (empty($student_caste)) { 
//     array_push($errors, "Caste is required");
//     header("location:personal_details.php?error=Caste is required"); 
// }
// if (empty($is_student_PWD)) { 
//     array_push($errors, "PWD is required");
//     header("location:personal_details.php?error=PWD is required"); 
// }
// if (empty($is_student_EWS)) { 
//     array_push($errors, "EWS is required");
//     header("location:personal_details.php?error=EWS is required"); 
// }
// if (empty($student_village_town)) { 
//     array_push($errors, "Villtown is required");
//     header("location:personal_details.php?error=Villtown is required"); 
// }
// if (empty($student_city)) { 
//     array_push($errors, "City is required");
//     header("location:personal_details.php?error=City is required"); 
// }
// if (empty($student_pin_code)) { 
//     array_push($errors, "PIN is required");
//     header("location:personal_details.php?error=PIN is required"); 
// }
// if (empty($student_police_station)) { 
//     array_push($errors, "Police Station is required");
//     header("location:personal_details.php?error=Police Station is required"); 
// }
// if (empty($student_district)) { 
//     array_push($errors, "District is required");
//     header("location:personal_details.php?error=District is required"); 
// }
// if (empty($bank_name)) { 
//     array_push($errors, "Bank Name is required");
//     header("location:personal_details.php?error=Bank Name is required"); 
// }
// if (empty($bank_account_no)) { 
//     array_push($errors, "Bank Acc no is required");
//     header("location:personal_details.php?error=Bank IFSC no is required"); 
// }
// if (empty($bank_ifsc_code)) { 
//     array_push($errors, "Bank IFSC no is required");
//     header("location:personal_details.php?error=Bank IFSC no is required"); 
// }

    // Update marks details in the database
    $update_query = "UPDATE student_details 
                 SET previous_school_name = '$previous_school_name', 
                 fathers_name = '$fathers_name', 
                 mothers_name = '$mothers_name', 
                 current_whatsapp_no = '$current_whatsapp_no', 
                 aadhar_card_no = '$aadhar_card_no', 
                 student_religion = '$student_religion', 
                 student_caste = '$student_caste', 
                 is_student_PWD = '$is_student_PWD', 
                 is_student_EWS = '$is_student_EWS', 
                 student_village_town = '$student_village_town', 
                 student_city = '$student_city', 
                 student_pin_code = '$student_pin_code', 
                 student_police_station = '$student_police_station', 
                 student_district = '$student_district', 
                 student_state = '$student_state', 
                 bank_name = '$bank_name',
                 bank_account_no = '$bank_account_no',
                 bank_ifsc_code = '$bank_ifsc_code'
                 WHERE reg_no = '$registration_no'";

    $update_result = mysqli_query($db, $update_query);
    // var_dump($update_query);
    // var_dump($update_result);
    if ($update_result) {
        echo "Update successful";
    } else {
        echo "Update failed: " . mysqli_error($db);
    }
    
    if ($update_result) {
        $_SESSION['success'] = "Marks updated successfully";
        header('Location: student_file_upload.php');
        exit(); // Stop further execution
    } else {
        header('Location: error.php');
        exit(); // Stop further execution
    }
    
    ob_end_flush(); // Flush the output buffer
}
?>
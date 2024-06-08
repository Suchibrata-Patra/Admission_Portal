
<?php 
ini_set('display_errors', 1); 
error_reporting(E_ALL);
require 'session.php';
require 'super_admin.php';
echo $user['fname'];
$table_name = $udise_code . '_student_details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';

// Ensure $udise_code is defined
if (!isset($udise_code) && isset($_SESSION['udise_code'])) {
    $udise_code = $_SESSION['udise_code'];
} elseif (!isset($udise_code)) {
    $udise_code = 'default_udise_code'; // Provide a default or handle error
}

// Initializing variables
$username = "";
$email    = "";
$errors = array(); 

// Check if user is logged in
if (!isset($_SESSION['reg_no']) || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit(); // Stop further execution
}

// Initialize session variables
$reg_no = $_SESSION['reg_no'];
$email = $_SESSION['email'];

// Fetch user details from the database
$query = "SELECT * FROM $table_name WHERE email='$email'";
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


    // Update marks details in the database
    $update_query = "UPDATE $table_name 
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
        $_SESSION['success'] = "Details updated successfully";
        echo "<script>window.location.href = 'student_file_upload.php';</script>"; 
        // header('Location: student_file_upload.php');
        exit(); // Stop further execution
    } else {
        echo "Update failed: " . mysqli_error($db);
        echo "<script>window.location.href = 'error.php';</script>"; 
        // header('Location: error.php');
        exit(); // Stop further execution
    }
} else {
    // If form is not submitted, show the current settings
    echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
    echo 'Table name: ' . $table_name . '<br>';
}

?>

<?php 
// // Turn off error display in production
// ini_set('display_errors', 0); 
// error_reporting(0);

// // Include session and super admin files
// require_once 'session.php';
// require_once 'super_admin.php';

// // Ensure $udise_code is defined
// $udise_code = isset($udise_code) ? $udise_code : (isset($_SESSION['udise_code']) ? $_SESSION['udise_code'] : 'default_udise_code');

// // Initialize session variables
// if (!isset($_SESSION['reg_no']) || !isset($_SESSION['email'])) {
//     header('Location: login.php');
//     exit();
// }

// // Database connection
// require_once 'db_connection.php';

// // Fetch user details from the database
// $table_name = $udise_code . '_student_details';
// $query = "SELECT * FROM $table_name WHERE email=?";
// $stmt = $db->prepare($query);
// $stmt->bind_param("s", $_SESSION['email']);
// $stmt->execute();
// $results = $stmt->get_result();
// $user = $results->fetch_assoc();
// $registration_no = $user['reg_no'];

// if (isset($_POST['submit_personal_details'])) {
//     // Sanitize form inputs
//     $previous_school_name = htmlspecialchars($_POST['previous_school_name']);
//     $fathers_name = htmlspecialchars($_POST['fathers_name']);
//     $mothers_name = htmlspecialchars($_POST['mothers_name']);
//     $current_whatsapp_no = htmlspecialchars($_POST['current_whatsapp_no']);
//     $aadhar_card_no = htmlspecialchars($_POST['aadhar_card_no']);
//     $student_religion = htmlspecialchars($_POST['student_religion']);
//     $student_caste = htmlspecialchars($_POST['student_caste']);
//     $is_student_PWD = htmlspecialchars($_POST['is_student_PWD']);
//     $is_student_EWS = htmlspecialchars($_POST['is_student_EWS']);
//     $student_village_town = htmlspecialchars($_POST['student_village_town']);
//     $student_city = htmlspecialchars($_POST['student_city']);
//     $student_pin_code = htmlspecialchars($_POST['student_pin_code']);
//     $student_police_station = htmlspecialchars($_POST['student_police_station']);
//     $student_district = htmlspecialchars($_POST['student_district']);
//     $student_state = htmlspecialchars($_POST['student_state']);
//     $bank_name = htmlspecialchars($_POST['bank_name']);
//     $bank_account_no = htmlspecialchars($_POST['bank_account_no']);
//     $bank_ifsc_code = htmlspecialchars($_POST['bank_ifsc_code']);

//     // Update marks details in the database using prepared statement
//     $update_query = "UPDATE $table_name SET previous_school_name=?, fathers_name=?, mothers_name=?, current_whatsapp_no=?, aadhar_card_no=?, student_religion=?, student_caste=?, is_student_PWD=?, is_student_EWS=?, student_village_town=?, student_city=?, student_pin_code=?, student_police_station=?, student_district=?, student_state=?, bank_name=?, bank_account_no=?, bank_ifsc_code=? WHERE reg_no=?";
//     $stmt = $db->prepare($update_query);
//     $stmt->bind_param("ssssssssssssssssssi", $previous_school_name, $fathers_name, $mothers_name, $current_whatsapp_no, $aadhar_card_no, $student_religion, $student_caste, $is_student_PWD, $is_student_EWS, $student_village_town, $student_city, $student_pin_code, $student_police_station, $student_district, $student_state, $bank_name, $bank_account_no, $bank_ifsc_code, $registration_no);
//     $stmt->execute();

//     if ($stmt->affected_rows > 0) {
//         $_SESSION['success'] = "Details updated successfully";
//         header('Location: student_file_upload.php');
//         exit();
//     } else {
//         $_SESSION['error'] = "Update failed";
//         header('Location: error.php');
//         exit();
//     }
// } else {
//     // If form is not submitted, show the current settings
//     echo 'This is for School with UDISE CODE - ' . htmlspecialchars($udise_code) . '<br>';
//     echo 'Table name: ' . htmlspecialchars($table_name) . '<br>';
// }
?>

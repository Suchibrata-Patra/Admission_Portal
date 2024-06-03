<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require_once 'database.php';
require 'HOI_super_admin.php';

$table_name = $udise_code . '_HOI_Login_Credentials';
ob_start();

echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';

// Initializing variables
$username = "";
$email    = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST['HOI_Signup'])) {
    $HOI_Udise_ID = $_POST['HOI_Udise_ID'];
    $HOI_HOI_Name = mysqli_real_escape_string($db, $_POST['HOI_HOI_Name']);
    $HOI_email = mysqli_real_escape_string($db, $_POST['HOI_email']);
    $HOI_Mobile_No = mysqli_real_escape_string($db, $_POST['HOI_Mobile_No']);
    $HOI_Login_Password = mysqli_real_escape_string($db, $_POST['HOI_Login_Password']);
    $terms = mysqli_real_escape_string($db, $_POST['terms']);

    if (empty($HOI_Udise_ID)) {
        array_push($errors, "First name is required");
        echo '<script>window.location.href="HOI_Signup.php?error=First name is required";</script>';
        // header("location: HOI_Signup.php?error=First name is required");
        exit();
    }
    if (empty($HOI_HOI_Name)) {
        array_push($errors, "Last name is required");
        echo '<script>window.location.href="HOI_Signup.php?error=Last name is required";</script>';
        // header("location: HOI_Signup.php?error=Last name is required");
        exit();
    }
    if (empty($HOI_email)) {
        array_push($errors, "Email is required");
        echo '<script>window.location.href="HOI_Signup.php?error=Email is required";</script>';
        //  header("location: HOI_Signup.php?error=Email is required");
        exit();
    }
    if (empty($HOI_Mobile_No)) {
        array_push($errors, "Mobile No is required");
        echo '<script>window.location.href="HOI_Signup.php?error=Mobile No is required";</script>';
        // header("location: HOI_Signup.php?error=Mobile No is required");
        exit();
    }
    if (empty($HOI_Login_Password)) {
        array_push($errors, "Password is required");
        echo '<script>window.location.href="HOI_Signup.php?error=Password is required";</script>';
        // header("location: HOI_Signup.php?error=Password is required");
        exit();
    }
    if (empty($terms)) {
        array_push($errors, "Terms acceptance is required");
        echo '<script>window.location.href="HOI_Signup.php?error=Terms acceptance is required";</script>';
        // header("location: HOI_Signup.php?error=Terms acceptance is required");
        exit();
    }

    $user_check_query = "SELECT * FROM $table_name WHERE `HOI_UDISE_ID` = '$HOI_Udise_ID' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    if (!$result) {
        echo "Error: " . mysqli_error($db);
    }
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['HOI_UDISE_ID'] === $HOI_Udise_ID) {
            array_push($errors, "User with this UDISE ID already exists");
            // header("location: HOI_Signup.php?error=User with this UDISE ID already exists");
            exit();
        }
        if ($user['HOI_email'] === $HOI_email) {
            array_push($errors, "Email already exists");
            header("location: HOI_Signup.php?error=Email already exists");
            exit();
        }
        if ($user['HOI_Mobile_No'] === $HOI_Mobile_No) {
            array_push($errors, "Mobile No is already registered");
            header("location: HOI_Signup.php?error=Mobile No is already registered");
            exit();
        }
    }

    if (count($errors) == 0) {
        $hashed_password = password_hash($HOI_Login_Password, PASSWORD_BCRYPT);
    
        // First query to insert into the HOI table
        $query1 = "INSERT INTO $table_name (`HOI_UDISE_ID`, `HOI_Password`, `HOI_Email_ID`, `HOI_Mobile_No`, `is_HOI_Account_Verified`, `emailVerify`, `numberVerify`, `Institution_Name`, `HOI_Name`, `Institution_Address`) 
                   VALUES ('$HOI_Udise_ID', '$hashed_password', '$HOI_email', '$HOI_Mobile_No', 0, 0, 0, NULL, '$HOI_HOI_Name', NULL)";
    
        if (mysqli_query($db, $query1)) {
            // Second query to insert into the edu_org_records table
            $query2 = "INSERT INTO edu_org_records (udise_id, school_name)
                       VALUES ('$HOI_Udise_ID', NULL)";
    
            $query2_result = mysqli_query($db, $query2);
    
            if ($query2_result) {
                $_SESSION['HOI_UDISE_ID'] = $HOI_email;
                $_SESSION['success'] = "You are now logged in";
                echo '<script>window.location.href="HOI_Dashboard.php";</script>';
                // header('location: HOI_Dashboard.php');
            } else {
                echo "Error updating edu_org_records: " . mysqli_error($db);
            }
        } else {
            echo "Error: " . mysqli_error($db);
        }
    }
}
?>

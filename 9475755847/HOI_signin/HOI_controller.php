<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);

include_once 'database.php';
require 'HOI_super_admin.php';

session_start();

// $udise_code = $_SESSION['udise_code'] ?? ''; // Ensure $udise_code is set
$table_name = $udise_code . '_HOI_Login_Credentials';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';
// initializing variables

$username = "";
$email    = "";
$errors = array(); 

// REGISTER USER
if (isset($_POST['HOI_Signup'])) {
  // receive all input values from the form
  $HOI_HOI_Name = $_POST['HOI_HOI_Name'];
  $HOI_email = mysqli_real_escape_string($db, $_POST['HOI_email']);
  $HOI_Mobile_No = mysqli_real_escape_string($db, $_POST['HOI_Mobile_No']);
  $HOI_Udise_ID = mysqli_real_escape_string($db, $_POST['HOI_Udise_ID']);
  $HOI_Login_Password = mysqli_real_escape_string($db, $_POST['HOI_Login_Password']);
  
  // form validation: ensure that the form is correctly filled
  if (empty($HOI_HOI_Name)) { 
    header("location: HOI_Signup.php?error=HOI Name is required"); 
    exit();
  }
  if (empty($HOI_email)) { 
    header("location: HOI_Signup.php?error=Email is required"); 
    exit();
  }
  if (empty($HOI_Mobile_No)) { 
    header("location: HOI_Signup.php?error=Mobile Number is required");
    exit();
  }
  if (empty($HOI_Udise_ID)) { 
    header("location: HOI_Signup.php?error=UDISE ID is required");
    exit();
  }
  if (empty($HOI_Login_Password)) { 
    header("location: HOI_Signup.php?error=Password is required");
    exit();
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $HOI_Check_query = "SELECT * FROM $table_name WHERE HOI_UDISE_ID=? LIMIT 1";
  echo $HOI_Check_query;
  $stmt = $db->prepare($HOI_Check_query);
  $stmt->bind_param('s', $HOI_Udise_ID);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user) { // if user exists
    if ($user['HOI_UDISE_ID'] === $HOI_Udise_ID) {
      header("location: HOI_Signup.php?error=UDISE ID already exists");
      exit();
    }
    if ($user['HOI_HOI_Name'] === $HOI_HOI_Name) {
      header("location: HOI_Signup.php?error=Name already exists");
      exit();
    }
    if ($user['HOI_email'] === $HOI_email) {
      header("location: HOI_Signup.php?error=Email already exists");
      exit();
    }
    if ($user['HOI_Mobile_No'] === $HOI_Mobile_No) {
      header("location: HOI_Signup.php?error=Mobile Number already registered");
      exit();
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $passwordHash = password_hash($HOI_Login_Password, PASSWORD_BCRYPT); // Hashing the password
    $query = "INSERT INTO $table_name (HOI_UDISE_ID, HOI_Password, HOI_Email_ID, HOI_Mobile_No, Indtitution_Name, HOI_Name, Iinstituion_Address) VALUES (?, ?, ?, ?, NULL, ?, NULL)";
    $stmt = $db->prepare($query);
    $stmt->bind_param('sssss', $HOI_Udise_ID, $passwordHash, $HOI_email, $HOI_Mobile_No, $HOI_HOI_Name);
    $stmt->execute();

    $_SESSION['udiseid'] = $HOI_Udise_ID;
    $_SESSION['success'] = "You are now logged in";
    header('location: HOI_Dashboard.php');
    exit();
  }
}
?>

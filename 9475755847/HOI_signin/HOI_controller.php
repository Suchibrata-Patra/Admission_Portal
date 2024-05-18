<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
 include 'database.php';
//  include 'HOI_session.php';
 require 'HOI_super_admin.php';
 
//  $table_name = $udise_code . '_HOI_Login_Credentials';
$table_name = '9475755847_HOI_Login_Credentials';
 echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
 echo 'Table name: ' . $table_name . '<br>';

 // initializing variables
$username = "";
$email    = "";
$errors = array(); 


// REGISTER USER
if (isset($_POST['HOI_Signup'])) {
  // receive all input values from the form
  $HOI_Udise_ID = $_POST['HOI_Udise_ID'];
  $HOI_HOI_Name = mysqli_real_escape_string($db, $_POST['HOI_HOI_Name']);
  $HOI_email = mysqli_real_escape_string($db, $_POST['HOI_email']);
  $HOI_Mobile_No = mysqli_real_escape_string($db, $_POST['HOI_Mobile_No']);
  $HOI_Login_Password = mysqli_real_escape_string($db, $_POST['HOI_Login_Password']);
  $terms = mysqli_real_escape_string($db, $_POST['terms']);
  // $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
  // $dob = mysqli_real_escape_string($db, $_POST['dob']);
  // $terms = mysqli_real_escape_string($db, $_POST['terms']);
  // $reg_no = mysqli_real_escape_string($db, $_POST['reg_no']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($HOI_Udise_ID)) { 
    array_push($errors, "First name is required");
    header("location: HOI_Signup.php?error=First name is required"); 
}
  if (empty($HOI_HOI_Name)) { 
    array_push($errors, "Last name is required");
    header("location: HOI_Signup.php?error=Last name is required"); 
}
  if (empty($HOI_email)) { 
    array_push($errors, "Password is required"); 
    header("location: HOI_Signup.php?error=Password is required");
}
  if (empty($HOI_Mobile_No)) { 
    array_push($errors, "Country Code is required");
    header("location: HOI_Signup.php?error=Country Code is required");
}
  if (empty($HOI_Login_Password)) { 
    array_push($errors, "Phone number is required"); 
    header("location: HOI_Signup.php?error=Phone Number is required");
}
  if (empty($terms)) { 
    array_push($errors, "Date of birth is required"); 
    header("location: HOI_Signup.php?error=Date of birth is required");
}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM $table_name WHERE HOI_UDISE_ID ='$user_id' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['HOI_UDISE_ID'] === $HOI_UDISE_ID) {
      array_push($errors, "email already exists");
      header("location: HOI_Signup.php?error=Email already exists");
    }
  }
  
  if ($user) { // if user exists
    if ($user['HOI_email'] === $HOI_email) {
      array_push($errors, "Registration No is already Registered.");
      header("location: HOI_Signup.php?error=Registration No is already Registered.");
    }
  }
  if ($user) { // if user exists
    if ($user['HOI_Mobile_No'] === $HOI_Mobile_No) {
      array_push($errors, "Mobile No is already registered.");
      header("location: HOI_Signup.php?error=Mobile  No is already Registered.");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    // $passwordHash = md5($password);//encrypt the password before saving in the database
    $query = "INSERT INTO $table_name (`HOI_UDISE_ID`,`HOI_Login_Password`,`HOI_Email_ID`,`HOI_Mobile_No`,`is_HOI_Account_Verified`,`emailVerify`,`numberVerify`,`Institution_Name`,`HOI_Name`,`Institution_Address`) 
    VALUES ('$HOI_UDISE_ID','$HOI_Login_Password','$HOI_email','$HOI_Mobile_No',0,0,0,NULL,'$HOI_Name',NULL)";
    mysqli_query($db, $query);

    $_SESSION['HOI_UDISE_ID'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: HOI_Dashboard.php');
  }
}

// ... 

?>

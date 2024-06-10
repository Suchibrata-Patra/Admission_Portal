<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();  // Initiate session at the very top to avoid 'headers already sent' issues

require_once 'database.php';  // Include database connection
require 'super_admin.php';    // Assuming this sets $udise_code

$table_name = $udise_code . '_student_details';
ob_start();

echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';
$errors = array();
// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fname = $_POST['fname'];
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $countryCode = mysqli_real_escape_string($db, $_POST['countryCode']);
  $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
  $dob = mysqli_real_escape_string($db, $_POST['dob']);
  $terms = mysqli_real_escape_string($db, $_POST['terms']);
  $reg_no = mysqli_real_escape_string($db, $_POST['reg_no']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) { 
    array_push($errors, "First name is required");
    header("location: signup.php?error=First name is required"); 
}
  if (empty($lname)) { 
    array_push($errors, "Last name is required");
    header("location: signup.php?error=Last name is required"); 
}
  if (empty($password)) { 
    array_push($errors, "Password is required"); 
    header("location: signup.php?error=Password is required");
}
  if (empty($countryCode)) { 
    array_push($errors, "Country Code is required");
    header("location: signup.php?error=Country Code is required");
}
  if (empty($phoneNumber)) { 
    array_push($errors, "Phone number is required"); 
    header("location: signup.php?error=Phone Number is required");
}
  if (empty($dob)) { 
    array_push($errors, "Date of birth is required"); 
    header("location: signup.php?error=Date of birth is required");
}
  if (empty($email)) { 
    array_push($errors, "Email is required"); 
    header("location: signup.php?error=Email is required");
}
  if (empty($password)) { 
    array_push($errors, "Password is required"); 
    header("location: signup.php?error=Password is required");
} 
 if (empty($terms)) { 
    array_push($errors, "terms is required"); 
    header("location: signup.php?error=terms is required");
}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM $table_name WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
      header("location: signup.php?error=Email already exists");
    }
  }
  
  if ($user) { // if user exists
    if ($user['reg_np'] === $reg_no) {
      array_push($errors, "Registration No is already Registered.");
      header("location: signup.php?error=Registration No is already Registered.");
    }
  }
  if ($user) { // if user exists
    if ($user['phoneNumber'] === $phoneNumber) {
      array_push($errors, "Mobile No is already registered.");
      header("location: signup.php?error=Mobile  No is already Registered.");
    }
  }

 if (time() < strtotime('+18 years', strtotime($dob))) {
    array_push($errors, "Age is under 18"); 
    header("location: signup.php?error=Age is not 18");
} 
// echo $number = $countryCode.$phoneNumber;
  // Finally, register user if there are no errors in the form
  // if (empty($errors)) {
  //   $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hashing the password
  //   $query = "INSERT INTO $table_name (reg_no, fname, lname, email, phoneNumber, dob, terms, password) 
  //   VALUES ('$reg_no', '$fname', '$lname', '$email', '$phoneNumber', '$dob', '$terms', '$passwordHash')";
  //   mysqli_query($db, $query);

  //   $_SESSION['email'] = $email;
  //   $_SESSION['success'] = "You are now logged in";
  //   header('location: welcome.php');
  //   exit();
  // }
  if (empty($errors)) {
    // Hash the password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $query = "INSERT INTO $table_name (reg_no, fname, lname, email, phoneNumber, dob, terms, password) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Bind parameters
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "ssssssss", $reg_no, $fname, $lname, $email, $phoneNumber, $dob, $terms, $passwordHash);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Set session variables
        $_SESSION['email'] = $email;
        $_SESSION['success'] = "You are now logged in";
        mysqli_stmt_close($stmt); // Close the statement
        mysqli_close($db); // Close the database connection
        header('location: welcome.php'); // Redirect to welcome page
        exit();
    } else {
        // Handle unsuccessful query
        $errors['db_error'] = "Database error: Unable to register user.";
    }
} 



}
?>
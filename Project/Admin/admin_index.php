<?php
session_start(); // Move session_start() to the top
include 'database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = array();
// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM student_details WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);
    
    if (mysqli_num_rows($results) == 1) {
       $_SESSION['email'] = $email;
       $_SESSION['success'] = "You are now logged in";
       // Redirect only if there are no errors
       header('location: welcome.php');
       exit(); // Ensure that no further code is executed after the redirect
    } else {
      array_push($errors, "Wrong username/password combination");
    }
  }
}

?>
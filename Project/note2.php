<?php 
require 'session.php';

// echo $user['fname'];
 $query = "SELECT * FROM student_details WHERE email='$email'";
 $results = mysqli_query($db, $query);
 $user = mysqli_fetch_assoc($results);

 echo $user['issubmitted'] ;
 if ($user['numberVerify'] == 0) {
  header('location: verify.php');
  exit(); // Add exit to stop further execution
} 
if ($user['issubmitted'] == 1) {
  header('location: payment_details.php');
  exit(); // Add exit to stop further execution
} 

?>
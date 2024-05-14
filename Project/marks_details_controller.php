<?php 
require 'session.php';

// echo $user['fname'];

if ($user['numberVerify'] == 0) {
  header('location: verify.php');
} 

// Fetch reg_no from the session
$reg_no = $_SESSION['reg_no'];

$query = "SELECT * FROM student_details WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

echo $user['reg_no'];

// REGISTER USER
if (isset($_POST['submit_marks'])) {
  // receive all input values from the form
  $bengali_marks = $_POST['bengali_marks'];
  $bengali_full_marks = $_POST['bengali_full_marks'];
  $english_marks = mysqli_real_escape_string($db, $_POST['english_marks']);
  $english_full_marks = mysqli_real_escape_string($db, $_POST['english_full_marks']);
  $mathematics_marks = mysqli_real_escape_string($db, $_POST['mathematics_marks']);
  $mathematics_full_marks = mysqli_real_escape_string($db, $_POST['mathematics_full_marks']);
  $physical_science_marks = mysqli_real_escape_string($db, $_POST['physical_science_marks']);
  $physical_science_full_marks = mysqli_real_escape_string($db, $_POST['physical_science_full_marks']);
  $life_science_marks = mysqli_real_escape_string($db, $_POST['life_science_marks']);
  $life_science_full_marks = mysqli_real_escape_string($db, $_POST['life_science_full_marks']);
  $history_marks = mysqli_real_escape_string($db, $_POST['History_marks']);
  $history_full_marks = mysqli_real_escape_string($db, $_POST['History_full_marks']);
  $geography_marks = mysqli_real_escape_string($db, $_POST['geography_marks']);
  $geography_full_marks = mysqli_real_escape_string($db, $_POST['geography_full_marks']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($bengali_marks)) { 
    array_push($errors, "Bengali Mark is required");
    header("location: marks_details.php?error=Bengali Marks is required"); 
}
  if (empty($bengali_full_marks)) { 
    array_push($errors, "Bengali Full Marks is required");
    header("location: marks_details.php?error=Bengali Full Marks is required"); 
}
  if (empty($english_marks)) { 
    array_push($errors, "English Marks is required"); 
    header("location: marks_details.php?error=English Marks is required");
}
  if (empty($english_full_marks)) { 
    array_push($errors, "English Full Marks is required");
    header("location: marks_details.php?error=English Full Marks is required");
}
  if (empty($mathematics_marks)) { 
    array_push($errors, "Mathematics Marks is required"); 
    header("location: marks_details.php?error=Mathematics Marks is required");
}
  if (empty($mathematics_full_marks)) { 
    array_push($errors, "Mathematics Full Marks is required"); 
    header("location: marks_details.php?error=Mathematics Full Marks is required");
}
  if (empty($physical_science_marks)) { 
    array_push($errors, "Physical Science Marks is required"); 
    header("location: marks_details.php?error=Physical Science Marks is required");
}
  if (empty($physical_science_full_marks)) { 
    array_push($errors, "Physical Science Full Marks is required"); 
    header("location: marks_details.php?error=Physical Science Full Marks is required");
} 
 if (empty($life_science_marks)) { 
    array_push($errors, "Life Science Marks is required"); 
    header("location: marks_details.php?error=Life Science Marks is required");
}
 if (empty($life_science_full_marks)) { 
    array_push($errors, "Life Science Full Marks is required"); 
    header("location: marks_details.php?error=Life Science Full Marks is required");
}
 if (empty($history_marks)) { 
    array_push($errors, "History Marks is required"); 
    header("location: marks_details.php?error=History Marks is required");
}
 if (empty($history_full_marks)) { 
    array_push($errors, "History Full Marks is required"); 
    header("location: marks_details.php?error=History Full Marks is required");
}
 if (empty($geography_marks)) { 
    array_push($errors, "Geography Marks is required"); 
    header("location: marks_details.php?error=Geography Marks is required");
}
 if (empty($geography_full_marks)) { 
    array_push($errors, "Geography Full Marks is required"); 
    header("location: marks_details.php?error=Geography Full Marks is required");
}


// first check the database to make sure 
// a user does not already exist with the same email
$email = $_SESSION['email'];
$user_check_query = "SELECT * FROM student_details WHERE email='$email' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);

// Finally, register user if there are no errors in the form
if (count($errors) == 0) {
  $query = "INSERT INTO marks_details (reg_no,bengali_marks, bengali_full_marks, english_marks, english_full_marks, mathematics_marks, 
            mathematics_full_marks, physical_science_marks, physical_science_full_marks, life_science_marks, 
            life_science_full_marks, history_marks, history_full_marks, geography_marks, geography_full_marks) 
            VALUES ('$reg_no','$bengali_marks', '$bengali_full_marks', '$english_marks', '$english_full_marks', '$mathematics_marks', 
            '$mathematics_full_marks', '$physical_science_marks', '$physical_science_full_marks', '$life_science_marks', 
            '$life_science_full_marks', '$history_marks', '$history_full_marks', '$geography_marks', '$geography_full_marks')";
  mysqli_query($db, $query);

  $_SESSION['email'] = $email;
  $_SESSION['success'] = "You are now logged in";
  header('location:personal_details.php');
}

// ... 

?>

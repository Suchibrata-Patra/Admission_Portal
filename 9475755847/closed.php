<?php
require 'session.php';
require 'super_admin.php';
require 'Date_Decider.php';
$table_name = $udise_code . '_Student_Details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';
$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if($is_Application_live==0){
        echo "<h2>Application Deadline is Over</h2>";
    }elseif($is_Admission_live==0 && $user['is_Admission_Allowed']==0){
            // echo "<h2>Admission is Closed, Please Contact With the Administration for Further Details And Resumption of Admission</h2>";
    }
    ?>
</body>
</html>
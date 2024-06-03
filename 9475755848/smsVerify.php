<?php 
require 'vendor/autoload.php';
require 'session.php';
require 'database.php';
require 'super_admin.php';
 $table_name = $udise_code . '_student_details';
 echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
 echo 'Table name: ' . $table_name . '<br>';
$rand = rand(999999 , 100000);

$basic  = new \Nexmo\Client\Credentials\Basic('de72066f', 'LttJnhM3fiFK6pj9');
$client = new \Nexmo\Client($basic);

$message = $client->message()->send([
    'to' => '8801789838721',
    'from' => 'Dream Media',
    'text' => 'Your varification code is: '.$rand,
]);
  $_SESSION['numberCode'] = 1;
  $_SESSION['success'] = "Code has been sent to your Number";

  $user_id = $user['id'];
  $query = "UPDATE $table_name SET numberVerify = $rand WHERE id = '$user_id'";
  $results = mysqli_query($db, $query);
  header('location: verify.php');
?>
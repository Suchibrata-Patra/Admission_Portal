<?php
session_start();
require 'session.php'; // Assuming 'session.php' contains your database connection logic

require 'database.php'; // Include database.php to access $sd

$query = "SELECT * FROM $sd"; // Use $sd in your SQL query
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
echo $user['fname'];
?>

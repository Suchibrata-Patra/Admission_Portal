<?php
$servername = "localhost";
$username = "id21749624_suchi";
$password = "Suchi#Brata@2003";
$dbname = "id21749624_localhost";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    // Removed the echo statement
}

// Commented out the echo statements to avoid unintended output

echo "Server: $servername<br>";
echo "Username: $username<br>";
echo "Password: $password<br>";
echo "Database: $dbname<br>";

?>

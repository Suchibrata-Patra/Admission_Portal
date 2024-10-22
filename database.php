<?php
    // $servername = "localhost"; 
    // $username = "root"; 
    // $password = "root"; 
    // $database = "user"; 
    // // Create a connection 
    // $db = mysqli_connect($servername, $username, $password, $database);

    // echo "Server Connected Succesfully.";
?>

<?php
// Include the function to load environment variables
require __DIR__ . 'load_env.php';

// Load the environment variables from the .env file
load_env('.env');

// Fetch database credentials from environment variables
$servername = getenv('DB_HOST') ?: 'localhost'; // Fallback for local development
$username = getenv('DB_USER') ?: 'root';        // Fallback for local development
$password = getenv('DB_PASS') ?: 'root';        // Fallback for local development
$database = getenv('DB_NAME') ?: 'user';        // Fallback for local development

// Create a connection
$db = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$db) {
    error_log("Connection failed: " . mysqli_connect_error()); // Log error to server logs
    die("Connection failed: Unable to connect to the database.");
}

// If the connection is successful
echo "Server Connected Successfully.";
?>
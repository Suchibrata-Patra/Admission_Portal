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
    // Fetch database credentials from environment variables, with fallback values for local development
    $servername = getenv('DB_HOST') ?: 'localhost'; // Use 'localhost' as default if not set
    $username = getenv('DB_USER') ?: 'root';        // Use 'root' as default if not set
    $password = getenv('DB_PASS') ?: 'root';        // Use 'root' as default if not set
    $database = getenv('DB_NAME') ?: 'user';        // Use 'user' as default if not set

    // Create a connection
    $db = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Server Connected Successfully.";
?>

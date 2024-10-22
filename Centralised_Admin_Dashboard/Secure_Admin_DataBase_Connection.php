<?php
// $servername = "localhost"; 
// $username = "root"; 
// $password = "root"; 
// $database = "secure_login_system"; 
// // Create a connection 
// $db = mysqli_connect($servername, $username, $password, $database); 
?>
<?php
    // Fetch database credentials from environment variables, with fallback values for local development
    $servername = getenv('DB_HOST') ?: 'localhost'; // Use 'localhost' as default if not set
    $username = getenv('ADMIN_DB_USER') ?: 'root';        // Use 'root' as default if not set
    $password = getenv('ADMIN_DB_PASS') ?: 'root';        // Use 'root' as default if not set
    $database = getenv('ADMIN_DB_NAME') ?: 'secure_login_system';        // Use 'user' as default if not set

    // Create a connection
    $db = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Server Connected Successfully.";
?>

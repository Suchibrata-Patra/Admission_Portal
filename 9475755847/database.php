<?php
    // $servername = "localhost"; 
    // $username = "u955994755_suchi_2003"; 
    // $password = "(Such#Brata@2003)"; 
    // $database = "u955994755_USER"; 
    // // Create a connection 
    // $db = mysqli_connect($servername, $username, $password, $database);

    // echo "Server Connected Succesfully.";
?>

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
function loadEnv($file) {
    if (!file_exists($file)) {
        throw new Exception("Env file not found.");
    }

    // Read the .env file and parse it
    $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignore comments and empty lines
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        // Split key and value safely
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $key = trim($parts[0]);
            $value = trim($parts[1]);

            // Remove surrounding quotes if they exist
            if (preg_match('/^["\'](.*)["\']$/', $value, $matches)) {
                $value = $matches[1];
            }

            // Set environment variable
            putenv("$key=$value");
        }
    }
}

try {
    // Load the .env file
    loadEnv(__DIR__ . '/.env');

    // Retrieve database credentials from the environment
    $host = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');
    $dbname = getenv('DB_NAME');

    // Validate environment variables
    if (!$host || !$user || !$password || !$dbname) {
        throw new Exception("Missing or incorrect environment variables.");
    }

    if (!filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) && !preg_match('/^[a-zA-Z0-9.-]+$/', $host)) {
        throw new Exception("Invalid DB_HOST value.");
    }

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $dbname)) {
        throw new Exception("Invalid DB_NAME value.");
    }

    // Enable strict error reporting for MySQLi
    mysqli_report(MYSQLI_REPORT_STRICT);

    // Establish a database connection
    $db = new mysqli($host, $user, $password, $dbname);

    echo "Successfully connected!";
} catch (Exception $e) {
    // Log the error securely
    error_log($e->getMessage(), 0);
    die("An error occurred while connecting to the database.");
}
?>

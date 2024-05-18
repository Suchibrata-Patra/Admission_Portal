<?php
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data and sanitize
    $udise_code = mysqli_real_escape_string($db, $_POST['udise_code']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    
    // Validate UDISE code and password format (add more checks as needed)
    if (!preg_match("/^[a-zA-Z0-9]{6,}$/", $udise_code)) {
        $_SESSION['login_error'] = "Invalid UDISE code format";
        header("location: error.php");
        exit;
    }

    // Fetch user details using prepared statement
    $query = "SELECT HOI_UDISE_ID, HOI_Password FROM 9475755847_HOI_Login_Credentials WHERE HOI_UDISE_ID = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "s", $udise_code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $stored_udise_code, $hashed_password);
        mysqli_stmt_fetch($stmt);
        
        // Verify password
        if (password_verify($password, $hashed_password)) {
            $_SESSION['udise_code'] = $udise_code;
            header("location: hoi_dashboard.php");
            exit;
        } else {
            $_SESSION['login_error'] = "Invalid password";
            header("location: error.php");
            exit;
        }
    } else {
        $_SESSION['login_error'] = "Invalid UDISE code";
        header("location: error.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOI Login</title>
</head>
<body>
    <h2>HOI Login</h2>
    <form action="HOI_login.php" method="post">
        <label for="udise_code">UDISE Code:</label>
        <input type="text" id="udise_code" name="udise_code" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>

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
        $_SESSION['signup_error'] = "Invalid UDISE code format";
        header("location: signup_error.php");
        exit;
    }

    // Check if UDISE code already exists
    $check_query = "SELECT HOI_UDISE_ID FROM 9475755847_HOI_Login_Credentials WHERE HOI_UDISE_ID = ?";
    $check_stmt = mysqli_prepare($db, $check_query);
    mysqli_stmt_bind_param($check_stmt, "s", $udise_code);
    mysqli_stmt_execute($check_stmt);
    mysqli_stmt_store_result($check_stmt);
    
    if (mysqli_stmt_num_rows($check_stmt) > 0) {
        $_SESSION['signup_error'] = "UDISE code already exists";
        header("location: signup_error.php");
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user into database
    $insert_query = "INSERT INTO 9475755847_HOI_Login_Credentials (HOI_UDISE_ID, HOI_Password) VALUES (?, ?)";
    $insert_stmt = mysqli_prepare($db, $insert_query);
    mysqli_stmt_bind_param($insert_stmt, "ss", $udise_code, $hashed_password);
    mysqli_stmt_execute($insert_stmt);

    if (mysqli_stmt_affected_rows($insert_stmt) == 1) {
        $_SESSION['signup_success'] = "Signup successful. You can now login.";
        header("location: HOI_login.php");
        exit;
    } else {
        $_SESSION['signup_error'] = "Signup failed. Please try again.";
        header("location: signup_error.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOI Signup</title>
</head>
<body>
    <h2>HOI Signup</h2>
    <?php
    if (isset($_SESSION['signup_error'])) {
        echo '<p style="color: red;">' . $_SESSION['signup_error'] . '</p>';
        unset($_SESSION['signup_error']);
    }
    ?>
    <form action="HOI_signup.php" method="post">
        <label for="udise_code">UDISE Code:</label>
        <input type="text" id="udise_code" name="udise_code" required><br><br>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Signup">
    </form>
</body>
</html>

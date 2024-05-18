<?php
require 'database.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs to prevent SQL injection
    $username = mysqli_real_escape_string($db, $username);
    $password = mysqli_real_escape_string($db, $password);

    // Query to check if the provided credentials exist in the database
    $sql = "SELECT * FROM `9475755847_HOI_Login_Credentials` WHERE `HOI_UDISE_ID`='$username' AND `HOI_Password`='$password'";
    $result = $db->query($sql);

    if ($result->num_rows >0) {
        // Login successful
        echo "Login successful!";
        echo '<script>window.location.href="HOI_Dashboard.php";</script>';        // You can redirect the user to another page here
    } else {
        // Login failed
        echo "Invalid username or password.";
    }
}

// Close MySQL dbection
$db->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>

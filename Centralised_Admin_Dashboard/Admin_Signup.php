<?php
session_start();
ini_set('display_errors', 0); // Disable error display in production
error_reporting(E_ALL);
include 'Secure_Admin_DataBase_Connection.php';

$errors = array();
$table_name = 'Secure_Login_Stack';

// Function to validate username and password complexity
function validateInput($username, $password) {
    if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        return "Admin ID can only contain letters, numbers, and underscores.";
    }
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        return "Password must be at least 8 characters long and include at least one letter and one number.";
    }
    return true;
}

// SIGN UP USER
if (isset($_POST['Admin_Signup'])) {
    // Sanitize inputs
    $secure_admin_username = filter_input(INPUT_POST, 'this_is_Admin_Login_ID_input', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'this_is_Admin_Password_input', FILTER_SANITIZE_STRING);

    // Validate inputs
    $validation_result = validateInput($secure_admin_username, $password);
    if ($validation_result !== true) {
        array_push($errors, $validation_result);
    }

    if (count($errors) == 0) {
        // Use prepared statements to prevent SQL injection
        $stmt = $db->prepare("SELECT * FROM $table_name WHERE secure_admin_username = ?");
        $stmt->bind_param('s', $secure_admin_username);
        $stmt->execute();
        $results = $stmt->get_result();

        if ($results->num_rows == 0) {
            // Hash the password with a strong algorithm and a unique salt
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Use prepared statements to prevent SQL injection
            $stmt = $db->prepare("INSERT INTO $table_name (secure_admin_username, secure_admin_password_hash) VALUES (?, ?)");
            $stmt->bind_param('ss', $secure_admin_username, $hashed_password);
            $stmt->execute();

            // Regenerate session ID for security
            session_regenerate_id(true);
            $_SESSION['secure_admin_username'] = $secure_admin_username;
            $_SESSION['success'] = "You are now registered and logged in";
            echo '<script>window.location.href="index.php";</script>';
            exit();
        } else {
            array_push($errors, "Admin ID already exists");
        }
    }

    // Output any errors for debugging
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../../../../Assets/css/Generalised_HOI_Stylesheet.css">
    <style>
      body {
        background-image: url("../../Assets/images/login_Background.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        margin: 0;
        height: 100vh;
      }
    </style>
    
    <title>Admin Signup</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
                <h3>Super Admin Signup</h3>
                <hr>
                <form method="post" action="Admin_Signup.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Admin ID</label>
                        <input type="text" name="this_is_Admin_Login_ID_input" class="form-control" id="exampleInputEmail1" placeholder="Enter your Admin ID" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="this_is_Admin_Password_input" class="form-control" id="exampleInputPassword1" placeholder="Enter Your password" required>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="showPasswordCheck">
                      <label class="form-check-label" for="showPasswordCheck">Show Password</label>
                  </div>
                    <button type="submit" class="btn btn-primary" name="Admin_Signup">Sign Up</button>
                    <div class="signup-link">
                        <a href="Admin_Login.php">Already have an account? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
         document.getElementById('showPasswordCheck').addEventListener('click', function() {
            var passwordInput = document.getElementById('exampleInputPassword1');
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
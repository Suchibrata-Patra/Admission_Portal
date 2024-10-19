<?php
session_start();
ini_set('display_errors', 1); 
error_reporting(E_ALL);
include 'Secure_Admin_DataBase_Connection.php';

$errors = array();
$table_name = 'Secure_Login_Stack';

// LOGIN USER
if (isset($_POST['Admin_Login'])) {
    $secure_admin_username = mysqli_real_escape_string($db, $_POST['this_is_Admin_Login_ID_input']);
    $password = mysqli_real_escape_string($db, $_POST['this_is_Admin_Password_input']);

    // Validate inputs
    if (empty($secure_admin_username)) {
        array_push($errors, "Admin ID is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) { 
        $query = "SELECT secure_admin_password_hash FROM $table_name WHERE secure_admin_username ='$secure_admin_username'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
            $user = mysqli_fetch_assoc($results);
            $stored_password = $user['secure_admin_password_hash'];

            // Verify the entered password against the hashed password
            if (password_verify($password, $stored_password)) {
                // Debugging output
                echo "Login successful! Redirecting...";
                $_SESSION['secure_admin_username'] = $secure_admin_username;
                $_SESSION['success'] = "You are now logged in";
                echo '<script>window.location.href="index.php";</script>';
                exit();
            } else {
                array_push($errors, "Wrong password");
            }
        } else {
            array_push($errors, "Admin ID not found");
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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">

    
    <!-- Bootstrap CSS -->
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
    
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
                <h3>Super Admin</h3>
                <hr>
                <form method="post" action="Admin_Login.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Admin ID</label>
                        <input type="text" name="this_is_Admin_Login_ID_input" class="form-control" id="exampleInputEmail1" aria-describedby="udiseidHelp" placeholder="Enter your Admin ID">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="this_is_Admin_Password_input" class="form-control" id="exampleInputPassword1" placeholder="Enter Your password">
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="showPasswordCheck">
                      <label class="form-check-label" for="showPasswordCheck">
                          Show Password
                      </label>
                  </div>
                    <button type="submit" class="btn btn-primary" name="Admin_Login">Login</button>
                    <div class="signup-link">
                        <a href="Admin_Signup.php">New Here? Sign Up</a>
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

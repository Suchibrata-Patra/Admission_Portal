<?php
session_start();
include 'database.php';
include 'HOI_super_admin.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = array();
$table_name = $udise_code . '_HOI_Login_Credentials';

// LOGIN USER
if (isset($_POST['HOI_Login'])) {
  $udiseid = mysqli_real_escape_string($db, $_POST['this_is_HOI_Udise_ID_data_input']);
  $password = mysqli_real_escape_string($db, $_POST['this_is_HOI_Password_input']);

  if (empty($udiseid)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    // Retrieve hashed password from the database
    $query = "SELECT HOI_Password FROM $table_name WHERE HOI_UDISE_ID ='$udiseid'";
    $results = mysqli_query($db,$query);
    
    if (mysqli_num_rows($results) == 1) {
       $user = mysqli_fetch_assoc($results);
       $hashed_password = $user['HOI_Password'];

       // Verify the entered password against the hashed password
       if (password_verify($password, $hashed_password)) {
          $_SESSION['udiseid'] = $udiseid;
          $_SESSION['success'] = "You are now logged in";
          // Redirect only if there are no errors
          echo '<script>window.location.href="HOI_Dashboard.php";</script>';
        //   header('location: HOI_Dashboard.php');
          exit(); // Ensure that no further code is executed after the redirect
       } else {
          array_push($errors, "Wrong password");
       }
    } else {
      array_push($errors, "Email not found");
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

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Login</title>
    <style>
        body {
            background-color: #f6f6f6; /* Light grey background */
            font-family: Arial, sans-serif; /* Standard font */
        }
        .login-container {
            margin-top: 50px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); /* Shadow effect */
            border-radius: 10px; /* Rounded corners */
            padding: 30px; /* Padding for spacing */
            background-color: #fff; /* White background */
        }
        h3 {
            color: #484848; /* Dark grey text color */
            text-align: center;
            margin-bottom: 30px; /* Margin at the bottom of the heading */
        }
        hr {
            border-top: 1px solid #ddd;
            margin-bottom: 20px; /* Margin at the bottom of the horizontal line */
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .btn-primary {
            background-color: #fd5c63; /* Airbnb's red color */
            border: none;
            border-radius: 8px;
            width: 100%; /* Full width button */
            margin-top: 20px; /* Margin at the top */
        }
        .btn-primary:hover {
            background-color: #eb4248; /* Lighter red on hover */
        }
        .signup-link {
            text-align: center; /* Center the signup link */
            margin-top: 20px; /* Space between button and link */
        }
        a {
            color: #fd5c63; /* Red color for links */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
                <h3>Welcome Back!</h3>
                <hr>
                <form method="post" action="HOI_Login.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">HOI_UDISE_ID</label>
                        <input type="udiseid" name="this_is_HOI_Udise_ID_data_input" class="form-control" id="exampleInputEmail1" aria-describedby="udiseidHelp" placeholder="Enter your udiseid">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="this_is_HOI_Password_input" class="form-control" id="exampleInputPassword1" placeholder="Enter HOI password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="HOI_Login">Login</button>
                    <div class="signup-link">
                        <a href="HOI_signup.php">New Here? Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

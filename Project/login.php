<?php
session_start();
include 'database.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = array();

// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "Email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $query = "SELECT * FROM student_details WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);
    
    if (mysqli_num_rows($results) == 1) {
       $_SESSION['email'] = $email;
       $_SESSION['success'] = "You are now logged in";
       // Redirect only if there are no errors
       header('location: welcome.php');
       exit(); // Ensure that no further code is executed after the redirect
    } else {
      array_push($errors, "Wrong username/password combination");
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
            background-color: #f6f6f6; /* Airbnb's light grey background color */
            font-family: Arial, sans-serif; /* Using a standard font */
        }
        .login-container {
            margin-top: 50px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Applying shadow to the container */
            border-radius: 10px; /* Adding border-radius for rounded corners */
            padding: 30px; /* Adding padding for better spacing */
            background-color:White;
        }
        h3 {
            color: #484848; /* Airbnb's dark grey text color */
            text-align: center;
        }
        hr {
            border-top: 1px solid #ddd;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .btn-primary {
            background-color: #fd5c63; /* Airbnb's red color */
            border: none;
            border-radius: 8px;
            width: 100%; /* Making the button full width */
            margin-top: 20px; /* Adding margin at the top */
        }
        .btn-primary:hover {
            background-color: #eb4248; /* Slightly lighter red on hover */
        }
        .signup-link {
            text-align: center; /* Centering the signup link */
            margin-top: 10px; /* Adding some space between the button and the link */
        }
        a {
            color: #fd5c63; /* Airbnb's red color for links */
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center"> <!-- Centering the login container -->
            <div class="col-md-6 login-container"> <!-- Adding a container and applying shadow -->
                <h3>Login or Signup</h3>
                <hr>
                <form method="post" action="">
                    <?php include('errors.php'); ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <button type="submit" class="btn btn-primary"  style="margin-top:2px;" name="login_user">Submit</button>
                    <div class="signup-link" >
                        <a href="signup.php">New Here? Sign Up</a> <!-- Adding margin to separate the link -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


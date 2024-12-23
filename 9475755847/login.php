<?php include('_DIR_/../../exception_handler.php') ?>
<?php include('../favicon.php') ?>
<?php
session_start();
include 'database.php';
include 'super_admin.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = array();
$table_name = $udise_code . '_Student_Details';

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
    // Retrieve hashed password from the database
    $query = "SELECT password FROM $table_name WHERE email='$email'";
    $results = mysqli_query($db, $query);
    
    if (mysqli_num_rows($results) == 1) {
       $user = mysqli_fetch_assoc($results);
       $hashed_password = $user['password'];

       // Verify the entered password against the hashed password
       if (password_verify($password, $hashed_password)) {
          $_SESSION['email'] = $email;
          $_SESSION['success'] = "You are now logged in";
          // Redirect only if there are no errors
          header('location: welcome.php');
          exit(); // Ensure that no further code is executed after the redirect
       } else {
          array_push($errors, "Wrong Password,Try Fogot Password.");
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
    <link rel="stylesheet" href="../../../Assets/css/login.css">


    <title>Login</title>
    <script>
        window.history.forward();
    </script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style>
        body {
            background-color: #f6f6f6; /* Light grey background */
            font-family: Arial, sans-serif; /* Standard font */
        }
        .login-container {
            margin-top: 120px;
            margin-bottom:120px;
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
            border-radius: 4px;
            border: 1px solid #ddd;
            padding:8px;
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
<?php include('site_header.php') ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
            <div style="display: flex; align-items: center; justify-content: center;">
        <span class="material-icons" style="font-size: 48px; margin-right: 10px; color: black;">
        <span class="material-symbols-outlined">
supervisor_account
</span>
</span>
        </span>
        <h2 style="margin: 0; font-size: 24px; color: black;">
            Login
        </h2>
    </div>
                <hr>
                <form method="post" action="login.php">
                    <?php include('errors.php'); ?>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label" style="color:Black;font-weight:bold;">Email Address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email" style="color:black;font-weight:300;">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label" style="color:Black;font-weight:bold;">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Enter your password">
                        <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="showPasswordCheck">
                                                    <label class="form-check-label" for="showPasswordCheck">
                                                        Show Password
                                                    </label>
                                                </div>
                    </div>
                    
                    <button 
        type="submit" 
        name="login_user" 
        style="background-color:#f2f0f0; color:black; font-weight:300; border:none; padding:10px 20px; cursor:pointer;border-radius:4px;" 
        onmouseover="this.style.backgroundColor='black'; this.style.color='white';" 
        onmouseout="this.style.backgroundColor='#f2f0f0'; this.style.color='black';">
        Login
    </button>                   
     <div class="signup-link" style="text-align: center;">
    <a href="signup.php" style="display: inline-block; margin-right: 10px;color:grey;">Sign Up</a>  
    <a href="#" style="display: inline-block; margin-right: 10px;color:rgb(222, 47, 47)" disabled>|</a>  
    <a href="forgot_password.php" style="display: inline-block;color:grey;"> Forgot Password ?</a>
</div>


                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
         document.getElementById('showPasswordCheck').addEventListener('click', function() {
            var passwordInput = document.getElementById('exampleInputPassword1');
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>
    <?php include('site_footer.php') ?>

<!-- 
  - #BACK TO TOP
  -->

<a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
  <ion-icon name="arrow-up"></ion-icon>
</a>
<script src="./Assets/js/script.js" defer></script>

<!-- Optional JavaScript; choose one of the two! -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
  crossorigin="anonymous"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
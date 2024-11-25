<?php include(__DIR__ . '/../../exception_handler.php'); ?>
<?php
session_start();
include 'database.php';
include 'HOI_Super_Admin.php';

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
          echo '<script>window.location.href="index.php";</script>';
        //   header('location: inde.php');
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
    <link rel="stylesheet" href="/../../../../Assets/css/Generalised_HOI_Stylesheet.css">
    <style>
      body {
        background-image: url("../../Assets/images/login_Background.png");
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        margin: 0; /* Ensure no margin around the body */
        height: 100vh; /* Ensure the body height is 100% of the viewport height */
      }
    </style>
    

    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 login-container">
                <h3>Administrator Login</h3>
                <hr>
                <form method="post" action="HOI_Login.php">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">UDISE ID</label>
                        <input type="udiseid" name="this_is_HOI_Udise_ID_data_input" class="form-control" id="exampleInputEmail1" aria-describedby="udiseidHelp" placeholder="Enter your udiseid">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="this_is_HOI_Password_input" class="form-control" id="exampleInputPassword1" placeholder="Enter HOI password">
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="showPasswordCheck">
                      <label class="form-check-label" for="showPasswordCheck">
                          Show Password
                      </label>
                  </div>
                    <button type="submit" class="btn btn-primary" name="HOI_Login">Login</button>
                    <div class="signup-link">
                        <a href="HOI_Signup.php">New Here? Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

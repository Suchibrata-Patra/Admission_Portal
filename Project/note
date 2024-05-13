<?php
session_start();
include('dbconnectionrequest.php');
error_reporting(E_ALL);
ini_set('display_errors', 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($username && $password) {
        $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $dbUsername, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                session_regenerate_id(true);
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $username;

                // Add additional security measures if needed (e.g., logging, 2FA)
                header('Location: index.php');
                exit();
            }
        }

        // Delaying response on invalid login to mitigate brute force attacks
        sleep(2);
        header('Location: login.php?error=1');
        exit();
    } else {
        // Invalid input, redirect back to login form
        header('Location: login.php?error=2');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: left; /* Adjust this line */
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            
        }
.form-group {
    margin-bottom: 20px;
    text-align: left; /* Align the text to the left */
}

.form-label {
    color: BLACK;
    background-color: #ddef75;
    padding-left: 5px;
    padding-right: 5px;
    padding-top: 2.5px;
    padding-bottom: 2.5px;
    margin-top: 4px;
    margin-bottom: -0.1px;
    border-top-right-radius: 6.5px;
    border-top-left-radius: 6.5px;
    margin-left: 0!important; /* Adjusted margin-left to 0 */
}


        .logo-container {
            background-color: #fff;
            padding-left: 33px;
            border-radius: 10px;
            padding-right: 20px;
            padding-top: 30%px;
            border-color: white;
            border-left-color: white;
            border-left: 267px;
            margin-bottom: 2px;
        }
.container {
    border-radius: 0px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1), 0 0 10px rgba(227, 219, 250, 0.5); /* Added box shadow with color */
    background: linear-gradient(45deg, #ffffff, #f2f2f2, #e5e5e5); /* Gradient from white to shades of light grey */
    border: 2px solid #e3dbfa;
    padding: 30px;
    width: 100%;
    text-align: center;
    height: 80%;
    border-top-left-radius: 50px;
    border-top-right-radius:50px;
}



        .logo {
            width: 120px;
            margin-bottom:0px;
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #333;
        }

       

        .form-control {
            border: 1px solid BLACK;
            border-radius: 7px;
            padding: 8px;
            width: 100%;
        }

        .btn-primary {
            background-color: #000;
            border-color: #000;
            width: 70%;
            border-radius:4px;
            padding-left:7px;
            padding-right:7px;
            padding-top:10px;
            padding-bottom:10px;
        }
.btn-primary:hover{
    background-color:BLACK;
}

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
        .profile-picture {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5%;
            margin-bottom:10px;
        }
        
        
       @media (min-width: 992px) { 
    body{
            background-image: url('Asset/loginpagebackground_desktop.jpg ');
    }
    .container {
        background-color: white;
        width: 400px;
        border-radius: 30px; /* Adjust the width for desktop */
        margin-left:9%;
        margin-top:-7%;
    }
}

        
    </style>
</head>

<body>
    <div class="logo-container">
<img src="Asset/image.png?<?php echo time(); ?>" alt="Company Logo" class="img-fluid logo profile-picture">
    </div>
    <div class="container">
        <h2 style="font-weight:bolder;margin-top:5%;color:BLACK">Login</h2>
        <a href="#" data-toggle="modal" data-target="#customModal" style="display: flex; align-items: center; justify-content: center; padding-top: 12px;">Forgot ?</a>

        <?php
        // Display an error message if the login attempt was unsuccessful
        if (isset($_GET['error']) && $_GET['error'] == 1) {
            echo '<div class="alert alert-danger" role="alert">Invalid username or password. Please try again.</div>';
        }
        ?>

        <!-- Login Form -->
        <form method="post">
            <div class="form-group">
              <label for="username" class="form-label">UserName</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password:</label>

                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                
            </div> 
            <button type="submit" class="btn btn-primary">Login</button>
            <p style="margin-top:70%">Release Versoin 2.0.1 (Stable Build) </p>
           
<br>


<!-- Bootstrap Modal -->
<div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <!--<h5 class="modal-title" id="customModalLabel"></h5>-->
        <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
        <!--  <span aria-hidden="true">&times;</span>-->
        <!--</button>-->
      </div>
      <div class="modal-body">
       Relax ! and try to remember your password... 
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
      <!--</div>-->
    </div>
  </div>
</div>

        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

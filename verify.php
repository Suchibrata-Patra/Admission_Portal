<?php
require 'session.php';
if ($user['numberVerify'] == 1) {
  header('location: welcome.php');
} 

if (isset($_POST['email_code'])) {
    $entered_code = $_POST['code'];
    $email_verify = $user['emailVerify']; // Assuming you have stored the email verification status in the $user array

    if ($entered_code == $email_verify) {
        // Update the Numberverify column to 1
        $user_id = $user['id'];
        $query = "UPDATE users SET Numberverify = 1 WHERE id = '$user_id'";
        $results = mysqli_query($db, $query);

        if ($results) {
            // Redirect to a success page or do something else
            header('location: welcome.php');
            exit();
        } else {
            // Handle database error
            echo "Error updating Numberverify column.";
        }
    } else {
        // Handle incorrect OTP entry
        echo "Incorrect verification code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
 
<head> this
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Email Verification</title>

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Email Verification</h2>

                        <?php if (isset($_SESSION['name'])) : ?>
                            <div class="alert alert-info" role="alert">
                                Welcome <strong><?php echo $_SESSION['name']; ?></strong>
                            </div>
                        <?php endif ?>

                        <p class="lead">Your Name: <?php echo $user['name'] ?> </p>
                        <p class="lead">Your Phone Number: <?php echo $user['phoneNumber'] ?> </p>

                        <?php if ($user['emailVerify'] == 1) : ?>
                            <div class="alert alert-success" role="alert">
                                Your email is already verified.
                            </div>
                        <?php endif ?>

                        <?php if (isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success" role="alert">
                                <strong><?php echo $_SESSION['success']; ?></strong>
                            </div>
                        <?php endif ?>

                        <?php if ($user['emailVerify'] != 1) : ?>
                            <form method="post">
                                <div class="mb-3">
                                    <label for="verificationCode" class="form-label">Enter verification code</label>
                                    <input type="text" id="verificationCode" name="code" class="form-control" placeholder="Verification code">
                                </div>
                                <button type="submit" name="email_code" class="btn btn-primary btn-block">Verify Email</button>
                            </form>
                        <?php endif ?>

                        <hr>

                        <p><a href="email.php">Resend OTP</a></p>

                        <a href="welcome.php?logout='1'" class="btn btn-danger btn-block">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>

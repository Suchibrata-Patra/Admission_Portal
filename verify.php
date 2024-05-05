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
        ?>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            width: 400px;
            border: none;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 40px;
        }

        .card-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .lead {
            font-size: 18px;
            color: #555;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 5px;
            width: 100%;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .resend-link {
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .resend-link:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Email Verification</h2>
                <div class="text-center mb-4">
                    <?php if (isset($_SESSION['name'])) : ?>
                        <div class="alert alert-info" role="alert">
                            Welcome <strong><?php echo $_SESSION['name']; ?></strong>
                        </div>
                    <?php endif ?>
                    <p class="lead">Your Name: <?php echo $user['name'] ?></p>
                    <p class="lead">Your Phone Number: <?php echo $user['phoneNumber'] ?></p>
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
                            <button type="submit" name="email_code" class="btn btn-primary">Verify Email</button>
                        </form>
                        <p class="mt-3">Didn't receive the code? <a href="email.php" class="resend-link">Resend OTP</a></p>
                    <?php endif ?>
                </div>
                <hr>
                <a href="welcome.php?logout='1'" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>

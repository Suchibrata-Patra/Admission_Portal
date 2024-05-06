<?php
require 'session.php';

// Handle form submission for email verification
if(isset($_POST['email_code'])) {
    if($user['emailVerify'] == $_POST['code']) {
        $user_id = $user['id'];
        $query = "UPDATE student_details SET numberVerify = 1, emailVerify = 1 WHERE id = '$user_id'";
        $results = mysqli_query($db, $query);
        unset($_SESSION['codeSend']);
        header('location: welcome.php');
    }
}
$user_id = $user['id'];
$name_query = "SELECT fname FROM student_details WHERE id = '$user_id'";
$results = mysqli_query($db, $name_query);
$row = mysqli_fetch_assoc($results);
$student_name = $row['fname'];

// Handle edit option
if(isset($_POST['edit'])) {
    // Delete user information from the database
    $user_id = $user['id'];
    $query = "DELETE FROM student_details WHERE id = '$user_id'";
    mysqli_query($db, $query);

    // Redirect to signup page for entering new details
    header('location: signup.php');
    exit(); // Ensure script stops here
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 3rem;
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
        }
        .message {
            margin-top: 1rem;
            color: #6c757d;
        }
        .btn {
            min-width: 150px;
        }
    </style>
</head>
<body>
<div class="container">
<?php if (isset($_SESSION['email'])) : ?>
    <p>Welcome, <strong><?php echo $student_name; ?></strong></p>
<?php endif ?>
    <a href="welcome.php?logout='1'" style="color: red;">Logout</a>
    <div class="row">
        <div class="col-md-6">
            <p class="mb-3">Your Email: <?php echo $user['email'] ?></p>
            <p class="mb-3">Your Phone Number: <?php echo $user['phoneNumber'] ?></p>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <!-- Edit button to delete user information -->
            <form method="post">
                <button type="submit" name="edit" class="btn btn-warning light">Edit Details</button>
            </form>
        </div>
    </div>

    <?php if ($user['numberVerify'] == 1 && $user['emailVerify'] == 1) {
        header('location: welcome.php');
    } ?>

    <div class="container">
    <!-- Your existing content -->

    <!-- Styled div -->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">Verification Code</h5>
            <form class="form-group" method="post">
                <input type="text" name="code" class="form-control mb-2" placeholder="Enter your verification code">
                <div class="row">
                    <div class="col">
                        <button type="submit" name="email_code" class="btn btn-dark btn-block">Submit</button>
                    </div>
                    <div class="col">
                        <a href="email.php" class="btn btn-info btn-block">Send Verification Email</a>        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


    <!-- Message indicating details cannot be changed after verification -->
    <p class="message">Once verification is completed, login details cannot be changed.</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


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
?>

<!DOCTYPE html>
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
    </style>
</head>
<body>
<div class="container">
    <?php if (isset($_SESSION['email'])) : ?>
        <p>Welcome, <strong><?php echo $_SESSION['email']; ?></strong></p>
    <?php endif ?>
    <a href="welcome.php?logout='1'" style="color: red;">Logout</a>
    <p>Your Email: <?php echo $user['email'] ?></p>
    <p>Your Phone Number: <?php echo $user['phoneNumber'] ?></p>

    <?php if ($user['numberVerify'] == 1 && $user['emailVerify'] == 1) {
        header('location: welcome.php');
    } ?>


    <a href="email.php" class="btn btn-success">Send Verification Email</a>

    <?php if (isset($_SESSION['codeSend'])) : ?>
        <div>
            <form class="form-group" method="post">
                <input type="text" name="code" class="form-control" placeholder="Enter your verification code">
                <button type="submit" name="email_code" class="btn btn-success mt-2">Submit</button>
            </form>
        </div>
    <?php endif ?>

    <!-- Edit button to delete user information -->
    <form method="post" class="mt-3">
        <button type="submit" name="edit" class="btn btn-danger">Edit Details</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
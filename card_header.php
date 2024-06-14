<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Default font size */
        .nav-link {
            font-size: 90%; /* Default font size */
        }

        /* Media query for smaller screens */
        @media (max-width: 768px) {
            .nav-link {
                font-size: 80%; /* Font size for smaller screens */
            }
        }
    </style>
</head>
<body>
    <!-- navbar.php -->
    <div class="card-header">
        <ul class="nav nav-pills card-header-pills">
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'welcome.php') !== false) ? 'active' : 'disabled'; ?>" href="welcome.php">Student Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'marks_details.php') !== false) ? 'active' : 'disabled'; ?>" href="marks_details.php">Marks Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'personal_details.php') !== false) ? 'active' : 'disabled'; ?>" href="personal_details.php">Personal Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'student_file_upload.php') !== false) ? 'active' : 'disabled'; ?>" href="student_file_upload.php">File Upload</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'choose_sub.php') !== false) ? 'active' : 'disabled'; ?>" href="choose_sub.php">Subjects</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'final_submission.php') !== false) ? 'active' : 'disabled'; ?>" href="final_submission.php">Final Submission</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo (strpos($_SERVER['REQUEST_URI'], 'payment.php') !== false) ? 'active' : 'disabled'; ?>" href="payment.php">Payment</a>
            </li>
        </ul>
    </div>

</body>
</html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

$table_name = $udise_code . '_HOI_Login_Credentials';
$Subject_table_name = $udise_code . '_Subject_Details';

$udiseid = mysqli_real_escape_string($db, $udiseid);

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);
    // Delete the row from the database
    $delete_query = "DELETE FROM $Subject_table_name WHERE Combo_ID = '$delete_id'";
    $delete_result = mysqli_query($db, $delete_query);
    if ($delete_result) {
        echo "Row deleted successfully.";
        exit(); // Exit after successful deletion
    } else {
        echo "Error deleting row: " . mysqli_error($db);
        exit(); // Exit after error
    }
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Stream = mysqli_real_escape_string($db, $_POST['Stream']);
    $Subject_Combinations = mysqli_real_escape_string($db, $_POST['Subject_Combinations']);

    // Update admission dates in the database
    $update_query = "INSERT INTO $Subject_table_name (`Stream`, `Subject_Combinations`) 
                    VALUES ('$Stream', '$Subject_Combinations')";
    $update_result = mysqli_query($db, $update_query);

    if ($update_result) {
        // Redirect after form submission to prevent resubmission on refresh
        header("Location: HOI_Subject_Combo.php?success=1");
        exit(); // Make sure to stop executing the script after redirection
    } else {
        $message = "Error updating Subject Combo: " . mysqli_error($db);
    }
}

// Check for success message in the URL and display it
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $message = "Subject Combo Updated successfully.";
}

$results = mysqli_query($db, "SELECT * FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1");

if (!$results) {
    die("Error in query: " . mysqli_error($db));
}

$user = mysqli_fetch_assoc($results);
if (!$user) {
    die("User not found");
}

if ($user['numberVerify'] != 1 || $user['emailVerify'] != 1) {
    echo "<script>window.location.href = 'HOI_verify.php';</script>"; 
}

$Subjects = "SELECT * from $Subject_table_name ORDER BY Stream";
$Avialable_Subjects = mysqli_query($db, $Subjects);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <!-- FAVICON -->
 <link rel="shortcut icon" href="../../../Assets/images/favicon.png" type="image/svg+xml">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="/../../../../Assets/css/Generalised_HOI_Stylesheet.css">
    <title style="font-family: 'Roboto', Times, serif;">Haggle</title>
</head>

<body style="font-family: 'Roboto', sans-serif;">

      <!-- SIDEBAR -->
      <?php include('HOI_Sidebar.php') ?>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="container">
                <div class="head-title">
                    <div class="left">
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="HOI_Admission_Date.php">Admission Date</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download"><i class='bx'><span
                                class="material-symbols-outlined">download</span></i></a>
                </div>
                <span class="institution-name">
                    <?php echo $user['Institution_Name']; ?>
                </span>

                <?php if (isset($message)) : ?>
                <div class="alert alert-info">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>

                <h3>Current Subjects</h3>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Stream</th>
                            <th scope="col">Combinations</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$counter = 1; // Initialize the counter variable
while ($subject = mysqli_fetch_assoc($Avialable_Subjects)) : 
?>

<tr data-id="<?php echo $subject['Combo_ID']; ?>">
    <th scope="row">
        <?php echo $counter; ?>
    </th> <!-- Use the counter variable here -->
    <td>
        <?php echo $subject['Stream']; ?>
    </td>
    <td>
        <?php echo $subject['Subject_Combinations']; ?>
    </td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic mixed styles example"
            style="margin-bottom: 10px;">
            <button type="button" class="btn btn-danger delete-btn" style="border-radius: 9%;"><span class="material-symbols-outlined">delete</span></button>
        </div>
    </td>
</tr>

<?php 
$counter++; // Increment the counter variable
endwhile; 
?>

                    </tbody>
                </table>
                <div class="admission-date-form">
                    <h4>Update Subject Details</h4>
                    <form action="HOI_Subject_Combo.php" method="POST" id="admission-form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="stream">Stream</label>
                                    <select id="stream" name="Stream" class="form-control">
                                        <option value="Science">Science</option>
                                        <option value="Arts">Arts</option>
                                        <option value="Commerce">Commerce</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="subject-combo">Subject Combinations</label>
                                    <input type="text" id="subject-combo" name="Subject_Combinations"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info" id="submit-btn">Add +</button>
                    </form>
                    <br>
                    <div class="instructions" style="padding:0.15rem;">
                        <h5>How to Use this Date Selection Page</h5>
                        <p>These dates are immutable. Once established, admissions will commence automatically from the
                            designated days. For example, if the start date is slated for August 15th, 2024, the
                            admission portal will open for students precisely after midnight (i.e, 12:00 AM IST) on the
                            14th.</p>
                    </div>
                </div>
                <!-- End of Admission Date Form -->
            </div>
        </main>
    </section>
     <script>
    // JavaScript code to handle delete button click
    document.addEventListener("DOMContentLoaded", function () {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                const row = event.target.closest('tr');
                const delete_id = row.getAttribute('data-id');
                // Send AJAX request to delete the row
                fetch('HOI_Subject_Combo.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: 'delete_id=' + encodeURIComponent(delete_id),
                    })
                    .then(response => response.text())
                    .then(data => {
                        // Display response message
                        alert(data);
                        // Remove the row from the table if deletion is successful
                        if (data === 'Row deleted successfully.') {
                            row.remove();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
    </script>
    <script src="script.js"></script>
</body>

</html>
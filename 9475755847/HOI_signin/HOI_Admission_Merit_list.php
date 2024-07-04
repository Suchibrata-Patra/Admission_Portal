<?php
// ini_set('display_errors', 1);
// error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';
if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

$table_name = $udise_code . '_HOI_Login_Credentials';
$Subject_table_name = $udise_code . '_Subject_Details';

// Directory where merit lists are uploaded
$upload_dir = "Merit_Lists";

// Handle file deletion
if (isset($_POST['delete']) && isset($_POST['filename'])) {
    $filename = $upload_dir . '/' . $_POST['filename'];
    if (file_exists($filename)) {
        unlink($filename); // Delete the file
        // echo "File deleted successfully.";
    } else {
        // echo "File does not exist.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['merit_list_pdf'])) {
    $file_type = strtolower(pathinfo($_FILES['merit_list_pdf']['name'], PATHINFO_EXTENSION));

    if ($file_type != 'pdf') {
        echo "Only PDF files are allowed.";
    } else {
        $i = 1;
        do {
            $target_file = $upload_dir . "/$udise_code" . "_meritlist_" . $i . ".pdf";
            $i++;
        } while (file_exists($target_file));

        if (move_uploaded_file($_FILES['merit_list_pdf']['tmp_name'], $target_file)) {
            // Redirect to index.php after successful upload
            header('Location:HOI_Admission_Merit_list.php');
            exit;
        } else {
            // echo "Sorry, there was an error uploading your file.";
        }
    }
}

$current_files = scandir($upload_dir);
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
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
<style>
    .progress {
        height: 23px;
        background-color:grey;
    }
    .progress-bar {
        line-height: 23px;
        background-color:black;
    }
</style>

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


            	<!-- HOI_Notification_Icon -->
   <?php include 'HOI_Notification_Icon.php'; ?>
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
                            <li><a class="active" href="HOI_Final_List.php">Merit List</a></li>
                        </ul>
                    </div>
                    <a href="HOI_CSV_Data_Download.php" class="btn-download">
                        <i class='bx'><span class="material-symbols-outlined">download</span></i>Download Student Info
                        <!-- <span class="text"></span> -->
                    </a>
                </div>
                <div class="content-section">
                   <form action="" method="POST" enctype="multipart/form-data" class="upload-form">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h3 class="display-4 jumbotron-header">Upload Merit List</h3>
            <div class="form-group">
                <label for="merit_list_pdf" class="file-label">Select PDF:</label>
                <input type="file" name="merit_list_pdf" id="merit_list_pdf" class="form-control-file" required>
            </div>
            <button type="submit" class="btn btn-primary upload-btn">Upload</button>
            <!-- Progress bar -->
            <div class="progress mt-3" style="display:none;">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
        </div>
    </div>
</form>

                    <br>
                    <h2 class="files-title">Currently Uploaded Merit Lists:</h2>
                    <table class="table table-hover table-striped">
                        <thead class="thead">
                            <tr>
                                <th>File Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($current_files as $file): if ($file != '.' && $file != '..'): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo htmlspecialchars($upload_dir . '/' . $file); ?>" target="_blank">
                                        <?php echo htmlspecialchars($file); ?>
                                    </a>
                                </td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="filename" value="<?php echo htmlspecialchars($file); ?>">
                                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endif; endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

    </section>

    <!-- Loader -->
    <div id="loader" style="display:none;">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('.upload-form');
        const progressBar = document.querySelector('.progress');
        const progressBarFill = document.querySelector('.progress-bar');

        form.addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent the default form submission

            const formData = new FormData(form);
            const xhr = new XMLHttpRequest();

            xhr.open('POST', '', true);

            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable) {
                    const percentComplete = (e.loaded / e.total) * 100;
                    progressBar.style.display = 'block';
                    progressBarFill.style.width = percentComplete + '%';
                    progressBarFill.setAttribute('aria-valuenow', percentComplete);
                    progressBarFill.textContent = Math.round(percentComplete) + '%';
                }
            });

            xhr.onload = function () {
                if (xhr.status === 200) {
                    // File upload successful, redirect or update the page as needed
                    window.location.href = 'HOI_Admission_Merit_list.php';
                } else {
                    // Handle error
                    alert('An error occurred while uploading the file.');
                }
            };

            xhr.send(formData);
        });
    });
</script>
<script src="script.js"></script>


</body>

</html>
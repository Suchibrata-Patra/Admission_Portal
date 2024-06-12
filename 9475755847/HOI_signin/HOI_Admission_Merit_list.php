<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

$upload_dir = "Merit_Lists";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['merit_list_pdf'])) {
    $file_type = strtolower(pathinfo($_FILES['merit_list_pdf']['name'], PATHINFO_EXTENSION));

    if ($file_type != 'pdf') {
        echo "Only PDF files are allowed.";
        exit;
    } else {
        $i = 1;
        do {
            $target_file = $upload_dir . "/$udise_code" . "_meritlist_" . $i . ".pdf";
            $i++;
        } while (file_exists($target_file));

        if (move_uploaded_file($_FILES['merit_list_pdf']['tmp_name'], $target_file)) {
            echo "The file has been uploaded as " . htmlspecialchars(basename($target_file)) . ".";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit;
        }
    }
}

$current_files = scandir($upload_dir);

foreach ($current_files as $file) {
    if ($file != '.' && $file != '..') {
        echo '<tr>
                <td>
                    <a href="' . htmlspecialchars($upload_dir . '/' . $file) . '" target="_blank">' . htmlspecialchars($file) . '</a>
                </td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="filename" value="' . htmlspecialchars($file) . '">
                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
              </tr>';
    }
}
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
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
            <?php echo $udise_code ?>
            <div class="container">
                <div class="content-section">
                    <form id="upload-form" enctype="multipart/form-data" class="upload-form">
                        <div class="jumbotron jumbotron-fluid">
                            <div class="container">
                                <h3 class="display-4 jumbotron-header">Upload Merit List</h3>
                                <div class="form-group">
                                    <label for="merit_list_pdf" class="file-label">Select PDF:</label>
                                    <input type="file" name="merit_list_pdf" id="merit_list_pdf" class="form-control-file" required>
                                </div>
                                <button type="submit" class="btn btn-primary upload-btn">Upload</button>
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
                        <tbody id="file-list">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#upload-form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (data) {
                        $('#file-list').html(data);
                    },
                    error: function () {
                        alert('There was an error uploading the file.');
                    }
                });
            });
        });
    </script>

</body>
</html>
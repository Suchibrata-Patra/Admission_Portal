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
            echo "The file has been uploaded as " . htmlspecialchars(basename($target_file)) . ".";
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        } else {
            // echo "Sorry, there was an error uploading your file.";
        }
    }
}

$current_files = scandir($upload_dir);

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profile_update'])) {
    $school_name = $_POST['school_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $principal_name = $_POST['principal_name'];

    // Save profile data to a file (you can use a database in real application)
    $profile_data = [
        'school_name' => $school_name,
        'address' => $address,
        'contact_number' => $contact_number,
        'principal_name' => $principal_name,
    ];
    file_put_contents($udise_code . '_profile_data.json', json_encode($profile_data));
}

// Load profile data
$profile_data = [];
if (file_exists($udise_code . '_profile_data.json')) {
    $profile_data = json_decode(file_get_contents($udise_code . '_profile_data.json'), true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style.css">
    <title style="font-family: 'Roboto', Times, serif;">Haggle</title>
</head>

<body style="font-family: 'Roboto', sans-serif;">

    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <i class='bx bxs-smile'></i>
            <span class="text">Haggle</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="HOI_Dashboard.php">
                    <i class='bx'><span class="material-symbols-outlined">dashboard</span></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="HOI_Admission_Date.php">
                    <i class='bx'><span class="material-symbols-outlined">calendar_month</span></i>
                    <span class="text">Admission Date</span>
                </a>
            </li>
            <li>
                <a href="HOI_Bank_Details.php">
                    <i class='bx'><span class="material-symbols-outlined">currency_rupee</span></i>
                    <span class="text">Bank Account</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx'><span class="material-symbols-outlined">list</span></i>
                    <span class="text">Merit List</span>
                </a>
            </li>
            <li class="active">
                <a href="HOI_School_Profile.php">
                    <i class='bx'><span class="material-symbols-outlined">account_balance</span></i>
                    <span class="text">School Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx'><span class="material-symbols-outlined">update</span></i>
                    <span class="text">Updates</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx'><span class="material-symbols-outlined">auto_stories</span></i>
                    <span class="text">Subject Combo</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx'><span class="material-symbols-outlined">info</span></i>
                    <span class="text">Change Info</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx'><span class="material-symbols-outlined">mail</span></i>
                    <span class="text">Mail</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx'><span class="material-symbols-outlined">id_card</span></i>
                    <span class="text">Merit List</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bxs-group'></i>
                    <span class="text">Team</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#">
                    <i class='bx bxs-cog'></i>
                    <span class="text">System Preferences</span>
                </a>
            </li>
            <li>
                <a href="HOI_Logout.php" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>
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

        </main>

    </section>
    <script src="script.js"></script>

</body>

</html>
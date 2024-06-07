<?php
// Ensure errors are not displayed to users
ini_set('display_errors', 0);
error_reporting(0);

// Include session handling and super admin functionality
require_once 'HOI_session.php';
require_once 'HOI_super_admin.php';

// Ensure UDISE code and ID are set, otherwise terminate execution
if (!isset($udise_code) || !isset($udiseid)) {
    die("Unauthorized access.");
}

// Define table names
$table_name = $udise_code . '_HOI_Login_Credentials';
$Subject_table_name = $udise_code . '_Subject_Details';

// Define upload directory for merit lists
$upload_dir = "Merit_Lists";

// Function to securely delete a file
function secure_delete_file($filename) {
    $filename = realpath($filename); // Ensure the filename is absolute
    if (strpos($filename, $upload_dir) === 0 && file_exists($filename)) {
        unlink($filename); // Only delete files in upload directory
    }
}

// Handle file deletion securely
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete']) && isset($_POST['filename'])) {
    secure_delete_file($upload_dir . '/' . $_POST['filename']);
}

// Function to securely move uploaded file
function secure_upload_file($file, $target_dir, $target_filename) {
    $file_type = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $target_file = $target_dir . '/' . $target_filename;

    // Validate file type and move uploaded file
    if ($file_type === 'pdf' && move_uploaded_file($file['tmp_name'], $target_file)) {
        return $target_file; // Return path to uploaded file
    } else {
        return false; // Upload failed
    }
}

// Handle file upload securely
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['merit_list_pdf'])) {
    $i = 1;
    do {
        $target_filename = $udise_code . "_meritlist_" . $i . ".pdf";
        $i++;
    } while (file_exists($upload_dir . '/' . $target_filename));

    $uploaded_file = secure_upload_file($_FILES['merit_list_pdf'], $upload_dir, $target_filename);
    if ($uploaded_file) {
        echo "The file has been uploaded as " . htmlspecialchars(basename($uploaded_file)) . ".";
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Load and save profile data securely
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['profile_update'])) {
    // Validate and sanitize input data
    $school_name = filter_var($_POST['school_name'], FILTER_SANITIZE_STRING);
    $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
    $contact_number = filter_var($_POST['contact_number'], FILTER_SANITIZE_STRING);
    $principal_name = filter_var($_POST['principal_name'], FILTER_SANITIZE_STRING);
    $first_merit_list_date = $_POST['first_merit_list_date']; // Validate format on client side
    $admission_starts_date = $_POST['admission_starts_date']; // Validate format on client side
    $last_admission_date = $_POST['last_admission_date']; // Validate format on client side
    $second_merit_list_date = isset($_POST['second_merit_list_date']) ? $_POST['second_merit_list_date'] : null;

    // Save profile data to a JSON file
    $profile_data = [
        'school_name' => $school_name,
        'address' => $address,
        'contact_number' => $contact_number,
        'principal_name' => $principal_name,
        'first_merit_list_date' => $first_merit_list_date,
        'admission_starts_date' => $admission_starts_date,
        'last_admission_date' => $last_admission_date,
        'second_merit_list_date' => $second_merit_list_date
    ];

    // Encode and save profile data to JSON file
    $json_data = json_encode($profile_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    if ($json_data !== false) {
        $json_file = $udise_code . '_profile_data.json';
        file_put_contents($json_file, $json_data, LOCK_EX); // Lock file for exclusive writing
    } else {
        echo "Failed to encode profile data.";
    }
}

// Load profile data securely
$profile_data = [];
$json_file = $udise_code . '_profile_data.json';
if (file_exists($json_file)) {
    $json_data = file_get_contents($json_file);
    $profile_data = json_decode($json_data, true);
    if ($profile_data === null) {
        echo "Error decoding profile data.";
        $profile_data = []; // Reset to empty array
    }
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
    <div class="container">
        <h2>School Profile Update</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            
            <div class="form-group">
                <label for="first_merit_list_date">1st Merit List Date:</label>
                <input type="date" class="form-control" id="first_merit_list_date" name="first_merit_list_date"
                    value="<?php echo isset($profile_data['first_merit_list_date']) ? $profile_data['first_merit_list_date'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="admission_starts_date">Admission Starts For 1st List Date:</label>
                <input type="date" class="form-control" id="admission_starts_date" name="admission_starts_date"
                    value="<?php echo isset($profile_data['admission_starts_date']) ? $profile_data['admission_starts_date'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="last_admission_date">Last Date for Admission Date:</label>
                <input type="date" class="form-control" id="last_admission_date" name="last_admission_date"
                    value="<?php echo isset($profile_data['last_admission_date']) ? $profile_data['last_admission_date'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="second_merit_list_date">Second Merit List Date (If Any):</label>
                <input type="date" class="form-control" id="second_merit_list_date" name="second_merit_list_date"
                    value="<?php echo isset($profile_data['second_merit_list_date']) ? $profile_data['second_merit_list_date'] : ''; ?>">
            </div>
            <button type="submit" name="profile_update" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
</main>


    </section>
    <script src="script.js"></script>

</body>

</html>
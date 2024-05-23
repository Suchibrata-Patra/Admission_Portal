<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

$table_name = $udise_code . '_HOI_Login_Credentials';
$student_table_name = $udise_code .'_Student_Details';

$udiseid = mysqli_real_escape_string($db, $udiseid);
$query = "SELECT * FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1";
$results = mysqli_query($db, $query);

if (!$results) {
    die("Error in query: " . mysqli_error($db));
}

$user = mysqli_fetch_assoc($results);
if ($user['numberVerify'] != 1 || $user['emailVerify'] != 1) {
    echo "<script>window.location.href = 'HOI_verify.php';</script>"; 
}
if (!$user) {
    die("User not found");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = mysqli_real_escape_string($db, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($db, $_POST['end_date']);

    // Update admission dates in the database
    $update_query = "UPDATE $table_name
                     SET `Formfillup_Start_Date` = '$start_date', `Formfillup_Last_Date` = '$end_date'
                     WHERE `HOI_UDISE_ID` = '$udiseid'";
    $update_result = mysqli_query($db, $update_query);

    if ($update_result) {
        $message = "Admission dates updated successfully.";
    } else {
        $message = "Error updating admission dates: " . mysqli_error($db);
    }
}

// Fetch the current admission dates
$admission_query = "SELECT `Formfillup_Start_Date`, `Formfillup_Last_Date` FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1";
$admission_results = mysqli_query($db, $admission_query);
$admission_dates = mysqli_fetch_assoc($admission_results);

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
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<!-- My CSS -->
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
			<li class="active">
				<a href="HOI_Admission_Date.php">
					<i class='bx'><span class="material-symbols-outlined">calendar_month</span></i>
					<span class="text">Admission Date</span>
				</a>
			</li>
			<li>
				<a href="#">
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
			<li>
				<a href="#">
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
					<span class="text">Admission</span>
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
			<div class="head-title">
				<div class="left">
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="HOI_Admission_Date.php">Admission Date</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx'><span class="material-symbols-outlined">download</span></i>
				</a>
			</div>
			<span class="institution-name"><?php echo $user['Institution_Name']; ?></span>

			<?php if (isset($message)) : ?>
				<div class="alert alert-info"><?php echo $message; ?></div>
			<?php endif; ?>
			
			<!-- Admission Date Form -->
			<div class="admission-date-form">
				<h3>Set Admission Dates</h3>
				<form action="HOI_Admission_Date.php" method="POST">
					<div class="form-group">
						<label for="start_date">Start Date:</label>
						<input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo isset($admission_dates['Formfillup_Start_Date']) ? $admission_dates['Formfillup_Start_Date'] : ''; ?>" required>
					</div>
					<div class="form-group">
						<label for="end_date">End Date:</label>
						<input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo isset($admission_dates['Formfillup_Last_Date']) ? $admission_dates['Formfillup_Last_Date'] : ''; ?>" required>
					</div>
					<button type="submit" class="btn btn-primary">Set Dates</button>
				</form>
			</div>
			<!-- End of Admission Date Form -->

		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	
	<script src="script.js"></script>
</body>
</html>

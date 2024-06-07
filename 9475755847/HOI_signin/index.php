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
// echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
// echo 'Table name: ' . $table_name . '<br>';

$udiseid = mysqli_real_escape_string($db, $udiseid);
$query = "SELECT * FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1";
$results = mysqli_query($db, $query);

$recent_application = "SELECT * FROM $student_table_name ORDER BY Registration_Time_Stamp DESC";
$student_application_result = mysqli_query($db,$recent_application); 

if (!$results) {
    die("Error in query: " . mysqli_error($db));
}

$user = mysqli_fetch_assoc($results);
if ($user['numberVerify'] != 1 | $user['emailVerify'] != 1) {
    echo "<script>window.location.href = 'HOI_verify.php';</script>"; 
} 
// echo $query . '<br>';
if (!$user) {
    die("User not found");
}
// Fetch the current admission dates
$admission_query = "SELECT `Formfillup_Start_Date`, `Formfillup_Last_Date` FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1";
$admission_results = mysqli_query($db, $admission_query);
$admission_dates = mysqli_fetch_assoc($admission_results);
$current_date = date('Y-m-d');
if ($admission_dates['Formfillup_Last_Date'] < $current_date) {
    $application_status = "Admission Deadline is Over";
} else {
    $application_status = "Application Portal is Live !";
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
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<!-- My CSS -->
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
			<i class='bx bx-menu' ></i>
			<!-- <a href="#" class="nav-link">Categories</a> -->
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell' ></i>
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
					<!-- <h1>Admin</h1> -->
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="#" class="btn-download">
					<i class='bx'><span class="material-symbols-outlined">download</span></i>
					<!-- <span class="text"></span> -->
				</a>
			</div>
			<span class="institution-name"><?php echo $user['Institution_Name'] ?></span>
			<div class="container" style="font-size:2rem;font-weight:normal;margin-top:1.5%;">Admission Statisitcs</div>
			<ul class="box-info">
				<li>
				<?php if ($admission_dates['Formfillup_Last_Date'] < $current_date) : ?>
					<i class='bx'><img src="../../../../../Assets/images/stopped_admission.png" alt="" style="width:85px;height: auto; background-color: #f9f9f9;"></i>
        <?php else : ?>
			<i class='bx'><img src="../../../../../Assets/images/live.gif" alt="" style="width:100px;height: auto; background-color: #f9f9f9;"></i>
        <?php endif; ?>
					<span class="text">
					<?php if ($admission_dates['Formfillup_Last_Date'] < $current_date) : ?>
						<h3>Stopped</h3>
						<?php else : ?>
						<h3>Live</h3>
						<?php endif; ?>
						<p>Application Status</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>2834</h3>
						<p>Total Application</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>Rs.2543</h3>
						<p>New Revenue</p>
					</span>
				</li>
			</ul>
			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Applications</h3>
						<!-- <i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i> -->
					</div>
					<table>
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>Account</th>
            <th>Reg No.</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $sl_no = 1;
    $students = [];
    while ($student = mysqli_fetch_assoc($student_application_result)) {
        $students[] = $student;
    }

    $last_10_students = array_slice($students, -10);
    foreach ($last_10_students as $student) { 
    ?>
    <tr>
        <td>
            <?php echo $sl_no++; ?>
        </td>
        <td>
            <div style="display: flex; align-items: center;">
            <?php 
            if($student['issubmitted'] == 0){
                echo '<span class="material-symbols-outlined" style="padding-right:17%;color:RED;">person</span>';
            } else {
                echo '<span class="material-symbols-outlined" style="padding-right:17%;color:GREEN;">person</span>';
            }
            ?>
                
                <p style="margin: 0;">
                    <?php echo htmlspecialchars($student['fname']); ?>
                </p>
            </div>
        </td>
        <td>
            <?php echo htmlspecialchars($student['reg_no']); ?>
        </td>
        <td>
            <?php 
            if($student['issubmitted'] == 0){
                echo '<span class="badge rounded-pill bg-warning" style="font-weight:500;">Draft</span>';
            } else {
                echo '<span class="badge rounded-pill bg-success" style="font-weight:500;background-color:#89ff88;color:White;">Submitted</span>';
            }
            ?>
        </td>
    </tr>
    <?php } ?>
</tbody>

</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>To - dos</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
			
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>
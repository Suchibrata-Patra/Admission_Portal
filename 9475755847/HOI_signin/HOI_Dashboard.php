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

<!-- My CSS -->
	<link rel="stylesheet" href="style.css">

	<title style="font-family: 'Roboto', Times, serif;">Haggle</title>
	<style>
        .institution-name {
            font-weight: 600;
            font-size: 20px;
        }

        /* Media query for screens smaller than 900px */
        @media screen and (max-width: 900px) {
            .institution-name {
                font-size: 14px;
            }
        }

        /* Media query for screens smaller than 600px */
        @media screen and (max-width: 600px) {
            .institution-name {
                font-size: 990%;
            }
        }

        /* Media query for screens smaller than 400px */
        @media screen and (max-width: 400px) {
            .institution-name {
                font-size: 10px;
            }
        }
    </style>
</head>
<body style="font-family: 'Roboto', sans-serif;">


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Haggle</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="#">
					<i class='bx'><span class="material-symbols-outlined">dashboard</span></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="#">
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
					<span class="text">Merit LIst</span>
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
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog' ></i>
					<span class="text">System Preferences</span>
				</a>
			</li>
			<li>
				<a href="HOI_Logout.php" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
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
					<h1>Admin</h1>
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
			<div class="container" style="font-size:20px;font-weight:bold;margin-top:1.5%;">Admission Statisitcs</div>
			<ul class="box-info">
				<li>
					<i class='bx'><img src="../Assets/live_animation.gif" alt="" style="width:100px;height: auto; background-color: #f9f9f9;"></i>
					<span class="text">
						<h3>Live</h3>
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
						<h3>Recent Application</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
    <thead>
        <tr>
            <th>Sl No.</th>
            <th>User Account</th>
            <th>Reg No.</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sl_no = 1; // Initialize the serial number
        while ($student = mysqli_fetch_assoc($student_application_result)) { 
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
                    echo '<span class="badge rounded-pill bg-warning" style="font-weight:500;color:BLACK;">Draft</span>';
                } else {
                    echo '<span class="badge rounded-pill bg-success" style="font-weight:500;">Submitted</span>';
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
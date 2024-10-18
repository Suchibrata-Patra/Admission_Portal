<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'Secure_Admin_DataBase_Connection.php';
require 'Admin_Session.php';
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
	<link rel="stylesheet" href="/../../../../Assets/css/Generalised_HOI_Stylesheet.css">

	<title style="font-family: 'Roboto', Times, serif;">Haggle</title>
</head>

<body style="font-family: 'Roboto', sans-serif;">


	<!-- SIDEBAR -->
	<?php include('Admin_Sidebar.php') ?>
	<!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
    <i class='bx bx-menu'></i>
    <!-- <a href="#" class="nav-link">Categories</a> -->
    <form action="#">
        <div class="form-input">
            <input type="search" placeholder="Search...">
            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
    </form>
    <input type="checkbox" id="switch-mode" hidden>
    <label for="switch-mode" class="switch-mode"></label>

	<!-- HOI_Notification_Icon -->
   <!-- <?php include 'HOI_Notification_Icon.php'; ?> -->
    
    <a href="#" class="profile">
        <img src="img/people.png" alt="Profile">
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
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="HOI_CSV_Data_Download.php" class="btn-download">
                        <i class='bx'><span class="material-symbols-outlined">download</span></i>Download
                        <!-- <span class="text"></span> -->
                    </a>
			</div>		
			<ul class="box-info">
				<li>
				
				</li>
				<li style="display: flex; justify-content: space-between; align-items: center;padding-top:10%;">
					<!-- First portion for Total Application -->
					<span class="text" style="flex: 1; text-align: center; border-right: 2px solid #ccc; padding-right:2%;">
						<h3>2834</h3>
						<p>Total <span class="badge rounded-pill bg-warning" style="font-weight:500;">Draft</span></p>
					</span>
					<!-- Second portion for Total Submission -->
					<span class="text" style="flex: 1; text-align: center;padding-left:0px;margin-left:-7%;">
						<h3>2834</h3>
						<p>Total <span class="badge rounded-pill bg-success" style="font-weight:500;background-color:#89ff88;color:White;">Submitted</span></p>
					</span>
				</li>
								
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3>Rs.2543</h3>
						<p>Net Revenue</p>
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
					
				</div>
				<div class="todo">
					<div class="head">
						<h3>Payment Details</h3>
						<i class='bx bx-plus'></i>
						<i class='bx bx-filter'></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
						<li class="not-completed">
							<p>Todo List</p>
							<i class='bx bx-dots-vertical-rounded'></i>
						</li>
					</ul>
				</div>
			</div>


		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

<script> document.getElementById('currentYear').textContent = new Date().getFullYear(); </script>
	<script src="script.js"></script>
</body>

</html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
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

    <title style="font-family: 'Roboto', Times, serif;">Register New Institution</title>
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
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>

            	<!-- HOI_Notification_Icon -->
   <?php include 'Admin_Notification.php'; ?>

            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
    <form action="Enroll_New_Institutions.php">
	<div class="container">
        <div class="head-title">
            <div class="left">
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="HOI_Bank_Details.php">Bank Details</a></li>
                </ul>
            </div>
        </div>

        <?php if (isset($message)) : ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
        <?php endif; ?>

        <div class="admission-date-form">
            <h3>Register New Institution</h3>
            <form action="#" method="POST" id="admission-form">
                <div class="row">
                    <div class="col-md-6">
					<div class="form-group">
                        <label for="udise_id"><strong>UDISE ID</strong></label>
                        <input type="text" class="form-control" placeholder="Enter UDISE ID" id="udise_id" required>
                    </div>
                    </div>
					<div class="col-md-6">
					<div class="form-group">
                        <label for="confirm_udise_id"><strong>Confirm UDISE ID</strong></label>
                        <input type="text" class="form-control" placeholder="Enter UDISE ID" id="confirm_udise_id" required>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
					<div class="form-group">
                        <label for="institution_name">Institution Name</label>
                        <input type="textbox" class="form-control" placeholder="Enter Institution's Name" id="institution_name" required>
                    </div>
                    </div>
                    <div class="col-md-6">
					<div class="form-group">
                        <label for="confirm_institution_name">Confirm Institution Name</label>
                        <input type="text" class="form-control" placeholder="Confirm Institution's Name" id="confirm_institution_name" required>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Contact No.</label>
                            <input type="number" id="start_date" placeholder="Enter Contact Number" name="start_date" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Confirm Contact No.</label>
                            <input type="number" id="end_date" name="end_date" placeholder="Confirm Contact Number" class="form-control" required>
                        </div>
                    </div>

                </div>

				<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Whatsapp No.</label>
                            <input type="number" id="start_date" name="start_date" placeholder="Enter Whatsapp Number." class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Confirm Whatsapp No.</label>
                            <input type="number" id="end_date" name="end_date" placeholder="Confirm Whatsapp Number." class="form-control" required>
                        </div>
                    </div>

                </div>
				<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Email ID</label>
                            <input type="number" id="start_date" name="start_date" placeholder="Email ID" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Confirm Email Id</label>
                            <input type="number" id="end_date" name="end_date" placeholder="Confirm Email ID" class="form-control" required>
                        </div>
                    </div>

                </div>

				<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Bank Account No</label>
                            <input type="number" id="start_date" name="start_date" placeholder="Bank Account Number" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Confirm Bank Account No</label>
                            <input type="number" id="end_date" name="end_date" placeholder="Confirm Bank Account Number" class="form-control" required>
                        </div>
                    </div>

                </div>

				<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Bank IFSC</label>
                            <input type="number" id="start_date" name="start_date" placeholder="Bank IFSC" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Confirm Bank IFSC</label>
                            <input type="number" id="end_date" name="end_date" placeholder="Confirm Bank IFSC" class="form-control" required>
                        </div>
                    </div>

                </div>
				<div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="start_date">Bank Branch</label>
                            <input type="number" id="start_date" name="start_date" placeholder="Enter Bank Branch" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="end_date">Confirm Bank Banch</label>
                            <input type="number" id="end_date" name="end_date" placeholder="Confirm Bank Branch" class="form-control" required>
                        </div>
                    </div>

                </div>
				

				





                <button type="submit" class="btn btn-info" id="submit-btn">Register</button>
            </form>
            <br>


			
          <div class="container" style="padding-right:10%;">
			Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque dolorum, laborum quaerat atque distinctio totam ullam quia illum soluta alias recusandae quis quae fugit repudiandae aliquid itaque eveniet eum! Nemo excepturi nam nulla, adipisci temporibus molestiae molestias distinctio eum. Ipsum velit aut consectetur cupiditate maxime sed aliquam iusto amet nemo, excepturi est sit voluptas cum quibusdam dolorum quae voluptatibus odio tenetur distinctio quam pariatur dicta illum? Magnam culpa vitae tempora, fuga ipsum recusandae iusto placeat delectus quasi? Excepturi corrupti pariatur accusantium deleniti molestias eum veritatis amet illo sunt deserunt, officiis repudiandae maiores. Fugiat quia ipsa sed quos asperiores iure natus.
		  </div>

        </div>


    </div>
	</form>
</main>

        <!-- MAIN -->
    </section>
	<script>
function setupConfirmation(inputId, mainId) {
    document.getElementById(inputId).addEventListener('input', function() {
        const mainValue = document.getElementById(mainId).value;
        const confirmValue = this.value;

        if (mainValue !== confirmValue) {
            this.style.borderColor = 'red';
            document.getElementById(mainId).style.borderColor = 'red';
            this.style.fontWeight = 'bold';
            document.getElementById(mainId).style.fontWeight = 'bold';
            this.style.color = 'red';
            document.getElementById(mainId).style.color = 'red';
        } else {
            this.style.borderColor = 'green';
            document.getElementById(mainId).style.borderColor = 'green';
            this.style.fontWeight = 'normal';
            document.getElementById(mainId).style.fontWeight = 'normal';
            this.style.color = 'black';  // Reset to default color
            document.getElementById(mainId).style.color = 'black';  // Reset to default color
        }
    });
}

// Call the function for each pair of inputs
setupConfirmation('confirm_udise_id', 'udise_id');
setupConfirmation('confirm_institution_name', 'institution_name');

    document.getElementById('submit').addEventListener('click', function() {
        const mainId = document.getElementById('udise_id').value;
        const confirmId = document.getElementById('confirm_udise_id').value;

        if (mainId !== confirmId) {
            alert("UDISE IDs do not match!");
        } else {
            alert("UDISE IDs match!");
        }
    });
</script>
    <script src="script.js"></script>
</body>

</html>
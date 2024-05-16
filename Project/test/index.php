<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: login.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Home </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">

    <style>
    /* Existing styles... */

@media (max-width: 768px) {
    .card {
        flex-direction: column; /* Change to column for stacked layout */
        text-align: center;
    }

    .card img {
        max-width: 100%;
        height: auto;
        max-height: 80px; /* Set a maximum height for the images */
        margin-top: 10px;
    }

    .card .card-body {
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between; /* Arrange text and button vertically */
        align-items: center; /* Align text and button to the center */
    }

    .btn-primary {
     border: none;
  border-radius: 129px;
  background-color: black;
  width: 143px;
  height: 41px;
  padding: 9px;
  margin-left: 20%;
  margin-right: 20%;/* Add margin to separate button from other elements */
    }
}

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f2f2f0;
            color: #333;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        .btn-smaller {
            padding: 5px 10px;
            font-size: 14px;
        }

        .container {
            padding-top: 50px;
            position: relative;
        }

        .logo-container {
            
        }

      .logo {
       background-color: #fff;
    border-radius: 10px;
    padding-right: 10px;
    padding-left:17px;
    padding-top: 7px;
    padding-bottom:5px;
    border-color: white;
    border-color: white;
    margin-bottom: 20px;
    margin-left:47%;
    margin-top:10px;
}


        h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #333;
            text-align: center;
        }

        .card {
            border: none;
            transition: transform 0.3s;
            margin-bottom: 10px;
            border-radius: 10px;
            background-color:rgb(255, 252, 252);
            border-color: black;
            border: 5px;
        }

        .card-title {
            color: black;
            font-weight: bold;
            margin-bottom: 0;
        }

        .btn-primary {
          border: none;
  border-radius: 129px;
  background-color: black;
  width: 143px;
  height: 41px;
  padding: 9px;
  margin-left: 20%;
  margin-right: 20%;
        }

        .btn-primary:hover {
            background-color: #393939;
            border-color: #000000;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #eaeaea;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            font-family: 'Roboto', sans-serif;
        }

        .sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 18px;
            color: #000000;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            color: #848485;
        }

        .sidebar .close-btn {
            position: absolute;
            top: 20px;
            right: 50px;
            font-size: 40px;

        }

        .logout-btn-sidebar {
            position: absolute;
            bottom: 20px;
            left: 20px;
        }

        /* Burger icon styles */
        .burger-icon {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 30px;
            cursor: pointer;
        }
        .selected{
            background-color: #ddef75 !important;
            color: black;
            margin-top: 2.5px;
            margin-bottom: 2.5px;
    }
    .btn-dange{
        background-color:#dc3545;
    }
    .img-fluid {
  max-width: 99%;
  height: 99px;
}
  .image-card {
    margin: 0 auto; /* Center horizontally */
    padding: 0;
    text-align: center; /* Center text/content */
    display: flex;
    align-items: center; /* Center vertically */
    justify-content: center; /* Center horizontally */
}
  .profile-picture {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            border:1px solid #f98100;
        }
    </style>
</head>

<body>
    <div id="mySidebar" class="sidebar">
       <a href="https://gangasagartourism.co.in/" class="selected">Visit Site </a>
        <a href="invoice_generator.php">Invoice Generator</a>
        <a href="enquery.php">Query Page</a>
        <a href="register-trip.php">Register Trip </a>
        <a href="pricematrix_modification.php">Update Price</a>
        <a href="setup.php">Change Logo</a>
        <!-- Add more links if needed -->
        <span class="close-btn" onclick="closeNav()">×</span>
        <form method="post" class="logout-btn-sidebar">
            <button type="submit" class="btn btn-danger" name="logout">Logout</button>
        </form>
    </div>

    <div class="container">
        <!-- Logout Button -->
        <form method="post" class="logout-btn" action="logout.php" style="display: flex; align-items: center;">
    <img src="Asset/image.png?<?php echo time(); ?>" alt="Profile Picture" class="profile-picture">

    <button type="submit" class="btn btn-danger" name="logout" style="color: BLACK; background-color: #ddef75; border-color: BLACK; border: 2px; margin-left: 10px;">Logout</button>
</form>


        <!-- Burger icon to toggle sidebar -->
        <div class="burger-icon" onclick="toggleNav()">☰</div>

        <!--<div class="logo-container">-->
        <!--    <img src="Asset/image.png" alt="" class="img-fluid logo">-->
        <!--</div>-->
        <h2 style="background-color:#ddef75; margin-left:22%; margin-right:23%;"><!--Dashboard--></h2>

         <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card invoice-card">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Invoice Generator</h5>
                            <p class="card-text">Click to generate invoice.</p>
                            <a href="invoice_generator.php" class="btn btn-primary btn-block">Generate &#10145;</a>
                        </div>
                    </div>
                    <div class="col-md-4  .image-card">
                        <img src="Asset/invoice.png" alt="Image" class="img-fluid small-image">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card query-card">
    <div class="row">
        <div class="col-md-8">
           <div class="card-body">
    <h5 class="card-title">Query Page</h5>
    <p class="card-text">Click Below to generate inquiry report.</p>
    <div style="margin: 0 5px;">
        <a href="enquery.php" class="btn-small" style="margin-right: 0px; padding: 9px 16.5px 9px 19px; background-color: #ddef75 ; color: BLACK; text-decoration: none; border-radius: 40px; margin-right:5px;padding-left:15px; font-size:25px;font-weight:999;">+</a>
        <a href="enquiry-register.php" class="btn-small"style="margin-right:0px; padding: 12px 30px; background-color: BLACK ; color: #fff; text-decoration: none; border-radius: 20px;">List</a>
    </div>
</div>

        </div>
        <div class="col-md-4">
            <img src="Asset/enquiry.png" alt="Image" class="img-fluid small-image">
        </div>
    </div>
</div>

        </div>
    </div>

    <!-- User Registration Card -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card registration-card">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Future Trips</h5>
                            <p class="card-text">See All Future Trips.</p>
                            <a href="future-trip.php" class="btn btn-primary btn-block">View</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="Asset/registratin.jpg" alt="Image" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <!-- New Card: Register Trip -->
        <div class="col-md-6 mb-4">
            <div class="card register-trip-card">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Register Trip</h5>
                            <p class="card-text">Click below to register a new trip.</p>
                            <a href="register-trip.php" class="btn btn-primary btn-block">Register</a>
                        </div>
                    </div>
                    <div class="col-md-4 image-card">
                        <img src="Asset/trip.jpg" alt="Image" class="img-fluid small-image">
                    </div>
                </div>
            </div>
        </div>
        <!-- End New Card -->

        <!-- New Card: Future Trips -->
        <div class="col-md-6 mb-4">
            <div class="card future-trips-card">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">Insider Report</h5>
                            <p class="card-text">Check Performance YOY </p>
                            <a href="insider.php" class="btn btn-primary btn-block">Check</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="Asset/yoy.jpg" alt="Image" class="img-fluid small-image">
                    </div>
                </div>
            </div>
        </div>
        <!-- End New Card -->
    </div>


    <script>
        function toggleNav() {
            var sidebar = document.getElementById("mySidebar");
            if (sidebar.style.width === "200px") {
                sidebar.style.width = "0";
            } else {
                sidebar.style.width = "200px";
            }
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }
    </script>
<!-- Add this inside the head section of your HTML -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<!-- ... (existing code) ... -->
<!-- Add this at the end of your HTML body section -->
<footer class="footer mt-auto py-3 text-center" style=" margin-top:20px; background-color: #ddef75; background-image: linear-gradient(to right, #ff4e50, #f9d423); width: 100%!important; height: 10%; border-radius: 7px;">
    <div class="container" style="display: flex; align-items: center; justify-content: center; height: 100%;">
        <span style="font-size: 26px; color: #fff; font-weight: 700; display: flex; align-items: center; padding-bottom:50px;">
            Made with <span class="material-icons" style="font-size: 28px; color: #ff4e50; margin-left: 5px;">favorite</span><!-- by Tukun-->
        </span>
    </div>
</footer>
<br><br>

<br><br>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

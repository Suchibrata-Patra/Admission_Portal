<?php 
require 'session.php';

// echo $user['fname'];
 $query = "SELECT * FROM student_details WHERE email='$email'";
 $results = mysqli_query($db, $query);
 $user = mysqli_fetch_assoc($results);

 echo $user['issubmitted'] ;
 if ($user['numberVerify'] == 0) {
  header('location: verify.php');
  exit(); // Add exit to stop further execution
} 
if ($user['issubmitted'] == 1) {
  header('location: payment_details.php');
  exit(); // Add exit to stop further execution
} 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
      }

      .header {
        background-color: white;
        color: black;
        text-align: right;
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .container {
        margin: 20px;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .row {
        margin-left: -15px;
        margin-right: -15px;
      }

      .col-xs-6 {
        width: 50%;
        float: left;
        padding-left: 15px;
        padding-right: 15px;
      }

      .tab-content {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
      }

      .logout {
        color: white;
        background-color: red;
        padding: 7px;
        border-radius: 5px;
        text-decoration: none;
      }

      .logout:hover {
        background-color: yellow;
        color: black;
      }
    </style>
  </head>
  <body>
    <div class="header">
      <h2 style="margin: 0">
        Welcome
        <?php echo $user['fname']; ?>
      </h2>
      <a href="welcome.php?logout='1'" class="logout">Logout</a>
    </div>
    <div class="container">
      <div class="row" >
        <div class="col-xs-12">
          <div class="card text-center">
            <div class="card-header">
              <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Student Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="marks_details.php"
                    >Marks Details</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Personal Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Address Details</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">File Upload</a>
                </li>
                <li class="nav-item">
                   <a class="nav-link disabled" href="#">Preview</a>
                 </li>
                 <li class="nav-item">
                  <a class="nav-link disabled" href="#">Final Submission</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Payment</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-xs-6 form-group">
                  <label><strong>Registration</strong> No</label>
                  <input
                    class="form-control"
                    type="text"
                    value="<?php echo $user['reg_no'];?>"
                    disabled
                  />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-6 form-group">
                  <label>Name</label>
                  <input
                    class="form-control"
                    type="text"
                    value="<?php echo $user['fname'] . ' ' . $user['lname']; ?>"
                    disabled
                  />
                </div>
                <div class="col-xs-6 form-group">
                  <label>Email ID</label>
                  <input
                    class="form-control"
                    type="text"
                    value="<?php echo $user['email']; ?>"
                    disabled
                  />
                </div>
                <div class="col-xs-6 form-group">
                  <label>Mobile No</label>
                  <input
                    class="form-control"
                    type="text"
                    value="<?php echo $user['phoneNumber']; ?>"
                    disabled
                  />
                </div>
                <div class="col-xs-6 form-group">
                  <label>Date of Birth</label>
                  <input
                    class="form-control"
                    type="text"
                    value="<?php echo date('F j, Y', strtotime($user['dob'])); ?>"
                    disabled
                  />
                </div>
              </div>
            </div>
            <div style="margin-left: 90%; padding-bottom: 2%;">
            <a href="marks_details.php" style="color: black;text-decoration: none;"> <button type="button" class="btn btn-primary" style="margin-right: 2%; background-color: white;color:black;"> Next</button></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  </body>
</html>

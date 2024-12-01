<?php include('_DIR_/../../exception_handler.php') ?>
<?php require ('../favicon.php') ?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'session.php';
require 'super_admin.php';
// require 'Date_Decider.php';

$table_name = $udise_code . '_Student_Details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';
// $query = "SELECT * FROM $table_name WHERE email='$email'";
// $results = mysqli_query($db, $query);
// $user = mysqli_fetch_assoc($results);

// if ($user['numberVerify'] == 0) {
//     header('Location: verify.php');
//     exit;
// } 
// if ($user['issubmitted'] == 1) {
//     header('Location:Application_Status.php');
//     exit;
// }
// if ($is_Application_live == 0) {
//     header('Location: closed.php');
//     exit;
}
// if($user['is_Admission_Allowed']==1){
//   if( && $is_Admission_live==0){
//      header('Location:closed.php');
//   }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="../../Assets/css/welcome.css">
  <!-- <script>
  window.history.forward();
</script> -->
</head>
<body>
  <!--PageLoader-->
  <?php require ('../Secure_Pageloader.php') ?>
  <!--Process Header-->
  <?php require ('../Student_Process_header.php') ?>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="card text-center">
          <?php include('../card_header.php') ?>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 form-group">
                <label class="field-lebels"><strong style="padding-right:2px;">Registration </strong> No</label>
                <input class="form-control " ;" type="text" value="<?php echo $user['reg_no'];?>" disabled />
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group">
                <label class="field-lebels">Name</label>
                <input class="form-control" type="text" value="<?php echo $user['fname'] . ' ' . $user['lname']; ?>"
                  disabled />
              </div>
              <div class="col-md-6 form-group">
                <label class="field-lebels">Email ID</label>
                <input class="form-control" type="text" value="<?php echo $user['email']; ?>" disabled />
              </div>
              <div class="col-md-6 form-group">
                <label class="field-lebels">Mobile No</label>
                <input class="form-control" type="text" value="<?php echo $user['phoneNumber']; ?>" disabled />
              </div>
              <div class="col-md-6 form-group">
                <label class="field-lebels">Date of Birth</label>
                <input class="form-control" type="text" value="<?php echo date('F j, Y', strtotime($user['dob'])); ?>"
                  disabled />
              </div>
            </div>
          </div>
          <div style="padding-bottom: 2%; text-align: center;">
            <a href="marks_details.php" style="color: black; text-decoration: none;">
              <button type="button" class="btn btn-info" style="background-color: white; color: black;">
                Next
              </button>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Hide preloader after 3 seconds
    setTimeout(function () {
      var preloader = document.getElementById('preloader');
      preloader.style.display = 'none';
    }, 4000); // 3000 milliseconds = 3 seconds
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php include('_DIR_/../../exception_handler.php') ?>
<?php include('../favicon.php') ?>
<?php 
require 'session.php';
require 'super_admin.php';

$table_name = $udise_code . '_Student_Details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';

if ($user['issubmitted'] == 1) {
    header('location: payment_details.php');
    exit(); // Add exit to stop further execution
} 

$query = "SELECT * FROM $table_name WHERE email=?";
$stmt = mysqli_prepare($db, $query);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$results = mysqli_stmt_get_result($stmt);

$user = mysqli_fetch_assoc($results);
echo '  Session Registration ID - '.$user['reg_no'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="public, max-age=3600">
    <title>Marks Details</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="../Assets/css/marks_details.css">
    <style>
        
    </style>
  </head>
  <body>
  <?php require ('../Student_Process_header.php') ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="card text-center">
            <?php include('../card_header.php') ?>
            <!--- This is the beginning of the Card Body portion-->

            <div class="card-body">
              <form method="post" action="marks_details_controller.php">
                <!-- Start of the Marks Entering Details -->
                <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputCity" style="display: flex"><strong>Subjects</strong></label>
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="Bengali"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">

                  <label for="inputState" style="display: flex"><strong>Obtained Marks</strong></label>
                    <input type="text" class="form-control" id="bengali_marks"
                    name ="bengali_marks"
                    oninput="restrictSpecialChars(this)"
                    <?php if ($user['bengali_marks'] == null): ?>
                    placeholder="Enter your Marks"
                    <?php else: ?>
                    value="<?php echo $user['bengali_marks']; ?>"
                    <?php endif; ?>
                    /required>
                  </div>
                  <div class="form-group col-md-2">
                  <label for="inputState" style="display: flex"><strong>Full Marks</strong></label>

                    <input
                      type="text"
                      class="form-control"
                      id="bengali_full_marks"
                      name="bengali_full_marks"
                      oninput="restrictSpecialChars(this)"
                      value="<?php echo $user['bengali_full_marks']; ?>"
                    />
                  </div>
                </div>
                <!-- End of the Marks Entering Page -->

                <!-- Start of the 2nd Marks Entering Details -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                  
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="English"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="english_marks"
                    name="english_marks"
                    oninput="restrictSpecialChars(this)"
                    <?php if ($user['english_marks'] == null): ?>
                    placeholder="Enter your Marks"
                    <?php else: ?>
                    value="<?php echo $user['english_marks']; ?>"
                    <?php endif; ?>
                    /required>
                  </div>
                  <div class="form-group col-md-2">
                    <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="english_full_marks"
                      name="english_full_marks"
                      oninput="restrictSpecialChars(this)"
                      value="<?php echo $user['english_full_marks']; ?>"
                      />
                  </div>
                </div>
                <!-- End of the 2nd Marks Entering Page -->

                <!-- Start of the 3rd Marks Entering Details -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="mathematics_marks"
                      value="Mathematics"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input type="text" class="form-control"
                    id="mathematics_marks" name="mathematics_marks"
                    oninput="restrictSpecialChars(this)"
                    <?php if ($user['mathematics_marks'] == null): ?>
                    placeholder="Enter your Marks"
                    <?php else: ?>
                    value="<?php echo $user['mathematics_marks']; ?>"
                    <?php endif; ?>
                    /required>
                  </div>
                  <div class="form-group col-md-2">
                    <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="mathematics_full_marks"
                      name="mathematics_full_marks"
                      oninput="restrictSpecialChars(this)"
                      value="<?php echo $user['mathematics_full_marks']; ?>"
                      /required>
                  </div>
                </div>
                <!-- End of the 3rd Marks Entering Page -->

                <!-- Start of the 4th Marks Entering Details -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="Physical Science"
                      disabled
                    /required>
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input type="text" class="form-control"
                    id="physical_science_marks" name="physical_science_marks"
                    oninput="restrictSpecialChars(this)"
                    <?php if ($user['physical_science_marks'] == null): ?>
                    placeholder="Enter your Marks"
                    <?php else: ?>
                    value="<?php echo $user['physical_science_marks']; ?>"
                    <?php endif; ?>
                    /required>
                  </div>
                  <div class="form-group col-md-2">
                    <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="physical_science_full_marks"
                      name="physical_science_full_marks"
                      oninput="restrictSpecialChars(this)"
                      value="<?php echo $user['physical_science_full_marks']; ?>"
                    /required>
                  </div>
                </div>
                <!-- End of the 4th Marks Entering Page -->

                <!-- Start of the 5th Marks Entering Details -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="Life Science"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input type="text" class="form-control"
                    id="life_science_marks" name="life_science_marks"
                    oninput="restrictSpecialChars(this)"
                    <?php if ($user['life_science_marks'] == null): ?>
                    placeholder="Enter your Marks"
                    <?php else: ?>
                    value="<?php echo $user['life_science_marks']; ?>"
                    <?php endif; ?>
                    /required>
                  </div>
                  <div class="form-group col-md-2">
                    <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="life_science_full_marks"
                      name="life_science_full_marks"
                      oninput="restrictSpecialChars(this)"
                      value="<?php echo $user['life_science_full_marks']; ?>"
                    />
                  </div>
                </div>
                <!-- End of the 5th Marks Entering Page -->

                <!-- Start of the 6th Marks Entering Details -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="History"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input type="text" class="form-control" id="History_marks"
                    name="History_marks"
                    oninput="restrictSpecialChars(this)"
                    <?php if ($user['history_marks'] == null): ?>
                    placeholder="Enter your Marks"
                    <?php else: ?>
                    value="<?php echo $user['history_marks']; ?>"
                    <?php endif; ?>
                    /required>
                  </div>
                  <div class="form-group col-md-2">
                    <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="History_full_marks"
                      name="History_full_marks"
                      oninput="restrictSpecialChars(this)"
                      value="<?php echo $user['history_full_marks']; ?>"
                    />
                  </div>
                </div>
                <!-- End of the 6th Marks Entering Page -->

                <!-- Start of the 6th Marks Entering Details -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="Geography"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input type="text" class="form-control" id="geography_marks"
                    name="geography_marks"
                    oninput="restrictSpecialChars(this)"
                    <?php if ($user['geography_marks'] == null): ?>
                    placeholder="Enter your Marks"
                    <?php else: ?>
                    value="<?php echo $user['geography_marks']; ?>"
                    <?php endif; ?>
                    /required>
                  </div>
                  <div class="form-group col-md-2">
                    <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="geography_full_marks"
                      name="geography_full_marks"
                      oninput="restrictSpecialChars(this)"
                      value="<?php echo $user['geography_full_marks']; ?>"
                    />
                  </div>
                </div>
                <!-- End of the 6th Marks Entering Page -->

                <hr />
                <!-- Start of the 6th Marks Entering Details -->

                <!-- End of the 6th Marks Entering Page -->
                <a
                href="welcome.php"
                style="color: black; text-decoration: none"
              >
                <button
                  type="button"
                  class="btn btn-info"
                  style="
                    margin-right: 2%;
                    background-color: rgb(255, 255, 255);
                    color: black;
                  "
                >
                  Back
                </button>
              </a>
              <a
                href="personal_details.php"
                style="color: black; text-decoration: none"
              >
              <button
                  type="submit"
                  name="submit_marks"
                  class="btn btn-info"
                  tyle="
                    margin-right: 2%;
                    background-color: rgb(255, 255, 255);
                    color: black;
                  "
                >
                  Save & Next
                </button></a
              >
              </form>
            </div>

            <!-- This is the End of Card Body Portion-->
            <div style="margin-left: 30%; padding-bottom: 2%">
              <a href="welcome.php" style="color: black; text-decoration: none">
                
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
  // Function to restrict special characters
  function restrictSpecialChars(inputField) {
    // Regular expression to match special characters
    var regex = /[!@#$%^&*(),.?":{}|<>]/g;

    // Check if the input contains any special characters
    if (regex.test(inputField.value)) {
      // If special characters are found, replace them with an empty string
      inputField.value = inputField.value.replace(regex, '');
    }
  }
</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  </body>
</html>

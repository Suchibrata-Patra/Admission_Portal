<?php
ini_set('display_errors', 1); 
error_reporting(E_ALL);
include 'database.php';
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
 <!-- FAVICON -->
 <link rel="shortcut icon" href="../../../Assets/images/favicon.png" type="image/svg+xml">

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/../../../../Assets/css/Generalised_HOI_Stylesheet.css">

    <script>
  window.history.forward();
</script>
    <title>Sign Up</title>
  </head>
  <body>
    <!-- <h2><Center>Head Of the Instituion Signup</Center></h2> -->
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <br />
          <?php if(isset($_GET['error'])) { ?>
          <div class="alert alert-danger">
            <?php echo $error = $_GET['error']; ?>
          </div>
          <?php } ?>
          <h3>Head Of the Instituion Signup</h3>
          <hr />
          <form method="post" action="HOI_controller.php">
          <div class="mb-3">
              <label for="udiseid" class="form-label">School UDISE ID</label>
              <input
                type="text"
                name="HOI_Udise_ID"
                class="form-control"
                id="reg_no"
                required
              />
            </div>
            <!-- <div class="mb-3">
              <label for="fname" class="form-label">Instituion Name</label>
              <input
                type="text"
                name="Institution_Name"
                class="form-control"
                id="fname"
                required
              />
            </div> -->
            <div class="mb-3">
              <label for="fname" class="form-label">HOI Name</label>
              <input
                type="text"
                name="HOI_HOI_Name"
                class="form-control"
                id="fname"
                required
              />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                name="HOI_email"
                class="form-control"
                id="email"
                required
              />
            </div>
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Phone Number</label>
              <div class="input-group">
                <select
                  name=""
                  class="form-select"
                  style="padding-right: 0px; padding-left: 3px"
                disabled >
                  <option data-countryCode="IN" value="91" selected>
                    India (+91)
                  </option>
                  Add more options for other countries here 
             </select> 
                <input
                  type="tel"
                  name="HOI_Mobile_No"
                  class="form-control"
                  id="phoneNumber"
                  aria-describedby="emailHelp"
                  placeholder="Enter your number here..."
                  required
                />
              </div>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Create Password</label>
              <input
                type="password"
                class="form-control"
                name="HOI_Login_Password"
                id="password"
                required
              />
            </div>
            <div class="mb-3 form-check">
              <input
                type="checkbox"
                class="form-check-input"
                name="terms"
                id="terms"
                required
              />
              <label class="form-check-label" for="terms"
                >I'm Sure The UDISE ID I have provided is Correct</label
              >
            </div>
            <button type="submit" name="HOI_Signup" class="btn btn-primary">
              Submit
            </button>
          </form>
        </div>
      </div>
    </div>

    <div class="container" style="padding-bottom: 200px"></div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    ></script>
  </body>
</html>

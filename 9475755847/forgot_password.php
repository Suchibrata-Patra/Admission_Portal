<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
  <link rel="shortcut icon" href="../../Assets/images/favicon.png" type="image/svg+xml">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./Assets/css/style.css">
  <title>Sign Up</title>
  <style>
    .alert {
      border-radius: 10px;
    }

    h3 {
      color: #484848;
      text-align: center;
    }

    hr {
      border-top: 1px solid #ddd;
    }
 
    .form-label {
      color: black;
      font-weight: 500;
      background-color: #e3e4f1;
      border-top-left-radius: 3px;
      border-top-right-radius: 3px;
      padding-left: 10px;
      padding-right: 10px;
      margin-bottom: -2px;
      font-size: 15px;
      margin-left: 1%;

    }

    .form-control {
      border-radius: 8px;
      border: 1px solid #ddd;
      font-size: 15px;
    }

    .btn-primary:hover {
      background-color: #eb4248;
    }

    .form-check-input {
      margin-top: 8px;
    }

    .form-check-label {
      color: #484848;
    }

    .form-check-input[type="checkbox"] {
      width: 20px;
      height: 20px;
    }

    .form-check-input[type="checkbox"]:focus {
      box-shadow: none;
    }

    .form-check-input[type="checkbox"]:checked {
      background-color: #fd5c63;
    }

    .form-check-input[type="checkbox"]:checked:after {
      content: "";
      display: block;
      width: 6px;
      height: 11px;
      border: solid white;
      border-width: 0 3px 3px 0;
      transform: rotate(45deg);
      margin-left: 6px;
    }
  </style>
</head>

<body>
  <?php include('site_header.php') ?>

  <script>
    window.history.forward();
  </script>
  <div class="container"
    style="margin-top:9%;padding-bottom:9%;background-color: white;border: 2px solid rgb(221, 221, 221);border-radius: 20px;">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <br />
        <?php if(isset($_GET['error'])) { ?>
        <div class="alert alert-danger">
          <?php echo $error = $_GET['error']; ?>
        </div>
        <?php } ?>
        <h3 style="font-size: 25px;">Forgot Password</h3>
        <hr />
        <form method="post" action="forgot_password_controller.php">
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required placeholder="Email ID">
          </div>
          <div class="mb-3">
            <label for="reg_no" class="form-label">Registration Number</label>
            <input type="text" name="reg_no" class="form-control" id="reg_no" placeholder="Registration No" required>
          </div>
          <div class="mb-3">
            <label for="phoneNumber" class="form-label" placeholder="Phone No" required>Phone Number</label>
            <div class="input-group">
              <!-- <select name="countryCode" class="form-select" style="padding-right: 0px; padding-left: 3px">
                <option data-countryCode="IN" value="91" selected>
                  India (+91)
                </option>
              </select> -->
              <input type="tel" name="phoneNumber" class="form-control" id="phoneNumber" aria-describedby="emailHelp"
                placeholder="Enter your number here..." required />
            </div>
          </div>
          <button type="submit" name="reg_user"
            style="background-color:#fd5c63;margin:19px;padding-left:4%;padding-right:4%;;padding-top:5px;padding-bottom:5px;color: white;border-radius:3px;">
            <b>Submit</b>
          </button>
          <a href="admission.php" style="color: #8b8181; text-decoration: none; display: inline-block;">
            Already Registered?<b style="color: #fd5c63; text-decoration: underline;"> Login</b>
          </a>
           <br>
        </form>
      </div>
    </div>
  </div>
  <br>
  <?php include('site_footer.php') ?>

  <!-- 
    - #BACK TO TOP
    -->

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <ion-icon name="arrow-up"></ion-icon>
  </a>
  <script src="./Assets/js/script.js" defer></script>

  <!-- Optional JavaScript; choose one of the two! -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
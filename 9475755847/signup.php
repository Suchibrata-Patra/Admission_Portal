<?php include('../favicon.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="../Assets/css/signup.css">
  <style>
  
  </style>
  <title>Sign Up</title>
</head>

<body>
  <?php //include('site_header.php') ?>

  <script>
    window.history.forward();
  </script>
  <br>
  <div class="container"
    style="margin-top:14%;padding-bottom:9%;background-color: white;border: 0px solid #eaeaea; border-radius: 20px;">
    <div class="row justify-content-center">

      <div class="col-md-6" style="padding-left:3%;padding-right:3%;border-right:2px solid #eaeaea;margin-top:5%;">
        <br />
        <?php if(isset($_GET['error'])) { ?>
        <div class="alert alert-danger">
          <?php echo $error = $_GET['error']; ?>
        </div>
        <?php } ?>
        <h3 style="font-size: 25px;color:BLACK;">Registration</h3>
        <hr />
        <form method="post" action="controller.php">
          <div class="mb-3">
            <label for="fname" class="form-label">First Name</label>
            <input type="text" name="fname" class="form-control" id="fname" oninput="restrictSpecialChars(this);limitLength(this, 50);" placeholder="Enter First Name here" required />
          </div>
          <div class="mb-3">
            <label for="lname" class="form-label">Last Name</label>
            <input type="text" name="lname" class="form-control" id="lname" oninput="restrictSpecialChars(this);limitLength(this, 50);" placeholder="Enter Last Name here" required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" oninput="limitLength(this, 250);" id="email" required />
          </div>
          <div class="mb-3">
            <label for="phoneNumber" class="form-label">Phone Number</label>
            <div class="input-group">
              <select name="countryCode" class="form-select" style="padding-right: 0px; padding-left: 3px">
                <option data-countryCode="IN" value="91" selected>
                  India (+91)
                </option>
                <!-- Add more options for other countries here -->
              </select>
              <input type="tel" name="phoneNumber" class="form-control" id="phoneNumber" aria-describedby="emailHelp"
                placeholder="Enter your number here..." oninput="restrictSpecialChars(this);limitLength(this, 10);" required />
            </div>
          </div>
          <div class="mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" name="dob" class="form-control" id="dob"  oninput="limitLength(this, 10);" required />
          </div>
          <div class="mb-3">
            <label for="reg_no" class="form-label">Registration Number</label>
            <input type="text" name="reg_no" class="form-control" id="reg_no" oninput="restrictSpecialChars(this);limitLength(this, 20);" required />
          </div>

          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required />
            <!-- <p class="password_guidelines"><a href="../password_guidelines.php" target="_blank"><u>See Password Guidelines </u></a></p> -->
          </div>
          <div class="mb-3">
            <label for="confim_password" class="form-label">Confirm Password</label>
            <input type="confim_password" class="form-control" name="confim_password" id="confim_password" required />
            <p class="password_guidelines"><a href="../password_guidelines.php" target="_blank"><u>See Password Guidelines </u></a></p>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="terms" id="terms" required />
            <label class="form-check-label" for="terms" style="">Accepting Platform's Terms & Conditions</label>
          </div>
          <center>
          <button type="submit" name="reg_user" class="btn btn-primary">
            Register 
          </button>
          </center>
          <a href="admission.php" style="color: #8b8181; text-decoration: none; display: inline-block;font-weight:300;">
            Already Registered?<b style="color: #fd5c63; text-decoration: underline;"> Login</b>
          </a>
           <br>
        </form>
      </div>

        <!-- Beginning of Background Images -->
            <div class="col-md-6"> 
        <p style="padding:10%;font-weight:200;"></p>
      </div>
        <!-- End of Background Images-->


    </div>
   
  </div>
  <!-- 
  - #NEWSLETTER
-->

<section class="section newsletter" aria-label="newsletter"
style="background-image: url('./assets/images/newsletter-bg.jpg')">
<div class="container">

<p class="section-subtitle">Subscribe Newsletter</p>

<h2 class="h2 section-title">Get Every Latest News</h2>

<form action="" class="newsletter-form">

  <div class="input-wrapper">
    <input type="email" name="email_address" aria-label="email" placeholder="Enter your mail address" required
      class="email-field">

    <ion-icon name="mail-open-outline" aria-hidden="true"></ion-icon>
  </div>

  <button type="submit" class="btn btn-primary">
    <span class="span">Subscribe</span>

    <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
  </button>

</form>

</div>
</section>
  <?php include('site_footer.php') ?>

  <!-- 
    - #BACK TO TOP
    -->

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <ion-icon name="arrow-up"></ion-icon>
  </a>
  <script src="./Assets/js/script.js" defer></script>
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
<script>
  function limitLength(element, maxLength) {
    if (element.value.length > maxLength) {
      element.value = element.value.slice(0, maxLength);
    }
  }
</script>
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
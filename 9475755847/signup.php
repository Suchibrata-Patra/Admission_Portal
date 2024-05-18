<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />

    <title>Sign Up</title>
    <style>
      body {
        background-color: #f6f6f6;
        font-family: Arial, sans-serif;
      }
      .container {
        margin-top: 50px;
        width: 95%;
      }
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
        color: #484848;
        font-weight: bold;
      }
      .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
      }
      .btn-primary {
        background-color: #fd5c63;
        border: none;
        border-radius: 8px;
        width: 100%;
        margin-top: 20px;
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
<script>
  window.history.forward();
</script>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <br />
          <?php if(isset($_GET['error'])) { ?>
          <div class="alert alert-danger">
            <?php echo $error = $_GET['error']; ?>
          </div>
          <?php } ?>
          <h3>Sign Up Form</h3>
          <hr />
          <form method="post" action="controller.php">
            <div class="mb-3">
              <label for="fname" class="form-label">First Name</label>
              <input
                type="text"
                name="fname"
                class="form-control"
                id="fname"
                required
              />
            </div>
            <div class="mb-3">
              <label for="lname" class="form-label">Last Name</label>
              <input
                type="text"
                name="lname"
                class="form-control"
                id="lname"
                required
              />
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                name="email"
                class="form-control"
                id="email"
                required
              />
            </div>
            <div class="mb-3">
              <label for="phoneNumber" class="form-label">Phone Number</label>
              <div class="input-group">
                <select
                  name="countryCode"
                  class="form-select"
                  style="padding-right: 0px; padding-left: 3px"
                >
                  <option data-countryCode="IN" value="91" selected>
                    India (+91)
                  </option>
                  <!-- Add more options for other countries here -->
                </select>
                <input
                  type="tel"
                  name="phoneNumber"
                  class="form-control"
                  id="phoneNumber"
                  aria-describedby="emailHelp"
                  placeholder="Enter your number here..."
                  required
                />
              </div>
            </div>
            <div class="mb-3">
              <label for="dob" class="form-label">Date of Birth</label>
              <input
                type="date"
                name="dob"
                class="form-control"
                id="dob"
                required
              />
            </div>
            <div class="mb-3">
              <label for="reg_no" class="form-label">Registration Number</label>
              <input
                type="text"
                name="reg_no"
                class="form-control"
                id="reg_no"
                required
              />
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input
                type="password"
                class="form-control"
                name="password"
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
                >Accepting Platform's Terms & Conditions</label
              >
            </div>
            <button type="submit" name="reg_user" class="btn btn-primary">
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

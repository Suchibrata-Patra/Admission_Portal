<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<title>The Application - Centralised Admission Portal</title>

    <style>
  #preloader {
    font-family: "Poppins", sans-serif;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  /* background: linear-gradient(to bottom right, #f5f5f5, #f4eec1, #f9d7fa); */
  background-color: #ffffff;
  z-index: 9999;
  display: flex;
  justify-content: center;
  align-items: center;
}

#loader img {
  animation: spin 1s linear infinite; /* Apply animation to the image */
}

#loader p {
  margin-top: 10px; /* Adjust the margin as needed */
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
    <title></title>
</head>
<body>
<div id="preloader">
  <center>
    <div id="loader">
      <!-- Changed the src attribute to use HTTPS -->
      <!-- <img src="https://yourdomain.com/Assets/images/loader.jpg" alt="" style="width:8%;height: auto;">
      <p style="color: rgb(0, 0, 0);font-size:20px;">Establishing Secure Connection . . .</p> -->
      <img src="../../../../Assets/images/loader.jpg" alt="" style="width:8%;height: auto;">
      <p style="color: rgb(0, 0, 0);font-size:20px;">Establishing Secure Connection . . .</p>
    </div>
  </center>
</div>
</body>
<script>
    // Hide preloader after 3 seconds
    setTimeout(function () {
      var preloader = document.getElementById('preloader');
      preloader.style.display = 'none';
    }, 1000); // 3000 milliseconds = 3 seconds
  </script>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>#preloader {
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
    }, 2000); // 3000 milliseconds = 3 seconds
  </script>
</html>

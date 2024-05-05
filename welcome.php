<?php 

require 'session.php';

// echo $user['fname'];

    if ($user['numberVerify'] == 0) {
      header('location: verify.php');
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
  }

  .header {
    background-color: #333333;
    color: #ffffff;
    text-align: center;
    padding: 20px 0;
  }

  .container {
    max-width: 800px;
    margin: 20px auto;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }

  .tabs {
    display: flex;
    justify-content: space-around;
    border-bottom: 2px solid #e0e0e0;
  }

  .tab {
    padding: 15px 20px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .tab:hover {
    background-color: #f5f5f5;
  }

  .active {
    background-color: #e0e0e0;
    font-weight: bold;
  }

  .content {
    padding: 20px;
  }

  .info {
    margin-bottom: 20px;
    font-size: 16px;
    color: #333333;
  }

  .success {
    color: green;
  }

  .logout {
    color: red;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .logout:hover {
    color: darkred;
  }

  .tab-content {
    display: none;
  }

  .tab-content.active {
    display: block;
  }
</style>
</head>
<body>
<div class="header">
  <h2>Welcome <?php echo $user['fname']; ?></h2>
  <a href="welcome.php?logout='1'" class="logout">Logout</a>
</div>
<div class="container">
  <div class="tabs">
    <div class="tab" onclick="openTab('address-details')">Address Details</div>
    <div class="tab" onclick="openTab('mars-details')">Mars Details</div>
    <div class="tab" onclick="openTab('file-upload')">File Upload</div>
  </div>
  <div id="address-details" class="tab-content active">
    <div class="content">
      <p class="info"><?php if ($user['emailVerify'] == 1) : ?><span class="success">This email is verified!</span><?php endif ?></p>
      <!-- Add address details content here -->
    </div>
  </div>
  <div id="mars-details" class="tab-content">
    <div class="content">
      <!-- Add mars details content here -->
    </div>
  </div>
  <div id="file-upload" class="tab-content">
    <div class="content">
      <!-- Add file upload content here -->
    </div>
  </div>
</div>

<script>
  function openTab(tabName) {
    var i, tabContent;
    tabContent = document.getElementsByClassName("tab-content");
    for (i = 0; i < tabContent.length; i++) {
      tabContent[i].classList.remove("active");
    }
    document.getElementById(tabName).classList.add("active");
  }
</script>
</body>
</html>

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
    background-color: WHITE;
    color: BLACK;
    text-align: right;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .container {
    margin: 20px;
  }

  .tabs {
    display: flex;
    overflow-x: auto;
    border-bottom: 2px solid #e0e0e0;
    margin-bottom: 10px;
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
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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
    color: White;
    background-color:RED;
    padding:7px;
    border-radius:5px;
    text-decoration: none;
  }

  .logout:hover {
    background-color:Yellow;
    color: Black;
  }

  .tab-content {
    display: none;
  }

  .tab-content.active {
    display: block;
  }

  @media screen and (max-width: 600px) {
    .tabs {
      flex-wrap: nowrap;
    }
  }
</style>
</head>
<body>
<div class="header">
  <h2 style="margin: 0;">Welcome <?php echo $user['fname']; ?></h2>
  <a href="welcome.php?logout='1'" class="logout">Logout</a>
</div>
<div class="container">
  <div class="tabs">
    <div class="tab" onclick="openTab('student-details')">Student Details</div>
    <div class="tab" onclick="openTab('marks-details')">Marks Details</div>
    <div class="tab" onclick="openTab('file-upload')">File Upload</div>
  </div>
  <div id="-details" class="tab-content active">
    <div class="content">
      <p class="info"><?php if ($user['emailVerify'] == 1) : ?><span class="success">This email is verified!</span><?php endif ?></p>
      <!-- Add address details content here -->
    </div>
  </div>
  <div id="marks-details" class="tab-content">
    <div class="content">
      <div>fhkdhdfj</div>
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

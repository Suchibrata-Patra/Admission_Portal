<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="/Assets/images/favicon.png" type="image/svg+xml">
  <title>TheApplication - Centralized Admission Portal</title>

  <!-- SEO Meta Description -->
  <meta name="description"
    content="TheApplication is a centralized admission portal that simplifies the application process for students applying to various educational institutions. Access important information, application deadlines, and required documentation all in one place.">

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
      font-family: 'Roboto', sans-serif;
      background-color: #fff;
      color: #000;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      display: flex;
      align-items: center;
      gap: 20px;
      text-align: left;
      max-width: 100%;
      padding: 20px;
      flex-direction: column; /* Stack content vertically for mobile */
    }

    .error-container {
      max-width: 100%;
      text-align: center; /* Center-align text for mobile readability */
    }

    .error-title {
      font-size: 35px;
      font-weight: 500;
      margin: 10px 0;
    }

    .error-message {
      font-size: 1rem;
      color: #a8a8a8;
      margin: 15px 0;
    }

    .primary-btn {
      display: inline-block;
      background-color: #000;
      color: #fff;
      font-size: 1rem;
      padding: 10px 25px;
      border-radius: 50px;
      text-decoration: none;
      transition: background-color 0.3s, transform 0.2s;
    }

    .primary-btn:hover {
      background-color: #333;
    }

    .primary-btn:active {
      transform: translateY(2px);
    }

    img {
      max-width: 150px; /* Adjust image size for smaller screens */
      height: auto;
    }

    .powered-by {
      position: fixed;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
    }

    .powered-by img {
      height: 40px;
      width: auto;
    }

    /* Yellow Circle Styling */
    .yellow-circle {
      width: 100px;
      height: 100px;
      background-color: yellow;
      border-radius: 50%;
      margin-top: 10px;
    }

    /* Responsive Design for Smaller Screens */
    @media (max-width: 600px) {
      html, body {
        padding: 10px;
      }

      .container {
        gap: 15px;
      }

      .error-title {
        font-size: 28px;
      }

      .error-message {
        font-size: 0.9rem;
      }

      .primary-btn {
        padding: 8px 20px;
        font-size: 0.9rem;
      }

      img {
        max-width: 120px;
      }

      .yellow-circle {
        width: 80px;
        height: 80px;
      }
    }
  </style>
</head>
<body>
  <!-- Icon Section -->
  <div class="powered-by">
    Powered By <br>
    <a href="/">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/63/The_application.in_navbara_icon.png/220px-The_application.in_navbara_icon.png" 
           alt="Site Icon">
    </a>
  </div>

  <div class="container">
    <!-- Image Section -->
    <div class="image-section">
      <img src="https://static.vecteezy.com/system/resources/previews/006/241/035/non_2x/cute-cartoon-puppy-outline-funny-dog-illustration-for-kids-illustration-with-black-outline-happy-cartoon-puppy-sits-portrait-of-a-cute-dog-a-dog-friend-on-white-background-free-vector.jpg" 
           alt="Cute Cartoon Puppy">
      <div class="yellow-circle"></div>
    </div>

    <!-- Error Content Section -->
    <div class="error-container">
      <h1 style="font-size:70px;">400</h1>
      <h1 class="error-title">It's Not You, It's Us</h1>
      <p class="error-message">
        Please bear with us while we resolve the issue. If the problem persists, let us know.  
      </p>
      <a href="/" class="primary-btn">Go Back Home</a>
    </div>
  </div>
</body>
</html>

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

  <link rel="preload"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" href="/Assets/images/Hero_Section_Background_Image.webp" as="image" type="image/webp">

  <link rel="stylesheet" href="/Assets/css/style_listing_page.css">

  <!-- Custom Styles -->
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
      padding: 0 15px;
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      justify-content: center;
      gap: 20px; /* Space between image and text */
      text-align: left;
      max-width: 100%;
      padding: 20px;
    }

    .error-container {
      max-width: 600px;
      text-align: center;
      flex: 1;
    }

    .error-title {
      font-size: 40px;
      font-weight: 500;
      margin: 0;
    }

    .error-message {
      font-size: 1.2rem;
      color: #a8a8a8;
      margin: 20px 0;
    }

    .primary-btn {
      display: inline-block;
      background-color: #000000;
      color: #fff;
      font-size: 1.1rem;
      font-weight: 200;
      padding: 16px 30px;
      border-radius: 50px;
      text-decoration: none;
      transition: background-color 0.3s, transform 0.2s;
      font-weight: 400;
    }

    .primary-btn:hover {
      background-color: #000000;
    }

    .primary-btn:active {
      transform: translateY(2px);
    }

    img {
      max-width: 30%;
      height: auto;
      flex: 1;
    }

    #navbar_icon{
        width:90%;
        height:auto;
    }

    .powered-by {
      position: fixed;
      top: 10px;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
    }

    .powered-by img {
      height: 50px;
      width: auto;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        padding: 15px;
      }

      .error-title {
        font-size: 36px;
      }

      .error-message {
        font-size: 1rem;
      }

      .primary-btn {
        font-size: 1rem;
        padding: 10px 20px;
      }

      img {
        width: 30%;
      }
    }

    @media (max-width: 480px) {
      .container {
        padding: 10px;
      }

      .error-title {
        font-size: 30px;
      }

      .error-message {
        font-size: 0.9rem;
      }

      .primary-btn {
        font-size: 1rem;
        padding: 10px 15px;
      }

      img {
        max-width: 90%;
      }
    }
  </style>
</head>
<body>
  <!-- Icon Section -->
  <div class="powered-by">
    <p>Powered By</p>
   <strong style="font-size:1.62em;font-weight:400;"><a href="https://theapplication.in" style="color:black;">TheApplication.in</a></strong>
  </div>

  <div class="container">
    <!-- Image Section -->
    <img src="Assets/images/We_are_sorry_saying_Puppy.webp" alt="Cute Cartoon Puppy">
  
    <!-- Error Content Section -->
    <div class="error-container">
      <h1 style="font-size:100px;">500</h1>
      <h1 class="error-title">It's Not You, It's Us</h1>
      <h5  style="color:#145374;font-weight:300;font-size:15px;">ORACLE_PARSING_ERROR -  U_SUCCESFUL</h5>
      <p class="error-message" style="font-weight:300;font-size:25px;">
        Please bear with us while we resolve the issue. If the problem persists, let us know.  
      </p>
      <a href="/" class="primary-btn">Go Back Home</a>
    </div>
  </div>
</body>
</html>

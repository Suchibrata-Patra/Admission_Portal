<?php include('../favicon.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DHBSSPV</title>

  <!-- 
    - favicon
  -->

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../Assets/css/contact_us.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-banner.png">
  <link rel="preload" as="image" href="./assets/images/hero-abs-1.png" media="min-width(768px)">
  <link rel="preload" as="image" href="./assets/images/hero-abs-2.png" media="min-width(768px)">
</head>

<body id="top">



  <!-- 
    # HEADER
 -->
  <?php include('site_header.php') ?>


      <!-- 
        - #CATEGORY
      -->

      <section class="section category" aria-label="category">
        <div class="container">
<br>
          <p class="section-subtitle">Got Any Doubts have to be resolved soon ? </p>

          <h2 class="h2 section-title">Connect With Us</h2>

          <ul class="grid-list">


          <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="mail-open-outline"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Gmail</a>
                  </h3>

                  <span class="card-meta">dhbsspv.official@gmail.com</span>
                </div>

              </div>
            </li>
          <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="call-outline"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Telephone</a>
                  </h3>

                  <span class="card-meta">74312 82729</span>
                </div>

              </div>

            </li>
          <li>
              <div class="category-card">

                <div class="card-icon">
                <ion-icon name="logo-whatsapp"></ion-icon>
                </div>

                <div>
                  <h3 class="h3 card-title">
                    <a href="#">Whatsapp</a>
                  </h3>

                  <span class="card-meta">+91 9475755847</span>
                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>


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

  </article>
  </main>





  <!-- 
    - #FOOTER
  -->
  <?php include('site_footer.php') ?>

  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <ion-icon name="arrow-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
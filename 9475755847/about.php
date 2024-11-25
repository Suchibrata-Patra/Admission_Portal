<?php require ('../favicon.php') ?>
<?php include('_DIR_/../../exception_handler.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DHBSSPV</title>

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="../Assets/css/about.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./Assets/images/hero-banner.png">
  <link rel="preload" as="image" href="./Assets/images/hero-abs-1.png" media="min-width(768px)">
  <link rel="preload" as="image" href="./Assets/images/hero-abs-2.png" media="min-width(768px)">
</head>

<body id="top">



  <!-- # HEADER -->
  <?php include('site_header.php') ?>


  <!-- 
        - #CATEGORY
      -->

  <section class="section category" aria-label="category">
    <div class="container">

      <p class="section-subtitle">About The Institution</p>

      <h2 class="h2 section-title">About Us</h2>
      <p style="text-align: justify;">

      <p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
    Welcome to DHBSSPV, where education meets excellence and every student’s potential is nurtured. Established in [Year], our school has been a beacon of knowledge, innovation, and holistic development. Located in the heart of Diamond Harbour, we pride ourselves on creating a vibrant, inclusive, and dynamic learning environment.
</p>
<p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
    At DHBSSPV, our mission is to empower students with a well-rounded education that not only focuses on academic excellence but also emphasizes character development, critical thinking, and creativity. We believe that every child is unique and capable of achieving great things with the right guidance and support.
</p>
<p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
    Our experienced and dedicated faculty are the cornerstone of our institution. They are committed to providing a high-quality education that inspires a lifelong love of learning. With a student-centered approach, they foster an environment where curiosity is encouraged, and every student is motivated to reach their full potential.
</p>
<p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
    We offer a comprehensive curriculum that is designed to challenge and engage students at every level. From our rigorous academic programs to our diverse extracurricular activities, we ensure that our students are well-prepared for the future. Our state-of-the-art facilities, including modern classrooms, science labs, a library, sports complexes, and art studios, provide an ideal setting for learning and growth.
</p>
<p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
    Community involvement and social responsibility are integral parts of our ethos. We encourage our students to be active participants in their community and to develop a sense of empathy and responsibility towards others. Through various community service projects and environmental initiatives, our students learn the importance of giving back and making a positive impact on the world.
</p>
<p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
    At DHBSSPV, we are more than just a school; we are a family. We value the partnerships we build with parents, guardians, and the wider community. Together, we work towards a common goal of nurturing well-rounded individuals who are ready to take on the challenges of the future with confidence and resilience.
</p>
<p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
    Thank you for considering DHBSSPV as a place for your child’s education. We invite you to visit our campus, meet our faculty, and experience the vibrant community that makes our school truly special. Join us in our journey of fostering excellence and shaping the leaders of tomorrow.
</p>

      </p>
      <br>

    </div>
  </section>

  <!-- 
        - #NEWSLETTER
      -->

  <section class="section newsletter" aria-label="newsletter"
    style="background-image: url('./Assets/images/newsletter-bg.jpg')">
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
  <script src="./Assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Haggle - Admission</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="style_listing_page.css">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>

    <div class="overlay" data-overlay></div>

    <div class="header-top">
      <div class="container">

        <a href="tel:+01123456790" class="helpline-box">

          <div class="icon-box">
            <ion-icon name="call-outline"></ion-icon>
          </div>

          <div class="wrapper">
            <p class="helpline-title">Got Stuck Somewhere ?</p>

            <p class="helpline-number">+91 9475755847</p>
          </div>

        </a>

        <a href="#" class="logo">
          <img src="https://1000logos.net/wp-content/uploads/2016/10/Apple-Logo-500x281.png" alt="Haggle logo"
            style="width: auto;height:2.5em;">
        </a>

        <div class="header-btn-group">

          <button class="search-btn" aria-label="Search">
            <ion-icon name="search"></ion-icon>
          </button>

          <button class="nav-open-btn" aria-label="Open Menu" data-nav-open-btn>
            <ion-icon name="menu-outline"></ion-icon>
          </button>

        </div>

      </div>
    </div>

    <div class="header-bottom">
      <div class="container">

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

        <nav class="navbar" data-navbar>

          <div class="navbar-top">

            <a href="#" class="logo">
              <img src="./assets/images/logo-blue.svg" alt="Tourly logo">
            </a>

            <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
              <ion-icon name="close-outline"></ion-icon>
            </button>

          </div>

          <ul class="navbar-list">

            <li>
              <a href="index.html" class="navbar-link" data-nav-link>home</a>
            </li>

            <li>
              <a href="#" class="navbar-link" data-nav-link>about us</a>
            </li>

            <li>
              <a href="#destination" class="navbar-link" data-nav-link>Ranking</a>
            </li>

            <li>
              <a href="#package" class="navbar-link" data-nav-link>Guide</a>
            </li>

            <li>
              <a href="#gallery" class="navbar-link" data-nav-link>gallery</a>
            </li>

            <li>
              <a href="#contact" class="navbar-link" data-nav-link>contact us</a>
            </li>

          </ul>

        </nav>

        <a href="#"><button class="btn btn-primary">Login</button></a>

      </div>
    </div>

  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home">
        <div class="container">

          <h2 class="h1 hero-title">Apply @ New Schools</h2>

          <p class="hero-text">
          Ensure smooth application processing: Create separate accounts for each institution, then proceed to apply to each school individually.          </p>
          <form action="Complete_List.php" method="GET" style="padding-top: 8%;padding-bottom:8%;">
            <input type="text" name="search" id="search"
              style="padding: 16px;font-size: 18px; border-radius: 30px; border: 2px solid #ffffff;background-color: #ffffff; width: calc(100% - 160px); max-width: 600px; display: inline-block; box-shadow: 0px 2px 5px rgba(255, 255, 255, 0.1);"
              placeholder="Search Schools">
            <button type="submit"
              style="padding: 16px 32px; font-size: 18px; border-radius: 30px; border: none; background-color: #FF5A5F; color: #fff; display: inline-block; cursor: pointer; transition: background-color 0.3s ease;">Search</button>
          </form>
          <div class="btn-group">
            <button class="btn btn-primary">How to Apply ?</button>

            <a href="Complete_List.html">
              <button class="btn btn-secondary">Available School Lists</button>
            </a>
          </div>

        </div>
      </section>

      <section class="popular" id="destination">
        <div class="container">

          <p class="section-subtitle">Unleash THE TOP School Names Where the Students Prefer to Study </p>

          <h2 class="h2 section-title">Most Applied Schools</h2>

          <p class="section-text">
          Ensure smooth application processing: <b>Create separate accounts for each institution,</b>then proceed to apply to each school individually.          </p>

          <ul class="popular-list">

            <li>
              <div class="popular-card">

                <figure class="card-img">
                  <img
                    src="https://images.unsplash.com/photo-1579862325998-44e49ab74138?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8SGFydmFyZHxlbnwwfHwwfHx8MA%3D%3D"
                    alt="San miguel, italy" loading="lazy">
                </figure>

                <div class="card-content">

                  <div class="card-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <p class="card-subtitle">
                    <a href="#">North 24 Pgs</a>
                  </p>

                  <h3 class="h3 card-title">
                    <a href="#">NARENDRAPUR</a>
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing.
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="popular-card">

                <figure class="card-img">
                  <img
                    src="https://images.unsplash.com/photo-1622397333309-3056849bc70b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8SGFydmFyZHxlbnwwfHwwfHx8MA%3D%3D"
                    alt="Burj khalifa, dubai" loading="lazy">
                </figure>

                <div class="card-content">

                  <div class="card-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <p class="card-subtitle">
                    <a href="#">Kolkata</a>
                  </p>

                  <h3 class="h3 card-title">
                    <a href="#">Harvard</a>
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet, consectetur adipisicing.
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="popular-card">

                <figure class="card-img">
                  <img
                    src="https://images.unsplash.com/photo-1605299670824-00515e81b924?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTN8fEhhcnZhcmR8ZW58MHx8MHx8fDA%3D"
                    alt="Kyoto temple, japan" loading="lazy">
                </figure>

                <div class="card-content">

                  <div class="card-rating">
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                    <ion-icon name="star"></ion-icon>
                  </div>

                  <p class="card-subtitle">
                    <a href="#">South 24 Pgs</a>
                  </p>

                  <h3 class="h3 card-title">
                    <a href="#">RKM </a>
                  </h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur.
                  </p>

                </div>

              </div>
            </li>

          </ul>

          <button class="btn btn-primary">More Schools</button>

        </div>
      </section>


      <div class="container">

      </div>
      </div>

      <section class="package" id="package">
        <div class="container">

          <p class="section-subtitle">Dont Hesitate to kickstart your Education Journey </p>

          <h2 class="h2 section-title">Apply @ Top Schools</h2>

          <p class="section-text">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Error voluptate modi corrupti nisi nihil quasi
            eaque harum fugiat qui doloribus?
          </p>

          <ul class="package-list">

            <li>
              <div class="package-card">

                <figure class="card-banner">
                  <img
                    src="https://images.unsplash.com/photo-1515542622106-78bda8ba0e5b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fEl0YWx5fGVufDB8fDB8fHww"
                    alt="Experience The Great Holiday On Beach" loading="lazy">
                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">D.H Bharat Sevasram Sangha Pranab Vidyapith</h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora maxime possimus numquam laboriosam
                    praesentium voluptatem? </p>

                    <p>Avialable Strems</p>
                  <ul class="card-meta-list">
                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="logo-react"></ion-icon>
                        <p class="text">Science</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="brush-outline"></ion-icon>                        
                      <p class="text">Arts</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="bar-chart-outline"></ion-icon>
                        <p class="text">Commerce</p>
                      </div>
                    </li>

                  </ul>

                </div>

                <div class="card-price">

                  <div class="wrapper">

                    <p class="reviews">Application Fees *</p>

                    <!-- <div class="card-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div> -->

                  </div>

                  <p class="price">
                    ₹750
                    <!-- <span>/ per person</span> -->
                  </p>

                  <button class="btn btn-secondary">Apply</button>

                </div>

              </div>
            </li>

            <li>
              <div class="package-card">

                <figure class="card-banner">
                  <img
                    src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                    alt="Summer Holiday To The Oxolotan River" loading="lazy">
                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">KakDwip Sundarban Adarsha Vidyapith</h3>

                  <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere, minus!
                  </p>
                  <p>Avialable Strems</p>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="logo-react"></ion-icon>
                        <p class="text">Science</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="brush-outline"></ion-icon>
                      <p class="text">Arts</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="bar-chart-outline"></ion-icon>
                        <p class="text">Commerce</p>
                      </div>
                    </li>

                  </ul>

                </div>

                <div class="card-price">

                  <div class="wrapper">

                    <p class="reviews">Application Fees *</p>

                    <!-- <div class="card-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div> -->

                  </div>

                  <p class="price">
                    ₹520
                    <!-- <span>/ per person</span> -->
                  </p>

                  <button class="btn btn-secondary">Apply</button>

                </div>

              </div>
            </li>

            <li>
              <div class="package-card">

                <figure class="card-banner">
                  <img
                    src="https://images.unsplash.com/photo-1520175480921-4edfa2983e0f?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                    alt="Santorini Island's Weekend Vacation" loading="lazy">
                </figure>

                <div class="card-content">

                  <h3 class="h3 card-title">Naba Pathabhawan School</h3>

                  <p class="card-text">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi, temporibus! </p>
<p>Avialable Strems</p>

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="logo-react"></ion-icon>
                        <p class="text">Science</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="brush-outline"></ion-icon>
                      <p class="text">Arts</p>
                      </div>
                    </li>

                    <li class="card-meta-item">
                      <div class="meta-box">
                      <ion-icon name="bar-chart-outline"></ion-icon>
                        <p class="text">Commerce</p>
                      </div>
                    </li>

                  </ul>

                </div>

                <div class="card-price">

                  <div class="wrapper">

                    <p class="reviews">Application Fees *</p>

                    <!-- <div class="card-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                    </div> -->

                  </div>

                  <p class="price">
                    ₹660
                    <!-- <span>/ per person</span> -->
                  </p>

                  <button class="btn btn-secondary">Apply</button>

                </div>

              </div>
            </li>

          </ul>
<p class="section-text">
<b>NOTE :</b> (*) Application fees are managed directly by the institutions; we ensure a hands-off approach to fee details.
</p>
<button class="btn btn-primary">View All Packages</button>

        </div>
      </section>





      <!-- 
        - #GALLERY
      -->

      <section class="gallery" id="gallery">
        <div class="container">

          <p class="section-subtitle">Photo Gallery</p>

          <h2 class="h2 section-title">Institutions Images</h2>

          <p class="section-text">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dicta voluptate, totam magnam natus sit!
          </p>

          <ul class="gallery-list">

            <li class="gallery-item">
              <figure class="gallery-image">
                <img
                  src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                  alt="Gallery image">
              </figure>
            </li>

            <li class="gallery-item">
              <figure class="gallery-image">
                <img
                  src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                  alt="Gallery image">
              </figure>
            </li>

            <li class="gallery-item">
              <figure class="gallery-image">
                <img
                  src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                  alt="Gallery image">
              </figure>
            </li>

            <li class="gallery-item">
              <figure class="gallery-image">
                <img
                  src="https://images.unsplash.com/photo-1707753911009-99d073f04fed?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDZ8fFBhcmlzaHxlbnwwfHwwfHx8MA%3D%3D"
                  alt="Gallery image">
              </figure>
            </li>

            <li class="gallery-item">
              <figure class="gallery-image">
                <img
                  src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                  alt="Gallery image">
              </figure>
            </li>

          </ul>

        </div>
      </section>





      <!-- 
        - #CTA
      -->

      <section class="cta" id="contact">
        <div class="container">

          <div class="cta-content">
            <p class="section-subtitle">Connect With Us</p>

            <h3 class="h2 section-title">Any Issues Needs to be resolved Soon ?</h3>

            <p class="section-text">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam eius obcaecati nulla suscipit temporibus
              a mollitia deserunt eum rem iste!
            </p>
          </div>

          <button class="btn btn-secondary">Contact Us !</button>

        </div>
      </section>

    </article>
  </main>



<?php include 'footer.php' ?>
  
  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up-outline"></ion-icon>
  </a>
  <script src="./assets/js/script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
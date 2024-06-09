<?php include ('favicon.php') ?>
<?php include ('header.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Haggle</title>

  <!-- 
    - favicon
  -->
  <!-- <link rel="shortcut icon" href="Assets/images/favicon.png" type="image/svg+xml"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="/Assets/css/style_listing_page.css">
  
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  

  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero" id="home">
        <div class="container">

          <h2 class="h1 hero-title">Apply @ New Schools</h2>

          <p class="hero-text">
            Ensure smooth application processing: Create separate accounts for each institution, then proceed to apply
            to each school individually. </p>
          <form action="/Complete_List.php" method="GET" style="padding-top: 8%;padding-bottom:8%;">
            <input type="text" name="search" id="search"
              style="padding: 16px;font-size: 18px; border-radius: 30px; border: 2px solid #ffffff;background-color: #ffffff; width: calc(100% - 160px); max-width: 600px; display: inline-block; box-shadow: 0px 2px 5px rgba(255, 255, 255, 0.1);"
              placeholder="Search Schools . . .">
            <button type="submit"
              style="margin-left:-9%; padding: 18px 34px; font-size: 18px;width:10%; border-top-right-radius: 30px;border-bottom-right-radius: 30px; background-color: #ff385c; color: #fff; display: inline-block; cursor: pointer; transition: background-color 0.3s ease;">Q</button>
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
            Ensure smooth application processing: <b>Create separate accounts for each institution,</b>then proceed to
            apply to each school individually. </p>

          <ul class="popular-list">

            <li>
              <div class="popular-card">

                <figure class="card-img">
                  <img
                    src="https://images.unsplash.com/photo-1613896527026-f195d5c818ed?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8c2Nob29sJTIwYnVpbGRpbmd8ZW58MHx8MHx8fDA%3D"
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
                    <a href="#">DHBSSPV</a>
                  </h3>

                  <p class="card-text">
                    Nurturing minds, fostering service, inspiring hearts.
                  </p>

                </div>

              </div>
            </li>

            <li>
              <div class="popular-card">

                <figure class="card-img">
                  <img
                    src="https://upload.wikimedia.org/wikipedia/commons/0/02/Ramakrishna_Belur_Math%2C_Howrah.jpg?20081010104934"
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
                    <a href="#">Belur</a>
                  </h3>

                  <p class="card-text">
                    <b>Spiritual sanctuary</b>,beacon of service, unity.
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
                    <a href="#">Sarisha RKM Sikshamansir</a>
                  </h3>

                  <p class="card-text">
                    Transforming lives, serving humanity, spiritual refuge.
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

          <h2 class="h2 section-title">Apply Nearby Schools</h2>

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
            <b>NOTE :</b> (*) Application fees are managed directly by the institutions; we ensure a hands-off approach
            to fee details.
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
  <script src="script.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
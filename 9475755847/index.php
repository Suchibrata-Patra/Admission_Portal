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
    <link rel="shortcut icon" href="../favicon.png" type="image/svg+xml">

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="../style.css">

    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body id="top">



    <header class="header" data-header>

        <div class="overlay" data-overlay></div>

        <div class="header-top">
            <div class="container">

                <a href="tel:+01123456790" class="helpline-box">

                    <div class="icon-box">
                        <ion-icon name="call-outline"></ion-icon>
                    </div>

                    <div class="wrapper">
                        <p class="helpline-title" style="color: black;">For Further Inquires :</p>

                        <p class="helpline-number" style="color: black;">+91 9475755847</p>
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
                            <a href="#" class="navbar-link" data-nav-link>Diamond Harbour Bharat Sevasram Sangha Pranab Vidyapith (H.S)</a>
                        </li>
                    </ul>

                </nav>

                <a href="login.php"><button class="btn btn-primary">Login</button></a>

            </div>
        </div>

    </header>





    <main>
        <article>

            <section class="popular" id="destination" style="margin-top: 1%;">

            </section>


            <div class="container">

            </div>
            </div>

            <section class="package" id="package">
                <div class="container" style="margin-top: -10%;">
                    <p class="section-subtitle">Search Results for -
                        <b><?php echo htmlspecialchars($search); ?></b>
                    </p>

                    <div style="width: 100%; max-width: 100%; text-align: center;">
                        <form action="#" method="GET"
                            style="padding-top: 1.5%; padding-bottom: 2%; display: flex; justify-content: center; align-items: center;">
                            <input type="text" name="search" id="search"
                                style="padding: 16px; font-size: 18px; border-radius: 30px; border: 1.5px solid #588cd0; background-color: #fafafa; width: calc(100% - 160px); max-width: 600px; box-shadow: 0px 2px 5px rgba(118, 174, 224, 0.1); margin-right: 10px;"
                                placeholder="Search Schools. . . "
                                value="<?php echo htmlspecialchars($search); ?>">
                                <button type="submit"
              style="margin-left:-10%; padding: 18px 34px; font-size: 18px;border-top-right-radius: 30px;border-bottom-right-radius: 30px; background-color: #FF5A5F; color: #fff; display: inline-block; cursor: pointer; transition: background-color 0.3s ease;">Search</button>
                        </form>
                    </div>

                    <!-- Search form -->
                    <?php if(isset($_GET['search'])): ?>
                    <!-- <p class="section-subtitle">Search Results for "<?php echo htmlspecialchars($search); ?>"</p> -->
                    <h2 class="h3 section-title">Search School Names</h2>

                    <ul class="package-list">
                        <?php foreach($schools as $school): ?>
                        <li>
                            <div class="package-card">
                                <figure class="card-banner">
                                    <img src="https://images.unsplash.com/photo-1515542622106-78bda8ba0e5b?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MjB8fEl0YWx5fGVufDB8fDB8fHww"
                                        alt="Experience The Great Holiday On Beach" loading="lazy">
                                </figure>
                                <!-- School details -->
                                <div class="card-content">
                                    <p class="section-subtitle">UDISE CODE - <?php echo $school['udise_id']; ?> </p>
                                    <h3 class="h3 card-title">
                                        <?php echo $school['school_name']; ?>
                                    </h3>
                                    <p>Available Streams</p>
                                    <ul class="card-meta-list">
                                        <li class="card-meta-item">
                                            <div class="meta-box">
                                                <ion-icon name="time"></ion-icon>

                                                <p class="text">Science</p>
                                            </div>
                                        </li>

                                        <li class="card-meta-item">
                                            <div class="meta-box">
                                                <ion-icon name="people"></ion-icon>

                                                <p class="text">Arts</p>
                                            </div>
                                        </li>

                                        <li class="card-meta-item">
                                            <div class="meta-box">
                                                <ion-icon name="location"></ion-icon>

                                                <p class="text">Commerce</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-price">
                                    <a href="<?php echo $school['udise_id']; ?>"><button
                                            class="btn btn-secondary">Apply</button></a>
                                </div>

                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <!-- View all packages button -->
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
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem dicta voluptate, totam
                        magnam natus sit!
                    </p>

                    <ul class="gallery-list">

                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                                    alt="Gallery image">
                            </figure>
                        </li>

                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                                    alt="Gallery image">
                            </figure>
                        </li>

                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
                                    alt="Gallery image">
                            </figure>
                        </li>

                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="https://images.unsplash.com/photo-1707753911009-99d073f04fed?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NDZ8fFBhcmlzaHxlbnwwfHwwfHx8MA%3D%3D"
                                    alt="Gallery image">
                            </figure>
                        </li>

                        <li class="gallery-item">
                            <figure class="gallery-image">
                                <img src="https://images.unsplash.com/photo-1515859005217-8a1f08870f59?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8SXRhbHl8ZW58MHx8MHx8fDA%3D"
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
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam eius obcaecati nulla
                            suscipit temporibus
                            a mollitia deserunt eum rem iste!
                        </p>
                    </div>

                    <button class="btn btn-secondary">Contact Us !</button>

                </div>
            </section>

        </article>
    </main>





    <?php include '../footer.php' ?>



    <!-- 
    - #GO TO TOP
  -->

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>





    <!-- 
    - custom js link
  -->
    <script src="script.js"></script>

    <!-- 
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
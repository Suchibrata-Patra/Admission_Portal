<?php
include 'exception_handler.php';
include 'log.php'; // Include the secureLogger function
include 'favicon.php';
include 'database.php'; // Include database connection details securely

// Custom error handler function to convert PHP errors into exceptions
function customErrorHandler($errno, $errstr, $errfile, $errline) {
    // Log the error
    secureLogger("Error: $errstr in $errfile on line $errline", 'ERROR');
    // Return true to prevent PHP's default error handler from being called
    return true;
}

// Set custom error handler
set_error_handler('customErrorHandler');

$schools = array();
$institutions = array();
$search = '';

try {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        $search = htmlspecialchars(trim($search));

        $sql = "SELECT school_name, udise_id FROM edu_org_records WHERE school_name LIKE ? OR udise_id LIKE ?";
        $stmt = mysqli_prepare($db, $sql);

        if ($stmt) {
            $searchPattern = "%" . $search . "%";
            mysqli_stmt_bind_param($stmt, "ss", $searchPattern, $searchPattern);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $schools[] = $row;
                    $udiseid = $row['udise_id'];
                    $table_name = mysqli_real_escape_string($db, $udiseid . '_HOI_Login_Credentials');
                    $sql2 = "SELECT Institution_Name FROM `$table_name` WHERE HOI_UDISE_ID = ?";
                    $stmt2 = mysqli_prepare($db, $sql2);

                    if ($stmt2) {
                        mysqli_stmt_bind_param($stmt2, "s", $udiseid);
                        mysqli_stmt_execute($stmt2);
                        $result2 = mysqli_stmt_get_result($stmt2);

                        if ($result2) {
                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    // Store institution details
                                    $institutions[$udiseid] = $row2;
                                }
                            } else {
                                $institutions[$udiseid] = "No additional details found for this school.";
                            }
                        } else {
                            secureLogger("Error executing query: " . mysqli_error($db), 'ERROR');
                        }

                        mysqli_stmt_close($stmt2);
                    } else {
                        secureLogger("Error preparing statement: " . mysqli_error($db), 'ERROR');
                    }
                }
            }else {
                secureLogger("Error executing query: " . mysqli_error($db), 'ERROR');
            }

            mysqli_stmt_close($stmt);
        }else {
            secureLogger("Error preparing statement: " . mysqli_error($db), 'ERROR');
        }    
    } 

} catch (Exception $e) {
    // Log any exceptions
    secureLogger("Exception: " . $e->getMessage(), 'ERROR');
}

// Close database connection
if (isset($db) && $db) {
    mysqli_close($db);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/Assets/images/favicon.png" type="image/svg+xml">
    <title>TheApplication - Centralised Admission Portal</title>

    <!-- SEO Meta Description -->
    <meta name="description"
        content="TheApplication is a centralized admission portal that simplifies the application process for students applying to various educational institutions. Access important information, application deadlines, and required documentation all in one place.">


    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">

    <link rel="preload"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="preload" href="/Assets/images/Hero_Section_Background_Image.webp" as="image" type="image/webp">
    <link rel="stylesheet" href="/Assets/css/style.css">
</head>

<body id="top">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KSV7GPM5" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


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
                            <a href="/index.php" class="navbar-link" data-nav-link>home</a>
                        </li>

                        <li>
                            <a href="#" class="navbar-link" data-nav-link>about us</a>
                        </li>

                        <li>
                            <a href="#destination" class="navbar-link" data-nav-link>destination</a>
                        </li>

                        <li>
                            <a href="#package" class="navbar-link" data-nav-link>packages</a>
                        </li>

                        <li>
                            <a href="#gallery" class="navbar-link" data-nav-link>gallery</a>
                        </li>

                        <li>
                            <a href="#contact" class="navbar-link" data-nav-link>contact us</a>
                        </li>

                    </ul>

                </nav>

                <button class="btn btn-primary">Apply</button>

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
                        <b>
                            <?php echo htmlspecialchars($search); ?>
                        </b>
                    </p>

                    <div style="width: 100%; max-width: 100%; text-align: center;">
                        <form action="#" method="GET"
                            style="padding-top: 1.5%; padding-bottom: 2%; display: flex; justify-content: center; align-items: center;">
                            <input type="text" name="search" id="search"
                                style="padding: 16px; font-size: 18px; border-radius: 30px; border: 1.5px solid #588cd0; background-color: #fafafa; width: calc(100% - 160px); max-width: 600px; box-shadow: 0px 2px 5px rgba(118, 174, 224, 0.1); margin-right: 10px;"
                                placeholder="Search Schools. . . " value="<?php echo htmlspecialchars($search); ?>"
                                pattern="^[a-zA-Z0-9.\- ]*$"
                                title="Only letters, numbers, spaces, dots, and hyphens are allowed.">

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
                                    <p class="section-subtitle">UDISE CODE -
                                        <?php echo $school['udise_id']; ?>
                                    </p>
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
                    <!-- <button class="btn btn-primary">View All Institutions</button> -->
                    <a href="Available_Institutions.php">
                        <button class="btn btn-primary">View All Institutions</button>
                    </a>
                    
                </div>
            </section>
        </article>
    </main>

    <!-- 
    - #GO TO TOP
  -->

    <a href="#top" class="go-top" data-go-top>
        <ion-icon name="chevron-up-outline"></ion-icon>
    </a>


    <!-- 
    - ionicon link
  -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
<?php include ('footer.php') ?>
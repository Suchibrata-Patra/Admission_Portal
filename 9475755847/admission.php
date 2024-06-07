<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DHBSSPV</title>
    <link rel="shortcut icon" href="../../Assets/images/favicon.png" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="preload" as="image" href="../assets/images/hero-banner.png">
    <link rel="preload" as="image" href="../assets/images/hero-abs-1.png" media="min-width(768px)">
    <link rel="preload" as="image" href="../assets/images/hero-abs-2.png" media="min-width(768px)">
    <link rel="stylesheet" href="./Assets/css/style.css">

    <style>
        .login-container {
            margin-top: 50px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            /* Shadow effect */
            border-radius: 10px;
            /* Rounded corners */
            padding: 10%;
            /* Padding for spacing */
            background-color: #fff;
            /* White background */
        }

        h3 {
            color: #706c6c;
            /* Dark grey text color */
            text-align: center;
            margin-bottom: 30px;
            /* Margin at the bottom of the heading */
        }

        hr {
            border-top: 1px solid #ddd;
            margin-bottom: 20px;
            /* Margin at the bottom of the horizontal line */
        }

        .form-control {
            border-radius: 2px;
            border: 1px solid #ddd;
            font-size: 15px;
        }

        .btn-primary {
            background-color: #fd5c63;
            /* Airbnb's red color */
            border: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #eb4248;
            /* Lighter red on hover */
        }

        .signup-link {
            text-align: center;
            /* Center the signup link */
            margin-top: 20px;
            /* Space between button and link */
        }

        a:hover {
            text-decoration: underline;
        }

        body {
            font-family: 'Urbanist', sans-serif;
            background-color: #f8f9fa;
        }

        .section-title {
            font-size: 2em;
            font-weight: 700;
            margin-bottom: 20px;
            text-align: center;
            color: #007bff;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 1.5em;
            /* Increased font size */
            font-weight: 600;
            margin-bottom: 15px;
            padding-left: 1.5%;
        }

        .table {
            margin-bottom: 0;
            background-color: #fff;
        }

        .table thead th {
            background-color: #9BB0C1;
            border: none;
            color: #ffffff;
            font-weight: 600;
            padding: 15px;
            /* Increased padding */
        }

        .table tbody tr {
            transition: background-color 0.3s ease;
            background-color: #FEFAF6;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table tbody td {
            border: none;
            padding: 15px;
            /* Increased padding */
            font-size: 1em;
            /* Increased font size */
        }

        .table-responsive {
            overflow-x: auto;
        }

        .back-top-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
            padding: 10px;
            display: none;
        }

        .back-top-btn:active {
            transform: translateY(2px);
        }

        .section-subtitle {
            padding-top: 7%;
        }

        @media only screen and (max-width: 768px) {
            .section-subtitle {
                margin-top: 20%;
            }
        }

        .list-group-item a {
            color: rgb(227, 80, 80);
            /* Bootstrap primary color */
            text-decoration: none;
        }

        .list-group-item a:hover {
            text-decoration: underline;
        }

        .list-group-item {
            background-color: #f5f2e1;
            /* Light grey background */
            border-color: #d9d565;
            /* Border color */
        }

        .list-group-item:nth-child(odd) {
            background-color: #ece3bd;
            /* Slightly darker grey for odd items */
        }
    </style>
</head>

<body id="top">

    <!-- # HEADER -->
    <?php include('site_header.php') ?>

    <!-- # sSEARCH BOX -->

    <div class="search-container" data-search-box>
        <div class="container">

            <button class="search-close-btn" aria-label="Close search" data-search-toggler>
                <ion-icon name="close-outline"></ion-icon>
            </button>
            <div class="search-wrapper">
                <input type="search" name="search" placeholder="Search Here..." aria-label="Search"
                    class="search-field">

                <button class="search-submit" aria-label="Submit" data-search-toggler>
                    <ion-icon name="search-outline"></ion-icon>
                </button>
            </div>

        </div>
    </div>

    <main>
        <articlen>
            <section class="section course" id="courses" aria-label="course"
                style="background-image: url('./assets/images/course-bg.jpg'); padding: 40px 0.05%;">
                <div class="container">
                    <p class="section-subtitle"
                        style="padding-top:7%; @media only screen and (max-width: 768px) { margin-top: 20%; }">Online
                        Admission Portal</p>

                    <h2 class="h2 section-title" style="color: black;">Admission 2024</h2>
                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Important Dates</h5>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Procedures</th>
                                                    <th scope="col">Dates</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Online Application <b style="color:#fd5c63">Starts</b></td>
                                                    <td>10th May 2024</td>
                                                </tr>
                                                <tr>
                                                    <td>Online Application <b style="color:#fd5c63"><u>Closes</u></b>
                                                    </td>
                                                    <td>20th May 2024</td>
                                                </tr>
                                                <tr>
                                                    <td><b style="color:#fd5c63">1st</b> Merit List</td>
                                                    <td>25th June 2024</td>
                                                </tr>
                                                <tr>
                                                    <td>Admission Starts For <b style="color:#fd5c63">1st List</b></td>
                                                    <td>26th June 2024</td>
                                                </tr>
                                                <tr>
                                                    <td>Last Date for <b style="color:#fd5c63"><u>Admission</u></b></td>
                                                    <td>25th June 2024</td>
                                                </tr>
                                                <tr>
                                                    <td>Second List <b>( If Any)</b></td>
                                                    <td style="color: #fd5c63;">Will be Notified</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <center>Applicant Login</center>
                                    </h5>
                                    <div class="table-responsive">
                                        <form method="post" action="login.php">
                                            <?php include('errors.php'); ?>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label"
                                                    style="margin-bottom:-1.1px;padding-left:6px;padding-right:6px;background-color: #d3d6f2;color:black;">Email
                                                    Address</label>
                                                <input type="email" name="email" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                    placeholder="Enter your email">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label"
                                                    style="margin-bottom:-1.1px;padding-left:6px;padding-right:6px;background-color: #d3d6f2;color:black;">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="exampleInputPassword1" placeholder="Enter your password">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="showPasswordCheck">
                                                    <label class="form-check-label" for="showPasswordCheck">
                                                        Show Password
                                                    </label>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary" name="login_user"
                                                style=" ">Login</button>
                                            <div class="signup-link">
                                                <a href="signup.php">New Here? Sign Up</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-left: 3%;">Instructions</h5>
                                    <p
                                        style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
                                    <h3 style="font-size: 20px;">Required Documents</h3>
                                    <div class="container">
                                        <table class="table table-striped"
                                            style="border-collapse: collapse; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="padding: 8px;">Document</th>
                                                    <th scope="col" style="padding: 8px;">Max Size</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding: 8px;">Passport Size Photo</td>
                                                    <td style="padding: 8px;">80 Kb</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 8px;">Aadhar Card</td>
                                                    <td style="padding: 8px;">80 Kb</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 8px;">Madhyamik Marksheet</td>
                                                    <td style="padding: 8px;">80 Kb</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 8px;">Madhyamik Certificate</td>
                                                    <td style="padding: 8px;">80 Kb</td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 8px;">Personal Signature</td>
                                                    <td style="padding: 8px;">80 Kb</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    </p>
                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="padding-left: 3%;">Contact Details</h5>
                                    <div class="container">
                                        <div class="table-responsive"> <!-- Added Bootstrap class for responsiveness -->
                                            <table class="table table-striped"
                                                style="border-collapse: collapse; width: 100%;">
                                                <tbody>
                                                    <tr>
                                                        <td style="padding: 8px;"><ion-icon name="mail-outline"
                                                                style="vertical-align: middle; display: inline-block;"></ion-icon>
                                                            <b
                                                                style="display: inline-block; vertical-align: middle;"></b>
                                                        </td>
                                                        <td style="padding: 8px;">Patra.group.official@gmail.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 8px;"><ion-icon name="call-outline"
                                                                style="vertical-align: middle; display: inline-block;"></ion-icon>
                                                            <b
                                                                style="display: inline-block; vertical-align: middle;"></b>
                                                        </td>
                                                        <td style="padding: 8px;">+91 947575547</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="padding: 8px;"><ion-icon name="logo-whatsapp"
                                                                style="vertical-align: middle; display: inline-block;"></ion-icon>
                                                            <b
                                                                style="display: inline-block; vertical-align: middle;"></b>
                                                        </td>
                                                        <td style="padding: 8px;">+91 8145302135</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" style="display: flex; align-items: center;">
                                        <div
                                            style="background-color: #EADFB4; border-radius: 3px;padding-top:7.3px;padding-bottom: 7.3px;padding-left: 6px;">
                                            <ion-icon name="list-outline" style="margin-right: 8px;"></ion-icon>
                                        </div>
                                        <div style="margin-left: 5px;">Merit List</div>
                                    </h5>
                                    <?php
                                    // Directory path
                                    $directory = './HOI_signin/Merit_Lists/';
            
                                    // Scan the directory for files
                                    $files = array_diff(scandir($directory), array('..', '.'));
            
                                    // Check if there are any files in the directory
                                    if (count($files) > 0) {
                                        $hasPdf = false;
                                        $listCounter = 1;
                                        echo '<ul class="list-group">';
                                        foreach ($files as $file) {
                                            if (pathinfo($file, PATHINFO_EXTENSION) == 'pdf') {
                                                $hasPdf = true;
                                                echo '<li class="list-group-item">
                                                        <a href="' . $directory . $file . '">Merit List ' . $listCounter . '</a>
                                                      </li>';
                                                $listCounter++;
                                            }
                                        }
                                        echo '</ul>';
                                        if (!$hasPdf) {
                                            echo '<p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
                                                    No List is Published Yet
                                                  </p>';
                                        }
                                    } else {
                                        echo '<p style="text-align: justify; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; margin: 20px;">
                                                No List is Published Yet
                                              </p>';
                                    }
                                    ?>
                                </div>
                            </div>

                            <br>
                            <div class="card"
                                style="background-color: #ffffff; border: none; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 100%; max-width: 400px; border-radius: 8px; overflow: hidden;">
                                <div class="card-body" style="padding: 20px;">
                                    <h3>Eligibility Criteria</h3>
                                    <ul style="list-style-type: none; padding: 0;">
                                        <li
                                            style="background-color: #eff0f1; margin-bottom: 8px; padding: 10px; padding-left: 20px; border-radius: 5px; box-shadow: inset 0 0 5px rgba(0,0,0,0.03); position: relative;">
                                            <span style="position: absolute; left: 10px;">•</span>You must pass all the
                                            papers in the 10th level board exams.
                                        </li>
                                        <li
                                            style="background-color: #eff0f1; margin-bottom: 8px; padding: 10px; padding-left: 20px; border-radius: 5px; box-shadow: inset 0 0 5px rgba(0,0,0,0.03); position: relative;">
                                            <span style="position: absolute; left: 10px;">•</span> Successful completion
                                            of the 10th grade board exams with passing grades in all subjects is a
                                            prerequisite for admission to Class XI.
                                        </li>
                                        <li
                                            style="background-color: #eff0f1; margin-bottom: 8px; padding: 10px; padding-left: 20px; border-radius: 5px; box-shadow: inset 0 0 5px rgba(0,0,0,0.03); position: relative;">
                                            <span style="position: absolute; left: 10px;">•</span> Candidates should
                                            maintain continuous academic engagement and should not have a gap in studies
                                            exceeding two years prior to seeking admission.
                                        </li>
                                        <li
                                            style="background-color: #eff0f1; margin-bottom: 8px; padding: 10px; padding-left: 20px; border-radius: 5px; box-shadow: inset 0 0 5px rgba(0,0,0,0.03); position: relative;">
                                            <span style="position: absolute; left: 10px;">•</span> Prospective students
                                            are expected to continue their formal education beyond the 10th grade in
                                            order to be eligible for admission to Class XI.
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>

                </div>
            </section>
            <section class="section event" id="event" aria-label="event">
                <!-- Event section content -->
            </section>
        </articlen>
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

    <script src="./Assets/js/script.js" defer></script>


    <!-- 
    - ionicon link
    -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script>
        // Show or hide the back-to-top button based on scroll position
        window.addEventListener('scroll', function () {
            const backToTopBtn = document.querySelector('.back-top-btn');
            if (window.scrollY > 200) {
                backToTopBtn.style.display = 'block';
            } else {
                backToTopBtn.style.display = 'none';
            }
        });
    </script>
    <script>
        document.getElementById('showPasswordCheck').addEventListener('click', function () {
            var passwordInput = document.getElementById('exampleInputPassword1');
            if (this.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    </script>


</body>

</html>
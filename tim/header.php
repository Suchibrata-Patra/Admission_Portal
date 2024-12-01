
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
        }

        .logo-img {
            width: 60%;
            height: auto;
        }

        .navbar {
            padding-top: 20px;
        }

        /* 
        .search-input {
            width: 100%;
            padding: 6px 12px;
            font-size: 14px;
            border-radius: 50px;
            border: 2.5px solid #fff;
            background-color: rgb(242, 242, 247);
        }

        .search-input:focus {
            border: 2.5px solid #f6dcf5;
            background-color: rgb(255, 255, 255);
        }

        .search-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            font-weight: 500;
            color: #ffffff;
            background-color: rgb(235, 75, 136);
            padding: 8px;
            border-radius: 50%;
        } */

        .dropdown-menu a:hover,
        .navbar-nav .nav-link:hover {
            background-color: #f1f1f1;
        }

        .nav-link {
            color: black;
        }

        .nav-link:hover {
            background-color: #faf9f9;
            border-radius: 5px;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #c33535;
        }

        /* Move profile icon to the left */
        .dropdown.ms-lg-3 {
            margin-left: 10px;
            /* Decrease this value to move icon more to the left */
        }

        .dropdown-menu {
            left: -120px;
            right: auto;
            max-width: 100vw;
            overflow-x: hidden;
        }

        /* Center navbar items for desktop */
        @media (min-width: 992px) {
            .navbar-nav {
                justify-content: center;
                width: 100%;
            }

            /* Center the navbar items and profile icon */
            .navbar-nav .nav-item {
                margin-left: 20px;
                margin-right: 20px;
            }

            .navbar-nav .nav-item.dropdown {
                margin-right: 20px;
                /* Make dropdowns more compact */
            }

            .navbar-brand {
                margin-right: auto;
            }

            .logo-img {
                margin-left: 40%;

            }
        }

        /* Optional: For mobile responsiveness */
        @media (max-width: 768px) {
            .search-bar {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container-fluid">
            <!-- Logo and Brand Name -->
            <a class="navbar-brand d-flex align-items-center" href="index">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/63/The_application.in_navbara_icon.png/220px-The_application.in_navbara_icon.png"
                    alt="Logo" class="logo-img">
            </a>

            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto"> <!-- Center navbar items -->
                    <li class="nav-item">
                        <a class="nav-link" href="routine">Primary Routine</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">Generate</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="settingsDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Settings &#8595;
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="settingsDropdown">
                            <li><a class="dropdown-item" href="settings-general.php">General</a></li>
                            <li><a class="dropdown-item" href="settings-security.php">Security</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="contactDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Contact &#8595;
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="contactDropdown">
                            <li><a class="dropdown-item" href="contact-support.php">Support</a></li>
                            <li><a class="dropdown-item" href="contact-feedback.php">Feedback</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li>
                        <div class="dropdown ms-lg-3">
                            <button class="btn dropdown-toggle" type="button" id="profileDropdown"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="https://media.licdn.com/dms/image/v2/D5603AQFzPaXXEzjdCQ/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1722660851705?e=2147483647&v=beta&t=C8bcnhwSyRShM_OBBYJXd0OKsXkqnid1y97kp6OkBGI"
                                    alt="Profile" class="profile-img">
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="#">View Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
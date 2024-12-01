<style>
    /* * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        } */
    body {
        font-family: 'Poppins';
        /* background-color: #f4f7fc; */
        color: #333;
    }

    /* Navbar styles */
    .navbar {
        background-color: #ffffff;
        padding: 8px 32px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        /* Ensure it sticks to the top */
        z-index: 1000;
        /* Ensures the navbar stays on top of other content */
        width: 100%;
        /* Ensure it spans the full width */
        /* Optional: box shadow to create a floating effect */
    }


    .navbar-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .logo {
        display: flex;
        align-items: center;
        text-decoration: none;
    }

    .logo-img {
        width: 70%;
        height: auto;
        margin-right: 12px;
        padding-left: 10%;
        padding-top: 5%;
        padding-bottom: 5%;
    }

    .logo-text {
        font-size: 15px;
        font-weight: 300;
        color: #333;
        line-height: 15px;
    }

    /* Navbar links */
    .navbar-links {
        list-style: none;
        display: flex;
        gap:auto;
        justify-content: center;
        position: relative;
        font-weight: 400;
        font-size: 14px;
    }

    .navbar-links li {
        font-size: 16px;
        position: relative;
    }

    .navbar-links a {
        text-decoration: none;
        color: #000000;
        padding: 10px 18px;
        border-radius: 5px;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .navbar-links a:hover {
        background-color: #f0f0f0;
        color: #000000;
    }

    /* Popup menu styles */
    .popup-menu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background-color: #ffffff;
        color: #333;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 180px;
        z-index: 100;
    }

    .popup-menu a {
        padding: 12px 18px;
        display: block;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s ease;
    }

    .popup-menu a:hover {
        background-color: #f1f1f1;
    }

    .navbar-links li:hover .popup-menu {
        display: block;
    }

    /* Profile and Dropdown */
    .navbar-user {
        display: flex;
        align-items: center;
        position: relative;
    }

    .user-profile {
        padding-right: 20px;
    }

    .profile-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ddd;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-btn {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        padding: 5px 7px;
        border-radius: 50%;
        transition: background-color 0.3s ease;
    }

    .dropdown-btn:hover {
        background-color: #f0f0f0;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #ffffff;
        color: #333;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 180px;
        z-index: 100;
    }

    .dropdown-content a {
        padding: 12px 18px;
        display: block;
        text-decoration: none;
        color: #333;
        transition: background-color 0.3s ease;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Search Bar styles */
    .search-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        width: 400px;
    }

    .search-input {
        width: 100%;
        padding: 8px 15px;
        font-size: 14px;
        border-radius: 50px;
        border: 2.5px solid rgb(255, 255, 255);
        outline: none;
        transition: border-color 0.3s;
        line-height: 37px;
        background-color: rgb(242, 242, 247);
    }

    .search-input:focus {
        border: 2.5px solid rgb(246, 220, 245);
        background-color: rgb(255, 255, 255);

    }

    .search-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
        font-weight: 500;
        color: #ffffff;
        background-color: rgb(235, 75, 136);
        padding: 10px;
        border-radius: 50px;
    }

    /* Hover effect for profile image */
    .dropdown:hover .dropdown-content {
        display: block;
    }

   /* Hamburger Menu */
.hamburger {
    display: none;
    flex-direction: column;
    cursor: pointer;
    margin-right: 10px;
}

.hamburger span {
    background-color: #333;
    height: 3px;
    width: 25px;
    margin: 3px 0;
    border-radius: 3px;
}

/* Mobile View Adjustments */
@media (max-width: 768px) {
    .navbar-links {
        display: none;
        flex-direction: column;
        width: 100%;
        background-color: #ffffff;
        position: absolute;
        top: 60px; /* Adjust based on the navbar height */
        left: 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .navbar-links.active {
        display: flex;
    }

    .hamburger {
        display: flex;
    }

    .search-bar {
        display: none; /* Hide search bar for smaller screens */
    }
}


</style>
<header>
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Logo -->
            <a href="index" class="logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/63/The_application.in_navbara_icon.png/220px-The_application.in_navbara_icon.png"
                    alt="Logo" class="logo-img">
            </a>

            <!-- Hamburger Menu -->
            <div class="hamburger" id="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Navbar Links -->
            <ul class="navbar-links" id="nav-links">
                <li><a href="routine">Primary Routine</a></li>
                <li><a href="select.php">Generate</a></li>
                <li>
                    <a href="settings.php">Settings &#8595;</a>
                    <div class="popup-menu">
                        <a href="settings-general.php">General</a>
                        <a href="settings-security.php">Security</a>
                    </div>
                </li>
                <li>
                    <a href="contact.php">Contact &#8595;</a>
                    <div class="popup-menu">
                        <a href="contact-support.php">Support</a>
                        <a href="contact-feedback.php">Feedback</a>
                    </div>
                </li>
            </ul>

            <!-- Profile Icon -->
            <div class="navbar-user">
                <div class="dropdown">
                    <div class="dropdown-btn">
                        <img src="https://media.licdn.com/dms/image/v2/D5603AQFzPaXXEzjdCQ/profile-displayphoto-shrink_200_200/profile-displayphoto-shrink_200_200/0/1722660851705?e=2147483647&v=beta&t=C8bcnhwSyRShM_OBBYJXd0OKsXkqnid1y97kp6OkBGI"
                            alt="Profile" class="profile-img">
                    </div>
                    <div class="dropdown-content">
                        <a href="#">View Profile</a>
                        <a href="#">Settings</a>
                        <a href="#">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
<script>
    document.getElementById('hamburger-menu').addEventListener('click', function () {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
});

</script>
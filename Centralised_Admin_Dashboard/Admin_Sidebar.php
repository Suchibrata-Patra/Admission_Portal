
<section id="sidebar">
    <a href="#" class="brand">
        <span class="text"><img src="https://theapplication.in/wp-content/uploads/2024/10/the_application.in_navbara_icon.png" alt="" srcset="" style="width:70%;height:auto;padding-top:15%;padding-left:10%;"></span>
    </a>
    <ul class="side-menu top">
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'index.php') ? 'class="active"' : ''; ?>>
            <a href="index.php">
                <i class='bx'><span class="material-symbols-outlined">dashboard</span></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'Enroll_New_Institutions.php') ? 'class="active"' : ''; ?>>
            <a href="Enroll_New_Institutions.php">
                <i class='bx'><span class="material-symbols-outlined">how_to_reg</span></i>
                <span class="text">Register</span>
            </a>
        </li>
        
        




    </ul>
    <ul class="side-menu">
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_School_Preferences.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_School_Preferences.php">
            <i class='bx'> <span class="material-symbols-outlined">settings</span> </i>
            <span class="text">School Preferences</span>
            </a>
        </li>
        <li>
            <a href="HOI_Logout.php" class="logout">
            <i class='bx'><span class="material-symbols-outlined">Logout</span></i>
            <span class="text">Logout</span>
            </a>
        </li>
        <li>
        <a href="../../../../about_us.php">
        <i class='bx'><span class="material-symbols-outlined">group</span></i>
                <span class="text">About Us</span>
        </a>
        </li>
    </ul>

</section>
<?php
// End PHP code
?>

<?php
require_once 'HOI_session.php';
?>
<section id="sidebar">
    <a href="#" class="brand">
        <i class='bx bxs-smile'></i>
        <span class="text">Haggle</span>
    </a>
    <ul class="side-menu top">
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'index.php') ? 'class="active"' : ''; ?>>
            <a href="index.php">
                <i class='bx'><span class="material-symbols-outlined">dashboard</span></i>
                <span class="text">Dashboard</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Admission_Date.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Admission_Date.php">
                <i class='bx'><span class="material-symbols-outlined">calendar_month</span></i>
                <span class="text">Dates</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Bank_Details.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Bank_Details.php">
                <i class='bx'><span class="material-symbols-outlined">currency_rupee</span></i>
                <span class="text">Bank Acc.</span>
            </a>
        </li>
        <!-- <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Important_Dates.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Important_Dates.php">
                <i class='bx'><span class="material-symbols-outlined">schedule</span></i>
                <span class="text">Imp. Dates</span>
            </a>
        </li> -->
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Subject_Combo.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Subject_Combo.php">
                <i class='bx'><span class="material-symbols-outlined">auto_stories</span></i>
                <span class="text">Subject Combo</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Admit_Students.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Admit_Students.php">
                <!-- <i class='bx'><span class="material-symbols-outlined">info</span></i> -->
                <i class='bx'><span class="material-symbols-outlined">new_releases</span></i>
                <span class="text">Admit</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Final_List.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Final_List.php">
                <i class='bx'><span class="material-symbols-outlined">delete_forever</span></i>
                <span class="text">Revoke</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Admission_Merit_list.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Admission_Merit_list.php">
                <i class='bx'><span class="material-symbols-outlined">id_card</span></i>
                <span class="text">Merit List</span>
            </a>
        </li>

        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Teacher_Profiles.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Teacher_Profiles.php">
                <i class='bx bxs-group'></i>
                <span class="text">Stuents_Profile</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_School_Preferences.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_School_Preferences.php">
                <i class='bx bxs-cog'></i>
                <span class="text">School Preferences</span>
            </a>
        </li>
        <li>
            <a href="HOI_Logout.php" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Logout</span>
            </a>
        </li>
    </ul>
</section>
<?php
// End PHP code
?>

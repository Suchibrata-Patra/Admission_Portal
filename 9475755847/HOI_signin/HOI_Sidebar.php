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
                <span class="text">Admission Date</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Bank_Details.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Bank_Details.php">
                <i class='bx'><span class="material-symbols-outlined">currency_rupee</span></i>
                <span class="text">Bank Account</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Important_Dates.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Important_Dates.php">
                <i class='bx'><span class="material-symbols-outlined">schedule</span></i>
                <span class="text">Imp. Dates</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Subject_Combo.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Subject_Combo.php">
                <i class='bx'><span class="material-symbols-outlined">auto_stories</span></i>
                <span class="text">Subject Combo</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Short_Listing.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Short_Listing.php">
                <!-- <i class='bx'><span class="material-symbols-outlined">info</span></i> -->
                <i class='bx'><span class="material-symbols-outlined">id_card</span></i>
                <span class="text">Short List</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Mail.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Mail.php">
                <i class='bx'><span class="material-symbols-outlined">mail</span></i>
                <span class="text">Mail</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Merit_List.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Merit_List.php">
                <i class='bx'><span class="material-symbols-outlined">id_card</span></i>
                <span class="text">Merit List</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Updates.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Updates.php">
                <i class='bx'><span class="material-symbols-outlined">update</span></i>
                <span class="text">Updates</span>
            </a>
        </li>
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_Team.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_Team.php">
                <i class='bx bxs-group'></i>
                <span class="text">Team</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li <?php echo (basename(htmlspecialchars($_SERVER['PHP_SELF'])) === 'HOI_System_Preferences.php') ? 'class="active"' : ''; ?>>
            <a href="HOI_System_Preferences.php">
                <i class='bx bxs-cog'></i>
                <span class="text">System Preferences</span>
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

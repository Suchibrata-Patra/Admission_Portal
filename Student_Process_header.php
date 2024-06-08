<?php
// Define the cache file path and cache time
// $cacheFile = 'cache/welcome_page.html';
// $cacheTime = 3; // Cache for 1 hour

// // Ensure the cache directory exists and is writable
// if (!file_exists('cache')) {
//     mkdir('cache', 0777, true);
// }

// // Serve from the cache if it is still valid
// if (file_exists($cacheFile) && time() - filemtime($cacheFile) < $cacheTime) {
//     readfile($cacheFile);
//     exit;
// }

// // Start output buffering
// ob_start();
?>

<div class="header">
    <h2 style="margin: 0">
        Welcome
        <?php echo htmlspecialchars($user['fname']); ?>
    </h2>
    <a href="welcome.php?logout='1'" class="logout">Logout</a>
</div>

<?php
// // Get the output and save it to the cache file
// $output = ob_get_contents();
// if (file_put_contents($cacheFile, $output) === false) {
//     // Handle error in writing to cache file (optional)
//     error_log("Failed to write cache file: $cacheFile");
// }

// // End output buffering and flush the output
// ob_end_flush();
?>

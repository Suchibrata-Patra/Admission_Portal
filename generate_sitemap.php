<?php
// Base directory to scan
$baseDir = '.';

// Function to scan numeric directories with index.php inside
function scanNumericDirectoriesWithIndex($dir) {
    $result = [];
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        $filePath = $dir . '/' . $file;

        // Check if it's a directory with a numeric name
        if (is_dir($filePath) && is_numeric($file)) {
            // Check if index.php exists in the directory
            if (file_exists($filePath . '/index.php')) {
                $result[] = $filePath; // Add the directory to the result
            }
        }
    }
    return $result;
}

// Function to scan for .php files in the base directory, excluding the Assets folder
function scanPhpFiles($dir) {
    $result = [];
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        $filePath = $dir . '/' . $file;

        // Check if it's a file with .php extension and not in the Assets folder
        if (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'php' && strpos($filePath, '/Assets/') === false) {
            $result[] = $filePath; // Add the PHP file to the result
        }
    }
    return $result;
}

// Function to generate the sitemap XML with XSL reference
function generateSitemap($numericDirectories, $phpFiles) {
    // Fetch the current domain dynamically
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? "https" : "http";
    $domain = $protocol . "://" . $_SERVER['HTTP_HOST'];

    // Begin sitemap structure with XSL reference
    $sitemapContent = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
    $sitemapContent .= '<?xml-stylesheet type="text/xsl" href="sitemap.xsl"?>' . PHP_EOL;
    $sitemapContent .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

    // Add numeric directories with index.php
    foreach ($numericDirectories as $directory) {
        $url = htmlspecialchars($domain . '/' . basename($directory) . '/index.php');
        $lastmod = date('Y-m-d', filemtime($directory . '/index.php'));

        $sitemapContent .= '    <url>' . PHP_EOL;
        $sitemapContent .= '        <loc>' . $url . '</loc>' . PHP_EOL;
        $sitemapContent .= '        <lastmod>' . $lastmod . '</lastmod>' . PHP_EOL;
        $sitemapContent .= '        <changefreq>monthly</changefreq>' . PHP_EOL;
        $sitemapContent .= '        <priority>0.8</priority>' . PHP_EOL;
        $sitemapContent .= '    </url>' . PHP_EOL;
    }

    // Add PHP files in the base directory
    foreach ($phpFiles as $file) {
        $url = htmlspecialchars($domain . '/' . basename($file));
        $lastmod = date('Y-m-d', filemtime($file));

        $sitemapContent .= '    <url>' . PHP_EOL;
        $sitemapContent .= '        <loc>' . $url . '</loc>' . PHP_EOL;
        $sitemapContent .= '        <lastmod>' . $lastmod . '</lastmod>' . PHP_EOL;
        $sitemapContent .= '        <changefreq>monthly</changefreq>' . PHP_EOL;
        $sitemapContent .= '        <priority>0.6</priority>' . PHP_EOL;
        $sitemapContent .= '    </url>' . PHP_EOL;
    }

    $sitemapContent .= '</urlset>' . PHP_EOL;

    // Save the sitemap.xml file
    $sitemapFile = 'sitemap.xml';
    if (file_put_contents($sitemapFile, $sitemapContent)) {
        echo "Sitemap generated successfully! <a href='$sitemapFile'>View Sitemap</a>";
    } else {
        echo "Failed to generate sitemap.";
    }
}

// If form is submitted, run the directory and file scanning process
if (isset($_POST['scan'])) {
    // Scan numeric directories with index.php
    $numericDirectories = scanNumericDirectoriesWithIndex($baseDir);

    // Scan PHP files in the base directory
    $phpFiles = scanPhpFiles($baseDir);

    // Generate the sitemap
    generateSitemap($numericDirectories, $phpFiles);

    // Display the results
    echo "<h2>Numeric Directories with index.php:</h2><ul>";
    if (!empty($numericDirectories)) {
        foreach ($numericDirectories as $directory) {
            echo "<li>" . htmlspecialchars($directory) . "</li>";
        }
    } else {
        echo "<li>No numeric directories with index.php found.</li>";
    }
    echo "</ul>";

    echo "<h2>PHP files in the base directory:</h2><ul>";
    if (!empty($phpFiles)) {
        foreach ($phpFiles as $file) {
            echo "<li>" . htmlspecialchars($file) . "</li>";
        }
    } else {
        echo "<li>No PHP files found in the base directory.</li>";
    }
    echo "</ul>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory and File Scanner with Sitemap</title>
</head>
<body>
    <h1>Scan Numeric Directories and PHP Files, and Generate Sitemap</h1>
    <form method="POST">
        <button type="submit" name="scan">Scan & Generate Sitemap</button>
    </form>
</body>
</html>

<?php
// Base directory to scan
$baseDir = '.';
$imagesDir = 'Assets/Images';

// Function to scan numeric directories with index.php inside
function scanNumericDirectoriesWithIndex($dir) {
    $result = [];
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        $filePath = $dir . '/' . $file;

        // Check if it's a directory and has a numeric name
        if (is_dir($filePath) && is_numeric($file)) {
            // Check if index.php exists in the directory
            if (file_exists($filePath . '/index.php')) {
                $result[] = $filePath; // Add the directory to the result
            }
        }
    }
    return $result;
}

// Function to scan for images under Assets > Images
function scanImages($dir) {
    $result = [];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg']; // Allowed image extensions

    if (is_dir($dir)) {
        $files = scandir($dir);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') continue;
            $filePath = $dir . '/' . $file;

            // Check if it's a file and has an allowed image extension
            $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
            if (is_file($filePath) && in_array(strtolower($fileExtension), $allowedExtensions)) {
                $result[] = $filePath; // Add the image file to the result
            }
        }
    }
    return $result;
}

// Function to scan all HTML files and check for robots meta tag
function scanAllPages($dir) {
    $result = [];
    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

    foreach ($files as $file) {
        if ($file->isFile() && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            // Load the file and check for the robots meta tag
            $content = file_get_contents($file);
            if (strpos($content, '<meta name="robots" content="nofollow"') === false) {
                // If "nofollow" is not present, add the file to the result
                $result[] = $file->getPathname();
            }
        }
    }
    return $result;
}

// Function to generate the sitemap XML with XSL reference
function generateSitemap($numericDirectories, $images, $allPages) {
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

    // Add image URLs from Assets > Images
    foreach ($images as $image) {
        $url = htmlspecialchars($domain . '/' . $image);
        $lastmod = date('Y-m-d', filemtime($image));

        $sitemapContent .= '    <url>' . PHP_EOL;
        $sitemapContent .= '        <loc>' . $url . '</loc>' . PHP_EOL;
        $sitemapContent .= '        <lastmod>' . $lastmod . '</lastmod>' . PHP_EOL;
        $sitemapContent .= '        <changefreq>monthly</changefreq>' . PHP_EOL;
        $sitemapContent .= '        <priority>0.5</priority>' . PHP_EOL;
        $sitemapContent .= '    </url>' . PHP_EOL;
    }

    // Add all pages that are not set to nofollow
    foreach ($allPages as $page) {
        $url = htmlspecialchars($domain . '/' . basename($page));
        $lastmod = date('Y-m-d', filemtime($page));

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

// If form is submitted, run the directory and image scanning process
if (isset($_POST['scan'])) {
    // Scan numeric directories with index.php
    $numericDirectories = scanNumericDirectoriesWithIndex($baseDir);

    // Scan for images under Assets > Images
    $images = scanImages($imagesDir);

    // Scan all pages under the root directory
    $allPages = scanAllPages($baseDir);

    // Generate the sitemap
    generateSitemap($numericDirectories, $images, $allPages);

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

    echo "<h2>Images under Assets > Images:</h2><ul>";
    if (!empty($images)) {
        foreach ($images as $image) {
            echo "<li>" . htmlspecialchars($image) . "</li>";
        }
    } else {
        echo "<li>No images found under Assets > Images.</li>";
    }
    echo "</ul>";

    echo "<h2>All pages scanned (not nofollow):</h2><ul>";
    if (!empty($allPages)) {
        foreach ($allPages as $page) {
            echo "<li>" . htmlspecialchars($page) . "</li>";
        }
    } else {
        echo "<li>No pages found that allow crawling.</li>";
    }
    echo "</ul>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory and Image Scanner with Sitemap</title>
</head>
<body>
    <h1>Scan Numeric Directories and Images, and Generate Sitemap</h1>
    <form method="POST">
        <button type="submit" name="scan">Scan & Generate Sitemap</button>
    </form>
</body>
</html>

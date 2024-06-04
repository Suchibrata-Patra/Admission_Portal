<?php
header('Content-Type: application/xml; charset=utf-8');

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<?xml-stylesheet type="text/xsl" href="sitemap.xsl"?>'; // Link to the XSL Stylesheet
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// Function to add URL to the sitemap
function addUrl($loc, $priority, $changefreq, $lastmod = null) {
    echo '<url>';
    echo '<loc>' . htmlspecialchars($loc) . '</loc>';
    echo '<priority>' . $priority . '</priority>';
    echo '<changefreq>' . $changefreq . '</changefreq>';
    if ($lastmod) {
        echo '<lastmod>' . $lastmod . '</lastmod>';
    }
    echo '</url>';
}

// Base URL of your site
$baseUrl = 'https://www.example.com/';

// Static files to be included in the sitemap
$files = [
    'Complete_List.php' => ['priority' => '0.8', 'changefreq' => 'always'],
    'footer.php' => ['priority' => '0.5', 'changefreq' => 'always'],
    'index.php' => ['priority' => '1.0', 'changefreq' => 'always'],
    'privacy_policy.php' => ['priority' => '0.6', 'changefreq' => 'always'],
    'terms_and_conditions.php' => ['priority' => '0.6', 'changefreq' => 'always']
];

// Get the current date in ISO 8601 format
$lastmod = date('c');

// Add static files to the sitemap
foreach ($files as $file => $info) {
    addUrl($baseUrl . $file, $info['priority'], $info['changefreq'], $lastmod);
}

// Dynamically include folders with numerical names containing index.php
$folders = glob('*', GLOB_ONLYDIR);
foreach ($folders as $folder) {
    if (is_numeric($folder) && file_exists($folder . '/index.php')) {
        addUrl($baseUrl . $folder . '/index.php', '0.7', 'always', $lastmod);
    }
}

echo '</urlset>';
?>

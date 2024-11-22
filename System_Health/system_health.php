<?php
// Function to fetch the sitemap and extract URLs with .php extensions
function getPhpPagesFromSitemap($sitemapUrl) {
    $sitemapContent = @file_get_contents($sitemapUrl);

    if ($sitemapContent === false) {
        echo "<p>Unable to fetch the sitemap.</p>";
        return [];
    }

    $xml = simplexml_load_string($sitemapContent);

    if ($xml === false) {
        echo "<p>Invalid sitemap format.</p>";
        return [];
    }

    $phpUrls = [];
    foreach ($xml->url as $url) {
        $loc = (string)$url->loc;
        if (pathinfo($loc, PATHINFO_EXTENSION) === 'php') {
            $phpUrls[] = $loc;
        }
    }
    return $phpUrls;
}

// Function to check the status of a URL
function checkUrlStatus($url) {
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200') !== false) {
        return true; // Page is working
    }
    return false; // Page has an error
}

// Main Script Execution
$sitemapUrl = 'https://admission.theapplication.in/sitemap.xml';
$phpUrls = getPhpPagesFromSitemap($sitemapUrl);

if (empty($phpUrls)) {
    echo "<p>No .php pages found in the sitemap or sitemap unavailable.</p>";
    exit;
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>PHP Pages Status Checker</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .status-working { color: green; font-weight: bold; }
        .status-error { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <h1>PHP Pages Status Checker</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>URL</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>";

foreach ($phpUrls as $index => $url) {
    $status = checkUrlStatus($url) 
        ? "<span class='status-working'>&#x2714; Working</span>" 
        : "<span class='status-error'>&#x2022; Error</span>";
    echo "<tr>
            <td>" . ($index + 1) . "</td>
            <td><a href='$url' target='_blank'>$url</a></td>
            <td>$status</td>
          </tr>";
}

echo "    </tbody>
    </table>
</body>
</html>";

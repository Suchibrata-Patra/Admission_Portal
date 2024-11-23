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
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .status-card {
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin: 20px 0;
            padding: 20px;
        }
        .status-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e1e4e8;
            padding: 15px 0;
        }
        .status-row:last-child {
            border-bottom: none;
        }
        .url {
            font-size: 14px;
            color: #0366d6;
            text-decoration: none;
        }
        .status-indicator {
            display: flex;
            align-items: center;
        }
        .status-indicator span {
            margin-left: 8px;
            font-weight: bold;
        }
        .status-working {
            color: #2da44e;
        }
        .status-error {
            color: #d73a49;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6a737d;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>PHP Pages Status Checker</h1>
        <div class='status-card'>";

foreach ($phpUrls as $index => $url) {
    $status = checkUrlStatus($url);
    $statusClass = $status ? "status-working" : "status-error";
    $statusText = $status ? "Working" : "Error";
    echo "<div class='status-row'>
            <a href='$url' class='url' target='_blank'>$url</a>
            <div class='status-indicator'>
                <div class='$statusClass'>&#x25CF;</div>
                <span class='$statusClass'>$statusText</span>
            </div>
          </div>";
}

echo "    </div>
        <footer>For more details, refer to the system log or contact support.</footer>
    </div>
</body>
</html>";
?>

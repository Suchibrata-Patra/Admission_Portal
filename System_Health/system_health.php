<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/Assets/images/favicon.png" type="image/svg+xml">
    <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
    <title>System Health Checker</title>
</head>

<body>
    <h1>
        <center><span class='material-icons status-working'>check_circle</span><br>Site Health Checkup<p
                style="font-size:15px;font-weight:300;">Powered by TheApplication.in</p>
        </center>
    </h1>
</body>

</html>

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

// Main Script Executions
$sitemapUrl = __DIR__ . '/../sitemap.xml';
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
    <link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f8fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            max-width: 950px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            font-size: 24px;
            grid-column: span 2;
        }
        .status-item {
            display: flex;
            justify-content: space-between; /* Separate info and status indicator */
            align-items: center;
            padding: 15px;
            background-color: white;
            border: none;
            border-bottom: 0.5px solid rgb(226, 226, 226);
            border-right: 0.5px solid rgb(226, 226, 226);
        }
        .file-name {
            flex-grow: 1;
            font-weight:200px;
            font-size:15px;
        }
        .status-indicator {
            display: flex;
            align-items: center;
        }
        .status-working {
            color: green;
            font-size: 32px;
        }
        .status-error {
            color: red;
            font-size: 32px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6a737d;
            grid-column: span 2;
        }

        .info {
            text-align: left; /* Align text to the left */
         }

        .page-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px; /* Add space between title and filename */
        }

        .file-name {
        font-size: 14px;
        color: #555;
        }

        .status-indicator {
            font-size: 18px;
            color: #4caf50;
        }
        .status-error {
        color: #f44336;
        }
.status-warning {
    color: orange;
    font-size: 32px;
}
.status-indicator {
        position: relative; /* Make it the reference point for the tooltip */
    }

    .status-indicator .tooltip {
        display: none; /* Hidden by default */
        position: absolute;
        bottom: 100%; /* Position the tooltip above the icon */
        left: 50%;
        transform: translateX(-50%);
        background-color: #333;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 1000;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .status-indicator .tooltip::after {
        content: '';
        position: absolute;
        top: 100%; /* Place the arrow at the bottom of the tooltip */
        left: 50%;
        transform: translateX(-50%);
        border-width: 5px;
        border-style: solid;
        border-color: #333 transparent transparent transparent;
    }

    .status-indicator:hover .tooltip {
        display: block; /* Show tooltip on hover */
    }
    </style>
</head>
<body>
    <div class='container'>
        ";
        function checkResourceStatus($url) {
            $headers = @get_headers($url);
            if ($headers && strpos($headers[0], '200') !== false) {
                return true; // Resource is working
            }
            return false; // Resource is missing
        }
       // Main Script
foreach ($phpUrls as $url) {
    // Fetch the filename
    $fileName = basename($url);

    // Fetch page content and initialize variables
    $pageContent = @file_get_contents($url);
    $pageTitle = null;
    $pageDescription = null;
    $hasMissingResources = false; // Track if any linked resources are missing

    if ($pageContent) {
        // Use DOMDocument to parse the HTML
        $dom = new DOMDocument();
        libxml_use_internal_errors(true); // Suppress warnings for malformed HTML
        $dom->loadHTML($pageContent);

        // Extract the title
        $titles = $dom->getElementsByTagName('title');
        if ($titles->length > 0) {
            $pageTitle = $titles->item(0)->nodeValue;
        }

        // Extract the meta description
        $metaTags = $dom->getElementsByTagName('meta');
        foreach ($metaTags as $meta) {
            if (strtolower($meta->getAttribute('name')) === 'description') {
                $pageDescription = $meta->getAttribute('content');
                break; // Stop after finding the first description
            }
        }

        // Check linked resources (CSS and JS)
        $linkedResources = [];
        foreach ($dom->getElementsByTagName('link') as $link) {
            if ($link->getAttribute('rel') === 'stylesheet') {
                $linkedResources[] = $link->getAttribute('href');
            }
        }
        foreach ($dom->getElementsByTagName('script') as $script) {
            if ($script->hasAttribute('src')) {
                $linkedResources[] = $script->getAttribute('src');
            }
        }

        // Validate each linked resource
        foreach ($linkedResources as $resource) {
            $resourceUrl = $resource;
            // If the resource is a relative path, convert it to an absolute URL
            if (parse_url($resourceUrl, PHP_URL_SCHEME) === null) {
                $parsedUrl = parse_url($url);
                $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
                $resourceUrl = rtrim($baseUrl, '/') . '/' . ltrim($resource, '/');
            }

            if (!checkResourceStatus($resourceUrl)) {
                $hasMissingResources = true;
                break; // No need to check further if one resource is missing
            }
        }

        libxml_clear_errors();
    }

    // Determine the display text
    if ($pageDescription && str_word_count($pageDescription) > 3) {
        $displayText = $pageTitle ?? $fileName;
    } elseif ($pageDescription) {
        $displayText = $pageDescription;
    } else {
        $displayText = $fileName;
    }

    // Check page status and linked resource status
    $pageStatus = checkResourceStatus($url);
    $statusClass = $pageStatus
        ? ($hasMissingResources ? "status-warning" : "status-working")
        : "status-error";
    $statusIcon = $pageStatus
        ? ($hasMissingResources ? "warning" : "check_circle")
        : "cancel";


        // Check page status and linked resource status
$pageStatus = checkResourceStatus($url);
$statusClass = $pageStatus
    ? ($hasMissingResources ? "status-warning" : "status-working")
    : "status-error";
$statusIcon = $pageStatus
    ? ($hasMissingResources ? "warning" : "check_circle")
    : "cancel";

// Generate error message for the tooltip
$errorMessage = !$pageStatus 
    ? "Page is not accessible."
    : ($hasMissingResources 
        ? "Some linked resources are missing."
        : "Page is working fine.");

     // Validate each linked resource and track missing ones
$missingResources = [];
foreach ($linkedResources as $resource) {
    $resourceUrl = $resource;
    // Convert relative paths to absolute URLs
    if (parse_url($resourceUrl, PHP_URL_SCHEME) === null) {
        $parsedUrl = parse_url($url);
        $baseUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
        $resourceUrl = rtrim($baseUrl, '/') . '/' . ltrim($resource, '/');
    }

    if (!checkResourceStatus($resourceUrl)) {
        $missingResources[] = $resource; // Add missing resource to the list
        $hasMissingResources = true;
    }
}

// Generate error message for the tooltip
$errorMessage = !$pageStatus
    ? "Page is not accessible."
    : ($hasMissingResources
        ? "Missing resources: " . implode(', ', $missingResources)
        : "Page is working fine.");

// Display the chosen text, filename, and status with a tooltip
echo "<div class='status-item'>
        <div class='info'>
            <div class='page-title'>$displayText</div>
            <div class='file-name'>$fileName</div>
        </div>
        <div class='status-indicator'>
            <span class='material-icons $statusClass'>$statusIcon</span>
            <div class='tooltip'>$errorMessage</div>
        </div>
      </div>";

}

        
        
        
echo "    </div>
        <footer>For more details, refer to the system log or contact support.</footer>
    </div>
</body>
</html>";
?>
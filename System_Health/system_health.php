<?php include('favicon.php') ?>
<?php
// Function to fetch the sitemap and extract URLs with .php extensions
function getPhpPagesFromSitemap($sitemapUrl) {
    $sitemapContent = @file_get_contents($sitemapUrl);

    if ($sitemapContent === false) {
        echo '<p>Unable to fetch the sitemap.</p>';
        return [];
    }

    $xml = simplexml_load_string($sitemapContent);

    if ($xml === false) {
        echo '<p>Invalid sitemap format.</p>';
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
    echo '<p>No .php pages found in the sitemap or sitemap unavailable.</p>';
    exit;
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>PHP Pages Status Checker</title>
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
    </style>
</head>
<body>
    <div class='container'>
        <h1>PHP Pages Status Checker</h1>

        <?php
        foreach ($phpUrls as $url) {
            $fileName = basename($url);
            
            $htmlContent = @file_get_contents($url);
            
            if ($htmlContent === FALSE) {
                echo '<div class='status-item'>
                        <div class='file-name'>$fileName (Unable to fetch content)</div>
                        <div class='status-indicator'>
                            <span class='material-icons status-error'>cancel</span>
                        </div>
                      </div>';
                continue;
            }

            // Extract the title from the HTML content using regex
            preg_match('/<title>(.*?)<\/title>/is', $htmlContent, $matches);
            $titleName = isset($matches[1]) ? $matches[1] : 'Untitled';
            
            // Check the URL status (assuming checkUrlStatus is defined elsewhere)
            $status = checkUrlStatus($url);
            
            // Determine the status classes and icons
            $statusClass = $status ? 'status-working' : 'status-error';
            $statusIcon = $status ? 'check_circle' : 'cancel';
            
            // Output the HTML
            echo '<div class='status-item'>
                    <div class='file-name'>$titleName <br>$fileName</div>
                    <div class='status-indicator'>
                        <span class='material-icons $statusClass'>$statusIcon</span>
                    </div>
                  </div>';
        }
        ?>
        
    </div>
    <footer>For more details, refer to the system log or contact support.</footer>
</body>

</html>";
?>

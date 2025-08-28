<?php
/**
 * Open Graph Meta Tags Test Script
 * 
 * This script helps you test your Open Graph meta tags locally.
 * Run this script and then use the provided URLs to test sharing.
 */

// Get the current site URL
$site_url = 'http://localhost:8000';

// Test URLs
$test_urls = [
    'Homepage' => $site_url,
    'OG Test Page' => $site_url . '/og-test/',
];

// Facebook Debugger URL
$facebook_debugger = 'https://developers.facebook.com/tools/debug/';

// Twitter Card Validator URL
$twitter_validator = 'https://cards-dev.twitter.com/validator';

// LinkedIn Post Inspector
$linkedin_inspector = 'https://www.linkedin.com/post-inspector/';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Graph Meta Tags Test</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
            line-height: 1.6;
        }
        .header {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
        .test-section {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .test-section h2 {
            color: #495057;
            margin-top: 0;
        }
        .url-list {
            list-style: none;
            padding: 0;
        }
        .url-list li {
            background: #f8f9fa;
            padding: 1rem;
            margin: 0.5rem 0;
            border-radius: 4px;
            border-left: 4px solid #007bff;
        }
        .url-list a {
            color: #007bff;
            text-decoration: none;
            font-weight: 500;
        }
        .url-list a:hover {
            text-decoration: underline;
        }
        .tool-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        .tool-link {
            background: #007bff;
            color: white;
            padding: 0.75rem 1rem;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.2s;
        }
        .tool-link:hover {
            background: #0056b3;
            text-decoration: none;
            color: white;
        }
        .instructions {
            background: #e7f3ff;
            border-left: 4px solid #007bff;
            padding: 1rem;
            margin: 1rem 0;
        }
        .warning {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 1rem;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Open Graph Meta Tags Test</h1>
        <p>Use this page to test your Open Graph meta tags for mobile sharing previews.</p>
    </div>

    <div class="test-section">
        <h2>Test Your Site URLs</h2>
        <p>Click on these URLs to test your Open Graph meta tags:</p>
        <ul class="url-list">
            <?php foreach ($test_urls as $name => $url): ?>
                <li>
                    <strong><?php echo htmlspecialchars($name); ?>:</strong>
                    <a href="<?php echo htmlspecialchars($url); ?>" target="_blank"><?php echo htmlspecialchars($url); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="test-section">
        <h2>Testing Tools</h2>
        <p>Use these tools to validate your Open Graph meta tags:</p>
        <div class="tool-links">
            <a href="<?php echo $facebook_debugger; ?>" target="_blank" class="tool-link">Facebook Debugger</a>
            <a href="<?php echo $twitter_validator; ?>" target="_blank" class="tool-link">Twitter Card Validator</a>
            <a href="<?php echo $linkedin_inspector; ?>" target="_blank" class="tool-link">LinkedIn Inspector</a>
        </div>
    </div>

    <div class="instructions">
        <h3>How to Test:</h3>
        <ol>
            <li>Copy one of your site URLs above</li>
            <li>Paste it into one of the testing tools</li>
            <li>Check if the preview image and description appear correctly</li>
            <li>If not, the tool will show you what's missing</li>
        </ol>
    </div>

    <div class="warning">
        <h3>Important Notes:</h3>
        <ul>
            <li>Your theme screenshot (2950x1834) will be used as the fallback image</li>
            <li>For best results, create a 1200x630 pixel image specifically for social sharing</li>
            <li>Make sure your site is accessible from the internet for testing tools to work</li>
            <li>Some tools cache results, so changes might not appear immediately</li>
        </ul>
    </div>

    <div class="test-section">
        <h2>Current OG Meta Tags</h2>
        <p>Your theme now includes these Open Graph meta tags:</p>
        <ul>
            <li><strong>og:title</strong> - Your restaurant name and location</li>
            <li><strong>og:description</strong> - Restaurant description</li>
            <li><strong>og:image</strong> - Your theme screenshot (fallback)</li>
            <li><strong>og:type</strong> - restaurant.restaurant</li>
            <li><strong>og:url</strong> - Your site URL</li>
            <li><strong>og:site_name</strong> - Demarchelier Bistro</li>
            <li><strong>Restaurant-specific tags</strong> - Price range, cuisine, hours, address, phone</li>
        </ul>
    </div>
</body>
</html> 
<?php
/**
 * SEO Test File for Demarchelier Bistro Theme
 * 
 * This file can be used to test the SEO implementation
 * Access via: yoursite.com/wp-content/themes/demarchelier/seo-test.php
 */

// Load WordPress
require_once('../../../wp-load.php');

// Set content type
header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEO Test - Demarchelier Bistro</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .test-section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; }
        .pass { background-color: #d4edda; border-color: #c3e6cb; }
        .fail { background-color: #f8d7da; border-color: #f5c6cb; }
        .info { background-color: #d1ecf1; border-color: #bee5eb; }
        pre { background: #f8f9fa; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>SEO Implementation Test - Demarchelier Bistro</h1>
    
    <div class="test-section info">
        <h2>Test Information</h2>
        <p>This page tests the SEO implementation for the Demarchelier Bistro theme.</p>
        <p><strong>Test Date:</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        <p><strong>Site URL:</strong> <?php echo home_url(); ?></p>
    </div>

    <?php
    // Test 1: Check if SEO functions are loaded
    echo '<div class="test-section ' . (function_exists('demarchelier_seo_meta_tags') ? 'pass' : 'fail') . '">';
    echo '<h2>Test 1: SEO Functions</h2>';
    if (function_exists('demarchelier_seo_meta_tags')) {
        echo '<p>✅ SEO functions are loaded successfully.</p>';
    } else {
        echo '<p>❌ SEO functions are not loaded.</p>';
    }
    echo '</div>';

    // Test 2: Check structured data
    echo '<div class="test-section info">';
    echo '<h2>Test 2: Structured Data Check</h2>';
    echo '<p>Check the page source for the following structured data:</p>';
    echo '<ul>';
    echo '<li>Restaurant Schema</li>';
    echo '<li>Local Business Schema</li>';
    echo '<li>Organization Schema</li>';
    echo '<li>WebSite Schema</li>';
    echo '<li>Breadcrumb Schema</li>';
    echo '</ul>';
    echo '<p><strong>Instructions:</strong> View page source and search for "application/ld+json"</p>';
    echo '</div>';

    // Test 3: Check meta tags
    echo '<div class="test-section info">';
    echo '<h2>Test 3: Meta Tags Check</h2>';
    echo '<p>Check the page source for the following meta tags:</p>';
    echo '<ul>';
    echo '<li>meta name="description"</li>';
    echo '<li>meta name="keywords"</li>';
    echo '<li>meta property="og:title"</li>';
    echo '<li>meta property="og:description"</li>';
    echo '<li>meta name="twitter:card"</li>';
    echo '<li>meta name="geo.region"</li>';
    echo '<li>meta name="geo.position"</li>';
    echo '</ul>';
    echo '</div>';

    // Test 4: Check sitemap
    echo '<div class="test-section ' . (file_exists(ABSPATH . 'sitemap.xml') ? 'pass' : 'fail') . '">';
    echo '<h2>Test 4: Sitemap Generation</h2>';
    if (file_exists(ABSPATH . 'sitemap.xml')) {
        echo '<p>✅ Sitemap.xml exists at: ' . home_url('/sitemap.xml') . '</p>';
        echo '<p><a href="' . home_url('/sitemap.xml') . '" target="_blank">View Sitemap</a></p>';
    } else {
        echo '<p>❌ Sitemap.xml not found.</p>';
    }
    echo '</div>';

    // Test 5: Check robots.txt
    echo '<div class="test-section ' . (file_exists(ABSPATH . 'robots.txt') ? 'pass' : 'fail') . '">';
    echo '<h2>Test 5: Robots.txt</h2>';
    if (file_exists(ABSPATH . 'robots.txt')) {
        echo '<p>✅ Robots.txt exists at: ' . home_url('/robots.txt') . '</p>';
        echo '<p><a href="' . home_url('/robots.txt') . '" target="_blank">View Robots.txt</a></p>';
    } else {
        echo '<p>❌ Robots.txt not found.</p>';
    }
    echo '</div>';

    // Test 6: Check theme customizer settings
    echo '<div class="test-section info">';
    echo '<h2>Test 6: Theme Customizer Settings</h2>';
    $meta_description = get_theme_mod('meta_description');
    $og_title = get_theme_mod('og_title');
    $restaurant_rating = get_theme_mod('restaurant_rating');
    
    echo '<p><strong>Meta Description:</strong> ' . ($meta_description ? $meta_description : 'Not set') . '</p>';
    echo '<p><strong>OG Title:</strong> ' . ($og_title ? $og_title : 'Not set') . '</p>';
    echo '<p><strong>Restaurant Rating:</strong> ' . ($restaurant_rating ? $restaurant_rating : 'Not set') . '</p>';
    echo '</div>';

    // Test 7: Check ACF fields
    echo '<div class="test-section info">';
    echo '<h2>Test 7: ACF Fields Check</h2>';
    if (class_exists('ACF')) {
        echo '<p>✅ ACF plugin is active.</p>';
        $contact_info = get_field('contact_info', 'option');
        $resy_link = get_field('resy_link', 'option');
        
        echo '<p><strong>Contact Info:</strong> ' . ($contact_info ? 'Set' : 'Not set') . '</p>';
        echo '<p><strong>Resy Link:</strong> ' . ($resy_link ? $resy_link : 'Not set') . '</p>';
    } else {
        echo '<p>❌ ACF plugin is not active.</p>';
    }
    echo '</div>';

    // Test 8: Performance check
    echo '<div class="test-section info">';
    echo '<h2>Test 8: Performance Check</h2>';
    echo '<p>Check the following performance optimizations:</p>';
    echo '<ul>';
    echo '<li>Preconnect links in head</li>';
    echo '<li>DNS prefetch links</li>';
    echo '<li>Preload critical resources</li>';
    echo '<li>Image optimization</li>';
    echo '</ul>';
    echo '</div>';
    ?>

    <div class="test-section info">
        <h2>SEO Testing Tools</h2>
        <p>Use these tools to verify the SEO implementation:</p>
        <ul>
            <li><a href="https://search.google.com/test/rich-results" target="_blank">Google Rich Results Test</a></li>
            <li><a href="https://developers.google.com/speed/pagespeed/insights/" target="_blank">PageSpeed Insights</a></li>
            <li><a href="https://validator.w3.org/" target="_blank">W3C HTML Validator</a></li>
            <li><a href="https://www.google.com/webmasters/tools/" target="_blank">Google Search Console</a></li>
            <li><a href="https://www.schema.org/" target="_blank">Schema.org Validator</a></li>
        </ul>
    </div>

    <div class="test-section info">
        <h2>Next Steps</h2>
        <ol>
            <li>Submit sitemap to Google Search Console</li>
            <li>Verify structured data with Google's Rich Results Test</li>
            <li>Monitor Core Web Vitals in Search Console</li>
            <li>Set up Google Analytics tracking</li>
            <li>Create local business citations</li>
        </ol>
    </div>

    <div class="test-section">
        <h2>Quick Links</h2>
        <p><a href="<?php echo home_url(); ?>">← Back to Homepage</a></p>
        <p><a href="<?php echo home_url('/sitemap.xml'); ?>" target="_blank">View Sitemap</a></p>
        <p><a href="<?php echo home_url('/robots.txt'); ?>" target="_blank">View Robots.txt</a></p>
    </div>

</body>
</html> 
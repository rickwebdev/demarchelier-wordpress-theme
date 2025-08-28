<?php
/**
 * URL Check Script for Demarchelier WordPress Site
 * 
 * This script checks if WordPress URLs are configured correctly
 * and displays the current site configuration.
 */

// Load WordPress
require_once('wp-config.php');
require_once('wp-load.php');

echo "=== WordPress URL Configuration Check ===\n\n";

// Check WordPress constants
echo "WordPress Constants:\n";
echo "WP_HOME: " . (defined('WP_HOME') ? WP_HOME : 'NOT DEFINED') . "\n";
echo "WP_SITEURL: " . (defined('WP_SITEURL') ? WP_SITEURL : 'NOT DEFINED') . "\n\n";

// Check WordPress options
echo "WordPress Options:\n";
echo "home: " . get_option('home') . "\n";
echo "siteurl: " . get_option('siteurl') . "\n\n";

// Check WordPress functions
echo "WordPress Functions:\n";
echo "home_url(): " . home_url() . "\n";
echo "site_url(): " . site_url() . "\n";
echo "get_template_directory_uri(): " . get_template_directory_uri() . "\n";
echo "get_stylesheet_directory_uri(): " . get_stylesheet_directory_uri() . "\n\n";

// Check uploads directory
echo "Uploads Directory:\n";
$upload_dir = wp_upload_dir();
echo "upload_dir['baseurl']: " . $upload_dir['baseurl'] . "\n";
echo "upload_dir['basedir']: " . $upload_dir['basedir'] . "\n\n";

// Check if uploads directory is accessible
echo "Uploads Directory Check:\n";
$uploads_path = $upload_dir['basedir'];
if (is_dir($uploads_path)) {
    echo "✓ Uploads directory exists: $uploads_path\n";
    
    // Count images
    $image_count = 0;
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($uploads_path));
    foreach ($iterator as $file) {
        if ($file->isFile() && in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $image_count++;
        }
    }
    echo "✓ Found $image_count images in uploads directory\n";
} else {
    echo "✗ Uploads directory does not exist: $uploads_path\n";
}

echo "\n=== End of Check ===\n";
?> 
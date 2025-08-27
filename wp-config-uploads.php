<?php
/**
 * WordPress Upload Configuration
 * Add these lines to your wp-config.php file to increase upload limits
 */

// Increase upload limits
@ini_set('upload_max_filesize', '64M');
@ini_set('post_max_size', '64M');
@ini_set('max_execution_time', '300');
@ini_set('max_input_time', '300');
@ini_set('memory_limit', '256M');

// WordPress specific upload settings
define('WP_MEMORY_LIMIT', '256M');
define('MAX_EXECUTION_TIME', 300);

// Allow larger image uploads
add_filter('big_image_size_threshold', '__return_false');

// Increase image quality
add_filter('jpeg_quality', function($quality) {
    return 95;
});

// Allow SVG uploads (optional)
add_filter('upload_mimes', function($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
});
?> 
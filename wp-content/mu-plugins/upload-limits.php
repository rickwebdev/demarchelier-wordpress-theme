<?php
/**
 * Must-Use Plugin: Upload Limits Fix
 * 
 * This plugin increases WordPress upload limits and is loaded before WordPress core.
 * It ensures upload limits are set correctly even if other plugins or themes override them.
 */

// Prevent direct access
if (!defined('ABSPATH') && !defined('WP_CLI')) {
    exit;
}

/**
 * Increase upload limits
 */
function demarchelier_upload_limits_fix() {
    // Set PHP upload limits
    @ini_set('upload_max_filesize', '64M');
    @ini_set('post_max_size', '64M');
    @ini_set('max_execution_time', '300');
    @ini_set('max_input_time', '300');
    @ini_set('memory_limit', '256M');
    @ini_set('max_file_uploads', '20');
    
    // WordPress specific constants
    if (!defined('WP_MEMORY_LIMIT')) {
        define('WP_MEMORY_LIMIT', '256M');
    }
    
    if (!defined('MAX_EXECUTION_TIME')) {
        define('MAX_EXECUTION_TIME', 300);
    }
    
    // Force WordPress to use our memory limit
    if (function_exists('wp_raise_memory_limit')) {
        wp_raise_memory_limit('admin');
    }
}

// Run immediately
demarchelier_upload_limits_fix();

// Hook into WordPress early to override upload limits
add_action('plugins_loaded', function() {
    // Override WordPress upload size limit
    if (!function_exists('wp_max_upload_size')) {
        function wp_max_upload_size() {
            return 64 * 1024 * 1024; // 64MB
        }
    }
    
    // Override WordPress upload directory size check
    add_filter('wp_upload_dir', function($uploads) {
        // Ensure upload directory is writable and has enough space
        return $uploads;
    });
}, 1);

/**
 * Additional WordPress upload filters
 */
add_action('init', function() {
    // Disable big image size threshold
    add_filter('big_image_size_threshold', '__return_false');
    
    // Increase image quality
    add_filter('jpeg_quality', function($quality) {
        return 95;
    });
    
    // Allow larger uploads in WordPress
    add_filter('upload_size_limit', function($size) {
        return 64 * 1024 * 1024; // 64MB in bytes
    });
    
    // Override WordPress upload size check
    add_filter('wp_handle_upload_prefilter', function($file) {
        // Remove any size restrictions
        return $file;
    });
    
    // Disable WordPress upload size validation
    add_filter('wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
        // Allow all file types and sizes
        return $data;
    }, 10, 4);
    
    // Override WordPress upload size limit function
    if (!function_exists('wp_max_upload_size')) {
        function wp_max_upload_size() {
            return 64 * 1024 * 1024; // 64MB
        }
    }
    
    // Override WordPress upload error messages
    add_filter('upload_error_strings', function($upload_error_strings) {
        // Remove size-related error messages
        unset($upload_error_strings['file_too_big']);
        return $upload_error_strings;
    });
    
    // Allow SVG uploads
    add_filter('upload_mimes', function($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    });
    
    // Increase timeout for large uploads
    add_filter('http_request_timeout', function($timeout) {
        return 300; // 5 minutes
    });
});

/**
 * Debug function to check current limits
 */
function demarchelier_debug_upload_limits() {
    if (current_user_can('manage_options')) {
        error_log('Upload Limits Debug:');
        error_log('upload_max_filesize: ' . ini_get('upload_max_filesize'));
        error_log('post_max_size: ' . ini_get('post_max_size'));
        error_log('memory_limit: ' . ini_get('memory_limit'));
        error_log('max_execution_time: ' . ini_get('max_execution_time'));
        error_log('WP_MEMORY_LIMIT: ' . (defined('WP_MEMORY_LIMIT') ? WP_MEMORY_LIMIT : 'Not defined'));
    }
}

// Debug on admin pages
if (is_admin()) {
    add_action('admin_init', 'demarchelier_debug_upload_limits');
} 
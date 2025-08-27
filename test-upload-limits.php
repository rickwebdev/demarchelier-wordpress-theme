<?php
/**
 * Test Upload Limits
 * 
 * This script tests if the upload limits have been properly set.
 */

echo "=== WordPress Upload Limits Test ===\n\n";

// Check PHP settings
echo "PHP Settings:\n";
echo "upload_max_filesize: " . ini_get('upload_max_filesize') . "\n";
echo "post_max_size: " . ini_get('post_max_size') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo "max_input_time: " . ini_get('max_input_time') . "\n";
echo "max_file_uploads: " . ini_get('max_file_uploads') . "\n\n";

// Check WordPress constants
echo "WordPress Constants:\n";
if (defined('WP_MEMORY_LIMIT')) {
    echo "WP_MEMORY_LIMIT: " . WP_MEMORY_LIMIT . "\n";
} else {
    echo "WP_MEMORY_LIMIT: Not defined\n";
}

if (defined('MAX_EXECUTION_TIME')) {
    echo "MAX_EXECUTION_TIME: " . MAX_EXECUTION_TIME . "\n";
} else {
    echo "MAX_EXECUTION_TIME: Not defined\n";
}

// Convert sizes to bytes for comparison
$upload_max = ini_get('upload_max_filesize');
$post_max = ini_get('post_max_size');

function size_to_bytes($size) {
    $size = strtolower(trim($size));
    if (preg_match('/^(\d+)([kmg]?)$/', $size, $matches)) {
        $value = (int)$matches[1];
        $unit = $matches[2];
        
        switch ($unit) {
            case 'k': return $value * 1024;
            case 'm': return $value * 1024 * 1024;
            case 'g': return $value * 1024 * 1024 * 1024;
            default: return $value;
        }
    }
    return 0;
}

$upload_max_bytes = size_to_bytes($upload_max);
$post_max_bytes = size_to_bytes($post_max);

echo "\nSize Analysis:\n";
echo "upload_max_filesize in bytes: " . number_format($upload_max_bytes) . "\n";
echo "post_max_size in bytes: " . number_format($post_max_bytes) . "\n";

// Test if 64MB files should be allowed
$test_size = 64 * 1024 * 1024; // 64MB in bytes
echo "Test file size (64MB): " . number_format($test_size) . " bytes\n\n";

if ($upload_max_bytes >= $test_size) {
    echo "✅ upload_max_filesize allows 64MB files\n";
} else {
    echo "❌ upload_max_filesize too small for 64MB files\n";
}

if ($post_max_bytes >= $test_size) {
    echo "✅ post_max_size allows 64MB files\n";
} else {
    echo "❌ post_max_size too small for 64MB files\n";
}

echo "\n=== Test Complete ===\n"; 
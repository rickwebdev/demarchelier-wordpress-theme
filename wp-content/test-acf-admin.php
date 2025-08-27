<?php
/**
 * Test ACF Admin Access
 * Run with: wp eval-file test-acf-admin.php
 */

echo "Testing ACF fields access...\n";

// Test if ACF functions are available
if (function_exists('get_field')) {
    echo "✓ ACF get_field function is available\n";
} else {
    echo "✗ ACF get_field function is NOT available\n";
}

// Test if options page exists
if (function_exists('acf_options_page')) {
    echo "✓ ACF options page function is available\n";
} else {
    echo "✗ ACF options page function is NOT available\n";
}

// Test getting a field value
$hero_title = get_field('hero_title', 'option');
if ($hero_title) {
    echo "✓ Hero title field value: " . $hero_title . "\n";
} else {
    echo "✗ Hero title field is empty or not accessible\n";
}

// Test getting options directly
$hero_title_option = get_option('options_hero_title');
if ($hero_title_option) {
    echo "✓ Hero title option value: " . $hero_title_option . "\n";
} else {
    echo "✗ Hero title option is empty\n";
}

// List all options that start with 'options_'
global $wpdb;
$options = $wpdb->get_results("SELECT option_name, option_value FROM {$wpdb->options} WHERE option_name LIKE 'options_%'");
echo "Found " . count($options) . " ACF options:\n";
foreach ($options as $option) {
    echo "  - " . $option->option_name . ": " . substr($option->option_value, 0, 50) . "...\n";
}

echo "Test complete!\n";
?> 
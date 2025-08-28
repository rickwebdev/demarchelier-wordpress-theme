<?php
/**
 * Sitemap Generator for Demarchelier Bistro Theme
 * 
 * @package Demarchelier
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Generate XML sitemap
 */
function demarchelier_generate_sitemap() {
    // Check if sitemap is requested
    if (isset($_GET['sitemap']) && $_GET['sitemap'] === 'xml') {
        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        
        // Homepage
        echo '<url>' . "\n";
        echo '<loc>' . esc_url(home_url('/')) . '</loc>' . "\n";
        echo '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        echo '<changefreq>weekly</changefreq>' . "\n";
        echo '<priority>1.0</priority>' . "\n";
        echo '</url>' . "\n";
        
        // About section
        echo '<url>' . "\n";
        echo '<loc>' . esc_url(home_url('/#about')) . '</loc>' . "\n";
        echo '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        echo '<changefreq>monthly</changefreq>' . "\n";
        echo '<priority>0.8</priority>' . "\n";
        echo '</url>' . "\n";
        
        // Menu section
        echo '<url>' . "\n";
        echo '<loc>' . esc_url(home_url('/#menu')) . '</loc>' . "\n";
        echo '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        echo '<changefreq>weekly</changefreq>' . "\n";
        echo '<priority>0.9</priority>' . "\n";
        echo '</url>' . "\n";
        
        // Hours section
        echo '<url>' . "\n";
        echo '<loc>' . esc_url(home_url('/#hours')) . '</loc>' . "\n";
        echo '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        echo '<changefreq>monthly</changefreq>' . "\n";
        echo '<priority>0.7</priority>' . "\n";
        echo '</url>' . "\n";
        
        // Gallery section
        echo '<url>' . "\n";
        echo '<loc>' . esc_url(home_url('/#gallery')) . '</loc>' . "\n";
        echo '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        echo '<changefreq>monthly</changefreq>' . "\n";
        echo '<priority>0.6</priority>' . "\n";
        echo '</url>' . "\n";
        
        // Contact section
        echo '<url>' . "\n";
        echo '<loc>' . esc_url(home_url('/#signup')) . '</loc>' . "\n";
        echo '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
        echo '<changefreq>monthly</changefreq>' . "\n";
        echo '<priority>0.8</priority>' . "\n";
        echo '</url>' . "\n";
        
        // Blog posts if they exist
        $posts = get_posts(array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'numberposts' => 50
        ));
        
        foreach ($posts as $post) {
            echo '<url>' . "\n";
            echo '<loc>' . esc_url(get_permalink($post->ID)) . '</loc>' . "\n";
            echo '<lastmod>' . get_the_modified_date('Y-m-d', $post->ID) . '</lastmod>' . "\n";
            echo '<changefreq>monthly</changefreq>' . "\n";
            echo '<priority>0.6</priority>' . "\n";
            echo '</url>' . "\n";
        }
        
        echo '</urlset>';
        exit;
    }
}
add_action('init', 'demarchelier_generate_sitemap');

/**
 * Add sitemap to robots.txt
 */
function demarchelier_robots_txt($output) {
    $output .= "\nSitemap: " . home_url('/?sitemap=xml') . "\n";
    return $output;
}
add_filter('robots_txt', 'demarchelier_robots_txt');

/**
 * Create sitemap file
 */
function demarchelier_create_sitemap_file() {
    $sitemap_content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $sitemap_content .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    
    // Homepage
    $sitemap_content .= '<url>' . "\n";
    $sitemap_content .= '<loc>' . esc_url(home_url('/')) . '</loc>' . "\n";
    $sitemap_content .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
    $sitemap_content .= '<changefreq>weekly</changefreq>' . "\n";
    $sitemap_content .= '<priority>1.0</priority>' . "\n";
    $sitemap_content .= '</url>' . "\n";
    
    // About section
    $sitemap_content .= '<url>' . "\n";
    $sitemap_content .= '<loc>' . esc_url(home_url('/#about')) . '</loc>' . "\n";
    $sitemap_content .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
    $sitemap_content .= '<changefreq>monthly</changefreq>' . "\n";
    $sitemap_content .= '<priority>0.8</priority>' . "\n";
    $sitemap_content .= '</url>' . "\n";
    
    // Menu section
    $sitemap_content .= '<url>' . "\n";
    $sitemap_content .= '<loc>' . esc_url(home_url('/#menu')) . '</loc>' . "\n";
    $sitemap_content .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
    $sitemap_content .= '<changefreq>weekly</changefreq>' . "\n";
    $sitemap_content .= '<priority>0.9</priority>' . "\n";
    $sitemap_content .= '</url>' . "\n";
    
    // Hours section
    $sitemap_content .= '<url>' . "\n";
    $sitemap_content .= '<loc>' . esc_url(home_url('/#hours')) . '</loc>' . "\n";
    $sitemap_content .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
    $sitemap_content .= '<changefreq>monthly</changefreq>' . "\n";
    $sitemap_content .= '<priority>0.7</priority>' . "\n";
    $sitemap_content .= '</url>' . "\n";
    
    // Gallery section
    $sitemap_content .= '<url>' . "\n";
    $sitemap_content .= '<loc>' . esc_url(home_url('/#gallery')) . '</loc>' . "\n";
    $sitemap_content .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
    $sitemap_content .= '<changefreq>monthly</changefreq>' . "\n";
    $sitemap_content .= '<priority>0.6</priority>' . "\n";
    $sitemap_content .= '</url>' . "\n";
    
    // Contact section
    $sitemap_content .= '<url>' . "\n";
    $sitemap_content .= '<loc>' . esc_url(home_url('/#signup')) . '</loc>' . "\n";
    $sitemap_content .= '<lastmod>' . date('Y-m-d') . '</lastmod>' . "\n";
    $sitemap_content .= '<changefreq>monthly</changefreq>' . "\n";
    $sitemap_content .= '<priority>0.8</priority>' . "\n";
    $sitemap_content .= '</url>' . "\n";
    
    // Blog posts if they exist
    $posts = get_posts(array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'numberposts' => 50
    ));
    
    foreach ($posts as $post) {
        $sitemap_content .= '<url>' . "\n";
        $sitemap_content .= '<loc>' . esc_url(get_permalink($post->ID)) . '</loc>' . "\n";
        $sitemap_content .= '<lastmod>' . get_the_modified_date('Y-m-d', $post->ID) . '</lastmod>' . "\n";
        $sitemap_content .= '<changefreq>monthly</changefreq>' . "\n";
        $sitemap_content .= '<priority>0.6</priority>' . "\n";
        $sitemap_content .= '</url>' . "\n";
    }
    
    $sitemap_content .= '</urlset>';
    
    // Write sitemap to file
    $sitemap_file = ABSPATH . 'sitemap.xml';
    file_put_contents($sitemap_file, $sitemap_content);
}
add_action('init', 'demarchelier_create_sitemap_file'); 
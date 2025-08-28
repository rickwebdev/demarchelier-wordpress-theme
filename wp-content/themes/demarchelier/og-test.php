<?php
/*
Template Name: OG Test
*/

get_header(); ?>

<div class="container">
    <div class="og-test-content">
        <h1>Open Graph Meta Tags Test</h1>
        <p>This page is used to test the Open Graph meta tags for mobile sharing.</p>
        
        <h2>Current OG Meta Tags:</h2>
        <ul>
            <li><strong>Title:</strong> <?php echo esc_html(get_theme_mod('og_title', 'Demarchelier Bistro - Classic French Restaurant in Greenport, NY')); ?></li>
            <li><strong>Description:</strong> <?php echo esc_html(get_theme_mod('og_description', 'Authentic French bistro cuisine since 1978. Located in Greenport Village, Long Island. Book your table today.')); ?></li>
            <li><strong>Image:</strong> <?php 
                $og_image = get_theme_mod('og_image');
                if (!$og_image) {
                    $og_image = get_template_directory_uri() . '/screenshot.png';
                }
                echo esc_url($og_image);
            ?></li>
            <li><strong>Type:</strong> restaurant.restaurant</li>
            <li><strong>URL:</strong> <?php echo esc_url(home_url('/')); ?></li>
        </ul>
        
        <h2>Testing Instructions:</h2>
        <ol>
            <li>Share this page URL on Facebook, Twitter, or WhatsApp</li>
            <li>Check if the preview shows the correct image and description</li>
            <li>If using Facebook, you can also use the <a href="https://developers.facebook.com/tools/debug/" target="_blank">Facebook Sharing Debugger</a></li>
            <li>For Twitter, use the <a href="https://cards-dev.twitter.com/validator" target="_blank">Twitter Card Validator</a></li>
        </ol>
        
        <h2>Current Theme Screenshot:</h2>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/screenshot.png'); ?>" alt="Theme Screenshot" style="max-width: 300px; height: auto;">
    </div>
</div>

<style>
.og-test-content {
    padding: 2rem 0;
    max-width: 800px;
    margin: 0 auto;
}

.og-test-content h1 {
    color: #333;
    margin-bottom: 1rem;
}

.og-test-content h2 {
    color: #666;
    margin: 2rem 0 1rem 0;
    border-bottom: 2px solid #eee;
    padding-bottom: 0.5rem;
}

.og-test-content ul {
    background: #f9f9f9;
    padding: 1rem;
    border-radius: 5px;
    margin: 1rem 0;
}

.og-test-content li {
    margin: 0.5rem 0;
}

.og-test-content ol {
    background: #f0f8ff;
    padding: 1rem 1rem 1rem 2rem;
    border-radius: 5px;
    margin: 1rem 0;
}

.og-test-content a {
    color: #0073aa;
    text-decoration: none;
}

.og-test-content a:hover {
    text-decoration: underline;
}
</style>

<?php get_footer(); ?> 
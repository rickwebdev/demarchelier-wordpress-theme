<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- SEO Meta Tags -->
    <title><?php wp_title('|', true, 'right'); ?></title>
    <meta name="description" content="<?php echo esc_attr(get_theme_mod('meta_description', 'Classic French Bistro in Greenport, NY. Authentic French cuisine since 1978. Book your table for an unforgettable dining experience.')); ?>">
    <meta name="keywords" content="<?php echo esc_attr(get_theme_mod('meta_keywords', 'French restaurant, Greenport NY, French bistro, fine dining, reservations, Demarchelier')); ?>">
    <meta name="author" content="Demarchelier Bistro">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo esc_attr(get_theme_mod('og_title', 'Demarchelier Bistro - Classic French Restaurant in Greenport, NY')); ?>">
    <meta property="og:description" content="<?php echo esc_attr(get_theme_mod('og_description', 'Authentic French bistro cuisine since 1978. Located in Greenport Village, Long Island. Book your table today.')); ?>">
    <meta property="og:type" content="restaurant.restaurant">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:site_name" content="Demarchelier Bistro">
    <meta property="og:locale" content="en_US">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:secure_url" content="<?php echo esc_url($og_image); ?>">
    
    <!-- Open Graph Image -->
    <?php 
    $og_image = get_theme_mod('og_image');
    if (!$og_image) {
        // Fallback to theme screenshot if no custom OG image is set
        $og_image = get_template_directory_uri() . '/screenshot.png';
    }
    ?>
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?php echo esc_attr(get_bloginfo('name') . ' - ' . get_bloginfo('description')); ?>">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr(get_theme_mod('twitter_title', 'Demarchelier Bistro - Classic French Restaurant')); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr(get_theme_mod('twitter_description', 'Authentic French bistro cuisine in Greenport, NY since 1978')); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
    <meta name="twitter:image:alt" content="<?php echo esc_attr(get_bloginfo('name') . ' - ' . get_bloginfo('description')); ?>">
    
    <!-- Geo Meta Tags -->
    <meta name="geo.region" content="US-NY">
    <meta name="geo.placename" content="Greenport">
    <meta name="geo.position" content="41.1034;-72.3618">
    <meta name="ICBM" content="41.1034, -72.3618">
    
    <!-- Restaurant Specific Meta Tags -->
    <meta name="restaurant:price_range" content="$$$">
    <meta name="restaurant:cuisine" content="French">
    <meta name="restaurant:accepts_reservations" content="true">
    <meta name="restaurant:serves_alcohol" content="true">
    
    <!-- Additional Open Graph Restaurant Tags -->
    <meta property="restaurant:price_range" content="$$$">
    <meta property="restaurant:cuisine" content="French">
    <meta property="restaurant:accepts_reservations" content="true">
    <meta property="restaurant:serves_alcohol" content="true">
    <meta property="restaurant:opening_hours" content="Tuesday-Sunday: 5:30 PM - 10:30 PM">
    <meta property="restaurant:street_address" content="50 E 86th St">
    <meta property="restaurant:locality" content="New York">
    <meta property="restaurant:region" content="NY">
    <meta property="restaurant:postal_code" content="10028">
    <meta property="restaurant:country" content="US">
    <meta property="restaurant:phone_number" content="(212) 249-9193">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_theme_mod('favicon', get_template_directory_uri() . '/favicon.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url(get_theme_mod('favicon', get_template_directory_uri() . '/favicon.png')); ?>">
    <link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('favicon', get_template_directory_uri() . '/favicon.png')); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_mod('apple_touch_icon', get_template_directory_uri() . '/apple-touch-icon.png')); ?>">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://resy.com">
    <link rel="preconnect" href="https://www.google.com">
    <link rel="preconnect" href="https://maps.googleapis.com">
    <link rel="preconnect" href="https://images.unsplash.com">
    
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//resy.com">
    <link rel="dns-prefetch" href="//maps.googleapis.com">
    <link rel="dns-prefetch" href="//images.unsplash.com">
    
    <!-- Preload critical hero images -->
    <?php
    // Get hero images for preloading
    $hero_images = array();
    $hero_image_1 = get_theme_mod('hero_image_1');
    $hero_image_2 = get_theme_mod('hero_image_2');
    $hero_image_3 = get_theme_mod('hero_image_3');
    $hero_image_4 = get_theme_mod('hero_image_4');
    
    // Preload Google Maps iframe
    ?>
    <link rel="preload" as="document" href="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8&q=471+Main+Street+Greenport+NY+11944">
    <?php
    
    if ($hero_image_1) $hero_images[] = $hero_image_1;
    if ($hero_image_2) $hero_images[] = $hero_image_2;
    if ($hero_image_3) $hero_images[] = $hero_image_3;
    if ($hero_image_4) $hero_images[] = $hero_image_4;
    
    // Fallback to ACF if no Customizer images
    if (empty($hero_images)) {
        $acf_hero_images = get_field('hero_images', 'option');
        if ($acf_hero_images && is_array($acf_hero_images)) {
            foreach ($acf_hero_images as $image) {
                if (isset($image['url'])) {
                    $hero_images[] = $image['url'];
                }
            }
        }
    }
    
    // Preload first 2 hero images (most critical)
    if (!empty($hero_images)) {
        foreach (array_slice($hero_images, 0, 2) as $image_url) {
            echo '<link rel="preload" as="image" href="' . esc_url($image_url) . '">';
        }
    } else {
        // Preload default hero images
        echo '<link rel="preload" as="image" href="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2000&auto=format&fit=crop">';
        echo '<link rel="preload" as="image" href="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop">';
    }
    ?>
    
    <?php wp_head(); ?>
    
    <!-- Critical CSS for faster First Paint -->
    <style>
        /* Critical hero styles for immediate rendering */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #fff;
            overflow: hidden;
            background: linear-gradient(135deg, #7A1F2A 0%, #8B0000 25%, #A0522D 50%, #7A1F2A 75%, #8B0000 100%);
        }
        .hero-bg {
            position: absolute;
            inset: -20%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0;
            transition: opacity 2s ease-in-out;
        }
        .hero-bg.active {
            opacity: 0; /* Start invisible, will be controlled by JavaScript */
        }
        .hero .inner {
            position: relative;
            z-index: 3;
            max-width: 800px;
            margin: 0 auto;
            padding: 3.5rem 1rem;
            transform: translateZ(50px);
            backface-visibility: hidden;
            will-change: transform;
        }
        .hero-brand {
            font-family: "Playfair Display", "Didot", "Bodoni MT", Georgia, serif;
            font-size: clamp(42px, 7vw, 72px);
            font-weight: 600;
            letter-spacing: 0.015em;
            color: #fff;
            text-align: center;
            margin-bottom: 0;
            text-transform: uppercase;
            opacity: 0.9;
        }
        .hero h1 {
            font-family: "Cormorant Garamond", "Garamond", "Times New Roman", serif;
            font-weight: 600;
            font-size: clamp(28px, 4vw, 48px);
            letter-spacing: 1.5px;
            margin-top: -0.5rem;
            margin-bottom: 0.6rem;
            line-height: 1.2;
        }
        .hero .sub {
            color: #f1ede7;
            margin: 0.4rem 0 1.7rem;
            font-size: clamp(18px, 2.5vw, 26px);
            font-weight: 500;
            letter-spacing: 0.3px;
            line-height: 1.4;
        }
        
        /* Hero shimmer effect */
        .hero h1, .hero .sub {
            background: linear-gradient(90deg, #fff, #fef8f0, #fff, #fef8f0, #fff);
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            animation: shimmer 12s linear infinite;
            opacity: 1;
            filter: drop-shadow(0 0 8px rgba(255,255,255,0.3));
        }
        
        @keyframes shimmer {
            0% { background-position: 200% center; }
            100% { background-position: -200% center; }
        }
        .btn {
            display: inline-block;
            padding: 0.75rem 1.25rem;
            border: 1px solid #D73D38;
            border-radius: 4px;
            font-weight: 500;
            font-size: 1.05rem;
            text-decoration: none;
            transition: all 0.6s ease;
        }
        .btn.book {
            background: #D73D38;
            color: #fff;
        }
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #7A1F2A 0%, #8B0000 25%, #A0522D 50%, #7A1F2A 75%, #8B0000 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.3s ease-out, visibility 0.3s ease-out;
        }
        .preloader.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        
        /* Progress Text Styles */
        .progress-text {
            font-family: "Lora", Georgia, "Times New Roman", serif;
            font-size: 0.9rem;
            color: #f1ede7;
            margin: 1.5rem 0 1rem;
            font-weight: 500;
            letter-spacing: 0.3px;
            text-align: center;
        }
        
        /* Loading Spinner */
        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 2px solid rgba(255,255,255,0.2);
            border-top: 2px solid #C9A227;
            border-radius: 50%;
            margin: 0 auto;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Preloader Logo Styling */
        .preloader-logo {
            font-family: "Times New Roman", Times, serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 1rem;
            opacity: 0;
            animation: fadeInUp 0.8s ease-out 0.1s forwards;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
            letter-spacing: 0.015em;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
        }
        .preloader-logo .bistro {
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            display: block;
            margin-top: -2px;
            color: #ffffff;
        }
        
        /* Header logo styling */
        .logo {
            font-family: "Times New Roman", Times, serif;
            font-weight: 700;
            font-size: 28px;
            letter-spacing: 0.015em;
            color: #7A1F2A;
            text-transform: uppercase;
            text-align: center;
            line-height: 1.1;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .logo .bistro {
            font-size: 20px;
            font-weight: 600;
            letter-spacing: 0.05em;
            display: block;
            margin-top: -2px;
        }
        
        /* Mobile logo adjustments */
        @media (max-width: 768px) {
            .logo {
                font-size: 24px;
                margin-left: 16px;
                letter-spacing: 0.015em;
            }
            .logo .bistro {
                font-size: 18px;
                letter-spacing: 0.05em;
            }
        }
    </style>
    
    <!-- Preloader will wait for hero images to load -->
    <script>
        // Preloader is now managed by theme-optimized.js
        // It will wait for hero images to load before hiding
    </script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Non-blocking Preloader with Progress Bar -->
<div class="preloader" id="preloader">
    <div class="preloader-content">
        <div class="preloader-logo">
            DEMARCHELIER
            <span class="bistro">Bistro</span>
        </div>
        <div class="progress-text" id="progress-text">Loading...</div>
        <div class="loading-spinner"></div>
    </div>
</div>

<a class="skip-link" href="#main"><?php _e('Skip to main content', 'demarchelier'); ?></a>

<header class="site-header" role="banner">
    <div class="container nav-wrap">
        <?php if (has_custom_logo()): ?>
            <div class="logo">
                <?php the_custom_logo(); ?>
            </div>
        <?php else: ?>
            <a class="logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php bloginfo('name'); ?> home">
                <?php bloginfo('name'); ?>
                <span class="bistro">Bistro</span>
            </a>
        <?php endif; ?>
        
        <button class="menu-toggle" aria-expanded="false" aria-controls="primary-nav" aria-label="<?php _e('Toggle navigation menu', 'demarchelier'); ?>">
            <span></span>
            <span></span>
            <span></span>
        </button>
        
        <nav id="primary-nav" aria-label="<?php _e('Primary', 'demarchelier'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
                'container' => false,
                'fallback_cb' => 'demarchelier_fallback_menu',
            ));
            ?>
            <?php 
            $resy_link = get_field('resy_link', 'option') ?: 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro';
            ?>
            <a class="btn book" href="<?php echo esc_url($resy_link); ?>" target="_blank" rel="noopener"><?php _e('Book a Table', 'demarchelier'); ?></a>
        </nav>
    </div>
    
    <div class="announce">
        <div class="container">
            <p><span class="announcement-prefix">Announcements:</span> <?php echo esc_html(get_theme_mod('announcement_text', 'Open For New Years Eve - a la carte menu & Festive specials • closed New Years day • Cassoulet Every Thursday')); ?></p>
        </div>
    </div>
</header>

<?php
// Fallback menu function
function demarchelier_fallback_menu() {
    echo '<a href="#about">' . __('About', 'demarchelier') . '</a>';
    echo '<a href="#menu">' . __('Menu', 'demarchelier') . '</a>';
    echo '<a href="#hours">' . __('Hours', 'demarchelier') . '</a>';
    echo '<a href="#gallery">' . __('Gallery', 'demarchelier') . '</a>';
    echo '<a href="#signup">' . __('Sign Up', 'demarchelier') . '</a>';
}
?> 
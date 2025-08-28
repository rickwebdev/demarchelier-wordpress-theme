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
    
    <!-- Open Graph Image -->
    <?php 
    $og_image = get_theme_mod('og_image');
    if ($og_image): ?>
        <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    <?php endif; ?>
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr(get_theme_mod('twitter_title', 'Demarchelier Bistro - Classic French Restaurant')); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr(get_theme_mod('twitter_description', 'Authentic French bistro cuisine in Greenport, NY since 1978')); ?>">
    <?php if ($og_image): ?>
        <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
    <?php endif; ?>
    
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
    
    <!-- Canonical URL -->
    <link rel="canonical" href="<?php echo esc_url(home_url($_SERVER['REQUEST_URI'])); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo esc_url(get_theme_mod('favicon', get_template_directory_uri() . '/favicon.ico')); ?>">
    <link rel="apple-touch-icon" href="<?php echo esc_url(get_theme_mod('apple_touch_icon', get_template_directory_uri() . '/apple-touch-icon.png')); ?>">
    
    <!-- Preconnect to external domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://resy.com">
    <link rel="preconnect" href="https://www.google.com">
    
    <!-- DNS Prefetch -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//resy.com">
    <link rel="dns-prefetch" href="//maps.googleapis.com">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Preloader -->
<div class="preloader" id="preloader">
    <div class="preloader-content">
        <div class="preloader-logo"><?php bloginfo('name'); ?></div>
        <div class="preloader-subtitle">Loading...</div>
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
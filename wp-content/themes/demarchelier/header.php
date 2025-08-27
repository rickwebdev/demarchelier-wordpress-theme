<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
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
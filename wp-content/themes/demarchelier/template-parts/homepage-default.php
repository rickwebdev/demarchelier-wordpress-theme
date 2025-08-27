<?php
/**
 * Default Homepage Template Part
 * 
 * @package Demarchelier
 */

// Get theme options (prioritize Customizer settings)
$hero_title = get_theme_mod('hero_title', 'Classic French Bistro');
$hero_subtitle = get_theme_mod('hero_subtitle', 'Serving authentic French fare since 1978 — from Manhattan to Greenport Village');
// Get hero images from Customizer
$hero_images = array();
$hero_image_1 = get_theme_mod('hero_image_1');
$hero_image_2 = get_theme_mod('hero_image_2');
$hero_image_3 = get_theme_mod('hero_image_3');
$hero_image_4 = get_theme_mod('hero_image_4');

if ($hero_image_1) $hero_images[] = array('url' => $hero_image_1);
if ($hero_image_2) $hero_images[] = array('url' => $hero_image_2);
if ($hero_image_3) $hero_images[] = array('url' => $hero_image_3);
if ($hero_image_4) $hero_images[] = array('url' => $hero_image_4);

// Fallback to ACF if no Customizer images
if (empty($hero_images)) {
    $hero_images = get_field('hero_images', 'option');
}
$resy_link = get_theme_mod('resy_link', 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro');
$about_content = get_theme_mod('about_content', 'Since 1978 we have served classic French <span class="accent-script">bistro</span> fare with a warm, family atmosphere. Our menu pairs traditional dishes with a predominantly French wine list. Join us for a quick bite at the bar or a relaxed dinner with friends.');
$about_image = get_theme_mod('about_image') ? array('url' => get_theme_mod('about_image')) : get_field('about_image', 'option');
$menu_items = get_option('menu_items') ?: get_field('menu_items', 'option');
$menu_pdf = get_theme_mod('menu_pdf_file') ? array('url' => get_theme_mod('menu_pdf_file')) : get_field('menu_pdf', 'option');

// Get hours from Customizer
$hours = array(
    get_theme_mod('hours_monday', 'Mon: 5:00 PM - 9:00 PM'),
    get_theme_mod('hours_tuesday', 'Tue: 5:00 PM - 9:00 PM'),
    get_theme_mod('hours_wednesday', 'Wed: 5:00 PM - 9:00 PM'),
    get_theme_mod('hours_thursday', 'Thu: 5:00 PM - 9:00 PM'),
    get_theme_mod('hours_friday', 'Fri: 5:00 PM - 10:00 PM'),
    get_theme_mod('hours_saturday', 'Sat: 5:00 PM - 10:00 PM'),
    get_theme_mod('hours_sunday', 'Sun: 5:00 PM - 9:00 PM'),
);

// Get contact info from Customizer
$contact_info = array(
    'address' => get_theme_mod('address', '471 Main Street, Greenport, NY 11944'),
    'phone' => get_theme_mod('phone', '1.631.593.1650'),
    'email' => get_theme_mod('email', 'info@demarchelierbistro.com'),
);
?>

<!-- Hero Section -->
<section class="hero" role="region" aria-label="Hero">
    <?php if ($hero_images): ?>
        <?php foreach ($hero_images as $index => $image): ?>
            <div class="hero-bg <?php echo $index === 0 ? 'active' : ''; ?>" 
                 style="background-image: url('<?php echo esc_url($image['url']); ?>')"></div>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Default hero images -->
        <div class="hero-bg active" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2000&auto=format&fit=crop')"></div>
        <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop')"></div>
        <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=2000&auto=format&fit=crop')"></div>
        <div class="hero-bg" style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop')"></div>
    <?php endif; ?>
    <div class="inner container">
        <h1><?php echo esc_html($hero_title); ?></h1>
        <p class="sub"><?php echo esc_html($hero_subtitle); ?></p>
        <a class="btn book" href="<?php echo esc_url($resy_link); ?>" target="_blank" rel="noopener"><?php _e('Book a Table', 'demarchelier'); ?></a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about container">
    <?php if ($about_image): ?>
        <img class="fade-in-left" src="<?php echo esc_url($about_image['url']); ?>" 
             alt="<?php echo esc_attr($about_image['alt']); ?>">
    <?php else: ?>
        <img class="fade-in-left" src="https://images.unsplash.com/photo-1519710164239-da123dc03ef4?q=80&w=1600&auto=format&fit=crop"
             alt="Candlelit bistro tables with framed artwork on the walls">
    <?php endif; ?>
    <div class="fade-in-right">
        <h2 class="outlined-heading"><?php _e('About', 'demarchelier'); ?></h2>
        <?php if ($about_content): ?>
            <?php echo wp_kses_post($about_content); ?>
        <?php else: ?>
            <p><?php _e('Since 1978 we have served classic French', 'demarchelier'); ?> <span class="accent-script"><?php _e('bistro', 'demarchelier'); ?></span> <?php _e('fare with a warm, family atmosphere. Our menu pairs traditional dishes with a predominantly French wine list. Join us for a quick bite at the bar or a relaxed dinner with friends.', 'demarchelier'); ?></p>
        <?php endif; ?>
        <div class="divider"></div>
        <p class="accent">471 Main Street, Greenport NY</p>
    </div>
</section>

<!-- Menu Section -->
<section id="menu" class="menu" <?php if (get_theme_mod('menu_background')): ?>style="background: linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.9)), url('<?php echo esc_url(get_theme_mod('menu_background')); ?>') center/cover no-repeat;"<?php endif; ?>>
    <div class="container">
        <h2 class="outlined-heading fade-in-up"><?php _e('Menu Highlights', 'demarchelier'); ?></h2>
        <?php if ($menu_items && is_array($menu_items)): ?>
            <ul class="fade-in-up">
                <?php foreach ($menu_items as $item): ?>
                    <?php if (is_array($item) && isset($item['menu_item'])): ?>
                        <li><?php echo esc_html($item['menu_item']); ?></li>
                    <?php elseif (is_string($item)): ?>
                        <li><?php echo esc_html($item); ?></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <ul class="fade-in-up">
                <li><?php _e('Duck Confit with gratin dauphinois', 'demarchelier'); ?></li>
                <li><?php _e('Steak Frites with bordelaise', 'demarchelier'); ?></li>
                <li><?php _e('Steak Tartare with pommes dauphine', 'demarchelier'); ?></li>
                <li><?php _e('Chicken Paillard with mesclun salad', 'demarchelier'); ?></li>
                <li><?php _e('Roasted Salmon with beurre blanc', 'demarchelier'); ?></li>
                <li><?php _e('Calf Liver Bordelaise with mashed potatoes', 'demarchelier'); ?></li>
                <li><?php _e('Onion Soup Gratinée', 'demarchelier'); ?></li>
                <li><?php _e('Crème Brûlée', 'demarchelier'); ?></li>
            </ul>
        <?php endif; ?>
        <a class="btn fade-in-up" href="<?php echo esc_url($menu_pdf ? $menu_pdf['url'] : '#'); ?>" target="_blank" rel="noopener" <?php echo !$menu_pdf ? 'onclick="alert(\'Menu PDF not yet uploaded. Please contact us for the current menu.\'); return false;"' : ''; ?>><?php _e('Download Full Menu (PDF)', 'demarchelier'); ?></a>
    </div>
</section>

<!-- Hours Section -->
<section id="hours" class="container">
    <h2 class="outlined-heading fade-in-up"><?php _e('Visit', 'demarchelier'); ?></h2>
    <div class="info-grid">
        <div class="card fade-in-up" aria-labelledby="hours-h">
            <h3 id="hours-h"><?php _e('Hours', 'demarchelier'); ?></h3>
            <?php if ($hours && is_array($hours)): ?>
                <ul aria-label="<?php _e('Opening hours', 'demarchelier'); ?>">
                    <?php foreach ($hours as $hour): ?>
                        <?php if (is_array($hour) && isset($hour['day']) && isset($hour['hours_text'])): ?>
                            <li><?php echo esc_html($hour['day']); ?>: <?php echo esc_html($hour['hours_text']); ?></li>
                        <?php elseif (is_string($hour)): ?>
                            <li><?php echo esc_html($hour); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <ul aria-label="<?php _e('Opening hours', 'demarchelier'); ?>">
                    <li><?php _e('Mon: Closed', 'demarchelier'); ?></li>
                    <li><?php _e('Tue: Closed', 'demarchelier'); ?></li>
                    <li><?php _e('Wed: 12 pm – 9 pm', 'demarchelier'); ?></li>
                    <li><?php _e('Thu: 12 pm – 9 pm', 'demarchelier'); ?></li>
                    <li><?php _e('Fri: 12 pm – 9:30 pm', 'demarchelier'); ?></li>
                    <li><?php _e('Sat: 12 pm – 9:30 pm', 'demarchelier'); ?></li>
                    <li><?php _e('Sun: 12 pm – 8:30 pm', 'demarchelier'); ?></li>
                </ul>
            <?php endif; ?>
        </div>
        <div class="card fade-in-up">
            <h3><?php _e('Location', 'demarchelier'); ?></h3>
            <address>
                <?php 
                if ($contact_info && $contact_info['address']) {
                    echo nl2br(esc_html($contact_info['address']));
                } else {
                    echo '471 Main Street<br>Greenport, NY 11944';
                }
                ?>
            </address>
            <p><a href="https://maps.google.com/?q=471 Main Street Greenport NY" target="_blank" rel="noopener"><?php _e('View on Google Maps', 'demarchelier'); ?></a></p>
        </div>
        <div class="card fade-in-up">
            <h3><?php _e('Contact', 'demarchelier'); ?></h3>
            <p>
                <?php if ($contact_info && $contact_info['phone']): ?>
                    <a href="tel:<?php echo esc_attr($contact_info['phone']); ?>"><?php echo esc_html($contact_info['phone']); ?></a><br>
                <?php else: ?>
                    <a href="tel:+16315931650">1.631.593.1650</a><br>
                <?php endif; ?>
                <?php if ($contact_info && $contact_info['email']): ?>
                    <a href="mailto:<?php echo esc_attr($contact_info['email']); ?>"><?php echo esc_html($contact_info['email']); ?></a>
                <?php else: ?>
                    <a href="mailto:info@demarchelierbistro.com">info@demarchelierbistro.com</a>
                <?php endif; ?>
            </p>
            <p><a class="btn book" href="<?php echo esc_url($resy_link); ?>" target="_blank" rel="noopener"><?php _e('Book a Table', 'demarchelier'); ?></a></p>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section id="gallery" class="gallery-section" aria-label="<?php _e('Art gallery', 'demarchelier'); ?>">
    <div class="container">
        <div class="gallery-content">
            <div class="fade-in-left">
                <h2 class="outlined-heading"><?php _e('Gallery', 'demarchelier'); ?></h2>
                <p><?php _e('Explore artwork from our family collection and the late Eric Demarchelier.', 'demarchelier'); ?></p>
                <a class="btn" href="https://www.ericdemarchelier.com/shop-art" target="_blank" rel="noopener"><?php _e('Visit Gallery Site', 'demarchelier'); ?></a>
            </div>
            <div class="gallery-images fade-in-right">
                <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?q=80&w=1200&auto=format&fit=crop"
                     alt="<?php _e('Warmly lit bistro interior with framed art', 'demarchelier'); ?>">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=1200&auto=format&fit=crop"
                     alt="<?php _e('Elegant artwork on restaurant walls', 'demarchelier'); ?>">
                <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=1200&auto=format&fit=crop"
                     alt="<?php _e('Family art collection display', 'demarchelier'); ?>">
                <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?q=80&w=1200&auto=format&fit=crop"
                     alt="<?php _e('Art gallery atmosphere', 'demarchelier'); ?>">
            </div>
        </div>
    </div>
</section>

<!-- Sign Up Section -->
<section id="signup" class="signup-section" <?php if (get_theme_mod('signup_background')): ?>style="background: linear-gradient(rgba(255,255,255,0.6), rgba(255,255,255,0.7)), url('<?php echo esc_url(get_theme_mod('signup_background')); ?>') center/cover no-repeat;"<?php endif; ?>>
    <div class="container">
        <div class="signup-grid">
            <div class="signup-content fade-in-left">
                <h2 class="outlined-heading"><?php _e('Sign Up', 'demarchelier'); ?></h2>
                <p><?php _e('Receive information about events, artwork, dinner specials, and everything Demarchelier. If you have any questions or comments, we would love to hear from you!', 'demarchelier'); ?></p>
            </div>
            <div class="signup-form fade-in-right">
                <?php echo do_shortcode('[contact-form-7 id="49" title="Demarchelier Contact Form"]'); ?>
            </div>
        </div>
    </div>
</section> 
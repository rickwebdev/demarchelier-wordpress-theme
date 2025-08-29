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
$about_content = get_theme_mod('about_content', 'Since Demarchelier opened in 1978 it has worked to bring a little piece of France to New York City and now the East End of Long Island. Every meal that leaves our kitchen expresses the soul of authentic French <span class="accent-script">bistro</span> fair. We continue to be a family owned and family run restaurant. Our comfortable, colorful, warm, familial spirit makes us a neighborhood fixture, ideal for a quick bite to eat, a romantic rendezvous or a meal with your family. Our traditional French menu is paired perfectly with a wide range of predominantly French wines.');

// Get about images from Customizer
$about_images = array();
$about_image_1 = get_theme_mod('about_image_1');
$about_image_2 = get_theme_mod('about_image_2');
$about_image_3 = get_theme_mod('about_image_3');

if ($about_image_1) $about_images[] = array('url' => $about_image_1);
if ($about_image_2) $about_images[] = array('url' => $about_image_2);
if ($about_image_3) $about_images[] = array('url' => $about_image_3);

// Fallback to ACF if no Customizer images
if (empty($about_images)) {
    $about_images = get_field('about_images', 'option');
}

// Get gallery images from Customizer
$gallery_images = array();
$gallery_image_1 = get_theme_mod('gallery_image_1');
$gallery_image_2 = get_theme_mod('gallery_image_2');
$gallery_image_3 = get_theme_mod('gallery_image_3');
$gallery_image_4 = get_theme_mod('gallery_image_4');

if ($gallery_image_1) $gallery_images[] = array('url' => $gallery_image_1);
if ($gallery_image_2) $gallery_images[] = array('url' => $gallery_image_2);
if ($gallery_image_3) $gallery_images[] = array('url' => $gallery_image_3);
if ($gallery_image_4) $gallery_images[] = array('url' => $gallery_image_4);

// Fallback to ACF if no Customizer images
if (empty($gallery_images)) {
    $gallery_images = get_field('gallery_images', 'option');
}

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
    'email' => get_theme_mod('email', 'demarcheliergreenport@gmail.com'),
);
?>

<!-- Hero Section -->
<section class="hero" role="region" aria-label="Hero">
    <?php if ($hero_images): ?>
        <?php foreach ($hero_images as $index => $image): ?>
            <div class="hero-bg <?php echo $index === 0 ? 'active' : ''; ?>" 
                 style="background-image: url('<?php echo esc_url($image['url']); ?>')"
                 data-fetchpriority="<?php echo $index === 0 ? 'high' : 'auto'; ?>"
                 data-loading="<?php echo $index === 0 ? 'eager' : 'lazy'; ?>"></div>
        <?php endforeach; ?>
    <?php else: ?>
        <!-- Default hero images -->
        <div class="hero-bg active" 
             style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2000&auto=format&fit=crop')"
             data-fetchpriority="high"
             data-loading="eager"></div>
        <div class="hero-bg" 
             style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop')"
             data-fetchpriority="auto"
             data-loading="lazy"></div>
        <div class="hero-bg" 
             style="background-image: url('https://images.unsplash.com/photo-1559339352-11d035aa65de?q=80&w=2000&auto=format&fit=crop')"
             data-fetchpriority="auto"
             data-loading="lazy"></div>
        <div class="hero-bg" 
             style="background-image: url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2000&auto=format&fit=crop')"
             data-fetchpriority="auto"
             data-loading="lazy"></div>
    <?php endif; ?>
    <div class="inner container">
        <div class="hero-brand">DEMARCHELIER</div>
        <h1><?php echo esc_html($hero_title); ?></h1>
        <p class="sub"><?php echo esc_html($hero_subtitle); ?></p>
        <a class="btn book" href="<?php echo esc_url($resy_link); ?>" target="_blank" rel="noopener"><?php _e('Book a Table', 'demarchelier'); ?></a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="about container">
    <div class="about-carousel fade-in-left">
        <?php if ($about_images && is_array($about_images)): ?>
            <?php foreach ($about_images as $index => $image): ?>
                <div class="about-carousel-image <?php echo $index === 0 ? 'active' : ''; ?>" 
                     style="background-image: url('<?php echo esc_url($image['url']); ?>');"
                     data-alt="<?php echo esc_attr($image['alt']); ?>">
                </div>
            <?php endforeach; ?>
            <div class="about-carousel-indicators">
                <?php foreach ($about_images as $index => $image): ?>
                    <div class="about-carousel-indicator <?php echo $index === 0 ? 'active' : ''; ?>" data-index="<?php echo $index; ?>"></div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="about-carousel-image active" 
                 style="background-image: url('https://images.unsplash.com/photo-1519710164239-da123dc03ef4?q=80&w=1600&auto=format&fit=crop');"
                 data-alt="Candlelit bistro tables with framed artwork on the walls">
            </div>
        <?php endif; ?>
    </div>
    <div class="fade-in-right">
        <h2 class="outlined-heading"><?php _e('About', 'demarchelier'); ?></h2>
        <?php if ($about_content): ?>
            <?php echo wp_kses_post($about_content); ?>
        <?php else: ?>
            <p><?php _e('Since Demarchelier opened in 1978 it has worked to bring a little piece of France to New York City and now the East End of Long Island. Every meal that leaves our kitchen expresses the soul of authentic French', 'demarchelier'); ?> <span class="accent-script"><?php _e('bistro', 'demarchelier'); ?></span> <?php _e('fair. We continue to be a family owned and family run restaurant. Our comfortable, colorful, warm, familial spirit makes us a neighborhood fixture, ideal for a quick bite to eat, a romantic rendezvous or a meal with your family. Our traditional French menu is paired perfectly with a wide range of predominantly French wines.', 'demarchelier'); ?></p>
        <?php endif; ?>
        <div class="divider"></div>
        <p class="accent">471 Main Street, Greenport NY</p>
    </div>
</section>

<!-- Menu Section -->
<section id="menu" class="menu" <?php if (get_theme_mod('menu_background')): ?>style="background: linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.9)), url('<?php echo esc_url(get_theme_mod('menu_background')); ?>') center/cover no-repeat;"<?php endif; ?>>
    <div class="container">
        <h2 class="outlined-heading fade-in-up"><?php _e('Menu Highlights', 'demarchelier'); ?></h2>
        <ul class="fade-in-up">
            <?php
            // Get menu items from Customizer settings
            $menu_items = array();
            for ($i = 1; $i <= 8; $i++) {
                $item = get_theme_mod('menu_item_' . $i);
                if (!empty($item)) {
                    $menu_items[] = $item;
                }
            }
            
            // If no Customizer items, fall back to ACF or defaults
            if (empty($menu_items)) {
                if ($menu_items_acf && is_array($menu_items_acf)) {
                    foreach ($menu_items_acf as $item) {
                        if (is_array($item) && isset($item['menu_item'])) {
                            echo '<li>' . esc_html($item['menu_item']) . '</li>';
                        } elseif (is_string($item)) {
                            echo '<li>' . esc_html($item) . '</li>';
                        }
                    }
                } else {
                    // Default fallback items
                    $default_items = array(
                        'Duck Confit with gratin dauphinois',
                        'Steak Frites with bordelaise',
                        'Steak Tartare with pommes dauphine',
                        'Chicken Paillard with mesclun salad',
                        'Roasted Salmon with beurre blanc',
                        'Calf Liver Bordelaise with mashed potatoes',
                        'Onion Soup Gratinée',
                        'Crème Brûlée'
                    );
                    foreach ($default_items as $item) {
                        echo '<li>' . esc_html($item) . '</li>';
                    }
                }
            } else {
                // Display Customizer menu items
                foreach ($menu_items as $item) {
                    echo '<li>' . esc_html($item) . '</li>';
                }
            }
            ?>
        </ul>
        <?php
        // Get menu PDF from Customizer or ACF
        $menu_pdf_url = get_theme_mod('menu_pdf_file');
        if (!$menu_pdf_url && $menu_pdf) {
            $menu_pdf_url = $menu_pdf['url'];
        }
        ?>
        <a class="btn fade-in-up" href="<?php echo esc_url($menu_pdf_url ? $menu_pdf_url : '#'); ?>" target="_blank" rel="noopener" <?php echo !$menu_pdf_url ? 'onclick="alert(\'Menu PDF not yet uploaded. Please contact us for the current menu.\'); return false;"' : ''; ?>><?php _e('Download Full Menu (PDF)', 'demarchelier'); ?></a>
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
            <div class="location-map">
                <iframe 
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8&q=471+Main+Street+Greenport+NY+11944"
                    width="100%" 
                    height="180" 
                    style="border:0; border-radius: 4px; margin-top: 12px;" 
                    allowfullscreen="" 
                    loading="eager"
                    importance="high"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="<?php _e('Demarchelier Bistro Location', 'demarchelier'); ?>">
                </iframe>
            </div>
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
                    <a href="mailto:demarcheliergreenport@gmail.com">demarcheliergreenport@gmail.com</a>
                <?php endif; ?>
            </p>
            <div class="social-icons">
                <?php 
                $instagram = get_theme_mod('instagram', 'https://www.instagram.com/demarchelierbistro/');
                $facebook = get_theme_mod('facebook', 'https://www.facebook.com/demarchelierbistro/');
                ?>
                <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="<?php _e('Follow us on Instagram', 'demarchelier'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="<?php _e('Follow us on Facebook', 'demarchelier'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
            </div>
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
                <p><?php _e('Explore the artwork of Eric Demarchelier.', 'demarchelier'); ?></p>
                <a class="btn" href="https://www.ericdemarchelier.com/shop-art" target="_blank" rel="noopener"><?php _e('Visit Gallery Site', 'demarchelier'); ?></a>
            </div>
            <div class="gallery-images fade-in-right">
                <?php 
                // Debug: Check what we have
                // error_log('Gallery images: ' . print_r($gallery_images, true));
                
                if ($gallery_images && is_array($gallery_images)): 
                    $image_count = 0;
                    foreach ($gallery_images as $image): 
                        $image_count++;
                        // Handle both ACF array format and simple URL format
                        $image_url = '';
                        $image_alt = '';
                        
                        if (is_array($image)) {
                            if (isset($image['url'])) {
                                $image_url = $image['url'];
                            } elseif (isset($image['sizes']['medium'])) {
                                $image_url = $image['sizes']['medium'];
                            } elseif (isset($image['sizes']['thumbnail'])) {
                                $image_url = $image['sizes']['thumbnail'];
                            }
                            
                            if (isset($image['alt'])) {
                                $image_alt = $image['alt'];
                            } elseif (isset($image['title'])) {
                                $image_alt = $image['title'];
                            }
                        } else {
                            $image_url = $image;
                        }
                        
                        if ($image_url): ?>
                            <img src="<?php echo esc_url($image_url); ?>"
                                 alt="<?php echo esc_attr($image_alt); ?>"
                                 width="300"
                                 height="225"
                                 loading="lazy">
                        <?php endif;
                    endforeach; 
                    
                    // If we have fewer than 4 images, fill with defaults
                    while ($image_count < 4): 
                        $image_count++; ?>
                        <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?q=80&w=1200&auto=format&fit=crop"
                             alt="<?php _e('Gallery image', 'demarchelier'); ?>"
                             width="300"
                             height="225"
                             loading="lazy">
                    <?php endwhile;
                else: ?>
                    <!-- Default gallery images -->
                    <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?q=80&w=1200&auto=format&fit=crop"
                         alt="<?php _e('Warmly lit bistro interior with framed art', 'demarchelier'); ?>"
                         width="300"
                         height="225"
                         loading="lazy">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=1200&auto=format&fit=crop"
                         alt="<?php _e('Elegant artwork on restaurant walls', 'demarchelier'); ?>"
                         width="300"
                         height="225"
                         loading="lazy">
                    <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1200&auto=format&fit=crop"
                         alt="<?php _e('Family art collection display', 'demarchelier'); ?>"
                         width="300"
                         height="225"
                         loading="lazy">
                    <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=1200&auto=format&fit=crop"
                         alt="<?php _e('Art gallery atmosphere', 'demarchelier'); ?>"
                         width="300"
                         height="225"
                         loading="lazy">
                <?php endif; ?>
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
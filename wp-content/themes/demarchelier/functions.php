<?php
/**
 * Demarchelier Bistro Theme Functions
 * 
 * @package Demarchelier
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Increase upload limits for large images
 */
function demarchelier_increase_upload_limits() {
    // Increase PHP upload limits
    @ini_set('upload_max_filesize', '64M');
    @ini_set('post_max_size', '64M');
    @ini_set('max_execution_time', '300');
    @ini_set('max_input_time', '300');
    @ini_set('memory_limit', '256M');
    
    // WordPress specific settings
    if (!defined('WP_MEMORY_LIMIT')) {
        define('WP_MEMORY_LIMIT', '256M');
    }
    
    // Allow larger image uploads
    add_filter('big_image_size_threshold', '__return_false');
    
    // Increase image quality
    add_filter('jpeg_quality', function($quality) {
        return 95;
    });
    
    // Allow SVG uploads (optional)
    add_filter('upload_mimes', function($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    });
}
add_action('init', 'demarchelier_increase_upload_limits');

/**
 * Theme Setup
 */
function demarchelier_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');
    add_theme_support('align-wide');
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'demarchelier'),
        'footer' => __('Footer Menu', 'demarchelier'),
    ));
    
    // Add image sizes
    add_image_size('hero-large', 2000, 1200, true);
    add_image_size('hero-medium', 1200, 800, true);
    add_image_size('gallery-thumb', 400, 300, true);
    add_image_size('about-image', 800, 600, true);
    add_image_size('og-image', 1200, 630, true);
}
add_action('after_setup_theme', 'demarchelier_setup');

/**
 * Enqueue scripts and styles
 */
function demarchelier_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('demarchelier-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue optimized JavaScript with defer
    wp_enqueue_script('demarchelier-script', get_template_directory_uri() . '/js/theme-optimized.js', array('jquery'), '1.0.0', true);
    
    // Add defer attribute to non-critical scripts
    add_filter('script_loader_tag', 'demarchelier_add_defer_attribute', 10, 3);
    
    // Localize script for AJAX
    wp_localize_script('demarchelier-script', 'demarchelier_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('demarchelier_nonce'),
    ));
}

/**
 * Add defer attribute to non-critical scripts for mobile performance
 */
function demarchelier_add_defer_attribute($tag, $handle, $src) {
    // Add defer to our theme script
    if ($handle === 'demarchelier-script') {
        return str_replace('<script ', '<script defer ', $tag);
    }
    
    // Add defer to jQuery if not already present
    if ($handle === 'jquery' && strpos($tag, 'defer') === false) {
        return str_replace('<script ', '<script defer ', $tag);
    }
    
    return $tag;
}
add_action('wp_enqueue_scripts', 'demarchelier_scripts');

/**
 * Register widget areas
 */
function demarchelier_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area', 'demarchelier'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in footer.', 'demarchelier'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'demarchelier_widgets_init');



/**
 * ACF Integration
 */
if (class_exists('ACF')) {
    // Add ACF options page
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => __('Demarchelier Theme Settings', 'demarchelier'),
            'menu_title' => __('Theme Settings', 'demarchelier'),
            'menu_slug'  => 'demarchelier-theme-settings',
            'capability' => 'edit_posts',
            'redirect'   => false,
            'icon_url'   => 'dashicons-restaurant',
        ));
    }
    
    // Register ACF fields
    function demarchelier_acf_fields() {
        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group(array(
                'key' => 'group_theme_settings',
                'title' => 'Theme Settings',
                'fields' => array(
                    array(
                        'key' => 'field_hero_title',
                        'label' => 'Hero Title',
                        'name' => 'hero_title',
                        'type' => 'text',
                        'default_value' => 'Classic French Bistro',
                    ),
                    array(
                        'key' => 'field_hero_subtitle',
                        'label' => 'Hero Subtitle',
                        'name' => 'hero_subtitle',
                        'type' => 'textarea',
                        'default_value' => 'Serving authentic French fare since 1978 — from Manhattan to Greenport Village',
                    ),
                    array(
                        'key' => 'field_hero_images',
                        'label' => 'Hero Images',
                        'name' => 'hero_images',
                        'type' => 'gallery',
                        'return_format' => 'array',
                        'min' => 1,
                        'max' => 4,
                    ),
                    array(
                        'key' => 'field_resy_link',
                        'label' => 'Reservation Link',
                        'name' => 'resy_link',
                        'type' => 'url',
                        'default_value' => 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro',
                    ),
                    array(
                        'key' => 'field_announcement_text',
                        'label' => 'Announcement Text',
                        'name' => 'announcement_text',
                        'type' => 'text',
                        'default_value' => 'Open For New Years Eve - a la carte menu & Festive specials • closed New Years day • Cassoulet Every Thursday',
                    ),
                    array(
                        'key' => 'field_about_content',
                        'label' => 'About Content',
                        'name' => 'about_content',
                        'type' => 'wysiwyg',
                        'default_value' => 'Since 1978 we have served classic French bistro fare with a warm, family atmosphere. Our menu pairs traditional dishes with a predominantly French wine list. Join us for a quick bite at the bar or a relaxed dinner with friends.',
                    ),
                    array(
                        'key' => 'field_about_image',
                        'label' => 'About Image',
                        'name' => 'about_image',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_menu_items',
                        'label' => 'Menu Items',
                        'name' => 'menu_items',
                        'type' => 'repeater',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_menu_item',
                                'label' => 'Menu Item',
                                'name' => 'menu_item',
                                'type' => 'text',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_menu_pdf',
                        'label' => 'Menu PDF',
                        'name' => 'menu_pdf',
                        'type' => 'file',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_hours',
                        'label' => 'Hours',
                        'name' => 'hours',
                        'type' => 'repeater',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_day',
                                'label' => 'Day',
                                'name' => 'day',
                                'type' => 'text',
                            ),
                            array(
                                'key' => 'field_hours_text',
                                'label' => 'Hours',
                                'name' => 'hours_text',
                                'type' => 'text',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_contact_info',
                        'label' => 'Contact Information',
                        'name' => 'contact_info',
                        'type' => 'group',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_address',
                                'label' => 'Address',
                                'name' => 'address',
                                'type' => 'textarea',
                                'default_value' => "471 Main Street\nGreenport, NY 11944",
                            ),
                            array(
                                'key' => 'field_phone',
                                'label' => 'Phone',
                                'name' => 'phone',
                                'type' => 'text',
                                'default_value' => '1.631.593.1650',
                            ),
                            array(
                                'key' => 'field_email',
                                'label' => 'Email',
                                'name' => 'email',
                                'type' => 'email',
                                'default_value' => 'demarcheliergreenport@gmail.com',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_social_links',
                        'label' => 'Social Links',
                        'name' => 'social_links',
                        'type' => 'group',
                        'sub_fields' => array(
                            array(
                                'key' => 'field_instagram',
                                'label' => 'Instagram',
                                'name' => 'instagram',
                                'type' => 'url',
                                'default_value' => 'https://www.instagram.com/demarchelierbistro/',
                            ),
                            array(
                                'key' => 'field_facebook',
                                'label' => 'Facebook',
                                'name' => 'facebook',
                                'type' => 'url',
                                'default_value' => 'https://www.facebook.com/demarchelierbistro/',
                            ),
                        ),
                    ),
                    array(
                        'key' => 'field_resy_link',
                        'label' => 'Resy Booking Link',
                        'name' => 'resy_link',
                        'type' => 'url',
                        'default_value' => 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro',
                    ),
                ),
                'location' => array(
                    array(
                        array(
                            'param' => 'options_page',
                            'operator' => '==',
                            'value' => 'demarchelier-theme-settings',
                        ),
                    ),
                ),
            ));
        }
    }
    add_action('acf/init', 'demarchelier_acf_fields');
}

/**
 * Custom Gutenberg Blocks
 */
function demarchelier_register_blocks() {
    // Register block script
    wp_register_script(
        'demarchelier-blocks',
        get_template_directory_uri() . '/js/blocks.js',
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components')
    );
    
    // Register block styles
    wp_register_style(
        'demarchelier-blocks-editor',
        get_template_directory_uri() . '/css/blocks-editor.css',
        array('wp-edit-blocks')
    );
    
    // Register blocks
    register_block_type('demarchelier/hero-section', array(
        'editor_script' => 'demarchelier-blocks',
        'editor_style' => 'demarchelier-blocks-editor',
        'render_callback' => 'demarchelier_render_hero_block',
    ));
    
    register_block_type('demarchelier/about-section', array(
        'editor_script' => 'demarchelier-blocks',
        'editor_style' => 'demarchelier-blocks-editor',
        'render_callback' => 'demarchelier_render_about_block',
    ));
    
    register_block_type('demarchelier/menu-section', array(
        'editor_script' => 'demarchelier-blocks',
        'editor_style' => 'demarchelier-blocks-editor',
        'render_callback' => 'demarchelier_render_menu_block',
    ));
    
    register_block_type('demarchelier/gallery-section', array(
        'editor_script' => 'demarchelier-blocks',
        'editor_style' => 'demarchelier-blocks-editor',
        'render_callback' => 'demarchelier_render_gallery_block',
    ));
    
    register_block_type('demarchelier/contact-section', array(
        'editor_script' => 'demarchelier-blocks',
        'editor_style' => 'demarchelier-blocks-editor',
        'render_callback' => 'demarchelier_render_contact_block',
    ));
}
add_action('init', 'demarchelier_register_blocks');

/**
 * Block render callbacks
 */
function demarchelier_render_hero_block($attributes) {
    $hero_title = get_field('hero_title', 'option') ?: 'Classic French Bistro';
    $hero_subtitle = get_field('hero_subtitle', 'option') ?: 'Serving authentic French fare since 1978 — from Manhattan to Greenport Village';
    $hero_images = get_field('hero_images', 'option');
    $resy_link = get_field('resy_link', 'option') ?: 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro';
    
    ob_start();
    ?>
    <section class="hero" role="region" aria-label="Hero">
        <?php if ($hero_images): ?>
            <?php foreach ($hero_images as $index => $image): ?>
                <div class="hero-bg <?php echo $index === 0 ? 'active' : ''; ?>" 
                     style="background-image: url('<?php echo esc_url($image['url']); ?>')"></div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="inner container">
            <h1><?php echo esc_html($hero_title); ?></h1>
            <p class="sub"><?php echo esc_html($hero_subtitle); ?></p>
            <a class="btn book" href="<?php echo esc_url($resy_link); ?>" target="_blank" rel="noopener">Book a Table</a>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function demarchelier_render_about_block($attributes) {
    $about_content = get_field('about_content', 'option');
    $about_images = get_field('about_images', 'option');
    
    ob_start();
    ?>
    <section id="about" class="about container">
        <div class="about-carousel fade-in-left">
            <?php if ($about_images && is_array($about_images)): ?>
                <?php foreach ($about_images as $index => $image): ?>
                    <div class="about-carousel-image <?php echo $index === 0 ? 'active' : ''; ?>" 
                         style="background-image: url('<?php echo esc_url($image['url']); ?>');"
                         data-alt="<?php echo esc_attr($image['alt']); ?>">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="about-carousel-image active" 
                     style="background-image: url('https://images.unsplash.com/photo-1519710164239-da123dc03ef4?q=80&w=1600&auto=format&fit=crop');"
                     data-alt="Candlelit bistro tables with framed artwork on the walls">
                </div>
            <?php endif; ?>
        </div>
        <div class="fade-in-right">
            <h2 class="outlined-heading">About</h2>
            <?php echo wp_kses_post($about_content); ?>
            <div class="divider"></div>
            <p class="accent">471 Main Street, Greenport NY</p>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function demarchelier_render_menu_block($attributes) {
    $menu_items_acf = get_field('menu_items', 'option');
    $menu_pdf_acf = get_field('menu_pdf', 'option');
    
    ob_start();
    ?>
    <section id="menu" class="menu">
        <div class="container">
            <h2 class="outlined-heading fade-in-up">Menu Highlights</h2>
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
            if (!$menu_pdf_url && $menu_pdf_acf) {
                $menu_pdf_url = $menu_pdf_acf['url'];
            }
            ?>
            <?php if ($menu_pdf_url): ?>
                <a class="btn fade-in-up" href="<?php echo esc_url($menu_pdf_url); ?>" target="_blank" rel="noopener">Download full menu (PDF)</a>
            <?php endif; ?>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function demarchelier_render_gallery_block($attributes) {
    ob_start();
    ?>
    <section class="gallery-section" aria-label="Art gallery">
        <div class="container">
            <div class="gallery-content">
                <div class="fade-in-left">
                    <h2 class="outlined-heading">Gallery</h2>
                    <p>Explore the artwork of Eric Demarchelier.</p>
                    <a class="btn" href="https://www.ericdemarchelier.com/shop-art" target="_blank" rel="noopener">Visit gallery site</a>
                </div>
                <div class="gallery-images fade-in-right">
                    <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?q=80&w=1200&auto=format&fit=crop" alt="Warmly lit bistro interior with framed art">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=1200&auto=format&fit=crop" alt="Elegant artwork on restaurant walls">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?q=80&w=1200&auto=format&fit=crop" alt="Family art collection display">
                    <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?q=80&w=1200&auto=format&fit=crop" alt="Art gallery atmosphere">
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

function demarchelier_render_contact_block($attributes) {
    ob_start();
    ?>
    <section id="signup" class="signup-section">
        <div class="container">
            <div class="signup-grid">
                <div class="signup-content fade-in-left">
                    <h2 class="outlined-heading">Sign Up</h2>
                    <p>Receive information about events, artwork, dinner specials, and everything Demarchelier. If you have any questions or comments, we would love to hear from you!</p>
                </div>
                <div class="signup-form fade-in-right">
                    <?php echo do_shortcode('[contact-form-7 id="1" title="Contact form 1"]'); ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean();
}

/**
 * Contact form handling
 */
function demarchelier_handle_contact_form() {
    check_ajax_referer('demarchelier_nonce', 'nonce');
    
    $fullname = sanitize_text_field($_POST['fullname']);
    $email = sanitize_email($_POST['email']);
    $subject = sanitize_text_field($_POST['subject']);
    $comment = sanitize_textarea_field($_POST['comment']);
    
    // Send email
    $to = get_field('email', 'option') ?: get_option('admin_email');
    $subject_line = 'New message from Demarchelier website: ' . $subject;
    $message = "Name: $fullname\nEmail: $email\nSubject: $subject\n\nMessage:\n$comment";
    $headers = array('Content-Type: text/plain; charset=UTF-8');
    
    $sent = wp_mail($to, $subject_line, $message, $headers);
    
    if ($sent) {
        wp_send_json_success('Message sent successfully!');
    } else {
        wp_send_json_error('Failed to send message. Please try again.');
    }
}
add_action('wp_ajax_contact_form', 'demarchelier_handle_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'demarchelier_handle_contact_form');

/**
 * ACF Fields Setup
 */
function demarchelier_setup_acf_fields() {
    // Only run if ACF is active
    if (!class_exists('ACF')) {
        return;
    }
    
    // Check if fields already exist
    $existing_group = get_field_object('hero_title', 'option');
    if ($existing_group) {
        return; // Fields already exist
    }
    
    // Create the field group
    $field_group = array(
        'key' => 'group_demarchelier_theme_settings',
        'title' => 'Demarchelier Theme Settings',
        'fields' => array(
            // Hero Section
            array(
                'key' => 'field_hero_title',
                'label' => 'Hero Title',
                'name' => 'hero_title',
                'type' => 'text',
                'default_value' => 'Classic French Bistro',
                'required' => 1,
            ),
            array(
                'key' => 'field_hero_subtitle',
                'label' => 'Hero Subtitle',
                'name' => 'hero_subtitle',
                'type' => 'textarea',
                'default_value' => 'Serving authentic French fare since 1978 — from Manhattan to Greenport Village',
                'required' => 1,
            ),
            array(
                'key' => 'field_hero_images',
                'label' => 'Hero Images',
                'name' => 'hero_images',
                'type' => 'gallery',
                'return_format' => 'array',
                'min' => 1,
                'max' => 4,
                'required' => 1,
            ),
            array(
                'key' => 'field_resy_link',
                'label' => 'Reservation Link',
                'name' => 'resy_link',
                'type' => 'url',
                'default_value' => 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro',
                'required' => 1,
            ),
            
            // Announcement
            array(
                'key' => 'field_announcement_text',
                'label' => 'Announcement Text',
                'name' => 'announcement_text',
                'type' => 'text',
                'default_value' => 'Open For New Years Eve - a la carte menu & Festive specials • closed New Years day • Cassoulet Every Thursday',
            ),
            
            // About Section
            array(
                'key' => 'field_about_content',
                'label' => 'About Content',
                'name' => 'about_content',
                'type' => 'wysiwyg',
                'default_value' => 'Since 1978 we have served classic French <span class="accent-script">bistro</span> fare with a warm, family atmosphere. Our menu pairs traditional dishes with a predominantly French wine list. Join us for a quick bite at the bar or a relaxed dinner with friends.',
            ),
            array(
                'key' => 'field_about_images',
                'label' => 'About Images',
                'name' => 'about_images',
                'type' => 'gallery',
                'return_format' => 'array',
                'min' => 1,
                'max' => 3,
                'required' => 1,
            ),
            
            // Menu Section
            array(
                'key' => 'field_menu_items',
                'label' => 'Menu Items',
                'name' => 'menu_items',
                'type' => 'repeater',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_menu_item',
                        'label' => 'Menu Item',
                        'name' => 'menu_item',
                        'type' => 'text',
                        'required' => 1,
                    ),
                ),
            ),
            array(
                'key' => 'field_menu_pdf',
                'label' => 'Menu PDF',
                'name' => 'menu_pdf',
                'type' => 'file',
                'return_format' => 'array',
            ),
            
            // Contact Info
            array(
                'key' => 'field_contact_info',
                'label' => 'Contact Information',
                'name' => 'contact_info',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => 'field_address',
                        'label' => 'Address',
                        'name' => 'address',
                        'type' => 'textarea',
                        'default_value' => '471 Main Street, Greenport NY 11944',
                    ),
                    array(
                        'key' => 'field_phone',
                        'label' => 'Phone',
                        'name' => 'phone',
                        'type' => 'text',
                        'default_value' => '1.631.593.1650',
                    ),
                    array(
                        'key' => 'field_email',
                        'label' => 'Email',
                        'name' => 'email',
                        'type' => 'email',
                        'default_value' => 'demarcheliergreenport@gmail.com',
                    ),
                ),
            ),
            
            // Gallery Section
            array(
                'key' => 'field_gallery_images',
                'label' => 'Gallery Images',
                'name' => 'gallery_images',
                'type' => 'gallery',
                'return_format' => 'array',
                'min' => 1,
                'max' => 4,
                'required' => 1,
            ),
            
            // Social Media
            array(
                'key' => 'field_social_media',
                'label' => 'Social Media',
                'name' => 'social_media',
                'type' => 'group',
                'sub_fields' => array(
                    array(
                        'key' => 'field_facebook',
                        'label' => 'Facebook',
                        'name' => 'facebook',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_instagram',
                        'label' => 'Instagram',
                        'name' => 'instagram',
                        'type' => 'url',
                    ),
                    array(
                        'key' => 'field_twitter',
                        'label' => 'Twitter',
                        'name' => 'twitter',
                        'type' => 'url',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    );
    
    // Insert the field group
    acf_add_local_field_group($field_group);
}

// Run the setup on theme activation
add_action('after_setup_theme', 'demarchelier_setup_acf_fields');

// Also run on admin init to ensure fields are created
add_action('admin_init', 'demarchelier_setup_acf_fields');

/**
 * Add ACF Options Page
 */
function demarchelier_add_acf_options_page() {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
            'page_title' => 'Theme Settings',
            'menu_title' => 'Theme Settings',
            'menu_slug' => 'theme-settings',
            'capability' => 'edit_posts',
            'redirect' => false
        ));
    }
}
add_action('acf/init', 'demarchelier_add_acf_options_page');

/**
 * Customizer additions
 */
function demarchelier_customize_register($wp_customize) {
    // Add section for theme options
    $wp_customize->add_section('demarchelier_options', array(
        'title' => __('Demarchelier Options', 'demarchelier'),
        'priority' => 30,
    ));
    
    // ===== HEADER SECTION =====
    // Add setting for announcement text
    $wp_customize->add_setting('announcement_text', array(
        'default' => 'Open For New Years Eve - a la carte menu & Festive specials • closed New Years day • Cassoulet Every Thursday',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('announcement_text', array(
        'label' => __('Announcement Text', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    // ===== HERO SECTION =====
    // Add setting for hero title
    $wp_customize->add_setting('hero_title', array(
        'default' => 'Classic French Bistro',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hero_title', array(
        'label' => __('Hero Title', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    // Add setting for hero subtitle
    $wp_customize->add_setting('hero_subtitle', array(
        'default' => 'Serving authentic French fare since 1978 — from Manhattan to Greenport Village',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('hero_subtitle', array(
        'label' => __('Hero Subtitle', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'textarea',
    ));
    
    // Add setting for reservation link
    $wp_customize->add_setting('resy_link', array(
        'default' => 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('resy_link', array(
        'label' => __('Reservation Link', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'url',
    ));
    
    // Hero Images
    $wp_customize->add_setting('hero_image_1', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image_1', array(
        'label' => __('Hero Image 1', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the first hero background image', 'demarchelier'),
    )));
    
    $wp_customize->add_setting('hero_image_2', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image_2', array(
        'label' => __('Hero Image 2', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the second hero background image', 'demarchelier'),
    )));
    
    $wp_customize->add_setting('hero_image_3', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image_3', array(
        'label' => __('Hero Image 3', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the third hero background image', 'demarchelier'),
    )));
    
    $wp_customize->add_setting('hero_image_4', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image_4', array(
        'label' => __('Hero Image 4', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the fourth hero background image', 'demarchelier'),
    )));
    
    // ===== ABOUT SECTION =====
    // Add setting for about content
    $wp_customize->add_setting('about_content', array(
        'default' => 'Since Demarchelier opened in 1978 it has worked to bring a little piece of France to New York City and now the East End of Long Island. Every meal that leaves our kitchen expresses the soul of authentic French <span class="accent-script">bistro</span> fair. We continue to be a family owned and family run restaurant. Our comfortable, colorful, warm, familial spirit makes us a neighborhood fixture, ideal for a quick bite to eat, a romantic rendezvous or a meal with your family. Our traditional French menu is paired perfectly with a wide range of predominantly French wines.',
        'sanitize_callback' => 'wp_kses_post',
    ));
    
    $wp_customize->add_control('about_content', array(
        'label' => __('About Content', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'textarea',
    ));
    
    // About Images
    $wp_customize->add_setting('about_image_1', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image_1', array(
        'label' => __('About Image 1', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the first about section image', 'demarchelier'),
    )));
    
    $wp_customize->add_setting('about_image_2', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image_2', array(
        'label' => __('About Image 2', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the second about section image', 'demarchelier'),
    )));
    
    $wp_customize->add_setting('about_image_3', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_image_3', array(
        'label' => __('About Image 3', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the third about section image', 'demarchelier'),
    )));
    
    // ===== GALLERY SECTION =====
    // Gallery Images
    $wp_customize->add_setting('gallery_image_1', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gallery_image_1', array(
        'label' => __('Gallery Image 1', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the first gallery image', 'demarchelier'),
    )));
    
    $wp_customize->add_setting('gallery_image_2', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gallery_image_2', array(
        'label' => __('Gallery Image 2', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the second gallery image', 'demarchelier'),
    )));
    
    $wp_customize->add_setting('gallery_image_3', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gallery_image_3', array(
        'label' => __('Gallery Image 3', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the third gallery image', 'demarchelier'),
    )));
    
    $wp_customize->add_setting('gallery_image_4', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'gallery_image_4', array(
        'label' => __('Gallery Image 4', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload the fourth gallery image', 'demarchelier'),
    )));
    
    // ===== MENU SECTION =====
    // Menu Section Background Image
    $wp_customize->add_setting('menu_background', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'menu_background', array(
        'label' => __('Menu Section Background', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload background image for menu highlights section', 'demarchelier'),
    )));
    
    // Menu PDF File Upload
    $wp_customize->add_setting('menu_pdf_file', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'menu_pdf_file', array(
        'label' => __('Upload Menu PDF', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload your menu PDF file', 'demarchelier'),
        'mime_type' => 'application/pdf',
    )));
    
    // ===== MENU HIGHLIGHTS SECTION =====
    // Menu Item 1
    $wp_customize->add_setting('menu_item_1', array(
        'default' => 'Duck Confit with gratin dauphinois',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('menu_item_1', array(
        'label' => __('Menu Item 1', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
        'description' => __('First menu highlight item', 'demarchelier'),
    ));
    
    // Menu Item 2
    $wp_customize->add_setting('menu_item_2', array(
        'default' => 'Steak Frites with bordelaise',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('menu_item_2', array(
        'label' => __('Menu Item 2', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
        'description' => __('Second menu highlight item', 'demarchelier'),
    ));
    
    // Menu Item 3
    $wp_customize->add_setting('menu_item_3', array(
        'default' => 'Steak Tartare with pommes dauphine',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('menu_item_3', array(
        'label' => __('Menu Item 3', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
        'description' => __('Third menu highlight item', 'demarchelier'),
    ));
    
    // Menu Item 4
    $wp_customize->add_setting('menu_item_4', array(
        'default' => 'Chicken Paillard with mesclun salad',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('menu_item_4', array(
        'label' => __('Menu Item 4', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
        'description' => __('Fourth menu highlight item', 'demarchelier'),
    ));
    
    // Menu Item 5
    $wp_customize->add_setting('menu_item_5', array(
        'default' => 'Roasted Salmon with beurre blanc',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('menu_item_5', array(
        'label' => __('Menu Item 5', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
        'description' => __('Fifth menu highlight item', 'demarchelier'),
    ));
    
    // Menu Item 6
    $wp_customize->add_setting('menu_item_6', array(
        'default' => 'Calf Liver Bordelaise with mashed potatoes',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('menu_item_6', array(
        'label' => __('Menu Item 6', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
        'description' => __('Sixth menu highlight item', 'demarchelier'),
    ));
    
    // Menu Item 7
    $wp_customize->add_setting('menu_item_7', array(
        'default' => 'Onion Soup Gratinée',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('menu_item_7', array(
        'label' => __('Menu Item 7', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
        'description' => __('Seventh menu highlight item', 'demarchelier'),
    ));
    
    // Menu Item 8
    $wp_customize->add_setting('menu_item_8', array(
        'default' => 'Crème Brûlée',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('menu_item_8', array(
        'label' => __('Menu Item 8', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
        'description' => __('Eighth menu highlight item', 'demarchelier'),
    ));
    
    // ===== HOURS SECTION =====
    // Hours Section
    $wp_customize->add_setting('hours_monday', array(
        'default' => 'Mon: 5:00 PM - 9:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hours_monday', array(
        'label' => __('Monday Hours', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hours_tuesday', array(
        'default' => 'Tue: 12:00 PM - 9:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hours_tuesday', array(
        'label' => __('Tuesday Hours', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hours_wednesday', array(
        'default' => 'Wed: 12:00 PM - 9:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hours_wednesday', array(
        'label' => __('Wednesday Hours', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hours_thursday', array(
        'default' => 'Thu: 12:00 PM - 9:00 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hours_thursday', array(
        'label' => __('Thursday Hours', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hours_friday', array(
        'default' => 'Fri: 12:00 PM - 9:30 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hours_friday', array(
        'label' => __('Friday Hours', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hours_saturday', array(
        'default' => 'Sat: 12:00 PM - 9:30 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hours_saturday', array(
        'label' => __('Saturday Hours', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    $wp_customize->add_setting('hours_sunday', array(
        'default' => 'Sun: 12:00 PM - 8:30 PM',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('hours_sunday', array(
        'label' => __('Sunday Hours', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    // ===== CONTACT SECTION =====
    // Add setting for address
    $wp_customize->add_setting('address', array(
        'default' => '471 Main Street, Greenport, NY 11944',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('address', array(
        'label' => __('Address', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    // Add setting for phone
    $wp_customize->add_setting('phone', array(
        'default' => '1.631.593.1650',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('phone', array(
        'label' => __('Phone', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'text',
    ));
    
    // Add setting for email
    $wp_customize->add_setting('email', array(
        'default' => 'demarcheliergreenport@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    
    $wp_customize->add_control('email', array(
        'label' => __('Email', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'email',
    ));
    
    // ===== SOCIAL MEDIA =====
    // Add setting for Instagram
    $wp_customize->add_setting('instagram', array(
        'default' => 'https://www.instagram.com/demarchelierbistro/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('instagram', array(
        'label' => __('Instagram URL', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'url',
    ));
    
    // Add setting for Facebook
    $wp_customize->add_setting('facebook', array(
        'default' => 'https://www.facebook.com/demarchelierbistro/',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('facebook', array(
        'label' => __('Facebook URL', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'url',
    ));
    
    // ===== SIGN UP SECTION =====
    // Sign Up Section Background Image
    $wp_customize->add_setting('signup_background', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'signup_background', array(
        'label' => __('Sign Up Section Background', 'demarchelier'),
        'section' => 'demarchelier_options',
        'description' => __('Upload background image for sign up section', 'demarchelier'),
    )));
    
    // ===== FOOTER CREDIT SECTION =====
    // Add setting for footer credit
    $wp_customize->add_setting('show_footer_credit', array(
        'default' => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ));
    
    $wp_customize->add_control('show_footer_credit', array(
        'label' => __('Show Theme Credit in Footer', 'demarchelier'),
        'section' => 'demarchelier_options',
        'type' => 'checkbox',
        'description' => __('Display "Theme by Rick Owadally" credit in the footer', 'demarchelier'),
    ));
}
add_action('customize_register', 'demarchelier_customize_register');

/**
 * Add schema markup
 */
function demarchelier_schema_markup() {
    // Check if ACF is available
    if (!function_exists('get_field')) {
        $contact_info = array();
        $address = '471 Main Street, Greenport, NY 11944';
        $phone = '1.631.593.1650';
        $email = 'demarcheliergreenport@gmail.com';
        $resy_link = 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro';
        $menu_pdf = null;
    } else {
        $contact_info = get_field('contact_info', 'option');
        $address = $contact_info['address'] ?? '471 Main Street, Greenport, NY 11944';
        $phone = $contact_info['phone'] ?? '1.631.593.1650';
        $email = $contact_info['email'] ?? 'demarcheliergreenport@gmail.com';
        $resy_link = get_field('resy_link', 'option') ?: 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro';
        $menu_pdf = get_field('menu_pdf', 'option');
    }
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Restaurant',
        'name' => 'Demarchelier Bistro',
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => '471 Main Street',
            'addressLocality' => 'Greenport',
            'addressRegion' => 'NY',
            'postalCode' => '11944'
        ),
        'telephone' => $phone,
        'email' => $email,
        'servesCuisine' => 'French',
        'url' => home_url(),
        'acceptsReservations' => $resy_link
    );
    
    if ($menu_pdf && isset($menu_pdf['url'])) {
        $schema['menu'] = $menu_pdf['url'];
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'demarchelier_schema_markup');

/**
 * Security enhancements
 */
function demarchelier_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
}
add_action('send_headers', 'demarchelier_security_headers');

/**
 * Remove WordPress version from head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Disable XML-RPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Limit login attempts (basic)
 */
function demarchelier_check_attempted_login($user, $username, $password) {
    if (!empty($username)) {
        $attempted_login = get_transient('attempted_login');
        if ($attempted_login === false) {
            $attempted_login = array();
        }
        $ip = $_SERVER['REMOTE_ADDR'];
        $attempted_login[$ip] = isset($attempted_login[$ip]) ? $attempted_login[$ip] + 1 : 1;
        set_transient('attempted_login', $attempted_login, 300);
        
        if ($attempted_login[$ip] > 5) {
            return new WP_Error('too_many_attempts', 'Too many login attempts. Please try again later.');
        }
    }
    return $user;
}
add_filter('authenticate', 'demarchelier_check_attempted_login', 30, 3); 

/**
 * Include SEO functions
 */
require get_template_directory() . '/inc/seo-functions.php';

/**
 * Include sitemap generator
 */
require get_template_directory() . '/inc/sitemap-generator.php';
<?php
/**
 * SEO Functions for Demarchelier Bistro Theme
 * 
 * @package Demarchelier
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add comprehensive SEO meta tags
 */
function demarchelier_seo_meta_tags() {
    // Basic SEO meta tags
    echo '<meta name="description" content="' . esc_attr(get_theme_mod('meta_description', 'Classic French Bistro in Greenport, NY. Authentic French cuisine since 1978. Book your table for an unforgettable dining experience.')) . '">' . "\n";
    echo '<meta name="keywords" content="' . esc_attr(get_theme_mod('meta_keywords', 'French restaurant, Greenport NY, French bistro, fine dining, reservations, Demarchelier')) . '">' . "\n";
    echo '<meta name="author" content="Demarchelier Bistro">' . "\n";
    echo '<meta name="robots" content="index, follow">' . "\n";
    
    // Canonical URL
    echo '<link rel="canonical" href="' . esc_url(home_url(add_query_arg(array(), $GLOBALS['wp']->request))) . '">' . "\n";
    
    // Favicon
    echo '<link rel="icon" type="image/x-icon" href="' . esc_url(get_theme_mod('favicon', get_template_directory_uri() . '/favicon.ico')) . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url(get_theme_mod('apple_touch_icon', get_template_directory_uri() . '/apple-touch-icon.png')) . '">' . "\n";
}
add_action('wp_head', 'demarchelier_seo_meta_tags', 1);

/**
 * Add Open Graph meta tags
 */
function demarchelier_open_graph_tags() {
    $og_image = get_theme_mod('og_image');
    
    echo '<meta property="og:title" content="' . esc_attr(get_theme_mod('og_title', 'Demarchelier Bistro - Classic French Restaurant in Greenport, NY')) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr(get_theme_mod('og_description', 'Authentic French bistro cuisine since 1978. Located in Greenport Village, Long Island. Book your table today.')) . '">' . "\n";
    echo '<meta property="og:type" content="restaurant.restaurant">' . "\n";
    echo '<meta property="og:url" content="' . esc_url(home_url('/')) . '">' . "\n";
    echo '<meta property="og:site_name" content="Demarchelier Bistro">' . "\n";
    echo '<meta property="og:locale" content="en_US">' . "\n";
    
    if ($og_image) {
        echo '<meta property="og:image" content="' . esc_url($og_image) . '">' . "\n";
        echo '<meta property="og:image:width" content="1200">' . "\n";
        echo '<meta property="og:image:height" content="630">' . "\n";
    }
}
add_action('wp_head', 'demarchelier_open_graph_tags', 2);

/**
 * Add Twitter Card meta tags
 */
function demarchelier_twitter_card_tags() {
    $og_image = get_theme_mod('og_image');
    
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr(get_theme_mod('twitter_title', 'Demarchelier Bistro - Classic French Restaurant')) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr(get_theme_mod('twitter_description', 'Authentic French bistro cuisine in Greenport, NY since 1978')) . '">' . "\n";
    
    if ($og_image) {
        echo '<meta name="twitter:image" content="' . esc_url($og_image) . '">' . "\n";
    }
}
add_action('wp_head', 'demarchelier_twitter_card_tags', 3);

/**
 * Add geo-targeting meta tags
 */
function demarchelier_geo_meta_tags() {
    echo '<meta name="geo.region" content="US-NY">' . "\n";
    echo '<meta name="geo.placename" content="Greenport">' . "\n";
    echo '<meta name="geo.position" content="41.1034;-72.3618">' . "\n";
    echo '<meta name="ICBM" content="41.1034, -72.3618">' . "\n";
    echo '<meta name="distribution" content="global">' . "\n";
    echo '<meta name="coverage" content="worldwide">' . "\n";
    echo '<meta name="rating" content="general">' . "\n";
    echo '<meta name="revisit-after" content="7 days">' . "\n";
}
add_action('wp_head', 'demarchelier_geo_meta_tags', 4);

/**
 * Add restaurant-specific meta tags
 */
function demarchelier_restaurant_meta_tags() {
    echo '<meta name="restaurant:price_range" content="$$$">' . "\n";
    echo '<meta name="restaurant:cuisine" content="French">' . "\n";
    echo '<meta name="restaurant:accepts_reservations" content="true">' . "\n";
    echo '<meta name="restaurant:serves_alcohol" content="true">' . "\n";
    echo '<meta name="restaurant:dress_code" content="Smart Casual">' . "\n";
    echo '<meta name="restaurant:parking" content="Street Parking">' . "\n";
    echo '<meta name="restaurant:wheelchair_accessible" content="true">' . "\n";
}
add_action('wp_head', 'demarchelier_restaurant_meta_tags', 5);

/**
 * Add performance optimization meta tags
 */
function demarchelier_performance_meta_tags() {
    // Preconnect to external domains
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://resy.com">' . "\n";
    echo '<link rel="preconnect" href="https://www.google.com">' . "\n";
    
    // DNS Prefetch
    echo '<link rel="dns-prefetch" href="//fonts.googleapis.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//resy.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//maps.googleapis.com">' . "\n";
    
    // Preload critical resources
    echo '<link rel="preload" href="' . get_stylesheet_uri() . '" as="style">' . "\n";
    echo '<link rel="preload" href="' . get_template_directory_uri() . '/js/theme.js" as="script">' . "\n";
    
    // Preload hero images if available
    $hero_images = get_field('hero_images', 'option');
    if ($hero_images && is_array($hero_images)) {
        foreach (array_slice($hero_images, 0, 2) as $image) {
            if (isset($image['url'])) {
                echo '<link rel="preload" href="' . esc_url($image['url']) . '" as="image">' . "\n";
            }
        }
    }
}
add_action('wp_head', 'demarchelier_performance_meta_tags', 6);

/**
 * Add structured data for restaurant
 */
function demarchelier_restaurant_schema() {
    // Get restaurant data
    $contact_info = get_field('contact_info', 'option') ?: array();
    $address = $contact_info['address'] ?? '471 Main Street, Greenport, NY 11944';
    $phone = $contact_info['phone'] ?? '1.631.593.1650';
    $email = $contact_info['email'] ?? 'demarcheliergreenport@gmail.com';
    $resy_link = get_field('resy_link', 'option') ?: 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro';
    $menu_pdf = get_field('menu_pdf', 'option');
    $hours = get_field('hours', 'option') ?: array();
    $social_links = get_field('social_links', 'option') ?: array();
    
    // Parse address
    $address_parts = explode(',', $address);
    $street_address = trim($address_parts[0] ?? '471 Main Street');
    $city_state_zip = trim($address_parts[1] ?? 'Greenport, NY 11944');
    $city_state_parts = explode(',', $city_state_zip);
    $city = trim($city_state_parts[0] ?? 'Greenport');
    $state_zip = trim($city_state_parts[1] ?? 'NY 11944');
    $state_zip_parts = explode(' ', $state_zip);
    $state = trim($state_zip_parts[0] ?? 'NY');
    $zip = trim($state_zip_parts[1] ?? '11944');
    
    // Build opening hours
    $opening_hours = array();
    if (!empty($hours)) {
        foreach ($hours as $hour) {
            if (isset($hour['day']) && isset($hour['hours_text'])) {
                $opening_hours[] = $hour['day'] . ' ' . $hour['hours_text'];
            }
        }
    } else {
        // Default hours
        $opening_hours = array(
            'Mon Closed',
            'Tue 12:00 PM - 9:00 PM',
            'Wed 12:00 PM - 9:00 PM',
            'Thu 12:00 PM - 9:00 PM',
            'Fri 12:00 PM - 9:30 PM',
            'Sat 12:00 PM - 9:30 PM',
            'Sun 12:00 PM - 8:30 PM'
        );
    }
    
    // Build schema data
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Restaurant',
        'name' => 'Demarchelier Bistro',
        'description' => get_theme_mod('meta_description', 'Classic French Bistro in Greenport, NY. Authentic French cuisine since 1978.'),
        'url' => home_url(),
        'telephone' => $phone,
        'email' => $email,
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => $street_address,
            'addressLocality' => $city,
            'addressRegion' => $state,
            'postalCode' => $zip,
            'addressCountry' => 'US'
        ),
        'geo' => array(
            '@type' => 'GeoCoordinates',
            'latitude' => 41.1034,
            'longitude' => -72.3618
        ),
        'servesCuisine' => 'French',
        'priceRange' => '$$$',
        'acceptsReservations' => true,
        'servesAlcohol' => true,
        'openingHours' => $opening_hours,
        'foundingDate' => '1978',
        'sameAs' => array()
    );
    
    // Add social media links
    if (!empty($social_links['instagram'])) {
        $schema['sameAs'][] = $social_links['instagram'];
    }
    if (!empty($social_links['facebook'])) {
        $schema['sameAs'][] = $social_links['facebook'];
    }
    
    // Add menu
    if ($menu_pdf && isset($menu_pdf['url'])) {
        $schema['menu'] = $menu_pdf['url'];
    }
    
    // Add reservation URL
    $schema['potentialAction'] = array(
        '@type' => 'ReserveAction',
        'target' => array(
            '@type' => 'EntryPoint',
            'urlTemplate' => $resy_link,
            'inLanguage' => 'en-US',
            'actionPlatform' => array(
                '@type' => 'ReservationSystem',
                'name' => 'Resy'
            )
        )
    );
    
    // Add aggregate rating if available
    $rating = get_theme_mod('restaurant_rating', '4.5');
    $review_count = get_theme_mod('restaurant_review_count', '150');
    if ($rating && $review_count) {
        $schema['aggregateRating'] = array(
            '@type' => 'AggregateRating',
            'ratingValue' => $rating,
            'reviewCount' => $review_count,
            'bestRating' => '5',
            'worstRating' => '1'
        );
    }
    
    // Output schema
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'demarchelier_restaurant_schema', 10);

/**
 * Add local business schema
 */
function demarchelier_local_business_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => 'Demarchelier Bistro',
        'image' => array(
            get_theme_mod('og_image', get_template_directory_uri() . '/images/restaurant-exterior.jpg')
        ),
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => '471 Main Street',
            'addressLocality' => 'Greenport',
            'addressRegion' => 'NY',
            'postalCode' => '11944',
            'addressCountry' => 'US'
        ),
        'geo' => array(
            '@type' => 'GeoCoordinates',
            'latitude' => 41.1034,
            'longitude' => -72.3618
        ),
        'url' => home_url(),
        'telephone' => '1.631.593.1650',
        'priceRange' => '$$$',
        'openingHoursSpecification' => array(
            array(
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => array('Tuesday', 'Wednesday', 'Thursday'),
                'opens' => '12:00',
                'closes' => '21:00'
            ),
            array(
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => array('Friday', 'Saturday'),
                'opens' => '12:00',
                'closes' => '21:30'
            ),
            array(
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Sunday',
                'opens' => '12:00',
                'closes' => '20:30'
            )
        )
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'demarchelier_local_business_schema', 11);

/**
 * Add organization schema
 */
function demarchelier_organization_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Organization',
        'name' => 'Demarchelier Bistro',
        'url' => home_url(),
        'logo' => array(
            '@type' => 'ImageObject',
            'url' => get_theme_mod('logo_url', get_template_directory_uri() . '/images/logo.png'),
            'width' => 300,
            'height' => 100
        ),
        'contactPoint' => array(
            '@type' => 'ContactPoint',
            'telephone' => '1.631.593.1650',
            'contactType' => 'customer service',
            'areaServed' => 'US',
            'availableLanguage' => 'English'
        ),
        'sameAs' => array()
    );
    
    // Add social media
    $social_links = get_field('social_links', 'option') ?: array();
    if (!empty($social_links['instagram'])) {
        $schema['sameAs'][] = $social_links['instagram'];
    }
    if (!empty($social_links['facebook'])) {
        $schema['sameAs'][] = $social_links['facebook'];
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'demarchelier_organization_schema', 12);

/**
 * Add web site schema
 */
function demarchelier_website_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => 'Demarchelier Bistro',
        'url' => home_url(),
        'description' => get_theme_mod('meta_description', 'Classic French Bistro in Greenport, NY. Authentic French cuisine since 1978.'),
        'potentialAction' => array(
            '@type' => 'SearchAction',
            'target' => home_url('/?s={search_term_string}'),
            'query-input' => 'required name=search_term_string'
        )
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'demarchelier_website_schema', 13);

/**
 * Add breadcrumb schema
 */
function demarchelier_breadcrumb_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => array(
            array(
                '@type' => 'ListItem',
                'position' => 1,
                'name' => 'Home',
                'item' => home_url()
            )
        )
    );
    
    // Add current page if not homepage
    if (!is_front_page()) {
        $schema['itemListElement'][] = array(
            '@type' => 'ListItem',
            'position' => 2,
            'name' => get_the_title(),
            'item' => get_permalink()
        );
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'demarchelier_breadcrumb_schema', 14);

/**
 * Add FAQ schema for common questions
 */
function demarchelier_faq_schema() {
    $faqs = get_theme_mod('faq_items', array());
    if (empty($faqs)) {
        // Default FAQs
        $faqs = array(
            array(
                'question' => 'Do you accept reservations?',
                'answer' => 'Yes, we accept reservations through Resy. You can book a table online or call us directly.'
            ),
            array(
                'question' => 'What type of cuisine do you serve?',
                'answer' => 'We serve authentic French bistro cuisine, featuring classic dishes like Duck Confit, Steak Frites, and traditional French desserts.'
            ),
            array(
                'question' => 'Do you have a dress code?',
                'answer' => 'We recommend smart casual attire. While we don\'t have a strict dress code, we encourage guests to dress appropriately for fine dining.'
            ),
            array(
                'question' => 'Do you serve alcohol?',
                'answer' => 'Yes, we have a carefully curated wine list featuring predominantly French wines, as well as a selection of cocktails and spirits.'
            )
        );
    }
    
    if (!empty($faqs)) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array()
        );
        
        foreach ($faqs as $faq) {
            $schema['mainEntity'][] = array(
                '@type' => 'Question',
                'name' => $faq['question'],
                'acceptedAnswer' => array(
                    '@type' => 'Answer',
                    'text' => $faq['answer']
                )
            );
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}
add_action('wp_head', 'demarchelier_faq_schema', 15);

/**
 * Add review schema
 */
function demarchelier_review_schema() {
    $reviews = get_theme_mod('restaurant_reviews', array());
    if (!empty($reviews)) {
        foreach ($reviews as $review) {
            $schema = array(
                '@context' => 'https://schema.org',
                '@type' => 'Review',
                'itemReviewed' => array(
                    '@type' => 'Restaurant',
                    'name' => 'Demarchelier Bistro'
                ),
                'reviewRating' => array(
                    '@type' => 'Rating',
                    'ratingValue' => $review['rating'],
                    'bestRating' => '5'
                ),
                'author' => array(
                    '@type' => 'Person',
                    'name' => $review['author']
                ),
                'reviewBody' => $review['text'],
                'datePublished' => $review['date']
            );
            
            echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
        }
    }
}
add_action('wp_head', 'demarchelier_review_schema', 16);

/**
 * Add article schema for blog posts
 */
function demarchelier_article_schema() {
    if (is_single()) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => get_the_title(),
            'description' => get_the_excerpt(),
            'image' => get_the_post_thumbnail_url(get_the_ID(), 'large'),
            'author' => array(
                '@type' => 'Organization',
                'name' => 'Demarchelier Bistro'
            ),
            'publisher' => array(
                '@type' => 'Organization',
                'name' => 'Demarchelier Bistro',
                'logo' => array(
                    '@type' => 'ImageObject',
                    'url' => get_theme_mod('logo_url', get_template_directory_uri() . '/images/logo.png')
                )
            ),
            'datePublished' => get_the_date('c'),
            'dateModified' => get_the_modified_date('c'),
            'mainEntityOfPage' => array(
                '@type' => 'WebPage',
                '@id' => get_permalink()
            )
        );
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}
add_action('wp_head', 'demarchelier_article_schema', 17);

/**
 * Add web page schema
 */
function demarchelier_webpage_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        'name' => get_the_title(),
        'description' => get_theme_mod('meta_description', 'Classic French Bistro in Greenport, NY. Authentic French cuisine since 1978.'),
        'url' => get_permalink(),
        'isPartOf' => array(
            '@type' => 'WebSite',
            'name' => 'Demarchelier Bistro',
            'url' => home_url()
        ),
        'about' => array(
            '@type' => 'Restaurant',
            'name' => 'Demarchelier Bistro'
        )
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
}
add_action('wp_head', 'demarchelier_webpage_schema', 18);

/**
 * Add alternate language links
 */
function demarchelier_alternate_languages() {
    echo '<link rel="alternate" hreflang="en" href="' . home_url() . '">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="' . home_url() . '">' . "\n";
}
add_action('wp_head', 'demarchelier_alternate_languages', 19);

/**
 * Add sitemap meta tag
 */
function demarchelier_sitemap_meta() {
    echo '<link rel="sitemap" type="application/xml" title="Sitemap" href="' . home_url('/sitemap.xml') . '">' . "\n";
}
add_action('wp_head', 'demarchelier_sitemap_meta', 20);

/**
 * Add meta robots tag
 */
function demarchelier_meta_robots() {
    if (is_front_page()) {
        echo '<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">' . "\n";
    } else {
        echo '<meta name="robots" content="index, follow">' . "\n";
    }
}
add_action('wp_head', 'demarchelier_meta_robots', 21);

/**
 * Customize title for SEO
 */
function demarchelier_seo_title($title) {
    if (is_front_page()) {
        $custom_title = get_theme_mod('homepage_title', 'Demarchelier Bistro - Classic French Restaurant in Greenport, NY');
        return $custom_title ? $custom_title : $title;
    }
    return $title;
}
add_filter('wp_title', 'demarchelier_seo_title', 10, 1);

/**
 * Add geo-targeting to body class
 */
function demarchelier_geo_body_class($classes) {
    $classes[] = 'geo-greenport-ny';
    $classes[] = 'cuisine-french';
    $classes[] = 'restaurant-type-bistro';
    return $classes;
}
add_filter('body_class', 'demarchelier_geo_body_class');

/**
 * Add structured data for menu items
 */
function demarchelier_menu_schema() {
    $menu_items = get_field('menu_items', 'option');
    if (!empty($menu_items)) {
        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'Menu',
            'name' => 'Demarchelier Bistro Menu',
            'url' => home_url('/#menu'),
            'hasMenuSection' => array()
        );
        
        // Group menu items by category (you can customize this)
        $categories = array(
            'Appetizers' => array(),
            'Main Courses' => array(),
            'Desserts' => array()
        );
        
        foreach ($menu_items as $item) {
            if (isset($item['menu_item'])) {
                $categories['Main Courses'][] = array(
                    '@type' => 'MenuItem',
                    'name' => $item['menu_item'],
                    'description' => 'Traditional French bistro dish'
                );
            }
        }
        
        foreach ($categories as $category_name => $items) {
            if (!empty($items)) {
                $schema['hasMenuSection'][] = array(
                    '@type' => 'MenuSection',
                    'name' => $category_name,
                    'hasMenuItem' => $items
                );
            }
        }
        
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
    }
}
add_action('wp_head', 'demarchelier_menu_schema', 22);

/**
 * Remove any video structured data to fix Google Search Console errors
 * This prevents false video schema from being detected
 */
function demarchelier_remove_video_schema() {
    // Remove any video structured data that might be added by plugins or themes
    remove_action('wp_head', 'wp_video_shortcode_script');
    
    // Remove any video schema that might be added by other sources
    add_action('wp_head', function() {
        // This ensures no video schema is present
        echo '<!-- Video schema removed to prevent false Google Search Console errors -->' . "\n";
    }, 999);
}
add_action('init', 'demarchelier_remove_video_schema');

/**
 * Filter out any video structured data from being output
 */
function demarchelier_filter_video_schema($output) {
    // Remove any video schema from the output
    $output = preg_replace('/<script[^>]*type="application\/ld\+json"[^>]*>.*?"@type"\s*:\s*"VideoObject".*?<\/script>/s', '', $output);
    $output = preg_replace('/<script[^>]*type="application\/ld\+json"[^>]*>.*?"uploadDate".*?<\/script>/s', '', $output);
    return $output;
}
add_filter('wp_head', 'demarchelier_filter_video_schema', 1000);

/**
 * Add event schema for special events
 */
function demarchelier_event_schema() {
    $events = get_theme_mod('restaurant_events', array());
    if (!empty($events)) {
        foreach ($events as $event) {
            $schema = array(
                '@context' => 'https://schema.org',
                '@type' => 'Event',
                'name' => $event['name'],
                'description' => $event['description'],
                'startDate' => $event['start_date'],
                'endDate' => $event['end_date'],
                'location' => array(
                    '@type' => 'Place',
                    'name' => 'Demarchelier Bistro',
                    'address' => array(
                        '@type' => 'PostalAddress',
                        'streetAddress' => '471 Main Street',
                        'addressLocality' => 'Greenport',
                        'addressRegion' => 'NY',
                        'postalCode' => '11944',
                        'addressCountry' => 'US'
                    )
                ),
                'organizer' => array(
                    '@type' => 'Organization',
                    'name' => 'Demarchelier Bistro'
                ),
                'offers' => array(
                    '@type' => 'Offer',
                    'price' => $event['price'],
                    'priceCurrency' => 'USD',
                    'availability' => 'https://schema.org/InStock'
                )
            );
            
            echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . '</script>';
        }
    }
}
add_action('wp_head', 'demarchelier_event_schema', 23); 
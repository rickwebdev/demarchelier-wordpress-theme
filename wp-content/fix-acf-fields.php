<?php
/**
 * Fix ACF Fields for Demarchelier Theme
 * This script will force recreate the ACF fields properly
 */

// Include WordPress
require_once('../wp-config.php');

echo "Fixing ACF fields for Demarchelier theme...\n";

// First, delete any existing field groups with similar keys
global $wpdb;
$wpdb->query("DELETE FROM {$wpdb->prefix}posts WHERE post_type = 'acf-field-group' AND post_title LIKE '%Demarchelier%'");
$wpdb->query("DELETE FROM {$wpdb->prefix}posts WHERE post_type = 'acf-field-group' AND post_title LIKE '%Theme Settings%'");

echo "✓ Cleared existing field groups\n";

// Create the options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Demarchelier Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'demarchelier-theme-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-restaurant',
    ));
    echo "✓ Created options page\n";
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
        
        // Hours
        array(
            'key' => 'field_hours',
            'label' => 'Hours',
            'name' => 'hours',
            'type' => 'repeater',
            'layout' => 'table',
            'sub_fields' => array(
                array(
                    'key' => 'field_day',
                    'label' => 'Day',
                    'name' => 'day',
                    'type' => 'text',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_hours_text',
                    'label' => 'Hours',
                    'name' => 'hours_text',
                    'type' => 'text',
                    'required' => 1,
                ),
            ),
        ),
        
        // Social Links
        array(
            'key' => 'field_social_links',
            'label' => 'Social Media Links',
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
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
);

// Add the field group
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group($field_group);
    echo "✓ ACF field group created successfully\n";
} else {
    echo "✗ Failed to create ACF field group\n";
    exit;
}

// Populate with default content
echo "Populating fields with default content...\n";

// Set default menu items
$default_menu_items = array(
    array('menu_item' => 'Duck Confit with gratin dauphinois'),
    array('menu_item' => 'Steak Frites with bordelaise'),
    array('menu_item' => 'Steak Tartare with pommes dauphine'),
    array('menu_item' => 'Chicken Paillard with mesclun salad'),
    array('menu_item' => 'Roasted Salmon with beurre blanc'),
    array('menu_item' => 'Calf Liver Bordelaise with mashed potatoes'),
    array('menu_item' => 'Onion Soup Gratinée'),
    array('menu_item' => 'Crème Brûlée'),
);

// Set default hours
$default_hours = array(
    array('day' => 'Mon', 'hours_text' => 'Closed'),
    array('day' => 'Tue', 'hours_text' => '12:00 PM - 9:00 PM'),
    array('day' => 'Wed', 'hours_text' => '12:00 PM - 9:00 PM'),
    array('day' => 'Thu', 'hours_text' => '12:00 PM - 9:00 PM'),
    array('day' => 'Fri', 'hours_text' => '12:00 PM - 9:30 PM'),
    array('day' => 'Sat', 'hours_text' => '12:00 PM - 9:30 PM'),
    array('day' => 'Sun', 'hours_text' => '12:00 PM - 8:30 PM'),
);

// Update options
update_option('options_hero_title', 'Classic French Bistro');
update_option('options_hero_subtitle', 'Serving authentic French fare since 1978 — from Manhattan to Greenport Village');
update_option('options_resy_link', 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro');
update_option('options_announcement_text', 'Open For New Years Eve - a la carte menu & Festive specials • closed New Years day • Cassoulet Every Thursday');
update_option('options_about_content', 'Since 1978 we have served classic French <span class="accent-script">bistro</span> fare with a warm, family atmosphere. Our menu pairs traditional dishes with a predominantly French wine list. Join us for a quick bite at the bar or a relaxed dinner with friends.');
update_option('options_menu_items', $default_menu_items);
update_option('options_hours', $default_hours);
update_option('options_contact_info', array(
    'address' => '471 Main Street, Greenport NY 11944',
    'phone' => '1.631.593.1650',
    'email' => 'demarcheliergreenport@gmail.com'
));
update_option('options_social_links', array(
    'instagram' => 'https://www.instagram.com/demarchelierbistro/',
    'facebook' => 'https://www.facebook.com/demarchelierbistro/'
));

echo "✓ Default content populated successfully\n";
echo "✓ ACF fields setup complete!\n";
echo "\nYou can now edit content at: WordPress Admin > Theme Settings\n";
echo "The fields should now appear in the admin panel.\n";
?> 
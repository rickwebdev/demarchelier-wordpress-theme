<?php
/**
 * WP-CLI script to update Demarchelier theme content
 * Usage: wp eval-file update-theme-content.php
 */

// Update theme content
echo "Updating Demarchelier theme content...\n";

// Hero Section
update_option('options_hero_title', 'Classic French Bistro');
update_option('options_hero_subtitle', 'Serving authentic French fare since 1978 — from Manhattan to Greenport Village');
update_option('options_resy_link', 'https://resy.com/cities/greenport-ny/venues/demarchelier-bistro');

// Announcement
update_option('options_announcement_text', 'Open For New Years Eve - a la carte menu & Festive specials • closed New Years day • Cassoulet Every Thursday');

// About Section
update_option('options_about_content', 'Since 1978 we have served classic French <span class="accent-script">bistro</span> fare with a warm, family atmosphere. Our menu pairs traditional dishes with a predominantly French wine list. Join us for a quick bite at the bar or a relaxed dinner with friends.');

// Menu Items
$menu_items = array(
    array('menu_item' => 'Duck Confit with gratin dauphinois'),
    array('menu_item' => 'Steak Frites with bordelaise'),
    array('menu_item' => 'Steak Tartare with pommes dauphine'),
    array('menu_item' => 'Chicken Paillard with mesclun salad'),
    array('menu_item' => 'Roasted Salmon with beurre blanc'),
    array('menu_item' => 'Calf Liver Bordelaise with mashed potatoes'),
    array('menu_item' => 'Onion Soup Gratinée'),
    array('menu_item' => 'Crème Brûlée'),
);
update_option('options_menu_items', $menu_items);

// Hours
$hours = array(
    array('day' => 'Mon', 'hours_text' => 'Closed'),
    array('day' => 'Tue', 'hours_text' => 'Closed'),
    array('day' => 'Wed', 'hours_text' => '12 pm – 9 pm'),
    array('day' => 'Thu', 'hours_text' => '12 pm – 9 pm'),
    array('day' => 'Fri', 'hours_text' => '12 pm – 9:30 pm'),
    array('day' => 'Sat', 'hours_text' => '12 pm – 9:30 pm'),
    array('day' => 'Sun', 'hours_text' => '12 pm – 8:30 pm'),
);
update_option('options_hours', $hours);

// Contact Info
$contact_info = array(
    'address' => '471 Main Street, Greenport NY 11944',
    'phone' => '1.631.593.1650',
    'email' => 'demarcheliergreenport@gmail.com'
);
update_option('options_contact_info', $contact_info);

// Social Links
$social_links = array(
    'instagram' => 'https://www.instagram.com/demarchelierbistro/',
    'facebook' => 'https://www.facebook.com/demarchelierbistro/'
);
update_option('options_social_links', $social_links);

echo "✓ Theme content updated successfully!\n";
echo "✓ You can now edit content at: WordPress Admin > Theme Settings\n";
?> 
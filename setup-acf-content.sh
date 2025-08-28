#!/bin/bash

# Setup ACF Content for Demarchelier Theme

echo "Setting up ACF content for Demarchelier theme..."

# Create ACF field groups and options
echo "Creating ACF field groups..."

# Create Options page
./wp-cli.sh acf options-page add "Theme Options" "theme-options" "Theme Options"

# Create field group for Hero Section
./wp-cli.sh acf field-group create \
    --title="Hero Section" \
    --location='{"post_type":[{"param":"==","value":"page","operator":"=="}]}' \
    --fields='[
        {
            "key": "field_hero_title",
            "label": "Hero Title",
            "name": "hero_title",
            "type": "text",
            "default_value": "Classic French Bistro"
        },
        {
            "key": "field_hero_subtitle",
            "label": "Hero Subtitle",
            "name": "hero_subtitle",
            "type": "textarea",
            "default_value": "Serving authentic French fare since 1978 — from Manhattan to Greenport Village"
        },
        {
            "key": "field_resy_link",
            "label": "Reservation Link",
            "name": "resy_link",
            "type": "url",
            "default_value": "https://resy.com/cities/greenport-ny/venues/demarchelier-bistro"
        }
    ]'

# Create field group for About Section
./wp-cli.sh acf field-group create \
    --title="About Section" \
    --location='{"post_type":[{"param":"==","value":"page","operator":"=="}]}' \
    --fields='[
        {
            "key": "field_about_content",
            "label": "About Content",
            "name": "about_content",
            "type": "wysiwyg",
            "default_value": "Since 1978 we have served classic French <span class=\"accent-script\">bistro</span> fare with a warm, family atmosphere. Our menu pairs traditional dishes with a predominantly French wine list. Join us for a quick bite at the bar or a relaxed dinner with friends."
        }
    ]'

# Create field group for Menu Section
./wp-cli.sh acf field-group create \
    --title="Menu Section" \
    --location='{"post_type":[{"param":"==","value":"page","operator":"=="}]}' \
    --fields='[
        {
            "key": "field_menu_items",
            "label": "Menu Items",
            "name": "menu_items",
            "type": "repeater",
            "sub_fields": [
                {
                    "key": "field_menu_item",
                    "label": "Menu Item",
                    "name": "menu_item",
                    "type": "text"
                }
            ]
        }
    ]'

# Create field group for Contact/Hours
./wp-cli.sh acf field-group create \
    --title="Contact & Hours" \
    --location='{"post_type":[{"param":"==","value":"page","operator":"=="}]}' \
    --fields='[
        {
            "key": "field_hours",
            "label": "Hours",
            "name": "hours",
            "type": "repeater",
            "sub_fields": [
                {
                    "key": "field_day",
                    "label": "Day",
                    "name": "day",
                    "type": "text"
                },
                {
                    "key": "field_hours_text",
                    "label": "Hours",
                    "name": "hours_text",
                    "type": "text"
                }
            ]
        },
        {
            "key": "field_contact_info",
            "label": "Contact Info",
            "name": "contact_info",
            "type": "group",
            "sub_fields": [
                {
                    "key": "field_address",
                    "label": "Address",
                    "name": "address",
                    "type": "text",
                    "default_value": "471 Main Street, Greenport, NY 11944"
                },
                {
                    "key": "field_phone",
                    "label": "Phone",
                    "name": "phone",
                    "type": "text",
                    "default_value": "1.631.593.1650"
                },
                {
                    "key": "field_email",
                    "label": "Email",
                    "name": "email",
                    "type": "email",
                    "default_value": "demarcheliergreenport@gmail.com"
                }
            ]
        }
    ]'

echo "Setting up default content..."

# Set default ACF options
./wp-cli.sh option add _options_hero_title "Classic French Bistro"
./wp-cli.sh option add _options_hero_subtitle "Serving authentic French fare since 1978 — from Manhattan to Greenport Village"
./wp-cli.sh option add _options_resy_link "https://resy.com/cities/greenport-ny/venues/demarchelier-bistro"

# Set about content
./wp-cli.sh option add _options_about_content "Since 1978 we have served classic French <span class=\"accent-script\">bistro</span> fare with a warm, family atmosphere. Our menu pairs traditional dishes with a predominantly French wine list. Join us for a quick bite at the bar or a relaxed dinner with friends."

# Set contact info
./wp-cli.sh option add _options_contact_info_address "471 Main Street, Greenport, NY 11944"
./wp-cli.sh option add _options_contact_info_phone "1.631.593.1650"
./wp-cli.sh option add _options_contact_info_email "demarcheliergreenport@gmail.com"

# Set hours
./wp-cli.sh option add _options_hours_0_day "Tuesday - Friday"
./wp-cli.sh option add _options_hours_0_hours_text "5:30 PM - 10:00 PM"
./wp-cli.sh option add _options_hours_1_day "Saturday"
./wp-cli.sh option add _options_hours_1_hours_text "5:00 PM - 10:30 PM"
./wp-cli.sh option add _options_hours_2_day "Sunday"
./wp-cli.sh option add _options_hours_2_hours_text "5:00 PM - 9:30 PM"

# Set menu items
./wp-cli.sh option add _options_menu_items_0_menu_item "Duck Confit with gratin dauphinois"
./wp-cli.sh option add _options_menu_items_1_menu_item "Steak Frites with bordelaise"
./wp-cli.sh option add _options_menu_items_2_menu_item "Steak Tartare with pommes dauphine"
./wp-cli.sh option add _options_menu_items_3_menu_item "Chicken Paillard with mesclun salad"
./wp-cli.sh option add _options_menu_items_4_menu_item "Roasted Salmon with beurre blanc"
./wp-cli.sh option add _options_menu_items_5_menu_item "Calf Liver Bordelaise with mashed potatoes"
./wp-cli.sh option add _options_menu_items_6_menu_item "Onion Soup Gratinée"
./wp-cli.sh option add _options_menu_items_7_menu_item "Crème Brûlée"

echo "ACF content setup complete!"
echo ""
echo "Your theme should now display:"
echo "- Hero section with title and subtitle"
echo "- About section with content"
echo "- Menu highlights section"
echo "- Hours and contact information"
echo ""
echo "You can edit this content in WordPress admin under 'Theme Options'" 
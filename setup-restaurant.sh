#!/bin/bash

# Demarchelier Restaurant WordPress Setup Script

echo "Setting up WordPress for Demarchelier Restaurant..."

# Install WordPress core
echo "Installing WordPress core..."
./wp-cli.sh core install \
    --url=http://localhost:8000 \
    --title="Demarchelier Restaurant" \
    --admin_user=admin \
    --admin_password=demarchelier2024 \
    --admin_email=admin@demarchelier.com \
    --skip-email

# Create restaurant-specific pages
echo "Creating restaurant pages..."

# Home page
./wp-cli.sh post create \
    --post_type=page \
    --post_title="Home" \
    --post_content="Welcome to Demarchelier Restaurant - Fine French Dining in New York" \
    --post_status=publish

# About page
./wp-cli.sh post create \
    --post_type=page \
    --post_title="About Us" \
    --post_content="Demarchelier Restaurant has been serving authentic French cuisine in the heart of New York since 1981. Our commitment to excellence and traditional French cooking techniques has made us a beloved destination for food enthusiasts." \
    --post_status=publish

# Menu page
./wp-cli.sh post create \
    --post_type=page \
    --post_title="Menu" \
    --post_content="Discover our carefully curated menu featuring classic French dishes with a modern twist." \
    --post_status=publish

# Reservations page
./wp-cli.sh post create \
    --post_type=page \
    --post_title="Reservations" \
    --post_content="Make your reservation for an unforgettable dining experience at Demarchelier Restaurant." \
    --post_status=publish

# Contact page
./wp-cli.sh post create \
    --post_type=page \
    --post_title="Contact" \
    --post_content="Visit us at 50 E 86th St, New York, NY 10028. Call us at (212) 249-9193 for reservations." \
    --post_status=publish

# Create restaurant-specific categories
echo "Creating restaurant categories..."
./wp-cli.sh term create category "Appetizers" --description="Starters and hors d'oeuvres"
./wp-cli.sh term create category "Main Courses" --description="Entrées and main dishes"
./wp-cli.sh term create category "Desserts" --description="Sweet endings to your meal"
./wp-cli.sh term create category "Wine List" --description="Our curated wine selection"
./wp-cli.sh term create category "Special Events" --description="Private dining and events"

# Create sample menu items
echo "Creating sample menu items..."

# Appetizers
./wp-cli.sh post create \
    --post_type=post \
    --post_title="Escargots de Bourgogne" \
    --post_content="Traditional Burgundy snails with garlic herb butter" \
    --post_category="Appetizers" \
    --post_status=publish

./wp-cli.sh post create \
    --post_type=post \
    --post_title="Soupe à l'Oignon" \
    --post_content="Classic French onion soup with melted Gruyère cheese" \
    --post_category="Appetizers" \
    --post_status=publish

# Main Courses
./wp-cli.sh post create \
    --post_type=post \
    --post_title="Coq au Vin" \
    --post_content="Braised chicken in red wine with mushrooms and pearl onions" \
    --post_category="Main Courses" \
    --post_status=publish

./wp-cli.sh post create \
    --post_type=post \
    --post_title="Filet de Bœuf Rossini" \
    --post_content="Beef tenderloin with foie gras and truffle sauce" \
    --post_category="Main Courses" \
    --post_status=publish

# Desserts
./wp-cli.sh post create \
    --post_type=post \
    --post_title="Crème Brûlée" \
    --post_content="Classic vanilla custard with caramelized sugar crust" \
    --post_category="Desserts" \
    --post_status=publish

./wp-cli.sh post create \
    --post_type=post \
    --post_title="Tarte Tatin" \
    --post_content="Upside-down caramelized apple tart" \
    --post_category="Desserts" \
    --post_status=publish

# Set up restaurant information
echo "Setting up restaurant information..."

# Update site options
./wp-cli.sh option update blogdescription "Fine French Dining in New York"
./wp-cli.sh option update timezone_string "America/New_York"
./wp-cli.sh option update date_format "F j, Y"
./wp-cli.sh option update time_format "g:i a"

# Create restaurant-specific options
./wp-cli.sh option add restaurant_address "50 E 86th St, New York, NY 10028"
./wp-cli.sh option add restaurant_phone "(212) 249-9193"
./wp-cli.sh option add restaurant_email "info@demarchelier.com"
./wp-cli.sh option add restaurant_hours "Tuesday-Sunday: 5:30 PM - 10:30 PM"
./wp-cli.sh option add restaurant_established "1981"

# Install and activate useful plugins
echo "Installing useful plugins..."

# Contact Form 7 for reservations
./wp-cli.sh plugin install contact-form-7 --activate

# Yoast SEO for better search optimization
./wp-cli.sh plugin install wordpress-seo --activate

# Classic Editor (if needed)
./wp-cli.sh plugin install classic-editor --activate

# Restaurant-specific custom fields plugin
./wp-cli.sh plugin install advanced-custom-fields --activate

echo "WordPress setup complete for Demarchelier Restaurant!"
echo ""
echo "Access your site at: http://localhost:8000"
echo "Admin login: admin / demarchelier2024"
echo ""
echo "Restaurant information has been configured:"
echo "- Address: 50 E 86th St, New York, NY 10028"
echo "- Phone: (212) 249-9193"
echo "- Hours: Tuesday-Sunday: 5:30 PM - 10:30 PM"
echo "- Established: 1981" 
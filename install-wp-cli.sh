#!/bin/bash

# WordPress WP-CLI Local Installation Script

echo "Installing WP-CLI locally..."

# Download WP-CLI
curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar

# Make it executable
chmod +x wp-cli.phar

# Move to a location in your PATH
sudo mv wp-cli.phar /usr/local/bin/wp

# Test the installation
wp --version

echo "WP-CLI installed successfully!"
echo ""
echo "Usage examples:"
echo "  wp --info"
echo "  wp core version"
echo "  wp plugin list"
echo "  wp theme list"
echo ""
echo "For WordPress development with Docker, you can also use:"
echo "  docker run -it --rm -v \$(pwd):/var/www/html wordpress:cli wp [command]" 
#!/bin/bash

# Demarchelier Restaurant - Production Deployment Script
# This script helps you update URLs when deploying to production

echo "=== Demarchelier Restaurant Production Deployment ==="
echo ""

# Check if domain is provided
if [ -z "$1" ]; then
    echo "Usage: ./deploy-to-production.sh YOUR_DOMAIN"
    echo "Example: ./deploy-to-production.sh demarchelier.com"
    echo ""
    echo "Make sure to:"
    echo "1. Upload all files to your server"
    echo "2. Import your database to the server"
    echo "3. Update wp-config.php with your live database credentials"
    echo "4. Run this script on your server"
    exit 1
fi

DOMAIN=$1
PROTOCOL="https"

echo "Updating WordPress URLs to: ${PROTOCOL}://${DOMAIN}"
echo ""

# Update WordPress options
echo "Updating WordPress options..."
wp option update home "${PROTOCOL}://${DOMAIN}"
wp option update siteurl "${PROTOCOL}://${DOMAIN}"

# Search and replace all URLs in database
echo "Updating all URLs in database..."
wp search-replace "http://localhost:8000" "${PROTOCOL}://${DOMAIN}" --skip-columns=guid
wp search-replace "https://localhost:8000" "${PROTOCOL}://${DOMAIN}" --skip-columns=guid

# Flush rewrite rules
echo "Flushing rewrite rules..."
wp rewrite flush

# Clear any caches
echo "Clearing caches..."
wp cache flush

echo ""
echo "✅ Deployment complete!"
echo ""
echo "Your WordPress site should now be accessible at: ${PROTOCOL}://${DOMAIN}"
echo ""
echo "Next steps:"
echo "1. Test your site at ${PROTOCOL}://${DOMAIN}"
echo "2. Check that all images are displaying correctly"
echo "3. Test the admin panel at ${PROTOCOL}://${DOMAIN}/wp-admin/"
echo "4. Update any hardcoded URLs in your theme files if needed"
echo ""
echo "If you have any issues:"
echo "- Check your server's error logs"
echo "- Verify database connection in wp-config.php"
echo "- Ensure all files have proper permissions" 
# Demarchelier Restaurant - Production Deployment Guide

## Overview
This guide walks you through deploying your WordPress site from local development to production, ensuring all URLs are properly updated.

## Pre-Deployment Checklist

### 1. Prepare Your Local Files
- ✅ All WordPress files are ready
- ✅ Theme files are complete
- ✅ Plugins are installed and configured
- ✅ Content is finalized

### 2. Database Export
Export your local database:
```bash
# From your local development directory
./wp-cli.sh db export demarchelier-production.sql
```

## Step-by-Step Deployment Process

### Step 1: Upload Files to Server
1. **Upload WordPress Core Files**
   - Upload all WordPress files to your server's public directory
   - Ensure `wp-content/` directory is included
   - Maintain directory structure

2. **Upload Theme Files**
   - Ensure `wp-content/themes/demarchelier/` is uploaded
   - Check that all theme files are present

3. **Upload Uploads Directory**
   - Upload `wp-content/uploads/` with all images
   - Maintain the year/month directory structure

### Step 2: Configure Database
1. **Create Database on Server**
   - Create a new MySQL database on your hosting provider
   - Note the database name, username, password, and host

2. **Import Database**
   - Import the `demarchelier-production.sql` file to your server database
   - Use phpMyAdmin or your hosting provider's database tool

3. **Update wp-config.php**
   ```php
   // Database Configuration
   define( 'DB_NAME', 'your_live_database_name' );
   define( 'DB_USER', 'your_live_database_user' );
   define( 'DB_PASSWORD', 'your_live_database_password' );
   define( 'DB_HOST', 'your_live_database_host' );
   
   // Site URLs (IMPORTANT: Don't add these yet!)
   // We'll update them via WP-CLI after import
   ```

### Step 3: Install WP-CLI on Server
If your hosting provider supports WP-CLI:

1. **Check if WP-CLI is available**
   ```bash
   wp --version
   ```

2. **If not available, install it**
   ```bash
   curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
   chmod +x wp-cli.phar
   sudo mv wp-cli.phar /usr/local/bin/wp
   ```

### Step 4: Update URLs (CRITICAL STEP)
This is where you fix the localhost URLs:

1. **Navigate to your WordPress directory on the server**
   ```bash
   cd /path/to/your/wordpress/site
   ```

2. **Run the deployment script**
   ```bash
   ./deploy-to-production.sh yourdomain.com
   ```

3. **Or run commands manually**
   ```bash
   # Update WordPress options
   wp option update home 'https://yourdomain.com'
   wp option update siteurl 'https://yourdomain.com'
   
   # Update all URLs in database
   wp search-replace 'http://localhost:8000' 'https://yourdomain.com' --skip-columns=guid
   wp search-replace 'https://localhost:8000' 'https://yourdomain.com' --skip-columns=guid
   
   # Flush rewrite rules
   wp rewrite flush
   
   # Clear caches
   wp cache flush
   ```

### Step 5: Test Your Site
1. **Visit your domain** - should load WordPress site
2. **Check images** - should display correctly
3. **Test admin panel** - `https://yourdomain.com/wp-admin/`
4. **Test navigation** - all links should work

## Alternative: Manual Database Update
If you can't use WP-CLI on your server:

### Option 1: phpMyAdmin
1. Open phpMyAdmin
2. Select your database
3. Go to SQL tab
4. Run these queries:
   ```sql
   UPDATE wp_options SET option_value = 'https://yourdomain.com' WHERE option_name = 'home';
   UPDATE wp_options SET option_value = 'https://yourdomain.com' WHERE option_name = 'siteurl';
   UPDATE wp_posts SET post_content = REPLACE(post_content, 'http://localhost:8000', 'https://yourdomain.com');
   UPDATE wp_posts SET guid = REPLACE(guid, 'http://localhost:8000', 'https://yourdomain.com');
   UPDATE wp_postmeta SET meta_value = REPLACE(meta_value, 'http://localhost:8000', 'https://yourdomain.com') WHERE meta_value LIKE '%localhost:8000%';
   ```

### Option 2: Search and Replace Plugin
1. Install "Better Search Replace" plugin
2. Go to Tools > Better Search Replace
3. Search for: `http://localhost:8000`
4. Replace with: `https://yourdomain.com`
5. Select all tables and run

## Post-Deployment Checklist

### ✅ Site Functionality
- [ ] Homepage loads correctly
- [ ] All images display properly
- [ ] Navigation menus work
- [ ] Contact forms function
- [ ] Admin panel accessible

### ✅ SEO and Performance
- [ ] Update permalink structure if needed
- [ ] Install and configure caching plugin
- [ ] Set up SSL certificate
- [ ] Configure CDN if needed

### ✅ Security
- [ ] Change admin password
- [ ] Install security plugin
- [ ] Set up regular backups
- [ ] Update file permissions

## Troubleshooting

### Images Not Loading
- Check file permissions (755 for directories, 644 for files)
- Verify uploads directory path
- Check .htaccess file

### Database Connection Issues
- Verify database credentials in wp-config.php
- Check database host settings
- Ensure database user has proper permissions

### 404 Errors
- Update permalink structure in WordPress admin
- Check .htaccess file
- Verify server supports URL rewriting

### SSL Issues
- Install SSL certificate
- Update URLs to use https://
- Configure WordPress to use SSL

## Support
If you encounter issues:
1. Check server error logs
2. Verify all files uploaded correctly
3. Test database connection
4. Contact your hosting provider

## Files to Include in Deployment
- All WordPress core files
- wp-content/themes/demarchelier/ (your theme)
- wp-content/plugins/ (installed plugins)
- wp-content/uploads/ (all images and media)
- wp-config.php (updated with live database credentials)
- .htaccess (if custom)
- deploy-to-production.sh (this script)

## Files to Exclude
- wp-config.php (upload separately with correct credentials)
- .git/ (version control)
- node_modules/ (development dependencies)
- *.log files
- Temporary files 
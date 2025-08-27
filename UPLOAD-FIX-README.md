# WordPress Upload Limits Fix

## Problem
Your images (`menu_hero.jpg` and `wine.JPG`) were exceeding the maximum upload size for WordPress.

## Solution
I've implemented a comprehensive fix that increases upload limits through multiple methods:

### 1. Custom PHP Configuration (`php.ini`)
- `upload_max_filesize = 64M`
- `post_max_size = 64M`
- `memory_limit = 256M`
- `max_execution_time = 300`

### 2. Docker Configuration (`docker-compose.yml`)
- Added environment variables for PHP settings
- Mounted custom PHP configuration file
- Increased memory and execution time limits

### 3. WordPress Theme Configuration (`functions.php`)
- Added PHP ini settings via WordPress hooks
- Increased image quality settings
- Added SVG upload support
- Disabled big image size threshold

## How to Apply the Fix

### Option 1: Use the Restart Script (Recommended)
```bash
./restart-with-uploads.sh
```

### Option 2: Manual Restart
```bash
# Stop containers
docker-compose down

# Remove WordPress container to ensure new config is applied
docker-compose rm -f wordpress

# Start with new configuration
docker-compose up -d
```

## New Upload Limits
- **Maximum file size**: 64MB
- **Maximum post size**: 64MB
- **Memory limit**: 256MB
- **Execution time**: 300 seconds
- **Image quality**: 95%

## Verification
After restarting, you should be able to upload your large images:
- `menu_hero.jpg`
- `wine.JPG`

## Access Your Site
Visit: http://localhost:8000

## Troubleshooting
If uploads still fail:
1. Check Docker logs: `docker-compose logs wordpress`
2. Verify PHP settings in WordPress admin
3. Ensure images are under 64MB each 
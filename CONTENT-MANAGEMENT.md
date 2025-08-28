# Demarchelier Restaurant Theme - Content Management Guide

## 🎯 How to Edit Your Restaurant Content

### **Method 1: WordPress Admin (Recommended)**

1. **Go to WordPress Admin**: http://localhost:8000/wp-admin
   - Username: `admin`
   - Password: `demarchelier2024`

2. **Navigate to Theme Settings**:
   - In the left sidebar, click **"Theme Settings"**
   - This will show all your restaurant content fields

3. **Edit Content Sections**:

   **Hero Section:**
   - Hero Title: "Classic French Bistro"
   - Hero Subtitle: Restaurant description
   - Hero Images: Upload 1-4 background images
   - Reservation Link: Resy booking URL

   **Announcement Bar:**
   - Announcement Text: Special events, hours, etc.

   **About Section:**
   - About Content: Restaurant story and description
   - About Image: Upload restaurant interior photo

   **Menu Section:**
   - Menu Items: Add/edit French dishes
   - Menu PDF: Upload full menu file

   **Contact Information:**
   - Address: Restaurant location
   - Phone: Contact number
   - Email: Contact email

   **Hours:**
   - Add/edit opening hours for each day

   **Social Media:**
   - Instagram: Social media links
   - Facebook: Social media links

### **Method 2: WP-CLI Commands**

Update all content at once:
```bash
./wp-cli.sh eval-file wp-content/update-theme-content.php
```

### **Method 3: Direct Database (Advanced)**

You can also edit content directly in the database using WP-CLI:

```bash
# View current hero title
./wp-cli.sh option get options_hero_title

# Update hero title
./wp-cli.sh option update options_hero_title "New Restaurant Name"

# View all theme options
./wp-cli.sh option list | grep options_
```

## 📋 Available Content Fields

| Field Name | Type | Description |
|------------|------|-------------|
| `hero_title` | Text | Main restaurant title |
| `hero_subtitle` | Textarea | Restaurant tagline |
| `hero_images` | Gallery | Background images (1-4) |
| `resy_link` | URL | Reservation booking link |
| `announcement_text` | Text | Header announcement |
| `about_content` | WYSIWYG | Restaurant story |
| `about_images` | Gallery | About section photos (1-3) |
| `gallery_images` | Gallery | Gallery section photos (1-4) |
| `menu_items` | Repeater | List of menu items |
| `menu_pdf` | File | Full menu PDF |
| `contact_info` | Group | Address, phone, email |
| `hours` | Repeater | Opening hours by day |
| `social_links` | Group | Instagram, Facebook URLs |

## 🎨 Content Structure

### Menu Items Format:
```php
array(
    array('menu_item' => 'Duck Confit with gratin dauphinois'),
    array('menu_item' => 'Steak Frites with bordelaise'),
    // ... more items
)
```

### Hours Format:
```php
array(
    array('day' => 'Mon', 'hours_text' => 'Closed'),
    array('day' => 'Wed', 'hours_text' => '12 pm – 9 pm'),
    // ... more days
)
```

### Contact Info Format:
```php
array(
    'address' => '471 Main Street, Greenport NY 11944',
    'phone' => '1.631.593.1650',
    'email' => 'demarcheliergreenport@gmail.com'
)
```

## 🔧 Troubleshooting

### If content doesn't update:
1. Clear WordPress cache
2. Check if ACF plugin is active
3. Verify field names match exactly
4. Check browser console for JavaScript errors

### If fields don't appear:
1. Go to WordPress Admin > Custom Fields > Field Groups
2. Ensure "Demarchelier Theme Settings" field group exists
3. Check that it's assigned to "Options Page"

### Quick Reset:
```bash
# Reset all content to defaults
./wp-cli.sh eval-file wp-content/update-theme-content.php
```

## 🚀 Next Steps

1. **Upload Images**: Add your restaurant photos to the Hero Images and About Image fields
2. **Customize Menu**: Update the menu items with your actual dishes
3. **Update Hours**: Set your real opening hours
4. **Add Social Links**: Include your actual social media URLs
5. **Upload Menu PDF**: Add your full menu file

Your content is now fully manageable through WordPress Admin! 🎉 
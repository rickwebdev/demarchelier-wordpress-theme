# Demarchelier Bistro WordPress Theme

A custom WordPress theme for Demarchelier Bistro - Classic French Bistro in Greenport, NY.

## Features

- **Modern Design**: Elegant, responsive design with French bistro aesthetics
- **ACF Integration**: Advanced Custom Fields for easy content management
- **Gutenberg Blocks**: Custom blocks for flexible page building
- **Performance Optimized**: Fast loading with optimized assets
- **SEO Ready**: Schema markup and SEO best practices
- **Accessibility**: WCAG compliant with keyboard navigation
- **Mobile First**: Responsive design that works on all devices

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Advanced Custom Fields Pro (recommended)
- Contact Form 7 (optional, for contact form functionality)

## Installation

1. **Upload the theme**:
   - Upload the theme folder to `/wp-content/themes/`
   - Or zip the theme folder and upload via WordPress admin

2. **Activate the theme**:
   - Go to Appearance > Themes in WordPress admin
   - Activate "Demarchelier Bistro"

3. **Install required plugins**:
   - Advanced Custom Fields Pro (recommended)
   - Contact Form 7 (optional)

4. **Configure theme settings**:
   - Go to Theme Settings in the admin menu
   - Fill in your restaurant information

## Theme Setup

### 1. Theme Settings (ACF Required)

Navigate to **Theme Settings** in your WordPress admin to configure:

- **Hero Section**: Title, subtitle, background images
- **Announcement Bar**: Marquee text
- **About Section**: Content and image
- **Menu Items**: List of menu highlights
- **Hours**: Operating hours for each day
- **Contact Information**: Address, phone, email
- **Social Links**: Instagram, Facebook URLs
- **Resy Link**: Booking system URL

### 2. Customizer Options

Go to **Appearance > Customize** to set:

- Site logo
- Announcement text
- Colors and typography

### 3. Navigation Menus

Create and assign menus:

- **Primary Menu**: Main navigation
- **Footer Menu**: Footer links

### 4. Homepage Setup

**Option A: Use Default Homepage**
- The theme will automatically display the default homepage content

**Option B: Create Custom Homepage**
- Create a new page
- Use Gutenberg blocks to build your layout
- Set as homepage in Settings > Reading

## Custom Gutenberg Blocks

The theme includes custom blocks for easy page building:

### Hero Section Block
- Background image carousel
- Customizable title and subtitle
- Call-to-action button

### About Section Block
- Image and content layout
- Outlined heading style
- Address information

### Menu Section Block
- Menu highlights list
- PDF download link
- Customizable items

### Gallery Section Block
- Image gallery grid
- Content and button
- Art gallery integration

### Contact Section Block
- Contact form
- Content area
- Form submission handling

## ACF vs Gutenberg Blocks

### ACF (Advanced Custom Fields)
**Best for:**
- Structured data (hours, contact info, menu items)
- Reusable content across pages
- Easy content management for non-technical users
- SEO-friendly structured data

**Advantages:**
- User-friendly interface
- Conditional logic
- Field validation
- Reusable field groups
- Better for content editors

### Gutenberg Blocks
**Best for:**
- Flexible page layouts
- Visual page building
- Custom content sections
- Design variations

**Advantages:**
- Visual editing
- Drag-and-drop interface
- Real-time preview
- Block patterns
- Better for designers

### Recommended Approach
Use **both** for maximum flexibility:
- **ACF**: For structured data (hours, contact info, menu items)
- **Gutenberg Blocks**: For flexible content areas (hero sections, about content, gallery)

## Customization

### CSS Customization
Add custom CSS in **Appearance > Customize > Additional CSS**:

```css
/* Example: Change primary color */
:root {
    --burgundy: #8B0000;
}

/* Example: Custom button styles */
.btn.book {
    background: linear-gradient(45deg, var(--burgundy), #9B2C2C);
}
```

### PHP Customization
Create a child theme for PHP modifications:

1. Create a new folder: `/wp-content/themes/demarchelier-child/`
2. Add `style.css` with theme header
3. Add `functions.php` to enqueue parent styles
4. Override template files as needed

### JavaScript Customization
Add custom JavaScript in **Appearance > Customize > Additional CSS**:

```javascript
// Example: Custom scroll behavior
jQuery(document).ready(function($) {
    // Your custom code here
});
```

## Performance Optimization

The theme includes several performance optimizations:

- **Lazy Loading**: Images load as they enter viewport
- **Debounced Scroll Events**: Optimized scroll handling
- **Minified Assets**: Compressed CSS and JS
- **Optimized Images**: WebP support and responsive images
- **Caching Ready**: Compatible with caching plugins

## SEO Features

- **Schema Markup**: Restaurant schema for search engines
- **Meta Tags**: Optimized meta descriptions and titles
- **Open Graph**: Social media sharing optimization
- **Structured Data**: Menu, hours, and contact information
- **Clean URLs**: SEO-friendly permalink structure

## Security Features

- **Security Headers**: XSS protection and content type headers
- **Nonce Verification**: AJAX request security
- **Input Sanitization**: All user inputs are sanitized
- **SQL Injection Protection**: Prepared statements
- **File Upload Security**: Restricted file types

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Internet Explorer 11+

## Mobile Support

- Responsive design
- Touch-friendly navigation
- Optimized images
- Fast loading on mobile networks

## Accessibility

- WCAG 2.1 AA compliant
- Keyboard navigation
- Screen reader support
- High contrast support
- Focus indicators
- Skip links

## Troubleshooting

### Common Issues

1. **ACF Fields Not Showing**
   - Ensure ACF Pro is installed and activated
   - Check if field groups are assigned to options page

2. **Contact Form Not Working**
   - Install and configure Contact Form 7
   - Check email settings in WordPress

3. **Images Not Loading**
   - Check file permissions
   - Verify image URLs in theme settings

4. **Mobile Menu Not Working**
   - Clear browser cache
   - Check for JavaScript conflicts

### Debug Mode

Enable WordPress debug mode in `wp-config.php`:

```php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
```

## Support

For support and customization requests:

1. Check the documentation
2. Review WordPress.org forums
3. Contact the theme developer

## Changelog

### Version 1.0.0
- Initial release
- ACF integration
- Custom Gutenberg blocks
- Responsive design
- SEO optimization

## License

This theme is licensed under GPL v2 or later.

## Credits

- Design: Custom design for Demarchelier Bistro
- Development: Custom WordPress theme
- Images: Unsplash (placeholder images)
- Fonts: Google Fonts 
<?php
/**
 * Fix Site Visibility Script
 * Makes the site publicly accessible and ensures proper settings
 */

// Database connection details
$host = 'mysql.demarchelierrestaurant.com';
$dbname = 'demarchelierrestaurant_c';
$username = '[YOUR_DB_USERNAME]'; // Replace with actual username
$password = '[YOUR_DB_PASSWORD]'; // Replace with actual password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n";
    
    // Get the correct table prefix
    $prefix = 'wp_cupsy3_'; // Update this if different
    
    // 1. Ensure site is public
    $sql = "UPDATE {$prefix}options SET option_value = '0' WHERE option_name = 'blog_public'";
    $pdo->exec($sql);
    echo "✓ Made site public\n";
    
    // 2. Set proper front page display
    $sql = "UPDATE {$prefix}options SET option_value = 'page' WHERE option_name = 'show_on_front'";
    $pdo->exec($sql);
    echo "✓ Set front page display to 'page'\n";
    
    // 3. Find and set the home page ID
    $sql = "SELECT ID FROM {$prefix}posts WHERE post_type = 'page' AND post_status = 'publish' ORDER BY ID ASC LIMIT 1";
    $stmt = $pdo->query($sql);
    $home_page_id = $stmt->fetchColumn();
    
    if ($home_page_id) {
        $sql = "UPDATE {$prefix}options SET option_value = ? WHERE option_name = 'page_on_front'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$home_page_id]);
        echo "✓ Set home page ID to: $home_page_id\n";
    }
    
    // 4. Ensure theme is active
    $sql = "UPDATE {$prefix}options SET option_value = 'demarchelier' WHERE option_name = 'stylesheet'";
    $pdo->exec($sql);
    echo "✓ Activated demarchelier theme\n";
    
    $sql = "UPDATE {$prefix}options SET option_value = 'demarchelier' WHERE option_name = 'template'";
    $pdo->exec($sql);
    echo "✓ Set template to demarchelier\n";
    
    // 5. Clear any maintenance mode
    $sql = "DELETE FROM {$prefix}options WHERE option_name = 'maintenance_mode'";
    $pdo->exec($sql);
    echo "✓ Cleared maintenance mode\n";
    
    // 6. Set proper permalink structure
    $sql = "UPDATE {$prefix}options SET option_value = '/%postname%/' WHERE option_name = 'permalink_structure'";
    $pdo->exec($sql);
    echo "✓ Set permalink structure\n";
    
    echo "\n✅ Site visibility fixed!\n";
    echo "Your site should now be publicly accessible.\n";
    echo "Try visiting: https://yourdomain.com/\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 
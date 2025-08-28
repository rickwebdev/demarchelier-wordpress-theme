<?php
/**
 * Database Prefix and URL Update Script
 * Run this after importing your database to fix table prefix and URLs
 */

// Database connection details (update these with your actual credentials)
$host = 'mysql.demarchelierrestaurant.com';
$dbname = 'demarchelierrestaurant_c';
$username = '[YOUR_DB_USERNAME]'; // Replace with actual username
$password = '[YOUR_DB_PASSWORD]'; // Replace with actual password

// Your domain
$new_domain = 'https://demarchelierrestaurant.com'; // Update with your actual domain

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully!\n";
    
    // Step 1: Rename tables from wp_ to wp_cupsy3_
    $tables = $pdo->query("SHOW TABLES LIKE 'wp_%'")->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($tables as $table) {
        $new_table = str_replace('wp_', 'wp_cupsy3_', $table);
        $sql = "RENAME TABLE `$table` TO `$new_table`";
        $pdo->exec($sql);
        echo "Renamed: $table -> $new_table\n";
    }
    
    // Step 2: Update site URLs in options table
    $sql = "UPDATE wp_cupsy3_options SET option_value = ? WHERE option_name IN ('siteurl', 'home')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$new_domain]);
    echo "Updated site URLs to: $new_domain\n";
    
    // Step 3: Update any hardcoded URLs in content
    $sql = "UPDATE wp_cupsy3_posts SET post_content = REPLACE(post_content, 'http://localhost:8000', ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$new_domain]);
    echo "Updated post content URLs\n";
    
    // Step 4: Update post GUIDs
    $sql = "UPDATE wp_cupsy3_posts SET guid = REPLACE(guid, 'http://localhost:8000', ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$new_domain]);
    echo "Updated post GUIDs\n";
    
    echo "\n✅ Database updated successfully!\n";
    echo "Your site should now work at: $new_domain\n";
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 
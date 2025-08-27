<?php
/**
 * Update Restaurant Hours Script
 * Updates the ACF hours field with current Google listing hours
 */

// New hours based on Google listing
$new_hours = array(
    array('day' => 'Mon', 'hours_text' => 'Closed'),
    array('day' => 'Tue', 'hours_text' => '12:00 PM - 9:00 PM'),
    array('day' => 'Wed', 'hours_text' => '12:00 PM - 9:00 PM'),
    array('day' => 'Thu', 'hours_text' => '12:00 PM - 9:00 PM'),
    array('day' => 'Fri', 'hours_text' => '12:00 PM - 9:30 PM'),
    array('day' => 'Sat', 'hours_text' => '12:00 PM - 9:30 PM'),
    array('day' => 'Sun', 'hours_text' => '12:00 PM - 8:30 PM'),
);

// Update ACF options
$result = update_option('options_hours', $new_hours);

if ($result) {
    echo "✅ Hours updated successfully!\n\n";
    echo "New hours:\n";
    foreach ($new_hours as $hour) {
        echo "- {$hour['day']}: {$hour['hours_text']}\n";
    }
    echo "\nThe hours have been updated in the WordPress database.\n";
    echo "You can view them in WordPress Admin > Theme Settings > Hours\n";
} else {
    echo "❌ Failed to update hours. Please check your WordPress installation.\n";
}

// Also update the customizer settings for backward compatibility
$customizer_hours = array(
    'hours_monday' => 'Mon: Closed',
    'hours_tuesday' => 'Tue: 12:00 PM - 9:00 PM',
    'hours_wednesday' => 'Wed: 12:00 PM - 9:00 PM',
    'hours_thursday' => 'Thu: 12:00 PM - 9:00 PM',
    'hours_friday' => 'Fri: 12:00 PM - 9:30 PM',
    'hours_saturday' => 'Sat: 12:00 PM - 9:30 PM',
    'hours_sunday' => 'Sun: 12:00 PM - 8:30 PM',
);

foreach ($customizer_hours as $key => $value) {
    set_theme_mod($key, $value);
}

echo "\n✅ Customizer hours also updated for compatibility.\n";
?> 
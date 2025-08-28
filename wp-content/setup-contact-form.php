<?php
/**
 * Setup Contact Form 7 for Demarchelier
 * Run with: wp eval-file setup-contact-form.php
 */

// Check if Contact Form 7 is active
if (!function_exists('wpcf7_contact_form')) {
    WP_CLI::error('Contact Form 7 is not active');
    exit;
}

// Create the form content
$form_content = '
<label>Full name *<br />
    [text* fullname] </label>

<label>Email *<br />
    [email* email] </label>

<label>Subject<br />
    [text subject] </label>

<label>Message<br />
    [textarea comment] </label>

[submit "Send a Message"]
';

$mail_content = '
From: [fullname] <[email]>
Subject: [subject]

Message:
[comment]

-- 
This email was sent from the Demarchelier website contact form.
';

$mail_2_content = '
Thank you for contacting Demarchelier Bistro!

We have received your message and will get back to you soon.

Your message:
[comment]

Best regards,
The Demarchelier Team
';

// Create the form
$form_data = array(
    'post_title' => 'Demarchelier Contact Form',
    'post_content' => $form_content,
    'post_status' => 'publish',
    'post_type' => 'wpcf7_contact_form'
);

// Insert the form
$form_id = wp_insert_post($form_data);

if ($form_id) {
    // Update form meta
    update_post_meta($form_id, '_form', $form_content);
    update_post_meta($form_id, '_mail', array(
        'subject' => 'New message from Demarchelier website',
        'sender' => 'Demarchelier <noreply@demarchelierrestaurant.com>',
        'body' => $mail_content,
        'recipient' => 'info@demarchelierrestaurant.com',
        'additional_headers' => 'Content-Type: text/html; charset=UTF-8',
        'attachments' => '',
        'use_html' => 1,
        'exclude_blank' => 0
    ));
    
    // Add mail 2 (auto-reply)
    update_post_meta($form_id, '_mail_2', array(
        'active' => 1,
        'subject' => 'Thank you for contacting Demarchelier',
        'sender' => 'Demarchelier <info@demarchelierrestaurant.com>',
        'body' => $mail_2_content,
        'recipient' => '[email]',
        'additional_headers' => 'Content-Type: text/html; charset=UTF-8',
        'attachments' => '',
        'use_html' => 1,
        'exclude_blank' => 0
    ));
    
    // Add messages
    update_post_meta($form_id, '_messages', array(
        'mail_sent_ok' => 'Thank you for your message. It has been sent.',
        'mail_sent_ng' => 'There was an error trying to send your message. Please try again later.',
        'validation_error' => 'One or more fields have an error. Please check and try again.',
        'spam' => 'There was an error trying to send your message. Please try again later.',
        'accept_terms' => 'You must accept the terms and conditions before sending your message.',
        'invalid_required' => 'Please fill the required field.',
        'invalid_too_long' => 'This field has a too long response.',
        'invalid_too_short' => 'This field has a too short response.'
    ));
    
    // Add additional settings
    update_post_meta($form_id, '_additional_settings', '');
    update_post_meta($form_id, '_locale', 'en_US');
    
    WP_CLI::success("Contact Form 7 created successfully with ID: $form_id");
    WP_CLI::log("Form shortcode: [contact-form-7 id=\"$form_id\" title=\"Demarchelier Contact Form\"]");
} else {
    WP_CLI::error('Failed to create Contact Form 7');
}
?> 
<footer class="site-footer">
    <div class="container foot-grid">
                <div>
            <strong><?php bloginfo('name'); ?></strong><br>
            <?php 
            $address = get_theme_mod('address', '471 Main Street, Greenport NY 11944');
            echo nl2br(esc_html($address));
            ?><br>
            <a href="https://maps.google.com/?q=<?php echo urlencode($address); ?>" target="_blank" rel="noopener"><?php _e('View on Google Maps', 'demarchelier'); ?></a>
        </div>
 
        <div>
            <strong><?php _e('Contact', 'demarchelier'); ?></strong><br>
            <?php 
            $phone = get_theme_mod('phone', '1.631.593.1650');
            $email = get_theme_mod('email', 'info@demarchelierbistro.com');
            ?>
            <a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a><br>
            <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><br>
            <div class="social-icons">
                <?php 
                $instagram = get_theme_mod('instagram', 'https://www.instagram.com/demarchelierbistro/');
                $facebook = get_theme_mod('facebook', 'https://www.facebook.com/demarchelierbistro/');
                ?>
                <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="<?php _e('Follow us on Instagram', 'demarchelier'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                    </svg>
                </a>
                <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener" class="social-icon" aria-label="<?php _e('Follow us on Facebook', 'demarchelier'); ?>">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    <div class="container" style="padding-top:12px">
        <small>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('All rights reserved.', 'demarchelier'); ?></small>
        <?php if (get_theme_mod('show_footer_credit', true)): ?>
            <br><small style="margin-top:8px; display:inline-block; opacity:0.7;">
                <?php _e('Website by', 'demarchelier'); ?> 
                <a href="https://rickthewebdev.com" target="_blank" rel="noopener" style="color:inherit; text-decoration:underline; transition:opacity 0.2s ease;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">Rick O</a> @ 
                <a href="https://subtenantstudios.com" target="_blank" rel="noopener" style="color:inherit; text-decoration:underline; transition:opacity 0.2s ease;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.7'">Subtenant Studios</a>
            </small>
        <?php endif; ?>
    </div>
</footer>

<?php wp_footer(); ?>

</body>
</html> 
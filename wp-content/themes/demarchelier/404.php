<?php get_header(); ?>

<main id="main">
    <section class="error-404 not-found">
        <div class="container">
            <div class="error-content">
                <h1 class="outlined-heading"><?php _e('404', 'demarchelier'); ?></h1>
                <h2><?php _e('Page Not Found', 'demarchelier'); ?></h2>
                <p><?php _e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'demarchelier'); ?></p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn"><?php _e('Return Home', 'demarchelier'); ?></a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?> 
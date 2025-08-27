<?php get_header(); ?>

<main id="main">
    <?php if (is_front_page()): ?>
        <!-- Homepage template -->
        <?php get_template_part('template-parts/homepage', 'default'); ?>
    <?php elseif (have_posts()): ?>
        <?php while (have_posts()): the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="container">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    <?php else: ?>
        <!-- Default content if no posts -->
        <div class="container">
            <h1>No content found</h1>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?> 
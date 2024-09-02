<?php get_header(); ?>

<main id="post-content">
    <?php
    while (have_posts()) : the_post();
        get_template_part('template-parts/content', 'single');
    endwhile;
    ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

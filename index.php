<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mamata
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <h1>Welcome to Mamata Beauty Salon & Wellness</h1>
                <p>Experience the best in beauty and wellness with our professional services. Book your appointment today!</p>
                <a href="<?php echo esc_url(home_url('/appointment')); ?>" class="button">Book Now</a>
            </div>
        </section>

        <!-- Recent Posts Section -->
        <section class="recent-posts">
            <div class="container">
                <h2>Our Services & Updates</h2>
                <?php
                // Query for the latest posts
                $query = new WP_Query(array(
                    'posts_per_page' => 3,
                    'post_type'      => 'post', // Change this to 'services' or another custom post type if needed
                ));

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail">
                                        <?php the_post_thumbnail('large'); ?>
                                    </div>
                                <?php endif; ?>
                                <h2 class="entry-title">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </h2>
                            </header>

                            <div class="entry-summary">
                                <?php the_excerpt(); ?>
                            </div>

                            <footer class="entry-footer">
                                <a href="<?php the_permalink(); ?>" class="button">Read More</a>
                            </footer>
                        </article>
                    <?php endwhile;

                    // Pagination
                    the_posts_pagination(array(
                        'prev_text' => __('Previous page', 'mamata'),
                        'next_text' => __('Next page', 'mamata'),
                        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'mamata') . ' </span>',
                    ));

                else :
                    echo '<p>No posts found.</p>';
                endif;

                // Reset post data
                wp_reset_postdata();
                ?>
            </div>
        </section>

        <!-- Call to Action Section -->
        <section class="cta">
            <div class="container">
                <h2>Ready for a Change?</h2>
                <p>Transform your look and feel revitalized. Contact us for a consultation or book an appointment online.</p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="button">Contact Us</a>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

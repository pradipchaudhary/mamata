<?php
/**
 * Footer template
 *
 * @package Mamata
 */

?>

    </div><!-- #content -->

    <footer class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="footer-widget-area">
                    <?php if (is_active_sidebar('footer-1')) : ?>
                        <?php dynamic_sidebar('footer-1'); ?>
                    <?php else : ?>
                        <h2 class="widget-title">Latest News</h2>
                        <ul>
                            <?php
                            $recent_posts = new WP_Query(array(
                                'posts_per_page' => 3,
                                'post_status'    => 'publish',
                            ));
                            if ($recent_posts->have_posts()) :
                                while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
                                <?php endwhile;
                            else :
                                echo '<li>No posts available.</li>';
                            endif;
                            wp_reset_postdata();
                            ?>
                        </ul>
                    <?php endif; ?>
                </div><!-- .footer-widget-area -->

                <div class="footer-widget-area">
                    <?php if (is_active_sidebar('footer-2')) : ?>
                        <?php dynamic_sidebar('footer-2'); ?>
                    <?php else : ?>
                        <h2 class="widget-title">Contact Us</h2>
                        <p>123 Beauty Lane<br>Wellness City, BC 12345</p>
                        <p><a href="mailto:info@beautysalon.com">info@beautysalon.com</a></p>
                        <p><a href="tel:+1234567890">+1 (234) 567-890</a></p>
                    <?php endif; ?>
                </div><!-- .footer-widget-area -->

                <div class="footer-widget-area">
                    <?php if (is_active_sidebar('footer-3')) : ?>
                        <?php dynamic_sidebar('footer-3'); ?>
                    <?php else : ?>
                        <h2 class="widget-title">Follow Us</h2>
                        <ul class="social-links">
                            <li><a href="https://facebook.com/yourpage" target="_blank" rel="noopener noreferrer">Facebook</a></li>
                            <li><a href="https://twitter.com/yourprofile" target="_blank" rel="noopener noreferrer">Twitter</a></li>
                            <li><a href="https://instagram.com/yourprofile" target="_blank" rel="noopener noreferrer">Instagram</a></li>
                            <li><a href="https://linkedin.com/in/yourprofile" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                        </ul>
                    <?php endif; ?>
                </div><!-- .footer-widget-area -->
            </div><!-- .footer-widgets -->

            <div class="footer-bottom">
                <div class="footer-logo">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                    <?php endif; ?>
                </div><!-- .footer-logo -->

                <div class="footer-info">
                    <p>&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>. All rights reserved.</p>
                    <p>Designed with love by <a href="https://pradipchaudhary.com.np/" target="_blank" rel="noopener noreferrer">Pradip Chaudhary</a></p>
                </div><!-- .footer-info -->

                <div class="footer-back-to-top">
                    <a href="#top" class="button">Back to Top</a>
                </div><!-- .footer-back-to-top -->
            </div><!-- .footer-bottom -->
        </div><!-- .container -->
    </footer><!-- .site-footer -->

    <?php wp_footer(); ?>

</body>
</html>

<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nexusolution
 */

get_header();
?>
<!-- banner section  -->
<?php
echo do_shortcode('[smartslider3 slider="1"]');
?>
<!-- :: Main Content -->
<div class="main">
    <h1> main content</h1>
</div>
<!-- :: About Section  -->
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/Computer-Hardware.jpg" alt="">
            </div>
            <div class="col-md-6">
                <div class="title"> ABOUT US </div>
                <div class="sub-title"></div>
            </div>
        </div>
    </div>
</section>
<!-- :: Testimonials -->
<section id="testimonials">
    <div class="container">
        <div class="row">
            <div class="testimonials-title">
                What People Say About Us
            </div>
            <?php echo do_shortcode('[sp_testimonial id="28"]'); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
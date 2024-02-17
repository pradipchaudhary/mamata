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



get_header();

?>

<div id="content" class="site-content <?php echo esc_attr($xe_opt->container); ?> padding-top-bottom clearfix">

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">



        </main><!-- #main -->
    </div><!-- #primary -->

    <?php get_sidebar(); ?>

</div><!-- #content -->

<?php
get_footer();
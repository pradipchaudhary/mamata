<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta name="author" content="Pradip Chaudhary">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="<?php wp_title(''); ?> | Mamata - Beauty Salon & Wellness">
    <meta property="og:description" content="<?php echo esc_attr(get_bloginfo('description')); ?>">
    <meta property="og:image" content="<?php echo esc_url(get_template_directory_uri() . '/images/og-image.jpg'); ?>">
    <meta property="og:url" content="<?php echo esc_url(home_url('/')); ?>">
    <meta property="og:type" content="website">
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/images/favicon.ico'); ?>" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri()); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header">
        <div class="container">
            <div class="site-branding">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1 class="site-title">
                        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                <?php endif; ?>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            </div><!-- .site-branding -->

            <nav id="site-navigation" class="main-navigation">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                ));
                ?>
            </nav><!-- #site-navigation -->
        </div><!-- .container -->
    </header><!-- .site-header -->

    <div id="content" class="site-content">
        <!-- Main content will be injected here -->

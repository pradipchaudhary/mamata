<?php
/**
 * Theme Functions.
 * 
 * @package Mamata 
 */

 function mamata_theme_setup() {
     // Add theme support for various features
     add_theme_support('post-thumbnails');
     add_theme_support('custom-logo');
     add_theme_support('title-tag');
     add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
 
     // Register menus
     register_nav_menus(array(
         'primary' => __('Primary Menu', 'mamata-beauty-salon'),
         'footer'  => __('Footer Menu', 'mamata-beauty-salon')
     ));
 }
 
 add_action('after_setup_theme', 'mamata_theme_setup');
 
 // Enqueue theme styles and scripts
 function mamata_enqueue_styles() {
     wp_enqueue_style('main-style', get_stylesheet_uri());
 }
 
 add_action('wp_enqueue_scripts', 'mamata_enqueue_styles');
 
 // Register widget areas
 function mamata_widgets_init() {
     register_sidebar(array(
         'name'          => __('Sidebar', 'mamata-beauty-salon'),
         'id'            => 'sidebar-1',
         'description'   => __('Add widgets here.', 'mamata-beauty-salon'),
         'before_widget' => '<div class="widget">',
         'after_widget'  => '</div>',
         'before_title'  => '<h2 class="widget-title">',
         'after_title'   => '</h2>',
     ));
 }
 add_action('widgets_init', 'mamata_widgets_init');
 

?>
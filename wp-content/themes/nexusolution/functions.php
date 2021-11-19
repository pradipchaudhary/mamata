<?php

/**
 * nexusolution functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nexusolution
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('nexusolution_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function nexusolution_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on nexusolution, use a find and replace
		 * to change 'nexusolution' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('nexusolution', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'nexusolution'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'nexusolution_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'nexusolution_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nexusolution_content_width()
{
	$GLOBALS['content_width'] = apply_filters('nexusolution_content_width', 640);
}
add_action('after_setup_theme', 'nexusolution_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nexusolution_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'nexusolution'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'nexusolution'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'nexusolution_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function nexusolution_scripts()
{
	wp_enqueue_style('nexusolution-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style("nexusolution-bootstrap", get_template_directory_uri() . '/assets/css/bootstrap.min.css');
	wp_enqueue_style("nexusolution-fontawesome", get_template_directory_uri() . '/assets/css/all.min.css');
	// wp_enqueue_style("nexusolution-font-awesome", 'https://pro.fontawesome.com/releases/v5.10.0/css/all.css');
	// Main CSS 
	wp_enqueue_style("nexusolution-main-style", get_template_directory_uri() . '/assets/css/main.css');
	// wp_style_add_data( 'nexusolution-style', 'rtl', 'replace' );

	// JSS Include
	wp_enqueue_script('nexusolution-main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true);
	wp_enqueue_script('nexusolution-bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('nexusolution-fontawesome-js', get_template_directory_uri() . '/assets/js/all.min.js', array(), _S_VERSION, true);
	wp_enqueue_script('nexusolution-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'nexusolution_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load the menu nav walker for bootstrap by Edward McIntyre
 * https://github.com/twittem/wp-bootstrap-navwalker
 */

if (!file_exists(get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php')) {
	// file does not exist... return an error.
	return new WP_Error('class-wp-bootstrap-navwalker-missing', __('It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker'));
} else {
	// file exists... require it.
	require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
}


add_filter('nav_menu_link_attributes', 'bootstrap5_dropdown_fix');
function bootstrap5_dropdown_fix($atts)
{
	if (array_key_exists('data-toggle', $atts)) {
		unset($atts['data-toggle']);
		$atts['data-bs-toggle'] = 'dropdown';
	}
	return $atts;
}



require_once get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
function main_menu()
{
	wp_nav_menu(array(
		'theme_location'    => 'menu-1',
		'menu_class'        => 'navbar-nav ms-auto mb-2 mb-lg-0',
		'depth'             => 2,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse',
		'container_id'      => 'navbarSupportedContent',
		'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
		'walker'            => new WP_Bootstrap_Navwalker(),
	));
}

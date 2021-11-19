<?php
/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://shapedplugin.com
 * @since             1.0
 * @package           Testimonial
 *
 * Plugin Name:     Testimonial
 * Plugin URI:      https://shapedplugin.com/plugin/testimonial-pro/?ref=1
 * Description:     Most Customizable and Powerful Testimonials Showcase Plugin for WordPress that allows you to manage and display Testimonials or Reviews on any page or widget.
 * Version:         2.3.2
 * Author:          ShapedPlugin
 * Author URI:      https://shapedplugin.com/
 * Text Domain:     testimonial-free
 * Domain Path:     /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Pro version check.
 *
 * @return boolean
 */
function is_testimonial_pro() {
	include_once ABSPATH . 'wp-admin/includes/plugin.php';
	if ( ! ( is_plugin_active( 'testimonial-pro/testimonial-pro.php' ) || is_plugin_active_for_network( 'testimonial-pro/testimonial-pro.php' ) ) ) {
		return true;
	}
}

if ( is_testimonial_pro() ) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-updates.php';
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-testimonial-import-export.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/notices/review.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/framework/classes/setup.class.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/testimonial-settings.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/testimonial-tools.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/testimonial-metaboxs.php';
	require_once plugin_dir_path( __FILE__ ) . 'admin/views/testimonial-form.php';
}

if ( ! class_exists( 'SP_Testimonial_FREE' ) ) {
	/**
	 * Handles core plugin hooks and action setup.
	 *
	 * @package testimonial-free
	 * @since 2.0
	 */
	class SP_Testimonial_FREE {
		/**
		 * Plugin version
		 *
		 * @var string
		 */
		public $version = '2.3.2';

		/**
		 * Plugin testimonial.
		 *
		 * @var SP_TFREE_Testimonial $testimonial
		 */
		public $testimonial;

		/**
		 * Plugin short code.
		 *
		 * @var SP_TFREE_Shortcodes $shortcode
		 */
		public $shortcode;

		/**
		 * Plugin router.
		 *
		 * @var SP_TFREE_Router $router
		 */
		public $router;

		/**
		 * Holds class object.
		 *
		 * @var null
		 * @since 2.0
		 */
		protected static $_instance = null;

		/**
		 * Initialize the SP_Testimonial_FREE() class.
		 *
		 * @return SP_Testimonial_FREE
		 * @since 2.0
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * SP_Testimonial_FREE constructor.
		 */
		public function __construct() {
			// Define constants.
			$this->define_constants();

			// Required class file include.
			spl_autoload_register( array( $this, 'autoload' ) );

			// Include required files.
			$this->includes();

			// instantiate classes.
			$this->instantiate();

			// Initialize the filter hooks.
			$this->init_filters();

			// Initialize the action hooks.
			$this->init_actions();
		}

		/**
		 * Initialize WordPress filter hooks
		 *
		 * @return void
		 */
		public function init_filters() {
			add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 2 );
			add_filter( 'manage_spt_shortcodes_posts_columns', array( $this, 'add_shortcode_column' ) );
			add_filter( 'plugin_row_meta', array( $this, 'after_testimonial_free_row_meta' ), 10, 4 );
			add_filter( 'manage_spt_testimonial_posts_columns', array( $this, 'add_testimonial_column' ) );
		}

		/**
		 * Initialize WordPress action hooks
		 *
		 * @return void
		 */
		public function init_actions() {
			add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
			add_action( 'manage_spt_shortcodes_posts_custom_column', array( $this, 'add_shortcode_form' ), 10, 2 );
			add_action( 'manage_spt_testimonial_posts_custom_column', array( $this, 'add_testimonial_extra_column' ), 10, 2 );
			add_action( 'activated_plugin', array( $this, 'redirect_help_page' ) );

			// Import Export.
			$import_export = new Testimonial_Import_Export( SP_TFREE_NAME, SP_TFREE_VERSION );

			add_action( 'wp_ajax_spt_export_shortcodes', array( $import_export, 'export_shortcodes' ) );
			add_action( 'wp_ajax_spt_import_shortcodes', array( $import_export, 'import_shortcodes' ) );
		}

		/**
		 * Define constants
		 *
		 * @since 2.0
		 */
		public function define_constants() {
			$this->define( 'SP_TFREE_NAME', 'Testimonial' );
			$this->define( 'SP_TFREE_VERSION', $this->version );
			$this->define( 'SP_TFREE_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'SP_TFREE_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'SP_TFREE_BASENAME', plugin_basename( __FILE__ ) );
		}

		/**
		 * Define constant if not already set.
		 *
		 * @since 2.0
		 *
		 * @param  string      $name Constant name.
		 * @param  string|bool $value Constant value.
		 */
		public function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}


		/**
		 * Load TextDomain for plugin.
		 *
		 * @since 2.0
		 */
		public function load_text_domain() {
			load_plugin_textdomain( 'testimonial-free', false, SP_TFREE_PATH . '/languages' );
		}

		/**
		 * Add plugin action menu
		 *
		 * Fired by `plugin_action_links` filter.
		 *
		 * @param array  $links The action link.
		 * @param string $file The file.
		 * @since 2.0.0
		 * @return array
		 */
		public function add_plugin_action_links( $links, $file ) {

			if ( SP_TFREE_BASENAME === $file ) {
				$ui_links        = array(
					sprintf( '<a href="%s">%s</a>', admin_url( 'post-new.php?post_type=spt_testimonial' ), __( 'Add Testimonial', 'testimonial-free' ) ),
					sprintf( '<a href="%s">%s</a>', admin_url( 'edit.php?post_type=spt_shortcodes' ), __( 'Manage Views', 'testimonial-free' ) ),
				);
				$links['go_pro'] = sprintf( '<a href="%s" style="%s">%s</a>', 'https://shapedplugin.com/plugin/testimonial-pro/?ref=1', 'color:#35b747;font-weight:bold', __( 'Go Pro!', 'testimonial-free' ) );

				return array_merge( $ui_links, $links );

			}

			return $links;
		}

		/**
		 * Add plugin row meta link
		 *
		 * @since 2.0
		 *
		 * @param array  $plugin_meta An array of the plugin's metadata.
		 * @param string $file Path to the plugin file.
		 *
		 * @return array An array of plugin row meta links
		 */
		public function after_testimonial_free_row_meta( $plugin_meta, $file ) {
			if ( SP_TFREE_BASENAME === $file ) {
				$plugin_meta[] = '<a href="https://demo.shapedplugin.com/testimonial/" target="_blank">' . __( 'Live Demo', 'testimonial-free' ) . '</a>';
			}

			return $plugin_meta;
		}

		/**
		 * Autoload class files on demand
		 *
		 * @param string $class requested class name.
		 */
		public function autoload( $class ) {
			$name = explode( '_', $class );
			if ( isset( $name[2] ) ) {
				$class_name = strtolower( $name[2] );
				$filename   = SP_TFREE_PATH . '/class/' . $class_name . '.php';

				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Instantiate all the required classes
		 *
		 * @since 2.0
		 */
		public function instantiate() {
			$this->testimonial = SP_TFREE_Testimonial::getInstance();
			$this->shortcode   = SP_TFREE_Shortcodes::getInstance();

			do_action( 'sp_tfree_instantiate', $this );
		}

		/**
		 * Page router instantiate.
		 *
		 * @since 2.0
		 */
		public function page() {
			$this->router = SP_TFREE_Router::instance();

			return $this->router;
		}

		/**
		 * Include the required files
		 *
		 * @return void
		 */
		public function includes() {
			$this->page()->sp_tfree_function();
			$this->router->includes();
		}

		/**
		 * ShortCode Column.
		 *
		 * @return array
		 */
		public function add_shortcode_column() {
			$new_columns['cb']        = '<input type="checkbox" />';
			$new_columns['title']     = __( 'Slider Title', 'testimonial-free' );
			$new_columns['shortcode'] = __( 'Shortcode', 'testimonial-free' );
			$new_columns['']          = '';
			$new_columns['date']      = __( 'Date', 'testimonial-free' );

			return $new_columns;
		}

		/**
		 * Display admin columns for the testimonial.
		 *
		 * @param string $column The columns.
		 * @param int    $post_id The post ID.
		 * @since 2.0.0
		 * @return void
		 */
		public function add_shortcode_form( $column, $post_id ) {

			switch ( $column ) {

				case 'shortcode':
					echo '<input class="sp_tfree_input" style="width: 230px;padding: 4px 8px;" type="text" readonly="readonly" value="[sp_testimonial id=&quot;' . esc_attr( $post_id ) . '&quot;]"/>
					<div class="sptpro-after-copy-text"><i class="fa fa-check-circle"></i> Shortcode Copied to Clipboard! </div>';
					break;
				default:
					break;

			} // end switch

		}

		/**
		 * Testimonial Column
		 *
		 * @return array
		 */
		public function add_testimonial_column() {
			$new_columns['cb']     = '<input type="checkbox" />';
			$new_columns['title']  = __( 'Title', 'testimonial-free' );
			$new_columns['image']  = __( 'Image', 'testimonial-free' );
			$new_columns['name']   = __( 'Name', 'testimonial-free' );
			$new_columns['rating'] = __( 'Rating', 'testimonial-free' );
			$new_columns['']       = '';
			$new_columns['date']   = __( 'Date', 'testimonial-free' );

			return $new_columns;
		}

		/**
		 * Display testimonial member columns.
		 *
		 * @param string $column The columns.
		 * @param int    $post_id The post ID.
		 */
		public function add_testimonial_extra_column( $column, $post_id ) {

			switch ( $column ) {

				case 'rating':
					$testimonial_data = get_post_meta( $post_id, 'sp_tpro_meta_options', true );
					if ( isset( $testimonial_data['tpro_rating'] ) ) {
						$rating_star = $testimonial_data['tpro_rating'];
						$fill_star   = '<i style="color: #f3bb00;" class="fa fa-star"></i>';
						$empty_star  = '<i class="fa fa-star"></i>';
						switch ( $rating_star ) {
							case 'one_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $empty_star . $empty_star . $empty_star . $empty_star . '</span>';
								break;
							case 'two_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $fill_star . $empty_star . $empty_star . $empty_star . '</span>';
								break;
							case 'three_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $fill_star . $fill_star . $empty_star . $empty_star . '</span>';
								break;
							case 'four_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $fill_star . $fill_star . $fill_star . $empty_star . '</span>';
								break;
							case 'five_star':
								$column_field = '<span style="font-size: 16px; color: #d4d4d4;">' . $fill_star . $fill_star . $fill_star . $fill_star . $fill_star . '</span>';
								break;
							default:
								$column_field = '<span aria-hidden="true">—</span>';
								break;
						}

						echo wp_kses_post( $column_field );
					}

					break;
				case 'image':
					add_image_size( 'sp_tfree_client_small_img', 50, 50, true );

					$thumb_id                 = get_post_thumbnail_id( $post_id );
					$testimonial_client_image = wp_get_attachment_image_src( $thumb_id, 'sp_tfree_client_small_img' );
					if ( '' !== $testimonial_client_image && is_array( $testimonial_client_image ) ) {
						echo '<img  src="' . esc_url( $testimonial_client_image[0] ) . '" width="' . esc_attr( $testimonial_client_image[1] ) . '"  height="' . esc_attr( $testimonial_client_image[2] ) . '"/>';
					} else {
						echo '<span aria-hidden="true">—</span>';
					}
					break;
				default:
					break;
				case 'name':
					$testimonial_data = get_post_meta( $post_id, 'sp_tpro_meta_options', true );
					if ( isset( $testimonial_data['tpro_name'] ) ) {
						$testimonial_client_name = $testimonial_data['tpro_name'];
						if ( '' !== $testimonial_client_name ) {
							echo esc_html( $testimonial_client_name );
						} else {
							echo '<span aria-hidden="true">—</span>';
						}
					}
					break;

			} // end switch

		}

		/**
		 * Redirect after active.
		 *
		 * @param string $plugin Plugin base name.
		 */
		public function redirect_help_page( $plugin ) {
			if ( SP_TFREE_BASENAME === $plugin ) {
				wp_safe_redirect( admin_url( 'edit.php?post_type=spt_testimonial&page=tfree_help' ) );
				exit();
			}
		}

	}
}

/**
 * Returns the main instance.
 *
 * @since 2.0
 * @return SP_Testimonial_FREE
 */
function sp_testimonial_free() {
	return SP_Testimonial_FREE::instance();
}

if ( is_testimonial_pro() ) {
	// sp_testimonial_free instance.
	sp_testimonial_free();
}

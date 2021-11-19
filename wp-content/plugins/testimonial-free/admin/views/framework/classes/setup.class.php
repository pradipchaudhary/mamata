<?php
/**
 * Framework setup.class file.
 *
 * @link https://shapedplugin.com
 * @since 2.0.0
 *
 * @package Testimonial_free
 * @subpackage Testimonial_free/framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPFTESTIMONIAL' ) ) {
	/**
	 *
	 * Setup Class
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPFTESTIMONIAL {

		/**
		 * Version.
		 *
		 * @var string
		 */
		public static $version = '2.1.3';
		/**
		 * Dir.
		 *
		 * @var string
		 */
		public static $dir = null;
		/**
		 * Url.
		 *
		 * @var string
		 */
		public static $url = null;
		/**
		 * Init.
		 *
		 * @var array
		 */
		public static $inited = array();
		/**
		 * Field.
		 *
		 * @var array
		 */
		public static $fields = array();
		/**
		 * Args.
		 *
		 * @var array
		 */
		public static $args = array(
			'options'           => array(),
			'customize_options' => array(),
			'metaboxes'         => array(),
			'widgets'           => array(),
		);

		/**
		 * Shortcode instances.
		 *
		 * @var array
		 */
		public static $shortcode_instances = array();

		/**
		 * Init
		 *
		 * @return void
		 */
		public static function init() {

			// init action.
			do_action( 'spftestimonial_init' );

			// set constants.
			self::constants();

			// include files.
			self::includes();

			add_action( 'after_setup_theme', array( 'SPFTESTIMONIAL', 'setup' ) );
			add_action( 'init', array( 'SPFTESTIMONIAL', 'setup' ) );
			add_action( 'switch_theme', array( 'SPFTESTIMONIAL', 'setup' ) );
			add_action( 'admin_enqueue_scripts', array( 'SPFTESTIMONIAL', 'add_admin_enqueue_scripts' ), 20 );
			add_action( 'admin_head', array( 'SPFTESTIMONIAL', 'add_admin_head_css' ), 99 );
			add_action( 'customize_controls_print_styles', array( 'SPFTESTIMONIAL', 'add_admin_head_css' ), 99 );

		}

		/**
		 * Setup
		 *
		 * @return void
		 */
		public static function setup() {

			// setup options.
			$params = array();
			if ( ! empty( self::$args['options'] ) ) {
				foreach ( self::$args['options'] as $key => $value ) {
					if ( ! empty( self::$args['sections'][ $key ] ) && ! isset( self::$inited[ $key ] ) ) {

						$params['args']       = $value;
						$params['sections']   = self::$args['sections'][ $key ];
						self::$inited[ $key ] = true;

						SPFTESTIMONIAL_Options::instance( $key, $params );

						if ( ! empty( $value['show_in_customizer'] ) ) {
							$value['output_css']                     = false;
							$value['enqueue_webfont']                = false;
							self::$args['customize_options'][ $key ] = $value;
							self::$inited[ $key ]                    = null;
						}
					}
				}
			}

			// setup customize options.
			$params = array();
			if ( ! empty( self::$args['customize_options'] ) ) {
				foreach ( self::$args['customize_options'] as $key => $value ) {
					if ( ! empty( self::$args['sections'][ $key ] ) && ! isset( self::$inited[ $key ] ) ) {

						$params['args']       = $value;
						$params['sections']   = self::$args['sections'][ $key ];
						self::$inited[ $key ] = true;

						SPFTESTIMONIAL_Customize_Options::instance( $key, $params );

					}
				}
			}

			// setup metaboxes.
			$params = array();
			if ( ! empty( self::$args['metaboxes'] ) ) {
				foreach ( self::$args['metaboxes'] as $key => $value ) {
					if ( ! empty( self::$args['sections'][ $key ] ) && ! isset( self::$inited[ $key ] ) ) {

						$params['args']       = $value;
						$params['sections']   = self::$args['sections'][ $key ];
						self::$inited[ $key ] = true;

						SPFTESTIMONIAL_Metabox::instance( $key, $params );

					}
				}
			}

			// create widgets.
			if ( ! empty( self::$args['widgets'] ) && class_exists( 'WP_Widget_Factory' ) ) {

				$wp_widget_factory = new WP_Widget_Factory();

				foreach ( self::$args['widgets'] as $key => $value ) {
					if ( ! isset( self::$inited[ $key ] ) ) {
						self::$inited[ $key ] = true;
						$wp_widget_factory->register( SPFTESTIMONIAL_Widget::instance( $key, $value ) );
					}
				}
			}

			do_action( 'spftestimonial_loaded' );

		}

		/**
		 * Create Options
		 *
		 * @param  mixed $id ID.
		 * @param  mixed $args Args.
		 * @return void
		 */
		public static function createOptions( $id, $args = array() ) {
			self::$args['options'][ $id ] = $args;
		}

		/**
		 * Create customize options.
		 *
		 * @param  int   $id ID.
		 * @param  array $args customize option.
		 * @return void
		 */
		public static function createCustomizeOptions( $id, $args = array() ) {
			self::$args['customize_options'][ $id ] = $args;
		}

		/**
		 * Create metabox options.
		 *
		 * @param  mixed $id ID.
		 * @param  mixed $args Args.
		 * @return void
		 */
		public static function createMetabox( $id, $args = array() ) {
			self::$args['metaboxes'][ $id ] = $args;
		}

		/**
		 * Create widget.
		 *
		 * @param  mixed $id ID.
		 * @param  mixed $args Args.
		 * @return void
		 */
		public static function createWidget( $id, $args = array() ) {
			self::$args['widgets'][ $id ] = $args;
			self::set_used_fields( $args );
		}

		/**
		 * Create section.
		 *
		 * @param  mixed $id ID.
		 * @param  mixed $sections Sections.
		 * @return void
		 */
		public static function createSection( $id, $sections ) {
			self::$args['sections'][ $id ][] = $sections;
			self::set_used_fields( $sections );
		}

		/**
		 * Constants
		 *
		 * @return void
		 */
		public static function constants() {

			// we need this path-finder code for set URL of framework.
			$dirname        = wp_normalize_path( dirname( dirname( __FILE__ ) ) );
			$theme_dir      = wp_normalize_path( get_parent_theme_file_path() );
			$plugin_dir     = wp_normalize_path( WP_PLUGIN_DIR );
			$plugin_dir     = str_replace( '/opt/bitnami', '/bitnami', $plugin_dir );
			$located_plugin = ( preg_match( '#' . self::sanitize_dirname( $plugin_dir ) . '#', self::sanitize_dirname( $dirname ) ) ) ? true : false;
			$directory      = ( $located_plugin ) ? $plugin_dir : $theme_dir;
			$directory_uri  = ( $located_plugin ) ? WP_PLUGIN_URL : get_parent_theme_file_uri();
			$foldername     = str_replace( $directory, '', $dirname );
			$protocol_uri   = ( is_ssl() ) ? 'https' : 'http';
			$directory_uri  = set_url_scheme( $directory_uri, $protocol_uri );

			self::$dir = $dirname;
			self::$url = $directory_uri . $foldername;

		}

		/**
		 * Include plugin files
		 *
		 * @param  mixed $file file.
		 * @param  mixed $load load.
		 * @return array
		 */
		public static function include_plugin_file( $file, $load = true ) {

			$path     = '';
			$file     = ltrim( $file, '/' );
			$override = apply_filters( 'spftestimonial_override', 'spftestimonial-override' );

			if ( file_exists( get_parent_theme_file_path( $override . '/' . $file ) ) ) {
				$path = get_parent_theme_file_path( $override . '/' . $file );
			} elseif ( file_exists( get_theme_file_path( $override . '/' . $file ) ) ) {
				$path = get_theme_file_path( $override . '/' . $file );
			} elseif ( file_exists( self::$dir . '/' . $override . '/' . $file ) ) {
				$path = self::$dir . '/' . $override . '/' . $file;
			} elseif ( file_exists( self::$dir . '/' . $file ) ) {
				$path = self::$dir . '/' . $file;
			}

			if ( ! empty( $path ) && ! empty( $file ) && $load ) {

				global $wp_query;

				if ( is_object( $wp_query ) && function_exists( 'load_template' ) ) {

					load_template( $path, true );

				} else {

					require_once $path;

				}
			} else {

				return self::$dir . '/' . $file;

			}

		}

		/**
		 * Is active plugin
		 *
		 * @param  mixed $file file.
		 * @return statement
		 */
		public static function is_active_plugin( $file = '' ) {
			return in_array( $file, (array) get_option( 'active_plugins', array() ), true );
		}

		/**
		 * Sanitize dirname.
		 *
		 * @param  mixed $dirname dirname.
		 * @return statement
		 */
		public static function sanitize_dirname( $dirname ) {
			return preg_replace( '/[^A-Za-z]/', '', $dirname );
		}

		/**
		 * Set plugin url.
		 *
		 * @param  mixed $file file.
		 * @return string
		 */
		public static function include_plugin_url( $file ) {
			return self::$url . '/' . ltrim( $file, '/' );
		}

		/**
		 * General includes.
		 *
		 * @return void
		 */
		public static function includes() {

			// includes helpers.
			self::include_plugin_file( 'functions/actions.php' );
			self::include_plugin_file( 'functions/deprecated.php' );
			self::include_plugin_file( 'functions/helpers.php' );
			self::include_plugin_file( 'functions/sanitize.php' );
			self::include_plugin_file( 'functions/validate.php' );

			// includes classes.
			self::include_plugin_file( 'classes/abstract.class.php' );
			self::include_plugin_file( 'classes/fields.class.php' );
			self::include_plugin_file( 'classes/options.class.php' );
			self::include_plugin_file( 'classes/customize-options.class.php' );
			self::include_plugin_file( 'classes/metabox.class.php' );
			self::include_plugin_file( 'classes/widgets.class.php' );

		}

		/**
		 * Include field.
		 *
		 * @param  mixed $type type.
		 * @return void
		 */
		public static function maybe_include_field( $type = '' ) {
			if ( ! class_exists( 'SPFTESTIMONIAL_Field_' . $type ) && class_exists( 'SPFTESTIMONIAL_Fields' ) ) {
				self::include_plugin_file( 'fields/' . $type . '/' . $type . '.php' );
			}
		}

		/**
		 * Get all of fields.
		 *
		 * @param  mixed $sections sections.
		 * @return void
		 */
		public static function set_used_fields( $sections ) {

			if ( ! empty( $sections['fields'] ) ) {

				foreach ( $sections['fields'] as $field ) {

					if ( ! empty( $field['fields'] ) ) {
						self::set_used_fields( $field );
					}

					if ( ! empty( $field['tabs'] ) ) {
						self::set_used_fields( array( 'fields' => $field['tabs'] ) );
					}

					if ( ! empty( $field['accordions'] ) ) {
						self::set_used_fields( array( 'fields' => $field['accordions'] ) );
					}

					if ( ! empty( $field['type'] ) ) {
						self::$fields[ $field['type'] ] = $field;
					}
				}
			}

		}

		/**
		 * Enqueue admin and fields styles and scripts.
		 *
		 * @return void
		 */
		public static function add_admin_enqueue_scripts() {

			// check for developer mode.
			$min = ( apply_filters( 'spftestimonial_dev_mode', false ) || WP_DEBUG ) ? '' : '.min';

			// admin utilities.
			wp_enqueue_media();

			// wp color picker.
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );

			$screen = get_current_screen();
			if ( 'spt_testimonial_form' === $screen->post_type || 'spt_testimonial' === $screen->post_type || 'spt_shortcodes' === $screen->post_type ) {
				wp_enqueue_style( 'tfree-font-awesome', SP_TFREE_URL . 'public/assets/css/font-awesome.min.css', array(), SP_TFREE_VERSION );

				// framework core styles.
				wp_enqueue_style( 'spftestimonial', self::include_plugin_url( 'assets/css/spftestimonial' . $min . '.css' ), array(), SP_TFREE_VERSION, 'all' );

				// rtl styles.
				if ( is_rtl() ) {
					wp_enqueue_style( 'spftestimonial-rtl', self::include_plugin_url( 'assets/css/spftestimonial-rtl' . $min . '.css' ), array(), SP_TFREE_VERSION, 'all' );
				}

				// framework core scripts.
				wp_enqueue_script( 'spftestimonial-plugins', self::include_plugin_url( 'assets/js/spftestimonial-plugins' . $min . '.js' ), array(), SP_TFREE_VERSION, true );
				wp_enqueue_script( 'spftestimonial', self::include_plugin_url( 'assets/js/spftestimonial' . $min . '.js' ), array( 'spftestimonial-plugins' ), SP_TFREE_VERSION, true );

				wp_localize_script(
					'spftestimonial',
					'spftestimonial_vars',
					array(
						'color_palette' => apply_filters( 'spftestimonial_color_palette', array() ),
						'i18n'          => array(
							// global localize.
							'confirm'             => esc_html__( 'Are you sure?', 'testimonial-free' ),
							'reset_notification'  => esc_html__( 'Restoring options.', 'testimonial-free' ),
							'import_notification' => esc_html__( 'Importing options.', 'testimonial-free' ),

							// chosen localize.
							'typing_text'         => esc_html__( 'Please enter %s or more characters', 'testimonial-free' ), // phpcs:ignore
							'searching_text'      => esc_html__( 'Searching...', 'testimonial-free' ),
							'no_results_text'     => esc_html__( 'No results match', 'testimonial-free' ),
						),
					)
				);
			}
			// load admin enqueue scripts and styles.
			$enqueued = array();

			if ( ! empty( self::$fields ) ) {
				foreach ( self::$fields as $field ) {
					if ( ! empty( $field['type'] ) ) {
						$classname = 'SPFTESTIMONIAL_Field_' . $field['type'];
						self::maybe_include_field( $field['type'] );
						if ( class_exists( $classname ) && method_exists( $classname, 'enqueue' ) ) {
							$instance = new $classname( $field );
							if ( method_exists( $classname, 'enqueue' ) ) {
								$instance->enqueue();
							}
							unset( $instance );
						}
					}
				}
			}

			do_action( 'spftestimonial_enqueue' );

		}

		/**
		 * WP 5.2 fallback.
		 *
		 * This function has been created as temporary.
		 * It will be remove after stable version of wp 5.3.
		 *
		 * @return void
		 */
		public static function add_admin_head_css() {

			global $wp_version;

			$current_branch = implode( '.', array_slice( preg_split( '/[.-]/', $wp_version ), 0, 2 ) );

			if ( version_compare( $current_branch, '5.3', '<' ) ) {

				echo '<style type="text/css">
          .spftestimonial-field-slider .spftestimonial--unit,
          .spftestimonial-field-border .spftestimonial--label,
          .spftestimonial-field-spacing .spftestimonial--label,
          .spftestimonial-field-dimensions .spftestimonial--label,
          .spftestimonial-field-spinner .ui-button-text-only{
            border-color: #ddd;
          }
          .spftestimonial-warning-primary{
            box-shadow: 0 1px 0 #bd2130 !important;
          }
          .spftestimonial-warning-primary:focus{
            box-shadow: none !important;
          }
        </style>';

			}

		}

		/**
		 * Add a new framework field.
		 *
		 * @param  mixed $field Field.
		 * @param  mixed $value value.
		 * @param  mixed $unique unique id.
		 * @param  mixed $where Where.
		 * @param  mixed $parent parent.
		 * @return void
		 */
		public static function field( $field = array(), $value = '', $unique = '', $where = '', $parent = '' ) {

			// Check for unallow fields.
			if ( ! empty( $field['_notice'] ) ) {

				$field_type = $field['type'];

				$field            = array();
				$field['content'] = sprintf( wp_kses_post( 'Ooops! This field type (%s) can not be used here, yet.', 'testimonial-free' ), '<strong>' . $field_type . '</strong>' );
				$field['type']    = 'notice';
				$field['style']   = 'danger';

			}

			$depend     = '';
			$hidden     = '';
			$unique     = ( ! empty( $unique ) ) ? $unique : '';
			$class      = ( ! empty( $field['class'] ) ) ? ' ' . $field['class'] : '';
			$is_pseudo  = ( ! empty( $field['pseudo'] ) ) ? ' spftestimonial-pseudo-field' : '';
			$field_type = ( ! empty( $field['type'] ) ) ? $field['type'] : '';

			if ( ! empty( $field['dependency'] ) ) {

				$dependency      = $field['dependency'];
				$hidden          = ' hidden';
				$data_controller = '';
				$data_condition  = '';
				$data_value      = '';
				$data_global     = '';

				if ( is_array( $dependency[0] ) ) {
					$data_controller = implode( '|', array_column( $dependency, 0 ) );
					$data_condition  = implode( '|', array_column( $dependency, 1 ) );
					$data_value      = implode( '|', array_column( $dependency, 2 ) );
					$data_global     = implode( '|', array_column( $dependency, 3 ) );
				} else {
					$data_controller = ( ! empty( $dependency[0] ) ) ? $dependency[0] : '';
					$data_condition  = ( ! empty( $dependency[1] ) ) ? $dependency[1] : '';
					$data_value      = ( ! empty( $dependency[2] ) ) ? $dependency[2] : '';
					$data_global     = ( ! empty( $dependency[3] ) ) ? $dependency[3] : '';
				}

				$depend .= ' data-controller="' . $data_controller . '"';
				$depend .= ' data-condition="' . $data_condition . '"';
				$depend .= ' data-value="' . $data_value . '"';
				$depend .= ( ! empty( $data_global ) ) ? ' data-depend-global="true"' : '';

			}

			if ( ! empty( $field_type ) ) {

				echo '<div class="spftestimonial-field spftestimonial-field-' . esc_attr( $field_type . $is_pseudo . $class . $hidden ) . '"' . wp_kses_post( $depend ) . '>';

				if ( ! empty( $field['title'] ) ) {
					$subtitle = ( ! empty( $field['subtitle'] ) ) ? '<p class="spftestimonial-text-subtitle">' . $field['subtitle'] . '</p>' : '';
					$title_help = ( ! empty( $field['title_help'] ) ) ? '<span class="spftestimonial-help spftestimonial-title-help"><span class="spftestimonial-help-text">' . $field['title_help'] . '</span><span class="fa fa-question-circle"></span></span>' : '';
					echo '<div class="spftestimonial-title">
					<h4>' . wp_kses_post( $field['title'] ) . '</h4>' . wp_kses_post( $title_help ) . wp_kses_post( $subtitle ) . '</div>';
				}

				echo ( ! empty( $field['title'] ) ) ? '<div class="spftestimonial-fieldset">' : '';

				$value = ( ! isset( $value ) && isset( $field['default'] ) ) ? $field['default'] : $value;
				$value = ( isset( $field['value'] ) ) ? $field['value'] : $value;

				self::maybe_include_field( $field_type );

				$classname = 'SPFTESTIMONIAL_Field_' . $field_type;

				if ( class_exists( $classname ) ) {
					$instance = new $classname( $field, $value, $unique, $where, $parent );
					$instance->render();
				} else {
					echo '<p>' . esc_html__( 'This field class is not available!', 'testimonial-free' ) . '</p>';
				}
			} else {
				echo '<p>' . esc_html__( 'This type is not found!', 'testimonial-free' ) . '</p>';
			}

			echo ( ! empty( $field['title'] ) ) ? '</div>' : '';
			echo '<div class="clear"></div>';
			echo '</div>';

		}

	}

	SPFTESTIMONIAL::init();
}

<?php
/**
 * Framework accordion field file.
 *
 * @link https://shapedplugin.com
 * @since 2.0.0
 *
 * @package Testimonial_free
 * @subpackage Testimonial_free/framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

if ( ! class_exists( 'SPFTESTIMONIAL_Field_code_editor' ) ) {
	/**
	 *
	 * Field: code_editor
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPFTESTIMONIAL_Field_code_editor extends SPFTESTIMONIAL_Fields {

		/**
		 * Version
		 *
		 * @var string
		 */
		public $version = '5.41.0';
		/**
		 * Cdn_url
		 *
		 * @var string
		 */
		public $cdn_url = 'https://cdn.jsdelivr.net/npm/codemirror@';

		/**
		 * Field constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {

			parent::__construct( $field, $value, $unique, $where, $parent );
		}

		/**
		 * Render field
		 *
		 * @return void
		 */
		public function render() {

			$default_settings = array(
				'tabSize'     => 2,
				'lineNumbers' => true,
				'theme'       => 'default',
				'mode'        => 'htmlmixed',
				'cdnURL'      => $this->cdn_url . $this->version,
			);

			$settings = ( ! empty( $this->field['settings'] ) ) ? $this->field['settings'] : array();
			$settings = wp_parse_args( $settings, $default_settings );
			$encoded  = htmlspecialchars( wp_json_encode( $settings ) );

			echo wp_kses_post( $this->field_before() );
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<textarea name="' . esc_attr( $this->field_name() ) . '"' . $this->field_attributes() . ' data-editor="' . esc_attr( $encoded ) . '">' . wp_kses_post( $this->value ) . '</textarea>';

			echo wp_kses_post( $this->field_after() );

		}

		/**
		 * Enqueue
		 *
		 * @return void
		 */
		public function enqueue() {

			$screen = get_current_screen();
			if ( 'spt_testimonial' === $screen->post_type || 'spt_shortcodes' === $screen->post_type ) {
				// Do not loads CodeMirror in revslider page.
				if ( in_array( spftestimonial_get_var( 'page' ), array( 'revslider' ), true ) ) {
					return;
				}

				if ( ! wp_script_is( 'spftestimonial-codemirror' ) ) {
					wp_enqueue_script( 'spftestimonial-codemirror', $this->cdn_url . $this->version . '/lib/codemirror.min.js', array( 'spftestimonial' ), $this->version, true );
					wp_enqueue_script( 'spftestimonial-codemirror-loadmode', $this->cdn_url . $this->version . '/addon/mode/loadmode.min.js', array( 'spftestimonial-codemirror' ), $this->version, true );
				}

				if ( ! wp_style_is( 'spftestimonial-codemirror' ) ) {
					wp_enqueue_style( 'spftestimonial-codemirror', $this->cdn_url . $this->version . '/lib/codemirror.min.css', array(), $this->version );
				}
			}

		}

	}
}


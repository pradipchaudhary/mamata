<?php
/**
 * Framework customize file.
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

if ( ! class_exists( 'WP_Customize_Panel_SPFTESTIMONIAL' ) && class_exists( 'WP_Customize_Panel' ) ) {
	/**
	 *
	 * WP Customize custom panel
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WP_Customize_Panel_SPFTESTIMONIAL extends WP_Customize_Panel {

		/**
		 * Post type.
		 *
		 * @var string
		 */
		public $type = 'spftestimonial';
	}
}

if ( ! class_exists( 'WP_Customize_Section_SPFTESTIMONIAL' ) && class_exists( 'WP_Customize_Section' ) ) {
	/**
	 *
	 * WP Customize custom section
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WP_Customize_Section_SPFTESTIMONIAL extends WP_Customize_Section {

		/**
		 * Post type.
		 *
		 * @var string
		 */
		public $type = 'spftestimonial';
	}
}

if ( ! class_exists( 'WP_Customize_Control_SPFTESTIMONIAL' ) && class_exists( 'WP_Customize_Control' ) ) {
	/**
	 *
	 * WP Customize custom control
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class WP_Customize_Control_SPFTESTIMONIAL extends WP_Customize_Control {

		/**
		 * Post type.
		 *
		 * @var string
		 */
		public $type = 'spftestimonial';
		/**
		 * Post field.
		 *
		 * @var string
		 */
		public $field = '';
		/**
		 * Post unique id.
		 *
		 * @var string
		 */
		public $unique = '';

		/**
		 * Render function.
		 *
		 * @return void
		 */
		protected function render() {

			$depend = '';
			$hidden = '';

			if ( ! empty( $this->field['dependency'] ) ) {
				$hidden  = ' spftestimonial-dependency-control hidden';
				$depend .= ' data-controller="' . $this->field['dependency'][0] . '"';
				$depend .= ' data-condition="' . $this->field['dependency'][1] . '"';
				$depend .= ' data-value="' . $this->field['dependency'][2] . '"';
			}

			$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
			$class = 'customize-control customize-control-' . $this->type . $hidden;

			echo '<li id="' . esc_attr( $id ) . '" class="' . esc_attr( $class ) . '"' . wp_kses_post( $depend ) . '>';
			$this->render_content();
			echo '</li>';

		}

		/**
		 * Render content function.
		 *
		 * @return void
		 */
		public function render_content() {

			$complex = array(
				'accordion',
				'background',
				'backup',
				'border',
				'button_set',
				'checkbox',
				'color_group',
				'date',
				'dimensions',
				'fieldset',
				'group',
				'image_select',
				'link_color',
				'media',
				'palette',
				'repeater',
				'sortable',
				'sorter',
				'spacing',
				'switcher',
				'tabbed',
				'typography',
			);

			$field_id   = ( ! empty( $this->field['id'] ) ) ? $this->field['id'] : '';
			$custom     = ( ! empty( $this->field['customizer'] ) ) ? true : false;
			$is_complex = ( in_array( $this->field['type'], $complex, true ) ) ? true : false;
			$class      = ( $is_complex || $custom ) ? ' spftestimonial-customize-complex' : '';
			$atts       = ( $is_complex || $custom ) ? ' data-unique-id="' . $this->unique . '" data-option-id="' . $field_id . '"' : '';

			if ( ! $is_complex && ! $custom ) {
				$this->field['attributes']['data-customize-setting-link'] = $this->settings['default']->id;
			}

			$this->field['name'] = $this->settings['default']->id;

			$this->field['dependency'] = array();

			echo '<div class="spftestimonial-customize-field' . esc_attr( $class ) . '"' . wp_kses_post( $atts ) . '>';

			SPFTESTIMONIAL::field( $this->field, $this->value(), $this->unique, 'customize' );

			echo '</div>';

		}

	}
}


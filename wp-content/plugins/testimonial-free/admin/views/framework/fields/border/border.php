<?php
/**
 * Framework border field file.
 *
 * @link https://shapedplugin.com
 * @since 2.0.0
 *
 * @package Testimonial_free
 * @subpackage Testimonial_free/framework
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! class_exists( 'SPFTESTIMONIAL_Field_border' ) ) {
	/**
	 *
	 * Field: border
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	class SPFTESTIMONIAL_Field_border extends SPFTESTIMONIAL_Fields {

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

			$args = wp_parse_args(
				$this->field,
				array(
					'top_icon'           => '<i class="fa fa-long-arrow-up"></i>',
					'left_icon'          => '<i class="fa fa-long-arrow-left"></i>',
					'bottom_icon'        => '<i class="fa fa-long-arrow-down"></i>',
					'right_icon'         => '<i class="fa fa-long-arrow-right"></i>',
					'all_icon'           => '<i class="fa fa-arrows"></i>',
					'top_placeholder'    => esc_html__( 'top', 'testimonial-free' ),
					'right_placeholder'  => esc_html__( 'right', 'testimonial-free' ),
					'bottom_placeholder' => esc_html__( 'bottom', 'testimonial-free' ),
					'left_placeholder'   => esc_html__( 'left', 'testimonial-free' ),
					'all_placeholder'    => esc_html__( 'all', 'testimonial-free' ),
					'top'                => true,
					'left'               => true,
					'bottom'             => true,
					'right'              => true,
					'all'                => false,
					'color'              => true,
					'hover_color'        => false,
					'style'              => true,
					'unit'               => 'px',
				)
			);

			$default_value = array(
				'top'         => '',
				'right'       => '',
				'bottom'      => '',
				'left'        => '',
				'color'       => '',
				'hover-color' => '',
				'style'       => 'solid',
				'all'         => '',
			);

			$border_props = array(
				'solid'  => esc_html__( 'Solid', 'testimonial-free' ),
				'dashed' => esc_html__( 'Dashed', 'testimonial-free' ),
				'dotted' => esc_html__( 'Dotted', 'testimonial-free' ),
				'double' => esc_html__( 'Double', 'testimonial-free' ),
				'inset'  => esc_html__( 'Inset', 'testimonial-free' ),
				'outset' => esc_html__( 'Outset', 'testimonial-free' ),
				'groove' => esc_html__( 'Groove', 'testimonial-free' ),
				'ridge'  => esc_html__( 'ridge', 'testimonial-free' ),
				'none'   => esc_html__( 'None', 'testimonial-free' ),
			);

			$default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

			$value = wp_parse_args( $this->value, $default_value );

			echo wp_kses_post( $this->field_before() );

			echo '<div class="spftestimonial--inputs">';

			if ( ! empty( $args['all'] ) ) {

				$placeholder = ( ! empty( $args['all_placeholder'] ) ) ? ' placeholder="' . $args['all_placeholder'] . '"' : '';

				echo '<div class="spftestimonial--input">';
				echo ( ! empty( $args['all_icon'] ) ) ? '<span class="spftestimonial--label spftestimonial--icon">' . wp_kses_post( $args['all_icon'] ) . '</span>' : '';
				echo '<input type="number" name="' . esc_attr( $this->field_name( '[all]' ) ) . '" value="' . esc_attr( $value['all'] ) . '"' . wp_kses_post( $placeholder ) . ' class="spftestimonial-input-number spftestimonial--is-unit" />';
				echo ( ! empty( $args['unit'] ) ) ? '<span class="spftestimonial--label spftestimonial--unit">' . esc_html( $args['unit'] ) . '</span>' : '';
				echo '</div>';

			} else {

				$properties = array();

				foreach ( array( 'top', 'right', 'bottom', 'left' ) as $prop ) {
					if ( ! empty( $args[ $prop ] ) ) {
						$properties[] = $prop;
					}
				}

				$properties = ( array( 'right', 'left' ) === $properties ) ? array_reverse( $properties ) : $properties;

				foreach ( $properties as $property ) {

					$placeholder = ( ! empty( $args[ $property . '_placeholder' ] ) ) ? ' placeholder="' . $args[ $property . '_placeholder' ] . '"' : '';

					echo '<div class="spftestimonial--input">';
					echo ( ! empty( $args[ $property . '_icon' ] ) ) ? '<span class="spftestimonial--label spftestimonial--icon">' . wp_kses_post( $args[ $property . '_icon' ] ) . '</span>' : '';
					echo '<input type="number" name="' . esc_attr( $this->field_name( '[' . $property . ']' ) ) . '" value="' . esc_attr( $value[ $property ] ) . '"' . wp_kses_post( $placeholder ) . ' class="spftestimonial-input-number spftestimonial--is-unit" />';
					echo ( ! empty( $args['unit'] ) ) ? '<span class="spftestimonial--label spftestimonial--unit">' . esc_html( $args['unit'] ) . '</span>' : '';
					echo '</div>';

				}
			}

			if ( ! empty( $args['style'] ) ) {
				echo '<div class="spftestimonial--input">';
				echo '<select name="' . esc_attr( $this->field_name( '[style]' ) ) . '">';
				foreach ( $border_props as $border_prop_key => $border_prop_value ) {
					$selected = ( $value['style'] === $border_prop_key ) ? ' selected' : '';
					echo '<option value="' . esc_attr( $border_prop_key ) . '"' . esc_attr( $selected ) . '>' . esc_html( $border_prop_value ) . '</option>';
				}
				echo '</select>';
				echo '</div>';
			}

			echo '</div>';

			if ( ! empty( $args['color'] ) ) {
				$default_color_attr = ( ! empty( $default_value['color'] ) ) ? ' data-default-color="' . $default_value['color'] . '"' : '';
				echo '<div class="spftestimonial--color">';
				echo '<div class="spftestimonial-field-color">';
				echo '<div class="spftestimonial--title">' . esc_html__( 'Color', 'testimonial-free' ) . '</div>';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[color]' ) ) . '" value="' . esc_attr( $value['color'] ) . '" class="spftestimonial-color"' . wp_kses_post( $default_color_attr ) . ' />';
				echo '</div>';
				echo '</div>';
			}

			if ( ! empty( $args['hover_color'] ) ) {
				$default_hover_color_attr = ( ! empty( $default_value['hover-color'] ) ) ? ' data-default-color="' . $default_value['hover-color'] . '"' : '';
				echo '<div class="spftestimonial--color">';
				echo '<div class="spftestimonial-field-color">';
				echo '<div class="spftestimonial--title">' . esc_html__( 'Hover Color', 'testimonial-free' ) . '</div>';
				echo '<input type="text" name="' . esc_attr( $this->field_name( '[hover-color]' ) ) . '" value="' . esc_attr( $value['hover-color'] ) . '" class="spftestimonial-color"' . wp_kses_post( $default_hover_color_attr ) . ' />';
				echo '</div>';
				echo '</div>';
			}

			echo '<div class="clear"></div>';

			echo wp_kses_post( $this->field_after() );

		}

	}
}

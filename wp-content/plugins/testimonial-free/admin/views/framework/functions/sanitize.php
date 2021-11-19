<?php
/**
 * Framework sanitize file.
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

if ( ! function_exists( 'spftestimonial_sanitize_replace_a_to_b' ) ) {
	/**
	 *
	 * Sanitize
	 * Replace letter a to letter b
	 *
	 * @param  string $value string.
	 *
	 * @return string
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spftestimonial_sanitize_replace_a_to_b( $value ) {

		return str_replace( 'a', 'b', $value );
	}
}

if ( ! function_exists( 'spftestimonial_sanitize_title' ) ) {
	/**
	 *
	 * Sanitize title
	 *
	 * @param  string $value string.
	 *
	 * @return string
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spftestimonial_sanitize_title( $value ) {

		return sanitize_title( $value );
	}
}

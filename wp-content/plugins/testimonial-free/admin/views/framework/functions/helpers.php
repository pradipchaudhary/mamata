<?php
/**
 * Framework helpers file.
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

if ( ! function_exists( 'spftestimonial_array_search' ) ) {
	/**
	 * Array search key & value
	 *
	 * @param  mixed $array main array.
	 * @param  mixed $key key.
	 * @param  mixed $value val.
	 * @return array
	 */
	function spftestimonial_array_search( $array, $key, $value ) {

		$results = array();

		if ( is_array( $array ) ) {
			if ( isset( $array[ $key ] ) && $array[ $key ] === $value ) {
				$results[] = $array;
			}

			foreach ( $array as $sub_array ) {
				$results = array_merge( $results, spftestimonial_array_search( $sub_array, $key, $value ) );
			}
		}

		return $results;

	}
}

if ( ! function_exists( 'spftestimonial_get_var' ) ) {
	/**
	 * Getting POST Var
	 *
	 * @param  mixed $var  var.
	 * @param  mixed $default default.
	 * @return mixed
	 */
	function spftestimonial_get_var( $var, $default = '' ) {

		if ( isset( $_POST[ $var ] ) ) { // phpcs:ignore
			return $_POST[ $var ]; // phpcs:ignore
		}

		if ( isset( $_GET[ $var ] ) ) { // phpcs:ignore
			return $_GET[ $var ]; // phpcs:ignore
		}

		return $default;

	}
}

if ( ! function_exists( 'spftestimonial_get_vars' ) ) {
	/**
	 * Getting POST Vars
	 *
	 * @param  mixed $var var.
	 * @param  mixed $depth depth.
	 * @param  mixed $default default.
	 * @return mixed
	 */
	function spftestimonial_get_vars( $var, $depth, $default = '' ) {

		if ( isset( $_POST[ $var ][ $depth ] ) ) { // phpcs:ignore
			return $_POST[ $var ][ $depth ]; // phpcs:ignore
		}

		if ( isset( $_GET[ $var ][ $depth ] ) ) { // phpcs:ignore
			return $_GET[ $var ][ $depth ]; // phpcs:ignore
		}

		return $default;

	}
}

if ( ! function_exists( 'spftestimonial_microtime' ) ) {
	/**
	 * Between Microtime
	 *
	 * @param  string $timenow now.
	 * @param  string $starttime start.
	 * @param  int    $timeout timeout.
	 * @return bool
	 */
	function spftestimonial_timeout( $timenow, $starttime, $timeout = 30 ) {

		return ( ( $timenow - $starttime ) < $timeout ) ? true : false;

	}
}

if ( ! function_exists( 'spftestimonial_wp_editor_api' ) ) {
	/**
	 *
	 * Check for wp editor api
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spftestimonial_wp_editor_api() {

		global $wp_version;

		return version_compare( $wp_version, '4.8', '>=' );

	}
}

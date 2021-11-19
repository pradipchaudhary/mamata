<?php
/**
 * Framework actions file.
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

if ( ! function_exists( 'spftestimonial_reset_ajax' ) ) {
	/**
	 *
	 * Reset Ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spftestimonial_reset_ajax() {

		if ( ! empty( $_POST['unique'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'spftestimonial_backup_nonce' ) ) {
			delete_option( sanitize_text_field( wp_unslash( $_POST['unique'] ) ) );
			wp_send_json_success();
		}

		wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'testimonial-free' ) ) );

	}
	add_action( 'wp_ajax_spftestimonial-reset', 'spftestimonial_reset_ajax' );
}

if ( ! function_exists( 'spftestimonial_chosen_ajax' ) ) {
	/**
	 *
	 * Chosen Ajax
	 *
	 * @since 1.0.0
	 * @version 1.0.0
	 */
	function spftestimonial_chosen_ajax() {

		if ( ! empty( $_POST['term'] ) && ! empty( $_POST['type'] ) && ! empty( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'spftestimonial_chosen_ajax_nonce' ) ) {

			$capability = apply_filters( 'spftestimonial_chosen_ajax_capability', 'manage_options' );

			if ( current_user_can( $capability ) ) {

				$type       = sanitize_text_field( wp_unslash( $_POST['type'] ) );
				$term       = sanitize_text_field( wp_unslash( $_POST['term'] ) );
				$query_args = ( ! empty( $_POST['query_args'] ) ) ? wp_kses_post_deep( $_POST['query_args'] ) : array(); // phpcs:ignore
				$options    = SPFTESTIMONIAL_Fields::field_data( $type, $term, $query_args );

				wp_send_json_success( $options );

			} else {
				wp_send_json_error( array( 'error' => esc_html__( 'You do not have required permissions to access.', 'testimonial-free' ) ) );
			}
		} else {
				wp_send_json_error( array( 'error' => esc_html__( 'Error: Nonce verification has failed. Please try again.', 'testimonial-free' ) ) );
		}

	}
	add_action( 'wp_ajax_spftestimonial-chosen', 'spftestimonial_chosen_ajax' );
}


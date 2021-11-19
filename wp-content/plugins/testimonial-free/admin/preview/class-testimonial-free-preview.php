<?php
/**
 * The admin preview.
 *
 * @link       http://shapedplugin.com
 * @since      2.1.4
 *
 * @package    Testimonial_free
 * @subpackage Testimonial_free/admin
 */

/**
 * The admin preview.
 *
 * @package    Testimonial_free
 * @subpackage Testimonial_free/admin
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class Testimonial_Free_Preview {
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.1.4
	 */
	public function __construct() {
		$this->testimonial_preview_action();
	}

	/**
	 * Public Action
	 *
	 * @return void
	 */
	private function testimonial_preview_action() {
		// admin Preview.
		add_action( 'wp_ajax_sp_tpro_preview_meta_box', array( $this, 'sp_tpro_preview_meta_box' ) );

	}

	/**
	 * Function Backed preview.
	 *
	 * @since 2.2.5
	 */
	public function sp_tpro_preview_meta_box() {
		$nonce = isset( $_POST['ajax_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['ajax_nonce'] ) ) : '';
		if ( ! wp_verify_nonce( $nonce, 'spftestimonial_metabox_nonce' ) ) {
			return;
		}

		$setting = array();
		// XSS ok.
		// No worries, This "POST" requests is sanitizing in the below array map.
		$data = ! empty( $_POST['data'] ) ? wp_unslash( $_POST['data'] )  : ''; // phpcs:ignore
		parse_str( $data, $setting );
		// Preset Layouts.
		$post_id            = $setting['post_ID'];
		$setting_options    = get_option( 'sp_testimonial_pro_options' );
		$shortcode_data     = $setting['sp_tpro_shortcode_options'];
		$main_section_title = $setting['post_title'];

		$tfree_one_star   = TFREE_Shortcode_Render::$tfree_one_star;
		$tfree_two_star   = TFREE_Shortcode_Render::$tfree_two_star;
		$tfree_three_star = TFREE_Shortcode_Render::$tfree_three_star;
		$tfree_four_star  = TFREE_Shortcode_Render::$tfree_four_star;
		$tfree_five_star  = TFREE_Shortcode_Render::$tfree_five_star;

		TFREE_Shortcode_Render::sp_tpro_html_show( $post_id, $setting_options, $shortcode_data, $tfree_one_star, $tfree_two_star, $tfree_three_star, $tfree_four_star, $tfree_five_star, $main_section_title );
		?>
		<script src="<?php echo esc_url( SP_TFREE_URL . 'public/assets/js/slick.min.js' ); ?>" ></script>
		<script src="<?php echo esc_url( SP_TFREE_URL . 'public/assets/js/sp-slick-active.js' ); ?>" ></script>
		<?php
		die();
	}

}
new Testimonial_Free_Preview();

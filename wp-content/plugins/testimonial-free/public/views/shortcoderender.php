<?php

/**
 * This file render the shortcode to the frontend
 *
 * @package testimonial-free
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!class_exists('TFREE_Shortcode_Render')) {
	/**
	 * Testimonial - Shortcode Render class
	 *
	 * @since 2.0
	 */
	class TFREE_Shortcode_Render
	{

		/**
		 * Five star review
		 *
		 * @var string
		 */
		public static $tfree_five_star = '<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					';
		/**
		 * Four star review
		 *
		 * @var string
		 */
		public static $tfree_four_star = '
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					';
		/**
		 * Three star review
		 *
		 * @var string
		 */
		public static $tfree_three_star = '
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					';
		/**
		 * Tow star review
		 *
		 * @var string
		 */
		public static $tfree_two_star = '
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					';
		/**
		 * One star review
		 *
		 * @var string
		 */
		public static $tfree_one_star = '
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					';

		/**
		 * Single instance of the class.
		 *
		 * @var null
		 * @since 2.0
		 */
		protected static $_instance = null;


		/**
		 * TFREE_Shortcode_Render Instance
		 *
		 * @since 2.0
		 * @static
		 * @return self Main instance
		 */
		public static function instance()
		{
			if (is_null(self::$_instance)) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * TFREE_Shortcode_Render constructor.
		 */
		public function __construct()
		{
			add_shortcode('sp_testimonial', array($this, 'shortcode_render'));
		}

		/**
		 * Full html show.
		 *
		 * @param array $post_id Shortcode ID.
		 * @param array $setting_options get all layout options.
		 * @param array $shortcode_data get all meta options.
		 */
		public static function sp_tpro_html_show($post_id, $setting_options, $shortcode_data, $tfree_one_star, $tfree_two_star, $tfree_three_star, $tfree_four_star, $tfree_five_star, $main_section_title)
		{
			$theme_style                  = isset($shortcode_data['theme_style']) ? $shortcode_data['theme_style'] : 'theme-one';
			$number_of_total_testimonials = isset($shortcode_data['number_of_total_testimonials']) ? $shortcode_data['number_of_total_testimonials'] : '10';
			$order_by                     = isset($shortcode_data['testimonial_order_by']) ? $shortcode_data['testimonial_order_by'] : 'date';
			$order                        = isset($shortcode_data['testimonial_order']) ? $shortcode_data['testimonial_order'] : 'DESC';
			$columns                      = isset($shortcode_data['columns']) ? $shortcode_data['columns'] : '';
			$columns_large_desktop        = isset($columns['large_desktop']) ? $columns['large_desktop'] : '1';
			$columns_desktop              = isset($columns['desktop']) ? $columns['desktop'] : '1';
			$columns_laptop               = isset($columns['laptop']) ? $columns['laptop'] : '1';
			$columns_tablet               = isset($columns['tablet']) ? $columns['tablet'] : '1';
			$columns_mobile               = isset($columns['mobile']) ? $columns['mobile'] : '1';

			// Slider Settings.
			$slider_auto_play = isset($shortcode_data['slider_auto_play']) ? $shortcode_data['slider_auto_play'] : 'true';
			switch ($slider_auto_play) {
				case 'true':
					$auto_play        = 'true';
					$auto_play_mobile = 'true';
					break;
				case 'off_on_mobile':
					$auto_play        = 'true';
					$auto_play_mobile = 'false';
					break;
				case 'false':
					$auto_play        = 'false';
					$auto_play_mobile = 'false';
					break;
			}
			$slider_auto_play_speed        = isset($shortcode_data['slider_auto_play_speed']) ? $shortcode_data['slider_auto_play_speed'] : '3000';
			$slider_scroll_speed           = isset($shortcode_data['slider_scroll_speed']) ? $shortcode_data['slider_scroll_speed'] : '600';
			$slider_pause_on_hover         = isset($shortcode_data['slider_pause_on_hover']) && $shortcode_data['slider_pause_on_hover'] ? 'true' : 'false';
			$slider_infinite               = isset($shortcode_data['slider_infinite']) && $shortcode_data['slider_infinite'] ? 'true' : 'false';
			$slider_navigation             = isset($shortcode_data['navigation']) ? $shortcode_data['navigation'] : 'true';
			$navigation_colors             = isset($shortcode_data['navigation_color']) ? $shortcode_data['navigation_color'] : '';
			$navigation_color              = isset($navigation_colors['color']) ? $navigation_colors['color'] : '';
			$navigation_hover_color        = isset($navigation_colors['hover-color']) ? $navigation_colors['hover-color'] : '';
			$navigation_background         = isset($navigation_colors['background']) ? $navigation_colors['background'] : '';
			$navigation_hover_background   = isset($navigation_colors['hover-background']) ? $navigation_colors['hover-background'] : '';
			$navigation_border             = isset($shortcode_data['navigation_border']) ? $shortcode_data['navigation_border'] : '';
			$navigation_border_size        = isset($navigation_border['all']) ? $navigation_border['all'] : '';
			$navigation_border_style       = isset($navigation_border['style']) ? $navigation_border['style'] : '';
			$navigation_border_color       = isset($navigation_border['color']) ? $navigation_border['color'] : '';
			$navigation_border_hover_color = isset($navigation_border['hover-color']) ? $navigation_border['hover-color'] : '';

			switch ($slider_navigation) {
				case 'true':
					$navigation        = 'true';
					$navigation_mobile = 'true';
					break;
				case 'hide_on_mobile':
					$navigation        = 'true';
					$navigation_mobile = 'false';
					break;
				case 'false':
					$navigation        = 'false';
					$navigation_mobile = 'false';
					break;
			}
			$slider_pagination       = isset($shortcode_data['pagination']) ? $shortcode_data['pagination'] : 'true';
			$pagination_colors       = isset($shortcode_data['pagination_colors']) ? $shortcode_data['pagination_colors'] : '#cccccc';
			$pagination_color        = isset($pagination_colors['color']) ? $pagination_colors['color'] : '#cccccc';
			$pagination_active_color = isset($pagination_colors['active-color']) ? $pagination_colors['active-color'] : '#1595ce';
			switch ($slider_pagination) {
				case 'true':
					$pagination        = 'true';
					$pagination_mobile = 'true';
					break;
				case 'hide_on_mobile':
					$pagination        = 'true';
					$pagination_mobile = 'false';
					break;
				case 'false':
					$pagination        = 'false';
					$pagination_mobile = 'false';
					break;
			}
			$adaptive_height  = isset($shortcode_data['adaptive_height']) && $shortcode_data['adaptive_height'] ? 'true' : 'false';
			$slider_swipe     = isset($shortcode_data['slider_swipe']) && $shortcode_data['slider_swipe'] ? 'true' : 'false';
			$swipe_to_slide   = isset($shortcode_data['swipe_to_slide']) && $shortcode_data['swipe_to_slide'] ? 'true' : 'false';
			$slider_draggable = isset($shortcode_data['slider_draggable']) && $shortcode_data['slider_draggable'] ? 'true' : 'false';
			$slider_direction = isset($shortcode_data['slider_direction']) ? $shortcode_data['slider_direction'] : 'ltr';
			$rtl_mode         = ('rtl' === $slider_direction) ? 'true' : 'false';

			// Display Settings.
			$section_title         = isset($shortcode_data['section_title']) ? $shortcode_data['section_title'] : '';
			$testimonial_title     = isset($shortcode_data['testimonial_title']) ? $shortcode_data['testimonial_title'] : '';
			$testimonial_title_tag = isset($shortcode_data['testimonial_title_tag']) ? $shortcode_data['testimonial_title_tag'] : 'h3';
			$testimonial_text      = isset($shortcode_data['testimonial_text']) ? $shortcode_data['testimonial_text'] : '';
			$reviewer_name         = isset($shortcode_data['testimonial_client_name']) ? $shortcode_data['testimonial_client_name'] : '';
			$reviewer_name_tag     = (isset($shortcode_data['testimonial_name_tag']) && $shortcode_data['testimonial_name_tag']) ? $shortcode_data['testimonial_name_tag'] : 'h4';
			$star_rating           = isset($shortcode_data['testimonial_client_rating']) ? $shortcode_data['testimonial_client_rating'] : '';
			$star_rating_color     = isset($shortcode_data['testimonial_client_rating_color']) ? $shortcode_data['testimonial_client_rating_color'] : '#f3bb00';
			$reviewer_position     = isset($shortcode_data['client_designation']) ? $shortcode_data['client_designation'] : '';

			// Image Settings.
			$client_image = isset($shortcode_data['client_image']) ? $shortcode_data['client_image'] : true;
			$image_sizes  = isset($shortcode_data['image_sizes']) ? $shortcode_data['image_sizes'] : 'tf-client-image-size';

			// Typography.
			$section_title_color      = isset($shortcode_data['section_title_typography']) ? $shortcode_data['section_title_typography']['color'] : '#444444';
			$testimonial_title_color  = isset($shortcode_data['testimonial_title_typography']) ? $shortcode_data['testimonial_title_typography']['color'] : '#333333';
			$testimonial_text_color   = isset($shortcode_data['testimonial_text_typography']) ? $shortcode_data['testimonial_text_typography']['color'] : '#333333';
			$client_name_color        = isset($shortcode_data['client_name_typography']) ? $shortcode_data['client_name_typography']['color'] : '#333333';
			$client_designation_color = isset($shortcode_data['client_designation_company_typography']) ? $shortcode_data['client_designation_company_typography']['color'] : '#444444';
			// Preloader.
			$preloader = isset($shortcode_data['preloader']) ? $shortcode_data['preloader'] : false;
			// Schema markup.
			if (isset($shortcode_data['schema_markup'])) {
				$show_schema_markup = $shortcode_data['schema_markup'];
			} else {
				$show_schema_markup = isset($setting_options['spt_enable_schema']) ? $setting_options['spt_enable_schema'] : false;
			}

			// Enqueue Script.
			$dequeue_slick_js = isset($setting_options['tf_dequeue_slick_js']) ? $setting_options['tf_dequeue_slick_js'] : true;
			if ($dequeue_slick_js) {
				wp_enqueue_script('tfree-slick-min-js');
			}
			wp_enqueue_script('tfree-slick-active');

			$outline = '';

			// Style.
			$outline .= '<style>';
			$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-dots li button{
				background: ' . $pagination_color . ';
			}
			#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-dots li.slick-active button{
                background: ' . $pagination_active_color . ';
            }
            #sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-prev,
			#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-next{
				background: ' . $navigation_background . ';
				border: ' . $navigation_border_size . 'px ' . $navigation_border_style . ' ' . $navigation_border_color . ';
				color: ' . $navigation_color . ';
			}
            #sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-prev:hover,
			#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-next:hover{
				background: ' . $navigation_hover_background . ';
				border-color: ' . $navigation_border_hover_color . ';
				color: ' . $navigation_hover_color . ';
			}
			';
			if ('true' === $navigation) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section{
					padding: 0 50px;
				}';
			}
			if ($star_rating) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-client-rating{
					color: ' . $star_rating_color . ';
				}';
			}
			if ($reviewer_position) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-client-designation{
					color: ' . $client_designation_color . ';
				}';
			}
			if ($reviewer_name) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-client-name{
					color: ' . $client_name_color . ';
				}';
			}
			if ($testimonial_text) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-client-testimonial{
					color: ' . $testimonial_text_color . ';
				}';
			}
			if ($testimonial_title) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-testimonial-title h3{
					color: ' . $testimonial_title_color . ';
				}';
			}
			if ($section_title) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section-title{
					color: ' . $section_title_color . ';
				}';
			}

			$outline .= '</style>';

			$args = array(
				'post_type'      => 'spt_testimonial',
				'orderby'        => $order_by,
				'order'          => $order,
				'posts_per_page' => empty($number_of_total_testimonials) ? '10000' : $number_of_total_testimonials,
			);

			$post_query = new WP_Query($args);

			$outline .= '<div id="sp-testimonial-free-wrapper-' . $post_id . '" class="sp-testimonial-free-wrapper">';

			if ($section_title) {
				$outline .= '<h2 class="sp-testimonial-free-section-title">' . $main_section_title . '</h2>';
			}
			if ($preloader) {
				$preloader_style = ($preloader) ? '' : 'display: none;';
				$outline        .= '<div class="tfree-preloader" id="tfree-preloader-' . $post_id . '" style="' . $preloader_style . '"><img src="' . SP_TFREE_URL . 'public/assets/img/preloader.gif"/></div>';
			}
			$outline                 .= '<div id="sp-testimonial-free-' . $post_id . '" class="sp-testimonial-free-section tfree-style-' . $theme_style . '" dir="' . $slider_direction . '" data-preloader="' . $preloader . '" data-slick=\'{"dots": ' . $pagination . ', "adaptiveHeight": ' . $adaptive_height . ', "pauseOnHover": ' . $slider_pause_on_hover . ', "slidesToShow": ' . $columns_large_desktop . ', "speed": ' . $slider_scroll_speed . ', "arrows": ' . $navigation . ', "autoplay": ' . $auto_play . ', "autoplaySpeed": ' . $slider_auto_play_speed . ', "swipe": ' . $slider_swipe . ', "swipeToSlide": ' . $swipe_to_slide . ', "draggable": ' . $slider_draggable . ', "rtl": ' . $rtl_mode . ', "infinite": ' . $slider_infinite . ', "responsive": [
				{
					"breakpoint": 1280, "settings": { "slidesToShow": ' . $columns_desktop . ' }
				},
				{
					"breakpoint": 980, "settings": { "slidesToShow": ' . $columns_laptop . ' }
				},
				{
					"breakpoint": 736, "settings": { "slidesToShow": ' . $columns_tablet . ' }
				},
				{
					"breakpoint": 480, "settings": {
						"slidesToShow": ' . $columns_mobile . ',
						"dots": ' . $pagination_mobile . ',
						"arrows": ' . $navigation_mobile . ',
						"autoplay": ' . $auto_play_mobile . '
					}
				}
				] }\'>';
			$total_rating_count       = 0;
			$total_rated_testimonials = 0;
			if ($post_query->have_posts()) {
				while ($post_query->have_posts()) :
					$post_query->the_post();

					$testimonial_data  = get_post_meta(get_the_ID(), 'sp_tpro_meta_options', true);
					$tfree_designation = (isset($testimonial_data['tpro_designation']) ? $testimonial_data['tpro_designation'] : '');
					$tfree_name        = (isset($testimonial_data['tpro_name']) ? $testimonial_data['tpro_name'] : '');
					$tfree_rating_star = (isset($testimonial_data['tpro_rating']) ? $testimonial_data['tpro_rating'] : '');

					if ('theme-one' === $theme_style) {
						include SP_TFREE_PATH . '/public/views/templates/theme-one.php';
					}
					if (!empty($rating_value)) {
						$total_rated_testimonials++;
						$total_rating_count += ($star_rating && !empty($tfree_rating_star)) ? $rating_value : 0;
					}
				endwhile;
			} else {
				$outline .= '<h2 class="sp-not-testimonial-found">' . esc_html__('No testimonials found', 'testimonial-free') . '</h2>';
			}
			if (0 !== $total_rated_testimonials) {
				$aggregate_rating = round(($total_rating_count / $total_rated_testimonials), 2);
			}
			$outline .= '</div>';
			if ($show_schema_markup && 0 !== $total_rated_testimonials) {
				include SP_TFREE_PATH . '/public/views/schema.php';
			}
			$outline .= '</div>';

			wp_reset_postdata();

			echo $outline;
		}

		/**
		 * Shorcode render.
		 *
		 * @param array $attributes Schortcode attributes.
		 *
		 * @return string
		 * @since 2.0
		 */
		public function shortcode_render($attributes)
		{

			shortcode_atts(
				array(
					'id' => '',
				),
				$attributes,
				'sp_testimonial'
			);

			$post_id            = $attributes['id'];
			$setting_options    = get_option('sp_testimonial_pro_options');
			$shortcode_data     = get_post_meta($post_id, 'sp_tpro_shortcode_options', true);
			$main_section_title = get_the_title($post_id);

			$tfree_one_star   = self::$tfree_one_star;
			$tfree_two_star   = self::$tfree_two_star;
			$tfree_three_star = self::$tfree_three_star;
			$tfree_four_star  = self::$tfree_four_star;
			$tfree_five_star  = self::$tfree_five_star;

			ob_start();
			self::sp_tpro_html_show($post_id, $setting_options, $shortcode_data, $tfree_one_star, $tfree_two_star, $tfree_three_star, $tfree_four_star, $tfree_five_star, $main_section_title);
			return ob_get_clean();
		}
	}

	new TFREE_Shortcode_Render();
}

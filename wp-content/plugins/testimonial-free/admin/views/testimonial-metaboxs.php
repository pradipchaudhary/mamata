<?php
/**
 * The testimonial Metabox  configuration.
 *
 * @link https://shapedplugin.com
 * @since 2.0.0
 *
 * @package Testimonial_free
 * @subpackage Testimonial_free/admin/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access directly.

if ( ! function_exists( 'spftestimonial_sanitize_text' ) ) {
	/**
	 * Sanitize function for text field.
	 *
	 * @param string $value sanitize value.
	 * @return string
	 */
	function spftestimonial_sanitize_text( $value ) {

		$safe_text = filter_var( $value, FILTER_SANITIZE_STRING );
		return $safe_text;

	}
}

//
// Metabox of the testimonial shortcode generator.
// Set a unique slug-like ID.
//
$prefix_shortcode_opts = 'sp_tpro_shortcode_options';

/**
 * Preview metabox.
 *
 * @param string $prefix The metabox main Key.
 * @return void
 */
SPFTESTIMONIAL::createMetabox(
	'sp_tpro_live_preview',
	array(
		'title'             => __( 'Live Preview', 'testimonial-free' ),
		'post_type'         => 'spt_shortcodes',
		'show_restore'      => false,
		'sp_tpro_shortcode' => false,
		'context'           => 'normal',
	)
);
SPFTESTIMONIAL::createSection(
	'sp_tpro_live_preview',
	array(
		'fields' => array(
			array(
				'type' => 'preview',
			),
		),
	)
);

//
// Testimonial metabox.
//
SPFTESTIMONIAL::createMetabox(
	$prefix_shortcode_opts,
	array(
		'title'     => __( 'Shortcode Options', 'testimonial-free' ),
		'class'     => 'spt-main-class',
		'post_type' => 'spt_shortcodes',
		'context'   => 'normal',
	)
);

//
// General Settings section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts,
	array(
		'title'  => __( 'General Settings', 'testimonial-free' ),
		'icon'   => 'fa fa-cog',
		'fields' => array(

			array(
				'id'       => 'layout',
				'type'     => 'image_select',
				'title'    => __( 'Layout Preset', 'testimonial-free' ),
				'subtitle' => __( 'Select a layout to display the testimonials.', 'testimonial-free' ),
				'desc'     => __( 'To unlock more amazing Testimonial Layouts (Grid, Masonry, List, & Isotope), <a target="_blank" href="https://shapedplugin.com/plugin/testimonial-pro/?ref=1"><b>Upgrade To Pro!</b></a>.', 'testimonial-free' ),
				'class'    => 'tfree-layout-preset',
				'options'  => array(
					'slider'  => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/slider.svg',
						'name'  => __( 'Slider', 'testimonial-free' ),
						'class' => 'free-feature',
					),
					'grid'    => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/grid.svg',
						'name'  => __( 'Grid', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'masonry' => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/masonry.svg',
						'name'  => __( 'Masonry', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'list'    => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/list.svg',
						'name'  => __( 'List', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'filter'  => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/layout/filter.svg',
						'name'  => __( 'Isotope', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
				),
				'default'  => 'slider',
			),
			array(
				'id'       => 'display_testimonials_from',
				'type'     => 'select_f',
				'title'    => __( 'Filter Testimonials', 'testimonial-free' ),
				'subtitle' => __( 'Select an option to display the testimonials.', 'testimonial-free' ),
				'options'  => array(
					'latest'                => array(
						'name'     => __( 'Latest', 'testimonial-free' ),
						'pro_only' => false,
					),
					'category'              => array(
						'name'     => __( 'Groups (Pro)', 'testimonial-free' ),
						'pro_only' => true,
					),
					'specific_testimonials' => array(
						'name'     => __( 'Specific (Pro)', 'testimonial-free' ),
						'pro_only' => true,
					),
					'exclude'               => array(
						'name'     => __( 'Exclude (Pro)', 'testimonial-free' ),
						'pro_only' => true,
					),
				),
				'default'  => 'latest',
			),
			array(
				'id'       => 'number_of_total_testimonials',
				'type'     => 'spinner',
				'title'    => __( 'Limit', 'testimonial-free' ),
				'subtitle' => __( 'Limit number of testimonials to show. Leave it empty to show all testimonials.', 'testimonial-free' ),
				'default'  => '12',
				'min'      => -1,
			),
			array(
				'id'       => 'columns',
				'type'     => 'column',
				'title'    => __( 'Responsive Column(s)', 'testimonial-free' ),
				'subtitle' => __( 'Set number of column(s) in different devices for responsive view.', 'testimonial-free' ),
				'default'  => array(
					'large_desktop' => '1',
					'desktop'       => '1',
					'laptop'        => '1',
					'tablet'        => '1',
					'mobile'        => '1',
				),
			),
			array(
				'id'         => 'random_order',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'type'       => 'checkbox',
				'title'      => __( 'Random Order', 'testimonial-free' ),
				'subtitle'   => __( 'Check to show testimonials random order. (Pro)', 'testimonial-free' ),
				'default'    => false,
			),
			array(
				'id'       => 'testimonial_order_by',
				'type'     => 'select',
				'title'    => __( 'Order By', 'testimonial-free' ),
				'subtitle' => __( 'Select an order by option.', 'testimonial-free' ),
				'options'  => array(
					'ID'       => __( 'Testimonial ID', 'testimonial-free' ),
					'date'     => __( 'Date', 'testimonial-free' ),
					'title'    => __( 'Title', 'testimonial-free' ),
					'modified' => __( 'Modified', 'testimonial-free' ),
				),
				'default'  => 'date',
			),
			array(
				'id'       => 'testimonial_order',
				'type'     => 'select',
				'title'    => __( 'Order Type', 'testimonial-free' ),
				'subtitle' => __( 'Select an order option.', 'testimonial-free' ),
				'options'  => array(
					'ASC'  => __( 'Ascending', 'testimonial-free' ),
					'DESC' => __( 'Descending', 'testimonial-free' ),
				),
				'default'  => 'DESC',
			),
			array(
				'id'         => 'schema_markup',
				'type'       => 'switcher',
				'title'      => __( 'Schema Markup', 'testimonial-free' ),
				'subtitle'   => __( 'Enable/Disable schema markup.', 'testimonial-free' ),
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => 94,
				'default'    => false,
			),
			array(
				'id'         => 'preloader',
				'type'       => 'switcher',
				'title'      => __( 'Preloader', 'testimonial-free' ),
				'subtitle'   => __( 'Enable/Disable preloader.', 'testimonial-free' ),
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => 94,
				'default'    => false,
			),
		),
	)
);
// Theme settings.
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts,
	array(
		'title'  => __( 'Theme Settings', 'testimonial-free' ),
		'icon'   => 'fa fa-magic',
		'fields' => array(
			array(
				'id'       => 'theme_style',
				'class'    => 'theme_style',
				'type'     => 'image_select',
				'title'    => __( 'Select Your Theme', 'testimonial-free' ),
				'subtitle' => __( 'Select a theme which you want to display. <b>Please note:</b> To get perfect view for some themes, you need to customize few settings below.', 'testimonial-free' ),
				'desc'     => __( 'Get Access to 9 Professionally Designed Testimonial Themes with Customization options, <a target="_blank" href="https://shapedplugin.com/plugin/testimonial-pro/?ref=1"><b>Upgrade to Pro!</b></a>', 'testimonial-free' ),
				'options'  => array(
					'theme-one'   => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/1.svg',
						'name'  => __( 'Theme One', 'testimonial-free' ),
					),
					'theme-two'   => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/2.svg',
						'name'  => __( 'Theme Two', 'testimonial-free' ),
						'class' => 'pro-feature',
					),

					'theme-three' => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/3.svg',
						'name'  => __( 'Theme Three', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'theme-four'  => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/4.svg',
						'name'  => __( 'Theme Four', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'theme-five'  => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/5.svg',
						'name'  => __( 'Theme Five', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'theme-six'   => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/6.svg',
						'name'  => __( 'Theme Six', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'theme-seven' => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/7.svg',
						'name'  => __( 'Theme Seven', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'theme-eight' => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/8.svg',
						'name'  => __( 'Theme Eight', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'theme-nine'  => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/9.svg',
						'name'  => __( 'Theme Nine', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'theme-ten'   => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/10.svg',
						'name'  => __( 'Theme Ten', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
				),
				'default'  => 'theme-one',
			),

			array(
				'type'    => 'subheading',
				'content' => __( 'Customize Theme', 'testimonial-free' ),
			),
			array(
				'id'       => 'testimonial_margin',
				'class'    => 'pro_only_field',
				'type'     => 'spinner',
				'title'    => __( 'Margin Between Testimonials', 'testimonial-free' ),
				'subtitle' => __( 'Set margin between the testimonials.', 'testimonial-free' ),
				'unit'     => __( 'px', 'testimonial-free' ),
				'default'  => 0,
			),
			array(
				'id'         => 'testimonial_border',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'type'       => 'border',
				'title'      => __( 'Testimonial Border', 'testimonial-free' ),
				'subtitle'   => __( 'Set testimonial border.', 'testimonial-free' ),
				'all'        => true,
				'default'    => array(
					'all'   => '1',
					'style' => 'solid',
					'color' => '#e3e3e3',
				),
			),




			array(
				'id'         => 'testimonial_bg_three',
				'type'       => 'color',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Testimonial Background', 'testimonial-free' ),
				'subtitle'   => __( 'Set testimonial background color.', 'testimonial-free' ),
				'default'    => '#e57373',

			),

			array(
				'id'         => 'testimonial_inner_padding',
				'type'       => 'spacing',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Inner Padding', 'testimonial-free' ),
				'subtitle'   => __( 'Set testimonial inner padding.', 'testimonial-free' ),
				'default'    => array(
					'top'    => '22',
					'right'  => '22',
					'bottom' => '22',
					'left'   => '22',
					'unit'   => 'px',
				),
				'units'      => array( 'px' ),
			),
			array(
				'id'         => 'testimonial_info_position',
				'type'       => 'button_set',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Testimonial Info Position', 'testimonial-free' ),
				'subtitle'   => __( 'Select testimonial info position.', 'testimonial-free' ),
				'options'    => array(
					'top'    => __( 'Top', 'testimonial-free' ),
					'bottom' => __( 'Bottom', 'testimonial-free' ),
					'left'   => __( 'Left', 'testimonial-free' ),
					'right'  => __( 'Right', 'testimonial-free' ),
				),
				'default'    => 'bottom',
			),
			array(
				'id'         => 'testimonial_info_border',
				'type'       => 'border',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Testimonial Info Border', 'testimonial-free' ),
				'subtitle'   => __( 'Set testimonial info border.', 'testimonial-free' ),
				'all'        => true,
				'default'    => array(
					'all'   => '0',
					'style' => 'solid',
					'color' => '#e3e3e3',
				),
			),
			array(
				'id'         => 'testimonial_info_bg',
				'type'       => 'color',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Background for Testimonial Info', 'testimonial-free' ),
				'subtitle'   => __( 'Set background color for testimonial information.', 'testimonial-free' ),
				'default'    => '#f1e9e0',
			),
			array(
				'id'         => 'testimonial_info_inner_padding',
				'type'       => 'spacing',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Inner Padding for Testimonial Info', 'testimonial-free' ),
				'subtitle'   => __( 'Set inner padding for testimonial information.', 'testimonial-free' ),
				'default'    => array(
					'top'    => '22',
					'right'  => '22',
					'bottom' => '22',
					'left'   => '22',
					'unit'   => 'px',
				),
				'units'      => array( 'px' ),
			),
			array(
				'type'    => 'notice',
				'content' => __( 'To unlock the Theme based Customization options, <a target="_blank" href="https://shapedplugin.com/plugin/testimonial-pro/?ref=1"><b>Upgrade to Pro!</b></a>.', 'testimonial-free' ),
			),
		),
	)
);

//
// Display Settings section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts,
	array(
		'title'  => __( 'Display Settings', 'testimonial-free' ),
		'icon'   => 'fa fa-th-large',
		'fields' => array(
			array(
				'id'         => 'section_title',
				'type'       => 'switcher',
				'title'      => __( 'Section Title', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide the testimonial section title.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => false,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Testimonial Content', 'testimonial-free' ),
			),
			array(
				'id'         => 'testimonial_title',
				'type'       => 'switcher',
				'title'      => __( 'Testimonial Title', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide testimonial tagline or title.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => true,
			),
			array(
				'id'         => 'testimonial_title_tag',
				'type'       => 'select',
				'title'      => __( 'HTML Tag', 'testimonial-free' ),
				'subtitle'   => __( 'Select testimonial title HTML tag.', 'testimonial-free' ),
				'options'    => array(
					'h1'   => 'h1',
					'h2'   => 'h2',
					'h3'   => 'h3',
					'h4'   => 'h4',
					'h5'   => 'h5',
					'h6'   => 'h6',
					'p'    => 'p',
					'span' => 'span',
					'div'  => 'div',
				),
				'default'    => 'h3',
				'dependency' => array(
					'testimonial_title',
					'==',
					'true',
				),
			),
			array(
				'id'         => 'testimonial_text',
				'type'       => 'switcher',
				'title'      => __( 'Testimonial Content', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide testimonial content.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => true,
			),
			array(
				'id'         => 'testimonial_content_type',
				'type'       => 'radio',
				'title'      => __( 'Content Display Type', 'testimonial-free' ),
				'subtitle'   => __( 'Choose content display type.', 'testimonial-free' ),
				'options'    => array(
					'full_content'       => __( 'Full Content', 'testimonial-free' ),
					'content_with_limit' => __( 'Content with Limit (Pro)', 'testimonial-free' ),
				),
				'default'    => 'full_content',
				'dependency' => array(
					'testimonial_text',
					'==',
					'true',
				),
			),
			array(
				'id'         => 'testimonial_read_more',
				'type'       => 'switcher',
				'class'      => 'pro_switcher',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Read More', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide testimonial read more button.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => false,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Reviewer Information', 'testimonial-free' ),
			),
			array(
				'id'         => 'testimonial_client_name',
				'type'       => 'switcher',
				'title'      => __( 'Full Name', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide reviewer full name.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => true,
			),
			array(
				'id'         => 'testimonial_name_tag',
				'type'       => 'select',
				'title'      => __( 'HTML Tag', 'testimonial-free' ),
				'subtitle'   => __( 'Select reviewer name HTML tag.', 'testimonial-free' ),
				'options'    => array(
					'h1'   => 'h1',
					'h2'   => 'h2',
					'h3'   => 'h3',
					'h4'   => 'h4',
					'h5'   => 'h5',
					'h6'   => 'h6',
					'p'    => 'p',
					'span' => 'span',
					'div'  => 'div',
				),
				'default'    => 'h4',
				'dependency' => array(
					'testimonial_client_name',
					'==',
					'true',
				),
			),
			array(
				'id'         => 'testimonial_client_rating',
				'type'       => 'switcher',
				'title'      => __( 'Rating', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide rating.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => true,
			),
			array(
				'id'         => 'tpro_star_icon',
				'type'       => 'icon_select',
				'title'      => __( 'Rating Icon', 'woo-quick-view-pro' ),
				'subtitle'   => __( 'Choose a rating icon.', 'woo-quick-view-pro' ),
				'options'    => array(
					'fa fa-star'      => 'fa fa-star',
					'fa fa-heart'     => array(
						'icon'     => 'fa fa-heart',
						'pro_only' => true,
					),
					'fa fa-thumbs-up' => array(
						'icon'     => 'fa fa-thumbs-up',
						'pro_only' => true,
					),
					'fa fa-hourglass' => array(
						'icon'     => 'fa fa-hourglass',
						'pro_only' => true,
					),
					'fa fa-circle'    => array(
						'icon'     => 'fa fa-circle',
						'pro_only' => true,
					),
					'fa fa-square'    => array(
						'icon'     => 'fa fa-square',
						'pro_only' => true,
					),
					'fa fa-flag'      => array(
						'icon'     => 'fa fa-flag',
						'pro_only' => true,
					),
					'fa fa-smile-o'   => array(
						'icon'     => 'fa fa-smile-o',
						'pro_only' => true,
					),
				),
				'default'    => 'fa fa-star',
				'dependency' => array( 'testimonial_client_rating', '==', 'true' ),
			),
			array(
				'id'         => 'testimonial_client_rating_color',
				'type'       => 'color',
				'title'      => __( 'Rating Color', 'testimonial-free' ),
				'subtitle'   => __( 'Set color for rating.', 'testimonial-free' ),
				'default'    => '#ffb900',
				'dependency' => array( 'testimonial_client_rating', '==', 'true' ),
			),
			array(
				'id'         => 'client_designation',
				'type'       => 'switcher',
				'title'      => __( 'Identity or Position', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide identity or position.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => true,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Social Media', 'testimonial-free' ),
			),

			array(
				'id'         => 'social_profile',
				'type'       => 'switcher',
				'class'      => 'pro_switcher',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Social Profiles', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide social profiles.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => false,
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Pagination', 'testimonial-free' ),
			),
			array(
				'type'    => 'notice',
				'style'   => 'info',
				'content' => __( 'To unlock the following pagination settings for Grid, Masonry, & List layouts,<a target="_blank" href="https://shapedplugin.com/plugin/testimonial-pro/?ref=1"><b> Upgrade To Pro!</b></a>', 'testimonial-free' ),
			),
			array(
				'id'         => 'grid_pagination',
				'type'       => 'switcher',
				'class'      => 'pro_switcher',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Pagination', 'testimonial-free' ),
				'subtitle'   => __( 'Enqueue/Dequeue pagination.', 'testimonial-free' ),
				'text_on'    => __( 'Enable', 'testimonial-free' ),
				'text_off'   => __( 'Disable', 'testimonial-free' ),
				'text_width' => 95,
				'default'    => true,
			),
			array(
				'id'         => 'tp_pagination_type',
				'type'       => 'radio',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Pagination Type', 'testimonial-free' ),
				'subtitle'   => __( 'Choose a pagination type.', 'testimonial-free' ),
				'options'    => array(
					'ajax_load_more'  => __( 'Load More Button (Ajax)', 'testimonial-free' ),
					'ajax_pagination' => __( 'Ajax Number Pagination', 'testimonial-free' ),
					'infinite_scroll' => __( 'Infinite Scroll (Ajax)', 'testimonial-free' ),
					'no_ajax'         => __( 'No Ajax (Normal Pagination)', 'testimonial-free' ),
				),
				'default'    => 'ajax_load_more',
			),
			array(
				'id'         => 'tp_per_page',
				'type'       => 'spinner',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Testimonial(s) to Show Per Page', 'testimonial-free' ),
				'subtitle'   => __( 'Set number of testimonial(s) to show per page.', 'testimonial-free' ),
				'default'    => 12,
			),
			array(
				'id'         => 'load_more_label',
				'type'       => 'text',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Load more button label', 'testimonial-free' ),
				'default'    => 'Load More',
			),
			array(
				'id'         => 'grid_pagination_alignment',
				'type'       => 'button_set',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Alignment', 'testimonial-free' ),
				'subtitle'   => __( 'Select pagination alignment.', 'testimonial-free' ),
				'options'    => array(
					'left'   => __( 'Left', 'testimonial-free' ),
					'center' => __( 'Center', 'testimonial-free' ),
					'right'  => __( 'Right', 'testimonial-free' ),
				),
				'default'    => 'left',
			),
			array(
				'id'         => 'grid_pagination_margin',
				'type'       => 'spacing',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Margin', 'testimonial-free' ),
				'subtitle'   => __( 'Set pagination margin.', 'testimonial-free' ),
				'default'    => array(
					'top'    => '20',
					'right'  => '0',
					'bottom' => '20',
					'left'   => '0',
					'unit'   => 'px',
				),
				'units'      => array( 'px' ),
			),
			array(
				'id'         => 'grid_pagination_colors',
				'type'       => 'color_group',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Pagination Color', 'testimonial-free' ),
				'subtitle'   => __( 'Set color for pagination.', 'testimonial-free' ),
				'options'    => array(
					'color'            => __( 'Color', 'testimonial-free' ),
					'hover-color'      => __( 'Hover Color', 'testimonial-free' ),
					'background'       => __( 'Background', 'testimonial-free' ),
					'hover-background' => __( 'Hover Background', 'testimonial-free' ),
				),
				'default'    => array(
					'color'            => '#5e5e5e',
					'hover-color'      => '#ffffff',
					'background'       => '#ffffff',
					'hover-background' => '#1595CE',
				),
			),
			array(
				'id'          => 'grid_pagination_border',
				'type'        => 'border',
				'class'       => 'pro_only_field',
				'attributes'  => array( 'disabled' => 'disabled' ),
				'title'       => __( 'Pagination Border', 'testimonial-free' ),
				'subtitle'    => __( 'Set pagination border.', 'testimonial-free' ),
				'all'         => true,
				'hover_color' => true,
				'default'     => array(
					'all'         => '2',
					'style'       => 'solid',
					'color'       => '#bbbbbb',
					'hover-color' => '#1595CE',
				),
			),
		),
	)
);

//
// Image Settings section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts,
	array(
		'title'  => __( 'Image Settings', 'testimonial-free' ),
		'icon'   => 'fa fa-image',
		'fields' => array(

			array(
				'id'         => 'client_image',
				'type'       => 'switcher',
				'title'      => __( 'Testimonial Image', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide testimonial image.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => true,
			),

			array(
				'id'         => 'thumbnail_slider',
				'type'       => 'checkbox',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Enable Thumbnail Slider', 'testimonial-free' ),
				'subtitle'   => __( 'Check to enable thumbnail slider. (Pro)', 'testimonial-free' ),
				'default'    => false,
			),
			array(
				'id'         => 'client_image_style',
				'class'      => 'client_image_style',
				'type'       => 'image_select',
				'title'      => __( 'Image Shape', 'testimonial-free' ),
				'subtitle'   => __( 'Choose a image shape.', 'testimonial-free' ),
				'options'    => array(
					'three' => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/image-shape/circle.svg',
						'name'  => __( 'Circle', 'testimonial-free' ),
					),
					'two'   => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/image-shape/rounded.svg',
						'name'  => __( 'Rounded', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
					'one'   => array(
						'image' => plugin_dir_url( __FILE__ ) . 'framework/assets/images/image-shape/square.svg',
						'name'  => __( 'Square', 'testimonial-free' ),
						'class' => 'pro-feature',
					),
				),
				'default'    => 'three',
				'dependency' => array(
					'client_image',
					'==',
					'true',
				),
			),
			array(
				'id'         => 'image_sizes',
				'type'       => 'image_sizes',
				'title'      => __( 'Testimonial Image Size', 'testimonial-free' ),
				'subtitle'   => __( 'Select which size image to show with your Testimonials.', 'testimonial-free' ),
				'default'    => 'tf-client-image-size',
				'dependency' => array(
					'client_image',
					'==',
					'true',
				),
			),
			array(
				'id'         => 'image_custom_size',
				'type'       => 'custom_size',
				'class'      => 'disabled',
				'title'      => __( 'Custom Size', 'testimonial-free' ),
				'subtitle'   => __( 'Set a custom width and height of the image.', 'testimonial-free' ),
				'default'    => array(
					'width'  => '120',
					'height' => '120',
					'crop'   => 'hard-crop',
					'unit'   => 'px',
				),
				'attributes' => array(
					'min' => 0,
				),
				'dependency' => array(
					'client_image|image_sizes',
					'==|==',
					'true|custom',
				),
			),
			array(
				'id'       => 'image_grayscale',
				'type'     => 'select',
				'title'    => __( 'Image Mode', 'testimonial-free' ),
				'subtitle' => __( 'Select a image mode.', 'testimonial-free' ),
				'options'  => array(
					'none'            => __( 'Normal', 'testimonial-free' ),
					'normal_on_hover' => __( 'Grayscale and normal on hover (Pro)', 'testimonial-free' ),
					'on_hover'        => __( 'Grayscale on hover (Pro)', 'testimonial-free' ),
					'always'          => __( 'Always grayscale (Pro)', 'testimonial-free' ),
				),
				'default'  => 'none',
			),
			array(
				'id'         => 'video_icon',
				'type'       => 'switcher',
				'class'      => 'pro_switcher',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Video Testimonial', 'testimonial-free' ),
				'subtitle'   => __( 'Show/Hide video testimonial.', 'testimonial-free' ),
				'text_on'    => __( 'Show', 'testimonial-free' ),
				'text_off'   => __( 'Hide', 'testimonial-free' ),
				'text_width' => 80,
				'default'    => false,
			),
		),
	)
);

//
// Slider Settings section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts,
	array(
		'title'  => __( 'Slider Controls', 'testimonial-free' ),
		'icon'   => 'fa fa-sliders',
		'fields' => array(
			array(
				'id'       => 'slider_mode',
				'type'     => 'button_set',
				'title'    => __( 'Slider Mode', 'testimonial-free' ),
				'subtitle' => __( 'Set a slider mode. Slider Settings are disabled in the ticker mode. ', 'testimonial-free' ),
				'options'  => array(
					'standard' => __( 'Standard', 'testimonial-free' ),
					'ticker'   => array(
						'option_name' => __( 'Ticker', 'testimonial-free' ),
						'pro_only'    => true,
					),
				),
				'default'  => 'standard',
			),
			array(
				'id'       => 'slider_auto_play',
				'type'     => 'button_set',
				'title'    => __( 'AutoPlay', 'testimonial-free' ),
				'subtitle' => __( 'On/Off auto play.', 'testimonial-free' ),
				'options'  => array(
					'true'          => __( 'On', 'testimonial-free' ),
					'false'         => __( 'Off', 'testimonial-free' ),
					'off_on_mobile' => __( 'Off on Mobile', 'testimonial-free' ),
				),
				'default'  => 'true',
			),
			array(
				'id'         => 'slider_auto_play_speed',
				'type'       => 'spinner',
				'title'      => __( 'AutoPlay Speed', 'testimonial-free' ),
				'subtitle'   => __( 'Set auto play speed in a millisecond. Default value 3000ms.', 'testimonial-free' ),
				'max'        => 30000,
				'min'        => 100,
				'default'    => 3000,
				'step'       => 100,
				'unit'       => __( 'ms', 'testimonial-free' ),
				'dependency' => array(
					'slider_auto_play',
					'any',
					'true,off_on_mobile',
				),
			),
			array(
				'id'       => 'slider_scroll_speed',
				'type'     => 'spinner',
				'title'    => __( 'Pagination Speed', 'testimonial-free' ),
				'subtitle' => __( 'Set pagination speed in a millisecond. Default value 600ms.', 'testimonial-free' ),
				'unit'     => __( 'ms', 'testimonial-free' ),
				'max'      => 10000,
				'min'      => 10,
				'default'  => 600,
				'step'     => 10,
			),
			array(
				'id'         => 'slider_pause_on_hover',
				'type'       => 'switcher',
				'title'      => __( 'Pause on Hover', 'testimonial-free' ),
				'subtitle'   => __( 'Enable/Disable slider pause on hover.', 'testimonial-free' ),
				'default'    => true,
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => 95,
				'dependency' => array(
					'slider_auto_play',
					'any',
					'true,off_on_mobile',
				),
			),
			array(
				'id'         => 'slider_infinite',
				'type'       => 'switcher',
				'title'      => __( 'Infinite Loop', 'testimonial-free' ),
				'subtitle'   => __( 'Enable/Disable infinite loop mode.', 'testimonial-free' ),
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => 95,
				'default'    => true,
			),
			array(
				'id'         => 'slider_animation',
				'type'       => 'select',
				'title'      => __( 'Slider Animation', 'testimonial-free' ),
				'subtitle'   => __( 'Fade effect works only on single column view.', 'testimonial-free' ),
				'options'    => array(
					'slide' => __( 'Slide', 'testimonial-free' ),
					'fade'  => __( 'Fade(Pro)', 'testimonial-free' ),
				),
				'default'    => 'slide',
				'dependency' => array( 'slider_mode', '==', 'standard' ),
			),
			array(
				'id'       => 'slider_direction',
				'type'     => 'button_set',
				'title'    => __( 'Direction', 'testimonial-free' ),
				'subtitle' => __( 'Slider direction.', 'testimonial-free' ),
				'options'  => array(
					'ltr' => __( 'Right to Left', 'testimonial-free' ),
					'rtl' => __( 'Left to Right', 'testimonial-free' ),
				),
				'default'  => 'ltr',
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Navigation', 'testimonial-free' ),
			),
			array(
				'id'       => 'navigation',
				'type'     => 'button_set',
				'title'    => __( 'Navigation', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide slider navigation.', 'testimonial-free' ),
				'options'  => array(
					'true'           => __( 'Show', 'testimonial-free' ),
					'false'          => __( 'Hide', 'testimonial-free' ),
					'hide_on_mobile' => __( 'Hide on Mobile', 'testimonial-free' ),
				),
				'default'  => 'true',
			),
			array(
				'id'         => 'navigation_color',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'testimonial-free' ),
				'subtitle'   => __( 'Set the navigation color.', 'testimonial-free' ),
				'options'    => array(
					'color'            => __( 'Color', 'testimonial-free' ),
					'hover-color'      => __( 'Hover Color', 'testimonial-free' ),
					'background'       => __( 'Background', 'testimonial-free' ),
					'hover-background' => __( 'Hover Background', 'testimonial-free' ),
				),
				'default'    => array(
					'color'            => '#777777',
					'hover-color'      => '#ffffff',
					'background'       => 'transparent',
					'hover-background' => '#1595ce',
				),
				'dependency' => array(
					'navigation',
					'any',
					'true,hide_on_mobile',
				),
			),
			array(
				'id'          => 'navigation_border',
				'type'        => 'border',
				'title'       => __( 'Border', 'testimonial-free' ),
				'subtitle'    => __( 'Set the navigation border.', 'testimonial-free' ),
				'all'         => true,
				'hover_color' => true,
				'default'     => array(
					'all'         => '2',
					'style'       => 'solid',
					'color'       => '#777777',
					'hover-color' => '#1595ce',
				),
				'dependency'  => array(
					'navigation',
					'any',
					'true,hide_on_mobile',
				),
			),

			array(
				'type'    => 'subheading',
				'content' => __( 'Pagination', 'testimonial-free' ),
			),
			array(
				'id'       => 'pagination',
				'type'     => 'button_set',
				'title'    => __( 'Pagination', 'testimonial-free' ),
				'subtitle' => __( 'Show/Hide pagination.', 'testimonial-free' ),
				'options'  => array(
					'true'           => __( 'Show', 'testimonial-free' ),
					'false'          => __( 'Hide', 'testimonial-free' ),
					'hide_on_mobile' => __( 'Hide on Mobile', 'testimonial-free' ),
				),
				'default'  => 'true',
			),
			array(
				'id'         => 'pagination_colors',
				'type'       => 'color_group',
				'title'      => __( 'Color', 'testimonial-free' ),
				'subtitle'   => __( 'Set the pagination color.', 'testimonial-free' ),
				'options'    => array(
					'color'        => __( 'Color', 'testimonial-free' ),
					'active-color' => __( 'Active Color', 'testimonial-free' ),
				),
				'default'    => array(
					'color'        => '#cccccc',
					'active-color' => '#1595ce',
				),
				'dependency' => array(
					'pagination',
					'any',
					'true,hide_on_mobile',
				),
			),
			array(
				'type'    => 'subheading',
				'content' => __( 'Miscellaneous', 'testimonial-free' ),
			),
			array(
				'id'         => 'adaptive_height',
				'type'       => 'switcher',
				'title'      => __( 'Adaptive Slider Height', 'testimonial-free' ),
				'subtitle'   => __( 'Dynamically adjust slider height based on each slide\'s height.', 'testimonial-free' ),
				'default'    => false,
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => 95,
			),
			array(
				'id'         => 'slider_swipe',
				'type'       => 'switcher',
				'title'      => __( 'Touch Swipe', 'testimonial-free' ),
				'subtitle'   => __( 'Enable/Disable swipe mode.', 'testimonial-free' ),
				'default'    => true,
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => 95,
			),
			array(
				'id'         => 'slider_draggable',
				'type'       => 'switcher',
				'title'      => __( 'Mouse Draggable', 'testimonial-free' ),
				'subtitle'   => __( 'Enable/Disable mouse draggable mode.', 'testimonial-free' ),
				'default'    => true,
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => 95,
				'dependency' => array( 'slider_swipe', '==', 'true' ),
			),
			array(
				'id'         => 'swipe_to_slide',
				'type'       => 'switcher',
				'title'      => __( 'Swipe To Slide', 'testimonial-free' ),
				'subtitle'   => __( 'Enable/Disable swipe to slide.', 'testimonial-free' ),
				'default'    => false,
				'text_on'    => __( 'Enabled', 'testimonial-free' ),
				'text_off'   => __( 'Disabled', 'testimonial-free' ),
				'text_width' => 95,
				'dependency' => array( 'slider_swipe', '==', 'true' ),
			),

		),
	)
);

//
// Typography section.
//
SPFTESTIMONIAL::createSection(
	$prefix_shortcode_opts,
	array(
		'title'  => __( 'Typography', 'testimonial-free' ),
		'icon'   => 'fa fa-font',
		'fields' => array(
			array(
				'type'    => 'notice',
				'style'   => 'normal',
				'content' => __( 'To unlock These Typography (940+ Google Fonts) options, <a target="_blank" href="https://shapedplugin.com/plugin/testimonial-pro/?ref=1"><b>Upgrade to Pro!</b></a> P.S. Note: The color fields work in the lite version.', 'testimonial-free' ),
			),
			array(
				'id'       => 'section_title_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Section Title Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the section title.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'section_title_typography',
				'type'          => 'typography',
				'title'         => __( 'Section Title Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set testimonial section title font properties.', 'testimonial-free' ),
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => '600',
					'type'           => 'google',
					'font-size'      => '22',
					'line-height'    => '22',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
					'margin-bottom'  => '23',
				),
				'margin_bottom' => true,
				'preview'       => true,
				'preview_text'  => 'What Our Customers Saying', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'testimonial_title_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Testimonial Title Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the testimonial tagline or title.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'testimonial_title_typography',
				'type'          => 'typography',
				'title'         => __( 'Testimonial Title Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set testimonial tagline or title font properties.', 'testimonial-free' ),
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => '600',
					'type'           => 'google',
					'font-size'      => '20',
					'line-height'    => '30',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#333333',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '18',
					'margin-left'    => '0',
				),
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
				'preview'       => true,
				'preview_text'  => 'The Testimonial Title', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'testimonial_text_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Testimonial Content Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the testimonial content.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'testimonial_text_typography',
				'type'          => 'typography',
				'title'         => __( 'Testimonial Content Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set testimonial content font properties.', 'testimonial-free' ),
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '16',
					'line-height'    => '26',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#333333',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '20',
					'margin-left'    => '0',
				),
				'color'         => true,
				'preview'       => true,
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
			),
			array(
				'id'       => 'client_name_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Name Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the name.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'client_name_typography',
				'type'          => 'typography',
				'title'         => __( 'Name Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set name font properties.', 'testimonial-free' ),
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => '700',
					'type'           => 'google',
					'font-size'      => '16',
					'line-height'    => '24',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#333333',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '8',
					'margin-left'    => '0',
				),
				'color'         => true,
				'preview'       => true,
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
				'preview_text'  => 'Jacob Firebird', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'designation_company_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Identity or Position & Company Name Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the identity or position & company name.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'client_designation_company_typography',
				'type'          => 'typography',
				'title'         => __( 'Identity or Position & Company Name Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set identity or position & company name font properties.', 'testimonial-free' ),
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '16',
					'line-height'    => '24',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '8',
					'margin-left'    => '0',
				),
				'color'         => true,
				'preview'       => true,
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
				'preview_text'  => 'CEO - Firebird Media Inc.', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'location_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Location Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the location.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'client_location_typography',
				'type'          => 'typography',
				'title'         => __( 'Location Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set location font properties.', 'testimonial-free' ),
				'class'         => 'sp-testimonial-font-color',
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '5',
					'margin-left'    => '0',
				),
				'color'         => true,
				'preview'       => true,
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
				'preview_text'  => 'Los Angeles', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'phone_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Phone or Mobile Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the phone or mobile.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'client_phone_typography',
				'type'          => 'typography',
				'title'         => __( 'Phone or Mobile Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set phone or mobile font properties.', 'testimonial-free' ),
				'class'         => 'sp-testimonial-font-color',
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '3',
					'margin-left'    => '0',
				),
				'color'         => true,
				'preview'       => true,
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
				'preview_text'  => '+1 234567890', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'email_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Email Address Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the email address.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'client_email_typography',
				'type'          => 'typography',
				'title'         => __( 'Email Address Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set email address font properties.', 'testimonial-free' ),
				'class'         => 'sp-testimonial-font-color',
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '5',
					'margin-left'    => '0',
				),
				'color'         => true,
				'preview'       => true,
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
				'preview_text'  => 'mail@yourwebsite.com', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'date_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Date Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the date.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'testimonial_date_typography',
				'type'          => 'typography',
				'title'         => __( 'Date Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set date font properties.', 'testimonial-free' ),
				'class'         => 'sp-testimonial-font-color',
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '6',
					'margin-left'    => '0',
				),
				'color'         => true,
				'preview'       => true,
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
				'preview_text'  => 'February 21, 2018', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'website_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Website Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the website.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'            => 'client_website_typography',
				'type'          => 'typography',
				'title'         => __( 'Website Font', 'testimonial-free' ),
				'subtitle'      => __( 'Set website font properties.', 'testimonial-free' ),
				'class'         => 'sp-testimonial-font-color',
				'default'       => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
					'color'          => '#444444',
					'margin-top'     => '0',
					'margin-right'   => '0',
					'margin-bottom'  => '6',
					'margin-left'    => '0',
				),
				'color'         => true,
				'preview'       => true,
				'margin_top'    => true,
				'margin_right'  => true,
				'margin_bottom' => true,
				'margin_left'   => true,
				'preview_text'  => 'www.yourwebsite.com', // Replace preview text with any text you like.
			),
			array(
				'id'       => 'filter_font_load',
				'type'     => 'switcher',
				'title'    => __( 'Load Isotope Filter Button Font', 'testimonial-free' ),
				'subtitle' => __( 'On/Off google font for the isotope filter button.', 'testimonial-free' ),
				'class'    => 'sp-testimonial-font-load',
				'default'  => true,
			),
			array(
				'id'           => 'filter_typography',
				'type'         => 'typography',
				'title'        => __( 'Isotope Filter Button Font', 'testimonial-free' ),
				'subtitle'     => __( 'Set isotope filter button font properties.', 'testimonial-free' ),
				'default'      => array(
					'font-family'    => 'Open Sans',
					'font-weight'    => 'normal',
					'type'           => 'google',
					'font-size'      => '15',
					'line-height'    => '20',
					'text-align'     => 'center',
					'text-transform' => 'none',
					'letter-spacing' => 0,
				),
				'color'        => false,
				'preview'      => true,
				'preview_text' => 'All', // Replace preview text with any text you like.
			),

		),
	)
);

//
// Metabox of the Testimonial.
// Set a unique slug-like ID.
//
$prefix_testimonial_opts = 'sp_tpro_meta_options';

//
// Testimonial metabox.
//
SPFTESTIMONIAL::createMetabox(
	$prefix_testimonial_opts,
	array(
		'title'     => __( 'Testimonial Options', 'testimonial-free' ),
		'class'     => 'spt-main-class',
		'post_type' => 'spt_testimonial',
		'context'   => 'normal',
	)
);

//
// Reviewer Information section.
//
SPFTESTIMONIAL::createSection(
	$prefix_testimonial_opts,
	array(
		'title'  => __( 'Reviewer Information', 'testimonial-free' ),
		'fields' => array(

			array(
				'id'       => 'tpro_name',
				'type'     => 'text',
				'title'    => __( 'Full Name', 'testimonial-free' ),
				'sanitize' => 'spftestimonial_sanitize_text',
			),
			array(
				'id'       => 'tpro_designation',
				'type'     => 'text',
				'title'    => __( 'Identity or Position', 'testimonial-free' ),
				'sanitize' => 'spftestimonial_sanitize_text',
			),
			array(
				'id'       => 'tpro_rating',
				'type'     => 'rating',
				'title'    => __( 'Rating', 'testimonial-free' ),
				'options'  => array(
					'five_star'  => __( '5 Stars', 'testimonial-free' ),
					'four_star'  => __( '4 Stars', 'testimonial-free' ),
					'three_star' => __( '3 Stars', 'testimonial-free' ),
					'two_star'   => __( '2 Stars', 'testimonial-free' ),
					'one_star'   => __( '1 Star', 'testimonial-free' ),
				),
				'default'  => '',
				'sanitize' => 'spftestimonial_sanitize_text',
			),
			array(
				'type'    => 'subheading',
				'class'   => 'pro_heading',
				'content' => __( 'EXTRA REVIEWER INFORMATION (PRO)', 'testimonial-free' ),
			),
			array(
				'type'    => 'notice',
				'content' => __( 'To unlock the following extra reviewer information fields, <a target="_blank" href="https://shapedplugin.com/plugin/testimonial-pro/?ref=1"><b>Upgrade to Pro!</b></a>', 'testimonial-free' ),
			),
			array(
				'id'         => 'tpro_email',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'type'       => 'text',
				'title'      => __( 'E-mail Address', 'testimonial-free' ),
				'sanitize'   => 'spftestimonial_sanitize_text',
			),

			array(
				'id'         => 'tpro_company_name',
				'type'       => 'text',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Company Name', 'testimonial-free' ),
				'sanitize'   => 'spftestimonial_sanitize_text',
			),
			array(
				'id'         => 'tpro_location',
				'type'       => 'text',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Location', 'testimonial-free' ),
				'sanitize'   => 'spftestimonial_sanitize_text',
			),
			array(
				'id'         => 'tpro_phone',
				'type'       => 'text',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Phone or Mobile', 'testimonial-free' ),
				'sanitize'   => 'spftestimonial_sanitize_text',
			),
			array(
				'id'         => 'tpro_website',
				'type'       => 'text',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Website', 'testimonial-free' ),
				'sanitize'   => 'spftestimonial_sanitize_text',
			),
			array(
				'id'         => 'tpro_video_url',
				'type'       => 'text',
				'class'      => 'pro_only_field',
				'attributes' => array( 'disabled' => 'disabled' ),
				'title'      => __( 'Video Testimonial URL', 'testimonial-free' ),
				'sanitize'   => 'spftestimonial_sanitize_text',
			),
			array(
				'type'    => 'subheading',
				'class'   => 'pro_heading',
				'content' => __( 'SOCIAL MEDIA (PRO)', 'testimonial-free' ),
			),
			array(
				'id'         => 'tpro_social_profiles',
				'type'       => 'repeater',
				'title'      => esc_html__( 'Social Profiles', 'testimonial-free' ),
				'class'      => 'pro_only_field social-profile-repeater',
				'attributes' => array( 'disabled' => 'disabled' ),
				'clone'      => false,
				'fields'     => array(
					array(
						'id'          => 'social_name',
						'type'        => 'select',
						'attributes'  => array( 'disabled' => 'disabled' ),
						'options'     => array( 'facebook' ),
						'placeholder' => 'facebook',
						'default'     => 'facebook',
					),
					array(
						'id'         => 'social_url',
						'type'       => 'text',
						'class'      => 'pro_only_field',
						'attributes' => array( 'disabled' => 'disabled' ),
						'class'      => 'social-url',
					),
				),
				'default'    => array(
					array(),
				),
			),
		),
	)
);

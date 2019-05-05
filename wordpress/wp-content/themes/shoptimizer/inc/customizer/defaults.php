<?php
/**
 *
 * Kirki defaults
 *
 * @package CommerceGurus
 * @subpackage Shoptimizer
 */

if ( ! function_exists( 'shoptimizer_get_option_defaults' ) ) {

	/**
	 *
	 * Sensible defaults ftw.
	 */
	function shoptimizer_get_option_defaults() {
		$defaults = array(

			// Top Bar.
			'shoptimizer_layout_top_bar_display'           => 'enable',
			'shoptimizer_layout_top_bar_background'        => '#fff',
			'shoptimizer_layout_top_bar_text'              => '#323232',
			'shoptimizer_layout_top_bar_border'            => '#eee',

			// Sidebars.
			'shoptimizer_layout_woocommerce_sidebar'       => 'left-woocommerce-sidebar',
			'shoptimizer_layout_archives_sidebar'          => 'right-archives-sidebar',
			'shoptimizer_layout_post_sidebar'              => 'right-post-sidebar',
			'shoptimizer_layout_page_sidebar'              => 'right-page-sidebar',

			// Header.
			'shoptimizer_header_bg_color'                  => '#fff',
			'shoptimizer_header_border_color'              => '#eee',
			'shoptimizer_layout_search_display'            => 'enable',

			// Navigation.
			'shoptimizer_navigation_bg_color'              => '#222',
			'shoptimizer_secondary_navigation_color'       => '#404040',
			'shoptimizer_navigation_color'                 => '#fff',
			'shoptimizer_navigation_color_hover'           => '#dc9814',
			'shoptimizer_sticky_navigation_border'         => 'rgba(0, 0, 0, 0.0)',

			// Navigation Dropdowns.
			'shoptimizer_navigation_dropdown_background'   => '#fff',
			'shoptimizer_navigation_dropdown_color'        => '#323232',
			'shoptimizer_navigation_dropdown_hover_color'  => '#dc9814',

			// Navigation Cart.
			'shoptimizer_cart_color'                       => '#fff',
			'shoptimizer_cart_icon_color'                  => '#dc9814',

			// Sticky Header.
			'shoptimizer_sticky_header'                    => 'enable',
			'shoptimizer_logo_mark_image'                  => '',

			// Below Header.
			'shoptimizer_below_header_bg'                  => '#dc9814',
			'shoptimizer_below_header_text'                => '#fff',

			// WooCommerce.
			'shoptimizer_layout_woocommerce_text_alignment' => 'product-align-left',

			'shoptimizer_layout_woocommerce_display_cart'  => true,
			'shoptimizer_layout_woocommerce_display_breadcrumbs' => true,
			'shoptimizer_layout_woocommerce_display_count' => true,
			'shoptimizer_layout_woocommerce_display_sorting' => true,
			'shoptimizer_layout_woocommerce_display_badge' => true,
			'shoptimizer_layout_woocommerce_display_rating' => false,
			'shoptimizer_layout_woocommerce_display_category' => true,
			'shoptimizer_layout_woocommerce_prev_next_display' => true,
			'shoptimizer_layout_woocommerce_sticky_cart_display' => true,
			'shoptimizer_layout_woocommerce_related_display' => true,
			'shoptimizer_layout_woocommerce_meta_display'  => true,

			'shoptimizer_layout_floating_button_display'   => true,
			'shoptimizer_layout_floating_button_text'      => 'Questions? Request a Call Back',

			'shoptimizer_layout_progress_bar_display'      => true,
			'shoptimizer_layout_woocommerce_simple_checkout' => true,

			// Blog
			'shoptimizer_layout_blog'                      => 'flow',
			'shoptimizer_layout_blog_summary_display'      => true,

			// Colors.
			'shoptimizer_color_general_swatch'             => '#dc9814',

			'shoptimizer_color_general_links'              => '#3077d0',
			'shoptimizer_color_general_links_hover'        => '#111',

			'shoptimizer_color_body_bg'                    => '#fff',

			'shoptimizer_product_bg'                       => '#f8f8f8',

			'shoptimizer_ratings_color'                    => '#ee9e13',

			'shoptimizer_woocommerce_button_text'          => '#fff',
			'shoptimizer_woocommerce_button_bg'            => '#3bb54a',
			'shoptimizer_woocommerce_button_hover_bg'      => '#009245',

			'shoptimizer_sale_flash_bg'                    => '#3bb54a',
			'shoptimizer_sale_flash_text'                  => '#fff',

			'shoptimizer_floating_button_bg'               => '#dc9814',
			'shoptimizer_floating_button_text'             => '#fff',

			'shoptimizer_archives_description_bg'          => '#efeee3',
			'shoptimizer_archives_description_text'        => '#222',

			// Footer.
			'shoptimizer_below_content_display'            => 'show',
			'shoptimizer_footer_display'                   => 'show',
			'shoptimizer_copyright_display'                => 'show',

			'shoptimizer_footer_bg'                        => '#111',
			'shoptimizer_footer_heading_color'             => '#fff',
			'shoptimizer_footer_color'                     => '#ccc',
			'shoptimizer_footer_links_color'               => '#999',
			'shoptimizer_footer_links_hover_color'         => '#fff',

			// Speed Settings.
			'shoptimizer_general_speed_critical_css'       => 'yes',
			'shoptimizer_general_speed_minify_main_css'    => 'yes',
		);

		return apply_filters( 'shoptimizer_get_option_defaults', $defaults );
	}
}// End if().

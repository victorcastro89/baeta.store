<?php if ( ! defined('WOODMART_THEME_DIR')) exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------------------------------
 * Frontend class that initiallize current header for the page and generates its structure HTML + CSS
 * ------------------------------------------------------------------------------------------------
 */

if( ! class_exists( 'WOODMART_HB_Frontend' ) ) {
	class WOODMART_HB_Frontend {
		private static $_instance = null;

		public $builder = null;

		private $_element_classes = array();

		private $_structure = array();

		public $header = null;

		public function __construct() {
			$this->builder = WOODMART_Header_Builder::get_instance();

			$this->init();
		}

		protected function __clone() {}

		static public function get_instance() {

			if( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function init() {
			add_action( 'wp_print_styles', array( $this, 'styles'), 200 );
			add_action( 'init', array( $this, 'get_elements') );
		}

		public function get_elements() {
			// Fix VC map issue. Load our elements when Visual Composer is loaded
			$this->_element_classes = $this->builder->elements->elements_classes;
		}

		public function styles() {
			$id = $this->get_current_id();
			$this->header = $this->builder->factory->get_header( $id );
			$this->_structure = $this->header->get_structure();
			$options = $this->header->get_options();
			wp_add_inline_style( 'woodmart-style', $this->get_header_css( $options ) );
		}

		public function get_current_id() {
			$id = $this->builder->manager->get_default_header();
			$page_id = woodmart_page_ID();
			$custom_post_header = woodmart_get_opt( 'single_post_header');
			$custom_product_header = woodmart_get_opt( 'single_product_header');
			$custom = get_post_meta( $page_id, '_woodmart_whb_header', true );

			if ( ! empty( $custom_post_header ) && $custom_post_header != 'none' && is_singular( 'post' ) ) $id = $custom_post_header;
			if ( ! empty( $custom_product_header ) && $custom_product_header != 'none' && woodmart_woocommerce_installed() && is_product() ) $id = $custom_product_header;

			if ( ! empty( $custom ) && $custom != 'none' ) $id = $custom;

			return $id;
		}

		public function get_header_css( $options ) {
			$top_border = ( isset( $options['top-bar']['border']['width'] ) ) ? (int) $options['top-bar']['border']['width'] : 0;
			$header_border = ( isset( $options['general-header']['border']['width'] ) ) ? (int) $options['general-header']['border']['width'] : 0;
			$bottom_border = ( isset( $options['header-bottom']['border']['width'] ) ) ? (int) $options['header-bottom']['border']['width'] : 0;

			$total_border_height = $top_border + $header_border + $bottom_border;

			$total_height = $options['top-bar']['height'] + $options['general-header']['height'] + $options['header-bottom']['height'];

			$mobile_height = $options['top-bar']['mobile_height'] + $options['general-header']['mobile_height'] + $options['header-bottom']['mobile_height'] + $total_border_height;

			$total_height += $total_border_height;

			$sticky_elements = array_filter($options, function($el) {
				return isset($el['sticky']) && $el['sticky'];
			});

			$total_sticky_height = 0;

			foreach ($sticky_elements as $key => $el) {
				if( isset($el['height']) && $el['height'] )
					$total_sticky_height += $el['height'];
			}

			ob_start();
			?>


			@media (min-width: 1025px) {

				.whb-top-bar-inner {
		            height: <?php echo esc_html( $options['top-bar']['height'] ); ?>px;
				}

				.whb-general-header-inner {
		            height: <?php echo esc_html( $options['general-header']['height'] ); ?>px;
				}

				.whb-header-bottom-inner {
		            height: <?php echo esc_html( $options['header-bottom']['height'] ); ?>px;
				}

				.whb-sticked .whb-top-bar-inner {
		            height: <?php echo esc_html( $options['top-bar']['sticky_height'] ); ?>px;
				}

				.whb-sticked .whb-general-header-inner {
		            height: <?php echo esc_html( $options['general-header']['sticky_height'] ); ?>px;
				}

				.whb-sticked .whb-header-bottom-inner {
		            height: <?php echo esc_html( $options['header-bottom']['sticky_height'] ); ?>px;
				}

				/* HEIGHT OF HEADER CLONE */

				.whb-clone .whb-general-header-inner {
		            height: <?php echo esc_html( $options['sticky_height'] ); ?>px;
				}

				/* HEADER OVERCONTENT */

				.woodmart-header-overcontent .title-size-small {
					padding-top: <?php echo esc_html( $total_height + 20 ); ?>px;
				}

				.woodmart-header-overcontent .title-size-default {
					padding-top: <?php echo esc_html( $total_height + 60 ); ?>px;
				}

				.woodmart-header-overcontent .title-size-large {
					padding-top: <?php echo esc_html( $total_height + 100 ); ?>px;
				}

				/* HEADER OVERCONTENT WHEN SHOP PAGE TITLE TURN OFF  */

				.woodmart-header-overcontent .without-title.title-size-small {
					padding-top: <?php echo esc_html( $total_height); ?>px;
				}


				.woodmart-header-overcontent .without-title.title-size-default {
					padding-top: <?php echo esc_html( $total_height + 35 ); ?>px;
				}


				.woodmart-header-overcontent .without-title.title-size-large {
					padding-top: <?php echo esc_html( $total_height + 60 ); ?>px;
				}

				/* HEADER OVERCONTENT ON SINGLE PRODUCT */

				.single-product .whb-overcontent:not(.whb-custom-header) {
					padding-top: <?php echo esc_html( $total_height); ?>px;
				}

				/* HEIGHT OF LOGO IN TOP BAR */

				.whb-top-bar .woodmart-logo img {
					max-height: <?php echo esc_html( $options['top-bar']['height'] ); ?>px;
				}

				.whb-sticked .whb-top-bar .woodmart-logo img {
					max-height: <?php echo esc_html( $options['top-bar']['sticky_height'] ); ?>px;
				}
				
				/* HEIGHT OF LOGO IN GENERAL HEADER */

				.whb-general-header .woodmart-logo img {
					max-height: <?php echo esc_html( $options['general-header']['height'] ); ?>px;
				}

				.whb-sticked .whb-general-header .woodmart-logo img {
					max-height: <?php echo esc_html( $options['general-header']['sticky_height'] ); ?>px;
				}

				/* HEIGHT OF LOGO IN BOTTOM HEADER */

				.whb-header-bottom .woodmart-logo img {
					max-height: <?php echo esc_html( $options['header-bottom']['height'] ); ?>px;
				}

				.whb-sticked .whb-header-bottom .woodmart-logo img {
					max-height: <?php echo esc_html( $options['header-bottom']['sticky_height'] ); ?>px;
				}

				/* HEIGHT OF LOGO IN HEADER CLONE */

				.whb-clone .whb-general-header .woodmart-logo img {
					max-height: <?php echo esc_html( $options['sticky_height'] ); ?>px;
				}

				/* HEIGHT OF HEADER BULDER ELEMENTS */

				/* HEIGHT ELEMENTS IN TOP BAR */

				.whb-top-bar .search-button > a,
				.whb-top-bar .woodmart-shopping-cart > a,
				.whb-top-bar .woodmart-wishlist-info-widget > a,
				.whb-top-bar .main-nav .item-level-0 > a,
				.whb-top-bar .whb-secondary-menu .item-level-0 > a,
				.whb-top-bar .woodmart-header-links .item-level-0 > a,
				.whb-top-bar .categories-menu-opener,
				.whb-top-bar .woodmart-burger-icon,
				.whb-top-bar .menu-opener,
				.whb-top-bar .whb-divider-stretch:before,
				.whb-top-bar form.woocommerce-currency-switcher-form .dd-selected,
				.whb-top-bar .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['top-bar']['height'] ); ?>px;
				}

				.whb-sticked .whb-top-bar .search-button > a,
				.whb-sticked .whb-top-bar .woodmart-shopping-cart > a,
				.whb-sticked .whb-top-bar .woodmart-wishlist-info-widget > a,
				.whb-sticked .whb-top-bar .main-nav .item-level-0 > a,
				.whb-sticked .whb-top-bar .whb-secondary-menu .item-level-0 > a,
				.whb-sticked .whb-top-bar .woodmart-header-links .item-level-0 > a,
				.whb-sticked .whb-top-bar .categories-menu-opener,
				.whb-sticked .whb-top-bar .woodmart-burger-icon,
				.whb-sticked .whb-top-bar .menu-opener,
				.whb-sticked .whb-top-bar .whb-divider-stretch:before,
				.whb-sticked .whb-top-bar form.woocommerce-currency-switcher-form .dd-selected,
				.whb-sticked .whb-top-bar .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['top-bar']['sticky_height'] ); ?>px;
				}

				/* HEIGHT ELEMENTS IN GENERAL HEADER */

				.whb-general-header .whb-divider-stretch:before,
				.whb-general-header .navigation-style-bordered .item-level-0 > a {
					height: <?php echo esc_html( $options['general-header']['height'] ); ?>px;
				}

				.whb-sticked:not(.whb-clone) .whb-general-header .whb-divider-stretch:before,
				.whb-sticked:not(.whb-clone) .whb-general-header .navigation-style-bordered .item-level-0 > a {
					height: <?php echo esc_html( $options['general-header']['sticky_height'] ); ?>px;
				}

				.whb-sticked:not(.whb-clone) .whb-general-header .woodmart-search-dropdown, 
				.whb-sticked:not(.whb-clone) .whb-general-header .dropdown-cart, 
				.whb-sticked:not(.whb-clone) .whb-general-header .woodmart-navigation:not(.vertical-navigation):not(.navigation-style-bordered) .sub-menu-dropdown {
					margin-top: <?php echo esc_html( ($options['general-header']['sticky_height'] / 2) - 20 ); ?>px;
				}

				.whb-sticked:not(.whb-clone) .whb-general-header .woodmart-search-dropdown:after, 
				.whb-sticked:not(.whb-clone) .whb-general-header .dropdown-cart:after, 
				.whb-sticked:not(.whb-clone) .whb-general-header .woodmart-navigation:not(.vertical-navigation):not(.navigation-style-bordered) .sub-menu-dropdown:after {
					height: <?php echo esc_html( ($options['general-header']['sticky_height'] / 2) - 20 ); ?>px;
				}

				/* HEIGHT ELEMENTS IN BOTTOM HEADER */

				.whb-header-bottom .search-button > a,
				.whb-header-bottom .woodmart-shopping-cart > a,
				.whb-header-bottom .woodmart-wishlist-info-widget > a,
				.whb-header-bottom .main-nav .item-level-0 > a,
				.whb-header-bottom .whb-secondary-menu .item-level-0 > a,
				.whb-header-bottom .woodmart-header-links .item-level-0 > a,
				.whb-header-bottom .categories-menu-opener,
				.whb-header-bottom .woodmart-burger-icon,
				.whb-header-bottom .menu-opener,
				.whb-header-bottom .whb-divider-stretch:before,
				.whb-header-bottom form.woocommerce-currency-switcher-form .dd-selected,
				.whb-header-bottom .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['header-bottom']['height'] ); ?>px;
				}

				.whb-header-bottom.whb-border-fullwidth .menu-opener {
					height: <?php echo esc_html( $options['header-bottom']['height'] + $bottom_border + $header_border); ?>px;
					margin-top: -<?php echo esc_html($header_border); ?>px;
					margin-bottom: -<?php echo esc_html($bottom_border); ?>px;
				}

				.whb-header-bottom.whb-border-boxed .menu-opener {
					height: <?php echo esc_html( $options['header-bottom']['height'] + $header_border); ?>px;
					margin-top: -<?php echo esc_html($header_border); ?>px;
					margin-bottom: -<?php echo esc_html($bottom_border); ?>px;
				}

				.whb-sticked .whb-header-bottom .search-button > a,
				.whb-sticked .whb-header-bottom .woodmart-shopping-cart > a,
				.whb-sticked .whb-header-bottom .woodmart-wishlist-info-widget > a,
				.whb-sticked .whb-header-bottom .main-nav .item-level-0 > a,
				.whb-sticked .whb-header-bottom .whb-secondary-menu .item-level-0 > a,
				.whb-sticked .whb-header-bottom .woodmart-header-links .item-level-0 > a,
				.whb-sticked .whb-header-bottom .categories-menu-opener,
				.whb-sticked .whb-header-bottom .woodmart-burger-icon,
				.whb-sticked .whb-header-bottom .whb-divider-stretch:before,
				.whb-sticked .whb-header-bottom form.woocommerce-currency-switcher-form .dd-selected,
				.whb-sticked .whb-header-bottom .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['header-bottom']['sticky_height'] ); ?>px;
				}

				.whb-sticked .whb-header-bottom.whb-border-fullwidth .menu-opener {
					height: <?php echo esc_html( $options['header-bottom']['sticky_height'] + $bottom_border + $header_border); ?>px;
				}

				.whb-sticked .whb-header-bottom.whb-border-boxed .menu-opener {
					height: <?php echo esc_html( $options['header-bottom']['sticky_height'] + $header_border); ?>px;
				}

				.whb-sticky-shadow.whb-sticked .whb-header-bottom .menu-opener {
					height: <?php echo esc_html( $options['header-bottom']['sticky_height'] + $header_border); ?>px;
					margin-bottom:0;
				}

				/* HEIGHT ELEMENTS IN HEADER CLONE */

				.whb-clone .search-button > a,
				.whb-clone .woodmart-shopping-cart > a,
				.whb-clone .woodmart-wishlist-info-widget > a,
				.whb-clone .main-nav .item-level-0 > a,
				.whb-clone .whb-secondary-menu .item-level-0 > a,
				.whb-clone .woodmart-header-links .item-level-0 > a,
				.whb-clone .categories-menu-opener,
				.whb-clone .woodmart-burger-icon,
				.whb-clone .menu-opener,
				.whb-clone .whb-divider-stretch:before,
				.whb-clone .navigation-style-bordered .item-level-0 > a,
				.whb-clone form.woocommerce-currency-switcher-form .dd-selected,
				.whb-clone .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['sticky_height'] ); ?>px;
				}
			}

	        @media (max-width: 1024px) {

				.whb-top-bar-inner {
		            height: <?php echo esc_html( $options['top-bar']['mobile_height'] ); ?>px;
				}

				.whb-general-header-inner {
		            height: <?php echo esc_html( $options['general-header']['mobile_height'] ); ?>px;
				}

				.whb-header-bottom-inner {
		            height: <?php echo esc_html( $options['header-bottom']['mobile_height'] ); ?>px;
				}

				/* HEIGHT OF HEADER CLONE */

				.whb-clone .whb-general-header-inner {
		            height: <?php echo esc_html( $options['general-header']['mobile_height'] ); ?>px;
				}

				/* HEADER OVERCONTENT */

				.woodmart-header-overcontent .page-title {
					padding-top: <?php echo esc_html( $mobile_height + 15 ); ?>px;
				}

				/* HEADER OVERCONTENT WHEN SHOP PAGE TITLE TURN OFF  */

				.woodmart-header-overcontent .without-title.title-shop {
					padding-top: <?php echo esc_html( $mobile_height); ?>px;
				}

				/* HEADER OVERCONTENT ON SINGLE PRODUCT */

				.single-product .whb-overcontent:not(.whb-custom-header) {
					padding-top: <?php echo esc_html( $mobile_height); ?>px;
				}

				/* HEIGHT OF LOGO IN TOP BAR */

				.whb-top-bar .woodmart-logo img {
					max-height: <?php echo esc_html( $options['top-bar']['mobile_height'] ); ?>px;
				}
				
				/* HEIGHT OF LOGO IN GENERAL HEADER */

				.whb-general-header .woodmart-logo img {
					max-height: <?php echo esc_html( $options['general-header']['mobile_height'] ); ?>px;
				}

				/* HEIGHT OF LOGO IN BOTTOM HEADER */

				.whb-header-bottom .woodmart-logo img {
					max-height: <?php echo esc_html( $options['header-bottom']['mobile_height'] ); ?>px;
				}

				/* HEIGHT OF LOGO IN HEADER CLONE */

				.whb-clone .whb-general-header .woodmart-logo img {
					max-height: <?php echo esc_html( $options['general-header']['mobile_height'] ); ?>px;
				}

				/* HEIGHT OF HEADER BULDER ELEMENTS */

				/* HEIGHT ELEMENTS IN TOP BAR */

				.whb-top-bar .search-button > a,
				.whb-top-bar .woodmart-shopping-cart > a,
				.whb-top-bar .woodmart-wishlist-info-widget > a,
				.whb-top-bar .main-nav .item-level-0 > a,
				.whb-top-bar .whb-secondary-menu .item-level-0 > a,
				.whb-top-bar .woodmart-header-links .item-level-0 > a,
				.whb-top-bar .categories-menu-opener,
				.whb-top-bar .woodmart-burger-icon,
				.whb-top-bar .whb-divider-stretch:before,
				.whb-top-bar form.woocommerce-currency-switcher-form .dd-selected,
				.whb-top-bar .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['top-bar']['mobile_height'] ); ?>px;
				}

				/* HEIGHT ELEMENTS IN GENERAL HEADER */

				.whb-general-header .search-button > a,
				.whb-general-header .woodmart-shopping-cart > a,
				.whb-general-header .woodmart-wishlist-info-widget > a,
				.whb-general-header .main-nav .item-level-0 > a,
				.whb-general-header .whb-secondary-menu .item-level-0 > a,
				.whb-general-header .woodmart-header-links .item-level-0 > a,
				.whb-general-header .categories-menu-opener,
				.whb-general-header .woodmart-burger-icon,
				.whb-general-header .whb-divider-stretch:before,
				.whb-general-header form.woocommerce-currency-switcher-form .dd-selected,
				.whb-general-header .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['general-header']['mobile_height'] ); ?>px;
				}

				/* HEIGHT ELEMENTS IN BOTTOM HEADER */

				.whb-header-bottom .search-button > a,
				.whb-header-bottom .woodmart-shopping-cart > a,
				.whb-header-bottom .woodmart-wishlist-info-widget > a,
				.whb-header-bottom .main-nav .item-level-0 > a,
				.whb-header-bottom .whb-secondary-menu .item-level-0 > a,
				.whb-header-bottom .woodmart-header-links .item-level-0 > a,
				.whb-header-bottom .categories-menu-opener,
				.whb-header-bottom .woodmart-burger-icon,
				.whb-header-bottom .whb-divider-stretch:before,
				.whb-header-bottom form.woocommerce-currency-switcher-form .dd-selected,
				.whb-header-bottom .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['header-bottom']['mobile_height'] ); ?>px;
				}

				/* HEIGHT ELEMENTS IN HEADER CLONE */

				.whb-clone .search-button > a,
				.whb-clone .woodmart-shopping-cart > a,
				.whb-clone .woodmart-wishlist-info-widget > a,
				.whb-clone .main-nav .item-level-0 > a,
				.whb-clone .whb-secondary-menu .item-level-0 > a,
				.whb-clone .woodmart-header-links .item-level-0 > a,
				.whb-clone .categories-menu-opener,
				.whb-clone .woodmart-burger-icon,
				.whb-clone .menu-opener,
				.whb-clone .whb-divider-stretch:before,
				.whb-clone form.woocommerce-currency-switcher-form .dd-selected,
				.whb-clone .whb-text-element .wcml-dropdown a.wcml-cs-item-toggle {
					height: <?php echo esc_html( $options['general-header']['mobile_height'] ); ?>px;
				}
			}

	        <?php

	        return ob_get_clean();
		}

		public function generate_header() {
			$this->_render_element( $this->_structure );
			do_action('whb_after_header');
		}

		private function _render_element( $el ) {
			$children = '';
			$type = ucfirst( $el['type'] );

			if( ! isset( $el['params'] ) ) $el['params'] = array();

			if( isset( $el['content'] ) && is_array( $el['content'] ) ) {
				ob_start();
				foreach ($el['content'] as $element) {
					$this->_render_element( $element );
				}
				$children = ob_get_clean();
			}

			if( $type == 'Row' && $this->_is_empty_row( $el ) || $type == 'Column' && $this->_is_empty_column( $el ) ) {
				$children = false;
			}

			if( isset( $this->_element_classes[ $type ] ) ) {
				$obj = $this->_element_classes[ $type ];
				$obj->render($el, $children);
			}

		}

		private function _is_empty_row( $el ) {
			$isEmpty = true;

			foreach ($el['content'] as $key => $column) {
				if( ! $this->_is_empty_column( $column ) ) $isEmpty = false;
			}

			return $isEmpty;
		}

		private function _is_empty_column( $el ) {
			return empty( $el['content'] );
		}
	}

	$_GLOBALS['woodmart_hb_frontend'] = WOODMART_HB_Frontend::get_instance();

}

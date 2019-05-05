<?php if ( ! defined('WOODMART_THEME_DIR')) exit('No direct script access allowed');

// **********************************************************************//
// ! Body classes
// **********************************************************************//

if( ! function_exists( 'woodmart_body_class' ) ) {
	function woodmart_body_class( $classes ) {

		$page_id = woodmart_page_ID();

		$site_width = woodmart_get_opt( 'site_width' );
		$product_design = woodmart_product_design();
		$product_sticky = woodmart_product_sticky();

		$ajax_shop = woodmart_get_opt( 'ajax_shop' );
		$hide_sidebar_mobile = woodmart_get_opt( 'shop_hide_sidebar' );
		$hide_sidebar_tablet = woodmart_get_opt( 'shop_hide_sidebar_tablet' );
		$hide_sidebar_desktop = woodmart_get_opt( 'shop_hide_sidebar_desktop' );
		$catalog_mode = woodmart_get_opt( 'catalog_mode' );
		$categories_toggle = woodmart_get_opt( 'categories_toggle' );
		$sticky_footer = woodmart_get_opt( 'sticky_footer' );
		$dark = woodmart_get_opt( 'dark_version' );
		$form_fields_style = ( woodmart_get_opt( 'form_fields_style' ) ) ? woodmart_get_opt( 'form_fields_style' ) : 'square';
		$form_border_width = woodmart_get_opt( 'form_border_width' );
		$single_post_design = woodmart_get_opt( 'single_post_design' );
		$main_sidebar_mobile = woodmart_get_opt( 'hide_main_sidebar_mobile' );

		if ( $single_post_design == 'large_image' && is_single() ) {
			$classes[] = 'single-post-large-image';
		}

		$classes[] = 'wrapper-' . $site_width;
		// Form style settings
		$classes[] = 'form-style-' . $form_fields_style;
		$classes[] = 'form-border-width-' . $form_border_width;

		if( is_singular( 'product' ) ) {
			$classes[] = 'woodmart-product-design-' . $product_design;
			if( $product_sticky ) {
				$classes[] = 'woodmart-product-sticky-on';
				woodmart_enqueue_script( 'woodmart-sticky-kit' );
			}
		}
		
		if ( woodmart_woocommerce_installed() && ( is_shop() || is_product_category() ) && ( $hide_sidebar_desktop && $sticky_footer ) ) {
			$classes[] = 'no-sticky-footer';
		}elseif( $sticky_footer ){
			$classes[] = 'sticky-footer-on';
		}
		
		if ( $dark ) {
			$classes[] = 'woodmart-dark';
		}

		if ( $catalog_mode ) {
			$classes[] = 'catalog-mode-on';
		}

		if ( $categories_toggle ) {
			$classes[] = 'categories-accordion-on';
		}

		if( woodmart_is_blog_archive() ) {
			$classes[] = 'woodmart-archive-blog';
		} else if( woodmart_is_shop_archive() ) {
			$classes[] = 'woodmart-archive-shop';
		} else if( woodmart_is_portfolio_archive() ) {
			$classes[] = 'woodmart-archive-portfolio';
		}
		
		//Header banner
		if ( ! woodmart_get_opt( 'header_close_btn' ) && woodmart_get_opt( 'header_banner' ) && ! woodmart_maintenance_page() ) {
			$classes[] = 'header-banner-display';
		}
		if ( woodmart_get_opt( 'header_banner' ) && ! woodmart_maintenance_page() ) {
			$classes[] = 'header-banner-enabled';
		}
		
		if ( $ajax_shop ) {
			$classes[] = 'woodmart-ajax-shop-on';
		}

		if( $hide_sidebar_mobile && ( woodmart_woocommerce_installed() && ( is_shop() || is_product_category() ) ) || $main_sidebar_mobile && ( ! woodmart_woocommerce_installed() || ( ! is_shop() && ! is_product_category() ) ) ) {
			$classes[] = 'offcanvas-sidebar-mobile';
		}

		if( $hide_sidebar_tablet ) {
			$classes[] = 'offcanvas-sidebar-tablet';
		}

		if( $hide_sidebar_desktop ) {
			$classes[] = 'offcanvas-sidebar-desktop';
		}

		if ( ! is_user_logged_in() && woodmart_get_opt( 'login_prices' ) ) {
			$classes[] = 'login-see-prices';
		}

		if ( woodmart_get_opt( 'disable_nanoscroller' ) != 'enable' ) {
			$classes[] = 'disabled-nanoscroller';
		}

		if ( woodmart_get_opt( 'sticky_notifications' ) ) {
			$classes[] = 'notifications-sticky';
		}

		if ( woodmart_get_opt( 'sticky_toolbar' ) ) {
			$classes[] = 'sticky-toolbar-on';
		}

		$classes = array_merge( $classes, woodmart_get_buttons_config_classes(), woodmart_get_header_body_classes() );

		return $classes;
	}

	add_filter('body_class', 'woodmart_body_class');
}



/**
 * ------------------------------------------------------------------------------------------------
 * Get header body classes
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'woodmart_get_header_body_classes' ) ) {
	function woodmart_get_header_body_classes() {
		$classes = array();
		$settings = whb_get_settings();
		if ( isset( $settings['overlap'] ) && $settings['overlap'] ) {
			$classes[] = 'woodmart-header-overcontent';
		}
		if ( whb_get_dropdowns_color() == 'light' ) {
			$classes[] = 'dropdowns-color-light';
		}
		return $classes;
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * Buttons configuration classes
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'woodmart_get_buttons_config_classes' ) ) {
	function woodmart_get_buttons_config_classes() {
		$classes = array();

		$classes[] = 'btns-default-' . woodmart_get_opt( 'btns_default_style' );
		$classes[] = 'btns-default-' . woodmart_get_opt( 'btns_default_color_scheme' );
		$classes[] = 'btns-default-hover-' . woodmart_get_opt( 'btns_default_color_scheme_hover' );

		$classes[] = 'btns-shop-' . woodmart_get_opt( 'btns_shop_style' );
		$classes[] = 'btns-shop-' . woodmart_get_opt( 'btns_shop_color_scheme' );
		$classes[] = 'btns-shop-hover-' . woodmart_get_opt( 'btns_shop_color_scheme_hover' );

		$classes[] = 'btns-accent-' . woodmart_get_opt( 'btns_accent_style' );
		$classes[] = 'btns-accent-' . woodmart_get_opt( 'btns_accent_color_scheme' );
		$classes[] = 'btns-accent-hover-' . woodmart_get_opt( 'btns_accent_color_scheme_hover' );

		return $classes;
	}
}


/**
 * ------------------------------------------------------------------------------------------------
 * Filter wp_title
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'woodmart_wp_title' ) ) {
	function woodmart_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'woodmart' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'woodmart_wp_title', 10, 2 );

}

/**
 * ------------------------------------------------------------------------------------------------
 * Get predefined footer configuration by index
 * ------------------------------------------------------------------------------------------------
 */

if( ! function_exists( 'woodmart_get_footer_config' ) ) {
	function woodmart_get_footer_config( $index ) {

		if( $index > 20 || $index < 1) {
			$index = 1;
		}

		$configs = apply_filters( 'woodmart_footer_configs_array', array(
			1 => array(
				'cols' => array(
					'col-12'
				),

			),
			2 => array(
				'cols' => array(
					'col-12 col-sm-6',
					'col-12 col-sm-6',
				),
			),
			3 => array(
				'cols' => array(
					'col-12 col-sm-4',
					'col-12 col-sm-4',
					'col-12 col-sm-4',
				),
			),
			4 => array(
				'cols' => array(
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
				),
			),
			5 => array(
				'cols' => array(
					'col-12 col-sm-6 col-md-4 col-lg-2',
					'col-12 col-sm-6 col-md-4 col-lg-2',
					'col-12 col-sm-6 col-md-4 col-lg-2',
					'col-12 col-sm-6 col-md-4 col-lg-2',
					'col-12 col-sm-6 col-md-4 col-lg-2',
					'col-12 col-sm-6 col-md-4 col-lg-2',
				),
			),
			6 => array(
				'cols' => array(
					'col-12 col-sm-4 col-lg-3',
					'col-12 col-sm-4 col-lg-6',
					'col-12 col-sm-4 col-lg-3',
				),
			),
			7 => array(
				'cols' => array(
					'col-12 col-sm-4 col-lg-6',
					'col-12 col-sm-4 col-lg-3',
					'col-12 col-sm-4 col-lg-3',
				),
			),
			8 => array(
				'cols' => array(
					'col-12 col-sm-4 col-lg-3',
					'col-12 col-sm-4 col-lg-3',
					'col-12 col-sm-4 col-lg-6',
				),
			),
			9 => array(
				'cols' => array(
					'col-12',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
				),
			),
			10 => array(
				'cols' => array(
					'col-12 col-md-6',
					'col-12 col-md-6',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
				),
			),
			11 => array(
				'cols' => array(
					'col-12 col-md-6',
					'col-12 col-md-6',
					'col-12 col-sm-6 col-md-3 col-lg-2',
					'col-12 col-sm-6 col-md-3 col-lg-2',
					'col-12 col-sm-6 col-md-3 col-lg-2',
					'col-12 col-sm-6 col-md-3 col-lg-2',
					'col-12 col-lg-4',
				),
			),
			12 => array(
				'cols' => array(
					'col-12',
					'col-12 col-sm-6 col-md-3 col-lg-2',
					'col-12 col-sm-6 col-md-3 col-lg-2',
					'col-12 col-sm-6 col-md-3 col-lg-2',
					'col-12 col-sm-6 col-md-3 col-lg-2',
					'col-12 col-lg-4',
				),
			),
			13 => array(
				'cols' => array(
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-6 col-lg-3',
					'col-12 col-sm-4 col-lg-2',
					'col-12 col-sm-4 col-lg-2',
					'col-12 col-sm-4 col-lg-2',
				),
			),
		) );

		return (isset( $configs[$index] )) ? $configs[$index] : array();
	}
}


// **********************************************************************//
// ! Theme 3d plugins
// **********************************************************************//


if(!defined('YITH_REFER_ID')) {
	define('YITH_REFER_ID', '1040314');
}


if( ! function_exists( 'woodmart_3d_plugins' )) {
	function woodmart_3d_plugins() {
		if( function_exists( 'set_revslider_as_theme' ) ){
			set_revslider_as_theme();
		}
	}

	add_action( 'init', 'woodmart_3d_plugins' );
}

if( ! function_exists( 'woodmart_vcSetAsTheme' ) ) {

	function woodmart_vcSetAsTheme() {
		if( function_exists( 'vc_set_as_theme' ) ){
			vc_set_as_theme();
		}
	}

	add_action( 'vc_before_init', 'woodmart_vcSetAsTheme' );
}


// **********************************************************************//
// ! Obtain real page ID (shop page, blog, portfolio or simple page)
// **********************************************************************//

/**
 * This function is called once when initializing WOODMART_Layout object
 * then you can use function woodmart_page_ID to get current page id
 */
if( ! function_exists( 'woodmart_get_the_ID' ) ) {
	function woodmart_get_the_ID( $args = array() ) {
		global $post;

		$page_id = 0;

		$page_for_posts    = get_option( 'page_for_posts' );
		$page_for_shop     = get_option( 'woocommerce_shop_page_id' );
		$page_for_projects = woodmart_tpl2id( 'portfolio.php' );
		$custom_404_id 	   = woodmart_get_opt( 'custom_404_page' );

		if(isset($post->ID)) $page_id = $post->ID;

		if( isset($post->ID) && ( is_singular( 'page' ) || is_singular( 'post' ) ) ) {
			$page_id = $post->ID;
		} else if( is_home() || is_singular( 'post' ) || is_search() || is_tag() || is_category() || is_date() || is_author() ) {
			$page_id = $page_for_posts;
		} else if( is_archive('portfolio') && get_post_type() == 'portfolio' ) {
			$page_id = $page_for_projects;
		}

		if( woodmart_woocommerce_installed() && function_exists( 'is_shop' )  ) {
			if( isset( $args['singulars'] ) && in_array( 'product', $args['singulars']) && is_singular( "product" ) ) {
				// keep post id
			} else if( is_shop() || is_product_category() || is_product_tag() || is_singular( "product" ) || woodmart_is_product_attribute_archieve() ) {
				$page_id = $page_for_shop;
			}
		}

		if( is_404() && ( $custom_404_id != 'default' || ! empty( $custom_404_id ) ) ) $page_id = $custom_404_id;

		return $page_id;
	}
}


// **********************************************************************//
// ! Function to get HTML block content
// **********************************************************************//

if( ! function_exists( 'woodmart_get_html_block' ) ) {
	function woodmart_get_html_block($id) {
		$post = get_post( $id );
		if ( ! $post || $post->post_type != 'cms_block' ) return;
		$content = do_shortcode( $post->post_content );

		$shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
		$woodmart_shortcodes_custom_css = get_post_meta( $id, 'woodmart_shortcodes_custom_css', true );
		
		$content .= '<style data-type="vc_shortcodes-custom-css">';
		if ( ! empty( $shortcodes_custom_css ) ) {
			$content .= $shortcodes_custom_css;
		}

		if ( ! empty( $woodmart_shortcodes_custom_css ) ) {
			$content .= $woodmart_shortcodes_custom_css;
		}
		$content .= '</style>';

		return $content;
	}

}

if( ! function_exists( 'woodmart_get_static_blocks_array' ) ) {
	function woodmart_get_static_blocks_array() {
		$args = array( 'posts_per_page' => 200, 'post_type' => 'cms_block' );
		$blocks_posts = get_posts( $args );
		$array = array();
		foreach ( $blocks_posts as $post ) :
			setup_postdata( $post );
			$array[$post->post_title] = $post->ID;
		endforeach;
		wp_reset_postdata();
		return $array;
	}
}

// **********************************************************************//
// ! Set excerpt length and more btn
// **********************************************************************//

add_filter( 'excerpt_length', 'woodmart_excerpt_length', 999 );

if( ! function_exists( 'woodmart_excerpt_length' ) ) {
	function woodmart_excerpt_length( $length ) {
		return 20;
	}
}

add_filter('excerpt_more', 'woodmart_new_excerpt_more');

if( ! function_exists( 'woodmart_new_excerpt_more' ) ) {
	function woodmart_new_excerpt_more( $more ) {
		return '';
	}
}

// **********************************************************************//
// ! Add scroll to top buttom
// **********************************************************************//

add_action( 'woodmart_after_footer', 'woodmart_scroll_top_btn' );

if( ! function_exists( 'woodmart_scroll_top_btn' ) ) {
	function woodmart_scroll_top_btn( $more ) {
		if( !woodmart_get_opt( 'scroll_top_btn' ) ) return;
		?>
			<a href="#" class="scrollToTop"><?php esc_attr_e( 'Scroll To Top', 'woodmart' ); ?></a>
		<?php
	}
}


// **********************************************************************//
// ! Return related posts args array
// **********************************************************************//

if( ! function_exists( 'woodmart_get_related_posts_args' ) ) {
	function woodmart_get_related_posts_args( $post_id ) {
		$taxs = wp_get_post_tags( $post_id );
		$args = array();
		if ( $taxs ) {
			$tax_ids = array();
			foreach( $taxs as $individual_tax ) $tax_ids[] = $individual_tax->term_id;

			$args = array(
				'tag__in'               => $tax_ids,
				'post__not_in'          => array( $post_id ),
				'showposts'             => 12,
				'ignore_sticky_posts'   => 1
			);

		}

		return $args;
	}
}

// **********************************************************************//
// ! Navigation walker
// **********************************************************************//

if( ! class_exists( 'WOODMART_Mega_Menu_Walker' )) {
	class WOODMART_Mega_Menu_Walker extends Walker_Nav_Menu {

		private $color_scheme = 'dark';

		public function __construct() {
			$this->color_scheme = whb_get_dropdowns_color();
		}

		/**
		 * Starts the list before the elements are added.
		 *
		 * @see Walker::start_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		public function start_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);

			if( $depth == 0) {
				$output .= "\n$indent<div class=\"sub-menu-dropdown color-scheme-" . $this->color_scheme . "\">\n";
				$output .= "\n$indent<div class=\"container\">\n";

			}
			if( $depth < 1 ) {
				$sub_menu_class = "sub-menu";
			} else {
				$sub_menu_class = "sub-sub-menu";
			}

			$output .= "\n$indent<ul class=\"$sub_menu_class color-scheme-" . $this->color_scheme . "\">\n";

			if( $this->color_scheme == 'light' || $this->color_scheme == 'dark' ) $this->color_scheme = whb_get_dropdowns_color() ;
		}

		/**
		 * Ends the list of after the elements are added.
		 *
		 * @see Walker::end_lvl()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 */
		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$indent = str_repeat("\t", $depth);
			$output .= "$indent</ul>\n";
			if( $depth == 0) {
				$output .= "$indent</div>\n";
				$output .= "$indent</div>\n";
			}
		}

		/**
		 * Start the element output.
		 *
		 * @see Walker::start_el()
		 *
		 * @since 3.0.0
		 *
		 * @param string $output Passed by reference. Used to append additional content.
		 * @param object $item   Menu item data object.
		 * @param int    $depth  Depth of menu item. Used for padding.
		 * @param array  $args   An array of arguments. @see wp_nav_menu()
		 * @param int    $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = 'item-level-' . $depth;

			$design = $width = $height = $icon = $label = $label_out = '';
			$design  = get_post_meta( $item->ID, '_menu_item_design',  true );
			$width   = get_post_meta( $item->ID, '_menu_item_width',   true );
			$height  = get_post_meta( $item->ID, '_menu_item_height',  true );
			$icon    = get_post_meta( $item->ID, '_menu_item_icon',    true );
			$event   = get_post_meta( $item->ID, '_menu_item_event',   true );
			$label   = get_post_meta( $item->ID, '_menu_item_label',   true );
			$label_text = get_post_meta( $item->ID, '_menu_item_label-text',   true );
			$block   = get_post_meta( $item->ID, '_menu_item_block',   true );
			$dropdown_ajax = get_post_meta( $item->ID, '_menu_item_dropdown-ajax',  true );
			$opanchor = get_post_meta( $item->ID, '_menu_item_opanchor', true );
			$callbtn  = get_post_meta( $item->ID, '_menu_item_callbtn', true );
			$color_scheme = get_post_meta( $item->ID, '_menu_item_colorscheme', true );

			if ( $color_scheme == 'light' ) {
				$this->color_scheme = 'light';
			}elseif( $color_scheme == 'dark' ){
				$this->color_scheme = 'dark';
			}

			if( empty($design) ) $design = 'default';

			if ( ! is_object( $args ) ) return;

			if( $depth == 0 && $args->menu_class != 'site-mobile-menu' ) {
				$classes[] = 'menu-item-design-' . $design;
				$classes[] = 'menu-' . ( (  in_array( $design, array( 'sized', 'full-width' ) ) ) ? 'mega-dropdown' : 'simple-dropdown' );
				$event = (empty($event)) ? 'hover' : $event;
				$classes[] = 'item-event-' . $event;
			} 
			
			if ( $block && $args->menu_class == 'site-mobile-menu' ) {
				$classes[] = 'menu-item-has-block';
			}

			if( $opanchor == 'enable' ) {
				 $classes[] = 'onepage-link';
				if(($key = array_search('current-menu-item', $classes)) !== false) {
					unset($classes[$key]);
				}
			}

			if( $callbtn == 'enable' ) {
				$classes[] = 'callto-btn';
			}

			if( !empty( $label ) ) {
				$classes[] = 'item-with-label';
				$classes[] = 'item-label-' . $label;
				$label_out = '<span class="menu-label menu-label-' . $label . '">' . esc_attr( $label_text ) . '</span>';
			}

			if( ! empty( $block ) && $design != 'default' ) {
				$classes[] = 'menu-item-has-children';
			}

			if( $dropdown_ajax == 'yes') {
				$classes[] = 'dropdown-load-ajax';
			}

			/**
			 * Filter the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filter the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param object $item    The current menu item.
			 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth   Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names .'>';

			$atts = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			$atts['href']   = ! empty( $item->url )        ? $item->url        : '';

			/**
			 * Filter the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 *     @type string $title  Title attribute.
			 *     @type string $target Target attribute.
			 *     @type string $rel    The rel attribute.
			 *     @type string $href   The href attribute.
			 * }
			 * @param object $item  The current menu item.
			 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
			 * @param int    $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
			$atts['class'] = 'woodmart-nav-link';

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$icon_url = '';

			if( $item->object == 'product_cat' ) {
				$icon_url = get_term_meta( $item->object_id, 'category_icon_alt', true );
			}

			$item_output = $args->before;
			$item_output .= '<a'. $attributes .'>';
			if($icon != '') {
				$item_output .= '<i class="fa fa-' . $icon . '"></i>';
			}

			$icon_attrs = apply_filters( 'woodmart_megamenu_icon_attrs', false );

			if( ! empty( $icon_url ) ) {
				$item_output .= '<img src="'  . esc_url( $icon_url ) . '" alt="' . esc_attr( $item->title ) . '" ' . $icon_attrs . ' class="category-icon" />';
			}
			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= '<span class="nav-link-text">' . $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . '</span>';
			$item_output .= $label_out;
			$item_output .= '</a>';
			$item_output .= $args->after;

			$styles = '';

			if( $depth == 0 && $args->menu_class != 'site-mobile-menu' ) {
				/**
				 * Add background image to dropdown
				 **/


				if( has_post_thumbnail( $item->ID ) ) {
					$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $item->ID ), 'full' );

					//ar($post_thumbnail);

					$styles .= '.menu-item-' . $item->ID . ' > .sub-menu-dropdown {';
						$styles .= 'background-image: url(' . $post_thumbnail[0] .'); ';
					$styles .= '}';
				}

				if( ! empty( $block ) && !in_array("menu-item-has-children", $item->classes) && $design != 'default' ) {
					$item_output .= "\n$indent<div class=\"sub-menu-dropdown color-scheme-" . $this->color_scheme . "\">\n";
					$item_output .= "\n$indent<div class=\"container\">\n";
						if( $dropdown_ajax == 'yes') {
							$item_output .= '<div class="dropdown-html-placeholder" data-id="' . $block . '"></div>';
						} else {
							$item_output .= woodmart_html_block_shortcode( array( 'id' => $block ) );
						}
					$item_output .= "\n$indent</div>\n";
					$item_output .= "\n$indent</div>\n";

					if( $this->color_scheme == 'light' || $this->color_scheme == 'dark' ) $this->color_scheme = whb_get_dropdowns_color() ;
				}
			}

			if($design == 'sized' && !empty($height) && !empty($width) && $args->menu_class != 'site-mobile-menu' ) {
				$styles .= '.menu-item-' . $item->ID . '.menu-item-design-sized > .sub-menu-dropdown {';
					$styles .= 'min-height: ' . $height .'px; ';
					$styles .= 'width: ' . $width .'px; ';
				$styles .= '}';
			}

			if( $styles != '' && $args->menu_class != 'site-mobile-menu' ) {
				$item_output .= '<style>';
				$item_output .= $styles;
				$item_output .= '</style>';
			}

			/**
			 * Filter a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string $item_output The menu item's starting HTML output.
			 * @param object $item        Menu item data object.
			 * @param int    $depth       Depth of menu item. Used for padding.
			 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}


// **********************************************************************//
// ! Load menu drodpwns with AJAX actions
// **********************************************************************//

if( ! function_exists('woodmart_load_html_dropdowns_action') ) {
	function woodmart_load_html_dropdowns_action() {
		$response = array(
			'status' => 'error',
			'message' => 'Can\'t load HTML blocks with AJAX',
			'data' => array(),
		);

		if( class_exists('WPBMap') )
			WPBMap::addAllMappedShortcodes();

		if( isset( $_POST['ids'] ) && is_array( $_POST['ids'] ) ) {
			$ids = woodmart_clean( $_POST['ids'] );
			foreach ($ids as $id) {
				$id = (int) $id;
				$content = woodmart_get_html_block($id);
				if( ! $content ) continue;

				$response['status'] = 'success';
				$response['message'] = 'At least one HTML block loaded';
				$response['data'][$id] = $content;
			}
		}

		echo json_encode($response);

		die();
	}
	add_action( 'wp_ajax_woodmart_load_html_dropdowns', 'woodmart_load_html_dropdowns_action' );
	add_action( 'wp_ajax_nopriv_woodmart_load_html_dropdowns', 'woodmart_load_html_dropdowns_action' );
}

// **********************************************************************//
// ! // Deletes first gallery shortcode and returns content (http://stackoverflow.com/questions/17224100/wordpress-remove-shortcode-and-save-for-use-elsewhere)
// **********************************************************************//

if( ! function_exists( 'woodmart_strip_shortcode_gallery' ) ) {
	function  woodmart_strip_shortcode_gallery( $content ) {
		preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
		if ( ! empty( $matches ) ) {
			foreach ( $matches as $shortcode ) {
				if ( 'gallery' === $shortcode[2] ) {
					$pos = strpos( $content, $shortcode[0] );
					if ($pos !== false)
						return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
				}
			}
		}
		return $content;
	}
}


// **********************************************************************//
// ! Get exceprt from post content
// **********************************************************************//

if( ! function_exists( 'woodmart_excerpt_from_content' ) ) {
	function woodmart_excerpt_from_content($post_content, $limit, $shortcodes = '') {
		// Strip shortcodes and HTML tags
		if ( empty( $shortcodes )) {
			$post_content = preg_replace("/\[caption(.*)\[\/caption\]/i", '', $post_content);
			$post_content = preg_replace('`\[[^\]]*\]`','',$post_content);
		}

		$post_content = stripslashes( wp_filter_nohtml_kses( $post_content ) );

		if ( woodmart_get_opt( 'blog_words_or_letters' ) == 'letter' ) {
			$excerpt = mb_substr( $post_content, 0, $limit );
			if ( mb_strlen( $excerpt ) >= $limit ) {
				$excerpt .= '...';
			}
		}else{
			$limit++;
			$excerpt = explode(' ', $post_content, $limit);
			if ( count( $excerpt) >= $limit ) {
				array_pop( $excerpt );
				$excerpt = implode( " ", $excerpt ) . '...';
			} else {
				$excerpt = implode( " ", $excerpt );
			}
		}

		$excerpt = strip_tags( $excerpt );

		if ( trim( $excerpt ) == '...' ) {
			return '';
		}

		return $excerpt;
	}
}

// **********************************************************************//
// ! Get portfolio taxonomies dropdown
// **********************************************************************//

if( ! function_exists( 'woodmart_get_projects_cats_array') ) {
	function woodmart_get_projects_cats_array() {
		$return = array('All' => '');

		if( ! post_type_exists( 'portfolio' ) ) return array();

		$cats = get_terms( 'project-cat' );

		foreach ($cats as $key => $cat) {
			$return[$cat->name] = $cat->term_id;
		}

		return $return;
	}
}

// **********************************************************************//
// ! Get menus dropdown
// **********************************************************************//

if( ! function_exists( 'woodmart_get_menus_array') ) {
	function woodmart_get_menus_array() {
		$woodmart_menus = wp_get_nav_menus();
		$woodmart_menu_dropdown = array();

		foreach ( $woodmart_menus as $menu ) {

			$woodmart_menu_dropdown[$menu->term_id] = $menu->name;

		}

		return $woodmart_menu_dropdown;
	}
}


// **********************************************************************//
// ! Get custom header array created with header builder
// **********************************************************************//

if(!function_exists('woodmart_get_whb_headers_array')) {
	function woodmart_get_whb_headers_array( $get_from_options = false ) {
		if ( $get_from_options ) {
			$list = get_option( 'whb_saved_headers' ); 
		} else {
			$headers_list = whb_get_builder()->list;
			$list = $headers_list->get_all();
		}
		$headers = array();
		$headers['none'] = 'none';

		if( ! empty( $list ) && is_array( $list ) ) {
            foreach ($list as $key => $header) {
                $headers[$key] = $header['name'];
            }
        }

		return $headers;
	}
}

// **********************************************************************//
// ! Get registered sidebars dropdown
// **********************************************************************//

if(!function_exists('woodmart_get_sidebars_array')) {
	function woodmart_get_sidebars_array() {
		global $wp_registered_sidebars;
		$sidebars['none'] = 'none';
		foreach( $wp_registered_sidebars as $id=>$sidebar ) {
			$sidebars[ $id ] = $sidebar[ 'name' ];
		}
		return $sidebars;
	}
}

// **********************************************************************//
// ! Get page id by template name
// **********************************************************************//

if( ! function_exists( 'woodmart_pages_ids_from_template' ) ) {
	function woodmart_pages_ids_from_template( $name ) {
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => $name . '.php'
		));

		$return = array();

		foreach($pages as $page){
			$return[] = $page->ID;
		}

		return $return;
	}
}

// **********************************************************************//
// ! Get content of the SVG icon located in images/svg folder
// **********************************************************************//
if( ! function_exists( 'woodmart_get_svg_content' ) ) {
	function woodmart_get_svg_content($name) {
		$folder = WOODMART_THEMEROOT . '/images/svg';
		$file = $folder . '/' . $name . '.svg';

		return (file_exists( $file )) ? woodmart_get_any_svg( $file ) : false;
	}
}

if( ! function_exists( 'woodmart_get_any_svg' ) ) {
	function woodmart_get_any_svg( $file, $id = false ) {
		$content = function_exists( 'woodmart_get_svg' ) ? woodmart_get_svg( $file ) : '';
		$start_tag = '<svg';
		if( $id ) {
			$pattern = "/id=\"(\w)+\"/";
			if( preg_match($pattern, $content) ) {
				$content = preg_replace($pattern, "id=\"" . $id . "\"", $content, 1);
			} else {
				$content = preg_replace( "/<svg/", "<svg id=\"" . $id . "\"", $content);
			}
		}
		// Strip doctype
		$position = strpos($content, $start_tag);
		$content = substr($content, $position);
		return $content;
	}
}

// **********************************************************************//
//  Function return vc_row with gradient.
// **********************************************************************//
if( ! function_exists( 'woodmart_get_gradient_attr' ) ) {
	function woodmart_get_gradient_attr( $output, $obj, $attr ) {
	if ( isset( $attr['woodmart_gradient_switch'] ) && $attr['woodmart_gradient_switch'] == 'yes' ) {
			$gradient_css = woodmart_get_gradient_css( $attr['woodmart_color_gradient'] );
			$output = preg_replace_callback('/woodmart-row-gradient-enable.*?>/',
				function ( $matches ) use( $gradient_css ) {
				   return strtolower( $matches[0] . '<div class="woodmart-row-gradient" style="' . $gradient_css . '"></div>' );
				}, $output );
		}
		return $output;
	}
}

add_filter( 'vc_shortcode_output', 'woodmart_get_gradient_attr', 10, 3 );

// **********************************************************************//
//  Function return gradient css.
// **********************************************************************//
if( ! function_exists( 'woodmart_get_gradient_css' ) ) {
	function woodmart_get_gradient_css( $gradient_attr ) {
		$gradient_css = explode( '|', $gradient_attr );
		$result =  'background-image:-webkit-' . $gradient_css[1] . ';';
		$result .= 'background-image:-moz-' . $gradient_css[1] . ';';
		$result .= 'background-image:-o-' . $gradient_css[1] . ';';
		$result .= 'background-image:'.$gradient_css[1] . ';';
		$result .= 'background-image:-ms-' . $gradient_css[1] . ';';
		return $result;
	}
}

// **********************************************************************//
//  Function return all images sizes
// **********************************************************************//
function woodmart_get_all_image_sizes() {
    global $_wp_additional_image_sizes;

    $default_image_sizes = array( 'thumbnail', 'medium', 'large', 'full' );

    foreach ( $default_image_sizes as $size ) {
        $image_sizes[ $size ][ 'width' ] = intval( get_option( "{$size}_size_w" ) );
        $image_sizes[ $size ][ 'height' ] = intval( get_option( "{$size}_size_h" ) );
        $image_sizes[ $size ][ 'crop' ] = get_option( "{$size}_crop" ) ? get_option( "{$size}_crop" ) : false;
    }

    if ( isset( $_wp_additional_image_sizes ) && count( $_wp_additional_image_sizes ) ) {
        $image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
    }

    return $image_sizes;
}

if( ! function_exists( 'woodmart_get_image_size' ) ) {
	function woodmart_get_image_size( $thumb_size ) {
		if ( is_string( $thumb_size ) && in_array( $thumb_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
			$images_sizes = woodmart_get_all_image_sizes();
			$image_size = $images_sizes[$thumb_size];
			if ( $thumb_size == 'full') {
				$image_size['width'] = 999999;
				$image_size['height'] = 999999;
			}
			return array( $image_size['width'], $image_size['height'] );
		}elseif ( is_string( $thumb_size ) ) {
			preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
			if ( isset( $thumb_matches[0] ) ) {
				$thumb_size = array();
				if ( count( $thumb_matches[0] ) > 1 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width
					$thumb_size[] = $thumb_matches[0][1]; // height
				} elseif ( count( $thumb_matches[0] ) > 0 && count( $thumb_matches[0] ) < 2 ) {
					$thumb_size[] = $thumb_matches[0][0]; // width
					$thumb_size[] = $thumb_matches[0][0]; // height
				} else {
					$thumb_size = false;
				}
			}
		}

		return $thumb_size;
	}
}

if( ! function_exists( 'woodmart_get_image_src' ) ) {
	function woodmart_get_image_src( $thumb_id, $thumb_size ) {
		$thumb_size = woodmart_get_image_size( $thumb_size );
		$thumbnail = wpb_resize( $thumb_id, null, $thumb_size[0], $thumb_size[1], true );
		return $thumbnail['url'];
	}
}

// **********************************************************************//
// ! Append :hover to CSS selectors array
// **********************************************************************//
if( ! function_exists( 'woodmart_append_hover_state' ) ) {
	function woodmart_append_hover_state( $selectors , $focus = false ) {
		$selectors = explode(',', $selectors[0]);

		$return = array();

		foreach ($selectors as $selector) {
			$return[] = $selector . ':hover';
			( $focus ) ? $return[] .= $selector . ':focus' : false ;
		}

		return implode(',', $return);
	}
}


// **********************************************************************//
// Woodmart twitter process links
// **********************************************************************//
if( ! function_exists( 'woodmart_twitter_process_links' ) ) {
	function woodmart_twitter_process_links( $tweet ) {

		// Is the Tweet a ReTweet - then grab the full text of the original Tweet
		if( isset( $tweet->retweeted_status ) ) {
			// Split it so indices count correctly for @mentions etc.
			$rt_section = current( explode( ":", $tweet->text ) );
			$text = $rt_section.": ";
			// Get Text
			$text .= $tweet->retweeted_status->text;
		} else {
			// Not a retweet - get Tweet
			$text = $tweet->text;
		}

		// NEW Link Creation from clickable items in the text
		$text = preg_replace( '/((http)+(s)?:\/\/[^<>\s]+)/i', '<a href="$0" target="_blank" rel="nofollow">$0</a>', $text );
		// Clickable Twitter names
		$text = preg_replace( '/[@]+([A-Za-z0-9-_]+)/', '<a href="http://twitter.com/$1" target="_blank" rel="nofollow">@\\1</a>', $text );
		// Clickable Twitter hash tags
		$text = preg_replace( '/[#]+([A-Za-z0-9-_]+)/', '<a href="http://twitter.com/search?q=%23$1" target="_blank" rel="nofollow">$0</a>', $text );
		// END TWEET CONTENT REGEX
		return $text;

	}
}

// **********************************************************************//
// Woodmart Owl Items Per Slide
// **********************************************************************//
if( ! function_exists( 'woodmart_owl_items_per_slide' ) ) {
	function woodmart_owl_items_per_slide( $slides_per_view, $hide = array(), $post_type = false, $location = false, $custom_sizes = false ) {
		$items = woodmart_get_owl_items_numbers( $slides_per_view, $post_type, $custom_sizes );
		$classes = '';

		if ( woodmart_get_opt( 'thums_position' ) == 'centered' && $location == 'main-gallery' ) {
			$items['desktop'] = $items['tablet_landscape'] = $items['tablet'] = $items['mobile'] = 2;
		}
		
		if ( ! in_array( 'lg', $hide ) ) $classes .= 'owl-items-lg-' . $items['desktop'];
		if ( ! in_array( 'md', $hide ) ) $classes .= ' owl-items-md-' . $items['tablet_landscape'];
 		$classes .= ' owl-items-sm-' . $items['tablet'];
 		$classes .= ' owl-items-xs-' . $items['mobile'];

		return $classes;
	}
}
// **********************************************************************//
// Woodmart Get Owl Items Numbers
// **********************************************************************//
if ( ! function_exists( 'woodmart_get_owl_items_numbers' ) ) {
	function woodmart_get_owl_items_numbers( $slides_per_view, $post_type = false, $custom_sizes = false ) {
		$items = array();

		$items['desktop'] = ( $slides_per_view > 0 ) ? $slides_per_view : 1;
		$items['tablet_landscape'] = $items['desktop'];

		if ( $items['desktop'] >= 5 ) {
			$items['tablet_landscape'] = 4;
		} 

		$items['tablet'] = ( $items['tablet_landscape'] > 1 ) ? $items['tablet_landscape'] - 1 : $items['tablet_landscape'];
		$items['mobile'] = ( $items['desktop'] > 4 ) ? 2 : 1;

		if ( $post_type == 'product' ) {
			$items['mobile'] = woodmart_get_opt( 'products_columns_mobile' );
		}

		if ( $items['desktop'] == 1 ) {
			$items['mobile'] = 1;
		}

		if ( $custom_sizes ) {
			return $custom_sizes;
		}

		return $items;
	}
}



// **********************************************************************//
// Woodmart Get Settings JS
// **********************************************************************//
if ( ! function_exists('woodmart_settings_js') ) {
	function woodmart_settings_js() {

        $custom_js          = woodmart_get_opt( 'custom_js' );
        $js_ready           = woodmart_get_opt( 'js_ready' );

		ob_start();

        if( ! empty( $custom_js ) || ! empty( $js_ready ) ): ?>
            <?php if( ! empty( $custom_js ) ): ?>
                <?php echo woodmart_get_opt( 'custom_js' ); ?>
            <?php endif; ?>
            <?php if( ! empty( $js_ready ) ): ?>
                jQuery(document).ready(function() {
                    <?php echo woodmart_get_opt( 'js_ready' ); ?>
                });
            <?php endif; ?>
        <?php endif;

        return ob_get_clean();
	}
}

// **********************************************************************//
// Woodmart Get Settings CSS
// **********************************************************************//
if ( ! function_exists('woodmart_settings_css') ) {
	function woodmart_settings_css() {

		$widgets_scroll = woodmart_get_opt( 'widgets_scroll' );
		$widgets_height = woodmart_get_opt( 'widget_heights' );

		//Quickview
		$quickview_width = woodmart_get_opt( 'quickview_width' );
		
		//Shop popup
		$shop_popup_width = woodmart_get_opt( 'popup_width' );
		
		//Header banner
		$header_banner_height = woodmart_get_opt( 'header_banner_height' );
		$header_banner_height_mobile = woodmart_get_opt( 'header_banner_mobile_height' );

		$custom_product_background = get_post_meta( get_the_ID(),  '_woodmart_product-background', true );

		$site_custom_width = woodmart_get_opt( 'site_custom_width' );
		$predefined_site_width = woodmart_get_opt( 'site_width' );

		ob_start();

		$site_width = '';

		if ( $predefined_site_width == 'full-width' ) {
			$site_width = 1222;
		} elseif ( $predefined_site_width == 'boxed-2' ) {
			$site_width = 1160;
		} elseif ( $predefined_site_width == 'wide' ) {
			$site_width = 1600;
		} else if ( $predefined_site_width == 'custom' ) {
			$site_width = $site_custom_width;
		}

		echo '<style>';

		?>
		<?php if ( $site_width ): ?>
			/* Site width */

			/* Header Boxed */ 
			@media (min-width: 1025px) {

				.whb-boxed:not(.whb-sticked):not(.whb-full-width) .whb-main-header {
					max-width: <?php echo esc_html( $site_width - 30 ); ?>px;
				}
			}

			.container {
				max-width: <?php echo esc_html( $site_width ); ?>px;
			}
			
			@media (min-width: <?php echo esc_html( $site_width + 70 ); ?>px) {
				
				[data-vc-full-width] {
					<?php if ( is_rtl() ): ?>
						left: calc((100vw - <?php echo esc_html( $site_width ); ?>px) / 2);
					<?php else: ?>
						left: calc((-100vw - -<?php echo esc_html( $site_width ); ?>px) / 2);
					<?php endif; ?>
				}
				
				[data-vc-full-width]:not([data-vc-stretch-content]) {
			        padding-left: calc((100vw - <?php echo esc_html( $site_width ); ?>px) / 2);
			        padding-right: calc((100vw - <?php echo esc_html( $site_width ); ?>px) / 2);
				}

				.platform-Windows [data-vc-full-width] {
					<?php if ( is_rtl() ): ?>
						left: calc((100vw - <?php echo esc_html( $site_width + 17 ); ?>px) / 2);
					<?php else: ?>
						left: calc((-100vw - -<?php echo esc_html( $site_width + 17 ); ?>px) / 2);
					<?php endif; ?>
				}

				.platform-Windows [data-vc-full-width]:not([data-vc-stretch-content]) {
			        padding-left: calc((100vw - <?php echo esc_html( $site_width + 17 ); ?>px) / 2);
			        padding-right: calc((100vw - <?php echo esc_html( $site_width + 17 ); ?>px) / 2);
				}

				.browser-Edge [data-vc-full-width] {
					<?php if ( is_rtl() ): ?>
						left: calc((100vw - <?php echo esc_html( $site_width + 12 ); ?>px) / 2);
					<?php else: ?>
						left: calc((-100vw - -<?php echo esc_html( $site_width + 12 ); ?>px) / 2);
					<?php endif; ?>
				}

				.browser-Edge [data-vc-full-width]:not([data-vc-stretch-content]) {
			        padding-left: calc((100vw - <?php echo esc_html( $site_width + 12 ); ?>px) / 2);
			        padding-right: calc((100vw - <?php echo esc_html( $site_width + 12 ); ?>px) / 2);
				}
			}


		<?php endif; ?>
		
		/* Quickview */
		.popup-quick-view {
		   max-width: <?php echo esc_html( $quickview_width ); ?>px;
		}

		/* Shop popup */
		.woodmart-promo-popup {
		   max-width: <?php echo esc_html( $shop_popup_width ); ?>px;
		}

		/* Header Banner */
		.header-banner {
			height: <?php echo esc_html( $header_banner_height ); ?>px;
		}

		.header-banner-display .website-wrapper {
			margin-top:<?php echo esc_html( $header_banner_height ); ?>px;
		}

		/* Tablet */
        @media (max-width: 1024px) {

			/* header Banner */

			.header-banner {
				height: <?php echo esc_html( $header_banner_height_mobile ); ?>px;
			}

			.header-banner-display .website-wrapper {
				margin-top:<?php echo esc_html( $header_banner_height_mobile ); ?>px;
			}

		}

        <?php if( $widgets_scroll ): ?>
            .woodmart-woocommerce-layered-nav .woodmart-scroll-content {
                max-height: <?php echo esc_attr( $widgets_height ); ?>px;
            }
        <?php endif; ?>

		<?php if ( !empty( $custom_product_background ) ): ?>
		.single-product .main-page-wrapper{
			background-color: <?php echo esc_html( $custom_product_background ); ?> !important;
		}
		<?php endif ?>

        <?php

		echo '</style>';
		
        echo ob_get_clean();
	}

    add_action( 'wp_head', 'woodmart_settings_css', 200 );
}
// **********************************************************************//
// Header classes
// **********************************************************************//
if ( ! function_exists( 'woodmart_get_header_classes' ) ) {
	function woodmart_get_header_classes(){
		$settings = whb_get_settings();
		$custom_product_header = woodmart_get_opt( 'single_product_header');

		$header_class = 'whb-header';
		$header_class .= ( $settings['overlap'] ) ? ' whb-overcontent' : '';
		$header_class .= ( $settings['overlap'] && $settings['boxed'] ) ? ' whb-boxed' : '';
		$header_class .= ( $settings['full_width'] ) ? ' whb-full-width' : '';
		$header_class .= ( $settings['sticky_shadow'] ) ? ' whb-sticky-shadow' : '';
		$header_class .= ( $settings['sticky_effect'] ) ? ' whb-scroll-' . $settings['sticky_effect'] : '';
		$header_class .= ( $settings['sticky_clone'] && $settings['sticky_effect'] == 'slide' ) ? ' whb-sticky-clone' : ' whb-sticky-real';
		$header_class .= ( $settings['hide_on_scroll'] ) ? ' whb-hide-on-scroll' : '';

		if ( ! empty( $custom_product_header ) && $custom_product_header != 'none' && woodmart_woocommerce_installed() && is_product() ) {
			$header_class .= ' whb-custom-header';
		}

		echo 'class="' . esc_attr( $header_class ) . '"';
	}
}

// **********************************************************************//
// Print script tag with content
// **********************************************************************//
if ( ! function_exists( 'woodmart_add_inline_script' ) ) {
	function woodmart_add_inline_script( $key, $content, $position = 'after' ) {
		?>
			<script>
				<?php echo apply_filters( 'woodmart_inline_script', $content ); ?>
			</script>
		<?php
	}
}

// **********************************************************************//
// Print text size css
// **********************************************************************//
if ( ! function_exists( 'woodmart_responsive_text_size_css' ) ) {
	function woodmart_responsive_text_size_css( $id, $class, $data, $action = 'echo' ) {
		if ( 'return' == $action ) {
			return '#'. $id . ' .'. $class .'{font-size:' . $data . 'px;line-height:' . intval( $data + 10 ) . 'px;}';
		} else {
			echo '#'. $id . ' .'. $class .'{font-size:' . $data . 'px;line-height:' . intval( $data + 10 ) . 'px;}';
		}
	}
}

// **********************************************************************//
// ! Function to get all pages
// **********************************************************************//

if( ! function_exists( 'woodmart_get_pages' ) ) {
	function woodmart_get_pages() {
		$pages = array( 'default' => esc_html__( 'Default', 'woodmart' ) );
		foreach( get_pages() as $page ){
			$pages[$page->ID] = $page->post_title;
		}  
		return $pages;
	}
}

// **********************************************************************//
// ! Function to set custom 404 page
// **********************************************************************//
if( ! function_exists( 'woodmart_custom_404_page' ) ) {
	function woodmart_custom_404_page( $template ) {
		global $wp_query;
		$custom_404 = woodmart_get_opt( 'custom_404_page' );
		if ( $custom_404 == 'default' || empty( $custom_404 )  ) return $template;

		$wp_query->query( 'page_id=' . $custom_404 );
		$wp_query->the_post();
		$template = get_page_template();
		rewind_posts();

		return $template;
	}
	add_filter( '404_template', 'woodmart_custom_404_page', 999 );
}

// **********************************************************************//
// Get typekit fonts
// **********************************************************************//
if ( ! function_exists( 'woodmart_add_custom_fonts' ) ) {
	function woodmart_add_custom_fonts() {
		global $woodmart_options;
		$fonts = array();
		$typekit_fonts = isset( $woodmart_options['typekit_fonts'] ) ? $woodmart_options['typekit_fonts'] : '';
		$custom_fonts = isset( $woodmart_options['multi_custom_fonts'] ) ? $woodmart_options['multi_custom_fonts'] : '';

		if ( $typekit_fonts ) {
			$typekit = explode( ',', $typekit_fonts );
			$fonts['Custom-Fonts'] = array_combine( $typekit, $typekit );
		}

		if ( $custom_fonts ) {
			foreach ( $custom_fonts as $key => $value ) {
				if ( $value['font-name'] ) {
					$fonts['Custom-Fonts'][$value['font-name']] = $value['font-name'];
				}
			}
		}

		return $fonts;
		
	}
	add_filter( 'redux/woodmart_options/field/typography/custom_fonts', 'woodmart_add_custom_fonts' );
}

if ( ! function_exists( 'woodmart_core_outdated_message' ) ) {
	function woodmart_core_outdated_message() {
		if ( is_user_logged_in() && ! defined( 'WOODMART_CORE_PLUGIN_VERSION' ) || ( defined( 'WOODMART_CORE_PLUGIN_VERSION' ) && version_compare( WOODMART_CORE_PLUGIN_VERSION, WOODMART_CORE_VERSION, '<' ) ) ) {
			wp_add_inline_style( 'woodmart-inline-css', '.woodmart-core-message {
			position: fixed;
			bottom: 20px;
			left: 20px;
			right: 20px;
			z-index: 100;
			background: #FFFDB2;
			padding: 30px;
			border-radius: 10px;
			max-width: 100%;
			max-width: 800px;
			color: #A39C18;
			-webkit-box-shadow: 0 0 3px rgba(0, 0, 0, 0.15);
			box-shadow: 0 0 3px rgba(0, 0, 0, 0.15); }
			.woodmart-core-message a {
			color: #6B6710;
			font-weight: bold; }
			.woodmart-core-message a:hover {
			color: #6B6710;
			text-decoration: underline; }' );

			echo '<div class="woodmart-core-message">You just installed the latest version of the WoodMart theme. To finish the installation and enable all theme\'s function  or if you see any problems with your WPBakery elements displayed as shortcodes you need to install the latest version of theWoodMart Core Plugin too. Go to <a href=' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '>Appearance -> Install plugins</a> and click on "Install" or "Update" button.</div>';	
		}
	}
	
	add_filter( 'wp_footer', 'woodmart_core_outdated_message', 10 );
}

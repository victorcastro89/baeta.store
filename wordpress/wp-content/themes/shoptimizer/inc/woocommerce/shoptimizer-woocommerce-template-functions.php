<?php
/**
 * WooCommerce Template Functions.
 *
 * @package shoptimizer
 */

/**
 * Remove the woocommerce_template_loop_product_link_open() function from the
 * WooCommerce "woocommerce_before_shop_loop_item" action.
 *
 * @see remove_action()
 */
add_action( 'wp_head', 'shoptimizer_remove_woocommerce_template_loop_product_link_open' );
function shoptimizer_remove_woocommerce_template_loop_product_link_open() {
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
}
/**
 * Attach our own function to use in place of the woocommerce_template_loop_product_link_open() function to
 * the WooCommerce "woocommerce_before_shop_loop_item" action.
 *
 * @see get_the_permalink()
 */
add_action( 'woocommerce_before_shop_loop_item', 'shoptimizer_template_loop_product_link_open', 20 );
function shoptimizer_template_loop_product_link_open() {
	echo '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
}


/**
 * Add mobile only single product details above the image.
 */
add_action( 'woocommerce_before_single_product_summary', 'shoptimizer_mobile_single_product_summary_open', 7 );
function shoptimizer_mobile_single_product_summary_open() {
	echo '<div class="mobile-summary">';
}

add_action( 'woocommerce_before_single_product_summary', 'shoptimizer_mobile_single_product_summary_close', 15 );
function shoptimizer_mobile_single_product_summary_close() {
	echo '</div>';
}


/**
 * After WooCommerce Category Content
 * Adds an additional textarea field when editing a category - outputted at the bottom of the page.
 *
 * @since   1.0.0
 * @return  void
 */

add_action( 'product_cat_add_form_fields', 'shoptimizer_taxonomy_add_new_meta_field', 10, 2 );

function shoptimizer_taxonomy_add_new_meta_field() {
	?>
	<div class="form-field">
	<label for="term_meta[custom_term_meta]"><?php _e( 'Below Category Content', 'shoptimizer' ); ?></label>
	<textarea name="term_meta[custom_term_meta]" id="term_meta[custom_term_meta]" rows="5" cols="40"></textarea>
	<p class="description"><?php _e( 'Detailed category information which appears below the product list', 'shoptimizer' ); ?></p>
	</div>
	<?php
}

add_action( 'product_cat_edit_form_fields', 'shoptimizer_taxonomy_edit_meta_field', 10, 2 );

function shoptimizer_taxonomy_edit_meta_field( $term ) {

	$t_id = $term->term_id;

	$term_meta = get_option( "taxonomy_$t_id" );
	$content   = $term_meta['custom_term_meta'] ? wp_kses_post( $term_meta['custom_term_meta'] ) : '';
	$settings  = array(
		'textarea_name' => 'term_meta[custom_term_meta]',
	);
	?>
	<tr class="form-field">
	<th scope="row" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Below Category Content', 'shoptimizer' ); ?></label></th>
	<td>
		<?php wp_editor( $content, 'product_cat_details', $settings ); ?>
	  <p class="description"><?php _e( 'Detailed category information which appears below the product list', 'shoptimizer' ); ?></p>
	</td>
	</tr>
	<?php
}

add_action( 'edited_product_cat', 'shoptimizer_save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_product_cat', 'shoptimizer_save_taxonomy_custom_meta', 10, 2 );

function shoptimizer_save_taxonomy_custom_meta( $term_id ) {
	if ( isset( $_POST['term_meta'] ) ) {
		$t_id      = $term_id;
		$term_meta = get_option( "taxonomy_$t_id" );
		$cat_keys  = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset( $_POST['term_meta'][ $key ] ) ) {
				$term_meta[ $key ] = wp_kses_post( stripslashes( $_POST['term_meta'][ $key ] ) );
			}
		}
		update_option( "taxonomy_$t_id", $term_meta );
	}
}

add_action( 'woocommerce_after_shop_loop', 'shoptimizer_product_category_archive_add_meta', 40 );

function shoptimizer_product_category_archive_add_meta() {

	if ( is_product_category() ) {

		  $t_id              = get_queried_object()->term_id;
		  $term_meta         = get_option( "taxonomy_$t_id" );
		  $term_meta_content = $term_meta['custom_term_meta'];
		if ( $term_meta_content != '' ) {
			echo '<div class="below-woocommerce-category">';
			echo apply_filters( 'wpautop', $term_meta_content );
			echo '</div>';
		}
	}

}

/**
 * After WooCommerce Shop Loop
 * Adds support for YITH Wishlist functionality
 *
 * @since   1.0.0
 * @return  void
 */
add_action( 'woocommerce_after_shop_loop_item', 'shoptimizer_display_yith_wishlist_loop', 97 );

function shoptimizer_display_yith_wishlist_loop() {
	if ( class_exists( 'YITH_WCWL_Shortcode' ) ) {
		echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	}
}

if ( ! function_exists( 'shoptimizer_before_content' ) ) {
	/**
	 * Before Content
	 * Wraps all WooCommerce content in wrappers which match the theme markup
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function shoptimizer_before_content() {
		?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_after_content' ) ) {
	/**
	 * After Content
	 * Closes the wrapping divs
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function shoptimizer_after_content() {
		?>
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php
		do_action( 'shoptimizer_sidebar' );
	}
}

if ( ! function_exists( 'shoptimizer_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments
	 * Ensure cart contents update when products are added to the cart via AJAX
	 *
	 * @param  array $fragments Fragments to refresh via AJAX.
	 * @return array            Fragments to refresh via AJAX
	 */
	function shoptimizer_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		shoptimizer_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

if ( ! function_exists( 'shoptimizer_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function shoptimizer_cart_link() {
		?>
		
			<div class="cart-click">
				<a class="cart-contents" href="#" title="<?php esc_attr_e( 'View your shopping cart', 'shoptimizer' ); ?>">
				<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo wp_kses_data( sprintf( _n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'shoptimizer' ), WC()->cart->get_cart_contents_count() ) ); ?></span>
				</a>
			</div>
		
		<?php
	}
}

if ( ! function_exists( 'shoptimizer_product_search' ) ) {
	/**
	 * Display Product Search
	 *
	 * @since  1.0.0
	 * @uses  shoptimizer_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function shoptimizer_product_search() {
		if ( shoptimizer_is_woocommerce_activated() ) {
			$shoptimizer_layout_search_display = '';
			$shoptimizer_layout_search_display = shoptimizer_get_option( 'shoptimizer_layout_search_display' );
			?>
			<?php if ( 'enable' === $shoptimizer_layout_search_display ) { ?>
			<div class="site-search">
				<?php the_widget( 'WC_Widget_Product_Search', 'title=' ); ?>
			</div>
			<?php } ?>
			<?php
		}
	}
}

if ( ! function_exists( 'shoptimizer_header_cart' ) ) {
	/**
	 * Display Header Cart
	 *
	 * @since  1.0.0
	 * @uses  shoptimizer_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function shoptimizer_header_cart() {
		$shoptimizer_layout_woocommerce_display_cart = '';
		$shoptimizer_layout_woocommerce_display_cart = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_display_cart' );
		if ( shoptimizer_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
			<?php if ( true === $shoptimizer_layout_woocommerce_display_cart ) { ?>
		<ul id="site-header-cart" class="site-header-cart menu">
			<li>
				<?php shoptimizer_cart_link(); ?>
			</li>
		</ul>
		<?php } ?>
			<?php
		}
	}
}

if ( ! function_exists( 'shoptimizer_header_cart_drawer' ) ) {
	/**
	 * Display Header Cart Drawer
	 *
	 * @since  1.0.0
	 * @uses  shoptimizer_is_woocommerce_activated() check if WooCommerce is activated
	 * @return void
	 */
	function shoptimizer_header_cart_drawer() {
		if ( shoptimizer_is_woocommerce_activated() ) {
			if ( is_cart() ) {
				$class = 'current-menu-item';
			} else {
				$class = '';
			}
			?>
		<div class="shoptimizer-mini-cart-wrap">
			<div id="ajax-loading">
				<div class="shoptimizer-loader">
					<div class="spinner">
					<div class="bounce1"></div>
					<div class="bounce2"></div>
					<div class="bounce3"></div>
					</div>
				</div>
			</div>
			<div class="close-drawer"></div><?php the_widget( 'WC_Widget_Cart', 'title=' ); ?></div>	
			<?php
		}
	}
}

if ( ! function_exists( 'shoptimizer_upsell_display' ) ) {
	/**
	 * Upsells
	 * Replace the default upsell function with our own which displays the correct number product columns
	 *
	 * @since   1.0.0
	 * @return  void
	 * @uses    woocommerce_upsell_display()
	 */
	function shoptimizer_upsell_display() {
		$columns = apply_filters( 'shoptimizer_upsells_columns', 3 );
		woocommerce_upsell_display( -1, $columns );
	}
}

if ( ! function_exists( 'shoptimizer_sorting_wrapper' ) ) {
	/**
	 * Sorting wrapper
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function shoptimizer_sorting_wrapper() {
		echo '<div class="shoptimizer-sorting">';
	}
}

if ( ! function_exists( 'shoptimizer_sorting_wrapper_close' ) ) {
	/**
	 * Sorting wrapper close
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function shoptimizer_sorting_wrapper_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'shoptimizer_product_columns_wrapper' ) ) {
	/**
	 * Product columns wrapper
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function shoptimizer_product_columns_wrapper() {
		$columns = shoptimizer_loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';
	}
}

if ( ! function_exists( 'shoptimizer_loop_columns' ) ) {
	/**
	 * Default loop columns on product archives
	 *
	 * @return integer products per row
	 * @since  1.0.0
	 */
	function shoptimizer_loop_columns() {
		$columns = 3;

		if ( function_exists( 'wc_get_default_products_per_row' ) ) {
			$columns = wc_get_default_products_per_row();
		}

		return apply_filters( 'shoptimizer_loop_columns', $columns );
	}
}

if ( ! function_exists( 'shoptimizer_product_columns_wrapper_close' ) ) {
	/**
	 * Product columns wrapper close
	 *
	 * @since   1.0.0
	 * @return  void
	 */
	function shoptimizer_product_columns_wrapper_close() {
		echo '</div>';
	}
}

if ( ! function_exists( 'shoptimizer_shop_messages' ) ) {
	/**
	 * Shoptimizer shop messages
	 *
	 * @since   1.0.0
	 */
	function shoptimizer_shop_messages() {
		if ( ! is_checkout() ) {
			echo wp_kses_post( shoptimizer_do_shortcode( 'woocommerce_messages' ) );
		}
	}
}

if ( ! function_exists( 'shoptimizer_woocommerce_pagination' ) ) {
	/**
	 * Shoptimizer WooCommerce Pagination
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_woocommerce_pagination() {
		if ( woocommerce_products_will_display() ) {
			woocommerce_pagination();
		}
	}
}

/**
 * Change Reviews tab title.
 */
function shoptimizer_woocommerce_reviews_tab_title( $title ) {
	$title = strtr(
		$title, array(
			'(' => '<span>',
			')' => '</span>',
		)
	);

	return $title;
}
add_filter( 'woocommerce_product_reviews_tab_title', 'shoptimizer_woocommerce_reviews_tab_title' );


/**
 * Display discounted % on product loop.
 */
add_filter( 'woocommerce_get_price_html', 'shoptimizer_change_displayed_sale_price_html', 10, 2 );
function shoptimizer_change_displayed_sale_price_html( $price, $product ) {

	// Only on sale products on frontend and excluding min/max price on variable products
	if ( $product->is_on_sale() && ! is_admin() && ! $product->is_type( 'variable' ) && ! $product->is_type( 'grouped' ) ) {
		// Get product prices
		$regular_price = (float) $product->get_regular_price(); // Regular price
		$sale_price    = (float) $product->get_price(); // Active price (the "Sale price" when on-sale)

		// "Saving Percentage" calculation and formatting
		$precision         = 0; // Max number of decimals
		$saving_percentage = round( 100 - ( $sale_price / $regular_price * 100 ), 0 ) . '%';

		// Append to the formated html price
		$price .= sprintf( __( '<span class="sale-item product-label">-%s</span>', 'shoptimizer' ), $saving_percentage );
	}
	return $price;
}


/**
 * Within Product Loop - remove title hook and create a new one with the category displayed above it.
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'shoptimizer_loop_product_title', 10 );

function shoptimizer_loop_product_title() {

	global $post;

	$shoptimizer_layout_woocommerce_display_category = '';
	$shoptimizer_layout_woocommerce_display_category = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_display_category' );

	$terms = get_the_terms( $post->ID, 'product_cat' );
	if ( $terms && ! is_wp_error( $terms ) ) :
		$shoptimizer_cat_links = array();
		foreach ( $terms as $term ) {
			$shoptimizer_cat_links[] = '<a href="' . esc_url( home_url() ) . '/product-category/' . $term->slug . '">' . $term->name . '</a>';
		}
		$shoptimizer_on_cat = join( ', ', $shoptimizer_cat_links );
		?>
		<?php if ( true === $shoptimizer_layout_woocommerce_display_category ) { ?>
		<h6><?php echo shoptimizer_safe_html( $shoptimizer_on_cat ); ?></h6>
		<?php } ?>
		<?php
		echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
endif;
}


/**
 * Single Product Page - Previous/Next hover feature.
 */
add_action( 'woocommerce_single_product_summary', 'shoptimizer_prev_next_product', 0 );

function shoptimizer_prev_next_product() {

		$shoptimizer_layout_woocommerce_prev_next_display = '';
		$shoptimizer_layout_woocommerce_prev_next_display = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_prev_next_display' );

		$shoptimizer_next = get_next_post();
		$shoptimizer_prev = get_previous_post();

		$shoptimizer_next = ( ! empty( $shoptimizer_next ) ) ? wc_get_product( $shoptimizer_next->ID ) : false;
		$shoptimizer_prev = ( ! empty( $shoptimizer_prev ) ) ? wc_get_product( $shoptimizer_prev->ID ) : false;

	?>
		<?php if ( true === $shoptimizer_layout_woocommerce_prev_next_display ) { ?>
			<div class="shoptimizer-product-prevnext">


				<?php if ( ! empty( $shoptimizer_prev ) ) : ?>
				
					<a href="<?php echo esc_url( $shoptimizer_prev->get_permalink() ); ?>"><span class="icon ri ri-chevron-left-circle"></span>
					<div class="tooltip">
						<?php echo shoptimizer_safe_html( $shoptimizer_prev->get_image() ); ?>
						<span class="title"><?php echo shoptimizer_safe_html( $shoptimizer_prev->get_title() ); ?></span>
						<span class="price"><?php echo shoptimizer_safe_html( $shoptimizer_prev->get_price_html() ); ?></span>								
					</div>
					</a>
				
				<?php endif ?>

				<?php if ( ! empty( $shoptimizer_next ) ) : ?>

					<a href="<?php echo esc_url( $shoptimizer_next->get_permalink() ); ?>"><span class="icon ri ri-chevron-right-circle"></span>
					<div class="tooltip">
						<?php echo shoptimizer_safe_html( $shoptimizer_next->get_image() ); ?>
						<span class="title"><?php echo shoptimizer_safe_html( $shoptimizer_next->get_title() ); ?></span>
						<span class="price"><?php echo shoptimizer_safe_html( $shoptimizer_next->get_price_html() ); ?></span>							
					</div>
					</a>
				
				<?php endif ?>

			</div>
			

			<?php
}
}

		/**
		 * Single Product Page - Call me back feature.
		 */
		add_action( 'woocommerce_single_product_summary', 'shoptimizer_call_back_feature', 80 );

function shoptimizer_call_back_feature() {

	$shoptimizer_layout_floating_button_display = '';
	$shoptimizer_layout_floating_button_display = shoptimizer_get_option( 'shoptimizer_layout_floating_button_display' );

	$shoptimizer_layout_floating_button_text = shoptimizer_get_option( 'shoptimizer_layout_floating_button_text' );

	if ( 'yes' === $shoptimizer_layout_floating_button_display ) {

		wp_enqueue_script( 'shoptimizer-bootstrap-modal', get_template_directory_uri() . '/assets/js/bootstrap.modal.min.js', array( 'jquery' ), '20161206', true );

		echo '<div class="call-back-feature"><a href="#" data-toggle="modal" data-target="#callBackModal">';

		echo shoptimizer_safe_html( $shoptimizer_layout_floating_button_text );

		echo '</a></div>';
		echo '
	<div class="modal fade" id="callBackModal" tabindex="-1" role="dialog" aria-labelledby="callBackModal" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
			</button>
		  </div>
		  <div class="modal-body">';

		  dynamic_sidebar( 'floating-button-content' );

		  echo '
		  </div>
		
		</div>
	  </div>
	</div>
	';
	}
}

if ( ! function_exists( 'shoptimizer_sticky_single_add_to_cart' ) ) {
	/**
	 * Sticky Add to Cart
	 *
	 * @since 1.0.0
	 */
	function shoptimizer_sticky_single_add_to_cart() {

		$shoptimizer_layout_woocommerce_sticky_cart_display = '';
		$shoptimizer_layout_woocommerce_sticky_cart_display = shoptimizer_get_option( 'shoptimizer_layout_woocommerce_sticky_cart_display' );

		global $product;

		?>
		
			<?php if ( true === $shoptimizer_layout_woocommerce_sticky_cart_display ) { ?>

					<?php
					$shoptimizer_sticky_addtocart_js  = '';
					$shoptimizer_sticky_addtocart_js .= "
			( function ( $ ) {
				'use strict';
				 var initialTopOffset = $('.shoptimizer-archive').offset().top;
					$(window).scroll(function(event) {
					  var scroll = $(window).scrollTop();

					  if (scroll + initialTopOffset >= $('.site-main').offset().top && scroll + initialTopOffset <= $('.site-main').offset().top + $('.site-main').outerHeight()) {
					    $('.shoptimizer-sticky-add-to-cart').addClass('visible'); 
					  } else {
					    $('.shoptimizer-sticky-add-to-cart').removeClass('visible');
					  }
					});


				$(window).scroll(); 

			}( jQuery ) );
		";

					wp_add_inline_script( 'shoptimizer-main', $shoptimizer_sticky_addtocart_js );

					?>

				<?php if ( $product->is_in_stock() ) { ?>
			<section class="shoptimizer-sticky-add-to-cart">
				<div class="col-full">
					<div class="shoptimizer-sticky-add-to-cart__content">
						<?php echo wp_kses_post( woocommerce_get_product_thumbnail() ); ?>
						<div class="shoptimizer-sticky-add-to-cart__content-product-info">
							<span class="shoptimizer-sticky-add-to-cart__content-title"><?php the_title(); ?>
							</span>	
						</div>

						<div class="shoptimizer-sticky-add-to-cart__content-button">
							<span class="shoptimizer-sticky-add-to-cart__content-price"><?php echo shoptimizer_safe_html( $product->get_price_html() ); ?></span>

						<?php if ( $product->is_type( 'variable' ) || $product->is_type( 'grouped' ) ) { ?>
							<a href="#main" class="variable-grouped-sticky button">
								<?php echo esc_attr__( 'Select options', 'shoptimizer' ); ?>
							</a>
						<?php } else { ?>
										
							<a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" class="button">							
								<?php echo esc_attr( $product->single_add_to_cart_text() ); ?>
							</a>

						<?php } ?>
						</div>
					</div>
				</div>
			</section>

					<?php
}
}// End if().
?>
		<?php
	}
}// End if().

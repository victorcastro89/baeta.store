<?php 
	global $product;


	do_action( 'woocommerce_before_shop_loop_item' ); 
?>

<div class="product-element-top">
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="product-image-link">
		<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woodmart_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
	</a>
	<?php woodmart_hover_image(); ?>
	<div class="woodmart-buttons">
		<?php if( class_exists('YITH_WCWL_Shortcode')) woodmart_wishlist_btn(); ?>
		<?php woodmart_compare_btn(); ?>
		<?php woodmart_quick_view_btn( get_the_ID() ); ?>
	</div>

	<div class="woodmart-add-btn">
		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
	<?php woodmart_quick_shop_wrapper(); ?>
</div>
<?php 
	echo woodmart_swatches_list();
?>
<?php
	/**
	 * woocommerce_shop_loop_item_title hook
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */
	do_action( 'woocommerce_shop_loop_item_title' );
?>

<?php
	woodmart_product_categories();
	woodmart_product_brands_links();
?>

<?php
	/**
	 * woocommerce_after_shop_loop_item_title hook
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */
	do_action( 'woocommerce_after_shop_loop_item_title' );
?>

<?php if ( woodmart_loop_prop( 'progress_bar' ) ): ?>
	<?php woodmart_stock_progress_bar(); ?>
<?php endif ?>

<?php if ( woodmart_loop_prop( 'timer' ) ): ?>
	<?php woodmart_product_sale_countdown(); ?>
<?php endif ?>
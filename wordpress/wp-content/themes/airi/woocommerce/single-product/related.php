<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


if ( $related_products ) : ?>

	<?php

	global $post;

	$product_cols = shortcode_atts(
		array('xlg'=> 1, 'lg'=> 1,'md'=> 1,'sm'=> 1,'xs'=> 1, 'mb' => 1),
		Airi()->settings()->get('related_products_columns')
	);
	$design = Airi()->settings()->get('shop_catalog_grid_style', '1');
	$loopCssClass = array('products','grid-items','la-slick-slider js-el');
	$loopCssClass[] = 'products-grid';
	$loopCssClass[] = 'grid-space-default';
	$loopCssClass[] = 'products-grid-' . $design;
	$slide_configs 	= Airi_Helper::get_slick_slider_config(array_merge(array('arrows' => true), $product_cols));
	$title = Airi()->settings()->get('related_product_title') ? Airi()->settings()->get('related_product_title') : _x( 'Related Products', 'front-view', 'airi' );
	$sub_title = Airi()->settings()->get('related_product_subtitle') ? Airi()->settings()->get('related_product_subtitle') : '';
	?>

	<div class="custom-product-wrap related">
		<div class="custom-product-ul">
			<div class="row block_heading vc_row" data-vc-full-width="true" data-vc-stretch-content="false">
				<div class="col-xs-12">
					<h2 class="block_heading--title"><span><?php echo esc_html($title); ?></span></h2>
					<?php if(!empty($sub_title)): ?><div class="block_heading--subtitle"><?php echo esc_html($sub_title); ?></div><?php endif; ?>
				</div>
			</div>
			<div class="vc_row-full-width vc_clearfix"></div>
			<div class="row">
				<div class="col-xs-12">
					<ul class="<?php echo esc_attr(implode(' ', $loopCssClass)) ?>" data-la_component="AutoCarousel" data-slider_config="<?php echo esc_attr($slide_configs)?>">

						<?php foreach ( $related_products as $related_product ) : ?>

							<?php
							$post_object = get_post( $related_product->get_id() );

							$post = $post_object;
							setup_postdata($post);

							wc_get_template_part( 'content', 'product' ); ?>

						<?php endforeach; ?>

					</ul>
				</div>
			</div>
		</div>
	</div>
<?php endif;

wp_reset_postdata();
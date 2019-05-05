<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package shoptimizer
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed site">

	<?php
	do_action( 'shoptimizer_before_site' );
	do_action( 'shoptimizer_before_header' );
	?>

	<header id="masthead" class="site-header">
		<div class="col-full topbar-wrapper">
			<?php
			do_action( 'shoptimizer_topbar' );
			?>
		</div>

		<div class="col-full main-header">

			<?php
			/**
			 * Functions hooked into shoptimizer_header action
			 *
			 * @hooked shoptimizer_site_branding                    - 20
			 * @hooked shoptimizer_secondary_navigation             - 30
			 * @hooked shoptimizer_product_search                   - 40
			 */
			do_action( 'shoptimizer_header' );
			?>

		</div>

		<div class="col-full">

			<?php
			/**
			 * Functions hooked into shoptimizer_header action
			 *
			 * @hooked shoptimizer_primary_navigation_wrapper       - 42
			 * @hooked shoptimizer_primary_navigation               - 50
			 * @hooked shoptimizer_header_cart                      - 60
			 * @hooked shoptimizer_primary_navigation_wrapper_close - 68
			 */
			do_action( 'shoptimizer_navigation' );
			?>

		</div>
	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to shoptimizer_before_content
	 *
	 * @hooked shoptimizer_header_widget_region - 10
	 */
	do_action( 'shoptimizer_before_content' );
	?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="shoptimizer-archive">

		<div class="archive-header">
			<div class="col-full">
				<?php
				/**
				 * Functions hooked in to shoptimizer_content_top
				 *
				 * @hooked woocommerce_breadcrumb - 10
				 */
				do_action( 'shoptimizer_content_top' );
				?>
			</div>
		</div>

		<div class="col-full">

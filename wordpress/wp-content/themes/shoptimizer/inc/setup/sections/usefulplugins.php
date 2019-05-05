<?php
/**
 * Getting started template
 *
 * @package CommerceGurus
 * @subpackage Shoptimizer
 */

$customizer_url = admin_url() . 'customize.php';
?>

<div id="usefulplugins" class="ccfw-tab-pane">

	<div class="ccfw-tab-pane-center">

		<h1 class="ccfw-welcome-title"><?php esc_html_e( 'Useful Plugins', 'shoptimizer' ); ?></h1>
		<h2><?php esc_html_e( 'Enhance your store with these useful plugins for Shoptimizer. Just search the "Plugins" section of WordPress for the name, then install and activate. You will need to consult the plugin documentation of each for setup instructions.', 'shoptimizer' ); ?></h2>
		<br/>
		<table class="useful-table">

			<tbody>
				<tr>
					<td class="image">
						<img width="100" alt="Autoptimize" src="<?php echo get_template_directory_uri() . '/inc/setup/images/autoptimize.png'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'Autoptimize', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Optimizes your website, concatenating the CSS and JavaScript code, and compressing it.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/autoptimize/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="Jetpack" src="<?php echo get_template_directory_uri() . '/inc/setup/images/jetpack.svg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'Jetpack', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'The popular plugin from Automattic has some useful features worth enabling, including lazy load and  photon for quicker page loading times. We are also using the related posts module on our demo site.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/jetpack/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="MailChimp for WordPress" src="<?php echo get_template_directory_uri() . '/inc/setup/images/mailchimp.png'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'MailChimp for WordPress', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Allows visitors to subscribe to your newsletters easily. Requires a free MailChimp account.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/mailchimp-for-wp/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="Smart WooCommerce Search" src="<?php echo get_template_directory_uri() . '/inc/setup/images/smartsearch.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'Smart WooCommerce Search', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Provides instant search results for your WooCommerce website when a user types some characters.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/smart-woocommerce-search/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="Woo Advanced Product Size Chart" src="<?php echo get_template_directory_uri() . '/inc/setup/images/sizeguide.png'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'Woo Advanced Product Size Chart', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Add product size charts with default template or custom size chart to any of your WooCommerce products.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/woo-advanced-product-size-chart/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="WooCommerce Product Tabs" src="<?php echo get_template_directory_uri() . '/inc/setup/images/tabs.svg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'WooCommerce Product Tabs', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Helps you add your own custom tabs to the product page in WooCommerce.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce-product-tabs/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="Variation Swatches for WooCommerce" src="<?php echo get_template_directory_uri() . '/inc/setup/images/swatches.png'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'Variation Swatches for WooCommerce', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'A much nicer way to display variations of variable products. This plugin will help you select a style for each attribute as a color, image or label.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/variation-swatches-for-woocommerce/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="Yeloni Exit Popup" src="<?php echo get_template_directory_uri() . '/inc/setup/images/yeloni.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'Yeloni Exit Popup', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Adds high converting widgets on your website – either when a user is leaving the website, after a specified time duration, after the visitor scrolls, or when the visitor reaches the bottom of the page.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/yeloni-free-exit-popup/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="YITH WooCommerce Ajax Product Filter" src="<?php echo get_template_directory_uri() . '/inc/setup/images/yithfilter.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'YITH WooCommerce Ajax Product Filter', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Choose among color, label, list, and dropdown and the filters will display those specific products immediately on the listings page.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/yith-woocommerce-ajax-navigation/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>
				<tr>
					<td class="image">
						<img width="100" alt="YITH WooCommerce Waiting List" src="<?php echo get_template_directory_uri() . '/inc/setup/images/yithwaiting.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image">
					</td>
					<td>
						<h3><?php esc_html_e( 'YITH WooCommerce Waiting List', 'shoptimizer' ); ?></h3>
						<p><?php esc_html_e( 'Allow users to request an email notification when an out-of-stock product comes back into stock.', 'shoptimizer' ); ?></p>
					</td>
					<td class="link">
						<a class="button-primary" target="_blank" href="<?php echo esc_url( 'https://wordpress.org/plugins/yith-woocommerce-waiting-list/' ); ?>"><?php esc_html_e( 'More information', 'shoptimizer' ); ?></a>
					</td>
				</tr>

				</tbody>

				</table>

	</div>

	<div class="ccfw-clear"></div>

</div>

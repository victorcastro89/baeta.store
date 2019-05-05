<?php
/**
 *
 * Color theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Color fields.
$shoptimizer_default_options = shoptimizer_get_option_defaults();

// General colors.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'color',
		'settings'    => 'shoptimizer_color_general_swatch',
		'label'       => esc_html__( 'Primary swatch color', 'shoptimizer' ),
		'description' => esc_html__( 'Select the primary color of your brand.', 'shoptimizer' ),
		'section'     => 'shoptimizer_color_section_general',
		'default'     => $shoptimizer_default_options['shoptimizer_color_general_swatch'],
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => 'body .price ins, body .summary .yith-wcwl-add-to-wishlist a:before, 
				body ul.products li.product .yith-wcwl-wishlistexistsbrowse a:before,
				body ul.products li.product .yith-wcwl-wishlistaddedbrowse a:before,
				body .summary .button-wrapper.shoptimizer-size-guide a:before, body ul.products li.product .yith-wcwl-add-button a:before,
				body .widget-area .widget.widget_categories a:hover, #secondary .widget ul li a:hover,
			.widget-area .widget li.chosen a, .widget-area .widget a:hover, #secondary .widget_recent_comments ul li a:hover,
			body .woocommerce-pagination .page-numbers li .page-numbers.current, body.single-product div.product p.price,
			body .main-navigation ul.menu li.full-width.menu-item-has-children ul li.highlight > a,
			body .main-navigation ul.menu li.full-width.menu-item-has-children ul li.highlight > a:hover',
				'property' => 'color',
			),
			array(
				'element'  => '.spinner > div, body .widget_price_filter .ui-slider .ui-slider-range, body .widget_price_filter .ui-slider .ui-slider-handle, #page .woocommerce-tabs ul.tabs li span,
			#secondary.widget-area .widget .tagcloud a:hover, .widget-area .widget.widget_product_tag_cloud a:hover,
			footer .mc4wp-form input[type="submit"], 
			#payment .payment_methods li.woocommerce-PaymentMethod > input[type=radio]:first-child:checked + label:before, 
			#payment .payment_methods li.wc_payment_method > input[type=radio]:first-child:checked + label:before,
			#shipping_method > li > input[type=radio]:first-child:checked + label:before, .image-border .elementor-image:after,
			ul.checkout-bar:before, .woocommerce-checkout .checkout-bar li.active:after, ul.checkout-bar li.visited:after',
				'property' => 'background-color',
			),
			array(
				'element'  => '#payment .payment_methods li.woocommerce-PaymentMethod > input[type=radio]:first-child:checked + label:before, 
			#payment .payment_methods li.wc_payment_method > input[type=radio]:first-child:checked + label:before,
			#shipping_method > li > input[type=radio]:first-child:checked + label:before',
				'property' => 'border-color',
			),

		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'body .price ins, body .summary .yith-wcwl-add-to-wishlist a:before,
				body ul.products li.product .yith-wcwl-wishlistexistsbrowse a:before,
				body ul.products li.product .yith-wcwl-wishlistaddedbrowse a:before,
				body .summary .button-wrapper.shoptimizer-size-guide a:before, body ul.products li.product .yith-wcwl-add-button a:before,
				body .widget-area .widget.widget_categories a:hover, #secondary .widget ul li a:hover,
			.widget-area .widget li.chosen a, .widget-area .widget a:hover, #secondary .widget_recent_comments ul li a:hover,
			body .woocommerce-pagination .page-numbers li .page-numbers.current, body.single-product div.product p.price,
			body .main-navigation ul.menu li.full-width.menu-item-has-children ul li.highlight > a,
			body .main-navigation ul.menu li.full-width.menu-item-has-children ul li.highlight > a:hover',
				'property' => 'color',
			),
			array(
				'element'  => '.spinner > div, body .widget_price_filter .ui-slider .ui-slider-range, body .widget_price_filter .ui-slider .ui-slider-handle,
			#secondary.widget-area .widget .tagcloud a:hover, .widget-area .widget.widget_product_tag_cloud a:hover,
			footer .mc4wp-form input[type="submit"], #page .woocommerce-tabs ul.tabs li span,
			#payment .payment_methods li.woocommerce-PaymentMethod > input[type=radio]:first-child:checked + label:before, 
			#payment .payment_methods li.wc_payment_method > input[type=radio]:first-child:checked + label:before,
			#shipping_method > li > input[type=radio]:first-child:checked + label:before, .image-border .elementor-image:after,
			ul.checkout-bar:before, .woocommerce-checkout .checkout-bar li.active:after, ul.checkout-bar li.visited:after',
				'property' => 'background-color',
			),
			array(
				'element'  => '#payment .payment_methods li.woocommerce-PaymentMethod > input[type=radio]:first-child:checked + label:before, 
			#payment .payment_methods li.wc_payment_method > input[type=radio]:first-child:checked + label:before,
			#shipping_method > li > input[type=radio]:first-child:checked + label:before',
				'property' => 'border-color',
			),

		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_color_general_links',
		'label'     => esc_html__( 'General links', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_general',
		'default'   => $shoptimizer_default_options['shoptimizer_color_general_links'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.entry-content article a:not(.elementor-button), .below-woocommerce-category a',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'.entry-content article a:not(.elementor-button), .below-woocommerce-category a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_color_general_links_hover',
		'label'     => esc_html__( 'General links hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_general',
		'default'   => $shoptimizer_default_options['shoptimizer_color_general_links_hover'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.entry-content a:hover, .below-woocommerce-category a:hover',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.entry-content a:hover, .below-woocommerce-category a:hover',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Body background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'color',
		'settings'    => 'shoptimizer_color_body_bg',
		'label'       => esc_html__( 'Body background color', 'shoptimizer' ),
		'description' => esc_html__( 'Visible if the grid is contained.', 'shoptimizer' ),
		'section'     => 'shoptimizer_color_section_general',
		'default'     => $shoptimizer_default_options['shoptimizer_color_body_bg'],
		'priority'    => 10,
		'output'      => array(
			array(
				'element'  => 'body',
				'property' => 'background-color',
			),
		),
		'transport'   => 'postMessage',
		'js_vars'     => array(
			array(
				'element'  => 'body',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Top Bar background.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_layout_top_bar_background',
		'label'     => esc_html__( 'Top bar background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_topbar',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_top_bar_background'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.col-full.topbar-wrapper',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.col-full.topbar-wrapper',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Top Bar text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_layout_top_bar_text',
		'label'     => esc_html__( 'Top Bar text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_topbar',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_top_bar_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.top-bar, .top-bar a',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.top-bar, .top-bar a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Top Bar border.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_layout_top_bar_border',
		'label'     => esc_html__( 'Top bar border', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_topbar',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_top_bar_border'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.col-full.topbar-wrapper',
				'property' => 'border-bottom-color',
			),
		),
		'transport' => 'postMessage',
		'choices'   => array(
			'alpha' => true,
		),
		'js_vars'   => array(
			array(
				'element'  => '.col-full.topbar-wrapper',
				'function' => 'css',
				'property' => 'border-bottom-color',
			),
		),
	)
);

// Header Background Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_header_bg_color',
		'label'     => esc_html__( 'Header background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_header_bg_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.site-header',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-header',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Header Border Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_header_border_color',
		'label'     => esc_html__( 'Header border color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_header',
		'default'   => $shoptimizer_default_options['shoptimizer_header_border_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.fa.menu-item, .ri.menu-item',
				'property' => 'border-left-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.fa.menu-item, .ri.menu-item',
				'function' => 'css',
				'property' => 'border-left-color',
			),
		),
	)
);


// Navigation Background Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_bg_color',
		'label'     => esc_html__( 'Navigation background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_bg_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'     => '.shoptimizer-primary-navigation',
				'function'    => 'css',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 992px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.shoptimizer-primary-navigation',
				'function'    => 'css',
				'property'    => 'background-color',
				'media_query' => '@media (min-width: 992px)',
			),
		),
	)
);

// Below header background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_below_header_bg',
		'label'     => esc_html__( 'Below header background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_below_header',
		'default'   => $shoptimizer_default_options['shoptimizer_below_header_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.header-widget-region',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.header-widget-region',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Below header text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_below_header_text',
		'label'     => esc_html__( 'Below header text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_below_header',
		'default'   => $shoptimizer_default_options['shoptimizer_below_header_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.header-widget-region',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.header-widget-region',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_1',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Primary Button', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// WooCommerce primary button text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_woocommerce_button_text',
		'label'     => esc_html__( 'Primary button text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_woocommerce_button_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '
			body .woocommerce #respond input#submit.alt, 
			body .woocommerce a.button.alt, 
			body .woocommerce button.button.alt, 
			body .woocommerce input.button.alt,
			.product .cart .single_add_to_cart_button,
			.shoptimizer-sticky-add-to-cart__content-button a.button,
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout,
			body ul.products li.product .button,
			.woocommerce-cart p.return-to-shop a,
			.site-main input[type="submit"],
			.site-main div.wpforms-container-full .wpforms-form input[type=submit], 
			.site-main div.wpforms-container-full .wpforms-form button[type=submit],
			.entry-content .feature a',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '
			body .woocommerce #respond input#submit.alt, 
			body .woocommerce a.button.alt, 
			body .woocommerce button.button.alt, 
			body .woocommerce input.button.alt,
			.product .cart .single_add_to_cart_button,
			.shoptimizer-sticky-add-to-cart__content-button a.button,
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout,
			body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.button, 
			body ul.products li.product .button, body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart, 
			body ul.products li.product .added_to_cart,
			.woocommerce-cart p.return-to-shop a,
			.site-main input[type="submit"],
			.site-main div.wpforms-container-full .wpforms-form input[type=submit], 
			.site-main div.wpforms-container-full .wpforms-form button[type=submit],
			.entry-content .feature a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// WooCommerce primary button background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_woocommerce_button_bg',
		'label'     => esc_html__( 'Primary button background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_woocommerce_button_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '
			body .woocommerce #respond input#submit.alt, 
			body .woocommerce a.button.alt, 
			body .woocommerce button.button.alt, 
			body .woocommerce input.button.alt,
			.product .cart .single_add_to_cart_button,
			.shoptimizer-sticky-add-to-cart__content-button a.button,
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout,
			body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.button, 
			body ul.products li.product .button, body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart, 
			body ul.products li.product .added_to_cart,
			.woocommerce-cart p.return-to-shop a,
			.site-main input[type="submit"],
			.site-main div.wpforms-container-full .wpforms-form input[type=submit], 
			.site-main div.wpforms-container-full .wpforms-form button[type=submit],
			.entry-content .feature a',
				'property' => 'background-color',
			),
			array(
				'element'  => '
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout',
				'property' => 'border-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '
			body .woocommerce #respond input#submit.alt, 
			body .woocommerce a.button.alt, 
			body .woocommerce button.button.alt, 
			body .woocommerce input.button.alt,
			.product .cart .single_add_to_cart_button,
			.shoptimizer-sticky-add-to-cart__content-button a.button,
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout,
			body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.button, 
			body ul.products li.product .button, body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart, 
			body ul.products li.product .added_to_cart,
			.woocommerce-cart p.return-to-shop a,
			.site-main input[type="submit"],
			.site-main div.wpforms-container-full .wpforms-form input[type=submit], 
			.site-main div.wpforms-container-full .wpforms-form button[type=submit],
			.entry-content .feature a',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout',
				'function' => 'css',
				'property' => 'border-color',
			),
		),
	)
);

// WooCommerce primary button background hover color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_woocommerce_button_hover_bg',
		'label'     => esc_html__( 'Primary button background hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_woocommerce_button_hover_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '
			body .woocommerce #respond input#submit.alt:hover, 
			body .woocommerce a.button.alt:hover, 
			body .woocommerce button.button.alt:hover, 
			body .woocommerce input.button.alt:hover,
			.product .cart .single_add_to_cart_button:hover,
			.shoptimizer-sticky-add-to-cart__content-button a.button:hover,
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout:hover,
			body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.button:hover, 
			body ul.products li.product .button:hover, body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart:hover, 
			body ul.products li.product .added_to_cart:hover,
			.woocommerce-cart p.return-to-shop a:hover,
			.site-main input[type="submit"]:hover,
			.site-main div.wpforms-container-full .wpforms-form input[type=submit]:hover, 
			.site-main div.wpforms-container-full .wpforms-form button[type=submit]:hover',

				'property' => 'background-color',
			),
			array(
				'element'  => '
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout:hover',
				'property' => 'border-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '
			body .woocommerce #respond input#submit.alt:hover, 
			body .woocommerce a.button.alt:hover, 
			body .woocommerce button.button.alt:hover, 
			body .woocommerce input.button.alt:hover,
			.product .cart .single_add_to_cart_button:hover,
			.shoptimizer-sticky-add-to-cart__content-button a.button:hover,
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout:hover,
			body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.button:hover, 
			body ul.products li.product .button:hover, body .main-navigation ul.menu li.menu-item-has-children.full-width > .sub-menu-wrapper li a.added_to_cart:hover, 
			body ul.products li.product .added_to_cart:hover,
			.woocommerce-cart p.return-to-shop a:hover,
			.site-main input[type="submit"]:hover,
			.site-main div.wpforms-container-full .wpforms-form input[type=submit]:hover, 
			.site-main div.wpforms-container-full .wpforms-form button[type=submit]:hover',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout:hover',
				'function' => 'css',
				'property' => 'border-color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_2',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Sale Flash', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Sale flash background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_sale_flash_bg',
		'label'     => esc_html__( 'Sale flash background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_sale_flash_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'body .onsale, .product-label',
				'property' => 'background-color',
			),
			array(
				'element'  => '.single-product .content-area .summary .onsale',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'body .onsale, .product-label',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => '.single-product .content-area .summary .onsale',
				'property' => 'color',
			),
		),
	)
);

// Sale flash text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_sale_flash_text',
		'label'     => esc_html__( 'Sale flash text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_sale_flash_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'body .onsale, .product-label',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'body .onsale, .product-label',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_4',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( ' Ratings', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Ratings color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_ratings_color',
		'label'     => esc_html__( 'Star ratings color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_ratings_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.woocommerce .star-rating span:before, .entry-content .testimonial-entry-title:after',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.woocommerce .star-rating span:before, .entry-content .testimonial-entry-title:after',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_5',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( ' Product Archives', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Archive description background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_archives_description_bg',
		'label'     => esc_html__( 'Archive description background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_archives_description_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.tax-product_cat header.woocommerce-products-header',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.tax-product_cat header.woocommerce-products-header',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Archive description text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_archives_text_bg',
		'label'     => esc_html__( 'Archive description text', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_archives_description_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.term-description p',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.term-description p',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_color_woocommerce_heading_6',
		'section'  => 'shoptimizer_color_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( ' Single Product', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Product background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_product_bg',
		'label'     => esc_html__( 'Product container background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_product_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.single-product .site-content .col-full',
				'property' => 'background-color',
			),
			array(
				'element'  => 'body.single-product .woocommerce-message',
				'property' => 'border-bottom-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.single-product .site-content .col-full',
				'function' => 'css',
				'property' => 'background-color',
			),
			array(
				'element'  => 'body.single-product .woocommerce-message',
				'property' => 'border-bottom-color',
			),
		),
	)
);

// Floating button background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_floating_button_bg',
		'label'     => esc_html__( 'Floating button background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_floating_button_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.call-back-feature a',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.call-back-feature a',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);


// Floating button text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_floating_button_text',
		'label'     => esc_html__( 'Floating button text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_floating_button_text'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.call-back-feature a',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.call-back-feature a',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Footer background color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_bg',
		'label'     => esc_html__( 'Footer background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_bg'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);


// Footer heading color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_heading_color',
		'label'     => esc_html__( 'Footer headings color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_heading_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer .widget .widget-title',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer .widget .widget-title',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Footer text color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_color',
		'label'     => esc_html__( 'Footer text color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);


// Footer links color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_links_color',
		'label'     => esc_html__( 'Footer links', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_links_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer a:not(.button)',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer a:not(.button)',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);


// Footer links hover color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_footer_links_hover_color',
		'label'     => esc_html__( 'Footer links hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_links_hover_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'footer a:not(.button):hover',
				'property' => 'color',
			),
			array(
				'element'  => 'footer li a:after',
				'property' => 'border-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'footer a:not(.button):hover',
				'function' => 'css',
				'property' => 'color',
			),
			array(
				'element'  => 'footer li a:after',
				'property' => 'border-color',
			),
		),
	)
);

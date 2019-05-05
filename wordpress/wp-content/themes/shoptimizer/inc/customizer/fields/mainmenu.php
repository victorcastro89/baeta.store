<?php
/**
 *
 * Main menu theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Main Menu.
$shoptimizer_default_options = shoptimizer_get_option_defaults();

// Display top bar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_layout_top_bar_display',
		'label'       => esc_html__( 'Display top bar?', 'shoptimizer' ),
		'description' => esc_html__( 'Enable or disable the top bar', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_top_bar',
		'default'     => $shoptimizer_default_options['shoptimizer_layout_top_bar_display'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'enable'  => esc_html__( 'Enable', 'shoptimizer' ),
			'disable' => esc_html__( 'Disable', 'shoptimizer' ),
		),
	)
);


// Header Padding Top
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_header_top_padding',
		'label'       => esc_html__( 'Header Top Padding', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the header top padding', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => 30,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => '.col-full.main-header',
				'property'    => 'padding-top',
				'units'       => 'px',
				'media_query' => '@media (min-width: 992px)',
			),

		),
	)
);

// Header Padding Bottom
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_header_bottom_padding',
		'label'       => esc_html__( 'Header Bottom Padding', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the header bottom padding', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => 30,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => '.col-full.main-header',
				'property'    => 'padding-bottom',
				'units'       => 'px',
				'media_query' => '@media (min-width: 992px)',
			),
		),
	)
);

// Display the search.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_layout_search_display',
		'label'       => esc_html__( 'Display the search?', 'shoptimizer' ),
		'description' => esc_html__( 'Enable or disable the search', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => $shoptimizer_default_options['shoptimizer_layout_search_display'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'enable'  => esc_html__( 'Enable', 'shoptimizer' ),
			'disable' => esc_html__( 'Disable', 'shoptimizer' ),
		),
	)
);


// Navigation Height
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_navigation_height',
		'label'       => esc_html__( 'Navigation Height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the navigation height', 'shoptimizer' ),
		'section'     => 'shoptimizer_navigation_section_layout',
		'default'     => 60,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '.menu-primary-menu-container > ul > li > a, .site-header .site-header-cart, .logo-mark',
				'property' => 'line-height',
				'units'    => 'px',
			),
			array(
				'element'  => '.site-header-cart',
				'property' => 'height',
				'units'    => 'px',
			),
		),
	)
);


// Sticky Header.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'select',
		'settings'    => 'shoptimizer_sticky_header',
		'label'       => esc_html__( 'Sticky Header', 'shoptimizer' ),
		'description' => esc_html__( 'Stick the header on scroll', 'shoptimizer' ),
		'section'     => 'shoptimizer_header_section_layout',
		'default'     => $shoptimizer_default_options['shoptimizer_sticky_header'],
		'priority'    => 10,
		'transport'   => 'refresh',
		'choices'     => array(
			'enable'  => esc_html__( 'Enable', 'shoptimizer' ),
			'disable' => esc_html__( 'Disable', 'shoptimizer' ),
		),
	)
);

// Main Navigation Links Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_color',
		'label'     => esc_html__( 'Navigation links', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'     => '.menu-primary-menu-container > ul > li > a',
				'property'    => 'color',
				'media_query' => '@media (min-width: 992px)',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'     => '.menu-primary-menu-container > ul > li > a',
				'function'    => 'css',
				'property'    => 'color',
				'media_query' => '@media (min-width: 992px)',
			),
		),
	)
);

// Main Navigation Links Hover/Selected Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_color_hover',
		'label'     => esc_html__( 'Navigation links hover/selected', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_color_hover'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.menu-primary-menu-container > ul > li > a span:before',
				'property' => 'border-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.menu-primary-menu-container > ul > li > a span:before',
				'property' => 'border-color',
			),
		),
	)
);

// Fade out other menu items on hover.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_navigation_color_other_hover',
		'label'       => esc_html__( 'Fade out other links when hovering over a menu item.', 'shoptimizer' ),
		'description' => esc_html__( 'Opacity (%).', 'shoptimizer' ),
		'section'     => 'shoptimizer_color_section_navigation',
		'default'     => 0.65,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 1,
			'step' => 0.01,
		),
		'output'      => array(
			array(
				'element'  => '.menu-primary-menu-container > ul#menu-primary-menu:hover > li > a',
				'property' => 'opacity',
			),
		),
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_colors_navigation_heading_1',
		'section'  => 'shoptimizer_color_section_navigation',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Dropdowns', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Navigation Dropdown Background Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_dropdown_background',
		'label'     => esc_html__( 'Navigation dropdown background', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_dropdown_background'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.main-navigation ul.menu ul.sub-menu',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.main-navigation ul.menu ul.sub-menu',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

// Navigation Dropdown Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_dropdown_color',
		'label'     => esc_html__( 'Navigation dropdown text', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_dropdown_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.main-navigation ul.menu ul li a, .main-navigation ul.nav-menu ul li a,
			.main-navigation ul.menu > li.menu-item-has-children:not(.full-width) ul li.menu-item-has-children > a:after',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.main-navigation ul.menu ul li a, .main-navigation ul.nav-menu ul li a,
			.main-navigation ul.menu > li.menu-item-has-children:not(.full-width) ul li.menu-item-has-children > a:after',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Main Navigation Dropdown Hover Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_navigation_dropdown_hover_color',
		'label'     => esc_html__( 'Navigation dropdown hover', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_navigation_dropdown_hover_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.main-navigation ul.menu ul a:hover',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.main-navigation ul.menu ul a:hover',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_colors_navigation_heading_2',
		'section'  => 'shoptimizer_color_section_navigation',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Secondary Navigation', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Secondary Navigation Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_secondary_navigation_color',
		'label'     => esc_html__( 'Secondary navigation color', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_secondary_navigation_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => 'body .secondary-navigation .menu a, .ri.menu-item:before, .fa.menu-item:before',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => 'body .secondary-navigation .menu a, .ri.menu-item:before, .fa.menu-item:before',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_colors_navigation_heading_21',
		'section'  => 'shoptimizer_color_section_navigation',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Sticky Navigation', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Sticky navigation border.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_sticky_navigation_border',
		'label'     => esc_html__( 'Sticky navigation border', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_topbar',
		'default'   => $shoptimizer_default_options['shoptimizer_sticky_navigation_border'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.shoptimizer-primary-navigation.is_stuck',
				'property' => 'border-bottom-color',
			),
		),
		'transport' => 'postMessage',
		'choices'   => array(
			'alpha' => true,
		),
		'js_vars'   => array(
			array(
				'element'  => '.shoptimizer-primary-navigation.is_stuck',
				'function' => 'css',
				'property' => 'border-bottom-color',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_colors_navigation_heading_3',
		'section'  => 'shoptimizer_color_section_navigation',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Cart', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Navigation Cart Icon Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_cart_icon_color',
		'label'     => esc_html__( 'Cart icon', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_cart_icon_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.site-header .site-header-cart a.cart-contents .count, .site-header .site-header-cart a.cart-contents .count:after',
				'property' => 'border-color',
			),
			array(
				'element'  => '.site-header .site-header-cart a.cart-contents .count',
				'property' => 'color',
			),
			array(
				'element'  => '.site-header .site-header-cart a.cart-contents:hover .count, .site-header .site-header-cart a.cart-contents:hover .count',
				'property' => 'background-color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-header .site-header-cart a.cart-contents .count, .site-header .site-header-cart a.cart-contents .count:after',
				'function' => 'css',
				'property' => 'border-color',
			),
			array(
				'element'  => '.site-header .site-header-cart a.cart-contents .count',
				'property' => 'color',
			),
			array(
				'element'  => '.site-header .site-header-cart a.cart-contents:hover .count, .site-header .site-header-cart a.cart-contents:hover .count',
				'property' => 'background-color',
			),
		),
	)
);

// Navigation Cart Text Color.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'color',
		'settings'  => 'shoptimizer_cart_color',
		'label'     => esc_html__( 'Cart text', 'shoptimizer' ),
		'section'   => 'shoptimizer_color_section_navigation',
		'default'   => $shoptimizer_default_options['shoptimizer_cart_color'],
		'priority'  => 10,
		'output'    => array(
			array(
				'element'  => '.site-header-cart .cart-contents',
				'property' => 'color',
			),
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'element'  => '.site-header-cart .cart-contents',
				'function' => 'css',
				'property' => 'color',
			),
		),
	)
);

// Main Navigation Level 1 Menu Font.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_mainmenu_level1_fontfamily',
		'label'    => esc_html__( 'Level 1 Font settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_navigation_section_layout',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '400',
			'font-size'      => '16px',
			'text-transform' => 'none',
			'letter-spacing' => '-0.3px',
		),
		'priority' => 60,
		'output'   => array(
			array(
				'element'  => '.menu-primary-menu-container > ul > li > a, .site-header-cart .cart-contents',
				'property' => 'font-family',
			),
		),
	)
);

// Main Navigation Level 2 Menu Font.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_mainmenu_level2_family',
		'label'    => esc_html__( 'Level 2 Font settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_navigation_section_layout',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '400',
			'font-size'      => '14px',
			'text-transform' => 'none',
		),
		'priority' => 60,
		'output'   => array(
			array(
				'element'  => '.main-navigation ul.menu ul li a, .main-navigation ul.nav-menu ul li a',
				'property' => 'font-family',
			),
		),
	)
);

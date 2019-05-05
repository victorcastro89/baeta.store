<?php
/**
 *
 * Layout theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Layout fields.
$shoptimizer_default_options = shoptimizer_get_option_defaults();


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_grid_heading_1',
		'section'  => 'shoptimizer_layout_section_grid',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Wrapper', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_layout_wrapper',
		'label'    => esc_attr__( 'Contain the grid?', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_grid',
		'default'  => 'no',
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

// Wrapper width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_wrapper_width_nb',
		'label'       => esc_html__( 'Wraper container width', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust wrapper width in px.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_grid',
		'default'     => 2170,
		'priority'    => 10,
		'choices'     => array(
			'min'  => 992,
			'max'  => 3000,
			'step' => 1,
		),
		'required'    => array(
			array(
				'setting'  => 'shoptimizer_layout_wrapper',
				'value'    => 'yes',
				'operator' => '==',
			),
		),
		'output'      => array(
			array(
				'element'  => '#page',
				'property' => 'max-width',
				'units'    => 'px',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_grid_heading_2',
		'section'  => 'shoptimizer_layout_section_grid',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Content container', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Content Container width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_container_width',
		'label'       => esc_html__( 'Content container width', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the width of your content container in pixels. Default is 1170px.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_grid',
		'default'     => 1170,
		'priority'    => 10,
		'choices'     => array(
			'min'  => 992,
			'max'  => 2000,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '.col-full, .single-product .site-content .shoptimizer-sticky-add-to-cart .col-full, body .woocommerce-message',
				'property' => 'max-width',
				'units'    => 'px',
			),
			array(
				'element'       => '
			.product-details-wrapper,
			.single-product .woocommerce-Tabs-panel,
			.single-product .archive-header .woocommerce-breadcrumb,
			.related.products,
			.upsells.products,
			.main-navigation ul li.menu-item-has-children.full-width .container',
				'value_pattern' => 'calc($px + 5.2325em)',
				'property'      => 'max-width',
				'units'         => '',
			),
			array(
				'element'       => '.below-content .col-full, footer .col-full',
				'value_pattern' => 'calc($px + 40px)',
				'property'      => 'max-width',
				'units'         => '',
			),
		),
	)
);




shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_1',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'General', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Display Cart in Menu.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_cart',
		'label'     => esc_html__( 'Display cart in menu', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display Breadcrumbs.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_breadcrumbs',
		'label'     => esc_html__( 'Display breadcrumbs', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_2',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Shop', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Display Products Results Count.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_count',
		'label'     => esc_html__( 'Display product results count', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display Products Sorting
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_sorting',
		'label'     => esc_html__( 'Display product sorting', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display sale flash over image.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'toggle',
		'settings' => 'shoptimizer_layout_woocommerce_display_badge',
		'label'    => esc_html__( 'Display sale flash over image', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => 1,
		'priority' => 10,
	)
);

// Display rating.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_rating',
		'label'     => esc_html__( 'Display rating', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display category.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_display_category',
		'label'     => esc_html__( 'Display category', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Text alignment
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_woocommerce_text_alignment',
		'label'     => esc_html__( 'Product text alignment', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_woocommerce_text_alignment'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'product-align-left'   => esc_html__( 'Left', 'shoptimizer' ),
			'product-align-center' => esc_html__( 'Center', 'shoptimizer' ),
			'product-align-right'  => esc_html__( 'Right', 'shoptimizer' ),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_3',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Single Product', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Display sticky add to cart bar.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_sticky_cart_display',
		'label'     => esc_html__( 'Display sticky add to cart bar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display related.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_related_display',
		'label'     => esc_html__( 'Display related', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display product meta data.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_meta_display',
		'label'     => esc_html__( 'Display product meta data', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display previous/next products
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_woocommerce_prev_next_display',
		'label'     => esc_html__( 'Display previous and next products', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => '1',
		'priority'  => 10,
		'transport' => 'refresh',
	)
);

// Display floating button
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_layout_floating_button_display',
		'label'    => esc_attr__( 'Display floating button', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => 'yes',
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

// Floating button text
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'text',
		'settings'  => 'shoptimizer_layout_floating_button_text',
		'label'     => esc_html__( 'Floating button text', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_woocommerce',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_floating_button_text'],
		'priority'  => 10,
		'transport' => 'auto',
		'required'  => array(
			array(
				'setting'  => 'shoptimizer_layout_floating_button_display',
				'value'    => 'yes',
				'operator' => '==',
			),
		),
		'js_vars'   => array(
			array(
				'element'  => '.call-back-feature',
				'function' => 'html',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_button_help',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div>' . esc_html__( 'The content is added within the widget: "Floating Button Modal Content"', 'shoptimizer' ) . '</div>',
		'priority' => 10,
		'required' => array(
			array(
				'setting'  => 'shoptimizer_layout_floating_button_display',
				'value'    => 'yes',
				'operator' => '==',
			),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_woocommerce_sidebar_heading_4',
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase; letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Cart and Checkout', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Display progress bar
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'toggle',
		'settings' => 'shoptimizer_layout_progress_bar_display',
		'label'    => esc_attr__( 'Display progress bar', 'shoptimizer' ),
		'section'  => 'shoptimizer_layout_section_woocommerce',
		'default'  => 1,
		'priority' => 10,
	)
);

// Distration free checkout
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'toggle',
		'settings'    => 'shoptimizer_layout_woocommerce_simple_checkout',
		'label'       => esc_attr__( 'Distraction-free checkout', 'shoptimizer' ),
		'description' => esc_attr__( 'Simplifies the checkout experience for better conversions.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_woocommerce',
		'default'     => 1,
		'priority'    => 10,
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_sidebars_heading_0',
		'section'  => 'shoptimizer_layout_section_sidebars',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'WooCommerce', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// WooCommerce Sidebar
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_woocommerce_sidebar',
		'label'     => esc_html__( 'WooCommerce Sidebar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_sidebars',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_woocommerce_sidebar'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'left-woocommerce-sidebar'  => esc_html__( 'Left', 'shoptimizer' ),
			'right-woocommerce-sidebar' => esc_html__( 'Right', 'shoptimizer' ),
			'no-woocommerce-sidebar'    => esc_html__( 'None', 'shoptimizer' ),
		),
	)
);


shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_sidebars_heading_1',
		'section'  => 'shoptimizer_layout_section_sidebars',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Pages', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Pages Sidebar
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_page_sidebar',
		'label'     => esc_html__( 'Page Sidebar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_sidebars',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_page_sidebar'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'left-page-sidebar'  => esc_html__( 'Left', 'shoptimizer' ),
			'right-page-sidebar' => esc_html__( 'Right', 'shoptimizer' ),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_sidebars_heading_2',
		'section'  => 'shoptimizer_layout_section_sidebars',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Blog Archives', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Blog Archives Sidebar
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_archives_sidebar',
		'label'     => esc_html__( 'Blog Archives Sidebar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_sidebars',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_archives_sidebar'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'left-archives-sidebar'  => esc_html__( 'Left', 'shoptimizer' ),
			'right-archives-sidebar' => esc_html__( 'Right', 'shoptimizer' ),
			'no-archives-sidebar'    => esc_html__( 'None', 'shoptimizer' ),
		),
	)
);

shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_layout_sidebars_heading_3',
		'section'  => 'shoptimizer_layout_section_sidebars',
		'default'  => '<div class="kirki-separator" 
	style="margin: 10px -12px;
	padding: 12px 12px;
	color: #111;
	text-transform: uppercase;
	letter-spacing: 1px;
	border-top: 1px solid #ddd;
	border-bottom: 1px solid #ddd;
	background-color: #fff;
	cursor: default;">' . esc_html__( 'Single Post', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Posts Sidebar
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_post_sidebar',
		'label'     => esc_html__( 'Post Sidebar', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_sidebars',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_post_sidebar'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'left-post-sidebar'  => esc_html__( 'Left', 'shoptimizer' ),
			'right-post-sidebar' => esc_html__( 'Right', 'shoptimizer' ),
			'no-post-sidebar'    => esc_html__( 'None', 'shoptimizer' ),
		),
	)
);

// Sidebar Width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_layout_sidebar_width',
		'label'       => esc_html__( 'Sidebar Width (%).', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the width of the sidebar.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_sidebars',
		'default'     => 22,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 50,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '#secondary',
				'property' => 'width',
				'units'    => '%',
			),
		),
	)
);

// Content Width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_layout_content_width',
		'label'       => esc_html__( 'Content Width (%).', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the width of the content.', 'shoptimizer' ),
		'section'     => 'shoptimizer_layout_section_sidebars',
		'default'     => 72,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '.content-area',
				'property' => 'width',
				'units'    => '%',
			),
		),
	)
);

// Blog
// Layout
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_layout_blog',
		'label'     => esc_html__( 'Blog Layout', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_blog',
		'default'   => $shoptimizer_default_options['shoptimizer_layout_blog'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'list'        => esc_html__( 'List', 'shoptimizer' ),
			'flow'        => esc_html__( 'Flow', 'shoptimizer' ),
			'grid grid-2' => esc_html__( 'Grid of 2', 'shoptimizer' ),
			'grid grid-3' => esc_html__( 'Grid of 3', 'shoptimizer' ),
		),
	)
);

// Display blog summary
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'toggle',
		'settings'  => 'shoptimizer_layout_blog_summary_display',
		'label'     => esc_html__( 'Display blog post summary', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_blog',
		'default'   => 1,
		'priority'  => 10,
		'transport' => 'refresh',
	)
);


// Footer fields.
// Display Below Content Area.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_below_content_display',
		'label'     => esc_html__( 'Show Below Content?', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_below_content_display'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'show' => esc_html__( 'Show', 'shoptimizer' ),
			'hide' => esc_html__( 'Hide', 'shoptimizer' ),
		),
	)
);

// Display Footer.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_footer_display',
		'label'     => esc_html__( 'Show Footer?', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_footer_display'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'show' => esc_html__( 'Show', 'shoptimizer' ),
			'hide' => esc_html__( 'Hide', 'shoptimizer' ),
		),
	)
);

// Display Copyright.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'      => 'select',
		'settings'  => 'shoptimizer_copyright_display',
		'label'     => esc_html__( 'Show Copyright?', 'shoptimizer' ),
		'section'   => 'shoptimizer_layout_section_footer',
		'default'   => $shoptimizer_default_options['shoptimizer_copyright_display'],
		'priority'  => 10,
		'transport' => 'refresh',
		'choices'   => array(
			'show' => esc_html__( 'Show', 'shoptimizer' ),
			'hide' => esc_html__( 'Hide', 'shoptimizer' ),
		),
	)
);


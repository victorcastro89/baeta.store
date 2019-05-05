<?php
/**
 *
 * Typography theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Main body fields.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_mainbody_fontfamily',
		'label'    => esc_html__( 'Font settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_mainbody',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
		),
		'priority' => 10,
		'output'   => array(
			array(
				'element'  => 'body, button, input, select, textarea, h6',
				'property' => 'font-family',
			),
		),
	)
);

// Paragraph.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_p_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_p',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '17px',
			'line-height'    => '1.6',
			'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#323232',
			'text-transform' => 'none',
		),
		'priority' => 20,
		'output'   => array(
			array(
				'element'  => '.entry-content p, .entry-content ul, .entry-content ol',
				'property' => 'font-family',
			),
		),
	)
);

// h1.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h1_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h1',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '40px',
			'line-height'    => '1.3',
			'letter-spacing' => '-0.5px',
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 20,
		'output'   => array(
			array(
				'element'  => 'h1',
				'property' => 'font-family',
			),
		),
	)
);

// h2.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h2_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h2',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '28px',
			'line-height'    => '1.4',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 30,
		'output'   => array(
			array(
				'element'  => 'h2',
				'property' => 'font-family',
			),
		),
	)
);


// h3.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h3_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h3',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '24px',
			'line-height'    => '1.55',
			'letter-spacing' => '-0.3px',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 40,
		'output'   => array(
			array(
				'element'  => 'h3',
				'property' => 'font-family',
			),
		),
	)
);


// h4.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h4_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h4',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '20px',
			'line-height'    => '1.6',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 50,
		'output'   => array(
			array(
				'element'  => 'h4',
				'property' => 'font-family',
			),
		),
	)
);


// h5.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_h5_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_h5',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '18px',
			'line-height'    => '1.6',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 60,
		'output'   => array(
			array(
				'element'  => 'h5',
				'property' => 'font-family',
			),
		),
	)
);

// Blockquote.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_blockquote_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_blockquote',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '300',
			'font-size'      => '20px',
			'line-height'    => '1.45',
			'letter-spacing' => '0',
			'subsets'        => array( 'latin-ext' ),
			'color'          => '#222',
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => 'blockquote p',
				'property' => 'font-family',
			),
		),
	)
);

// Widget Titles.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_widget_title_fontfamily',
		'label'    => esc_html__( 'Font Settings', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_headings_widget_title',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => 'regular',
			'font-size'      => '16px',
			'line-height'    => '1.5',
			'letter-spacing' => '0px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => '.widget .widget-title, .widget .widgettitle',
				'property' => 'font-family',
			),
		),
	)
);


// Blog Post Title.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_blog_post_title',
		'label'    => esc_html__( 'Blog Post Title', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_blog',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '300',
			'font-size'      => '36px',
			'line-height'    => '1.24',
			'letter-spacing' => '-0.5px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => 'body.single-post h1',
				'property' => 'font-family',
			),
		),
	)
);

// WooCommerce.
// Archives Category Description.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_woocommerce_archives_description',
		'label'    => esc_html__( 'Archives Category Description', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_woocommerce',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '400',
			'font-size'      => '19px',
			'letter-spacing' => '-0.2px',
			'line-height'    => '29px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => '.term-description',
				'property' => 'font-family',
			),
		),
	)
);

// Archives Product Title.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_woocommerce_listings_title',
		'label'    => esc_html__( 'Archives Product Title', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_woocommerce',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '400',
			'font-size'      => '16px',
			'letter-spacing' => '0px',
			'line-height'    => '24px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => '.content-area ul.products li.product .woocommerce-loop-product__title, .content-area ul.products li.product h2,
			ul.products li.product .woocommerce-loop-product__title, ul.products li.product h2',
				'property' => 'font-family',
			),
		),
	)
);


// Single Product Title.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_woocommerce_single_title',
		'label'    => esc_html__( 'Single Product Title', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_woocommerce',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '400',
			'font-size'      => '34px',
			'letter-spacing' => '-0.5px',
			'line-height'    => '44px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => 'body.single-product h1',
				'property' => 'font-family',
			),
		),
	)
);

// Primary Buttons.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'typography',
		'settings' => 'shoptimizer_typography_woocommerce_primary_button',
		'label'    => esc_html__( 'Primary Buttons', 'shoptimizer' ),
		'section'  => 'shoptimizer_typography_section_woocommerce',
		'default'  => array(
			'font-family'    => 'IBM Plex Sans',
			'variant'        => '600',
			'font-size'      => '18px',
			'letter-spacing' => '0px',
			'subsets'        => array( 'latin-ext' ),
			'text-transform' => 'none',
		),
		'priority' => 70,
		'output'   => array(
			array(
				'element'  => 'body .woocommerce #respond input#submit.alt, 
			body .woocommerce a.button.alt, 
			body .woocommerce button.button.alt, 
			body .woocommerce input.button.alt,
			.product .cart .single_add_to_cart_button,
			.shoptimizer-sticky-add-to-cart__content-button a.button,
			.shoptimizer-mini-cart-wrap .widget_shopping_cart a.button.checkout',
				'property' => 'font-family',
			),
		),
	)
);

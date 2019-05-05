<?php
/**
 *
 * General theme options
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// General fields.
$shoptimizer_default_options = shoptimizer_get_option_defaults();

// Header Logo Height.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_logo_height',
		'label'       => esc_html__( 'Logo Height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the height of your logo in pixels. You can upload your logo image within the "Site Identity" panel.', 'shoptimizer' ),
		'section'     => 'shoptimizer_section_general_logo',
		'default'     => 42,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'  => '.site-header .custom-logo-link img',
				'property' => 'height',
				'units'    => 'px',
			),
		),
	)
);


// Sticky Logo Image.
shoptimizer_Kirki::add_field(
	'accentuate_config', array(
		'type'     => 'image',
		'settings' => 'shoptimizer_logo_mark_image',
		'label'    => esc_html__( 'Sticky Logo', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_sticky_logo',
		'default'  => $shoptimizer_default_options['shoptimizer_logo_mark_image'],
		'priority' => 10,
	)
);


// Sticky Logo Image Width.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'slider',
		'settings' => 'shoptimizer_sticky_logo_width',
		'label'    => esc_html__( 'Sticky Logo Width', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_sticky_logo',
		'default'  => 58,
		'priority' => 10,
		'choices'  => array(
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		),
		'output'   => array(
			array(
				'element'  => '.is_stuck .logo-mark',
				'property' => 'width',
				'units'    => 'px',
			),
			array(
				'element'  => '.is_stuck .primary-navigation.with-logo .menu-primary-menu-container',
				'property' => 'margin-left',
				'units'    => 'px',
			),
		),
	)
);

// Mobile Header Height.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_mobile_header_height',
		'label'       => esc_html__( 'Mobile Header Height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the height of your mobile header in pixels.', 'shoptimizer' ),
		'section'     => 'shoptimizer_section_general_mobile_header',
		'default'     => 70,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 200,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => '.main-header',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (max-width: 992px)',
			),
			array(
				'element'       => '.main-header .site-header-cart',
				'value_pattern' => 'calc(-14px + $px / 2)',
				'property'      => 'top',
				'units'         => '',
				'media_query'   => '@media (max-width: 992px)',
			),

		),
	)
);

// Mobile Logo Height.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'        => 'slider',
		'settings'    => 'shoptimizer_mobile_logo_height',
		'label'       => esc_html__( 'Mobile Logo Height', 'shoptimizer' ),
		'description' => esc_html__( 'Adjust the height of your mobile logo in pixels.', 'shoptimizer' ),
		'section'     => 'shoptimizer_section_general_mobile_header',
		'default'     => 22,
		'priority'    => 1,
		'choices'     => array(
			'min'  => 0,
			'max'  => 100,
			'step' => 1,
		),
		'output'      => array(
			array(
				'element'     => 'body .site-header .custom-logo-link img',
				'property'    => 'height',
				'units'       => 'px',
				'media_query' => '@media (max-width: 992px)',
			),
		),
	)
);

// Critical CSS Settings.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_general_speed_heading_1',
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Critical CSS', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);

// Critical CSS.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_general_speed_critical_css',
		'label'    => esc_attr__( 'Enable Critical CSS?', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => 'yes',
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),

		),
		'priority' => 10,
	)
);

// Minification Settings.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'custom',
		'settings' => 'shoptimizer_general_speed_heading_2',
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => '<div class="kirki-separator" style="margin: 10px -12px; padding: 12px 12px; color: #111; text-transform: uppercase;
	letter-spacing: 1px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; background-color: #fff; cursor: default;">' . esc_html__( 'Minification Settings', 'shoptimizer' ) . '</div>',
		'priority' => 10,
	)
);


// Main CSS Minified.
shoptimizer_Kirki::add_field(
	'shoptimizer_config', array(
		'type'     => 'select',
		'settings' => 'shoptimizer_general_speed_minify_main_css',
		'label'    => esc_attr__( 'Minify Main CSS?', 'shoptimizer' ),
		'section'  => 'shoptimizer_section_general_speed_settings',
		'default'  => 'yes',
		'choices'  => array(
			'yes' => esc_attr__( 'Yes', 'shoptimizer' ),
			'no'  => esc_attr__( 'No', 'shoptimizer' ),
		),
		'priority' => 10,
	)
);

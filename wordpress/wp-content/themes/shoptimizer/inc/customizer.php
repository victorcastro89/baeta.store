<?php
/**
 * Shoptimizer Theme Customizer
 *
 * @package CommerceGurus
 * @subpackage shoptimizer
 */

// Set config scope.
shoptimizer_Kirki::add_config( 'shoptimizer_config', array(
	'option_type'	 => 'theme_mod',
	'capability'	 => 'edit_theme_options',
) );

function shoptimizer_kirki_styling( $config ) {
	return wp_parse_args( array(
		'disable_loader' => 'true',
	), $config );
}
add_filter( 'kirki_config', 'shoptimizer_kirki_styling' );

// Init options and set sane defaults.
require_once get_template_directory() . '/inc/customizer/options.php';

// Get Panels.
require get_template_directory() . '/inc/customizer/panels/panels.php';

// Get Sections.
require get_template_directory() . '/inc/customizer/sections/general.php';
require get_template_directory() . '/inc/customizer/sections/color.php';
require get_template_directory() . '/inc/customizer/sections/mainmenu.php';
require get_template_directory() . '/inc/customizer/sections/typography.php';
require get_template_directory() . '/inc/customizer/sections/layout.php';

// Get Fields.
require get_template_directory() . '/inc/customizer/fields/general.php';
require get_template_directory() . '/inc/customizer/fields/color.php';
require get_template_directory() . '/inc/customizer/fields/mainmenu.php';
require get_template_directory() . '/inc/customizer/fields/typography.php';
require get_template_directory() . '/inc/customizer/fields/layout.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function shoptimizer_customize_register( $wp_customize ) {
	// Remove sections not required - all in our main customizer options.
	$wp_customize->remove_section( 'colors' );

	// Reassign default sections to panels.
	$wp_customize->get_section( 'title_tagline' )->panel	 = 'shoptimizer_panel_general';
	$wp_customize->get_section( 'static_front_page' )->panel = 'shoptimizer_panel_general';

	$wp_customize->get_setting( 'blogname' )->transport			 = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport	 = 'postMessage';
}

add_action( 'customize_register', 'shoptimizer_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function shoptimizer_customize_preview_js() {
	wp_enqueue_script( 'shoptimizer_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}

add_action( 'customize_preview_init', 'shoptimizer_customize_preview_js' );

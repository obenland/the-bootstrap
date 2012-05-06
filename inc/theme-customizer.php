<?php
/** theme-customizer.php
 * 
 * Implementation of the Theme Customizer for Themes
 * @link		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
 * 
 * @author		Konstantin Obenland
 * @package		The Bootstrap
 * @since		1.4.0 - 05.05.2012
 */


if ( ! function_exists( 'the_bootstrap_options' ) )
	require_once 'theme-options.php';


/**
 * Registers the theme setting controls with the Theme Customizer
 * 
 * @author	Konstantin Obenland
 * @since	1.4.0 - 05.05.2012
 * 
 * @param	WP_Customize	$wp_customize
 * 
 * @return	void
 */
function the_bootstrap_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'the_bootstrap_theme_options', array(
		'title'		=>	__( 'Theme Options', 'the-bootstrap' ),
		'priority'	=>	99,
	) );
	
	// Theme Layout
	$wp_customize->add_setting( 'the_bootstrap_theme_options[theme_layout]', array(
		'default'	=>	the_bootstrap_options()->theme_layout,
		'type'		=>	'option',
		'transport'	=>	'postMessage',
	) );
	$wp_customize->add_control( 'the_bootstrap_theme_layout', array(
		'label'		=>	__( 'Default Layout', 'the-bootstrap' ),
		'section'	=>	'the_bootstrap_theme_options',
		'settings'	=>	'the_bootstrap_theme_options[theme_layout]',
		'type'		=>	'radio',
		'choices'	=>	array(
			'content-sidebar'	=>	__( 'Content on left', 'the-bootstrap' ),
			'sidebar-content'	=>	__( 'Content on right', 'the-bootstrap' )
		),
	) );
	
	// Sitename in Navbar
	$wp_customize->add_setting( 'the_bootstrap_theme_options[navbar_site_name]', array(
		'default'	=>	the_bootstrap_options()->navbar_site_name,
		'type'		=>	'option',
		'transport'	=>	'postMessage',
	) );
	$wp_customize->add_control( 'the_bootstrap_navbar_site_name', array(
		'label'		=>	__( 'Add site name to navigation bar.', 'the-bootstrap' ),
		'section'	=>	'the_bootstrap_theme_options',
		'settings'	=>	'the_bootstrap_theme_options[navbar_site_name]',
		'type'		=>	'checkbox',
	) );
	
	// Searchform in Navbar
	$wp_customize->add_setting( 'the_bootstrap_theme_options[navbar_searchform]', array(
		'default'	=>	the_bootstrap_options()->navbar_searchform,
		'type'		=>	'option',
		'transport'	=>	'postMessage',
	) );
	$wp_customize->add_control( 'the_bootstrap_navbar_searchform', array(
		'label'		=>	__( 'Add searchform to navigation bar.', 'the-bootstrap' ),
		'section'	=>	'the_bootstrap_theme_options',
		'settings'	=>	'the_bootstrap_theme_options[navbar_searchform]',
		'type'		=>	'checkbox',
	) );
	
	if ( $wp_customize->is_preview() && ! is_admin() ) {
		add_action( 'wp_enqueue_scripts', 'the_bootstrap_customize_enqueue_scripts' );
	}
}
add_action( 'customize_register', 'the_bootstrap_customize_register' );


/**
 * Adds controls to change settings instantly
 *
 * @author	Konstantin Obenland
 * @since	1.4.0 - 05.05.2012
 *
 * @return	void
 */
function the_bootstrap_customize_enqueue_scripts() {
	
	wp_enqueue_script( 'the-bootstrap-customize', get_template_directory_uri() . '/js/theme-customizer.js', array('jquery'), _the_bootstrap_version(), true );
	
	wp_localize_script( 'the-bootstrap-customize', 'the_bootstrap_customize', array(
		'sitename'		=>	get_bloginfo( 'name', 'display' ),
		'searchform'	=>	the_bootstrap_nav_searchform( false )
	) );
}


/* End of file theme-customizer.php */
/* Location: ./wp-content/themes/the-bootstrap/inc/theme-customizer.php */
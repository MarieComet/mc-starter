<?php
/**
 * MCStarter Theme Customizer
 *
 * @package MCStarter
 */

add_action( 'customize_register', 'mcstarter_customize_register' );
/**
 * Registers customizer panels and settings
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mcstarter_customize_register( $wp_customize ) {

	// Load our custom Control
	// require_once 'class-wp-customize-multi-checkbox-control.php';

	// Add postMessage support for site title, description and header text color.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Register custom sections, settings and partials
	$sections = mcstarter_get_customizer_sections();
	array_walk( $sections , function( $args, $id, $wp_customize ){
		$wp_customize->add_section( $id, $args );
	}, $wp_customize );

	$settings = mcstarter_get_customizer_settings();
	array_walk( $settings, 'mcstarter_register_customizer_setting', $wp_customize );	
}

add_action( 'customize_preview_init', 'mcstarter_customize_preview_js' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function mcstarter_customize_preview_js() {
	wp_enqueue_script( 'mcstarter-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), null, true );
}


/**
 * Returns an array of customizer sections to register.
 *
 * @return  array  $settings  Array of sections to register.
 */
function mcstarter_get_customizer_sections(){
	$sections = [
		'layout' => [
			'priority' => 80,
			'title' => __( 'Layout', 'mcstarter' ),
		],
	];
	return apply_filters( 'mcstarter_customizer_sections', $sections );
}


/**
 * Returns an array of customizer settings and controls to register.
 *
 * @return  array  $settings  Array of settings and control to register.
 */
function mcstarter_get_customizer_settings() {
	$settings = [
		'mcstarter_post_thumbnail_display' => [
			'default' => 'large-thumbnail',
			'sanitize_callback' => 'mcstarter_validate_choice',
			'control' => [
				'type' => 'radio',
				'label' => __( 'Blog post featured image display', 'mcstarter' ),
				'section' => 'layout',
				'active_callback' => function(){ return ! is_singular(); },
				'choices' => [
					'small-thumbnail' => __( 'Small thumbnail', 'mcstarter' ),
					'large-thumbnail' => __( 'Large featured image', 'mcstarter' ),
				],
			]
		],
		'mcstarter_sidebar_position' => [
			'default'   => 'sidebar-right',
			'transport' => 'postMessage',
			'sanitize_callback' => 'mcstarter_validate_choice',
			'control'   => [
				'type'    => 'radio',
				'label'   => __( 'Widget area position', 'mcstarter' ),
				'section' => 'layout',
				'active_callback' => function(){return ! is_page() && ! is_404() && is_active_sidebar( 'sidebar-1' );},
				'choices' => [
					'sidebar-left'   => __( 'Widget area on the left', 'mcstarter' ),
					'sidebar-right'  => __( 'Widget area on the right', 'mcstarter' ),
					'sidebar-bottom' => __( 'Widget area below content', 'mcstarter' ),
				],
			]
		],
		'mcstarter_homepage_title' => [
			'default'   => 'site-title',
			'sanitize_callback' => 'mcstarter_validate_choice',
			'control'   => [
				'type'    => 'radio',
				'label'   => __( 'Title to display on front page', 'mcstarter' ),
				'section' => 'static_front_page',
				'active_callback' => function(){ return is_front_page() && !is_home();},
				'choices' => [
					'site-title'   => __( 'Display site title', 'mcstarter' ),
					'page-title'   => __( 'Display page title', 'mcstarter' ),
				],
			]
		],
	];
	return apply_filters( 'mcstarter_customizer_settings', $settings );
}


/**
 * Register customizer settings and their controls.
 * 
 * @param  array   $args  The arguments for the setting to register.
 * @param  string  $id    The id of the setting.
 * @param  string  $wp_customize  The customizer object.
 */
function mcstarter_register_customizer_setting( $args, $id, $wp_customize ) {
	// $wp_customize->add_setting( $id, $args );
	$wp_customize->add_setting( $id, [
		'type'           => ! empty( $args['type'] ) ? $args['type'] : 'theme_mod',
		'capability'     => ! empty( $args['capability'] ) ? $args['capability'] : 'edit_theme_options',
		'theme_supports' => ! empty( $args['theme_supports'] ) ? $args['theme_supports'] : '',
		'default'        => ! empty( $args['default'] ) ? $args['default'] : '',
		'sanitize_callback' => ! empty( $args['sanitize_callback'] ) ? $args['sanitize_callback'] : 'sanitize_text_field'
	] );
	
	// By default, for standard controls pass in the setting id to add_control() method
	$id_or_control = $id;

	// For custom controls, check the type and pass in the relevant WP Customize Custom Control if needed
	if( ! empty( $args['control']['type'] ) ){
		switch ( $args['control']['type'] ) {
			case 'color':
				$id_or_control = new WP_Customize_Color_Control( $wp_customize, $id, $args['control']);
				break;
			case 'multi-checkbox':
				$id_or_control = new MCStarter_Customize_Multi_Checkbox_Control( $wp_customize, $id, $args['control'] );
				break;
		}
	}

	$wp_customize->add_control( $id_or_control, $args['control'] );
}


/**
 * Validates choices on select and radio inputs in the customizer
 * 
 * @param  string    $value     The value of the setting to sanitize.
 * @param  object    $setting   The instance of the customizer setting.
 * @return string    $value     The sanitized value.
 */
function mcstarter_validate_choice( $value, $setting ) {
	$settings = mcstarter_get_customizer_settings();
	$return   = false;
	if( ! empty ( $settings[$setting->id] ) ){
		$default = ! empty( $settings[$setting->id]['default'] ) ? $settings[$setting->id]['default'] : '';
		$valid   = ! empty( $settings[$setting->id]['control']['choices'] ) ? $settings[$setting->id]['control']['choices'] : [];
		$return  = array_key_exists( $value, $valid ) ? $value : $default;
		if( 'multi-checkbox' === $settings[$setting->id]['control']['type'] ){
			$intersection = array_intersect( array_keys( $valid ) , explode( ',', $value ) );
			$return = ! empty( $intersection ) ? implode( ',', $intersection) : '';
		}
	}
	return $return;
}


add_action( 'wp_head', 'mcstarter_head_styles' );
/**
 * Prints <style> tags in the header, according to customizer settings.
 */
function mcstarter_head_styles(){
	$styles = '';

	// Navbar site info styles
	if ( ! display_header_text() ) {
		$styles .= '.site-title, .site-description { position: absolute; clip: rect(1px, 1px, 1px, 1px); }';
	} else {
		$header_text_color = get_header_textcolor();
		if( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color ){
			$styles .= '.site-title a, .site-description { color: #' . sanitize_hex_color_no_hash( $header_text_color ) . '; }';
		}
	}	

	if( $styles ){
		echo '<style type="text/css" id="mcstarter-customizer-css">' . esc_html( $styles ) . '</style>';
	}
  
}
<?php
/**
 * MCStarter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MCStarter
 */

add_action( 'after_setup_theme', 'mcstarter_setup' );
if ( ! function_exists( 'mcstarter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function mcstarter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on MCStarter, use a find and replace
		 * to change 'mcstarter' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'mcstarter', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in four locations.
		register_nav_menus( array(
			'menu-1'      => esc_html__( 'Primary menu', 'mcstarter' ),
			'topbar-menu' => esc_html__( 'Top bar menu', 'mcstarter' ),
			'social-menu' => esc_html__( 'Main menu social icons', 'mcstarter' ),
			'footer-menu' => esc_html__( 'Footer menu', 'mcstarter' ),
			'footer-social-menu' => esc_html__( 'Footer social icons', 'mcstarter' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		) );

		// Add support for the custom header feature.
		add_theme_support( 'custom-header', apply_filters( 'kawi_custom_header_args', array(
			'default-image'          => '',
			'default-text-color'     => '3d4852',
			'width'                  => 2000,
			'height'                 => 1000,
			'flex-height'            => false,
		) ) );
			
			
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
			
		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 50,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Register new image sizes
		add_image_size( 'mcstarter-featured-full', 2000, 1000, array( 'center', 'top' ) );
		add_image_size( 'mcstarter-featured-large', 1600, 800, array( 'center', 'top' ) );
		add_image_size( 'mcstarter-featured', 992, 496, array( 'center', 'top' ) );
		add_image_size( 'mcstarter-featured-small', 576, 288, array( 'center', 'top' ) );

		// Add styles on the editor.
		$editor_stylesheet_name = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'editor-style.css' : 'editor-style.min.css';	
		add_theme_support( 'editor-styles' );
		add_editor_style( array( $editor_stylesheet_name, mcstarter_slug_fonts_url() ) );

		// Gutenberg supports
		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
			array(
				'name' => __( 'Small', 'mcstarter' ),
				'size' => 14,
				'slug' => 'small'
			),
			array(
				'name' => __( 'Normal', 'mcstarter' ),
				'size' => 16,
				'slug' => 'normal'
			),
			array(
				'name' => __( 'Lead', 'mcstarter' ),
				'size' => 18,
				'slug' => 'lead'
			),
			array(
				'name' => __( 'Large', 'mcstarter' ),
				'size' => 20,
				'slug' => 'large'
			),
			array(
				'name' => __( 'Very Large', 'mcstarter' ),
				'size' => 24,
				'slug' => 'very-large'
			),
			array(
				'name' => __( 'Huge', 'mcstarter' ),
				'size' => 28,
				'slug' => 'huge'
			)
		) );
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'Primary', 'mcstarter' ),
				'slug'  => 'primary',
				'color' => '#40c0d1',
			),
			array(
				'name'  => __( 'Secondary', 'mcstarter' ),
				'slug'  => 'secondary',
				'color' => '#5c4ae2',
			),
			array(
				'name'  => __( 'Grey', 'mcstarter' ),
				'slug'  => 'grey',
				'color' => '#677783',
			),
			array(
				'name'  => __( 'Light grey', 'mcstarter' ),
				'slug'  => 'light-grey',
				'color' => '#bac6d3',
			),
			array(
				'name'  => __( 'Lightest grey', 'mcstarter' ),
				'slug'  => 'lightest-grey',
				'color' => '#f1f5f8',
			),
		) );
	}
endif;


add_filter( 'image_size_names_choose', 'mcstarter_custom_sizes' );
/**
 * Registers new images sizes for the admin area
 * 
 * @param  array  $sizes  Registered image sizes
 */
function mcstarter_custom_sizes( $sizes ) {
	return array_merge( $sizes, array(
        'mcstarter-featured-full'  => __( 'Full screen header image size', 'mcstarter' ),
        'mcstarter-featured-large' => __( 'Boxed header image size', 'mcstarter' ),
        'mcstarter-featured'       => __( 'Featured image size on listing pages', 'mcstarter' ),
        'mcstarter-featured-small' => __( 'Smaller featured image size', 'mcstarter' ),
    ) );
}


/**
 * Gets the URL to the Google Fonts
 */
function mcstarter_slug_fonts_url() {
	$fonts_url = '';
	$font_families = array( 'Oxygen+Mono' );
	
	/* Translators: If there are characters in your language that are not supported by Muli, translate this to 'off'. 
	 * Do not translate into your own language.
	 */
	$muli = _x( 'on', 'Muli font: on or off', 'mcstarter' );
	
	if ( 'off' !== $muli ) {
		$font_families[] = 'Muli:400,400i,700';
	}
	
	$fonts_url = add_query_arg( array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	), 'https://fonts.googleapis.com/css' );
 
	return esc_url_raw( $fonts_url );
}


add_action( 'after_setup_theme', 'mcstarter_content_width', 0 );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function mcstarter_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'mcstarter_content_width', 1600 );
}


add_action( 'widgets_init', 'mcstarter_widgets_init' );
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function mcstarter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Main widget area', 'mcstarter' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Widgets added here will appear in a widget area you can place on the left, right or bottom via a setting in the customizer. If no widgets are added, a one column layout will be used for all pages and posts.', 'mcstarter' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title h6">',
		'after_title'   => '</h2>',
	) );
}


add_action( 'wp_enqueue_scripts', 'mcstarter_scripts' );
/**
 * Enqueue scripts and styles.
 */
function mcstarter_scripts() {
	$stylesheet_uri = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? get_stylesheet_uri() : get_theme_file_uri( 'style.min.css' );	
	$script_name    = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '/js/src/main.js' : '/js/main.min.js';	
	wp_enqueue_style( 'mcstarter-fonts', mcstarter_slug_fonts_url(), array(), null );
	wp_enqueue_style( 'mcstarter-styles', $stylesheet_uri, array(), null );
	wp_enqueue_script( 'mcstarter-scripts', get_template_directory_uri() . $script_name, array(), null, false );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Notices.
 */
if( is_admin() ){
	require get_template_directory() . '/inc/notices.php';
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

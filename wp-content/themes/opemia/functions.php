<?php
/**
 * Opemia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Opemia
 */

if ( ! defined('ABSPATH') ) {
	exit;
}

if ( ! defined( 'OPEMIA_THEME_DIR' ) ) {
	define( 'OPEMIA_THEME_DIR', get_template_directory() );
}

if ( ! defined( 'OPEMIA_THEME_DIR_URI' ) ) {
	define( 'OPEMIA_THEME_DIR_URI', get_template_directory_uri() );
}

if ( ! defined( 'OPEMIA_ASSETS_DIR' ) ) {
	define( 'OPEMIA_ASSETS_DIR', OPEMIA_THEME_DIR_URI . '/assets' );
}

if ( ! defined( 'OPEMIA_THEME_INC_DIR' ) ) {
	define( 'OPEMIA_THEME_INC_DIR',  OPEMIA_THEME_DIR . '/includes' );
}

if ( ! defined( 'OPEMIA_THEME_SETTINGS' ) ) {
	define( 'OPEMIA_THEME_SETTINGS', 'opemia-settings' );
}

// Load files.
require_once OPEMIA_THEME_INC_DIR . '/init.php';

if ( ! function_exists( 'opemia_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function opemia_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Opemia, use a find and replace
		 * to change 'opemia' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'opemia', OPEMIA_THEME_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/* Add theme support for gutenberg block */
		add_theme_support( 'align-wide' );

		// Add theme support for Responsive Videos.
		add_theme_support( 'jetpack-responsive-videos' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' => __( 'Primary menu', 'opemia' ),
	        'footer' => __( 'Footer menu', 'opemia' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		$defaults = array(
			'default-color'          => 'ffffff',
			'default-image'          => '',
			'default-repeat'         => 'repeat',
		);
		add_theme_support( 'custom-background', $defaults );

		$args = array(
			'width'         => 1000,
			'height'        => 66,
			'default-image' => get_template_directory_uri() . '/images/header.jpg',
		);
		add_theme_support( 'custom-header', $args );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', [
			'width'      => 169,
			'height'      => 50
		] );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		$editor_stylesheet_path = './assets/css/style-editor.css';

		// Enqueue editor styles.
		add_editor_style( $editor_stylesheet_path );
	}
endif;
add_action( 'after_setup_theme', 'opemia_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function opemia_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'opemia_content_width', 640 );
}
add_action( 'after_setup_theme', 'opemia_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function opemia_widgets_init() {

	$footer_layout = esc_attr( get_theme_mod( 'footer_layout', 4 ) );
	
	$footer_layout = 12 / $footer_layout;

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'opemia' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'opemia' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'opemia' ),
		'id'            => 'opemia_footer_widget_area',
		'description'   => '',
		'before_widget' => '<div class="col-lg-'.$footer_layout.' col-md-6 col-sm-6"><div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'opemia_widgets_init' );

if ( ! function_exists( 'wp_body_open' ) ) {

	/**
	 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

add_filter( 'comment_form_fields', 'opemia_comment_fields_custom_order' );
function opemia_comment_fields_custom_order( $fields ) {
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    $phone_field = $fields['phone'];
    $url_field = $fields['url'];
    $cookies_field = $fields['cookies'];
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    unset( $fields['url'] );
    unset( $fields['phone'] );
    unset( $fields['cookies'] );
    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['url'] = $url_field;
    $fields['phone'] = $phone_field;
    $fields['comment'] = $comment_field;
    $fields['cookies'] = $cookies_field;
    // done ordering, now return the fields:
    return $fields;
}
<?php
/**
 * Opemia Theme Customizer
 *
 * @package Opemia
 */

/**
 * Main Class for customizer
 */
class Opemia_Customizer {

	/**
	 * Instance
	 *
	 * @access private
	 * @var object
	 */
	private static $instance;

	/**
	 * Initiator
	 */
	public static function get_instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function __construct() {

		add_action( 'customize_preview_init', 	array( $this, 'opemia_customize_preview_js' ) );
		add_action( 'customize_register',		array( $this, 'opemia_customizer_register' ) );
		add_action( 'after_setup_theme',	 	array( $this, 'opemia_customizer_settings' ) );
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 * Other basic stuff for customizer initialization.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function opemia_customizer_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.bottom-header .logo a h1',
				'container_inclusive' => false,
				'render_callback' => array( $this, 'partial_blogname' ),
			) );

			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'container_inclusive' => false,
				'render_callback' => array( $this, 'partial_blogdescription' ),
			) );
		}
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 * @since 1.0
	 */
	public function partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 *
	 * @since 1.0
	 */
	public function partial_blogdescription() {
		bloginfo( 'description' );
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 * 
	 * @since 1.0
	 */
	public function opemia_customize_preview_js() {
		wp_enqueue_script( 'opemia-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
	}

	public function opemia_customizer_settings() {
		require OPEMIA_THEME_INC_DIR . '/customize/header-section.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require OPEMIA_THEME_INC_DIR . '/customize/breadcrumbs-section.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		require OPEMIA_THEME_INC_DIR . '/customize/footer-section.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
	}
}

/**
 * Initialize customizer class.
 */
Opemia_Customizer::get_instance();
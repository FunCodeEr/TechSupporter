<?php

if ( ! class_exists( 'Opemia_Enqueue_Scripts' ) ) {
	class Opemia_Enqueue_Scripts {

		public function __construct() {

			$theme_info = wp_get_theme();
			$this->theme_version = $theme_info[ 'Version' ];
			$this->init_assets();
		}

		public function opemia_fonts_url() {
			$fonts_url = '';
			$fonts     = array();

			if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'opemia' ) ) {
				$fonts[] = 'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
			}

			if ( 'off' !== _x( 'on', 'Montserrat font: on or off', 'opemia' ) ) {
				$fonts[] = 'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
			}

			if ( $fonts ) {
				$fonts_url = add_query_arg( array(
					'family' => urlencode( implode( '|', $fonts ) ),
					'display'=> 'swap',
				), 'https://fonts.googleapis.com/css' );
			}


			return esc_url_raw( $fonts_url );
		}

		public function init_assets() {
			add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'backend_scripts' ) );
		}

		public function backend_scripts(){	
			wp_enqueue_style('opemia-admin-style', OPEMIA_ASSETS_DIR . '/css/admin.css');
			wp_enqueue_script( 'opemia-admin-script', OPEMIA_ASSETS_DIR . '/js/opemia-admin-script.js', array( 'jquery' ), '', true );
		    wp_localize_script( 'opemia-admin-script', 'opemia_ajax_object',
		        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
		    );
		}

		public function frontend_scripts() {

			wp_enqueue_style( 'opemia-google-fonts', $this->opemia_fonts_url() );

			wp_enqueue_style( 'opemia-style', get_stylesheet_uri() );

			wp_enqueue_style( 'animate', OPEMIA_ASSETS_DIR . '/css/animate.min.css', [], $this->theme_version );
			wp_enqueue_style( 'bootstrap', OPEMIA_ASSETS_DIR . '/css/bootstrap.min.css', [], $this->theme_version );
			wp_enqueue_style( 'font-awesome', OPEMIA_ASSETS_DIR . '/css/font-awesome.min.css', [], $this->theme_version );

			wp_enqueue_style( 'opemia-main', OPEMIA_ASSETS_DIR .'/css/main.css', [], $this->theme_version );
			wp_enqueue_style( 'opemia-responsive', OPEMIA_ASSETS_DIR .'/css/responsive.css', [], $this->theme_version );

			wp_enqueue_script('bootstrap', OPEMIA_ASSETS_DIR . '/js/bootstrap.min.js', array('jquery'));
			wp_enqueue_script('opemia-scripts', OPEMIA_ASSETS_DIR . '/js/scripts.js', array('jquery'));
			
			if ( is_singular() && comments_open() ) {
				wp_enqueue_script( 'comment-reply' );
			}
		}
	}

	new Opemia_Enqueue_Scripts;
}
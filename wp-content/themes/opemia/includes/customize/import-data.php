<?php
class opemia_import_data {

	private static $instance;

	public static function init( ) {
		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof opemia_import_data ) ) {
			self::$instance = new opemia_import_data;
			self::$instance->opemia_actions();
		}
	}

	public function opemia_actions() {
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'opemia_import_scripts' ), 0 );
	}

	public function opemia_import_scripts() {

	}
}

$opemia_import_customizer = array(
	'import_data' => array(
		'recommended' => true,
	),
);

opemia_import_data::init( apply_filters( 'opemia_import_customizer', $opemia_import_customizer ) );
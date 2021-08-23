<?php

function opemia_customizer_footer( $wp_customize ) {

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	// Footer Panel
	$wp_customize->add_panel( 
		'footer_section',
		array(
			'priority'      => 34,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Footer', 'opemia'),
		) 
	);

	// Footer Setting Section
	$wp_customize->add_section(
        'footer_copyright_section',
        array(
            'title' 		=> __('Copyright','opemia'),
			'panel'  		=> 'footer_section',
		)
    );

	$wp_customize->add_setting(
		'footer_copyright',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => true,
			'sanitize_callback' => 'opemia_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'footer_copyright',
		array(
			'type'     => 'checkbox',
			'section'  => 'footer_copyright_section',
			'label'    => __( 'Hide / Show Copyright', 'opemia' ),
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'footer_copyright',
		array(
			'selector' => '.bottom-footer .copyright-text',
			'container_inclusive' => true,
			'render_callback' => 'footer_copyright_section',
			'fallback_refresh' => true,
		)
	);

	// Copyright Text
	$wp_customize->add_setting(
    	'opemia_footer_copyright_text',
    	array(
	        'default'			=> esc_html__( 'Copyright © 2021, OPEMIA. All Right Reserved', 'opemia' ),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'opemia_sanitize_html'
		)
	);

	$wp_customize->add_control( 
		'opemia_footer_copyright_text',
		array(
		    'label'   		=> __('Copyright Content','opemia'),
		    'section'		=> 'footer_copyright_section',
			'settings'   	=> 'opemia_footer_copyright_text',
			'type' 			=> 'textarea',
		)  
	);

    $wp_customize->add_setting( 
    	'footer_bottom_bg' , 
    	array(
    		'default'			=> esc_url(get_template_directory_uri() .'/assets/images/footer-bg2.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'opemia_sanitize_url',
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'footer_bottom_bg' ,
		array(
			'label'          => esc_html__( 'Background Image', 'opemia' ),
			'section'        => 'footer_copyright_section',
			'settings'   	 => 'footer_bottom_bg',
		)
	));

	// Footer Menu
	$wp_customize->add_section(
        'footer_menu_section',
        array(
            'title' 		=> __('Menu','opemia'),
			'panel'  		=> 'footer_section',
		)
    );

	$wp_customize->add_setting( 
		'footer_menu', 
		array(
			'default'			=> '1',
			'capability' 		=> 'edit_theme_options',
			'sanitize_callback' => 'opemia_sanitize_checkbox',
			'transport'         => $selective_refresh,
		)
	);
	
	$wp_customize->add_control(
		'footer_menu',
		array(
			'type'    => 'checkbox',
			'section' => 'footer_menu_section',
			'label'	  => esc_html__( 'Hide / Show Footer Menu', 'opemia' ),
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'footer_menu',
		array(
			'selector' => '.bottom-footer ul.bt-links',
			'container_inclusive' => true,
			'render_callback' => 'footer_menu_section',
			'fallback_refresh' => true,
		)
	);
}

add_action( 'customize_register', 'opemia_customizer_footer' );
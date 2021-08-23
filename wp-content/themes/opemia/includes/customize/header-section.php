<?php

function opemia_header_setting( $wp_customize ) {

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
	
	$wp_customize->remove_control("header_image");

	$wp_customize->add_panel(
		'header_section',
		array(
			'priority'      => 30,
			'capability' =>'edit_theme_options',
			'title' => __('Header','opemia'),
		)
	);

	$wp_customize->add_section(
        'title_tagline',
        array(
        	'priority'      => 1,
            'title' 		=> esc_html__('Site Identity','opemia'),
			'panel'  		=> 'header_section',
		)
    );

	// Header Search
	$wp_customize->add_section(
        'header_search',
        array(
        	'priority'      => 3,
            'title' 		=> esc_html__('Header Search','opemia'),
			'panel'  		=> 'header_section',
		)
    );

    $wp_customize->add_setting(
		'enable_header_search',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => true,
			'sanitize_callback' => 'opemia_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'enable_header_search',
		array(
			'type'     => 'checkbox',
			'section'  => 'header_search',
			'label'    => __( 'Show search in header', 'opemia' ),
		)
	);

	// Call to Action Button
	$wp_customize->add_section(
        'header_cta_button',
        array(
        	'priority'      => 4,
            'title' 		=> __('Button Setting','opemia'),
			'panel'  		=> 'header_section',
		)
    );

	$wp_customize->add_setting(
		'opemia_show_button',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => true,
			'sanitize_callback' => 'opemia_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'opemia_show_button',
		array(
			'type'     => 'checkbox',
			'section'  => 'header_cta_button',
			'label'    => __( 'Hide / Show Call to Action', 'opemia' ),
		)
	);
	
	$wp_customize->add_setting(
    	'opemia_button_label',
    	array(
			'sanitize_callback' => 'opemia_sanitize_text',
			'capability' => 'edit_theme_options',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control( 
		'opemia_button_label',
		array(
		    'label'   		=> __('Button Label','opemia'),
		    'section' 		=> 'header_cta_button',
			'type'		 =>	'text',
		)
	);

	$wp_customize->add_setting(
    	'opemia_button_link',
    	array(
			'sanitize_callback' => 'opemia_sanitize_url',
			'capability' => 'edit_theme_options',
		)
	);	

	$wp_customize->add_control( 
		'opemia_button_link',
		array(
		    'label'   		=> __('Button Link','opemia'),
		    'section' 		=> 'header_cta_button',
			'type'		 =>	'url',
		)
	);
}

add_action( 'customize_register', 'opemia_header_setting' );
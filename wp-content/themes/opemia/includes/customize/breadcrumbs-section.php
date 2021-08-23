<?php

function opemia_breadcrumbs_setting( $wp_customize ) {

	$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';
		
	$wp_customize->add_panel( 
		'opemia_breadcrumbs_settings', 
		array(
			'priority'      => 30,
			'capability'    => 'edit_theme_options',
			'title'			=> __('Breadcrumbs', 'opemia'),
		)
	);

	$wp_customize->add_section(
        'breadcrumbs_section',
        array(
        	'priority'      => 1,
            'title' 		=> __('Breadcrumbs','opemia'),
			'panel'  		=> 'opemia_breadcrumbs_settings',
		)
    );

	$wp_customize->add_setting(
		'opemia_display_breadcrumb',
		array(
			'capability'        => 'edit_theme_options',
			'default'           => true,
			'sanitize_callback' => 'opemia_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		'opemia_display_breadcrumb',
		array(
			'type'     => 'checkbox',
			'section'  => 'breadcrumbs_section',
			'label'    => __( 'Hide / Show Breadcrumbs', 'opemia' ),
		)
	);

	$wp_customize->selective_refresh->add_partial(
		'opemia_display_breadcrumb',
		array(
			'selector' => '.pager-sec',
			'container_inclusive' => true,
			'render_callback' => 'breadcrumbs_section',
			'fallback_refresh' => true,
		)
	);

	// Background Image // 
    $wp_customize->add_setting( 
    	'breadcrumb_background_bg' , 
    	array(
			'default' 			=> esc_url(get_template_directory_uri() .'/assets/images/pager-bg.jpg'),
			'capability'     	=> 'edit_theme_options',
			'sanitize_callback' => 'opemia_sanitize_url',	
		) 
	);
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize , 'breadcrumb_background_bg' ,
		array(
			'label'          => __( 'Background Image', 'opemia' ),
			'section'        => 'breadcrumbs_section',
			'settings'   	 => 'breadcrumb_background_bg',
		) 
	));
}

add_action( 'customize_register', 'opemia_breadcrumbs_setting' );
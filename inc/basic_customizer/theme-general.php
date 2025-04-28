<?php

/**
 * Color Section Options
 * This function registers customizer settings and controls for the "Color" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_general_section( $wp_customize ) {



    // Panel or Section (you can group all colors into one section)
    $wp_customize->add_section( 'theme_general_options', [
        'title'    => __( 'General Settings', 'arnabwp' ),
        'description' => __('Control the general settings of the theme', 'arnabwp'),
        'priority' => 10,
        'panel'    => 'arnabwp_theme_basic_options_panel',
    ] );

    $wp_customize->add_setting('arnabwp_container_width', [
        'default'           => 1200,
        'sanitize_callback' => 'absint',
    ]);
    
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_container_width',
        [
            'label'       => __('Site Container Width (px)', 'arnabwp'),
            'section'     => 'theme_general_options',
            'settings'    => 'arnabwp_container_width',
            'input_attrs' => [
                'min'  => 960,
                'max'  => 1920,
                'step' => 1,
            ],
            'class'     => 'arnabwp-range-control',
        ]
    ));

    $wp_customize->add_setting( 'enable_scroll_to_top', array(
        'default'   => '1', // Default is enabled
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'enable_scroll_to_top_control', 
        [
        'label'      => __( 'Enable Scroll to Top', 'arnabwp' ),
        'section'    => 'theme_general_options',
        'settings'   => 'enable_scroll_to_top',
        'type'       => 'checkbox',
    ]
    ));
}
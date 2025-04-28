<?php

/**
 * Color Section Options
 * This function registers customizer settings and controls for the "Color" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_preloader_section( $wp_customize ) {



    // Panel or Section (you can group all colors into one section)
    $wp_customize->add_section( 'theme_preloader_options', [
        'title'    => __( 'Preloader Settings', 'arnabwp' ),
        'description' => __('Control preloaders of the theme', 'arnabwp'),
        'priority' => 5,
        'panel'    => 'arnabwp_theme_basic_options_panel',
    ] );

    // Enable Toggle
    $wp_customize->add_setting('arnabwp_preloader_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'arnabwp_preloader_enable',
        [
            'label'   => __('Enable Feature Section', 'arnabwp'),
            'section' => 'theme_preloader_options',
        ]
    ));

    // Preloader Background Color
    $wp_customize->add_setting('preloader_background_color', [
        'default'           => '#ffffff', // Default white background
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'preloader_background_color', [
        'label'    => __('Preloader Background Color', 'arnabwp'),
        'section'  => 'theme_preloader_options',
        'settings' => 'preloader_background_color',
    ]));

    // Preloader Spinner Color
    $wp_customize->add_setting('preloader_spinner_color', [
        'default'           => '#007bff', // Default blue spinner
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'preloader_spinner_color', [
        'label'    => __('Preloader Spinner Color', 'arnabwp'),
        'section'  => 'theme_preloader_options',
        'settings' => 'preloader_spinner_color',
    ]));
}


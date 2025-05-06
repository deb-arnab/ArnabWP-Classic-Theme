<?php

/**
 * Preloader Section Options
 * 
 * Registers Customizer settings and controls for the "Preloader Settings" section
 * in the theme options panel.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_preloader_section( $wp_customize ) {

    /**
     * Add Section: Preloader Settings
     */
    $wp_customize->add_section( 'arnabwp_preloader_options', [
        'title'       => __( 'Preloader Settings', 'arnabwp' ),
        'description' => __( 'Control preloader options of the theme.', 'arnabwp' ),
        'priority'    => 5,
        'panel'       => 'arnabwp_theme_basic_options_panel',
    ] );

    /**
     * Preloader Enable Setting
     */
    $wp_customize->add_setting( 'arnabwp_preloader_enable', [
        'default'           => true, // Default is enabled
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    /**
     * Preloader Enable Control
     */
    $wp_customize->add_control( new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
        $wp_customize,
        'arnabwp_preloader_enable',
        [
            'label'    => __( 'Enable Preloader', 'arnabwp' ),
            'section'  => 'arnabwp_preloader_options',
            'settings' => 'arnabwp_preloader_enable',
        ]
    ));

    /**
     * Preloader Background Color Setting
     */
    $wp_customize->add_setting( 'arnabwp_preloader_background_color', [
        'default'           => '#ffffff', // Default background color: white
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    /**
     * Preloader Background Color Control
     */
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'arnabwp_preloader_background_color',
        [
            'label'    => __( 'Preloader Background Color', 'arnabwp' ),
            'section'  => 'arnabwp_preloader_options',
            'settings' => 'arnabwp_preloader_background_color',
        ]
    ));

    /**
     * Preloader Spinner Color Setting
     */
    $wp_customize->add_setting( 'arnabwp_preloader_spinner_color', [
        'default'           => '#187dbc', 
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    /**
     * Preloader Spinner Color Control
     */
    $wp_customize->add_control( new WP_Customize_Color_Control(
        $wp_customize,
        'arnabwp_preloader_spinner_color',
        [
            'label'    => __( 'Preloader Spinner Color', 'arnabwp' ),
            'section'  => 'arnabwp_preloader_options',
            'settings' => 'arnabwp_preloader_spinner_color',
        ]
    ));
}

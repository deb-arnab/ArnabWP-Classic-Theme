<?php

/**
 * General Section Options
 * 
 * Registers Customizer settings and controls for the "General Settings" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_general_section( $wp_customize ) {

    /**
     * Add Section: General Settings
     */
    $wp_customize->add_section( 'theme_general_options', [
        'title'       => __( 'General Settings', 'arnabwp' ),
        'description' => __( 'Control the general settings of the theme.', 'arnabwp' ),
        'priority'    => 10,
        'panel'       => 'arnabwp_theme_basic_options_panel',
    ] );

    /**
     * Site Container Width Setting
     */
    $wp_customize->add_setting( 'arnabwp_container_width', [
        'default'           => 1200, // Default container width in pixels
        'sanitize_callback' => 'absint',
    ]);

    /**
     * Site Container Width Control
     */
    $wp_customize->add_control( new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_container_width',
        [
            'label'       => __( 'Site Container Width (px)', 'arnabwp' ),
            'section'     => 'theme_general_options',
            'settings'    => 'arnabwp_container_width',
            'input_attrs' => [
                'min'  => 960,
                'max'  => 1920,
                'step' => 1,
            ],
            'class'       => 'arnabwp-range-control',
        ]
    ));

    /**
     * Enable Scroll to Top Setting
     */
    $wp_customize->add_setting( 'enable_scroll_to_top', [
        'default'           => '1', // Default is enabled
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    /**
     * Enable Scroll to Top Control
     */
    $wp_customize->add_control( new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'enable_scroll_to_top_control', 
        [
            'label'    => __( 'Enable Scroll to Top', 'arnabwp' ),
            'section'  => 'theme_general_options',
            'settings' => 'enable_scroll_to_top',
            'type'     => 'checkbox',
        ]
    ));

    $wp_customize->add_setting( 'arnabwp_button_padding_top_bottom', [
        'default'           => 10, // Default container width in pixels
        'sanitize_callback' => 'absint',
    ]);


        // Divider: Site Font Family
        $wp_customize->add_setting('arnabwp_site_button_divider', [
            'sanitize_callback' => '__return_null',
        ]);
    
        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'arnabwp_site_button_divider',
            [
                'type'        => 'hidden',
                'section'     => 'theme_general_options',
                'description' => '<hr><strong style="font-size:15px; color:#db007c">Button Settings</strong><hr>',
            ]
        ));

    $wp_customize->add_control( new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_button_padding_top_bottom',
        [
            'label'       => __( 'Padding Top/Bottom (px)', 'arnabwp' ),
            'section'     => 'theme_general_options',
            'settings'    => 'arnabwp_button_padding_top_bottom',
            'input_attrs' => [
                'min'  => 0,
                'max'  => 50,
                'step' => 1,
            ],
            'class'       => 'arnabwp-range-control',
        ]
    ));

    $wp_customize->add_setting( 'arnabwp_button_padding_left_right', [
        'default'           => 15, // Default container width in pixels
        'sanitize_callback' => 'absint',
    ]);

    /**
     * Site Container Width Control
     */
    $wp_customize->add_control( new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_button_padding_left_right',
        [
            'label'       => __( 'Padding Left/Right (px)', 'arnabwp' ),
            'section'     => 'theme_general_options',
            'settings'    => 'arnabwp_button_padding_left_right',
            'input_attrs' => [
                'min'  => 0,
                'max'  => 50,
                'step' => 1,
            ],
            'class'       => 'arnabwp-range-control',
        ]
    ));

    $wp_customize->add_setting( 'arnabwp_button_radius', [
        'default'           => 5, // Default container width in pixels
        'sanitize_callback' => 'absint',
    ]);

    /**
     * Site Container Width Control
     */
    $wp_customize->add_control( new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_button_radius',
        [
            'label'       => __( 'Radius (px)', 'arnabwp' ),
            'section'     => 'theme_general_options',
            'settings'    => 'arnabwp_button_radius',
            'input_attrs' => [
                'min'  => 0,
                'max'  => 100,
                'step' => 1,
            ],
            'class'       => 'arnabwp-range-control',
        ]
    ));

    
}
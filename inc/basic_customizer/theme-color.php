<?php

/**
 * Color Section Options
 * This function registers customizer settings and controls for the "Color" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_color_section( $wp_customize ) {



    // Panel or Section (you can group all colors into one section)
    $wp_customize->add_section( 'theme_color_options', [
        'title'    => __( 'Color Scheme', 'arnabwp' ),
        'description' => __('Control the colors of the theme', 'arnabwp'),
        'priority' => 15,
        'panel'    => 'arnabwp_theme_basic_options_panel',
    ] );

    // Settings and Controls
    $color_settings = [
        'primary_color'   => __( 'Primary Color', 'arnabwp' ),
        'secondary_color' => __( 'Secondary Color', 'arnabwp' ),
        'custom_background_color'=> __( 'Background Color', 'arnabwp' ),
        'text_color'           => __( 'Text Color', 'arnabwp' ),
        'heading_color'   => __( 'Heading Color', 'arnabwp' ),
        'link_color'      => __( 'Link Color', 'arnabwp' ),
        'button_color'    => __( 'Button Background Color', 'arnabwp' ),
        'button_text_color'=> __( 'Button Text Color', 'arnabwp' ),
    ];

    foreach ( $color_settings as $setting => $label ) {
        $wp_customize->add_setting( $setting, [
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ] );

        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting, [
            'label'    => $label,
            'section'  => 'theme_color_options',
            'settings' => $setting,
        ] ) );
    }
}



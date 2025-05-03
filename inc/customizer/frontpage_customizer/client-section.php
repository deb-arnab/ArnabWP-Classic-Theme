<?php

/**
 * Client Section Options
 * This function registers customizer settings and controls for the "Client" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_client_section($wp_customize)
{

    // === Section ===
    $wp_customize->add_section('arnabwp_client_section', array(
        'title'    => __('Clients', 'arnabwp'),
        'panel'    => 'arnabwp_frontpage_panel',
        'priority' => 50,
    ));

    // Divider: Show/Hide Controls
    $wp_customize->add_setting('arnabwp_client_toggle_divider', [
        'sanitize_callback' => '__return_false',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_client_toggle_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_client_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Section</strong><hr>',
        ]
    ));
    // Enable Toggle
    $wp_customize->add_setting('arnabwp_client_section_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'arnabwp_client_section_enable',
        [
            'label'   => __('Enable Client Section', 'arnabwp'),
            'section' => 'arnabwp_client_section',
        ]
    ));

    // ========== Divider: Background Settings ==========
    $wp_customize->add_setting('arnabwp_client_divider_background', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_client_divider_background',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_client_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Background Settings</strong><hr>',
        ]
    ));

    $wp_customize->add_setting('client_section_bg_type', [
        'default'           => 'none',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('client_section_bg_type', [
        'label'   => __('Background Type', 'arnabwp'),
        'section' => 'arnabwp_client_section',
        'type'    => 'select',
        'choices' => [
            'none'  => __('None', 'arnabwp'),
            'color' => __('Color', 'arnabwp'),
            'image' => __('Image', 'arnabwp'),
        ],
    ]);

    $wp_customize->add_setting('client_section_bg_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'client_section_bg_color',
        [
            'label'    => __('Background Color', 'arnabwp'),
            'section'  => 'arnabwp_client_section',
            'settings' => 'client_section_bg_color',
            'active_callback' => function () {
                return get_theme_mod('client_section_bg_type') === 'color';
            },
        ]
    ));

    // === Background Image ===
    $wp_customize->add_setting('client_section_bg_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'client_section_bg_image',
        [
            'label'    => __('Background Image', 'arnabwp'),
            'section'  => 'arnabwp_client_section',
            'settings' => 'client_section_bg_image',
            'active_callback' => function () {
                return get_theme_mod('client_section_bg_type') === 'image';
            },
        ]
    ));

    // === Background Scroll Effect ===
    $wp_customize->add_setting('client_section_bg_scroll', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'client_section_bg_scroll',
        [
            'label'    => __('Enable Scroll Effect', 'arnabwp'),
            'section'  => 'arnabwp_client_section',
            'active_callback' => function () {
                return get_theme_mod('client_section_bg_type') === 'image';
            },
        ]
    ));
}

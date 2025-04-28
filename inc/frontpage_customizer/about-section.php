<?php

/**
 * About Section Options
 * This function registers customizer settings and controls for the "About" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_about_section($wp_customize)
{

    // === Section ===
    $wp_customize->add_section('arnabwp_about_section', array(
        'title'    => __('About Section', 'arnabwp'),
        'panel'    => 'arnabwp_frontpage_panel',
        'priority' => 30,
    ));

    // Divider: Show/Hide Controls
    $wp_customize->add_setting('arnabwp_about_toggle_divider', [
        'sanitize_callback' => '__return_null',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_about_toggle_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_about_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Section</strong><hr>',
        ]
    ));
    // Enable Toggle
    $wp_customize->add_setting('arnabwp_about_section_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'arnabwp_about_section_enable',
        [
            'label'   => __('Enable About Section', 'arnabwp'),
            'section' => 'arnabwp_about_section',
        ]
    ));

    // ========== Divider: Background Settings ==========
    $wp_customize->add_setting('arnabwp_about_divider_background', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_about_divider_background',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_about_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Background Settings</strong><hr>',
        ]
    ));

    // === Background Image ===
    $wp_customize->add_setting('about_section_bg_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'about_section_bg_image',
        [
            'label'    => __('Background Image', 'arnabwp'),
            'section'  => 'arnabwp_about_section',
            'settings' => 'about_section_bg_image',
        ]
    ));

    // === Background Scroll Effect ===
    $wp_customize->add_setting('about_section_bg_scroll', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'about_section_bg_scroll',
        [
            'label'    => __('Enable Scroll Effect', 'arnabwp'),
            'section'  => 'arnabwp_about_section',
        ]
    ));

    // ========== Divider: Content Settings ==========
    $wp_customize->add_setting('arnabwp_about_divider_content', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_about_divider_content',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_about_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Content Settings</strong><hr>',
        ]
    ));

    // === Title ===
    $wp_customize->add_setting('about_section_title', [
        'default'           => 'About Us',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('about_section_title', [
        'label'    => __('Title', 'arnabwp'),
        'section'  => 'arnabwp_about_section',
        'type'     => 'text',
    ]);

    // === Subtitle ===
    $wp_customize->add_setting('about_section_subtitle', [
        'default'           => 'Who We Are',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('about_section_subtitle', [
        'label'    => __('Subtitle', 'arnabwp'),
        'section'  => 'arnabwp_about_section',
        'type'     => 'text',
    ]);

    // === Description ===
    $wp_customize->add_setting('about_section_description', [
        'default'           => 'We are a passionate team delivering top-tier solutions.',
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('about_section_description', [
        'label'    => __('Description', 'arnabwp'),
        'section'  => 'arnabwp_about_section',
        'type'     => 'textarea',
    ]);


    // ========== Divider: Image Settings ==========
    $wp_customize->add_setting('arnabwp_about_divider_image', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_about_divider_image',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_about_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Image Settings</strong><hr>',
        ]
    ));

    // === Image ===
    $wp_customize->add_setting('about_section_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new \WP_Customize_Image_Control(
        $wp_customize,
        'about_section_image',
        [
            'label'    => __('About Image', 'arnabwp'),
            'section'  => 'arnabwp_about_section',
            'settings' => 'about_section_image',
        ]
    ));


    // ========== Divider: Button Settings ==========
    $wp_customize->add_setting('arnabwp_about_divider_button', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_about_divider_button',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_about_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Button Settings</strong><hr>',
        ]
    ));

    // === Button Text ===
    $wp_customize->add_setting('about_section_button_text', [
        'default'           => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('about_section_button_text', [
        'label'    => __('Button Text', 'arnabwp'),
        'section'  => 'arnabwp_about_section',
        'type'     => 'text',
    ]);

    // === Button URL ===
    $wp_customize->add_setting('about_section_button_url', [
        'default'           => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('about_section_button_url', [
        'label'    => __('Button URL', 'arnabwp'),
        'section'  => 'arnabwp_about_section',
        'type'     => 'url',
    ]);
}

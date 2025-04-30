<?php

/**
 * Feature Section Options
 * This function registers customizer settings and controls for the "Features" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_feature_section($wp_customize)
{

    // === Add Section === //
    $wp_customize->add_section('arnabwp_feature_section', [
        'title'    => __('Features', 'arnabwp'),
        'panel'    => 'arnabwp_frontpage_panel',
        'priority' => 20,
    ]);

    $wp_customize->add_setting('arnabwp_current_features_tab', [
        'default'           => 'general',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Tabs_Control(
        $wp_customize,
        'arnabwp_current_features_tab',
        [

            'section' => 'arnabwp_feature_section', // Ensure this is your desired section.
            'settings' => 'arnabwp_current_features_tab',
            'tabs' => [
                'general' => __('General', 'arnabwp'),
                'style' => __('Styles', 'arnabwp'),
            ],
        ]
    ));

    // Divider: Show/Hide Controls
    $wp_customize->add_setting('arnabwp_feature_toggle_divider', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_feature_toggle_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Section</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'general',
        ]
    ));

    // Enable Toggle
    $wp_customize->add_setting('arnabwp_feature_section_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'arnabwp_feature_section_enable',
        [
            'label'   => __('Enable Feature Section', 'arnabwp'),
            'section' => 'arnabwp_feature_section',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'general',
        ]
    ));

    // ========== Divider: Section Basics ========== //
    $wp_customize->add_setting('arnabwp_divider_feature_basics', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_feature_basics',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Section Basics</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'general',
        ]
    ));

    // === Service Count === //
    $wp_customize->add_setting('arnabwp_feature_service_count', [
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('arnabwp_feature_service_count', [
        'label'       => __('Number of Services to Show', 'arnabwp'),
        'section'     => 'arnabwp_feature_section',
        'type'        => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 6,
        ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'general',
    ]);

    // === Section Title === //
    $wp_customize->add_setting('arnabwp_service_section_title', [
        'default'           => 'Our Services',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('arnabwp_service_section_title', [
        'label'   => __('Section Title', 'arnabwp'),
        'section' => 'arnabwp_feature_section',
        'type'    => 'text',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'general',
    ]);

    // === Section Description === //
    $wp_customize->add_setting('arnabwp_service_section_description', [
        'default'           => 'What we offer for your needs',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('arnabwp_service_section_description', [
        'label'   => __('Section Description', 'arnabwp'),
        'section' => 'arnabwp_feature_section',
        'type'    => 'text',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'general',
    ]);

    // ========== Divider: Service Name Style ========== //
    $wp_customize->add_setting('arnabwp_divider_service_name_style', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_service_name_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Service Name Style</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
        ]
    ));

    // === Font Size: Service Name === //
    $wp_customize->add_setting('arnabwp_service_name_font_size', [
        'default'           => 18,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_service_name_font_size',
        [
            'label'       => __('Service Name Font Size', 'arnabwp'),
            'section'     => 'arnabwp_feature_section',
            'type'        => 'number',
            'input_attrs' => [
                'min'  => 10,
                'max'  => 30,
                'step' => 1,
            ],
            'class'     => 'arnabwp-range-control',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
        ]
    ));

    // === Color: Service Name === //
    $wp_customize->add_setting('arnabwp_service_name_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_service_name_color', [
        'label'   => __('Service Name Color', 'arnabwp'),
        'section' => 'arnabwp_feature_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
    ]));

    // ========== Divider: Service Description Style ========== //
    $wp_customize->add_setting('arnabwp_divider_service_description_style', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_service_description_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Service Description Style</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
        ]
    ));

    // === Font Size: Service Description === //
    $wp_customize->add_setting('arnabwp_service_description_font_size', [
        'default'           => 14,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_service_description_font_size',
        [
            'label'       => __('Service Description Font Size', 'arnabwp'),
            'section'     => 'arnabwp_feature_section',
            'type'        => 'range',
            'input_attrs' => [
                'min'  => 10,
                'max'  => 30,
                'step' => 1,
            ],
            'class'     => 'arnabwp-range-control',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
        ]
    ));

    // === Color: Service Description === //
    $wp_customize->add_setting('arnabwp_service_description_color', [
        'default'           => '#dddddd',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_service_description_color', [
        'label'   => __('Service Description Color', 'arnabwp'),
        'section' => 'arnabwp_feature_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
    ]));

    // ========== Divider: Icon Style ========== //
    $wp_customize->add_setting('arnabwp_divider_service_icon_style', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_service_icon_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Icon Style</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
        ]
    ));

    // === Icon Size === //
    $wp_customize->add_setting('arnabwp_service_icon_size', [
        'default'           => 70,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_service_icon_size',
        [
            'label'       => __('Service Icon Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_feature_section',
            'type'        => 'range',
            'input_attrs' => [
                'min'  => 50,
                'max'  => 200,
                'step' => 1,
            ],
            'class'     => 'arnabwp-range-control',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
        ]
    ));

    // === Icon Border Radius === //
    $wp_customize->add_setting('arnabwp_service_icon_radius', [
        'default'           => 50,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_service_icon_radius',
        [
            'label'       => __('Service Icon Border Radius (%)', 'arnabwp'),
            'section'     => 'arnabwp_feature_section', // fixed typo: was 'feature_section'
            'type'        => 'range',
            'input_attrs' => [
                'min'  => 0,
                'max'  => 100,
                'step' => 1,
            ],
            'class'     => 'arnabwp-range-control',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_features_tab', 'general') === 'style',
        ]
    ));
}

// ===================== //
// === Sanitize Callbacks === //
// ===================== //

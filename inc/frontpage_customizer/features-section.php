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

    // Divider: Show/Hide Controls
    $wp_customize->add_setting('arnabwp_feature_toggle_divider', [
        'sanitize_callback' => '__return_null',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_feature_toggle_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Section</strong><hr>',
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
        ]
    ));

    // ========== Divider: Section Basics ========== //
    $wp_customize->add_setting('divider_feature_basics', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_feature_basics',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Section Basics</strong><hr>',
        ]
    ));

    // === Service Count === //
    $wp_customize->add_setting('feature_service_count', [
        'default'           => 3,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('feature_service_count', [
        'label'       => __('Number of Services to Show', 'arnabwp'),
        'section'     => 'arnabwp_feature_section',
        'type'        => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 6,
        ],
    ]);

    // === Section Title === //
    $wp_customize->add_setting('service_section_title', [
        'default'           => 'Our Services',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('service_section_title', [
        'label'   => __('Section Title', 'arnabwp'),
        'section' => 'arnabwp_feature_section',
        'type'    => 'text',
    ]);

    // === Section Description === //
    $wp_customize->add_setting('service_section_description', [
        'default'           => 'What we offer for your needs',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('service_section_description', [
        'label'   => __('Section Description', 'arnabwp'),
        'section' => 'arnabwp_feature_section',
        'type'    => 'text',
    ]);

    // ========== Divider: Service Name Style ========== //
    $wp_customize->add_setting('divider_service_name_style', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_service_name_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Service Name Style</strong><hr>',
        ]
    ));

    // === Font Size: Service Name === //
    $wp_customize->add_setting('service_name_font_size', [
        'default'           => 18,
        'sanitize_callback' => 'arnabwp_sanitize_service_name_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'service_name_font_size', [
        'label'       => __('Service Name Font Size', 'arnabwp'),
        'section'     => 'arnabwp_feature_section',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 16,
            'max'  => 26,
            'step' => 1,
        ],
        'class'     => 'arnabwp-range-control',
    ]
    ));

    // === Color: Service Name === //
    $wp_customize->add_setting('service_name_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'service_name_color', [
        'label'   => __('Service Name Color', 'arnabwp'),
        'section' => 'arnabwp_feature_section',
    ]));

    // ========== Divider: Service Description Style ========== //
    $wp_customize->add_setting('divider_service_description_style', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_service_description_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Service Description Style</strong><hr>',
        ]
    ));

    // === Font Size: Service Description === //
    $wp_customize->add_setting('service_description_font_size', [
        'default'           => 14,
        'sanitize_callback' => 'arnabwp_sanitize_service_description_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'service_description_font_size', [
        'label'       => __('Service Description Font Size', 'arnabwp'),
        'section'     => 'arnabwp_feature_section',
        'type'        => 'range',
        'input_attrs' => [
            'min'  => 12,
            'max'  => 20,
            'step' => 1,
        ],
        'class'     => 'arnabwp-range-control',
    ]
    ));

    // === Color: Service Description === //
    $wp_customize->add_setting('service_description_color', [
        'default'           => '#dddddd',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'service_description_color', [
        'label'   => __('Service Description Color', 'arnabwp'),
        'section' => 'arnabwp_feature_section',
    ]));

    // ========== Divider: Icon Style ========== //
    $wp_customize->add_setting('divider_service_icon_style', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_service_icon_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_feature_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Icon Style</strong><hr>',
        ]
    ));

    // === Icon Size === //
    $wp_customize->add_setting('service_icon_size', [
        'default'           => 70,
        'sanitize_callback' => 'arnabwp_sanitize_service_icon_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'service_icon_size', [
        'label'       => __('Service Icon Size (px)', 'arnabwp'),
        'section'     => 'arnabwp_feature_section',
        'type'        => 'range',
        'input_attrs' => [
            'min'  => 50,
            'max'  => 150,
            'step' => 1,
        ],
        'class'     => 'arnabwp-range-control',
    ]
    ));

    // === Icon Border Radius === //
    $wp_customize->add_setting('service_icon_radius', [
        'default'           => 50,
        'sanitize_callback' => 'arnabwp_sanitize_service_icon_radius',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'service_icon_radius', [
        'label'       => __('Service Icon Border Radius (%)', 'arnabwp'),
        'section'     => 'arnabwp_feature_section', // fixed typo: was 'feature_section'
        'type'        => 'range',
        'input_attrs' => [
            'min'  => 0,
            'max'  => 50,
            'step' => 1,
        ],
        'class'     => 'arnabwp-range-control',
    ]
    ));
}


// ===================== //
// === Sanitize Callbacks === //
// ===================== //

if (! function_exists('arnabwp_sanitize_service_name_font_size')) {
    function arnabwp_sanitize_service_name_font_size($value)
    {
        return max(16, min(26, absint($value)));
    }
}

if (! function_exists('arnabwp_sanitize_service_description_font_size')) {
    function arnabwp_sanitize_service_description_font_size($value)
    {
        return max(12, min(20, absint($value)));
    }
}

if (! function_exists('arnabwp_sanitize_service_icon_size')) {
    function arnabwp_sanitize_service_icon_size($value)
    {
        return max(50, min(150, absint($value)));
    }
}

if (! function_exists('arnabwp_sanitize_service_icon_radius')) {
    function arnabwp_sanitize_service_icon_radius($value)
    {
        return max(0, min(50, absint($value)));
    }
}

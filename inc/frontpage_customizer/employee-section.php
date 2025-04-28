<?php

/**
 * Employee Section Options
 * This function registers customizer settings and controls for the "employee" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_employee_section($wp_customize)
{

    // === Add Section === //
    $wp_customize->add_section('arnabwp_employee_section', [
        'title'    => __('Teams', 'arnabwp'),
        'panel'    => 'arnabwp_frontpage_panel',
        'priority' => 40,
    ]);



    // Divider: Show/Hide Controls
    $wp_customize->add_setting('arnabwp_employee_toggle_divider', [
        'sanitize_callback' => '__return_null',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_employee_toggle_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Section</strong><hr>',
        ]
    ));
    // Enable Toggle
    $wp_customize->add_setting('arnabwp_employee_section_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
        $wp_customize,
        'arnabwp_employee_section_enable',
        [
            'label'   => __('Enable Employee Section', 'arnabwp'),
            'section' => 'arnabwp_employee_section',
        ]
    ));

    // ========== Divider: Section Basics ========== //
    $wp_customize->add_setting('divider_employee_basics', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_employee_basics',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Section Basics</strong><hr>',
        ]
    ));

    // === Employee Count === //
    $wp_customize->add_setting('arnabwp_employee_count', [
        'default'           => 6,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('arnabwp_employee_count', [
        'label'       => __('Number of Employees to Show', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
        'type'        => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 10,
        ],
    ]);

    // === Section Title === //
    $wp_customize->add_setting('arnabwp_employee_section_title', [
        'default'           => 'Meet Our Team',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('arnabwp_employee_section_title', [
        'label'   => __('Section Title', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
        'type'    => 'text',
    ]);

    // === Section Description === //
    $wp_customize->add_setting('arnabwp_employee_section_description', [
        'default'           => 'We’re a passionate group of professionals.',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('arnabwp_employee_section_description', [
        'label'   => __('Section Description', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
        'type'    => 'text',
    ]);


    // ========== Divider: Employee Name Style ========== //
    $wp_customize->add_setting('divider_employee_name_style', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_employee_name_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Employee Name Style</strong><hr>',
        ]
    ));

    // === Font Size:Employee Name === //
    $wp_customize->add_setting('employee_name_font_size', [
        'default'           => 18,
        'sanitize_callback' => 'arnabwp_sanitize_employee_name_font_size',
    ]);
    $wp_customize->add_control('employee_name_font_size', [
        'label'       => __('Employee Name Font Size', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 16,
            'max'  => 26,
            'step' => 1,
        ],
    ]);

    // === Color: Employee Name === //
    $wp_customize->add_setting('employee_name_color', [
        'default'           => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'employee_name_color', [
        'label'   => __('Employee Name Color', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
    ]));

    // ========== Divider: Employee Description Style ========== //
    $wp_customize->add_setting('divider_employee_description_style', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_employee_description_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Employee Description Style</strong><hr>',
        ]
    ));

    // === Font Size: Employee Description === //
    $wp_customize->add_setting('employee_description_font_size', [
        'default'           => 16,
        'sanitize_callback' => 'arnabwp_sanitize_employee_description_font_size',
    ]);
    $wp_customize->add_control('employee_description_font_size', [
        'label'       => __('Employee Description Font Size', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 12,
            'max'  => 20,
            'step' => 1,
        ],
    ]);

    // === Color: Employee Description === //
    $wp_customize->add_setting('employee_description_color', [
        'default'           => '#555555',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'employee_description_color', [
        'label'   => __('Employee Description Color', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
    ]));

    // === Font Size: Employee email === //
    $wp_customize->add_setting('employee_email_font_size', [
        'default'           => 14,
        'sanitize_callback' => 'arnabwp_sanitize_employee_email_font_size',
    ]);
    $wp_customize->add_control('employee_email_font_size', [
        'label'       => __('Employee Email Font Size', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 12,
            'max'  => 20,
            'step' => 1,
        ],
    ]);

    // === Color: Employee email === //
    $wp_customize->add_setting('employee_email_color', [
        'default'           => '#dddddd',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'employee_email_color', [
        'label'   => __('Employee Email Color', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
    ]));

    // === Font Size: Employee sicial icons === //
    $wp_customize->add_setting('employee_social_icon_font_size', [
        'default'           => 12,
        'sanitize_callback' => 'arnabwp_sanitize_employee_social_icon_font_size',
    ]);
    $wp_customize->add_control('employee_social_icon_font_size', [
        'label'       => __('Employee Social Icon Size', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
        'type'        => 'number',
        'input_attrs' => [
            'min'  => 10,
            'max'  => 30,
            'step' => 1,
        ],
    ]);

    // === Color: Employee social icons === //
    $wp_customize->add_setting('employee_social_icon_color', [
        'default'           => '#187dbc',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'employee_social_icon_color', [
        'label'   => __('Employee Social Icons Color', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
    ]));
}


// ===================== //
// === Sanitize Callbacks === //
// ===================== //

if (! function_exists('arnabwp_sanitize_employee_name_font_size')) {
    function arnabwp_sanitize_employee_name_font_size($value)
    {
        return max(16, min(26, absint($value)));
    }
}

if (! function_exists('arnabwp_sanitize_employee_description_font_size')) {
    function arnabwp_sanitize_employee_description_font_size($value)
    {
        return max(12, min(20, absint($value)));
    }
}

if (! function_exists('arnabwp_sanitize_employee_email_font_size')) {
    function arnabwp_sanitize_employee_email_font_size($value)
    {
        return max(12, min(20, absint($value)));
    }
}

if (! function_exists('arnabwp_sanitize_employee_social_icon_font_size')) {
    function arnabwp_sanitize_employee_social_icon_font_size($value)
    {
        return max(10, min(30, absint($value)));
    }
}

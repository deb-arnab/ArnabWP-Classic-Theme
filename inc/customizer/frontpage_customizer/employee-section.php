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

  // === Tabs for UI === //

  $wp_customize->add_setting('arnabwp_current_employee_tab', [
    'default'           => 'general',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control( new \ARNABWP_THEME\Inc\Customizer\Controls\Tabs_Control( 
    $wp_customize,
    'arnabwp_current_employee_tab', [

    'section' => 'arnabwp_employee_section', // Ensure this is your desired section.
    'settings'=> 'arnabwp_current_employee_tab',
    'tabs' => [
        'general' => __( 'General', 'arnabwp' ),
        'style' => __( 'Styles', 'arnabwp' ),
    ],
]
));

    // Divider: Show/Hide Controls
    $wp_customize->add_setting('arnabwp_employee_toggle_divider', [
        'sanitize_callback' => '__return_false',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_employee_toggle_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Section</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'general',
        ]
    ));
    // Enable Toggle
    $wp_customize->add_setting('arnabwp_employee_section_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
        $wp_customize,
        'arnabwp_employee_section_enable',
        [
            'label'   => __('Enable Employee Section', 'arnabwp'),
            'section' => 'arnabwp_employee_section',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'general',
        ]
    ));

    // ========== Divider: Section Basics ========== //
    $wp_customize->add_setting('arnabwp_divider_employee_basics', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_employee_basics',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Section Basics</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'general',
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
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'general',
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
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'general',
    ]);

    // === Section Description === //
    $wp_customize->add_setting('arnabwp_employee_section_description', [
        'default'           => 'We’re a passionate group of professionals.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('arnabwp_employee_section_description', [
        'label'   => __('Section Description', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
        'type'    => 'textarea',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'general',
    ]);


    // ========== Divider: Employee Name Style ========== //
    $wp_customize->add_setting('arnabwp_divider_employee_name_style', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_employee_name_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Employee Name Style</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
        ]
    ));

    // === Font Size:Employee Name === //
    $wp_customize->add_setting('arnabwp_employee_name_font_size', [
        'default' => json_encode([
            'desktop' => '20',
            'tablet'  => '18',
            'mobile'  => '16'
        ]),
        'transport' => 'refresh',
       'sanitize_callback' => 'arnabwp_sanitize_employee_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Responsive_Range_Control(
        $wp_customize,
        'arnabwp_employee_name_font_size', [
        'label'       => __('Employee Name Font Size', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
        'input_attrs' => [
            'min' => 6,
            'max' => 100,
            'step' => 1,
            'default_desktop' => 20,
        'default_tablet'  => 18,
        'default_mobile'  => 16,
        ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
    ]
    ));

    // === Color: Employee Name === //
    $wp_customize->add_setting('arnabwp_employee_name_color', [
        'default'           => '#187dbc',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_employee_name_color', [
        'label'   => __('Employee Name Color', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
    ]));

    // ========== Divider: Employee Description Style ========== //
    $wp_customize->add_setting('arnabwp_divider_employee_description_style', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_employee_description_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Employee Description Style</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
        ]
    ));

    // === Font Size: Employee Description === //
    $wp_customize->add_setting('arnabwp_employee_description_font_size', [
        'default' => json_encode([
            'desktop' => '16',
            'tablet'  => '14',
            'mobile'  => '12'
        ]),
        'transport' => 'refresh',
       'sanitize_callback' => 'arnabwp_sanitize_employee_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Responsive_Range_Control(
        $wp_customize,
        'arnabwp_employee_description_font_size', [
        'label'       => __('Employee Description Font Size', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
        'input_attrs' => [
            'min' => 6,
            'max' => 100,
            'step' => 1,
            'default_desktop' => 16,
        'default_tablet'  => 14,
        'default_mobile'  => 12,
        ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
    ]
    ));

    // === Color: Employee Description === //
    $wp_customize->add_setting('arnabwp_employee_description_color', [
        'default'           => '#555555',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_employee_description_color', [
        'label'   => __('Employee Description Color', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
    ]));

       // ========== Divider: Employee social_link Style ========== //
       $wp_customize->add_setting('arnabwp_divider_employee_social_link_style', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_employee_social_link_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_employee_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Employee Social Link Style</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
        ]
    ));

    // === Font Size: Employee email === //
    $wp_customize->add_setting('arnabwp_employee_email_font_size', [
        'default' => json_encode([
            'desktop' => '14',
            'tablet'  => '12',
            'mobile'  => '10'
        ]),
        'transport' => 'refresh',
       'sanitize_callback' => 'arnabwp_sanitize_employee_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Responsive_Range_Control(
        $wp_customize,
        'arnabwp_employee_email_font_size', [
        'label'       => __('Employee Email Font Size', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
       'input_attrs' => [
                'min' => 6,
                'max' => 100,
                'step' => 1,
                'default_desktop' => 14,
            'default_tablet'  => 12,
            'default_mobile'  => 10,
            ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
    ]
    ));

    // === Color: Employee email === //
    $wp_customize->add_setting('arnabwp_employee_email_color', [
        'default'           => '#e83582',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_employee_email_color', [
        'label'   => __('Employee Email Color', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
    ]));

    // === Font Size: Employee sicial icons === //
    $wp_customize->add_setting('arnabwp_employee_social_icon_font_size', [
        'default' => json_encode([
            'desktop' => '18',
            'tablet'  => '16',
            'mobile'  => '14'
        ]),
        'transport' => 'refresh',
       'sanitize_callback' => 'arnabwp_sanitize_employee_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Responsive_Range_Control(
        $wp_customize,
        'arnabwp_employee_social_icon_font_size', [
        'label'       => __('Employee Social Icon Size', 'arnabwp'),
        'section'     => 'arnabwp_employee_section',
     'input_attrs' => [
                'min' => 6,
                'max' => 100,
                'step' => 1,
                'default_desktop' => 18,
            'default_tablet'  => 16,
            'default_mobile'  => 14,
            ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
    ]
    ));

    // === Color: Employee social icons === //
    $wp_customize->add_setting('arnabwp_employee_social_icon_color', [
        'default'           => '#e83582',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_employee_social_icon_color', [
        'label'   => __('Employee Social Icons Color', 'arnabwp'),
        'section' => 'arnabwp_employee_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_employee_tab', 'general') === 'style',
    ]));
}


// ===================== //
// === Sanitize Callbacks === //
// ===================== //

function arnabwp_sanitize_employee_font_size($value) {
    // Decode the JSON value into an associative array
    $decoded = json_decode( $value, true );

    // If decoding failed or the result is not an array, return a default size
    if ( ! is_array( $decoded ) ) {
        return json_encode([
            'desktop' => 16,
            'tablet'  => 14,
            'mobile'  => 12
        ]);
    }

    // Sanitize each device size
    foreach ( $decoded as $device => $size ) {
        // Ensure size is numeric and within a reasonable range
        if ( ! is_numeric( $size ) || $size < 6 || $size > 100 ) {
            // Set to a reasonable default if invalid
            $decoded[ $device ] = ($device === 'desktop') ? 16 : ($device === 'tablet' ? 14 : 12);
        } else {
            // Sanitize the value to a positive integer
            $decoded[ $device ] = absint( $size );
        }
    }

    // Return the sanitized array as a JSON-encoded string
    return json_encode( $decoded );
}

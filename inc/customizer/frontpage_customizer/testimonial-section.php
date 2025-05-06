<?php

/**
 * Testimonial Section Options
 * This function registers customizer settings and controls for the "Testimonial" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_testimonial_section($wp_customize)
{

    // === Add Section === //
    $wp_customize->add_section('arnabwp_testimonial_section', [
        'title'    => __('Testimonials', 'arnabwp'),
        'panel'    => 'arnabwp_frontpage_panel',
        'priority' => 60,
    ]);

// === Tabs for UI Switching (Custom Control) === //
$wp_customize->add_setting('arnabwp_current_testimonial_tab', [
    'default'           => 'general',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Tabs_Control(
    $wp_customize,
    'arnabwp_current_testimonial_tab', [
        'section'  => 'arnabwp_testimonial_section',
        'settings' => 'arnabwp_current_testimonial_tab',
        'tabs'     => [
            'general' => __('General', 'arnabwp'),
            'style'   => __('Styles', 'arnabwp'),
            'icon'   => __('Image', 'arnabwp'),
        ],
    ]
));

    // Divider: Show/Hide Controls
    $wp_customize->add_setting('arnabwp_testimonial_toggle_divider', [
        'sanitize_callback' => '__return_false',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_testimonial_toggle_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_testimonial_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Section</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'general',
        ]
    ));
    // Enable Toggle
    $wp_customize->add_setting('arnabwp_testimonial_section_enable', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
        $wp_customize,
        'arnabwp_testimonial_section_enable',
        [
            'label'   => __('Enable Testimonial Section', 'arnabwp'),
            'section' => 'arnabwp_testimonial_section',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'general',
        ]
    ));

        // Setting to enable/disable quotation mark above comments
        $wp_customize->add_setting('arnabwp_show_testimonial_quotation_mark', [
            'default'   => true,
            'transport' => 'refresh',
            'sanitize_callback' => 'wp_validate_boolean',
        ]);
    
        $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
            $wp_customize,
            'arnabwp_show_testimonial_quotation_mark',
            [
                'label'    => __('Show Quotation Mark Above Comments', 'arnabwp'),
                'section'  => 'arnabwp_testimonial_section',
                'type'     => 'checkbox',
                'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'general',
            ]
        ));

    // ========== Divider: Section Basics ========== //
    $wp_customize->add_setting('arnabwp_divider_testimonial_basics', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_testimonial_basics',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_testimonial_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Testimonial Contents</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'general',
        ]
    ));

    // === Section Title === //
    $wp_customize->add_setting('arnabwp_testimonial_section_title', [
        'default'           => 'What Our Clients Say',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('arnabwp_testimonial_section_title', [
        'label'   => __('Section Title', 'arnabwp'),
        'section' => 'arnabwp_testimonial_section',
        'type'    => 'text',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'general',
    ]);

    // === Section Description === //
    $wp_customize->add_setting('arnabwp_testimonial_section_description', [
        'default'           => 'Experience the difference with us',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('arnabwp_testimonial_section_description', [
        'label'   => __('Section Description', 'arnabwp'),
        'section' => 'arnabwp_testimonial_section',
        'type'    => 'text',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'general',
    ]);

    // ========== Divider: Testimonial Content Style ========== //
    $wp_customize->add_setting('arnabwp_divider_testimonial_content_font', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_testimonial_content_font',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_testimonial_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Content Font Size</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
        ]
    ));

 // === Font Size: Name === //
 $wp_customize->add_setting('arnabwp_testimonial_name_font_size', [
    'default' => json_encode([
        'desktop' => '20',
        'tablet'  => '18',
        'mobile'  => '16'
    ]),
    'transport' => 'refresh',
   'sanitize_callback' => 'arnabwp_sanitize_testimonial_font_size',
]);
$wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Responsive_Range_Control(
    $wp_customize,
    'arnabwp_testimonial_name_font_size', [
    'label'       => __('Client Name Font Size', 'arnabwp'),
    'section'     => 'arnabwp_testimonial_section',
    'input_attrs' => [
            'min' => 6,
            'max' => 100,
            'step' => 1,
            'default_desktop' => 20,
        'default_tablet'  => 18,
        'default_mobile'  => 16,
        ],
    'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
]
));

    // === Font Size: Testimonial comment === //
    $wp_customize->add_setting('arnabwp_testimonial_comment_font_size', [
        'default' => json_encode([
            'desktop' => '16',
            'tablet'  => '14',
            'mobile'  => '12'
        ]),
        'transport' => 'refresh',
       'sanitize_callback' => 'arnabwp_sanitize_testimonial_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Responsive_Range_Control(
        $wp_customize,
        'arnabwp_testimonial_comment_font_size', [
        'label'       => __('Client Comment Font Size', 'arnabwp'),
        'section'     => 'arnabwp_testimonial_section',
        'input_attrs' => [
            'min' => 6,
            'max' => 100,
            'step' => 1,
            'default_desktop' => 16,
        'default_tablet'  => 14,
        'default_mobile'  => 12,
        ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
    ]
    ));

    // === Font Size: Job position/Description === //
    $wp_customize->add_setting('arnabwp_testimonial_job_font_size', [
        'default' => json_encode([
            'desktop' => '16',
            'tablet'  => '14',
            'mobile'  => '12'
        ]),
        'transport' => 'refresh',
       'sanitize_callback' => 'arnabwp_sanitize_testimonial_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Responsive_Range_Control(
        $wp_customize,
        'arnabwp_testimonial_job_font_size', [
        'label'       => __('Client Job Font Size', 'arnabwp'),
        'section'     => 'arnabwp_testimonial_section',
        'input_attrs' => [
            'min' => 6,
            'max' => 100,
            'step' => 1,
            'default_desktop' => 16,
        'default_tablet'  => 14,
        'default_mobile'  => 12,
        ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
    ]
    ));

    // === Font Size: social icons === //
    $wp_customize->add_setting('arnabwp_testimonial_social_icon_font_size', [
        'default' => json_encode([
            'desktop' => '18',
            'tablet'  => '16',
            'mobile'  => '14'
        ]),
        'transport' => 'refresh',
       'sanitize_callback' => 'arnabwp_sanitize_testimonial_font_size',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Responsive_Range_Control(
        $wp_customize,
        'arnabwp_testimonial_social_icon_font_size', [
        'label'       => __('Client Social Icon Size', 'arnabwp'),
        'section'     => 'arnabwp_testimonial_section',
     'input_attrs' => [
                'min' => 6,
                'max' => 100,
                'step' => 1,
                'default_desktop' => 18,
            'default_tablet'  => 16,
            'default_mobile'  => 14,
            ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
    ]
    ));

    // ========== Divider: Testimonial Content Style ========== //
    $wp_customize->add_setting('arnabwp_divider_testimonial_content_style', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_testimonial_content_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_testimonial_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Content Color</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
        ]
    ));

    // === Color: Name === //
    $wp_customize->add_setting('arnabwp_testimonial_name_color', [
        'default'           => '#187dbc',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_testimonial_name_color', [
        'label'   => __('Client Name Color', 'arnabwp'),
        'section' => 'arnabwp_testimonial_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
    ]));

    // === Color: Testimonial comment === //
    $wp_customize->add_setting('arnabwp_testimonial_comment_color', [
        'default'           => '#ccc',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_testimonial_comment_color', [
        'label'   => __('Client Comment Color', 'arnabwp'),
        'section' => 'arnabwp_testimonial_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
    ]));

    // === Color: Job position/Description === //
    $wp_customize->add_setting('arnabwp_testimonial_job_color', [
        'default'           => '#555555',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_testimonial_job_color', [
        'label'   => __('Client Job Color', 'arnabwp'),
        'section' => 'arnabwp_testimonial_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
    ]));

       // === Color: social icons === //
       $wp_customize->add_setting('arnabwp_testimonial_social_icon_color', [
        'default'           => '#e83582',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_testimonial_social_icon_color', [
        'label'   => __('Client Social Icons Color', 'arnabwp'),
        'section' => 'arnabwp_testimonial_section',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'style',
    ]));

    // ========== Divider: Icon Style ========== //
    $wp_customize->add_setting('arnabwp_divider_testimonial_icon_style', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_divider_testimonial_icon_style',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_testimonial_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Icon Style</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'icon',
        ]
    ));

    // === Icon Size === //
    $wp_customize->add_setting('arnabwp_testimonial_icon_size', [
        'default'           => 70,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Range_Control(
        $wp_customize,
        'arnabwp_testimonial_icon_size', [
        'label'       => __('Client Image Size Width & Height (px)', 'arnabwp'),
        'section'     => 'arnabwp_testimonial_section',
        'type'        => 'range',
        'input_attrs' => [
            'min'  => 50,
            'max'  => 200,
            'step' => 1,
        ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'icon',
    ]
    ));

    // === Icon Border Radius === //
    $wp_customize->add_setting('arnabwp_testimonial_icon_radius', [
        'default'           => 50,
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Range_Control(
        $wp_customize,
        'arnabwp_testimonial_icon_radius', [
        'label'       => __('Client Image Border Radius (%)', 'arnabwp'),
        'section'     => 'arnabwp_testimonial_section', 
        'type'        => 'range',
        'input_attrs' => [
            'min'  => 0,
            'max'  => 100,
            'step' => 1,
        ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_testimonial_tab', 'general') === 'icon',
    ]
    ));

    

 
    
}


// ===================== //
// === Sanitize Callbacks === //
// ===================== //


function arnabwp_sanitize_testimonial_font_size($value) {
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

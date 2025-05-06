<?php

/**
 * Newsletter Section Options
 * This function registers customizer settings and controls for the "Newsletter" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_newsletter_section($wp_customize)
{

    // === Add Section === //
    $wp_customize->add_section('arnabwp_newsletter_section', [
        'title'    => __('Newsletter', 'arnabwp'),
        'panel'    => 'arnabwp_frontpage_panel',
        'priority' => 80,
    ]);



    $wp_customize->add_setting('arnabwp_current_newsletter_tab', [
        'default'           => 'general',
        'transport'         => 'refresh',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control( new \ARNABWP_THEME\Inc\Customizer\Controls\Tabs_Control( 
        $wp_customize,
        'arnabwp_current_newsletter_tab', [
    
        'section' => 'arnabwp_newsletter_section', // Ensure this is your desired section.
        'settings'=> 'arnabwp_current_newsletter_tab',
        'tabs' => [
            'general' => __( 'General', 'arnabwp' ),
            'content' => __( 'Contents', 'arnabwp' ),
        ],
    ]
    ));

    // Divider: Show/Hide Controls
    $wp_customize->add_setting('arnabwp_newsletter_toggle_divider', [
        'sanitize_callback' => '__return_false',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_newsletter_toggle_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_newsletter_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Section</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'general',
        ]
    ));

     // Show/Hide toggle
     $wp_customize->add_setting( 'show_newsletter_section', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
        $wp_customize, 'show_newsletter_section', [
        'label'   => __( 'Show Newsletter Section', 'arnabwp' ),
        'section' => 'arnabwp_newsletter_section',
        'type'    => 'checkbox',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'general',
    ] 
    ));

    // ========== Divider: Background Settings ==========
    $wp_customize->add_setting('arnabwp_newsletter_divider_background', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_newsletter_divider_background',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_newsletter_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Background Settings</strong><hr>',
            'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'general',
        ]
    ));

    $wp_customize->add_setting('newsletter_section_bg_type', [
        'default'           => 'none',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('newsletter_section_bg_type', [
        'label'   => __('Background Type', 'arnabwp'),
        'section' => 'arnabwp_newsletter_section',
        'type'    => 'select',
        'choices' => [
            'none'  => __('None', 'arnabwp'),
            'color' => __('Color', 'arnabwp'),
            'image' => __('Image', 'arnabwp'),
        ],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'general',
    ]);

    $wp_customize->add_setting('newsletter_section_bg_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'newsletter_section_bg_color',
        [
            'label'    => __('Background Color', 'arnabwp'),
            'section'  => 'arnabwp_newsletter_section',
            'settings' => 'newsletter_section_bg_color',
            'active_callback' => fn() => get_theme_mod('newsletter_section_bg_type') === 'color' && get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'general',
        ]
    ));

    // === Background Image ===
    $wp_customize->add_setting('newsletter_section_bg_image', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'newsletter_section_bg_image',
        [
            'label'    => __('Background Image', 'arnabwp'),
            'section'  => 'arnabwp_newsletter_section',
            'settings' => 'newsletter_section_bg_image',
            'active_callback' => fn() => get_theme_mod('newsletter_section_bg_type') === 'image' && get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'general',
        ]
    ));

    // === Background Scroll Effect ===
    $wp_customize->add_setting('newsletter_section_bg_scroll', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
        $wp_customize,
        'newsletter_section_bg_scroll',
        [
            'label'    => __('Enable Scroll Effect', 'arnabwp'),
            'section'  => 'arnabwp_newsletter_section',
            'active_callback' => fn() => get_theme_mod('newsletter_section_bg_type') === 'image' && get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'general',
        ]
    ));

        // Divider: Section Content
        $wp_customize->add_setting('arnabwp_newsletter_content_divider', [
            'sanitize_callback' => '__return_false',
        ]);
    
        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'arnabwp_newsletter_content_divider',
            [
                'type'        => 'hidden',
                'section'     => 'arnabwp_newsletter_section',
                'description' => '<hr><strong style="font-size:15px; color:#db007c">Newsletter Contents</strong><hr>',
                'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'content',
            ]
        ));

    // Title setting
    $wp_customize->add_setting( 'newsletter_title', [
        'default'           => __( 'Subscribe to Our Newsletter', 'arnabwp' ),
        'sanitize_callback' => 'sanitize_text_field',
    ] );

    $wp_customize->add_control( 'newsletter_title', [
        'label'   => __( 'Title', 'arnabwp' ),
        'section' => 'arnabwp_newsletter_section',
        'type'    => 'text',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'content',
    ] );

    // Description setting
    $wp_customize->add_setting( 'newsletter_description', [
        'default'           => __( 'Get the latest updates and offers.', 'arnabwp' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ] );

    $wp_customize->add_control( 'newsletter_description', [
        'label'   => __( 'Description', 'arnabwp' ),
        'section' => 'arnabwp_newsletter_section',
        'type'    => 'textarea',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'content',
    ] );

     // Shortcode Textarea (User inserts the shortcode here)
     $wp_customize->add_setting( 'newsletter_shortcode', [
        'default'           => '[arnabwp_newsletter_form]',
        'sanitize_callback' => 'sanitize_textarea_field',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'content',
    ] );

    $wp_customize->add_control( 'newsletter_shortcode', [
        'label'   => __( 'Newsletter Shortcode', 'arnabwp' ),
        'section' => 'arnabwp_newsletter_section',
        'type'    => 'textarea',
        'description' => __( 'Insert the newsletter shortcode to display the form.', 'arnabwp' ),
        'input_attrs' => [
    'rows' => 3,
        ],
'active_callback' => fn() => get_theme_mod('arnabwp_current_newsletter_tab', 'general') === 'content',
    ] );
}
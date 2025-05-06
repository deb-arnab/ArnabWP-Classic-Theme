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
function add_general_section($wp_customize)
{

    /**
     * Add Section: General Settings
     */
    $wp_customize->add_section('theme_general_options', [
        'title'       => __('General Settings', 'arnabwp'),
        'priority'    => 10,
        'panel'       => 'arnabwp_theme_basic_options_panel',
    ]);

    /**
     * Enable Scroll to Top Setting
     */
    $wp_customize->add_setting('enable_scroll_to_top', [
        'default'           => '1', // Default is enabled
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
        $wp_customize,
        'enable_scroll_to_top_control',
        [
            'label'    => __('Enable Scroll to Top', 'arnabwp'),
            'section'  => 'theme_general_options',
            'settings' => 'enable_scroll_to_top',
            'type'     => 'checkbox',
        ]
    ));

    // Divider: Site layout setting
    $wp_customize->add_setting('arnabwp_site_layout_divider', [
        'sanitize_callback' => '__return_false',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_site_layout_divider',
        [
            'type'        => 'hidden',
            'section'     => 'theme_general_options',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Site Layout Settings</strong><hr>',
        ]
    ));

    // Sidebar Layout
    $wp_customize->add_setting('arnabwp_sidebar_layout', [
        'default'           => 'right',
        'sanitize_callback' => 'sanitize_sidebar_layout',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Radio_Control(
        $wp_customize,
        'arnabwp_sidebar_layout',
        [
            'label'   => __('Blog/Page Sidebar Layout', 'arnabwp'),
            'section' => 'theme_general_options',

            'choices' => [
                'no'    => 'dashicons-editor-justify',
                'left'  => 'dashicons-align-pull-left',
                'right' => 'dashicons-align-pull-right',
            ],
        ]
    ));

    // Blog Layout Style
    $wp_customize->add_setting('arnabwp_blog_layout', [
        'default'           => 'masonry',
        'sanitize_callback' => 'sanitize_blog_layout',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Radio_Control(
        $wp_customize,
        'arnabwp_blog_layout',
        [
            'label'   => __('Blog Layout Style', 'arnabwp'),
            'section' => 'theme_general_options',
            'choices' => [
                'masonry' => 'dashicons-grid-view',
                'list'    => 'dashicons-list-view',
            ],
        ]
    ));

    /**
     * Site Container Width Setting
     */
    $wp_customize->add_setting('arnabwp_container_width', [
        'default'           => 1200, // Default container width in pixels
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Range_Control(
        $wp_customize,
        'arnabwp_container_width',
        [
            'label'       => __('Site Container Width (px)', 'arnabwp'),
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


    // Divider: Site button layout
    $wp_customize->add_setting('arnabwp_site_button_divider', [
        'sanitize_callback' => '__return_false',
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

    $wp_customize->add_setting('arnabwp_button_padding_top_bottom', [
        'default'           => 10, // Default container width in pixels
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Range_Control(
        $wp_customize,
        'arnabwp_button_padding_top_bottom',
        [
            'label'       => __('Padding Top/Bottom (px)', 'arnabwp'),
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

    $wp_customize->add_setting('arnabwp_button_padding_left_right', [
        'default'           => 15, // Default container width in pixels
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Range_Control(
        $wp_customize,
        'arnabwp_button_padding_left_right',
        [
            'label'       => __('Padding Left/Right (px)', 'arnabwp'),
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

    $wp_customize->add_setting('arnabwp_button_radius', [
        'default'           => 5, // Default container width in pixels
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Range_Control(
        $wp_customize,
        'arnabwp_button_radius',
        [
            'label'       => __('Radius (px)', 'arnabwp'),
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


/**
 * Sanitize the sidebar layout option.
 *
 * @param string $value The selected layout option.
 * @return string Sanitized value if valid; fallback to 'right'.
 */
function sanitize_sidebar_layout($value)
{
    $valid = ['no', 'left', 'right'];

    return in_array($value, $valid, true) ? $value : 'right';
}

/**
 * Sanitize the sidebar layout option.
 *
 * @param string $value The selected layout option.
 * @return string Sanitized value if valid; fallback to 'right'.
 */
function sanitize_blog_layout($value)
{
    $valid = ['masonry', 'list'];

    return in_array($value, $valid, true) ? $value : 'masonry';
}
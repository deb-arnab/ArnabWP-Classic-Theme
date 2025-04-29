<?php
/**
 * Typography Section Options
 * Registers customizer settings and controls for Typography (fonts and sizes).
 *
 * @package ArnabWP
 */

/**
 * Add Typography Section
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function add_typography_section( $wp_customize ) {

    // Typography Customizer Section
    $wp_customize->add_section('arnabwp_typography_section', [
        'title'       => __('Typography Settings', 'arnabwp'),
        'description' => __('Customize body and heading fonts.', 'arnabwp'),
        'priority'    => 20,
        'panel'       => 'arnabwp_theme_basic_options_panel',
    ]);

    // =============================
    // Site Font Family
    // =============================

    // Divider: Site Font Family
    $wp_customize->add_setting('arnabwp_typography_divider', [
        'sanitize_callback' => '__return_null',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_typography_divider',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_typography_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Site Font Family</strong><hr>',
        ]
    ));

    // Body Font Family
    $wp_customize->add_setting('arnabwp_body_font_family', [
        'default'           => 'Arial, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('arnabwp_body_font_family', [
        'label'    => __('Body Font Family', 'arnabwp'),
        'section'  => 'arnabwp_typography_section',
        'type'     => 'select',
        'choices'  => get_font_choices(),
    ]);

    // Heading Font Family
    $wp_customize->add_setting('arnabwp_heading_font_family', [
        'default'           => 'Georgia, serif',
        'sanitize_callback' => 'sanitize_text_field',
    ]);

    $wp_customize->add_control('arnabwp_heading_font_family', [
        'label'    => __('Heading Font Family', 'arnabwp'),
        'section'  => 'arnabwp_typography_section',
        'type'     => 'select',
        'choices'  => get_font_choices(),
    ]);

    // =============================
    // Site Font Size
    // =============================

    // Divider: Site Font Size
    $wp_customize->add_setting('arnabwp_typography_divider1', [
        'sanitize_callback' => '__return_null',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_typography_divider1',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_typography_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Site Font Size</strong><hr>',
        ]
    ));

    // Body Font Size
    $wp_customize->add_setting('arnabwp_body_font_size', [
        'default'           => 16,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_body_font_size',
        [
            'label'       => __('Body Font Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'input_attrs' => [
                'min'  => 10,
                'max'  => 30,
                'step' => 1,
            ],
        ]
    ));

    // Heading Font Size
    $wp_customize->add_setting('arnabwp_heading_font_size', [
        'default'           => 32,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_heading_font_size',
        [
            'label'       => __('Heading Font Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'input_attrs' => [
                'min'  => 25,
                'max'  => 60,
                'step' => 1,
            ],
        ]
    ));

    // =============================
    // Blog Font Size
    // =============================

    // Divider: Blog Font Size
    $wp_customize->add_setting('arnabwp_typography_divider2', [
        'sanitize_callback' => '__return_null',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_typography_divider2',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_typography_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Blogs Font Size</strong><hr>',
        ]
    ));

    // Blog Content Font Size
    $wp_customize->add_setting('arnabwp_blog_body_font_size', [
        'default'           => 16,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_blog_body_font_size',
        [
            'label'       => __('Blog Content Font Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'input_attrs' => [
                'min'  => 10,
                'max'  => 30,
                'step' => 1,
            ],
        ]
    ));

    // Blog Title Font Size
    $wp_customize->add_setting('arnabwp_blog_title_font_size', [
        'default'           => 32,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_blog_title_font_size',
        [
            'label'       => __('Blog Title Font Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'input_attrs' => [
                'min'  => 25,
                'max'  => 60,
                'step' => 1,
            ],
        ]
    ));

    // =============================
    // Front Page Font Size
    // =============================

    // Divider: Front Page Font Size
    $wp_customize->add_setting('arnabwp_typography_divider3', [
        'sanitize_callback' => '__return_null',
    ]);

    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'arnabwp_typography_divider3',
        [
            'type'        => 'hidden',
            'section'     => 'arnabwp_typography_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Front Page Font Size</strong><hr>',
        ]
    ));

    // Section Description Font Size
    $wp_customize->add_setting('arnabwp_section_description_font_size', [
        'default'           => 16,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_section_description_font_size',
        [
            'label'       => __('Section Description Font Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'input_attrs' => [
                'min'  => 10,
                'max'  => 30,
                'step' => 1,
            ],
        ]
    ));

    // Section Title Font Size
    $wp_customize->add_setting('arnabwp_section_title_font_size', [
        'default'           => 32,
        'sanitize_callback' => 'absint',
    ]);

    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Range_Control(
        $wp_customize,
        'arnabwp_section_title_font_size',
        [
            'label'       => __('Section Title Font Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'input_attrs' => [
                'min'  => 25,
                'max'  => 60,
                'step' => 1,
            ],
        ]
    ));
}

/**
 * Get list of font family choices.
 *
 * @return array
 */
function get_font_choices() {
    return [
        'Arial, sans-serif'            => 'Arial',
        'Georgia, serif'               => 'Georgia',
        'Tahoma, sans-serif'           => 'Tahoma',
        'Times New Roman, serif'       => 'Times New Roman',
        'Verdana, sans-serif'          => 'Verdana',
        'Courier New, monospace'       => 'Courier New',
        'Lucida Console, monospace'    => 'Lucida Console',
        'Roboto, sans-serif'           => 'Roboto',
        'Open Sans, sans-serif'        => 'Open Sans',
        'Lato, sans-serif'             => 'Lato',
        'Poppins, sans-serif'          => 'Poppins',
        'Montserrat, sans-serif'       => 'Montserrat',
    ];
}
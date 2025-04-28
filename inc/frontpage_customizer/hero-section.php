<?php

/**
 * Register Hero Section Customizer Options
 *
 * This function adds customizer settings and controls for the Hero section.
 * It's hooked via the trait 'trait-frontpage-options.php' into 'class-theme-customizer.php'.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_hero_section($wp_customize)
{

    /**
     * Add Hero Section under Frontpage Panel
     */
    $wp_customize->add_section('hero_section', [
        'title'    => __('Hero Section', 'arnabwp'),
        'panel'    => 'arnabwp_frontpage_panel',
        'priority' => 10,
    ]);

    // ========== Divider: Hero Type ========== //
    $wp_customize->add_setting('divider_hero_type', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_hero_type',
        [
            'type'        => 'hidden',
            'section'     => 'hero_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Hero Type</strong><hr>',
        ]
    ));

    // === Hero Type: Static Image or Slider === //
    $wp_customize->add_setting('hero_type', [
        'default'           => 'image',
        'transport'         => 'refresh',
        'sanitize_callback' => 'arnabwp_sanitize_hero_type',
    ]);
    $wp_customize->add_control('hero_type', [
        'label'   => __('Hero Type', 'arnabwp'),
        'section' => 'hero_section',
        'type'    => 'select',
        'choices' => [
            'image'  => __('Static Image', 'arnabwp'),
            'slider' => __('Image Slider', 'arnabwp'),
        ],
    ]);

    // === Static Image Control === //
    $wp_customize->add_setting('hero_image', [
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', [
        'label'           => __('Background Image', 'arnabwp'),
        'section'         => 'hero_section',
        'settings'        => 'hero_image',
        'active_callback' => function () {
            return get_theme_mod('hero_type') === 'image';
        },
    ]));

    // === Slider Images === //
    $wp_customize->add_setting('hero_slider', [
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'arnabwp_sanitize_repeater',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Repeater_Control($wp_customize, 'hero_slider', [
        'label'        => __('Slider Images', 'arnabwp'),
        'section'      => 'hero_section',
        'fields'       => [
            'image' => ['type' => 'image', 'label' => 'Slider Image'],
        ],
        'button_label' => __('Add Slide', 'arnabwp'),
        'active_callback' => function () {
            return get_theme_mod('hero_type') === 'slider';
        },
    ]));

    // ========== Divider: Hero Content ========== //
    $wp_customize->add_setting('divider_hero_content', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_hero_content',
        [
            'type'        => 'hidden',
            'section'     => 'hero_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Hero Content</strong><hr>',
        ]
    ));

    // === Hero Title === //
    $wp_customize->add_setting('hero_title', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_title', [
        'label'   => __('Hero Title', 'arnabwp'),
        'section' => 'hero_section',
        'type'    => 'text',
    ]);

    // === Hero Subtitle === //
    $wp_customize->add_setting('hero_subtitle', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('hero_subtitle', [
        'label'   => __('Hero Subtitle', 'arnabwp'),
        'section' => 'hero_section',
        'type'    => 'text',
    ]);

    // === CTA Buttons === //
    $wp_customize->add_setting('hero_cta_buttons', [
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'arnabwp_sanitize_cta_repeater',
    ]);
    $wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Repeater_Control($wp_customize, 'hero_cta_buttons', [
        'label'        => __('CTA Buttons', 'arnabwp'),
        'section'      => 'hero_section',
        'fields'       => [
            'text'   => ['type' => 'text', 'label' => 'Button Text'],
            'url'    => ['type' => 'text', 'label' => 'Button URL'],
            'target' => ['type' => 'select', 'label' => 'Open In', 'choices' => [
                '_self'  => __('Same Tab', 'arnabwp'),
                '_blank' => __('New Tab', 'arnabwp'),
            ]],
        ],
        'button_label' => __('Add Button', 'arnabwp'),
    ]));

    // ========== Divider: Style Options ========== //
    $wp_customize->add_setting('divider_hero_styles', [
        'sanitize_callback' => '__return_null',
    ]);
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        'divider_hero_styles',
        [
            'type'        => 'hidden',
            'section'     => 'hero_section',
            'description' => '<hr><strong style="font-size:15px; color:#db007c">Style Options</strong><hr>',
        ]
    ));

    // === Title Color === //
    $wp_customize->add_setting('hero_title_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_title_color', [
        'label'   => __('Hero Title Color', 'arnabwp'),
        'section' => 'hero_section',
    ]));

    // === Subtitle Color === //
    $wp_customize->add_setting('hero_subtitle_color', [
        'default'           => '#cccccc',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_subtitle_color', [
        'label'   => __('Hero Subtitle Color', 'arnabwp'),
        'section' => 'hero_section',
    ]));

    /**
     * Button Background Color
     */
    $wp_customize->add_setting('arnabwp_hero_btn_bg_color', [
        'default'           => '#0073e6',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_hero_btn_bg_color', [
        'label'    => __('Button Background Color', 'arnabwp'),
        'section'  => 'hero_section',
        'settings' => 'arnabwp_hero_btn_bg_color',
    ]));

    /**
     * Button Hover Background Color
     */
    $wp_customize->add_setting('arnabwp_hero_btn_hover_bg_color', [
        'default'           => '#0073e8',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_hero_btn_hover_bg_color', [
        'label'    => __('Button Hover Background Color', 'arnabwp'),
        'section'  => 'hero_section',
        'settings' => 'arnabwp_hero_btn_hover_bg_color',
    ]));

    /**
     * Button Text Color
     */
    $wp_customize->add_setting('arnabwp_hero_btn_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_hero_btn_text_color', [
        'label'    => __('Button Text Color', 'arnabwp'),
        'section'  => 'hero_section',
        'settings' => 'arnabwp_hero_btn_text_color',
    ]));

    /**
     * Button Hover Text Color
     */
    $wp_customize->add_setting('arnabwp_hero_btn_hover_text_color', [
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ]);

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'arnabwp_hero_btn_hover_text_color', [
        'label'    => __('Button Hover Text Color', 'arnabwp'),
        'section'  => 'hero_section',
        'settings' => 'arnabwp_hero_btn_hover_text_color',
    ]));

    function arnabwp_sanitize_hero_type($input)
    {
        $valid_types = ['image', 'slider'];
        return in_array($input, $valid_types, true) ? $input : 'image';
    }

    function arnabwp_sanitize_cta_repeater($input)
    {
        $input_decoded = json_decode($input, true);
        if (!is_array($input_decoded)) {
            return json_encode([]);
        }

        $clean = [];
        foreach ($input_decoded as $item) {
            $clean[] = [
                'text'   => sanitize_text_field($item['text'] ?? ''),
                'url'    => esc_url_raw($item['url'] ?? ''),
                'target' => in_array($item['target'] ?? '_self', ['_self', '_blank'], true) ? $item['target'] : '_self'
            ];
        }

        return json_encode($clean);
    }
}

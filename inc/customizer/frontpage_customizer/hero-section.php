<?php
/**
 * Register Hero Section Customizer Options
 *
 * Adds customizable settings for the Hero section on the front page.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */

function add_hero_section($wp_customize) {

// === Section: Hero === //
$wp_customize->add_section('arnabwp_hero_section', [
    'title'    => __('Hero Section', 'arnabwp'),
    'panel'    => 'arnabwp_frontpage_panel',
    'priority' => 10,
]);

// === Tabs for UI Switching (Custom Control) === //
$wp_customize->add_setting('arnabwp_current_hero_tab', [
    'default'           => 'general',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Tabs_Control(
    $wp_customize,
    'arnabwp_current_hero_tab', [
        'section'  => 'arnabwp_hero_section',
        'settings' => 'arnabwp_current_hero_tab',
        'tabs'     => [
            'general' => __('General', 'arnabwp'),
            'content' => __('Contents', 'arnabwp'),
            'style'   => __('Styles', 'arnabwp'),
        ],
    ]
));

// === Divider: Hero Background Type === //
$wp_customize->add_setting('arnabwp_divider_hero_type', [
    'sanitize_callback' => '__return_false',
]);
$wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'arnabwp_divider_hero_type', [
        'type'            => 'hidden',
        'section'         => 'arnabwp_hero_section',
        'description'     => '<hr><strong style="font-size:15px; color:#db007c">Hero Background</strong><hr>',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'general',
    ]
));

// === Hero Type: Static Image or Slider === //
$wp_customize->add_setting('arnabwp_hero_type', [
    'default'           => 'image',
    'transport'         => 'refresh',
    'sanitize_callback' => 'arnabwp_sanitize_hero_type',
]);
$wp_customize->add_control('arnabwp_hero_type', [
    'label'           => __('Hero Type', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'type'            => 'select',
    'choices'         => [
        'image'  => __('Static Image', 'arnabwp'),
        'slider' => __('Image Slider', 'arnabwp'),
    ],
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'general',
]);

// === Static Background Image === //
$wp_customize->add_setting('arnabwp_hero_image', [
    'default'           => '',
    'transport'         => 'refresh',
    'sanitize_callback' => 'esc_url_raw',
]);
$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'arnabwp_hero_image', [
    'label'           => __('Background Image', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'input_attrs'     => ['data-tab' => 'general'],
    'active_callback' => fn() => get_theme_mod('arnabwp_hero_type') === 'image' && get_theme_mod('arnabwp_current_hero_tab', 'general') === 'general',
]));

// === Slider Repeater Control === //
$wp_customize->add_setting('arnabwp_hero_slider', [
    'default'           => '',
    'transport'         => 'refresh',
    'sanitize_callback' => 'arnabwp_sanitize_repeater',
]);
$wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Repeater_Control($wp_customize, 'arnabwp_hero_slider', [
    'label'           => __('Slider Images', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'fields'          => [
        'image' => ['type' => 'image', 'label' => 'Slider Image'],
    ],
    'button_label'    => __('Add Slide', 'arnabwp'),
    'active_callback' => fn() => get_theme_mod('arnabwp_hero_type') === 'slider' && get_theme_mod('arnabwp_current_hero_tab', 'general') === 'general',
]));

// === Divider: Hero Layout === //
$wp_customize->add_setting('arnabwp_divider_hero_layout', [
    'sanitize_callback' => '__return_false',
]);
$wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'arnabwp_divider_hero_layout', [
        'type'            => 'hidden',
        'section'         => 'arnabwp_hero_section',
        'description'     => '<hr><strong style="font-size:15px; color:#db007c">Layout Option</strong><hr>',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'general',
    ]
));

// === Hero Content Alignment === //
$wp_customize->add_setting('arnabwp_hero_content_alignment', [
    'default'           => 'center',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hero_alignment',
]);
$wp_customize->add_control('arnabwp_hero_content_alignment', [
    'label'           => __('Hero Content Layout', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'type'            => 'select',
    'choices'         => ['left' => __('Left', 'arnabwp'), 'center' => __('Center', 'arnabwp'), 'right' => __('Right', 'arnabwp')],
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'general',
]);

// === Divider: Content === //
$wp_customize->add_setting('arnabwp_divider_hero_content', [
    'sanitize_callback' => '__return_false',
]);
$wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'arnabwp_divider_hero_content', [
        'type'            => 'hidden',
        'section'         => 'arnabwp_hero_section',
        'description'     => '<hr><strong style="font-size:15px; color:#db007c">Hero Content</strong><hr>',
        'input_attrs'     => ['data-tab' => 'content'],
        'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'content',
    ]
));

// === Hero Title and Subtitle === //
$wp_customize->add_setting('arnabwp_hero_title', [
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('arnabwp_hero_title', [
    'label'           => __('Hero Title', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'type'            => 'text',
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'content',
]);

$wp_customize->add_setting('arnabwp_hero_subtitle', [
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_text_field',
]);
$wp_customize->add_control('arnabwp_hero_subtitle', [
    'label'           => __('Hero Subtitle', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'type'            => 'text',
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'content',
]);

// === CTA Buttons (Repeater Control) === //
$wp_customize->add_setting('arnabwp_hero_cta_buttons', [
    'default'           => '',
    'transport'         => 'refresh',
    'sanitize_callback' => 'arnabwp_sanitize_cta_repeater',
]);
$wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Repeater_Control($wp_customize, 'arnabwp_hero_cta_buttons', [
    'label'        => __('CTA Buttons', 'arnabwp'),
    'section'      => 'arnabwp_hero_section',
    'fields'       => [
        'text'   => ['type' => 'text', 'label' => 'Button Text'],
        'url'    => ['type' => 'text', 'label' => 'Button URL'],
        'target' => ['type' => 'select', 'label' => 'Open In', 'choices' => ['_self' => __('Same Tab', 'arnabwp'), '_blank' => __('New Tab', 'arnabwp')]],
    ],
    'button_label'    => __('Add Button', 'arnabwp'),
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'content',
]));

// === Divider: Style === //
$wp_customize->add_setting('arnabwp_divider_hero_styles', ['sanitize_callback' => '__return_false']);
$wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'arnabwp_divider_hero_styles', [
        'type'            => 'hidden',
        'section'         => 'arnabwp_hero_section',
        'description'     => '<hr><strong style="font-size:15px; color:#db007c">Style Options</strong><hr>',
        'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'style',
    ]
));

// === Font Sizes (Custom Range Control) === //
$wp_customize->add_setting('arnabwp_hero_title_font_size', [
    'default' => json_encode([
        'desktop' => '46',
        'tablet'  => '36',
        'mobile'  => '26'
    ]),
    'transport' => 'refresh',
   'sanitize_callback' => 'arnabwp_sanitize_hero_font_size',
]);
$wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Responsive_Range_Control($wp_customize, 'arnabwp_hero_title_font_size', [
    'label'           => __('Hero Title Font Size', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'input_attrs' => [
                'min' => 6,
                'max' => 100,
                'step' => 1,
                'default_desktop' => 46,
            'default_tablet'  => 36,
            'default_mobile'  => 26,
            ],
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'style',
]));

$wp_customize->add_setting('arnabwp_hero_subtitle_font_size', [
   'default' => json_encode([
                'desktop' => '16',
                'tablet'  => '14',
                'mobile'  => '12'
            ]),
            'transport' => 'refresh',
           'sanitize_callback' => 'arnabwp_sanitize_hero_font_size',
        ]);
$wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Responsive_Range_Control($wp_customize, 'arnabwp_hero_subtitle_font_size', [
    'label'           => __('Hero Subtitle Font Size', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'type'            => 'range',
    'input_attrs' => [
        'min' => 6,
        'max' => 100,
        'step' => 1,
        'default_desktop' => 16,
    'default_tablet'  => 14,
    'default_mobile'  => 12,
    ],
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'style',
]));

// === Colors === //
$wp_customize->add_setting('arnabwp_hero_title_color', [
    'default'           => '#ffffff',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
]);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_title_color', [
    'label'           => __('Hero Title Color', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'settings'        => 'arnabwp_hero_title_color',
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'style',
]));

$wp_customize->add_setting('arnabwp_hero_subtitle_color', [
    'default'           => '#cccccc',
    'transport'         => 'refresh',
    'sanitize_callback' => 'sanitize_hex_color',
]);
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'hero_subtitle_color', [
    'label'           => __('Hero Subtitle Color', 'arnabwp'),
    'section'         => 'arnabwp_hero_section',
    'settings'        => 'arnabwp_hero_subtitle_color',
    'active_callback' => fn() => get_theme_mod('arnabwp_current_hero_tab', 'general') === 'style',
]));


}

// === Sanitization Helpers === //

function arnabwp_sanitize_hero_type($input) {
    $valid = ['image', 'slider'];
    return in_array($input, $valid, true) ? $input : 'image';
}

function sanitize_hero_alignment($value) {
    return in_array($value, ['left', 'center', 'right'], true) ? $value : 'center';
}

function arnabwp_sanitize_cta_repeater($input) {
    $items = json_decode($input, true);
    if (!is_array($items)) return json_encode([]);

    $clean = [];
    foreach ($items as $item) {
        $clean[] = [
            'text'   => sanitize_text_field($item['text'] ?? ''),
            'url'    => esc_url_raw($item['url'] ?? ''),
            'target' => in_array($item['target'] ?? '_self', ['_self', '_blank'], true) ? $item['target'] : '_self'
        ];
    }

    return json_encode($clean);
}

function arnabwp_sanitize_hero_font_size($value) {
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

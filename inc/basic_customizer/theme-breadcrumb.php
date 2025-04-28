<?php

/**
 * Color Section Options
 * This function registers customizer settings and controls for the "Color" section
 * on the front page of the theme.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @package ArnabWP
 */
function add_breadcrumb_section( $wp_customize ) {



// Add Section: Breadcrumbs
$wp_customize->add_section('arnabwp_breadcrumbs_section', [
    'title'       => __('Breadcrumbs Settings', 'arnabwp'),
    'description' => __('Control the appearance and behavior of breadcrumbs.', 'arnabwp'),
    'priority'    => 30,
    'panel'    => 'arnabwp_theme_basic_options_panel',
]);

/**
 * Enable Breadcrumbs Toggle
 */
$wp_customize->add_setting('arnabwp_enable_breadcrumbs', [
    'default'           => true,
    'sanitize_callback' => 'wp_validate_boolean',
]);

$wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
    $wp_customize,
    'arnabwp_enable_breadcrumbs',
    [
        'label'   => __('Enable Breadcrumbs', 'arnabwp'),
        'section' => 'arnabwp_breadcrumbs_section',
    ]
));

// Divider: Typography
$wp_customize->add_setting('arnabwp_breadcrumb_typo_divider', [
    'sanitize_callback' => '__return_null',
]);

$wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'arnabwp_breadcrumb_typo_divider',
    [
        'type'     => 'hidden',
        'section'  => 'arnabwp_breadcrumbs_section',
        'description' => '<hr><strong style="font-size:15px; color:#db007c">Separator & Typography</strong><hr>',
        'active_callback' => function() {
            return get_theme_mod('arnabwp_enable_breadcrumbs') === true;
        },
    ]
));

/**
 * Breadcrumb Separator
 */
$wp_customize->add_setting('arnabwp_breadcrumb_separator', [
    'default'           => '>',
    'sanitize_callback' => 'sanitize_breadcrumb_separator',
]);

$wp_customize->add_control('arnabwp_breadcrumb_separator', [
    'label'       => __('Breadcrumb Separator', 'arnabwp'),
    'description' => __('Character or symbol to use between breadcrumb items (e.g., >, /, »).', 'arnabwp'),
    'type'        => 'select',
    'choices'	  => [
        '>' => __('>', 'arnabwp'),
        '»' => __('»', 'arnabwp'),
        '/' => __('/', 'arnabwp'),
    ],
    'section'     => 'arnabwp_breadcrumbs_section',
    'active_callback' => function() {
            return get_theme_mod('arnabwp_enable_breadcrumbs') === true;
        },
]);

/**
 * Font Size (px)
 */
$wp_customize->add_setting('arnabwp_breadcrumb_font_size', [
    'default'           => 14,
    'sanitize_callback' => 'absint',
]);

$wp_customize->add_control('arnabwp_breadcrumb_font_size', [
    'label'       => __('Font Size (px)', 'arnabwp'),
    'type'        => 'number',
    'section'     => 'arnabwp_breadcrumbs_section',
    'input_attrs' => [
        'min' => 10,
        'max' => 20,
        'step' => 1,
    ],
    'active_callback' => function() {
            return get_theme_mod('arnabwp_enable_breadcrumbs') === true;
        },
]);

// Divider: Color Settings
$wp_customize->add_setting('arnabwp_breadcrumb_color_divider', [
    'sanitize_callback' => '__return_null',
]);

$wp_customize->add_control(new WP_Customize_Control(
    $wp_customize,
    'arnabwp_breadcrumb_color_divider',
    [
        'type'     => 'hidden',
        'section'  => 'arnabwp_breadcrumbs_section',
        'description' => '<hr><strong style="font-size:15px; color:#db007c">Color Settings</strong><hr>',
        'active_callback' => function() {
            return get_theme_mod('arnabwp_enable_breadcrumbs') === true;
        },
    ]
    
));

/**
 * Breadcrumb Font Color
 */
$wp_customize->add_setting('arnabwp_breadcrumb_color', [
    'default'           => '#666666',
    'sanitize_callback' => 'sanitize_hex_color',
]);

$wp_customize->add_control(new WP_Customize_Color_Control(
    $wp_customize,
    'arnabwp_breadcrumb_color',
    [
        'label'    => __('Breadcrumb Color', 'arnabwp'),
        'section'  => 'arnabwp_breadcrumbs_section',
        'active_callback' => function() {
            return get_theme_mod('arnabwp_enable_breadcrumbs') === true;
        },
    ]
));
}

/**
* Sanitize the breadcrumb separator option.
*
* @param string $value The selected separator value.
* @return string
*/
function sanitize_breadcrumb_separator($value)
{
$valid = ['>', '»', '/'];

// Return the value only if it's valid; fallback to '>'
return in_array($value, $valid, true) ? $value : '>';
}

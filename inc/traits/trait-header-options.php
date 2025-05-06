<?php

/**
 * Trait for adding header options to the WordPress Customizer.
 * 
 * This trait includes functionality to add a header section where users
 * can customize the copyright text for the header.
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Traits;

use WP_Customize_Control;
use WP_Customize_Color_Control;

trait Header_Options
{

	/**
	 * Add header section and options to the WordPress Customizer.
	 *
	 * This method will add a custom section to the Customizer for header settings,
	 * 
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress Customizer object.
	 * @return void
	 */

	public function add_header_section($wp_customize)
	{
		$wp_customize->add_section('arnabwp_header_options', [
			'title'    => __('Header Options', 'arnabwp'),
			'priority' => 40,
		]);

		// Divider: Show/Hide Controls
		$wp_customize->add_setting('arnabwp_header_toggle_divider', [
			'sanitize_callback' => '__return_null',
		]);

		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'arnabwp_header_toggle_divider',
			[
				'type'        => 'hidden',
				'section'     => 'arnabwp_header_options',
				'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Controls</strong><hr>',
			]
		));

		// Topbar Toggle
		$wp_customize->add_setting('arnabwp_show_topbar', [
			'default' => true,
			'sanitize_callback' => 'wp_validate_boolean',
		]);

		$wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
			$wp_customize,
			'arnabwp_show_topbar',
			[
				'label'    => __('Enable Top Bar', 'arnabwp'),
				'type'     => 'checkbox',
				'section'  => 'arnabwp_header_options',
			]
		));

		// Divider: Topbar Controls
		$wp_customize->add_setting('arnabwp_topbar_content_divider', [
			'sanitize_callback' => '__return_null',
		]);

		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'arnabwp_topbar_content_divider',
			[
				'type'        => 'hidden',
				'section'     => 'arnabwp_header_options',
				'description' => '<hr><strong style="font-size:15px; color:#db007c">Topbar Contents</strong></br><span>Fill topbar contents to see topbar</span><hr>',
				'active_callback' => function() {
					return get_theme_mod('arnabwp_show_topbar') === true;
				},
			]
		));
		// === Topbar Phone ===
		$wp_customize->add_setting('arnabwp_topbar_phone', [
			'default'           => '',
			'sanitize_callback' => [$this,'sanitize_phone_input'],
			'transport'         => 'refresh',
		]);

		$wp_customize->add_control('arnabwp_topbar_phone', [
			'label'       => __('Phone Number', 'arnabwp'),
			'type'        => 'text',
			'section'     => 'arnabwp_header_options',
			'input_attrs' => [
				'placeholder' => '+123 456 789',
			],
			'active_callback' => function() {
				return get_theme_mod('arnabwp_show_topbar') === true;
			},
		]);


		// === Topbar Email ===
		$wp_customize->add_setting('arnabwp_topbar_email', [
			'default' => '',
			'sanitize_callback' => 'sanitize_email',
			'transport_refresh' => 'refresh',
		]);

		$wp_customize->add_control('arnabwp_topbar_email', [
			'label'       => __('Email', 'arnabwp'),
			'type'        => 'text',
			'section'     => 'arnabwp_header_options',
			'input_attrs' => [
				'placeholder' => 'info@example.com',
			],
			'active_callback' => function() {
				return get_theme_mod('arnabwp_show_topbar') === true;
			},
		]);


		// === Topbar Address ===
		$wp_customize->add_setting('arnabwp_topbar_address', [
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport_refresh' => 'refresh',
		]);

		$wp_customize->add_control('arnabwp_topbar_address', [
			'label'       => __('Address', 'arnabwp'),
			'type'        => 'text',
			'section'     => 'arnabwp_header_options',
			'input_attrs' => [
				'placeholder' => 'Address, Country',
			],
			'active_callback' => function() {
				return get_theme_mod('arnabwp_show_topbar') === true;
			},
		]);

		// Divider: Layout Settings
		$wp_customize->add_setting('arnabwp_header_layout_divider', [
			'sanitize_callback' => '__return_null',
		]);

		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'arnabwp_header_layout_divider',
			[
				'type'        => 'hidden',
				'section'     => 'arnabwp_header_options',
				'description' => '<hr><strong style="font-size:15px; color:#db007c">Header Layout Settings</strong><hr>',
			]
		));

		// Header Layout
		$wp_customize->add_setting('arnabwp_header_layout', [
			'default'           => 'logo-left',
			'sanitize_callback' => [$this, 'sanitize_header_layout'], // Use a custom sanitization method
		]);

		$wp_customize->add_control('arnabwp_header_layout', [
			'label'   => __('Header Layout', 'arnabwp'),
			'section' => 'arnabwp_header_options',
			'type'    => 'select',
			'choices' => [
				'logo-left'   => __('Logo Left, Menu Right', 'arnabwp'),
				'logo-center' => __('Logo Centered, Menu Below', 'arnabwp'),
				'logo-right'    => __('Logo Right, Menu Left', 'arnabwp'),
			],
		]);

		// Sticky Header Toggle
		$wp_customize->add_setting('arnabwp_sticky_header', [
			'default'           => false,
			'sanitize_callback' => 'wp_validate_boolean',
		]);

		$wp_customize->add_control(new \ARNABWP_THEME\Inc\Customizer\Controls\Toggle_Control(
			$wp_customize,
			'arnabwp_sticky_header',
			[
				'label'    => __('Enable Sticky Header', 'arnabwp'),
				'section'  => 'arnabwp_header_options',
				'type'     => 'checkbox',
			]
		));

		// Divider: Font Settings
		$wp_customize->add_setting('arnabwp_header_font_divider', [
			'sanitize_callback' => '__return_null',
		]);

		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'arnabwp_header_font_divider',
			[
				'type'        => 'hidden',
				'section'     => 'arnabwp_header_options',
				'description' => '<hr><strong style="font-size:15px; color:#db007c">Font Settings</strong><hr>',
			]
		));

		// Menu Font Size with restricted choices
		$wp_customize->add_setting('arnabwp_menu_font_size', [
			'default'           => 16,
			'sanitize_callback' => 'absint',
		]);

		$wp_customize->add_control( new \ARNABWP_THEME\Inc\Customizer\Controls\Range_Control(
        $wp_customize,
		'arnabwp_menu_font_size', [
			'label'    => __('Menu Font Size', 'arnabwp'),
			'section'  => 'arnabwp_header_options',
			'type'        => 'range',
        'input_attrs' => [
            'min'  => 6,
            'max'  => 100,
            'step' => 1,
        ],
		]
		) );

	}

	/**
	 * Sanitize the header layout option.
	 *
	 * @param string $value The selected layout value.
	 * @return string
	 */
	public function sanitize_header_layout($value)
	{
		$valid = ['logo-left', 'logo-center', 'logo-right'];

		// Return the value only if it's valid; fallback to 'logo-left'
		return in_array($value, $valid, true) ? $value : 'logo-left';
	}




	/**
 * Sanitize phone number input.
 *
 * @param string $value The phone number to sanitize.
 * @return string Sanitized phone number.
 */
public function sanitize_phone_input($value)
{
    return preg_replace('/[^0-9+]/', '', $value);  // Allow only numbers and plus sign.
}
}




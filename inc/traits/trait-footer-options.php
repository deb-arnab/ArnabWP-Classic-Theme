<?php

/**
 * Trait for adding footer options to the WordPress Customizer.
 * 
 * This trait includes functionality to add a footer section where users
 * can customize the copyright text for the footer.
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Traits;

use WP_Customize_Control;
use WP_Customize_Color_Control;

trait Footer_Options
{

	/**
	 * Add footer section and options to the WordPress Customizer.
	 *
	 * This method will add a custom section to the Customizer for footer settings,
	 * including an input field for users to set the footer copyright text.
	 *
	 * @param \WP_Customize_Manager $wp_customize The WordPress Customizer object.
	 * @return void
	 */

	public function add_footer_section($wp_customize)
	{

		// Add the footer section to the Customizer
		$wp_customize->add_section('arnabwp_footer_section', [
			'title'    => __('Footer Options', 'arnabwp'), // Section title
			'priority' => 45, // Priority to determine position in the Customizer
		]);

		// Divider: Show/Hide Controls
		$wp_customize->add_setting('arnabwp_footer_toggle_divider', [
			'sanitize_callback' => '__return_null',
		]);

		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'arnabwp_footer_toggle_divider',
			[
				'type'        => 'hidden',
				'section'     => 'arnabwp_footer_section',
				'description' => '<hr><strong style="font-size:15px; color:#db007c">Show/Hide Controls</strong><hr>',
			]
		));

		// Show/hide footer widgets
		$wp_customize->add_setting('arnabwp_footer_show_widgets', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		]);

		$wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
			$wp_customize,
			'arnabwp_footer_show_widgets',
			[
				'label'    => __('Show Footer Widgets', 'arnabwp'),
				'section'  => 'arnabwp_footer_section',
				'type'     => 'checkbox',
			]
		));

		// Show/hide copyright text
		$wp_customize->add_setting('arnabwp_footer_show_copyright', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		]);

		$wp_customize->add_control(new \ARNABWP_THEME\Inc\Controls\Toggle_Control(
			$wp_customize,
			'arnabwp_footer_show_copyright',
			[
				'label'    => __('Show Copyright Text', 'arnabwp'),
				'section'  => 'arnabwp_footer_section',
				'type'     => 'checkbox',
			]
		));

		// Divider: Footer Text
		$wp_customize->add_setting('arnabwp_footer_text_divider', [
			'sanitize_callback' => '__return_null',
		]);

		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'arnabwp_footer_text_divider',
			[
				'type'        => 'hidden',
				'section'     => 'arnabwp_footer_section',
				'description' => '<hr><strong style="font-size:15px; color:#db007c">Footer Text</strong><hr>',
			]
		));

		// Footer copyright text
		$wp_customize->add_setting('arnabwp_footer_copyright_text', [
			'default'           => __('© ' . get_the_date('Y') . ' ArnabWP. All rights reserved.', 'arnabwp'),
			'sanitize_callback' => 'wp_kses_post',
		]);

		$wp_customize->add_control('arnabwp_footer_copyright_text', [
			'label'   => __('Copyright Text', 'arnabwp'),
			'section' => 'arnabwp_footer_section',
			'type'    => 'text',
			'active_callback' => function() {
					return get_theme_mod('arnabwp_footer_show_copyright') === true;
				},
		]);

		// Footer text alignment
		$wp_customize->add_setting('arnabwp_footer_text_alignment', [
			'default'           => 'center',
			'sanitize_callback' => [$this, 'sanitize_footer_alignment'],
		]);

		$wp_customize->add_control('arnabwp_footer_text_alignment', [
			'label'   => __('Footer Text Alignment', 'arnabwp'),
			'section' => 'arnabwp_footer_section',
			'type'    => 'select',
			'choices' => [
				'left'   => __('Left', 'arnabwp'),
				'center' => __('Center', 'arnabwp'),
				'right'  => __('Right', 'arnabwp'),
			],
			'active_callback' => function() {
					return get_theme_mod('arnabwp_footer_show_copyright') === true;
				},
		]);

		// Divider: Color Settings
		$wp_customize->add_setting('arnabwp_footer_color_divider', [
			'sanitize_callback' => '__return_null',
		]);

		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			'arnabwp_footer_color_divider',
			[
				'type'        => 'hidden',
				'section'     => 'arnabwp_footer_section',
				'description' => '<hr><strong style="font-size:15px; color:#db007c">Color Settings</strong><hr>',
			]
		));

		// Footer background color
		$wp_customize->add_setting('arnabwp_footer_bg_color', [
			'default'           => '#000000',
			'sanitize_callback' => 'sanitize_hex_color',
		]);

		$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'arnabwp_footer_bg_color',
			[
				'label'   => __('Footer Background Color', 'arnabwp'),
				'section' => 'arnabwp_footer_section',
				
			]
		));

		// Footer widget heading color
		$wp_customize->add_setting('arnabwp_footer_widget_heading_color', [
			'default'           => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		]);

		$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'arnabwp_footer_widget_heading_color',
			[
				'label'    => __('Footer Widget Heading Color', 'arnabwp'),
				'section'  => 'arnabwp_footer_section',
				'settings' => 'arnabwp_footer_widget_heading_color',
				'active_callback' => function() {
					return get_theme_mod('arnabwp_footer_show_widgets') === true;
				},
			]
		));

		// Footer widget text color
		$wp_customize->add_setting('arnabwp_footer_widget_text_color', [
			'default'           => '#bbbbbb',
			'sanitize_callback' => 'sanitize_hex_color',
		]);

		$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'arnabwp_footer_widget_text_color',
			[
				'label'    => __('Footer Widget Text Color', 'arnabwp'),
				'section'  => 'arnabwp_footer_section',
				'settings' => 'arnabwp_footer_widget_text_color',
				'active_callback' => function() {
					return get_theme_mod('arnabwp_footer_show_widgets') === true;
				},
			]
		));

		// Footer copyright text color
		$wp_customize->add_setting('arnabwp_footer_copyright_text_color', [
			'default'           => '#999999',
			'sanitize_callback' => 'sanitize_hex_color',
		]);

		$wp_customize->add_control(new WP_Customize_Color_Control(
			$wp_customize,
			'arnabwp_footer_copyright_text_color',
			[
				'label'    => __('Footer Copyright Text Color', 'arnabwp'),
				'section'  => 'arnabwp_footer_section',
				'settings' => 'arnabwp_footer_copyright_text_color',
				'active_callback' => function() {
					return get_theme_mod('arnabwp_footer_show_copyright') === true;
				},
			]
		));
	}

	/**
	 * Sanitize the footer alignment option.
	 *
	 * @param string $value The selected alignment value.
	 * @return string
	 */
	public function sanitize_footer_alignment($value)
	{
		$valid = ['left', 'center', 'right'];

		// Return the value only if it's valid; fallback to 'center'
		return in_array($value, $valid, true) ? $value : 'center';
	}
}

<?php

/**
 * Trait for adding typography options to the WordPress Customizer.
 * 
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Traits;

trait Typography_Options
{
    /**
     * Register customizer settings and controls for typography.
     *
     * @param WP_Customize_Manager $wp_customize Theme Customizer object.
     */
    public function add_typography_section($wp_customize)
    {

        // ============================
        // Typography Customizer Section
        // ============================
        $wp_customize->add_section('arnabwp_typography_section', [
            'title'       => __('Typography Settings', 'arnabwp'),
            'description' => __('Customize body and heading fonts.', 'arnabwp'),
            'priority'    => 30,
        ]);

        /**
         * Body Font Family Setting & Control
         */
        $wp_customize->add_setting('arnabwp_body_font_family', [
            'default'           => 'Arial, sans-serif',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control('arnabwp_body_font_family', [
            'label'    => __('Body Font Family', 'arnabwp'),
            'section'  => 'arnabwp_typography_section',
            'type'     => 'select',
            'choices'  => $this->get_font_choices(),

        ]);

        /**
         * Heading Font Family Setting & Control
         */
        $wp_customize->add_setting('arnabwp_heading_font_family', [
            'default'           => 'Georgia, serif',
            'sanitize_callback' => 'sanitize_text_field',
        ]);

        $wp_customize->add_control('arnabwp_heading_font_family', [
            'label'       => __('Heading Font Family', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'type'     => 'select',
            'choices'  => $this->get_font_choices(),
        ]);

        /**
         * Body Font Size Setting & Control
         */
        $wp_customize->add_setting('arnabwp_body_font_size', [
            'default'           => 16,
            'sanitize_callback' => [$this, 'sanitize_font_size'],
        ]);

        $wp_customize->add_control('arnabwp_body_font_size', [
            'label'       => __('Body Font Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'type'        => 'number',
            'input_attrs' => [
                'min'  => 12,
                'max'  => 20,
                'step' => 1,
            ],
        ]);

        /**
         * Heading Font Size Setting & Control
         */

        $wp_customize->add_setting('arnabwp_heading_font_size', [
            'default'           => 32,
            'sanitize_callback' => [$this, 'sanitize_font_size'],
        ]);

        $wp_customize->add_control('arnabwp_heading_font_size', [
            'label'       => __('Heading Font Size (px)', 'arnabwp'),
            'section'     => 'arnabwp_typography_section',
            'type'        => 'number',
            'input_attrs' => [
                'min'  => 20,
                'max'  => 60,
                'step' => 1,
            ],
        ]);
    }
    /**
     * Sanitize font size input.
     *
     * @param mixed $value Font size value.
     * @return int Sanitized and constrained font size.
     */
    public function sanitize_font_size($value)
    {
        $value = absint($value);
        if ($value < 12) {
            return 12;
        }
        if ($value > 100) {
            return 100;
        }
        return $value;
    }

    /**
     * Get list of font family choices.
     *
     * @return array
     */
    public function get_font_choices()
    {
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
}

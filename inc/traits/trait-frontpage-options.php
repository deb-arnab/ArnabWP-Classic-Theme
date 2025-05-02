<?php
/**
 * Trait: Frontpage panel
 *
 * Adds a customizer panel for frontpage sections (e.g. Hero, Features).
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Traits;

trait Frontpage_Options {

    /**
     * Register a customizer panel and its associated sections
     *
     * This method is intended to be called during the `customize_register` action.
     *
     * @param WP_Customize_Manager $wp_customize Customizer object passed by WordPress.
     */
    public function add_frontpage_panel( $wp_customize ) {

        // Add a main panel to the customizer for frontpage settings.
        $wp_customize->add_panel( 'arnabwp_frontpage_panel', [
            'title'       => __( 'Frontpage Section', 'arnabwp' ),
            'description' => __( 'Customize the theme frontpage settings here.', 'arnabwp' ),
            'priority'    => 35,
        ]);

        // Include modular files for each frontpage section
        include_once ARNABWP_DIR_PATH . '/inc/frontpage_customizer/hero-section.php';
        include_once ARNABWP_DIR_PATH . '/inc/frontpage_customizer/features-section.php';
        include_once ARNABWP_DIR_PATH . '/inc/frontpage_customizer/about-section.php';
        include_once ARNABWP_DIR_PATH . '/inc/frontpage_customizer/employee-section.php';
        include_once ARNABWP_DIR_PATH . '/inc/frontpage_customizer/client-section.php';
        include_once ARNABWP_DIR_PATH . '/inc/frontpage_customizer/testimonial-section.php';
        include_once ARNABWP_DIR_PATH . '/inc/frontpage_customizer/newsletter-section.php';

        // Register each section with the customizer
        add_hero_section( $wp_customize );
        add_feature_section( $wp_customize );
        add_about_section( $wp_customize );
        add_employee_section( $wp_customize );
        add_client_section( $wp_customize );
        add_testimonial_section( $wp_customize );
        add_newsletter_section( $wp_customize );
    }
}
<?php
/**
 * Trait: Frontpage panel
 *
 * Adds a customizer panel for frontpage sections (e.g. Hero, Features).
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Traits;

trait Basic_Options {

    /**
     * Register a customizer panel and its associated sections
     *
     * This method is intended to be called during the `customize_register` action.
     *
     * @param WP_Customize_Manager $wp_customize Customizer object passed by WordPress.
     */
    public function add_theme_basic_options_panel( $wp_customize ) {

        // Add a main panel to the customizer for frontpage settings.
        $wp_customize->add_panel( 'arnabwp_theme_basic_options_panel', [
            'title'       => __( 'Theme Basic Options', 'arnabwp' ),
            'description' => __( 'Customize the theme basic settings here.', 'arnabwp' ),
            'priority'    => 30,
        ]);

        // Include modular files for each frontpage section
        include_once ARNABWP_DIR_PATH . '/inc/customizer/basic_customizer/theme-color.php';
        include_once ARNABWP_DIR_PATH . '/inc/customizer/basic_customizer/theme-typography.php';
        include_once ARNABWP_DIR_PATH . '/inc/customizer/basic_customizer/theme-breadcrumb.php';
        include_once ARNABWP_DIR_PATH . '/inc/customizer/basic_customizer/theme-preloader.php';
        include_once ARNABWP_DIR_PATH . '/inc/customizer/basic_customizer/theme-general.php';
      
        // Register each section with the customizer
        add_color_section( $wp_customize );
        add_typography_section( $wp_customize );
        add_breadcrumb_section( $wp_customize );
        add_preloader_section( $wp_customize );
        add_general_section( $wp_customize );
        
    }
}
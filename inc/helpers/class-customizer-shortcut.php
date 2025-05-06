<?php
/**
 * Customizer Shortcut Class
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Helpers;

class Customizer_Shortcut {

    public function __construct() {
        

        // Enqueue in Customizer live preview
        add_action( 'customize_preview_init', [ $this, 'enqueue_preview' ] );

        // Enqueue in frontend when in Customizer preview mode
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_frontend' ] );
    }



    /**
     * Enqueue scripts for the Customizer live preview frame
     */
    public function enqueue_preview() {
        $this->enqueue_common_assets();
    }

    /**
     * Enqueue scripts on the frontend during Customizer preview
     */
    public function enqueue_frontend() {
        if ( is_customize_preview() ) {
            $this->enqueue_common_assets();
        }
    }

    /**
     * Reusable method to enqueue JS/CSS and localize data
     */
    private function enqueue_common_assets() {
        wp_enqueue_script(
            'arnabwp-customizer-shortcut',
            ARNABWP_TEMP_DIR_URI . '/assets/js/customizer/helpers/customizer-shortcut.js',
            ['jquery'],
            null,
            true
        );

        wp_enqueue_style(
            'arnabwp-customizer-shortcut-style',
            ARNABWP_TEMP_DIR_URI . '/assets/css/customizer/customizer-shortcut.css',
            [],
            null
        );
    }

    /**
     * Output shortcut icon for Customizer section jump
     *
     * @param string $section_id
     */
    public static function arnabwp_display_shortcut( $section_id ) {
        if ( is_customize_preview() && $section_id ) {
            echo '<div class="customizer-shortcut">';
            echo '<a href="#" class="customize-partial-edit-shortcut" data-section="' . esc_attr( $section_id ) . '">';
            echo '<span class="dashicons dashicons-edit"></span>';
            echo '</a>';
            echo '</div>';
        }
    }
}

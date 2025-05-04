<?php
/**
 * Color Output Helper Class
 * 
 * Helper class to output color styles from Customizer.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Helpers;

/**
 * Class Color_Output
 *
 * Outputs dynamic color styles based on Customizer settings.
 */
class Color_Output {

    /**
     * Output root-level CSS custom properties (variables) for colors.
     *
     * Accepts an array of arrays with:
     * - string $css_var    The CSS variable name, e.g. '--primary-color'.
     * - string $setting    Theme mod key from Customizer.
     * - string $fallback   Fallback color if no theme mod is set.
     *
     * Example:
     * [
     *   ['--primary-color', 'arnabwp_primary_color', '#0073aa'],
     *   ['--accent-color', 'arnabwp_accent_color', '#dd3333']
     * ]
     *
     * @param array $colors Array of color variable definitions.
     */
    public static function arnabwp_output_root_colors( array $colors ) {
        if ( empty( $colors ) ) {
            return;
        }

        echo '<style>:root {';
        foreach ( $colors as [ $css_var, $setting, $fallback ] ) {
            $color = get_theme_mod( $setting, $fallback );
            if ( $color ) {
                echo "{$css_var}: {$color};";
            }
        }
        echo '}</style>';
    }

    /**
     * Output inline CSS rules to apply color to selectors.
     *
     * Accepts an array of arrays with:
     * - string $selector    CSS selector (e.g. '.site-title').
     * - string $property    CSS property (e.g. 'color' or 'background-color').
     * - string $setting     Theme mod key from Customizer.
     * - string $fallback    Fallback color if no theme mod is set.
     *
     * Example:
     * [
     *   ['.site-title', 'color', 'arnabwp_heading_color', '#000000'],
     *   ['.btn-primary', 'background-color', 'arnabwp_primary_color', '#0073aa']
     * ]
     *
     * @param array $rules Array of selector color rule definitions.
     */
    public static function arnabwp_output_color_rules( array $rules ) {
        if ( empty( $rules ) ) {
            return;
        }

        echo '<style>';
        foreach ( $rules as [ $selector, $property, $setting, $fallback ] ) {
            $color = get_theme_mod( $setting, $fallback );
            if ( $color ) {
                echo "{$selector} { {$property}: {$color}; }";
            }
        }
        echo '</style>';
    }
}

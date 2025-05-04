<?php
/**
 * Button Output Helper Class
 * 
 * Helper class to output button styles from Customizer.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Helpers;

/**
 * Class Button_Output
 *
 * Outputs CSS custom properties for buttons using Customizer settings.
 */
class Button_Output {

    /**
     * Outputs root-level CSS variables for button-related properties.
     *
     * Accepts an array of arrays where each sub-array contains:
     * - string $mod_name   The theme mod key used in the Customizer.
     * - string $css_var    The name of the CSS variable (without `--` prefix).
     * - string|int $default The default fallback value if theme mod is not set.
     * - string $unit       The unit to append (e.g., 'px', 'em').
     *
     * Example usage:
     * [
     *   [ 'arnabwp_button_padding', 'button-padding', 12, 'px' ],
     *   [ 'arnabwp_button_radius', 'button-radius', 4, 'px' ]
     * ]
     *
     * Will render:
     * :root {
     *   --button-padding: 12px;
     *   --button-radius: 4px;
     * }
     *
     * @param array $vars Array of variable definitions for button styles.
     */
    public static function arnabwp_output_root_buttons( $vars = [] ) {
        if ( empty( $vars ) || ! is_array( $vars ) ) {
            return;
        }

        $css = ":root {\n";

        foreach ( $vars as $var ) {
            // $var = [ 'mod_name', 'css_var', 'default', 'unit' ]
            list( $mod_name, $css_var, $default, $unit ) = $var;

            $value = get_theme_mod( $mod_name, $default );
            $value = absint( $value ); // For px values

            if ( $value || $value === 0 ) {
                $css .= "    --{$css_var}: {$value}{$unit};\n";
            }
        }

        $css .= "}\n";

        echo "<style type='text/css'>\n" . $css . "</style>";
    }
}

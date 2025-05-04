<?php
/**
 * Font Output Helper Class
 *
 * Outputs dynamic typography styles based on Customizer settings.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Helpers;

/**
 * Class Font_Output
 *
 * Contains helper methods to generate inline font-related CSS
 * (e.g., font family and responsive font sizes) from the Customizer.
 */
class Font_Output {

    /**
     * Output font family styles for multiple selectors.
     *
     * Each rule must be an array of:
     * [string $selector, string $property, string $setting, string $fallback]
     *
     * Example:
     * [
     *   ['body', 'font-family', 'arnabwp_body_font_family', 'sans-serif'],
     *   ['h1,h2,h3', 'font-family', 'arnabwp_heading_font_family', 'serif']
     * ]
     *
     * @param array $font_rules An array of font style rules.
     */
    public static function arnabwp_output_font_family( array $font_rules ) {
        foreach ( $font_rules as $rule ) {
            list( $selector, $property, $setting, $fallback ) = $rule;
            $value = get_theme_mod( $setting, $fallback );

            if ( ! empty( $value ) ) {
                echo "<style>{$selector} { {$property}: {$value}; }</style>";
            }
        }
    }

    /**
     * Output responsive font size for desktop, tablet, and mobile breakpoints.
     *
     * Retrieves a JSON-encoded array of sizes from the Customizer:
     * ['desktop' => '18', 'tablet' => '16', 'mobile' => '14']
     * Then outputs appropriate media queries for tablet and mobile.
     *
     * @param string $selector     CSS selector (e.g., 'body', 'h1').
     * @param string $mod_name     Theme mod key that stores JSON-encoded responsive sizes.
     * @param string $default_size Default desktop size if setting is missing.
     */
    public static function arnabwp_output_responsive_size( $selector, $mod_name, $default_size ) {
        // Debugging
        error_log('Font_Output::render called!');

        $values = get_theme_mod( $mod_name, json_encode([
            'desktop' => $default_size,
            'tablet'  => '',
            'mobile'  => ''
        ]) );

        $values = json_decode( $values, true );

        // Debugging values
        error_log(print_r($values, true));

        if ( ! is_array( $values ) ) {
            error_log('Values are not an array');
            return;
        }

        $css  = '';
        $unit = 'px';

        if ( ! empty( $values['desktop'] ) ) {
            $css .= "{$selector} { font-size: {$values['desktop']}{$unit}; }\n";
        } else {
            $css .= "{$selector} { font-size: {$default_size}{$unit}; }\n";
        }

        if ( ! empty( $values['tablet'] ) ) {
            $css .= "@media (min-width: 768px) and (max-width: 991px) {\n";
            $css .= "{$selector} { font-size: {$values['tablet']}{$unit}; }\n";
            $css .= "}\n";
        }

        if ( ! empty( $values['mobile'] ) ) {
            $css .= "@media (max-width: 767px) {\n";
            $css .= "{$selector} { font-size: {$values['mobile']}{$unit}; }\n";
            $css .= "}\n";
        }

        // Debugging output
        error_log("CSS: $css");

        echo "<style type='text/css'>\n" . $css . "\n</style>";
    }

    /**
     * Output a default font size style rule for a given selector.
     *
     * This method is used for simpler typography settings where only one value is needed
     * without responsiveness (e.g., a title or button font size).
     *
     * @param string $selector     CSS selector (e.g., '.site-title').
     * @param string $mod_name     Theme mod key from the Customizer.
     * @param string $default_size Default fallback value (e.g., '18').
     * @param string $property     CSS property to use (default: 'font-size').
     * @param string $unit         Unit to append (default: 'px').
     */
    public static function arnabwp_output_default_size( $selector, $mod_name, $default_size, $property = 'font-size', $unit = 'px' ) {
        $value = get_theme_mod( $mod_name, $default_size );

        if ( empty( $value ) ) {
            $value = $default_size;
        }

        $css = "{$selector} { {$property}: {$value}{$unit}; }\n";

        echo "<style type='text/css'>\n" . $css . "</style>";
    }
}

<?php
/**
 * Layout Output Helper Class
 * 
 * Output layout styles from Customizer settings.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Helpers;

/**
 * Class Layout_Output
 *
 * Outputs dynamic CSS for layout settings configured in the WordPress Customizer.
 */
class Layout_Output {

    /**
     * Output inline CSS for a given selector and set of CSS properties based on a Customizer setting.
     *
     * This method prints a `<style>` block applying the given properties with the customizer value (plus unit)
     * to the specified CSS selector.
     *
     * Example use:
     * arnabwp_output_site_layout_rules('.site-container', ['max-width'], 'arnabwp_container_width', 1200, 'px');
     *
     * @param string $selector   CSS selector to apply the styles to (e.g., '.site-container').
     * @param array  $properties Array of CSS properties to apply (e.g., ['max-width', 'width']).
     * @param string $setting    The theme mod key from the Customizer.
     * @param mixed  $fallback   Fallback value if the Customizer setting is not set (default: '').
     * @param string $unit       The unit to append to the numeric value (default: 'px').
     */
    public static function arnabwp_output_site_layout_rules( $selector, array $properties, $setting, $fallback = '', $unit = 'px' ) {
        $value = get_theme_mod( $setting, $fallback );

        if ( $value !== '' && $value !== null ) {
            $value = absint( $value ) . $unit;
            $rules = '';

            foreach ( $properties as $property ) {
                $rules .= "{$property}: {$value}; ";
            }

            echo "<style>{$selector} { {$rules} }</style>";
        }
    }

    /**
     * Output inline CSS rules for header layout based on Customizer selection.
     *
     * Supports the following header layouts:
     * - `logo-center`: Centered logo with nav items below.
     * - `logo-right`: Logo aligned right with nav items left.
     *
     * The method prints a `<style>` block to the head with layout-specific CSS.
     * It does nothing if the layout is the default (`logo-left`).
     */
    public static function arnabwp_output_header_layout_rules() {
        $layout = get_theme_mod( 'arnabwp_header_layout', 'logo-left' );

        if ( ! in_array( $layout, [ 'logo-center', 'logo-right' ], true ) ) {
            return;
        }

        echo '<style>';

        // Layout: Logo Centered
        if ( $layout === 'logo-center' ) {
            echo '
            .header-layout-logo-center header.site-header .navbar .container {
                flex-direction: column;
                align-items: center;
            }
            .header-layout-logo-center header.site-header .navbar-brand {
                margin-bottom: 1rem;
                text-align: center;
            }
            .header-layout-logo-center header.site-header .navbar-collapse {
                justify-content: center !important;
                text-align: center;
            }
            .header-layout-logo-center header.site-header .navbar-nav {
                flex-direction: row;
                gap: 1.5rem;
                justify-content: center;
            }
            @media (max-width: 991px) {
                .header-layout-logo-center header.site-header .navbar-nav {
                    flex-direction: column;
                }
            }';
        }

        // Layout: Logo Right
        if ( $layout === 'logo-right' ) {
            echo '
            .header-layout-logo-right .navbar .container {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }
            .header-layout-logo-right .navbar-collapse {
                order: 1;
                flex: 1;
            }
            .header-layout-logo-right .navbar-nav {
                display: flex;
                justify-content: flex-start;
                margin-left: 0 !important;
                margin-right: auto !important;
            }
            .header-layout-logo-right .navbar-brand {
                order: 2;
                margin-left: auto;
            }';
        }

        echo '</style>';
    }

}

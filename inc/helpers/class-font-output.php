<?php
/**
 * Font Output Helper Class
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Helpers;

class Font_Output {

	/**
	 * Outputs font-size CSS based on responsive range control.
	 *
	 * @param string $selector     The CSS selector (e.g. 'body', '.site-title').
	 * @param string $mod_name     The theme_mod name.
	 * @param int    $default_size The default desktop size (fallback).
	 */
    public static function render( $selector, $mod_name, $default_size = 16 ) {
    // Debugging
    error_log('Font_Output::render called!');
    
    $values = get_theme_mod( $mod_name, json_encode([ 'desktop' => $default_size, 'tablet' => '', 'mobile' => '' ]) );
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
        $css .= "{$selector} { font-size: {$values['desktop']}{$unit}; }" . "\n";
    } else {
        $css .= "{$selector} { font-size: {$default_size}{$unit}; }" . "\n";
    }
    
    if ( ! empty( $values['tablet'] ) ) {
        // Bootstrap's tablet breakpoint is between 768px and 991px
        $css .= "@media (min-width: 768px) and (max-width: 991px) {\n";
        $css .= "{$selector} { font-size: {$values['tablet']}{$unit}; }" . "\n";
        $css .= "}\n";
    }
    
    if ( ! empty( $values['mobile'] ) ) {
        // Bootstrap's mobile breakpoint is ≤767px
        $css .= "@media (max-width: 767px) {\n";
        $css .= "{$selector} { font-size: {$values['mobile']}{$unit}; }" . "\n";
        $css .= "}\n";
    }
    // Debugging output
    error_log("CSS: $css");

    echo "<style type='text/css'>\n" . $css . "\n</style>";
}
}
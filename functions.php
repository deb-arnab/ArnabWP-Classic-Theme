<?php
/**
 * Theme Functions
 * 
 * @package ArnabWP
 */



 if ( ! defined( 'ARNABWP_DIR_PATH' ) ) {
	define( 'ARNABWP_DIR_PATH', untrailingslashit( get_template_directory() ) );
}

if ( ! defined( 'ARNABWP_TEMP_DIR_URI' ) ) {
	define( 'ARNABWP_TEMP_DIR_URI', untrailingslashit( get_template_directory_uri() ) );
}

require_once ARNABWP_DIR_PATH . '/inc/autoloader.php';

function arnabwp_get_theme_instance(){

    \ARNABWP_THEME\Inc\ArnabWP::get_instance();

}
arnabwp_get_theme_instance();




// Sanitization callback for the repeater field
function arnabwp_sanitize_repeater($input) {
    $input_decoded = json_decode($input, true);
    if (!is_array($input_decoded)) {
        return json_encode([]);  // Return empty array if not an array
    }

    $clean = [];
    foreach ($input_decoded as $item) {
        if (isset($item['image'])) {
            $clean_item = [
                'image' => esc_url_raw($item['image']),  // Sanitize image URLs
            ];
            $clean[] = $clean_item;
        }
    }

    return json_encode($clean);
}


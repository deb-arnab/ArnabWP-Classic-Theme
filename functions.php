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

require_once ARNABWP_DIR_PATH . '/inc/helpers/autoloader.php';

function arnabwp_get_theme_instance(){

    \ARNABWP_THEME\Inc\ArnabWP::get_instance();
    // \ARNABWP_THEME\Inc\MENUS::get_instance();
}
arnabwp_get_theme_instance();

function arnabwp_setup_homepage_content() {
    // Only run if no front page is set
    if ( get_option( 'show_on_front' ) !== 'page' ) {

        // Create new page
        $homepage = array(
            'post_title'   => 'Home',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => 
                '<!-- wp:pattern {"slug":"arnabwp/testimonials-static"} /-->'.
                "\n" .
                '<!-- wp:pattern {"slug":"arnabwp/team-static"} /-->',
        );

        $home_id = wp_insert_post( $homepage );

        if ( $home_id && ! is_wp_error( $home_id ) ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $home_id );
        }
    }
}
add_action( 'after_switch_theme', 'arnabwp_setup_homepage_content' );


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


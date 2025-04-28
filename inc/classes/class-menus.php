<?php
/**
 * Adds Dynamic Menus to the Theme
 * 
 * @package ArnabWP
 */

 
namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;
 
class Menus {
     use Singleton;
 
 
protected function __construct(){
 
    //Load Class

    $this->setup_hooks();
    

 }

protected function setup_hooks(){

     //Action Hooks
     add_action('init',array( $this,'arnabwp_register_menus' ));
 }

 public function arnabwp_register_menus() {
    register_nav_menus(
        array(
            'arnabwp_primary_menu' => esc_html__( 'Primary Menu', 'arnabwp' ),
            'arnabwp_footer_menu' => esc_html__( 'Footer Menu', 'arnabwp' ),
        ));
}

    /**
     * Load and return the custom nav walker.
     *
     * @return \ARNABWP_THEME\Inc\Walker_Menus|null
     */
    public function arnabwp_get_navwalker() {
        $walker_path = ARNABWP_DIR_PATH . '/inc/classes/class-walker-menus.php';

        if ( file_exists( $walker_path ) ) {
            require_once $walker_path;
            return \ARNABWP_THEME\Inc\Walker_Menus::get_instance();
        }

        return null;
    }

    /**
     * Get menu ID by theme location.
     *
     * @param string $location
     * @return int|string
     */
    public function get_arnabwp_menu_id( string $location ) {
        $locations = get_nav_menu_locations();
        return $locations[ $location ] ?? '';
    }

}
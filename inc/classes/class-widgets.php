<?php

/**
 * Theme Setup Class for Widgets
 * 
 * This class handles the registration and initialization of widget areas for the theme.
 * It includes the sidebar and footer widget areas, as well as any additional widget areas
 * that may be needed for custom sections.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;

class Widgets
{
    // Use Singleton trait to ensure a single instance of this class
    use Singleton;

    /**
     * Constructor method to initialize the widget setup process
     */
    protected function __construct()
    {
        $this->setup_hooks();
    }

    /**
     * Set up action hooks for widget registration
     *
     * This method adds the 'widgets_init' action to call the widget registration function.
     */
    protected function setup_hooks()
    {
        // Add action hook to initialize widgets during 'widgets_init' phase
        add_action('widgets_init', [$this, 'arnabwp_register_widgets']);
    }

    /**
     * Register theme widget areas
     *
     * This method registers the widget areas (sidebars and footer widget areas)
     * for the theme. It includes:
     * - Primary Sidebar
     * - Four Footer Widget Areas (1 for each column)
     * 
     * Additional widget areas can be registered here as needed.
     */
    public function arnabwp_register_widgets()
    {
        // Register Primary Sidebar Widget Area
        register_sidebar( [
            'name'          => esc_html__( 'Primary Sidebar', 'arnabwp' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Widgets in this area will be shown on all posts and pages.', 'arnabwp' ),
            'before_widget' => '<section id="%1$s" class="widget sidebar-widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ] );

        // Register Footer Widget Areas (4 columns)
        for ( $i = 1; $i <= 4; $i++ ) {
            register_sidebar( [
                'name'          => sprintf( esc_html__( 'Footer Column %d', 'arnabwp' ), $i ),
                'id'            => 'footer-' . $i,
                'description'   => sprintf( esc_html__( 'Widgets in this area will appear in footer column %d.', 'arnabwp' ), $i ),
                'before_widget' => '<section id="%1$s" class="widget footer-widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ] );
        }
    }
}

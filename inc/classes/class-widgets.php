<?php

/**
 * Theme Setup Class
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;

class Widgets
{
    use Singleton;

    protected function __construct()
    {
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {

        add_action('widgets_init', [$this, 'arnabwp_register_widgets']);
    }

    public function arnabwp_register_widgets()
    {

		// Sidebar Widget Area
		register_sidebar( [
			'name'          => esc_html__( 'Primary Sidebar', 'arnabwp' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Widgets in this area will be shown on all posts and pages.', 'arnabwp' ),
			'before_widget' => '<section id="%1$s" class="widget sidebar-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		] );

		// Footer Widget Areas (4 columns)
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

		/**
		 * Additional Custom Widget Areas (Optional)
		 * Example: Header widget, page-specific widgets, etc.
		 * Use `register_sidebar()` here if needed.
		 */
	}
}

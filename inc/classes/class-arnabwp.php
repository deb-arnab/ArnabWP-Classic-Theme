<?php

/**
 * Main Theme Class.
 * 
 * Initializes and configures core theme features such as support for custom logos,
 * post thumbnails, HTML5 support, custom post types, widgets, and more.
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;
use ARNABWP_THEME\Inc\Enqueue;
use ARNABWP_THEME\Inc\Menus;
use ARNABWP_THEME\Inc\Breadcrumbs;
use ARNABWP_THEME\Inc\Pagination;
use ARNABWP_THEME\Inc\Widgets;
use ARNABWP_THEME\Inc\Custom_Post_Types;
use ARNABWP_THEME\Inc\Custom_Meta_Boxes;
use ARNABWP_THEME\Inc\Theme_Customizer;
use ARNABWP_THEME\Inc\Shortcode;


/**
 * Class ArnabWP
 * 
 * The entry point of the theme which loads all essential components.
 */
class ArnabWP
{
	use Singleton;

	/**
	 * Constructor function.
	 * 
	 * Initializes core theme classes and registers necessary hooks.
	 */
	protected function __construct()
	{
		// Initialize theme components
		
		Enqueue::get_instance();
		Menus::get_instance();
		Breadcrumbs::get_instance();
		Pagination::get_instance();
		Widgets::get_instance();
		Custom_Post_Types::get_instance();
		Custom_Meta_Boxes::get_instance();
		Theme_Customizer::get_instance();
		Shortcode::get_instance();
	


		// Setup theme hooks
		$this->setup_hooks();
	}

	/**
	 * Setup theme-related action and filter hooks.
	 * 
	 * @return void
	 */
	protected function setup_hooks()
	{
		add_action('after_setup_theme', [$this, 'arnabwp_theme_support']);
		add_filter('excerpt_more', [$this, 'custom_excerpt_more']);
		add_filter('excerpt_length', [$this, 'custom_excerpt_length'], 999);
		// Register patterns after WordPress has initialized
	add_action('init', [$this, 'register_block_patterns']);
	add_action( 'after_switch_theme', 'arnabwp_setup_homepage_content' );
	}

	/**
	 * Register theme support for WordPress core features.
	 * 
	 * @return void
	 */
	public function arnabwp_theme_support()
	{
		// Add support for document title
		add_theme_support('title-tag');

		// Add support for custom logo
		add_theme_support('custom-logo', [
			'header-text' => ['site-title', 'site-description'],
			'height'      => 100,
			'width'       => 300,
			'flex-height' => true,
			'flex-width'  => true,
		]);

		// Add support for custom background
		// add_theme_support( 'custom-background', [
		// 	'default-image' => '',
		// 	'default-size'  => 'cover',
		// ] );

		// Enable post thumbnails for various post types
		add_theme_support('post-thumbnails', [
			'post',
			'page',
			'service',
			'testimonial',
			'employee',
			'client',
		]);

		// Register custom image size
		add_image_size('post-thumbnails', 800, 500, true);

		// Add support for post formats
		add_theme_support('post-formats', [
			'aside',
			'gallery',
			'quote',
			'image',
			'video',
		]);

		// Enable selective refresh for widgets in Customizer
		add_theme_support('customize-selective-refresh-widgets');

		// Enable HTML5 markup support
		add_theme_support('html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
		]);

		add_theme_support( 'editor-styles' );
add_editor_style( 'assets/css/editor-style.css' );

		// Add support for automatic feed links
		add_theme_support('automatic-feed-links');

		// Enable block editor enhancements
		add_theme_support('wp_block_styles');
		add_theme_support('responsive-embeds');
		add_theme_support('align-wide');

		// Set default content width if not already set
		global $content_width;
		if (! isset($content_width)) {
			$content_width = 1240;
		}

	
	}

/**
 * Register custom block patterns and categories.
 */
public function register_block_patterns() {
	// Register a custom category
	if ( function_exists( 'register_block_pattern_category' ) ) {
		register_block_pattern_category(
			'arnabwp-sections',
			[ 'label' => __( 'ArnabWP Patterns', 'arnabwp' ) ]
		);
	}

	// Register the testimonial static pattern
	if ( function_exists( 'register_block_pattern' ) ) {
		register_block_pattern(
			'arnabwp/testimonials-static',
			require get_template_directory() . '/patterns/testimonials-static.php'
		);
		register_block_pattern(
			'arnabwp/team-static',
			require get_template_directory() . '/patterns/team-static.php'
		);
		register_block_pattern(
			'arnabwp/features-static',
			require get_template_directory() . '/patterns/features-static.php'
		);
		register_block_pattern(
			'arnabwp/features-modern',
			require get_template_directory() . '/patterns/features-modern.php'
		);
	}
}

public function arnabwp_setup_homepage_content() {
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
                '<!-- wp:pattern {"slug":"arnabwp/team-static"} /-->'.
                "\n" .
                '<!-- wp:pattern {"slug":"arnabwp/features-static"} /-->',
        );

        $home_id = wp_insert_post( $homepage );

        if ( $home_id && ! is_wp_error( $home_id ) ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $home_id );
        }
    }
}


	/**
	 * Customize the string displayed at the end of excerpts.
	 * 
	 * @param string $more The existing excerpt string.
	 * @return string Modified excerpt ending.
	 */
	public function custom_excerpt_more($more)
	{
		return '...'; // Replace default [read more] with ellipsis
	}

	/**
	 * Customize the excerpt length in number of words.
	 * 
	 * @return int Excerpt length.
	 */
	public function custom_excerpt_length()
	{
		return 40; // Default length can be changed to fit theme style
	}
}

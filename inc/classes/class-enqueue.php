<?php

/**
 * Enqueue Theme Assets
 * 
 * @package ArnabWP
 */


namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;

class Enqueue
{
    use Singleton;


    protected function __construct()
    {

        //Load Class

        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        //Action Hooks
        add_action('wp_enqueue_scripts', array($this, 'arnabwp_enqueue_styles'));
        add_action('wp_enqueue_scripts', array($this, 'arnabwp_enqueue_scripts'));
    }


    public function arnabwp_enqueue_styles()
    {

        // Register and Enqueue Theme Stylesheet
        wp_register_style('style-css', get_stylesheet_uri(), [], filemtime(ARNABWP_DIR_PATH . '/style.css'), 'all');
        wp_enqueue_style('style-css');

        // Register and Enqueue Bootstrap CSS
        wp_register_style('bootstrap-css', ARNABWP_TEMP_DIR_URI . '/assets/css/bootstrap.min.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/bootstrap.min.css'), 'all');
        wp_enqueue_style('bootstrap-css');

        // Register and Enqueue Custom CSS
        wp_register_style('custom-css', ARNABWP_TEMP_DIR_URI . '/assets/css/custom.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/custom.css'), 'all');
        wp_enqueue_style('custom-css');


        wp_register_style('arnabwp-preloader-css', ARNABWP_TEMP_DIR_URI . '/assets/css/basics/preloader.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/basics/preloader.css'), 'all');
        wp_enqueue_style('arnabwp-preloader-css');

        // Register and Enqueue Frontpage CSS
        wp_register_style('arnabwp-frontpage-css', ARNABWP_TEMP_DIR_URI . '/assets/css/frontpage.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/frontpage.css'), 'all');
        wp_enqueue_style('arnabwp-frontpage-css');

        // Register and Enqueue Blog comment CSS
        wp_register_style('arnabwp-comments-css', ARNABWP_TEMP_DIR_URI . '/assets/css/blog/comments.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/blog/comments.css'), 'all');
        wp_enqueue_style('arnabwp-comments-css');

        // Register and Enqueue Blog pagination CSS
        wp_register_style('arnabwp-pagination-css', ARNABWP_TEMP_DIR_URI . '/assets/css/blog/pagination.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/blog/pagination.css'), 'all');
        wp_enqueue_style('arnabwp-pagination-css');

        wp_register_style('arnabwp-blogpost-css', ARNABWP_TEMP_DIR_URI . '/assets/css/blog/blogpost.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/blog/blogpost.css'), 'all');
        wp_enqueue_style('arnabwp-blogpost-css');

        wp_register_style('arnabwp-breadcrumbs-css', ARNABWP_TEMP_DIR_URI . '/assets/css/basics/breadcrumbs.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/basics/breadcrumbs.css'), 'all');
        wp_enqueue_style('arnabwp-breadcrumbs-css');

        wp_register_style('arnabwp-footer-widgets-css', ARNABWP_TEMP_DIR_URI . '/assets/css/basics/footer-widgets.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/basics/footer-widgets.css'), 'all');
        wp_enqueue_style('arnabwp-footer-widgets-css');

        wp_register_style('arnabwp-widgets-css', ARNABWP_TEMP_DIR_URI . '/assets/css/basics/widgets.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/basics/widgets.css'), 'all');
        wp_enqueue_style('arnabwp-widgets-css');

        wp_register_style('arnabwp-sidebar-widgets-css', ARNABWP_TEMP_DIR_URI . '/assets/css/basics/sidebar-widgets.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/basics/sidebar-widgets.css'), 'all');
        wp_enqueue_style('arnabwp-sidebar-widgets-css');

        wp_register_style('arnabwp-sidebar-layout-css', ARNABWP_TEMP_DIR_URI . '/assets/css/basics/sidebar-layout.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/basics/sidebar-layout.css'), 'all');
        wp_enqueue_style('arnabwp-sidebar-layout-css');

        wp_register_style('arnabwp-scroll-to-top-css', ARNABWP_TEMP_DIR_URI . '/assets/css/basics/scroll-to-top.css', [], filemtime(ARNABWP_DIR_PATH . '/assets/css/basics/scroll-to-top.css'), 'all');
        wp_enqueue_style('arnabwp-scroll-to-top-css');


        // Enqueue Google Fonts

        wp_enqueue_style(
            'google-fonts',
            'https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap',
            false
        );

        // Owl Carousel CSS
        wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
        wp_enqueue_style('owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css');

        // Register Font Awesome
        wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], '6.5.0', 'all');

        // Enqueue Font Awesome
        wp_enqueue_style('font-awesome');
    }

    public function arnabwp_enqueue_scripts()
    {

        // Enqueue jQuery 
        wp_enqueue_script('jquery');

        // Register and Enqueue Bootstrap JS
        wp_register_script(
            'bootstrap-js',
            ARNABWP_TEMP_DIR_URI . '/assets/js/bootstrap.min.js',
            ['jquery'],
            filemtime(ARNABWP_DIR_PATH . '/assets/js/bootstrap.min.js'),
            true
        );
        wp_enqueue_script('bootstrap-js');

        // Register and Enqueue Main JS
        wp_register_script(
            'main-js',
            ARNABWP_TEMP_DIR_URI . '/assets/js/main.js',
            [],
            filemtime(ARNABWP_DIR_PATH . '/assets/js/main.js'),
            true
        );
        wp_enqueue_script('main-js');





        // Owl Carousel JS
        wp_enqueue_script('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), null, true);

         // Register and Enqueue Main JS
         wp_register_script(
            'arnabwp-slider-js',
            ARNABWP_TEMP_DIR_URI . '/assets/js/owl-carousel/slider.js',
            [],
            filemtime(ARNABWP_DIR_PATH . '/assets/js/owl-carousel/slider.js'),
            true
        );
        wp_enqueue_script('arnabwp-slider-js');
    }
}

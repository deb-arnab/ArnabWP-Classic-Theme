<?php

/**
 * Theme Customizer Class.
 * 
 * This class manages all theme customizer settings, including custom sections
 * and controls for various theme options like header, footer, typography, and colors.
 * It also handles the output of customizer settings as inline styles in the head.
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;
use ARNABWP_THEME\Inc\Traits\Footer_Options;
use ARNABWP_THEME\Inc\Traits\Header_Options;
use ARNABWP_THEME\Inc\Traits\Frontpage_Options;
use ARNABWP_THEME\Inc\Traits\Basic_Options;

// Load custom controls if in preview or admin
if ( is_customize_preview() || is_admin() ) {
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-toggle-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-range-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-repeater-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-tabs-control.php';
}

/**
 * Class Theme_Customizer
 * 
 * Handles all customizer settings using modular traits for footer, header, frontpage, and basic theme options.
 */
class Theme_Customizer {

    // Use Singleton trait to ensure a single instance of this class
    use Singleton;
    use Footer_Options;
    use Header_Options;
    use Frontpage_Options;
    use Basic_Options;

    /**
     * Constructor. Registers hooks.
     */
    protected function __construct() {
        $this->setup_hooks();
    }

    /**
     * Register necessary action hooks for customizing theme settings.
     *
     * - 'customize_register' to register the customizer settings
     * - 'wp_head' to output the customizer styles in the head
     * - 'body_class' filter to add header layout class to the body
     */
    protected function setup_hooks() {
        // Add action hooks for customizer settings and styles
        add_action( 'customize_register', [ $this, 'arnabwp_register_customizer_settings' ] );
        add_action( 'wp_head', [ $this, 'arnabwp_output_customizer_styles' ] );

        // Add body class for header layout
        add_filter( 'body_class', function ( $classes ) {
            $layout = get_theme_mod( 'arnabwp_header_layout', 'logo-left' );
            $classes[] = 'header-layout-' . sanitize_html_class( $layout );
            return $classes;
        });
    }

    /**
     * Register customizer settings for various sections (footer, header, frontpage, and basic theme options).
     *
     * @param \WP_Customize_Manager $wp_customize Customizer object.
     */
    public function arnabwp_register_customizer_settings( $wp_customize ) {
        $this->add_footer_section( $wp_customize );
        $this->add_header_section( $wp_customize );
        $this->add_frontpage_panel( $wp_customize );
        $this->add_theme_basic_options_panel( $wp_customize );
    }

    /**
     * Output custom styles based on customizer settings into the head.
     * 
     * This includes custom styles for site width, buttons, typography, colors, 
     * preloader, header, breadcrumbs, footer, and hero section.
     */
    public function arnabwp_output_customizer_styles() {

        // === Site Width Styles === //
        $container_width = get_theme_mod( 'arnabwp_container_width', 1200 );

        echo '<style type="text/css">';
        echo '.site-container {
            max-width: ' . absint( $container_width ) . 'px;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }';
        echo '</style>';
      
        // === Button Styles === //
        $padding_top_bottom = get_theme_mod( 'arnabwp_button_padding_top_bottom', 10 );
        $padding_left_right = get_theme_mod( 'arnabwp_button_padding_left_right', 15 );
        $button_radius      = get_theme_mod( 'arnabwp_button_radius', 5);

        // Ensure values are integers
        $padding_top_bottom = absint( $padding_top_bottom );
        $padding_left_right = absint( $padding_left_right );
        $button_radius      = absint( $button_radius );

        // Only output if values exist
        if ( $padding_top_bottom || $padding_left_right ) :
        ?>
        <style>
            :root {
                --arnabwp-button-padding-top-bottom: <?php echo esc_attr( $padding_top_bottom ); ?>px;
                --arnabwp-button-padding-left-right: <?php echo esc_attr( $padding_left_right ); ?>px;
                --arnabwp-button-radius: <?php echo esc_attr( $button_radius ); ?>px;
            }
        </style>
        <?php
        endif;

        // === Preloader Styles === //
        $preloader_bg_color = get_theme_mod('preloader_background_color', '#ffffff');
        $preloader_spinner_color = get_theme_mod('preloader_spinner_color', '#007bff');
        ?>
        <style type="text/css">
            #preloader {
                background-color: <?php echo esc_attr($preloader_bg_color); ?>;
            }
            #preloader .preloader-spinner {
                border-top-color: <?php echo esc_attr($preloader_spinner_color); ?>;
            }
        </style>
        <?php

        // === Typography Styles === //
        $body_font      = get_theme_mod( 'arnabwp_body_font_family', 'Arial, sans-serif' );
        $heading_font   = get_theme_mod( 'arnabwp_heading_font_family', 'Georgia, serif' );

        $body_font_size = get_theme_mod( 'arnabwp_body_font_size', 16 );
        $heading_size   = get_theme_mod( 'arnabwp_heading_font_size', 32 );
        $content_title_font_size = get_theme_mod( 'arnabwp_content_title_font_size', 32 );

        echo '<style type="text/css">';
        echo "body { font-family: {$body_font}; font-size: {$body_font_size}px; }";
        echo "h1, h2, h3, h4, h5, h6 { font-family: {$heading_font}; font-size: {$heading_size}px; }";
        echo ".entry-title, .post-title { font-size: {$content_title_font_size}px; }";
        
        // === Color Styles Refactored into a Loop === //
        $color_settings = [
            'primary_color'          => '--primary-color',
            'secondary_color'        => '--secondary-color',
            'custom_background_color'=> '--background-color',
            'text_color'             => '--text-color',
            'heading_color'          => '--heading-color',
            'link_color'             => '--link-color',
            'button_color'           => '--button-color',
            'button_text_color'      => '--button-text-color',
        ];

        foreach ( $color_settings as $setting => $css_var ) {
            $color = get_theme_mod( $setting );
            if ( $color ) {
                echo ":root { {$css_var}: {$color}; }";
            }
        }

        echo '</style>';

        // === Footer Styles === //
        $footer_heading_color= get_theme_mod('arnabwp_footer_widget_heading_color', '#ffffff');
        $footer_text_color= get_theme_mod('arnabwp_footer_widget_text_color', '#bbbbbb');
        $footer_copyright_color= get_theme_mod('arnabwp_footer_copyright_text_color', '#999999');

        if ( $footer_heading_color || $footer_text_color || $footer_copyright_color )
            echo '
            <style type="text/css">
                .site-footer .footer-widget .wp-block-heading{
                    color: '.esc_attr( $footer_heading_color ).'!important;
                }

                .site-footer .footer-widget ul li,
                .site-footer .footer-widget p
                {
                    color: '.esc_attr( $footer_text_color ). '!important;
                }

                .site-footer .footer-copy {
                    color:'.esc_attr( $footer_copyright_color).';
                }
            </style>';

        // === Hero Section Styles === //
        $hero_title_fontsize= get_theme_mod('arnabwp_hero_title_font_size', 40);
        $hero_subtitle_fontsize= get_theme_mod('arnabwp_hero_subtitle_font_size', 16);

        $hero_title_color= get_theme_mod('arnabwp_hero_title_color', '#ffffff');
        $hero_subtitle_color= get_theme_mod('arnabwp_hero_subtitle_color', '#ffffff');

        $hero_btn_bg_color= get_theme_mod('arnabwp_hero_btn_bg_color', '#0073e6');
        $hero_btn_text_color= get_theme_mod('arnabwp_hero_btn_text_color', '#ffffff');

        if ( $hero_title_color || $hero_subtitle_color )
            echo '
            <style type="text/css">
                .hero-content h1
                {
                    color: '.esc_attr( $hero_title_color ).';
                    font-size: '.esc_attr($hero_title_fontsize).'px;
                }

                .hero-content p
                {
                    color: '.esc_attr( $hero_subtitle_color ).';
                    font-size: '.esc_attr($hero_subtitle_fontsize).'px;
                }
                .hero-buttons .hero-btn
                {
                    color: '.esc_attr( $hero_btn_text_color). ';
                    background-color: '.esc_attr( $hero_btn_bg_color ). ';
                }
            </style>';
    }
}

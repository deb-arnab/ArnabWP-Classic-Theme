<?php
/**
 * Theme Customizer Class.
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;
use ARNABWP_THEME\Inc\Traits\Footer_Options;
use ARNABWP_THEME\Inc\Traits\Typography_Options;
use ARNABWP_THEME\Inc\Traits\Color_Options;
use ARNABWP_THEME\Inc\Traits\Header_Options;
use ARNABWP_THEME\Inc\Traits\Breadcrumb_Options;
use ARNABWP_THEME\Inc\Traits\Frontpage_Options;

if ( is_customize_preview() || is_admin() ) {
require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-toggle-control.php';
require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-repeater-control.php';

}

/**
 * Class Theme_Customizer
 * 
 * Handles all customizer settings using modular traits.
 */
class Theme_Customizer {

    use Singleton;
    use Footer_Options;
    use Typography_Options;
    use Color_Options;
    use Header_Options;
    use Breadcrumb_Options;
    use Frontpage_Options;

    /**
     * Constructor. Registers hooks.
     */
    protected function __construct() {
        $this->setup_hooks();
    }

    /**
     * Register necessary action hooks.
     */
    protected function setup_hooks() {
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
     * Register customizer settings.
     *
     * @param \WP_Customize_Manager $wp_customize Customizer object.
     */
    public function arnabwp_register_customizer_settings( $wp_customize ) {
        $this->add_footer_section( $wp_customize );
        $this->add_typography_section( $wp_customize );
        $this->add_color_section( $wp_customize );
        $this->add_header_section( $wp_customize );
        $this->add_breadcrumb_section( $wp_customize );
        $this->add_frontpage_panel( $wp_customize );
    }

    /**
     * Output custom styles from customizer settings into the head.
     */
    public function arnabwp_output_customizer_styles() {
        
        // === Typography Styles === //
        $body_font      = get_theme_mod( 'arnabwp_body_font_family', 'Arial, sans-serif' );
        $heading_font   = get_theme_mod( 'arnabwp_heading_font_family', 'Georgia, serif' );
        $body_font_size = get_theme_mod( 'arnabwp_body_font_size', 16 );
        $heading_size   = get_theme_mod( 'arnabwp_heading_font_size', 32 );

        echo '<style type="text/css">';
        echo "body { font-family: {$body_font}; font-size: {$body_font_size}px; }";
        echo "h1, h2, h3, h4, h5, h6 { font-family: {$heading_font}; font-size: {$heading_size}px; }";


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
        
        $colors = [
            'primary_color'          => get_theme_mod( 'primary_color' ),
            'secondary_color'        => get_theme_mod( 'secondary_color' ),
            'custom_background_color'=> get_theme_mod( 'custom_background_color' ),
            'text_color'             => get_theme_mod( 'text_color' ),
            'heading_color'          => get_theme_mod( 'heading_color' ),
            'link_color'             => get_theme_mod( 'link_color' ),
            'button_color'           => get_theme_mod( 'button_color' ),
            'button_text_color'      => get_theme_mod( 'button_text_color' ),
        ];

        if ( $colors['primary_color'] ) {
            echo ":root { --primary-color: {$colors['primary_color']}; }";
        }
        if ( $colors['secondary_color'] ) {
            echo ":root { --secondary-color: {$colors['secondary_color']}; }";
        }
        if ( $colors['custom_background_color'] ) {
            echo "body { background-color: {$colors['custom_background_color']}; }";
        }
        if ( $colors['text_color'] ) {
            echo "body, p, span, li, .text { color: {$colors['text_color']}; }";
        }
        if ( $colors['heading_color'] ) {
            echo "h1, h2, h3, h4, h5, h6 { color: {$colors['heading_color']}; }";
        }
        if ( $colors['link_color'] ) {
            echo "a { color: {$colors['link_color']}; }";
        }
        if ( $colors['button_color'] ) {
            echo "button, .btn { background-color: {$colors['button_color']}; }";
        }
        if ( $colors['button_text_color'] ) {
            echo "button, .btn { color: {$colors['button_text_color']}; }";
        }

        // === Header Styles === //
        $layout     = get_theme_mod( 'arnabwp_header_layout', 'logo-left' );
        $sticky     = get_theme_mod( 'arnabwp_sticky_header', false );
        $bg_color   = get_theme_mod( 'arnabwp_header_bg_color', '#000' );
        $text_color = get_theme_mod( 'arnabwp_header_text_color', '#fff' );
        $font       = get_theme_mod( 'arnabwp_menu_font_size', 16 );

        if ( $bg_color ) {
            echo "header.site-header { background-color: {$bg_color}; }";
        }
        if ( $text_color ) {
            echo "header.site-header .navbar-nav .nav-link { color: {$text_color}; }";
        }
        if ( $font ) {
            echo "header.site-header .navbar-nav a { font-size: {$font}px; }";
        }
        if ( $sticky ) {
            echo "header.site-header { position: sticky; top: 0; z-index: 999; }";
        }

        // === Layout-Specific Header Styles === //
        if ( $layout === 'logo-center' ) {
            echo '.header-layout-logo-center header.site-header .navbar .container {
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

        if ( $layout === 'logo-right' ) {
            echo '.header-layout-logo-right .navbar .container {
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
 


// === Breadcrumb Styles === //
$bc_font_size  = get_theme_mod( 'arnabwp_breadcrumb_font_size', 14 );
$bc_font_color = get_theme_mod( 'arnabwp_breadcrumb_color', '#666666' );

echo '<style type="text/css">
	.arnabwp-breadcrumb {
		font-size: ' . intval( $bc_font_size ) . 'px;
		color: ' . esc_attr( $bc_font_color ) . ';
	}
	.arnabwp-breadcrumb a {
		color: ' . esc_attr( $bc_font_color ) . ';
		text-decoration: none;
	}
	.arnabwp-breadcrumb-separator {
		margin: 0 8px;
		color: ' . esc_attr( $bc_font_color ) . ';
	}
</style>';

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
$hero_title_color= get_theme_mod('arnabwp_hero_title_color', '#ffffff');
$hero_subtitle_color= get_theme_mod('arnabwp_hero_subtitle_color', '#ffffff');

$hero_btn_bg_color= get_theme_mod('arnabwp_hero_btn_bg_color', '#0073e6');
$hero_btn_hover_bg_color= get_theme_mod('arnabwp_hero_btn_hover_bg_color', '#0073e8');

$hero_btn_text_color= get_theme_mod('arnabwp_hero_btn_text_color', '#ffffff');
$hero_btn_hover_text_color= get_theme_mod('arnabwp_hero_btn_hover_text_color', '#ffffff');

if ( $hero_title_color || $hero_subtitle_color )
    
    echo '
    <style type="text/css">
        .hero-content h1{
            color: '.esc_attr( $hero_title_color ).';
        }

         .hero-content p
        {
            color: '.esc_attr( $hero_subtitle_color ). ';
        }
         .hero-buttons .hero-btn
        {
            color: '.esc_attr( $hero_btn_text_color). ';
            background-color: '.esc_attr( $hero_btn_bg_color ). ';
        }
         .hero-buttons .hero-btn:hover
        {
            color: '.esc_attr( $hero_btn_hover_text_color ). ';
           background-color: '.esc_attr( $hero_btn_hover_bg_color ). ';
        }
    </style>';

}
}

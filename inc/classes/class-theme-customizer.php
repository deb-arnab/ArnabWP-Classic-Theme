<?php
/**
 * Theme Customizer Class.
 * 
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc;

use ARNABWP_THEME\Inc\Traits\Singleton;
use ARNABWP_THEME\Inc\Traits\Footer_Options;
use ARNABWP_THEME\Inc\Traits\Header_Options;
use ARNABWP_THEME\Inc\Traits\Frontpage_Options;
use ARNABWP_THEME\Inc\Traits\Basic_Options;

if ( is_customize_preview() || is_admin() ) {
require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-toggle-control.php';
require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-range-control.php';
require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-repeater-control.php';
require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-tabs-control.php';
require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-radio-control.php';


}

/**
 * Class Theme_Customizer
 * 
 * Handles all customizer settings using modular traits.
 */
class Theme_Customizer {

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
        $this->add_header_section( $wp_customize );
        $this->add_frontpage_panel( $wp_customize );
        $this->add_theme_basic_options_panel( $wp_customize );
    }

    /**
     * Output custom styles from customizer settings into the head.
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
        $padding_top_bottom = get_theme_mod( 'arnabwp_button_padding_top_bottom', 10 ); // fallback 10px if not set
        $padding_left_right = get_theme_mod( 'arnabwp_button_padding_left_right', 15 ); // fallback 15px if not set
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
                /* Preloader Customization */
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
        echo ".entry-title, .post-card-content .post-title, .post-title { font-size: {$content_title_font_size}px;}";
   

                // === Color Styles Refactored into a Loop === //
                $color_settings = [
                    'primary_color'          => '--primary-color',
                    'secondary_color'        => '--secondary-color',
                    'custom_background_color'=> '--background-color',
                    'text_color'             => '--text-color',
                    'heading_color'          => '--heading-color',
                    'link_color'             => '--link-color',
                    'nav_bg_color'             => '--nav-bg-color',
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
            'nav_bg_color'             => get_theme_mod( 'nav_bg_color' ),
            'menu_color'           => get_theme_mod( 'menu_color' ),
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
        if ( $colors['nav_bg_color'] ) {
            echo "header.site-header { background-color: {$colors['nav_bg_color']}; }";
        }
        if ( $colors['menu_color'] ) {
            echo ":root { --menu-color: {$colors['menu_color']}; }";
        }
        if ( $colors['button_text_color'] ) {
            echo "button, .btn { color: {$colors['button_text_color']}; }";
        }

        // === Header Styles === //
        $layout     = get_theme_mod( 'arnabwp_header_layout', 'logo-left' );
        $sticky     = get_theme_mod( 'arnabwp_sticky_header', false );
        $font       = get_theme_mod( 'arnabwp_menu_font_size', 16 );

        
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
$hero_title_fontsize= get_theme_mod('arnabwp_hero_title_font_size', 40);
$hero_subtitle_fontsize= get_theme_mod('arnabwp_hero_subtitle_font_size', 16);

$hero_title_color= get_theme_mod('arnabwp_hero_title_color', '#ffffff');
$hero_subtitle_color= get_theme_mod('arnabwp_hero_subtitle_color', '#ffffff');


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
      
    </style>';

}
}

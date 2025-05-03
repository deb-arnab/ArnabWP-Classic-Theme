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

if (is_customize_preview() || is_admin()) {

    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-toggle-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-range-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-repeater-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-tabs-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-radio-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/classes/controls/class-responsive-range-control.php';
}

/**
 * Class Theme_Customizer
 * 
 * Handles all customizer settings using modular traits.
 */
class Theme_Customizer
{

    use Singleton;
    use Footer_Options;
    use Header_Options;
    use Frontpage_Options;
    use Basic_Options;


    /**
     * Constructor. Registers hooks.
     */
    protected function __construct()
    {
        $this->setup_hooks();
    }

    /**
     * Register necessary action hooks.
     */
    protected function setup_hooks()
    {
        add_action('customize_register', [$this, 'arnabwp_register_customizer_settings']);
        add_action('wp_head', [$this, 'arnabwp_output_customizer_styles']);

        // Add body class for header layout
        add_filter('body_class', function ($classes) {
            $layout = get_theme_mod('arnabwp_header_layout', 'logo-left');
            $classes[] = 'header-layout-' . sanitize_html_class($layout);
            return $classes;
        });
    }

    /**
     * Register customizer settings.
     *
     * @param \WP_Customize_Manager $wp_customize Customizer object.
     */
    public function arnabwp_register_customizer_settings($wp_customize)
    {
        $this->add_footer_section($wp_customize);
        $this->add_header_section($wp_customize);
        $this->add_frontpage_panel($wp_customize);
        $this->add_theme_basic_options_panel($wp_customize);
    }

    /**
     * Output custom styles from customizer settings into the head.
     */
    public function arnabwp_output_customizer_styles()
    {

        echo "<!-- Customizer Styles Output Start -->";

        // === Site Width Styles === //
        $container_width = get_theme_mod('arnabwp_container_width', 1200);

        echo '<style type="text/css">';
        echo '.site-container {
            max-width: ' . absint($container_width) . 'px;
            margin: 0 auto;
            padding-left: 15px;
            padding-right: 15px;
        }';



        // === Button Styles === //
        $padding_top_bottom = get_theme_mod('arnabwp_button_padding_top_bottom', 10); // fallback 10px if not set
        $padding_left_right = get_theme_mod('arnabwp_button_padding_left_right', 15); // fallback 15px if not set
        $button_radius      = get_theme_mod('arnabwp_button_radius', 5);

        // Ensure values are integers
        $padding_top_bottom = absint($padding_top_bottom);
        $padding_left_right = absint($padding_left_right);
        $button_radius      = absint($button_radius);

        // Only output if values exist
        if ($padding_top_bottom || $padding_left_right) :

            echo '<style type="text/css">';
            echo '
            :root {
                --arnabwp-button-padding-top-bottom: <?php echo esc_attr( $padding_top_bottom ); ?>px;
                --arnabwp-button-padding-left-right: <?php echo esc_attr( $padding_left_right ); ?>px;
                --arnabwp-button-radius: <?php echo esc_attr( $button_radius ); ?>px;
            }';
            echo '</style>';
        endif;

        // === Preloader Styles === //
        $preloader_bg_color = get_theme_mod('preloader_background_color', '#ffffff');
        $preloader_spinner_color = get_theme_mod('preloader_spinner_color', '#007bff');

        echo '<style type="text/css">';
        echo "
                
                #preloader {
                    background-color: <?php echo esc_attr($preloader_bg_color); ?>;
                }";
        echo "
                #preloader .preloader-spinner {
                    border-top-color: <?php echo esc_attr($preloader_spinner_color); ?>;
                }";
        echo '</style>';



        // === Color Styles Refactored into a Loop === //
        $color_settings = [
            'primary_color'          => '--primary-color',
            'secondary_color'        => '--secondary-color',
            'custom_background_color' => '--background-color',
            'text_color'             => '--text-color',
            'heading_color'          => '--heading-color',
            'link_color'             => '--link-color',
            'nav_bg_color'             => '--nav-bg-color',
            'button_color'           => '--button-color',
            'button_text_color'      => '--button-text-color',
        ];

        foreach ($color_settings as $setting => $css_var) {
            $color = get_theme_mod($setting);
            if ($color) {
                echo '<style type="text/css">';
                echo ":root { {$css_var}: {$color}; }";
                echo '</style>';
            }
        }

        $colors = [
            'primary_color'          => get_theme_mod('primary_color'),
            'secondary_color'        => get_theme_mod('secondary_color'),
            'custom_background_color' => get_theme_mod('custom_background_color'),
            'text_color'             => get_theme_mod('text_color'),
            'heading_color'          => get_theme_mod('heading_color'),
            'link_color'             => get_theme_mod('link_color'),
            'nav_bg_color'             => get_theme_mod('nav_bg_color'),
            'menu_color'           => get_theme_mod('menu_color'),
            'button_text_color'      => get_theme_mod('button_text_color'),
        ];
        echo '<style type="text/css">';
        if ($colors['primary_color']) {
            echo ":root { --primary-color: {$colors['primary_color']}; }";
        }
        if ($colors['secondary_color']) {
            echo ":root { --secondary-color: {$colors['secondary_color']}; }";
        }
        if ($colors['custom_background_color']) {
            echo "body { background-color: {$colors['custom_background_color']}; }";
        }
        if ($colors['text_color']) {
            echo "body, p, span, li, .text { color: {$colors['text_color']}; }";
        }
        if ($colors['heading_color']) {
            echo "h1, h2, h3, h4, h5, h6 { color: {$colors['heading_color']}; }";
        }
        if ($colors['link_color']) {
            echo "a { color: {$colors['link_color']}; }";
        }
        if ($colors['nav_bg_color']) {
            echo "header.site-header { background-color: {$colors['nav_bg_color']}; }";
        }

        if ($colors['menu_color']) {
            echo ":root { --menu-color: {$colors['menu_color']}; }";
        }
        if ($colors['button_text_color']) {
            echo "button, .btn { color: {$colors['button_text_color']}; }";
        }
        echo '</style>';


        // === Header Styles === //
        $layout     = get_theme_mod('arnabwp_header_layout', 'logo-left');
        $sticky     = get_theme_mod('arnabwp_sticky_header', false);
        $font       = get_theme_mod('arnabwp_menu_font_size', 16);

        echo '<style type="text/css">';
        if ($font) {
            echo "header.site-header .navbar-nav a { font-size: {$font}px; }";
        }
        if ($sticky) {
            echo "header.site-header { position: sticky; top: 0; z-index: 999; }";
        }
        echo '</style>';

        // === Layout-Specific Header Styles === //
        echo '<style type="text/css">';
        if ($layout === 'logo-center') {

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

        if ($layout === 'logo-right') {
            echo '<style type="text/css">';
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
        $bc_font_size  = get_theme_mod('arnabwp_breadcrumb_font_size', 14);
        $bc_font_color = get_theme_mod('arnabwp_breadcrumb_color', '#666666');

        echo '<style type="text/css">
	.arnabwp-breadcrumb {
		font-size: ' . intval($bc_font_size) . 'px;
		color: ' . esc_attr($bc_font_color) . ';
	}
	.arnabwp-breadcrumb a {
		color: ' . esc_attr($bc_font_color) . ';
		text-decoration: none;
	}
	
</style>';

        // === Footer Styles === //

        $footer_text_color = get_theme_mod('arnabwp_footer_widget_text_color', '#bbbbbb');
        $footer_copyright_color = get_theme_mod('arnabwp_footer_copyright_text_color', '#999999');

        if ($footer_text_color || $footer_copyright_color)

            echo '
    <style type="text/css">
        .site-footer .footer-widget ul li,
        .site-footer .footer-widget p
        {
            color: ' . esc_attr($footer_text_color) . '!important;
        }

        .site-footer .footer-copy {
            color:' . esc_attr($footer_copyright_color) . ';
        }
    </style>';


        // === Hero Section Styles === //

        $hero_title_color = get_theme_mod('arnabwp_hero_title_color', '#ffffff');
        $hero_subtitle_color = get_theme_mod('arnabwp_hero_subtitle_color', '#ffffff');


        if ($hero_title_color || $hero_subtitle_color)

            echo '
    <style type="text/css">
        .hero-content h1
        {
            color: ' . esc_attr($hero_title_color) . ';

        }

         .hero-content p
        {
            color: ' . esc_attr($hero_subtitle_color) . ';

        }
      
    </style>';


        // === Typography Styles === //
        $body_font      = get_theme_mod('arnabwp_body_font_family', 'Arial, sans-serif');
        $heading_font   = get_theme_mod('arnabwp_heading_font_family', 'Georgia, serif');

        echo '<style type="text/css">';
        echo "body { font-family: {$body_font}; }";
        echo "h1, h2, h3, h4, h5, h6 { font-family: {$heading_font}; }";

        echo '</style>';


        /**
         * Typography Font Size Output for Customizer Settings using Font_Output helper
         *
         * @param string $selector CSS selector.
         * @param string $setting  Customizer setting ID.
         * @param int    $default  Default font size in px.
         */

        /**
         * Body font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('body', 'arnabwp_body_font_size', 16);

        /**
         * Heading tags (h1–h6) font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('h1, h2, h3, h4, h5, h6', 'arnabwp_heading_font_size', 36);

        /**
         * Post and entry title font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.entry-title, .post-card-content .post-title, .post-title', 'arnabwp_content_title_font_size', 28);

        /**
         * Frontpage Section title font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.section-title', 'arnabwp_section_title_font_size', 32);

        /**
         * Frontpage Section description font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.section-description', 'arnabwp_section_description_font_size', 16);

        /**
         * Hero section title font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.hero-title', 'arnabwp_hero_title_font_size', 46);

        /**
         * Hero section subtitle font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.hero-subtitle', 'arnabwp_hero_subtitle_font_size', 16);

        /**
         * Employee name font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.employee-name', 'arnabwp_employee_name_font_size', 20);

        /**
         * Employee description font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.employee-description', 'arnabwp_employee_description_font_size', 16);

        /**
         * Employee email font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.employee-email', 'arnabwp_employee_email_font_size', 14);

        /**
         * Employee social icon font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.employee-social-icon', 'arnabwp_employee_social_icon_font_size', 18);

        /**
         * Testimonial social icon font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.testimonial-social-icon', 'arnabwp_testimonial_social_icon_font_size', 18);

        /**
         * Testimonial client name font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.testimonial-client-name', 'arnabwp_testimonial_name_font_size', 20);

        /**
         * Testimonial client title/job font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.testimonial-client-title', 'arnabwp_testimonial_job_font_size', 16);

        /**
         * Testimonial comment font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.testimonial-comment', 'arnabwp_testimonial_comment_font_size', 16);

        /**
         * Service name/title font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.service-name', 'arnabwp_service_name_font_size', 20);

        /**
         * Service description font size
         */
        \ARNABWP_THEME\Inc\Helpers\Font_Output::render('.service-description', 'arnabwp_service_description_font_size', 16);


        echo "<!-- Customizer Styles Output End -->";
    }
}

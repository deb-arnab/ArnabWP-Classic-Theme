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

new \ARNABWP_THEME\Inc\Helpers\Customizer_Shortcut();


// Load necessary customizer controls when previewing or in admin mode.
if (is_customize_preview() || is_admin()) {
    require_once ARNABWP_DIR_PATH . '/inc/customizer/controls/class-toggle-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/customizer/controls/class-range-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/customizer/controls/class-repeater-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/customizer/controls/class-tabs-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/customizer/controls/class-radio-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/customizer/controls/class-responsive-range-control.php';
    require_once ARNABWP_DIR_PATH . '/inc/helpers/class-customizer-shortcut.php';
}

/**
 * Class Theme_Customizer
 * 
 * Handles all customizer settings using modular traits.
 *
 * This class uses multiple traits to organize the theme customizer settings into sections like footer, header, frontpage, and basic options.
 * It registers necessary hooks and outputs custom styles in the head based on customizer settings.
 */
class Theme_Customizer
{
    // Traits for modular customization options.
    use Singleton;
    use Footer_Options;
    use Header_Options;
    use Frontpage_Options;
    use Basic_Options;


    /**
     * Constructor. Registers hooks.
     * 
     * This method calls `setup_hooks()` to initialize the action hooks needed for the customizer and styles.
     */
    protected function __construct()
    {
        $this->setup_hooks();
    }

    /**
     * Register necessary action hooks.
     * 
     * This method registers hooks for:
     * 1. Registering customizer settings (`arnabwp_register_customizer_settings`).
     * 2. Outputting customizer styles in the head (`arnabwp_output_customizer_styles`).
     * 3. Adding a body class for header layout based on the selected layout in the customizer.
     */
    protected function setup_hooks()
    {
        // Register the customizer settings and output styles.
        add_action('customize_register', [$this, 'arnabwp_register_customizer_settings']);
        add_action('wp_head', [$this, 'arnabwp_output_customizer_styles']);

        // Add body class for header layout based on user selection.
        add_filter('body_class', function ($classes) {
            $layout = get_theme_mod('arnabwp_header_layout', 'logo-left');
            $classes[] = 'header-layout-' . sanitize_html_class($layout);
            return $classes;
        });
    }

    /**
     * Register customizer settings.
     * 
     * This method registers all sections and panels related to footer, header, frontpage, and theme basic options.
     *
     * @param \WP_Customize_Manager $wp_customize Customizer object to register settings.
     */
    public function arnabwp_register_customizer_settings($wp_customize)
    {
        // Add sections for footer, header, frontpage, and theme basic options.
        $this->add_footer_section($wp_customize);
        $this->add_header_section($wp_customize);
        $this->add_frontpage_panel($wp_customize);
        $this->add_theme_basic_options_panel($wp_customize);
    }

    /**
     * Output custom styles from customizer settings into the head.
     * 
     * This method outputs custom CSS styles directly into the head section of the page based on the customizer settings.
     * It includes styles for layout, font family, colors, font sizes, and buttons.
     */
    public function arnabwp_output_customizer_styles()
    {
        echo "<!-- Customizer Styles Output Start -->";

        // Output site container width based on customizer setting.
        \ARNABWP_THEME\Inc\Helpers\Layout_Output::arnabwp_output_site_layout_rules(
            '.site-container',
            ['max-width'],
            'arnabwp_container_width',
            1200,
            'px'
        );

        // Output header layout styles based on the customizer settings.
        \ARNABWP_THEME\Inc\Helpers\Layout_Output::arnabwp_output_header_layout_rules();

        // Output header Sticky styles based on the customizer settings.
        \ARNABWP_THEME\Inc\Helpers\Layout_Output::arnabwp_output_header_sticky_rules();

        // Output font family styles based on customizer settings.
        \ARNABWP_THEME\Inc\Helpers\Font_Output::arnabwp_output_font_family([ 
            ['body', 'font-family', 'arnabwp_body_font_family', 'Arial, sans-serif'],
            ['h1, h2, h3, h4, h5, h6', 'font-family', 'arnabwp_heading_font_family', 'Georgia, serif' ],
        ]);

        // Output root color styles (primary, secondary, background, text, etc.).
        \ARNABWP_THEME\Inc\Helpers\Color_Output::arnabwp_output_root_colors([
            ['--primary-color', 'primary_color', '#e83582'],
            ['--secondary-color', 'secondary_color', '#187dbc'],
            ['--background-color', 'custom_background_color', '#f4f4f4'],
            ['--text-color', 'text_color', '#000000'],
            ['--heading-color', 'heading_color', '#000000'],
            ['--link-color', 'link_color', '#0c0cdd'],
            ['--nav-bg-color', 'nav_bg_color', '#000000'],
            ['--menu-color', 'menu_color', '#f4f4f4'],
            ['--button-text-color', 'button_text_color', '#ffffff'],
        ]);

        // Output color styles for specific elements (e.g., body, header, footer, etc.).
        \ARNABWP_THEME\Inc\Helpers\Color_Output::arnabwp_output_color_rules([
            ['body', 'background-color', 'custom_background_color', '#f4f4f4'],
            ['body, p, span, li, .text', 'color', 'text_color', '#000000'],
            ['h1, h2, h3, h4, h5, h6', 'color', 'heading_color', '#000000'],
            ['a', 'color', 'link_color', '#0c0cdd'],
            ['header.site-header', 'background-color', 'nav_bg_color', '#000000'],
            ['button, .btn', 'color', 'button_text_color', '#ffffff'],
            ['.hero-content h1', 'color', 'arnabwp_hero_title_color', '#fffffff'],
            ['.hero-content p', 'color', 'arnabwp_hero_subtitle_color', '#ffffff'],
            ['.site-footer .footer-widget ul li, .site-footer .footer-widget p', 'color', 'arnabwp_footer_widget_text_color', '#bbbbbb'],
            ['.site-footer .footer-copy', 'color', 'arnabwp_footer_copyright_text_color', '#999999'],
            ['.site-footer', 'background-color', 'arnabwp_footer_bg_color', '#f8f9fa'],
            ['.arnabwp-breadcrumb, .arnabwp-breadcrumb a', 'color', 'arnabwp_breadcrumb_color', '#666666'],
            ['#preloader', 'background-color', 'arnabwp_preloader_background_color', '#ffffff'],
            ['#preloader .preloader-spinner', 'border-top-color', 'arnabwp_preloader_spinner_color', '#187dbc'],
            ['.testimonial-client-name', 'color', 'arnabwp_testimonial_name_color', '#187dbc'],
            ['.testimonial-client-title', 'color', 'arnabwp_testimonial_job_color', '#555555'],
            ['.testimonial-comment', 'color', 'arnabwp_testimonial_comment_color', '#ccc'],
            ['.testimonial-social-icon a', 'color', 'testimonial_social_icon_color', '#e83582'],
            ['.service-name', 'color', 'arnabwp_service_name_color', '#187dbc'],
            ['.service-description', 'color', 'arnabwp_service_description_color', '#555555'],
            ['.employee-name', 'color', 'arnabwp_employee_name_color', '#187dbc'],
            ['.employee-description', 'color', 'arnabwp_employee_description_color', '#555555'],
            ['.employee-email', 'color', 'arnabwp_employee_email_color', '#e83582'],
            ['.employee-social-icon a', 'color', 'arnabwp_employee_social_icon_color', '#e83582'],
        ]);

        // Output font size styles for different elements based on customizer settings.
        $font_sizes = [
            ['body', 'arnabwp_body_font_size', 16],
            ['h1, h2, h3, h4, h5, h6', 'arnabwp_heading_font_size', 36],
            ['.entry-title, .post-card-content .post-title, .post-title', 'arnabwp_content_title_font_size', 28],
            ['.section-title', 'arnabwp_section_title_font_size', 32],
            ['.section-description', 'arnabwp_section_description_font_size', 16],
            ['.hero-title', 'arnabwp_hero_title_font_size', 46],
            ['.hero-subtitle', 'arnabwp_hero_subtitle_font_size', 16],
            ['.employee-name', 'arnabwp_employee_name_font_size', 20],
            ['.employee-description', 'arnabwp_employee_description_font_size', 16],
            ['.employee-email', 'arnabwp_employee_email_font_size', 14],
            ['.employee-social-icon', 'arnabwp_employee_social_icon_font_size', 18],
            ['.testimonial-social-icon', 'arnabwp_testimonial_social_icon_font_size', 18],
            ['.testimonial-client-name', 'arnabwp_testimonial_name_font_size', 20],
            ['.testimonial-client-title', 'arnabwp_testimonial_job_font_size', 16],
            ['.testimonial-comment', 'arnabwp_testimonial_comment_font_size', 16],
            ['.service-name', 'arnabwp_service_name_font_size', 20],
            ['.service-description', 'arnabwp_service_description_font_size', 16],
            ['.arnabwp-breadcrumb', 'arnabwp_breadcrumb_font_size', 14],
            ['.navbar-nav a', 'arnabwp_menu_font_size', 14],
        ];

        // Loop through the font sizes and output responsive and default sizes.
        foreach ($font_sizes as [$selector, $mod_name, $default_size]) {
            \ARNABWP_THEME\Inc\Helpers\Font_Output::arnabwp_output_responsive_size($selector, $mod_name, $default_size);
            \ARNABWP_THEME\Inc\Helpers\Font_Output::arnabwp_output_default_size($selector, $mod_name, $default_size);
        }

        // Output button styles based on customizer settings.
        \ARNABWP_THEME\Inc\Helpers\Button_Output::arnabwp_output_root_buttons([
            ['arnabwp_button_padding_top_bottom', 'arnabwp-button-padding-top-bottom', 10, 'px'],
            ['arnabwp_button_padding_left_right', 'arnabwp-button-padding-left-right', 15, 'px'],
            ['arnabwp_button_radius', 'arnabwp-button-radius', 5, 'px'],
        ]);



   
        echo "<!-- Customizer Styles Output End -->";
    }
}

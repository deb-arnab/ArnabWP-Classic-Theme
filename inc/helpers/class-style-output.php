<?php
/**
 * Style Output Helper for ArnabWP Theme
 *
 * @package ArnabWP
 */

namespace ARNABWP_THEME\Inc\Helpers;

class Arnabwp_Style_Output {

	/**
	 * Render CSS variable under :root.
	 */
	public static function render_root_var( $var_name, $setting_name, $default = '' ) {
		$value = get_theme_mod( $setting_name, $default );
		if ( $value ) {
			echo "<style>:root { {$var_name}: {$value}; }</style>";
		}
	}

	/**
	 * Render a single CSS rule.
	 */
	public static function render_css( $selector, $property, $setting_name, $default = '' ) {
		$value = get_theme_mod( $setting_name, $default );
		if ( $value ) {
			echo "<style>{$selector} { {$property}: {$value}; }</style>";
		}
	}

	/**
	 * Render multiple CSS rules for a selector.
	 */
	public static function render_multiple( $selector, $rules = [] ) {
		$style = '';
		foreach ( $rules as $property => $value ) {
			if ( ! empty( $value ) ) {
				$style .= "{$property}: {$value}; ";
			}
		}
		if ( $style ) {
			echo "<style>{$selector} { {$style} }</style>";
		}
	}

	// Layout Styles
	public static function arnabwp_layout() {
		$container_width = get_theme_mod( 'arnabwp_container_width', 1200 );
		self::render_multiple( '.arnabwp-site-container', [
			'max-width'     => absint( $container_width ) . 'px',
			'margin'        => '0 auto',
			'padding-left'  => '15px',
			'padding-right' => '15px',
		]);
	}

	// Button Styles
	public static function arnabwp_buttons() {
		self::render_root_var( '--arnabwp-button-padding-top-bottom', 'arnabwp_button_padding_top_bottom', 10 );
		self::render_root_var( '--arnabwp-button-padding-left-right', 'arnabwp_button_padding_left_right', 15 );
		self::render_root_var( '--arnabwp-button-radius', 'arnabwp_button_radius', 5 );
		self::render_css( 'button, .btn, .arnabwp-button', 'color', 'button_text_color' );
	}

	// Color Variables
	public static function arnabwp_colors() {
		$vars = [
			'--arnabwp-primary-color'       => 'primary_color',
			'--arnabwp-secondary-color'     => 'secondary_color',
			'--arnabwp-background-color'    => 'custom_background_color',
			'--arnabwp-text-color'          => 'text_color',
			'--arnabwp-heading-color'       => 'heading_color',
			'--arnabwp-link-color'          => 'link_color',
			'--arnabwp-nav-bg-color'        => 'nav_bg_color',
			'--arnabwp-menu-color'          => 'menu_color',
			'--arnabwp-button-text-color'   => 'button_text_color',
		];
		foreach ( $vars as $var => $setting ) {
			self::render_root_var( $var, $setting );
		}

		self::render_css( 'body', 'background-color', 'custom_background_color' );
		self::render_css( 'body, p, span, li, .text', 'color', 'text_color' );
		self::render_css( 'h1, h2, h3, h4, h5, h6', 'color', 'heading_color' );
		self::render_css( 'a', 'color', 'link_color' );
		self::render_css( 'header.arnabwp-site-header', 'background-color', 'nav_bg_color' );
	}

	// Typography
	public static function arnabwp_typography() {
		self::render_css( 'body', 'font-family', 'arnabwp_body_font_family', 'Arial, sans-serif' );
		self::render_multiple( 'h1, h2, h3, h4, h5, h6', [
			'font-family' => get_theme_mod( 'arnabwp_heading_font_family', 'Georgia, serif' ),
			'font-size'   => get_theme_mod( 'arnabwp_heading_font_size', 32 ) . 'px',
		]);
	}

	// Hero Section
	public static function arnabwp_hero() {
		self::render_multiple( '.arnabwp-hero-content h1', [
			'color'     => get_theme_mod( 'arnabwp_hero_title_color', '#ffffff' ),
			'font-size' => get_theme_mod( 'arnabwp_hero_title_font_size', 40 ) . 'px',
		]);
		self::render_multiple( '.arnabwp-hero-content p', [
			'color'     => get_theme_mod( 'arnabwp_hero_subtitle_color', '#ffffff' ),
			'font-size' => get_theme_mod( 'arnabwp_hero_subtitle_font_size', 16 ) . 'px',
		]);
	}

	// Header
	public static function arnabwp_header() {
		self::render_css( 'header.arnabwp-site-header .navbar-nav a', 'font-size', 'arnabwp_menu_font_size', 16 );

		if ( get_theme_mod( 'arnabwp_sticky_header', false ) ) {
			echo '<style>header.arnabwp-site-header { position: sticky; top: 0; z-index: 999; }</style>';
		}

		$layout = get_theme_mod( 'arnabwp_header_layout', 'logo-left' );

		if ( $layout === 'logo-center' ) {
			echo '<style>
				.header-layout-logo-center header.arnabwp-site-header .navbar .container {
					flex-direction: column;
					align-items: center;
				}
				.header-layout-logo-center header.arnabwp-site-header .navbar-brand {
					margin-bottom: 1rem;
					text-align: center;
				}
				.header-layout-logo-center header.arnabwp-site-header .navbar-collapse {
					justify-content: center !important;
					text-align: center;
				}
				.header-layout-logo-center header.arnabwp-site-header .navbar-nav {
					flex-direction: row;
					gap: 1.5rem;
					justify-content: center;
				}
				@media (max-width: 991px) {
					.header-layout-logo-center header.arnabwp-site-header .navbar-nav {
						flex-direction: column;
					}
				}
			</style>';
		}

		if ( $layout === 'logo-right' ) {
			echo '<style>
				.header-layout-logo-right .arnabwp-site-header .navbar .container {
					display: flex;
					align-items: center;
					justify-content: space-between;
				}
				.header-layout-logo-right .arnabwp-site-header .navbar-collapse {
					order: 1;
					flex: 1;
				}
				.header-layout-logo-right .arnabwp-site-header .navbar-nav {
					display: flex;
					justify-content: flex-start;
					margin-left: 0 !important;
					margin-right: auto !important;
				}
				.header-layout-logo-right .arnabwp-site-header .navbar-brand {
					order: 2;
					margin-left: auto;
				}
			</style>';
		}
	}

	// Footer
	public static function arnabwp_footer() {
		self::render_multiple( '.arnabwp-site-footer .footer-widget ul li, .arnabwp-site-footer .footer-widget p', [
			'color' => get_theme_mod( 'arnabwp_footer_widget_text_color', '#bbbbbb' ),
		] );

		self::render_css( '.arnabwp-site-footer .footer-copy', 'color', 'arnabwp_footer_copyright_text_color', '#999999' );
	}

	// Breadcrumb
	public static function arnabwp_breadcrumb() {
		self::render_multiple( '.arnabwp-breadcrumb', [
			'font-size' => get_theme_mod( 'arnabwp_breadcrumb_font_size', 14 ) . 'px',
			'color'     => get_theme_mod( 'arnabwp_breadcrumb_color', '#666666' ),
		] );
		self::render_css( '.arnabwp-breadcrumb a', 'color', 'arnabwp_breadcrumb_color', '#666666' );
	}

	// Preloader
	public static function arnabwp_preloader() {
		self::render_css( '#arnabwp-preloader', 'background-color', 'preloader_background_color', '#ffffff' );
		self::render_css( '#arnabwp-preloader .preloader-spinner', 'border-top-color', 'preloader_spinner_color', '#007bff' );
	}
}
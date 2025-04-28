<?php
/**
 * Header Template
 *
 * This file is loaded on every page of the site and contains the opening HTML,
 * <head> section, navigation bar, and optional breadcrumbs.
 *
 * @package ArnabWP
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Site Author -->
    <meta name="author" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">

    <!-- SEO Meta Tags (Fallback - override with SEO plugin like Yoast if active) -->
    <?php if ( ! defined( 'WPSEO_VERSION' ) ) : ?>
        <meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
        <meta property="og:title" content="<?php echo esc_attr( wp_get_document_title() ); ?>">
        <meta property="og:description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
        <meta property="og:url" content="<?php echo esc_url( home_url( add_query_arg( null, null ) ) ); ?>">
        <meta property="og:site_name" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
        <meta property="og:type" content="website">
        <?php if ( has_post_thumbnail() && is_single() ) :
            $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
            if ( ! empty( $thumb[0] ) ) : ?>
                <meta property="og:image" content="<?php echo esc_url( $thumb[0] ); ?>">
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Site Icon -->
    <?php if ( has_site_icon() ) : ?>
        <link rel="icon" href="<?php echo esc_url( get_site_icon_url() ); ?>" sizes="32x32" />
    <?php endif; ?>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <!-- Preloader -->
  <?php 
    $section_enabled = get_theme_mod('arnabwp_preloader_enable', true);
    if ($section_enabled) {
        // Show preloader when enabled
        ?>
        <div id="preloader" class="preloader">
            <div class="preloader-inner">
                <div class="preloader-spinner"></div>
            </div>
        </div>
        <?php
    }
?>
<?php
// Fires the wp_body_open hook (for compatibility with modern themes and third-party tools)
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<div id="page" class="site">

    <header id="header_area" class="site-header" role="banner">
       
        <?php 
        // Load the topbar template part if enabled in Customizer
        if ( get_theme_mod( 'arnabwp_show_topbar', true ) ) {
            get_template_part( 'template_parts/header/topbar' );
        }

        // Load the main navigation menu template part
        get_template_part( 'template_parts/header/nav' ); 
        ?>
    
    </header>

    <div id="content" class="site-content">

        <?php if ( get_theme_mod( 'arnabwp_enable_breadcrumbs', true ) ) : ?>
            <nav aria-label="Breadcrumb" class="site-breadcrumb">
                <?php
                $breadcrumbs = \ARNABWP_THEME\Inc\Breadcrumbs::get_instance();
                $breadcrumbs->arnabwp_breadcrumb();
                ?>
            </nav>
        <?php endif; ?>
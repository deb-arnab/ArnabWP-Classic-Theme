<?php
/**
 * Template Part: Header Navigation
 *
 * Main navigation bar using Bootstrap 5.
 * Handles logo, menu toggle, and dynamic menu with custom walker.
 *
 * @package ArnabWP
 */

use ARNABWP_THEME\Inc\MENUS;

// Instantiate the Menus class to retrieve the custom walker.
$menu_class = Menus::get_instance();
$walker     = $menu_class->arnabwp_get_navwalker();
?>

<!-- Skip Link for Accessibility -->
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'arnabwp' ); ?></a>

<nav class="navbar navbar-expand-lg navbar-dark" role="navigation" aria-label="<?php esc_attr_e( 'Main Navigation', 'arnabwp' ); ?>">
    <div class="container">

        <!-- Site Logo / Site Name -->
        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php 
            if ( has_custom_logo() ) {
                // Output custom logo with lazy loading for performance.
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo_image = wp_get_attachment_image(
                    $custom_logo_id,
                    'medium',
                    false,
                    array(
                        'class' => 'custom-logo',
                        'alt'   => get_bloginfo( 'name' ), // Alt fallback
                        'loading' => 'lazy', // Lazy loading
                    )
                );
                echo $logo_image;
            } else {
                echo esc_html( get_bloginfo( 'name' ) ); // Fallback to site title
            }
            ?>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
            aria-controls="mainNav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'arnabwp' ); ?>">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Primary Menu -->
        <div class="collapse navbar-collapse justify-content-end" id="mainNav">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'arnabwp_primary_menu', // Registered menu location
                'container'      => false,                  // No extra container
                'menu_class'     => 'navbar-nav mb-2 mb-lg-0', // Bootstrap classes
                'depth'          => 3,                      // Supports dropdowns
                'fallback_cb'    => '__return_false',       // No fallback output
                'walker'         => $walker,                // Custom walker class for Bootstrap markup
            ) );
            ?>
        </div>

    </div>
</nav>
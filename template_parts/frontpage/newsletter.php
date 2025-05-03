<?php
/**
 * Template Part: Newsletter Section
 *
 * @package ArnabWP
 */



// Background customization with proper escaping
$bg_type   = esc_attr(get_theme_mod('newsletter_section_bg_type', 'none'));
$bg_color  = esc_attr(get_theme_mod('newsletter_section_bg_color', '#ffffff'));
$bg_image  = esc_url(get_theme_mod('newsletter_section_bg_image', ''));
$bg_scroll = (bool) get_theme_mod('newsletter_section_bg_scroll', true);

$bg_style = '';

if ($bg_type === 'color') {
    $bg_style = 'style="background-color: ' . esc_attr($bg_color) . ';"';
} elseif ($bg_type === 'image' && !empty($bg_image)) {
    $bg_style = 'style="background-image: url(' . esc_url($bg_image) . '); background-attachment: ' . ($bg_scroll ? 'fixed' : 'scroll') . '; background-size: cover; background-position: center;"';
}



if ( get_theme_mod( 'show_newsletter_section', true ) ) :
?>
    <section id="newsletter" class="py-5 text-center" aria-labelledby="newsletter-section-heading" <?php echo $bg_style; ?>>
    <div class="site-container">
            <div class="row justify-content-center">
                <div class="col-lg-8">

                    <?php if ( get_theme_mod( 'newsletter_title' ) || get_theme_mod( 'newsletter_description' ) ) : ?>
                        <header class="mb-4">
                            <?php if ( get_theme_mod( 'newsletter_title' ) ) : ?>
                                <h2 id="newsletter-section-heading" class="section-title mb-3 fw-bold">
                                    <?php echo esc_html( get_theme_mod( 'newsletter_title', __( 'Subscribe to Our Newsletter', 'arnabwp' ) ) ); ?>
                                </h2>
                            <?php endif; ?>

                            <?php if ( get_theme_mod( 'newsletter_description' ) ) : ?>
                                <p class="section-description text-muted mb-0">
                                    <?php echo esc_html( get_theme_mod( 'newsletter_description', __( 'Get the latest updates and offers.', 'arnabwp' ) ) ); ?>
                                </p>
                            <?php endif; ?>
                        </header>
                    <?php endif; ?>

                    <?php
                    // Get the newsletter shortcode from the Customizer
                    $newsletter_shortcode = get_theme_mod( 'newsletter_shortcode', '[arnabwp_newsletter_form]' );

                    if ( ! empty( $newsletter_shortcode ) ) {
                        echo do_shortcode( $newsletter_shortcode );
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
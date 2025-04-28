<?php

/**
 * Client Section Template
 *
 * Shows a modern Owl Carousel of client logos with hover names and external links.
 * 
 * @package ArnabWP
 */

// Check if the section is enabled
$section_enabled = get_theme_mod('arnabwp_client_section_enable', true);
if (! $section_enabled) {
    return;
}

// Background customization with proper escaping
$bg_type   = esc_attr(get_theme_mod('client_section_bg_type', 'none'));
$bg_color  = esc_attr(get_theme_mod('client_section_bg_color', '#ffffff'));
$bg_image  = esc_url(get_theme_mod('client_section_bg_image', ''));
$bg_scroll = (bool) get_theme_mod('client_section_bg_scroll', true);

$bg_style = '';

if ($bg_type === 'color') {
    $bg_style = 'style="background-color: ' . esc_attr($bg_color) . ';"';
} elseif ($bg_type === 'image' && !empty($bg_image)) {
    $bg_style = 'style="background-image: url(' . esc_url($bg_image) . '); background-attachment: ' . ($bg_scroll ? 'fixed' : 'scroll') . '; background-size: cover; background-position: center;"';
}

$clients = new WP_Query([
    'post_type' => 'client',
    'posts_per_page' => -1,
    'no_found_rows'  => true, // Performance optimization for non-paginated queries
]);

if ($clients->have_posts()) : ?>
    <section class="client-section py-5" role="region" aria-label="<?php esc_attr_e('Our Clients', 'arnabwp'); ?>" <?php echo $bg_style; ?>>
        <div class="container">
            <div class="owl-carousel owl-theme client-carousel" role="region" aria-label="Clients Carousel">
                <?php
                // Start client loop
                while ($clients->have_posts()) :
                    $clients->the_post();

                    $client_name = get_post_meta(get_the_ID(), '_client_name', true);
                    $client_website = get_post_meta(get_the_ID(), '_client_website', true);
                    $logo = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                    if (!$logo) continue;

                    // Setup alt text
                    $alt_text = $client_name ? $client_name : __('Client Logo', 'arnabwp');

                    // Set width and height for lazy loading optimization (optional: adjust sizes if needed)
                    $image_attributes = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                    $img_width  = !empty($image_attributes[1]) ? $image_attributes[1] : '300';
                    $img_height = !empty($image_attributes[2]) ? $image_attributes[2] : '150';

                ?>
                    <div class="item">
                        <a href="<?php echo esc_url($client_website ? $client_website : '#'); ?>"
                            target="_blank"
                            rel="nofollow noopener"
                            aria-label="<?php echo esc_attr(sprintf(__('Visit %s website', 'arnabwp'), $client_name ? $client_name : __('Client', 'arnabwp'))); ?>"
                            class="client-logo-wrapper">
                            <div class="client-logo-inner">
                                <img
                                    src="<?php echo esc_url($logo); ?>"
                                    alt="<?php echo esc_attr($alt_text); ?>"
                                    class="client-logo"
                                    loading="lazy"
                                    width="<?php echo esc_attr($img_width); ?>"
                                    height="<?php echo esc_attr($img_height); ?>" />
                            </div>

                            <figcaption class="client-overlay d-flex align-items-center justify-content-center">
                                <span class="client-name"><?php echo esc_html($client_name); ?></span>
                            </figcaption>
                        </a>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
<?php endif; ?>
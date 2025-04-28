<?php

/**
 * Template Part: About Section
 *
 * Displays the About section with dynamic Customizer content.
 *
 * @package ArnabWP
 */

// Check if the section is enabled
$section_enabled = get_theme_mod('arnabwp_about_section_enable', true);
if (! $section_enabled) {
    return;
}

// Get and escape About section settings
$title        =  get_theme_mod('about_section_title', __('About Us', 'arnabwp' ));
$subtitle     = get_theme_mod('about_section_subtitle', __('Who We Are', 'arnabwp' ));
$description  = get_theme_mod('about_section_description',  __( 'We are a passionate team delivering top-tier solutions.', 'arnabwp' ) ) ;
$image        = esc_url(get_theme_mod('about_section_image', ''));
$alt_text     = esc_attr(get_theme_mod('about_section_image_alt', $title));
$button_text  =  get_theme_mod('about_section_button_text', __('Learn More', 'arnabwp' ));
$button_url   = esc_url(get_theme_mod('about_section_button_url', '#'));

$bg_image     = esc_url(get_theme_mod('about_section_bg_image', ''));
$bg_scroll    = (bool) get_theme_mod('about_section_bg_scroll', true);

// Generate inline background style if background image is set
$has_bg_image = !empty($bg_image);
$bg_style = '';
if ($bg_image) {
    $bg_style = 'style="background-image: url(' . esc_url($bg_image) . '); background-attachment: ' . ($bg_scroll ? 'fixed' : 'scroll') . '; background-size: cover; background-position: center;"';
}
?>

<section id="about" class="py-5" <?php echo $bg_style; ?> aria-labelledby="about-section-title">
    <?php if ($has_bg_image) : ?>
        <div class="bg-overlay" aria-hidden="true"></div>
    <?php endif; ?>
    <div class="container">
        <div class="row align-items-center">
            <!-- About Section Image -->
            <?php if ($image) : ?>
                <div class="about-img col-lg-4 text-center mb-4 mb-lg-0">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($alt_text); ?>" class="img-fluid rounded shadow" loading="lazy" decoding="async">
                </div>
            <?php endif; ?>
            <!-- About Section Content -->
            <div class="about-content col-lg-8">
                <?php if ($subtitle) : ?>
                    <p class="text-primary mb-2 small"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>

                <?php if ($title) : ?>
                    <h2 class="mb-4"><?php echo esc_html($title); ?></h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                    <p class="mb-4"><?php echo wp_kses_post($description); ?></p>
                <?php endif; ?>

                <?php if ($button_text && $button_url) : ?>
                    <a href="<?php echo esc_url($button_url); ?>" class="btn btn-primary" role="button" <?php echo strpos($button_url, home_url()) === false ? 'rel="noopener noreferrer"' : ''; ?> aria-label="<?php echo esc_attr($button_text . ' about section'); ?>">
                        <?php echo esc_html($button_text); ?>
                    </a>
                <?php endif; ?>
            </div>


        </div>
    </div>
</section>
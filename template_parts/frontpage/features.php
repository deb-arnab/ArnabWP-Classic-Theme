<?php

/**
 * Template Part: Services / Features Section
 *
 * Dynamically displays service posts with customizable design via Customizer.
 *
 * @package ArnabWP
 */


// Check if the section is enabled
$section_enabled = get_theme_mod('arnabwp_feature_section_enable', true);
if (! $section_enabled) {
    return;
}

// Get and sanitize the service count, limiting it to a maximum of 6
$service_count = min(absint(get_theme_mod('arnabwp_feature_service_count', 3)), 6);

// Query the latest service posts
$service_query = new WP_Query([
    'post_type'      => 'service',
    'posts_per_page' => $service_count,
    'no_found_rows'  => true,
    'post_status'    => 'publish',
]);

// Get Customizer settings for section title and styles
$section_title       =  get_theme_mod('arnabwp_service_section_title', __('Our Services', 'arnabwp'));
$section_description =  get_theme_mod('arnabwp_service_section_description', __('Explore the solutions we offer', 'arnabwp'));

$section_title_font_size =  absint(get_theme_mod('arnabwp_section_title_font_size', 32));
$section_desc_font_size =  absint(get_theme_mod('arnabwp_section_description_font_size', 16));


$name_font_size      = absint(get_theme_mod('arnabwp_service_name_font_size', 18));
$name_color          = esc_attr(get_theme_mod('arnabwp_service_name_color', '#ffffff'));

$desc_font_size      = absint(get_theme_mod('arnabwp_service_description_font_size', 14));
$desc_color          = esc_attr(get_theme_mod('arnabwp_service_description_color', '#dddddd'));

$icon_size           = absint(get_theme_mod('arnabwp_service_icon_size', 70));
$icon_radius         = absint(get_theme_mod('arnabwp_service_icon_radius', 50));

if ($service_query->have_posts()) : ?>
    <section class="services-section py-5" aria-label="Services">
    <div class="site-container">
            <!-- Section heading -->
            <div class="text-center mb-4">
                <h2 class="fw-bold" style="font-size: <?php echo $section_title_font_size; ?>px; "><?php echo esc_html($section_title); ?></h2>
                <p class="text-muted" style="font-size: <?php echo $section_desc_font_size; ?>px; "><?php echo esc_html($section_description); ?></p>
            </div>

            <div class="row">
                <?php
                $counter = 0;
                while ($service_query->have_posts()) :
                    $service_query->the_post();
                    $counter++;
                    // Get custom meta fields
                    $service_name        = get_post_meta(get_the_ID(), '_service_name', true);
                    $service_description = get_post_meta(get_the_ID(), '_service_description', true);
                    $icon_url            = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
                ?>
                    <div class="col-12 col-sm-6 col-md-4 mb-4">
                        <div class="service-card h-100 text-center">
                            <!-- Service Icon -->
                            <?php if ($icon_url) : ?>

                                <img src="<?php echo esc_url($icon_url); ?>"
                                    <?php echo ($counter > 1) ? 'loading="lazy"' : ''; ?>
                                    alt="<?php echo esc_attr($service_name); ?>"
                                    title="<?php echo esc_attr($service_name); ?>"
                                    width="<?php echo esc_attr($icon_size); ?>"
                                    height="<?php echo esc_attr($icon_size); ?>"
                                    class="mx-auto mt-3"
                                    style="border-radius: <?php echo esc_attr($icon_radius); ?>%;" />
                            <?php endif; ?>

                            <!-- Service Card Content (Title + Description) -->
                            <div class="card-body">
                                <?php if (! empty($service_name)) : ?>
                                    <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                        <h5 class="card-title entry-title"
                                            style="font-size: <?php echo $name_font_size; ?>px; color: <?php echo $name_color; ?>;">
                                            <?php echo esc_html($service_name ?: get_the_title()); ?>
                                        </h5>
                                    </a>
                                <?php endif; ?>
                                <?php if (! empty($service_description)) : ?>
                                    <p class="card-text"
                                        style="font-size: <?php echo esc_attr($desc_font_size); ?>px !important; color: <?php echo esc_attr($desc_color); ?>;">
                                        <?php echo esc_html($service_description); ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

<?php
else :
    echo do_blocks('<!-- wp:pattern {"slug":"arnabwp/features-static"} /-->');
endif;

wp_reset_postdata();
?>

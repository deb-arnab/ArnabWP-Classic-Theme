<?php

/**
 * Template Part: Employees Section
 *
 * Dynamically displays employees custom post types with customizable design via Customizer.
 *
 * @package ArnabWP
 */


// Check if the section is enabled
$section_enabled = get_theme_mod('arnabwp_employee_section_enable', true);
if (! $section_enabled) {
    return;
}

// Get section title and description with proper escaping
$section_title       = get_theme_mod('arnabwp_employee_section_title', __('Meet Our Team', 'arnabwp'));
$section_description = get_theme_mod('arnabwp_employee_section_description', __('We’re a passionate group of professionals.', 'arnabwp'));

$section_title_font_size =  absint(get_theme_mod('arnabwp_section_title_font_size', 32));
$section_desc_font_size =  absint(get_theme_mod('arnabwp_section_description_font_size', 16));

// Get and sanitize employee count
$employee_count = absint(get_theme_mod('arnabwp_employee_count', 6));

// Get styling settings
$name_font_size       = absint(get_theme_mod('employee_name_font_size', 20));
$name_color           = esc_attr(get_theme_mod('employee_name_color', '#111111'));

$desc_font_size       = absint(get_theme_mod('employee_description_font_size', 16));
$desc_color           = esc_attr(get_theme_mod('employee_description_color', '#555555'));

$email_font_size      = absint(get_theme_mod('employee_email_font_size', 14));
$email_color          = esc_attr(get_theme_mod('employee_email_color', '#dddddd'));

$social_icon_size     = absint(get_theme_mod('employee_social_icon_font_size', 12));
$social_icon_color    = esc_attr(get_theme_mod('employee_social_icon_color', '#187dbc'));
?>




<section id="team" class="py-5" role="region" aria-labelledby="team-section">
<div class="site-container">
        <!-- Section Header -->
        <div class="text-center mb-4">
            <h2 class="fw-bold" style="font-size: <?php echo $section_title_font_size; ?>px; "><?php echo esc_html($section_title); ?></h2>
            <p class="text-muted" style="font-size: <?php echo $section_desc_font_size; ?>px; "><?php echo esc_html($section_description); ?></p>
        </div>

        <?php
        // Query employees
        $team_query = new WP_Query([
            'post_type'      => 'employee',
            'posts_per_page' => $employee_count,
            'order'          => 'ASC',
        ]);

        if ($team_query->have_posts()) :
        ?>
            <!-- Employee Carousel -->
            <div class="owl-carousel owl-theme employee-slider" role="region" aria-label="Team Carousel" aria-roledescription="carousel">
                <?php while ($team_query->have_posts()) : $team_query->the_post();
                    $name     = get_post_meta(get_the_ID(), '_employee_name', true);
                    $position = get_post_meta(get_the_ID(), '_employee_position', true);
                    $email    = get_post_meta(get_the_ID(), '_employee_email', true);
                    $social   = get_post_meta(get_the_ID(), '_employee_social_links', true);
                    $social   = is_array($social) ? $social : []; // Ensure it's an array
                ?>
                    <!-- Employee Card -->
                    <div class="team-card position-relative">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="employee-img-wrapper position-relative overflow-hidden">
                                <?php the_post_thumbnail('medium', [
                                    'class' => 'employee-img w-100',
                                    'loading'  => 'lazy',
                                    'decoding' => 'async',
                                    'alt'      => esc_attr($name ? $name : get_the_title()),
                                ]); ?>

                                <!-- Email Overlay -->
                                <?php if (!empty($email)) : ?>
                                    <div class="email-overlay text-center">
                                        <a href="mailto:<?php echo antispambot($email); ?>" style="font-size: <?php echo esc_attr($email_font_size); ?>px; color: <?php echo esc_attr($email_color); ?>;" aria-label="<?php echo esc_attr__('Email', 'arnabwp') . ' ' . esc_attr($name ? $name : get_the_title()); ?>">
                                            <?php echo antispambot($email); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- Social Overlay -->
                                <?php if (! empty($social)) : ?>
                                    <div class="social-overlay d-flex justify-content-center align-items-center" style="font-size: <?php echo esc_attr($social_icon_size); ?>px;">
                                        <?php if (! empty($social['facebook'])) : ?>
                                            <a href="<?php echo esc_url($social['facebook']); ?>" target="_blank" rel="noopener" style="color: <?php echo esc_attr($social_icon_color); ?>;" aria-label="<?php esc_attr_e('Follow on Facebook', 'arnabwp'); ?>">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (! empty($social['twitter'])) : ?>
                                            <a href="<?php echo esc_url($social['twitter']); ?>" target="_blank" rel="noopener" style="color: <?php echo esc_attr($social_icon_color); ?>;" aria-label="<?php esc_attr_e('Follow on Twitter', 'arnabwp'); ?>">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (! empty($social['linkedin'])) : ?>
                                            <a href="<?php echo esc_url($social['linkedin']); ?>" target="_blank" rel="noopener" style="color: <?php echo esc_attr($social_icon_color); ?>;" aria-label="<?php esc_attr_e('Connect on LinkedIn', 'arnabwp'); ?>">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Employee Name and Position -->
                        <div class="p-4 text-center">
                            <h5 class="fw-bold mb-1" style="font-size: <?php echo esc_attr($name_font_size); ?>px; color: <?php echo esc_attr($name_color); ?>">
                                <strong><?php echo esc_html($name ? $name : get_the_title()); ?></strong>
                            </h5>
                            <?php if (! empty($position)) : ?>
                                <p class="mb-1" style="font-size: <?php echo esc_attr($desc_font_size); ?>px; color: <?php echo esc_attr($desc_color); ?>">
                                    <?php echo esc_html($position); ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>
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

// Get section title and description
$section_title       = get_theme_mod('arnabwp_employee_section_title', __('Meet Our Team', 'arnabwp'));
$section_description = get_theme_mod('arnabwp_employee_section_description', __('We’re a passionate group of professionals.', 'arnabwp'));

$employee_count = absint(get_theme_mod('arnabwp_employee_count', 6));

// Get style settings

$name_color        = esc_attr(get_theme_mod('employee_name_color', '#187dbc'));
$desc_color        = esc_attr(get_theme_mod('employee_description_color', '#555555'));


$email_color       = esc_attr(get_theme_mod('employee_email_color', '#e83582'));


$social_icon_color = esc_attr(get_theme_mod('employee_social_icon_color', '#e83582'));

// Query employees
$team_query = new WP_Query([
    'post_type'      => 'employee',
    'posts_per_page' => $employee_count,
    'order'          => 'ASC',
]);

if ($team_query->have_posts()) :
?>

<section id="team" class="py-5" role="region" aria-labelledby="team-section">
    <div class="site-container">
        <!-- Section Header -->
        <div class="text-center mb-4">
            <h2 class="fw-bold section-title">
                <?php echo esc_html($section_title); ?>
            </h2>
            <p class="text-muted section-description">
                <?php echo esc_html($section_description); ?>
            </p>
        </div>

        <!-- Employee Carousel -->
        <div class="owl-carousel owl-theme employee-slider" role="region" aria-label="Team Carousel" aria-roledescription="carousel">
            <?php while ($team_query->have_posts()) : $team_query->the_post();
                $name     = get_post_meta(get_the_ID(), '_employee_name', true);
                $position = get_post_meta(get_the_ID(), '_employee_position', true);
                $email    = get_post_meta(get_the_ID(), '_employee_email', true);
                $social   = get_post_meta(get_the_ID(), '_employee_social_links', true);
                $social   = is_array($social) ? $social : [];
            ?>
                <div class="team-card position-relative">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="employee-img-wrapper position-relative overflow-hidden">
                            <?php the_post_thumbnail('medium', [
                                'class'    => 'employee-img w-100',
                                'loading'  => 'lazy',
                                'decoding' => 'async',
                                'alt'      => esc_attr($name ? $name : get_the_title()),
                            ]); ?>

                            <?php if (! empty($email)) : ?>
                                <div class="employee-email email-overlay text-center">
                                    <a 
                                    href="mailto:<?php echo antispambot($email); ?>" 
                                    style="color: <?php echo esc_attr($email_color); ?>;" 
                                    aria-label="<?php echo esc_attr__('Email', 'arnabwp') . ' ' . esc_attr($name ? $name : get_the_title()); ?>">
                                        <?php echo antispambot($email); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if (! empty($social)) : ?>
                                <div class="employee-social-icon social-overlay d-flex justify-content-center align-items-center">
                                    
                                    <?php if (! empty($social['facebook'])) : ?>
                                        <a 
                                        href="<?php echo esc_url($social['facebook']); ?>" 
                                        target="_blank" 
                                        rel="noopener" 
                                        style="color: <?php echo esc_attr($social_icon_color); ?>;" 
                                        aria-label="<?php esc_attr_e('Follow on Facebook', 'arnabwp'); ?>">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (! empty($social['twitter'])) : ?>
                                        <a 
                                        href="<?php echo esc_url($social['twitter']); ?>" 
                                        target="_blank" 
                                        rel="noopener" 
                                        style="color: <?php echo esc_attr($social_icon_color); ?>;" 
                                        aria-label="<?php esc_attr_e('Follow on Twitter', 'arnabwp'); ?>">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (! empty($social['linkedin'])) : ?>
                                        <a 
                                        href="<?php echo esc_url($social['linkedin']); ?>" 
                                        target="_blank" 
                                        rel="noopener" 
                                        style="color: <?php echo esc_attr($social_icon_color); ?>;" 
                                        aria-label="<?php esc_attr_e('Connect on LinkedIn', 'arnabwp'); ?>">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-title p-4 text-center">
                        <h5 class="fw-bold mb-1 employee-name" style="color: <?php echo esc_attr($name_color); ?>">
                            <?php echo esc_html($name ? $name : get_the_title()); ?>
                        </h5>
                        <?php if (! empty($position)) : ?>
                            <p class="mb-1 employee-description" style="color: <?php echo esc_attr($desc_color); ?>">
                                <?php echo esc_html($position); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<?php
else :
    echo do_blocks('<!-- wp:pattern {"slug":"arnabwp/team-static"} /-->');
endif;

wp_reset_postdata();
?>

<?php

/**
 * Template Part: Testimonial Section
 * 
 * Query and display testimonials with SEO schema markup.
 * 
 * @package ArnabWP
 */



$section_enabled = get_theme_mod('arnabwp_testimonial_section_enable', true);
if (!$section_enabled) return;

// Query testimonials custom post type
$testimonial_query = new WP_Query([
    'post_type'      => 'testimonial',
    'posts_per_page' => -1, // Display all testimonials
    'orderby'        => 'date',
    'order'          => 'ASC',
]);

// Get the Customizer setting
$show_quotation_mark = (bool) get_theme_mod('arnabwp_show_testimonial_quotation_mark', true);

// Get dynamic customization values
$section_title       = get_theme_mod('arnabwp_testimonial_section_title', __('What Our Clients Say', 'arnabwp'));
$section_description =  get_theme_mod('arnabwp_testimonial_section_description', __('Experience the difference with us', 'arnabwp'));

$icon_size           = absint(get_theme_mod('arnabwp_testimonial_icon_size', 70));
$icon_radius         = absint(get_theme_mod('arnabwp_testimonial_icon_radius', 50));


if ($testimonial_query->have_posts()) : ?>
<?php \ARNABWP_THEME\Inc\Helpers\Customizer_Shortcut::arnabwp_display_shortcut( 'arnabwp_testimonial_section' ); ?>
    <section class="testimonial-section py-5" id="testimonials" aria-label="Client Testimonial">
    <div class="site-container">
            <!-- Section heading -->
            <div class="text-center mb-5">
                <h2 class="fw-bold section-title" ><?php echo esc_html($section_title); ?></h2>
                <p class="section-description" ><?php echo esc_html($section_description); ?></p>
            </div>

            <div class="owl-carousel owl-theme testimonial-carousel" role="region" aria-label="Testimonials Carousel">

                <?php while ($testimonial_query->have_posts()) : $testimonial_query->the_post();
                    // Retrieve testimonial meta data
                    $client_name        = esc_html(get_post_meta(get_the_ID(), '_testimonial_client_name', true));
                    $client_title       = esc_html(get_post_meta(get_the_ID(), '_testimonial_client_title', true));
                    $rating             = get_post_meta(get_the_ID(), '_testimonial_rating', true);
                    $social_links       = get_post_meta(get_the_ID(), '_testimonial_social_links', true);
                    $testimonial_comment = esc_html(get_post_meta(get_the_ID(), '_testimonial_comment', true)); // Retrieve testimonial comment
                ?>

                    <div class="testimonial-item position-relative" role="article">
                        <div class="card-body">
                            <!-- Show Quotation Mark If Enabled -->
                            <?php if ($show_quotation_mark) : ?>
                                <div class="testimonial-quote-mark" style="font-size: 150px; color: #f7c301; text-align: center; margin: -80px auto;">
                                    &ldquo;
                                </div>
                            <?php endif; ?>
                            <!-- Testimonial Content -->
                            <blockquote class="testimonial-comment text-center mb-4">
                                <p class="testimonial-comment mb-0" style="font-style: italic;"><?php echo $testimonial_comment; ?></p>
                            </blockquote>

                            <!-- Rating (Centered) -->
                            <?php if ($rating) : ?>
                                <div class="testimonial-rating mb-4 text-center" role="img" aria-label="Rated <?php echo esc_attr($rating); ?> out of 5 stars">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <span class="star-rating<?php echo ($i <= $rating ? ' filled' : ''); ?>">&#9733;</span>
                                    <?php endfor; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Client Info -->
                            <div class="testimonial-client d-flex align-items-center justify-content-center mb-3 gap-4">
                                <div class="testimonial-client-avatar"
                                    style=" width: <?php echo esc_attr($icon_size); ?>px; 
                                    height: <?php echo esc_attr($icon_size); ?>px; 
                                    border-radius: <?php echo esc_attr($icon_radius); ?>%; overflow: hidden;"
                                    role="img"
                                    aria-label="<?php echo esc_attr($client_name ? $client_name . '\'s Photo' : 'Client Photo'); ?>">
                                    <?php if (has_post_thumbnail()) : ?>

                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail')); ?>"
                                            alt="<?php echo esc_attr($client_name ? $client_name . '\'s Avatar' : 'Client Avatar'); ?>"
                                            loading="lazy">
                                    <?php endif; ?>
                                </div>

                                <div class="testimonial-client-details">
                                    <h5 class="testimonial-client-name mb-1 entry-title fw-bold"><?php echo $client_name; ?></h5>
                                    <p class="testimonial-client-title mb-2"><?php echo $client_title; ?></p>
                                    <!-- Social Links (Below Subtitle) -->
                                    <?php if (!empty($social_links)) : ?>
                                        <div class="testimonial-social-icon testimonial-client-social-links">
                                            <?php if (!empty($social_links['facebook'])) : ?>
                                                <a 
                                                href="<?php echo esc_url($social_links['facebook']); ?>"
                                                    target="_blank"
                                                
                                                    rel="noopener"
                                                    aria-label="Facebook profile of <?php echo esc_attr($client_name); ?>">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($social_links['twitter'])) : ?>
                                                <a 
                                                href="<?php echo esc_url($social_links['twitter']); ?>" 
                                                target="_blank" 
                                                 
                                                rel="noopener"
                                                aria-label="Twitter profile of <?php echo esc_attr($client_name); ?>">
                                                    <i class="fab fa-twitter"></i>
                                                </a>
                                            <?php endif; ?>
                                            <?php if (!empty($social_links['linkedin'])) : ?>
                                                <a 
                                                href="<?php echo esc_url($social_links['linkedin']); ?>" 
                                                target="_blank" 
                                                
                                                rel="noopener"
                                                aria-label="Linkedin profile of <?php echo esc_attr($client_name); ?>">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </a>
                                            <?php endif; ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div> <!-- Close row -->
        </div> <!-- Close container -->
    </section> <!-- Close testimonial-section -->

    <?php else : ?>
    <?php
    // Fallback: Show the static block pattern
    echo do_blocks('<!-- wp:pattern {"slug":"arnabwp/testimonials-static"} /-->');
    ?>
<?php endif; ?>

<?php
// Reset postdata
wp_reset_postdata();
?>
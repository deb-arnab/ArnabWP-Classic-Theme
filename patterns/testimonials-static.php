<?php
/**
 * Title: Testimonials Section (Static)
 * Slug: arnabwp/testimonials-static
 * Categories: arnabwp-sections, testimonials
 * Keywords: testimonials, clients, feedback
 * Inserter: yes
 */

return [
	'title'       => __( 'Testimonials Section (Static)', 'arnabwp' ),
	'slug'        => 'arnabwp/testimonials-static',
	'categories'  => [ 'arnabwp-sections', 'testimonials' ],
	'keywords'    => [ 'testimonials', 'clients', 'feedback' ],
	'description' => __( 'Compact testimonial layout with quote, comment, rating, avatar beside name and title, and social links.', 'arnabwp' ),
	'content'     => <<<HTML
<!-- wp:group {"tagName":"section","className":"testimonial-section py-5","layout":{"type":"constrained"}} -->
<section class="wp-block-group testimonial-section py-5" id="testimonials" aria-label="Client Testimonial">
    <!-- wp:group {"className":"site-container","layout":{"type":"constrained"}} -->
    <div class="wp-block-group site-container">

    <!-- Heading -->
        <!-- wp:heading {"textAlign":"center","level":2,"className":"fw-bold","style":{"typography":{"fontSize":"32px"}}} -->
        <h2 class="wp-block-heading has-text-align-center fw-bold" style="font-size:32px">What Our Clients Say</h2>
        <!-- /wp:heading -->

    <!-- Description -->
        <!-- wp:paragraph {"align":"center","className":"text-muted","style":{"typography":{"fontSize":"16px"}}} -->
        <p class="has-text-align-center text-muted" style="font-size:16px">Experience the difference.</p>
        <!-- /wp:paragraph -->

        <!-- wp:group {"className":"testimonial-box text-center","layout":{"type":"constrained"}} -->
        <div class="wp-block-group testimonial-box text-center" style="padding-bottom: 40px;">

            <!-- Quotation Mark -->
            <p class="has-text-align-center" style="font-size:80px;color:#f7c301;">&ldquo;</p>

            <!-- Comment -->
            <p class="has-text-align-center testimonial-comment" style="font-size:16px;font-style:italic;color:#555;">This theme is fast, clean, and flexible. Love it!</p>

            <!-- Star Rating -->
            <p class="has-text-align-center testimonial-rating" style="font-size:16px;">
                <span style="color:#ffc107">&#9733;</span>
                <span style="color:#ffc107">&#9733;</span>
                <span style="color:#ffc107">&#9733;</span>
                <span style="color:#ffc107">&#9733;</span>
                <span style="color:#e4e4e4">&#9733;</span>
            </p>

            <!-- Image + Name/Title Compact Row -->
            <!-- wp:group {"className":"testimonial-person","style":{"layout":{"selfStretch":"fixed","flexDirection":"row","justifyContent":"center","alignItems":"center","gap":"10px","flex-wrap":"nowrap","margin:12px auto"}}} -->
            <div class="wp-block-group testimonial-person" style="display:flex;justify-content:center;align-items:center;gap:10px;flex-wrap:nowrap;margin:12px auto;">

                <!-- Avatar -->
                <figure class="wp-block-image testimonial-avatar" style="margin:0;border-radius:50%;">
                    <img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prof-logo.jpg" alt="Jane Doe" width="60" height="60" />
                </figure>

                <!-- Name and Title -->
                <div class="testimonial-text p-4" style="text-align:center;">
                    <h5 class="fw-bold" style="text-align:center;font-size:16px;color:#000;">Jane Doe</h5>
                    <p style="margin:0;font-size:14px;color:#888;">Marketing Manager</p>
                </div>

            </div>
            <!-- /wp:group -->

            <!-- Social Links -->
            <p class="has-text-align-center testimonial-social-links" style="font-size:12px;">
                <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
            </p>

        </div>
        <!-- /wp:group -->

    </div>
    <!-- /wp:group -->
</section>
<!-- /wp:group -->
HTML
];

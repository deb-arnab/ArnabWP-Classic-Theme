<?php
/**
 * Title: Team Section (Static)
 * Slug: arnabwp/team-static
 * Categories: arnabwp-sections, team
 * Keywords: team, staff, employees, members
 * Inserter: yes
 */

return [
    'title'       => __( 'Team Section (Static)', 'arnabwp' ),
    'slug'        => 'arnabwp/team-static',
    'categories'  => [ 'arnabwp-sections', 'team' ],
    'keywords'    => [ 'team', 'staff', 'employees', 'members' ],
    'description' => __( 'A static team section with name, position, email, and social icons.', 'arnabwp' ),
    'content'     => <<<HTML
  
<!-- wp:group {"className":"employee-section py-5"} -->
<section class="wp-block-group employee-section py-5"id="team" aria-label="Team Members">
     <!-- wp:group {"className":"site-container"} -->
    <div class="wp-block-group alignwide site-container">
        <!-- Heading -->
        <!-- wp:heading {"textAlign":"center","level":2,"className":"fw-bold","style":{"typography":{"fontSize":"32px"}}} -->
        <h2 class="wp-block-heading has-text-align-center fw-bold" style="font-size:32px">Meet Our Team</h2>
        <!-- /wp:heading -->

    <!-- Description -->
        <!-- wp:paragraph {"align":"center","className":"text-muted","style":{"typography":{"fontSize":"16px"}}} -->
        <p class="has-text-align-center text-muted" style="font-size:16px">We’re a passionate group of professionals.</p>
        <!-- /wp:paragraph --><!-- Section Header -->

    <!-- wp:columns {"className":"team-box text-center"} -->
        <div class="wp-block-group wp-block-columns team-box text-center">
            
           <!-- wp:column -->
            <div class="wp-block-column">
                <div class="team-card p-4 position-relative">
                    <!-- Avatar -->
                    <figure class="wp-block-image size-medium">
                        <img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prof-logo.jpg" alt="Jane Doe" />
                    </figure>
                    <!-- Name and Title and Email -->
                    <div class="team-text px-2" style="text-align:center;">
                        <h5 class="fw-bold" style="text-align:center; font-size:16px;color:#000">Jane Doe</h5>
                        <p style="text-align:center; font-size: 16px; color: #888;">Marketing Manager</p>
                        
                        <p><a href="mailto:david.green@example.com" style="text-align:center; font-size: 14px; color: #555555;">jane.doe@example.com</a></p>
                    </div>
                

                    <!-- Social Links -->
                    <div class="employee-socials" style="text-align:center;">
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
<!-- /wp:column -->
          <!-- wp:column -->
            <div class="wp-block-column">
                <div class="team-card p-4 position-relative">
                         <!-- Avatar -->
                    <figure class="wp-block-image size-medium">
                        <img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prof-logo.jpg" alt="John Smith" />
                    </figure>
                       <!-- Name and Title and Email -->
                    <div class="team-text px-2" style="text-align:center;">
                        <h5 class="fw-bold" style="text-align:center; font-size:16px;color:#000">John Smith</h5>
                        <p style="text-align:center; font-size: 16px; color: #888;">Small Business Owner</p>
                        <p><a href="mailto:david.green@example.com" style="text-align:center; font-size: 14px; color: #555555;">john.smith@example.com</a></p>
                    </div>
                
                    <!-- Social Links -->
                    <div class="employee-socials" style="text-align:center;">
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <!-- /wp:column -->
<!-- wp:column -->
            <div class="wp-block-column">
                <div class="team-card p-4 position-relative">
                         <!-- Avatar -->
                    <figure class="wp-block-image size-medium">
                        <img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prof-logo.jpg" alt="Alice Brown" />
                    </figure>
                       <!-- Name and Title and Email -->
                    <div class="team-text px-2" style="text-align:center;">
                        <h5 class="fw-bold" style="text-align:center; font-size:16px;color:#000">Alice Brown</h5>
                        <p style="text-align:center; font-size: 16px; color: #888;">Web Developer</p>
                        <p><a href="mailto:david.green@example.com" style="text-align:center; font-size: 14px; color: #555555;">alice.brown@example.com</a></p>
                    </div>
                
                    <!-- Social Links -->
                    <div class="employee-socials" style="text-align:center;">
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
<!-- /wp:column -->
          <!-- wp:column -->
            <div class="wp-block-column">
                <div class="team-card p-4 position-relative">
                         <!-- Avatar -->
                    <figure class="wp-block-image size-medium">
                        <img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prof-logo.jpg" alt="David Green" />
                    </figure>
                       <!-- Name and Title and Email -->
                    <div class="team-text px-2" style="text-align:center;">
                        <h5 class="fw-bold" style="text-align:center;font-size:16px;color:#000">David Green</h5>
                        <p style="text-align:center; font-size: 16px; color: #888;">Graphic Designer</p>
                        <!-- Email -->
                        <p><a href="mailto:david.green@example.com" style="text-align:center; font-size: 14px; color: #555555;">david.green@example.com</a></p>
                    </div>
                
                    <!-- Social Links -->
                    <div class="has-text-align-center employee-socials" style="font-size:12px;margin-top:12px;">
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" style="color:#187dbc;margin:0 6px;" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
<!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>

</section>
<!-- /wp:group -->
HTML
];
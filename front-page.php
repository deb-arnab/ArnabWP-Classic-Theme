<?php
/**
 * Front Page Template
 *
 * This is the template for the static front page set in WordPress settings.
 * It loads modular template parts for the hero section and features.
 *
 * @package ArnabWP
 */

// Load the header
get_header();
?>

<?php 
// Load the Hero section (customizable via Customizer)
get_template_part( 'template_parts/frontpage/hero' ); 

// Load the Features section (services or highlights)
get_template_part( 'template_parts/frontpage/features' );

// Load the About section 
get_template_part( 'template_parts/frontpage/about' ); 

// Load the Employee section 
get_template_part( 'template_parts/frontpage/employee' ); 

// Load the Client section 
get_template_part( 'template_parts/frontpage/client' ); 

// Load the Testimonial section 
get_template_part( 'template_parts/frontpage/testimonial' );

// Load the Newsletter section 
get_template_part( 'template_parts/frontpage/newsletter' );
?>

<?php
// Load the footer
get_footer();
?>
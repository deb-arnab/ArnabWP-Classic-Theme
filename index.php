<?php
/**
 * Main template file
 * 
 * @package ArnabWP
 */

 use ARNABWP_THEME\Inc\Pagination;
 $pagination= Pagination::get_instance();
?>




<?php get_header(); ?>



<main class="py-5 bg-info">
<div class="site-container">





<?php if ( is_home() && ! is_front_page() ) : ?>
      <h1 class="mb-5 fw-bold text-center"><?php single_post_title(); ?></h1>
    <?php endif; ?>

    </div>
    </main>
    <section>
    <div class="site-container">
    <?php if ( have_posts() ) : ?>

      <div class="masonry-grid">
       
        <?php while ( have_posts() ) : the_post(); 
      
      if ( 'service' !== get_post_type() ) {
        get_template_part('template_parts/blogs/content');
    }
      
      endwhile; ?>
 
      </div>
    
    <?php else : 
      get_template_part( 'template_parts/blogs/content', 'none' );
      ?>
      
    <?php endif; ?>
      <div class="mt-4">
                    <?php $pagination->arnabwp_page_nav(); ?>
                </div>
    </div>
                </section>

<?php get_footer(); ?>
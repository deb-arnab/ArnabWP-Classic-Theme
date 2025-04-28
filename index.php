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



<main class="py-5">
  <div class="container">






    <?php if ( is_home() && ! is_front_page() ) : ?>
      <h1 class="mb-5 fw-bold text-center"><?php single_post_title(); ?></h1>
    <?php endif; ?>

    <?php if ( have_posts() ) : ?>

      <div class="masonry-grid">
       
        <?php while ( have_posts() ) : the_post(); 
      
      get_template_part('template_parts/blogs/content');
      
      
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
</main>

<?php get_footer(); ?>
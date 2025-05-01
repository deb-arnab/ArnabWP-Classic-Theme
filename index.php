<?php

/**
 * Main template file
 * 
 * @package ArnabWP
 */

use ARNABWP_THEME\Inc\Pagination;

$pagination = Pagination::get_instance();

$sidebar_layout = get_theme_mod('arnabwp_sidebar_layout', 'right');
$layout_class = 'has-sidebar-right';

if ($sidebar_layout === 'left') {
  $layout_class = 'has-sidebar-left';
} elseif ($sidebar_layout === 'no') {
  $layout_class = 'no-sidebar';
}

$blog_layout = get_theme_mod('arnabwp_blog_layout', 'masonry');
$blog_class  = ($blog_layout === 'list') ? 'list-layout' : 'masonry-grid';
?>



<?php get_header(); ?>





<main class="py-5 bg-info">
  <div class="site-container">

    <?php if (is_home() && ! is_front_page()) : ?>
      <h1 class="mb-5 fw-bold text-center"><?php single_post_title(); ?></h1>
    <?php endif; ?>

  </div>
</main>

<section class="mt-5 <?php echo esc_attr($layout_class); ?>">
  <div class="site-container arnabwp-blog-content d-flex flex-lg-row">

    <?php if ($sidebar_layout === 'left') : ?>
      <?php get_sidebar(); ?>
    <?php endif; ?>

    <?php if (have_posts()) : ?>

      <div class="content-area flex-grow-1">
        <div class="<?php echo esc_attr($blog_class); ?>">
          <?php
          global $arnabwp_post_index;
          $arnabwp_post_index = 0;
          while (have_posts()) : the_post();
          $arnabwp_post_index++;
          get_template_part('template_parts/blogs/content');

          endwhile; ?>
        </div>

      <?php else :
      get_template_part('template_parts/blogs/content', 'none');
      ?>

      <?php endif; ?>
      <div class="mt-4 mb-4">
        <?php $pagination->arnabwp_page_nav(); ?>
      </div>
      </div>
      <?php if ($sidebar_layout === 'right') : ?>
        <?php get_sidebar(); ?>
      <?php endif; ?>
  </div>
  </main>
  </div>
</section>

<?php get_footer(); ?>
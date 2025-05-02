<?php
/**
 * The template for showing single blog content
 * 
 * @package ArnabWP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-card shadow-sm px-5 py-5 mb-4'); ?>>

  <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail mb-4">
      <?php the_post_thumbnail( 'large', ['class' => 'img-fluid rounded', 'alt' => get_the_title() . ' thumbnail'] ); ?>
    </div>
  <?php endif; ?>

  <header class="mb-3">
    <h2 class="display-5 post-title"><?php the_title(); ?></h2>

    <?php get_template_part( 'template_parts/blogs/content', 'meta' ); ?>

  </header>

  <div class="entry-content">
  <?php the_content(); ?>
  <?php
wp_link_pages(array(
    'before' => '<div class="page-links">Pages:',
    'after'  => '</div>',
));
?>

  </div>
</article>

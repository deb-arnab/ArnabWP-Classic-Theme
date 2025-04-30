<?php
/**
 * The template for showing single blog content
 * 
 * @package ArnabWP
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>

  <?php if ( has_post_thumbnail() ) : ?>
    <div class="post-thumbnail mb-4">
      <?php the_post_thumbnail( 'large', ['class' => 'img-fluid rounded', 'alt' => get_the_title() . ' thumbnail'] ); ?>
    </div>
  <?php endif; ?>

  <header class="mb-3">
    <h1 class="display-5 post-title"><?php the_title(); ?></h1>

    <?php get_template_part( 'template_parts/blogs/content', 'meta' ); ?>

  </header>

  <div class="entry-content mb-4">
  <?php the_content(); ?>

  </div>
</article>

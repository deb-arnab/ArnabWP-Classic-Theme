<?php

/**
 * The template for showing blogs content
 * 
 * @package ArnabWP
 */


 $blog_layout = get_theme_mod('arnabwp_blog_layout', 'masonry');
$is_list = ($blog_layout === 'list');

global $arnabwp_post_index;
$post_index = $arnabwp_post_index;
$reverse_layout = (has_post_thumbnail() && $is_list && $post_index % 2 === 0) ? 'reverse-layout' : '';
?>

<article class="post-card <?php echo $is_list ? 'd-flex flex-row list-item ' . $reverse_layout : ''; ?>">
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>" class="<?php echo $is_list ? '' : 'mb-3'; ?>">
            <?php the_post_thumbnail('medium', [
                'class' => $is_list ? 'img-fluid' : 'img-fluid rounded',
            ]); ?>
        </a>


    <div class="<?php echo $is_list ? 'post-card-content' : ''; ?>">

        <h3 class="mt-2 post-title">
            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                <?php the_title(); ?>
            </a>
        </h3>
        <?php get_template_part( 'template_parts/blogs/content', 'meta' ); ?>

        <a href="<?php the_permalink(); ?>" class="btn btn-sm">Read More</a>

    </div>
  
    <?php else : ?>

    <div class="<?php echo $is_list ? 'post-card-content' : ''; ?>">

        <h3 class="mt-2 post-title">
            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                <?php the_title(); ?>
            </a>
        </h3>
        <?php get_template_part( 'template_parts/blogs/content', 'meta' ); ?>
       

        <div class="mt-2 mb-2">
            <?php the_excerpt(); ?>
        </div>

        <a href="<?php the_permalink(); ?>" class="btn btn-sm">Read More</a>

    </div>
    <?php endif; ?>
</article>
<?php

/**
 * The template for showing blogs archive
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

            <h2 class="mt-2 post-title">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                    <?php the_title(); ?>
                </a>
            </h2>
            <small class="text-muted">
                <?php get_template_part('template_parts/blogs/content', 'meta'); ?>
            </small>
            <a href="<?php the_permalink(); ?>" class="btn btn-sm mt-3">Read More</a>

        </div>

    <?php else : ?>

        <div class="<?php echo $is_list ? 'post-card-content' : ''; ?>">

            <h3 class="mt-2 post-title">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
                    <?php the_title(); ?>
                </a>
            </h3>
            <small class="text-muted">
                <?php get_template_part('template_parts/blogs/content', 'meta'); ?>
            </small>

            <div class="mt-5">
                <?php the_excerpt(); ?>
            </div>

            <a href="<?php the_permalink(); ?>" class="btn btn-sm mt-5">Read More</a>

        </div>
    <?php endif; ?>
</article>
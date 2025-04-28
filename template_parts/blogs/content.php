<?php

/**
 * The template for showing blogs content
 * 
 * @package ArnabWP
 */

?>

<article class="post-card">

    <h3 class="mt-3">
        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
            <?php the_title(); ?>
        </a>
    </h3>

    <p class="small text-muted mb-2">
        <?php echo esc_html(get_the_date()); ?> • <?php the_author_posts_link(); ?>
    </p>

    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('medium', ['class' => 'img-fluid rounded']); ?>
        </a>
    <?php endif; ?>

    <div class="mt-3 mb-3">
        <?php the_excerpt(); ?>
    </div>

    <a href="<?php the_permalink(); ?>" class="btn btn-sm btn-outline-dark">Read More</a>
</article>


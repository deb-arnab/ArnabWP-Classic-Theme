<?php
/**
 * Post Meta Template
 *
 * Displays author, date, categories, and tags.
 *
 * @package ArnabWP
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<div class="post-meta small text-muted d-flex flex-wrap gap-3 align-items-center mb-3">

    <?php if ( get_the_author_meta( 'display_name' ) ) : ?>
        <span class="meta-author" aria-label="Author: <?php echo esc_html( get_the_author() ); ?>">
            <i class="fa-solid fa-user"></i>
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
                <?php echo esc_html( get_the_author() ); ?>
            </a>
        </span>
    <?php endif; ?>

    <span class="meta-date">
        <i class="fa-regular fa-calendar-days"></i>
        <span class="screen-reader-text">Published on:</span>
        <time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
            <?php echo esc_html( get_the_date() ); ?>
        </time>
    </span>

    <?php if ( has_category() ) : ?>
        <span class="meta-categories">
            <i class="fa-solid fa-folder-open"></i>
            <span class="screen-reader-text">Posted in:</span>
            <?php the_category( ' <span class="meta-category-separator">|</span> ' ); ?>
        </span>
    <?php endif; ?>

    <?php if ( has_tag() ) : ?>
        <span class="meta-tags">
            <i class="fa-solid fa-tags"></i>
            <span class="screen-reader-text">Tags:</span>
            <?php the_tags( '', ' <span class="meta-tag-separator">|</span> ', '' ); ?>
        </span>
    <?php endif; ?>

</div>

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

<div class="post-meta d-flex flex-wrap gap-3 align-items-center">

    <?php if ( get_the_author_meta( 'display_name' ) ) : ?>
        <span class="meta-author" aria-label="Author: <?php echo esc_html( get_the_author() ); ?>">
            <i class="fa-solid fa-user"></i>&nbsp;
            <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" style="text-decoration: none; color:var(--text-color);">
                <?php echo esc_html( get_the_author() ); ?>
            </a>
        </span>
    <?php endif; ?>

    <span class="meta-date">
        <i class="fa-regular fa-calendar-days"> </i>&nbsp;
        <span class="screen-reader-text">Published on: </span>
        <time style="color:var(--text-color);" datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>">
            <?php echo esc_html( get_the_date() ); ?>
        </time>
    </span>


    <?php if ( has_category() ) : ?>
    <span class="meta-categories">
        <i class="fa-solid fa-folder-open"> </i>&nbsp;
        <span class="screen-reader-text">Posted in:</span>
        <span style="text-decoration: none;">
            <?php
                $categories = get_the_category_list( ' <span class="meta-category-separator">|</span> ' );
                echo str_replace( '<a', '<a style="text-decoration: none; color:var(--text-color);"', $categories );
            ?>
        </span>
    </span>
<?php endif; ?>

<?php if ( has_tag() ) : ?>
    <span class="meta-tags">
        <i class="fa-solid fa-tags"> </i>&nbsp;
        <span class="screen-reader-text">Tags:</span>
        <span style="text-decoration: none;">
            <?php
                $tags = get_the_tag_list( '', ' <span class="meta-tag-separator">|</span> ', '' );
                echo str_replace( '<a', '<a style="text-decoration: none; color:var(--text-color);"', $tags );
            ?>
        </span>
    </span>
<?php endif; ?>

</div>

<?php

/**
 * Single Post template file
 * 
 * @package ArnabWP
 */

get_header(); // Includes the header part



$sidebar_layout = get_theme_mod('arnabwp_sidebar_layout', 'right');
$layout_class = 'has-sidebar-right';

if ($sidebar_layout === 'left') {
    $layout_class = 'has-sidebar-left';
} elseif ($sidebar_layout === 'no') {
    $layout_class = 'no-sidebar';
}
?>


<main id="primary" class="site-main">
<header class='py-5 bg-info'>

   
    <?php
    if  (is_single()) : ?>

        <h1 class="fw-bold text-center">
         <?php the_title(); ?>
        </h1>
        <p class="text-small text-center">Posted on <?php echo get_the_date(); ?> </p>
    <?php 
  endif
    ?>
</header>

<section class="site-container py-5 <?php echo esc_attr($layout_class); ?>">
    <div class="arnabwp-blog-content d-flex flex-lg-row">


        <?php if ($sidebar_layout === 'left') : ?>
            <?php get_sidebar(); ?>
        <?php endif; ?>
        <!-- Main Content Area -->

        <?php if (have_posts()) : ?>

            <div class="content-area flex-grow-1">
                <?php while (have_posts()) :
                    the_post();
                    get_template_part('template_parts/blogs/content', 'single'); ?>

                    <?php
                    // If comments are open or there are comments, load comment template
                    if (comments_open() || get_comments_number()) :
                    ?>
                        <span class="comments-area mt-5">
                            <i class="fa-solid fa-comments"></i>
                            <span class="screen-reader-text">Comments:</span>
                            <?php comments_template(); ?>

                        </span>

                    <?php endif; ?>


                    <div class="post-navigation">
                        <div class="previous-post">
                        <?php previous_post_link('<span>%link</span>', '← Previous Post'); ?>
                        </div>
                        <div class="next-post">
                        <?php next_post_link('<span>%link</span>', 'Next Post →'); ?>
                        </div>
                    </div>
                  
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <!-- Sidebar Area (Right Side) -->
        <?php if ($sidebar_layout === 'right') : ?>
            <?php get_sidebar(); ?>
        <?php endif; ?>
    </div>
    </div>
        </section>
</main>
<?php get_footer(); // Includes the footer part 
?>
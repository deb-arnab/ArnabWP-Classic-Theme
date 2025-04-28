<?php
/**
 * Single Post template file
 * 
 * @package ArnabWP
 */

get_header(); // Includes the header part

?>

<main id="primary" class="site-main py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content Area -->
            <div class="col-lg-8">
                <?php
                while ( have_posts() ) :
                    the_post();
                    get_template_part( 'template_parts/blogs/content', 'single' );?>

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
                            <?php previous_post_link( '<div class="btn btn-light">%link</div>', 'Previous Post' ); ?>
                        </div>
                        <div class="next-post">
                            <?php next_post_link( '<div class="btn btn-light">%link</div>', 'Next Post' ); ?>
                        </div>
                    </div>

                <?php endwhile; ?>
            </div>

            <!-- Sidebar Area (Right Side) -->
            <div class="col-lg-4">
                <?php get_sidebar(); // Loads the sidebar.php ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); // Includes the footer part ?>

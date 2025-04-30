<?php
/**
 * Page template file
 * 
 * @package ArnabWP
 */
?>


<?php
get_header();
?>

<main class="py-5 bg-info">
    <div class="site-container">
        <?php 
     
        if ( is_page() ) : ?>
            <h1 class="mb-5 fw-bold text-center"><?php the_title(); ?></h1>
        <?php 
endif; ?>

        <div class="page-content">
            <?php
            while ( have_posts() ) : the_post();
                the_content(); // Display content for the page
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
get_footer();
?>


<?php
/**
 * Page template file
 *
 * This template is used to display individual pages on the website.
 *
 * @package ArnabWP
 */
?>

<?php
// Include the header template part
get_header();
?>

<main class="py-5 bg-info">
    <div class="site-container">
        <?php 
        // Check if the current page is a single page and display the title
        if ( is_page() ) : ?>
            <h1 class="fw-bold text-center"><?php the_title(); ?></h1>
        <?php 
        endif; ?>

        <div class="page-content">
            <?php
            // Loop through the posts and display the content for the page
            while ( have_posts() ) : the_post();
                the_content(); // Display the content for the page
            endwhile;
            ?>
        </div>
    </div>
</main>

<?php
// Include the footer template part
get_footer();
?>

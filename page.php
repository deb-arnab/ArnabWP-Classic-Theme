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

<main id="primary" class="site-main">
<header class='py-5 bg-info'>
        <?php 
        // Check if the current page is a single page and display the title
        if ( is_page() ) : ?>
            <h1 class="fw-bold text-center"><?php the_title(); ?></h1>
        <?php 
        endif; ?>
	</header>
    <div class="site-container py-5 <?php echo esc_attr($layout_class); ?>">
        <div class="arnabwp-page-content">
        <?php if ($sidebar_layout === 'left') : ?>
      <?php get_sidebar(); ?>
    <?php endif; ?>
    <?php if (have_posts()) : ?>
        <div class="content-area row">
            <?php
            // Loop through the posts and display the content for the page
            while ( have_posts() ) : the_post();
                the_content(); // Display the content for the page
            endwhile;
            ?>
    
	  <?php endif; ?>
		
	  </div>
		<?php if ($sidebar_layout === 'right') : ?>
        <?php get_sidebar(); ?>
      <?php endif; ?>
  </div>
	</div>
</main>

<?php
// Include the footer template part
get_footer();
?>

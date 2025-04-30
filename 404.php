<?php
/**
 * 404 template file
 * 
 * @package ArnabWP
 */
?>


<?php
get_header();
?>

<main id="primary" class="site-main py-5">
<div class="site-container">
        <div class="row">
            <!-- Main Content Area -->
            <?php
                    get_template_part( 'template_parts/blogs/content', 'none' );?>

                 
                
        </div>
    </div>
</main>

<?php
get_footer();
?>

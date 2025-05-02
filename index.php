<?php
/**
 * Main template file
 * 
 * This template is used to display a page when nothing more specific matches a query.
 * It is a fallback template for posts index (blog page).
 *
 * @package ArnabWP
 */

use ARNABWP_THEME\Inc\Pagination;

// Initialize pagination instance.
$pagination = Pagination::get_instance();

// Get sidebar layout setting.
$sidebar_layout = get_theme_mod( 'arnabwp_sidebar_layout', 'right' );
$layout_class   = 'has-sidebar-right';

if ( 'left' === $sidebar_layout ) {
	$layout_class = 'has-sidebar-left';
} elseif ( 'no' === $sidebar_layout ) {
	$layout_class = 'no-sidebar';
}

// Get blog layout setting.
$blog_layout = get_theme_mod( 'arnabwp_blog_layout', 'masonry' );
$blog_class  = ( 'list' === $blog_layout ) ? 'list-layout' : 'masonry-grid';
?>

<?php get_header(); ?>

<main id="primary" class="site-main" role="main">
  <header class="py-5 bg-info">
    <?php if ( is_home() && ! is_front_page() ) : ?>
      <h1 class="fw-bold text-center">
        <?php single_post_title(); ?>
      </h1>
    <?php endif; ?>
  </header>

  <section class="site-container py-5 <?php echo esc_attr( $layout_class ); ?>">
    <div class="arnabwp-blog-content d-flex flex-lg-row">

      <?php if ( 'left' === $sidebar_layout ) : ?>
        <?php get_sidebar(); ?>
      <?php endif; ?>

      <div class="content-area flex-grow-1">
        <?php if ( have_posts() ) : ?>
          <div class="<?php echo esc_attr( $blog_class ); ?>" aria-label="Blog Posts">
            <?php
            global $arnabwp_post_index;
            $arnabwp_post_index = 0;

            while ( have_posts() ) :
              the_post();
              $arnabwp_post_index++;
              get_template_part( 'template_parts/blogs/content' );
            endwhile;
            ?>
          </div><!-- /.<?php echo esc_attr( $blog_class ); ?> -->
        <?php else : ?>
          <?php get_template_part( 'template_parts/blogs/content', 'none' ); ?>
        <?php endif; ?>

        <div class="mt-4 mb-4">
          <?php $pagination->arnabwp_page_nav(); ?>
        </div>
      </div><!-- /.content-area -->

      <?php if ( 'right' === $sidebar_layout ) : ?>
        <?php get_sidebar(); ?>
      <?php endif; ?>

    </div><!-- /.arnabwp-blog-content -->
  </section>
</main>

<?php get_footer(); ?>

<?php

/**
 * Archive Template
 *
 * @package arnabwp
 */

use ARNABWP_THEME\Inc\Pagination;

$pagination = Pagination::get_instance();

$sidebar_layout = get_theme_mod('arnabwp_sidebar_layout', 'right');
$layout_class = 'has-sidebar-right';

if ($sidebar_layout === 'left') {
	$layout_class = 'has-sidebar-left';
} elseif ($sidebar_layout === 'no') {
	$layout_class = 'no-sidebar';
}

// Get blog layout setting.
$blog_layout = get_theme_mod('arnabwp_blog_layout', 'masonry');
$blog_class  = ('list' === $blog_layout) ? 'list-layout' : 'masonry-grid';
get_header(); ?>

<main id="primary" class="site-main" role="main">

	<header class='py-5 bg-info'>
		<?php if (is_archive() && have_posts()) : ?>
			<h1 class="fw-bold text-center">
				<?php the_archive_title(); ?>
			</h1>
			<?php the_archive_description('<div class="text-small text-center">', '</div>'); ?>
		<?php else : ?>
			<h1 class="fw-bold text-center"><?php esc_html_e('Nothing Found', 'arnabwp'); ?></h1>
		<?php endif; ?>
	</header>

	<section class="site-container py-5 <?php echo esc_attr($layout_class); ?>">
		<div class="arnabwp-blog-content d-flex flex-lg-row">
			<?php if ($sidebar_layout === 'left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

			<div class="content-area flex-grow-1">
				<?php if (have_posts()) : ?>
					<div class="<?php echo esc_attr($blog_class); ?>" aria-label="Blog Posts">
						<?php
						global $arnabwp_post_index;
						$arnabwp_post_index = 0;

						while (have_posts()) :
							the_post();
							$arnabwp_post_index++;
						?>

							<?php get_template_part('template_parts/blogs/content', 'archive'); ?>

						<?php
						endwhile;
						?>
					</div><!-- /.<?php echo esc_attr($blog_class); ?> -->



				<?php else :
					get_template_part('template_parts/blogs/content', 'none');
				?>
				<?php endif; ?>
				<!-- pagination inside content area -->
				<div class="mt-4 mb-4">
					<?php $pagination->arnabwp_page_nav(); ?>
				</div>
			</div><!-- /.content-area -->

			<?php if ($sidebar_layout === 'right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div><!-- /.arnabwp-blog-content -->
	</section>
</main>

<?php get_footer(); ?>
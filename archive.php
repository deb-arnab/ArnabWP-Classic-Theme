<?php
/**
 * Archive Template
 *
 * @package arnabwp
 */

get_header(); ?>

<main id="primary" class="site-main py-5">
	<div class="container">
		<header class="mb-5">
			<?php if (have_posts()) : ?>
				<h1 class="h3">
					<?php the_archive_title(); ?>
				</h1>
				<?php the_archive_description('<div class="text-muted mb-3">', '</div>'); ?>
			<?php else : ?>
				<h1 class="h3"><?php esc_html_e('Nothing Found', 'arnabwp'); ?></h1>
			<?php endif; ?>
		</header>

		<?php if (have_posts()) : ?>
			<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
				<?php while (have_posts()) : the_post(); ?>
					<div class="col">
						<article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 shadow-sm'); ?>>
							<?php if (has_post_thumbnail()) : ?>
								<a href="<?php the_permalink(); ?>" class="text-decoration-none">
									<?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => get_the_title()]); ?>
								</a>
							<?php endif; ?>

							<div class="card-body">
								<h2 class="card-title h5">
									<a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
										<?php the_title(); ?>
									</a>
								</h2>
								<p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
							</div>

							<div class="card-footer bg-info border-top-0">
								<small class="text-white">
									<?php echo get_the_date(); ?> | <?php the_author(); ?>
								</small>
							</div>
						</article>
					</div>
				<?php endwhile; ?>
			</div>

			<div class="mt-5">
				<?php the_posts_pagination([
					'prev_text' => __('« Prev', 'arnabwp'),
					'next_text' => __('Next »', 'arnabwp'),
				]); ?>
			</div>
		<?php else : ?>
			<div class="alert alert-warning" role="alert">
				<?php esc_html_e('Sorry, no posts matched your criteria.', 'arnabwp'); ?>
			</div>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>

<?php
/**
 * Search Results Template
 *
 * @package arnabwp
 */
use ARNABWP_THEME\Inc\Pagination;

$pagination = Pagination::get_instance();
get_header(); ?>

<main id="primary" class="site-main">
<header class='py-5 bg-info'>
			<h1 class="fw-bold text-center">
				<?php
				printf(
					esc_html__('Search Results for: %s', 'arnabwp'),
					'<span>' . esc_html(get_search_query()) . '</span>'
				);
				?>
			</h1>
		</header>
		<div class="site-container py-5">
		<?php if (have_posts()) : ?>
			<div class="content-area row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
				<?php while (have_posts()) : the_post(); ?>
					<div class="col">
						<article id="post-<?php the_ID(); ?>" <?php post_class('card h-100 shadow-sm'); ?>>
							<?php if (has_post_thumbnail()) : ?>
								<a href="<?php the_permalink(); ?>" class="text-decoration-none">
									<?php the_post_thumbnail('medium', ['class' => 'card-img-top', 'alt' => get_the_title()]); ?>
								</a>
							

							<div class="card-body bg-white">
								<h2 class="card-title post-title">
									<a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
										<?php the_title(); ?>
									</a>
								</h2>
								<p class="card-text"><?php echo wp_trim_words(get_the_excerpt()); ?></p>
								<a href="<?php the_permalink(); ?>" class="btn btn-sm">Read More</a>
							</div>
							<div class="card-footer border-top-0">
								<small class="text-white">
								<?php get_template_part( 'template_parts/blogs/content', 'meta' ); ?>
								</small>
							</div>
							<?php else : ?>
							<div class="card-body">
								<h2 class="card-title h5">
									<a href="<?php the_permalink(); ?>" class="text-decoration-none text-dark">
										<?php the_title(); ?>
									</a>
								</h2>
								<p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
								<a href="<?php the_permalink(); ?>" class="btn btn-sm">Read More</a>
							</div>

							<div class="card-footer border-top-0">
								<small class="text-white">
								<?php get_template_part( 'template_parts/blogs/content', 'meta' ); ?>
								</small>
							</div>
							<?php endif; ?>
						</article>
				</div>
				<?php endwhile; ?>
				<?php else :
      get_template_part('template_parts/blogs/content', 'none');
      ?>
	  <?php endif; ?>
			
	  </div>
	  <div>
        <?php $pagination->arnabwp_page_nav(); ?>
      </div>
  </div>

</main>

<?php get_footer(); ?>
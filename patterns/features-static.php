<?php
/**
 * Title: Services / Features Section (Static)
 * Slug: arnabwp/features-static
 * Categories: arnabwp-sections, featured
 * Keywords: services, features, icons, grid
 * Inserter: yes
 */

return [
	'title'       => __( 'Services / Features Section (Static)', 'arnabwp' ),
	'slug'        => 'arnabwp/features-static',
	'categories'  => [ 'arnabwp-sections', 'featured' ],
	'keywords'    => [ 'services', 'features', 'grid', 'icons' ],
	'description' => __( 'A 3-column static services section with icons, titles, and descriptions.', 'arnabwp' ),
	'content'     => <<<HTML
<!-- wp:group {"tagName":"section","className":"services-section py-5","layout":{"type":"constrained"}} -->
<section class="wp-block-group services-section py-5" aria-label="Services">

	<!-- wp:group {"className":"site-container","layout":{"type":"constrained"}} -->
	<div class="wp-block-group site-container">

		<!-- wp:group {"className":"text-center mb-4"} -->
		<div class="wp-block-group text-center mb-4">
			<!-- wp:heading {"level":2,"className":"fw-bold","style":{"typography":{"fontSize":"32px"}}} -->
			<h2 class="wp-block-heading has-text-align-center fw-bold" style="font-size:32px">Our Services</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"text-muted","style":{"typography":{"fontSize":"16px"}}} -->
			<p class="has-text-align-center text-muted" style="font-size:16px">Explore the solutions we offer</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:columns {"isStackedOnMobile":true,"className":"service-cards"} -->
		<div class="wp-block-columns service-cards">

			<!-- wp:column -->
			<div class="wp-block-column">
				<div class="service-card h-100 text-center">
					<figure style="margin:0;">
						<img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prf.jpg"
							alt="Design"
							width="70"
							height="70"
							style="border-radius:50%;"
							class="mx-auto mt-3" />
					</figure>
					<div class="card-body">
						<h5 class="card-title entry-title" style="font-size:18px;color:#000;">Creative Design</h5>
						<p class="card-text" style="font-size:14px;color:#888;">
							Beautiful and responsive layouts tailored to your brand.
						</p>
					</div>
				</div>
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<div class="service-card h-100 text-center">
					<figure style="margin:0;">
						<img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prf.jpg"
							alt="Development"
							width="70"
							height="70"
							style="border-radius:50%;"
							class="mx-auto mt-3" />
					</figure>
					<div class="card-body">
						<h5 class="card-title entry-title" style="font-size:18px;color:#000;">Web Development</h5>
						<p class="card-text" style="font-size:14px;color:#888;">
							Robust, scalable, and lightning-fast web development.
						</p>
					</div>
				</div>
			</div>
			<!-- /wp:column -->

			<!-- wp:column -->
			<div class="wp-block-column">
				<div class="service-card h-100 text-center">
					<figure style="margin:0;">
						<img src="http://arnabwp.local/wp-content/themes/arnabwp/assets/img/prf.jpg"
							alt="Support"
							width="70"
							height="70"
							style="border-radius:50%;"
							class="mx-auto mt-3" />
					</figure>
					<div class="card-body">
						<h5 class="card-title entry-title" style="font-size:18px;color:#000;">24/7 Support</h5>
						<p class="card-text" style="font-size:14px;color:#888;">
							Always available to assist with your website needs.
						</p>
					</div>
				</div>
			</div>
			<!-- /wp:column -->

		</div>
		<!-- /wp:columns -->

	</div>
	<!-- /wp:group -->

</section>
<!-- /wp:group -->
HTML
];